<?php
    include_once('./model/Bill.classes.php');
    $Bill = new Bill();
    if(isset($_GET['delete_giohang']) && $_GET['delete_giohang']) {
        $id_giohang = $_GET['delete_giohang'];
        $Bill->deleteBill($id_giohang);
    }
?>
<table>
    <thead>
        <tr>
            <td>ID đơn hàng</td>
            <td>ID User</td>
            <td>Gmail</td>
            <td>Địa chỉ giao hàng</td>
            <td>SĐT nhận hàng</td>
            <td>Tên người nhận</td>
            <td>Phương thức thanh toán</td>
            <td>Điểm tích lũy sử dụng</td>
            <td>Tổng tiền phải trả</td>
            <td>Trạng thái</td>
            <td>Tùy chỉnh</td>
        </tr>
    </thead>

    <tbody>
        <?php
            $bill = $Bill->getBillsByUser();
            foreach($bill as $row_bill) {
        ?>
        <tr>
            <td><?php echo $row_bill['id_bill'] ?></td>
            <td><?php echo $row_bill['id_user'] ?></td>
            <td><?php echo $row_bill['user_email'] ?></td>
            <td><?php echo $row_bill['delivery_address'] ?></td>
            <td><?php echo $row_bill['receiver_phone'] ?></td>
            <td><?php echo $row_bill['receiver_name'] ?></td>
            <td><?php echo $row_bill['payment_method'] ?></td>
            <td><?php echo $row_bill['point_used'] ?></td>
            <td><?php echo $row_bill['total_pay'] ?></td>
            <td><?php echo $row_bill['status']?></td>
            <td><a href="?quanly=admin&action=detailCart&id_giohang=<?php echo $row_bill['id_bill'] ?>" class="status delivered">Xem chi tiết</a>
                <a href="?quanly=admin&action=changeCart&id_giohang=<?php echo $row_bill['id_bill'] ?>" class="status pending">Sửa</a>
                <a href="?quanly=admin&action=manageCart&delete_giohang=<?php echo $row_bill['id_bill'] ?>" class="status return">Xóa</a>
            </td>
        </tr>

        <?php }?>
    </tbody>
</table>