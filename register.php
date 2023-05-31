<?php
$host="localhost";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="sys";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordConfirmation = $_POST["password_confirmation"];

    // Validate input data (similar to previous code)
    if (empty($username) || empty($password) || empty($passwordConfirmation)) {
        echo "Please fill in all fields.";
        exit();
    }

    if ($password !== $passwordConfirmation) {
        echo "Password and confirmation do not match.";
        exit();
    }

    // Check if username already exists
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "Username already taken. Please choose a different username.";
        exit();
    }

    // Hash the password (similar to previous code)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) 
    {
        header("Location: login.html");
        exit;
    }
     else {
        echo "Error: " . $conn->error;
    }
}
// Close database connection
$conn->close();
?>
