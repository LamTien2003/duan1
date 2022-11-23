<?php
    include_once('./model/detailProduct.classes.php');
    $DetailProduct= new DetailProduct();include_once('./model/detailProduct.classes.php');
    $DetailProduct= new DetailProduct();
    if(isset($_GET['id_sanpham']) && $_GET['id_sanpham']) {
        $id_sanpham = $_GET['id_sanpham'];
    } 
    if(isset($_GET['delete_detailProduct']) && $_GET['delete_detailProduct']) {
        $id_detailProduct = $_GET['delete_detailProduct'];
        $DetailProduct->deleteDetailProduct($id_detailProduct);
    }
?>
<div class="btn-insert">
    <a href="?quanly=admin&action=insertDetailProduct&id_sanpham=<?php echo $id_sanpham ?>" class="btn">Thêm + </a>
</div>
<table>
    <thead>
        <tr>
            <td>ID Sản phẩm</td>
            <td>Giá</td>
            <td>Size</td>
            <td>Số lượng đã bán</td>
            <td>Số lượng tồn kho</td>
            <td>Số lượng còn lại</td>
            <td>Tùy chỉnh</td>
        </tr>
    </thead>

    <tbody>
        <?php
            $detailProductList = $DetailProduct->getDetailProductsByProduct($id_sanpham);
            foreach($detailProductList as $row_detail) {
        ?>
        <tr>
            <td><?php echo $row_detail['id_detailProduct'] ?></td>
            <td><?php echo $row_detail['detail_price'] ?></td>
            <td><?php echo $row_detail['detail_size'] ?></td>
            <td><?php echo $row_detail['sold'] ?></td>
            <td><?php echo $row_detail['inventory'] ?></td>
            <td><?php echo $row_detail['inventory'] - $row_detail['sold'] ?></td>
            <td>
                <a href="?quanly=admin&action=changeDetailProduct&id_chitietSP=<?php echo $row_detail['id_detailProduct'] ?>" class="status pending">Sửa</a>
                <a href="?quanly=admin&action=detailProduct&id_sanpham=<?php echo $id_sanpham ?>&delete_detailProduct=<?php echo $row_detail['id_detailProduct'] ?>" class="status return">Xóa</a>
            </td>
        </tr>

        <?php }?>
    </tbody>
</table>