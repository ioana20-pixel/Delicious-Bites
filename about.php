<?php
// about.php
require_once 'vendor/autoload.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Delicious Bites</title>
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

    <main>
        <section class="about">
            <h1>About Delicious Bites</h1>
            <p>Welcome to Delicious Bites, your ultimate destination for mouth-watering recipes and culinary inspiration!</p>
            <p>Our mission is to bring easy-to-follow and delicious recipes right to your kitchen. Whether you're a seasoned chef or a beginner, you'll find something new to try every week.</p>
            <p>Join us on a journey to discover new flavors, cooking techniques, and unique dishes that will make your meals memorable.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Delicious Bites. All Rights Reserved.</p>
    </footer>
</body>
</html>
