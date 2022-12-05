<?php
    include_once('./model/bill.classes.php');
    include_once('./model/detailBill.classes.php');
    include_once('./model/user.classes.php');
    $id_user = Session::getValueSession('user');
    $Bill = new Bill();
    $DetailBill = new DetailBill();
    $User = new User();

    if(isset($_POST['submit_done'])) {
        $id_bill = $_POST['id_bill'];
        $pointForUser = $_POST['pointForUser'];
        $Bill->updateStatusBill($id_bill,2);
        $User->addPointUser($pointForUser,$id_user);
    }

    $listBill = $Bill->getBillOfUser($id_user);
    foreach($listBill as $row_bill) {
        $id_bill = $row_bill['id_bill'];
?>
<form action="" method="POST" class="order">
    <div class="user">
        <div class="user-info">
            <p class="address"><?php echo $row_bill['delivery_address'] ?></p>
            <p class="phone"><?php echo $row_bill['receiver_phone'] ?></p>
        </div>
        <p class="status">
        <?php 
            if($row_bill['status'] == 0) {
                echo "Chờ xác nhận";
            }else if($row_bill['status'] == 1) {
                echo "Đang giao hàng";
            }else {
                echo "Đã giao hàng";
            }
        ?>
         </p>
    </div>

    <?php
        $listDetail = $DetailBill->getDetailBillsByBill($id_bill);
        foreach($listDetail as $row_detail) {

    ?>
            <div class="product">
                <div class="product-info">
                    <img src="<?php echo $row_detail['product_img'] ?>" alt="">
                    <div class="product-details">

                        <h4 class="product-details_title"><?php echo $row_detail['product_name'] ?></h4>
                        <div class="product-details-divide">
                            <p class="product-details_subtitle">Phân loại hàng: <?php echo $row_detail['size_detail'] ?></p>
                            <p class="product-details_price">Giá sản phẩm: <?php echo $row_detail['product_price'] ?></p>
                            <p class="product-details_count">Số lượng: <?php echo $row_detail['amount_detail'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="price">
                    <?php echo number_format($row_detail['product_price'] * $row_detail['amount_detail'], 0, '', '.') ?> đ
                </div>
            </div>

    <?php
                }
    ?>
    <div class="total">
        <div class="total-info">
            <p class="total-money">Tổng tiền sản phẩm: <?php echo number_format($row_bill['total_money'], 0, '', '.') ?> đ</p>
            <p class="total-ship">Phí vận chuyển: 30.000 đ</p>
            <p class="total-point">Giảm giá từ điểm thưởng: <?php echo number_format($row_bill['point_used'], 0, '', '.') ?> đ</p>
            <p class="total-pay">Tổng tiền phải trả: <?php echo number_format($row_bill['total_pay'], 0, '', '.') ?> đ</p>
        </div>
        <?php 
            echo $row_bill['status'] == 1 ? 
                '<div class="total-submit">
                    <input type="submit" name="submit_done" value="Đã nhận được hàng"></input>
                </div>' 
            : '' 
        ?>
    </div>
    <input type="text" hidden name="id_bill" value="<?php echo $row_bill['id_bill'] ?>">
    <input type="text" hidden name="pointForUser" value="<?php echo $row_bill['total_pay'] * 5 / 100 ?>">
</form>

<?php }   ?>
