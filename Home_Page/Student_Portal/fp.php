<?php
    session_start();
    include"database.php";
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;

   require 'phpmailer/vendor/autoload.php';

   if(isset($_POST["submit"]))
   {
    $email=$_POST["email"];
    $mail=new PHPMailer(true);
    try
    {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gskgsk3773@gmail.com';
        $mail->Password = 'fcgq sojw hmyl tzhv';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('mcaportal@gmail.com','MCA Portal');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $verification_code = substr(number_format(time() * rand(),0,'',''),0,6);
        $mail->Subject = 'MCA Portal OTP Verification';
        $mail->Body = '<p><h3>Your OTP is : </h3> <b style="font-size:35px;">'.$verification_code.'</b><br><br><b>Thanks for spending your golden time in our MCA Portal Web Page.</b></p>';
        $mail->send();
        $encryption_password = password_hash($password, PASSWORD_DEFAULT);
        $sql="INSERT INTO otp(verification_code) values ('".$verification_code."')";
        mysqli_query($db,$sql);
        header("Location: otp_verification.php?email=".$email);
        exit();
    }
    catch(Exception $e)
    {
        $error_message = "OTP could not send. Mailer Error: {$mail->ErrorInfo}";
    }
   }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>MCA Portal - Forgot Password</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' );

            :root {
                --primary-color: #7494ec;
                --primary-light: rgba(116, 148, 236, 0.1);
                --primary-dark: #5a7ad0;
                --accent-color: #ff6b6b;
                --success-color: #2ed573;
                --error-color: #ff4757;
                --warning-color: #ffa502;
                --text-dark: #333;
                --text-light: #777;
                --white: #ffffff;
                --bg-light: #f8f9fa;
                --transition-speed: 0.3s;
                --shadow-light: 0 5px 15px rgba(0, 0, 0, 0.05);
                --shadow-dark: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
            }

            body {
                background: linear-gradient(135deg, #c9d6ff, #e2e2e2);
                color: var(--text-dark);
                line-height: 1.6;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
            }

            .container {
                width: 100%;
                max-width: 500px;
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .center {
                background: var(--white);
                border-radius: 20px;
                padding: 30px;
                box-shadow: var(--shadow-light);
                transition: all var(--transition-speed);
                position: relative;
                overflow: hidden;
                animation: fadeIn 0.8s ease-out forwards;
            }

            .center:hover {
                box-shadow: var(--shadow-dark);
                transform: translateY(-5px);
            }

            .center::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 5px;
                background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            }

            h3 {
                color: var(--primary-color);
                font-size: 28px;
                margin-bottom: 25px;
                text-align: center;
                position: relative;
                display: inline-block;
                left: 50%;
                transform: translateX(-50%);
            }

            h3::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 0;
                width: 100%;
                height: 3px;
                background: var(--primary-color);
                border-radius: 3px;
            }

            form {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .input-container {
                position: relative;
            }

            label {
                position: absolute;
                top: 15px;
                left: 15px;
                color: var(--text-light);
                transition: all 0.3s ease;
                pointer-events: none;
                background: transparent;
            }

            input {
                width: 100%;
                padding: 15px;
                border-radius: 12px;
                border: 1px solid #e0e0e0;
                background: #f9f9f9;
                font-size: 16px;
                color: var(--text-dark);
                transition: all var(--transition-speed);
            }

            input:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px var(--primary-light);
                outline: none;
                background: var(--white);
            }

            input:focus ~ label,
            input:not(:placeholder-shown) ~ label {
                top: -10px;
                left: 10px;
                font-size: 12px;
                padding: 0 5px;
                background: white;
                color: var(--primary-color);
            }

            .input-icon {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--primary-color);
                font-size: 20px;
            }

            button {
                background: var(--primary-color);
                color: var(--white);
                border: none;
                padding: 15px;
                border-radius: 12px;
                font-weight: 600;
                font-size: 16px;
                cursor: pointer;
                transition: all var(--transition-speed);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                position: relative;
                overflow: hidden;
            }

            button::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: all 0.5s;
            }

            button:hover::before {
                left: 100%;
            }

            button:hover {
                background: var(--primary-dark);
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(116, 148, 236, 0.3);
            }

            button i {
                font-size: 20px;
            }

            .links {
                display: flex;
                justify-content: space-between;
                margin-top: 15px;
            }

            .links a {
                color: var(--primary-color);
                text-decoration: none;
                font-weight: 500;
                transition: all var(--transition-speed);
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .links a:hover {
                color: var(--primary-dark);
                transform: translateY(-2px);
            }

            .links a i {
                font-size: 18px;
            }

            .error-message {
                background-color: rgba(255, 71, 87, 0.1);
                color: var(--error-color);
                padding: 15px;
                border-radius: 12px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 500;
                border-left: 4px solid var(--error-color);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                animation: shake 0.5s ease-in-out;
            }

            .error-message i {
                font-size: 20px;
            }

            .footer {
                text-align: center;
                padding: 15px;
                background: rgba(255, 255, 255, 0.8);
                color: var(--text-light);
                font-size: 14px;
                border-radius: 15px;
                backdrop-filter: blur(10px);
            }

            /* Animations */
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }

            /* Email verification animation */
            .email-icon {
                font-size: 80px;
                color: var(--primary-color);
                display: block;
                text-align: center;
                margin-bottom: 20px;
                animation: floating 3s ease-in-out infinite;
            }

            @keyframes floating {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
                100% { transform: translateY(0px); }
            }

            /* Security pattern background */
            .security-pattern {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: 
                    radial-gradient(var(--primary-light) 2px, transparent 2px),
                    radial-gradient(var(--primary-light) 2px, transparent 2px);
                background-size: 30px 30px;
                background-position: 0 0, 15px 15px;
                opacity: 0.3;
                z-index: -1;
            }

            /* Responsive styles */
            @media (max-width: 576px) {
                .center {
                    padding: 20px;
                }

                h3 {
                    font-size: 24px;
                }

                input, button {
                    padding: 12px;
                }

                .email-icon {
                    font-size: 60px;
                }

                .links {
                    flex-direction: column;
                    gap: 15px;
                    align-items: center;
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
        <div class="center">
            <div class="security-pattern"></div>
            <i class='bx bxs-envelope email-icon'></i>
            
            <?php if(isset($error_message)): ?>
                <div class="error-message">
                    <i class='bx bxs-error-circle'></i>
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <form action="fp.php" method="post" id="forgotPasswordForm">
                <h3>Password Recovery</h3>
                <p style="text-align: center; margin-bottom: 20px; color: var(--text-light);">
                    Enter your email address to receive a verification code
                </p>
                
                <div class="input-container">
                    <input type="email" name="email" id="emailInput" placeholder=" " required>
                    <label for="emailInput">Email Address</label>
                    <i class='bx bxs-envelope input-icon'></i>
                </div>
                
                <button type="submit" name="submit" id="submitBtn">
                    <i class='bx bxs-paper-plane'></i> Send Verification Code
                </button>
                
                <div class="links">
                    <a href="fp.php"><i class='bx bx-refresh'></i> Refresh</a>
                    <a href="ulogin.php"><i class='bx bx-arrow-back'></i> Back to Login</a>
                </div>
            </form>
        </div>
        <div class="footer">
            <p>Copyright &copy; MCA Portal 2025</p>
        </div>
     </div>

     <script>
        // Form submission animation
        const form = document.getElementById('forgotPasswordForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) return;
            
            submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Sending...';
            submitBtn.disabled = true;
            
            // Form will submit normally after this
        });
        
        // Email validation with visual feedback
        const emailInput = document.getElementById('emailInput');
        
        emailInput.addEventListener('blur', function() {
            if (this.value && !isValidEmail(this.value)) {
                this.style.borderColor = 'var(--error-color)';
                this.style.boxShadow = '0 0 0 3px rgba(255, 71, 87, 0.1)';
                
                // Add error message if it doesn't exist
                if (!document.querySelector('.email-error')) {
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'email-error';
                    errorMsg.style.color = 'var(--error-color)';
                    errorMsg.style.fontSize = '12px';
                    errorMsg.style.marginTop = '5px';
                    errorMsg.innerHTML = '<i class="bx bxs-error-circle"></i> Please enter a valid email address';
                    this.parentNode.appendChild(errorMsg);
                }
            } else {
                this.style.borderColor = '';
                this.style.boxShadow = '';
                
                // Remove error message if it exists
                const errorMsg = document.querySelector('.email-error');
                if (errorMsg) {
                    errorMsg.remove();
                }
            }
        });
        
        // Email validation function
        function isValidEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
        
        // Focus animation for input
        emailInput.addEventListener('focus', function() {
            this.parentNode.classList.add('focused');
        });
        
        emailInput.addEventListener('blur', function() {
            this.parentNode.classList.remove('focused');
        });
     </script>
    </body>
</html>
