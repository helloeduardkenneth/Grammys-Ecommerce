<?php

include 'components/config.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $pass = ($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = ($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $link->prepare("SELECT * FROM users WHERE email = ? OR number = ?");
   $select_user->bind_param("ss", $email, $number);
   $select_user->execute();
   $select_user->store_result();
   $row_count = $select_user->num_rows;

   if($row_count > 0){
      $message[] = 'email or number already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $link->prepare("INSERT INTO `users`(name, email, number, password) VALUES(?,?,?,?)");
         $insert_user->bind_param("ssss", $name, $email, $number, $cpass);
         $insert_user->execute();
         $select_user = $link->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->bind_param("ss", $email, $pass);
         $select_user->execute();
         $select_user->store_result();
         $row_count = $select_user->num_rows;
         if($row_count > 0){
            $select_user->bind_result($id);
            $select_user->fetch();
            $_SESSION['user_id'] = $id;
            header('location: login.php');
         }
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
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./assets/css/Grammys.css">

</head>

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
</style>

<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="form-container">

   <form action="" method="post">
    <div class="register">
        <h1 class="text-center register-heading">Register</h1>
    </div>
    <div class="register-form">
        <div class="box">
            <label for="name">Name</label>
            <input type="text" name="name" required maxlength="50">
        </div>

        <div class="box">
            <label for="email">Email</label>
            <input type="email" name="email" required class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        </div>

        <div class="box">
            <label for="number">Contact Number</label>
            <input type="number" name="number" required min="0" max="9999999999" maxlength="12">
        </div>

        <div class="box">
            <label for="pass">Password</label>
            <input type="password" name="pass" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        </div>

        <div class="box">
            <label for="cpass">Confirm Password</label>
            <input type="password" name="cpass" required class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
        </div>

        <input type="submit" value="Register" name="submit" class="btn">
        <p>Already have an account? <a href="login.php">Login.</a></p>
    </div>
   </form>

</section>

<?php include 'components/footer.php'; ?>


<!-- custom js file link  -->
<script>
    document.querySelectorAll('input[type="number"]').forEach(numberInput => {
        numberInput.oninput = () =>{
            if(numberInput.value.length > numberInput.maxLength) numberInput.value = numberInput.value.slice(0, numberInput.maxLength);
        };
    });
</script>

<script src="./Scripts/Search.js"></script>

<script src="https://kit.fontawesome.com/80e0f4e3cb.js"></script>


</body>
</html>