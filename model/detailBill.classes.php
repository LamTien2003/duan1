<?php
include_once('./model/bill.classes.php');
class DetailBill extends Bill {
    function getDetailBillsByBill($id) {
        $sql = "SELECT * FROM detailbill WHERE id_bill = $id";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
}

?>