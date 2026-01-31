<?php
session_start();
include "database.php";
include "staff_sidebar.php";
if (!isset($_SESSION["ID"])) {
    header("location:slogin.php");
    exit();
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>MCA Portal - Payment Announcement</title>
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
            gap: 20px;
        }

        .page-header {
            background: var(--blue-gradient);
            color: var(--white);
            padding: 25px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(116, 148, 236, 0.2);
            position: relative;
            overflow: hidden;
        }

        .center {
            background: var(--white);
            padding: 35px;
            border-radius: 15px;
            box-shadow: var(--shadow-light);
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

        form h3 {
            color: var(--primary-color);
            margin-bottom: 25px;
            font-size: 24px;
        }

        form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        form button {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th {
            background: var(--primary-color);
            color: var(--white);
            padding: 12px;
            text-align: left;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.03);
            color: var(--text-light);
            font-size: 14px;
            margin-top: auto;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php staff_sidebar_html(); ?>

        <div class="main-content">
            <div class="page-header">
                <h1>Payment Announcements</h1>
            </div>

            <div class="center">
                <?php
                if (isset($_POST["submit"])) {
                    $sql = "INSERT INTO pannouncement(SID,TITLE,MESSAGE,AMOUNT,DATE,DUE_DATE) VALUES ({$_SESSION["ID"]},'{$_POST["tname"]}','{$_POST["mname"]}','{$_POST["amount"]}',now(),'{$_POST["addate"]}')";
                    if ($db->query($sql)) {
                        echo "<p style='color: var(--success-color);'>Payment Posted Successfully</p>";
                    }
                }
                ?>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                    <h3>Post Fee Detail</h3>
                    <label>Title</label>
                    <input type="text" name="tname" required>
                    <label>Description</label>
                    <input type="text" name="mname" required>
                    <label>Amount (₹)</label>
                    <input type="number" name="amount" required>
                    <label>Due Date</label>
                    <input type="date" name="addate" required>
                    <button type="submit" name="submit"><i class='bx bx-paper-plane'></i> Post Announcement</button>
                </form>
            </div>

            <div class="content"
                style="background: var(--white); padding: 30px; border-radius: 15px; box-shadow: var(--shadow-light);">
                <h3>Previous Payments</h3>
                <?php
                $sql = "SELECT * FROM pannouncement WHERE SID={$_SESSION["ID"]} ORDER BY DATE DESC";
                $res = $db->query($sql);
                if ($res->num_rows > 0) {
                    echo "<table>
                           <tr>
                           <th>SNO</th>
                           <th>TITLE</th>
                           <th>AMOUNT</th>
                           <th>DUE DATE</th>
                           <th>DELETE</th>
                           </tr>";
                    $i = 0;
                    while ($row = $res->fetch_assoc()) {
                        $i++;
                        echo "<tr>
                                <td>{$i}</td>
                                <td>{$row["TITLE"]}</td>
                                <td style='color: var(--accent-color); font-weight: 600;'>₹{$row["AMOUNT"]}</td>
                                <td>{$row["DUE_DATE"]}</td>
                                <td><a href='delete3.php?id={$row["PID"]}' style='color: var(--error-color);'><i class='bx bx-trash'></i> Delete</a></td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No payments found.</p>";
                }
                ?>
            </div>

            <div class="footer">
                <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?></p>
            </div>
        </div>
    </div>
</body>

</html>