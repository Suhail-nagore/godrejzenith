<?php

require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $contactNumber = $_POST["mobile"];


    // Validate and sanitize the form data (perform necessary checks)

    

    // Connect to the database
    $servername = "localhost"; // Replace with your MySQL server name
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "test"; // Replace with your MySQL database name

    // Create a new PDO instance
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Handle database connection error
        echo "Connection failed: " . $e->getMessage();
        exit;
    }

    // Prepare and execute the database query
    try {
        $stmt = $conn->prepare("INSERT INTO enquiry (name,email,contact_number) VALUES (:name,  :email,:contactNumber)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contactNumber', $contactNumber);
        $stmt->execute();
    } catch (PDOException $e) {
        // Handle database query error
        echo "Error: " . $e->getMessage();
        exit;
    }

    // Close the database connection
    $conn = null;
    
       // Send an email with the form data 
    $mail = new PHPMailer(true);
    // print_r($mail);




        
    try {
                                      
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com'; // Replace with your SMTP server address
    $mail->SMTPAuth = true;
    $mail->Username = 'info@maisoninfratech.in'; // Replace with your SMTP username
    $mail->Password = 'Maison@123'; // Replace with your SMTP password
    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, 'ssl' also possible
    $mail->Port = 465 ;

//     Recipients
    $mail->setFrom('info@maisoninfratech.in',$name);
    $mail->addAddress('gozoomtechnologies@gmail.com'); // Replace with the desired email address

//     Email content
    $mail->isHTML(true);
    $mail->Subject = 'Godrej Zenith 89 Enquiry';
    $mail->Body = "Name: $name\n"
        . "Email: $email\n"
        . "Contact Number: $contactNumber\n";
   


    $mail->send();
   

//     Email sent successfully
    header("Location: success.html");
    exit;
} 
catch (Exception $e) {
    // Error sending email
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    exit;
}

}