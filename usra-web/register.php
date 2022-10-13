<?php
session_start();
$pagetitle="USRA-WEB &middot; Account Registration"; // used in include/head.php
require 'include/_dbcon.php';
require 'include/_header.php';
require 'include/_alert.php';

// initialize error message
$errormsg="&nbsp;";

// if submit is sent, validate input then process registration, else, show registration page
if (isset($_REQUEST['submit'])) {

    // acquire and massage user input
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $username = test_input($_REQUEST['login_username']);
    $password = test_input($_REQUEST['login_password']);
    $pwordcheck = test_input($_REQUEST['login_password_check']);

  // validate password
  if($password===$pwordcheck) {
    if (strlen($password) < 8) {
      $errormsg = "Your password must contain at least 8 characters";
    } elseif(!preg_match("#[0-9]+#",$password)) {
      $errormsg = "Your password must contain at least 1 number";
    } elseif(!preg_match("#[A-Z]+#",$password)) {
      $errormsg = "Your password must contain at least 1 capital letter";
    } elseif(!preg_match("#[a-z]+#",$password)) {
      $errormsg = "Your password must contain at least 1 lowercase letter";
    } else {

      // validate username uniqueness
      $sql=mysqli_prepare($con, "SELECT * FROM student WHERE email=?");
      mysqli_stmt_bind_param($sql, "s", $username);
      mysqli_stmt_execute($sql);
      mysqli_stmt_store_result($sql);
      $avail = mysqli_stmt_num_rows($sql);

      // if authentication succeed, process login, else, set error message
      if ($avail == 1) {
        $errormsg = "Your email has already been registered";
      } else {

        // register user
        $password = md5($password);
        $sql = "INSERT INTO student (email, password, register_dt) VALUES ('$username','$password', SYSDATE())";
        if (mysqli_query($con,$sql)) {

          // prepare alert
          $_SESSION['alert_status']=1;
          $_SESSION['alert_type']="success";
          $_SESSION['alert_strong']="SUCCESS";
          $_SESSION['alert_text']="Your account has successfully been created. You can now login to update your profile.";

          // clear off and send user to login page
          mysqli_close($con);
          echo "<script>location.href='index.php'</script>";
          die();

        // user registration failed
        } else {
          $errormsg = "Database error";
        }
      }
    }
  } else {
      $errormsg = "Your password does not match";
  }
}
?>

<!-- Login Page -->
<div class="hero-static d-flex align-items-center bg-image">
  <div class="w-100">
    <div class="content content-full pb-0">
      <div class="row justify-content-center">
        <div class="col-md-7 col-lg-7 col-xl-5 col-sm-9 col-xs-9">
          <div class="text-center">
            <img src="assets/img/system/logo.png" width="33%">
            <h4 class="text-gray mb-1">Uniutama Student Registration Application<br>(Web Platform)</h4>
            <br>
            <h6 class="text-white pb-3 ls1">Fill in your registration details or <a href="login.php"><b class="text-info">LOGIN</b></a></h6>
          </div>
          <form class="js-validation-signin center" action="" method="POST">
            <div class="form-group row justify-content-center mb-0">
              <div class="col-md-8 col-sm-12">
                <div class="form-group">
                  <input type="email" class="form-control text-center" id="login-username" name="login_username" placeholder="Email Address" required autofocus>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control text-center" id="login-password" name="login_password" placeholder="Password" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control text-center" id="login-password_check" name="login_password_check" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-block btn-success">
                    Register
                  </button>
                  <h6 class="help-block text-errormessage text-center pt-3"><?=$errormsg?></h6>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="font-size-sm text-center text-muted pb-3">
        <small>USRA-WEB | Homework for Uniutama Interview Session | Khairil Azri bin Azlan</small>
      </div>
    </div>
  </div>
</div>

<script src="assets/js/oneui.core.min.js"></script>
<script src="assets/js/oneui.app.min.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
