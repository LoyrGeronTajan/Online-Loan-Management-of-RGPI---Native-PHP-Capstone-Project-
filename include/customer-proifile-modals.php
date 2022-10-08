<!-- Customer Profile Modal -->

<!-- EDIT PROFILE Modal -->
<div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLongTitle">
          <h3 class="text-white fw-bold text-uppercase">
            User Profile
          </h3><button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;
            </span></button>
      </div>


      <!-- START FORM -->
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="pl-lg-4">
            <h6 class="heading-small text-muted mb-4">User information</h6>
            <div class="row">

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Full Name</label>
                  <input name="user_fullname" type="text" id="input-email" class="form-control form-control-alternative"
                    value="<?php echo $username['fullname'];?>" style="background-color: #dfe6e9; color:#535c68;">
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
                  <input name="user_companyname" type="text" id="input-username"
                    class="form-control form-control-alternative" value="<?php echo $username['company'];?>"
                    style="background-color: #dfe6e9; color:#535c68;">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Address</label>
                  <input name="user_companyaddress" type="text" id="input-email"
                    class="form-control form-control-alternative" value="<?php echo $username['address'];?>"
                    style="background-color: #dfe6e9; color:#535c68;">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="input-first-name">Contact Information</label>
                  <input name="user_phone" type="text" id="input-first-name"
                    class="form-control form-control-alternative" value="<?php echo $username['phone'];?>"
                    style="background-color: #dfe6e9; color:#535c68;">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group focused">
                  <label class="form-control-label" for="input-email">Email Address</label>
                  <input name="user_email" type="email" id="input-last-name"
                    class="form-control form-control-alternative" value="<?php echo $username['email'];?>"
                    style="background-color: #dfe6e9; color:#535c68;">
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer mb-3"><button type="button" class="btn btn-sm btn-secondary btn-rounded mt-3"
              data-dismiss="modal">Close</button><button type="submit" name="btn-update-userprofile"
              class="btn btn-sm btn-success btn-rounded mt-3">Update</button></div>
        </div>
      </form>
      <!-- END FORM -->
    </div>
  </div>
</div>

<!-- EDIT CREDENTIALS Modal -->
<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLongTitle">
          <h3 class="text-white fw-bold text-uppercase">
            Change Credentials
          </h3><button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
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
                  <input name="user_newpassword" type="password" minlength="8" id="input-email"
                    class="form-control form-control-alternative" style="background-color: #dfe6e9; color:#535c68;"
                    required>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Confirm Password</label>
                  <input name="user_confirmpassword" type="password" minlength="8" id="input-email"
                    class="form-control form-control-alternative" style="background-color: #dfe6e9; color:#535c68;"
                    required>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer mb-3">
            <button type="button" class="btn btn-sm btn-secondary btn-rounded mt-3" data-dismiss="modal">Close</button>

            <button type="submit" name="btn-update-usercredential"
              class="btn btn-sm btn-success btn-rounded mt-3">Update</button></div>
        </div>
      </form>
      <!-- END FORM -->
    </div>
  </div>
</div>

