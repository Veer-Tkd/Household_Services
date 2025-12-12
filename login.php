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
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];
    
    // Validation
    if (empty($email) || empty($password)) {
        $error_message = "All fields are required.";
    } elseif (!validate_email($email)) {
        $error_message = "Please enter a valid email address.";
    } else {
        try {
            // Check if user exists
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND is_active = 1");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user && verify_password($password, $user['password'])) {
                // Login successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                $_SESSION['user_type'] = $user['user_type'];
                
                // Update last login time (optional)
                $stmt = $pdo->prepare("UPDATE users SET updated_at = CURRENT_TIMESTAMP WHERE id = ?");
                $stmt->execute([$user['id']]);
                
                redirect('index.php');
            } else {
                $error_message = "Invalid email or password.";
            }
        } catch (PDOException $e) {
            $error_message = "Login failed. Please try again.";
            error_log("Login error: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Household Services - Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        rel="stylesheet"
    />

    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="login.css" />
    
    <style>
        .error-message {
            color: #ff6b6b;
            background-color: rgba(255, 107, 107, 0.1);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }
        
        .success-message {
            color: #51cf66;
            background-color: rgba(81, 207, 102, 0.1);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
            border: 1px solid rgba(81, 207, 102, 0.3);
        }
        
        .input-error {
            border: 2px solid #ff6b6b !important;
            background: rgba(255, 107, 107, 0.1) !important;
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome to Household Services</h1>
        <nav>
            <ul>
                <li>
                    <a href="index.php" class="nav-item nav-link">Home</a>
                </li>
                <li><a href="login.php" class="nav-item nav-link active">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="provider.php">Provider Register</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="login-box">
            <h1>Login</h1>

            <?php if (!empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <?php if (!empty($success_message)): ?>
                <div class="success-message"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        class="text-input"
                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                        required
                    />
                </div>

                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="text-input"
                        required
                    />
                </div>

                <div class="input-login">
                    <input type="submit" class="button" value="Login" />
                </div>
            </form>

            <div class="signup">
                <p>Don't have an account? <a href="register.php">Sign Up</a></p>
            </div>
        </div>
    </div>

    <script>
        // Enhanced client-side validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const emailInput = document.querySelector('input[name="email"]');
            const passwordInput = document.querySelector('input[name="password"]');
            
            form.addEventListener('submit', function(e) {
                let isValid = true;
                
                // Clear previous errors
                document.querySelectorAll('.input-error').forEach(input => {
                    input.classList.remove('input-error');
                });
                
                // Email validation
                if (!emailInput.value.trim()) {
                    emailInput.classList.add('input-error');
                    isValid = false;
                } else if (!validateEmail(emailInput.value)) {
                    emailInput.classList.add('input-error');
                    isValid = false;
                }
                
                // Password validation
                if (!passwordInput.value.trim()) {
                    passwordInput.classList.add('input-error');
                    isValid = false;
                }
                
                if (!isValid) {
                    e.preventDefault();
                }
            });
            
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
        });
    </script>
</body>
</html>