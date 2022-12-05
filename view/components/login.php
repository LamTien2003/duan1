<?php
  include_once('./model/authen.classes.php');
  $Authen = new Authen();
  if(isset($_POST["submit_login"]) && $_POST["submit_login"] ) {
    if( (isset($_POST["username"]) && $_POST["username"]) && (isset($_POST["password"]) && $_POST["password"]) ) {
        $userName  = $_POST["username"];
        $password  = $_POST["password"];
        $Authen->login($userName,$password);
    }
  }
  if(isset($_GET["delete_userSession"])) {
    Session::unsetSession('user');
    header("Location: index.php");
}

?>
<div class="login">
  <h1 class="lg-title"><i class="fa-solid fa-circle-user"></i></h1>
  <form action="" method="POST">
    <div class="txt-filed form-group" >
      <input id="username" type="text" class="input form-control" name="username" />
      <label for="username"> <i class="fa-solid fa-user"></i> Username </label>
      <div class="form-message"></div>
    </div>
    <div class="txt-filed form-group" >
      <input id="password" type="password" class="input-pass input form-control" name="password" />
      <label for="password"> <i class="fa-solid fa-key"></i> Password </label>
      <i class="eye eye-close fa-regular fa-eye-slash"></i>
      <i class="eye eye-open hidden fa-regular fa-eye"></i>
      <div class="form-message"></div>
    </div>
    <div class="link-pass">
      <a href="index.php?quanly=forgetPassword">
        <div class="pass">Quên mật khẩu ?</div>
      </a>
    </div>

    <input id="checklogin" class="btn-login form-submit" type="submit" name="submit_login" value="Login"></input>
    <div class="signup-link">
      Bạn chưa có tài khoản
      <a href="index.php?quanly=register">Đăng ký</a>
    </div>
  </form>
</div>