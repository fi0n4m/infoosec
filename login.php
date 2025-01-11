<?php

session_start();

include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['psw']);

    $sql = "SELECT * FROM signup WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['dob'] = $user['dob'];

        header('Location: dashboard.php');
        exit();
    } else {
        echo "<p style='color: red;'>Invalid email or password. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
            background-color: rgb(0, 33, 48);
            text-align: center;
        }
        .container {
            padding: 16px;
            background-color: rgb(255, 255, 255);
            width: 90%;  
            max-width: 400px; 
            margin: 0 auto;    
            margin-top: 70px; 
            border-radius: 8px;
        }
        input[type=email], input[type=password] {
            width: 90%;
            padding: 12px; 
            margin: 5px 0 20px 0;  
            display: inline-block;
            border-radius: 8px;
            background: #f1f1f1;
        }
        input[type=email]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }
        .loginbtn {
            background-color: #458cdd;
            color: white;
            padding: 14px 20px;  
            margin: 8px 0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }
        .loginbtn:hover {
            opacity: 1;
        }
        .signin {
            background-color: #b4b3b3;
            text-align: center;
        }
        a {
            color: rgb(250, 17, 17);
        }
        h1 {
            color: #2c56e0;
        }
    </style>
</head>

<body>

<form method="POST" action="login.php">
  <div class="container">
  <h1> LAKANDULA </h1>
    <h2>LOGIN</h2>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter your email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter your password" name="psw" id="psw" required>

    <hr>

    <button type="submit" class="loginbtn">LOGIN</button>
    <p>Don't have an account? <a href="signup.php">Sign up</a>.</p>
  </div>

</form>

</body>
</html>
