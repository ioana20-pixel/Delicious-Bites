<?php
// index.php
require_once 'vendor/autoload.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delicious Bites - Home</title>
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
        <section class="hero">
            <h1>Welcome to Delicious Bites</h1>
            <p>Your ultimate destination for mouth-watering recipes!</p>
        </section>
        <section class="featured-recipes">
            <h2>Featured Recipes</h2>
            <div class="recipe-cards">
                <!-- Carbonara Recipe -->
                <div class="recipe-card">
                    <img src="images/carbonara.jpg" alt="Spaghetti Carbonara">
                    <h3>Spaghetti Carbonara</h3>
                    <p>A classic Italian pasta dish!</p>
                    <a href="carbonara.php">
                        <button>View Recipe</button>
                    </a>
                </div>

                <!-- Avocado Toast Recipe -->
                <div class="recipe-card">
                    <img src="images/avocado-toast.jpg" alt="Avocado Toast">
                    <h3>Avocado Toast</h3>
                    <p>Simple and healthy breakfast!</p>
                    <a href="avocado-toast.php">
                        <button>View Recipe</button>
                    </a>
                </div>

                <!-- Chicken Curry Recipe -->
                <div class="recipe-card">
                    <img src="images/chicken-curry.jpg" alt="Chicken Curry">
                    <h3>Chicken Curry</h3>
                    <p>Spicy and flavorful chicken curry!</p>
                    <a href="chicken-curry.php">
                        <button>View Recipe</button>
                    </a>
                </div>
            </div>
        </section>

        <!-- Stay Tuned Section -->
        <section class="stay-tuned">
            <p>Stay tuned for more delicious recipes coming your way!</p>
            <p class="weekly-updates">Weekly updates</p>
        </section>

    </main>
    <footer>
        <p>&copy; 2025 Delicious Bites. All Rights Reserved.</p>
    </footer>
</body>
</html>
