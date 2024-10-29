<script type="text/javascript">
  function alertifySuccess()
  {
    alertify.alert("Info", "Compte créé avec succès!", function() {
      window.location = 'http://localhost/online-banking/site/dist/auth_login.php';
      alertify.success("Ok");

    });
    return false;
  }
</script>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>S'enregister</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      content="Premium Multipurpose Admin & Dashboard Template"
      name="description"
    />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

   <!-- alertifyjs Css -->
    <link href="assets/libs/alertifyjs/build/css/alertify.min.css" rel="stylesheet" type="text/css" />

    <!-- alertifyjs default themes  Css -->
    <link href="assets/libs/alertifyjs/build/css/themes/default.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link
      href="assets/css/bootstrap.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
  </head>

  <body class="bg-primary bg-pattern">
    <div class="account-pages pt-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center">
              <div clas="row">
                  <img src="assets/images/orebank.png" alt="logo" height="40">
              </div>
              <h5 class="font-size-16 text-white-50 mb-4">
                La banque à portée de main , simplifiez votre vie financère
              </h5>
            </div>
          </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-4">S'enregistrer</h5>
                                        <form class="needs-validation" novalidate>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                <label for="validationTooltip01">Nom</label>
                                                <input type="text" name="txt_fname" class="form-control" id="validationTooltip01" placeholder="Nom" value="" required>
                                                <div class="valid-feedback">
                                                    Parfait!
                                                </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                <label for="validationTooltip02">Prénoms</label>
                                                <input type="text" name="txt_lname" class="form-control" id="validationTooltip02" placeholder="Prénoms" value="" required>
                                                <div class="valid-feedback">
                                                    Parfait!
                                                </div>
                                                </div>
                                                
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                <h5 class="font-size-14 mb-3">Sexe</h5>
                                                    
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" name="txt_gender" value="H" id="custominlineRadio1" name="custominlineRadio" class="custom-control-input" checked>
                                                        <label class="custom-control-label" for="custominlineRadio1">Homme</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" name="txt_gender" value="F" id="custominlineRadio2" name="custominlineRadio" class="custom-control-input">
                                                        <label class="custom-control-label" for="custominlineRadio2">Femme</label>
                                                    </div>
                                                </div>
                                            <div class="col-md-4 mb-3">
                                             <div class="form-group mb-4">
                                                <label>Date de naissance</label>
                                                <div class="input-group">
                                                    <input type="text" name="txt_bdate" class="form-control" placeholder="mm/jj/aaa" data-provide="datepicker" data-date-autoclose="true">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                    </div>
                                                </div><!-- input-group -->
                                            </div>
                                            </div>
                                               
                                               
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                <label for="validationTooltip01">Téléphone</label>
                                                <input type="text" name="txt_mobile" class="form-control" id="validationTooltip01" placeholder="Numéro de téléphone" value="" required>
                                                <div class="valid-feedback">
                                                    Parfait!
                                                </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                <label for="validationTooltip02">Email</label>
                                                <input type="email" name="txt_email" class="form-control" id="validationTooltip02" placeholder="Adresse e-mail" value="" required>
                                                <div class="valid-feedback">
                                                    Parfait!
                                                </div>
                                                </div>
                                                
                                            </div>


                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                <label for="validationTooltip03">Addresse</label>
                                                <input type="text" name="txt_address" class="form-control" id="validationTooltip03" placeholder="Addresse" required>
                                                <div class="invalid-feedback">
                                                    Veillez entrer une addresse valide.
                                                </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                <label for="validationTooltip03">Ville</label>
                                                <input type="text" name="txt_city" class="form-control" id="validationTooltip03" placeholder="Ville" required>
                                                <div class="invalid-feedback">
                                                    Veillez entrer une ville valide.
                                                </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                <label for="validationTooltip04">État</label>
                                                <input type="text" name="txt_state" class="form-control" id="validationTooltip04" placeholder="État" required>
                                                <div class="invalid-feedback">
                                                    Veillez entrer une état valide.
                                                </div>
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                <label for="validationTooltip04">BP</label>
                                                <input type="text" name="txt_zip" class="form-control" id="validationTooltip04" placeholder="BP" required>
                                                <div class="invalid-feedback">
                                                    Veillez entrer une BP valide.
                                                </div>
                                                </div>
                                            </div>
                                              <div class="row">
                                                <div class="col-md-4 mb-3">
                                                <label for="validationTooltipUsername">Nom utilisateur</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                                    </div>
                                                    <input type="text" name="txt_username" class="form-control" id="validationTooltipUsername" placeholder="Nom utilisateur" aria-describedby="validationTooltipUsernamePrepend" required>
                                                    <div class="invalid-feedback">
                                                    Veillez entrer un nom utilisateur unique.
                                                    </div>
                                                </div>
                                                </div>
                                            
                                                <div class="col-md-4 mb-3">
                                                  <label>Mot de passe</label>
                                                    <input type="password" name="txt_password" id="pass2" class="form-control" required
                                                            placeholder="Mot de passe"/>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                  <label>Confirmation Mot de passe</label>

                                                    <input type="password" name="txt_repassword" class="form-control" required
                                                            data-parsley-equalto="#pass2"
                                                            placeholder="Confirmez mot de passe"/>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-md-4 mb-3">
                                                      <label>Type de compte</label>
                                                      <select name="txt_account_type" class="custom-select" required>
                                                          <option value="">SELECTIONNEZ VOTRE TYPE DE COMPTE</option>
                                                          <option value="EPARGNE">EPARGNE</option>
                                                          <option value="COURANT">COURANT</option>
                                                      </select>
                                                      <div class="invalid-feedback">select account type</div>
                                                </div>
                                              </div>
                                              
                                            <div class="row">
                                                <div class="custom-control custom-checkbox col-md-4 m-3">
                                                    <input type="checkbox" class="custom-control-input" id="term-conditionCheck" checked>
                                                    <label class="custom-control-label font-weight-normal" for="term-conditionCheck">J'accepte <a href="#" class="text-primary">Terms and Conditions</a></label>
                                                </div>
                                            </div>

                                            <button class="btn btn-success btn-block waves-effect waves-light" name="btnSubmit" type="submit">S'enregistrer</button>
                                            <div class="mt-4 text-center">
                                                    <a href="auth_login.php" class="text-muted"><i class="mdi mdi-account-circle mr-1"></i>J'ai déjà un compte</a>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


   
      </div>
    </div>
    <!-- end Account pages -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

            <!-- validation init -->
        <script src="assets/js/pages/form-validation.init.js"></script>

 <!-- alertifyjs js -->
    <script src="assets/libs/alertifyjs/build/alertify.min.js"></script>
    <script src="assets/js/pages/alertifyjs.init.js"></script>

  <!-- Showing Admin ID in alert after switch to Admin login page-->
    <!-- <script>
      $("#add").submit(function() {
  alertify.alert("Alert Title", "Alert Message!", function() {
    alertify.success("Ok");
    window.location = '/auth-login.php';
  });
  return false;
});

    </script> -->
    

    <script src="assets/js/app.js"></script>
  </body>
