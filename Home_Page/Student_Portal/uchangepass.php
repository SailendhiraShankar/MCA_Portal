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
        <title>MCA Portal - Change Password</title>
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
                max-width: 500px;
                margin: 0 auto;
                width: 100%;
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

            /* Form Styles */
            form {
                position: relative;
                z-index: 1;
            }

            form h3 {
                color: var(--primary-dark);
                font-size: 1.8rem;
                margin-bottom: 25px;
                text-align: center;
                position: relative;
                padding-bottom: 10px;
            }

            form h3::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 100px;
                height: 3px;
                background: var(--primary-color);
                border-radius: 10px;
            }

            form label {
                display: block;
                margin: 15px 0 8px;
                color: var(--text-dark);
                font-weight: 500;
            }

            form input[type="password"] {
                width: 100%;
                padding: 12px 15px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background: var(--white);
                color: var(--text-dark);
                font-size: 1rem;
                transition: all var(--transition-speed);
            }

            form input[type="password"]:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 2px var(--primary-light);
                outline: none;
            }

            form button[type="submit"] {
                background: var(--primary-color);
                color: white;
                border: none;
                padding: 12px 20px;
                border-radius: 8px;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                margin-top: 25px;
                width: 100%;
                transition: all var(--transition-speed);
            }

            form button[type="submit"]:hover {
                background: var(--primary-dark);
                transform: translateY(-3px);
                box-shadow: var(--shadow-light);
            }

            .form-links {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 20px;
            }

            form a {
                display: inline-block;
                margin: 10px 15px;
                color: var(--primary-color);
                text-decoration: none;
                font-weight: 500;
                transition: all var(--transition-speed);
                display: flex;
                align-items: center;
            }

            form a i {
                margin-right: 5px;
            }

            form a:hover {
                color: var(--primary-dark);
                transform: translateY(-2px);
            }

            .success {
                background: var(--success-color);
                color: white;
                padding: 15px;
                border-radius: 8px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 500;
                animation: fadeIn 0.5s ease-out forwards;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .success i, .error i {
                margin-right: 8px;
                font-size: 18px;
            }

            .error {
                background: var(--error-color);
                color: white;
                padding: 15px;
                border-radius: 8px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 500;
                animation: fadeIn 0.5s ease-out forwards;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Password strength indicator */
            .password-strength {
                height: 5px;
                margin-top: 8px;
                border-radius: 5px;
                transition: all var(--transition-speed);
            }

            .weak {
                background: var(--error-color);
                width: 30%;
            }

            .medium {
                background: #ffa64d;
                width: 60%;
            }

            .strong {
                background: var(--success-color);
                width: 100%;
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
                            <button>
                                <a href="mhome.php">Student Portal</a>
                            </button>
                            <button class="active">
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
            
            <div class="main-content">
                <div class="welcome-header">
                    <h1>Account Security</h1>
                </div>
                
                <div class="content-section">
                    <?php
                        if(isset($_POST["submit"]))
                        {
                            try {
                                $sql="SELECT * from user WHERE UPASS='{$_POST["opass"]}' and UID='{$_SESSION["ID"]}'";
                                $res=$db->query($sql);
                                if($res->num_rows>0)
                                {
                                    $s="update user set UPASS='{$_POST["npass"]}' WHERE UID=".$_SESSION["ID"];
                                    $db->query($s);
                                    echo"<p class='success'><i class='bx bxs-check-circle'></i> Password Changed Successfully</p>";
                                }
                                else
                                {
                                    echo"<p class='error'><i class='bx bxs-error'></i> Invalid Password</p>";
                                }
                            } catch (Exception $e) {
                                echo"<p class='error'><i class='bx bxs-error'></i> An error occurred. Please try again.</p>";
                            }
                        }   
                    ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                        <h3 class="heading">Change Password</h3>
                        <label>Old Password:</label>
                        <input type="password" name="opass" id="oldPassword" required>
                        
                        <label>New Password:</label>
                        <input type="password" name="npass" id="newPassword" required>
                        <div class="password-strength" id="passwordStrength"></div>
                        
                        <button type="submit" name="submit">Update Password</button>
                        
                        <div class="form-links">
                            <a href="fp.php"><i class='bx bx-help-circle'></i> Forgot Password?</a>
                            <a href="mhome.php"><i class='bx bx-home'></i> Home</a>
                            <a href="uchangepass.php"><i class='bx bx-refresh'></i> Refresh</a>
                        </div>
                    </form>
                </div>        
            </div>
        </div>
        
        <div class="footer">
            <p>Copyright &copy; MCA Portal 2025</p>
        </div>
       
        <script>
            // Mobile menu toggle
            document.querySelector('.menu-toggle').addEventListener('click', function() {
                document.querySelector('.sidebar').classList.toggle('active');
            });
            
            // Password strength indicator
            const newPasswordInput = document.getElementById('newPassword');
            const passwordStrength = document.getElementById('passwordStrength');
            
            newPasswordInput.addEventListener('input', function() {
                const password = this.value;
                
                if (password.length === 0) {
                    passwordStrength.className = 'password-strength';
                    passwordStrength.style.width = '0';
                } else if (password.length < 6) {
                    passwordStrength.className = 'password-strength weak';
                } else if (password.length < 10) {
                    passwordStrength.className = 'password-strength medium';
                } else {
                    passwordStrength.className = 'password-strength strong';
                }
            });
        </script>
    </body>
</html>
