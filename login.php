<?php
session_start(); // Start a new session or resume the existing session

// Establish a connection to the MySQL database
$conn = new mysqli("localhost", "root", "", "user_registration");

// Check if the request method is POST (form submission)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Escape user input to prevent SQL injection
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Prepare SQL query to find user by username
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql); // Execute the query

    // Check if a user was found
    if ($result->num_rows > 0) {
        // Fetch user data from the result
        $user = $result->fetch_assoc();
        
        // Verify the provided password with the hashed password stored in the database
        if (password_verify($password, $user['password'])) {
            // Set session variable to indicate the user is logged in
            $_SESSION['username'] = $user['username'];
            // Redirect to the dashboard page
            header("Location: dashboard.php");
            exit();
        } else {
            // Show an error message if the password is incorrect
            echo "Invalid password.";
        }
    } else {
        // Show an error message if no user is found with the provided username
        echo "No user found with that username.";
    }
}

// Close the database connection
$conn->close();
?>
