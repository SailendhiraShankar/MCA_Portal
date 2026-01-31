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
    <title>MCA Portal - Announcements</title>
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

        /* Header Section */
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

        /* Center Content */
        .center {
            background: var(--white);
            padding: 35px;
            border-radius: 15px;
            box-shadow: var(--shadow-light);
            position: relative;
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

        /* Form Styles */
        form h3 {
            color: var(--primary-color);
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: 600;
        }

        form input[type="text"] {
            width: 100%;
            padding: 14px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
        }

        form input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px dashed #ddd;
            border-radius: 8px;
        }

        form button {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        form button:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
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
    </style>
</head>

<body>
    <div class="container">
        <?php staff_sidebar_html(); ?>

        <div class="main-content">
            <div class="page-header">
                <h1>Announcements</h1>
            </div>

            <div class="center">
                <?php
                if (isset($_POST["submit"])) {
                    $target_dir = "Announcement/";
                    $target_dir2 = "../Student_Portal/Announcement/";
                    $target_file = "";
                    if (!empty($_FILES["efile"]["name"])) {
                        $target_file = $target_dir . basename($_FILES["efile"]["name"]);
                        $target_file2 = $target_dir2 . basename($_FILES["efile"]["name"]);
                        move_uploaded_file($_FILES["efile"]["tmp_name"], $target_file);
                        copy($target_file, $target_file2);
                    }
                    $sql = "INSERT INTO announcement(MESSAGE, FILE, LOGS, SID) VALUES ('{$_POST["mname"]}','{$target_file}',now(),{$_SESSION["ID"]})";
                    if ($db->query($sql)) {
                        echo "<p class='success' style='color: var(--success-color);'>Announcement Posted</p>";
                    }
                }
                ?>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                    <h3>Post New Announcement</h3>
                    <label>Message</label>
                    <input type="text" name="mname" required>
                    <label>Attachment (Optional)</label>
                    <input type="file" name="efile">
                    <button type="submit" name="submit"><i class='bx bx-send'></i> Post</button>
                </form>
            </div>

            <div class="content"
                style="background: var(--white); padding: 30px; border-radius: 15px; box-shadow: var(--shadow-light);">
                <h3>Previous Announcements</h3>
                <?php
                $sql = "SELECT * FROM announcement WHERE SID={$_SESSION["ID"]} ORDER BY LOGS DESC";
                $res = $db->query($sql);
                if ($res->num_rows > 0) {
                    echo "<table>
                           <tr>
                           <th>SNO</th>
                           <th>MESSAGE</th>
                           <th>VIEW</th>
                           <th>DELETE</th>
                           </tr>";
                    $i = 0;
                    while ($row = $res->fetch_assoc()) {
                        $i++;
                        $file_link = !empty($row["FILE"]) ? "<a href='{$row["FILE"]}' target='_blank' style='color: var(--primary-color);'><i class='bx bx-file'></i> View</a>" : "No file";
                        echo "<tr>
                                <td>{$i}</td>
                                <td>{$row["MESSAGE"]}</td>
                                <td>{$file_link}</td>
                                <td><a href='delete2.php?id={$row["AID"]}' style='color: var(--error-color);'><i class='bx bx-trash'></i> Delete</a></td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No announcements found.</p>";
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