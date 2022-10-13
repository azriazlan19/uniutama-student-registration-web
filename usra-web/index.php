<?php
session_start();

// not yet login, show login page
if(!isset($_SESSION['login_status']) or $_SESSION['login_status']==0) {
  echo "<script>location.href='login.php'</script>"; die();

// already logged in, show dashboard
} else {
  echo "<script>location.href='dashboard.php'</script>"; die();
}

?>
