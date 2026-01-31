<?php
session_start();
include "database.php";
function countRecord($sql, $db)
{
    $res = $db->query($sql);
    return $res->num_rows;
}
if (!isset($_SESSION["ID"])) {
    header("location:ulogin.php");
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
            content: '\eb25';
            /* Store Documents icon */
        }

        .navbar nav ul button:nth-child(2) a::before {
            content: '\eb7b';
            /* View Documents icon */
        }

        .navbar nav ul button:nth-child(3) a::before {
            content: '\eb2d';
            /* Student Portal icon */
        }

        .navbar nav ul button:nth-child(4) a::before {
            content: '\eb8c';
            /* Change Password icon */
        }

        .navbar nav ul button:nth-child(5) a::before {
            content: '\ebec';
            /* Logout icon */
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

        /* User Profile Section */
        .user-profile {
            padding: 15px;
            border-top: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 10px;
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

        .user-info {
            flex: 1;
            overflow: hidden;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 12px;
            color: var(--text-light);
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

        /* Page Header */
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

        /* Action Bar */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--white);
            color: var(--text-dark);
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 15px;
            transition: all var(--transition-speed) ease;
            box-shadow: var(--shadow-light);
        }

        .action-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .action-button.primary {
            background: var(--primary-color);
            color: var(--white);
        }

        .action-button.primary:hover {
            background: var(--primary-dark);
        }

        .action-button::before {
            font-family: 'boxicons';
            font-size: 18px;
        }

        .action-button.search::before {
            content: '\eb2e';
            color: var(--primary-color);
        }

        .action-button.home::before {
            content: '\eb2d';
            color: var(--primary-color);
        }

        .action-button.primary::before {
            color: var(--white);
        }

        /* Documents Table */
        .documents-section {
            background: var(--white);
            padding: 25px;
            border-radius: 15px;
            box-shadow: var(--shadow-light);
            overflow: hidden;
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th {
            background: var(--primary-light);
            color: var(--primary-dark);
            font-weight: 600;
            text-align: left;
            padding: 15px;
            font-size: 15px;
            border-bottom: 2px solid var(--primary-color);
        }

        table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: var(--text-dark);
            vertical-align: middle;
        }

        table tr:nth-child(even) {
            background-color: rgba(249, 250, 252, 0.7);
        }

        table tr:hover {
            background-color: var(--primary-light);
        }

        table tr:last-child td {
            border-bottom: none;
        }

        /* Table Action Buttons */
        table .view-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            background: var(--primary-light);
            color: var(--primary-color);
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
        }

        table .view-btn:hover {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-2px);
        }

        table .view-btn a {
            color: inherit;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        table .view-btn a::before {
            content: '\eb10';
            font-family: 'boxicons';
            font-size: 16px;
        }

        table .delete-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            background: rgba(255, 107, 107, 0.1);
            color: var(--accent-color);
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            text-decoration: none;
        }

        table .delete-btn:hover {
            background: var(--accent-color);
            color: var(--white);
            transform: translateY(-2px);
        }

        table .delete-btn::before {
            content: '\ebac';
            font-family: 'boxicons';
            font-size: 16px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-light);
        }

        .empty-state::before {
            content: '\eb7b';
            font-family: 'boxicons';
            font-size: 60px;
            display: block;
            margin-bottom: 20px;
            color: #ddd;
        }

        /* Error Message */
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
        }

        .error::before {
            content: '\ec80';
            font-family: 'boxicons';
            font-size: 20px;
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

            .action-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .action-buttons {
                width: 100%;
            }

            .action-button {
                flex: 1;
                justify-content: center;
            }

            table th,
            table td {
                padding: 12px 10px;
            }
        }

        @media screen and (max-width: 480px) {
            .main-content {
                padding: 15px;
            }

            .page-header {
                padding: 20px;
            }

            .page-header h1 {
                font-size: 24px;
            }

            .documents-section {
                padding: 15px;
            }

            table th,
            table td {
                padding: 10px 8px;
                font-size: 13px;
            }

            table .view-btn,
            table .delete-btn {
                padding: 6px 10px;
                font-size: 12px;
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

        .navbar nav ul button:nth-child(1) {
            animation-delay: 0.1s;
        }

        .navbar nav ul button:nth-child(2) {
            animation-delay: 0.2s;
        }

        .navbar nav ul button:nth-child(3) {
            animation-delay: 0.3s;
        }

        .navbar nav ul button:nth-child(4) {
            animation-delay: 0.4s;
        }

        .navbar nav ul button:nth-child(5) {
            animation-delay: 0.5s;
        }

        /* Table row animation */
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
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }

        table tr:nth-child(1) {
            animation-delay: 0.1s;
        }

        table tr:nth-child(2) {
            animation-delay: 0.2s;
        }

        table tr:nth-child(3) {
            animation-delay: 0.3s;
        }

        table tr:nth-child(4) {
            animation-delay: 0.4s;
        }

        table tr:nth-child(5) {
            animation-delay: 0.5s;
        }

        table tr:nth-child(6) {
            animation-delay: 0.6s;
        }

        table tr:nth-child(7) {
            animation-delay: 0.7s;
        }

        table tr:nth-child(8) {
            animation-delay: 0.8s;
        }

        table tr:nth-child(9) {
            animation-delay: 0.9s;
        }

        table tr:nth-child(10) {
            animation-delay: 1.0s;
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
                            <a href="upload_documents.php">Store Documents</a>
                        </button>
                        <button class="active">
                            <a href="view_documents.php">View Documents</a>
                        </button>
                        <button>
                            <a href="uhome.php">Student Portal</a>
                        </button>
                        <button>
                            <a href="uchangepass.php">Change Password</a>
                        </button>
                        <button>
                            <a href="logout.php">Logout</a>
                        </button>
                    </ul>
                </nav>
            </div>

            <!-- User Profile Section -->
            <div class="user-profile">
                <div class="user-avatar">
                    <?php echo substr($_SESSION["NAME"], 0, 1); ?>
                </div>
                <div class="user-info">
                    <div class="user-name"><?php echo $_SESSION["NAME"]; ?></div>
                    <div class="user-role">Student</div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <h1>View Documents</h1>
            </div>

            <!-- Action Bar -->
            <div class="action-bar">
                <div class="action-buttons">
                    <a href="search_books.php" class="action-button search">Search Documents</a>
                    <a href="uhome.php" class="action-button home">Back to Home</a>
                </div>
            </div>

            <!-- Documents Table Section -->
            <div class="documents-section">
                <div class="table-container">
                    <?php
                    $sql = "SELECT * FROM udocuments WHERE UID={$_SESSION["ID"]}";
                    $res = $db->query($sql);
                    if ($res->num_rows > 0) {
                        echo "<table>
                                <tr>
                                <th>SNO</th>
                                <th>TITLE</th>
                                <th>KEYWORDS</th>
                                <th>VIEW</th>
                                <th>DELETE</th>
                                </tr>
                            ";
                        $i = 0;
                        while ($row = $res->fetch_assoc()) {
                            $i++;
                            echo "<tr>";
                            echo "<td>{$i}</td>";
                            echo "<td>{$row["BTITLE"]}</td>";
                            echo "<td>{$row["KEYWORD"]}</td>";
                            echo "<td><button class='view-btn'><a href='{$row["FILE"]}' target='_blank'>View</a></button></td>";
                            echo "<td><a href='delete.php?id={$row["BID"]}' class='delete-btn'>Delete</a></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<div class='empty-state'>
                                    <p class='error'>No Documents Found</p>
                                    <p>You haven't uploaded any documents yet. Start by uploading your first document.</p>
                                </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?></p>
    </div>

    <script>
        // Mobile sidebar toggle
        document.querySelector('.menu-toggle').addEventListener('click', function () {
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
        document.addEventListener('click', function (event) {
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

        // Confirm delete action
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    if (!confirm('Are you sure you want to delete this document?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>

</html>