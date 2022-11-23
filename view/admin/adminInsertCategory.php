<?php
  include_once('./model/category.classes.php');
  $Category = new Category();
  if(isset($_POST["submit_insertProduct"]) && $_POST["submit_insertProduct"] ) {
    if( (isset($_POST["fullname"]) && $_POST["fullname"]) && (isset($_POST["order"]) && $_POST["order"]) 
    && (isset($_FILES) && $_FILES) && (isset($_POST["parentId"]) && ($_POST["parentId"] || $_POST["parentId"] == 0)) ) {
        $fullName = $_POST["fullname"];
        $image = $_FILES['image'];
        $parentId  = $_POST["parentId"];
        $order = $_POST['order'];
        // UPDATE VALUE

        var_dump($order);
        $Category->insertCategory($image,$fullName,$order,$parentId);
    }
}
?>

<div class="form">
    <form action="" method="POST" class="form container" id="form-1" enctype="multipart/form-data">
    <h3 class="heading">Thông tin Danh mục</h3>
        <div class="spacer"></div>

        <div class="form-group">
            <label for="fullname" class="form-label">Tên</label>
            <input id="fullname" name="fullname" type="text" placeholder="Tên danh mục" class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>


        <div class="form-group">
            <label for="image" class="form-label">Image:</label>
            <input id="image" name="image" type="file" placeholder="./assets/images/..." class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="order" class="form-label">Vị trí</label>
            <input id="order" name="order" type="text" placeholder="1,2,3,..." class="form-control"
                autocomplete="off" value = "">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="parentId" class="form-label">Danh mục cha</label>
            <select id="parentId" name="parentId"  class="form-control alo" autocomplete="off">
              <option value="0">--Không có (Danh mục gốc)</option>

            <?php
                $categoryList = $Category->getParentCategory();
                foreach($categoryList as $row_parentCategory) {
            ?>
              <option value="<?php echo $row_parentCategory['id_category'] ?>"
              >
              <?php echo $row_parentCategory['name_category'] ?> 
              </option>

            <?php }?>

            </select>
            <span class="form-message"></span>
          </div>


        <input class="form-submit" type="submit" value="Lưu" name="submit_insertProduct"></input>
    </form>

</div>

