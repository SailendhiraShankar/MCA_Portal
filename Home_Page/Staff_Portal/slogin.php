<?php
    // Start output buffering to prevent "headers already sent" error
    ob_start();
    
    session_start();
    include "database.php";
    
    // Initialize variables
    $error_message = "";
    $success_message = "";
    
    // Process login form submission
    if(isset($_POST["submit"]))
    {
        $sql = "SELECT * FROM staff WHERE SNAME='" . $_POST["name"] . "' AND SPASS='" . $_POST["pass"] . "'";
        $res = $db->query($sql);
        
        if($res->num_rows > 0)
        {
            $row = $res->fetch_assoc();
            $_SESSION["ID"] = $row["SID"];
            $_SESSION["NAME"] = $row["SNAME"];
            
            // Set success message
            $success_message = "Login successful! Redirecting...";
            
            // Use JavaScript for redirection after showing the message
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'shome.php';
                }, 1500);
            </script>";
        }
        else
        {
            $error_message = "Invalid username or password. Please try again.";
        }
    }
?>
<!DOCTYPE HTML>
<html>
      <head>
            <title>MCA Portal - Staff Login</title>
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
                    width: 850px;
                    height: 550px;
                    background: #fff;
                    margin: 20px;
                    border-radius: 40px;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, .2);
                    overflow: hidden;
                    display: flex;
                }

                .left-panel {
                    width: 50%;
                    height: 100%;
                    background: #7494ec;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    color: #fff;
                    padding: 40px;
                    text-align: center;
                    position: relative;
                    overflow: hidden;
                    border-radius: 30px 0 0 30px;
                }

                .left-panel::before {
                    content: '';
                    position: absolute;
                    top: -50%;
                    left: -50%;
                    width: 200%;
                    height: 200%;
                    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 60%);
                    animation: pulse 15s infinite linear;
                }

                @keyframes pulse {
                    0% {
                        transform: translate(0, 0) scale(1);
                    }
                    50% {
                        transform: translate(-10%, -10%) scale(1.1);
                    }
                    100% {
                        transform: translate(0, 0) scale(1);
                    }
                }

                .left-panel h1 {
                    font-size: 36px;
                    margin-bottom: 20px;
                    position: relative;
                    z-index: 1;
                }

                .left-panel p {
                    font-size: 16px;
                    margin-bottom: 30px;
                    line-height: 1.6;
                    position: relative;
                    z-index: 1;
                }

                .left-panel .btn {
                    width: 160px;
                    height: 46px;
                    background: transparent;
                    border: 2px solid #fff;
                    border-radius: 15px;
                    color: #fff;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    position: relative;
                    z-index: 1;
                }

                .left-panel .btn:hover {
                    background: rgba(255, 255, 255, 0.2);
                    transform: translateY(-2px);
                }

                .staff-icon {
                    font-size: 80px;
                    margin-bottom: 20px;
                    color: rgba(255, 255, 255, 0.9);
                    position: relative;
                    z-index: 1;
                }

                .right-panel {
                    width: 50%;
                    height: 100%;
                    background: #fff;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    padding: 40px;
                    border-radius: 0 30px 30px 0;
                }

                .right-panel h1 {
                    font-size: 32px;
                    margin-bottom: 30px;
                    color: #7494ec;
                    position: relative;
                }

                .right-panel h1::after {
                    content: '';
                    position: absolute;
                    bottom: -10px;
                    left: 50%;
                    transform: translateX(-50%);
                    width: 50px;
                    height: 3px;
                    background: #7494ec;
                    border-radius: 3px;
                }

                form {
                    width: 100%;
                }

                .input-box {
                    position: relative;
                    margin: 30px 0;
                }

                .input-box input {
                    width: 100%;
                    padding: 13px 50px 13px 20px;
                    background: #f5f5f5;
                    border-radius: 15px;
                    border: 1px solid #e0e0e0;
                    outline: none;
                    font-size: 16px;
                    color: #333;
                    font-weight: 500;
                    transition: all 0.3s ease;
                }

                .input-box input:focus {
                    border-color: #7494ec;
                    box-shadow: 0 0 0 2px rgba(116, 148, 236, 0.1);
                }

                .input-box input::placeholder {
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

                .links {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 20px;
                    font-size: 14.5px;
                }

                .links a {
                    color: #7494ec;
                    transition: all 0.3s ease;
                }

                .links a:hover {
                    color: #5a7bd6;
                    text-decoration: underline;
                }

                .btn {
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
                }

                .btn::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: -100%;
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                    transition: all 0.5s ease;
                }

                .btn:hover {
                    background: #5a7bd6;
                    transform: translateY(-2px);
                }

                .btn:hover::before {
                    left: 100%;
                }

                .error-message {
                    background-color: rgba(255, 51, 51, 0.1);
                    color: #ff3333;
                    padding: 10px;
                    border-radius: 15px;
                    margin-bottom: 20px;
                    text-align: center;
                    border-left: 4px solid #ff3333;
                    animation: shake 0.5s ease-in-out;
                }

                .success-message {
                    background-color: rgba(76, 175, 80, 0.1);
                    color: #4CAF50;
                    padding: 10px;
                    border-radius: 15px;
                    margin-bottom: 20px;
                    text-align: center;
                    border-left: 4px solid #4CAF50;
                    animation: fadeIn 0.5s ease-in-out;
                }

                @keyframes shake {
                    0%, 100% { transform: translateX(0); }
                    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                    20%, 40%, 60%, 80% { transform: translateX(5px); }
                }

                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(-10px); }
                    to { opacity: 1; transform: translateY(0); }
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

                @media screen and (max-width: 768px) {
                    .container {
                        flex-direction: column;
                        height: auto;
                    }

                    .left-panel, .right-panel {
                        width: 100%;
                        padding: 30px;
                    }

                    .left-panel {
                        order: 2;
                        padding: 40px 30px;
                        border-radius: 0 0 30px 30px;
                    }

                    .right-panel {
                        order: 1;
                        border-radius: 30px 30px 0 0;
                    }
                }

                @media screen and (max-width: 400px) {
                    .container {
                        margin: 10px;
                    }

                    .left-panel, .right-panel {
                        padding: 20px;
                    }

                    .left-panel h1, .right-panel h1 {
                        font-size: 28px;
                    }

                    .links {
                        flex-direction: column;
                        gap: 10px;
                        align-items: center;
                    }
                }

                /* Animation */
                .right-panel {
                    animation: fadeIn 0.5s ease-out forwards;
                }

                .floating {
                    animation: floating 3s ease-in-out infinite;
                }

                @keyframes floating {
                    0% { transform: translateY(0px); }
                    50% { transform: translateY(-10px); }
                    100% { transform: translateY(0px); }
                }
            </style> 
      </head>
      <body>
            <div class="container">
                <div class="left-panel">
                    <i class='bx bxs-chalkboard staff-icon floating'></i>
                    <h1>Staff Portal</h1>
                    <p>Access administrative tools, manage student documents, and publish announcements through our secure staff portal.</p>
                    <button class="btn" onclick="location.href='../index.php'">Back to Home</button>
                </div>
                <div class="right-panel">
                    <h1>Staff Login</h1>
                    
                    <?php if(!empty($error_message)): ?>
                        <div class="error-message"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    
                    <?php if(!empty($success_message)): ?>
                        <div class="success-message"><?php echo $success_message; ?></div>
                    <?php endif; ?>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="input-box">
                            <input type="text" name="name" placeholder="Staff Name" required>
                            <i class='bx bxs-user'></i>
                        </div>
                        <div class="input-box">
                            <input type="password" name="pass" placeholder="Password" required>
                            <i class='bx bxs-lock-alt'></i>
                        </div>
                        <div class="links">
                            <a href="../index.php">Home</a>
                            <a href="fp.php">Forgot Password?</a>
                            <a href="slogin.php">Refresh</a>
                        </div>
                        <button type="submit" name="submit" class="btn">Login</button>
                    </form>
                </div>
            </div>
            <div class="footer">
                <p>Copyright &copy; MCA Portal 2025</p>
            </div>
      </body>
</html>
<?php
    // Flush the output buffer and send output to browser
    ob_end_flush();
?>
