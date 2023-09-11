<?php
// Database connection
$host = "localhost"; // Replace with your database host
$username = "jkuegah1"; // Replace with your database username
$password = "jkuegah1"; // Replace with your database password
$database = "jkuegah1"; // Replace with your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for commands
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $command = $_POST["command"];

    if ($command === "delete") {
        $id = $_POST["id"];
        // Delete command with person ID
        $deleteQuery = "DELETE FROM people WHERE id = $id";
        if ($conn->query($deleteQuery) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } elseif ($command === "insert") {
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $phoneNumber = $_POST["phoneNumber"];

        // Insert command with form data
        $insertQuery = "INSERT INTO people (first_name, last_name, phone_number) VALUES ('$firstName', '$lastName', '$phoneNumber')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    } else {
        // Default command: show the list of people
        $query = "SELECT * FROM people";
        $result = $conn->query($query);

        $people = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $people[] = array(
                    "id" => $row['id'],
                    "first_name" => $row['first_name'],
                    "last_name" => $row['last_name'],
                    "phone_number" => $row['phone_number']
                );
            }
        }

        echo json_encode($people);
    }
}

// Close the database connection
$conn->close();
?>
