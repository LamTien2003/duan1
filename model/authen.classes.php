<?php
    include_once('./model/user.classes.php');
    class Authen {

        public function login($userName,$password) {
            $isLogin = false;
            $isAdmin = false;
            $User = new User();

            $userList = $User->getUsers();
            foreach($userList as $row_user) {
                $taikhoan = $row_user["accountName_user"];
                $matkhau = $row_user["user_password"];
                $role = $row_user["user_role"];
                if($userName == $taikhoan && $matkhau == $password) {
                    $isLogin = true;
                    $id_user = $row_user["id_user"];
                    $role ? $isAdmin = true : $isAdmin = false;
                    Session::setValueSession("user",$id_user);
                }
            };
            
            if($isLogin) {
                $arr = array("user" => $id_user,"product"=> array());
                $checkContain = false;
                $sessionCart = Session::getValueSession('cart');
                foreach($sessionCart as $item) {
                    if($item['user'] == $id_user )
                    $checkContain = true;
                }
                $newCartSession = array_push($sessionCart,$arr);
                !$checkContain ? Session::setValueSession('cart',$newCartSession) : '';
                // !$checkContain ? array_push($_SESSION['cart'],$arr) : '';

                $message = "Đăng nhập thành công";
                $isAdmin ? header("Location: index.php?quanly=admin") : header("Location: index.php"); 
                echo "<script type='text/javascript'>alert('$message');</script>";
            }else {
                $message = "Đăng nhập thất bại";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }

        public function register($fullName,$userName,$password,$phone,$address,$email) {
            $isContain = false;
            $User = new User();
            $userList = $User->getUsers();
            foreach($userList as $row_user) {
                $taikhoan = $row_user["accountName_user"];
                if($userName == $taikhoan) {
                    $isContain = true;
                }
            };
            if(!$isContain) {
                $User->insertUser($fullName,$userName,$password,$phone,$address,$email,'0');
                echo "<script type='text/javascript'>alert('Đăng ký thành công');</script>";
                header("Location: index.php?quanly=login");
                return;
            }else {
                return "Tài khoản đã tồn tại";
            }
        }
    }

?>