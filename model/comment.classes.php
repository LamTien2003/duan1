<?php 
class Comment extends DB {
    public function getCommments() {
        $sql = "Select * from comment";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function countCommmentsDontAccept() {
        $sql = "Select * from comment where accept = 0";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }
    public function getCommmentsOfProduct($id_product) {
        $sql = "Select * from comment WHERE id_product = $id_product AND accept = 1";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function insertComment($comment,$id_product,$id_user) {
        $sql = "INSERT INTO `comment` ( `comment_content`, `accept`, `id_product`, `id_user`)
         VALUES ( ?, '0', ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$comment,$id_product,$id_user]);
    }
    public function deleteComment($id) {
        $sql = "DELETE FROM comment WHERE id_comment = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }
    public function acceptComment($id) {
        $sql = "UPDATE `comment` SET `accept` = '1' WHERE `comment`.`id_comment` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        header("Location:index.php?quanly=admin&action=manageComment");
    }
}

?>