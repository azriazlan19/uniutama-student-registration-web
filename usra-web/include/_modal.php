<!-- Change Password Modal -->
<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="change_password" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popout modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="block block-themed block-transparent mb-0">
        <div class="block-header bg-primary-dark pt-3">
          <h3 class="block-title"><i class="fa fa-key"></i> &nbsp; Change Password</h3>
        </div>
        <div class="block-content font-size-sm">
          <form id="loginft" action="#" method="post">
            <div class="row items-push p-0 m-0 mb-3">
              <p>Please insert a new password for your account. Minimum password length have to be <span class="text-danger">at least 8 characters</span> and the entered password must not be the same with the current default password.</p>
            </div>
            <div class="form-group row">
              <label for="new_pword" class="col-md-4 col-form-label">New Password:</label>
              <div class="col-md-8">
                <input type="password" class="form-control input-sm" name="new_pword" value="" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="new_pword2" class="col-md-4 col-form-label">Re-type Password:</label>
              <div class="col-md-8">
                <input type="password" class="form-control input-sm" name="new_pword2" value="" required>
              </div>
            </div>
          </form>
        </div>
        <div class="block-content block-content-full text-right">
          <button type="submit" class="btn btn-sm btn-outline-secondary" form="loginft">Continue</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Logout Modal -->
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="logout" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popout modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="block block-themed block-transparent mb-0">
        <div class="block-header bg-primary-dark pt-3">
          <h3 class="block-title"><i class="fa fa-sign-out-alt"></i> &nbsp; Confirm Exit</h3>
        </div>
        <div class="block-content font-size-sm">
          <form id="signout" action="logout.php" method="post">
            <div class="row items-push p-0 m-0">
              <p class="">Are you sure you want to sign out from the system?</p>
            </div>
          </form>
        </div>
        <div class="block-content block-content-full text-right">
          <button type="submit" class="btn btn-sm btn-outline-secondary" form="signout">Continue</button>
        </div>
      </div>
    </div>
  </div>
</div>
