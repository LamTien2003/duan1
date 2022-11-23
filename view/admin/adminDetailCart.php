<?php
    include_once('./model/detailBill.classes.php');
    $DetailBill = new DetailBill();
    if(isset($_GET['id_giohang']) && $_GET['id_giohang']) {
        $id_giohang = $_GET['id_giohang'];
    }
?>
<table>
    <thead>
        <tr>
            <td>Tên</td>
            <td>Số lượng</td>
            <td>Size</td>
            <td>Đơn giá</td>
            <td>Tổng giá</td>
            <td>Tùy chỉnh</td>
        </tr>
    </thead>

    <tbody>
        <?php
            $detailBillList = $DetailBill->getDetailBillsByBill($id_giohang);
            foreach($detailBillList as $row_detailBill) {
        ?>
        <tr>
            <td><?php echo $row_detailBill['product_name'] ?></td>
            <td><?php echo $row_detailBill['amount_detail'] ?></td>
            <td><?php echo $row_detailBill['size_detail'] ?></td>
            <td><?php echo $row_detailBill['product_price'] ?></td>
            <td><?php echo $row_detailBill['product_price'] * $row_detailBill['amount_detail'] ?></td>
            <td>
                <span class="status pending">Sửa</span>
                <span class="status return">Xóa</span>
            </td>
        </tr>

        <?php }?>
    </tbody>
</table>