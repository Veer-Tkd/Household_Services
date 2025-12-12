<?php
require_once 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure Composer has installed PHPMailer


$error_message = '';
$success_message = '';

// Check if user is already logged in
if (is_logged_in()) {
    redirect('dashboard.php');
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = sanitize_input($_POST['first_name']);
    $last_name = sanitize_input($_POST['last_name']);
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = isset($_POST['gender']) ? sanitize_input($_POST['gender']) : '';
    $terms_accepted = isset($_POST['terms']);
    
    // Validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error_message = "All fields are required.";
    } elseif (!validate_email($email)) {
        $error_message = "Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $error_message = "Password must be at least 6 characters long.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } elseif (empty($gender) || !in_array($gender, ['male', 'female'])) {
        $error_message = "Please select a valid gender.";
    } elseif (!$terms_accepted) {
        $error_message = "You must accept the terms and conditions.";
    } else {
        try {
            // Check if email already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->fetch()) {
                $error_message = "An account with this email already exists.";
            } 
            else {
                // Create new user
                $hashed_password = hash_password($password);

                $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, gender) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$first_name, $last_name, $email, $hashed_password, $gender]);

                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = '220140107054veerpatel@gmail.com'; // your Gmail address
                    $mail->Password = 'dnsysqcvzhrdadce';     // your App Password
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    $mail->setFrom('220140107054veerpatel@gmail.com', 'Household Services');
                    $mail->addAddress($email, $first_name);

                    $mail->isHTML(true);
                    $mail->Subject = 'Thank You for Registering!';
                    $mail->Body    = "<h2>Welcome, $first_name!</h2><p>Thanks for registering on our website. We're excited to have you with us.</p><p>We’re happy to have you onboard. Feel free to explore and use our services.</p><br><p>-- Best regards,<br>Household Services Team</p>";

                    $mail->send();
                } catch (Exception $e) {
                    error_log("Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
                }


                // Redirect to login page after successful registration
                header('Location: login.php');
                exit();
                }
            } 
        catch (PDOException $e) {
            $error_message = "Registration failed. Please try again.";
            error_log("Registration error: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Household Services - Register</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        rel="stylesheet"
    />

    <link rel="stylesheet" href="register.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />
    
    <style>
        .error-message {
            color: #ff6b6b;
            background-color: rgba(255, 107, 107, 0.1);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }
        
        .success-message {
            color: #51cf66;
            background-color: rgba(81, 207, 102, 0.1);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid rgba(81, 207, 102, 0.3);
        }
        
        .success-message a {
            color: #2e7d32;
            font-weight: bold;
            text-decoration: underline;
        }
        
        .input-error {
            border: 2px solid #ff6b6b !important;
            background: rgba(255, 107, 107, 0.1) !important;
        }
        
        .field-error {
            color: #ff6b6b;
            font-size: 0.9em;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>

<body>
    <div>
        <header>
            <h1>Welcome to Household Services</h1>
            <nav>
                <br />
                <ul>
                    <li>    
                        <a href="index.php" class="nav-item nav-link">Home</a>
                    </li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php" class="nav-item nav-link active">Register</a></li>
                    <li><a href="provider.php">Provider Register</a></li>
                </ul>
            </nav>
        </header>
    </div>
    
    <div class="content">
        <h2>Registration Form</h2>
        
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <form id="registerForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="input-name split-input">
                <div class="input-box">
                    <i class="fa-solid fa-user"></i>
                    <input 
                        type="text" 
                        name="first_name" 
                        placeholder="First Name" 
                        value="<?php echo isset($first_name) ? htmlspecialchars($first_name) : ''; ?>"
                        required 
                    />
                </div>
                <div class="input-box">
                    <i class="fa-solid fa-user"></i>
                    <input 
                        type="text" 
                        name="last_name" 
                        placeholder="Last Name" 
                        value="<?php echo isset($last_name) ? htmlspecialchars($last_name) : ''; ?>"
                        required 
                    />
                </div>
            </div>

            <div class="input-name">
                <i class="fa-solid fa-envelope"></i>
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Email" 
                    class="text-name" 
                    value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"
                    required 
                />
            </div>

            <div class="input-name">
                <i class="fa-solid fa-lock"></i>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Password" 
                    class="text-name" 
                    required 
                />
            </div>

            <div class="input-name">
                <i class="fa-solid fa-lock"></i>
                <input
                    type="password"
                    name="confirm_password"
                    placeholder="Confirm Password"
                    class="text-name"
                    required
                />
            </div>
            
            <hr />
            
            <div class="radio-buttons">
                <label>
                    <input 
                        type="radio" 
                        class="radio-button" 
                        name="gender" 
                        value="male" 
                        <?php echo (isset($gender) && $gender == 'male') ? 'checked' : ''; ?>
                        required
                    />
                    Male
                </label>
                <label>
                    <input
                        type="radio"
                        class="radio-button"
                        name="gender"
                        value="female"
                        <?php echo (isset($gender) && $gender == 'female') ? 'checked' : ''; ?>
                        required
                    />
                    Female
                </label>
            </div>

            <hr />
            
            <div class="input-name">
                <input type="checkbox" name="terms" class="check-button" required />
                <label>Accept The Terms And Conditions</label>
            </div>
            
            <hr />
            
            <div class="input-reg">
                <input type="submit" class="button" value="Register" />
            </div>
            
            <div class="input-p">
                <p>
                    Already Have an Account? <span><a href="login.php">Login</a></span>
                </p>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("registerForm");
            const submitBtn = document.querySelector(".button");

            // Real-time validation
            const firstNameInput = document.querySelector('input[name="first_name"]');
            const lastNameInput = document.querySelector('input[name="last_name"]');
            const emailInput = document.querySelector('input[name="email"]');
            const passwordInput = document.querySelector('input[name="password"]');
            const confirmPasswordInput = document.querySelector('input[name="confirm_password"]');
            const termsCheckbox = document.querySelector('input[name="terms"]');

            // Password confirmation validation
            confirmPasswordInput.addEventListener('input', function() {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.classList.add('input-error');
                } else {
                    confirmPasswordInput.classList.remove('input-error');
                }
            });

            // Email validation
            emailInput.addEventListener('blur', function() {
                if (!validateEmail(emailInput.value)) {
                    emailInput.classList.add('input-error');
                } else {
                    emailInput.classList.remove('input-error');
                }
            });

            // Form submission validation
            form.addEventListener("submit", function (e) {
                let isValid = true;
                
                // Clear previous errors
                document.querySelectorAll('.input-error').forEach(input => {
                    input.classList.remove('input-error');
                });

                // Validate all fields
                if (!firstNameInput.value.trim()) {
                    firstNameInput.classList.add('input-error');
                    isValid = false;
                }

                if (!lastNameInput.value.trim()) {
                    lastNameInput.classList.add('input-error');
                    isValid = false;
                }

                if (!emailInput.value.trim() || !validateEmail(emailInput.value)) {
                    emailInput.classList.add('input-error');
                    isValid = false;
                }

                if (passwordInput.value.length < 6) {
                    passwordInput.classList.add('input-error');
                    isValid = false;
                }

                if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.classList.add('input-error');
                    isValid = false;
                }

                const genderSelected = document.querySelector('input[name="gender"]:checked');
                if (!genderSelected) {
                    isValid = false;
                }

                if (!termsCheckbox.checked) {
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });

            function validateEmail(email) {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(email);
            }
        });
    </script>
</body>
</html>