<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('location:admin_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>products</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>">


    </head>
    <body>
        
    <?php 
        include '../components/admin_header.php';    
    ?>

    <section class="add-products">
        <h1 class="heading">add product</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="flex">
                <div class="inputBox">
                    <span> product name(cannot empty)</span>
                    <input type="text" required placeholder="enter product name" 
                    name="name" maxlength="100" class="box">
                </div>
                <div class="inputBox">
                    <span> product price(cannot empty)</span>
                    <input type="number" min="0" max="9999999999" required placeholder="enter product price" 
                    name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
                </div>
                <div class="inputBox">
                    <span>image 01 (cannot empty)</span>
                    <input type="file" name="image_01" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                </div>
                <div class="inputBox">
                    <span>image 02 (cannot empty)</span>
                    <input type="file" name="image_02" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                </div>
                <div class="inputBox">
                    <span>image 03 (cannot empty)</span>
                    <input type="file" name="image_03" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                </div>
                <div class="inputBox">
                    <span>products detail</span>
                    <textarea name="details" class="box" placeholder=" enter product detail" required maxlength="500" cols="30" row="10"></textarea>
                </div>
                <input type="submit" value="add product" name="add_product" class="btn">
            </div>
        </form>


    </section>

    <!--custom js file link-->
    <script src="../js/admin_script.js"></script>
    </body>
</html>
