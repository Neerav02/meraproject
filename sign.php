<?php
// Database configuration
$host = 'localhost';
$dbname = 'listmore'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['tb1'];
    $inputPassword = $_POST['tb2'];

    if (empty($inputUsername) || empty($inputPassword)) {
        $message = "Please provide both username and password.";
    } else {
        // Check if the user exists
        $stmt = $pdo->prepare("SELECT * FROM register WHERE username = :Username AND pass = :Password");
        $stmt->execute([
            'username' => $inputUsername,
            'password' => $inputPassword,
        ]);
        $user = $stmt->fetch();

        if ($user) {
            $message = "Login successfully!";
        } else {
            $message = "User not found. Please register first.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="tb1">Username:</label>
        <input type="text" id="tb1" name="tb1" required><br><br>

        <label for="tb2">Password:</label>
        <input type="password" id="tb2" name="tb2" required><br><br>

        <button type="submit">Login</button>
    </form>

    <p><?php echo $message; ?></p>

    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</body>
</html>
