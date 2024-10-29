<!-- Tow Fileds Request Approved and Request Ignored -->
<?php
    include('connect.php');
    session_start();
    // if Session is getting account_no then user can access index.php else require login
    if(isset($_SESSION["s_admin_id"]))
    {
        $Admin_id = $_SESSION["s_admin_id"];
        // For Getting Admin Details
        $query_admin = "SELECT * FROM tbl_admin WHERE admin_id=$Admin_id";
        $result_admin = mysqli_query($con, $query_admin);
        $row_admin_detail = mysqli_fetch_array($result_admin);

        // For Getting All Customers Details
        // $query_for_customer_details = "SELECT * FROM tbl_customer";
        // $customers_details = mysqli_query($con,$query_for_customer_details);
        // $row_customer_detail = mysqli_fetch_array($customers_details);

        // $no_of_customer
        $query_for_no_of_requests = "SELECT * FROM tbl_requests";
        $result_no_of_requests = mysqli_query($con,$query_for_no_of_requests);
        $total_requests = mysqli_num_rows($result_no_of_requests); 

        // $debit_count
        $query_for_approved_requests = "SELECT * FROM tbl_requests where status='sent'";
        $result_no_of_approved_requests = mysqli_query($con,$query_for_approved_requests);
        $total_approved = mysqli_num_rows($result_no_of_approved_requests);

        // $credit_count
        $query_for_ignored_requests = "SELECT * FROM tbl_requests where status='ignore'";
        $result_no_of_ignored_requests = mysqli_query($con,$query_for_ignored_requests);
        $total_ignored= mysqli_num_rows($result_no_of_ignored_requests); 
        if($total_ignored == null)
        {
            $total_ignored = 0;
        }

        /// get Request_id from url
        if(isset($_GET['request_id']))
        {
            $request_id = intval($_GET['request_id']);
            $request_details = mysqli_query($con,"SELECT * FROM tbl_requests WHERE request_id=$request_id");
            $row_request = mysqli_fetch_array($request_details);
            $sender_account_no = $row_request['to_account'];

            $query_for_sender_details = "SELECT * FROM tbl_customer WHERE account_no = $sender_account_no";
            $result_sender_details = mysqli_query($con,$query_for_sender_details);
            $row_sender = mysqli_fetch_array($result_sender_details);
        }
        else {
            header('location: view_requests.php');

        }
        
    } else {
        header("location:http://localhost/online-banking/admin/dist/auth-login.php");
    }

?>


<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>View Requests</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- slick css -->
        <link href="assets/libs/slick-slider/slick/slick.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/slick-slider/slick/slick-theme.css" rel="stylesheet" type="text/css" />

        <!-- jvectormap -->
        <link href="assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.php" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/favicon.ico" alt="logo" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/orebank.png" alt="logo" height="20">
                                </span>
                            </a>

                            <a href="index.php" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/favicon.ico" alt="logo" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/orebank.png" alt="logo" height="20">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-backburger"></i>
                        </button>

                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-flag-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="" src="assets/images/flags/french.jpg" alt="Header Language" height="14">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/us.jpg" alt="user-image" class="mr-2" height="12"><span class="align-middle">Anglais</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/germany.jpg" alt="user-image" class="mr-2" height="12"><span class="align-middle">Allemand</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/italy.jpg" alt="user-image" class="mr-2" height="12"><span class="align-middle">Italien</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/spain.jpg" alt="user-image" class="mr-2" height="12"><span class="align-middle">Espagnol</span>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown d-none d-lg-inline-block ml-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg"
                                    alt="Header Avatar">
                                     
                                <span class="d-none d-sm-inline-block ml-1"><?php echo $row_admin_detail["full_name"]?></span>
                                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="auth-login.php"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Se déconnecter</a>
                            </div>
                        </div>
            
                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="index.php" class="waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span>Tableau de bord</span>
                                </a>
                            </li>

                            <li>
                                <a href="transaction.php" class=" waves-effect">
                                    <i class="mdi mdi-calendar-month"></i>
                                    <span>Transactions</span>
                                </a>
                            </li>

                            <li>
                                <a href="login_history.php" class="waves-effect">
                                    <i class="mdi mdi-account-group"></i>
                                    <span>Historique de connexion</span>
                                </a>
                            </li>

                            <li>
                                <a href="manage_balance.php" class="waves-effect">
                                    <i class="mdi mdi-bank-transfer"></i>
                                    <span>Gestion des soldes</span>
                                </a>
                            </li>

                            <li>
                                <a href="view_requests.php" class="waves-effect">
                                    <i class="mdi mdi-book-open"></i>
                                    <span>Toutes les demandes</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="analysis.php" class="waves-effect">
                                    <i class="mdi mdi-chart-areaspline-variant"></i>
                                    <span>Analysis</span>
                                </a>
                            </li> -->
                            <!-- <li>
                                <a href="manage_feedback.php" class="waves-effect">
                                    <i class="mdi mdi-heart-outline"></i>
                                    <span>Cheque Book Requests</span>
                                </a>
                            </li> -->

                            <li>
                                <a href="manage_feedback.php" class="waves-effect">
                                    <i class="mdi mdi-heart-outline"></i>
                                    <span>Avis</span>
                                </a>
                            </li>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Tableau de bord des demandes</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                            <li class="breadcrumb-item active">Demandes</li>
                                        </ol>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-sm-6 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14">Nombre des demandes</h5>
                                            </div>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-box"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h4 class="m-0 align-self-center"><?php echo $total_requests ?></h4>
                                        
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-sm-6 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14">Demandes approuvées</h5>
                                            </div>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-briefcase"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h4 class="m-0 align-self-center"><?php echo $total_approved?></h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14">Demandes ignorées</h5>
                                            </div>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-tags"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h4 class="m-0 align-self-center"><?php echo $total_ignored?></h4>
                                    </div>
                                </div>
                            </div>

    
                        </div>
                        <!-- end row -->
                        <div class="btn-group mr-2 mb-3">
                                                <a href="view_requests.php"><button type="button" class="btn btn-primary waves-light waves-effect"><i class="fas fa-arrow-left"></i></button></a>
                                            </div>

                        <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="media mb-4">
                                            <img class="d-flex mr-3 rounded-circle avatar-sm" src="assets/images/users/avatar-1.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h4 class="font-size-16"><?php echo $row_sender['full_name']; ?></h4>
                                                <p class="text-muted font-size-13"><?php echo $row_sender['email']; ?></p>
                                                <div class="btn-toolbar justify-content-md-end" role="toolbar">
                                            <div class="btn-group ml-md-2 mb-3">
                                                
                                                
                                            </div>
                                        </div>
                                        <!-- <h4 class="font-size-16">This Week's Top Stories</h4> -->
        
                                        <p>Chèr(e) <?php echo $row_sender['full_name'];?>,</p>
                                        <p><?php echo $row_request['message']; ?></p>
                                        <hr/>

                                        <div class="row">
                                            
                                            
                                            
                                            
                                                <div class="btn-toolbar justify-content-md-end" role="toolbar"></div>
                                                <div class="btn-group ml-md-2 mb-3"></div>
                                                
                                            

                                            
                                            
                                            
                                        </div>
                                    </div>
                                <!-- end card -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="assets/libs/slick-slider/slick/slick.min.js"></script>

        <!-- Jq vector map -->
        <script src="assets/libs/jqvmap/jquery.vmap.min.js"></script>
        <script src="assets/libs/jqvmap/maps/jquery.vmap.usa.js"></script>

        <script src="assets/js/pages/dashboard.init.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>
