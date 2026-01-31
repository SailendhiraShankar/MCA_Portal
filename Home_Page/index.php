<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCA Portal</title>
    <style>
       /* Home Page Styles for MCA Portal - Blue & White Theme */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap' );

:root {
    --primary-blue: #1a73e8;
    --secondary-blue: #4285f4;
    --dark-blue: #0d47a1;
    --light-blue: #e8f0fe;
    --hover-blue: #d2e3fc;
    --white: #ffffff;
    --light-gray: #f5f5f5;
    --medium-gray: #e0e0e0;
    --text-dark: #202124;
    --text-gray: #5f6368;
    --shadow-color: rgba(0, 0, 0, 0.1);
    --transition-speed: 0.3s;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

html {
    scroll-behavior: smooth;
}

body {
    background-color: var(--light-gray);
    color: var(--text-dark);
    overflow-x: hidden;
    position: relative;
    min-height: 100vh;
}

/* Background Animation */
.background-animation {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    overflow: hidden;
}

.shape {
    position: absolute;
    border-radius: 50%;
    filter: blur(60px);
    opacity: 0.4;
}

.shape1 {
    background: var(--primary-blue);
    width: 500px;
    height: 500px;
    top: -250px;
    left: -250px;
    animation: float 15s ease-in-out infinite;
}

.shape2 {
    background: var(--secondary-blue);
    width: 400px;
    height: 400px;
    bottom: -200px;
    right: -200px;
    animation: float 18s ease-in-out infinite reverse;
}

.shape3 {
    background: var(--light-blue);
    width: 300px;
    height: 300px;
    top: 50%;
    right: 10%;
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0% {
        transform: translate(0, 0) rotate(0deg);
    }
    25% {
        transform: translate(50px, 50px) rotate(90deg);
    }
    50% {
        transform: translate(0, 100px) rotate(180deg);
    }
    75% {
        transform: translate(-50px, 50px) rotate(270deg);
    }
    100% {
        transform: translate(0, 0) rotate(360deg);
    }
}

/* Header Styles */
header {
    background-color: var(--white);
    padding: 20px 5%;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 2px 10px var(--shadow-color);
    position: sticky;
    top: 0;
    z-index: 100;
}

.logo {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo i {
    font-size: 28px;
    color: var(--primary-blue);
}

.logo h1 {
    font-size: 24px;
    font-weight: 600;
    color: var(--primary-blue);
}

/* Main Content */
main {
    padding: 0 0 50px;
}

/* Hero Section */
.hero {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 60px 5%;
    min-height: calc(100vh - 70px);
    flex-wrap: wrap;
}

.hero-content {
    flex: 1;
    min-width: 300px;
    animation: fadeInUp 1s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero-content h2 {
    font-size: 2.8rem;
    margin-bottom: 20px;
    color: var(--text-dark);
    line-height: 1.2;
}

.hero-content h2 span {
    color: var(--primary-blue);
    position: relative;
    display: inline-block;
}

.hero-content h2 span::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 8px;
    background-color: var(--light-blue);
    z-index: -1;
}

.hero-content p {
    font-size: 1.2rem;
    margin-bottom: 40px;
    color: var(--text-gray);
}

.portal-buttons {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.portal-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 15px 30px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all var(--transition-speed);
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.portal-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, var(--primary-blue), var(--secondary-blue));
    z-index: -1;
    transition: all 0.5s ease;
}

.portal-btn::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, var(--secondary-blue), var(--dark-blue));
    z-index: -1;
    transition: all 0.5s ease;
}

.portal-btn:hover::after {
    left: 0;
}

.portal-btn i {
    font-size: 1.3rem;
}

.student-btn {
    background-color: var(--primary-blue);
    color: var(--white);
    box-shadow: 0 5px 15px rgba(26, 115, 232, 0.3);
}

