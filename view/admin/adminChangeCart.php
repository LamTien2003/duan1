
<?php
    include_once('./model/Bill.classes.php');
    $Bill = new Bill();
    if(isset($_GET['id_giohang']) && $_GET['id_giohang']) {
      $id_giohang = $_GET['id_giohang'];
    }
    if(isset($_POST["submit_changeCart"]) && $_POST["submit_changeCart"] ) {
        if( (isset($_POST["address"]) && $_POST["address"]) && (isset($_POST["phone"]) && $_POST["phone"])
        && (isset($_POST["status"]) && $_POST["status"]) && (isset($_POST["fullname"]) && $_POST["fullname"]) ) {
            $fullname = $_POST['fullname'];
            $address = $_POST["address"];
            $phone  = $_POST["phone"];
            $status  = $_POST["status"];
            $Bill->updateBill($address,$phone,$fullname,$status,$id_giohang);
        }
    }
?>
<?php
    $bill = $Bill->getBillById($id_giohang);
    foreach($bill as $row_bill) {
?>

<div class="form">
    <form action="" method="POST" class="form container" id="form-1">
        <h3 class="heading">Thông tin người dùng</h3>
        <div class="spacer"></div>

        <div class="form-group">
            <label for="fullname" class="form-label">Tên người nhận </label>
            <input id="fullname" name="fullname" type="text" placeholder="VD: tienltps24556" class="form-control"
                autocomplete="off" value = "<?php echo $row_bill['receiver_name'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="address" class="form-label">Địa chỉ liên hệ </label>
            <input id="address" name="address" type="text" placeholder="VD: tienltps24556" class="form-control"
                autocomplete="off" value = "<?php echo $row_bill['delivery_address'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input id="phone" name="phone" type="text" placeholder="VD: 0931462697" class="form-control"
                autocomplete="off" value = "<?php echo $row_bill['receiver_phone'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="status" class="form-label">Trạng thái</label>
            <select id="status" name="status"  class="form-control alo" autocomplete="off">
              <option value="">--Chọn Trạng thái</option>
              <option value="0" <?php echo $row_bill['status'] == 0 ? "selected": '' ?>> Chờ duyệt</option>
              <option value="1" <?php echo $row_bill['status'] == 1 ? "selected": '' ?>> Đang vận chuyển</option>
              <option value="2" <?php echo $row_bill['status'] == 2 ? "selected": '' ?>> Đã giao</option>
            </select>
            <span class="form-message"></span>
        </div>


        <input class="form-submit" type="submit" value="Lưu" name="submit_changeCart"></input>
    </form>

</div>
<?php } ?>
