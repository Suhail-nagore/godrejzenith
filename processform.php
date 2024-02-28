<?php
// Database connection credentials
$servername = "your_host";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $country = $_POST["country"];
    $phone = $_POST["phone"];
    $event_cat = $_POST["event_cat"];
    $pname = $_POST["pname"];
    $comment = $_POST["comment"];
    $utm_source = $_POST["utm_source"];
    $deviceInfo = $_POST["deviceInfo"];

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO your_table_name (name, email, country, phone, event_cat, pname, comment, utm_source, deviceInfo)
            VALUES ('$name', '$email', '$country', '$phone', '$event_cat', '$pname', '$comment', '$utm_source', '$deviceInfo')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Form submission method not allowed.";
}

// Close database connection
$conn->close();
?>
