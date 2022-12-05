<?php
  include_once('./model/authen.classes.php');
  $Authen = new Authen();
  $message = '';
  $randomCode = '';
  $id_user = '';
  if(isset($_POST["submit_sendRequest"]) && $_POST["submit_sendRequest"] ) {
    if( (isset($_POST["username"]) && $_POST["username"]) && (isset($_POST["email"]) && $_POST["email"]) ) {
        $randomCode = $_POST["randomCode"];
        $userName  = $_POST["username"];
        $email  = $_POST["email"];
        $id_user = $Authen->sendRequest($userName,$email,$randomCode);
    }
  }


?>

<div class="login">
  <h1 class="lg-title"><i class="fa-solid fa-circle-user"></i></h1>
  <form action="index.php?quanly=changeNewPassWord" method="POST">
    <h2><?php echo $message ?></h2>
    <div class="txt-filed form-group" >
      <input id="code" type="text" placeholder="Nhập tên tài khoản của bạn" class="input form-control" name="code" />
      <label for="code"> <i class="fa-solid fa-user"></i> Nhập mã xác nhận </label>
      <div class="form-message"></div>
    </div>


    <input hidden type="text" class="input form-control" name="id_user" value= <?php echo $id_user ?> />
    <input hidden type="text" class="input form-control" name="verifyCode" value= <?php echo $randomCode ?> />
    <input id="checklogin" class="btn-login form-submit" type="submit" name="submit_verify" value="Xác nhận thông tin"></input>
    
  </form>
</div>