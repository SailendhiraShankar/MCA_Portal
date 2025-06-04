<?php
    session_start();
    include"database.php";
    function countRecord($sql,$db)
    {
        $res=$db->query($sql);
        return $res->num_rows;
    }
    if(!isset($_SESSION["ID"]))
    {
	    header("location:slogin.php");
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>MCA Portal</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            :root {
                --primary-color: #7494ec;
                --primary-light: rgba(116, 148, 236, 0.1);
                --primary-dark: #5a7ad6;
                --accent-color: #ff6b6b;
                --text-dark: #333;
                --text-light: #777;
                --white: #ffffff;
                --bg-light: #f5f7fb;
                --transition-speed: 0.3s;
                --shadow-light: 0 5px 15px rgba(0, 0, 0, 0.05);
                --blue-gradient: linear-gradient(135deg, #6384e4, #7494ec);
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
            }

            body {
                background: var(--bg-light);
                color: var(--text-dark);
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            /* Layout Structure */
            .container {
                display: flex;
                min-height: 100vh;
            }

            /* Sidebar Styles */
            .sidebar {
                width: 250px;
                background: var(--white);
                box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
                display: flex;
                flex-direction: column;
                position: fixed;
                left: 0;
                top: 0;
                height: 100%;
                z-index: 100;
            }

            /* Portal Header */
            .portal-header {
                background: var(--blue-gradient);
                color: var(--white);
                padding: 20px 15px;
                text-align: center;
                font-size: 22px;
                font-weight: 600;
                letter-spacing: 0.5px;
            }

            /* Navigation Menu */
            .navbar {
                flex: 1;
                padding: 20px 15px;
                overflow-y: auto;
            }

            .navbar nav ul {
                list-style: none;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .navbar nav ul button {
                background: none;
                border: none;
                padding: 0;
                width: 100%;
                border-radius: 8px;
                overflow: hidden;
                transition: all var(--transition-speed) ease;
                background: #f9f9f9;
            }

            .navbar nav ul button a {
                display: flex;
                align-items: center;
                padding: 14px 16px;
                color: #444;
                text-decoration: none;
                font-weight: 500;
                font-size: 15px;
                transition: all var(--transition-speed) ease;
                position: relative;
            }

            .navbar nav ul button a::before {
                content: '';
                font-family: 'boxicons';
                margin-right: 10px;
                font-size: 18px;
                color: var(--primary-color);
            }

            .navbar nav ul button:nth-child(1) a::before {
                content: '\ef71'; /* Suggestion icon */
            }

            .navbar nav ul button:nth-child(2) a::before {
                content: '\ed33'; /* Announcement icon */
            }

            .navbar nav ul button:nth-child(3) a::before {
                content: '\eaed'; /* Document/Form icon */
            }

            .navbar nav ul button:nth-child(4) a::before {
                content: '\ef29'; /* Payment icon */
            }

            .navbar nav ul button:nth-child(5) a::before {
                content: '\eb2d'; /* Home icon */
            }

            .navbar nav ul button:hover {
                transform: translateX(5px);
            }

            .navbar nav ul button.active {
                background: #f0f3fa;
                position: relative;
            }

            .navbar nav ul button.active::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                width: 4px;
                background: var(--primary-color);
                border-radius: 0 2px 2px 0;
            }

            .navbar nav ul button.active a {
                color: var(--primary-color);
            }

            .navbar nav ul button:last-child a {
                color: var(--primary-color);
            }

            /* Main Content Area */
            .main {
                margin-left: 250px;
                padding: 30px;
                flex: 1;
                width: calc(100% - 250px);
                display: flex;
                flex-direction: column;
            }

            /* Header Section */
            .wrapper {
                background: var(--blue-gradient);
                color: var(--white);
                padding: 25px;
                text-align: center;
                border-radius: 15px;
                box-shadow: 0 4px 15px rgba(116, 148, 236, 0.2);
                margin-bottom: 30px;
                position: relative;
                overflow: hidden;
            }

            .wrapper::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -10%;
                width: 120%;
                height: 200%;
                background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
                background-size: cover;
                z-index: 0;
                opacity: 0.1;
                transform: rotate(-5deg);
            }

            .wrapper h1 {
                font-size: 32px;
                font-weight: 600;
                position: relative;
                z-index: 1;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            /* Weather Widget */
            .weather-widget {
                background: linear-gradient(135deg, #74b9ff, #0984e3);
                border-radius: 15px;
                padding: 25px;
                color: var(--white);
                margin-bottom: 30px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                box-shadow: 0 5px 15px rgba(9, 132, 227, 0.3);
            }

            .weather-info {
                display: flex;
                align-items: center;
            }

            .weather-icon {
                font-size: 48px;
                margin-right: 20px;
            }

            .weather-details h3 {
                font-size: 24px;
                margin-bottom: 5px;
            }

            .weather-details p {
                font-size: 16px;
                opacity: 0.9;
            }

            .weather-temp {
                font-size: 42px;
                font-weight: 700;
            }

            /* Content Section */
            .content {
                background: var(--white);
                padding: 35px;
                border-radius: 15px;
                box-shadow: var(--shadow-light);
                flex: 1;
                position: relative;
                overflow: hidden;
                animation: fadeIn 0.5s ease-out forwards;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(15px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .content::after {
                content: '';
                position: absolute;
                bottom: 0;
                right: 0;
                width: 150px;
                height: 150px;
                background: var(--primary-light);
                border-radius: 50%;
                transform: translate(50%, 50%);
                z-index: 0;
            }

            .content h2 {
                color: var(--primary-color);
                margin-bottom: 25px;
                font-size: 28px;
                font-weight: 600;
                position: relative;
                display: inline-block;
                z-index: 1;
            }

            .content h2::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 0;
                width: 60px;
                height: 4px;
                background: var(--primary-color);
                border-radius: 3px;
            }

            .content p {
                margin-bottom: 18px;
                line-height: 1.7;
                color: var(--text-dark);
                position: relative;
                z-index: 1;
            }

            .content span {
                color: var(--primary-color);
                font-weight: 500;
            }

            /* Footer */
            .footer {
                text-align: center;
                padding: 20px;
                background: rgba(0, 0, 0, 0.03);
                color: var(--text-light);
                font-size: 14px;
                margin-top: 30px;
                border-radius: 15px;
            }

            /* Mobile Menu Toggle Button */
            .menu-toggle {
                display: none;
                position: fixed;
                top: 15px;
                left: 15px;
                width: 40px;
                height: 40px;
                background: var(--primary-color);
                border-radius: 50%;
                color: var(--white);
                text-align: center;
                line-height: 40px;
                font-size: 20px;
                z-index: 101;
                cursor: pointer;
                box-shadow: 0 3px 10px rgba(116, 148, 236, 0.4);
            }

            /* Responsive Styles */
            @media screen and (max-width: 992px) {
                .sidebar {
                    width: 220px;
                }
                
                .main {
                    margin-left: 220px;
                    width: calc(100% - 220px);
                    padding: 25px;
                }
                
                .wrapper h1 {
                    font-size: 28px;
                }
                
                .content h2 {
                    font-size: 24px;
                }
            }

            @media screen and (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                    transition: transform var(--transition-speed) ease;
                }
                
                .sidebar.active {
                    transform: translateX(0);
                }
                
                .main {
                    margin-left: 0;
                    width: 100%;
                    padding: 20px;
                }
                
                .menu-toggle {
                    display: block;
                }
                
                .wrapper {
                    margin-top: 20px;
                }
                
                .weather-widget {
                    flex-direction: column;
                    text-align: center;
                }
                
                .weather-info {
                    margin-bottom: 15px;
                    justify-content: center;
                }
            }

            @media screen and (max-width: 576px) {
                .wrapper {
                    padding: 20px;
                }
                
                .wrapper h1 {
                    font-size: 24px;
                }
                
                .content {
                    padding: 25px;
                }
                
                .content h2 {
                    font-size: 22px;
                }
            }

            /* Animation for menu items */
            @keyframes fadeInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
            
            .navbar nav ul button {
                animation: fadeInLeft 0.5s ease forwards;
                opacity: 0;
            }
            
            .navbar nav ul button:nth-child(1) { animation-delay: 0.1s; }
            .navbar nav ul button:nth-child(2) { animation-delay: 0.2s; }
            .navbar nav ul button:nth-child(3) { animation-delay: 0.3s; }
            .navbar nav ul button:nth-child(4) { animation-delay: 0.4s; }
            .navbar nav ul button:nth-child(5) { animation-delay: 0.5s; }
            
            /* Float animation for weather widget */
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
                100% { transform: translateY(0px); }
            }
            
            .weather-widget {
                animation: float 3s ease-in-out infinite;
            }
        </style>
    </head>
    <body>
        <!-- Mobile Menu Toggle Button -->
        <div class="menu-toggle">
            <i class='bx bx-menu'></i>
        </div>
        
        <div class="container">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Portal Header -->
                <div class="portal-header">
                    MCA Portal
                </div>
                
                <!-- Navigation Menu -->
                <div class="navbar">
                    <nav>
                        <ul>
                            <button class="<?php echo basename($_SERVER['PHP_SELF']) == 'suggestion.php' ? 'active' : ''; ?>">
                                <a href="suggestion.php">Suggestion</a>
                            </button>
                            <button class="<?php echo basename($_SERVER['PHP_SELF']) == 'announcement.php' ? 'active' : ''; ?>">
                                <a href="announcement.php">Announcement</a>
                            </button>
                            <button class="<?php echo basename($_SERVER['PHP_SELF']) == 'viewod.php' ? 'active' : ''; ?>">
                                <a href="viewod.php">View OD Form</a>
                            </button>
                            <button class="<?php echo basename($_SERVER['PHP_SELF']) == 'payment_announcement.php' ? 'active' : ''; ?>">
                                <a href="payment_announcement.php">Payment Info</a>
                            </button>
                            <button class="<?php echo basename($_SERVER['PHP_SELF']) == 'shome.php' ? 'active' : ''; ?>">
                                <a href="shome.php">Home</a>
                            </button>
                        </ul>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="main">
                <!-- Header Section -->
                <div class="wrapper">
                    <h1>Staff Portal</h1>
                </div>
                
                <!-- Weather Widget -->
                <div class="weather-widget">
                    <div class="weather-info">
                        <div class="weather-icon">
                            <i class='bx bx-sun'></i>
                        </div>
                        <div class="weather-details">
                            <h3>Today's Weather</h3>
                            <p>Sunny, Clear Sky • <?php echo date('l, F j'); ?></p>
                        </div>
                    </div>
                    <div class="weather-temp">28°C</div>
                </div>
                
                <!-- Content Section -->
                <div class="content">
                    <h2>Hi <?php echo $_SESSION["NAME"]; ?></h2>
                    <p>Dear <?php echo $_SESSION["NAME"]; ?>, you can use the digital data for your gathering informations and you can also utilize
                       main features given in the page like <span>will you select given options to explore the digital data hub</span> and many 
                       more things you can access.
                    </p>
                </div>
                
                <!-- Footer -->
                <div class="footer">
                    <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?></p>
                </div>
            </div>
        </div>
        
        <script>
            // Mobile sidebar toggle
            document.querySelector('.menu-toggle').addEventListener('click', function() {
                document.querySelector('.sidebar').classList.toggle('active');
                
                // Change icon based on sidebar state
                const icon = this.querySelector('i');
                if (icon.classList.contains('bx-menu')) {
                    icon.classList.remove('bx-menu');
                    icon.classList.add('bx-x');
                } else {
                    icon.classList.remove('bx-x');
                    icon.classList.add('bx-menu');
                }
            });
            
            // Close sidebar when clicking outside (mobile)
            document.addEventListener('click', function(event) {
                const sidebar = document.querySelector('.sidebar');
                const menuToggle = document.querySelector('.menu-toggle');
                
                if (!sidebar.contains(event.target) && 
                    !menuToggle.contains(event.target) && 
                    sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    
                    const icon = menuToggle.querySelector('i');
                    icon.classList.remove('bx-x');
                    icon.classList.add('bx-menu');
                }
            });
        </script>
    </body>
</html>
