<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in by verifying the session
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect them to the login page
    header('Location: login.php');
    exit;
}

// Include database connection
include('db_connect.php'); // Assuming this file contains the database connection code

// Retrieve user information from the session
$firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : 'Guest';
$lastname = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : 'User';
$user_email = isset($_SESSION['email']) ? $_SESSION['email'] : 'No email found';

// Feedback handling
if (isset($_POST['submit_feedback'])) {
    $feedback = htmlspecialchars($_POST['feedback']);
    
    if (!empty($feedback)) {
        // Insert the feedback into the database
        try {
            $sql = "INSERT INTO feedback (user_id, firstname, lastname, email, feedback_content) 
                    VALUES (:user_id, :firstname, :lastname, :email, :feedback_content)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $_SESSION['user_id']);  // Assuming user_id is stored in session
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $user_email);
            $stmt->bindParam(':feedback_content', $feedback);
            
            $stmt->execute();
            $feedbackMessage = "Thank you for your feedback!";
        } catch (PDOException $e) {
            $feedbackMessage = "Error: " . $e->getMessage();
        }
    } else {
        $feedbackMessage = "Please enter some feedback.";
    }
}

// Sign out handling
if (isset($_POST['signout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <title>Dashboard</title>
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
            border-radius: 8px;
        }
        .profile-container {
            padding: 16px;
            background-color: #f1f1f1;
            border-radius: 8px;
            text-align: center;
        }
        h1 {
            color: #2c56e0;
            margin-top: 50px;
        }
        .dashboardbtn {
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
        .dashboardbtn:hover {
            opacity: 1;
        }
        .signout {
            background-color: #b4b3b3;
            text-align: center;
        }
        a {
            color: rgb(250, 17, 17);
        }
        .profile-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #2c56e0;
            color: white;
            font-size: 30px;
            margin-bottom: 16px;
            display: inline-block;
            line-height: 60px;
            text-align: center;
        }
        .player-info-btn {
            background-color: #458cdd;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }
        .player-info-btn:hover {
            background-color: #3578d4;
        }
    </style>
</head>
<body>

<h1> Welcome to Your Dashboard </h1>

<div class="container">
    <h2>Hello, <?php echo htmlspecialchars($firstname) . " " . htmlspecialchars($lastname); ?>!</h2>
    <p>Email: <?php echo htmlspecialchars($user_email); ?></p> <!-- Displaying the email -->
    <p>Welcome to your dashboard. You are logged in.</p>

    <div class="profile-container">
        <div class="profile-icon">
            <?php echo strtoupper(substr($firstname, 0, 1)); ?>
        </div>
        <button class="player-info-btn" onclick="window.location.href='player_info.php'">Player Info</button>
    </div>

    <hr>

    <!-- Feedback Form -->
    <div class="feedback-form">
        <h3>Write a Post!</h3>
        <?php if (isset($feedbackMessage)): ?>
            <div class="feedback-message"><?php echo htmlspecialchars($feedbackMessage); ?></div>
        <?php endif; ?>
        <form method="POST">
            <textarea name="feedback" class="feedback-textarea" placeholder="What's on your mind?"></textarea>
            <button type="submit" name="submit_feedback" class="submit-feedback-btn">Submit Feedback</button>
        </form>
    </div>

    <hr>

    <form method="POST">
        <button type="submit" name="signout" class="dashboardbtn">Sign Out</button>
    </form>
</div>

</body>
</html>
