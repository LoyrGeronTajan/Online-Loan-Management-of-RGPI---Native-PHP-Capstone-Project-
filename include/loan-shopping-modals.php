<!-- View Cart Modal -->
<div class="modal fade" id="viewcart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h6 class="modal-title" id="exampleModalLongTitle">
          <h6 class="text-white fw-bold">
            VIEW CART
        </h6><button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;
          </span></button>
      </div>
      <div class="modal-body">
        <?php
          $conn = new mysqli('localhost','root','','rgpi');
          $orders = "SELECT * FROM cartorder WHERE status = 1 AND username = '".$_SESSION['username']."' ";
          $query_order = mysqli_query($conn, $orders);
          if (mysqli_num_rows($query_order) > 0) 
          {
                  ?>
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-6 offset-md-3">
                        </div>
                      </div>
                      <div class="card">

                        <div class="card-body">
                          <div class="table-responsive" style="font-size: 1.2rem; ">
                            <table class="table table-borderless" align="center">
                              <thead>
                                <tr class="table-primary text-dark text-uppercase text-center">
                                  <th class="fw-bold" width="10%">Username</th>
                                  <th class="fw-bold" width="20%">Item Description</th>
                                  <th class="fw-bold" width="5%">Quantity</th>
                                  <th class="fw-bold" width="15%">Price</th>
                                  <th class="fw-bold" width="15%">Total</th>
                                  <th class="fw-bold" width="10%">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                    $total = 0.00;
                                    foreach($query_order as $orders)
                                    {
                                      ?>
                                        <tr align="center">
                                          <td><?php echo $_SESSION['username'];?> </td>
                                          <td align="left" width="30%"><?php echo $orders['order_productname'];?> </td>
                                          <td><?php echo $orders['order_productqty'];?> </td>
                                          <td>&#8369; <?php echo number_format($orders['order_productprice'] ,2);?> </td>
                                          <td>&#8369; <?php echo number_format($orders['productTotal'], 2);?>
                                          </td>


                                          <td align="center">
                                            <a href="shopping-cart.php?action=delete&id=<?php echo $orders["id"]; ?>">
                                              <button class="btn btn-sm btn-outline-danger btn-rounded d-flex justify-content-center"
                                                data-mdb-ripple-color="dark">
                                                <i class="fas fa-trash-alt"></i>
                                              </button>
                                            </a>
                                          </td>
                                        </tr>
                                      <?php
                                      $total += $orders['productTotal'];
                                    }
                                  ?>
                                <tr class="table-bordered table-success fw-bold">
                                  <td colspan="4" align="right"> <span class="text-muted">TOTAL</span> :</td>
                                  <td align="center">&#8369; <?php echo number_format($total, 2); ?></td>
                                  <td></td>
                                </tr>
                                <tr class="table-primary">
                                  <td colspan="5" align="right">
                                    <a href="shopping-cart.php" class="btn btn-sm btn-primary btn-rounded fw-bold"
                                      data-mdb-ripple-color="dark">ADD MORE</a>
                                  </td>
                                  <td align="right">
                                  <?php 
                                    if($total > $username['creditLimit'])
                                    {
                                      ?>
                                    <script>
                                      swal({
                                        title: "NOTICE!",
                                        text: "THE CREDIT LIMIT HAS BEEN REACHED! Remove any excess product. Thank you for adhering to your limit.",
                                        icon: "warning",
                                        timer: 10000,
                                      });
                                    </script>
                                    <button type="submit" name="btn-checkout" class="btn btn-sm btn-outline-success fw-bold btn-rounded"
                                      data-mdb-ripple-color="dark" data-toggle='modal' data-target='#invoice'
                                      disabled>CHECKOUT</button>
                                    <?php
                                    }
                                    else
                                    {
                                      ?>
                                    <button type="submit" name="btn-checkout" class="btn btn-sm btn-outline-success fw-bold btn-rounded"
                                      data-mdb-ripple-color="dark" data-toggle='modal' data-target='#invoice'>CHECKOUT</button>
                                    <?php
                                    }
                                  ?>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php 
          } 
          else
          {
            echo '<div class="d-flex justify-content-center" style="margin-top: 100px;"> <!-- START D-FLEX -->
                <div class="card mb-5">

                  <div class="card-shadow text-center">
                    <div class="card-body">
                      <img src="assets/img/emptyuser.gif" class="img-fluid" alt="gif" style=" width: 150px; height: 150px;">
                      <h6 class="card-title fw-bold">EMPTY CART
                      </h6>
                    </div>
                  </div>
                </div>
                </div>';   
          }
        ?>
      </div>
    </div>
  </div>
</div>

<!-- Generate Invoice No. Modal -->
<div class="modal fade" id="invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
       <div class="modal-header bg-primary">
         <h5 class="modal-title" id="exampleModalLongTitle">
           <h6 class="text-white fw-bold">
             Invoice Modal
           </h6>
         </h5><button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
             aria-hidden="true">&times;
           </span></button>
       </div>
       <div class="modal-body">

         <!-- START FORM -->
         <form action="" method="POST" enctype="multipart/form-data">
           <div class="modal-body">
             <div class="form-floating mb-3">
               <input type="text" class="form-control text-primary" name="invoiceNo" id="id"
                 value="<?php echo $number; ?>" readonly><label for="floatingInput">Invoice No:</label>
             </div>

             <div class="form-floating mb-3">
               <input type="text" class="form-control" name="invoiceUsername"
                 value="<?= $username['username'];?>" readonly /><label for="floatingInput">Username:</label>
             </div>

             <div class="form-floating mb-3">
               <input type="text" class="form-control" value="<?= $username['company'];?>"
                 name="invoiceCompany" readonly><label for="floatingInput">Company
                 Name</label>
             </div>

             <div class="modal-footer mb-3">
               <button type="button" class="btn btn-sm fw-bold btn-secondary btn-rounded mt-3" data-dismiss="modal">Close
               </button>


               <button type="submit" name="btn-add-invoice" class="btn btn-sm fw-bold btn-outline-success btn-rounded mt-3">Submit
               </button>

             </div>

           </div>
         </form>
         <!-- END FORM -->

       </div>
      </div>
    </div>
</div>