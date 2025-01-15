<?php
// chicken_curry.php
require_once 'vendor/autoload.php';
require_once 'config.php'; // For database connection
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Handle the add to favourites action
if (isset($_POST['add_to_favourites'])) {
    $user_id = $_SESSION['user_id'];
    $recipe_name = 'Chicken Curry';
    $recipe_id = 3;  // Recipe ID, ensure this matches with your database structure

    // Insert into the favourites table
    $sql = "INSERT INTO favourites (user_id, recipe_name, recipe_id) VALUES (:user_id, :recipe_name, :recipe_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':recipe_name', $recipe_name);
    $stmt->bindParam(':recipe_id', $recipe_id);
    $stmt->execute();
    
    $message = "Recipe added to your favourites!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chicken Curry Recipe</title>
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
        <section class="recipe-detail">
            <h1>Chicken Curry</h1>
            <img src="images/chicken-curry.jpg" alt="Chicken Curry">
            <h2>Ingredients</h2>
            <ul>
                <li>500g chicken breasts</li>
                <li>1 onion</li>
                <li>2 garlic cloves</li>
                <li>1 can coconut milk</li>
                <li>1 tbsp curry powder</li>
                <li>Salt and pepper</li>
            </ul>
            <h2>Instructions</h2>
            <ol>
                <li>Cook chicken and chop into pieces.</li>
                <li>Sauté onion and garlic until soft.</li>
                <li>Add curry powder and coconut milk, simmer for 10 minutes.</li>
                <li>Add chicken pieces, cook for another 5 minutes. Serve with rice.</li>
            </ol>
        </section>

        <!-- Add to favourites button -->
        <form method="POST" class="center-button">
            <button type="submit" name="add_to_favourites" class="btn-favourite">Add to Favourites</button>
        </form>

        <!-- Display message if added to favourites -->
        <?php if (isset($message)): ?>
            <p class="added-message"><?= $message ?></p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Delicious Bites. All Rights Reserved.</p>
    </footer>
</body>
</html>
