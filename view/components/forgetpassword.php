<?php
  include_once('./model/authen.classes.php');
  $Authen = new Authen();
  $message = '';
  $randomCode = rand(000000,999999);
?>

<div class="login">
  <h1 class="lg-title"><i class="fa-solid fa-circle-user"></i></h1>
  <form action="index.php?quanly=verifyEmail" method="POST">
    
    <div class="txt-filed form-group" >
      <input id="username" type="text" placeholder="Nhập tên tài khoản của bạn" class="input form-control" name="username" />
      <label for="username"> <i class="fa-solid fa-user"></i> Username </label>
      <div class="form-message"></div>
    </div>

    <div class="txt-filed form-group" >
      <input id="email" type="email" placeholder="Nhập email đã đăng ký với tài khoản" class="input-pass input form-control" name="email" />
      <label for="email"> <i class="fa-solid fa-key"></i> Email đăng ký: </label>
      <div class="form-message"></div>
    </div>


    <input hidden type="text" class="input form-control" name="randomCode" value= <?php echo $randomCode ?> />
    <input id="checklogin" class="btn-login form-submit" type="submit" name="submit_sendRequest" value="Xác nhận thông tin"></input>
    
  </form>
</div>