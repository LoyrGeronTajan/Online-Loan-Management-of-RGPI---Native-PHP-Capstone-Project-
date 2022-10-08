<?php
    include 'include/customer-navigation.php';
    include 'include/security.php';
?>

<head>
  <title>RGPI Receipt | Rigth Goods Philippines Inc.</title>
  <style>
    table {
      display: flex;
      flex-flow: column;
      width: 80%;
      align-items: center;

    }

    thead {
      flex: 0 0 auto;
    }

    tbody {
      flex: 1 1 auto;
      display: block;
      overflow: auto;
      /* overflow-x: hidden; */
    }

    tr {

      width: 100%;
      display: table;
      table-layout: fixed;
    }
  </style>
</head>
<?php
    if(!isset($_GET["action"]) == 'success')  
      { 
        echo '<div class="d-flex justify-content-center" style="margin-top: 100px;"> <!-- START D-FLEX -->
                    <div class="card mb-5">
                    
                      <div class="card-shadow text-center">
                        <div class="card-body">
                          <img src="assets/img/emptyuser.gif" class="img-fluid" alt="gif" style=" width: 150px; height: 150px;">
                          <h6 class="card-title fw-bold">Empty Receipt
                          </h6>
                        </div>
                      </div>
                    </div>
                    </div>';   
        
      }
      else
      {

        //Display the Receipt
        include 'lib/config.php';

        //SQL QUERY
        $receipt_query = "SELECT invoice.invoiceNo,cartorder.order_productname, cartorder.order_productqty,cartorder.order_productprice,cartorder.productTotal FROM cartorder,invoice WHERE cartorder.status = 1 AND cartorder.invoiceNo = invoice.invoiceNo AND cartorder.username = '".$_SESSION['username']."'";
        $query_receipt_run = mysqli_query($conn, $receipt_query);
        $symbol = "qty)";
        $space = " ";
        $customer = mysqli_fetch_assoc($query_receipt_run);

        /****** TIMEZONE AND DATE ********/
        date_default_timezone_set('Asia/Manila');
        $date = date('F d, Y');
        
        if ($query_receipt_run) 
          {
        ?>
        <div class="container py-5 mt-5"> 
          <div class="d-flex justify-content-center">
            <!-- START D-FLEX -->
            <div class="card mt-3">
              <div class="card-header text-white bg-primary">
                <p class="h5 text-center fw-bold">CUSTOMER'S ORDER SUMMARY</p>
              </div>
              <div class="card-shadow text-center">
                <div class="card-body">
                  <figure class="text-center">
                    <blockquote class="blockquote">
                      <p>Thankyou!
                      <span class="fw-bold"> <?php echo $_SESSION['username'];?></span> for choosing <span
                        style="color: #2980b9; font: size 1.6vw; font-weight:bold;">RGPI.</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                      RIGHT GOODS PHILIPPINES INC.
                    </figcaption>
                  </figure>
                 
                 <img src="assets/img/icon2.png" class="img-fluid" style="width: auto; height: 200px;" alt="" >
                 <hr>
                 <dl class="row text-justify">
                       <dt class="col-sm-4">RGPI</dt>
                        <dd class="col-sm-8">
                          <dl class="row">
                            <dt class="col-sm-6"></dt>
                            <dd class="col-sm-6">
                              Receipt
                            </dd>
                          </dl>

                        </dd>  
                        <hr>
                        <dt class="col-sm-4">STMI Compound</dt>
                        <dd class="col-sm-8">
                          <dl class="row">
                            <dt class="col-sm-6"></dt>
                            <dd class="col-sm-6">
                            Invoice No : <?= $customer['invoiceNo']?>
                            </dd>
                          </dl>
                        </dd> 
                        <hr>                
                        <dt class="col-sm-4">Brgy. Lawa Calamba</dt>
                        <dd class="col-sm-8">
                          <dl class="row">
                            <dt class="col-sm-6"></dt>
                            <dd class="col-sm-6">
                              Date: <?= $date ?>
                            </dd>
                          </dl>
                        </dd>  
                        <hr>
                        <dt class="col-sm-4">[63 49 545-5585]</dt>
                        <dd class="col-sm-8">
                          <dl class="row">
                            <dt class="col-sm-6"></dt>
                            <dd class="col-sm-6">
                              Username: <?= $_SESSION['username'] ?>
                            </dd>
                          </dl>
                        </dd>  

                      </dl>
                         
                  <!-- <div class="table-responsive">
                    <table class="table table borderless">
                    
                      <tbody>
                        <tr>
                          <td>Right Goods Philippines Inc</td>
                          <td></td>
                          <td>Receipt</td>
                        </tr>
                        <tr>
                          <td>STMI Compound Brgy. Lawa Calamba</td>
                          <td></td>
                          <td>Invoice No: RGPI-0000001</td>
                        </tr>
                      </tbody>

                    </table>
                  </div> -->

                  
                 
                  
                  <div class="table-responsive">
                    <table class="table table-borderless table-hover" style="height: 600px;overflow: scroll;font-size: 1.2rem; ">
                      <thead class="fw-bold">
                        <tr class="table-primary fw-bold text-uppercase">
                          <th class="fw-bold">Invoice Number</th>
                          <th class="fw-bold">Product Description</th>
                          <th class="fw-bold">Price</th>
                          <th class="fw-bold">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                                    $total = 0.00;
                                    $subTotal = 0.12;
                                    $result = 0.00;
                                    $grandTotal = 0.00;
                                    foreach($query_receipt_run as $receipt)
                                    {
                                  ?>

                        <tr>
                          <td align="left">
                            <!-- PRODUCT DESCRIPTION -->
                            <?php echo $receipt['invoiceNo']?>
                          </td>

                          <td align="left">
                            <!-- PRODUCT DESCRIPTION -->
                            <?php echo $receipt['order_productname'] . " (" . $receipt['order_productqty'] . "qty)"?>
                          </td>

                          <td>
                            <!-- PRODUCT PRICE -->
                            &#8369; <?php echo number_format($receipt['order_productprice'],2);?>
                          </td>
                          <td>
                            <!-- PRODUCT TOTAL -->
                            &#8369; <?php echo number_format($receipt['productTotal'], 2);?>
                          </td>
                        </tr>

                        <?php
                                      $total += $receipt['productTotal'];
                                      $result = $total * $subTotal;
                                      $grandTotal = $total + $result;

                                    }
                                    ?>
                        <tr class=" fw-bold">
                          <td colspan="2" align="right" class="fw-bold"><span class="text-muted">SUB TOTAL</span></td>
                          <td align="right" class="fw-bold">&#8369; <?php  echo number_format($total, 2); ?></td>
                        </tr>
                        <tr class=" fw-bold">
                          <td colspan="2" align="right" class="fw-bold"><span class="text-muted">12% VAT</span></td>
                          <td align="right" class="fw-bold">&#8369; <?php  echo number_format($result, 2); ?></td>
                        </tr>
                        <tr class=" fw-bold">
                          <td colspan="2" align="right" class="fw-bold"><span class="text-muted">GRAND TOTAL</span></td>
                          <td align="right" class="fw-bold">&#8369; <?php  echo number_format($grandTotal, 2); ?></td>
                        </tr>
                        <tr class="table-primary">
                          <td class="" colspan="3" align="right">
                            <form action="generatePdf.php" method="post" target="_blank">
                              <input type="hidden" name="totalamount" value="<?php  echo number_format($grandTotal, 2);?>">

                              <button type="submit" class="btn btn-outline-success btn-rounded" name="dlPdf"  data-mdb-ripple-color="dark">
                              <i class="fas fa-download"></i>
                                GENERATE RECEIPT
                              </button>
                            </form>


                          </td>

                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          
<?php
                  
                  
                  }
                }     
              ?>


<?php
    include 'include/scripts.php';
?>