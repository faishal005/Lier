<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete_user->execute([$delete_id]);
    $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
    $delete_orders->execute([$delete_id]);
    $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
    $delete_messages->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart->execute([$delete_id]);
    header('location:users_accounts.php');
 }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>users accounts</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../css/admin_style.css?v=<?php echo time(); ?>">


    </head>
    <body>
        <?php include '../components/admin_header.php'; ?>

        
        <section class="accounts">

            <h1 class="heading">user accounts</h1>

            <div class="box-container">
            <?php
                $select_accounts = $conn->prepare("SELECT * FROM `users`");
                $select_accounts->execute();
                if($select_accounts->rowCount() > 0){
                    while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
            ?>
            <div class="box">
                <p> user id : <span><?= $fetch_accounts['id']; ?></span> </p>
                <p> user name : <span><?= $fetch_accounts['name']; ?></span> </p>
                
                <a href="user_accounts.php?delete=<?= $fetch_accounts['id']; ?>" 
                   onclick="return confirm('delete this account?')" class="delete-btn">delete</a>
            </div>
            <?php
                    }
                }else{
                    echo '<p class="empty">no accounts available!</p>';
                }
            ?>

            </div>

            </section>


    <!--custom js file link-->
    <script src="../js/admin_script.js"></script>
    </body>
</html>
