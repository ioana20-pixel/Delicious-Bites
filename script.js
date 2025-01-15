// Existing functionality for displaying the recipes
document.addEventListener("DOMContentLoaded", () => {
    const recipes = [
        { title: "Spaghetti Carbonara", image: "images/carbonara.jpg", link: "recipe_carbonara.html" },
        { title: "Avocado Toast", image: "images/avocado_toast.jpg", link: "recipe_avocado_toast.html" },
        { title: "Chicken Curry", image: "images/chicken_curry.jpg", link: "recipe_chicken_curry.html" }
    ];

    const recipeContainer = document.querySelector(".recipe-cards");

    recipes.forEach(recipe => {
        const card = document.createElement("div");
        card.className = "recipe-card";
        card.innerHTML = `
            <img src="${recipe.image}" alt="${recipe.title}">
            <h3>${recipe.title}</h3>
            <a href="${recipe.link}"><button>View Recipe</button></a>
        `;
        recipeContainer.appendChild(card);
    });
});

// New code for recipes.html page (to show user-submitted recipes)
document.addEventListener("DOMContentLoaded", () => {
    const loggedIn = localStorage.getItem("loggedIn") === "true";  // Check login status (simple localStorage simulation)

    if (!loggedIn) {
        document.getElementById('login-status').innerHTML = "<p>You need to be logged in to view your recipes. <a href='login.html'>Login here</a></p>";
    } else {
        // Retrieve recipes from localStorage (user's recipes)
        const userRecipes = JSON.parse(localStorage.getItem("userRecipes")) || [];

        // Display a funny message if there are no recipes
        const recipeMessage = userRecipes.length === 0 ?
            "<p>No recipes yet. Add a recipe first! Maybe your pet's favorite dish?</p>" :
            "";

        document.getElementById('recipe-message').innerHTML = recipeMessage;

        // Display the recipes (if any)
        const recipeContainer = document.getElementById('recipe-cards');
        userRecipes.forEach(recipe => {
            const card = document.createElement("div");
            card.className = "recipe-card";
            card.innerHTML = `
                <img src="${recipe.image}" alt="${recipe.title}">
                <h3>${recipe.title}</h3>
                <a href="${recipe.link}"><button>View Recipe</button></a>
            `;
            recipeContainer.appendChild(card);
        });
    }
});

// Code for handling the submission of a recipe (on submit-recipe.html)
document.getElementById('recipeForm')?.addEventListener('submit', function(e) {
    e.preventDefault();

    const title = document.getElementById('title').value;
    const ingredients = document.getElementById('ingredients').value;
    const instructions = document.getElementById('instructions').value;
    const image = document.getElementById('image').files[0];

    if (title && ingredients && instructions && image) {
        // Create a new recipe object
        const recipe = {
            title: title,
            ingredients: ingredients,
            instructions: instructions,
            image: URL.createObjectURL(image),  // Create a URL for the image
            link: `recipe_${title.toLowerCase().replace(/\s+/g, '_')}.html` // Simple recipe link based on title
        };

        // Get existing recipes from localStorage or start with an empty array
        const existingRecipes = JSON.parse(localStorage.getItem("userRecipes")) || [];

        // Add the new recipe to the array
        existingRecipes.push(recipe);

        // Save the updated recipes list back to localStorage
        localStorage.setItem("userRecipes", JSON.stringify(existingRecipes));

        alert('Recipe submitted successfully!');
        window.location.href = 'recipes.html'; // Redirect to the recipes page
    } else {
        alert('Please fill out all fields!');
    }
});

// Code to handle login logic (in login.js or inline in login.html)
document.getElementById('loginForm')?.addEventListener('submit', function(e) {
    e.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (username === 'user' && password === 'password') {
        localStorage.setItem('loggedIn', 'true'); // Store login status in localStorage
        alert('Logged in successfully!');
        window.location.href = 'recipes.html'; // Redirect to recipes page after login
    } else {
        alert('Invalid credentials, please try again.');
    }
});
