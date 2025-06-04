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
        <title>MCA Portal - Suggestions</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

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
                --form-bg: #f9f9f9;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
            }

            body {
                background-color: var(--bg-light);
                color: var(--text-dark);
                line-height: 1.6;
                position: relative;
                min-height: 100vh;
                overflow-x: hidden;
            }

            /* Layout Structure */
            .container {
                display: flex;
                min-height: 100vh;
            }

            /* Sidebar/Navbar Styles - Matching Reference */
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

            /* Main Content Area */
            .main-content {
                flex: 1;
                padding: 20px;
                transition: all var(--transition-speed);
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            /* Header Styles */
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

            /* Action Bar */
            .action-bar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                flex-wrap: wrap;
                gap: 15px;
            }

            .action-button {
                background: var(--primary-color);
                color: var(--white);
                border: none;
                padding: 10px 20px;
                border-radius: 8px;
                font-weight: 500;
                font-size: 14px;
                cursor: pointer;
                transition: all var(--transition-speed);
                display: flex;
                align-items: center;
                gap: 8px;
                text-decoration: none;
            }

            .action-button i {
                font-size: 18px;
            }

            .action-button:hover {
                background: var(--primary-dark);
                transform: translateY(-3px);
                box-shadow: var(--shadow-light);
            }

            /* Suggestion Cards */
            .suggestion-section {
                display: flex;
                flex-direction: column;
                gap: 20px;
                animation: fadeIn 0.8s ease-out forwards;
            }

            .suggestion-card {
                background: var(--white);
                border-radius: 12px;
                padding: 20px;
                box-shadow: var(--shadow-light);
                transition: all var(--transition-speed);
                position: relative;
                overflow: hidden;
                border-left: 4px solid var(--primary-color);
            }

            .suggestion-card:hover {
                transform: translateY(-5px);
                box-shadow: var(--shadow-dark);
            }

            .suggestion-header {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 12px;
            }

            .user-avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: var(--primary-light);
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                color: var(--primary-color);
                font-size: 16px;
            }

            .user-name {
                font-weight: 600;
                color: var(--text-dark);
                font-size: 16px;
            }

            .suggestion-content {
                padding: 10px 0;
                color: var(--text-dark);
                font-size: 15px;
                line-height: 1.6;
                margin-bottom: 15px;
            }

            .suggestion-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                color: var(--text-light);
                font-size: 13px;
            }

            .suggestion-time {
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .suggestion-time i {
                font-size: 16px;
            }

            .like-button {
                background: var(--primary-light);
                color: var(--primary-color);
                border: none;
                padding: 6px 15px;
                border-radius: 50px;
                font-weight: 500;
                font-size: 14px;
                cursor: pointer;
                transition: all var(--transition-speed);
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .like-button i {
                font-size: 16px;
            }

            .like-button:hover {
                background: var(--primary-color);
                color: var(--white);
                transform: translateY(-2px);
            }

            .like-count {
                font-weight: 600;
            }

            /* Empty State */
            .empty-state {
                text-align: center;
                padding: 40px 20px;
                background: var(--white);
                border-radius: 12px;
                box-shadow: var(--shadow-light);
                animation: fadeIn 0.8s ease-out forwards;
            }

            .empty-state i {
                font-size: 60px;
                display: block;
                margin-bottom: 20px;
                color: #ddd;
            }

            /* Error Message */
            .error {
                background: #f8d7da;
                color: #721c24;
                padding: 15px;
                border-radius: 8px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 500;
            }

            /* Footer */
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

            /* Responsive Styles */
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
                
                .suggestion-card {
                    padding: 15px;
                }
                
                .action-bar {
                    flex-direction: column;
                    align-items: flex-start;
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
            <!-- Sidebar/Navbar - Matching Reference Design -->
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
                            <a href="suggestion.php" class="active-link">
                                <i class='bx bxs-message-rounded-dots'></i> Suggestions
                            </a>
                        </button>
                    </ul>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="main-content">
                <!-- Header -->
                <div class="header">
                    <h1>View User Suggestions</h1>
                </div>
                
                <!-- Action Bar -->
                <div class="action-bar">
                    <a href="comment.php" class="action-button">
                        <i class='bx bxs-message-add'></i> Send Suggestion
                    </a>
                    <a href="mhome.php" class="action-button">
                        <i class='bx bxs-home'></i> Back to Home
                    </a>
                </div>
                
                <!-- Suggestion Section -->
                <div class="suggestion-section">
                    <?php
                        $sql="SELECT user.UNAME,comment.COMM,comment.LOGS,comment.CID FROM comment INNER JOIN user on comment.UID=user.UID ORDER BY comment.CID DESC";
                        $res=$db->query($sql);
                        if($res->num_rows>0)
                        {
                            while($row=$res->fetch_assoc())
                            {
                                $cid = $row["CID"];
                                $lsql = "SELECT COUNT(*) as lc FROM `like` WHERE CID = $cid";
                                $lr = $db->query($lsql);
                                $lrow = $lr->fetch_assoc();
                                $lc = $lrow['lc'];
                                $username = $row["UNAME"];
                                $initial = substr($username, 0, 1);
                                
                                echo "<div class='suggestion-card'>";
                                echo "<div class='suggestion-header'>";
                                echo "<div class='user-avatar'>{$initial}</div>";
                                echo "<div class='user-name'>{$username}</div>";
                                echo "</div>";
                                
                                echo "<div class='suggestion-content'>{$row["COMM"]}</div>";
                                
                                echo "<div class='suggestion-footer'>";
                                echo "<div class='suggestion-time'><i class='bx bxs-time'></i> {$row["LOGS"]}</div>";
                                
                                echo "<form method='post' action='like.php'>";
                                echo "<input type='hidden' name='cid' value='{$cid}'>";
                                echo "<button type='submit' class='like-button'><i class='bx bxs-like'></i> Like <span class='like-count'>{$lc}</span></button>";
                                echo "</form>";
                                
                                echo "</div>";
                                echo "</div>";
                            }
                        }
                        else
                        {
                            echo "<div class='empty-state'>
                                <i class='bx bxs-message-x'></i>
                                <p class='error'>No Comment Yet...</p>
                                <p>Be the first to share your suggestion!</p>
                            </div>";
                        }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?></p>
        </div>
        
        <script>
            // Add animation to suggestion cards
            document.addEventListener('DOMContentLoaded', function() {
                const cards = document.querySelectorAll('.suggestion-card');
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.style.animation = `fadeIn 0.5s ease-out forwards`;
                    }, 100 * index);
                });
            });
        </script>
    </body>
</html>
