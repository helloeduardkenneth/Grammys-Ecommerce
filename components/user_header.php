<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href=".assets/css/Grammys.css">
  <script src="https://kit.fontawesome.com/80e0f4e3cb.js"></script>
  
  <title>Grammys</title>
</head>

<body>

<style>
    .message {
        background-color: var(--light-violet-color);
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 40px;
        font-size: 1.5rem;
    }
    .login {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .login .fa-right-from-bracket {
        font-size: 1.4rem;
    }
</style>

<?php
    if(isset($message)){
       foreach($message as $message){
          echo '
          <div class="message">
             <span>'.$message.'</span>
             <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
          </div>
          ';
       }
    }
?>

<section class="header-section">
    <div class="header">
        <div class="grammys-logo">
            <img class="logo" src="./assets/grammys-logo.png" alt="grammys-logo">
        </div>
        <div class="right">
            <div class="search-container">
                <form action="#">
                    <input class="search-bar" id="search-input" type="text" placeholder="Search...">
                </form>
                <i class="fa fa-search" id="search-icon"></i>
            </div>
            <div class="login-or-cart">
            <?php
                $select_profile = $link->prepare("SELECT * FROM `users` WHERE id = ?");
                $select_profile->execute([$user_id]);
                if($select_profile->rowCount() > 0){
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>  
                <a href="logout.php">
                    <div class="login">
                        <i class="fa fa-right-from-bracket"></i>
                        <h1 class="login-text">Hi, <?= $fetch_profile['name']; ?>!</h1>
                    </div>
                </a>
                <?php } else { ?>
                    <a href="login.php">
                        <div class="login">
                            <i class="fa fa-user"></i>
                            <h1 class="login-text">Login</h1>
                        </div>
                    </a>
                <?php } ?>
                <a href="cart.php">
                    <div class="cart">
                        <i class="fa fa-cart-shopping"></i>
                        <h1 class="cart-text">Cart</h1>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="wrapper">
        <nav class="navbar">
            <input type="checkbox" id="toggle" onclick="toggleChecker()">
            <label for="toggle">
                <i class="material-icons">menu</i>
            </label>
            <div class="menu">
                <ul class="nav-item">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
        </nav>
    </div>          
</section>

