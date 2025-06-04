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
        <title>MCA Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        <style>
        :root {
            --primary-color: #7494ec;
            --primary-light: rgba(116, 148, 236, 0.1);
            --primary-dark: #5a7ad0;
            --accent-color: #ff6b6b;
            --text-dark: #333;
            --text-light: #777;
            --white: #ffffff;
            --shadow-light: 0 5px 15px rgba(0, 0, 0, 0.05);
            --shadow-dark: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition-speed: 0.3s;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: var(--text-dark);
            line-height: 1.6;
            position: relative;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Navigation Styles */
        .navbar {
            background: var(--white);
            box-shadow: var(--shadow-light);
            border-radius: 15px;
            padding: 15px;
            margin: 20px;
            position: relative;
            z-index: 10;
            transition: all var(--transition-speed);
        }
        
        .navbar nav ul {
            display: flex;
            flex-direction: column;
            gap: 10px;
            list-style: none;
        }
        
        .navbar button {
            background-color: transparent;
            border: none;
            width: 100%;
            text-align: left;
            border-radius: 10px;
            transition: all var(--transition-speed);
            position: relative;
            overflow: hidden;
        }
        
        .navbar button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.5s;
        }
        
        .navbar button:hover::before {
            left: 100%;
        }
        
        .navbar button:hover {
            background-color: var(--primary-light);
            transform: translateY(-3px);
        }
        
        .navbar a {
            color: var(--text-dark);
            text-decoration: none;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: all var(--transition-speed);
        }
        
        .navbar a:hover {
            color: var(--primary-color);
        }
        
        .navbar a i {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        .active-link {
            background-color: var(--primary-light);
            color: var(--primary-color) !important;
            border-left: 4px solid var(--primary-color);
        }
        
        .logo {
            text-align: center;
            padding: 20px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .logo h2 {
            color: var(--primary-color);
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .logo span {
            color: var(--accent-color);
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 20px;
            transition: all var(--transition-speed);
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-light);
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
        }
        
        .header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            position: relative;
        }
        
        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
            position: relative;
        }
        
        /* Search Form Styles */
        .search-container {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow-light);
            margin-bottom: 25px;
            transition: all var(--transition-speed);
            position: relative;
            overflow: hidden;
            border-left: 5px solid var(--primary-color);
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .search-container:hover {
            box-shadow: var(--shadow-dark);
            transform: translateY(-5px);
        }
        
        .search-container h3 {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }
        
        .search-container h3::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 3px;
        }
        
        .search-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .form-group {
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-dark);
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #eee;
            border-radius: 10px;
            font-size: 1rem;
            transition: all var(--transition-speed);
            background-color: #f9f9f9;
        }
        
        .form-group input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
            outline: none;
        }
        
        .form-group i {
            position: absolute;
            right: 15px;
            top: 45px;
            color: var(--text-light);
        }
        
        .search-actions {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }
        
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all var(--transition-speed);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .btn-primary {
            background: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(116, 148, 236, 0.3);
        }
        
        .btn-secondary {
            background: #f1f3f9;
            color: var(--text-dark);
        }
        
        .btn-secondary:hover {
            background: #e4e8f0;
            transform: translateY(-3px);
        }
        
        /* Results Table Styles */
        .results-container {
            background: var(--white);
            border-radius: 15px;
            padding: 30px;
            box-shadow: var(--shadow-light);
            margin-bottom: 25px;
            animation: fadeIn 0.8s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden;
            border-radius: 10px;
        }
        
        th {
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 15px;
            text-align: left;
            font-weight: 600;
            position: relative;
        }
        
        th:first-child {
            border-top-left-radius: 10px;
        }
        
        th:last-child {
            border-top-right-radius: 10px;
        }
        
        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            color: var(--text-dark);
            transition: all var(--transition-speed);
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
        }
        
        tr:last-child td:last-child {
            border-bottom-right-radius: 10px;
        }
        
        tr:hover td {
            background-color: #f9f9f9;
        }
        
        td a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all var(--transition-speed);
            display: inline-flex;
            align-items: center;
        }
        
        td a i {
            margin-right: 5px;
        }
        
        td a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .error {
            color: var(--accent-color);
            text-align: center;
            padding: 20px;
            font-size: 1.1rem;
            background: rgba(255, 107, 107, 0.1);
            border-radius: 10px;
            margin-top: 20px;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-light);
        }
        
        .empty-state i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: var(--text-dark);
        }
        
        /* Footer Styles */
        .footer {
            background: var(--white);
            color: var(--text-dark);
            text-align: center;
            padding: 15px;
            border-radius: 15px;
            margin: 20px;
            box-shadow: var(--shadow-light);
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .container {
                flex-direction: column;
            }
            
            .navbar {
                margin-bottom: 0;
            }
            
            .navbar nav ul {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .navbar button {
                width: auto;
            }
            
            .logo {
                padding: 10px 0;
                margin-bottom: 10px;
            }
            
            .search-actions {
                flex-direction: column;
            }
        }
        
        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.8rem;
            }
            
            .navbar nav ul {
                justify-content: space-between;
            }
            
            .navbar a {
                padding: 10px;
            }
            
            .navbar a i {
                margin-right: 5px;
                font-size: 1.2rem;
            }
            
            .search-container {
                padding: 20px;
            }
            
            .search-container h3 {
                font-size: 1.5rem;
            }
            
            th, td {
                padding: 10px;
            }
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .search-container h3 {
            animation: pulse 2s infinite;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
        
        /* Document Card Styles */
        .document-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .document-card {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            transition: all var(--transition-speed);
            position: relative;
            display: flex;
            flex-direction: column;
        }
        
        .document-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-dark);
        }
        
        .document-icon {
            height: 120px;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .document-icon i {
            font-size: 3rem;
            color: var(--primary-color);
        }
        
        .document-info {
            padding: 20px;
            flex: 1;
        }
        
        .document-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-dark);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .document-keywords {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .document-actions {
            padding: 15px 20px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }
        
        .view-btn {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all var(--transition-speed);
        }
        
        .view-btn i {
            margin-right: 5px;
        }
        
        .view-btn:hover {
            color: var(--primary-dark);
        }
        
        /* Toggle View Button */
        .view-toggle {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }
        
        .toggle-btn {
            background: var(--white);
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 8px 12px;
            margin-left: 10px;
            cursor: pointer;
            transition: all var(--transition-speed);
            display: flex;
            align-items: center;
        }
        
        .toggle-btn i {
            font-size: 1.2rem;
        }
        
        .toggle-btn.active {
            background: var(--primary-light);
            color: var(--primary-color);
            border-color: var(--primary-light);
        }
        
        .toggle-btn:hover {
            background: #f5f5f5;
        }
        
        .toggle-btn.active:hover {
            background: var(--primary-light);
        }
        
        /* Hide elements based on view */
        .table-view .document-cards {
            display: none;
        }
        
        .card-view table {
            display: none;
        }
        
        .card-view .document-cards {
            display: grid;
        }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <h2>MCA <span>Portal</span></h2>
                </div>
                <nav>
                    <ul>
                        <button>
                            <a href="uhome.php">
                                <i class='bx bxs-home'></i> Home
                            </a>
                        </button>
                        <button>
                            <a href="view_announcement.php">
                                <i class='bx bxs-megaphone'></i> Announcements
                            </a>
                        </button>
                        <button>
                            <a href="contest.php">
                                <i class='bx bxs-trophy'></i> Contests
                            </a>
                        </button>
                        <button>
                            <a href="view_documents.php" class="active-link">
                                <i class='bx bxs-book'></i> Documents
                            </a>
                        </button>
                        <button>
                            <a href="odapply.php">
                                <i class='bx bxs-calendar-check'></i> OD Apply
                            </a>
                        </button>
                        <button>
                            <a href="view_payment.php">
                                <i class='bx bxs-wallet'></i> Payments
                            </a>
                        </button>
                        <button>
                            <a href="suggestion.php">
                                <i class='bx bxs-message-rounded-dots'></i> Suggestions
                            </a>
                        </button>
                    </ul>
                </nav>
            </div>
            
            <div class="main-content">
                <div class="header">
                    <h1>Document Library</h1>
                    <p>Search and access all your academic documents and resources</p>
                </div>
                
                <div class="search-container">
                    <h3>Search Documents</h3>
                    <form class="search-form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                        <div class="form-group">
                            <label>Enter Document Title or Keywords</label>
                            <input type="text" required name="name" placeholder="e.g., Machine Learning, Python, Database...">
                            <i class='bx bx-search'></i>
                        </div>
                        <div class="search-actions">
                            <button type="submit" name="submit" class="btn btn-primary">
                                <i class='bx bx-search'></i> Search
                            </button>
                            <a href="view_documents.php" class="btn btn-secondary">
                                <i class='bx bx-arrow-back'></i> Back
                            </a>
                            <a href="search_books.php" class="btn btn-secondary">
                                <i class='bx bx-refresh'></i> Refresh
                            </a>
                        </div>
                    </form>
                </div>
                
                <div class="results-container table-view" id="resultsContainer">
                    <div class="view-toggle">
                        <button class="toggle-btn active" id="tableViewBtn" title="Table View">
                            <i class='bx bx-table'></i>
                        </button>
                        <button class="toggle-btn" id="cardViewBtn" title="Card View">
                            <i class='bx bx-grid-alt'></i>
                        </button>
                    </div>
                    
                    <?php
                        if(isset($_POST["submit"]))
                        {
                            $sql="SELECT * FROM udocuments WHERE BTITLE like '%{$_POST["name"]}%' or Keyword like '%{$_POST["name"]}%'";
                            $sql="SELECT * FROM udocuments WHERE UID={$_SESSION["ID"]}";
                            $res=$db->query($sql);
                            if($res->num_rows>0)
                            {
                                echo"<table>
                                <tr>
                                <th>SNO</th>
                                <th>TITLE</th>
                                <th>KEYWORDS</th>
                                <th>VIEW</th>
                                </tr>
                                ";
                                $i=0;
                                echo "<div class='document-cards'>";
                                while($row=$res->fetch_assoc())
                                {            
                                    $i++;
                                    echo"<tr>";
                                        echo"<td>{$i}</td>";
                                        echo"<td>{$row["BTITLE"]}</td>";
                                        echo"<td>{$row["KEYWORD"]}</td>";
                                        echo"<td><a href='{$row["FILE"]}' target='_blank'><i class='bx bx-file'></i> View</a></td>";
                                    echo"</tr>";
                                    
                                    // Card view (hidden by default)
                                    echo "<div class='document-card'>";
                                        echo "<div class='document-icon'>";
                                            echo "<i class='bx bxs-file-pdf'></i>";
                                        echo "</div>";
                                        echo "<div class='document-info'>";
                                            echo "<div class='document-title'>{$row["BTITLE"]}</div>";
                                            echo "<div class='document-keywords'><i class='bx bx-tag-alt'></i> {$row["KEYWORD"]}</div>";
                                        echo "</div>";
                                        echo "<div class='document-actions'>";
                                            echo "<a href='{$row["FILE"]}' target='_blank' class='view-btn'><i class='bx bx-file'></i> View Document</a>";
                                            echo "<span>#{$i}</span>";
                                        echo "</div>";
                                    echo "</div>";
                                }
                                echo "</div>";
                                echo"</table>";
                            }
                            else
                            {
                                echo "<div class='empty-state'>";
                                    echo "<i class='bx bx-search-alt'></i>";
                                    echo "<h3>No Documents Found</h3>";
                                    echo "<p>Try searching with different keywords or check your document library.</p>";
                                echo "</div>";
                            }
                        } else {
                            echo "<div class='empty-state'>";
                                echo "<i class='bx bx-book-open'></i>";
                                echo "<h3>Search for Documents</h3>";
                                echo "<p>Enter keywords or document titles to find what you're looking for.</p>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>Copyright &copy; MCA Portal 2025</p>
        </div>
        
        <script>
            // Toggle between table and card view
            const tableViewBtn = document.getElementById('tableViewBtn');
            const cardViewBtn = document.getElementById('cardViewBtn');
            const resultsContainer = document.getElementById('resultsContainer');
            
            tableViewBtn.addEventListener('click', function() {
                resultsContainer.classList.remove('card-view');
                resultsContainer.classList.add('table-view');
                tableViewBtn.classList.add('active');
                cardViewBtn.classList.remove('active');
            });
            
            cardViewBtn.addEventListener('click', function() {
                resultsContainer.classList.remove('table-view');
                resultsContainer.classList.add('card-view');
                cardViewBtn.classList.add('active');
                tableViewBtn.classList.remove('active');
            });
            
            // Add animation to search results
            document.addEventListener('DOMContentLoaded', function() {
                const searchForm = document.querySelector('.search-form');
                searchForm.addEventListener('submit', function() {
                    resultsContainer.style.animation = 'none';
                    setTimeout(() => {
                        resultsContainer.style.animation = 'fadeIn 0.8s ease-out forwards';
                    }, 10);
                });
            });
        </script>
    </body>
</html>
