<?php
// Staff Sidebar Component
// Include this file in all staff portal pages within a <div class="sidebar"> container
// Make sure to include the staff_sidebar_styles() function output in the <head> section

function staff_sidebar_styles()
{
    return "
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
        font-family: 'Poppins', sans-serif;
    }

    body {
        background: var(--bg-light);
        color: var(--text-dark);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Container for Sidebar and Content */
    .container {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar Base Styles */
    .sidebar {
        width: 250px;
        background: #fff;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        position: fixed;
        left: 0;
        top: 0;
        height: 100%;
        z-index: 100;
    }

    /* Portal Header */
    .portal-header {
        background: linear-gradient(135deg, #6384e4, #7494ec);
        color: #fff;
        padding: 20px 15px;
        text-align: center;
        font-size: 22px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* Navigation Menu */
    .sidebar .navbar {
        flex: 1;
        padding: 20px 15px;
        overflow-y: auto;
    }

    .sidebar .navbar nav ul {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 0;
        margin: 0;
    }

    .sidebar .navbar nav ul button {
        background: #f9f9f9;
        border: none;
        padding: 0;
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .sidebar .navbar nav ul button a {
        display: flex;
        align-items: center;
        padding: 14px 16px;
        color: #444;
        text-decoration: none;
        font-weight: 500;
        font-size: 15px;
        transition: all 0.3s ease;
        position: relative;
    }

    .sidebar .navbar nav ul button a i {
        margin-right: 12px;
        font-size: 20px;
        color: #7494ec;
    }

    .sidebar .navbar nav ul button:hover {
        transform: translateX(5px);
        background: rgba(116, 148, 236, 0.15);
    }

    .sidebar .navbar nav ul button:hover a {
        color: #7494ec;
    }

    .sidebar .navbar nav ul button.active {
        background: #f0f3fa;
        position: relative;
    }

    .sidebar .navbar nav ul button.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: #7494ec;
        border-radius: 0 2px 2px 0;
    }

    .sidebar .navbar nav ul button.active a {
        color: #7494ec;
    }

    /* Main Content Adjustment */
    .main-content {
        margin-left: 250px;
        padding: 30px;
        flex: 1;
        width: calc(100% - 250px);
    }

    /* Mobile Menu Toggle */
    .menu-toggle {
        display: none;
        position: fixed;
        top: 15px;
        left: 15px;
        width: 40px;
        height: 40px;
        background: #7494ec;
        border-radius: 50%;
        color: #fff;
        text-align: center;
        line-height: 40px;
        font-size: 20px;
        z-index: 101;
        cursor: pointer;
        box-shadow: 0 3px 10px rgba(116, 148, 236, 0.4);
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

    .sidebar .navbar nav ul button {
        animation: fadeInLeft 0.5s ease forwards;
        opacity: 0;
    }

    .sidebar .navbar nav ul button:nth-child(1) { animation-delay: 0.1s; }
    .sidebar .navbar nav ul button:nth-child(2) { animation-delay: 0.12s; }
    .sidebar .navbar nav ul button:nth-child(3) { animation-delay: 0.14s; }
    .sidebar .navbar nav ul button:nth-child(4) { animation-delay: 0.16s; }
    .sidebar .navbar nav ul button:nth-child(5) { animation-delay: 0.18s; }
    .sidebar .navbar nav ul button:nth-child(6) { animation-delay: 0.20s; }
    .sidebar .navbar nav ul button:nth-child(7) { animation-delay: 0.22s; }
    .sidebar .navbar nav ul button:nth-child(8) { animation-delay: 0.24s; }
    .sidebar .navbar nav ul button:nth-child(9) { animation-delay: 0.26s; }

    /* Responsive Styles */
    @media screen and (max-width: 992px) {
        .sidebar {
            width: 220px;
        }
        
        .main-content {
            margin-left: 220px;
            width: calc(100% - 220px);
            padding: 25px;
        }
    }

    @media screen and (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        
        .sidebar.active {
            transform: translateX(0);
        }
        
        .main-content {
            margin-left: 0;
            width: 100%;
            padding: 20px;
            padding-top: 60px;
        }
        
        .menu-toggle {
            display: block;
        }
    }
    ";
}

function staff_sidebar_html()
{
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <!-- Mobile Menu Toggle -->
    <div class="menu-toggle" onclick="toggleSidebar()">
        <i class='bx bx-menu'></i>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Portal Header -->
        <div class="portal-header">
            MCA Portal
        </div>

        <!-- Navigation Menu -->
        <div class="navbar">
            <nav>
                <ul>
                    <button class="<?php echo $current_page == 'shome.php' ? 'active' : ''; ?>">
                        <a href="shome.php"><i class='bx bxs-home'></i>Home</a>
                    </button>
                    <button class="<?php echo $current_page == 'suggestion.php' ? 'active' : ''; ?>">
                        <a href="suggestion.php"><i class='bx bxs-message-dots'></i>Suggestions</a>
                    </button>
                    <button class="<?php echo $current_page == 'announcement.php' ? 'active' : ''; ?>">
                        <a href="announcement.php"><i class='bx bxs-megaphone'></i>Announcement</a>
                    </button>
                    <button class="<?php echo $current_page == 'viewod.php' ? 'active' : ''; ?>">
                        <a href="viewod.php"><i class='bx bxs-file'></i>View OD Form</a>
                    </button>
                    <button class="<?php echo $current_page == 'supload_documents.php' ? 'active' : ''; ?>">
                        <a href="supload_documents.php"><i class='bx bxs-cloud-upload'></i>Upload Documents</a>
                    </button>
                    <button class="<?php echo $current_page == 'sview_documents.php' ? 'active' : ''; ?>">
                        <a href="sview_documents.php"><i class='bx bxs-folder-open'></i>View Documents</a>
                    </button>
                    <button class="<?php echo $current_page == 'payment_announcement.php' ? 'active' : ''; ?>">
                        <a href="payment_announcement.php"><i class='bx bxs-wallet'></i>Payment Info</a>
                    </button>
                    <button class="<?php echo $current_page == 'verify_student_payments.php' ? 'active' : ''; ?>">
                        <a href="verify_student_payments.php"><i class='bx bxs-check-shield'></i>Verify Payments</a>
                    </button>
                    <button>
                        <a href="logout.php"><i class='bx bxs-log-out'></i>Logout</a>
                    </button>
                </ul>
            </nav>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            const icon = menuToggle.querySelector('i');

            sidebar.classList.toggle('active');

            if (icon.classList.contains('bx-menu')) {
                icon.classList.remove('bx-menu');
                icon.classList.add('bx-x');
            } else {
                icon.classList.remove('bx-x');
                icon.classList.add('bx-menu');
            }
        }

        // Close sidebar when clicking outside (mobile)
        document.addEventListener('click', function (event) {
            const sidebar = document.querySelector('.sidebar');
            const menuToggle = document.querySelector('.menu-toggle');

            if (sidebar && menuToggle &&
                !sidebar.contains(event.target) &&
                !menuToggle.contains(event.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');

                const icon = menuToggle.querySelector('i');
                icon.classList.remove('bx-x');
                icon.classList.add('bx-menu');
            }
        });
    </script>
    <?php
}
?>