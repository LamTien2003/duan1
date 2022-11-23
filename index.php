<?php
ob_start(); //Fix loi setcookie hoac header sau khi html duoc render
session_start();
    include_once('./model/db.classes.php');
    include_once('./model/product.classes.php');
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
                    case 'shop': 
                        echo '<link rel="stylesheet" href="./assets/css/main.css">';
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

  ( isset($_GET['quanly']) && $_GET['quanly'] == 'admin' ) ? '' : include_once './view/components/header.php';
  if(isset($_GET['quanly'])) {
      switch($_GET['quanly']) {
          case 'danhmuc': include_once './view/shop.php'; break; 
          case 'gioithieu': include_once './view/about.php'; break; 
          case 'admin': include_once './view/admin/admin.php'; break; 
      }
  }else {
      include_once './view/home.php'; 
  }
  
  ( isset($_GET['quanly']) && $_GET['quanly'] == 'admin' ) ? '' : include_once './view/components/footer.php';

    
  ?>
    
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="./js/app.js"></script>
<script src="./js/validate.js"></script>
</html>
<?php
     ob_end_flush(); // Flush the output from the buffer
?>