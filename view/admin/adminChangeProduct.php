<?php
  include_once('./model/product.classes.php');
  include_once('./model/category.classes.php');
  $Category = new Category();
  $Product = new Product();
    if(isset($_GET['id_sanpham']) && $_GET['id_sanpham']) {
        $id_sanpham = $_GET['id_sanpham'];
    }
    if(isset($_POST["submit_changeProduct"]) && $_POST["submit_changeProduct"] ) {
        if( (isset($_POST["fullname"]) && $_POST["fullname"]) && (isset($_FILES) && $_FILES)
        && (isset($_POST["subname"]) && $_POST["subname"]) && (isset($_POST["hot"]) && $_POST["hot"])
        && (isset($_POST["category"]) && $_POST["category"]) && (isset($_POST["description"]) && $_POST["description"]) ) {
            $title = $_POST["fullname"];
            $image = $_FILES['image'];
            $subTitle  = $_POST["subname"];
            $description = $_POST["description"];
            $hot  = $_POST["hot"];
            $category = $_POST['category'];
            // UPDATE VALUE
            $Product->updateProduct($id_sanpham,$image,$title,$subTitle,$description,$hot,$category);
            
        }
    }
?>

<?php
    $product = $Product->getProductId($id_sanpham);
    foreach($product as $row_product) {
?>
<div class="form">
    <form action="" method="POST" class="form container" id="form-1" enctype="multipart/form-data">
        <h3 class="heading">Thông tin Sản phẩm</h3>
        <div class="spacer"></div>

        <div class="form-group">
            <label for="fullname" class="form-label">Title Product</label>
            <input id="fullname" name="fullname" type="text" placeholder="VD: Lâm Tiến" class="form-control"
                autocomplete="off" value = "<?php echo $row_product['title_product'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="subname" class="form-label">SubTitle</label>
            <input id="subname" name="subname" type="text" placeholder="Subtitle của sản phẩm" class="form-control"
                autocomplete="off" value = "<?php echo $row_product['subTitle_product'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Mô tả</label>
            <input id="description" name="description" type="text" placeholder="Description của sản phẩm" class="form-control"
                autocomplete="off" value = "<?php echo $row_product['des_product'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="image" class="form-label">Image:</label>
            <input id="image" name="image" type="file" placeholder="VD: 0931462697" class="form-control"
                autocomplete="off" value = "<?php echo $row_product['img_product'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="hot" class="form-label">Hot</label>
            <input id="hot" name="hot" type="text" placeholder="VD: ltt@gmail.com" class="form-control"
                autocomplete="off" value = "<?php echo $row_product['hot_product'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="category" class="form-label">Danh mục</label>
            <select id="category" name="category"  class="form-control alo" autocomplete="off">
              <option value="">--Chọn danh mục</option>

            <?php
                $parentCategory = $Category->getCategorys();
                foreach($parentCategory as $row_parentCategory) {
            ?>
              <option value="<?php echo $row_parentCategory['id_category'] ?>"
                      <?php echo $row_parentCategory['id_category'] == $row_product['id_category'] ? 'selected': '' ?>
              >
                <?php echo $row_parentCategory['name_category'] ?> 
              </option>
            <?php }?>

            </select>
            <span class="form-message"></span>
        </div>


        <input class="form-submit" type="submit" value="Lưu" name="submit_changeProduct"></input>
    </form>
<?php } ?>
</div>
