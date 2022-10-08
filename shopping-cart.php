<?php
      include 'include/customer-navigation.php';
      include 'include/security.php';
?>


<?php
        include 'lib/config.php';
        /****** COMPANY INFORMATION ********/
        $sql_date = "SELECT * FROM tbl_member WHERE username = '".$_SESSION['username']."'";
        $query_run = mysqli_query($conn,$sql_date);
        $username = mysqli_fetch_array($query_run);
      ?>

<head>

  <style>
    img {
      height: 200px;
      max-width: fit-content;
    }
  </style>



  <title>Loan Shopping | Right Goods Philippines Inc.</title>
</head>

<div class="container-fluid ">
  <!-- START CONTAINER -->
  <div class="row">
    <!-- Start Row -->
    <div class="col-md-12 " style="margin-top: 200px;">
      <div class="card">
        <div class="card-header bg-primary text-white">

          <?php 
    /******* Invoice Process *********/
    $conn = new mysqli('localhost','root','','rgpi');
    //SQL QUERY
    $query2 = "SELECT * FROM invoice ORDER BY invoiceId desc ";
    $result2 = mysqli_query($conn,$query2);
    $row = mysqli_fetch_assoc($result2);
    
    // $lastid = $row["invoiceId"];
    $rowcount = mysqli_num_rows($result2);

    /******* Increment the Invoice No ********/
    if(empty($rowcount))
    {
        $number = "RGPI-0000001";
    }
    else
    {
        $idd = str_replace("RGPI-", "", $rowcount);
        $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
        $number = 'RGPI-'.$id;
    }
    ?>

          <?php
         
    if(isset($_POST['btn-add-invoice']))
    {
        $invoiceno = $_POST['invoiceNo'];
        $username = $_POST['invoiceUsername'];
        $company = $_POST['invoiceCompany'];
     
        if(!$conn)
        {
            die("connection failed " . mysqli_connect_error());
        }
        else
        {
            $sql = "INSERT INTO invoice(invoiceNo,invoiceUsername,invoiceCompany)
            VALUES('".$invoiceno."','".$username."','".$company."') ";
            if(mysqli_query($conn,$sql))
            {
                $query = "SELECT invoiceId FROM invoice ORDER BY invoiceId desc";
                $result = mysqli_query($conn,$query);
                $row = mysqli_fetch_array($result);
                // $lastid = $row["invoiceId"];
                $rowcount = mysqli_num_rows($result);
                if(empty($rowcount))
                {
                    $number = "RGPI-0000001";
                }
                else
                {
                    $idd = str_replace("RGPI-", "", $rowcount);
                    $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
                    $number = 'RGPI-'.$id;
                }


                $yourURL="receipt.php?action=success";
                echo ("<script>location.href='$yourURL'</script>");
     
            }
            else
            {
                echo "Record Faileddd";
            }
        }
    }
