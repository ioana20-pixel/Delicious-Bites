<?php
require_once 'vendor/autoload.php';
require_once 'config.php'; // For database connection
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Handle the delete action
if (isset($_POST['delete_favourite'])) {
    $user_id = $_SESSION['user_id'];
    $favourite_id = $_POST['favourite_id'];  // Get the favourite ID to delete
    
    // Delete from the favourites table
    $sql = "DELETE FROM favourites WHERE user_id = :user_id AND id = :favourite_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':favourite_id', $favourite_id);
    $stmt->execute();
    
    $message = "Recipe removed from your favourites!";
}

// Fetch the user's favourite recipes
$sql = "SELECT * FROM favourites WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();
$favourites = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Favourites</title>
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
        <section class="favourites">
            <h1>Your Favourite Recipes</h1>

            <?php if (isset($message)): ?>
                <p class="message"><?= $message ?></p>
            <?php endif; ?>

            <?php if (count($favourites) > 0): ?>
                <ul class="favourites-list">
                    <?php foreach ($favourites as $favourite): ?>
                        <li>
                            <!-- Enhanced link with hover effect -->
                            <a href="recipe.php?id=<?= $favourite['recipe_id'] ?>"><?= htmlspecialchars($favourite['recipe_name']) ?></a>
                            <!-- Delete button next to the link -->
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="favourite_id" value="<?= $favourite['id'] ?>">
                                <button type="submit" name="delete_favourite" class="btn-delete">Remove</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>You have no favourite recipes yet.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Delicious Bites. All Rights Reserved.</p>
    </footer>
</body>
</html>
