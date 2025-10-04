<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form class="login_form" action="index.php" method="post">
            <label for="username">Username:</label>
            <input class="field" type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input class="field" type="password" id="password" name="password" required>
            
            <!-- <input type="hidden" name="_token" value=""> -->

            <button type="submit" class="btn">Login</button>

        </form>
    </div>
    </body>
    </html>    
<?php
require 'includes/config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        // Here you would typically check the credentials against a database
        // For simplicity, let's assume a hardcoded user
        if ($username === 'admin' && $password === 'password') {
            $_SESSION['user'] = $username;
            header('Location: index.php?msg=Login successful');
            exit;
        } else {
            echo '<p class="error">Invalid username or password</p>';
        }
    } else {
        echo '<p class="error">Please fill in all fields</p>';
    }
}
?>
<?php include 'includes/footer.php'; ?>
<?php
// footer.php
?>
<footer>
    <p>&copy; <?= date('Y') ?> My Blog</p>  
</footer>
</body>
</html>