?>

          <?php
            include 'lib/config.php';
            /****** COMPANY INFORMATION ********/
            $sql_date = "SELECT * FROM tbl_member WHERE username = '".$_SESSION['username']."'";
            $query_run = mysqli_query($conn,$sql_date);
            $username = mysqli_fetch_array($query_run);
                   
          if ($username['creditLimit'] == 0) 
          {
          ?>
          <script>
            swal({
              title: "NOTICE!",
              text: "Your credit limit has not been created by Right Goods Philippines Inc. Check your Account Profile for your Credit Limit at all times.",
              icon: "warning",
              timer: 10000,

            }).then(function () {
              window.location = "customerprofile.php";
            });
          </script>
          <?php
          }
        ?>
          <?php
            /****** Inovice Status ********/
            $sql_date = "SELECT invoice.kaeName,invoice.status,invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany, invoice.dateDelivered,invoice.dueDate,SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date FROM invoice LEFT JOIN cartorder ON cartorder.invoiceNo = invoice.invoiceNo 
            WHERE invoice.invoiceUsername =  '".$_SESSION['username']."' and invoice.status = 'notpaid'
            GROUP BY cartorder.invoiceNo;";
            $query_run = mysqli_query($conn,$sql_date);
            $status = mysqli_fetch_array($query_run);
    
            if (isset($status['status']) == 'notpaid') 
            {
            ?>
          <script>
            swal({
              title: "NOTICE!",
              text: "Your Total Balance is not yet paid.",
              icon: "warning",
              timer: 10000,

            }).then(function () {
              window.location = "customerprofile.php";
            });
          </script>
          <?php
            }
          ?>

          <h3 class="text-center">
        
            SHOPPING CART
            <?php
             $conn = new mysqli('localhost','root','','rgpi');
             $orders = "SELECT * FROM cartorder WHERE status = 1 AND username = '".$_SESSION['username']."' ";
             $query_order = mysqli_query($conn, $orders);
             $count = mysqli_num_rows($query_order);
            
             echo "<button type='button' class='btn btn-sm btn-outline-success btn-rounded float-sm-end position-relative'
             data-toggle='modal' data-target='#viewcart'>
             <i class='bi bi-cart2' style='color: white;'></i>
             <span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger badge-counter'
               id='comparison-count'>
               <span class='fw-bold'> ".$count." <span>
             </span>
           </button>";
            
          ?>

            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter"></span>
          </h3>
        </div>
      </div>
    </div>


    <div class="col-md-3">
      <!-- Start Filter -->
      <form class="position-sticky" action="" method="GET">
        <!-- Start Form -->
        <div class="card shadow mt-3">
          <div class="card-header">
            <h5>Filter
              <button type="submit" class="btn btn-sm btn-outline-success btn-rounded float-end"
                data-mdb-ripple-color="dark">Search</button>
            </h5>
          </div>
          <div class="card-body">
            <h6>Category List</h6>
            <hr>
            <?php
                include 'lib/config.php';
                $conn = new mysqli('localhost','root','','rgpi');
                //SQL QUERY
                $brand_query = "Select * FROM brandname ORDER BY brandname ASC"; 
                $brand_query_run = mysqli_query($conn,$brand_query);

                if (mysqli_num_rows($brand_query_run) > 0) {
                  foreach($brand_query_run as $brandlist)
                  {
                    $checked = [];
                    if (isset($_GET['brands'])) {
                      $checked = $_GET['brands'];
                    }
              ?>

                <div class="form-check mb-3">

                  <input type="checkbox" class="form-check-input" name="brands[]" id="flexCheckDefault"
                    value="<?= $brandlist['id']; ?> " <?php 
                    if (in_array($brandlist['id'], $checked))
                      {
                        echo "checked";
                      }
                  ?> />
                  <?= $brandlist['brandname']; ?>
                </div>
            <?php
                  }
                  }else
                  {
                    echo "No Category Found";
                  }
            ?>
          </div>
        </div>
      </form> <!-- End Form -->
    </div> <!-- End Filter -->


    <div class="col-md-9 mt-3">
      <!-- Brand Items -->
      <div class="card">
      <div class="card bg-info">
        <h6
         class="text-center text-dark " style=" font-family: 'Open Sans', sans-serif ">
          <span class="text-dark fw-bold ">NOTICE</span> : Please select and add one at a time
        </h6>
      </div>  
      
        <div class="card-body row">
          <?php
              if (isset($_GET['brands'])) 
                {
                  $itemscheck = [];
                  $itemscheck = $_GET['brands'];

                  foreach($itemscheck as $displayItems)
                  {
                    //SQL QUERY
                    $items = "SELECT * FROM addnewproduct  WHERE category IN ($displayItems) ORDER BY productName ASC";
                    $items_query_run = mysqli_query($conn,$items);

                    if (mysqli_num_rows($items_query_run) > 0) 
                    {
                      foreach($items_query_run as $itemlist) :
            ?>
          <div class="col-md-4 mt-3">
            <div class="border p-2">
              <form action="shopping-cart.php?action=add&id=<?php echo $itemlist["id"]; ?>" method="POST"
                class="fw-bold text-uppercase">
                <!-- START FORM -->
                <?php echo "<img src='assets/img/new-product/".$itemlist['productImage']."' class='img-fluid img-thumbnail'  >"?><br>

                <p class="lead" style="font-size: 1.2rem;"><?= $itemlist['productName']?></p> <br>

                &#8369; <?= $itemlist['productPrice']?>

                <input type="number" min="1" name="product_qty" id="" class="form-control" placeholder="qty" value="1"><br>

                <input type="hidden" name="cart_id" value="<?php echo $itemlist['id']?>">

                <input type="hidden" name="invoice" value="<?php echo $number?>">






                <input type="hidden" name="cart_name" value="<?php echo $itemlist['productName']?>">
                <input type="hidden" name="cart_price" value="<?php echo $itemlist['productPrice']?>">
                <button type="submit" id="addItem" name="btn-cart" class="btn btn-sm btn-outline-primary btn-rounded"
                  data-mdb-ripple-color="dark">Add to Cart</button>
              </form> <!-- END FORM -->
            </div>
          </div>
          <?php
                      endforeach;
                    }else{
                      echo '<div class="d-flex justify-content-center" style="margin-top: 100px;"> <!-- START D-FLEX -->
                      <div class="card mb-5">
                      
                        <div class="card-shadow text-center">
                          <div class="card-body">
                            <img src="assets/img/emptyuser.gif" class="img-fluid" alt="gif" style=" width: 150px; height: 150px;">
                            <h6 class="card-title fw-bold">No item found 
                            </h6>
                          </div>
                        </div>
                      </div>
                      </div>'; 
                    }

                  }

                }
                else
                {
                  //SQL QUERY
                  $items = "SELECT * FROM `addnewproduct` ORDER BY productName ASC";
                  $items_query_run = mysqli_query($conn,$items);

                  if (mysqli_num_rows($items_query_run) > 0) 
                  {
                    foreach($items_query_run as $itemlist) :
            ?>
          <div class="col-md-4 mt-3">
            <div class="border p-2">
              <div class="card-deck">
                      
                <form action="shopping-cart.php?action=add&id=<?php echo $itemlist["id"]; ?>" method="POST"
                  class="fw-bold text-uppercase ">
                  <!-- START FORM -->
                  <?php echo "<img src='assets/img/new-product/".$itemlist['productImage']."' class='img-fluid img-thumbnail img-thumbnail' >"?><br>

                  <p class="lead"><?= $itemlist['productName']?></p> <br>
                  &#8369; <?= $itemlist['productPrice']?><br>
                  <input type="number" min="1" name="product_qty" id="" class="form-control mb-3" placeholder="qty" value="1">

                  <!-- INPUT HIDDEN DATA -->
                  <input type="hidden" name="cart_id" value="<?php echo $itemlist['id']?>">

                  <input type="hidden" name="invoice" value="<?php echo $number?>">



                  <input type="hidden" name="cart_name" value="<?php echo $itemlist['productName']?>">
                  <input type="hidden" name="cart_price" value="<?php echo $itemlist['productPrice']?>">

                  <?php
                  include 'lib/config.php';
                  /****** COMPANY INFORMATION ********/
                  $sql_date = "SELECT * FROM tbl_member WHERE username = '".$_SESSION['username']."'";
                  $query_run = mysqli_query($conn,$sql_date);
                  $username = mysqli_fetch_array($query_run);
                   
                  if ($username['creditLimit'] == 0) {
                    ?>
                  <button type="submit" name="btn-cart" class="btn btn-sm btn-outline-primary btn-rounded" data-mdb-ripple-color="dark"
                    disabled>Add to Cart</button>
                  <?php
                  }
                  else
                  {
                    ?>
                  <button type="submit" name="btn-cart" class="btn btn-sm btn-outline-primary btn-rounded"
                    data-mdb-ripple-color="dark">Add to Cart</button>
                  <?php
                  }

                  ?>


                </form> <!-- END FORM -->
              </div>
            </div>
          </div>
          <?php

                    endforeach;
                    }else
                    {
                      echo '<div class="d-flex justify-content-center" style="margin-top: 100px;"> <!-- START D-FLEX -->
                      <div class="card mb-5">
                      
                        <div class="card-shadow text-center">
                          <div class="card-body">
                            <img src="assets/img/emptyuser.gif" class="img-fluid" alt="gif" style=" width: 150px; height: 150px;">
                            <h6 class="card-title fw-bold">No item found 
                            </h6>
                          </div>
                        </div>
                      </div>
                      </div>';  
                    }
                }  
          ?>

        </div>
      </div>
    </div>
  </div> <!-- End Row -->
