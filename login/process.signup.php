<?php
// Start the session
session_start();

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize input values
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $password_confirmation = sanitizeInput($_POST['password_confirmation']);

    // Basic validation
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if ($password !== $password_confirmation) {
        $errors[] = "Passwords do not match.";
    }

    // Check if there are any errors
    if (!empty($errors)) {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    } else {
        // Hash the password before storing it (for security)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Here you would typically store user data in a database
        // For this example, we'll just display a success message
        echo "<p style='color: green;'>Signup successful! Welcome, $name.</p>";
        
        // Redirect to a success page or perform further processing
        // header("Location: success.php");
        // exit();
    }
} else {
    // If the form is not submitted correctly, redirect to the signup page
    header("Location: index.html");
    exit();
}
?>