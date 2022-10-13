<?php
session_start();
require 'include/_dbcon.php';
require 'include/_var.php';
require 'include/_header.php';
require 'include/_sidebar.php';
require 'include/_hero.php';
require 'include/_alert.php';

// use student email as main data identifier
$email=$_SESSION['user_email'];

// initialize page variable
$sql = "SELECT * FROM student WHERE email='$email'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$personal_name = $row['fullname'];
$personal_gender = $row['gender'];
$personal_religion = $row['religion'];
$personal_race = $row['race'];
$personal_marital = $row['maritalstatus'];
$personal_dob = $row['dateofbirth'];
$personal_pob = $row['placeofbirth'];
$personal_contact = $row['phonenumber'];
$personal_address = $row['address'];
$personal_city = $row['city'];
$personal_state = $row['state'];
$personal_country = $row['country'];
$personal_postcode = $row['postcode'];

// reset profile image
if ($row['avatar']!=NULL) {
  $_SESSION['user_avatar']="avatar/".$row['avatar'];
  $personal_avatar = $row['avatar'];
} else {
  $personal_avatar = "No image, click to upload";
}
mysqli_free_result($result);


// if user submit details update, process details update
if (isset($_REQUEST['submit_personal_information'])) {

  // set variable
  $fullname = $_REQUEST['fullname'];
  $gender = $_REQUEST['gender'];
  $religion = $_REQUEST['religion'];
  $race = $_REQUEST['race'];
  $maritalstatus = $_REQUEST['maritalstatus'];
  $dateofbirth = $_REQUEST['dateofbirth'];
  $placeofbirth = strtoupper($_REQUEST['placeofbirth']);
  $phonenumber = $_REQUEST['phonenumber'];
  $address = strtoupper($_REQUEST['address']);
  $city = strtoupper($_REQUEST['city']);
  $state = strtoupper($_REQUEST['state']);
  $country = strtoupper($_REQUEST['country']);
  $postcode = $_REQUEST['postcode'];
  $sql = "UPDATE student SET fullname = '$fullname', gender = '$gender', religion = '$religion', race = '$race', maritalstatus = '$maritalstatus', dateofbirth = '$dateofbirth', placeofbirth = '$placeofbirth', phonenumber = '$phonenumber', address = '$address', city = '$city', state = '$state', country = '$country', postcode = '$postcode' WHERE email = '$email'";

  // set alert
  if (mysqli_query($con, $sql)) {
    $_SESSION['alert_status'] = 1;
    $_SESSION['alert_strong'] = "Success";
    $_SESSION['alert_type'] = "success";
    $_SESSION['alert_text'] = "Details updated successfully.";
  } else {
    $_SESSION['alert_status'] = 1;
    $_SESSION['alert_strong'] = "Error";
    $_SESSION['alert_type'] = "danger";
    $_SESSION['alert_text'] = "Details failed to be updated.";
  }

  // refresh page
  mysqli_close($con);
  // header("Refresh:0; url=profile.php");
  echo '<script> location.replace("profile.php"); </script>';

// if user submit image update, process image upload
} else if (isset($_REQUEST['submit_img_upload'])) {

  // set required variable and path to upload folder
  $target_dir = "assets/img/avatar/";
  $target_file = $target_dir . basename($_FILES["profile_img"]["name"]);
  $imgFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $imgCheck = getimagesize($_FILES["profile_img"]["tmp_name"]);
  $imgName = strtok($email, '@') . rand() . "." . $imgFileType;
  $sql = "UPDATE student SET avatar = '$imgName' WHERE email = '$email'";

  // process upload image
  if ($imgCheck !== false) { // Check if image file is a actual image or fake image
    if ($_FILES["profile_img"]["size"] < 600000) { // Check if image size larger than 5MB
      if ($imgFileType == "jpg" or $imgFileType == "png" or $imgFileType == "jpeg" or $imgFileType == "gif" ) { // check format
        if (move_uploaded_file($_FILES["profile_img"]["tmp_name"], $target_dir . $imgName)) { // Check if file was successfully uploaded
          if (mysqli_query($con, $sql)) { // Check if file name was successfully updated
            $_SESSION['user_avatar'] = "avatar/".$imgName;
            $_SESSION['alert_status'] = 1;
            $_SESSION['alert_strong'] = "Upload Success.";
            $_SESSION['alert_type'] = "success";
            $_SESSION['alert_text'] = "The image " . htmlspecialchars(basename($_FILES["profile_img"]["name"])) . " has been renamed to ".$imgName.".";
          } else { // File name was not updated, but the file was uploaded
            $_SESSION['alert_status'] = 1;
            $_SESSION['alert_strong'] = "Upload failed.";
            $_SESSION['alert_type'] = "danger";
            $_SESSION['alert_text'] = "The image was not uploaded.";
          }
        } else { // File was not uploaded
          $_SESSION['alert_status'] = 1;
          $_SESSION['alert_strong'] = "Upload failed.";
          $_SESSION['alert_type'] = "danger";
          $_SESSION['alert_text'] = "The image was not uploaded.";
        }
      } else { // File format not allowed
        $_SESSION['alert_status'] = 1;
        $_SESSION['alert_strong'] = "Upload failed.";
        $_SESSION['alert_type'] = "danger";
        $_SESSION['alert_text'] = "Only JPG, JPEG, PNG or GIF file are allowed.";
      }
    } else { // File size is larger than 5MB
      $_SESSION['alert_status'] = 1;
      $_SESSION['alert_strong'] = "Upload failed.";
      $_SESSION['alert_type'] = "danger";
      $_SESSION['alert_text'] = "The file is too large. Maximum size allowed is 5MB.";
    }
  } else { // File is fake
    $_SESSION['alert_status'] = 1;
    $_SESSION['alert_strong'] = "Upload failed.";
    $_SESSION['alert_type'] = "danger";
    $_SESSION['alert_text'] = "Please upload a proper image file.";
  }

  // refresh page
  mysqli_close($con);
  // header("Refresh:0; url=profile.php");
  echo '<script> location.replace("profile.php"); </script>';
}
?>

