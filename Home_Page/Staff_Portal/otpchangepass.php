<?php
    session_start();
    include"database.php";
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
                flex-direction: column;
                min-height: 100vh;
                align-items: center;
                justify-content: center;
                padding: 30px;
                position: relative;
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
                width: 100%;
                max-width: 600px;
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
                position: relative;
                overflow: hidden;
                animation: fadeIn 0.5s ease-out forwards;
                max-width: 500px;
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
                display: flex;
                flex-direction: column;
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

            form input[type="email"],
            form input[type="password"] {
                width: 100%;
                padding: 14px 15px;
                margin-bottom: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background: #f9f9f9;
                transition: all var(--transition-speed) ease;
                font-size: 15px;
            }

            form input[type="email"]:focus,
            form input[type="password"]:focus {
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
                width: fit-content;
            }

            form a:hover {
                background: #e9ecf3;
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            }

            form a::before {
                content: '\eb2d';
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
                width: 100%;
                max-width: 600px;
            }

            /* Email Verification Badge */
            .verified-email {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                background: rgba(46, 213, 115, 0.1);
                color: var(--success-color);
                padding: 5px 10px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 500;
                position: absolute;
                top: 15px;
                right: 15px;
            }

            .verified-email::before {
                content: '\ec34';
                font-family: 'boxicons';
                font-size: 14px;
            }

            /* Responsive Styles */
            @media screen and (max-width: 576px) {
                .center {
                    padding: 25px;
                }
                
                form button, form a {
                    width: 100%;
                    margin-right: 0;
                    text-align: center;
                    justify-content: center;
                }
                
                .heading {
                    font-size: 24px;
                }
            }

            /* Animation for form elements */
            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            form label, form input, form button, form a {
                animation: slideInUp 0.5s ease forwards;
                opacity: 0;
            }
            
            form label:nth-child(2) { animation-delay: 0.1s; }
            form input:nth-child(3) { animation-delay: 0.2s; }
            form label:nth-child(4) { animation-delay: 0.3s; }
            form input:nth-child(5) { animation-delay: 0.4s; }
            form button { animation-delay: 0.5s; }
            form a { animation-delay: 0.6s; }
        </style>
    </head>
    <body>
        <div class="container">
            <!-- Header Section -->
            <div class="page-header">
                <h1>Reset Password</h1>
            </div>
            
            <!-- Center Content -->
            <div class="center">
                <?php
                    if(isset($_POST["submit"]))
                    {
                        $csql = "select * from staff WHERE MAIL='{$_POST["email"]}'";
                        $cr = $db->query($csql);
                        if($cr->num_rows>0)
                        {
                            $sql="update staff set SPASS='{$_POST["npass"]}' WHERE MAIL='{$_POST["email"]}'";
                            if($db->query($sql))
                            {
                                echo"<p class='success'>Password Changed Successfully</p>";
                            }
                        }
                        else
                        {
                            echo "<p class='error'>Email Not Found</p>";
                        }   
                    }   
                ?>
                <div class="verified-email">Email Verified</div>
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                    <h3 class="heading">Change Password</h3>
                    
                    <label>Enter Your Email:</label>
                    <input type="email" name="email" required placeholder="Enter your verified email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>">
                    
                    <label>New Password:</label>
                    <div class="password-field">
                        <input type="password" name="npass" id="new-password" required placeholder="Enter your new password">
                        <i class='bx bx-hide toggle-password' id="toggle-password"></i>
                    </div>
                    
                    <div class="password-strength">
                        <div class="password-strength-meter" id="password-strength-meter"></div>
                    </div>
                    <div class="password-strength-text" id="password-strength-text"></div>
                    
                    <button type="submit" name="submit">Update Password</button>
                    <a href="shome.php">Back to Home</a>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="footer">
                <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?></p>
            </div>
        </div>
        
        <script>
            // Password visibility toggle
            document.getElementById('toggle-password').addEventListener('click', function() {
                const passwordInput = document.getElementById('new-password');
                
                // Toggle between password and text type
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.classList.remove('bx-hide');
                    this.classList.add('bx-show');
                } else {
                    passwordInput.type = 'password';
                    this.classList.remove('bx-show');
                    this.classList.add('bx-hide');
                }
            });
            
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
            
            // Auto-fill email from URL parameter if available
            window.addEventListener('load', function() {
                const emailInput = document.querySelector('input[type="email"]');
                if (emailInput.value) {
                    emailInput.setAttribute('readonly', true);
                    emailInput.style.backgroundColor = 'var(--primary-light)';
                    emailInput.style.borderColor = 'var(--primary-color)';
                    
                    // Focus on password field
                    document.getElementById('new-password').focus();
                }
            });
        </script>
    </body>
</html>
