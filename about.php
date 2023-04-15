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
    <title>Grammy's Bakeshop - Shop</title>
    <link rel="stylesheet" href="./assets/css/Grammys.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

    <?php include 'components/user_header.php'; ?>

    <div class="about">
        <h1 class="text-center about-heading">About</h1>
    </div>
    <section>
        <div>
            <div class="description">
                <div class="introduction">
                    <p class="about-subtitle">Welcome to Grammy’s Bakery, your convenient online store for freshly baked products!</p>
                    <p class="about-subtitle">At Grammy’s Bakery, we understand that life can be busy and hectic, which is why we offer a wide variety of delicious treats that can be conveniently ordered online and delivered straight to your door. Whether you’re a busy professional, a student, or simply someone who loves freshly baked goods, we’ve got you covered.</p>
                </div>
                <div class="our-story">
                    <h1 class="about-title">Our Story</h1>
                    <p class="about-subtitle">Grammy’s Bakery is a family-owned and operated business that has been around for over 20 years. We are passionate about baking and creating delicious treats that bring joy to people’s lives. Each of our treats is made from scratch in small batches to ensure the utmost quality and taste.</p>
                </div>
                <div class="our-philosophy">
                    <h1 class="about-title">Our Philosophy</h1>
                    <p class="about-subtitle">At Grammy’s Bakery, we believe that everyone should have access to delicious baked goods, no matter how busy their lives may be. We are committed to using only the freshest and highest quality ingredients in all of our products. We take pride in our commitment to quality and believe that our passion for baking shines through in every bite.</p>
                </div>
                <div class="our-products">
                    <h1 class="about-title">Our Products</h1>
                    <p class="about-subtitle">We offer a wide variety of treats, including pies, cupcakes, muffins, and more. All of our products are made from scratch and baked fresh daily. Our menu is designed to cater to a variety of tastes and dietary needs.</p>
                </div>
                <div class="our-promise">
                    <h1 class="about-title">Our Products</h1>
                    <p class="about-subtitle">We are committed to providing our customers with the best possible experience. From the quality of our ingredients to the care we put into each and every order, we strive to exceed your expectations. We believe that our convenient online ordering and delivery service, paired with our commitment to quality, makes us the best choice for anyone looking for delicious baked goods.</p>
                </div>
                <div class="outro">
                    <p class="about-subtitle">Thank you for choosing Grammy’s Bakery. We are grateful for your support and look forward to serving you soon!</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>


    <script src="./Scripts/Search.js"></script>
    
    <script src="https://kit.fontawesome.com/80e0f4e3cb.js"></script>
</body>
</html>