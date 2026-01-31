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
	    header("location:ulogin.php");
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>MCA Portal - Upload Documents</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
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
                font-family: "Poppins", sans-serif;
            }

            body {
                background: var(--bg-light);
                color: var(--text-dark);
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            /* Layout Structure */
            .container {
                display: flex;
                min-height: 100vh;
            }

            /* Sidebar Styles */
            .sidebar {
                width: 250px;
                background: var(--white);
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
                background: var(--blue-gradient);
                color: var(--white);
                padding: 20px 15px;
                text-align: center;
                font-size: 22px;
                font-weight: 600;
                letter-spacing: 0.5px;
            }

            /* Navigation Menu */
            .navbar {
                flex: 1;
                padding: 20px 15px;
                overflow-y: auto;
            }

            .navbar nav ul {
                list-style: none;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .navbar nav ul button {
                background: none;
                border: none;
                padding: 0;
                width: 100%;
                border-radius: 8px;
                overflow: hidden;
                transition: all var(--transition-speed) ease;
                background: #f9f9f9;
            }

            .navbar nav ul button a {
                display: flex;
                align-items: center;
                padding: 14px 16px;
                color: #444;
                text-decoration: none;
                font-weight: 500;
                font-size: 15px;
                transition: all var(--transition-speed) ease;
                position: relative;
            }

            .navbar nav ul button a::before {
                content: '';
                font-family: 'boxicons';
                margin-right: 10px;
                font-size: 18px;
                color: var(--primary-color);
            }

            .navbar nav ul button:nth-child(1) a::before {
                content: '\eb25'; /* Store Documents icon */
            }

            .navbar nav ul button:nth-child(2) a::before {
                content: '\eb7b'; /* View Documents icon */
            }

            .navbar nav ul button:nth-child(3) a::before {
                content: '\eb2d'; /* Student Portal icon */
            }

            .navbar nav ul button:nth-child(4) a::before {
                content: '\eb8c'; /* Change Password icon */
            }

            .navbar nav ul button:nth-child(5) a::before {
                content: '\ebec'; /* Logout icon */
                color: var(--accent-color);
            }

            .navbar nav ul button:hover {
                transform: translateX(5px);
            }

            .navbar nav ul button.active {
                background: #f0f3fa;
                position: relative;
            }

            .navbar nav ul button.active::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                width: 4px;
                background: var(--primary-color);
                border-radius: 0 2px 2px 0;
            }

            .navbar nav ul button.active a {
                color: var(--primary-color);
            }

            .navbar nav ul button:last-child a {
                color: var(--accent-color);
            }

            /* User Profile Section */
            .user-profile {
                padding: 15px;
                border-top: 1px solid #eee;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .user-avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: var(--primary-light);
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                color: var(--primary-color);
                font-size: 16px;
            }

            .user-info {
                flex: 1;
                overflow: hidden;
            }

            .user-name {
                font-weight: 600;
                font-size: 14px;
                color: var(--text-dark);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .user-role {
                font-size: 12px;
                color: var(--text-light);
            }

            /* Main Content Area */
            .main-content {
                margin-left: 250px;
                padding: 30px;
                flex: 1;
                width: calc(100% - 250px);
                display: flex;
                flex-direction: column;
            }

            /* Page Header */
            .page-header {
                background: var(--blue-gradient);
                color: var(--white);
                padding: 25px;
                text-align: center;
                border-radius: 15px;
                box-shadow: 0 4px 15px rgba(116, 148, 236, 0.2);
                margin-bottom: 30px;
                position: relative;
                overflow: hidden;
            }

            .page-header::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -10%;
                width: 120%;
                height: 200%;
                background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
                background-size: cover;
                z-index: 0;
                opacity: 0.1;
                transform: rotate(-5deg);
            }

            .page-header h1 {
                font-size: 28px;
                font-weight: 600;
                position: relative;
                z-index: 1;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            /* Upload Form Section */
            .upload-section {
                background: var(--white);
                padding: 30px;
                border-radius: 15px;
                box-shadow: var(--shadow-light);
                flex: 1;
                position: relative;
                overflow: hidden;
                animation: fadeIn 0.5s ease-out forwards;
                max-width: 600px;
                margin: 0 auto;
                width: 100%;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(15px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .upload-section::after {
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

            /* Form Styles */
            form {
                position: relative;
                z-index: 1;
            }

            form h3 {
                color: var(--primary-color);
                margin-bottom: 25px;
                font-size: 24px;
                font-weight: 600;
                position: relative;
                display: inline-block;
                text-align: center;
                width: 100%;
            }

            form h3::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 50%;
                transform: translateX(-50%);
                width: 60px;
                height: 4px;
                background: var(--primary-color);
                border-radius: 3px;
            }

            form label {
                display: block;
                margin-bottom: 8px;
                font-weight: 500;
                color: var(--text-dark);
            }

            form input[type="text"] {
                width: 100%;
                padding: 14px 15px;
                margin-bottom: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background: #f9f9f9;
                transition: all var(--transition-speed) ease;
                font-size: 15px;
            }

            form input[type="text"]:focus {
                border-color: var(--primary-color);
                background: var(--white);
                box-shadow: 0 0 0 3px var(--primary-light);
                outline: none;
            }

            /* File Upload Styling */
            .file-upload {
                position: relative;
                margin-bottom: 20px;
            }

            .file-upload input[type="file"] {
                position: absolute;
                left: 0;
                top: 0;
                opacity: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
                z-index: 2;
            }

            .file-upload-label {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 14px 15px;
                background: #f9f9f9;
                border: 1px dashed #ddd;
                border-radius: 8px;
                color: var(--text-light);
                font-weight: 500;
                transition: all var(--transition-speed) ease;
                cursor: pointer;
            }

            .file-upload-label::before {
                content: '\eb21';
                font-family: 'boxicons';
                font-size: 24px;
                color: var(--primary-color);
            }

            .file-upload input[type="file"]:focus + .file-upload-label,
            .file-upload:hover .file-upload-label {
                border-color: var(--primary-color);
                background: var(--primary-light);
                color: var(--primary-color);
            }

            .file-name {
                margin-top: 8px;
                font-size: 14px;
                color: var(--text-light);
                text-align: center;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            form button {
                width: 100%;
                height: 48px;
                background: var(--primary-color);
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, .1);
                border: none;
                cursor: pointer;
                font-size: 16px;
                color: var(--white);
                font-weight: 600;
                transition: all var(--transition-speed) ease;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                margin-bottom: 15px;
            }

            form button::before {
                content: '\eb79';
                font-family: 'boxicons';
                font-size: 20px;
            }

            form button:hover {
                background: var(--primary-dark);
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(116, 148, 236, 0.3);
            }

            .links-container {
                display: flex;
                justify-content: center;
                gap: 15px;
                flex-wrap: wrap;
            }

            form a {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: var(--bg-light);
                color: var(--text-dark);
                text-decoration: none;
                padding: 12px 20px;
                border-radius: 8px;
                font-weight: 500;
                font-size: 15px;
                transition: all var(--transition-speed) ease;
                margin-bottom: 10px;
            }

            form a:hover {
                background: #e9ecf3;
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            }

            form a:nth-child(1)::before {
                content: '\eb96';
                font-family: 'boxicons';
                font-size: 18px;
                color: var(--primary-color);
            }

            form a:nth-child(2)::before {
                content: '\eb2d';
                font-family: 'boxicons';
                font-size: 18px;
                color: var(--primary-color);
            }

            /* Success and Error Messages */
            .success {
                background: rgba(46, 213, 115, 0.1);
                color: var(--success-color);
                padding: 15px;
                border-radius: 8px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 500;
                border-left: 4px solid var(--success-color);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                position: relative;
                z-index: 1;
            }

            .success::before {
                content: '\ec34';
                font-family: 'boxicons';
                font-size: 20px;
            }

            .error {
                background: rgba(255, 71, 87, 0.1);
                color: var(--error-color);
                padding: 15px;
                border-radius: 8px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 500;
                border-left: 4px solid var(--error-color);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                position: relative;
                z-index: 1;
            }

            .error::before {
                content: '\ec80';
                font-family: 'boxicons';
                font-size: 20px;
            }

            /* Footer */
            .footer {
                text-align: center;
                padding: 20px;
                background: rgba(0, 0, 0, 0.03);
                color: var(--text-light);
                font-size: 14px;
                margin-top: 30px;
                border-radius: 15px;
                margin-left: 250px;
                width: calc(100% - 280px);
            }

            /* Mobile Menu Toggle Button */
            .menu-toggle {
                display: none;
                position: fixed;
                top: 15px;
                left: 15px;
                width: 40px;
                height: 40px;
                background: var(--primary-color);
                border-radius: 50%;
                color: var(--white);
                text-align: center;
                line-height: 40px;
                font-size: 20px;
                z-index: 101;
                cursor: pointer;
                box-shadow: 0 3px 10px rgba(116, 148, 236, 0.4);
            }

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
                
                .footer {
                    margin-left: 220px;
                    width: calc(100% - 250px);
                }
            }

            @media screen and (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                    transition: transform var(--transition-speed) ease;
                }
                
                .sidebar.active {
                    transform: translateX(0);
                }
                
                .main-content {
                    margin-left: 0;
                    width: 100%;
                    padding: 20px;
                }
                
                .footer {
                    margin-left: 0;
                    width: calc(100% - 40px);
                    margin: 30px 20px 20px 20px;
                }
                
                .menu-toggle {
                    display: block;
                }
                
                .upload-section {
                    padding: 25px;
                }
                
                form h3 {
                    font-size: 22px;
                }
            }

            @media screen and (max-width: 480px) {
                .upload-section {
                    padding: 20px;
                }
                
                form h3 {
                    font-size: 20px;
                }
                
                .links-container {
                    flex-direction: column;
                }
                
                form a {
                    width: 100%;
                    justify-content: center;
                }
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
            
            .navbar nav ul button {
                animation: fadeInLeft 0.5s ease forwards;
                opacity: 0;
            }
            
            .navbar nav ul button:nth-child(1) { animation-delay: 0.1s; }
            .navbar nav ul button:nth-child(2) { animation-delay: 0.2s; }
            .navbar nav ul button:nth-child(3) { animation-delay: 0.3s; }
            .navbar nav ul button:nth-child(4) { animation-delay: 0.4s; }
            .navbar nav ul button:nth-child(5) { animation-delay: 0.5s; }
        </style>
    </head>
    <body>
        <!-- Mobile Menu Toggle Button -->
        <div class="menu-toggle">
            <i class='bx bx-menu'></i>
        </div>
        
        <div class="container">
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
                            <button class="active">
                                <a href="upload_documents.php">Store Documents</a>
                            </button>
                            <button>
                                <a href="view_documents.php">View Documents</a>
                            </button>
                            <button>
                                <a href="uhome.php">Student Portal</a>
                            </button>
                            <button>
                                <a href="uchangepass.php">Change Password</a>
                            </button>
                            <button>
                                <a href="logout.php">Logout</a>
                            </button>
                        </ul>
                    </nav>
                </div>
                
                <!-- User Profile Section -->
                <div class="user-profile">
                    <div class="user-avatar">
                        <?php echo substr($_SESSION["NAME"], 0, 1); ?>
                    </div>
                    <div class="user-info">
                        <div class="user-name"><?php echo $_SESSION["NAME"]; ?></div>
                        <div class="user-role">Student</div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="main-content">
                <!-- Page Header -->
                <div class="page-header">
                    <h1>Upload Documents</h1>
                </div>
                
                <!-- Upload Form Section -->
                <div class="upload-section">
                    <?php
                        if(isset($_POST["submit"]))
                        {
                            $target_dir = "upload/";
                            if (!file_exists($target_dir)) {
                                mkdir($target_dir, 0777, true);
                            }
                            $target_file = $target_dir.basename($_FILES["efile"]["name"]);
                            if(move_uploaded_file($_FILES["efile"]["tmp_name"],$target_file))
                            {
                                $sql="insert into udocuments(BTITLE,KEYWORD,FILE,UID) values ('{$_POST["bname"]}','{$_POST["keys"]}','{$target_file}',{$_SESSION["ID"]})";
                                $db->query($sql);
                                echo"<p class='success'>Document Uploaded Successfully</p>";
                            }
                            else 
                            {
                                echo"<p class='error'>Error in Upload. Please try again.</p>";
                            }
                        }   
                    ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
                        <h3>Upload Documents</h3>
                        
                        <label>Title</label>
                        <input type="text" name="bname" required placeholder="Enter document title">
                        
                        <label>Keywords</label>
                        <input type="text" name="keys" required placeholder="Enter keywords (comma separated)">
                        
                        <label>Upload File</label>
                        <div class="file-upload">
                            <input type="file" name="efile" id="file-input" required>
                            <label for="file-input" class="file-upload-label">Choose a file or drag it here</label>
                            <div class="file-name" id="file-name">No file selected</div>
                        </div>
                        
                        <button type="submit" name="submit">Upload Document</button>
                        
                        <div class="links-container">
                            <a href="upload_documents.php">Refresh</a>
                            <a href='uhome.php'>Back to Home</a>
                        </div>
                    </form>      
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>Copyright &copy; MCA Portal <?php echo date('Y'); ?></p>
        </div>
        
        <script>
            // Mobile sidebar toggle
            document.querySelector('.menu-toggle').addEventListener('click', function() {
                document.querySelector('.sidebar').classList.toggle('active');
                
                // Change icon based on sidebar state
                const icon = this.querySelector('i');
                if (icon.classList.contains('bx-menu')) {
                    icon.classList.remove('bx-menu');
                    icon.classList.add('bx-x');
                } else {
                    icon.classList.remove('bx-x');
                    icon.classList.add('bx-menu');
                }
            });
            
            // Close sidebar when clicking outside (mobile)
            document.addEventListener('click', function(event) {
                const sidebar = document.querySelector('.sidebar');
                const menuToggle = document.querySelector('.menu-toggle');
                
                if (!sidebar.contains(event.target) && 
                    !menuToggle.contains(event.target) && 
                    sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    
                    const icon = menuToggle.querySelector('i');
                    icon.classList.remove('bx-x');
                    icon.classList.add('bx-menu');
                }
            });
            
            // File input display
            document.getElementById('file-input').addEventListener('change', function() {
                const fileName = this.files[0] ? this.files[0].name : 'No file selected';
                document.getElementById('file-name').textContent = fileName;
                
                // Change style when file is selected
                if (this.files[0]) {
                    document.querySelector('.file-upload-label').style.borderColor = 'var(--primary-color)';
                    document.querySelector('.file-upload-label').style.background = 'var(--primary-light)';
                    document.getElementById('file-name').style.color = 'var(--primary-color)';
                }
            });
            
            // Drag and drop functionality
            const dropArea = document.querySelector('.file-upload');
            
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });
            
            function highlight() {
                dropArea.querySelector('.file-upload-label').style.borderColor = 'var(--primary-color)';
                dropArea.querySelector('.file-upload-label').style.background = 'var(--primary-light)';
            }
            
            function unhighlight() {
                dropArea.querySelector('.file-upload-label').style.borderColor = '#ddd';
                dropArea.querySelector('.file-upload-label').style.background = '#f9f9f9';
            }
            
            dropArea.addEventListener('drop', handleDrop, false);
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files.length) {
                    document.getElementById('file-input').files = files;
                    document.getElementById('file-name').textContent = files[0].name;
                    document.getElementById('file-name').style.color = 'var(--primary-color)';
                }
            }
        </script>
    </body>
</html>
