<?php
session_start();
require_once("db.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background-color: #f4f4f9; }
        .login-container { 
            background: white; 
            padding: 2rem; 
            border-radius: 8px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
            width: 100%; 
            max-width: 350px; }

        h2 { text-align: center; color: #333; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: .5rem; color: #666; }
        input { width: 100%; padding: .75rem; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: .75rem; background-color: #007bff; border: none; border-radius: 4px; color: white; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .msg {
            margin-top: 15px;
            text-align: center;
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <?php
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Get the username and password from the input form.
            $u_username = $_POST['username'];
            $u_password = $_POST['password'];

            // Query the database to get the user account.
            $result = db_query("SELECT username, password FROM account WHERE username = '" . $u_username . "'");
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $password_checking = password_verify($u_password, $row['password']);
                if ($password_checking)
                {   
                    // Store the username in a session.
                    $_SESSION['username'] = $u_username;

                    // REDIRECT to homepage.php
                    header("Location: homepage.php");
                    exit();
                }
                else
                {
                    $message = "Login unsuccessfully. Invalid username or password";
                }
            }
            else
            {
                $message = "Login unsuccessfully. Invalid username or password";
            }
        }
    ?>

    <div class="login-container">
        <h2>Sign In</h2>
        <form action="signin.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required></div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required></div>

            <button type="submit">Login</button>

            <?php if ($message): ?>
                <p class="msg"><?= $message ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