.staff-btn {
    background-color: var(--white);
    color: var(--primary-blue);
    border: 2px solid var(--primary-blue);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.staff-btn::before, .staff-btn::after {
    opacity: 0;
}

.staff-btn:hover {
    background-color: var(--primary-blue);
    color: var(--white);
}

.staff-btn:hover::before {
    opacity: 1;
}

.secondary-buttons {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.secondary-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    color: var(--text-gray);
    background-color: var(--white);
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    transition: all var(--transition-speed);
}

.secondary-btn:hover {
    color: var(--primary-blue);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.hero-image {
    flex: 1;
    min-width: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    height: 400px;
}

.floating-elements {
    position: relative;
    width: 100%;
    height: 100%;
}

.element {
    position: absolute;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 120px;
    height: 120px;
    background-color: var(--white);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 15px;
    text-align: center;
    transition: all var(--transition-speed);
}

.element i {
    font-size: 2rem;
    color: var(--primary-blue);
    margin-bottom: 10px;
}

.element span {
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text-dark);
}

.element:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.element1 {
    top: 0;
    left: 10%;
    animation: float-element 6s ease-in-out infinite;
}

.element2 {
    top: 30%;
    right: 10%;
    animation: float-element 7s ease-in-out infinite 1s;
}

.element3 {
    bottom: 0;
    left: 20%;
    animation: float-element 5s ease-in-out infinite 0.5s;
}

.element4 {
    bottom: 30%;
    right: 0;
    animation: float-element 8s ease-in-out infinite 1.5s;
}

@keyframes float-element {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

/* Section Styles */
section {
    padding: 80px 5%;
}

.section-header {
    text-align: center;
    margin-bottom: 50px;
}

.section-header h2 {
    font-size: 2.2rem;
    color: var(--text-dark);
    margin-bottom: 15px;
    position: relative;
    display: inline-block;
}

.underline {
    width: 80px;
    height: 4px;
    background: linear-gradient(to right, var(--primary-blue), var(--secondary-blue));
    margin: 0 auto;
    border-radius: 2px;
}

/* Data Hub Section */
.data-hub {
    background-color: var(--white);
}

.data-hub-content {
    display: flex;
    align-items: center;
    gap: 50px;
    flex-wrap: wrap;
}

.data-hub-text {
    flex: 1;
    min-width: 300px;
}

.data-hub-text p {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 30px;
    color: var(--text-dark);
}

.highlight {
    color: var(--primary-blue);
    font-weight: 600;
}

.feature-links {
    list-style: none;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.feature-links li {
    position: relative;
}

.feature-links a {
    text-decoration: none;
    color: var(--text-dark);
    font-weight: 500;
    padding: 8px 15px;
    border-radius: 50px;
    background-color: var(--light-blue);
    transition: all var(--transition-speed);
    display: inline-block;
}

.feature-links a:hover {
    background-color: var(--primary-blue);
    color: var(--white);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.data-hub-image {
    flex: 1;
    min-width: 300px;
    display: flex;
    justify-content: center;
}

.data-hub-image img {
    max-width: 100%;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all var(--transition-speed);
}

.data-hub-image img:hover {
    transform: scale(1.03);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

/* Uses Section */
.uses-section {
    background-color: var(--light-gray);
}

.uses-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.use-card {
    background-color: var(--white);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: all var(--transition-speed);
    text-align: center;
}

.use-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.use-icon {
    width: 70px;
    height: 70px;
    background-color: var(--light-blue);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}

.use-icon i {
    font-size: 30px;
    color: var(--primary-blue);
}

.use-card h3 {
    font-size: 1.2rem;
    margin-bottom: 15px;
    color: var(--text-dark);
}

.use-card p {
    color: var(--text-gray);
    line-height: 1.6;
}

/* Access Section */
.access-section {
    background-color: var(--white);
}

.access-section h3 {
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: var(--text-dark);
}

.access-section > p {
    font-size: 1.1rem;
    margin-bottom: 30px;
    color: var(--text-gray);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.feature-item {
    background-color: var(--light-blue);
    padding: 20px;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    transition: all var(--transition-speed);
}

.feature-item:hover {
    transform: translateY(-5px);
    background-color: var(--primary-blue);
    color: var(--white);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.feature-item i {
    font-size: 2rem;
    margin-bottom: 15px;
    color: var(--primary-blue);
    transition: all var(--transition-speed);
}

.feature-item:hover i {
    color: var(--white);
}

.feature-item span {
    font-weight: 500;
}

/* Contact Section */
.contact-section {
    background-color: var(--light-gray);
}

.contact-content {
    display: flex;
    gap: 50px;
    flex-wrap: wrap;
}

.contact-info, .contact-form {
    flex: 1;
    min-width: 300px;
}

.contact-info h3, .contact-form h3 {
    font-size: 1.5rem;
    margin-bottom: 30px;
    color: var(--text-dark);
}

.contact-details {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.contact-item i {
    font-size: 1.5rem;
    color: var(--primary-blue);
    margin-top: 5px;
}

.contact-item p {
    line-height: 1.6;
    color: var(--text-gray);
}

.form-group {
    margin-bottom: 20px;
}

.form-group input, .form-group textarea {
    width: 100%;
    padding: 15px;
    border: 1px solid var(--medium-gray);
    border-radius: 5px;
    font-size: 1rem;
    transition: all var(--transition-speed);
}

.form-group textarea {
    height: 150px;
    resize: vertical;
}

.form-group input:focus, .form-group textarea:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.2);
}

.submit-btn {
    background-color: var(--primary-blue);
    color: var(--white);
    border: none;
    padding: 15px 30px;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-speed);
}

.submit-btn:hover {
    background-color: var(--dark-blue);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

/* Footer */
footer {
    background-color: var(--dark-blue);
    color: var(--white);
    padding: 50px 5% 20px;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 30px;
    margin-bottom: 30px;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 10px;
}

.footer-logo i {
    font-size: 24px;
}

.footer-logo h3 {
    font-size: 1.5rem;
    font-weight: 600;
}

.footer-links h4 {
    font-size: 1.2rem;
    margin-bottom: 20px;
}

.footer-links ul {
    list-style: none;
}

.footer-links li {
    margin-bottom: 10px;
}

.footer-links a {
    text-decoration: none;
    color: var(--light-gray);
    transition: color var(--transition-speed);
}

.footer-links a:hover {
    color: var(--white);
}

.footer-bottom {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-bottom p {
    color: var(--light-gray);
    font-size: 0.9rem;
}

/* Back to Top Button */
.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background-color: var(--primary-blue);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    opacity: 0;
    visibility: hidden;
    transition: all var(--transition-speed);
    z-index: 99;
}

.back-to-top.active {
    opacity: 1;
    visibility: visible;
}

.back-to-top:hover {
    background-color: var(--dark-blue);
    transform: translateY(-5px);
}

/* Responsive Design */
@media (max-width: 992px) {
    .hero {
        flex-direction: column;
        text-align: center;
        padding: 40px 5%;
    }
    
    .hero-content {
        margin-bottom: 50px;
    }
    
    .portal-buttons, .secondary-buttons {
        justify-content: center;
    }
    
    .data-hub-content {
        flex-direction: column;
        text-align: center;
    }
    
    .feature-links {
        justify-content: center;
    }
    
    .contact-content {
        flex-direction: column;
    }
}

@media (max-width: 768px) {
    .hero-content h2 {
        font-size: 2.2rem;
    }
    
    .section-header h2 {
        font-size: 1.8rem;
    }
    
    .footer-content {
        flex-direction: column;
        text-align: center;
    }
    
    .footer-logo {
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .hero-content h2 {
        font-size: 1.8rem;
    }
    
    .portal-buttons {
        flex-direction: column;
    }
    
    .portal-btn {
        width: 100%;
    }
    
    .element {
        width: 100px;
        height: 100px;
    }
    
    .element i {
        font-size: 1.5rem;
    }
    
    .element span {
        font-size: 0.8rem;
    }
}

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="background-animation">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
    </div>

    <header>
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            <h1>MCA Portal</h1>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h2>Welcome to <span>MCA Department</span></h2>
                <p>Your gateway to academic excellence and digital innovation</p>
                <div class="portal-buttons">
                    <a href="Student_Portal/ulogin.php" class="portal-btn student-btn">
                        <i class="fas fa-user-graduate"></i>
                        <span>Student Portal</span>
                    </a>
                    <a href="Staff_Portal/slogin.php" class="portal-btn staff-btn">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Staff Portal</span>
                    </a>
                </div>
                <div class="secondary-buttons">
                    <a href="Student_Portal/new.php" class="secondary-btn">
                        <i class="fas fa-user-plus"></i>
                        <span>New User Registration</span>
                    </a>
                    <a href="#section3" class="secondary-btn">
                        <i class="fas fa-info-circle"></i>
                        <span>About Us</span>
                    </a>
                </div>
            </div>
            <div class="hero-image">
                <div class="floating-elements">
                    <div class="element element1">
                        <i class="fas fa-file-alt"></i>
                        <span>Documents</span>
                    </div>
                    <div class="element element2">
                        <i class="fas fa-bullhorn"></i>
                        <span>Announcements</span>
                    </div>
                    <div class="element element3">
                        <i class="fas fa-comments"></i>
                        <span>Comments</span>
                    </div>
                    <div class="element element4">
                        <i class="fas fa-credit-card"></i>
                        <span>Payments</span>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="data-hub">
            <div class="section-header">
                <h2>MCA Student & Staff Portal</h2>
                <div class="underline"></div>
            </div>
            <div class="data-hub-content">
                <div class="data-hub-text">
                    <p>The <span class="highlight">MCA Student & Staff Portal</span> is a comprehensive platform designed specifically for the MCA department. This integrated system provides students and faculty with easy access to academic resources, course materials, and departmental communications all in one place.
                    </p>
                    <ul class="feature-links">
                        <li><a href="#section1" class="scroll-link">Portal Features</a></li>
                        <li><a href="#section2" class="scroll-link">Access & Services</a></li>
                        <li><a href="#section3" class="scroll-link">About</a></li>
                    </ul>
                </div>
                <div class="data-hub-image">
                    <img src="m.jpg" alt="MCA Portal Illustration">
                </div>
            </div>
        </section>

        <section id="section1" class="uses-section">
            <div class="section-header">
                <h2>Portal Features</h2>
                <div class="underline"></div>
            </div>
            <div class="uses-grid">
                <div class="use-card">
                    <div class="use-icon">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <h3>Cloud Storage</h3>
                    <p>The cloud storage is a service where data is remotely maintained, managed and backed up.</p>
                </div>
                <div class="use-card">
                    <div class="use-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>User Interactions</h3>
                    <p>This site contains user interactions that give a new look and visual experience for the users.</p>
                </div>
                <div class="use-card">
                    <div class="use-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3>Session Locking</h3>
                    <p>Improves security by clearing sessions when you navigate away and preventing unauthorized access.</p>
                </div>
                <div class="use-card">
                    <div class="use-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3>Information</h3>
                    <p>Information based on government official sites, presented in an interesting way for all users.</p>
                </div>
            </div>
        </section>

        <section id="section2" class="access-section">
            <div class="section-header">
                <h2>Access & Services</h2>
                <div class="underline"></div>
            </div>
            <h3>User Access</h3>
            <p>Users can access these features in the webpage:</p>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fas fa-file-upload"></i>
                    <span>Store Documents</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-bullhorn"></i>
                    <span>Announcement</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-file-alt"></i>
                    <span>View Documents</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-lightbulb"></i>
                    <span>Suggestion</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-laptop-code"></i>
                    <span>Coding Contest</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-key"></i>
                    <span>Change Password</span>
                </div>
                <div class="feature-item">
                    <i class="fa fa-credit-card"></i>
                    <span>Payment</span>
                </div>
            </div>
        </section>

        <section id="section3" class="contact-section">
            <div class="section-header">
                <h2>About</h2>
                <div class="underline"></div>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <h3>Contact</h3>
                    <div class="contact-details">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>06/Vivekandar Street,<br>Dubai cross alley,<br>Dubai Main Road,<br>Dubai.</p>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <p>+91 000 000 000</p>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <p>contact@mcaportal.edu</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <h3>Send us a message</h3>
                    <form>
                        <div class="form-group">
                            <input type="text" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="submit-btn">Send Message</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <i class="fas fa-graduation-cap"></i>
                <h3>MCA Portal</h3>
            </div>
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="Student_Portal/ulogin.php">Student Login</a></li>
                    <li><a href="Staff_Portal/slogin.php">Staff Login</a></li>
                    <li><a href="Student_Portal/new.php">Register</a></li>
                    <li><a href="#section3">About Us</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Copyright &copy; MCA Portal 2025. All rights reserved.</p>
        </div>
    </footer>

    <a href="#" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </a>

    <script>
      // Home Page JavaScript for MCA Portal
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            if (this.getAttribute('href') !== '#') {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    // Scroll to target
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
    
    // Back to top button
    const backToTopBtn = document.querySelector('.back-to-top');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.classList.add('active');
        } else {
            backToTopBtn.classList.remove('active');
        }
    });
    
    backToTopBtn.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Portal buttons hover effect
    const portalBtns = document.querySelectorAll('.portal-btn');
    
    portalBtns.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.15)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = btn.classList.contains('student-btn') ? 
                '0 5px 15px rgba(26, 115, 232, 0.3)' : 
                '0 5px 15px rgba(0, 0, 0, 0.05)';
        });
    });
    
    // Add ripple effect to buttons
    const buttons = document.querySelectorAll('button, .portal-btn, .secondary-btn');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const x = e.clientX - this.getBoundingClientRect().left;
            const y = e.clientY - this.getBoundingClientRect().top;
            
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Add ripple style
    const style = document.createElement('style');
    style.textContent = `
        .ripple {
            position: absolute;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        .portal-btn, .secondary-btn {
            position: relative;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
    
    // Animate elements on scroll
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.section-header, .use-card, .feature-item, .contact-content');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementPosition < windowHeight - 100) {
                element.classList.add('animate');
            }
        });
    };
    
    // Add animation styles
    const animationStyle = document.createElement('style');
    animationStyle.textContent = `
        .section-header, .use-card, .feature-item, .contact-content {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        
        .section-header.animate, .use-card.animate, .feature-item.animate, .contact-content.animate {
            opacity: 1;
            transform: translateY(0);
        }
        
        .use-card:nth-child(2), .feature-item:nth-child(2) {
            transition-delay: 0.1s;
        }
        
        .use-card:nth-child(3), .feature-item:nth-child(3) {
            transition-delay: 0.2s;
        }
        
        .use-card:nth-child(4), .feature-item:nth-child(4) {
            transition-delay: 0.3s;
        }
        
        .use-card:nth-child(5), .feature-item:nth-child(5) {
            transition-delay: 0.4s;
        }
    `;
    document.head.appendChild(animationStyle);
    
    // Run on load and scroll
    animateOnScroll();
    window.addEventListener('scroll', animateOnScroll);
});
    </script>
</body>
</html>
