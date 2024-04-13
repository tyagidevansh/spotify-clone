<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Musify!</title>
</head>
<body>
    <div id = "inputContainer">
        <form id = "loginForm" action="register.php" method="post">
            <h2>Login to your account</h2>
            <p>
                <label for="loginUsername">Username</label>
                <input id = "loginUsername" name = "loginUsername" type="text" placeholder = "John Doe" required>
            </p>
            <p>
                <label for="loginPassword">Password</label>
                <input id = "loginPassword" name = "loginPassword" type="password" required>
            </p>
            <button type = "submit" name = "loginButton" > LOG IN</button>
        </form>
    </div>
</body>
</html>