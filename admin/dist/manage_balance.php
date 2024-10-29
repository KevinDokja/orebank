
<script type="text/javascript">
  function alertifyPromptAdd(account_no)
  {
    function changeUrl(amount,operationType)
    {
        var url = new URL(window.location.href);
        var query_string = window.location.href;
        var search_params = new URLSearchParams(); 
        search_params.append('operationType',operationType);
        search_params.append('account_id', account_no);
        search_params.append('amount',amount);
        url.search = search_params.toString();
        var new_url = url.toString();
        window.location.href = new_url;
    };
    var amount = 0
    alertify.prompt(
        "Ajouter de l'argent",
        "1000",
        function(e, r) {
            alertify.success("Ajouté : " + r);
            changeUrl(r,"credit");
        },
        
        function() {
          alertify.error("Annuler");
        },
      );
      
      
  }

  function alertifyPromptReduce(account_no)
  {
    function changeUrl(amount,operationType)
    {
        var url = new URL(window.location.href);
        var query_string = window.location.href;
        var search_params = new URLSearchParams(); 
        search_params.append('operationType',operationType);
        search_params.append('account_id', account_no);
        search_params.append('amount',amount);
        url.search = search_params.toString();
        var new_url = url.toString();
        window.location.href = new_url;
    };
    alertify.prompt(
        "Retirer de l'argent",
        "1000",
        function(e, r) {
          alertify.success("Reduit : " + r);
          changeUrl(r,"debit");

        },
        function() {
          alertify.error("Annuler");
        }
      );
  }

  function sweetAlertSuccess()
  {
    Swal.fire({
      position: "top-end",
      icon: "success",
      title: "Montant transferé avec succès",
      showConfirmButton: !1,
      timer: 1500
    }); 
  }
  function notEnoughBal()
  {
    Swal.fire({
      title: "Operation Echouée",
      text: "Solde insuffisant !",
      icon: "error"
    });
  }
  
