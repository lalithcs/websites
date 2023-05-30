<?php
// Database connection settings
$servername = "localhost:3306";
$username = "thedaddy_login";
$password = "admin@9602";
$dbname = "thedaddy_logindetails";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate input data (similar to previous code)
    if (empty($username) || empty($password)) {
        echo "Please fill in all fields.";
        exit();
    }
    }

    // Check if the username exists in the database
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            header("Location: index.html");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Username not found.";
    }


// Close database connection
$conn->close();
?>
