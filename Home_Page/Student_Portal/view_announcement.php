<?php
    session_start();
    include"database.php";
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
        
        .content {
            background: var(--white);
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--shadow-light);
            margin-bottom: 30px;
            flex: 1;
        }
        
        .announcement {
            border-left: 4px solid var(--primary-color);
            padding: 20px;
            margin-bottom: 25px;
            background: var(--white);
            border-radius: 0 15px 15px 0;
            box-shadow: var(--shadow-light);
            transition: all var(--transition-speed);
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .announcement:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-dark);
        }
        
        .announcement:nth-child(even) {
            border-left: 4px solid var(--accent-color);
        }
        
        .announcement-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .staff-name {
            font-size: 1.2rem;
            color: var(--primary-dark);
            font-weight: 600;
        }
        
        .timestamp {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .section-title {
            font-size: 1.1rem;
            color: var(--text-dark);
            margin: 15px 0 10px 0;
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 8px;
            color: var(--primary-color);
        }
        
        .document-section {
            background: var(--primary-light);
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
        }
        
        .view-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 15px;
            cursor: pointer;
            transition: all var(--transition-speed);
            font-weight: 500;
        }
        
        .view-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .view-btn a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        
        .view-btn i {
            margin-right: 5px;
        }
        
        .message-section {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            line-height: 1.8;
        }
        
        .error {
            text-align: center;
            padding: 50px 0;
            color: var(--text-light);
            font-size: 1.2rem;
        }
        
        .error i {
            font-size: 3rem;
            color: var(--accent-color);
            margin-bottom: 15px;
            display: block;
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
            
            .announcement-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .timestamp {
                margin-top: 5px;
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
                            <a href="view_announcement.php" class="active-link">
                                <i class='bx bxs-megaphone'></i> Announcements
                            </a>
                        </button>
                        <button>
                            <a href="contest.php">
                                <i class='bx bxs-trophy'></i> Contests
                            </a>
                        </button>
                        <button>
                            <a href="odapply.php">
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
                    <h1>View Announcements</h1>
                </div>
                
                <div class="content">
                <?php
                    try {
                        $sql="SELECT staff.SNAME,announcement.MESSAGE,announcement.FILE,announcement.LOGS FROM announcement INNER JOIN staff on announcement.SID=staff.SID ORDER BY announcement.AID DESC";
                        $res=$db->query($sql);
                        if($res->num_rows>0)
                        {
                            while($row=$res->fetch_assoc())
                            {
                                echo '<div class="announcement">';
                                echo '<div class="announcement-header">';
                                echo '<div class="staff-name">' . $row["SNAME"] . '</div>';
                                echo '<div class="timestamp">' . $row["LOGS"] . '</div>';
                                echo '</div>';
                                
                                echo '<div class="section-title"><i class="bx bxs-file-doc"></i>Documents</div>';
                                echo '<div class="document-section">';
                                if(!empty($row["FILE"]))
                                {
                                    echo '<button class="view-btn"><a href="' . $row["FILE"] . '" target="_blank"><i class="bx bx-file"></i>View Document</a></button>';
                                }
                                else
                                {
                                    echo '<p>No Document Attached</p>';
                                }
                                echo '</div>';
                                
                                echo '<div class="section-title"><i class="bx bxs-message-detail"></i>Announcement Message</div>';
                                echo '<div class="message-section">';
                                echo '<p>' . $row["MESSAGE"] . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        else
                        {
                            echo '<div class="error">';
                            echo '<i class="bx bx-message-x"></i>';
                            echo 'No Announcements Yet...';
                            echo '</div>';
                        }
                    } catch (Exception $e) {
                        echo '<div class="error">';
                        echo '<i class="bx bx-error-circle"></i>';
                        echo 'Unable to load announcements. Please try again later.';
                        echo '</div>';
                    }
                ?>
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
