<?php
class Bill extends DB {
    public function getBillsByUser() {
        $sql = "SELECT * FROM `bill` inner join user on `bill`.id_user = `user`.`id_user`";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getBillById($id) {
        $sql = "SELECT * FROM `bill` WHERE id_bill = $id";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function updateBill($address,$phone,$fullname,$status,$id_bill) {
        $sql = "UPDATE `bill` SET `delivery_address` = ?, `receiver_phone` = ?, `receiver_name` = ?, `status` = ? 
        WHERE `bill`.`id_bill` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$address,$phone,$fullname,$status,$id_bill]);
        header("Location:index.php?quanly=admin&action=manageCart");
    }
    public function deleteBill($id) {
        $sql = "DELETE FROM bill WHERE id_bill = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>