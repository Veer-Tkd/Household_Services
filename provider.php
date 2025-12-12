<?php
require_once 'config.php';

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
    $phone = sanitize_input($_POST['phone']);
    $service_type = sanitize_input($_POST['service_type']);
    $experience = sanitize_input($_POST['experience']);
    $terms_accepted = isset($_POST['terms']);
    
    // Validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirm_password) || empty($phone) || empty($service_type) || empty($experience)) {
        $error_message = "All fields are required.";
    } elseif (!validate_email($email)) {
        $error_message = "Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $error_message = "Password must be at least 6 characters long.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } elseif (empty($gender) || !in_array($gender, ['male', 'female'])) {
        $error_message = "Please select a valid gender.";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $error_message = "Please enter a valid 10-digit phone number.";
    } elseif (!$terms_accepted) {
        $error_message = "You must accept the terms and conditions.";
    } else {
        try {
            // Check if email already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->fetch()) {
                $error_message = "An account with this email already exists.";
            } else {
                // Create new provider
                $hashed_password = hash_password($password);
                
                $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, gender, user_type, phone, service_type, experience) VALUES (?, ?, ?, ?, ?, 'provider', ?, ?, ?)");
                $stmt->execute([$first_name, $last_name, $email, $hashed_password, $gender, $phone, $service_type, $experience]);
                
                $success_message = "Provider registration successful! You can now <a href='login.php'>login</a>.";
                
                // Clear form data on success
                $first_name = $last_name = $email = $gender = $phone = $service_type = $experience = '';
            }
        } catch (PDOException $e) {
            // Check if we need to add columns to users table
            if (strpos($e->getMessage(), 'Unknown column') !== false) {
                try {
                    // Add missing columns for providers
                    $pdo->exec("ALTER TABLE users ADD COLUMN phone VARCHAR(15) NULL");
                    $pdo->exec("ALTER TABLE users ADD COLUMN service_type VARCHAR(100) NULL");
                    $pdo->exec("ALTER TABLE users ADD COLUMN experience VARCHAR(50) NULL");
                    
                    // Retry the insert
                    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, gender, user_type, phone, service_type, experience) VALUES (?, ?, ?, ?, ?, 'provider', ?, ?, ?)");
                    $stmt->execute([$first_name, $last_name, $email, $hashed_password, $gender, $phone, $service_type, $experience]);
                    
                    $success_message = "Provider registration successful! You can now <a href='login.php'>login</a>.";
                    $first_name = $last_name = $email = $gender = $phone = $service_type = $experience = '';
                } catch (PDOException $e2) {
                    $error_message = "Registration failed. Please try again.";
                    error_log("Provider registration error: " . $e2->getMessage());
                }
            } else {
                $error_message = "Registration failed. Please try again.";
                error_log("Provider registration error: " . $e->getMessage());
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Household Services - Provider Registration</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

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
        
        .provider-badge {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        
        select {
            width: 100%;
            padding: 12px 15px;
            margin-top: 5px;
            border-radius: 25px;
            border: 1px solid lightsteelblue;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            background: white;
            color: black;
            font-size: 1rem;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        
        select:focus {
            outline: none;
            border-color: #6a11cb;
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
                    <li><a href="register.php">Register</a></li>
                    <li><a href="provider.php" class="nav-item nav-link active">Provider Register</a></li>
                </ul>
            </nav>
        </header>
    </div>
    
    <div class="content">
        <div class="provider-badge">
            <i class="fas fa-briefcase"></i> Service Provider Registration
        </div>
        
        <h2>Join as a Service Provider</h2>
        
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <form id="providerForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
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
                <i class="fa-solid fa-phone"></i>
                <input 
                    type="tel" 
                    name="phone" 
                    placeholder="Phone Number (10 digits)" 
                    class="text-name" 
                    value="<?php echo isset($phone) ? htmlspecialchars($phone) : ''; ?>"
                    pattern="[0-9]{10}"
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
                <i class="fa-solid fa-tools"></i>
                <select name="service_type" required>
                    <option value="">Select Service Type</option>
                    <option value="cleaning" <?php echo (isset($service_type) && $service_type == 'cleaning') ? 'selected' : ''; ?>>Cleaning Services</option>
                    <option value="repair" <?php echo (isset($service_type) && $service_type == 'repair') ? 'selected' : ''; ?>>Repair & Maintenance</option>
                    <option value="painting" <?php echo (isset($service_type) && $service_type == 'painting') ? 'selected' : ''; ?>>Painting Services</option>
                    <option value="gardening" <?php echo (isset($service_type) && $service_type == 'gardening') ? 'selected' : ''; ?>>Gardening</option>
                    <option value="plumbing" <?php echo (isset($service_type) && $service_type == 'plumbing') ? 'selected' : ''; ?>>Plumbing</option>
                    <option value="electrical" <?php echo (isset($service_type) && $service_type == 'electrical') ? 'selected' : ''; ?>>Electrical Work</option>
                    <option value="carpentry" <?php echo (isset($service_type) && $service_type == 'carpentry') ? 'selected' : ''; ?>>Carpentry</option>
                    <option value="other" <?php echo (isset($service_type) && $service_type == 'other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            
            <div class="input-name">
                <i class="fa-solid fa-medal"></i>
                <select name="experience" required>
                    <option value="">Years of Experience</option>
                    <option value="0-1" <?php echo (isset($experience) && $experience == '0-1') ? 'selected' : ''; ?>>0-1 Year</option>
                    <option value="1-3" <?php echo (isset($experience) && $experience == '1-3') ? 'selected' : ''; ?>>1-3 Years</option>
                    <option value="3-5" <?php echo (isset($experience) && $experience == '3-5') ? 'selected' : ''; ?>>3-5 Years</option>
                    <option value="5-10" <?php echo (isset($experience) && $experience == '5-10') ? 'selected' : ''; ?>>5-10 Years</option>
                    <option value="10+" <?php echo (isset($experience) && $experience == '10+') ? 'selected' : ''; ?>>10+ Years</option>
                </select>
            </div>
            
            <hr />
            
            <div class="input-name">
                <input type="checkbox" name="terms" class="check-button" required />
                <label>I agree to the Terms and Conditions and Provider Agreement</label>
            </div>
            
            <hr />
            
            <div class="input-reg">
                <input type="submit" class="button" value="Register as Provider" />
            </div>
            
            <div class="input-p">
                <p>
                    Already Have an Account? <span><a href="login.php">Login</a></span>
                </p>
                <p>
                    Want to register as a customer? <span><a href="register.php">Customer Registration</a></span>
                </p>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("providerForm");
            const submitBtn = document.querySelector(".button");

            // Real-time validation
            const phoneInput = document.querySelector('input[name="phone"]');
            const passwordInput = document.querySelector('input[name="password"]');
            const confirmPasswordInput = document.querySelector('input[name="confirm_password"]');
            const emailInput = document.querySelector('input[name="email"]');

            // Phone number validation
            phoneInput.addEventListener('input', function() {
                const phoneRegex = /^[0-9]{10}$/;
                if (!phoneRegex.test(phoneInput.value)) {
                    phoneInput.classList.add('input-error');
                } else {
                    phoneInput.classList.remove('input-error');
                }
            });

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

                // Validate all required fields
                const requiredFields = form.querySelectorAll('input[required], select[required]');
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('input-error');
                        isValid = false;
                    }
                });

                // Specific validations
                if (!validateEmail(emailInput.value)) {
                    emailInput.classList.add('input-error');
                    isValid = false;
                }

                const phoneRegex = /^[0-9]{10}$/;
                if (!phoneRegex.test(phoneInput.value)) {
                    phoneInput.classList.add('input-error');
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

                const termsChecked = document.querySelector('input[name="terms"]').checked;
                if (!termsChecked) {
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