</html>



<?php

  include('connect.php');

  if(isset($_REQUEST['btnSubmit']))
  {
    $first_name = $_REQUEST['txt_fname'];
    $last_name = $_REQUEST['txt_lname'];
    $full_name = $first_name . " " . $last_name;

    $gender = $_REQUEST['txt_gender'];
    $birth_date = $_REQUEST['txt_bdate'];
    $birth_date = date("Y-m-d", strtotime($birth_date) );

    $mobile = $_REQUEST['txt_mobile'];
    $email = $_REQUEST['txt_email'];
    $address = $_REQUEST['txt_address'];
    $city = $_REQUEST['txt_city'];
    $state = $_REQUEST['txt_state'];
    $zip = $_REQUEST['txt_zip'];
    $username = $_REQUEST['txt_username'];
    $password = $_REQUEST['txt_password'];

    $account_type = $_REQUEST['txt_account_type'];

    
    // Query for inesrt record in tbl_account
    $query = "INSERT INTO tbl_account (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($con, $query) or die('SQL Error :: '.mysqli_error($con));
    
    if ($result)
    {
      // get account_no from username
      $query_account_no = "SELECT account_no FROM tbl_account WHERE username='$username'";
      $result_account_no = mysqli_query($con, $query_account_no);
      $account_no = mysqli_fetch_array($result_account_no)[0];  // ! [0] for the first value of array
      
      // query for insert record in tbl_customer
      $query_for_tbl_customer = "INSERT INTO tbl_customer (account_no, full_name, gender, birth_date, mobile, email) VALUES ($account_no,'$full_name', '$gender', '$birth_date','$mobile', '$email')";
      
      $result = mysqli_query($con, $query_for_tbl_customer) or die('SQL Error :: '.mysqli_error($con));

      // insert record in tbl_address
      $query_for_tbl_address = "INSERT INTO tbl_address (account_no, home_address, city, state, pincode) VALUES ($account_no,'$address','$city','$state',$zip)";

      $result = mysqli_query($con, $query_for_tbl_address) or die('SQL Error :: '.mysqli_error($con));

      
      
      // Query for tbl_account_type
      $query_for_account_type = "INSERT INTO tbl_account_type (account_no,account_type) VALUES ($account_no, '$account_type')";
      $result_of_account_type = mysqli_query($con, $query_for_account_type) or die('SQL Error :: '.mysqli_error($con));

      // Query for tbl_account_bal
      $query_for_account_bal = "INSERT INTO tbl_balance (account_no,account_type,balance) VALUES ($account_no, '$account_type',0)";
      $result_of_account_bal = mysqli_query($con, $query_for_account_bal) or die('SQL Error :: '.mysqli_error($con));

      // After Successfully insert all records show alert Dialog Box that Register Successfully
      if ($result)
      {
        echo '<script type="text/JavaScript">  
        alertifySuccess();
       </script>' 
        ;
        

      }
      else
      {
        print($result);

        echo "ERROR: Could not able to execute $query. " . mysqli_error($con);
      }
      
    } else {
      // todo : Show error -> username already exist
      print("username already Exist");
    }
     
  }
?>