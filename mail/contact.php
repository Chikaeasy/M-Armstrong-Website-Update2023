<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log function for debugging
function logError($message) {
    error_log(date('[Y-m-d H:i:s] ') . $message . PHP_EOL, 3, 'error.log');
}

// Validate and sanitize input
if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    logError("Form validation failed");
    http_response_code(400);
    echo json_encode(["error" => "Invalid form data"]);
    exit();
}

$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$m_subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

// Construct email
$to = "melodee@melodeearmstrong.com"; // Change this email to your desired recipient
$subject = "$m_subject:  $name";
$body = "You have received a new message from your website contact form.\n\n"
      . "Here are the details:\n\n"
      . "Name: $name\n\n"
      . "Email: $email\n\n"
      . "Subject: $m_subject\n\n"
      . "Message: $message";

$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Attempt to send email
if (mail($to, $subject, $body, $headers)) {
    http_response_code(200);
    echo json_encode(["success" => "Email sent successfully"]);
} else {
    logError("Failed to send email");
    http_response_code(500);
    echo json_encode(["error" => "Failed to send email"]);
}
?>