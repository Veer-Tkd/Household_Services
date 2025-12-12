<?php
require_once 'config.php';

// Check if user is logged in
if (!is_logged_in()) {
    redirect('login.php');
}

// Get current user data
$current_user = app_get_current_user($pdo);

if (!$current_user) {
    session_destroy();
    redirect('login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Household Services</title>
    
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
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc, #43e97b);
            min-height: 100vh;
            color: #333;
        }
        
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .logo h1 {
            color: #6a11cb;
            font-size: 1.8rem;
        }
        
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
        }
        
        .nav-menu a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-menu a:hover {
            color: #6a11cb;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .logout-btn {
            background: #ff4757;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s;
        }
        
        .logout-btn:hover {
            background: #ff3742;
        }
        
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        
        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .welcome-card h2 {
            color: #6a11cb;
            margin-bottom: 1rem;
        }
        
        .user-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .detail-item {
            background: rgba(106, 17, 203, 0.1);
            padding: 1rem;
            border-radius: 10px;
            border-left: 4px solid #6a11cb;
        }
        
        .detail-item strong {
            color: #6a11cb;
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .service-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        
        .service-card:hover {
            transform: translateY(-5px);
        }
        
        .service-card i {
            font-size: 3rem;
            color: #6a11cb;
            margin-bottom: 1rem;
        }
        
        .service-card h3 {
            color: #333;
            margin-bottom: 1rem;
        }
        
        .service-card p {
            color: #666;
            margin-bottom: 1.5rem;
        }
        
        .btn {
            background: #6a11cb;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #5a0ea8;
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-menu {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
            
            .user-info {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <h1>Household Services</h1>
            </div>
            
            <ul class="nav-menu">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="bookings.php">My Bookings</a></li>
                <li><a href="profile.php">Profile</a></li>
            </ul>
            
            <div class="user-info">
                <span>Welcome, <?php echo htmlspecialchars($current_user['first_name']); ?>!</span>
                <a href="logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="welcome-card">
            <h2>Welcome to Your Dashboard</h2>
            <p>Hello <?php echo htmlspecialchars($current_user['first_name'] . ' ' . $current_user['last_name']); ?>! 
               Manage your household services from here.</p>
            
            <div class="user-details">
                <div class="detail-item">
                    <strong>Name:</strong> <?php echo htmlspecialchars($current_user['first_name'] . ' ' . $current_user['last_name']); ?>
                </div>
                <div class="detail-item">
                    <strong>Email:</strong> <?php echo htmlspecialchars($current_user['email']); ?>
                </div>
                <div class="detail-item">
                    <strong>Gender:</strong> <?php echo ucfirst(htmlspecialchars($current_user['gender'])); ?>
                </div>
                <div class="detail-item">
                    <strong>Account Type:</strong> <?php echo ucfirst(htmlspecialchars($current_user['user_type'])); ?>
                </div>
                <div class="detail-item">
                    <strong>Member Since:</strong> <?php echo date('F Y', strtotime($current_user['created_at'])); ?>
                </div>
            </div>
        </div>

        <div class="services-grid">
            <div class="service-card">
                <i class="fas fa-broom"></i>
                <h3>Cleaning Services</h3>
                <p>Professional house cleaning services for your home</p>
                <a href="services.php?category=cleaning" class="btn">Book Now</a>
            </div>
            
            <div class="service-card">
                <i class="fas fa-tools"></i>
                <h3>Repair & Maintenance</h3>
                <p>Fix and maintain your household appliances and fixtures</p>
                <a href="services.php?category=repair" class="btn">Book Now</a>
            </div>
            
            <div class="service-card">
                <i class="fas fa-paint-roller"></i>
                <h3>Painting Services</h3>
                <p>Interior and exterior painting services</p>
                <a href="services.php?category=painting" class="btn">Book Now</a>
            </div>
            
            <div class="service-card">
                <i class="fas fa-seedling"></i>
                <h3>Gardening</h3>
                <p>Garden maintenance and landscaping services</p>
                <a href="services.php?category=gardening" class="btn">Book Now</a>
            </div>
            
            <div class="service-card">
                <i class="fas fa-wrench"></i>
                <h3>Plumbing</h3>
                <p>Professional plumbing services and repairs</p>
                <a href="services.php?category=plumbing" class="btn">Book Now</a>
            </div>
            
            <div class="service-card">
                <i class="fas fa-bolt"></i>
                <h3>Electrical Work</h3>
                <p>Safe and reliable electrical services</p>
                <a href="services.php?category=electrical" class="btn">Book Now</a>
            </div>
        </div>
    </div>

    <script>
        // Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all service cards
            document.querySelectorAll('.service-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
</body>
</html>