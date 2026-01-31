<?php
session_start();
include "database.php";
include "staff_sidebar.php";

if (!isset($_SESSION["ID"])) {
    header("location:slogin.php");
    exit();
}

// Handle Approval/Rejection
if (isset($_POST['action'])) {
    $order_id = $_POST['order_id'];
    $action = $_POST['action'];

    if ($action == 'approve') {
        $sql = "UPDATE payment SET status='success' WHERE order_id='$order_id'";
        $msg = "Payment Approved Successfully!";
        $msg_type = "success";
    } elseif ($action == 'reject') {
        $sql = "UPDATE payment SET status='rejected' WHERE order_id='$order_id'";
        $msg = "Payment Rejected";
        $msg_type = "error";
    }

    if ($db->query($sql)) {
        // Success
    } else {
        $msg = "Error updating record";
        $msg_type = "error";
    }
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>MCA Portal - Verify Payments</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php echo staff_sidebar_styles(); ?>

        /* Page Specific Styles */
        .main-content {
            flex: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
        }

        .page-header {
            background: linear-gradient(135deg, #6384e4, #7494ec);
            color: #fff;
            padding: 25px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(116, 148, 236, 0.2);
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        /* Message */
        .msg {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }

        .msg.success {
            background: rgba(46, 213, 115, 0.15);
            color: #2ed573;
            border-left: 4px solid #2ed573;
        }

        .msg.error {
            background: rgba(255, 71, 87, 0.15);
            color: #ff4757;
            border-left: 4px solid #ff4757;
        }

        /* Payment Cards */
        .payment-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
            justify-content: space-between;
            border-left: 5px solid #ffcc00;
            transition: all 0.3s ease;
        }

        .payment-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .payment-info {
            flex: 1;
            min-width: 280px;
        }

        .student-name {
            font-weight: 600;
            font-size: 18px;
            color: #333;
            margin-bottom: 8px;
        }

        .event-title {
            color: #777;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .amount {
            font-size: 15px;
            color: #333;
            margin-bottom: 12px;
        }

        .amount strong {
            color: #7494ec;
            font-size: 18px;
        }

        .proof-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            background: rgba(116, 148, 236, 0.1);
            color: #7494ec;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .proof-link:hover {
            background: #7494ec;
            color: #fff;
        }

        .no-proof {
            color: #ff4757;
            font-size: 13px;
            font-style: italic;
        }

        /* Action Buttons */
        .actions {
            display: flex;
            gap: 10px;
        }

        .actions form {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-approve {
            background: rgba(46, 213, 115, 0.15);
            color: #2ed573;
        }

        .btn-approve:hover {
            background: #2ed573;
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-reject {
            background: rgba(255, 71, 87, 0.15);
            color: #ff4757;
        }

        .btn-reject:hover {
            background: #ff4757;
            color: #fff;
            transform: translateY(-2px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .empty-state i {
            font-size: 60px;
            color: #2ed573;
            margin-bottom: 15px;
        }

        .empty-state p {
            color: #999;
            font-size: 16px;
        }

        /* Responsive */
        @media screen and (max-width: 768px) {
            .payment-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .actions {
                width: 100%;
            }

            .actions form {
                width: 100%;
            }

            .btn {
                flex: 1;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php staff_sidebar_html(); ?>

        <div class="main-content">
            <div class="page-header">
                <h1><i class='bx bxs-check-shield'></i> Verify Student Payments</h1>
            </div>

            <?php if (isset($msg))
                echo "<div class='msg $msg_type'>$msg</div>"; ?>

            <?php
            $sid = $_SESSION["ID"];
            $sql = "SELECT p.*, a.TITLE, u.UNAME as STUDENT_NAME 
                    FROM payment p 
                    JOIN pannouncement a ON p.rp_id = a.PID 
                    JOIN user u ON p.UID = u.UID 
                    WHERE a.SID = '$sid' AND (p.status = 'pending' OR p.status = 'Pending') 
                    ORDER BY p.order_id DESC";

            $res = $db->query($sql);

            if ($res && $res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    ?>
                    <div class="payment-card">
                        <div class="payment-info">
                            <div class="student-name"><?php echo htmlspecialchars($row['STUDENT_NAME']); ?></div>
                            <div class="event-title">Paying for: <strong><?php echo htmlspecialchars($row['TITLE']); ?></strong>
                            </div>
                            <div class="amount">Amount: <strong>₹ <?php echo $row['price']; ?></strong></div>

                            <?php if ($row['transaction_image']): ?>
                                <a href="../Student_Portal/<?php echo $row['transaction_image']; ?>" target="_blank"
                                    class="proof-link">
                                    <i class='bx bxs-image'></i> View Payment Proof
                                </a>
                            <?php else: ?>
                                <span class="no-proof"><i class='bx bxs-error'></i> No proof attached</span>
                            <?php endif; ?>
                        </div>

                        <div class="actions">
                            <form method="POST">
                                <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                <button type="submit" name="action" value="approve" class="btn btn-approve">
                                    <i class='bx bx-check'></i> Approve
                                </button>
                                <button type="submit" name="action" value="reject" class="btn btn-reject">
                                    <i class='bx bx-x'></i> Reject
                                </button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='empty-state'>
                        <i class='bx bx-check-circle'></i>
                        <p>No pending payments to verify. All caught up!</p>
                      </div>";
            }
            ?>
        </div>
    </div>
</body>

</html>