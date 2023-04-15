<?php

include '../components/config.php';

if(isset($_POST['add_product'])){


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
    $product_fullsize_folder = '../uploaded_fullsize/'.$product_fullsize;

    // Thumbnail
    $product_thumbnail = $_FILES['product_thumbnail']['name'];
    $product_thumbnail_tmp_name = $_FILES['product_thumbnail']['tmp_name'];
    $product_thumbnail_folder = '../uploaded_thumbnail/'.$product_thumbnail;


    if(empty($product_name) || empty($product_price) || empty($product_fullsize) || empty($product_thumbnail) || empty($product_desc) || empty($product_category)){
       $message[] = 'Please fill out all the form';
    } else {
       $insert = "INSERT INTO products(name, price, fullsize, thumbnail, description, category) VALUES('$product_name', '$product_price', '$product_fullsize', '$product_thumbnail', '$product_desc', '$product_category')";
       $upload = mysqli_query($link, $insert);
 
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
 

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($link, "DELETE FROM products WHERE id = $id");
   header('location:admin_page.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Grammys Admin Panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css  -->
   <style>

      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

      :root{
         --green:#27ae60;
         --black:#333;
         --white:#fff;
         --bg-color:#eee;
         --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
         --border:.1rem solid var(--black);
      }

      *{
         font-family: 'Poppins', sans-serif;
         margin:0; padding:0;
         box-sizing: border-box;
         outline: none; border:none;
         text-decoration: none;
         text-transform: capitalize;
      }

      html{
         font-size: 62.5%;
         overflow-x: hidden;
      }

      .btn{
         display: block;
         width: 100%;
         cursor: pointer;
         border-radius: .5rem;
         margin-top: 1rem;
         font-size: 1.7rem;
         padding:1rem 3rem;
         background: var(--green);
         color:var(--white);
         text-align: center;
      }

      .btn:hover{
         background: var(--black);
      }

      .message{
         display: block;
         background: var(--bg-color);
         padding:1.5rem 1rem;
         font-size: 2rem;
         color:var(--black);
         margin-bottom: 2rem;
         text-align: center;
      }

      .container{
         max-width: 100%;
         padding:2rem;
         margin:0 auto;
      }

      .admin-product-form-container.centered{
         display: flex;
         align-items: center;
         justify-content: center;
         min-height: 100vh;
         
      }

      .admin-product-form-container form{
         max-width: 50rem;
         margin:0 auto;
         padding:2rem;
         border-radius: .5rem;
         background: var(--bg-color);
      }

      .admin-product-form-container form h3{
         text-transform: uppercase;
         color:var(--black);
         margin-bottom: 1rem;
         text-align: center;
         font-size: 2.5rem;
      }

      .admin-product-form-container form .box{
         width: 100%;
         border-radius: .5rem;
         padding:1.2rem 1.5rem;
         font-size: 1.7rem;
         margin:1rem 0;
         background: var(--white);
         text-transform: none;
      }

      .product-display{
         margin:2rem 0;
      }

      .product-display .product-display-table{
         width: 100%;
         text-align: center;
      }

      .product-display .product-display-table thead{
         background: var(--bg-color);
      }

      .product-display .product-display-table th{
         padding: 1rem;
         font-size: 1rem;
      }


      .product-display .product-display-table td{
         padding:1rem;
         font-size: 1.5rem !important;
         border-bottom: var(--border);
      }

      .product-display .product-display-table .btn:first-child{
         margin-top: 0;
      }

      .product-display .product-display-table .btn:last-child{
         background: crimson;
      }

      .product-display .product-display-table .btn:last-child:hover{
         background: var(--black);
      }

      @media (max-width:991px){

         html{
            font-size: 55%;
         }

      }

      @media (max-width:768px){

         .product-display{
            overflow-y:scroll;
         }

         .product-display .product-display-table{
            width: 80rem;
         }

      }

      @media (max-width:450px){

         html{
            font-size: 50%;
         }

      }
   </style>

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

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
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
            <option value="Muffins">Muffins</option> 
            <option value="Tartlets">Tartlets</option>
         </select>
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>

   </div>

   <?php

   $select = mysqli_query($link, "SELECT * FROM products");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>full size</th>
            <th>thumbnail</th>
            <th>product name</th>
            <th>product description</th>
            <th>product price</th>
            <th>product category</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="../uploaded_fullsize/<?php echo $row['fullsize']; ?>" width="100" height="100" alt=""></td>
            <td><img src="../uploaded_thumbnail/<?php echo $row['thumbnail']; ?>" width="100" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>$<?php echo $row['price']; ?>/-</td>
            <td><?php echo $row['category']; ?></td>
            <td>
               <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>