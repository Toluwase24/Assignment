<?php
// Establish a database connection (replace DB_HOST, DB_USER, DB_PASSWORD, and DB_NAME with your actual database credentials)
$mysqli = new mysqli("localhost", "jkuegah1", "jkuegah1", "jkuegah1");

// Check for any connection error
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve the submitted username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare a SQL statement to select the user from the database
$sql = "SELECT id, password FROM user WHERE username = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

// If a row is returned, the login is verified
if ($stmt->num_rows == 1) {
    $stmt->bind_result($userId, $storedPassword);
    $stmt->fetch();
    
    // Verify the submitted password against the stored password
    if ($password === $storedPassword) {
        // Set the "userid" cookie to the user's ID
        setcookie("userid", $userId, time() + 3600, "/"); // Adjust the expiration time as needed

        // Redirect to the edit page
        header("Location: week5.php");
        exit();
    } else {
        // If the password doesn't match, display an error message
        echo "Incorrect password.";
    }
} else {
    // If the username is not found, display an error message
    echo "Username not found.";
}

$stmt->close();
$mysqli->close();
?>
