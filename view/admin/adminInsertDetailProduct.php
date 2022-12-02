<?php
  include_once('./model/detailProduct.classes.php');
  $DetailProduct= new DetailProduct();
  if(isset($_GET['id_sanpham']) && $_GET['id_sanpham']) {
    $id_sanpham = $_GET['id_sanpham'];
  }
  if(isset($_POST['submit_insertProduct']) && $_POST['submit_insertProduct'] ) {
      if( (isset($_POST['price']) && $_POST['price']) && (isset($_POST['size']) && $_POST['size']) &&
      (isset($_POST['sold']) && $_POST['sold']) && (isset($_POST['tonkho']) && $_POST['tonkho']) ) {
          $price = $_POST['price'];
          $size = $_POST['size'];
          $sold = $_POST['sold'];
          $inventory = $_POST['tonkho'];
          $DetailProduct->insertDetailProduct($price,$size,$inventory,$sold,$id_sanpham);
      }
  }
?>

<div class="form">
    <form action="" method="POST" class="form container" id="form-1">
        <h3 class="heading">Thông tin Sản phẩm</h3>
        <div class="spacer"></div>


        <div class="form-group">
            <label for="price" class="form-label">Giá sản phẩm </label>
            <input id="price" name="price" type="text" placeholder="Giả sản phẩm" class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <label for="size" class="form-label">Size </label>
            <input id="size" name="size" type="text" placeholder="VD: Size sản phẩm" class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>


        <div class="form-group">
            <label for="sold" class="form-label">Số lượng đã bán</label>
            <input id="sold" name="sold" type="text" placeholder="Số lượng đã bán" class="form-control"
                autocomplete="off" value = "0">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="tonkho" class="form-label">Số lượng tồn kho: </label>
            <input id="tonkho" name="tonkho" type="text" placeholder="Số lượng tồn kho" class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>


        <input class="form-submit" type="submit" value="Lưu" name="submit_insertProduct"></input>
    </form>

</div>

