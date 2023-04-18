<?php

include 'components/config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grammy's Bakeshop - Home</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/Grammys.css">
</head>
<body>

    <?php include 'components/user_header.php'; ?>

    <section id="hero-section">
        <div class="container">
            <div class="hero-details">
                <h1 class="hero-heading">Indulge in our freshly baked goodies-straight from Grammy's oven!</h1>
                <a class="shop-button" href="shop.php">Shop</a>
            </div>
        </div>
    </section>
    <div class="all-products-empty"></div>

    <?php include './components/featured-products.php' ?>

    <section class="shop-by-category-section">
        <div class="shop-by-category-container">
            <h1 class="text-center shop-category-title">Shop by category</h1>
            <div class="shop-by-categories">
                <a href="shop.php?category=Mini Pies">
                    <div class="category">
                        <img class="category-image"src="./assets/ShopByCategory/mini-pies.png" alt="mini-pies">
                        <h1 class="category-title">Mini Pies</h1>
                    </div>
                </a>
                <a href="shop.php?category=Cream Puffs">
                    <div class="category">
                        <img class="category-image" src="./assets/ShopByCategory/cream-puffs.png" alt="cream-puffs">
                        <h1 class="category-title">Cream Puffs</h1>
                    </div>
                </a>
                <a href="shop.php?category=Muffins">
                    <div class="category">
                        <img class="category-image" src="./assets/ShopByCategory/muffins.png" alt="muffins">
                        <h1 class="category-title">Muffins</h1>
                    </div>
                </a>
                <a href="shop.php?category=Cupcakes">
                    <div class="category">
                        <img class="category-image" src="./assets/ShopByCategory/cupcakes.png" alt="cupcakes">
                        <h1 class="category-title">Cupcakes</h1>
                    </div>
                </a>
                <a href="shop.php?category=Tartlets">
                    <div class="category">
                        <img class="category-image" src="./assets/ShopByCategory/tarlets.png" alt="tarlets">
                        <h1 class="category-title">Tartlets</h1>
                    </div>
                </a>
                <a href="shop.php?category=Cinnamon Rolls">
                    <div class="category">
                        <img class="category-image" src="./assets/ShopByCategory/cinnamon-rolls.png" alt="cinnamon-rolls">
                        <h1 class="category-title">Cinnamon Rolls</h1>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>

    <script src="./Scripts/Grammys.js"></script>
    <script src="./Scripts/Filter.js"></script>
    
    <script src="https://kit.fontawesome.com/80e0f4e3cb.js"></script>
</body>
</html>