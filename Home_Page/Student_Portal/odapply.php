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
        <title>MCA Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <style>
        :root {
            --primary-color: #7494ec;
            --primary-light: rgba(116, 148, 236, 0.1);
            --primary-dark: #5a7ad0;
            --accent-color: #ff6b6b;
            --text-dark: #333;
            --text-light: #777;
            --white: #ffffff;
            --shadow-light: 0 5px 15px rgba(0, 0, 0, 0.05);
            --shadow-dark: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition-speed: 0.3s;
            --form-bg: #f9f9f9;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: var(--text-dark);
            line-height: 1.6;
            position: relative;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Navigation Styles */
        .navbar {
            background: var(--white);
            box-shadow: var(--shadow-light);
            border-radius: 15px;
            padding: 15px;
            margin: 20px;
            position: relative;
            z-index: 10;
            transition: all var(--transition-speed);
            width: 250px;
        }
        
        .navbar nav ul {
            display: flex;
            flex-direction: column;
            gap: 10px;
            list-style: none;
        }
        
        .navbar button {
            background-color: transparent;
            border: none;
            width: 100%;
            text-align: left;
            border-radius: 10px;
            transition: all var(--transition-speed);
            position: relative;
            overflow: hidden;
        }
        
        .navbar button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.5s;
        }
        
        .navbar button:hover::before {
            left: 100%;
        }
        
        .navbar button:hover {
            background-color: var(--primary-light);
            transform: translateY(-3px);
        }
        
        .navbar a {
            color: var(--text-dark);
            text-decoration: none;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: all var(--transition-speed);
        }
        
        .navbar a:hover {
            color: var(--primary-color);
        }
        
        .navbar a i {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        .active-link {
            background-color: var(--primary-light);
            color: var(--primary-color) !important;
            border-left: 4px solid var(--primary-color);
        }
        
        .logo {
            text-align: center;
            padding: 20px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .logo h2 {
            color: var(--primary-color);
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .logo span {
            color: var(--accent-color);
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 20px;
            transition: all var(--transition-speed);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-light);
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
        }
        
        .header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            position: relative;
        }
        
        .center {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow-light);
            margin-bottom: 30px;
            flex: 1;
            animation: fadeIn 0.8s ease-out forwards;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }
        
        /* Form Styles */
        form {
            background: var(--form-bg);
            padding: 30px;
            border-radius: 10px;
            box-shadow: var(--shadow-light);
            transition: all var(--transition-speed);
        }
        
        form:hover {
            box-shadow: var(--shadow-dark);
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
        
        form select, 
        form input[type="date"], 
        form input[type="text"],
        form input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: var(--white);
            color: var(--text-dark);
            font-size: 1rem;
            transition: all var(--transition-speed);
        }
        
        form select:focus, 
        form input[type="date"]:focus, 
        form input[type="text"]:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px var(--primary-light);
            outline: none;
        }
        
        form input[type="file"] {
            padding: 10px;
            background: var(--white);
            cursor: pointer;
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
        
        form a {
            display: inline-block;
            margin-top: 15px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            margin-right: 15px;
            transition: all var(--transition-speed);
        }
        
        form a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }
        
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }
        
        .footer {
            background: var(--white);
            color: var(--text-dark);
            text-align: center;
            padding: 15px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 15px;
            margin: 0 20px 20px 20px;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .container {
                flex-direction: column;
            }
            
            .navbar {
                width: auto;
                margin-bottom: 0;
            }
            
            .navbar nav ul {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .navbar button {
                width: auto;
            }
            
            .logo {
                padding: 10px 0;
                margin-bottom: 10px;
            }
            
            .main-content {
                min-height: auto;
            }
        }
        
        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.8rem;
            }
            
            .navbar nav ul {
                justify-content: space-between;
            }
            
            .navbar a {
                padding: 10px;
            }
            
            .navbar a i {
                margin-right: 5px;
                font-size: 1.2rem;
            }
            
            .center {
                padding: 20px;
            }
            
            form {
                padding: 20px;
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
            <div class="navbar">
                <div class="logo">
                    <h2>MCA <span>Portal</span></h2>
                </div>
                <nav>
                    <ul>
                        <button>
                            <a href="uhome.php">
                                <i class='bx bxs-home'></i> Home
                            </a>
                        </button>
                        <button>
                            <a href="view_announcement.php">
                                <i class='bx bxs-megaphone'></i> Announcements
                            </a>
                        </button>
                        <button>
                            <a href="contest.php">
                                <i class='bx bxs-trophy'></i> Contests
                            </a>
                        </button>
                        <button>
                            <a href="odapply.php" class="active-link">
                                <i class='bx bxs-calendar-check'></i> OD Apply
                            </a>
                        </button>
                        <button>
                            <a href="view_payment.php">
                                <i class='bx bxs-wallet'></i> Payments
                            </a>
                        </button>
                        <button>
                            <a href="suggestion.php">
                                <i class='bx bxs-message-rounded-dots'></i> Suggestions
                            </a>
                        </button>
                    </ul>
                </nav>
            </div>
            
            <div class="main-content">
                <div class="header">
                    <h1>On Duty Application</h1>
                </div>
                
                <div class="center">
                    <?php
                        if(isset($_POST["submit"]))
                        {
                            try {
                                $target_dir = "OD_File/";
                                $target_dir2 = "../Staff_Portal/OD_File/";
                                $fbv = false;
                                $target_file = "";
                                $target_file2 = "";
                                if(!empty($_FILES["efile"]["name"]))
                                {
                                    $target_file = $target_dir.basename($_FILES["efile"]["name"]);
                                    $target_file2 = $target_dir2.basename($_FILES["efile"]["name"]);
                                    if(move_uploaded_file($_FILES["efile"]["tmp_name"],$target_file))
                                    {
                                        if(copy($target_file,$target_file2))
                                        {
                                            $fbv = true;
                                        }
                                        else
                                        {
                                            echo"<p class='error'>Error in Copying File</p>";
                                        }
                                    }
                                    else
                                    {
                                        echo"<p class='error'>Error in File Upload</p>";
                                    }
                                }
                                $staff_id = intval($_POST["sname"]);
                                $period_date = $db->real_escape_string($_POST["pdate"]);
                                $period = $db->real_escape_string($_POST["pnum"]);
                                $message = $db->real_escape_string($_POST["mname"]);
                                $u_name = $_SESSION["NAME"];
                                $sql="INSERT INTO od(SID, UNAME, PERIOD_DATE, PERIOD, MESSAGE, FILE) VALUES ('$staff_id','$u_name','$period_date','$period','$message','$target_file')";
                                if($db->query($sql))
                                {
                                    echo"<p class='success'>OD Application Submitted Successfully</p>";
                                }
                                else 
                                {
                                    echo"<p class='error'>Error in Application Submission</p>";
                                }
                            } catch (Exception $e) {
                                echo"<p class='error'>An error occurred. Please try again.</p>";
                            }
                        }   
                    ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
                        <h3>On Duty Apply</h3>
                        <label>Select Staff:</label>
                        <select name="sname" required>
                            <option value="">Select Staff</option>
                            <?php
                                try {
                                    $sq = "select SID,SNAME from staff";
                                    $sr = $db->query($sq);
                                    if($sr->num_rows > 0)
                                    {
                                        while($row = $sr->fetch_assoc())
                                        {
                                            echo"<option value='{$row['SID']}'>{$row['SNAME']}</option>";
                                        }
                                    }
                                } catch (Exception $e) {
                                    echo"<option value=''>Unable to load staff list</option>";
                                }
                            ?>
                        </select>
                        <label>Period Date:</label>
                        <input type="date" name="pdate" required>
                        <label>Which Period:</label>
                        <input type="text" name="pnum" placeholder="Enter period number(s)" required>
                        <label>Message:</label>
                        <input type="text" name="mname" placeholder="Enter reason for OD" required>
                        <label>Any Proof:</label>
                        <input type="file" name="efile">
                        <button type="submit" name="submit">Apply OD</button>
                        <div style="text-align: center; margin-top: 15px;">
                            <a href="odapply.php"><i class='bx bx-refresh'></i> Refresh</a>
                            <a href='uhome.php'><i class='bx bx-arrow-back'></i> Back to Home</a>
                        </div>
                    </form>      
                </div>
                
                <div class="footer">
                    <p>Copyright &copy; MCA Portal 2025</p>
                </div>
            </div>
       </div>
       
       <script>
           // Add active class to current page link
           document.addEventListener('DOMContentLoaded', function() {
               const currentLocation = location.href;
               const navLinks = document.querySelectorAll('.navbar a');
               
               navLinks.forEach(link => {
                   if(link.href === currentLocation) {
                       link.classList.add('active-link');
                   } else {
                       link.classList.remove('active-link');
                   }
               });
               
               // Add hover effect animation
               const buttons = document.querySelectorAll('.navbar button');
               buttons.forEach(button => {
                   button.addEventListener('mouseover', function() {
                       this.style.transform = 'translateY(-3px)';
                   });
                   
                   button.addEventListener('mouseout', function() {
                       this.style.transform = 'translateY(0)';
                   });
               });
           });
       </script>
    </body>
</html>
