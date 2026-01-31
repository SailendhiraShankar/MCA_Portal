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
    <title>MCA Portal - View Suggestions</title>
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

        .page-header h1 {
            font-size: 28px;
            font-weight: 600;
            position: relative;
            z-index: 1;
        }

        /* Content Section */
        .content {
            background: var(--white);
            padding: 30px;
            border-radius: 15px;
            box-shadow: var(--shadow-light);
            flex: 1;
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

        /* Suggestion Items */
        .suggestion-card {
            background: var(--white);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        .suggestion-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .suggestion-card strong {
            display: block;
            color: var(--primary-color);
            font-size: 18px;
            margin-bottom: 10px;
        }

        .suggestion-text {
            display: block;
            margin: 10px 0;
            line-height: 1.6;
            color: var(--text-dark);
            font-size: 15px;
        }

        .suggestion-date {
            display: block;
            color: var(--text-light);
            font-size: 13px;
            margin-top: 10px;
            font-style: italic;
        }

        .like-btn {
            background: var(--primary-light);
            color: var(--primary-color);
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 10px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
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
                <h1>Students Suggestions</h1>
            </div>

            <div class="content">
                <?php
                $sql = "SELECT user.UNAME,comment.COMM,comment.LOGS,comment.CID FROM comment INNER JOIN user on comment.UID=user.UID ORDER BY comment.CID DESC";
                $res = $db->query($sql);
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $cid = $row["CID"];
                        $lsql = "SELECT COUNT(*) as lc FROM `like` WHERE CID = $cid";
                        $lr = $db->query($lsql);
                        $lrow = $lr->fetch_assoc();
                        $lc = $lrow['lc'];
                        echo "
                        <div class='suggestion-card'>
                            <strong>{$row["UNAME"]}</strong>
                            <span class='suggestion-text'>{$row["COMM"]}</span>
                            <span class='suggestion-date'>{$row["LOGS"]}</span>
                            <button class='like-btn'><i class='bx bx-like'></i> Like-{$lc}</button>
                        </div>";
                    }
                } else {
                    echo "<div style='text-align:center; padding: 30px; color: var(--text-light);'><i class='bx bx-message-x'></i> No suggestions yet.</div>";
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