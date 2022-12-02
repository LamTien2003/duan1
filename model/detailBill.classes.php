<?php
include_once('./model/bill.classes.php');
class DetailBill extends Bill {
    function getDetailBillsByBill($id) {
        $sql = "SELECT * FROM detailbill WHERE id_bill = $id";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function insertDetailBill($amount,$size,$title,$img,$price,$id_bill,$id_detailProduct) {
        $id_user = Session::getValueSession('user');
        $id_detail = $id_detailProduct;
        $sql = "INSERT INTO `detailbill` ( `amount_detail`, `size_detail`,
         `product_name`, `product_img`, `product_price`, `id_bill`, `id_detailProduct`) 
        VALUES ( '$amount', '$size', '$title', '$img', '$price', '$id_bill', $id_detail)";
        $stmt = $this->connect()->query($sql);
    }
}

?>