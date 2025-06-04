<?php
    session_start();
    include"database.php";
    function countRecord($sql,$db)
    {
        try {
            $res = $db->query($sql);
            return $res->num_rows;
        } catch (Exception $e) {
            // Return 0 if query fails or table doesn't exist
            return 0;
        }
    }
    if(!isset($_SESSION["ID"]))
    {
	    header("location:ulogin.php");
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>MCA Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <style>
        :root {
            --primary-color: #7494ec;
            --primary-light: rgba(116, 148, 236, 0.1);
            --primary-dark: #5a7ad0;
            --accent-color: #ff6b6b;
            --text-dark: #333;
            --text-light: #777;
            --white: #ffffff;
            --shadow-light: 0 5px 15px rgba(0, 0, 0, 0.05);
            --shadow-dark: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition-speed: 0.3s;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: var(--text-dark);
            line-height: 1.6;
            position: relative;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Navigation Styles */
        .navbar {
            background: var(--white);
            box-shadow: var(--shadow-light);
            border-radius: 15px;
            padding: 15px;
            margin: 20px;
            position: relative;
            z-index: 10;
            transition: all var(--transition-speed);
        }
        
        .navbar nav ul {
            display: flex;
            flex-direction: column;
            gap: 10px;
            list-style: none;
        }
        
        .navbar button {
            background-color: transparent;
            border: none;
            width: 100%;
            text-align: left;
            border-radius: 10px;
            transition: all var(--transition-speed);
            position: relative;
            overflow: hidden;
        }
        
        .navbar button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.5s;
        }
        
        .navbar button:hover::before {
            left: 100%;
        }
        
        .navbar button:hover {
            background-color: var(--primary-light);
            transform: translateY(-3px);
        }
        
        .navbar a {
            color: var(--text-dark);
            text-decoration: none;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: all var(--transition-speed);
        }
        
        .navbar a:hover {
            color: var(--primary-color);
        }
        
        .navbar a i {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        .active-link {
            background-color: var(--primary-light);
            color: var(--primary-color) !important;
            border-left: 4px solid var(--primary-color);
        }
        
        .logo {
            text-align: center;
            padding: 20px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .logo h2 {
            color: var(--primary-color);
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .logo span {
            color: var(--accent-color);
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 20px;
            transition: all var(--transition-speed);
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-light);
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
        }
        
        .header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            position: relative;
        }
        
        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            position: relative;
        }
        
        .content-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 25px;
        }
        
        .card {
            background: var(--white);
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--shadow-light);
            transition: all var(--transition-speed);
            position: relative;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-dark);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .card-icon i {
            font-size: 1.8rem;
            color: var(--primary-color);
        }
        
        .card h3 {
            color: var(--text-dark);
            font-size: 1.3rem;
        }
        
        .card p {
            color: var(--text-light);
            margin-bottom: 20px;
        }
        
        .stat {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .card-action {
            display: inline-block;
            padding: 10px 20px;
            background: var(--primary-light);
            color: var(--primary-color);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all var(--transition-speed);
        }
        
        .card-action:hover {
            background: var(--primary-color);
            color: white;
        }
        
        .welcome-message {
            background: var(--white);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-light);
            border-left: 5px solid var(--primary-color);
        }
        
        .welcome-message h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.8rem;
        }
        
        .welcome-message p {
            color: var(--text-light);
            font-size: 1.1rem;
            line-height: 1.8;
        }
        
        .welcome-message span {
            color: var(--accent-color);
            font-weight: 600;
        }
        
        .footer {
            background: var(--white);
            color: var(--text-dark);
            text-align: center;
            padding: 15px;
            border-radius: 15px;
            margin: 20px;
            box-shadow: var(--shadow-light);
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .container {
                flex-direction: column;
            }
            
            .navbar {
                margin-bottom: 0;
            }
            
            .navbar nav ul {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .navbar button {
                width: auto;
            }
            
            .logo {
                padding: 10px 0;
                margin-bottom: 10px;
            }
        }
        
        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.8rem;
            }
            
            .content-wrapper {
                grid-template-columns: 1fr;
            }
            
            .navbar nav ul {
                justify-content: space-between;
            }
            
            .navbar a {
                padding: 10px;
            }
            
            .navbar a i {
                margin-right: 5px;
                font-size: 1.2rem;
            }
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .header, .welcome-message, .card {
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .card:nth-child(2) {
            animation-delay: 0.2s;
        }
        
        .card:nth-child(3) {
            animation-delay: 0.4s;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
        </style>
    </head>
    <body>
       <div class="container">
            <div class="navbar">
                <div class="logo">
                    <h2>MCA <span>Portal</span></h2>
                </div>
                <nav>
                    <ul>
                        <button>
                            <a href="uhome.php" class="active-link">
                                <i class='bx bxs-home'></i> Home
                            </a>
                        </button>
                        <button>
                            <a href="view_announcement.php">
                                <i class='bx bxs-megaphone'></i> Announcements
                            </a>
                        </button>
                        <button>
                            <a href="contest.php">
                                <i class='bx bxs-trophy'></i> Contests
                            </a>
                        </button>
                        <button>
                            <a href="odapply.php">
                                <i class='bx bxs-calendar-check'></i> OD Apply
                            </a>
                        </button>
                        <button>
                            <a href="view_payment.php">
                                <i class='bx bxs-wallet'></i> Payments
                            </a>
                        </button>
                        <button>
                            <a href="suggestion.php">
                                <i class='bx bxs-message-rounded-dots'></i> Suggestions
                            </a>
                        </button>
                    </ul>
                </nav>
            </div>
            
            <div class="main-content">
                <div class="header">
                    <h1>Welcome to Student Portal</h1>
                    <p>Access all your academic resources, announcements, and services in one place</p>
                </div>
                
                <div class="welcome-message">
                    <h2>Hello, <?php echo $_SESSION["NAME"]; ?>!</h2>
                    <p>Dear <?php echo $_SESSION["NAME"]; ?>, you can use the digital data for your gathering informations and you can also utilize
                       main features given in the page like<span> will you select given options to explore the digital data hub </span>and many 
                       more things you can access.
                    </p>
                </div>
                
                <div class="content-wrapper">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class='bx bxs-megaphone'></i>
                            </div>
                            <h3>Announcements</h3>
                        </div>
                        <div class="stat">
                            <?php 
                                // Count announcements if table exists
                                if(isset($db)) {
                                    try {
                                        echo countRecord("SELECT * FROM announcements", $db);
                                    } catch (Exception $e) {
                                        echo "0";
                                    }
                                } else {
                                    echo "0";
                                }
                            ?>
                        </div>
                        <p>Stay updated with the latest announcements from your department</p>
                        <a href="view_announcement.php" class="card-action">View All</a>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class='bx bxs-trophy'></i>
                            </div>
                            <h3>Contests</h3>
                        </div>
                        <div class="stat">
                            <?php 
                                // Count contests if table exists
                                if(isset($db)) {
                                    try {
                                        echo countRecord("SELECT * FROM contests", $db);
                                    } catch (Exception $e) {
                                        echo "0";
                                    }
                                } else {
                                    echo "0";
                                }
                            ?>
                        </div>
                        <p>Participate in various contests and showcase your skills</p>
                        <a href="contest.php" class="card-action">Explore</a>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class='bx bxs-calendar-check'></i>
                            </div>
                            <h3>Pending OD</h3>
                        </div>
                        <div class="stat">
                            <?php 
                                // Count OD applications if table exists
                                if(isset($db) && isset($_SESSION["ID"])) {
                                    try {
                                        echo countRecord("SELECT * FROM od_applications WHERE student_id=".$_SESSION["ID"]." AND status='pending'", $db);
                                    } catch (Exception $e) {
                                        echo "0";
                                    }
                                } else {
                                    echo "0";
                                }
                            ?>
                        </div>
                        <p>Check your On-Duty application status</p>
                        <a href="odapply.php" class="card-action">Apply Now</a>
                    </div>
                </div>
            </div>
       </div>
       
       <div class="footer">
            <p>Copyright &copy; MCA Portal 2025</p>
       </div>
       
       <script>
           // Add active class to current page link
           document.addEventListener('DOMContentLoaded', function() {
               const currentLocation = location.href;
               const navLinks = document.querySelectorAll('.navbar a');
               
               navLinks.forEach(link => {
                   if(link.href === currentLocation) {
                       link.classList.add('active-link');
                   } else {
                       link.classList.remove('active-link');
                   }
               });
               
               // Add hover effect animation
               const buttons = document.querySelectorAll('.navbar button');
               buttons.forEach(button => {
                   button.addEventListener('mouseover', function() {
                       this.style.transform = 'translateY(-3px)';
                   });
                   
                   button.addEventListener('mouseout', function() {
                       this.style.transform = 'translateY(0)';
                   });
               });
           });
       </script>
    </body>
</html>
