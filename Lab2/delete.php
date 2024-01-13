<?php
// Establish a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "Aman@dak1";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['delete'])) {
    // Retrieve form data
    $name = $_POST['delete_name'];
    $email = $_POST['delete_email'];

    // Check if the record exists
    $check = "SELECT * FROM details WHERE name = '$name' AND email = '$email'";
    $res = $conn->query($check);

    if ($res->num_rows > 0) {
        // Delete the record from the database
        $sql = "DELETE FROM details WHERE name = '$name' AND email = '$email'";

        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully <br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Such entry does not exist in the database <br>";
    }
}

// Close the database connection
$conn->close();
?>
