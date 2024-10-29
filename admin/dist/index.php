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
        $query_for_no_of_customer = "SELECT * FROM tbl_customer";
        $result_no_of_customer = mysqli_query($con,$query_for_no_of_customer);
        $no_of_customer = mysqli_num_rows($result_no_of_customer); 

        // $debit_count
        $query_for_debit_count = "SELECT * FROM tbl_transaction where trans_type='DEBIT'";
        $result_debit_count = mysqli_query($con,$query_for_debit_count);
        $debit_count = mysqli_num_rows($result_debit_count);

        // $credit_count
        $query_for_credit_count = "SELECT * FROM tbl_transaction where trans_type='CREDIT'";
        $result_credit_count = mysqli_query($con,$query_for_credit_count);
        $credit_count = mysqli_num_rows($result_credit_count); 

        // $total_bank_balance
        $query_for_total_bank_balance = "SELECT SUM(balance) as bank_balance FROM tbl_balance"; // SUM of all account balance
        $result_total_bank_balance = mysqli_query($con,$query_for_total_bank_balance);
        $array_total_bank_balance = mysqli_fetch_assoc($result_total_bank_balance); # $no_of_transaction
        $total_bank_balance = $array_total_bank_balance['bank_balance'];

        // $query_for_credit_total = "SELECT SUM(amount) as credit_sum FROM tbl_transaction where account_no = $Account_no and trans_type='CREDIT' ";
        // $query_credit_result = mysqli_query($con,$query_for_credit_total);
        // $total_credit = mysqli_fetch_assoc($query_credit_result);
   
        // // TODO: Select All Customer and their Transaction from database and Print into Table
        // // For Getting All Customers Transaction Details
        // $query_for_transactions = "SELECT * FROM tbl_transaction where account_no = $Account_no ORDER BY trans_date DESC ";
        // $transaction_result = mysqli_query($con,$query_for_transactions);
        // $no_of_transaction = mysqli_num_rows($transaction_result); # $no_of_transaction

        // // For getting Acount Balance
        // $query_for_account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$Account_no";
        // $result_account_bal = mysqli_query($con, $query_for_account_bal);
        // $account_bal = mysqli_fetch_array($result_account_bal)[0];

        // // For Sum of Credit Amount
        // $query_for_credit_total = "SELECT SUM(amount) as credit_sum FROM tbl_transaction where account_no = $Account_no and trans_type='CREDIT' ";
        // $query_credit_result = mysqli_query($con,$query_for_credit_total);
        // $total_credit = mysqli_fetch_assoc($query_credit_result);
        // if (!empty($total_credit['credit_sum'])) {
        //     $credit_sum = $total_credit['credit_sum'];
        // }
        // else {
        //     $credit_sum = 0;
        // }
        
        // // For Sum of Debit Amount
        // $query_for_debit_total = "SELECT SUM(amount) as debit_sum FROM tbl_transaction where account_no = $Account_no and trans_type='DEBIT' ";
        // $query_debit_result = mysqli_query($con,$query_for_debit_total);
        // $total_debit = mysqli_fetch_assoc($query_debit_result);
        // if (!empty($total_debit['debit_sum'])) {
        //     $debit_sum = $total_debit['debit_sum'];
        // }
        // else {
        //     $debit_sum = 0;
        // }
        

        
    } else {
        header("location:http://localhost/online-banking/admin/dist/auth-login.php");
    }

?>


<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Tableau de bord</title>
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
                                    <h4 class="mb-0 font-size-18">Tableau de bord</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                            <li class="breadcrumb-item active">Tableau de bord</li>
                                        </ol>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14">Nombres de clients</h5>
                                            </div>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-box"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h4 class="m-0 align-self-center"><?php echo $no_of_customer ?></h4>
                                        
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14">Totale des transactions de débit</h5>
                                            </div>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-briefcase"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h4 class="m-0 align-self-center"><?php echo $debit_count?></h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14">Totale des transactions de crédit</h5>
                                            </div>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-tags"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h4 class="m-0 align-self-center"><?php echo $credit_count?></h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14">Solde total</h5>
                                            </div>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-cart"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h4 class="m-0 align-self-center">MGA <?php echo $total_bank_balance ?></h4>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                        <!-- end row -->
                        

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-4">Tous les clients</h4>

                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"  style="width: 60px;"></th>
                                                        <th scope="col">N° Compte & Nom</th>
                                                        <th scope="col">Date de naissance</th>
                                                        <th scope="col">Sexe</th>
                                                        <th scope="col">Mobile</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Solde</th>
                                                        <th scope="col">Type de compte</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php

                                                    // For Getting All Customers Details
                                                    $query_for_customer_details = "SELECT * FROM tbl_customer";
                                                    $customers_details = mysqli_query($con,$query_for_customer_details);
                                                    // $row_customer_detail = mysqli_fetch_array($customers_details);

                                                    while($row = mysqli_fetch_array($customers_details)) {
                                                        $account_no = $row["account_no"];

                                                        $query_for_account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$account_no";
                                                        $result_account_bal = mysqli_query($con, $query_for_account_bal);
                                                        $account_bal = mysqli_fetch_array($result_account_bal)[0];

                                                        $query_for_account_type = "SELECT account_type FROM tbl_account_type WHERE account_no=$account_no";
                                                        $result_account_type = mysqli_query($con, $query_for_account_type);
                                                        $account_type = mysqli_fetch_array($result_account_type)[0];
                                                       echo 
                                                       '<tr>
                                                       <td>
                                                       <div class="avatar-xs">
                                                       <a href="profile_view.php?account_no='.$account_no.'">
                                                       <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                        '.$row["full_name"][0].'
                                                                    </span>
                                                        </a>

                                                                </div>
                                                            </td>
                                                            <td>
                                                       <a href="profile_view.php?account_no='.$account_no.'">

                                                                <p class="mb-1 font-size-12"># '.$row["account_no"].'</p>
                                                                <h5 class="font-size-15 mb-0">'.$row["full_name"].' </h5>
                                                        </a>


                                                            </td>
                                                            <td>'.$row["birth_date"].'</td>
                                                            <td>'.$row["gender"].'<br></td>
                                                            
                                                            <td>'.$row["mobile"].'</td>
                                                            <td> '.$row["email"].'</td>
                                                            <td>MGA '.$account_bal.'<br></td>
                                                            <td> '.$account_type.'</td>
                                                    </tr>';
                                                   } 
                                                ?>    
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
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
