<!DOCTYPE html>
<html>
<head>
    <title>Week 5 - People table</title>
</head>
<body>
    <?php
    if (!isset($_COOKIE['userid'])) {
        // Redirect to the login page
        header("Location: week7login.php");
        exit(); // Make sure to exit after redirection
    }

    // Retrieve the logged-in userid from the cookie
    $userid = $_COOKIE['userid'];

    // Print the logged-in userid at the beginning of the page
    echo "Logged-in User : " . $userid;

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

    // Retrieve all information from the "people" table
    $query = "SELECT * FROM people";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Display the retrieved information
        echo "<h1>People Directory</h1>";
        echo "<table>";
        echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Telephone</th><th>Delete</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row['id']."</td><td>".$row['firstname']."</td><td>".$row['lastname']."</td><td>".$row['telephone']."</td><td><a href='week5.php?delete=".$row['id']."'>Delete</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "No records found.";
    }

    // Add people form
    echo "<h2>Add Person</h2>";
    echo "<form method='POST' action='week5.php'>";
    echo "<label>First Name: </label><input type='text' name='firstname'><br>";
    echo "<label>Last Name: </label><input type='text' name='lastname'><br>";
    echo "<label>Telephone: </label><input type='text' name='telephone'><br>";
    echo "<input type='submit' value='Add'>";
    echo "</form>";

    // Process form data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $telephone = $_POST['telephone'];

        // Insert new record into the "people" table
        $insertQuery = "INSERT INTO people (firstname, lastname, telephone) VALUES ('$firstname', '$lastname', '$telephone')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "Person added successfully.";
            header("Location: week5.php"); // Redirect to prevent form resubmission
            exit();
        } else {
            echo "Error adding person: " . $conn->error;
        }
    }

    // Delete people
    if (isset($_GET['delete'])) {
        $personId = $_GET['delete'];

        // Delete record from the "people" table
        $deleteQuery = "DELETE FROM people WHERE id = $personId";
        if ($conn->query($deleteQuery) === TRUE) {
            echo "Person deleted successfully.";
            header("Location: week5.php"); // Redirect after delete to update table
            exit();
        } else {
            echo "Error deleting person: " . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
