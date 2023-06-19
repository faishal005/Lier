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
        <title>dashboard</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>">


    </head>
    <body>

    <?php    
    include '../components/admin_header.php';
    ?>
    
    <section class = "dashboard">
        <h1 class="heading">DashBoard</h1>
        <div class="box-container">

        <div class="box">
            <h3> welcome </h3>
            <p><?= $fetch_profile['name']; ?></p>
            <a href="update_profile.php" class="btn">update profile</a>
        </div>

        <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['pending']);
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['total_price'];
               }
            }
         ?>
         <h3><span>$</span><?= $total_pendings; ?><span>/-</span></h3>
         <p>total pendings</p>
         <a href="placed_orders.php" class="btn">see orders</a>
        </div>

        <div class="box">
        <?php
            $total_completes =0;
            $select_completes = $conn -> prepare ("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completes-> execute(['completed']);
            if($select_completes->rowCount() > 0){
            while($fetch_completes = $select_completes -> fetch (PDO::FETCH_ASSOC)){
                $total_completes += $fetch_pending ['total_price'];                
            }
        }
        ?>
            <h3><span>$</span><?$total_completes; ?><span>/-</span> </h3>
            <p>total completes</p>
            <a href="placed_orders.php" class="btn">see orders</a>
        </div>

        <div class="box">
            <?php 
                $select_orders = $conn -> prepare ("SELECT * FROM `orders`");
                $select_orders -> execute();
                $numbers_of_orders = $select_orders -> rowCount();
            ?>
            <h3><?=$numbers_of_orders;  ?></h3>
            <P>total orders</P>
            <a href="placed_orders.php" class="btn">see orders</a>
        </div>

        <div class="box">
            <?php 
                $select_products = $conn -> prepare ("SELECT * FROM `products`");
                $select_products -> execute();
                $numbers_of_products = $select_products -> rowCount();
            ?>
            <h3><?=$numbers_of_products;  ?></h3>
            <P>products added</P>
            <a href="products.php" class="btn">see products</a>
        </div>

        <div class="box">
            <?php 
                $select_users = $conn -> prepare ("SELECT * FROM `users`");
                $select_users -> execute();
                $numbers_of_users = $select_users -> rowCount();
            ?>
            <h3><?=$numbers_of_users;  ?></h3>
            <P>users account</P>
            <a href="products.php" class="btn">see users</a>
        </div>

        <div class="box">
            <?php 
                $select_admins = $conn -> prepare ("SELECT * FROM `admins`");
                $select_admins -> execute();
                $numbers_of_admins = $select_admins -> rowCount();
            ?>
            <h3><?=$numbers_of_admins;  ?></h3>
            <P>total admins</P>
            <a href="admin_accounts.php" class="btn">see admins</a>
        </div>

        <div class="box">
            <?php 
                $select_messages = $conn -> prepare ("SELECT * FROM `messages`");
                $select_messages -> execute();
                $numbers_of_messages = $select_messages -> rowCount();
            ?>
            <h3><?=$numbers_of_messages;  ?></h3>
            <P>see messages</P>
            <a href="messages.php" class="btn">see messages</a>
        </div>
        </div>

    </section>

    <!--custom js file link-->
    <script src="../js/admin_script.js"></script>
    </body>
</html>
