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





    <script src="../js/admin_script.js"></script>
    </body>
</html>
