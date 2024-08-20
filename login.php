<?php
session_start();

$conn = new mysqli("localhost", "root", "", "user_registration");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div class="wrapper">
      <h1>Login</h1>
      <form action="login.php" method="POST">
        <input
          type="text"
          name="username"
          placeholder="Username"
          required
        /><br />
        <input
          type="password"
          name="password"
          placeholder="Password"
          required
        /><br />
        <button type="submit">Login</button>
      </form>
      <div class="member">
        Not a member? <a href="register.php">Register now</a>
      </div>
    </div>
  </body>
</html>
