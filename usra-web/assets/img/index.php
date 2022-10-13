<?php 
// unauthorize access will be sent to root index.php
session_start();
echo "<script>location.href='../index.php'</script>"; die();
?>