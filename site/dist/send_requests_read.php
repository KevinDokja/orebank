<script type="text/javascript">
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

</script>
<?php
    include('connect.php');
    session_start();
    
    function sendMoneyFunc()
    {
         
      header("Location: http://www.google.com/");
   
    }

    
    if(isset($_SESSION["s_account_no"]) && isset($_SESSION['s_login']))
    {
        $Account_no = $_SESSION["s_account_no"];
        // For Getting Customer Details
        $query_customer = "SELECT * FROM tbl_customer WHERE account_no='$Account_no'";
        $result_customer = mysqli_query($con, $query_customer);
        $row_customer = mysqli_fetch_array($result_customer);

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
            header('location: inbox.php');
        }
    } else {
        header("location:http://localhost/online-banking/site/dist/auth_login.php");
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Demande envoyée lue</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Summernote css -->
        <link href="assets/libs/summernote/summernote-bs4.css" rel="stylesheet" type="text/css" />

        <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

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
                                    <h4 class="mb-0 font-size-18">Demande de virement</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Banque nette</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Demandes envoyées</a></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <!-- end page title -->

                        <div class="row mb-4">
                            <div class="col-xl-3">
                                <div class="card h-100">
                                    <div class="card-body email-leftbar">
                                        <a href="request_money.php" class="btn btn-danger btn-block btn-rounded waves-effect waves-light"><i class="mdi mdi-plus mr-1"></i> Nouvelle demande</a>

                                        <div class="mail-list mt-4">
                                            <?php
                                                $query_for_no_of_requests = "SELECT * FROM tbl_requests where to_account = $Account_no";
                                                $no_of_requests_result = mysqli_query($con,$query_for_no_of_requests);
                                                $no_of_requests = mysqli_num_rows($no_of_requests_result);
                                            ?>
                                            <a href="inbox.php"><i class="mdi mdi-inbox mr-2"></i>Boîte de réception  <span class="ml-1 float-right">(<?php echo $no_of_requests; ?>)</span></a>
                                            <a href="send_requests.php" class="active"><i class="mdi mdi-send-check-outline mr-2"></i>Demandes envoyées</a>
                                            
                                        </div>

                                        <div>
                                            <h6 class="mt-4">Etiquettes</h6>
        
                                            <div class="mail-list mt-1">
                                                <a href="#"><span class="mdi mdi-circle-outline mr-2 text-info"></span>Support de thème</a>
                                                <a href="#"><span class="mdi mdi-circle-outline mr-2 text-warning"></span>Freelance</a>
                                                <a href="#"><span class="mdi mdi-circle-outline mr-2 text-primary"></span>Sociale</a>
                                                <a href="#"><span class="mdi mdi-circle-outline mr-2 text-danger"></span>Amis</a>
                                                <a href="#"><span class="mdi mdi-circle-outline mr-2 text-success"></span>Famille</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-9">
                                
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
                                            
                                            
                                            </div>
                                            
                                                <div class="btn-toolbar justify-content-md-end" role="toolbar">
                                            <div class="btn-group ml-md-2 mb-3">
                                                
                                            </div>

                                            
                                            
                                            
                                    </div>
                                </div>
                                <!-- end card -->

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

        <!-- Sweet Alerts js -->
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <!-- Sweet alert init js-->
        <script src="assets/js/pages/sweet-alerts.init.js"></script>

        <!-- Summernote js -->
        <script src="assets/libs/summernote/summernote-bs4.min.js"></script>

        <!-- email summernote init -->
        <script src="assets/js/pages/email-summernote.init.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>
<?php
    if(isset($_REQUEST['btn_send_money']))
    {
        $request_id = intval($_GET['request_id']);
        $request_details = mysqli_query($con,"SELECT * FROM tbl_requests WHERE request_id=$request_id");
        $row_request = mysqli_fetch_array($request_details);
        $sender_account_no = $row_request['account_no'];

        $query_for_sender_details = "SELECT * FROM tbl_customer WHERE account_no = $sender_account_no";
        $result_sender_details = mysqli_query($con,$query_for_sender_details);
        $row_sender = mysqli_fetch_array($result_sender_details);

        // Check if Balance is Sufficient or not
        $query_for_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$Account_no";
        $result = mysqli_query($con, $query_for_Account_bal) or die('SQL Error :: '.mysqli_error());
        $row = mysqli_fetch_assoc($result);

        $Acount_bal = $row['balance'];
        $Amount = $row_request['amount'];
        $To_account = $row_sender['account_no'];


        if ($Amount > $Acount_bal)
        {
            echo "Solde insuffisant";
        }
        else
        {
            // 1. Reduce amount in login in customer
            $Acount_bal = $Acount_bal - $Amount;
            $query_for_update_from_Account_bal = "UPDATE tbl_balance SET balance=$Acount_bal WHERE  account_no=$Account_no";
            $result = mysqli_query($con, $query_for_update_from_Account_bal) or die('SQL Error ::   '.mysqli_error());



            // 2. add amount in to_account customer
            $query_for_Ben_Account_bal = "SELECT balance FROM tbl_balance WHERE account_no=$To_account";
            $result = mysqli_query($con, $query_for_Ben_Account_bal) or die('SQL Error :: '.mysqli_error());
            $row = mysqli_fetch_assoc($result);
            $Acount_bal = $row['balance'];
            $Amount = $Amount;

            $Account_bal = $Acount_bal + $Amount;
            $query_for_update_Ben_Account_bal = "UPDATE tbl_balance SET balance=$Account_bal WHERE  account_no=$To_account";
            $result = mysqli_query($con, $query_for_update_Ben_Account_bal) or die('SQL Error ::    '.mysqli_error());



            $Trans_date = date("Y-m-d H:i:s");
            $Amount = $Amount;
            $Trans_type = "DEBIT";
            $Purpose = "Demande";
            $To_account = $sender_account_no;

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
                // Set Status to Sent
                $query_for_update_status = "UPDATE tbl_requests SET status = 'sent' WHERE request_id=$request_id";
                $result_of_update = mysqli_query($con, $query_for_update_status) or die('SQL Error :: '.mysqli_error());
                echo '<script type="text/JavaScript">  
                sweetAlertSuccess();
                </script>' 
                ;
            }
            else
            {
              print($result);
            
              echo "ERROR: impossible d'éxecuter $query. " . mysqli_error($con);
            }
        }
    }
?>