<?php
    include_once('./model/bill.classes.php');
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    }else {
        $page = 1;
    }

    $Bill = new Bill();
    if(isset($_GET['delete_giohang']) && $_GET['delete_giohang']) {
        $id_giohang = $_GET['delete_giohang'];
        $Bill->deleteBill($id_giohang);
    }

    if(isset($_GET['updateStatus'])) {
        $id_bill_update = $_GET['updateStatus'];
        $Bill->updateStatusBill($id_bill_update,1);
    }
?>
<div class="search-box">
    <i class="fa-solid fa-magnifying-glass"></i>
    <input type="text" name="search" id="search-bill" placeholder="Nhập Tên,Địa chỉ hoặc ID đơn hàng để tìm kiếm"/>
</div>

<table>
    <thead>
        <tr>
            <td>ID đơn hàng</td>
            <td>ID User</td>
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

    <tbody id="result">
        <?php
            $billPerPage = 5;
            $countBills = $Bill->getCountBills();
            $countPage = ceil($countBills / $billPerPage);
            $start = ($page -1) * $billPerPage;
            $billList = $Bill->getBillsWithUserLimit($start,$billPerPage);
            foreach($billList as $row_bill) {
        ?>
        <tr>
            <td><?php echo $row_bill['id_bill'] ?></td>
            <td><?php echo $row_bill['id_user'] ?></td>
            <td><?php echo $row_bill['delivery_address'] ?></td>
            <td><?php echo $row_bill['receiver_phone'] ?></td>
            <td><?php echo $row_bill['receiver_name'] ?></td>
            <td><?php echo $row_bill['payment_method'] == '0' ? 'COD' : 'ATM' ?></td>
            <td><?php echo $row_bill['point_used'] ?></td>
            <td><?php echo $row_bill['total_pay'] ?></td>
            <td><?php 
                    if($row_bill['status'] == 0) {
                        echo "Chờ xác nhận";
                    }else if($row_bill['status'] == 1) {
                        echo "Đang giao";
                    }else {
                        echo "Đã giao";
                    }
                ?>
            </td>
            <td>
                <a href="?quanly=admin&action=detailCart&id_giohang=<?php echo $row_bill['id_bill'] ?>" class="status delivered">Xem chi tiết</a>
                <?php 
                $id_bill = $row_bill['id_bill'];
                echo $row_bill['status'] == 0 ?
                 "<a href='?quanly=admin&action=manageCart&updateStatus=$id_bill'class='status inProgress'>Duyệt</a>"
                 : '' ?>
                <a href="?quanly=admin&action=changeCart&id_giohang=<?php echo $row_bill['id_bill'] ?>" class="status pending">Sửa</a>
                <a href="?quanly=admin&action=manageCart&delete_giohang=<?php echo $row_bill['id_bill'] ?>" class="status return">Xóa</a>
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
                    onchange="fetchAjax('searchBill')"
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