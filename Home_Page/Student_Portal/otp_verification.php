<!DOCTYPE HTML>
<html>
    <head>
        <title>MCA Portal - OTP Verification</title>
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
                text-align: center;
                letter-spacing: 8px;
                font-weight: 600;
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
                justify-content: center;
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

            .error {
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

            .error i {
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

            /* OTP verification animation */
            .otp-icon {
                font-size: 80px;
                color: var(--primary-color);
                display: block;
                text-align: center;
                margin-bottom: 20px;
                animation: pulse 2s ease-in-out infinite;
            }

            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.1); }
                100% { transform: scale(1); }
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

            /* OTP input boxes */
            .otp-inputs {
                display: flex;
                justify-content: center;
                gap: 10px;
                margin-bottom: 20px;
            }

            .otp-input {
                width: 50px;
                height: 60px;
                border-radius: 10px;
                border: 1px solid #e0e0e0;
                background: #f9f9f9;
                font-size: 24px;
                font-weight: 600;
                text-align: center;
                transition: all var(--transition-speed);
            }

            .otp-input:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px var(--primary-light);
                outline: none;
                background: var(--white);
            }

            /* Timer */
            .timer {
                text-align: center;
                margin-top: 15px;
                color: var(--text-light);
                font-size: 14px;
            }

            .timer span {
                color: var(--primary-color);
                font-weight: 600;
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

                .otp-icon {
                    font-size: 60px;
                }

                .otp-input {
                    width: 40px;
                    height: 50px;
                    font-size: 20px;
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

            /* Success message */
            .success-message {
                background-color: rgba(46, 213, 115, 0.1);
                color: var(--success-color);
                padding: 15px;
                border-radius: 12px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 500;
                border-left: 4px solid var(--success-color);
            }
        </style>
    </head>
    <body>
     <div class="container">
        <?php
            session_start();
            include"database.php";
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
                    echo "<div class='error'><i class='bx bxs-error-circle'></i> Invalid OTP. Please try again.</div>";
                }
            }
        ?>
        <div class="center"> 
            <div class="security-pattern"></div>
            <i class='bx bxs-check-shield otp-icon'></i>
            
            <div class="success-message">
                <i class='bx bxs-check-circle'></i> OTP has been sent successfully to your email
            </div>
            
            <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" id="otpForm">
                <h3>Verify Your Identity</h3>
                <p style="text-align: center; margin-bottom: 20px; color: var(--text-light);">
                    Please enter the 6-digit verification code sent to your email
                </p>
                
                <div class="input-container">
                    <input type="text" name="verification_code" id="otpInput" placeholder=" " maxlength="6" required>
                    <label for="otpInput">Enter OTP</label>
                    <i class='bx bxs-lock-alt input-icon'></i>
                </div>
                
                <div class="timer">
                    Time remaining: <span id="countdown">05:00</span>
                </div>
                
                <button type="submit" name="submit" id="submitBtn">
                    <i class='bx bxs-check-circle'></i> Verify OTP
                </button>
                
                <div class="links">
                    <a href="otp_verification.php"><i class='bx bx-refresh'></i> Refresh</a>
                </div>
            </form>
        </div>
        <div class="footer">
            <p>Copyright &copy; MCA Portal 2025</p>
        </div>
     </div>

     <script>
        // Form submission animation
        const form = document.getElementById('otpForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) return;
            
            submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Verifying...';
            submitBtn.disabled = true;
            
            // Form will submit normally after this
        });
        
        // OTP input formatting and validation
        const otpInput = document.getElementById('otpInput');
        
        otpInput.addEventListener('input', function(e) {
            // Remove non-numeric characters
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Limit to 6 digits
            if (this.value.length > 6) {
                this.value = this.value.slice(0, 6);
            }
        });
        
        // Countdown timer
        function startCountdown() {
            let duration = 5 * 60; // 5 minutes in seconds
            const countdownEl = document.getElementById('countdown');
            
            const timer = setInterval(function() {
                const minutes = Math.floor(duration / 60);
                let seconds = duration % 60;
                
                seconds = seconds < 10 ? '0' + seconds : seconds;
                
                countdownEl.textContent = minutes + ':' + seconds;
                
                if (--duration < 0) {
                    clearInterval(timer);
                    countdownEl.textContent = 'Expired';
                    countdownEl.style.color = 'var(--error-color)';
                    
                    // Add resend link
                    const timerDiv = document.querySelector('.timer');
                    timerDiv.innerHTML += ' <a href="fp.php" style="color: var(--primary-color); text-decoration: none; font-weight: 500;"><i class="bx bx-refresh"></i> Resend OTP</a>';
                }
            }, 1000);
        }
        
        // Start countdown when page loads
        window.onload = function() {
            startCountdown();
        };
        
        // Auto-focus on OTP input
        otpInput.focus();
        
        // Auto-submit when 6 digits are entered
        otpInput.addEventListener('input', function() {
            if (this.value.length === 6) {
                // Wait a moment before submitting to show the user the complete input
                setTimeout(() => {
                    submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Verifying...';
                    submitBtn.disabled = true;
                    form.submit();
                }, 500);
            }
        });
     </script>
    </body>
</html>
