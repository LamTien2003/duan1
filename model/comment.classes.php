<?php 
class Comment extends DB {
    public function getCommments() {
        $sql = "Select * from comment";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
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