</script>
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

        // Start manage balance
        
        if(isset($_GET['operationType']))
        {
            $manage_account_no = $_GET['account_id'];
            $manage_amount = $_GET['amount'];
            $manage_oprationType = $_GET['operationType'];
            // Opeartion Credit
            if($manage_oprationType == "credit")
            {
                
                $Account_no = 338509629;
                        $query_for_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$Account_no";
                $result = mysqli_query($con, $query_for_Account_bal) or die('SQL Error :: '.mysqli_error());
                $row = mysqli_fetch_assoc($result);

                $Acount_bal = $row['balance'];
                $Amount = $manage_amount;
                $To_account = $manage_account_no;


                // if Account_bal is not Sufficient then Run This block Of code That disply You have not Sufficient bal or ben_account_no == logged_in usee then        Display You can not set    Your Account Number
                // else Run  Below Code
                if ($Amount > $Acount_bal)
                {
                    echo "Votre solde est insuffisant pour cette opération";
                }
                else
                {
                
                    // 1. Reduce amount in Admin in customer
                    $Acount_bal = $Acount_bal - $Amount;
                    $query_for_update_from_Account_bal = "UPDATE tbl_balance SET balance=$Acount_bal WHERE account_no=$Account_no";
                    $result = mysqli_query($con, $query_for_update_from_Account_bal) or die('SQL Error ::   '.mysqli_error());
                
                
                
                    // 2. add amount in to_account customer
                    $To_account = $manage_account_no;
                    $query_for_Ben_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$To_account";
                    $result = mysqli_query($con, $query_for_Ben_Account_bal) or die('SQL Error :: '.mysqli_error());
                    $row = mysqli_fetch_assoc($result);
                    $Acount_bal = $row['balance'];
                
                    $Account_bal = $Acount_bal + $Amount;
                    $query_for_update_Ben_Account_bal = "UPDATE tbl_balance SET balance=$Account_bal WHERE  account_no=$To_account";
                    $result = mysqli_query($con, $query_for_update_Ben_Account_bal) or die('SQL Error ::    '.mysqli_error());
                
                
                
                    $Trans_date = date("Y-m-d H:i:s");
                    $Trans_type = "DEBIT";
                    $Purpose = "Operation effectuée par la banque";
                    $To_account = $manage_account_no;
                
                
                    $query_for_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$Account_no";
                    $result = mysqli_query($con, $query_for_Account_bal) or die('SQL Error :: '.mysqli_error());
                    $row = mysqli_fetch_assoc($result);
                    $Acount_bal = $row['balance'];
                
                    // 3. insert transaction debit record for logged_in user in tbl_transaction
                    $query_debit_record = "INSERT INTO tbl_transaction (trans_date,amount,trans_type,purpose,   to_account,account_no,account_bal) 
                    VALUES ('$Trans_date', $Amount, '$Trans_type', '$Purpose', $To_account, $Account_no,    $Acount_bal)";
                    $result = mysqli_query($con, $query_debit_record) or die('SQL Error :: '.mysqli_error());
                
                
                    $Trans_type = "CREDIT";
                    $query_for_Ben_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$To_account";
                    $result = mysqli_query($con, $query_for_Ben_Account_bal) or die('SQL Error :: '.mysqli_error());
                    $row = mysqli_fetch_assoc($result);
                    $Acount_bal = $row['balance'];
                
                    // 4. insert transaction credit record for to_account user in tbl_transaction
                    $query_credit_record = "INSERT INTO tbl_transaction (trans_date,amount,trans_type,purpose,  to_account,account_no,account_bal) 
                    VALUES ('$Trans_date', $Amount, '$Trans_type', '$Purpose', $Account_no, $To_account,    $Acount_bal)";
                    $result = mysqli_query($con, $query_credit_record) or die('SQL Error :: '.mysqli_error());
                
                
                    if ($result)
                    {
                      echo '<script type="text/JavaScript">  
                      sweetAlertSuccess();
                     </script>' 
                      ;
                    }
                }
            
            }
        
        if($manage_oprationType == "debit")
        {
            $Account_no = $manage_account_no;
            $query_for_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$Account_no";
            $result = mysqli_query($con, $query_for_Account_bal) or die('SQL Error :: '.mysqli_error());
            $row = mysqli_fetch_assoc($result);
            $Acount_bal = $row['balance'];
            $Amount = $manage_amount;
            $To_account = 338509629;
            // if Account_bal is not Sufficient then Run This block Of code That disply You have not Sufficient bal or ben_account_no == logged_inusee then        Display You can not set    Your Account Number
            // else Run  Below Code
            if ($Amount > $Acount_bal)
            {
                echo '<script type="text/JavaScript">  
              notEnoughBal();
             </script>' 
              ;
            }
            else
            {
            
                // 1. Reduce amount in Customer Account
                $Acount_bal = $Acount_bal - $Amount;
                $query_for_update_from_Account_bal = "UPDATE tbl_balance SET balance=$Acount_bal WHERE account_no=$Account_no";
                $result = mysqli_query($con, $query_for_update_from_Account_bal) or die('SQL Error ::   '.mysqli_error());
            
            
            
                // 2. add amount in Admin account
                $query_for_Ben_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$To_account";
                $result = mysqli_query($con, $query_for_Ben_Account_bal) or die('SQL Error :: '.mysqli_error());
                $row = mysqli_fetch_assoc($result);
                $Acount_bal = $row['balance'];
            
                $Account_bal = $Acount_bal + $Amount;
                $query_for_update_Ben_Account_bal = "UPDATE tbl_balance SET balance=$Account_bal WHERE  account_no=$To_account";
                $result = mysqli_query($con, $query_for_update_Ben_Account_bal) or die('SQL Error ::    '.mysqli_error());
            
            
            
                $Trans_date = date("Y-m-d H:i:s");
                $Trans_type = "DEBIT";
                $Purpose = "Operation efféctuée par la banque";
            
                // $query_for_Account_no = "SELECT account_no FROM tbl_customer WHERE username='$Username'";
                // $result = mysqli_query($con, $query_for_Account_no) or die('SQL Error :: '.mysqli_error());
                // $row = mysqli_fetch_assoc($result);
                // $Account_no = $row['account_no'];
            
                $query_for_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$Account_no";
                $result = mysqli_query($con, $query_for_Account_bal) or die('SQL Error :: '.mysqli_error());
                $row = mysqli_fetch_assoc($result);
                $Acount_bal = $row['balance'];
            
                // 3. insert transaction debit record for logged_in user in tbl_transaction
                $query_debit_record = "INSERT INTO tbl_transaction (trans_date,amount,trans_type,purpose,   to_account,account_no,account_bal) 
                VALUES ('$Trans_date', $Amount, '$Trans_type', '$Purpose', $To_account, $Account_no,    $Acount_bal)";
                $result = mysqli_query($con, $query_debit_record) or die('SQL Error :: '.mysqli_error());
            
            
                $Trans_type = "CREDIT";
                $query_for_Ben_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$To_account";
                $result = mysqli_query($con, $query_for_Ben_Account_bal) or die('SQL Error :: '.mysqli_error());
                $row = mysqli_fetch_assoc($result);
                $Acount_bal = $row['balance'];
            
                // 4. insert transaction credit record for to_account user in tbl_transaction
                $query_credit_record = "INSERT INTO tbl_transaction (trans_date,amount,trans_type,purpose,  to_account,account_no,account_bal) 
                VALUES ('$Trans_date', $Amount, '$Trans_type', '$Purpose', $Account_no, $To_account,    $Acount_bal)";
                $result = mysqli_query($con, $query_credit_record) or die('SQL Error :: '.mysqli_error());
            
            
                if ($result)
                {
                  echo '<script type="text/JavaScript">  
                  sweetAlertSuccess();
                 </script>' 
                  ;
                }
            }
        }
        }
    } else {
        header("location:http://localhost/online-banking/admin/dist/auth-login.php");
    }


