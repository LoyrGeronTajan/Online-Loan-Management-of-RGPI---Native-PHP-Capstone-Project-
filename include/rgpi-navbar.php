
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="rgpi-home.php">
      <div class="sidebar-brand-icon">
        <img src="assets/img/icon2.png" class="img-fluid">
      </div>
      <div class="sidebar-brand-text mx-5"><sup style="color: #dfe6e9; font: size 2vw;">RGPI.</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
      <a class="nav-link" href="rgpi-home.php">
        <i class="fas fa-user-cog fa-sm fa-fw"></i>
        <span>Operations Manager</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
      Management
    </div>

    <li class="nav-item">
      <a class="nav-link" href="rgpi-addnewproduct.php">
        <i class="fab fa-opencart fa-sm fa-fw"></i>
        <span>Product Management</span></a>
    </li>

    <li class="nav-item">

      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fas fa-dollar-sign fa-sm fa-fw"></i>
        <span>Transaction</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Loan Orders</h6>
          <a class="collapse-item" href="rgpi-loansummary.php">Assign of Ordered Loans</a>
          <a class="collapse-item" href="rgpi-transaction.php">Borrowers' Ordered Loans</a>
          <a class="collapse-item" href="rgpi-kae-paidPayment.php">Paid Loans</a>
          <h6 class="collapse-header">Archive</h6>
          <a class="collapse-item" href="rgpi-archivePaid.php">Paid Archive</a>
          <a class="collapse-item" href="rgpi-archiveLoan.php">Product Archive</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="far fa-folder fa-sm fa-fw"></i>
        <span>Borrower's Information</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Profile:</h6>
          <a class="collapse-item" href="rgpi-borrowersprofile.php">Customer Profile</a>
          <a class="collapse-item" href="rgpi-creditlimit.php">Credit Limit Request</a>
          <a class="collapse-item" href="rgpi-kae-overdue.php">Critical Accounts</a>
        </div>
      </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
      CREATE USERS CREDENTIALS
    </div>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
        aria-controls="collapsePages">
        <i class="bi bi-plus-square-fill"></i>
        <span>Users' Credentials</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Users' Credentials</h6>
          <a class="collapse-item" href="rgpi-kaelist.php">Users' List</a>
        </div>
      </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>

  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars fa-sm fa-fw"></i>
        </button>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <h6>ADMIN</h6>
              <div class="topbar-divider d-none d-sm-block"></div>
              <span class="mr-2 d-none d-lg-inline text-gray-600 small text-uppercase">

                <?php $username = "username : "; echo $_SESSION['rgpi-name']; ?>

              </span>
              <i class="fas fa-power-off fw-bold text-danger fa-sm fa-fw"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="rgpi-logout.php" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400 fa-sm fa-fw"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up fa-sm fa-fw"></i>
      </a>


      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to logout?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
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