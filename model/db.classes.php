<?php
class DB {
    private $servername = "localhost";
    private $username = "root";
    private $password = '';
    private $dbname = "fuho";

    protected function connect () {
        try {
            $conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    protected function addImageToFolder($image) {
        $target_dir = "./assets/images/";
        $target_file = $target_dir . basename($image["name"]);
        $uploadOk = true;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 
        if (file_exists($target_file)) {
        echo "File đã tồn tại";
        $uploadOk = false;
        }

        if ($image["size"] > 500000) {
        echo "Dung lượng File quá lớn.";
        $uploadOk = false;
        return;
        }
 
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "webp" ) {
        echo "Sai định dạng ảnh.";
        $uploadOk = false;
        return;
        }

        if (!$uploadOk) {
        echo "Update không thành công.";
        }else {
            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                echo "File ". htmlspecialchars( basename( $image["name"])). " Đã được update.";
            } else {
                echo "Có lỗi xảy ra khi update.";
            }
        }
        return $target_file;
    }
}
?>