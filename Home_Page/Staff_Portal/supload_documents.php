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
    <title>MCA Portal - Store Documents</title>
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

        .center-form {
            background: var(--white);
            padding: 35px;
            border-radius: 15px;
            box-shadow: var(--shadow-light);
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
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
            text-align: center;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        form input[type="text"],
        form input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
        }

        form button {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        form button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
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
                <h1>Store Documents</h1>
            </div>

            <div class="center-form">
                <?php
                if (isset($_POST["submit"])) {
                    $target_dir = "upload/";
                    $target_file = $target_dir . basename($_FILES["efile"]["name"]);
                    if (move_uploaded_file($_FILES["efile"]["tmp_name"], $target_file)) {
                        $sql = "INSERT INTO sdocuments(BTITLE,KEYWORD,FILE,SID) VALUES ('{$_POST["bname"]}','{$_POST["keys"]}','{$target_file}',{$_SESSION["ID"]})";
                        if ($db->query($sql)) {
                            echo "<p style='color: var(--success-color); text-align:center; margin-bottom:15px;'>Document Uploaded Successfully</p>";
                        }
                    }
                }
                ?>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                    <h3>Upload New Document</h3>
                    <label>Title</label>
                    <input type="text" name="bname" required placeholder="Enter document title">
                    <label>Keywords</label>
                    <input type="text" name="keys" required placeholder="Enter keywords (comma separated)">
                    <label>Select File</label>
                    <input type="file" name="efile" required>
                    <button type="submit" name="submit"><i class='bx bx-upload'></i> Upload Document</button>
                    <div style="margin-top: 15px; text-align: center;">
                        <a href="sview_documents.php" style="color: var(--primary-color); text-decoration: none;">View
                            All Documents</a>
                    </div>
                </form>
            </div>

            <div class="footer">
                <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?></p>
            </div>
        </div>
    </div>
</body>

</html>