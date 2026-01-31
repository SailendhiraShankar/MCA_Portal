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
    <title>MCA Portal - Staff Home</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php echo staff_sidebar_styles(); ?>

        /* Page Specific Styles */
        .wrapper {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: var(--white);
            padding: 25px;
            text-align: center;
            width: 100%;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 4px 15px rgba(116, 148, 236, 0.2);
            position: relative;
            overflow: hidden;
            z-index: 10;
        }

        .wrapper::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -10%;
            width: 120%;
            height: 200%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
            z-index: -1;
            opacity: 0.1;
            transform: rotate(-5deg);
        }

        .heading {
            font-size: 32px;
            font-weight: 600;
            margin: 10px 0;
            position: relative;
            display: inline-block;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Dashboard Area */
        .dashboard-area {
            padding: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        /* Dashboard Cards */
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .card {
            background: var(--white);
            border-radius: 20px;
            padding: 25px;
            box-shadow: var(--shadow-light);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: var(--primary-color);
            opacity: 0.5;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(116, 148, 236, 0.2);
        }

        .card-icon {
            width: 70px;
            height: 70px;
            background: var(--primary-light);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
        }

        .card-icon i {
            font-size: 32px;
            color: var(--primary-color);
        }

        .card-info h3 {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .card-info p {
            font-size: 16px;
            color: var(--text-light);
        }

        /* Content Section */
        .content {
            background: var(--white);
            padding: 35px;
            border-radius: 20px;
            box-shadow: var(--shadow-light);
            position: relative;
            overflow: hidden;
        }

        .content h2 {
            color: var(--primary-color);
            margin-bottom: 25px;
            font-size: 28px;
            font-weight: 600;
        }

        .sectionpoint1 {
            margin-left: 30px;
            margin-bottom: 20px;
        }

        .sectionpoint1 li {
            margin-bottom: 12px;
            list-style-type: none;
            position: relative;
            padding-left: 25px;
        }

        .sectionpoint1 li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 10px;
            width: 10px;
            height: 10px;
            background: var(--primary-color);
            border-radius: 50%;
        }

        /* Weather Widget */
        .weather-widget {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            border-radius: 20px;
            padding: 25px;
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 5px 15px rgba(9, 132, 227, 0.3);
        }

        .weather-info {
            display: flex;
            align-items: center;
        }

        .weather-icon {
            font-size: 48px;
            margin-right: 20px;
        }

        .weather-temp {
            font-size: 42px;
            font-weight: 700;
        }

        /* Activity Timeline */
        .timeline {
            position: relative;
            padding-left: 30px;
            margin-left: 10px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 2px;
            height: 100%;
            background: var(--primary-light);
        }

        .timeline-item {
            position: relative;
            padding-bottom: 25px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -38px;
            top: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--primary-color);
            border: 3px solid var(--white);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .timeline-date {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 8px;
        }

        .timeline-content {
            background: var(--primary-light);
            padding: 15px;
            border-radius: 10px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.03);
            color: var(--text-light);
            font-size: 14px;
            margin-top: auto;
            border-radius: 20px;
        }

        @media screen and (max-width: 768px) {
            .dashboard-area {
                padding: 20px;
            }

            .weather-widget {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .weather-info {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php staff_sidebar_html(); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1 class="heading">Welcome <?php echo $_SESSION["NAME"]; ?></h1>
            </div>

            <div class="dashboard-area">
                <!-- Weather Widget -->
                <div class="weather-widget">
                    <div class="weather-info">
                        <div class="weather-icon">
                            <i class='bx bx-sun'></i>
                        </div>
                        <div class="weather-details">
                            <h3>Today's Weather</h3>
                            <p>Sunny, Clear Sky • <?php echo date('l, F j'); ?></p>
                        </div>
                    </div>
                    <div class="weather-temp">28°C</div>
                </div>

                <!-- Dashboard Cards -->
                <div class="dashboard">
                    <div class="card">
                        <div class="card-icon">
                            <i class='bx bxs-file'></i>
                        </div>
                        <div class="card-info">
                            <h3><?php echo countRecord("SELECT * FROM sdocuments WHERE SID=" . $_SESSION["ID"], $db); ?>
                            </h3>
                            <p>Your Documents</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-icon">
                            <i class='bx bxs-megaphone'></i>
                        </div>
                        <div class="card-info">
                            <h3><?php echo countRecord("SELECT * FROM announcement WHERE SID=" . $_SESSION["ID"], $db); ?>
                            </h3>
                            <p>Announcements</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-icon">
                            <i class='bx bxs-calendar'></i>
                        </div>
                        <div class="card-info">
                            <h3><?php echo countRecord("SELECT * FROM pannouncement WHERE SID=" . $_SESSION["ID"], $db); ?>
                            </h3>
                            <p>Payment Notices</p>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <h2>Dear <?php echo $_SESSION["NAME"]; ?></h2>
                    <p>Welcome to your personalized dashboard! You can access most interesting features in this portal
                        like:</p>
                    <ul class="sectionpoint1">
                        <li>Store Documents</li>
                        <li>View Documents</li>
                        <li>Datahub</li>
                    </ul>
                    <br>
                    <p><b>Store Documents:</b> Securely upload and store your files in various formats.</p>
                    <p><b>View Documents:</b> Manage your uploaded files - view, download, or delete them easily.</p>
                    <p><b>Datahub:</b> Access teaching resources, references, and tools to enhance your experience.</p>
                </div>

                <!-- Recent Activity Timeline -->
                <div class="activity-timeline">
                    <h3 style="color: var(--primary-color); margin-bottom: 20px;">Recent Activities</h3>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-date">Today, <?php echo date('h:i A'); ?></div>
                            <div class="timeline-content">
                                <h4>Login Successful</h4>
                                <p>You have successfully logged into the MCA Portal.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-date">Yesterday, 03:45 PM</div>
                            <div class="timeline-content">
                                <h4>Document Uploaded</h4>
                                <p>You uploaded a new document "Semester Schedule".</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer">
                    <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?> | Designed for Staff</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>