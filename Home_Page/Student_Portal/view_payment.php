<?php
session_start();
include "database.php";
if (!isset($_SESSION["ID"])) {
    header("location:ulogin.php");
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>MCA Portal - View Payments</title>
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

        /* Payment Cards */
        .payment-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
            animation: fadeIn 0.8s ease-out forwards;
        }

        .payment-card {
            background: var(--white);
            border-radius: 12px;
            padding: 25px;
            box-shadow: var(--shadow-light);
            transition: all var(--transition-speed);
            position: relative;
            overflow: hidden;
        }

        .payment-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-dark);
        }

        .payment-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
        }

        .payment-card.pending::before {
            background: var(--warning-color);
        }

        .payment-card.success::before {
            background: var(--success-color);
        }

        .payment-card.expired::before {
            background: var(--error-color);
        }

        .payment-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .payment-title i {
            font-size: 24px;
            color: var(--primary-color);
        }

        .payment-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .detail-label {
            font-size: 13px;
            color: var(--text-light);
            font-weight: 500;
        }

        .detail-value {
            font-size: 15px;
            color: var(--text-dark);
            font-weight: 500;
        }

        .amount-value {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-dark);
        }

        .payment-description {
            background: var(--form-bg);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.6;
            color: var(--text-dark);
        }

        .payment-status {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            width: fit-content;
            margin-bottom: 20px;
        }

        .payment-status.pending {
            background: rgba(255, 165, 2, 0.1);
            color: var(--warning-color);
        }

        .payment-status.success {
            background: rgba(46, 213, 115, 0.1);
            color: var(--success-color);
        }

        .payment-status.expired {
            background: rgba(255, 71, 87, 0.1);
            color: var(--error-color);
        }

        .payment-status i {
            font-size: 18px;
        }

        .payment-action {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .pay-button {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all var(--transition-speed);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pay-button i {
            font-size: 18px;
        }

        .pay-button:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: var(--shadow-light);
        }

        .expired-notice {
            background: rgba(255, 71, 87, 0.1);
            color: var(--error-color);
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            width: fit-content;
        }

        .credited-notice {
            background: rgba(46, 213, 115, 0.1);
            color: var(--success-color);
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            width: fit-content;
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

        /* Success Message */
        .success {
            background: #d4edda;
            color: #155724;
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
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

            .payment-card {
                padding: 20px;
            }

            .payment-details {
                grid-template-columns: 1fr;
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
                        <a href="view_payment.php" class="active-link">
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

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <h1>View Payments</h1>
            </div>

            <!-- Payment Section -->
            <div class="payment-section">
                <?php
                $sql = "SELECT pannouncement.PID,staff.SNAME,pannouncement.TITLE,pannouncement.AMOUNT,pannouncement.MESSAGE,pannouncement.DATE,pannouncement.DUE_DATE FROM pannouncement INNER JOIN staff on pannouncement.SID=staff.SID ORDER BY pannouncement.PID DESC";
                $res = $db->query($sql);
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $pid = $row['PID'];
                        $title = $row["TITLE"];
                        $amount = $row["AMOUNT"];
                        $d_d = $row["DUE_DATE"];
                        $check = $db->query("SELECT status FROM payment WHERE rp_id='$pid' AND UID='{$_SESSION['ID']}' ORDER BY order_id DESC LIMIT 1");
                        if ($check && $check->num_rows > 0) {
                            $p_s = strtolower($check->fetch_assoc()['status']);
                        } else {
                            $p_s = 'Not Paid';
                        }
                        $t = date("Y-m-d");
                        $dp = strtotime($d_d) < strtotime($t);

                        // Determine card class based on payment status
                        $cardClass = 'pending';
                        if ($p_s === 'success' || $p_s === 'credited') {
                            $cardClass = 'success';
                        } elseif ($p_s === 'pending') {
                            $cardClass = 'pending';
                        } elseif ($dp) {
                            $cardClass = 'expired';
                        }

                        echo "<div class='payment-card {$cardClass}'>";
                        echo "<div class='payment-title'><i class='bx bxs-wallet'></i>{$title}</div>";

                        echo "<div class='payment-details'>";
                        echo "<div class='detail-item'>";
                        echo "<div class='detail-label'>Amount</div>";
                        echo "<div class='detail-value amount-value'>₹ {$amount}</div>";
                        echo "</div>";

                        echo "<div class='detail-item'>";
                        echo "<div class='detail-label'>Posted by</div>";
                        echo "<div class='detail-value'>{$row["SNAME"]}</div>";
                        echo "</div>";

                        echo "<div class='detail-item'>";
                        echo "<div class='detail-label'>Posted Date</div>";
                        echo "<div class='detail-value'>{$row["DATE"]}</div>";
                        echo "</div>";

                        echo "<div class='detail-item'>";
                        echo "<div class='detail-label'>Due Date</div>";
                        echo "<div class='detail-value'>" . ($dp ? "<span style='color: var(--error-color);'>{$d_d}</span>" : $d_d) . "</div>";
                        echo "</div>";
                        echo "</div>";

                        echo "<div class='payment-description'>{$row["MESSAGE"]}</div>";

                        // Payment status display
                        $statusText = ucfirst($p_s);
                        if ($p_s === 'not paid') {
                            $statusClass = 'pending';
                            $statusIcon = '<i class="bx bxs-time"></i>';
                        } elseif ($p_s === 'success' || $p_s === 'credited') {
                            $statusClass = 'success';
                            $statusIcon = '<i class="bx bxs-check-circle"></i>';
                        } elseif ($p_s === 'pending') {
                            $statusClass = 'pending';
                            $statusIcon = '<i class="bx bxs-hourglass"></i>';
                            $statusText = "Waiting for Approval";
                        } else {
                            $statusClass = 'pending';
                            $statusIcon = '<i class="bx bxs-time"></i>';
                        }

                        echo "<div class='payment-status {$statusClass}'>{$statusIcon} {$statusText}</div>";

                        echo "<div class='payment-action'>";
                        if ($p_s !== 'success' && $p_s !== 'credited' && $p_s !== 'pending') {
                            if (!$dp) {
                                echo "<form action='pay.php' method='POST'>
                                            <input type='hidden' name='amount' value='" . ($amount * 100) . "'>
                                            <input type='hidden' name='title' value='" . htmlspecialchars($title, ENT_QUOTES) . "'>
                                            <input type='hidden' name='pid' value='$pid'>
                                            <button type='submit' class='pay-button'><i class='bx bxs-credit-card'></i> Pay Now</button>
                                        </form>";
                            } else {
                                echo "<div class='expired-notice'><i class='bx bxs-error-circle'></i> Due Date Passed</div>";
                            }
                        } elseif ($p_s === 'pending') {
                            echo "<div class='expired-notice' style='background: rgba(255, 165, 2, 0.1); color: var(--warning-color);'><i class='bx bxs-info-circle'></i> Verification Pending</div>";
                        } else {
                            echo "<div class='credited-notice'><i class='bx bxs-check-circle'></i> Payment Already Credited</div>";
                        }
                        echo "</div>";

                        echo "</div>";
                    }
                } else {
                    echo "<div class='empty-state'>
                                <i class='bx bxs-wallet'></i>
                                <p class='error'>No Payment Pending...</p>
                                <p>There are currently no payments due or pending for your account.</p>
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
        // Add animation to payment cards
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.payment-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.animation = `fadeIn 0.5s ease-out forwards`;
                }, 100 * index);
            });
        });
    </script>
</body>

</html>