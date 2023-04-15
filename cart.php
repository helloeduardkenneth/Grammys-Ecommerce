<?php

include 'components/config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['cart_id']) && isset($_POST['qty'])){
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);
    $update_qty = $link->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
    $update_qty->execute([$qty, $cart_id]);
}

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $link->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $message[] = 'Cart Item Deleted';
}

if(isset($_POST['delete_all'])){
   $delete_cart_item = $link->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   // header('location:cart.php');
   $message[] = 'Deleted All from Cart';
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $link->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'Cart Quantity Updated';
}

$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="./assets/css/Grammys.css">

</head>
<body>

<style>
    .cart-container {
        background-color: var(--light-violet-color);
        width: 100%;
        padding: 75px 250px 25px 250px;
    }
    .cart-heading {
        color: var(--dark-violet-color);
        font-size: 50px;
        font-weight: 500;
        margin-bottom: 60px;
    }
    .box-container {
        padding: 150px 420px;
        display: flex;
        flex-direction: column;
        gap: 55px;
        position: relative;
    }
    .cart-list {
        display: flex !important;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
    .cart-product {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .cart-product img {
        width: 100px;
        height: 100px;
    }
    .cart-qty-price-delete {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 150px;
        padding-left: 100px;
    }
    .product-name {
    }
    .fa-times {
        border: none !important;
        cursor: pointer;
        background: none;
    }
    .cart-qty-price-delete input[type="number"] {
        width: 50px;
        height: 50px;
        text-align: center !important;
    }
    .qty-price {
        display: flex;
        align-items: center;
        gap: 120px;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none !important;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        appearance: textfield !important;
        -moz-appearance: textfield !important;
    }
    .cart-divider {
        border-bottom: 2px solid #000;
    }
    .cart-computing {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    .cart-computing .sub-total { 
        padding-bottom: 40px;
        font-size: 25px;
        font-weight: 500;
        display: flex;

        gap: 100px;
    }
    .cart-computing .total {
        font-size: 30px;
        font-weight: 600;
        display: flex;
        gap: 120px;
    }
    .cart-btn {
        padding-top: 40px;
        gap: 25px;
        display: flex;
        flex-direction: column;
    }
    .proceed-checkout {
        background-color: var(--dark-violet-color);
        padding: 12px 45px;
        color: #FFF;
        font-weight: 600;
        border-radius: 8px;
    }
    .continue-shopping {
        background-color: #FFFFFF;
        border: 2px solid var(--dark-violet-color);
        padding: 12px 45px;
        color: var(--dark-violet-color);
        font-weight: 600;
        border-radius: 8px;
    }
    .empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 40px;
    }
    .cart-empty {
        font-size: 2rem;
        font-weight: 500;
    }
    .product-name {
            position: absolute;
            left: 550px !important;
    }
    @media (max-width: 767px) {
        .cart-container {
            padding: 25px 135px !important;
        }
        .cart-heading {
            margin: 0;
        }
        .cart-heading {
            font-size: 25px;
        }
        .box-container {
            padding: 0;
            gap: 10px;
        }
        .cart-qty-price-delete {
            flex-direction: column;
            gap: 10px;
            align-items: start;
            padding-left: 0;
        }
        .box-container form {
            padding: 45px 0 !important;

        }
        .product-name, .price {
            font-size: 1rem;
        }
        .cart-list {
            gap: 40px;
            justify-content: normal;
        }
        .cart-qty-price-delete input[type="number"] {
            width: 35px;
            height: 35px;
        }
        .cart-computing {
            align-items: center;
            padding: 20px;
        }
        .sub-total div {
            font-size: 1.5rem;
        }
        .cart-computing .total {
            font-size: 1.5rem;
            gap: 140px;
        }
        .cart-btn .proceed-checkout {
            width: 100% !important;
        }

        .fa-times {
            position: absolute;
            right: 0 !important;
        }
        .product-name {
            position: static;
        }
    }
</style>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->



<!-- shopping cart section starts  -->

<section class="products">

    <div class="cart-container">
        <h1 class="text-center cart-heading">Cart</h1>
    </div>

   <div class="box-container">

      <?php
         $grand_total = 0;
         $select_cart = $link->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">

        <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">

   
            <div class="cart-list" data-cart-id="<?php echo $fetch_cart['id']; ?>">
                <div class="cart-product">
                    <img src="uploaded_fullsize/<?= $fetch_cart['fullsize']; ?>" alt="">
                </div>
                <div class="cart-qty-price-delete">
                    <h1 class="product-name"><?= $fetch_cart['name']; ?></h1>
                    <input type="number" class="qty-input" name="qty" value="<?php echo $fetch_cart['quantity']; ?>">
                    <h1 class="price">$<?= $fetch_cart['price']; ?>.00</h1>
                </div>
                <button type="submit" class="fas fa-times" name="delete" onclick="return confirm('Delete this item?');"></button>
            </div>
            
        </form>
        <?php 
                $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                $grand_total += $sub_total;
            } 
        ?>
        
        <div class="cart-divider"></div>
        <div class="cart-computing">
            <div class="sub-total">
                <div>Subtotal</div>
                <div><strong>$<?= $grand_total ?></strong></div>
            </div>
            <div class="total">Total<span><strong>$<?= $grand_total ?></strong></span> </div>
            <div class="cart-btn">
                <a class="proceed-checkout" href="checkout.php">Proceed to checkout</a>
                <a class="continue-shopping" href="shop.php">Continue Shopping</a>
            </div>
        </div>
        
        <?php } else { ?>

        <div class="empty">
            <p class="text-center cart-empty">Your cart is empty.</p>
            <a class="continue-shopping" href="shop.php">Continue Shopping</a>
        </div>
        
        <?php } ?>
        
    </div>
</section>
<!-- shopping cart section ends -->

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="./Scripts/Search.js"></script>
<script src="https://kit.fontawesome.com/80e0f4e3cb.js"></script>

</body>
</html>