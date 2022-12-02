<?php
    include_once('./model/detailProduct.classes.php');
    $DetailProduct= new DetailProduct();
    if(isset($_GET['id_chitietSP']) && $_GET['id_chitietSP']) {
        $id_chitiet = $_GET['id_chitietSP'];
    }
    if(isset($_POST["submit_changeDetailProduct"]) && $_POST["submit_changeDetailProduct"] ) {
        if( (isset($_POST['price']) && $_POST['price']) && (isset($_POST['size']) && $_POST['size']) &&
        (isset($_POST['sold']) && $_POST['sold']) && (isset($_POST['tonkho']) && $_POST['tonkho']) ) {
          $id_sanpham = $_POST['id_sanpham'];
          $price = $_POST['price'];
          $size = $_POST['size'];
          $sold = $_POST['sold'];
          $inventory = $_POST['tonkho'];
          $DetailProduct->updateDetailProduct($inventory,$sold,$size,$price,$id_chitiet,$id_sanpham);
      }
    }
?>
<?php
        $detailProduct = $DetailProduct->getDetailProductById($id_chitiet);
        foreach($detailProduct as $row_detail) {
?>
<div class="form">
    <form action="" method="POST" class="form container" id="form-1">
        <h3 class="heading">Thông tin Sản phẩm</h3>
        <div class="spacer"></div>

    
        <div class="form-group">
            <label for="price" class="form-label">Giá sản phẩm </label>
            <input id="price" name="price" type="text" placeholder="VD: tienltps24556" class="form-control"
                autocomplete="off" value = "<?php echo $row_detail['detail_price'] ?>">
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <label for="size" class="form-label">Size </label>
            <input id="size" name="size" type="text" placeholder="VD: tienltps24556" class="form-control"
                autocomplete="off" value = "<?php echo $row_detail['detail_size'] ?>">
            <span class="form-message"></span>
        </div>


        <div class="form-group">
            <label for="sold" class="form-label">Số lượng đã bán</label>
            <input id="sold" name="sold" type="text" placeholder="VD: ltt@gmail.com" class="form-control"
                autocomplete="off" value = "<?php echo $row_detail['sold'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="tonkho" class="form-label">Số lượng tồn kho: </label>
            <input id="tonkho" name="tonkho" type="text" placeholder="VD: ltt@gmail.com" class="form-control"
                autocomplete="off" value = "<?php echo $row_detail['inventory'] ?>">
            <span class="form-message"></span>
        </div>
        <input type="text" hidden name="id_sanpham" value="<?php echo $row_detail['id_product'] ?>">
        <input class="form-submit" type="submit" value="Lưu" name="submit_changeDetailProduct"></input>
    </form>
</div>
<?php }?>
