<?php
  include_once('./model/product.classes.php');
  include_once('./model/category.classes.php');
  $Category = new Category(); 
  $Product = new Product();

  if(isset($_POST['submit_insertProduct']) && $_POST['submit_insertProduct'] ) {
      if( (isset($_POST['fullname']) && $_POST['fullname']) && (isset($_FILES) && $_FILES)
      && (isset($_POST['hot']) && $_POST['hot']) && (isset($_POST['subname']) && $_POST['subname']) 
      && (isset($_POST['category']) && $_POST['category']) && (isset($_POST['description']) && $_POST['description'])) {
          $fullName = $_POST['fullname'];
          $subName = $_POST['subname'];
          $category = $_POST['category'];
          $description = $_POST['description'];
          $image = $_FILES['image'];
          $hot = $_POST['hot'];
          $Product->insertProduct($fullName,$image,$hot,$subName,$category,$description);
      }
  }
?>

<div class="form">
    <form action="" method="POST" class="form container" id="form-1" enctype="multipart/form-data">
        <h3 class="heading">Thông tin Sản phẩm</h3>
        <div class="spacer"></div>


        <div class="form-group">
            <label for="fullname" class="form-label">Title: </label>
            <input id="fullname" name="fullname" type="text" placeholder="Title của sản phẩm" class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>
        <div class="form-group">
            <label for="subname" class="form-label">Subtitle: </label>
            <input id="subname" name="subname" type="text" placeholder="Subtitle của sản phẩm" class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="category" class="form-label">Danh mục</label>
            <select id="category" name="category"  class="form-control alo" autocomplete="off">
              <option value="">--Chọn Danh mục</option>
            <?php
                $categoryList = $Category->getCategorys();
                foreach($categoryList as $rowCategory) {
            ?>
              <option value="<?php echo $rowCategory['id_category']  ?>"><?php echo $rowCategory['name_category'] ?></option>

            <?php }?>
            </select>
            <span class="form-message"></span>
          </div>

          <div class="form-group">
            <label for="description" class="form-label">Mô tả sản phẩm</label>
            <input id="description" name="description" type="text" placeholder="VD: Mô tả sản phẩm" class="form-control height-100" autocomplete="off">
            <span class="form-message last-child"></span>
          </div>

        <div class="form-group">
            <label for="image" class="form-label">Image:</label>
            <input id="image" name="image" type="file" placeholder="./assets/image/..." class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="hot" class="form-label">Hot</label>
            <input id="hot" name="hot" type="text" placeholder="1,2,3,..." class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>


        <input class="form-submit" type="submit" value="Lưu" name="submit_insertProduct"></input>
    </form>

</div>
