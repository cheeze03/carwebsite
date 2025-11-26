<?php
// Database configuration - NEW DATABASE
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elite_cars_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize input
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $customer_email = $conn->real_escape_string($_POST['customer_email']);
    $customer_message = $conn->real_escape_string($_POST['customer_message']);

    // Insert into database using prepared statement
    $stmt = $conn->prepare("INSERT INTO contact_messages (customer_name, customer_email, customer_message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $customer_name, $customer_email, $customer_message);

    if ($stmt->execute()) {
        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Message Sent - Elite Cars</title>
            <style>
                body { 
                    background-color: #0a0a0a; 
                    color: #00ff00; 
                    text-align: center; 
                    font-family: 'Arial', sans-serif; 
                    padding: 50px;
                    margin: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 30px;
                    border: 2px solid #00ff00;
                    border-radius: 10px;
                    background: #111;
                }
                h2 {
                    color: #00ff00;
                    font-size: 28px;
                    margin-bottom: 20px;
                }
                p {
                    font-size: 18px;
                    margin: 15px 0;
                }
                .back-link {
                    display: inline-block;
                    margin-top: 30px;
                    padding: 10px 20px;
                    background: #ff0000;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    font-weight: bold;
                }
                .back-link:hover {
                    background: #cc0000;
                    transform: scale(1.05);
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>✅ Message Sent Successfully!</h2>
                <p>Thank you, <strong>$customer_name</strong>. We'll get back to you within 24 hours.</p>
                <p>Your message has been recorded in our system.</p>
                <a href='contact.html' class='back-link'>← Back to Contact Page</a>
            </div>
        </body>
        </html>";
    } else {
        echo "
        <html>
        <head>
            <title>Error - Elite Cars</title>
            <style>
                body { background: #0a0a0a; color: #ff0000; text-align: center; padding: 50px; font-family: Arial; }
            </style>
        </head>
        <body>
            <h2>❌ Database Error</h2>
            <p>Error: " . $stmt->error . "</p>
            <a href='contact.html' style='color:white;'>← Go Back</a>
        </body>
        </html>";
    }

    $stmt->close();
}

$conn->close();
?>