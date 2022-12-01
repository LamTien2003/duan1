<?php
    include_once('./model/authen.classes.php');
    $Authen = new Authen();
    if(isset($_POST["submit_register"]) && $_POST["submit_register"] ) {
      if( (isset($_POST["fullname"]) && $_POST["fullname"]) && (isset($_POST["username"]) && $_POST["username"])
      && (isset($_POST["password"]) && $_POST["password"]) && (isset($_POST["phone"]) && $_POST["phone"]) 
      && (isset($_POST["email"]) && $_POST["email"]) && (isset($_POST["address"]) && $_POST["address"]) ) {
          $fullName = $_POST["fullname"];
          $userName  = $_POST["username"];
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
        <div class="input-box">
          <span class="details">Username</span>
          <input id="user" name="username" type="text" placeholder="Enter your username" required />
        </div>
        <div class="input-box">
          <span class="details">Password</span>
          <i class="eye eye-close fa-regular fa-eye-slash"></i>
          <i class="eye  eye-open hidden  fa-regular fa-eye"></i>
          <input id="pass" name="password" class="input-pass" type="password" placeholder="Enter your password" required />
        </div>
        <div class="input-box">
          <span class="details">Full Name</span>
          <input id="name" name="fullname" type="text" placeholder="Enter your name" required />
        </div>
        <div class="input-box">
          <span class="details">Email</span>
          <input id="email" name="email" type="email" placeholder="Enter your email" required />
        </div>
        <div class="input-box">
          <span class="details">Phone Number</span>
          <input id="tel" name="phone" type="text" placeholder="Enter your number" required />
        </div>
        <div class="input-box">
          <span class="details">Address</span>

          <input id="address" name="address" class="input" type="text" placeholder="Enter your address" required />
        </div>
      </div>
      <!-- Gender -->
      
        <div class="container-btn-sm">
          <div class="sign-up-btn">
            <input id="register" name='submit_register' type="submit" value="Sign Up">
          </div>
        </div>

</div>