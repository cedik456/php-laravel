<?php
$conn = new mysqli("localhost", "root", "", "user_registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <h1>Sign up</h1>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required /><br />
            <input type="email" name="email" placeholder="Email" required /><br />
            <input type="password" name="password" placeholder="Password" required /><br />
            
            <div class="terms">
                <input type="checkbox" id="checkbox">
                <label for="checkbox">I agree to these <a href="">Terms & Conditions</a></label>
            </div>
            
            <button type="submit">Register</button>
        </form>
        <div class ="member">
            Already a member? <a href="login.php">Login here</a>
        </div>
        
    </div>
</body>
</html>
