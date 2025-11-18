
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carwebsite";

// Create DB connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Collect Data
$fullname   = $_POST['fullname'];
$email      = $_POST['email'];
$phone      = $_POST['phone'];
$national_id = $_POST['national_id'];
$address    = $_POST['address'];
$car_model  = $_POST['car_model'];
$view_date  = $_POST['view_date'];
$payment_method = $_POST['payment_method'];
$amount_paid = $_POST['amount_paid'];
$message    = $_POST['message'];

// Insert into database
$sql = "INSERT INTO bookings101 
(fullname, email, phone, national_id, address, car_model, view_date, payment_method, amount_paid, message)
VALUES 
('$fullname', '$email', '$phone', '$national_id', '$address', '$car_model', '$view_date', '$payment_method', '$amount_paid', '$message')";

if ($conn->query($sql) === TRUE) {
    
    echo "
    <div style='background:black; color:white; padding:40px; text-align:center; font-size:20px;'>
        <h2>Booking Completed Successfully!</h2>
        <p>Your booking has been recorded. You will be contacted shortly.</p>
        <p>You will be redirected to the home page in <strong>5 seconds</strong>.</p>
    </div>
    <script>
        setTimeout(function(){
            window.location.href = 'index.html';
        }, 5000);
    </script>
    ";
} 
else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