?>


<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Gestion des soldes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- slick css -->
        <link href="assets/libs/slick-slider/slick/slick.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/slick-slider/slick/slick-theme.css" rel="stylesheet" type="text/css" />

        <!-- alertifyjs Css -->
        <link href="assets/libs/alertifyjs/build/css/alertify.min.css" rel="stylesheet" type="text/css" />

        <!-- alertifyjs default themes  Css -->
        <link href="assets/libs/alertifyjs/build/css/themes/default.min.css" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

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
                                        <h4 class="m-0 align-self-center"><?php echo $total_bank_balance ?></h4>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                        <!-- end row -->
                        

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-4">Soldes actuel des clients</h4>

                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"  style="width: 60px;"></th>
                                                        <th scope="col">N° compte & Nom</th>
                                                        <th scope="col">Sexe</th>
                                                        <th scope="col">Type de compte</th>
                                                        <th scope="col">Solde</th>
                                                        <th></th>
                                                        <th scope="col">Ajouter ou Reduire de l'argent</th>

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
                                                        if ($account_no == 338509629)
                                                        {
                                                            $AddReduceBtn = '';
                                                        }
                                                        else
                                                        {
                                                            $AddReduceBtn = '<button type="button" name="btn_add" onclick="alertifyPromptAdd('.$account_no.');" class="btn btn-outline-success btn-sm">Ajouter</button>
                                                            <button type="button" onclick="alertifyPromptReduce('.$account_no.');" class="btn btn-outline-danger btn-sm">Reduire</button>
                                                            <div class="col-sm-4">';
                                                        }
                                                       echo 
                                                       '<tr>
                                                            <td>
                                                                <div class="avatar-xs">
                                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                        '.$row["full_name"][0].'
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p class="mb-1 font-size-12"># '.$row["account_no"].'</p>
                                                                <h5 class="font-size-15 mb-0">'.$row["full_name"].' </h5>
                                                            </td>
                                                            <td>'.$row["gender"].'<br></td>
                                                            <td> '.$account_type.'</td>
                                                            <td>MGA '.$account_bal.'<br></td>
                                                            <td></td>
                                                            <td>
                                                            '.$AddReduceBtn.'
                                                
                                            </div>
                                                        </td>

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

        <!-- alertifyjs js -->
        <script src="assets/libs/alertifyjs/build/alertify.min.js"></script>

        <script src="assets/js/pages/alertifyjs.init.js"></script>

        <!-- Sweet Alerts js -->
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <!-- Sweet alert init js-->
        <script src="assets/js/pages/sweet-alerts.init.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>
