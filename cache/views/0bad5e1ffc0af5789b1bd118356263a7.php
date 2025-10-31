<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->yieldSection('title'); ?> - <?php echo htmlspecialchars(APP_NAME, ENT_QUOTES, "UTF-8"); ?></title>    
    
    <link rel="icon" type="image/x-icon" href="<?php echo htmlspecialchars(asset('img/favicon.ico'), ENT_QUOTES, "UTF-8"); ?>">

    <!-- Custom fonts for this template-->
    <link href="/assets/dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"  type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/dashboard/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">


<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">SysFramework</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>        
        <li class="nav-item">
          <a class="nav-link" href="/register">Registrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/logout">Logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/admin/dashboard">Dashboard</a>
        </li>

        
                </ul>
            </div>
        </div>
    </nav>
    

<br><br>

    <!-- Main content --> 
     
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="/assets/bootstrap5/img/s.png" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img">
                </div>
                <div class="sidebar-brand-text mx-3">SysFramework <sup>2025</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/admin/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="/admin/buttons">Buttons</a>
                        <a class="collapse-item" href="/admin/cards">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="/admin/utilities_color">Colors</a>
                        <a class="collapse-item" href="/admin/utilities_border">Borders</a>
                        <a class="collapse-item" href="/admin/utilities_animation">Animations</a>
                        <a class="collapse-item" href="/admin/utilities_other">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pages:</h6>
                        <a class="collapse-item" href="/admin/blank">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/charts">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/tables">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>ERP Syspanel</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://sys.syspanel.com.br" target="_blank">Upgrade to ERP Syspanel</a>
            </div>

        </ul>
        <!-- End of Sidebar -->


    <?php echo $this->yieldSection('content'); ?>  
    
    
    </div>
    <!-- End of Page Wrapper -->
     <br>

    <!-- Footer -->
    <footer class="footer bg-dark text-white text-center py-3 fixed-bottom">
        <div class="container mt-3">
            <p class="mb-0">
                &copy; <?php echo htmlspecialchars(date('Y'), ENT_QUOTES, "UTF-8"); ?> <a href="https://sysframework.syspanel.com.br" target="_blank" class="text-white">SysFramework Versão 1.0 </a> 
                <a href="https://opensource.org/licenses/MIT" target="_blank" class="text-white">MIT License</a>
            </p>
            <div class="mt-2">
                <a href="https://www.paypal.com/donate/?business=marcocosta@gmx.com&currency_code=USD" target="_blank">
                    <img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" alt="Donate via PayPal">
                </a>
            </div>
        </div>
    </footer>



    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/dashboard/') }}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="/assets/dashboard/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/jquery/jquery.min.js"></script>


    <!-- Core plugin JavaScript-->
    <script src="/assets/dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>


    <!-- Custom scripts for all pages-->
    <script src="/assets/dashboard/js/sb-admin-2.min.js"></script>


    <!-- Page level plugins -->
    <script src="/assets/dashboard/vendor/chart.js/Chart.min.js"></script>


    <!-- Page level custom scripts -->
    <script src="/assets/dashboard/js/demo/chart-area-demo.js"></script>
    <script src="/assets/dashboard/js/demo/chart-pie-demo.js"></script>


</body>
</html>