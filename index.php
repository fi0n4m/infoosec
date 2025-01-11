<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<title>Index</title>
<style>
body {
  font-family: 'Arial, sans-serif';
  text-align: center;
  background-color: rgb(240, 240, 240);
  margin-top: 50px;
}
h1 {
  color: #333;
}
.btn {
  border: 2px solid black;
  background-color: white;
  color: black;
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
  margin: 10px;
}

.login {
  border-color: #04AA6D;
  color: green;
}

.login:hover {
  background-color: #04AA6D;
  color: white;
}

.signup {
  border-color: #2196F3;
  color: dodgerblue;
}

.signup:hover {
  background: #2196F3;
  color: white;
}
</style>
</head>
<body>

<h1>Welcome, Player!</h1>

<form action="login.php" method="GET" style="display: inline;">
    <button type="submit" class="btn login">Login</button>
</form>

<form action="signup.php" method="GET" style="display: inline;">
    <button type="submit" class="btn signup">Sign Up</button>
</form>

</body>
</html>
