<div id="page-container" class="sidebar-o sidebar-dark side-scroll side-trans-enabled">
  <nav id="sidebar" aria-label="Main Navigation">

    <!-- Side Logo -->
    <div class="content-header">
      <a class="font-w600 text-dual" href='index.php'>
        <img src="assets/img/system/logo.png" width="39px" class="mb-1">&nbsp;&nbsp;
        <span class="smini-hide">
          <span class="font-w700 ">U S R A - W E B</span>
        </span>
      </a>
    </div>

    <!-- Side Profile -->
    <div class="content-side bg-white-5 px-1">
      <div class="content text-center pt-3 pb-4 px-0">
        <div class="pt-0 pb-1">
          <img class="img-avatar img-avatar-thumb" src="assets/img/<?=$_SESSION['user_avatar']?>" alt="">
        </div>
        <h1 class="h6 text-white mb-0 pb-0 mt-3"><?=$_SESSION['user_email']?></h1>
        <small class="text-white-75 py-0 my-0">Registration ID : #<?=$_SESSION['user_id']?></small><br>
        <small class="text-white-75 py-0 my-0">Registered on <?=$_SESSION['user_registerdate']?></small>
      </div>
    </div>

    <!-- Side Navigation -->
    <div class="content-side content-side-full pt-2">
      <ul class="nav-main">
        <li class='nav-main-heading pt-3'>Registration Process</li>
          <!-- loop page list acquired from db, from '_var.php' -->
          <?php
            for ($i=1; $i < $page_count ; $i++) {
              ?>
                <li class="nav-main-item">
                  <a class="nav-main-link <?=$curractivepage[$i]?>" href="<?=$listpage_name[$i]?>">
                    <i class="nav-main-link-icon <?=$listpage_icon[$i]?>"></i>
                    <span class="nav-main-link-name"><?=$listpage_title[$i]?></span>
                  </a>
                </li>
              <?php
            }
          ?>
        <li class='nav-main-heading pt-3'>System Settings</li>
        <li class="nav-main-item">
          <a class="nav-main-link" href="#" data-toggle="modal" data-target="#logout" title="Exit">
            <i class="nav-main-link-icon fa fa-sign-out-alt"></i>
            <span class="nav-main-link-name">Log Out</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Main Container -->
  <main id="main-container">


