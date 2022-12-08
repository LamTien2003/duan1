<?php

class User extends DB {

    public function getUsers() {
        $sql = "Select * from user";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getUserId($id) {
        $sql = "Select * from user WHERE id_user = $id";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getUsersLimit($start,$count) {
        $sql = "Select * from user ORDER BY id_user DESC LIMIT $start, $count ";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function countUsers() {
        $sql = "Select * from user where user_role = 0";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }
    public function countAdmins() {
        $sql = "Select * from user where user_role = 1";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }
    public function getCountUsers() {
        $sql = "Select * from user";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }
    public function insertUser($fullName,$userName,$password,$phone,$address,$email,$role) {
        $sql = "INSERT INTO user
        (`user_name`, `user_phone`, `user_address`, `user_email`, `accountName_user`, `user_password`, `user_role`)
        VALUES (?, ?, ?, ?, ?, ?, ?)";;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fullName,$phone,$address,$email,$userName,$password,$role]);
        header("Location:index.php?quanly=admin&action=manageUser");
    }
    public function updateUser($fullName,$userName,$password,$phone,$address,$email,$role,$id_user) {
        $sql = "UPDATE user 
        SET `user_name` = ?, user_phone = ?, user_address = ?, user_email = ?, accountName_user = ?,user_password = ?,user_role = ?
        WHERE id_user = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fullName,$phone,$address,$email,$userName,$password,$role,$id_user]);
        header("Location:index.php?quanly=admin&action=manageUser");
    }
    public function addPointUser($point,$id_user) {
        $sql = "UPDATE `user` SET point_available = point_available + $point WHERE id_user = $id_user";
        $stmt = $this->connect()->query($sql);
        echo "<script type='text/javascript'>alert('Chúc mừng, bạn vừa nhận được $point điểm thưởng, điểm thưởng sẽ được cộng vào ví và sử dụng khi thanh toán hóa đơn');</script>";
    }
    public function deletePointUser($point,$id_user) {
        $sql = "UPDATE `user` SET point_available = point_available - $point WHERE id_user = $id_user";
        $stmt = $this->connect()->query($sql);
        echo "<script type='text/javascript'>alert('Chúc mừng, bạn vừa nhận được $point điểm thưởng, điểm thưởng sẽ được cộng vào ví và sử dụng khi thanh toán hóa đơn');</script>";
    }
    public function changeInfoUser($fullName,$password,$phone,$address,$email,$id_user) {
        $sql = "UPDATE user 
        SET `user_name` = ?, user_phone = ?, user_address = ?, user_email = ?,user_password = ? WHERE id_user = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fullName,$phone,$address,$email,$password,$id_user]);
        header("Location:index.php?quanly=user");
    }
    public function changePasswordUser($password,$id_user) {
        $sql = "UPDATE user SET user_password = ? WHERE id_user = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$password,$id_user]);
        echo "
        <SCRIPT> 
            alert('Mật khẩu của bạn đã được đổi mới')
            window.location.replace('index.php?quanly=login');
        </SCRIPT>";
    }
    public function deleteUser($id) {
        $sql = "DELETE FROM user WHERE id_user = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }
    public function searchUser($name,$page,$limit) {
        $start = ($page -1) * $limit;
        $sql = "Select * from user WHERE user_name LIKE '%$name%' OR id_user = '$name' ";
        $sqlResult = "Select * from user WHERE user_name LIKE '%$name%' OR id_user = '$name' LIMIT $start,$limit";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $countTotalUser = $stmt->rowCount();
        $stmt = $this->connect()->prepare($sqlResult);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return ["countTotalUser" => $countTotalUser, "data" => $result];
    }
    public function checkUserForgetPassword($userName,$email) {
        $isCheck = false;
        $sql = "Select * from user WHERE accountName_user = '$userName' AND user_email = '$email'";
        $stmt = $this->connect()->query($sql);
        $user = $stmt->fetchAll();
        if($stmt->rowCount() >= 1) {
            $isCheck = $user[0]['id_user'];
        }
        return $isCheck;
    }
}
?>