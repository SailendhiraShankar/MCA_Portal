<?php
    session_start();
    include"database.php";
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>MCA Portal - OTP Verification</title>
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
                align-items: center;
            }

            form h3 {
                color: var(--primary-color);
                margin-bottom: 25px;
                font-size: 24px;
                font-weight: 600;
                position: relative;
                display: inline-block;
                text-align: center;
            }

            form h3::after {
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
                align-self: flex-start;
            }

            form input[type="text"] {
                width: 100%;
                padding: 14px 15px;
                margin-bottom: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background: #f9f9f9;
                transition: all var(--transition-speed) ease;
                font-size: 18px;
                letter-spacing: 5px;
                text-align: center;
                font-weight: 600;
            }

            form input[type="text"]:focus {
                border-color: var(--primary-color);
                background: var(--white);
                box-shadow: 0 0 0 3px var(--primary-light);
                outline: none;
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
                min-width: 150px;
                justify-content: center;
            }

            form button:hover {
                background: var(--primary-dark);
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(116, 148, 236, 0.3);
            }

            form button::before {
                content: '\ea41';
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
                min-width: 150px;
                justify-content: center;
            }

            form a:hover {
                background: #e9ecf3;
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            }

            form a::before {
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
                width: 100%;
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
                width: 100%;
            }

            .error::before {
                content: '\ec80';
                font-family: 'boxicons';
                font-size: 20px;
            }

            /* OTP Input Animation */
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.02); }
                100% { transform: scale(1); }
            }

            .otp-animation {
                animation: pulse 1.5s infinite;
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

            /* OTP Digits Display */
            .otp-container {
                display: flex;
                justify-content: center;
                gap: 10px;
                margin-bottom: 20px;
            }

            .otp-digit {
                width: 50px;
                height: 60px;
                border: 2px solid #ddd;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                font-weight: 600;
                background: #f9f9f9;
                transition: all var(--transition-speed) ease;
            }

            .otp-digit.filled {
                border-color: var(--primary-color);
                background: var(--primary-light);
            }

            /* Timer */
            .timer {
                margin-top: 15px;
                font-size: 14px;
                color: var(--text-light);
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .timer::before {
                content: '\ea0b';
                font-family: 'boxicons';
                font-size: 16px;
                color: var(--accent-color);
            }

            /* Responsive Styles */
            @media screen and (max-width: 576px) {
                .center {
                    padding: 25px;
                }
                
                form button, form a {
                    width: 100%;
                    margin-right: 0;
                }
                
                .otp-digit {
                    width: 40px;
                    height: 50px;
                    font-size: 20px;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <!-- Header Section -->
            <div class="page-header">
                <h1>OTP Verification</h1>
            </div>
            
            <!-- Center Content -->
            <div class="center">
                <?php
                    if(isset($_POST["submit"]))
                    {
                        $otp=$_POST["verification_code"];
                        $sql="UPDATE otp SET otp_verified_at = NOW() WHERE verification_code = '".$otp."'";
                        $result=mysqli_query($db,$sql);
                        if(mysqli_affected_rows($db)>0)
                        {
                            header("Location: otpchangepass.php?email=".$email);
                        }
                        else
                        {
                            echo"<p class='error'>Invalid OTP. Please try again.</p>";
                        }
                    }
                ?>
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                    <h3>OTP Sent Successfully</h3>
                    
                    <div class="otp-container">
                        <div class="otp-digit" id="digit-1"></div>
                        <div class="otp-digit" id="digit-2"></div>
                        <div class="otp-digit" id="digit-3"></div>
                        <div class="otp-digit" id="digit-4"></div>
                        <div class="otp-digit" id="digit-5"></div>
                        <div class="otp-digit" id="digit-6"></div>
                    </div>
                    
                    <label>Enter OTP:</label>
                    <input type="text" name="verification_code" id="otp-input" maxlength="6" required class="otp-animation" placeholder="------" autocomplete="off">
                    
                    <div class="timer" id="timer">OTP expires in: 05:00</div>
                    
                    <button type="submit" name="submit">Verify OTP</button>
                    <a href="otp_verification.php">Resend OTP</a>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="footer">
                <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?></p>
            </div>
        </div>
        
        <script>
            // OTP Input Enhancement
            const otpInput = document.getElementById('otp-input');
            const digitElements = [
                document.getElementById('digit-1'),
                document.getElementById('digit-2'),
                document.getElementById('digit-3'),
                document.getElementById('digit-4'),
                document.getElementById('digit-5'),
                document.getElementById('digit-6')
            ];
            
            // Focus on OTP input when page loads
            window.addEventListener('load', function() {
                otpInput.focus();
            });
            
            // Update digit display when typing
            otpInput.addEventListener('input', function() {
                const value = this.value;
                
                // Reset all digits
                digitElements.forEach(digit => {
                    digit.textContent = '';
                    digit.classList.remove('filled');
                });
                
                // Fill digits based on input
                for (let i = 0; i < value.length && i < 6; i++) {
                    digitElements[i].textContent = value[i];
                    digitElements[i].classList.add('filled');
                }
            });
            
            // OTP Expiry Timer
            function startTimer(duration, display) {
                let timer = duration, minutes, seconds;
                const interval = setInterval(function () {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);
                    
                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;
                    
                    display.textContent = `OTP expires in: ${minutes}:${seconds}`;
                    
                    if (--timer < 0) {
                        clearInterval(interval);
                        display.textContent = "OTP expired. Please request a new one.";
                        display.style.color = "var(--error-color)";
                    }
                }, 1000);
            }
            
            // Start 5-minute countdown
            window.onload = function () {
                const fiveMinutes = 60 * 5;
                const display = document.getElementById('timer');
                startTimer(fiveMinutes, display);
            };
            
            // Only allow numbers in OTP input
            otpInput.addEventListener('keypress', function(e) {
                const charCode = e.which ? e.which : e.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    e.preventDefault();
                }
            });
        </script>
    </body>
</html>
