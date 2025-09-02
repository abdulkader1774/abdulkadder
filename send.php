<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Sender</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            width: 100%;
            max-width: 800px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        
        header {
            background: #4a6cf7;
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .description {
            font-size: 16px;
            opacity: 0.9;
        }
        
        .content {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        
        input, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        input:focus, textarea:focus {
            border-color: #4a6cf7;
            outline: none;
        }
        
        textarea {
            min-height: 150px;
            resize: vertical;
        }
        
        button {
            background: #4a6cf7;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        button:hover {
            background: #3a5cd8;
        }
        
        .result {
            margin-top: 25px;
            padding: 15px;
            border-radius: 5px;
            display: none;
        }
        
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            display: block;
        }
        
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            display: block;
        }
        
        .history {
            margin-top: 30px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
            display: none;
        }
        
        .history h2 {
            margin-bottom: 15px;
            color: #333;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background: #eee;
            font-weight: 600;
        }
        
        footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #eee;
        }
        
        @media (max-width: 600px) {
            .content {
                padding: 20px;
            }
            
            th, td {
                padding: 8px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Email Sender</h1>
            <p class="description">Send emails easily using PHP mail() function</p>
        </header>
        
        <div class="content">
            <form id="emailForm" method="POST">
                <div class="form-group">
                    <label for="sender">Your Email:</label>
                    <input type="email" id="sender" name="sender" required placeholder="your-email@example.com">
                </div>
                
                <div class="form-group">
                    <label for="recipient">Recipient Email:</label>
                    <input type="email" id="recipient" name="recipient" required placeholder="recipient@example.com">
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required placeholder="Email Subject">
                </div>
                
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required placeholder="Type your message here..."></textarea>
                </div>
                
                <button type="submit" name="send_email">Send Email</button>
            </form>
            
            <div id="result" class="result"></div>
            
            <div class="history" id="historySection">
                <h2>Sent Emails History</h2>
                <div id="emailHistory">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>To</th>
                                <th>Subject</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Oct 15, 2023</td>
                                <td>john@example.com</td>
                                <td>Test Message</td>
                            </tr>
                            <tr>
                                <td>Oct 14, 2023</td>
                                <td>sarah@example.com</td>
                                <td>Meeting Reminder</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <footer>
            <p>Email Sender Website &copy; 2023 | Powered by PHP mail()</p>
        </footer>
    </div>

    <script>
        document.getElementById('emailForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('send_email', 'true');
            
            fetch('', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                const resultDiv = document.getElementById('result');
                resultDiv.style.display = 'block';
                
                if (data.includes('successfully')) {
                    resultDiv.className = 'result success';
                    document.getElementById('emailForm').reset();
                } else {
                    resultDiv.className = 'result error';
                }
                
                resultDiv.innerHTML = data;
                
                // Scroll to result
                resultDiv.scrollIntoView({ behavior: 'smooth' });
            })
            .catch(error => {
                document.getElementById('result').innerHTML = 'An error occurred: ' + error;
                document.getElementById('result').className = 'result error';
                document.getElementById('result').style.display = 'block';
            });
        });
    </script>
</body>
</html>

<?php
// PHP code for sending email and storing in database
if (isset($_POST['send_email'])) {
    // Database configuration
    $db_host = 'sql212.ezyro.com';
    $db_name = 'ezyro_39705941_send';
    $db_user = 'ezyro_39705941';
    $db_pass = '056251eaa8b28';
    
    // Create connection
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    // Check connection
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    
    // Create table if it doesn't exist
    $create_table = "CREATE TABLE IF NOT EXISTS sent_emails (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        recipient_email VARCHAR(255) NOT NULL,
        subject VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        sender_email VARCHAR(255) NOT NULL,
        sent_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($create_table)) {
        echo "<div class='error'>Error creating table: " . $conn->error . "</div>";
    }
    
    // Get form data
    $recipient = filter_var($_POST['recipient'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    $sender = filter_var($_POST['sender'], FILTER_SANITIZE_EMAIL);
    
    // Validate email addresses
    if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='error'>Invalid recipient email address</div>";
        exit();
    }
    
    if (!filter_var($sender, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='error'>Invalid sender email address</div>";
        exit();
    }
    
    // Prepare email headers
    $headers = "From: $sender\r\n";
    $headers .= "Reply-To: $sender\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    // Send email using mail() function
    $mailSent = mail($recipient, $subject, $message, $headers);
    
    if ($mailSent) {
        // Store email in database
        $stmt = $conn->prepare("INSERT INTO sent_emails (recipient_email, subject, message, sender_email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $recipient, $subject, $message, $sender);
        
        if ($stmt->execute()) {
            echo "<div class='success'>Email sent successfully and stored in database!</div>";
        } else {
            echo "<div class='success'>Email sent successfully but could not be stored in database: " . $conn->error . "</div>";
        }
        
        $stmt->close();
    } else {
        echo "<div class='error'>Failed to send email. Please check your server configuration.</div>";
    }
    
    $conn->close();
}
?>