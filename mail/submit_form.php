<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $date = htmlspecialchars(trim($_POST['date']));
    $time = htmlspecialchars(trim($_POST['time']));
    $service = htmlspecialchars(trim($_POST['service']));

    // Debugging information
    error_log("Form Data: Name = $name, Email = $email, Date = $date, Time = $time, Service = $service");

    // Validation (example)
    if (empty($name) || empty($email) || empty($date) || empty($time) || $service == "Select A Service") {
        echo "All fields are required.";
    } else {
        // Normally, you would process the form data here (e.g., send an email, save to a database)
        echo "Your request has been received. We will contact you soon.";
    }
} else {
    echo "Invalid request method.";
}
?>
