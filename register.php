<?php
require_once 'vendor/autoload.php';

$client = new Google_Client();

$client->setClientId("769570673569-eh0qi71eci8ts5v0uk7vljep3apm2i6t.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost/final_project/google-register-callback.php");

$client->addScope("email");
$client->addScope("profile");

$url = $client->createAuthUrl();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Delicious Bites</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="your_recipes.php">Your Recipes</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <h2>Register</h2>

        <!-- Regular registration form -->
        <form action="register_handler.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        
        <p>Already have an account? <a href="login.php">Login here</a></p>

        <!-- Google Login button -->
        <a href="<?= $url ?>"><button type="button">Register with Google</button></a>
    </div>

    <footer>
        <p>&copy; 2025 Delicious Bites. All Rights Reserved.</p>
    </footer>
</body>
</html>
