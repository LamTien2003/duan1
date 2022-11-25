<?php
    // include_once('./model/admin.php');
    // $countUser = getCountUser($connect);
    // $countSanpham = getCountProduct($connect);
    // $countGiohang = getCountOrder($connect);
?>



<!-- =============== Navigation ================ -->
<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <!-- <span class="icon">
                        <ion-icon name="logo-apple"></ion-icon>
                    </span> -->

                        <img  src="./assets/images/fuho_logo.png" alt="" class="logo">
   
                </a>
                <!-- <div class="sub-header-img">
                    
                </div> -->
            </li>

            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Tổng quan</span>
                </a>
            </li>

            <li>
                <a href="?quanly=admin&action=manageUser">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Quản lý User</span>
                </a>
            </li>

            <li>
                <a href="?quanly=admin&action=manageProduct">
                    <span class="icon">
                        <ion-icon name="chatbubble-outline"></ion-icon>
                    </span>
                    <span class="title">Quản lý sản phẩm</span>
                </a>
            </li>
            <li>
                <a href="?quanly=admin&action=manageCart">
                    <span class="icon">
                        <ion-icon name="chatbubble-outline"></ion-icon>
                    </span>
                    <span class="title">Quản lý Đơn hàng</span>
                </a>
            </li>
            <li>
                <a href="?quanly=admin&action=manageCategory">
                    <span class="icon">
                        <ion-icon name="chatbubble-outline"></ion-icon>
                    </span>
                    <span class="title">Quản lý Danh mục</span>
                </a>
            </li>
            <li>
                <a href="?quanly=admin&action=manageComment">
                    <span class="icon">
                        <ion-icon name="chatbubble-outline"></ion-icon>
                    </span>
                    <span class="title">Quản lý Bình luận</span>
                </a>
            </li>

            <li>
                <a href="?quanly=admin&action=manageSlider">
                    <span class="icon">
                        <ion-icon name="chatbubble-outline"></ion-icon>
                    </span>
                    <span class="title">Quản lý Slider</span>
                </a>
            </li>

            <li>
                <a href="index.php">
                    <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                    <span class="title">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>

            <div class="user">
                <img src="assets/imgs/customer01.jpg" alt="">
            </div>
        </div>

        <!-- ======================= Cards ================== -->
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Sản phẩm</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="eye-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Users</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="cart-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers"></div>
                    <div class="cardName">Đơn hàng được đặt</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="chatbubbles-outline"></ion-icon>
                </div>
            </div>

        </div>

        <!-- ================ Order Details List ================= -->
        <div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Thông tin chi tiết</h2>
                </div>
                
                <?php
                    if(isset($_GET['action']) && $_GET['action']) {
                        switch($_GET['action']) {
                            case 'manageUser': include_once('adminManageUser.php'); break;
                            case 'manageSlider': include_once('adminManageSlider.php'); break;
                            case 'manageProduct' : include_once('adminManageProduct.php'); break;
                            case 'manageCart' : include_once('adminManageCart.php'); break;
                            case 'manageCategory' : include_once('adminManageCategory.php'); break;
                            case 'manageComment' : include_once('adminManageComment.php'); break;
                            case 'detailCart' : include_once('adminDetailCart.php'); break;
                            case 'detailProduct' : include_once('adminDetailProduct.php'); break;
                            case 'changeUser' : include_once('adminChangeUser.php'); break;
                            case 'changeSlider' : include_once('adminChangeSlider.php'); break;
                            case 'changeCategory' : include_once('adminChangeCategory.php'); break;
                            case 'changeProduct' : include_once('adminChangeProduct.php'); break;
                            case 'changeDetailProduct' : include_once('adminChangeDetailProduct.php'); break;
                            case 'changeCart' : include_once('adminChangeCart.php'); break;
                            case 'insertProduct' : include_once('adminInsertProduct.php'); break;
                            case 'insertDetailProduct' : include_once('adminInsertDetailProduct.php'); break;
                            case 'insertUser' : include_once('adminInsertUser.php'); break;
                            case 'insertSlider' : include_once('adminInsertSlider.php'); break;
                            case 'insertCategory' : include_once('adminInsertCategory.php'); break;
                        }
                    }else {
                        include_once('adminManageUser.php');
                    }
                ?>
                
            </div>


        </div>
    </div>
</div>