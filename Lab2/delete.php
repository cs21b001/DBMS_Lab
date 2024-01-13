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
// Retrieve and display data from the database
$sql = "SELECT * FROM details";
$result = $conn->query($sql);

echo "<table border='1'>";
echo "<tr><th>Name</th><th>Email</th></tr>";

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='2'>No results</td></tr>";
}

echo "</table>";


// Close the database connection
$conn->close();
?>
