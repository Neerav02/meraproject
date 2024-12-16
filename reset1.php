<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "listmore";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM register";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  echo"<table border ='1' width:100%;>
          <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
            <th>Phone Number</th>
          </tr>";
  while ($row = mysqli_fetch_assoc($result)) {
    // Handle null or empty phone number
    $phone = !empty($row["Phone_no"]) ? $row["Phone_no"] : "Not Provided";
    echo "<tr>
            <td>" . htmlspecialchars($row["Username"]) . "</td>
            <td>" . htmlspecialchars($row["Password"]) . "</td>
            <td>" . htmlspecialchars($row["Email"]) . "</td>
            <td>" . htmlspecialchars($phone) . "</td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

mysqli_close($conn);
?>
