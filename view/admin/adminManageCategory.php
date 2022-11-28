<?php
    include_once('./model/category.classes.php');
    $Category = new Category();
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    }else {
        $page = 1;
    }
    if(isset($_GET['delete_danhmuc']) && $_GET['delete_danhmuc']) {
        $id_danhmuc = $_GET['delete_danhmuc'];
        $Category->deleteCategory($id_danhmuc);
    }
?>
<div class="btn-insert">
    <a href="?quanly=admin&action=insertCategory" class="btn">Thêm + </a>
</div>
<div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" name="search" id="search-category" placeholder="Nhập tên hoặc ID Danh mục để tìm kiếm"/>
</div>
<table>
    <thead>
        <tr>
            <td>ID Danh mục</td>
            <td>Image</td>
            <td>Tên</td>
            <td>Vị trí</td>
            <td>Danh mục cha</td>
            <td>Tùy chỉnh</td>
        </tr>
    </thead>

    <tbody id="result">
        <?php
            $CategoryPerPage = 5;
            $countCategorys = $Category->getCountCategory();
            $countPage = ceil($countCategorys / $CategoryPerPage);
            $start = ($page -1) * $CategoryPerPage;
            $categoryList = $Category->getCategorysLimit($start,$CategoryPerPage);
            foreach($categoryList as $row_category ) {
        ?>
        <tr>
            <td><?php echo  $row_category['id_category'] ?></td>
            <td style="width: 10%;">
                <img src="<?php echo  $row_category['img_category'] ?>" width="100%" height="120" style="object-fit:cover;">
            </td>
            <td><?php echo  $row_category['name_category'] ?></td>
            <td><?php echo  $row_category['order'] ?></td>
            <td><?php echo  $row_category['parent_id'] ?></td>
            <td>
                <a href="?quanly=admin&action=changeCategory&id_danhmuc=<?php echo  $row_category['id_category'] ?>" class="status pending">Sửa</a>
                <a href="?quanly=admin&action=manageCategory&delete_danhmuc=<?php echo  $row_category['id_category'] ?>" class="status return">Xóa</a>
            </td>
        </tr>

        <?php }?>   
    </tbody>
    
</table>
<div class="pagination">
    <?php
            $i = 1;
            while($i <= $countPage) {
    ?>
            <div class="item">
                <input
                    value="<?php echo $i ?>" 
                    onchange="fetchAjax('searchCategory')"
                    type="radio" 
                    name="nav" 
                    id="input-<?php echo $i ?>" 
                    class="input-page" <?php echo $i == $page ? 'checked': '' ?>
                />
                <label for="input-<?php echo $i ?>" class="button button-<?php echo $i ?>"> <?php echo $i ?></label>
            </div>
    <?php  
            $i++;
        }
    ?>
</div>