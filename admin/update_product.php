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
        <title>update product</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>">


    </head>
    <body>
    <?php 
        include '../components/admin_header.php';    
    ?>
    <!-- update -->
    <section class="update-product">

    <?php
        $update_id=$_GET['update'];
        $select_products = $conn -> prepare ("SELECT * FROM `products` WHERE id = ?");
        $select_products -> execute ([$update_id]);
        if($select_products -> rowCount() > 0){
            while ($fetch_products = $select_products -> fetch (PDO::FETCH_ASSOC)){
    ?>
    <form action="" method="post" enctype="multipart/form-data">
            <div class="image-container">
                <div class="main-image">
                    <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                </div>
                <div class="sub-image">
                    <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                    <img src="../uploaded_img/<?= $fetch_products['image_02']; ?>" alt="">
                    <img src="../uploaded_img/<?= $fetch_products['image_03']; ?>" alt="">

                </div>
            </div>
            <span>name product</span>
            <input type="text" required placeholder="enter product name"
            name="name" maxlength="100" class="box" 
            value="<?= $fetch_products['name']; ?>">
            <span>price</span>
            <input type="number" min="0" max="9999999999" name="price" 
            onkeypress=" if(this.value.length == 10 ) return false;" class="box"
            value="<?= $fetch_products['price']; ?>">
            <span>details</span>
            <textarea name="details" class="box" placeholder="enter product detail" 
            required maxlength="500" cols="30" row="10"><?= $fetch_products['details']; ?></textarea>
            <span>Gambar 01</span>
            <input type="file" name="image_01" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
            <span>Gambar 02</span>
            <input type="file" name="image_02" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
            <span>Gambar 02</span>
            <input type="file" name="image_03" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>



    </form>
    <?php
                }
            }else{
                echo '<p class="empty"> no products added</p>';
            }
        
    ?>

    </section>
    <!--custom js file link-->
    <script src="../js/admin_script.js"></script>
    </body>
</html>
