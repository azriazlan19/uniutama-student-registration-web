<?php

// check login status
if (!isset($_SESSION['login_status']) or $_SESSION['login_status']==0) {
  echo "<script>location.href='logout.php'</script>"; die();
}

// get overall page list
$sql="SELECT * FROM page";
if ($result=mysqli_query($con,$sql)) {
  $i=0; $page_count=0;
  while ($row=mysqli_fetch_assoc($result)) {
    $listpage_id[$i]=$row['page_id'];
    $listpage_name[$i]=$row['page_name'];
    $listpage_title[$i]=$row['page_title'];
    $listpage_caption[$i]=$row['page_caption'];
    $listpage_icon[$i]=$row['page_icon'];
    $i++;
  }
  mysqli_free_result($result);
  $page_count=count($listpage_id);
}

// initialize page variables
$currpagename=basename($_SERVER['PHP_SELF']);
$currpageid=0;
$currpageindex=0;
for ($i=0; $i<$page_count; $i++) {
  $curractivepage[$i]="";
  if ($listpage_name[$i]==$currpagename) {
    $currpageid=$listpage_id[$i];
    $currpageindex=$i;
    $curractivepage[$i]="active";
    $currpagetitle=$listpage_title[$i];
  }
}

?>
