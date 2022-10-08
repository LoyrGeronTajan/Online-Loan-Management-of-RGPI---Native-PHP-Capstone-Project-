<!-- Modal -->
<div class="modal fade" id="addkae" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="exampleModalLabel">ADD NEW KEY ACCOUNT EXECUTIVE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="rgpi-kaelist.php" method="POST" enctype="multipart/form-data" class="row g-3 ">
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label col-form-label-sm">USER ROLE</label>
                    <select class="form-select form-select-sm mb-3" name="role" aria-label="Default select example" style="background-color: #dfe6e9; color:#535c68;" required >
                        <option selected value="user">Key Accounts Executive</option>
                        <option value="admin">Operations Manager</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label col-form-label-sm">KAE IMAGE</label>
                    <input class="form-control form-control-sm" type="file" name="kae-image" id="kae-image" style="background-color: #dfe6e9; color:#535c68;" required  />
                </div>

                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label col-form-label-sm">FULL NAME</label>
                    <input type="text" name="fname" class="form-control form-control-sm"
                    style="background-color: #dfe6e9; color:#535c68;" required />
                </div>

                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label col-form-label-sm">EMAIL ADDRESS</label>
                    <input type="email" name="email" class="form-control form-control-sm" id="validationCustom01"
                    required style="background-color: #dfe6e9; color:#535c68;" required/>
                </div>

                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label col-form-label-sm">USERNAME</label>
                    <input type="text" name="username" class="form-control form-control-sm" id="validationCustom01"
                    required style="background-color: #dfe6e9; color:#535c68;" required/>
                </div>

                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label col-form-label-sm">PASSWORD</label>
                    <input type="password" name="password" minlength="8" class="form-control form-control-sm" id="validationCustom01"
                    required style="background-color: #dfe6e9; color:#535c68;" required/>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btn-add-usertype" class="btn btn-sm btn-outline-success">Add</button>
                </div>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>