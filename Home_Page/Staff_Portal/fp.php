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
        echo"OTP could not send.Mailer Error: {$mail->ErrorInfo}";
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
                background: linear-gradient(135deg, #c9d6ff, #e2e2e2);
            }

            .container {
                position: relative;
                width: 500px;
                background: #fff;
                margin: 20px;
                border-radius: 40px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, .2);
                overflow: hidden;
                padding: 40px;
            }

            .center {
                text-align: center;
            }

            h3 {
                font-size: 28px;
                margin-bottom: 30px;
                color: #7494ec;
                position: relative;
                display: inline-block;
            }

            h3::after {
                content: '';
                position: absolute;
                bottom: -10px;
                left: 0;
                width: 100%;
                height: 3px;
                background: #7494ec;
                border-radius: 3px;
            }

            form {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            label {
                align-self: flex-start;
                margin-bottom: 8px;
                font-weight: 500;
                color: #333;
                font-size: 16px;
            }

            .input-box {
                position: relative;
                width: 100%;
                margin-bottom: 30px;
            }

            input[type="email"] {
                width: 100%;
                padding: 15px 50px 15px 20px;
                background: #f5f5f5;
                border-radius: 15px;
                border: 1px solid #e0e0e0;
                outline: none;
                font-size: 16px;
                color: #333;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            input[type="email"]:focus {
                border-color: #7494ec;
                box-shadow: 0 0 0 2px rgba(116, 148, 236, 0.1);
            }

            input[type="email"]::placeholder {
                color: #888;
                font-weight: 400;
            }

            .input-box i {
                position: absolute;
                right: 20px;
                top: 50%;
                transform: translateY(-50%);
                font-size: 20px;
                color: #7494ec;
            }

            button {
                width: 100%;
                height: 48px;
                background: #7494ec;
                border-radius: 15px;
                box-shadow: 0 4px 10px rgba(116, 148, 236, 0.3);
                border: none;
                cursor: pointer;
                font-size: 16px;
                color: #fff;
                font-weight: 600;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
                margin-bottom: 20px;
            }

            button::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: all 0.5s ease;
            }

            button:hover {
                background: #5a7bd6;
                transform: translateY(-2px);
            }

            button:hover::before {
                left: 100%;
            }

            .links {
                display: flex;
                justify-content: space-between;
                width: 100%;
                margin-top: 10px;
            }

            a {
                color: #7494ec;
                font-size: 15px;
                transition: all 0.3s ease;
            }

            a:hover {
                color: #5a7bd6;
                text-decoration: underline;
            }

            .footer {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                text-align: center;
                padding: 10px;
                background: rgba(0, 0, 0, 0.05);
                color: #666;
                font-size: 14px;
            }

            .email-icon {
                font-size: 80px;
                color: #7494ec;
                margin-bottom: 20px;
                animation: floating 3s ease-in-out infinite;
            }

            @keyframes floating {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
                100% { transform: translateY(0px); }
            }

            .error-message {
                background-color: rgba(255, 51, 51, 0.1);
                color: #ff3333;
                padding: 10px;
                border-radius: 15px;
                margin-bottom: 20px;
                text-align: center;
                border-left: 4px solid #ff3333;
                width: 100%;
                animation: shake 0.5s ease-in-out;
            }

            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }

            /* Animation */
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .container {
                animation: fadeIn 0.5s ease-out forwards;
            }

            @media screen and (max-width: 576px) {
                .container {
                    width: 90%;
                    padding: 30px 20px;
                }

                h3 {
                    font-size: 24px;
                }

                .email-icon {
                    font-size: 60px;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="center">
                <i class='bx bxs-envelope email-icon'></i>
                <h3>OTP Verification</h3>
                
                <?php
                    if(isset($mail->ErrorInfo)) {
                        echo "<p class='error-message'>OTP could not send. Mailer Error: {$mail->ErrorInfo}</p>";
                    }
                ?>
                
                <form action="fp.php" method="post">
                    <label>Email Address</label>
                    <div class="input-box">
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <i class='bx bxs-envelope'></i>
                    </div>
                    <button type="submit" name="submit">Send OTP</button>
                    <div class="links">
                        <a href="fp.php">Refresh</a>
                        <a href="slogin.php">Back to Login</a>
                    </div>
                </form>
            </div>
            <div class="footer">
                <p>Copyright &copy; MCA Portal 2025</p>
            </div>
        </div>
    </body>
</html>
