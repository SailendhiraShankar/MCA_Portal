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
	    header("location:ulogin.php");
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>MCA Portal - Student Home</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            :root {
                --primary-color: #7494ec;
                --primary-light: rgba(116, 148, 236, 0.1);
                --primary-dark: #5a7ad6;
                --accent-color: #ff6b6b;
                --success-color: #2ed573;
                --error-color: #ff4757;
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
                content: '\eb25'; /* Store Documents icon */
            }

            .navbar nav ul button:nth-child(2) a::before {
                content: '\eb7b'; /* View Documents icon */
            }

            .navbar nav ul button:nth-child(3) a::before {
                content: '\eb2d'; /* Student Portal icon */
            }

            .navbar nav ul button:nth-child(4) a::before {
                content: '\eb8c'; /* Change Password icon */
            }

            .navbar nav ul button:nth-child(5) a::before {
                content: '\ebec'; /* Logout icon */
                color: var(--accent-color);
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
                color: var(--accent-color);
            }

            /* User Profile Section */
            .user-profile {
                padding: 15px;
                border-top: 1px solid #eee;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .user-avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: var(--primary-light);
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                color: var(--primary-color);
                font-size: 16px;
            }

            .user-info {
                flex: 1;
                overflow: hidden;
            }

            .user-name {
                font-weight: 600;
                font-size: 14px;
                color: var(--text-dark);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .user-role {
                font-size: 12px;
                color: var(--text-light);
            }

            /* Main Content Area */
            .main-content {
                margin-left: 250px;
                padding: 30px;
                flex: 1;
                width: calc(100% - 250px);
                display: flex;
                flex-direction: column;
            }

            /* Welcome Header */
            .welcome-header {
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

            .welcome-header::before {
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

            .welcome-header h1 {
                font-size: 28px;
                font-weight: 600;
                position: relative;
                z-index: 1;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            /* Content Section */
            .content-section {
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

            .content-section::after {
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

            .content-section h2 {
                color: var(--primary-color);
                margin-bottom: 15px;
                font-size: 24px;
                font-weight: 600;
            }

            .content-section p {
                margin-bottom: 15px;
                line-height: 1.6;
                color: var(--text-dark);
                position: relative;
                z-index: 1;
            }

            .content-section b {
                color: var(--primary-dark);
                font-weight: 600;
            }

            /* Feature List */
            .feature-list {
                list-style: none;
                margin: 15px 0;
                position: relative;
                z-index: 1;
            }

            .feature-list li {
                padding: 10px 0 10px 30px;
                position: relative;
                transition: all var(--transition-speed) ease;
            }

            .feature-list li::before {
                content: '\eb7e';
                font-family: 'boxicons';
                position: absolute;
                left: 0;
                top: 50%;
                transform: translateY(-50%);
                color: var(--primary-color);
                font-size: 18px;
            }

            .feature-list li:hover {
                transform: translateX(5px);
                color: var(--primary-color);
            }

            /* Feature Cards */
            .feature-cards {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
                margin-top: 30px;
                position: relative;
                z-index: 1;
            }

            .feature-card {
                background: var(--white);
                border-radius: 12px;
                padding: 20px;
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
                transition: all var(--transition-speed) ease;
                border-left: 4px solid var(--primary-color);
            }

            .feature-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            }

            .feature-card h3 {
                display: flex;
                align-items: center;
                gap: 10px;
                color: var(--primary-color);
                margin-bottom: 10px;
                font-size: 18px;
            }

            .feature-card h3::before {
                font-family: 'boxicons';
                font-size: 22px;
            }

            .feature-card:nth-child(1) h3::before {
                content: '\eb25'; /* Store Documents icon */
            }

            .feature-card:nth-child(2) h3::before {
                content: '\eb7b'; /* View Documents icon */
            }

            .feature-card:nth-child(3) h3::before {
                content: '\eb2d'; /* Datahub icon */
            }

            .feature-card p {
                color: var(--text-light);
                font-size: 14px;
                line-height: 1.5;
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
                
                .main-content {
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
                
                .main-content {
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
                
                .feature-cards {
                    grid-template-columns: 1fr;
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
                            <button>
                                <a href="upload_documents.php">Store Documents</a>
                            </button>
                            <button>
                                <a href="view_documents.php">View Documents</a>
                            </button>
                            <button class="active">
                                <a href="mhome.php">Student Portal</a>
                            </button>
                            <button>
                                <a href="uchangepass.php">Change Password</a>
                            </button>
                            <button>
                                <a href="logout.php">Logout</a>
                            </button>
                        </ul>
                    </nav>
                </div>
                
                <!-- User Profile Section -->
                <div class="user-profile">
                    <div class="user-avatar">
                        <?php echo substr($_SESSION["NAME"], 0, 1); ?>
                    </div>
                    <div class="user-info">
                        <div class="user-name"><?php echo $_SESSION["NAME"]; ?></div>
                        <div class="user-role">Student</div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="main-content">
                <!-- Welcome Header -->
                <div class="welcome-header">
                    <h1>Welcome <?php echo $_SESSION["NAME"]; ?></h1>
                </div>
                
                <!-- Content Section -->
                <div class="content-section">
                    <h2>Dear <?php echo $_SESSION["NAME"]; ?>,</h2>
                    <p>You can access most interesting things in this site like:</p>
                    
                    <ul class="feature-list">
                        <li>Store Documents</li>
                        <li>View Documents</li>
                        <li>Datahub</li>
                    </ul>
                    
                    <div class="feature-cards">
                        <div class="feature-card">
                            <h3>Store Documents</h3>
                            <p>By using this function you can store your files by uploading in the store documents section. Keep all your important files in one secure place.</p>
                        </div>
                        
                        <div class="feature-card">
                            <h3>View Documents</h3>
                            <p>Your uploaded documents are viewable using this page and you can upload, view and delete files as needed for easy management.</p>
                        </div>
                        
                        <div class="feature-card">
                            <h3>Datahub</h3>
                            <p>In datahub you can access many resources that are useful for improving your knowledge and academic performance.</p>
                        </div>
                    </div>
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
