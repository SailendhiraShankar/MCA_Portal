<?php
 include"database.php";
?>
<!DOCTYPE HTML>
<html>
    <head>
      <title>MCA Portal - New User Registration</title>
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            text-decoration: none;
            list-style: none;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(90deg, #c9d6ff, #e2e2e2);
        }

        .container {
            position: relative;
            width: 850px;
            background: #fff;
            margin: 20px;
            border-radius: 30px;
            box-shadow: 0 0 30px rgba(0, 0, 0, .2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            padding: 40px;
        }

        .center {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .heading {
            color: #7494ec;
            margin-bottom: 25px;
            font-size: 32px;
            font-weight: 600;
            position: relative;
            display: inline-block;
            text-align: center;
        }

        .heading::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: #7494ec;
            border-radius: 3px;
        }

        form {
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 1;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        form input, form select {
            width: 100%;
            padding: 13px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
            transition: all 0.3s ease;
            font-size: 15px;
            color: #333;
        }

        form input:focus, form select:focus {
            border-color: #7494ec;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(116, 148, 236, 0.1);
            outline: none;
        }

        form select {
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%237494ec" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>');
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
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
            color: #777;
            z-index: 2;
            font-size: 18px;
        }

        form button {
            width: 100%;
            height: 48px;
            background: #7494ec;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 15px;
        }

        form button::before {
            content: '\ea12';
            font-family: 'boxicons';
            font-size: 20px;
        }

        form button:hover {
            background: #5a7bd6;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(116, 148, 236, 0.3);
        }

        .links-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        form a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f5f7fb;
            color: #333;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.3s ease;
            margin-bottom: 10px;
        }

        form a:hover {
            background: #e9ecf3;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        form a:nth-child(1)::before {
            content: '\eb77';
            font-family: 'boxicons';
            font-size: 18px;
            color: #7494ec;
        }

        form a:nth-child(2)::before {
            content: '\eb96';
            font-family: 'boxicons';
            font-size: 18px;
            color: #7494ec;
        }

        form a:nth-child(3)::before {
            content: '\eb2d';
            font-family: 'boxicons';
            font-size: 18px;
            color: #7494ec;
        }

        /* Success and Error Messages */
        .success {
            background: rgba(46, 213, 115, 0.1);
            color: #2ed573;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
            border-left: 4px solid #2ed573;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            max-width: 500px;
        }

        .success::before {
            content: '\ec34';
            font-family: 'boxicons';
            font-size: 20px;
        }

        .error {
            background: rgba(255, 71, 87, 0.1);
            color: #ff4757;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
            border-left: 4px solid #ff4757;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            max-width: 500px;
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
            width: 100%;
        }

        .password-strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s ease, background 0.3s ease;
        }

        .weak {
            width: 33%;
            background: #ff4757;
        }

        .medium {
            width: 66%;
            background: #ffba00;
        }

        .strong {
            width: 100%;
            background: #2ed573;
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
            color: #777;
            font-size: 14px;
            margin-top: 30px;
            border-radius: 15px;
            width: 100%;
        }

        /* Decorative elements */
        .decoration {
            position: absolute;
            z-index: 0;
        }

        .circle-1 {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(116, 148, 236, 0.05);
            top: -100px;
            right: -50px;
        }

        .circle-2 {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(116, 148, 236, 0.05);
            bottom: -50px;
            left: -50px;
        }

        /* Animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .heading {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        form label, form input, form select, form button, form a {
            opacity: 0;
            animation: fadeInUp 0.5s ease-out forwards;
        }

        form label:nth-of-type(1), form input:nth-of-type(1) { animation-delay: 0.1s; }
        form label:nth-of-type(2), form input:nth-of-type(2) { animation-delay: 0.2s; }
        form label:nth-of-type(3), form input:nth-of-type(3) { animation-delay: 0.3s; }
        form label:nth-of-type(4), form select { animation-delay: 0.4s; }
        form button { animation-delay: 0.5s; }
        .links-container { animation-delay: 0.6s; }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            .container {
                padding: 30px;
                margin: 15px;
            }
            
            .heading {
                font-size: 28px;
            }
        }

        @media screen and (max-width: 480px) {
            .container {
                padding: 20px;
                margin: 10px;
                border-radius: 20px;
            }
            
            .heading {
                font-size: 24px;
            }
            
            form input, form select {
                padding: 12px;
                font-size: 14px;
            }
            
            form button {
                height: 44px;
                font-size: 15px;
            }
            
            form a {
                padding: 10px 15px;
                font-size: 14px;
            }
            
            .links-container {
                flex-direction: column;
                gap: 10px;
            }
            
            form a {
                width: 100%;
                justify-content: center;
            }
        }
      </style>
    </head>
    <body>
        <div class="container">
            <!-- Decorative elements -->
            <div class="decoration circle-1"></div>
            <div class="decoration circle-2"></div>
            
            <div class="center">
                <?php
                   if(isset($_POST["submit"]))
                   {
                        $sql="insert into user (UNAME,UPASS,MAIL,STATE) values ('{$_POST["name"]}','{$_POST["pass"]}','{$_POST["mail"]}','{$_POST["state"]}')";
                        $db->query($sql);
                        echo"<p class='success'>Successfully Registered</p>";
                   }   
                ?>
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" >
                    <h3 class="heading">New User Registration</h3>
                    
                    <label>Name:</label>
                    <input type="text" name="name" required placeholder="Enter your full name">
                    
                    <label>Password:</label>
                    <div class="password-field">
                        <input type="password" name="pass" id="password" required placeholder="Create a strong password">
                        <i class='bx bx-hide toggle-password' id="toggle-password"></i>
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-meter" id="password-strength-meter"></div>
                    </div>
                    <div class="password-strength-text" id="password-strength-text"></div>
                    
                    <label>Email:</label>
                    <input type="email" name="mail" required placeholder="Enter your email address">
                    
                    <label>State:</label>
                    <select name="state" required>
                        <option value="">Select your state</option>
                        <option value="1">Tamil Nadu</option>
                        <option value="2">Mumbai</option>
                        <option value="3">Kerala</option>
                        <option value="4">Karnataka</option>
                        <option value="5">Andhra Pradesh</option>
                        <option value="Others">Others</option>
                    </select>
                    
                    <button type="submit" name="submit">Register Account</button>
                    
                    <div class="links-container">
                        <a href="ulogin.php">Login Now</a>
                        <a href="new.php">Refresh</a>
                        <a href="../index.php">Home</a>
                    </div>
                </form>
            </div>        
            
            <div class="footer">
               <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?></p>
            </div>
        </div>
        
        <script>
            // Password visibility toggle
            document.getElementById('toggle-password').addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                
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
            const password = document.getElementById('password');
            const strengthMeter = document.getElementById('password-strength-meter');
            const strengthText = document.getElementById('password-strength-text');
            
            password.addEventListener('input', function() {
                const value = this.value;
                const strength = calculatePasswordStrength(value);
                
                // Reset strength meter
                strengthMeter.className = '';
                strengthText.textContent = '';
                
                if (value.length > 0) {
                    if (strength < 3) {
                        strengthMeter.classList.add('weak');
                        strengthText.textContent = 'Weak';
                        strengthText.style.color = '#ff4757';
                    } else if (strength < 5) {
                        strengthMeter.classList.add('medium');
                        strengthText.textContent = 'Medium';
                        strengthText.style.color = '#ffba00';
                    } else {
                        strengthMeter.classList.add('strong');
                        strengthText.textContent = 'Strong';
                        strengthText.style.color = '#2ed573';
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
            
            // Auto focus on name field
            window.addEventListener('load', function() {
                document.querySelector('input[name="name"]').focus();
            });
        </script>
    </body>
</html>
