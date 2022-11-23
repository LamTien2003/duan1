
<?php
    include_once('./model/user.classes.php');
    $User = new User();
    if(isset($_GET['id_user']) && $_GET['id_user']) {
      $id_user = $_GET['id_user'];
    }
    if(isset($_POST["submit_changeUser"]) && $_POST["submit_changeUser"] ) {
        if( (isset($_POST["fullname"]) && $_POST["fullname"]) && (isset($_POST["userName"]) && $_POST["userName"])
        && (isset($_POST["password"]) && $_POST["password"])&& (isset($_POST["phone"]) && $_POST["phone"])
        && (isset($_POST["email"]) && $_POST["email"]) && (isset($_POST["address"]) && $_POST["address"]) ) {
            $fullName = $_POST["fullname"];
            $userName  = $_POST["userName"];
            $password  = $_POST["password"];
            $phone  = $_POST["phone"];
            $address = $_POST['address'];
            $email  = $_POST["email"];
            $role  = $_POST["role"];
            
            // UPDATE VALUE
            $User->updateUser($fullName,$userName,$password,$phone,$address,$email,$role,$id_user);
        }
    }
?>
<?php
    $user = $User->getUserId($id_user);
    foreach($user as $row_user) {
?>

<div class="form">
    <form action="" method="POST" class="form container" id="form-1">
        <h3 class="heading">Thông tin người dùng</h3>
        <div class="spacer"></div>

        <div class="form-group">
            <label for="fullname" class="form-label">Họ và tên</label>
            <input id="fullname" name="fullname" type="text" placeholder="VD: Lâm Tiến" class="form-control"
                autocomplete="off" value = "<?php echo $row_user['user_name'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="userName" class="form-label">Tên đăng nhập: </label>
            <input id="userName" name="userName" type="text" placeholder="VD: tienltps24556" class="form-control"
                autocomplete="off" value = "<?php echo $row_user['accountName_user'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Mật khẩu:</label>
            <input id="password" name="password" placeholder="123456789" type="password" class="form-control"
                autocomplete="off" value = "<?php echo $row_user['user_password'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input id="phone" name="phone" type="text" placeholder="VD: 0931462697" class="form-control"
                autocomplete="off" value = "<?php echo $row_user['user_phone'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="address" class="form-label">Địa chỉ</label>
            <input id="address" name="address" type="text" placeholder="VD: 0931462697" class="form-control"
                autocomplete="off" value = "<?php echo $row_user['user_address'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="text" placeholder="VD: ltt@gmail.com" class="form-control"
                autocomplete="off" value = "<?php echo $row_user['user_email'] ?>">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role"  class="form-control" autocomplete="off">
              <option value="">--Chọn Danh mục</option>
              <option value="0" <?php echo $row_user['user_role'] == 0 ? 'selected': '' ?>>0 - User</option>
              <option value="1" <?php echo $row_user['user_role'] == 1 ? 'selected': '' ?>>1 - Admin</option>
            </select>
            <span class="form-message"></span>
        </div>


        <input class="form-submit" type="submit" value="Lưu" name="submit_changeUser"></input>
    </form>

</div>
<?php } ?>
