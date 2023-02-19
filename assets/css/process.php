<?php
// Set the recipient email address
$to = "niwillisivali@gmail.com";

// Sanitize and encode form data to prevent injection attacks and XSS
$first_name = htmlspecialchars(filter_var($_POST["first_name"], FILTER_SANITIZE_STRING), ENT_QUOTES, 'UTF-8');
$last_name = htmlspecialchars(filter_var($_POST["last_name"], FILTER_SANITIZE_STRING), ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL), ENT_QUOTES, 'UTF-8');

// Validate email address
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  die("Invalid email format");
}

// Create the email message and encode any special characters
$message = "Name: $first_name $last_name\nEmail: $email";
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

// Set the email headers and encode any special characters
$headers = "From: " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "\r\n";
$headers .= "Reply-To: " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";

// Send the email
if (mail($to, "Contact Form Submission", $message, $headers)) {
  echo "Thank you for your message!";
} else {
  echo "Sorry, there was a problem sending your message. Please try again later.";
}
?>
