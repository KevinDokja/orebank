<?php
    include('connect.php');
    session_start();
    // if Session is getting account_no then user can access index.php else require login
    if(isset($_SESSION["s_account_no"]) && isset($_SESSION['s_login']))
    {
        $Account_no = $_SESSION["s_account_no"];
        // For Getting Customer Details
        $query_customer = "SELECT * FROM tbl_customer WHERE account_no='$Account_no'";
        $result_customer = mysqli_query($con, $query_customer);
        $row_customer = mysqli_fetch_array($result_customer);

        // For Getting Different Types of values in page
        $query_for_transactions = "SELECT * FROM tbl_transaction where account_no = $Account_no ORDER BY trans_date DESC ";
        $transaction_result = mysqli_query($con,$query_for_transactions);
        $no_of_transaction = mysqli_num_rows($transaction_result); # $no_of_transaction

        // For Getting Different Types of values in page
        $query_for_transactions_of_this_month = "SELECT * FROM tbl_transaction where account_no = $Account_no AND MONTH(trans_date) = MONTH(CURRENT_DATE()) AND YEAR(trans_date) = YEAR(CURRENT_DATE()) ";
        $transaction_result_of_this_month = mysqli_query($con,$query_for_transactions_of_this_month);
        $no_of_transaction_of_this_month = mysqli_num_rows($transaction_result_of_this_month); # $no_of_transaction

        // For getting Acount Balance
        $query_for_account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$Account_no";
        $result_account_bal = mysqli_query($con, $query_for_account_bal);
        $account_bal = mysqli_fetch_array($result_account_bal)[0];

        // For Sum of Credit Amount
        $query_for_credit_total = "SELECT SUM(amount) as credit_sum FROM tbl_transaction where account_no = $Account_no and trans_type='CREDIT' ";
        $query_credit_result = mysqli_query($con,$query_for_credit_total);
        $total_credit = mysqli_fetch_assoc($query_credit_result);
        if (!empty($total_credit['credit_sum'])) {
            $credit_sum = $total_credit['credit_sum'];
        }
        else {
            $credit_sum = 0;
        }
        
        // For Sum of Debit Amount
        $query_for_debit_total = "SELECT SUM(amount) as debit_sum FROM tbl_transaction where account_no = $Account_no and trans_type='DEBIT' ";
        $query_debit_result = mysqli_query($con,$query_for_debit_total);
        $total_debit = mysqli_fetch_assoc($query_debit_result);
        if (!empty($total_debit['debit_sum'])) {
            $debit_sum = $total_debit['debit_sum'];
        }
        else {
            $debit_sum = 0;
        }

        $query_credit_sum_this_month = "SELECT SUM(amount) as credit_sum_of_this_month FROM tbl_transaction where account_no = $Account_no and trans_type='CREDIT' and MONTH(trans_date) = MONTH(CURRENT_DATE()) AND YEAR(trans_date) = YEAR(CURRENT_DATE())";
        $query_credit_sum_this_month_result = mysqli_query($con,$query_credit_sum_this_month);
        $credit_sum_this_month = mysqli_fetch_assoc($query_credit_sum_this_month_result);
        if (!empty($credit_sum_this_month['credit_sum_of_this_month'])) {
            $credit_sum_of_this_month = $credit_sum_this_month['credit_sum_of_this_month'];
        }
        else {
            $credit_sum_of_this_month = 0;
        }

        $query_debit_sum_this_month = "SELECT SUM(amount) as debit_sum_of_this_month FROM tbl_transaction where account_no = $Account_no and trans_type='DEBIT' and MONTH(trans_date) = MONTH(CURRENT_DATE()) AND YEAR(trans_date) = YEAR(CURRENT_DATE())";
        $query_debit_sum_this_month_result = mysqli_query($con,$query_debit_sum_this_month);
        $credit_sum_this_month = mysqli_fetch_assoc($query_debit_sum_this_month_result);
        if (!empty($credit_sum_this_month['debit_sum_of_this_month'])) {
            $debit_sum_of_this_month = $credit_sum_this_month['debit_sum_of_this_month'];
        }
        else {
            $debit_sum_of_this_month = 0;
        }
//         SELECT *
// FROM tbl_transaction
// WHERE MONTH(trans_date) = MONTH(CURRENT_DATE())
// AND YEAR(trans_date) = YEAR(CURRENT_DATE())
        

        
    } else {
        header("location:http://localhost/online-banking/site/dist/auth_login.php");
    }

?>


