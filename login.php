<?php

include 'components/config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = ($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
 
    $select_user = $link->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
 
    if($select_user->rowCount() > 0){
       $_SESSION['user_id'] = $row['id'];
       header('location:home.php');
    }else{
       $message[] = 'incorrect username or password!';
    }
 
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./assets/css/Grammys.css">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>

<style>
     .register {
        background-color: var(--light-violet-color);
        width: 100%;
        padding: 75px 250px 25px 250px;
    }

    .register-heading {
        color: var(--dark-violet-color);
        font-size: 50px;
        font-weight: 500;
        margin-bottom: 60px;
    }
    .register-form {
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
    .box label {
        font-size: 25px;
        font-weight: 500;
    }
    .register-form p {
        font-size: 16px;
        font-weight: 400;
    }
    @media (max-width: 767px) {
        .register {
            padding: 25px 0;
        }
        .register-heading {
            font-size: 25px;
            margin: 0;
        }
        .register-form {
            padding: 40px 20px;
        }
        .box {
            flex-direction: column;
            gap: 10px;
        }
        .box input[type="email"], .box input[type="password"] {
            height: 45px;
        }
        .btn {
            display: flex;
            align-self: center;
        }
        .register-form p {
            text-align: center;
        }
    }
</style>

<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="form-container">

   <form action="" method="post">
   <div class="register">
        <h1 class="text-center register-heading">Login</h1>
    </div>

    <div class="register-form">
        <div class="box">
            <label for="email">Email</label>
            <input type="email" name="email" required maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        </div>
        <div class="box">
            <label for="pass">Password</label>
            <input type="password" name="pass" required maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        </div>
        <input type="submit" value="Login" name="submit" class="btn">
        <p>Don't have an account? <a href="register.php">Register.</a></p>
    </div>
   </form>

</section>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="./Scripts/Search.js"></script>

<script src="https://kit.fontawesome.com/80e0f4e3cb.js"></script>

</body>
</html>