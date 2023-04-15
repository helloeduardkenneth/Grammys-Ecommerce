<?php

@include 'config.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

    // Product Name
    $product_name = $_POST['product_name'];

    // Product Price
    $product_price = $_POST['product_price'];
 
    //  Description
    $product_desc = isset($_POST['product_desc']) ? $_POST['product_desc'] : '';

    // Product Category
    $product_category = isset($_POST['product_category']) ? $_POST['product_category'] : '';

    // Full size
    $product_fullsize = $_FILES['product_fullsize']['name'];
    $product_fullsize_tmp_name = $_FILES['product_fullsize']['tmp_name'];
    $product_fullsize_folder = 'uploaded_fullsize/'.$product_fullsize;

    // Thumbnail
    $product_thumbnail = $_FILES['product_thumbnail']['name'];
    $product_thumbnail_tmp_name = $_FILES['product_thumbnail']['tmp_name'];
    $product_thumbnail_folder = 'uploaded_thumbnail/'.$product_thumbnail;

    if(empty($product_name) || empty($product_price) || empty($product_fullsize) || empty($product_thumbnail) || empty($product_desc) || empty($product_category)){
        $message[] = 'Please fill out all the form';
    } else {

      $update_data = "UPDATE products SET name='$product_name', price='$product_price', fullsize='$product_fullsize', thumbnail='$product_thumbnail', description='$product_desc', category='$product_category'  WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

     //   Fullsize
 
     if($upload){
        move_uploaded_file($product_fullsize_tmp_name, $product_fullsize_folder);
        $message[] = 'new product added successfully';
    } else {
        $message[] = 'could not add the product';
    }

    //   Thumbnail

    if($upload){
        move_uploaded_file($product_thumbnail_tmp_name, $product_thumbnail_folder);
        $message[] = 'new product added successfully';
    } else {
        $message[] = 'could not add the product';
    }

   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">


<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">update the product</h3>
        <input type="text" placeholder="Enter Product Name" name="product_name" class="box">
        <input type="number" placeholder="Enter Product Price" name="product_price" class="box">
        <label>Full size</label>
        <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_fullsize" class="box">
        <label>Thumbnail</label>
        <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_thumbnail" class="box">
        <input type="text" placeholder="Enter Description" name="product_desc" class="box">
        <select class="box" name="product_category">
            <option value="" disabled selected>-- Select a Category --</option>
            <option value="Cinnamon Rolls">Cinnamon Rolls</option>
            <option value="Cream Puffs">Cream Puffs</option>
            <option value="Cupcakes">Cupcakes</option>
            <option value="Mini Pies">Mini Pies</option> 
            <option value="Tartlets">Tartlets</option>
        </select>
      <a href="admin_page.php" class="btn">Back</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>