<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Transactions</title>
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

    <body data-topbar="dark" data-layout="horizontal">

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.php" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm-dark.png" alt="" height="22">
                                </span>
                                <span class="logo-lg text-white">
                                    <!-- <img src="assets/images/logo-dark.png" alt="" height="19"> -->
                                    <img src="assets/images/logo-sm-dark(3rd copy).png" alt="" height="19"> <b> OREBANK</b>
                                </span>
                            </a>

                            <a href="index.php" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm-light.png" alt="" height="22">
                                </span>
                                <span class="logo-lg text-white">
                                    <!-- <img src="assets/images/logo-light.png" alt="" height="19"> -->
                                    <img src="assets/images/welcome-to-smartbank.png" alt="" height="50"> <b> OREBANK</b>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm mr-2 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="" src="assets/images/flags/french.jpg"alt="Header Language" height="14">
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
                                <span class="d-none d-sm-inline-block ml-1"><?php echo $row_customer['full_name'] ?></span>
                                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a class="dropdown-item" href="profile.php"><i class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="http://localhost/online-banking/site/dist/auth_login.php"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i>Se deconnecter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="topnav">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">
                                        <i class="mdi mdi-storefront mr-2"></i>Transactions
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="quick_transfer.php">
                                        <i class="mdi mdi-bank-transfer mr-2"></i>Transfert rapide
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="inbox.php">
                                        <i class="mdi mdi mdi-email-send-outline mr-2"></i>Demander de virement
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="profile.php">
                                        <i class="mdi mdi mdi mdi mdi-human-greeting  mr-2"></i>Profile
                                    </a>
                                </li>

                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="cheque_book.php">
                                        <i class="mdi mdi mdi mdi mdi-book-open mr-2"></i>Request Cheque Book
                                    </a>
                                </li> -->

                                <li class="nav-item">
                                    <a class="nav-link" href="feedback.php">
                                        <i class="mdi mdi mdi mdi-heart-outline mr-2"></i>Avis
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="FAQs.php">
                                        <i class="mdi mdi-book-open-variant mr-2"></i>FAQs
                                    </a>
                                </li>

                                

                                <!-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-advancedui" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-package-variant-closed mr-2"></i>Advanced UI <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-advancedui">
                                        <a href="advanced-alertify.html" class="dropdown-item">Alertify</a>
                                        <a href="advanced-rating.html" class="dropdown-item">Rating</a>
                                        <a href="advanced-nestable.html" class="dropdown-item">Nestable</a>
                                        <a href="advanced-rangeslider.html" class="dropdown-item">Range Slider</a>
                                        <a href="advanced-sweet-alert.html" class="dropdown-item">Sweet-Alert</a>
                                        <a href="advanced-lightbox.html" class="dropdown-item">Lightbox</a>
                                        <a href="advanced-maps.html" class="dropdown-item">Maps</a>
                                    </div>
                                </li> -->

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

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
                                    <h4 class="mb-0 font-size-18">Transactions<br></h4>
            
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item">Banque nette<br></li>
                                            <li class="breadcrumb-item active">Transactions<br></li>
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
                                                <h5 class="font-size-14">Nombre de Transactions<br></h5>
                                            </div>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-box"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h4 class="m-0 align-self-center"><?php echo $no_of_transaction?></h4>
                                        
                                        <p class="mb-0 mt-3 text-muted"><span class="text-dark"> <?php echo $no_of_transaction_of_this_month; ?> </span> Transactions ce mois-ci</p>
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14">Montant total du crédit<br></h5>
                                            </div>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-briefcase"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h4 class="m-0 align-self-center">MGA <?php echo $credit_sum ?></h4>
                                          <p class="mb-0 mt-3 text-muted"><span class="text-success">MGA <?php echo $credit_sum_of_this_month ?> <i class="mdi mdi-trending-up mr-1"></i></span> Ce mois-ci</p>
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14">Montant total debité<br></h5>
                                            </div>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-tags"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h4 class="m-0 align-self-center">MGA <?php echo $debit_sum ?></h4>
                                        <p class="mb-0 mt-3 text-muted"><span class="text-danger">MGA <?php echo $debit_sum_of_this_month ?> <i class="mdi mdi-trending-up mr-1"></i></span> Ce mois-ci</p>
                                    </div>
                                </div>
                            </div>
            
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14">Solde actuel<br></h5>
                                                </div>
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="dripicons-cart"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <h4 class="m-0 align-self-center">MGA <?php echo $account_bal ?></h4>
                                        <?php 
                                            $result_of_this_month = $credit_sum_of_this_month - $debit_sum_of_this_month;
                                            if ($result_of_this_month < 0)
                                            {
                                                $echo_result_of_this_month =  '<p class="mb-0 mt-3 text-muted"><span class="text-danger">MGA '.$result_of_this_month.' <i class="mdi mdi-trending-up mr-1"></i></span> Ce mois-ci</p>';
                                            }
                                            else
                                            {
                                                $echo_result_of_this_month =  '<p class="mb-0 mt-3 text-muted"><span class="text-success">MGA '.$result_of_this_month.' <i class="mdi mdi-trending-up mr-1"></i></span> Ce mois-ci</p>';
                                            }

                                            echo $echo_result_of_this_month;
                                        ?>
                                        
                                    </div>
                                </div>
            
                            </div>
                        </div>
                        <div class="row"><br></div>
                        <!-- end row -->
                        <?php            

                        

                        // echo "<table>"; // start a table tag in the HTML
                        // // For transactions in Home Page(index page)
                        // $query_for_transactions = "SELECT * FROM tbl_transaction where account_no = $Account_no ORDER BY trans_date DESC ";
                        // $transaction_result = mysqli_query($con,$query_for_transactions);

                        // while($row = mysqli_fetch_array($transaction_result)) {
                        // $to_account_no = $row['to_account'];
                        // $query_for_ben_name = "SELECT full_name FROM tbl_customer WHERE account_no=$to_account_no";
                        // $result_ben_name = mysqli_query($con, $query_for_ben_name);
                        // $ben_name = mysqli_fetch_array($result_ben_name)[0];

                        // echo "<tr><td>" . $row['trans_id'] . "</td><td>" .$ben_name . "</td><td>" . $row['trans_date'] . "</td><td>" . $row['purpose'] ."</td><td>" . $row['trans_type'] . "</td><td>" .  $row['amount'] . "</td><td>" . $row['account_bal'] . "</td></tr>";  //$row['index'] the index here is a field name
                        // }

                        // echo "</table>"; //Close the table in HTML
                   
                        
                        // $result = mysql_query('SELECT SUM(value) AS value_sum FROM codes'); 
                        // $row = mysql_fetch_assoc($result); 
                        // $sum = $row['value_sum'];
                    
                        
                        ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-4">Dernières transactions</h4>
            
                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style="width: 50px;">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="customCheckall">
                                                                <label class="custom-control-label" for="customCheckall"></label>
                                                            </div>
                                                        </th>
                                                        <th scope="col" style="width: 60px;"><br></th>
                                                        <th scope="col">ID Transaction &amp; Nom</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col"><br></th>
                                                        <th scope="col">Motif</th>
                                                        <th scope="col">Type de Transaction<br></th>
                                                        <th scope="col">Montant</th>
                                                        <th scope="col">Solde<br></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                               
                                                <?php
                                                    // For transactions in Home Page(index page)
                                                    $query_for_transactions = "SELECT * FROM tbl_transaction where account_no = $Account_no ORDER BY trans_date DESC ";
                                                    $transaction_result = mysqli_query($con,$query_for_transactions);
                                                    $no_of_transaction = mysqli_num_rows($transaction_result);

                                                    while($row = mysqli_fetch_array($transaction_result)) {
                                                        $to_account_no = $row['to_account'];
                                                        $query_for_ben_name = "SELECT full_name FROM tbl_customer WHERE account_no=$to_account_no";
                                                        $result_ben_name = mysqli_query($con, $query_for_ben_name);
                                                        $ben_name = mysqli_fetch_array($result_ben_name)[0];
                                                   if($row["trans_type"] == "DEBIT") {
                                                        $trans_light = '<i class="mdi mdi-checkbox-blank-circle text-danger mr-1"></i>';
                                                   }
                                                   else {
                                                        $trans_light = '<i class="mdi mdi-checkbox-blank-circle text-success mr-1"></i>';

                                                   }
                                                       echo 
                                                       '<tr>
                                                            <td>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="customCheck1">
                                                                    <label class="custom-control-label" for="customCheck1"></label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                        '.$ben_name[0].'
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p class="mb-1 font-size-12"># '.$row["trans_id"].'</p>
                                                                <h5 class="font-size-15 mb-0">'.$ben_name.' </h5>
                                                            </td>
                                                            <td>'.$row["trans_date"].'</td>
                                                            <td><br></td>
                                                            <td>'.$row["purpose"].'<br></td>
                                                            
                                                            <td>'.$trans_light.'
                                                            '.$row["trans_type"].'</td>
                                                            <td>MGA '.$row["amount"].'</td>
                                                            <td>MGA '.$row["account_bal"].'<br></td>
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
                    </div>
                </div><br>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
    
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom rightbar-nav-tab nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link py-3 active" data-toggle="tab" href="#chat-tab" role="tab">
                            <i class="mdi mdi-message-text font-size-22"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-3" data-toggle="tab" href="#tasks-tab" role="tab">
                            <i class="mdi mdi-format-list-checkbox font-size-22"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-3" data-toggle="tab" href="#settings-tab" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <i class="mdi mdi-settings font-size-22"></i>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <div class="tab-pane active" id="chat-tab" role="tabpanel">
                
                        <form class="search-bar py-4 px-3">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="mdi mdi-magnify"></span>
                            </div>
                        </form>

                        <h6 class="font-weight-medium px-4 mt-2 text-uppercase">Groupe de discussion</h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-success"></i>
                                <span class="mb-0 mt-1">Développement</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-warning"></i>
                                <span class="mb-0 mt-1">Travail de bureau</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-danger"></i>
                                <span class="mb-0 mt-1">Groupe personnel</span>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item pl-3 d-block">
                                <i class="mdi mdi-checkbox-blank-circle-outline mr-1"></i>
                                <span class="mb-0 mt-1">Freelance</span>
                            </a>
                        </div>

                        <h6 class="font-weight-medium px-4 mt-4 text-uppercase">Favoris</h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-10.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Andrew Mackie</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Rory Dalyell</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">To an English person, it will seem like simplified</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-9.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status busy"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Jaxon Dunhill</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">To achieve this, it would be necessary.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <h6 class="font-weight-medium px-4 mt-4 text-uppercase">Autres discussions</h6>

                        <div class="p-2 pb-4">
                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-2.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Jackson Therry</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">Everyone realizes why a new common language.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-4.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Charles Deakin</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">The languages only differ in their grammar.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-5.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Ryan Salting</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">If several languages coalesce the grammar of the resulting.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-6.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status online"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Sean Howse</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-7.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status busy"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Dean Coward</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">The new common language will be more simple.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset notification-item">
                                <div class="media">
                                    <div class="position-relative mr-3">
                                        <img src="assets/images/users/avatar-8.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                        <i class="mdi mdi-circle user-status away"></i>
                                    </div>
                                    <div class="media-body overflow-hidden">
                                        <h6 class="mt-0 mb-1">Hayley East</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-0 text-truncate">One could refuse to pay expensive translators.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>

                    <div class="tab-pane" id="tasks-tab" role="tabpanel">
                        <h6 class="font-weight-medium px-3 mb-0 mt-4">Tâche en cours</h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-3">
                                <p class="text-muted mb-0">Développement<span class="float-right">75%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-3">
                                <p class="text-muted mb-0">Reparation de base de données<span class="float-right">37%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-3">
                                <p class="text-muted mb-0">Création d'une sauvegarde<span class="float-right">52%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>
                        </div>

                        <h6 class="font-weight-medium px-3 mb-0 mt-4">Tâche à venir</h6>

                        <div class="p-2">
                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-3">
                                <p class="text-muted mb-0">Rapport de vente<span class="float-right">12%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                            <a href="javascript: void(0);" class="text-reset item-hovered d-block p-3">
                                <p class="text-muted mb-0">Redesign du site web<span class="float-right">67%</span></p>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </a>

                        </div>

                        <div class="p-3 mt-2">
                            <a href="javascript: void(0);" class="btn btn-success btn-block waves-effect waves-light">Crée une tâche</a>
                        </div>

                    </div>
                    <div class="tab-pane" id="settings-tab" role="tabpanel">
                            <h6 class="font-weight-medium px-4 py-3 text-uppercase bg-light">Paramètre général</h6>

                        <div class="p-4">
                            <h6 class="font-weight-medium">Statut en ligne</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="settings-check1" name="settings-check1" checked="">
                                <label class="custom-control-label font-weight-normal" for="settings-check1">Afficher votre statut à tous</label>
                            </div>

                            <h6 class="font-weight-medium mt-4">Mise à jours auto</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="settings-check2" name="settings-check2" checked="">
                                <label class="custom-control-label font-weight-normal" for="settings-check2">Rester à jour</label>
                            </div>

                            <h6 class="font-weight-medium mt-4">Configuration de sauveguarde</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="settings-check3" name="settings-check3">
                                <label class="custom-control-label font-weight-normal" for="settings-check3">Sauvegarde auto</label>
                            </div>

                        </div>

                        <h6 class="font-weight-medium px-4 py-3 mt-2 text-uppercase bg-light">Paramètre avancé</h6>

                        <div class="p-4">
                            <h6 class="font-weight-medium">Alerte de l'application</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="settings-check4" name="settings-check4" checked="">
                                <label class="custom-control-label font-weight-normal" for="settings-check4">Notifications par e-mail</label>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="settings-check5" name="settings-check5">
                                <label class="custom-control-label font-weight-normal" for="settings-check5">Notifications par sms</label>
                            </div>

                            <h6 class="font-weight-medium mt-4">API</h6>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="settings-check6" name="settings-check6">
                                <label class="custom-control-label font-weight-normal" for="settings-check6">Autoriser l'accès</label>
                            </div>

                        </div>
                    </div>
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

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