</div> <!-- End Container -->

<!---------------------- PHP FUNCTION ----------------------->




<?php
    // BUTTON ADDTOCART FUNCTION
    if(isset($_POST['btn-cart']))
    {
      $invoice = $_POST['invoice'];
      $username = $_SESSION['username'];
      $cart_name = $_POST['cart_name'];
      $cart_price = $_POST['cart_price'];
      $cart_qty = $_POST['product_qty'];


      
        $qtyXprice = 0.00;
        number_format($qtyXprice = $cart_price * $cart_qty, 2);
        $conn = new mysqli("localhost","root","","rgpi");
        $cartQuery = "INSERT INTO cartorder (`invoiceNo`,`username`,`order_productname`,`order_productprice`,`order_productqty`,productTotal) VALUES ('$invoice','$username','$cart_name','$cart_price','$cart_qty','$qtyXprice')";
        $cart_query_run = mysqli_query($conn, $cartQuery);

        if($cart_query_run)
        {
          echo '<script>
          swal({
              
              title: "Item Added",
              icon: "success",
              timer: 5000,
              
          }).then(function() {
              window.location = "shopping-cart.php";
          });
        </script>';  
          // header("Location: shopping-cart.php");
         
          exit(); 
        
        }
        else
        {
        
          echo '<script>
          swal({
  
              title: "Item not Added",
              icon: "danger",
              timer: 5000,
              
          }).then(function() {
              window.location = "shopping-cart.php";
          });
        </script>'; 
        }
    }

    //REMOVE ITEM IN VIEW CART
    if(isset($_GET["action"]))  
    {  
      $product_id = $_GET["id"];

      $conn = new mysqli('localhost','root','','rgpi');
      $query = "DELETE FROM cartorder WHERE id='$product_id' ";
      $query_run = mysqli_query($conn,$query);

      if ($query_run) 
      {
          
        echo '<script>
          swal({

              title: "Item Removed",
              icon: "success",
              timer: 5000,
              
          }).then(function() {
              window.location = "shopping-cart.php";
          });
        </script>'; 
      }
      else
      {
        echo '<script>
          swal({

              title: "Item not Remove",
              icon: "danger",
              timer: 5000,
              
          }).then(function() {
              window.location = "shopping-cart.php";
          });
        </script>'; 
      }
    }

    
  ?>

<?php
  include 'include/loan-shopping-modals.php';
  include 'include/customer-footer.php';
  include 'include/customer-scripts.php';
  include 'include/scripts.php';
  ?>

</body>

</html>