<?php
session_start();
$pagetitle="USRA-WEB &middot; Login"; // used in include/head.php
require 'include/_dbcon.php';
require 'include/_header.php';
require 'include/_alert.php';

// initialize error message
$errormsg="&nbsp;";

// if submit is sent, process login, else, show login page
if (isset($_REQUEST['submit'])) {

  // get data from input boxes
  $username = $_REQUEST['login_username'];
  $password = md5($_REQUEST['login_password']);

  // authenticate username and password
  $sql = mysqli_prepare($con, "SELECT * FROM student WHERE email=? AND password=?");
  mysqli_stmt_bind_param($sql, "ss", $username, $password);
  mysqli_stmt_execute($sql);
  mysqli_stmt_store_result($sql);
  $avail = mysqli_stmt_num_rows($sql);

  // if authentication succeed, process login, else, set error message
  if ($avail == 1) {
    $sql="SELECT * FROM student WHERE email = '$username'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    // set common variable
    $_SESSION['user_id'] = $row['student_id'];
    $_SESSION['user_email'] = $row['email'];
    $_SESSION['user_registerdate'] = substr($row['register_dt'], 0, 10);
    if ($row['avatar']==NULL) {
      $_SESSION['user_avatar']="system/avatar.jpg";
    } else {
      $_SESSION['user_avatar']="avatar/" . $row['avatar'];
    }
    $_SESSION['login_status'] = 1;

    // set alert variable
    $_SESSION['alert_status']=1;
    $_SESSION['alert_type']="success";
    $_SESSION['alert_strong']="SUCCESS";
    $_SESSION['alert_text']="Welcome ".$_SESSION['user_email'];

    // clear off and send user to dashboard page
    mysqli_free_result($result);
    mysqli_close($con);
    echo "<script>location.href='index.php'</script>";
    die();

  // authentication falied, set error message
  } else {
    $errormsg="Wrong username/password combination";
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
            <h6 class="text-white pb-3 ls1">Enter your login credentials or <a href="register.php"><b class="text-info">REGISTER</b></a></h6>
          </div>
          <form class="js-validation-signin center" action="" method="POST">
            <div class="form-group row justify-content-center mb-0">
              <div class="col-md-8 col-sm-12">
                <div class="form-group">
                  <input type="email" class="form-control text-center" id="login-username" name="login_username" placeholder="Email" required autofocus>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control text-center" id="login-password" name="login_password" placeholder="Password" required>
                </div>
                <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-block btn-primary">
                    Login <i class="fa fa-fw fa-sign-in-alt mr-1"></i>
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
