<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('location:admin_login.php');
};

if(isset($_POST['add_product'])){
    $name=$_POST['name'];
    $name=filter_var($name,FILTER_SANITIZE_STRING);
    $price=$_POST['price'];
    $price=filter_var($price,FILTER_SANITIZE_STRING);
    $details=$_POST['details'];
    $details=filter_var($details,FILTER_SANITIZE_STRING);
    
    $image_01 = $_FILES['image_01']['name'];
    $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_01_size = $_FILES['image_01']['size'];
    $image_01_tmp_name = $_FILES['image_01']['tmp_name'];
    $image_01_folder = '../uploaded_img/'.$image_01;

    $image_02 = $_FILES['image_02']['name'];
    $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
    $image_02_size = $_FILES['image_02']['size'];
    $image_02_tmp_name = $_FILES['image_02']['tmp_name'];
    $image_02_folder = '../uploaded_img/'.$image_02;

    $image_03 = $_FILES['image_03']['name'];
    $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
    $image_03_size = $_FILES['image_03']['size'];
    $image_03_tmp_name = $_FILES['image_03']['tmp_name'];
    $image_03_folder = '../uploaded_img/'.$image_03;

    $select_products = $conn ->prepare ("SELECT *FROM `products` WHERE name = ?");
    $select_products->execute([$name]);

    if($select_products ->rowCount() > 0 ) {
        $message[] = 'product name already exist';
    } else {
        if ($image_01_size > 2000000 OR $image_02_size > 2000000 OR $image_03_size > 2000000){
            $message[] = 'image size is too large';
        } else {
            move_uploaded_file($image_01_tmp_name, $image_01_folder);
            move_uploaded_file($image_02_tmp_name, $image_02_folder);
            move_uploaded_file($image_03_tmp_name, $image_03_folder);

            $insert_products = $conn -> prepare (" INSERT INTO `products` (name, details, price, image_01, image_02, Image_03) VALUES(?,?,?,?,?,?)");
            $insert_products -> execute([$name, $details, $price, $image_01, $image_02, $image_03]);
        
            $message[] = 'new product has been added';
        
        }


    }

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
                    <textarea name="details" class="box" placeholder="enter product detail" required maxlength="500" cols="30" row="10"></textarea>
                </div>
                <input type="submit" value="add product" name="add_product" class="btn">
            </div>
        </form>


    </section>

    <!--custom js file link-->
    <script src="../js/admin_script.js"></script>
    </body>
</html>
