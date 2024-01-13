<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // collect value of input field
        $name = $_POST['name'];
        $email = $_POST['email'];
        if (empty($name) || empty($email)) {
            echo "Name and email are required";
        } else {
            echo "Welcome " . $name . ", your email is: " . $email;
        }
    }
?>
