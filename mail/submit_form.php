<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize input data
    function sanitize_input($data) {
        $data = trim($data);                    // Remove whitespace
        $data = stripslashes($data);            // Remove backslashes
        $data = htmlspecialchars($data);        // Convert special characters to HTML entities
        return $data;
    }

    // Validate and sanitize form inputs
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $date = sanitize_input($_POST['date']);
    $time = sanitize_input($_POST['time']);
    $service = sanitize_input($_POST['service']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Feedback message
    $message = "Thank you, $name. Your request for a consultation on $date at $time has been received. We will contact you at $email regarding $service.";

    // Send email
    $to = "recipient@example.com";  // Replace with your email address
    $subject = "Consultation Request";
    $body = $message;
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo $message . " Email sent successfully.";  // Return success message including email status
    } else {
        echo "Failed to send email. Please try again later.";  // Return failure message if email sending fails
    }
} else {
    echo "Invalid request method.";
}
?>
