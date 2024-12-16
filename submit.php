<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "listmore"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $pass= $_POST['password'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

   # $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO register (Username, Password, Email, Phone_no) 
            VALUES ('$username', '$pass', '$email', '$phone_number')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>