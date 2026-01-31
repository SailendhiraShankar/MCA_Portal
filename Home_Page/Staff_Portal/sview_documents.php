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
    <title>MCA Portal - View Documents</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 600;
            position: relative;
            z-index: 1;
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
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-header a:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
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

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        table th {
            background: var(--primary-color);
            color: var(--white);
            padding: 15px;
            text-align: left;
        }

        table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        table tr:hover {
            background-color: var(--primary-light);
        }

        table button {
            background: var(--primary-color);
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        table button a {
            color: var(--white);
            text-decoration: none;
            display: flex;
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

        @media screen and (max-width: 768px) {
            .main-content {
                padding: 20px;
            }

            .page-header {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php staff_sidebar_html(); ?>

        <div class="main-content">
            <!-- Header Section -->
            <div class="page-header">
                <h1>View Documents</h1>
                <div class="actions">
                    <a href="search_books.php"><i class='bx bx-search'></i> Search</a>
                    <a href='shome.php'><i class='bx bx-home'></i> Home</a>
                </div>
            </div>

            <!-- Content Section -->
            <div class="content">
                <?php
                $sql = "SELECT * FROM sdocuments WHERE SID={$_SESSION["ID"]}";
                $res = $db->query($sql);
                if ($res->num_rows > 0) {
                    echo "<table>
                       <tr>
                       <th>SNO</th>
                       <th>TITLE</th>
                       <th>KEYWORDS</th>
                       <th>VIEW</th>
                       <th>DELETE</th>
                       </tr>";
                    $i = 0;
                    while ($row = $res->fetch_assoc()) {
                        $i++;
                        echo "<tr>
                                <td>{$i}</td>
                                <td>{$row["BTITLE"]}</td>
                                <td>{$row["KEYWORD"]}</td>
                                <td><button><a href='{$row["FILE"]}' target='_blank'><i class='bx bx-file'></i> View</a></button></td>
                                <td><a href='delete.php?id={$row["BID"]}' style='color: var(--error-color);'><i class='bx bx-trash'></i> Delete</a></td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<div class='error' style='text-align:center; padding: 20px; color: var(--error-color);'><i class='bx bx-error-circle'></i> No Documents Found</div>";
                }
                ?>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?></p>
            </div>
        </div>
    </div>
</body>

</html>