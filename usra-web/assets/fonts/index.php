<?php 
// ************************************************************************************************************************************
// NOTE FOR AIUCAMSYS DEVELOPERS:
// prevent unauthorize access, send them back to root index.php
// ************************************************************************************************************************************
session_start();
echo "<script>location.href='../index.php'</script>"; die();
?>