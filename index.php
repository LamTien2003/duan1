<?php
    ob_start(); //Fix loi setcookie hoac header sau khi html duoc render
    include_once('./model/db.classes.php');
    include_once('./model/session.classes.php');
    include_once('./model/product.classes.php');
    Session::init();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/components/header.css">
    <link rel="stylesheet" href="./assets/css/components/footer.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <?php
         if(isset($_GET['quanly'])) {
            switch($_GET['quanly']) {
                
                    case 'admin': 
                        echo '<link rel="stylesheet" href="./assets/css/admin.css">';
                        echo '<link rel="stylesheet" href="./assets/css/components/form.css">';
                    break;
                    case 'cuahang': 
                        echo '<link rel="stylesheet" href="./assets/css/shop.css">';
                        echo '<link rel="stylesheet" href="./assets/css/admin.css">';
                    break;
                    case 'giohang': 
                        echo '<link rel="stylesheet" href="./assets/css/style.css">';
                    break;
                    case 'chitiet': 
                        echo '<link rel="stylesheet" href="./assets/css/style.css">';
                    break;
                    case 'gioithieu': 
                        echo '<link rel="stylesheet" href="./assets/css/about.css">';
                    break;
                    case 'login': 
                        echo '<link rel="stylesheet" href="./assets/css/login.css">';
                    break;
                    case 'register': 
                        echo '<link rel="stylesheet" href="./assets/css/register.css">';
                    break;
                
            }
        }else {
            echo '<link rel="stylesheet" href="./assets/css/home.css">'; 
        }
     ?>
    <title>Dự án 1</title>
</head>
<body>
  <?php 
    if(isset($_GET['quanly'])) {
        switch($_GET['quanly']) {
            case 'admin': ''; break;
            case 'login': ''; break;
            case 'register': ''; break;
            default: {
                include_once './view/components/header.php';
                break;
            }
        }
    }else {
        include_once './view/components/header.php';
    }
  if(isset($_GET['quanly'])) {
      switch($_GET['quanly']) {
          case 'cuahang': include_once './view/shop.php'; break; 
          case 'gioithieu': include_once './view/about.php'; break; 
          case 'giohang': include_once './view/shoppingcart.php'; break; 
          case 'chitiet': include_once './view/chitietsp.php'; break; 
          case 'login': include_once './view/components/login.php'; break; 
          case 'register': include_once './view/components/register.php'; break; 
          case 'admin': include_once './view/admin/admin.php'; break; 
      }
  }else {
      include_once './view/home.php'; 
  }
  
  if(isset($_GET['quanly'])) {
        switch($_GET['quanly']) {
            case 'admin': ''; break;
            case 'login': ''; break;
            case 'register': ''; break;
            default: {
                include_once './view/components/footer.php';
                break;
            }
        }
    }else {
        include_once './view/components/footer.php';
    }

    
  ?>
    
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script src="./js/app.js"></script>
<script src="./js/validate.js"></script>
<script src="./js/search.js"></script>
</html>

<?php
     ob_end_flush(); // Flush the output from the buffer
?>