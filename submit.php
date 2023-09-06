<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $feedback = $_POST["feedback"];
    
    // Check if an image was uploaded
    if ($_FILES["image"]["error"] == 0) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Image uploaded successfully
        } else {
            echo "Sorry, there was an error uploading your image.";
        }
    }
    
    // Compose the email message
    $to = 'gauravkumawat941@gmail.com';  // Replace with your email address
    $subject = 'New Feedback Submission';
    $message = "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "Feedback: $feedback\n";
    $headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error sending feedback.";
    }
} else {
    echo "Error: This script should be accessed through a POST request.";
}
?>
