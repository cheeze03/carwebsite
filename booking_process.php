<?php
// Database configuration - NEW DATABASE
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elite_cars_db";

// Create DB connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Collect Data from NEW field names
$client_name = $_POST['client_name'];
$client_email = $_POST['client_email'];
$client_phone = $_POST['client_phone'];
$client_id_number = $_POST['client_id_number'];
$client_address = $_POST['client_address'];
$selected_car = $_POST['selected_car'];
$test_drive_date = $_POST['test_drive_date'];
$payment_type = $_POST['payment_type'];
$payment_amount = $_POST['payment_amount'];
$special_requests = $_POST['special_requests'];

// Insert into database using prepared statement
$stmt = $conn->prepare("INSERT INTO car_bookings (client_name, client_email, client_phone, client_id_number, client_address, selected_car, test_drive_date, payment_type, payment_amount, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssds", $client_name, $client_email, $client_phone, $client_id_number, $client_address, $selected_car, $test_drive_date, $payment_type, $payment_amount, $special_requests);

if ($stmt->execute()) {
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Booking Confirmed - Elite Cars</title>
        <style>
            body { 
                background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 100%); 
                color: #ffffff; 
                padding: 40px; 
                text-align: center; 
                font-family: 'Arial', sans-serif;
                margin: 0;
            }
            .confirmation-box {
                max-width: 700px;
                margin: 0 auto;
                padding: 40px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 15px;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(0, 255, 0, 0.3);
            }
            h2 {
                color: #00ff00;
                font-size: 32px;
                margin-bottom: 25px;
                text-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
            }
            .booking-details {
                background: rgba(0, 0, 0, 0.5);
                padding: 20px;
                border-radius: 10px;
                margin: 20px 0;
                text-align: left;
            }
            .detail-item {
                margin: 10px 0;
                padding: 8px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            .countdown {
                font-size: 24px;
                color: #ff9900;
                margin: 20px 0;
            }
        </style>
    </head>
    <body>
        <div class='confirmation-box'>
            <h2>🎉 Booking Confirmed Successfully!</h2>
            
            <div class='booking-details'>
                <div class='detail-item'><strong>Client:</strong> $client_name</div>
                <div class='detail-item'><strong>Car Selected:</strong> $selected_car</div>
                <div class='detail-item'><strong>Test Drive Date:</strong> $test_drive_date</div>
                <div class='detail-item'><strong>Payment Amount:</strong> $$payment_amount</div>
                <div class='detail-item'><strong>Booking Reference:</strong> ELITE-" . rand(1000, 9999) . "</div>
            </div>
            
            <p>Your booking has been securely stored in our system. Our team will contact you within 24 hours to confirm your test drive appointment.</p>
            
            <div class='countdown' id='countdown'>Redirecting in 5 seconds...</div>
            
            <p style='color: #cccccc; font-size: 14px; margin-top: 30px;'>
                Thank you for choosing Elite Cars! 🚗
            </p>
        </div>

        <script>
            let timeLeft = 5;
            const countdownElement = document.getElementById('countdown');
            
            const countdown = setInterval(function() {
                timeLeft--;
                countdownElement.textContent = 'Redirecting in ' + timeLeft + ' seconds...';
                
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    window.location.href = 'index.html';
                }
            }, 1000);
        </script>
    </body>
    </html>";
} 
else {
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <title>Booking Error - Elite Cars</title>
        <style>
            body { 
                background: #0a0a0a; 
                color: #ff0000; 
                padding: 40px; 
                text-align: center; 
                font-family: Arial; 
            }
            .error-box {
                max-width: 600px;
                margin: 0 auto;
                padding: 30px;
                border: 2px solid #ff0000;
                border-radius: 10px;
                background: #111;
            }
            a {
                color: white;
                text-decoration: none;
                padding: 10px 20px;
                background: #333;
                border-radius: 5px;
                display: inline-block;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class='error-box'>
            <h2>❌ Booking Error</h2>
            <p>We encountered an error processing your booking:</p>
            <p><strong>Error: " . $stmt->error . "</strong></p>
            <a href='booking.html'>← Back to Booking Page</a>
        </div>
    </body>
    </html>";
}

$stmt->close();
$conn->close();
?>