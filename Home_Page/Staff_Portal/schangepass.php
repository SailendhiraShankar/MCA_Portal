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

            /* Main Content Area */
            .main-content {
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

            /* Center Content */
            .center {
                background: var(--white);
                padding: 35px;
                border-radius: 15px;
                box-shadow: var(--shadow-light);
                flex: 1;
                position: relative;
                overflow: hidden;
                animation: fadeIn 0.5s ease-out forwards;
                max-width: 600px;
                margin: 0 auto;
                width: 100%;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(15px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .center::after {
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
                margin-bottom: 20px;
            }

            .heading {
                color: var(--primary-color);
                margin-bottom: 25px;
                font-size: 28px;
                font-weight: 600;
                position: relative;
                display: inline-block;
                text-align: center;
                width: 100%;
            }

            .heading::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 50%;
                transform: translateX(-50%);
                width: 60px;
                height: 4px;
                background: var(--primary-color);
                border-radius: 3px;
            }

            form label {
                display: block;
                margin-bottom: 8px;
                font-weight: 500;
                color: var(--text-dark);
            }

            /* Common styles for both password and text inputs */
            .password-input {
                width: 100%;
                padding: 14px 15px;
                margin-bottom: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background: #f9f9f9;
                transition: all var(--transition-speed) ease;
                font-size: 15px;
            }

            .password-input:focus {
                border-color: var(--primary-color);
                background: var(--white);
                box-shadow: 0 0 0 3px var(--primary-light);
                outline: none;
            }

            .password-field {
                position: relative;
            }

            .toggle-password {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                color: var(--text-light);
                z-index: 2;
                font-size: 18px;
            }

            form button {
                background: var(--primary-color);
                color: var(--white);
                border: none;
                padding: 12px 25px;
                border-radius: 8px;
                font-weight: 500;
                font-size: 16px;
                cursor: pointer;
                transition: all var(--transition-speed) ease;
                margin-right: 10px;
                margin-bottom: 15px;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }

            form button:hover {
                background: var(--primary-dark);
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(116, 148, 236, 0.3);
            }

            form button::before {
                content: '\eb8c';
                font-family: 'boxicons';
                font-size: 18px;
            }

            form a {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: var(--bg-light);
                color: var(--text-dark);
                text-decoration: none;
                padding: 12px 20px;
                border-radius: 8px;
                font-weight: 500;
                font-size: 15px;
                transition: all var(--transition-speed) ease;
                margin-right: 10px;
                margin-bottom: 10px;
            }

            form a:hover {
                background: #e9ecf3;
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            }

            form a:first-of-type::before {
                content: '\ef0e';
                font-family: 'boxicons';
                font-size: 18px;
                color: var(--accent-color);
            }

            form a:nth-of-type(2)::before {
                content: '\eb2d';
                font-family: 'boxicons';
                font-size: 18px;
                color: var(--primary-color);
            }

            form a:last-of-type::before {
                content: '\eb96';
                font-family: 'boxicons';
                font-size: 18px;
                color: var(--primary-color);
            }

            /* Success and Error Messages */
            .success {
                background: rgba(46, 213, 115, 0.1);
                color: var(--success-color);
                padding: 15px;
                border-radius: 8px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 500;
                border-left: 4px solid var(--success-color);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                position: relative;
                z-index: 1;
            }

            .success::before {
                content: '\ec34';
                font-family: 'boxicons';
                font-size: 20px;
            }

            .error {
                background: rgba(255, 71, 87, 0.1);
                color: var(--error-color);
                padding: 15px;
                border-radius: 8px;
                margin-bottom: 20px;
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

            .error::before {
                content: '\ec80';
                font-family: 'boxicons';
                font-size: 20px;
            }

            /* Password Strength Meter */
            .password-strength {
                height: 5px;
                margin-bottom: 15px;
                border-radius: 3px;
                overflow: hidden;
                background: #eee;
                position: relative;
                top: -15px;
            }

            .password-strength-meter {
                height: 100%;
                width: 0;
                transition: width 0.3s ease, background 0.3s ease;
            }

            .weak {
                width: 33%;
                background: var(--error-color);
            }

            .medium {
                width: 66%;
                background: #ffba00;
            }

            .strong {
                width: 100%;
                background: var(--success-color);
            }

            .password-strength-text {
                font-size: 12px;
                margin-bottom: 15px;
                text-align: right;
                position: relative;
                top: -15px;
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
                
                .heading {
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
                
                .center {
                    padding: 25px;
                }
            }

            @media screen and (max-width: 576px) {
                .center {
                    padding: 20px;
                }
                
                form button, form a {
                    width: 100%;
                    margin-right: 0;
                    text-align: center;
                    justify-content: center;
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
            <div class="main-content">
                <!-- Header Section -->
                <div class="page-header">
                    <h1>Change Password</h1>
                </div>
                
                <!-- Center Content -->
                <div class="center">
                    <?php
                        if(isset($_POST["submit"]))
                        {
                            $sql="SELECT * from staff WHERE SPASS='{$_POST["opass"]}' and SID='{$_SESSION["ID"]}'";
                            $res=$db->query($sql);
                            if($res->num_rows>0)
                            {
                                $s="update staff set SPASS='{$_POST["npass"]}' WHERE SID=".$_SESSION["ID"];
                                $db->query($s);
                                echo"<p class='success'>Password Changed Successfully</p>";
                            }
                            else
                            {
                                echo"<p class='error'>Invalid Password</p>";
                            }
                        }   
                    ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                        <h3 class="heading">Change Password</h3>
                        
                        <label>Old Password:</label>
                        <div class="password-field">
                            <input type="password" name="opass" required class="password-input" id="old-password">
                            <i class='bx bx-hide toggle-password' id="toggle-old-password"></i>
                        </div>
                        
                        <label>New Password:</label>
                        <div class="password-field">
                            <input type="password" name="npass" required class="password-input" id="new-password">
                            <i class='bx bx-hide toggle-password' id="toggle-new-password"></i>
                        </div>
                        
                        <div class="password-strength">
                            <div class="password-strength-meter" id="password-strength-meter"></div>
                        </div>
                        <div class="password-strength-text" id="password-strength-text"></div>
                        
                        <button type="submit" name="submit">Update Password</button>
                        <a href="fp.php">Forgot Password?</a>
                        <a href="shome.php">Home</a>
                        <a href="schangepass.php">Refresh</a>
                    </form>
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
            
            // Password visibility toggle - Fixed implementation
            document.getElementById('toggle-old-password').addEventListener('click', function() {
                const passwordInput = document.getElementById('old-password');
                togglePasswordVisibility(passwordInput, this);
            });
            
            document.getElementById('toggle-new-password').addEventListener('click', function() {
                const passwordInput = document.getElementById('new-password');
                togglePasswordVisibility(passwordInput, this);
            });
            
            function togglePasswordVisibility(inputElement, iconElement) {
                // Toggle between password and text type
                if (inputElement.type === 'password') {
                    inputElement.type = 'text';
                    iconElement.classList.remove('bx-hide');
                    iconElement.classList.add('bx-show');
                } else {
                    inputElement.type = 'password';
                    iconElement.classList.remove('bx-show');
                    iconElement.classList.add('bx-hide');
                }
                
                // Important: Preserve all classes and styles
                inputElement.classList.add('password-input');
            }
            
            // Password strength meter
            const newPassword = document.getElementById('new-password');
            const strengthMeter = document.getElementById('password-strength-meter');
            const strengthText = document.getElementById('password-strength-text');
            
            newPassword.addEventListener('input', function() {
                const password = this.value;
                const strength = calculatePasswordStrength(password);
                
                // Update strength meter
                strengthMeter.className = '';
                strengthText.textContent = '';
                
                if (password.length > 0) {
                    if (strength < 3) {
                        strengthMeter.classList.add('weak');
                        strengthText.textContent = 'Weak';
                        strengthText.style.color = 'var(--error-color)';
                    } else if (strength < 5) {
                        strengthMeter.classList.add('medium');
                        strengthText.textContent = 'Medium';
                        strengthText.style.color = '#ffba00';
                    } else {
                        strengthMeter.classList.add('strong');
                        strengthText.textContent = 'Strong';
                        strengthText.style.color = 'var(--success-color)';
                    }
                }
            });
            
            function calculatePasswordStrength(password) {
                let strength = 0;
                
                // Length check
                if (password.length >= 8) strength += 1;
                if (password.length >= 12) strength += 1;
                
                // Character type checks
                if (/[A-Z]/.test(password)) strength += 1; // Uppercase
                if (/[a-z]/.test(password)) strength += 1; // Lowercase
                if (/[0-9]/.test(password)) strength += 1; // Numbers
                if (/[^A-Za-z0-9]/.test(password)) strength += 1; // Special characters
                
                return strength;
            }
        </script>
    </body>
</html>
