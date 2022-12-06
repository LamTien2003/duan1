<?php
    include_once('./model/authen.classes.php');
    $Authen = new Authen();
    if(isset($_POST["submit_register"]) && $_POST["submit_register"] ) {
      if( (isset($_POST["fullname"]) && $_POST["fullname"]) && (isset($_POST["userName"]) && $_POST["userName"])
      && (isset($_POST["password"]) && $_POST["password"]) && (isset($_POST["phone"]) && $_POST["phone"]) 
      && (isset($_POST["email"]) && $_POST["email"]) && (isset($_POST["address"]) && $_POST["address"]) ) {
          $fullName = $_POST["fullname"];
          $userName  = $_POST["userName"];
          $password  = $_POST["password"];
          $phone  = $_POST["phone"];
          $email  = $_POST["email"];
          $address  = $_POST["address"];
          $message = $Authen->register($fullName,$userName,$password,$phone,$address,$email);        
      }
    }
?>
<div class="sign-up-wrapper">
  <div class="sign-up-container">
    <div class="sign-up-title"><i class="fa-solid fa-user-plus"></i> Sign Up</div>
    <p class="message-error"><?php echo (isset($message) && $message) ? $message : '' ?></p>
    <form action="" method="post">
      <div class="user-details">
        <div class="input-box form-group">
          <span class="details">Username</span>
          <input id="user" name="userName" type="text" class="form-control" placeholder="Enter your username" />
          <div class="form-message"></div>
        </div>

        <div class="input-box form-group">
          <span class="details">Password</span>
          <input id="user" name="password" type="text" class="form-control" placeholder="Enter your password" />
          <div class="form-message"></div>
        </div>

        <div class="input-box form-group">
          <span class="details">Fullname</span>
          <input id="user" name="fullname" type="text" class="form-control" placeholder="Enter your fullname" />
          <div class="form-message"></div>
        </div>

        <div class="input-box form-group">
          <span class="details">Phone</span>
          <input id="user" name="phone" type="text" class="form-control" placeholder="Enter your phone" />
          <div class="form-message"></div>
        </div>

        <div class="input-box form-group">
          <span class="details">Email</span>
          <input id="user" name="email" type="text" class="form-control" placeholder="Enter your email" />
          <div class="form-message"></div>
        </div>

        <div class="input-box form-group">
          <span class="details">Address</span>
          <input id="user" name="address" type="text" class="form-control" placeholder="Enter your address" />
          <div class="form-message"></div>
        </div>
      </div>
      <!-- Gender -->
      
        <div class="container-btn-sm">
          <div class="sign-up-btn">
            <input id="register" name='submit_register' type="submit" value="Sign Up">
          </div>
        </div>

</div>