<?php

include 'components/config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


if(isset($_POST['add_to_cart'])){

   if($user_id == ''){
      header('location: login.php');
   } else {

      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $fullsize = $_POST['fullsize'];
      $fullsize = filter_var($fullsize, FILTER_SANITIZE_STRING);

      $check_cart_numbers = $link->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if($check_cart_numbers->rowCount() > 0){
         $message[] = 'Already added to cart!';
      }else{
         $insert_cart = $link->prepare("INSERT INTO `cart`(user_id, name, price, fullsize) VALUES(?,?,?,?)");
         $insert_cart->execute([$user_id, $name, $price, $fullsize]);
         $message[] = 'Added to cart';
         
      }

   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grammy's Bakeshop - Product View</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/Grammys.css">

</head>

    <style>
        .productview {
            padding: 95px 285px;
            flex-direction: row;
        }
        .productview-container {
            display: flex;
            flex-direction: row;
            padding-top: 35px;
        }
        .productview-details {
            display: flex;
            flex-direction: column;
            padding-left: 40px;
        }
        .productview-btns {
            display: flex;
            padding: 35px 0;
            gap: 50px;
        }
        .productview-name-price {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .add-to-cart {
            border: 2px solid #9112FF;
            border-radius: 8px;
            color: #9112FF;
            font-size: 25px;
            font-family: "Barlow", sans-serif;
            padding: 12px 30px;
            background-color: #FFFFFF;
            cursor: pointer;
        }
        .add-to-cart:hover {
            background-color: #9112FF;
            color: #FFFFFF;
        }
        .buy-now {
            background-color: #9112FF;
            border-radius: 8px;
            color: #FFFFFF;
            font-size: 25px;
            font-family: "Barlow", sans-serif;
            padding: 12px 45px;
            border: none;
        }
        .buy-now:hover {
            background-color: #FFFFFF;
            border: 2px solid #9112FF;
            color: #9112FF;
        }
        @media (max-width: 767px) {
            .productview {
                padding: 0;
            }
            .productview-container {
                padding: 25px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            .productview-container img {
                width: 100%;
            }
            .productview-details {
                padding: 0;
            }
            .productview-btns {
                flex-direction: column;
                gap: 25px;
            }
            .page-indicator {
                display: none;
            }
            .all-products-empty {
                height: 15px;
            }
            .productview-name-price {
                padding-top: 15px;
            }
            .productview-name, .productview-price {
                font-size: 24px;
                font-weight: 500;
            }
        }
        

    </style>

<body>

    <?php include 'components/user_header.php'; ?>

    <div>
        <div class="all-products-empty"></div>
        <?php
            $pid = $_GET['pid'];
            $select_products = $link->prepare("SELECT * FROM products WHERE id = ?");
            $select_products->execute([$pid]);
            if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>
            <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $fetch_products['pid']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="description" value="<?= $fetch_products['description']; ?>">
            <input type="hidden" name="fullsize" value="<?= $fetch_products['fullsize']; ?>">

            <div class="productview">
                <div class="page-indicator">
                    <p><a href="shop.php">Shop</a> / Products / <strong><?= $fetch_products['name']; ?></strong></p>
                </div>
                <div class="productview-container">
                    <div>
                        <img src="uploaded_fullsize/<?= $fetch_products['fullsize']; ?>" alt="">
                    </div>
                    <div class="productview-details">
                        <div class="productview-name-price">
                            <h1 class="productview-name"><?= $fetch_products['name']; ?></h1>
                            <h2 class="productview-price"><span>$</span><?= $fetch_products['price']; ?>.00</h2>
                        </div>
                        <div class="productview-btns">
                            <button name="add_to_cart" class="add-to-cart">Add to Cart</button>
                            <button name="add_to_cart" class="buy-now">Buy Now</button>
                        </div>
                        <p class="productview-description"><?= $fetch_products['description']; ?></p>
                    </div>
                </div>
            </form>
        <?php }
        } else {
            echo '<p class="text-center">No products added yet!</p>';
        }
        ?>

        </div>
    </div>

    <?php include 'components/footer.php'; ?>

<script src="./Scripts/Search.js"></script>

<script src="https://kit.fontawesome.com/80e0f4e3cb.js"></script>
</body>
</html>