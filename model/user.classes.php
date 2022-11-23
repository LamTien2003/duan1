<?php

class User extends DB {

    public function getUsers() {
        $sql = "Select * from User";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getUserId($id) {
        $sql = "Select * from User WHERE id_user = $id";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
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
    public function deleteUser($id) {
        $sql = "DELETE FROM user WHERE id_user = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>