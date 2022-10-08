<!-- Modal -->

<!-- Add Modal -->
<div class="modal fade" id="addnewproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-uppercase" style="color: white;">
        <h5 class="modal-title" id="exampleModalLabel" > Add Product</h5>
        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="rgpi-addnewproduct.php" method="POST" enctype="multipart/form-data" class="row g-3 ">

          <div class="col-md-6">
            <label for="validationCustom01" class="form-label col-form-label-sm">Product Category</label>
            <select name="category" class="form-select form-select-sm" style="background-color: #dfe6e9; color:#535c68;" required>
              <option value="1">1 : Baby Care</option>
              <option value="2">2 : Fabric Care</option>
              <option value="3">3 : Family Care</option>
              <option value="4">4 : Feminine Care</option>
              <option value="5">5 : Grooming</option>
              <option value="6">6 : Hair Care</option>
              <option value="7">7 : Home Care</option>
              <option value="8">8 : Oral Care</option>
              <option value="9">9 : Perosnal Health Care</option>
              <option value="10">10 : Skin & Personal Care</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="validationCustom02" class="form-label col-form-label-sm">Product Description</label>
            <input type="text" name="product_name" class="form-control form-control-sm"
              style="background-color: #dfe6e9; color:#535c68;" required />
          </div>

          <div class="col-md-6">
            <label for="validationCustom02" class="form-label col-form-label-sm">Product Image</label>
            <input type="file" name="add_product_image" class="form-control form-control-sm"
              style="background-color: #dfe6e9; color:#535c68;" required />
          </div>

          <div class="col-md-6">
            <label for="validationCustom01" class="form-label col-form-label-sm">Product Price</label>
            <input type="text" name="product_price" class="form-control form-control-sm" id="validationCustom01"
              required style="background-color: #dfe6e9; color:#535c68;" required>

          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="btn-add-product" class="btn btn-sm btn-outline-success">Add</button>
          </div>
        </form>
      </div>


    </div>
  </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="edit<?= $data['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-uppercase" style="color: white;">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="rgpi-addnewproduct.php" method="POST" class="row g-3" enctype="multipart/form-data">
          <input type="hidden" name="edit_product_id" value="<?php echo $data['id'];?>">

          <div class="col-md-6">
            <label for="validationCustom02" class="form-label col-form-label-sm">Image</label>
            <input type="file" name="product_image" value="<?php echo $data['productImage'];?>"
              class="form-control form-control-sm" />
          </div>

          <div class="col-md-6">
            <label for="validationCustom01" class="form-label col-form-label-sm">Product Category</label>
            <select name="edit_product_category" class="form-control" style="background-color: #dfe6e9; color:#535c68;"
              required>
              <option value="<?php echo $data['category']?>"><?php echo $data['category']?></option>
              <option value="1">1 : Baby Care</option>
              <option value="2">2 : Fabric Care</option>
              <option value="3">3 : Family Care</option>
              <option value="4">4 : Feminine Care</option>
              <option value="5">5 : Grooming</option>
              <option value="6">6 : Hair Care</option>
              <option value="7">7 : Home Care</option>
              <option value="8">8 : Oral Care</option>
              <option value="9">9 : Perosnal Health Care</option>
              <option value="10">10 : Skin & Personal Care</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="validationCustom02" class="form-label col-form-label-sm">Product Description</label>
            <input type="text" name="edit_product_name" class="form-control form-control-sm"
              value="<?php echo $data['productName'];?>" style="background-color: #dfe6e9; color:#535c68;" required />
          </div>

          <div class="col-md-6">
            <label for="validationCustom01" class="form-label col-form-label-sm">Product Price</label>
            <input type="text" name="edit_product_price" class="form-control form-control-sm" id="validationCustom01"
              value="<?= $data['productPrice'];?>" style="background-color: #dfe6e9; color:#535c68;" required>

          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="btn-update-product" class="btn btn-sm btn-outline-success">Update</button>
          </div>
        </form>
      </div>


    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete<?= $data['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-uppercase" style="color: white;">
        <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="rgpi-addnewproduct.php" method="POST" class="row g-3 ">
          <input type="hidden" name="btn_delete_id" value="<?php echo $data['id'];?>">
          <h3 class="text-center">Are you sure ? </h3>

          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="btn-delete-product" class="btn btn-sm btn-outline-danger">Delete</button>
          </div>
        </form>
      </div>


    </div>
  </div>
</div>