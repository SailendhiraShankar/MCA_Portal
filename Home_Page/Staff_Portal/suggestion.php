<?php
    session_start();
    include"database.php";
    if(!isset($_SESSION["ID"]))
    {
	    header("location:slogin.php");
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>MCA Portal - View Suggestions</title>
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
            .page-header {
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

            .page-header::before {
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

            .page-header h1 {
                font-size: 28px;
                font-weight: 600;
                position: relative;
                z-index: 1;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            /* Content Section */
            .content {
                background: var(--white);
                padding: 30px;
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

            /* Suggestion Styles */
            .content p {
                background: var(--white);
                border-radius: 12px;
                padding: 20px;
                margin-bottom: 20px;
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
                position: relative;
                z-index: 1;
                transition: all var(--transition-speed) ease;
                border-left: 4px solid var(--primary-color);
            }

            .content p:hover {
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .content p strong {
                display: block;
                color: var(--primary-color);
                font-size: 18px;
                margin-bottom: 10px;
            }

            .content p ui {
                display: block;
                margin: 10px 0;
                line-height: 1.6;
                color: var(--text-dark);
                font-size: 15px;
            }

            .content p i {
                display: block;
                color: var(--text-light);
                font-size: 13px;
                margin-top: 10px;
                font-style: italic;
            }

            .content p button {
                background: var(--primary-light);
                color: var(--primary-color);
                border: none;
                padding: 8px 15px;
                border-radius: 20px;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
                transition: all var(--transition-speed) ease;
                display: inline-flex;
                align-items: center;
                gap: 5px;
                margin-top: 10px;
            }

            .content p button:hover {
                background: var(--primary-color);
                color: var(--white);
            }

            .content p button::before {
                content: '\ef11';
                font-family: 'boxicons';
                font-size: 16px;
            }

            /* Error Message */
            .error {
                background: rgba(255, 71, 87, 0.1);
                color: var(--error-color);
                padding: 20px;
                border-radius: 8px;
                margin: 20px 0;
                text-align: center;
                font-weight: 500;
                border-left: 4px solid var(--error-color);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                position: relative;
                z-index: 1;
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
                margin-left: 250px;
                width: calc(100% - 280px);
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
                
                .footer {
                    margin-left: 220px;
                    width: calc(100% - 250px);
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
                
                .footer {
                    margin-left: 0;
                    width: calc(100% - 40px);
                    margin: 30px 20px 20px 20px;
                }
                
                .menu-toggle {
                    display: block;
                }
                
                .page-header {
                    margin-top: 20px;
                }
                
                .content {
                    padding: 20px;
                }
            }

            @media screen and (max-width: 576px) {
                .page-header {
                    padding: 20px;
                }
                
                .page-header h1 {
                    font-size: 24px;
                }
                
                .content {
                    padding: 15px;
                }
                
                .content p {
                    padding: 15px;
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
            
            /* Animation for suggestions */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .content p {
                animation: fadeInUp 0.5s ease-out forwards;
                opacity: 0;
            }
            
            .content p:nth-child(1) { animation-delay: 0.1s; }
            .content p:nth-child(2) { animation-delay: 0.2s; }
            .content p:nth-child(3) { animation-delay: 0.3s; }
            .content p:nth-child(4) { animation-delay: 0.4s; }
            .content p:nth-child(5) { animation-delay: 0.5s; }
            .content p:nth-child(6) { animation-delay: 0.6s; }
            .content p:nth-child(7) { animation-delay: 0.7s; }
            .content p:nth-child(8) { animation-delay: 0.8s; }
            .content p:nth-child(9) { animation-delay: 0.9s; }
            .content p:nth-child(10) { animation-delay: 1.0s; }
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
                            <button class="active">
                                <a href="suggestion.php">Suggestion</a>
                            </button>
                            <button>
                                <a href="announcement.php">Announcement</a>
                            </button>
                            <button>
                                <a href="viewod.php">View OD Form</a>
                            </button>
                            <button>
                                <a href="payment_announcement.php">Payment Info</a>
                            </button>
                            <button>
                                <a href="shome.php">Home</a>
                            </button>
                        </ul>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="main">
                <!-- Header Section -->
                <div class="page-header">
                    <h1>View Students Suggestions</h1>
                </div>
                
                <!-- Content Section -->
                <div class="content">
                    <?php
                        $sql="SELECT user.UNAME,comment.COMM,comment.LOGS,comment.CID FROM comment INNER JOIN user on comment.UID=user.UID ORDER BY comment.CID DESC";
                        $res=$db->query($sql);
                        if($res->num_rows>0)
                        {
                            while($row=$res->fetch_assoc())
                            {
                                $cid = $row["CID"];
                                $lsql = "SELECT COUNT(*) as lc FROM `like` WHERE CID = $cid";
                                $lr = $db->query($lsql);
                                $lrow = $lr->fetch_assoc();
                                $lc = $lrow['lc'];
                                echo"<p>
                                        <strong>{$row["UNAME"]}</strong>
                                        <ui>{$row["COMM"]}</ui>
                                        <i>{$row["LOGS"]}</i>
                                        <button>Like-{$lc}</button>
                                      </form>
                                </p>";
                            }
                        }
                        else
                        {
                            echo"<p class='error'><i class='bx bx-message-x'></i> No Comment Yet...</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?></p>
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
