<?php
session_start();

include("../../includes/db_conn.php");
include("../../includes/sanitize_data.php");

if(isset($_POST['signUp'])){
  $dir = "../../uploads/";
  $firstName = sanitize_data($_POST['firstName']);
  $lastName = sanitize_data($_POST['lastName']);
  $userName = $_POST['userName'];
  $email = $_POST['email'];
  $phoneNo = sanitize_data($_POST['phoneNo']);
  $matricNo = sanitize_data($_POST['matricNo']);
  $gender = $_POST['gender'];
  $password = sanitize_data($_POST['password']);
  $level = sanitize_data($_POST['level']);
  $passportName = $_FILES['passport']['name'];
  $passportLocation = $_FILES['passport']['tmp_name'];

  $fileName = $dir.$passportName;
  $file = "uploads/".$passportName;

 $sql = mysqli_query($conn,"SELECT * FROM users WHERE matricNo = '$matricNo'");
 if(mysqli_num_rows($sql) > 0){
  exit("user exists!!!!!!!!!!!");
 }else{
  if(move_uploaded_file($passportLocation,$fileName)){
    $hashed_password = password_hash($password,PASSWORD_DEFAULT);
   $query = mysqli_query($conn,"INSERT INTO users (firstName,lastName,userName,email,gender,level,matricNo,phoneNo,passport,password) VALUES('$firstName','$lastName','$userName','$email','$gender','$level','$matricNo','$phoneNo','$file','$hashed_password')");
   if(!$query){
     exit("nah");
   }else{
    $last_id = mysqli_insert_id($conn);
    $_SESSION['author_id'] = $last_id;
    header("location:pay.php");
   }
   
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
    <title>Safest</title>
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
                <h4> CSC Department</h4>
                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                <form class="pt-3" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="firstName" id="exampleInputUsername1" placeholder="firstName" required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="lastName" id="exampleInputUsername1" placeholder="lastName" required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="phoneNo" id="exampleInputUsername1" placeholder="Phone No" required>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="matricNo" id="exampleInputUsername1" placeholder="matric No" required>
                  </div>
                 
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="userName" id="exampleInputUsername1" placeholder="userName" required>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" name="email" id="email-address" placeholder="Email" required>
                  </div>

                  <div class="form-group">
                  <select name="level" class="form-control form-control-lg" id="exampleFormControlSelect2" required>
                      <option value="">Level</option>
                      <option value="100">100</option>
                      <option value="200">200</option>
                      <option value="300">300</option>
                      <option value="400">400</option>
                      <option value="500">900</option>
                    </select>
                  </div>

                 
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                    <input type="radio" value="female" name="gender" required> Female
                    <input type="radio" value="male" name="gender" required> Male
                  </div>
                  <div class="form-group">
                   <input type="file" name="passport" id="" required>
                  </div>
                  <div class="mb-4">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions </label>
                    </div>
                  </div>
                  <div class="mt-3">
                    <button type="submit" name="signUp" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >SIGN UP</button>
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