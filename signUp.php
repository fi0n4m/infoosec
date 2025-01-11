<?php
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input data to prevent XSS attacks
    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $middlename = htmlspecialchars($_POST['middlename']);  // Added middle name
    $email = htmlspecialchars($_POST['email']);
    $dob = htmlspecialchars($_POST['dob']);
    $password = htmlspecialchars($_POST['psw']);
    $password_repeat = htmlspecialchars($_POST['psw-repeat']);

    // Check if the passwords match
    if ($password !== $password_repeat) {
        echo "<p style='color: red; text-align: center;'>Passwords do not match!</p>";
    } else {
        // Check if the email already exists in the database
        $sql = "SELECT * FROM signup WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<p style='color: red; text-align: center;'>Email already exists!</p>";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare SQL query to insert the new user into the database
            $sql = "INSERT INTO signup (lastname, firstname, middlename, email, dob, password) 
                    VALUES (:lastname, :firstname, :middlename, :email, :dob, :password)";
            try {
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':lastname', $lastname);
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':middlename', $middlename);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':dob', $dob);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->execute();

                // Redirect the user to the login page after successful registration
                header('Location: login.php');
            } catch (PDOException $e) {
                // Handle potential errors
                echo "<p style='color: red; text-align: center;'>Error: " . $e->getMessage() . "</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Sign Up Page</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
            background-color: rgb(0, 33, 48);
        }
        * {
            box-sizing: border-box;
        }
        .container {
            padding: 16px;
            background-color: rgb(255, 255, 255);
            width: 90%;  
            max-width: 500px; 
            margin: 0 auto;    
            margin-top: 60px;
            border-radius: 10px;
            max-height: 80vh; 
            overflow-y: auto; 
        }
        input[type=text], input[type=password], input[type=email], input[type=date] {
            width: 100%;
            padding: 12px; 
            margin: 5px 0 20px 0;  
            display: inline-block;
            border-radius: 20px;
            background: #f1f1f1;
        }
        input[type=text]:focus, input[type=password]:focus, input[type=email]:focus, input[type=date]:focus {
            background-color: #ddd;
            outline: none;
        }
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }
        .registerbtn {
            background-color: #458cdd;
            color: white;
            padding: 14px 20px;  
            margin: 8px 0;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }
        .registerbtn:hover {
            opacity: 1;
        }
        a {
            color: rgb(250, 17, 17);
        }
        .signin {
            background-color: #b4b3b3;
            text-align: center;
        }
        h1 {
            color: #2c56e0;
            text-align: center;
        }
    </style>
</head>
<body>

<form method="POST" action="signup.php">
  <div class="container">
    <h1> LAKANDULA </h1>
    <h2>SIGN UP</h2>
    <hr>

    <label for="firstname"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name" name="firstname" id="firstname" required>

    <label for="middlename"><b>Middle Name</b></label>
    <input type="text" placeholder="Enter Middle Name" name="middlename" id="middlename" required>

    <label for="lastname"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="lastname" id="lastname" required>

    <label for="dob"><b>Date of Birth</b></label>
    <input type="date" placeholder="Enter Date of Birth" name="dob" id="dob" required>

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter your email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter your password" name="psw" id="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat your password" name="psw-repeat" id="psw-repeat" required>

    <hr>

    <button type="submit" class="registerbtn">SIGN UP</button>
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>

</body>
</html>
