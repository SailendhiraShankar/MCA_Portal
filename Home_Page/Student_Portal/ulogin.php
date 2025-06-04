<?php
    session_start();
    include"database.php";
    ob_start();
    if(isset($_POST["submit"]))
    {
        $sql="SELECT * FROM user where UNAME='{$_POST["name"]}' and UPASS='{$_POST["pass"]}'";
        $res=$db->query($sql);
        if($res->num_rows>0)
        {
            $row=$res->fetch_assoc();
            $_SESSION["ID"]=$row["UID"];
            $_SESSION["NAME"]=$row["UNAME"];
            header("location:uhome.php");
            exit();
        }
        else
        {
            $error = "Invalid Username or Password";
        }
    }
?>

<!DOCTYPE HTML>
<html>
      <head>
            <title>MCA Portal - Student Login</title>
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
                    height: 550px;
                    background: #fff;
                    margin: 20px;
                    border-radius: 30px;
                    box-shadow: 0 0 30px rgba(0, 0, 0, .2);
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
                }

                .left-panel::before {
                    content: '';
                    position: absolute;
                    top: -50%;
                    left: -50%;
                    width: 200%;
                    height: 200%;
                    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
                    background-size: cover;
                    z-index: 0;
                    opacity: 0.1;
                    transform: rotate(-15deg);
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
                    border-radius: 8px;
                    color: #fff;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    position: relative;
                    z-index: 1;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                }

                .left-panel .btn i {
                    font-size: 20px;
                }

                .left-panel .btn:hover {
                    background: rgba(255, 255, 255, 0.2);
                    transform: translateY(-2px);
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
                }

                .right-panel h1 {
                    font-size: 32px;
                    margin-bottom: 30px;
                    color: #333;
                    position: relative;
                }

                .right-panel h1::after {
                    content: '';
                    position: absolute;
                    bottom: -10px;
                    left: 50%;
                    transform: translateX(-50%);
                    width: 50px;
                    height: 4px;
                    background: #7494ec;
                    border-radius: 2px;
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
                    background: #eee;
                    border-radius: 8px;
                    border: none;
                    outline: none;
                    font-size: 16px;
                    color: #333;
                    font-weight: 500;
                    transition: all 0.3s ease;
                }

                .input-box input:focus {
                    background: #e6e6e6;
                    box-shadow: 0 0 5px rgba(116, 148, 236, 0.5);
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

                .forgot-link {
                    text-align: right;
                    margin-bottom: 20px;
                }

                .forgot-link a {
                    color: #7494ec;
                    font-size: 14.5px;
                    transition: all 0.3s ease;
                }

                .forgot-link a:hover {
                    color: #5a7bd6;
                    text-decoration: underline;
                }

                .btn {
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
                }

                .btn:hover {
                    background: #5a7bd6;
                    transform: translateY(-2px);
                }

                .error-message {
                    background-color: rgba(255, 51, 51, 0.1);
                    color: #ff3333;
                    padding: 10px;
                    border-radius: 8px;
                    margin-bottom: 20px;
                    text-align: center;
                    border-left: 4px solid #ff3333;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 8px;
                }

                .error-message::before {
                    content: '\ec80';
                    font-family: 'boxicons';
                    font-size: 20px;
                }

                .additional-links {
                    margin-top: 20px;
                    text-align: center;
                    width: 100%;
                    display: flex;
                    justify-content: center;
                    gap: 15px;
                }

                .additional-links a {
                    color: #7494ec;
                    font-size: 14px;
                    transition: all 0.3s ease;
                }

                .additional-links a:hover {
                    color: #5a7bd6;
                    text-decoration: underline;
                }

                /* Floating shapes for decoration */
                .shape {
                    position: absolute;
                    z-index: 0;
                    opacity: 0.05;
                    background: #fff;
                }

                .shape-1 {
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    top: 20%;
                    left: 10%;
                    animation: float 8s ease-in-out infinite;
                }

                .shape-2 {
                    width: 80px;
                    height: 80px;
                    border-radius: 10px;
                    bottom: 15%;
                    left: 15%;
                    transform: rotate(45deg);
                    animation: float 10s ease-in-out infinite 1s;
                }

                .shape-3 {
                    width: 60px;
                    height: 60px;
                    border-radius: 50%;
                    top: 70%;
                    left: 30%;
                    animation: float 7s ease-in-out infinite 0.5s;
                }

                @keyframes float {
                    0% { transform: translateY(0) rotate(0deg); }
                    50% { transform: translateY(-20px) rotate(5deg); }
                    100% { transform: translateY(0) rotate(0deg); }
                }

                /* Footer */
                .footer {
                    position: absolute;
                    bottom: 10px;
                    left: 0;
                    width: 100%;
                    text-align: center;
                    color: rgba(255, 255, 255, 0.7);
                    font-size: 12px;
                    z-index: 1;
                }

                @media screen and (max-width: 768px) {
                    .container {
                        flex-direction: column;
                        height: auto;
                        max-width: 400px;
                    }

                    .left-panel, .right-panel {
                        width: 100%;
                        padding: 30px;
                    }

                    .left-panel {
                        order: 2;
                        padding: 40px 30px;
                    }

                    .right-panel {
                        order: 1;
                    }

                    .left-panel h1 {
                        font-size: 28px;
                    }

                    .left-panel p {
                        font-size: 14px;
                    }

                    .shape-1, .shape-2, .shape-3 {
                        display: none;
                    }
                }

                @media screen and (max-width: 400px) {
                    .container {
                        margin: 10px;
                        border-radius: 20px;
                    }

                    .left-panel, .right-panel {
                        padding: 20px;
                    }

                    .left-panel h1, .right-panel h1 {
                        font-size: 24px;
                    }

                    .input-box {
                        margin: 20px 0;
                    }

                    .input-box input {
                        padding: 10px 40px 10px 15px;
                        font-size: 14px;
                    }

                    .input-box i {
                        font-size: 18px;
                    }

                    .btn {
                        height: 42px;
                        font-size: 14px;
                    }
                }

                /* Animation */
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(10px); }
                    to { opacity: 1; transform: translateY(0); }
                }

                .right-panel h1 {
                    animation: fadeIn 0.5s ease-out forwards;
                }

                .input-box:nth-child(1) {
                    animation: fadeIn 0.5s ease-out forwards 0.2s;
                    opacity: 0;
                }

                .input-box:nth-child(2) {
                    animation: fadeIn 0.5s ease-out forwards 0.4s;
                    opacity: 0;
                }

                .forgot-link {
                    animation: fadeIn 0.5s ease-out forwards 0.6s;
                    opacity: 0;
                }

                .btn {
                    animation: fadeIn 0.5s ease-out forwards 0.8s;
                    opacity: 0;
                }

                .additional-links {
                    animation: fadeIn 0.5s ease-out forwards 1s;
                    opacity: 0;
                }
            </style> 
      </head>
      <body>
            <div class="container">
                <div class="left-panel">
                    <!-- Decorative shapes -->
                    <div class="shape shape-1"></div>
                    <div class="shape shape-2"></div>
                    <div class="shape shape-3"></div>
                    
                    <h1>Welcome to MCA Portal</h1>
                    <p>Access your academic resources, documents, and more. Don't have an account yet? Register now to get started.</p>
                    <button class="btn" onclick="location.href='new.php'"><i class='bx bx-user-plus'></i>Register</button>
                    
                    <div class="footer">
                        <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?></p>
                    </div>
                </div>
                <div class="right-panel">
                    <h1>Student Login</h1>
                    
                    <?php if(isset($error)) { ?>
                        <div class="error-message"><?php echo $error; ?></div>
                    <?php } ?>
                    
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <div class="input-box">
                            <input type="text" name="name" placeholder="Username" required>
                            <i class='bx bxs-user'></i>
                        </div>
                        <div class="input-box">
                            <input type="password" name="pass" id="password" placeholder="Password" required>
                            <i class='bx bxs-lock-alt' id="togglePassword" style="cursor: pointer;"></i>
                        </div>
                        <div class="forgot-link">
                            <a href="fp.php">Forgot Password?</a>
                        </div>
                        <button type="submit" name="submit" class="btn">Login</button>
                    </form>
                    
                    <div class="additional-links">
                        <a href="../index.php">Back to Home</a>
                        <a href="ulogin.php">Refresh</a>
                    </div>
                </div>
            </div>
            
            <script>
                // Password visibility toggle
                document.getElementById('togglePassword').addEventListener('click', function() {
                    const passwordInput = document.getElementById('password');
                    
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        this.classList.remove('bxs-lock-alt');
                        this.classList.add('bxs-lock-open-alt');
                    } else {
                        passwordInput.type = 'password';
                        this.classList.remove('bxs-lock-open-alt');
                        this.classList.add('bxs-lock-alt');
                    }
                });
                
                // Auto focus on username field
                window.addEventListener('load', function() {
                    document.querySelector('input[name="name"]').focus();
                });
            </script>
      </body>
</html>
