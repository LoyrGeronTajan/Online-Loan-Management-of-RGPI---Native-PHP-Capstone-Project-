<?php 
   session_start();	
   include "lib/config.php";
   if (isset($_SESSION['rgpi-username']) && isset($_SESSION['rgpi-id'])) {   ?>

 
 	

	<!---------------- OPERATIONS MANAGER ----------------->
	<?php if ($_SESSION['rgpi-role'] == 'admin') {?>
  <?php include 'include/rgpi-header.php';?>	  
  <?php include 'include/rgpi-navbar.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

	<!-- Total Customer Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<a class="text-decoration-none" href="rgpi-borrowersprofile.php">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Total Customer </div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
								<?php
									include 'lib/config.php';
									$sql = "SELECT id FROM `tbl_member` WHERE creditLimit != '' ORDER BY id";
									$query_run = mysqli_query($conn,$sql);
									$totalCustomer = mysqli_num_rows($query_run);
									echo $totalCustomer;
								?>
							</div>
						</div>
						<div class="col-auto">
						<i class="far fa-user-circle fa-2x text-gray-300"></i>
							
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>


	<!-- Total New Customer Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<a class="text-decoration-none" href="rgpi-newcustomer.php">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								New Customer </div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
								<?php
									include 'lib/config.php';
									$sql = "SELECT id FROM `tbl_member` WHERE creditLimit = '' AND status = '!approve' ORDER BY id";
									$query_run = mysqli_query($conn,$sql);
									$totalCustomer = mysqli_num_rows($query_run);
									echo $totalCustomer;
								?>
							</div>
						</div>
						<div class="col-auto">
						<i class="far fa-user-circle fa-2x text-gray-300"></i>
							
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>

	<!-- Newcommers Card Example -->
	<!-- <div class="col-xl-3 col-md-6 mb-4">
		<a class="text-decoration-none" href="rgpi-newcommer.php">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Newcomer Customer </div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php
										/******* Pending accounts *********/
											include 'lib/config.php';
											$sql = "SELECT newcommer_id FROM `tbl_newcommer` WHERE status = 'pending' ORDER BY newcommer_id";
											$query_run = mysqli_query($conn,$sql);
											$totalPaid = mysqli_num_rows($query_run);
											echo $totalPaid;
									
								?>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-user-clock fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div> -->


	<!-- Pending Requests Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<a class="text-decoration-none" href="rgpi-loansummary.php">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Pending Account (Assign KAE)</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php
										/******* Pending accounts *********/
											include 'lib/config.php';
											$sql = "SELECT invoiceId FROM `invoice` WHERE kaeName = ' ' ORDER BY invoiceId";
											$query_run = mysqli_query($conn,$sql);
											$totalPaid = mysqli_num_rows($query_run);
											echo $totalPaid;
									
								?>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-user-clock fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>


	<!-- Credit Limit Requests Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<a class="text-decoration-none" href="rgpi-creditlimit.php">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Pending Credit Limit Request</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
							<?php
										/******* Pending accounts *********/
											include 'lib/config.php';
											$sql = "SELECT id FROM `tbl_member` WHERE requestCreditlimit = 'request' ORDER BY id";
											$query_run = mysqli_query($conn,$sql);
											$totalPaid = mysqli_num_rows($query_run);
											echo $totalPaid;
									
								?>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-user-clock fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>

	<!-- Set Limit Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<a class="text-decoration-none" href="rgpi-setlimit.php">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Set Credit Limit</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
								<?php
									include 'lib/config.php';
									$sql = "SELECT * From tbl_member WHERE creditLimit = '' AND status = 'approve' ORDER BY id";
									$query_run = mysqli_query($conn,$sql);
									$totalCustomer = mysqli_num_rows($query_run);
									echo $totalCustomer;
								?>
							</div>
						</div>
						<div class="col-auto">
						<i class="far fa-user-circle fa-2x text-gray-300"></i>
							
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>

	<!-- Critical Accounts Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<a class="text-decoration-none" href="rgpi-kae-overdue.php">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Critical Accounts</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
								<?php
								/******* Overdue accounts *********/
									include 'lib/config.php';
									$sql = "SELECT invoice.kaeName,invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany, invoice.dateDelivered,invoice.dueDate,  SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date FROM invoice LEFT JOIN cartorder ON cartorder.invoiceNo = invoice.invoiceNo 
            
									WHERE  invoice.status = 'notpaid' AND CURRENT_TIMESTAMP > invoice.dueDate
									GROUP BY invoice.invoiceNo
									";
									$query_run = mysqli_query($conn,$sql);

									
									$totalOverdue = mysqli_num_rows($query_run);
									echo $totalOverdue;
									
								?>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
						
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>

	<!-- Paid Transaction Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<a class="text-decoration-none" href="rgpi-kae-paidPayment.php">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Paid Transaction
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
								<?php
										/******* Paid accounts *********/
											include 'lib/config.php';
											$sql = "SELECT invoiceId FROM `invoice` WHERE status = 'paid' AND archive = 'NO' ORDER BY invoiceId";
											$query_run = mysqli_query($conn,$sql);
											$totalPaid = mysqli_num_rows($query_run);
											echo $totalPaid;
									
								?>
									</div>
								</div>
								
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	
</div>



</div>
<!-- /.container-fluid -->


  <?php
		include 'include/rgpi-footer.php';  
		include 'include/scripts.php'; 
	?>

  <!---------------- END OPERATIONS MANAGER ----------------->


	<?php }else { ?>
	
	<!---------------- Key Accounts Executive --------------->
	<?php include 'include/rgpi-header.php';?>
	<?php include 'include/kae-navbar.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

	<!-- Total Customer Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<a class="text-decoration-none" href="rgpi-kae-activeAccount.php">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Handle Accounts </div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
								<?php
									include 'lib/config.php';
									$sql = "SELECT invoiceId FROM `invoice` WHERE kaeName = '".$_SESSION['rgpi-username']."' ORDER BY invoiceId";
									$query_run = mysqli_query($conn,$sql);
									$totalCustomer = mysqli_num_rows($query_run);
									echo $totalCustomer;
									
								?>
							</div>
						</div>
						<div class="col-auto">
						<i class="far fa-user-circle fa-2x text-gray-300"></i>
							
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>

	<!-- Critical Accounts Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<a class="text-decoration-none" href="rgpi-kae-overdue.php">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Critical Accounts</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">
								

								<?php
								/******* Overdue accounts *********/
									include 'lib/config.php';
									$sql = "SELECT invoice.kaeName,invoice.invoiceNo, invoice.invoiceUsername, invoice.invoiceCompany, invoice.dateDelivered,invoice.dueDate,  SUM(cartorder.productTotal) AS 'Total_Balance', cartorder.create_date FROM invoice LEFT JOIN cartorder ON cartorder.invoiceNo = invoice.invoiceNo 
            
									WHERE invoice.kaeName = '".$_SESSION['rgpi-username']."' AND CURRENT_TIMESTAMP > invoice.dueDate AND invoice.status = 'notpaid'
									GROUP BY invoice.invoiceNo
									";

									$query_run = mysqli_query($conn,$sql);
									$totalOverdue = mysqli_num_rows($query_run);
									echo $totalOverdue;

									// while ($row=mysqli_fetch_assoc($query_run)) {

									// 	$dueDate = date($row['dueDate']);
                                	// 	$deliveryDate = date($row['dateDelivered']);

									// 	$due = strtotime($dueDate);
									// 	$deliver = strtotime($deliveryDate);
									// 	$today = strtotime('today');

									// 	if($today > $due) {
									// 		$totalOverdue = mysqli_num_rows($query_run);
									// 		echo $totalOverdue;
									// 	}else {
									// 		//echo 0;
									// 	}

									
									// }

									//echo $totalOverdue;
									
								?>
							</div>
						</div>
						<div class="col-auto">
							<i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>

	<!-- New Assigned Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<a class="text-decoration-none" href="rgpi-kae-transaction.php">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">List Accounts
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
								<?php
										/******* Paid accounts *********/
											include 'lib/config.php';
											$sql = "SELECT invoiceId FROM `invoice` WHERE !COALESCE(dateDelivered,0) AND !COALESCE(dueDate,0) AND kaeName = '".$_SESSION['rgpi-username']."' AND status = 'notpaid' ORDER BY invoiceId;";
											$query_run = mysqli_query($conn,$sql);
											$totalPaid = mysqli_num_rows($query_run);
											echo '<h6 class="text-muted">new assigned accounts</h6>' . $totalPaid ;
									
								?>
									</div>
								</div>
								
							</div>
						</div>
						<div class="col-auto">
						<i class="far fa-user-circle fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
</div>



</div>
<!-- /.container-fluid -->


	<?php
		include 'include/rgpi-footer.php';  
		include 'include/scripts.php'; 
	?>
<!---------------- End Key Accounts Executive --------------->
		<?php } ?>
<?php }else{
	header("Location: rgpi-login.php");
} ?>