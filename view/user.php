<?php
    include_once('./model/user.classes.php');
    $User = new User();
    $id_user = Session::getValueSession('user');
    $user = $User->getUserId($id_user);
      
?>
<div class="content">
    <?php
        $user = $User->getUserId($id_user);
        foreach($user as $item) {
    ?>
        <div class="content-left">
            <div class="logo">
                <div class="img"><img src="./assets/images/1.jpg" alt=""></div>
                <div class="logo-info">
                    <h4 class="name"><?php echo $item['user_name'] ?></h4>
                    <div class="point-available"><?php echo $item['point_available'] ?> Điểm thưởng hiện có</div>
                </div>
            </div>
            <div class="info-user">
                <div class="info-details">
                    <i class="fa-solid fa-user"></i>
                    <a href="?quanly=user">Tài khoản của tôi</a>
                </div>
                <div class="info-details">
                    <i class="fa-solid fa-user"></i>
                    <a href="?quanly=user&action=mycart">Đơn hàng của tôi</a>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="content-right">
        <div class="title">
            <h3>Hồ sơ của tôi</h3>
            <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
        </div>

        <?php
            if(isset($_GET['action'])) {
                switch($_GET['action']) {
                    case "mycart" : include_once("userCart.php");
                }
            }else {
                include_once("userInfo.php");
            }
        ?>


    </div>
</div>