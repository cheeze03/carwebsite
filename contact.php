<?php
// Database configuration
$servername = "localhost";
$username = "root"; // default for XAMPP/WAMP
$password = ""; // leave empty unless you set one in MySQL
$dbname = "carwebsite"; // your new database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize input
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert into database using prepared statement (secure)
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "
        <html>
            <body style='background-color:black; color:lime; text-align:center; font-family:Arial;'>
                <h2>✅ Message Sent Successfully!</h2>
                <p>Thank you, $name. We'll get back to you soon.</p>
                <a href='contact.html' style='color:red; text-decoration:none;'>← Back to Contact Page</a>
            </body>
        </html>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>
