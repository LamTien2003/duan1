<?php
class Bill extends DB {
    public function getBillsWithUser() {
        $sql = "SELECT * FROM `bill` inner join user on `bill`.id_user = `user`.`id_user`";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    function getBillsWithUserLimit($start,$count) {
        $sql = "SELECT * FROM `bill` inner join user on `bill`.id_user = `user`.`id_user` ORDER BY id_bill DESC LIMIT $start, $count ";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getBillById($id) {
        $sql = "SELECT * FROM `bill` WHERE id_bill = $id";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getCountBills() {
        $sql = "Select * from bill";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
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
    public function searchBill($name,$page,$limit) {
        $start = ($page -1) * $limit;
        $sql = "Select * from bill WHERE receiver_name LIKE '%$name%' OR delivery_address LIKE '%$name%' OR id_bill = '$name'";
        $sqlResult = "Select * from bill WHERE receiver_name LIKE '%$name%' OR delivery_address LIKE '%$name%' OR id_bill = '$name' LIMIT $start,$limit";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $countTotalBill = $stmt->rowCount();
        $stmt = $this->connect()->prepare($sqlResult);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return ["countTotalBill" => $countTotalBill, "data" => $result];
    }
}
?>