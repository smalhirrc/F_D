<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'databaseconnect.php';

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$validate_username = filter_var($username, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9_]{3,20}$/")));

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!empty($validate_username) && !empty($password)){
        // Process login
        $stmt = $db->prepare("SELECT * FROM Storiers WHERE user_name = :validate_username LIMIT 1");
        $stmt->bindParam(':validate_username', $validate_username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password_hash'])) {
            // login success
            session_start();
            $_SESSION['username'] = $validate_username;
            header("Location: index.php");
            exit();
        }
        else{
            $error_message = "Invalid username or password.";
        }
    }
    else {
        $error_message = "Invalid username or password.";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div id="login_form_container">
            <h1>Login</h1>
            <form action="login.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
            </form>
            <div>
                <p>Don't have an account? <a href="register.php">Register here</a>.</p>
            </div>
            <?php if(isset($error_message)): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>