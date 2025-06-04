<?php
    session_start();
    include"database.php";
    function countRecord($sql,$db)
    {
        $res=$db->query($sql);
        return $res->num_rows;
    }
    if(!isset($_SESSION["ID"]))
    {
	    header("location:slogin.php");
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>MCA Portal - Staff Home</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' );

            :root {
                --primary-color: #7494ec;
                --primary-light: rgba(116, 148, 236, 0.1);
                --primary-dark: #5a7ad6;
                --text-dark: #333;
                --text-light: #777;
                --white: #ffffff;
                --sidebar-width: 280px;
                --sidebar-collapsed: 80px;
                --transition-speed: 0.3s;
                --border-radius: 20px;
                --shadow-light: 0 5px 15px rgba(0, 0, 0, 0.05);
                --shadow-medium: 0 8px 20px rgba(116, 148, 236, 0.2);
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
            }

            body {
                background: #f5f7fb;
                color: var(--text-dark);
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                overflow-x: hidden;
            }

            .container {
                display: flex;
                width: 100%;
                position: relative;
            }

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

            .heading::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 50%;
                transform: translateX(-50%);
                width: 80%;
                height: 3px;
                background: var(--white);
                border-radius: 3px;
            }

            /* Sidebar Styles */
            .navi {
                width: var(--sidebar-width);
                background: var(--white);
                height: 100vh;
                position: fixed;
                left: 0;
                top: 0;
                border-radius: 0 30px 30px 0;
                box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
                z-index: 100;
                transition: all var(--transition-speed) ease;
                overflow-y: auto;
                overflow-x: hidden;
            }

            /* Sidebar Container Styles */
            .sidebar-container {
                display: flex;
                flex-direction: column;
                height: 100%;
                padding: 20px 0;
            }

            /* Profile Section */
            .profile-section {
                padding: 20px;
                text-align: center;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                margin-bottom: 20px;
            }

            .profile-image {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                overflow: hidden;
                margin: 0 auto 15px;
                border: 3px solid var(--primary-color);
                box-shadow: 0 5px 15px rgba(116, 148, 236, 0.3);
                transition: all var(--transition-speed) ease;
            }

            .profile-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .profile-info h3 {
                font-size: 18px;
                font-weight: 600;
                color: var(--text-dark);
                margin-bottom: 5px;
            }

            .profile-info p {
                font-size: 14px;
                color: var(--text-light);
                margin-bottom: 10px;
            }

            .status-badge {
                display: inline-block;
                padding: 4px 12px;
                background: rgba(46, 213, 115, 0.15);
                color: #2ed573;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 500;
            }

            /* Navigation Menu */
            .nav-menu {
                flex: 1;
                padding: 0 15px;
            }

            .nav-menu ul {
                list-style: none;
            }

            .nav-item {
                margin-bottom: 8px;
                border-radius: 15px;
                transition: all var(--transition-speed) ease;
            }

            .nav-item a {
                display: flex;
                align-items: center;
                padding: 12px 15px;
                color: var(--text-dark);
                text-decoration: none;
                border-radius: 15px;
                transition: all var(--transition-speed) ease;
            }

            .nav-item a i {
                font-size: 22px;
                margin-right: 15px;
                transition: all var(--transition-speed) ease;
            }

            .nav-item:hover {
                background: var(--primary-light);
            }

            .nav-item:hover a {
                color: var(--primary-color);
            }

            .nav-item.active {
                background: var(--primary-color);
            }

            .nav-item.active a {
                color: var(--white);
            }

            /* Quick Actions */
            .quick-actions {
                padding: 20px;
                border-top: 1px solid rgba(0, 0, 0, 0.05);
                margin-top: 20px;
            }

            .quick-actions h4 {
                font-size: 16px;
                color: var(--text-light);
                margin-bottom: 15px;
                text-align: center;
            }

            .action-buttons {
                display: flex;
                justify-content: space-between;
                gap: 10px;
            }

            .action-btn {
                flex: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 15px 10px;
                background: var(--primary-light);
                color: var(--primary-color);
                border-radius: 15px;
                text-decoration: none;
                transition: all var(--transition-speed) ease;
            }

            .action-btn i {
                font-size: 24px;
                margin-bottom: 8px;
            }

            .action-btn span {
                font-size: 12px;
                text-align: center;
            }

            .action-btn:hover {
                background: var(--primary-color);
                color: var(--white);
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(116, 148, 236, 0.3);
            }

            /* Logout Section */
            .logout-section {
                padding: 20px;
                text-align: center;
                border-top: 1px solid rgba(0, 0, 0, 0.05);
            }

            .logout-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 12px 20px;
                background: #ff6b6b;
                color: var(--white);
                border-radius: 15px;
                text-decoration: none;
                transition: all var(--transition-speed) ease;
            }

            .logout-btn i {
                font-size: 20px;
                margin-right: 10px;
            }

            .logout-btn:hover {
                background: #ff5252;
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
            }

            /* Main Content Area */
            .main {
                margin-left: var(--sidebar-width);
                padding: 30px;
                flex: 1;
                transition: all var(--transition-speed) ease;
            }

            /* Dashboard Cards */
            .dashboard {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 25px;
                margin-bottom: 30px;
            }

            .card {
                background: var(--white);
                border-radius: var(--border-radius);
                padding: 25px;
                box-shadow: var(--shadow-light);
                display: flex;
                align-items: center;
                transition: all var(--transition-speed) ease;
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
                box-shadow: var(--shadow-medium);
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
                transition: all var(--transition-speed) ease;
            }

            .card:hover .card-icon {
                background: var(--primary-color);
            }

            .card-icon i {
                font-size: 32px;
                color: var(--primary-color);
                transition: all var(--transition-speed) ease;
            }

            .card:hover .card-icon i {
                color: var(--white);
                transform: scale(1.1);
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
                margin: 0;
            }

            /* Content Section */
            .content {
                background: var(--white);
                padding: 35px;
                border-radius: var(--border-radius);
                box-shadow: var(--shadow-light);
                margin-top: 25px;
                animation: fadeIn 0.5s ease-out forwards;
                position: relative;
                overflow: hidden;
            }

            .content::after {
                content: '';
                position: absolute;
                bottom: 0;
                right: 0;
                width: 150px;
                height: 150px;
                background: var(--primary-light);
                border-radius: 50%;
                transform: translate(50%, 50%);
                z-index: 0;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(15px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .content h2 {
                color: var(--primary-color);
                margin-bottom: 25px;
                font-size: 28px;
                font-weight: 600;
                position: relative;
                display: inline-block;
                z-index: 1;
            }

            .content h2::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 0;
                width: 60px;
                height: 4px;
                background: var(--primary-color);
                border-radius: 3px;
            }

            .content p {
                margin-bottom: 18px;
                line-height: 1.7;
                color: var(--text-dark);
                position: relative;
                z-index: 1;
            }

            .content b {
                color: var(--primary-color);
                font-weight: 600;
            }

            .sectionpoint1 {
                margin-left: 30px;
                margin-bottom: 20px;
                position: relative;
                z-index: 1;
            }

            .sectionpoint1 li {
                margin-bottom: 12px;
                position: relative;
                padding-left: 25px;
                list-style-type: none;
                transition: all var(--transition-speed) ease;
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
                transition: all var(--transition-speed) ease;
            }

            .sectionpoint1 li:hover {
                transform: translateX(5px);
            }

            .sectionpoint1 li:hover::before {
                background: var(--primary-dark);
                transform: scale(1.3);
            }

            /* Footer */
            .footer {
                text-align: center;
                padding: 20px;
                background: rgba(0, 0, 0, 0.03);
                color: var(--text-light);
                font-size: 14px;
                margin-top: 30px;
                border-radius: var(--border-radius);
            }

            /* Mobile Menu Toggle Button */
            .menu-toggle {
                display: none;
                position: fixed;
                bottom: 30px;
                right: 30px;
                width: 60px;
                height: 60px;
                background: var(--primary-color);
                border-radius: 50%;
                color: var(--white);
                text-align: center;
                line-height: 60px;
                font-size: 28px;
                z-index: 1000;
                cursor: pointer;
                box-shadow: 0 5px 15px rgba(116, 148, 236, 0.4);
                transition: all var(--transition-speed) ease;
            }

            .menu-toggle:hover {
                background: var(--primary-dark);
                transform: scale(1.05);
            }

            /* Collapsed Sidebar State */
            .sidebar-collapsed .navi {
                width: var(--sidebar-collapsed);
            }

            .sidebar-collapsed .main {
                margin-left: var(--sidebar-collapsed);
            }

            .sidebar-collapsed .profile-image {
                width: 50px;
                height: 50px;
            }

            .sidebar-collapsed .profile-info h3,
            .sidebar-collapsed .profile-info p,
            .sidebar-collapsed .profile-info .status-badge,
            .sidebar-collapsed .nav-item a span,
            .sidebar-collapsed .quick-actions h4,
            .sidebar-collapsed .action-btn span,
            .sidebar-collapsed .logout-btn span {
                display: none;
            }

            .sidebar-collapsed .action-buttons {
                flex-direction: column;
            }

            /* Weather Widget */
            .weather-widget {
                background: linear-gradient(135deg, #74b9ff, #0984e3);
                border-radius: var(--border-radius);
                padding: 25px;
                color: var(--white);
                margin-bottom: 30px;
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

            .weather-details h3 {
                font-size: 24px;
                margin-bottom: 5px;
            }

            .weather-details p {
                font-size: 16px;
                opacity: 0.9;
            }

            .weather-temp {
                font-size: 42px;
                font-weight: 700;
            }

            /* Recent Activity Timeline */
            .activity-timeline {
                margin-top: 30px;
            }

            .activity-timeline h3 {
                color: var(--primary-color);
                margin-bottom: 20px;
                font-size: 22px;
                font-weight: 600;
                position: relative;
                display: inline-block;
            }

            .activity-timeline h3::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 0;
                width: 40px;
                height: 3px;
                background: var(--primary-color);
                border-radius: 3px;
            }

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

            .timeline-item:last-child {
                padding-bottom: 0;
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
                color: var(--text-dark);
            }

            .timeline-content h4 {
                margin-bottom: 8px;
                color: var(--primary-color);
            }

            /* Dark Mode Styles */
            body.dark-mode {
                background: #1a1a2e;
                color: #e6e6e6;
            }

            body.dark-mode .wrapper {
                background: linear-gradient(135deg, #4b6cb7, #182848);
            }

            body.dark-mode .navi {
                background: #252541;
            }

            body.dark-mode .card,
            body.dark-mode .content {
                background: #252541;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            body.dark-mode .card-info h3,
            body.dark-mode .content h2 {
                color: #4b6cb7;
            }

            body.dark-mode .card-info p,
            body.dark-mode .content p,
            body.dark-mode .footer {
                color: #b8b8b8;
            }

            body.dark-mode .card-icon {
                background: rgba(75, 108, 183, 0.15);
            }

            body.dark-mode .nav-item a {
                color: #e6e6e6;
            }

            body.dark-mode .nav-item:hover {
                background: rgba(75, 108, 183, 0.15);
            }

            body.dark-mode .nav-item:hover a {
                color: #4b6cb7;
            }

            body.dark-mode .nav-item.active {
                background: #4b6cb7;
            }

            body.dark-mode .timeline::before {
                background: rgba(75, 108, 183, 0.15);
            }

            body.dark-mode .timeline-content {
                background: rgba(75, 108, 183, 0.15);
                color: #e6e6e6;
            }

            body.dark-mode .dark-mode-toggle {
                background: #252541;
            }

            body.dark-mode .dark-mode-toggle i {
                color: #e6e6e6;
            }

            body.dark-mode .collapse-sidebar {
                background: #252541;
            }

            body.dark-mode .collapse-sidebar i {
                color: #4b6cb7;
            }

            /* Responsive Design */
            @media screen and (max-width: 1200px) {
                :root {
                    --sidebar-width: 250px;
                }
                
                .dashboard {
                    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                }
            }

            @media screen and (max-width: 992px) {
                :root {
                    --sidebar-width: 220px;
                }
                
                .main {
                    padding: 25px;
                }
                
                .card-icon {
                    width: 60px;
                    height: 60px;
                }
                
                .card-info h3 {
                    font-size: 28px;
                }
            }

            @media screen and (max-width: 768px) {
                .container {
                    flex-direction: column;
                }
                
                .navi {
                    width: 280px;
                    left: -280px;
                    z-index: 1001;
                }
                
                .navi.active {
                    left: 0;
                }
                
                .main {
                    margin-left: 0;
                    padding: 20px;
                    width: 100%;
                }
                
                .menu-toggle {
                    display: block;
                }
                
                .dashboard {
                    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                    gap: 20px;
                }
                
                .content {
                    padding: 25px;
                }
                
                .heading {
                    font-size: 26px;
                }
                
                .content h2 {
                    font-size: 24px;
                }
            }

            @media screen and (max-width: 576px) {
                .wrapper {
                    padding: 20px;
                }
                
                .heading {
                    font-size: 22px;
                }
                
                .content {
                    padding: 20px;
                }
                
                .dashboard {
                    grid-template-columns: 1fr;
                }
                
                .card {
                    padding: 20px;
                }
                
                .card-icon {
                    width: 50px;
                    height: 50px;
                }
                
                .card-icon i {
                    font-size: 24px;
                }
                
                .card-info h3 {
                    font-size: 24px;
                }
                
                .weather-widget {
                    flex-direction: column;
                    text-align: center;
                }
                
                .weather-info {
                    margin-bottom: 15px;
                    justify-content: center;
                }
            }

            @media screen and (max-width: 480px) {
                .dashboard {
                    grid-template-columns: 1fr;
                    gap: 15px;
                }
                
                .card {
                    padding: 15px;
                }
                
                .content {
                    padding: 15px;
                }
                
                .heading {
                    font-size: 20px;
                }
                
                .content h2 {
                    font-size: 20px;
                }
                
                .weather-widget {
                    padding: 15px;
                }
                
                .weather-icon {
                    font-size: 36px;
                }
                
                .weather-temp {
                    font-size: 32px;
                }
            }

            /* Dark Mode Toggle */
            .dark-mode-toggle {
                position: fixed;
                top: 20px;
                right: 20px;
                width: 40px;
                height: 40px;
                background: var(--white);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                z-index: 99;
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
                transition: all var(--transition-speed) ease;
            }

            .dark-mode-toggle i {
                font-size: 22px;
                color: var(--text-dark);
                transition: all var(--transition-speed) ease;
            }

            .dark-mode-toggle:hover {
                transform: scale(1.1);
            }

            /* Collapse Sidebar Button */
            .collapse-sidebar {
                position: fixed;
                bottom: 30px;
                left: calc(var(--sidebar-width) - 20px);
                width: 40px;
                height: 40px;
                background: var(--white);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                z-index: 101;
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
                transition: all var(--transition-speed) ease;
            }

            .sidebar-collapsed .collapse-sidebar {
                left: calc(var(--sidebar-collapsed) - 20px);
            }

            .collapse-sidebar i {
                font-size: 20px;
                color: var(--primary-color);
                transition: all var(--transition-speed) ease;
            }

            .sidebar-collapsed .collapse-sidebar i {
                transform: rotate(180deg);
            }

            @media screen and (max-width: 768px) {
                .collapse-sidebar {
                    display: none;
                }
            }

            /* Notification Badge */
            .notification-badge {
                position: absolute;
                top: -5px;
                right: -5px;
                width: 18px;
                height: 18px;
                background: #ff6b6b;
                color: var(--white);
                border-radius: 50%;
                font-size: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
            }

            /* Tooltip */
            .tooltip {
                position: relative;
            }

            .tooltip:hover::after {
                content: attr(data-tooltip);
                position: absolute;
                top: -40px;
                left: 50%;
                transform: translateX(-50%);
                background: rgba(0, 0, 0, 0.8);
                color: var(--white);
                padding: 5px 10px;
                border-radius: 5px;
                font-size: 12px;
                white-space: nowrap;
                z-index: 1000;
            }

            .tooltip:hover::before {
                content: '';
                position: absolute;
                top: -10px;
                left: 50%;
                transform: translateX(-50%);
                border-width: 5px;
                border-style: solid;
                border-color: rgba(0, 0, 0, 0.8) transparent transparent transparent;
                z-index: 1000;
            }

            /* Animations */
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }

            .pulse {
                animation: pulse 2s infinite;
            }

            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
                100% { transform: translateY(0px); }
            }

            .float {
                animation: float 3s ease-in-out infinite;
            }

            /* Print Media Styles */
            @media print {
                .navi, .menu-toggle, .dark-mode-toggle, .collapse-sidebar {
                    display: none !important;
                }
                
                .main {
                    margin-left: 0 !important;
                    padding: 0 !important;
                }
                
                .wrapper {
                    box-shadow: none !important;
                    color: #000 !important;
                    background: #fff !important;
                }
                
                .card, .content {
                    box-shadow: none !important;
                    border: 1px solid #ddd !important;
                }
            }

            /* Accessibility Enhancements */
            .skip-to-content {
                position: absolute;
                top: -40px;
                left: 0;
                background: var(--primary-color);
                color: white;
                padding: 8px;
                z-index: 1001;
                transition: top 0.3s;
            }

            .skip-to-content:focus {
                top: 0;
            }

            /* Focus styles for keyboard navigation */
            a:focus, button:focus {
                outline: 2px solid var(--primary-color);
                outline-offset: 2px;
            }

            /* High contrast mode */
            @media (prefers-contrast: high) {
                :root {
                    --primary-color: #0000ff;
                    --primary-dark: #0000cc;
                    --text-dark: #000000;
                    --text-light: #444444;
                    --white: #ffffff;
                }
                
                .card, .content, .navi {
                    border: 1px solid #000;
                }
            }

            /* Reduced motion preference */
            @media (prefers-reduced-motion: reduce) {
                * {
                    animation: none !important;
                    transition: none !important;
                }
            }
        </style>
    </head>
    <body>
       <!-- Dark Mode Toggle -->
       <div class="dark-mode-toggle tooltip" data-tooltip="Toggle Dark Mode">
           <i class='bx bx-moon'></i>
       </div>
       
       <!-- Collapse Sidebar Button -->
       <div class="collapse-sidebar tooltip" data-tooltip="Collapse Sidebar">
           <i class='bx bx-chevron-left'></i>
       </div>
       
       <div class="container">
          <div class="wrapper">
              <h1 class="heading">Welcome <?php echo $_SESSION["NAME"]; ?></h1>
          </div>
          <div class="navi">
             <!-- Integrated Sidebar -->
             <div class="sidebar-container">
                <!-- Staff Profile Section -->
                <div class="profile-section">
                    <div class="profile-image">
                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION["NAME"]); ?>&background=7494ec&color=fff&size=128" alt="Profile">
                    </div>
                    <div class="profile-info">
                        <h3><?php echo $_SESSION["NAME"]; ?></h3>
                        <p>Staff ID: <?php echo $_SESSION["ID"]; ?></p>
                        <span class="status-badge">Online</span>
                    </div>
                </div>
                
                <!-- Navigation Menu -->
                <div class="nav-menu">
                    <ul>
                        <li class="nav-item active">
                            <a href="#">
                                <i class='bx bxs-dashboard'></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="supload_documents.php">
                                <i class='bx bxs-cloud-upload'></i>
                                <span>Store Documents</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="sview_documents.php">
                                <i class='bx bxs-file-find'></i>
                                <span>View Documents</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="smhome.php">
                                <i class='bx bxs-data'></i>
                                <span>Datahub</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="schangepass.php">
                                <i class='bx bxs-lock-alt'></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
                
                <!-- Quick Actions -->
                <div class="quick-actions">
                    <h4>Quick Actions</h4>
                    <div class="action-buttons">
                        <a href="supload_documents.php" class="action-btn">
                            <i class='bx bxs-file-plus'></i>
                            <span>New Document</span>
                        </a>
                    </div>
                </div>
                
                <!-- Logout Section -->
                <div class="logout-section">
                    <a href="logout.php" class="logout-btn">
                        <i class='bx bxs-log-out'></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
          </div>
       </div>
       <div class="main">
           <!-- Weather Widget -->
           <div class="weather-widget">
               <div class="weather-info">
                   <div class="weather-icon">
                       <i class='bx bx-sun'></i>
                   </div>
                   <div class="weather-details">
                       <h3>Today's Weather</h3>
                       <p>Sunny, Clear Sky</p>
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
                       <h3><?php echo countRecord("SELECT * FROM sdocuments WHERE SID=".$_SESSION["ID"],$db); ?></h3>
                       <p>Your Documents</p>
                   </div>
               </div>
               <div class="card">
                   <div class="card-icon">
                       <i class='bx bxs-megaphone'></i>
                   </div>
                   <div class="card-info">
                       <h3><?php echo countRecord("SELECT * FROM announcement WHERE SID=".$_SESSION["ID"],$db); ?></h3>
                       <p>Announcements</p>
                   </div>
               </div>
               <div class="card">
                   <div class="card-icon">
                       <i class='bx bxs-calendar'></i>
                   </div>
                   <div class="card-info">
                       <h3><?php echo countRecord("SELECT * FROM pannouncement WHERE SID=".$_SESSION["ID"],$db); ?></h3>
                       <p>Payment Notices</p>
                   </div>
               </div>
               <div class="card">
                   <div class="card-icon">
                       <i class='bx bxs-user-account'></i>
                   </div>
                   <div class="card-info">
                       <h3><?php echo countRecord("SELECT * FROM user",$db); ?></h3>
                       <p>Total Students</p>
                   </div>
               </div>
           </div>
           
           <div class="content">
                <h2>Dear <?php echo $_SESSION["NAME"]; ?></h2>
                <p>Welcome to your personalized dashboard! You can access most interesting features in this portal like:</p>
                <ul class="sectionpoint1">
                  <li>Store Documents</li>
                  <li>View Documents</li>
                  <li>Datahub</li>
                </ul>
                <br>
                <p><b>Store Documents:</b> By using this function you can store your files by uploading in the store documents. Our system supports various file formats and ensures your documents are securely stored.</p>
                <p><b>View Documents:</b> Your uploaded documents are viewed by using this page and you can upload, view and delete the file using this page. The interface provides easy navigation and management of all your files.</p>
                <p><b>Datahub:</b> In datahub you can access many things and more useful for improving your knowledge. It contains resources, references, and tools to enhance your teaching experience.</p>
           </div>
           
           <!-- Recent Activity Timeline -->
           <div class="activity-timeline">
               <h3>Recent Activities</h3>
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
                   <div class="timeline-item">
                       <div class="timeline-date">Yesterday, 11:30 AM</div>
                       <div class="timeline-content">
                           <h4>Announcement Created</h4>
                           <p>You created a new announcement for students.</p>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="footer">
             <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?> | Designed with <i class='bx bxs-heart' style="color: #ff6b6b;"></i> for Staff</p>
       </div>
       
       <!-- Mobile Menu Toggle Button -->
       <div class="menu-toggle" id="menuToggle">
           <i class='bx bx-menu'></i>
       </div>
       
       <script>
           // Mobile menu toggle functionality
           document.getElementById('menuToggle').addEventListener('click', function() {
               document.querySelector('.navi').classList.toggle('active');
               
               // Change icon based on menu state
               const icon = this.querySelector('i');
               if (icon.classList.contains('bx-menu')) {
                   icon.classList.remove('bx-menu');
                   icon.classList.add('bx-x');
               } else {
                   icon.classList.remove('bx-x');
                   icon.classList.add('bx-menu');
               }
           });
           
           // Close menu when clicking outside
           document.addEventListener('click', function(event) {
               const navi = document.querySelector('.navi');
               const menuToggle = document.getElementById('menuToggle');
               
               if (!navi.contains(event.target) && !menuToggle.contains(event.target) && navi.classList.contains('active')) {
                   navi.classList.remove('active');
                   const icon = menuToggle.querySelector('i');
                   icon.classList.remove('bx-x');
                   icon.classList.add('bx-menu');
               }
           });
           
           // Collapse sidebar functionality
           document.querySelector('.collapse-sidebar').addEventListener('click', function() {
               document.body.classList.toggle('sidebar-collapsed');
           });
           
           // Dark mode toggle functionality
           document.querySelector('.dark-mode-toggle').addEventListener('click', function() {
               document.body.classList.toggle('dark-mode');
               
               // Change icon based on dark mode state
               const icon = this.querySelector('i');
               if (icon.classList.contains('bx-moon')) {
                   icon.classList.remove('bx-moon');
                   icon.classList.add('bx-sun');
               } else {
                   icon.classList.remove('bx-sun');
                   icon.classList.add('bx-moon');
               }
           });
           
           // Add pulse animation to cards
           const cards = document.querySelectorAll('.card');
           cards.forEach((card, index) => {
               setTimeout(() => {
                   card.classList.add('pulse');
               }, index * 300);
           });
           
           // Add float animation to weather widget
           document.querySelector('.weather-widget').classList.add('float');
           
           // Add notification badges dynamically
           function addNotificationBadge(selector, count) {
               if (count > 0) {
                   const element = document.querySelector(selector);
                   if (element) {
                       const badge = document.createElement('span');
                       badge.className = 'notification-badge';
                       badge.textContent = count > 9 ? '9+' : count;
                       element.style.position = 'relative';
                       element.appendChild(badge);
                   }
               }
           }
           
           // Example usage - add notification badges
           addNotificationBadge('.nav-item:nth-child(5) a', 3); // Announcements
           addNotificationBadge('.nav-item:nth-child(6) a', 2); // Payment Notices
           
           // Current date and time for weather widget
           const now = new Date();
           const options = { weekday: 'long', month: 'long', day: 'numeric' };
           document.querySelector('.weather-details p').textContent += ' • ' + now.toLocaleDateString('en-US', options);
       </script>
    </body>
</html>
