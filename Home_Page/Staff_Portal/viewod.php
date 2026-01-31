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
    <title>MCA Portal - View OD Form</title>
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

        .content {
            background: var(--white);
            padding: 30px;
            border-radius: 15px;
            box-shadow: var(--shadow-light);
            flex: 1;
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
                <h2>On Duty Applications</h2>
            </div>

            <div class="content">
                <?php
                $sql = "SELECT * FROM od";
                $res = $db->query($sql);
                if ($res->num_rows > 0) {
                    echo "<table>
                           <tr>
                           <th>SNO</th>
                           <th>STUDENT NAME</th>
                           <th>DATE</th>
                           <th>PERIOD</th>
                           <th>FILE</th>
                           </tr>";
                    $i = 0;
                    while ($row = $res->fetch_assoc()) {
                        $i++;
                        $file_link = !empty($row["FILE"]) ? "<a href='{$row["FILE"]}' target='_blank' style='color: var(--primary-color);'><i class='bx bx-file'></i> View</a>" : "No file";
                        echo "<tr>
                                <td>{$i}</td>
                                <td>{$row["UNAME"]}</td>
                                <td>{$row["PERIOD_DATE"]}</td>
                                <td>{$row["PERIOD"]}</td>
                                <td>{$file_link}</td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No applications found.</p>";
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