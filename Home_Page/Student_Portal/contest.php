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
            width: 250px;
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
        
        .content {
            background: var(--white);
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--shadow-light);
            margin-bottom: 30px;
            flex: 1;
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .contest-card {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow-light);
            border-left: 5px solid var(--accent-color);
            margin: 20px 0;
            transition: all var(--transition-speed);
        }
        
        .contest-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-dark);
        }
        
        .welcome-text {
            font-size: 1.2rem;
            color: var(--text-dark);
            margin-bottom: 25px;
            line-height: 1.8;
        }
        
        .contest-link {
            display: block;
            background: var(--primary-light);
            padding: 20px;
            border-radius: 10px;
            margin: 30px 0;
            text-align: center;
            border-left: 5px solid var(--primary-color);
            transition: all var(--transition-speed);
        }
        
        .contest-link:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: var(--shadow-dark);
        }
        
        .contest-link a {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-speed);
        }
        
        .contest-link:hover a {
            color: var(--white);
        }
        
        .contest-link i {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        .good-luck {
            font-size: 1.5rem;
            color: var(--accent-color);
            text-align: center;
            margin-top: 30px;
            font-weight: 600;
        }
        
        .footer {
            background: var(--white);
            color: var(--text-dark);
            text-align: center;
            padding: 15px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 15px;
            margin: 0 20px 20px 20px;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .container {
                flex-direction: column;
            }
            
            .navbar {
                width: auto;
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
            
            .main-content {
                min-height: auto;
            }
        }
        
        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.8rem;
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
            
            .welcome-text {
                font-size: 1.1rem;
            }
            
            .contest-link a {
                font-size: 1.1rem;
            }
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
                            <a href="uhome.php">
                                <i class='bx bxs-home'></i> Home
                            </a>
                        </button>
                        <button>
                            <a href="view_announcement.php">
                                <i class='bx bxs-megaphone'></i> Announcements
                            </a>
                        </button>
                        <button>
                            <a href="contest.php" class="active-link">
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
                    <h1>Coding Contest</h1>
                </div>
                
                <div class="content">
                    <div class="contest-card">
                        <p class="welcome-text">Dear <?php echo $_SESSION["NAME"]; ?>, are you willing to participate in this contest? Click the link below to start your coding challenge!</p>
                        
                        <div class="contest-link pulse">
                            <a href="https://www.hackerrank.com/mca-portal" target="_blank">
                                <i class='bx bx-code-alt'></i> Click here to start the contest
                            </a>
                        </div>
                        
                        <p class="good-luck">All The Best!</p>
                    </div>
                </div>
                
                <div class="footer">
                    <p>Copyright &copy; MCA Portal 2025</p>
                </div>
            </div>
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
