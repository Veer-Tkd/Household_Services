<?php
require 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $address = $_POST['address'];
  $date = $_POST['date'];
  $service = $_POST['service'];

  $stmt = $conn->prepare("INSERT INTO bookings (fullname, email, mobile, address, date, service) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $fullname, $email, $mobile, $address, $date, $service);

  if ($stmt->execute()) {
   // Send Thank You Email
   $mail = new PHPMailer(true);
   try {
     $mail->isSMTP();
     $mail->Host       = 'smtp.gmail.com';
     $mail->SMTPAuth   = true;
     $mail->Username   = '220140107054veerpatel@gmail.com'; // Replace with your Gmail
     $mail->Password   = 'dnsysqcvzhrdadce';     // Replace with your App Password
     $mail->SMTPSecure = 'tls';
     $mail->Port       = 587;

     $mail->setFrom('220140107054veerpatel@gmail.com', 'Household Services');
     $mail->addAddress($email, $fullname);
     $mail->isHTML(true);
     $mail->Subject = 'Thank You for Your Booking!';
     $mail->Body    = "<h2>Hello, $fullname!</h2>
        <p>Thank you for booking <strong>$service</strong> service on <strong>$date</strong>.</p>
        <p>We’ll reach out to you soon to confirm the details.</p>
        <br><p>- Household Services Team</p>";

      $mail->send();
    } catch (Exception $e) {
      error_log("Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }

    echo "<script>alert('Booking successful!'); window.location.href='book.php';</script>";
    } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>

<?php include 'header.php'; ?>


<style>
      body {
        font-family: Arial, sans-serif;
      }
      .container {
        width: 70%;
        margin: 0 auto;
      }
      .booking-form {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
      }
      .booking-form label {
        font-weight: bold;
        margin-bottom: 5px;
      }
      .booking-form input,
      .booking-form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }
      .booking-form button {
        grid-column: 1 / -1;
        padding: 10px 20px;
        background-color: #f0c107;
        border: none;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        border-radius: 5px;
      }
      .booking-form button:hover {
        background-color: #d8a506;
      }
    </style>

<div class="container">
  <h1>BOOK <span style="color: #f0c107">NOW</span></h1>
  <p>Quick Book</p>
  <form class="booking-form" method="POST" action="book.php">
    <div>
      <label for="fullname">Full Name</label>
      <input type="text" id="fullname" name="fullname" required />
    </div>
    <div>
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required />
    </div>
    <div>
      <label for="mobile">Mobile</label>
      <input type="tel" id="mobile" name="mobile" required />
    </div>
    <div>
      <label for="address">Address</label>
      <input type="text" id="address" name="address" />
    </div>
    <div>
      <label for="date">Date</label>
      <input type="date" id="date" name="date" required />
    </div>
    <div>
      <label for="service">Select Your Service</label>
      <select id="service" name="service" required>
        <option value="" disabled selected>Select</option>
        <option value="Home Cleaning">Home Cleaning</option>
        <option value="Cooking">Cooking</option>
        <option value="Gardening">Gardening</option>
        <option value="Electrician">Electrician</option>
        <option value="Plumbing">Plumbing</option>
        <option value="Carpenter">Carpenter</option>
      </select>
    </div>
    <button type="submit">Book Now</button>
  </form>
</div>

<?php include 'footer.php'; ?>
