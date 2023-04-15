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

    <div class="wrapper">
        <nav class="all-products">
            <div class="wrapper-heading">
                <h1 class="text-center allproducts-heading">All Products</h1>
            </div>
            <div class="wrapper-nav">
                <input type="checkbox" id="toggle-nav">
                <label for="toggle-nav" class="nav-toggle">
                    <i class="material-icons">arrow_forward_ios</i>
                </label>
                <div class="product-menu">
                    <ul class="product-links">
                        <li class="product-link active"><a href="#">All Products</a></li>
                        <li data-filter="Cinnamon Rolls" class="product-link"><a href="#">Cinnamon Rolls</a></li>
                        <li data-filter="Cream Puffs" class="product-link"><a href="#">Cream Puffs</a></li>
                        <li data-filter="Cupcakes" class="product-link"><a href="#" >Cupcakes</a></li>
                        <li data-filter="Mini Pies" class="product-link"><a href="#">Mini Pies</a></li>
                        <li data-filter="Muffins" class="product-link"><a href="#">Muffins</a></li>
                        <li data-filter="Tartlets" class="product-link"><a href="#">Tartlets</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    

    <div class="sort-by-price">
        <label for="sort-by-price-select">Sort: </label>
        <select id="sort-by-price-select">
            <option disabled selected class="low-to-high-price" value="low-to-high-price">Low to High Price</option>
            <option value="low-to-high">Low to High</option>
            <option value="high-to-low">High to Low</option>
        </select>
        <button id="sort-by-price-btn" class="go-btn">GO</button>
    </div>

<section>
    <div class="product-container">
    <?php
         $select_products = $link->prepare("SELECT * FROM `products`");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="thumbnail" value="<?= $fetch_products['thumbnail']; ?>">
            

            <ul class="product-items">
            <a href="ProductView.php?pid=<?= $fetch_products['id']; ?>">
                <li class="product-item" data-category="<?= $fetch_products['category']; ?>" data-price="<?= $fetch_products['price']; ?>">
                    <img src="uploaded_thumbnail/<?= $fetch_products['thumbnail']; ?>" alt="">
                    <div class="product-title-price">
                        <h1 class="product-name"><?= $fetch_products['name']; ?></h1>
                        <h2 ><span>$</span><?= $fetch_products['price']; ?>.00</h2>
                    </div>
                    <a class="product-btn" href="ProductView.php?pid=<?= $fetch_products['id']; ?>">View product</a>
                </li>
            </a>
            </ul>
        </form>
    <?php 
    }
        } else {
            echo '<p class="text-center">No products added yet!</p>';
        }
            $select_products->closeCursor();
    ?>
    </div>
</section>

    <?php include 'components/footer.php'; ?>

    <script src="./Scripts/Search.js"></script>
    <script src="./Scripts/Filter.js"></script>
    
    <script src="https://kit.fontawesome.com/80e0f4e3cb.js"></script>
</body>
</html>