<?php
    session_start();
    include"database.php";
    function countRecord($sql,$db)
    {
        $res=$db->query($sql);
        return $res->num_rows;
    }
    if(!isset($_SESSION["ID"]))
    {
	    header("location:slogin.php");
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>MCA Portal - Payment Announcement</title>
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
                min-height: 100vh;
            }

            /* Sidebar Styles */
            .sidebar {
                width: 250px;
                background: var(--white);
                box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
                display: flex;
                flex-direction: column;
                position: fixed;
                left: 0;
                top: 0;
                height: 100%;
                z-index: 100;
            }

            /* Portal Header */
            .portal-header {
                background: var(--blue-gradient);
                color: var(--white);
                padding: 20px 15px;
                text-align: center;
                font-size: 22px;
                font-weight: 600;
                letter-spacing: 0.5px;
            }

            /* Navigation Menu */
            .navbar {
                flex: 1;
                padding: 20px 15px;
                overflow-y: auto;
            }

            .navbar nav ul {
                list-style: none;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .navbar nav ul button {
                background: none;
                border: none;
                padding: 0;
                width: 100%;
                border-radius: 8px;
                overflow: hidden;
                transition: all var(--transition-speed) ease;
                background: #f9f9f9;
            }

            .navbar nav ul button a {
                display: flex;
                align-items: center;
                padding: 14px 16px;
                color: #444;
                text-decoration: none;
                font-weight: 500;
                font-size: 15px;
                transition: all var(--transition-speed) ease;
                position: relative;
            }

            .navbar nav ul button a::before {
                content: '';
                font-family: 'boxicons';
                margin-right: 10px;
                font-size: 18px;
                color: var(--primary-color);
            }

            .navbar nav ul button:nth-child(1) a::before {
                content: '\ef71'; /* Suggestion icon */
            }

            .navbar nav ul button:nth-child(2) a::before {
                content: '\ed33'; /* Announcement icon */
            }

            .navbar nav ul button:nth-child(3) a::before {
                content: '\eaed'; /* Document/Form icon */
            }

            .navbar nav ul button:nth-child(4) a::before {
                content: '\ef29'; /* Payment icon */
            }

            .navbar nav ul button:nth-child(5) a::before {
                content: '\eb2d'; /* Home icon */
            }

            .navbar nav ul button:hover {
                transform: translateX(5px);
            }

            .navbar nav ul button.active {
                background: #f0f3fa;
                position: relative;
            }

            .navbar nav ul button.active::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                width: 4px;
                background: var(--primary-color);
                border-radius: 0 2px 2px 0;
            }

            .navbar nav ul button.active a {
                color: var(--primary-color);
            }

            /* Main Content Area */
            .main-content {
                margin-left: 250px;
                padding: 30px;
                flex: 1;
                width: calc(100% - 250px);
                display: flex;
                flex-direction: column;
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
                margin-bottom: 30px;
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
            }

            form h3 {
                color: var(--primary-color);
                margin-bottom: 25px;
                font-size: 24px;
                font-weight: 600;
                position: relative;
                display: inline-block;
            }

            form h3::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 0;
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
            }

            form input[type="text"],
            form input[type="number"],
            form input[type="date"] {
                width: 100%;
                padding: 14px 15px;
                margin-bottom: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background: #f9f9f9;
                transition: all var(--transition-speed) ease;
                font-size: 15px;
            }

            form input[type="text"]:focus,
            form input[type="number"]:focus,
            form input[type="date"]:focus {
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
            }

            form button:hover {
                background: var(--primary-dark);
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(116, 148, 236, 0.3);
            }

            form button::before {
                content: '\ef29';
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
            }

            form a:hover {
                background: #e9ecf3;
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            }

            form a:first-of-type::before {
                content: '\eb96';
                font-family: 'boxicons';
                font-size: 18px;
                color: var(--primary-color);
            }

            form a:last-of-type::before {
                content: '\eb49';
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
            }

            .error::before {
                content: '\ec80';
                font-family: 'boxicons';
                font-size: 20px;
            }

            /* Content Section */
            .content {
                background: var(--white);
                padding: 30px;
                border-radius: 15px;
                box-shadow: var(--shadow-light);
                flex: 1;
                position: relative;
                overflow: hidden;
                animation: fadeIn 0.5s ease-out forwards;
            }

            .content h3 {
                color: var(--primary-color);
                margin-bottom: 25px;
                font-size: 24px;
                font-weight: 600;
                position: relative;
                display: inline-block;
            }

            .content h3::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 0;
                width: 60px;
                height: 4px;
                background: var(--primary-color);
                border-radius: 3px;
            }

            /* Table Styles */
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                background: var(--white);
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            }

            table th {
                background: var(--primary-color);
                color: var(--white);
                padding: 15px;
                text-align: left;
                font-weight: 500;
                font-size: 16px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            table tr {
                border-bottom: 1px solid #eee;
                transition: all var(--transition-speed) ease;
            }

            table tr:nth-child(even) {
                background-color: rgba(116, 148, 236, 0.05);
            }

            table tr:hover {
                background-color: rgba(116, 148, 236, 0.1);
            }

            table td {
                padding: 15px;
                vertical-align: middle;
                font-size: 15px;
            }

            table td:nth-child(4) {
                font-weight: 600;
                color: #ff6b6b;
            }

            table td:nth-child(4)::before {
                content: '₹ ';
                font-weight: normal;
            }

            table td:nth-child(6) {
                font-weight: 500;
                color: #ff6b6b;
            }

            table td a {
                color: var(--accent-color);
                text-decoration: none;
                font-weight: 500;
                transition: all var(--transition-speed) ease;
                display: inline-flex;
                align-items: center;
                gap: 5px;
            }

            table td a:hover {
                color: #ff4757;
                text-decoration: underline;
            }

            table td a::before {
                content: '\ec40';
                font-family: 'boxicons';
                font-size: 16px;
            }

            /* Section Header */
            .section-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .section-header h3 {
                margin-bottom: 0;
            }

            .section-header a {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: var(--bg-light);
                color: var(--text-dark);
                text-decoration: none;
                padding: 10px 20px;
                border-radius: 8px;
                font-weight: 500;
                font-size: 15px;
                transition: all var(--transition-speed) ease;
            }

            .section-header a:hover {
                background: #e9ecf3;
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            }

            .section-header a::before {
                content: '\eb49';
                font-family: 'boxicons';
                font-size: 18px;
                color: var(--primary-color);
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
                margin-left: 250px;
                width: calc(100% - 280px);
            }

            /* Mobile Menu Toggle Button */
            .menu-toggle {
                display: none;
                position: fixed;
                top: 15px;
                left: 15px;
                width: 40px;
                height: 40px;
                background: var(--primary-color);
                border-radius: 50%;
                color: var(--white);
                text-align: center;
                line-height: 40px;
                font-size: 20px;
                z-index: 101;
                cursor: pointer;
                box-shadow: 0 3px 10px rgba(116, 148, 236, 0.4);
            }

            /* Responsive Styles */
            @media screen and (max-width: 992px) {
                .sidebar {
                    width: 220px;
                }
                
                .main-content {
                    margin-left: 220px;
                    width: calc(100% - 220px);
                    padding: 25px;
                }
                
                .footer {
                    margin-left: 220px;
                    width: calc(100% - 250px);
                }
            }

            @media screen and (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                    transition: transform var(--transition-speed) ease;
                }
                
                .sidebar.active {
                    transform: translateX(0);
                }
                
                .main-content {
                    margin-left: 0;
                    width: 100%;
                    padding: 20px;
                }
                
                .footer {
                    margin-left: 0;
                    width: calc(100% - 40px);
                    margin: 30px 20px 20px 20px;
                }
                
                .menu-toggle {
                    display: block;
                }
                
                .center, .content {
                    padding: 25px;
                }
                
                .section-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 15px;
                }
                
                table {
                    display: block;
                    overflow-x: auto;
                }
            }

            @media screen and (max-width: 576px) {
                .center, .content {
                    padding: 20px;
                }
                
                form button, form a {
                    width: 100%;
                    margin-right: 0;
                    text-align: center;
                    justify-content: center;
                }
            }

            /* Animation for menu items */
            @keyframes fadeInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
            
            .navbar nav ul button {
                animation: fadeInLeft 0.5s ease forwards;
                opacity: 0;
            }
            
            .navbar nav ul button:nth-child(1) { animation-delay: 0.1s; }
            .navbar nav ul button:nth-child(2) { animation-delay: 0.2s; }
            .navbar nav ul button:nth-child(3) { animation-delay: 0.3s; }
            .navbar nav ul button:nth-child(4) { animation-delay: 0.4s; }
            .navbar nav ul button:nth-child(5) { animation-delay: 0.5s; }
            
            /* Animation for table rows */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            table tr {
                animation: fadeInUp 0.5s ease-out forwards;
                opacity: 0;
            }
            
            table tr:nth-child(1) { animation-delay: 0.1s; }
            table tr:nth-child(2) { animation-delay: 0.2s; }
            table tr:nth-child(3) { animation-delay: 0.3s; }
            table tr:nth-child(4) { animation-delay: 0.4s; }
            table tr:nth-child(5) { animation-delay: 0.5s; }
            table tr:nth-child(6) { animation-delay: 0.6s; }
            table tr:nth-child(7) { animation-delay: 0.7s; }
            table tr:nth-child(8) { animation-delay: 0.8s; }
            table tr:nth-child(9) { animation-delay: 0.9s; }
            table tr:nth-child(10) { animation-delay: 1.0s; }
            
            /* Payment amount highlight */
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.02); }
                100% { transform: scale(1); }
            }
            
            table td:nth-child(4) {
                animation: pulse 2s infinite;
            }
        </style>
    </head>
    <body>
        <!-- Mobile Menu Toggle Button -->
        <div class="menu-toggle">
            <i class='bx bx-menu'></i>
        </div>
        
        <div class="container">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Portal Header -->
                <div class="portal-header">
                    MCA Portal
                </div>
                
                <!-- Navigation Menu -->
                <div class="navbar">
                    <nav>
                        <ul>
                            <button>
                                <a href="suggestion.php">Suggestion</a>
                            </button>
                            <button>
                                <a href="announcement.php">Announcement</a>
                            </button>
                            <button>
                                <a href="viewod.php">View OD Form</a>
                            </button>
                            <button class="active">
                                <a href="payment_announcement.php">Payment Info</a>
                            </button>
                            <button>
                                <a href="shome.php">Home</a>
                            </button>
                        </ul>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="main-content">
                <!-- Header Section -->
                <div class="page-header">
                    <h1>Payment Announcements</h1>
                </div>
                
                <!-- Post Payment Form -->
                <div class="center">
                    <?php
                        if(isset($_POST["submit"]))
                        {
                            $sql="INSERT INTO pannouncement(SID,TITLE,MESSAGE,AMOUNT,DATE,DUE_DATE) VALUES ({$_SESSION["ID"]},'{$_POST["tname"]}','{$_POST["mname"]}','{$_POST["amount"]}',now(),'{$_POST["addate"]}')";
                            if($db->query($sql))
                            {
                                echo"<p class='success'>Payment Posted</p>";
                            }
                            else 
                            {
                                echo"<p class='error'>Error in Post</p>";
                            }
                        }   
                    ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
                        <h3>Payment Announcement for Students</h3>
                        <label>Payment Title:</label>
                        <input type="text" name="tname" required placeholder="Enter payment title">
                        <label>Message:</label>
                        <input type="text" name="mname" required placeholder="Enter payment details">
                        <label>Amount:</label>
                        <input type="number" name="amount" required placeholder="Enter amount in rupees">
                        <label>Due Date:</label>
                        <input type="date" name="addate" required>
                        <button type="submit" name="submit">Post Payment</button>
                        <a href="payment_announcement.php">Refresh</a>
                        <a href='smhome.php'>Back</a>
                    </form>      
                </div>
                
                <!-- View Payments Section -->
                <div class="content">
                    <div class="section-header">
                        <h3>View Payments</h3>
                        <a href='smhome.php'>Back to Home</a>
                    </div>
                    
                    <?php
                        $sql="SELECT * FROM pannouncement WHERE SID={$_SESSION["ID"]}";
                        $res=$db->query($sql);
                        if($res->num_rows>0)
                        {
                           echo"<table>
                           <tr>
                           <th>SNO</th>
                           <th>PAYMENT TITLE</th>
                           <th>MESSAGE</th>
                           <th>AMOUNT</th>
                           <th>DATE POSTED</th>
                           <th>DUE DATE</th>
                           <th>DELETE</th>
                           </tr>
                        ";
                        $i=0;
                        while($row=$res->fetch_assoc())
                        {
                           $i++;
                           echo"<tr>";
                           echo"<td>{$i}</td>";
                           echo"<td>{$row["TITLE"]}</td>";
                           echo"<td>{$row["MESSAGE"]}</td>";
                           echo"<td>{$row["AMOUNT"]}</td>";
                           echo"<td>{$row["DATE"]}</td>";
                           echo"<td>{$row["DUE_DATE"]}</td>";
                           echo"<td><a href='delete3.php?id={$row["PID"]}'>Delete</a></td>";
                           echo"</tr>";
                        }
                        echo"</table>";
                        }
                        else
                        {
                            echo"<p class='error'>No Payment Announcements Found</p>";
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
            // Mobile sidebar toggle
            document.querySelector('.menu-toggle').addEventListener('click', function() {
                document.querySelector('.sidebar').classList.toggle('active');
                
                // Change icon based on sidebar state
                const icon = this.querySelector('i');
                if (icon.classList.contains('bx-menu')) {
                    icon.classList.remove('bx-menu');
                    icon.classList.add('bx-x');
                } else {
                    icon.classList.remove('bx-x');
                    icon.classList.add('bx-menu');
                }
            });
            
            // Close sidebar when clicking outside (mobile)
            document.addEventListener('click', function(event) {
                const sidebar = document.querySelector('.sidebar');
                const menuToggle = document.querySelector('.menu-toggle');
                
                if (!sidebar.contains(event.target) && 
                    !menuToggle.contains(event.target) && 
                    sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    
                    const icon = menuToggle.querySelector('i');
                    icon.classList.remove('bx-x');
                    icon.classList.add('bx-menu');
                }
            });
            
            // Set minimum date for due date field
            document.addEventListener('DOMContentLoaded', function() {
                const dateInput = document.querySelector('input[type="date"]');
                if (dateInput) {
                    const today = new Date();
                    const yyyy = today.getFullYear();
                    let mm = today.getMonth() + 1;
                    let dd = today.getDate();
                    
                    if (dd < 10) dd = '0' + dd;
                    if (mm < 10) mm = '0' + mm;
                    
                    const formattedToday = yyyy + '-' + mm + '-' + dd;
                    dateInput.setAttribute('min', formattedToday);
                }
            });
        </script>
    </body>
</html>
