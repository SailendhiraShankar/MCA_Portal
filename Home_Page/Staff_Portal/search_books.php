<?php
session_start();
include "database.php";
include "staff_sidebar.php";
function countRecord($sql, $db)
{
    $res = $db->query($sql);
    return $res->num_rows;
}
if (!isset($_SESSION["ID"])) {
    header("location:slogin.php");
    exit();
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>MCA Portal - Search Documents</title>
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

        <?php echo staff_sidebar_styles(); ?>

        /* Page Specific Styles */
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
            flex: 1;
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.5s ease-out forwards;
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
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
            margin-bottom: 30px;
        }

        .heading {
            color: var(--primary-color);
            margin-bottom: 25px;
            font-size: 28px;
            font-weight: 600;
            position: relative;
            display: inline-block;
            text-align: center;
            width: 100%;
        }

        .heading::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
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

        form input[type="text"] {
            width: 100%;
            padding: 14px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
            transition: all var(--transition-speed) ease;
            font-size: 15px;
        }

        form input[type="text"]:focus {
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

        form a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--bg-light);
            color: var(--text-dark);
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 16px;
            transition: all var(--transition-speed) ease;
            margin-right: 10px;
        }

        form a:hover {
            background: #e9ecf3;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
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
            position: relative;
            z-index: 1;
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

        table td a {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: var(--primary-color);
            color: var(--white) !important;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            transition: all var(--transition-speed) ease;
        }

        table td a:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(116, 148, 236, 0.3);
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
            position: relative;
            z-index: 1;
        }

        /* Search Results Animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        table {
            animation: slideIn 0.5s ease-out forwards;
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

            table th,
            table td {
                padding: 12px 10px;
            }

            .heading {
                font-size: 24px;
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

            .center {
                padding: 25px;
            }
        }

        @media screen and (max-width: 576px) {
            .center {
                padding: 20px;
            }

            .heading {
                font-size: 22px;
            }

            form button,
            form a {
                width: 100%;
                margin-right: 0;
                text-align: center;
                justify-content: center;
                margin-bottom: 10px;
            }

            .content {
                overflow-x: auto;
            }

            table {
                min-width: 500px;
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

        /* Search icon animation */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .search-icon {
            animation: pulse 2s infinite;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php staff_sidebar_html(); ?>
        <div class="main-content">
            <!-- Main Content -->
            <div class="main">
                <!-- Header Section -->
                <div class="page-header">
                    <h1>Search Documents</h1>
                </div>

                <div class="center">
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <h3 class="heading">Search Documents</h3>
                        <label>Enter Name or Keywords</label>
                        <input type="text" required name="name" placeholder="Enter document title or keywords...">
                        <button type="submit" name="submit"><i class='bx bx-search search-icon'></i> Search</button>
                        <a href="sview_documents.php"><i class='bx bx-arrow-back'></i> Back</a>
                        <a href="search_books.php"><i class='bx bx-refresh'></i> Refresh</a>
                    </form>
                    <?php
                    if (isset($_POST["submit"])) {
                        $sql = "SELECT * FROM sdocuments WHERE SID={$_SESSION["ID"]} AND (BTITLE like '%{$_POST["name"]}%' or Keyword like '%{$_POST["name"]}%')";
                        $res = $db->query($sql);
                        if ($res->num_rows > 0) {
                            echo "<table>
                            <tr>
                            <th>SNO</th>
                            <th>TITLE</th>
                            <th>KEYWORDS</th>
                            <th>VIEW</th>
                            </tr>
                            ";
                            $i = 0;
                            while ($row = $res->fetch_assoc()) {
                                $i++;
                                echo "<tr>";
                                echo "<td>{$i}</td>";
                                echo "<td>{$row["BTITLE"]}</td>";
                                echo "<td>{$row["KEYWORD"]}</td>";
                                echo "<td><a href='{$row["FILE"]}' target='_blank'><i class='bx bx-file'></i> View</a></td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<p class='error'><i class='bx bx-error-circle'></i> No Documents Found</p>";
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?></p>
            </div>

        </div>
    </div>
    </div>
    <script>
        // Focus search input on page load
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="name"]');
            if (searchInput) {
                searchInput.focus();
            }
        });
    </script>
</body>
</html>