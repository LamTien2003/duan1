<?php
  include_once('./model/category.classes.php');
  $Category = new Category();
    if(isset($_GET['id_danhmuc']) && $_GET['id_danhmuc']) {
        $id_danhmuc = $_GET['id_danhmuc'];
    }
    if(isset($_POST["submit_changeCategory"]) && $_POST["submit_changeCategory"] ) {
        if( (isset($_POST["fullname"]) && $_POST["fullname"]) && (isset($_POST["order"]) && $_POST["order"])
        && (isset($_FILES) && $_FILES) && (isset($_POST["category"]) && ($_POST["category"] || $_POST["category"] == 0)) ) {
            $fullName = $_POST["fullname"];
            $image = $_FILES['image'];
            $category  = $_POST["category"];
            $order = $_POST['order'];
            // UPDATE VALUE
            $Category->updateCategory($id_danhmuc,$image,$fullName,$order,$category);
        }
    }
?>

<?php
    $category = $Category->getCategoryId($id_danhmuc);
    foreach($category as $row_category) {
?>
<div class="form">
    <form action="" method="POST" class="form container" id="form-1" enctype="multipart/form-data">
        <h3 class="heading">Thông tin Danh mục</h3>
        <div class="spacer"></div>

        <div class="form-group">
            <label for="fullname" class="form-label">Tên</label>
            <input id="fullname" name="fullname" type="text" placeholder="VD: Lâm Tiến" class="form-control"
                autocomplete="off" value = "<?php echo $row_category['name_category'] ?>">
            <span class="form-message"></span>
        </div>


        <div class="form-group">
            <label for="image" class="form-label">Image:</label>
            <input id="image" name="image" type="file" placeholder="VD: 0931462697" class="form-control"
                autocomplete="off" value = "<?php echo $row_category['img_category'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="order" class="form-label">Vị trí ưu tiên: </label>
            <input id="order" name="order" type="text" placeholder="VD: Lâm Tiến" class="form-control"
                autocomplete="off" value = "<?php echo $row_category['order'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="category" class="form-label">Danh mục cha</label>
            <select id="category" name="category"  class="form-control alo" autocomplete="off">
              <option value="0">--Không có (Danh mục gốc)</option>

            <?php
                $parentCategory = $Category->getParentCategory();
                foreach($parentCategory as $row_parentCategory) {
            ?>
            <option value="<?php echo $row_parentCategory['id_category'] ?>"
                    <?php echo $row_parentCategory['id_category'] == $row_category['parent_id'] ? 'selected': '' ?>
            >
                <?php echo $row_parentCategory['name_category'] ?> 
            </option>
            <?php }?>

            </select>
            <span class="form-message"></span>
          </div>


        <input class="form-submit" type="submit" value="Lưu" name="submit_changeCategory"></input>
    </form>
<?php } ?>
</div>
