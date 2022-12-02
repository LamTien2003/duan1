<?php
    include_once('./model/user.classes.php');
    $id_user = Session::getValueSession('user');
    $User = new User();
    
    if(isset($_POST["submit_changeinfo"]) && $_POST["submit_changeinfo"] ) {
        if( (isset($_POST["fullname"]) && $_POST["fullname"]) 
        && (isset($_POST["password"]) && $_POST["password"]) && (isset($_POST["phone"]) && $_POST["phone"])
        && (isset($_POST["email"]) && $_POST["email"]) ) {
            $fullName = $_POST["fullname"];
            $password  = $_POST["password"];
            $phone  = $_POST["phone"];
            $email  = $_POST["email"];
            
            // UPDATE VALUE
            $User->changeInfoUser($fullName,$password,$phone,$address,$email,$id_user);
        }
    }
?>
<?php
    $user = $User->getUserId($id_user);
    foreach($user as $row_user) {
        
?>
<form action="" method="POST" class="form container" id="form-1">
    <div class="spacer"></div>

    <div class="form-group">
        <label for="fullname" class="form-label">Họ và tên: </label>
        <div class="flex-col">
            <input id="fullname" name="fullname" type="text" placeholder="VD: Lâm Tiến" class="form-control"
                value="<?php echo $row_user['user_name'] ?>" autocomplete="off"> 
            <span class="form-message"></span>
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="form-label">Mật khẩu: </label>
        <div class="flex-col">
            <input id="password" name="password" placeholder="123456789" type="password" class="form-control"
                autocomplete="off" value="<?php echo $row_user['user_password'] ?>"> 
            <span class="form-message"></span>
        </div>
    </div>


    <div class="form-group">
        <label for="phone" class="form-label">Địa chỉ: </label>
        <div class="flex-col">
            <input id="address" name="address" type="text" placeholder="VD: 0931462697" class="form-control" autocomplete="off"
                value="<?php echo $row_user['user_address']?>"> 
            <span class="form-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="phone" class="form-label">Số điện thoại: </label>
        <div class="flex-col">
            <input id="phone" name="phone" type="text" placeholder="VD: 0931462697" class="form-control" autocomplete="off"
                value="<?php echo $row_user['user_phone'] ?>"> 
            <span class="form-message"></span>
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="form-label">Email: </label>
        <div class="flex-col">
            <input id="email" name="email" type="text" placeholder="VD: ltt@gmail.com" class="form-control"
                autocomplete="off" value="<?php echo $row_user['user_email'] ?>"> 
            <span class="form-message"></span>
        </div>
    </div>
    <div class="submit">
        <input class="form-submit" type="submit" value="Lưu thay đổi" name="submit_changeinfo"></input>
    </div>
</form>
<?php }?>