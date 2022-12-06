<?php
class Bill extends DB {
    public function getBillsWithUser() {
        $sql = "SELECT * FROM `bill` inner join user on `bill`.id_user = `user`.`id_user`";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getBillsWithUserLimit($start,$count) {
        $sql = "SELECT * FROM `bill` inner join user on `bill`.id_user = `user`.`id_user` ORDER BY id_bill DESC LIMIT $start, $count ";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getBillOfUser($id_user) {
        $sql = "SELECT * FROM `bill` WHERE id_user = $id_user";
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
    public function getCountBillsDontAcp() {
        $sql = "Select * from bill where status = 0";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }
    public function insertBill($address,$phone,$name,$pointUsed,$totalMoney,$totalPay) {
        $id_user = Session::getValueSession('user');
        $sql = "INSERT INTO `bill` (`delivery_address`, `receiver_phone`, `receiver_name`,
         `payment_method`, `point_used`, `total_money`, `total_pay`, `status`, `id_user`)
        VALUES (?, ?, ?, '0', ?, ?, ?, '0', ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$address,$phone,$name,$pointUsed,$totalMoney,$totalPay,$id_user]);
        $id_bill = $this->getLastIdBill();
        return $id_bill;
    }
    public function updateBill($address,$phone,$fullname,$status,$id_bill) {
        $sql = "UPDATE `bill` SET `delivery_address` = ?, `receiver_phone` = ?, `receiver_name` = ?, `status` = ? 
        WHERE `bill`.`id_bill` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$address,$phone,$fullname,$status,$id_bill]);
        header("Location:index.php?quanly=admin&action=manageCart");
    }
    public function updateStatusBill($id_bill,$status) {
        $sql = "UPDATE `bill` SET `status` = $status WHERE `bill`.`id_bill` = $id_bill";
        $stmt = $this->connect()->query($sql);
    }
    public function deleteBill($id) {
        $sql = "DELETE FROM bill WHERE id_bill = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }
    public function getLastIdBill() {
        $sql = "SELECT MAX(id_bill) FROM bill";
        $stmt = $this->connect()->query($sql);
        $arr = $stmt->fetch();
        $id_bill = $arr[0];
        return $id_bill;
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
    public function getDataChart() {
        $result = [];
        $sql = "SELECT COUNT(*) as soluong,DATE_FORMAT(date_pay,'%d/%m/%Y') as ngay from `bill` GROUP BY date_pay";
        $stmt = $this->connect()->query($sql);
        $fetchResult = $stmt->fetchAll();
        // foreach($fetchResult as $item) {

        // }
        return $fetchResult;
    }
}
?>