<?php
$host = 'localhost';
$username = 'root';
$password = 'lalith1.';
$database = 'users';

$conn = mysqli_connect($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate input data (similar to previous code)
    if (empty($username) || empty($password)) {
        echo "Please fill in all fields.";
        exit();
    }

    // Check if username already exists (similar to previous code)
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "Username already taken. Please choose a different username.";
        exit();
    }

    // Hash the password (similar to previous code)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $sql = "INSERT INTO users.users (username, password) VALUES ('$username', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