<!-- TOTAL LOAN BALANCE Modal -->
<div class="modal fade" id="loanbalance" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLongTitle">
          <h3 class="text-white fw-bold text-uppercase">
            Total Loan Balance
          </h3><button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;
            </span></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
          <?php
            include 'lib/config.php';
            $conn = new mysqli('localhost','root','','rgpi');
            $invoice=" SELECT invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany, invoice.dateDelivered,invoice.dueDate, SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date FROM invoice LEFT JOIN cartorder ON cartorder.invoiceNo = invoice.invoiceNo

            WHERE invoice.invoiceUsername =  '".$_SESSION['username']."' AND invoice.status != 'paid'
            GROUP BY cartorder.invoiceNo;
            ";

            $invoice_query_run=mysqli_query($conn, $invoice);

            if (mysqli_num_rows($invoice_query_run) > 0) {
              
              $total = 0.00;
              $subTotal = 0.12;
              $result = 0.00;
              $grandTotal = 0.00;

              while ($row=mysqli_fetch_assoc($invoice_query_run)) {
                ?>
                 <?php
                        /********** Count Number of Terms **************/
                        date_default_timezone_set('Asia/Manila');
                                $dueDate = date($row['dueDate']);
                                $deliveryDate = date($row['dateDelivered']);
                                //$today = date('Y-m-d');
                               
                                $due = strtotime($dueDate);
                                $deliver = strtotime($deliveryDate);
                                $today = strtotime('today');

                                
                                $Overduediff = $due - $today; // overdue
                                $overdue = abs(floor($Overduediff / (60 * 60 * 24)));


                                $Termsdiff = $deliver - $due; // terms
                                $terms = abs(floor($Termsdiff / (60 * 60 * 24)));

                        ?>
                  <form class="row g-3 needs-validation" novalidate>

                    <div class="col-md-3">
                      <label for="validationCustom01" class="form-label col-form-label-sm">Invoice No.</label>
                      <input type="text" class="form-control form-control-sm" id="validationCustom01" value="<?= $row['invoiceNo']?>" style="background-color: #dfe6e9; color:#535c68;" readonly>
                      
                    </div>

                    <div class="col-md-3">
                      <label for="validationCustom02" class="form-label col-form-label-sm">Username</label>
                      <input type="text" class="form-control form-control-sm" id="validationCustom02" value="<?= $row['invoiceUsername']?>" style="background-color: #dfe6e9; color:#535c68;" readonly>
                      
                    </div>

                    <div class="col-md-6">
                      <label for="validationCustom02" class="form-label col-form-label-sm">Company Name</label>
                      <input type="text" class="form-control form-control-sm" id="validationCustom02" value="<?= $row['invoiceCompany']?>" style="background-color: #dfe6e9; color:#535c68;" readonly>
                    </div>

                    <div class="col-md-6">
                      <label for="validationCustom01" class="form-label col-form-label-sm">Date Delivered</label>
                      <input type="text" class="form-control form-control-sm" id="validationCustom01" value="<?= $row['dateDelivered'] ?>" style="background-color: #dfe6e9; color:#535c68;" readonly>
                      
                    </div>

                    <div class="col-md-6">
                      <label for="validationCustom02" class="form-label col-form-label-sm">Due Date</label>
                      <input type="text" class="form-control form-control-sm" id="validationCustom02" value="<?= $row['dueDate']?>" style="background-color: #dfe6e9; color:#535c68;" readonly>
                    </div>

                    <div class="col-md-2">
                      <label for="validationCustom02" class="form-label col-form-label-sm">Term</label>
                      <input type="text" class="form-control form-control-sm" id="validationCustom02" value="<?= $terms ?>" style="background-color: #dfe6e9; color:#535c68;" readonly>
                    </div>

                    <div class="col-md-2">
                      <label for="validationCustom02" class="form-label col-form-label-sm">Overdue</label>
                      <input type="text" class="form-control form-control-sm" id="validationCustom02" value="<?php
                       if ($deliveryDate == null && $dueDate == null) {
                        echo 0;
                      }
                      else if($today > $due) {
                          echo $overdue;
                      }
                      ?>" style="background-color: #dfe6e9; color:#535c68;" readonly>
                      
                    </div>
                    
                    <div class="col-md-8">
                      <label for="validationCustom02" class="form-label col-form-label-sm">Total Amount</label>
                      <input type="text" class="form-control form-control-sm" id="validationCustom02" value="&#8369; <?= number_format($grandTotal,2)?>" style="background-color: #dfe6e9; color:#535c68;" readonly>
                    </div>


                  </form>               
                <?php
              }
            } else {
              echo '<div class="d-flex justify-content-center" style="margin-top: 100px;"> <!-- START D-FLEX -->
              <div class="card mb-5">
              
                <div class="card-shadow text-center">
                  <div class="card-body">
                    <img src="assets/img/emptyuser.gif" class="img-fluid" alt="gif" style=" width: 150px; height: 150px;">
                    <h6 class="card-title fw-bold">
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
  </div>
</div>

<!-- TOTAL Payment Transaction Modal -->
<div class="modal fade" id="transaction_history" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLongTitle">
          <h3 class="text-white fw-bold text-uppercase">
            Payment History
          </h3><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;
            </span></button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="table-responsive">
            <?php
                            include 'lib/config.php';
                            $conn = new mysqli('localhost','root','','rgpi');
                            $invoice=" SELECT invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany,invoice.datePaid, invoice.dateDelivered,invoice.dueDate, SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date FROM invoice LEFT JOIN cartorder ON cartorder.invoiceNo = invoice.invoiceNo

                            WHERE invoice.invoiceUsername =  '".$_SESSION['username']."' AND invoice.status = 'paid'
                            GROUP BY cartorder.invoiceNo;
                            ";


                            $invoice_query_run=mysqli_query($conn, $invoice);

                            if (mysqli_num_rows($invoice_query_run) > 0) {
                        ?>
            <table class="table table-borderless caption-top table-hover" id="dataTable">
              <thead>
                <tr class="table-primary text-dark">

                  <th scope="col">INVOICE NO.</th>
                  <th scope="col">USERNAME </th>
                  <th scope="col">COMPANY NAME </th>
                  <th scope="col">DATE PAID </th>
                  <th scope="col">TOTAL AMOUNT</th>
                </tr>
              </thead>
              <tbody>
                <?php
                                $total = 0.00;
                                $subTotal = 0.12;
                                $result = 0.00;
                                $grandTotal = 0.00;
                                while ($row=mysqli_fetch_assoc($invoice_query_run)) { ?>
                <tr>
                  <td class="align-middle"><?php echo $row['invoiceNo']?></td>
                  <td class="align-middle"><?php echo $row['invoiceUsername']?></td>
                  <td class="align-middle"><?php echo $row['invoiceCompany']?></td>
                  <td class="align-middle"><?php echo $row['datePaid']?></td>
                  <?php
                                    //$total += $row['Total_Balance'];
                                    $result = $row['Total_Balance'] * $subTotal;
                                    $grandTotal = $row['Total_Balance'] + $result;
                                    ?>
                  <td class="align-middle">&#8369; <?php echo number_format($grandTotal,2)?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php
                      }
                        else
                        {
                          echo '<div class="d-flex justify-content-center" style="margin-top: 100px;"> <!-- START D-FLEX -->
                          <div class="card mb-5">

                            <div class="card-shadow text-center">
                              <div class="card-body">
                                <img src="assets/img/emptyuser.gif" class="img-fluid" alt="gif" style=" width: 150px; height: 150px;">
                                <h6 class="card-title fw-bold">
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
  </div>
</div>



