<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $date = htmlspecialchars(trim($_POST['date']));
    $time = htmlspecialchars(trim($_POST['time']));
    $service = htmlspecialchars(trim($_POST['service']));

    // Validate input
    if (empty($name) || empty($email) || empty($date) || empty($time) || $service == "Select A Service") {
        echo "All fields are required.";
        exit;
    }

    // Send email
    $to = "melodee@melodeearmstrong.com";
    $subject = "New Consultation Request";
    $message = "Name: $name\nEmail: $email\nDate: $date\nTime: $time\nService: $service";
    $headers = "From: $email";

    if (mail($to, $subject, $message, $headers)) {
        echo "Your request has been received. We will contact you soon.";
    } else {
        echo "An error occurred while sending your request. Please try again later.";
    }
} else {
    echo "Invalid request method.";
}
?>