<!-- Page Content -->
<div class="content">
  <div class="row">
    <div class="col-lg-12">
      <!-- Block Tabs Default Style -->
      <div class="block">
        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
          <li class="nav-item mx-1"><a class="nav-link active" href="#_1">Personal Information</a></li>
          <li class="nav-item mx-1"><a class="nav-link" href="#_2">Passport Information (International Student Only)</a></li>
        </ul>
        <div class="block-content tab-content">

          <div class="tab-pane active" id="_1" role="tabpanel">
          <form id="form_personal_information" action="" method="POST">
            <div class="row p-3">
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-4"><small>Profile Image :</small></div>
                  <div class="col-md-8">
                    <button type="button" id="btnTB" class="input-file" data-toggle='modal' data-target='#img_upload' title="Click to update Profile Image">
                      <?=$personal_avatar?>
                    </button>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"><small>Full Name :</small></div>
                  <div class="col-md-8"><input type="text" class="form-control input-sm" name="fullname" value="<?=$personal_name?>"></div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"><small>Gender :</small></div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="gender" value="<?=$personal_gender?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"><small>Religion :</small></div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="religion" value="<?=$personal_religion?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"><small>Race :</small></div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="race" value="<?=$personal_race?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"><small>Date of Birth :</small></div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="dateofbirth" value="<?=$personal_dob?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"><small>Marital Status :</small></div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="maritalstatus" value="<?=$personal_marital?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-4"><small>Mailing Address :</small></div>
                  <div class="col-md-8">
                    <textarea type="text" rows="3" class="form-control input-sm mb-1" name="address" placeholder="Street Address"><?=$personal_address?></textarea>
                    <input type="text" class="form-control input-sm mb-1" name="city" value="<?=$personal_city?>" placeholder="City">
                    <input type="text" class="form-control input-sm mb-1" name="state" value="<?=$personal_state?>" placeholder="State">
                    <input type="text" class="form-control input-sm mb-1" name="country" value="<?=$personal_country?>" placeholder="Country">
                    <input type="text" class="form-control input-sm" name="postcode" value="<?=$personal_postcode?>" placeholder="Postcode">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"><small>Place of Birth :</small></div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="placeofbirth" value="<?=$personal_pob?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"><small>Phone Number :</small></div>
                  <div class="col-md-8">
                    <input type="text" class="form-control input-sm" name="phonenumber" value="<?=$personal_contact?>">
                  </div>
                </div>

              </div>
              <div class="col-md-12 mb-3">
                <input type="submit" name="submit_personal_information" form="form_personal_information" class="btn btn-sm btn-primary form-control mt-3" value="Update Personal Information">
              </div>
            </div>
          </form>
          </div>

          <div class="tab-pane" id="_2" role="tabpanel">
            <div class="row p-3">
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-4"><small>Date Issuance :</small></div>
                  <div class="col-md-8"><input type="text" class="form-control input-sm" name="" value="" disabled></div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"><small>Place Issuance :</small></div>
                  <div class="col-md-8"><input type="text" class="form-control input-sm" name="" value="" disabled></div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"><small>Immigration Details :</small></div>
                  <div class="col-md-8"><input type="text" class="form-control input-sm" name="" value="" disabled></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-4"><small>Date Expiry :</small></div>
                  <div class="col-md-8"><input type="text" class="form-control input-sm" name="" value="" disabled></div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"><small>Immigration :</small></div>
                  <div class="col-md-8"><input type="text" class="form-control input-sm" name="" value="" disabled></div>
                </div>
                <div class="form-group row">
                  <div class="col-md-4"><small>Immigration Date :</small></div>
                  <div class="col-md-8"><input type="text" class="form-control input-sm" name="" value="" disabled></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Upload Profile Image -->
<div class="modal fade" id="img_upload" tabindex="-1" role="dialog" aria-labelledby="img_upload" aria-hidden="true" data-dismiss="true">
  <div class="modal-dialog modal-dialog-popout modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="block block-themed mb-0">
        <div class="block-header bg-primary-dark">
          <h3 class="block-title">
            <i class='fa fa-camera fa-1x d-none d-sm-inline-block'></i> &nbsp; Update Profile Image
          </h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="block-content mt-2">
          <form id="form_img_upload" action="" method="POST" enctype="multipart/form-data">
            <input type="text" class="form-control input-sm" name="c2_id" value="<?=$c2_id?>" hidden>
            <input type="text" class="form-control input-sm" name="c2_name" value="<?=$c2_name?>" hidden>
            <div class="form-group row text-center px-3">
              <div class="drop-zone form-control">
                <span class="drop-zone__prompt">Drop image here or click to upload</span>
                <input type="file" name="profile_img" class="drop-zone__input">
            </div>
            </div>
          </form>
        </div>
        <div class="block-content block-content-full text-right pt-1 mb-4">
          <button type="submit" name="submit_img_upload" form="form_img_upload" class="btn btn-sm btn-outline-secondary">CONFIRM</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require 'include/_footer.php';
require 'include/_modal.php';
?>
