<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $dob = htmlspecialchars($_POST['dob']);
    $password = htmlspecialchars($_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE signup SET firstname = :firstname, lastname = :lastname, email = :email, dob = :dob, password = :password WHERE id = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':id', $user_id);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Account updated successfully.</p>";
    } else {
        echo "<p style='color: red;'>Failed to update account.</p>";
    }
}

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $sql = "DELETE FROM signup WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $user_id);

    if ($stmt->execute()) {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    } else {
        echo "<p style='color: red;'>Failed to delete account.</p>";
    }
}

// Fetch User Information
$sql = "SELECT * FROM signup WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Player Info</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
        font-family: 'Arial, sans-serif';
        background-color: rgb(0, 33, 48);
        color: white;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        width: 90%;
        max-width: 400px;
        background-color: rgb(255, 255, 255);
        border-radius: 8px;
        overflow-y: auto;
        max-height: 90vh;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        padding: 20px;
    }

    h2 {
        color: rgb(44, 86, 224);
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin: 10px 0 5px;
        font-size: 14px;
        font-weight: bold;
        color: #333;
    }

    input[type="text"], input[type="email"], input[type="date"], input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
    }

    .update-btn, .delete-btn {
        width: 45%;
        margin-top: 10px;
    }

    .update-btn {
        background-color: #2c56e0;
        color: white;
    }

    .update-btn:hover {
        background-color: #3578d4;
    }

    .delete-btn {
        background-color: red;
        color: white;
    }

    .delete-btn:hover {
        background-color: darkred;
    }

    .back-btn {
        background-color: #555;
        color: white;
    }

    .back-btn:hover {
        background-color: #333;
    }

    .scrollable {
        max-height: 400px;
        overflow-y: auto;
        padding-right: 5px;
    }

    /* Scrollbar style */
    .scrollable::-webkit-scrollbar {
        width: 8px;
    }

    .scrollable::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 10px;
    }

    .scrollable::-webkit-scrollbar-thumb:hover {
        background-color: #555;
    }

    .button-container {
        display: flex;
        justify-content: space-between;
    }
</style>
<body>
    <div class="container">
        <h2>Player Information</h2>
        <div class="scrollable">
            <!-- Update Form -->
            <form method="POST">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" required>

                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?php echo $user['dob']; ?>" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter new password" required>

                <input type="hidden" name="action" value="update">
                <div class="button-container">
                    <button type="submit" class="update-btn">Update Info</button>
                    <form method="POST">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="delete-btn">Delete Account</button>
                    </form>
                </div>
            </form>

            <hr>

            <!-- Back Button -->
            <button onclick="window.location.href='dashboard.php'" class="back-btn">Back to Dashboard</button>
        </div>
    </div>
</body>
</html>
