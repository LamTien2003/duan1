<?php
  include_once('./model/authen.classes.php');
  include_once('./model/user.classes.php');
  $Authen = new Authen();
  $User = new User();
  $randomCode = '';
  $id_user = '';

  if(isset($_POST["submit_verify"]) && $_POST["submit_verify"] ) {
    if( (isset($_POST["code"]) && $_POST["code"]) ) {
        $id_user = $_POST["id_user"];
        $code = $_POST["code"];
        $verifyCode = $_POST['verifyCode'];
        $Authen->verifyEmail($code,$verifyCode,$id_user);
    }
  }
  if(isset($_POST['submit_changeNewPassword']) && $_POST['submit_changeNewPassword']) {
    $id_user = $_POST['id_user'];
    $password = $_POST['password'];
    $User->changePasswordUser($password,$id_user);
  }
?>

<div class="login">
  <h1 class="lg-title"><i class="fa-solid fa-circle-user"></i></h1>
  <form action="" method="POST">

    <div class="txt-filed form-group" >
      <input id="password" type="text" placeholder="Nhập tên tài khoản của bạn" class="input form-control" name="password" />
      <label for="password"> <i class="fa-solid fa-user"></i> Nhập mật khẩu </label>
      <div class="form-message"></div>
    </div>

    <div class="txt-filed form-group" >
      <input id="passwordAgain" type="text" placeholder="Nhập tên tài khoản của bạn" class="input form-control" name="passwordAgain" />
      <label for="passwordAgain"> <i class="fa-solid fa-user"></i> Nhập lại mật khẩu </label>
      <div class="form-message"></div>
    </div>


    <input hidden type="text" class="input form-control" name="id_user" value= <?php echo $id_user ?> />
    <input id="checklogin" class="btn-login form-submit" type="submit" name="submit_changeNewPassword" value="Xác nhận thông tin"></input>
    
  </form>
</div>