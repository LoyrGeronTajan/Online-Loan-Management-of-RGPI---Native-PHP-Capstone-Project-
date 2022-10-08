<div class="modal fade" id="kaeInformation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLongTitle">
          USER PROFILE
        </h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;
          </span></button>
      </div>

      <!-- START FORM -->
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="pl-lg-4">
            <h6 class="heading-small text-muted mb-4">User Image</h6>
            <div class="row">

              <div class="col-lg-12">
                <div class="form-group">
                  <input name="user_image" type="file" id="" class="form-control form-control-alternative"
                    value="<?php echo $username['userImage'];?>" style="background-color: #dfe6e9; color:#535c68;">
                </div>
              </div>
            </div>
            <hr class="my-4">
          </div>

          <div class="pl-lg-4">
            <h6 class="heading-small text-muted mb-4">Company information</h6>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label">Name</label>
                  <input name="user_name" type="text" id="input-username" class="form-control form-control-alternative"
                    value="<?php echo $username['name'];?>" style="background-color: #dfe6e9; color:#535c68;">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-email">Email Address</label>
                  <input name="user_email" type="email" id="input-last-name"
                    class="form-control form-control-alternative" value="<?php echo $username['email'];?>"
                    style="background-color: #dfe6e9; color:#535c68;">
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer mb-3"><button type="button" class="btn btn-sm btn-secondary"
              data-dismiss="modal">Close</button><button type="submit" name="btn-update-userprofile"
              class="btn btn-sm btn-outline-success">Update</button></div>
        </div>
      </form>
      <!-- END FORM -->
    </div>
  </div>
</div>

<!-- KAE Password Modal -->
<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLongTitle">
          Change Credentials
        </h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;
          </span></button>
      </div>

      <!-- START FORM -->
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="pl-lg-4">
            <h6 class="heading-small text-muted mb-4">User Crentials</h6>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Old Password</label>
                  <input name="user_oldpassword" type="text" class="form-control form-control-alternative"
                    style="background-color: #dfe6e9; color:#535c68;" required>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">New Password</label>
                  <input name="user_newpassword" type="password" id="input-email"
                    class="form-control form-control-alternative" style="background-color: #dfe6e9; color:#535c68;"
                    required>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Confirm Password</label>
                  <input name="user_confirmpassword" type="password" id="input-email"
                    class="form-control form-control-alternative" style="background-color: #dfe6e9; color:#535c68;"
                    required>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer mb-3">
            <button type="button" class="btn btn-sm btn-secondary " data-dismiss="modal">Close</button>

            <button type="submit" name="btn-update-usercredential"
              class="btn btn-sm btn-outline-success ">Update</button></div>
        </div>
      </form>
      <!-- END FORM -->
    </div>
  </div>
</div>


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to logout?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancel</button>

        <form action="rgpi-logout.php" method="POST">

          <button type="submit" name="logout_btn" class="btn btn-sm btn-outline-success">Logout</button>
        </form>
      </div>
    </div>
  </div>
</div>