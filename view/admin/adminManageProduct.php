<?php
    include_once('./model/product.classes.php');
    $Product = new Product();
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    }else {
        $page = 1;
    }
    if(isset($_GET['delete_sanpham']) && $_GET['delete_sanpham']) {
        $id_sanpham = $_GET['delete_sanpham'];
        $Product->deleteProduct($id_sanpham);
    }
?>
<div class="btn-insert">
    <a href="?quanly=admin&action=insertProduct" class="btn">Thêm + </a>
</div>
<table>
    <thead>
        <tr>
            <td>ID Sản phẩm</td>
            <td>Image</td>
            <td>Tên</td>
            <td>Hot</td>
            <td>ID Danh mục</td>
            <td>Tùy chỉnh</td>
        </tr>
    </thead>

    <tbody>
        <?php
            $productPerPage = 10;
            $countProducts = $Product->getCountProducts();
            $countPage = ceil($countProducts / $productPerPage);
            $start = ($page -1) * $productPerPage;
            $productList = $Product->getProductsLimit($start,$productPerPage);
            foreach( $productList as $row_sanpham ) {
        ?>
        <tr>
            <td><?php echo $row_sanpham['id_product'] ?></td>
            <td style="width: 10%;">
                <img src="<?php echo $row_sanpham['img_product'] ?>" width="100%" height="120" style="object-fit:cover;">
            </td>
            <td><?php echo $row_sanpham['title_product'] ?></td>
            <td><?php echo $row_sanpham['hot_product'] ?></td>
            <td><?php echo $row_sanpham['id_category'] ?></td>
            <td>
                <a href="?quanly=admin&action=detailProduct&id_sanpham=<?php echo $row_sanpham['id_product'] ?>" class="status delivered">Xem chi tiết</a>
                <a href="?quanly=admin&action=changeProduct&id_sanpham=<?php echo $row_sanpham['id_product'] ?>" class="status pending">Sửa</a>
                <a href="?quanly=admin&action=manageProduct&delete_sanpham=<?php echo $row_sanpham['id_product'] ?>" class="status return">Xóa</a>
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
            <a href="?quanly=admin&action=manageProduct&page=<?php echo $i ?>" 
                <?php echo $i == $page ? 'class="active"': '' ?>
            >
                <?php echo $i ?>
            </a>
    <?php  
            $i++;
        }
    ?>
</div>