<?php

include 'components/config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./assets/css/Grammys.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
    <style>
    .checkout {
        background-color: var(--light-violet-color);
        width: 100%;
        padding: 75px 250px 25px 250px;
    }

    .checkout-heading {
        color: var(--dark-violet-color);
        font-size: 50px;
        font-weight: 500;
        margin-bottom: 60px;
    }
    .checkout-form {
        display: flex;
        gap: 45px;
        flex-direction: column;
        padding: 90px 285px 90px 285px;
        max-width: 1000px;
    }
    .box {
        display: flex;
        justify-content: space-between;
    }
    .btn {
        align-self: flex-start;
        padding: 12px 55px;
        background: #9112FF !important;
        border: none;
        border-radius: 8px;
        color: #FFFFFF;
        font-size: 25px;
        font-weight: 500;
    }

    .checkout-form p {
        font-size: 25px;
        font-weight: 500;
    }
    .continue-shopping {
        background-color: #FFFFFF;
        border: 2px solid var(--dark-violet-color);
        padding: 12px 45px;
        color: var(--dark-violet-color);
        font-weight: 600;
        border-radius: 8px;
    }
    @media (max-width: 767px) {
        .checkout {
            padding: 25px 0; !important;
        }
        .checkout-heading {
            font-size: 25px;
            margin: 0;
        }
        .checkout-form {
            display: flex;
            gap: 45px;
            flex-direction: column;
            padding: 35px 24px 250px 24px;
            justify-content: center;
            text-align: center;
        }   
    }
    </style>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section>
    <div class="checkout">
        <h1 class="text-center checkout-heading">Checkout</h1>
    </div>

    
    <div class="checkout-form">
        <p class="box">
            Your order has been placed. Thank you!
        </p>
        <div class="cart-btn">
            <a class="continue-shopping" href="shop.php">Continue Shopping</a>
        </div>
    </div>

</section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="./Scripts/Search.js"></script>

</body>
</html>