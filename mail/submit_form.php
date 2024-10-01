<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to log errors
function logError($message) {
    error_log(date('[Y-m-d H:i:s] ') . $message . PHP_EOL, 3, 'error.log');
}

// Function to sanitize input
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $date = sanitizeInput($_POST['date'] ?? '');
    $time = sanitizeInput($_POST['time'] ?? '');
    $service = sanitizeInput($_POST['service'] ?? '');

    // Validate input
    if (empty($name) || empty($email) || empty($date) || empty($time) || $service == "Select A Service") {
        http_response_code(400);
        echo json_encode(["error" => "All fields are required."]);
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid email address."]);
        exit;
    }

    // Validate date and time (basic check, can be improved)
    if (!strtotime($date) || !strtotime($time)) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid date or time."]);
        exit;
    }

    // Send email
    $to = "melodee@melodeearmstrong.com";
    $subject = "New Consultation Request";
    $message = "Name: $name\nEmail: $email\nDate: $date\nTime: $time\nService: $service";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        http_response_code(200);
        echo json_encode(["success" => "Your request has been received. We will contact you soon."]);
    } else {
        logError("Failed to send email: " . error_get_last()['message']);
        http_response_code(500);
        echo json_encode(["error" => "An error occurred while sending your request. Please try again later."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Invalid request method."]);
}
?>