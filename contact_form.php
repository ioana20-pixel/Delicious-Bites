<?php
// contact_form.php
require_once 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Email details
    $to = "ioanacarnaru@yahoo.com"; // The email to send to
    $subject = "New Contact Form Submission";
    
    // Create the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Message: \n$message\n";
    
    // Email headers
    $headers = "From: $email" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8" . "\r\n";
    
    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "<h3>Message Sent!</h3>";
        echo "<p>Thank you, $name! Your message has been sent. We will get back to you soon.</p>";
    } else {
        echo "<h3>Error!</h3>";
        echo "<p>There was a problem sending your message. Please try again later.</p>";
    }
}
?>
