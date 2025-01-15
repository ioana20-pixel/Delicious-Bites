<?php
session_start();

require_once 'config.php';
require_once 'vendor/autoload.php';

// Initialize the Google Client
$client = new Google_Client();
$client->setClientId('769570673569-eh0qi71eci8ts5v0uk7vljep3apm2i6t.apps.googleusercontent.com'); 
$client->setClientSecret('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'); 
$client->setRedirectUri('http://localhost/final_project/google-login-callback.php'); 
$client->addScope('email');

// Check if the user is already logged in through Google (after redirect)
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token['error'])) {
        $_SESSION['access_token'] = $token['access_token'];
        header('Location: google-login-callback.php');
        exit();
    }
}

// Check if user is already logged in with session
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Login logic for regular login (form submission)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the user exists in the database
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Fetch the user data from the database
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and verify the password
    if ($user && password_verify($password, $user['password'])) { // password_verify is used for hashed passwords
        $_SESSION['user_id'] = $user['id']; // Store the user ID in the session
        header('Location: index.php');
        exit();
    } else {
        $error_message = "Invalid username or password!";
    }
}

$login_url = $client->createAuthUrl(); // Google login URL
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Delicious Bites</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="your_recipes.php">Your Recipes</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <h2>Login</h2>

        <!-- Display error message if login fails -->
        <?php if (isset($error_message)): ?>
            <p class="error"><?= $error_message ?></p>
        <?php endif; ?>

        <!-- Regular login form -->
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="register.php">Register here</a></p>

        <!-- Google Login button -->
        <a href="<?= $login_url ?>"><button type="button">Login with Google</button></a>
    </div>

    <footer>
        <p>&copy; 2025 Delicious Bites. All Rights Reserved.</p>
    </footer>
</body>
</html>