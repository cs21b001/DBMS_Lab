<?php
// Establish a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "YourPassword";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Check if the entry already exists
    $check = "SELECT * FROM details WHERE name = '$name' AND email = '$email'";
    $res = $conn->query($check);

    if ($res->num_rows > 0) {
        echo "Record already exists <br>";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO details (name, email) VALUES ('$name', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Record inserted successfully <br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
