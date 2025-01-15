<?php
require_once 'vendor/autoload.php';
require_once 'config.php'; // For database connection
session_start();

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    $recipe_id = $_GET['id'];

    // Prepare SQL query to fetch the recipe
    $sql = "SELECT * FROM recipes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $recipe_id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Fetch the recipe details
    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If no recipe found, display the error message
    if (!$recipe) {
        $message = "Recipe not found!";
    }
} else {
    $message = "Invalid recipe ID!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe</title>
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
        <?php if (isset($message)): ?>
            <p class="error-message"><?= $message ?></p>
        <?php elseif ($recipe): ?>
            <h1><?= htmlspecialchars($recipe['recipe_name']) ?></h1>
            <img src="<?= htmlspecialchars($recipe['image_url']) ?>" alt="<?= htmlspecialchars($recipe['recipe_name']) ?>">
            <h2>Ingredients</h2>
            <ul>
                <?php
                $ingredients = explode(",", $recipe['ingredients']);
                foreach ($ingredients as $ingredient) {
                    echo "<li>" . htmlspecialchars(trim($ingredient)) . "</li>";
                }
                ?>
            </ul>
            <h2>Instructions</h2>
            <ol>
                <?php
                $instructions = explode(",", $recipe['instructions']);
                foreach ($instructions as $instruction) {
                    echo "<li>" . htmlspecialchars(trim($instruction)) . "</li>";
                }
                ?>
            </ol>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Delicious Bites. All Rights Reserved.</p>
    </footer>
</body>
</html>
