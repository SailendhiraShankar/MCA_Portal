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
        <title>MCA Portal - View Documents</title>
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
                content: '\eb24';
            }

            .navbar nav ul button:nth-child(2) a::before {
                content: '\eb7b';
            }

            .navbar nav ul button:nth-child(3) a::before {
                content: '\eb2d';
            }

            .navbar nav ul button:nth-child(4) a::before {
                content: '\eb8c';
            }

            .navbar nav ul button:nth-child(5) a::before {
                content: '\ebec';
                color: var(--accent-color);
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

            .navbar nav ul button:last-child a {
                color: var(--accent-color);
            }

            /* Main Content Area */
            .main {
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
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 15px;
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
                margin: 0;
            }

            .page-header .actions {
                display: flex;
                gap: 10px;
                position: relative;
                z-index: 1;
            }

            .page-header a {
                background: rgba(255, 255, 255, 0.2);
                color: var(--white);
                text-decoration: none;
                padding: 10px 20px;
                border-radius: 8px;
                font-weight: 500;
                font-size: 15px;
                transition: all var(--transition-speed) ease;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .page-header a:hover {
                background: rgba(255, 255, 255, 0.3);
                transform: translateY(-3px);
            }

            .page-header a.a1 {
                background: rgba(255, 255, 255, 0.15);
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

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(15px); }
                to { opacity: 1; transform: translateY(0); }
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
                font-weight: 600;
                font-size: 16px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            table th:first-child {
                border-top-left-radius: 10px;
            }

            table th:last-child {
                border-top-right-radius: 10px;
            }

            table td {
                padding: 15px;
                border-bottom: 1px solid #eee;
                font-size: 15px;
                color: var(--text-dark);
            }

            table tr:last-child td {
                border-bottom: none;
            }

            table tr:nth-child(even) {
                background-color: var(--bg-light);
            }

            table tr:hover {
                background-color: var(--primary-light);
            }

            /* Button Styles */
            table button {
                background: var(--primary-color);
                color: var(--white);
                border: none;
                padding: 8px 15px;
                border-radius: 6px;
                font-weight: 500;
                font-size: 14px;
                cursor: pointer;
                transition: all var(--transition-speed) ease;
            }

            table button:hover {
                background: var(--primary-dark);
                transform: translateY(-2px);
                box-shadow: 0 3px 10px rgba(116, 148, 236, 0.3);
            }

            table button a {
                color: var(--white);
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 5px;
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
                color: #ff5252;
                text-decoration: underline;
            }

            /* Error Message */
            .error {
                background: rgba(255, 71, 87, 0.1);
                color: var(--error-color);
                padding: 20px;
                border-radius: 8px;
                margin: 20px 0;
                text-align: center;
                font-weight: 500;
                border-left: 4px solid var(--error-color);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
            }

            .error i {
                font-size: 24px;
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
                
                .main {
                    margin-left: 220px;
                    width: calc(100% - 220px);
                    padding: 25px;
                }
                
                .footer {
                    margin-left: 220px;
                    width: calc(100% - 250px);
                }
                
                table th, table td {
                    padding: 12px 10px;
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
                
                .main {
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
                
                .content {
                    padding: 20px;
                }
                
                .page-header {
                    flex-direction: column;
                    align-items: center;
                    padding: 20px;
                }
                
                .page-header .actions {
                    width: 100%;
                    justify-content: center;
                }
            }

            @media screen and (max-width: 576px) {
                .content {
                    padding: 15px;
                    overflow-x: auto;
                }
                
                table {
                    min-width: 500px;
                }
                
                .page-header h1 {
                    font-size: 24px;
                }
                
                .page-header a {
                    padding: 8px 15px;
                    font-size: 14px;
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
        </style>
    </head>
    <body>
        <!-- Mobile Menu Toggle Button -->
        <div class="menu-toggle">
            <i class='bx bx-menu'></i>
        </div>
        
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
                            <a href="supload_documents.php">Store Documents</a>
                        </button>
                        <button class="active">
                            <a href="sview_documents.php">View Documents</a>
                        </button>
                        <button>
                            <a href="smhome.php">Staff Portal</a>
                        </button>
                        <button>
                            <a href="schangepass.php">Change Password</a>
                        </button>
                        <button>
                            <a href="logout.php">Logout</a>
                        </button>
                    </ul>
                </nav>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main">
            <!-- Header Section -->
            <div class="page-header">
                <h1>View Documents</h1>
                <div class="actions">
                    <a href="search_books.php"><i class='bx bx-search'></i> Search Documents</a>
                    <a class="a1" href='shome.php'><i class='bx bx-home'></i> Home</a>
                </div>
            </div>
            
            <!-- Content Section -->
            <div class="content">
                <?php
                    $sql="SELECT * FROM sdocuments WHERE SID={$_SESSION["ID"]}";
                    $res=$db->query($sql);
                    if($res->num_rows>0)
                    {
                       echo"<table>
                       <tr>
                       <th>SNO</th>
                       <th>TITLE</th>
                       <th>KEYWORDS</th>
                       <th>VIEW</th>
                       <th>DELETE</th>
                       </tr>
                    ";
                    $i=0;
                    while($row=$res->fetch_assoc())
                    {
                       $i++;
                       echo"<tr>";
                       echo"<td>{$i}</td>";
                       echo"<td>{$row["BTITLE"]}</td>";
                       echo"<td>{$row["KEYWORD"]}</td>";
                       echo"<td><button><a href='{$row["FILE"]}' target='_blank'><i class='bx bx-file'></i> View</a></button></td>";
                       echo"<td><a href='delete.php?id={$row["BID"]}'><i class='bx bx-trash'></i> Delete</a></td>";
                       echo"</tr>";
                    }
                    echo"</table>";
                    }
                    else
                    {
                        echo"<p class='error'><i class='bx bx-error-circle'></i> No Documents Found</p>";
                    }
                ?>
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
        </script>
    </body>
</html>
