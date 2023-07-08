<?php
session_start();
include("../../includes/db_conn.php");
include("../../includes/sanitize_data.php");

if(isset($_POST['signUp'])){
 

  $matricNo = sanitize_data($_POST['matricNo']);
 
  $password = sanitize_data($_POST['password']);
 

 $query = mysqli_query($conn,"SELECT * FROM users WHERE matricNo = '$matricNo' OR userName = '$matricNo'");
 if(mysqli_num_rows($query) < 1){
   exit("user not found");
 }else{
   while($row = mysqli_fetch_assoc($query)){
     $reg_pass = $row['password'];
   }
   $check_pass = password_verify($password,$reg_pass);
   if(!$check_pass){
    exit("error");
   }else{
    if($matricNo == 'admin'){
      $_SESSION['admin'] = TRUE;
    }
     header("location:../../index.php");
   }
 }


}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lucky Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../css/style.css" <!-- End layout styles -->
    <link rel="shortcut icon" href="../../images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="../../images/logo.svg">
                </div>
                <h4>Safest</h4>
                <!-- <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6> -->
                <form class="pt-3" method="post" enctype="multipart/form-data">
                 
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="matricNo" id="exampleInputUsername1" placeholder="User Name">
                  </div>
                 

                 
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password">
                  </div>
                 
                
                  <div class="mt-3">
                    <button type="submit" name="signUp" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >SIGN IN</button>
                  </div>
                  <!-- <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login.html" class="text-primary">Login</a> -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>