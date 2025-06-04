<?php
    session_start();
    include"database.php";
    if(!isset($_SESSION["ID"]))
    {
	    header("location:ulogin.php");
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>MCA Portal - Send Suggestion</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' );

            :root {
                --primary-color: #7494ec;
                --primary-light: rgba(116, 148, 236, 0.1);
                --primary-dark: #5a7ad0;
                --accent-color: #ff6b6b;
                --success-color: #2ed573;
                --error-color: #ff4757;
                --text-dark: #333;
                --text-light: #777;
                --white: #ffffff;
                --bg-light: #f8f9fa;
                --transition-speed: 0.3s;
                --shadow-light: 0 5px 15px rgba(0, 0, 0, 0.05);
                --shadow-dark: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
            }

            body {
                background: linear-gradient(135deg, #c9d6ff, #e2e2e2);
                color: var(--text-dark);
                line-height: 1.6;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
            }

            .container {
                width: 100%;
                max-width: 600px;
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .center {
                background: var(--white);
                border-radius: 20px;
                padding: 30px;
                box-shadow: var(--shadow-light);
                transition: all var(--transition-speed);
                position: relative;
                overflow: hidden;
                animation: fadeIn 0.8s ease-out forwards;
            }

            .center:hover {
                box-shadow: var(--shadow-dark);
                transform: translateY(-5px);
            }

            .center::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 5px;
                background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            }

            .heading {
                color: var(--primary-color);
                font-size: 28px;
                margin-bottom: 25px;
                text-align: center;
                position: relative;
                display: inline-block;
                left: 50%;
                transform: translateX(-50%);
            }

            .heading::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 0;
                width: 100%;
                height: 3px;
                background: var(--primary-color);
                border-radius: 3px;
            }

            form {
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            label {
                font-weight: 500;
                color: var(--text-dark);
                font-size: 16px;
                margin-bottom: 5px;
                display: block;
            }

            input, textarea {
                width: 100%;
                padding: 15px;
                border-radius: 12px;
                border: 1px solid #e0e0e0;
                background: #f9f9f9;
                font-size: 16px;
                color: var(--text-dark);
                transition: all var(--transition-speed);
                resize: none;
            }

            textarea {
                min-height: 120px;
            }

            input:focus, textarea:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px var(--primary-light);
                outline: none;
                background: var(--white);
            }

            button {
                background: var(--primary-color);
                color: var(--white);
                border: none;
                padding: 15px;
                border-radius: 12px;
                font-weight: 600;
                font-size: 16px;
                cursor: pointer;
                transition: all var(--transition-speed);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                position: relative;
                overflow: hidden;
            }

            button::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: all 0.5s;
            }

            button:hover::before {
                left: 100%;
            }

            button:hover {
                background: var(--primary-dark);
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(116, 148, 236, 0.3);
            }

            button i {
                font-size: 20px;
            }

            .links {
                display: flex;
                justify-content: space-between;
                margin-top: 15px;
            }

            .links a {
                color: var(--primary-color);
                text-decoration: none;
                font-weight: 500;
                transition: all var(--transition-speed);
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .links a:hover {
                color: var(--primary-dark);
                transform: translateY(-2px);
            }

            .links a i {
                font-size: 18px;
            }

            .success {
                background-color: rgba(46, 213, 115, 0.1);
                color: var(--success-color);
                padding: 15px;
                border-radius: 12px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 500;
                border-left: 4px solid var(--success-color);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                animation: slideDown 0.5s ease-out forwards;
            }

            .success i {
                font-size: 20px;
            }

            .error {
                background-color: rgba(255, 71, 87, 0.1);
                color: var(--error-color);
                padding: 15px;
                border-radius: 12px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 500;
                border-left: 4px solid var(--error-color);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                animation: shake 0.5s ease-in-out;
            }

            .error i {
                font-size: 20px;
            }

            .footer {
                text-align: center;
                padding: 15px;
                background: rgba(255, 255, 255, 0.8);
                color: var(--text-light);
                font-size: 14px;
                border-radius: 15px;
                backdrop-filter: blur(10px);
            }

            /* Animations */
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            @keyframes slideDown {
                from { opacity: 0; transform: translateY(-20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }

            /* Floating labels effect */
            .input-container {
                position: relative;
            }

            .input-container label {
                position: absolute;
                top: 15px;
                left: 15px;
                color: var(--text-light);
                transition: all 0.3s ease;
                pointer-events: none;
                background: transparent;
            }

            .input-container input:focus ~ label,
            .input-container input:not(:placeholder-shown) ~ label,
            .input-container textarea:focus ~ label,
            .input-container textarea:not(:placeholder-shown) ~ label {
                top: -10px;
                left: 10px;
                font-size: 12px;
                padding: 0 5px;
                background: white;
                color: var(--primary-color);
            }

            /* Character counter */
            .char-counter {
                position: absolute;
                bottom: 10px;
                right: 15px;
                font-size: 12px;
                color: var(--text-light);
                transition: all var(--transition-speed);
            }

            .char-counter.warning {
                color: var(--warning-color);
            }

            .char-counter.danger {
                color: var(--error-color);
            }

            /* Responsive styles */
            @media (max-width: 576px) {
                .center {
                    padding: 20px;
                }

                .heading {
                    font-size: 24px;
                }

                input, textarea, button {
                    padding: 12px;
                }

                .links {
                    flex-direction: column;
                    gap: 15px;
                    align-items: center;
                }
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

            /* Emoji picker */
            .emoji-picker {
                display: flex;
                gap: 10px;
                margin-bottom: 15px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .emoji {
                font-size: 20px;
                cursor: pointer;
                transition: all var(--transition-speed);
                background: var(--primary-light);
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
            }

            .emoji:hover {
                transform: scale(1.2);
                background: var(--primary-color);
                color: white;
            }

            /* Mood selector */
            .mood-selector {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
            }

            .mood-option {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 5px;
                cursor: pointer;
            }

            .mood-icon {
                font-size: 24px;
                transition: all var(--transition-speed);
            }

            .mood-label {
                font-size: 12px;
                color: var(--text-light);
            }

            .mood-option:hover .mood-icon {
                transform: scale(1.2);
                color: var(--primary-color);
            }

            .mood-option.selected .mood-icon {
                color: var(--primary-color);
            }

            .mood-option.selected .mood-label {
                color: var(--primary-color);
                font-weight: 500;
            }
        </style>
    </head>
    <body>
        <div class="container">
          <div class="center">
            <?php
                if(isset($_POST["submit"]))
                {
                    $v1=mysqli_real_escape_string($db,$_POST["mes"]);
                    $sql="INSERT INTO comment(UID, COMM, LOGS) VALUES ({$_SESSION["ID"]},'$v1',now())";
                    $db->query($sql);
                    echo "<div class='success'><i class='bx bxs-check-circle'></i> Comment Sent Successfully</div>";
                }  
            ?>
            <form action="<?php echo $_SERVER["REQUEST_URI"];?>" method="post" id="suggestionForm">
                <h3 class="heading">Send Suggestion</h3>
                
                <!-- Mood selector -->
                <div class="mood-selector">
                    <div class="mood-option" data-mood="happy">
                        <div class="mood-icon">😊</div>
                        <div class="mood-label">Happy</div>
                    </div>
                    <div class="mood-option" data-mood="idea">
                        <div class="mood-icon">💡</div>
                        <div class="mood-label">Idea</div>
                    </div>
                    <div class="mood-option" data-mood="question">
                        <div class="mood-icon">❓</div>
                        <div class="mood-label">Question</div>
                    </div>
                    <div class="mood-option" data-mood="concern">
                        <div class="mood-icon">😕</div>
                        <div class="mood-label">Concern</div>
                    </div>
                    <div class="mood-option" data-mood="feedback">
                        <div class="mood-icon">📝</div>
                        <div class="mood-label">Feedback</div>
                    </div>
                </div>
                
                <div class="input-container">
                    <textarea id="suggestionText" name="mes" placeholder=" " required></textarea>
                    <label for="suggestionText">Your Suggestion</label>
                    <div class="char-counter">0/300</div>
                </div>
                
                <!-- Quick emoji picker -->
                <div class="emoji-picker">
                    <div class="emoji" data-emoji="👍">👍</div>
                    <div class="emoji" data-emoji="👏">👏</div>
                    <div class="emoji" data-emoji="🙌">🙌</div>
                    <div class="emoji" data-emoji="🎉">🎉</div>
                    <div class="emoji" data-emoji="🚀">🚀</div>
                </div>
                
                <button type="submit" name="submit" id="submitBtn">
                    <i class='bx bxs-send'></i> Post Suggestion
                </button>
                
                <div class="links">
                    <a href="comment.php"><i class='bx bx-refresh'></i> Refresh</a>
                    <a href="suggestion.php"><i class='bx bx-arrow-back'></i> Back to Suggestions</a>
                </div>
            </form>
          </div>
          <div class="footer">
             <p>Copyright &copy; MCA Portal 2025</p>
          </div>
        </div>

        <script>
            // Character counter
            const suggestionText = document.getElementById('suggestionText');
            const charCounter = document.querySelector('.char-counter');
            const maxLength = 300;
            
            suggestionText.addEventListener('input', function() {
                const currentLength = this.value.length;
                charCounter.textContent = `${currentLength}/${maxLength}`;
                
                if (currentLength > maxLength * 0.8 && currentLength <= maxLength * 0.9) {
                    charCounter.className = 'char-counter warning';
                } else if (currentLength > maxLength * 0.9) {
                    charCounter.className = 'char-counter danger';
                } else {
                    charCounter.className = 'char-counter';
                }
                
                // Limit text length
                if (currentLength > maxLength) {
                    this.value = this.value.substring(0, maxLength);
                    charCounter.textContent = `${maxLength}/${maxLength}`;
                }
            });
            
            // Emoji picker
            const emojis = document.querySelectorAll('.emoji');
            emojis.forEach(emoji => {
                emoji.addEventListener('click', function() {
                    const emojiChar = this.getAttribute('data-emoji');
                    suggestionText.value += emojiChar;
                    suggestionText.focus();
                    
                    // Trigger input event to update character counter
                    const event = new Event('input');
                    suggestionText.dispatchEvent(event);
                });
            });
            
            // Mood selector
            const moodOptions = document.querySelectorAll('.mood-option');
            moodOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove selected class from all options
                    moodOptions.forEach(opt => opt.classList.remove('selected'));
                    
                    // Add selected class to clicked option
                    this.classList.add('selected');
                    
                    // Get mood and add prefix to suggestion text
                    const mood = this.getAttribute('data-mood');
                    const moodPrefixes = {
                        'happy': 'I really like ',
                        'idea': 'I have an idea: ',
                        'question': 'I was wondering about ',
                        'concern': 'I am concerned about ',
                        'feedback': 'My feedback is '
                    };
                    
                    // Only add prefix if text is empty
                    if (suggestionText.value.trim() === '') {
                        suggestionText.value = moodPrefixes[mood];
                        suggestionText.focus();
                        
                        // Place cursor at end of text
                        suggestionText.selectionStart = suggestionText.value.length;
                        suggestionText.selectionEnd = suggestionText.value.length;
                        
                        // Trigger input event to update character counter
                        const event = new Event('input');
                        suggestionText.dispatchEvent(event);
                    }
                });
            });
            
            // Form submission animation
            const form = document.getElementById('suggestionForm');
            const submitBtn = document.getElementById('submitBtn');
            
            form.addEventListener('submit', function(e) {
                if (!form.checkValidity()) return;
                
                submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Sending...';
                submitBtn.disabled = true;
                
                // Form will submit normally after this
            });
            
            // Auto-resize textarea
            suggestionText.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
            
            // Success message auto-hide
            const successMessage = document.querySelector('.success');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.opacity = '0';
                    successMessage.style.transform = 'translateY(-20px)';
                    successMessage.style.transition = 'all 0.5s ease';
                    
                    setTimeout(() => {
                        successMessage.remove();
                    }, 500);
                }, 3000);
            }
        </script>
    </body>
</html>
