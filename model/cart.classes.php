<?php
    include_once('./model/bill.classes.php');
    include_once('./model/detailBill.classes.php');
    include_once('./model/detailProduct.classes.php');
    include_once('./model/user.classes.php');

    class Cart {
        public function addToCart($id_detailProduct,$amount,$img_product,$title_product,$subtitle_product) {
            $id_user = Session::getValueSession('user');
            $array_sanpham = array("id" => $id_detailProduct,"title" => "$title_product","subtitle" => "$subtitle_product",
            "amount" => $amount,"img" => "$img_product");
            $checkContain = false;
                for($i = 0; $i < count($_SESSION['cart']) ; $i++) {
                    if($_SESSION['cart'][$i]['user'] == $id_user) {
                        for($j = 0; $j < count($_SESSION['cart'][$i]['product']); $j++) {
                            if($_SESSION['cart'][$i]['product'][$j]['id'] == $id_detailProduct) {
                                $checkContain = true;
                                $_SESSION['cart'][$i]['product'][$j]['amount'] += $soluong;
                            }
                        }
                    }
                }
                if(!$checkContain) {
                        for($i = 0; $i < count($_SESSION['cart']); $i++) {
                            if($_SESSION['cart'][$i]['user'] == $id_user) {
                                array_push($_SESSION['cart'][$i]['product'],$array_sanpham);
                        }
                    }
                }
                header("Location:index.php?quanly=giohang");
        }
        public function deteleProductFromCart($index_product,$id_user) {
            for($i = 0; $i < count($_SESSION['cart']) ; $i++) {
                if($_SESSION['cart'][$i]['user'] == $id_user) {
                    array_splice($_SESSION['cart'][$i]['product'],$index_product,1);
                }
            }
            header("Location:index.php?quanly=giohang");
        }
        public function payCart($amount,$id_detailProduct,$title,$img,$size,$price,$name,$phone,$address,$pointUsed,$totalMoney,$totalPay,$id_user) {
            $Bill = new Bill();
            $DetailBill = new DetailBill();
            $DetailProduct = new DetailProduct();
            $User = new User();
            $id_bill = $Bill->insertBill($address,$phone,$name,$pointUsed,$totalMoney,$totalPay);
            $User->deletePointUser($pointUsed,$id_user);
            for($i = 0; $i < count($id_detailProduct); $i++) {
                $DetailProduct->updateAmountDetailProduct($id_detailProduct[$i],$amount[$i]);
                $DetailBill->insertDetailBill($amount[$i],$size[$i],$title[$i],$img[$i],$price[$i],$id_bill,$id_detailProduct[$i]);
                $this->clearCart($id_user);
            }
            header("Location:index.php");

        }

        public function getCartOfUser($id_user) {
            $array = Session::getValueSession("cart");
            foreach($array as $item) {
                if($item['user'] == $id_user) {
                    return $item['product'];
                }
            }
        }

        public function clearCart ($id_user) {
            for($i = 0; $i < count($_SESSION['cart']) ; $i++) {
                if($_SESSION['cart'][$i]['user'] == $id_user) {
                    $_SESSION['cart'][$i]['product'] = array();
                }
            }
        }
    } 
?>