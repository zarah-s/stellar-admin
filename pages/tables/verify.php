<?php
session_start();

  include("../../includes/db_conn.php");

  if(!$_SESSION['admin']){
    header("Location:../samples/login.php");
  
  }
  if(isset($_POST['search'])){
    $inp = $_POST['matric'];
    $query = mysqli_query($conn,"SELECT * FROM users WHERE matricNo = '$inp'");
    if(mysqli_num_rows($query) < 1){
      exit("nah");
    }else{
      header("Location:verify.php?matric=$inp");
    }
  }


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Stellar Admin</title>
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
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex align-items-center">
          <a class="navbar-brand brand-logo" href="../../index.html">
            <!-- <img src="../../images/logo.svg" alt="logo" class="logo-dark" /> -->
            <h2 class="text-white">Safest</h2>

          </a>
          <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
          <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome student verification software</h5>
          <ul class="navbar-nav navbar-nav-right ml-auto">
           
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle ml-2" src="../../images/faces/admin.jpg" alt="Profile image"> <span class="font-weight-normal"> Admin </span></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-sm rounded-circle" src="../../images/faces/admin.jpg" alt="Profile image">
                  <p class="mb-1 mt-3">Allen Moreno</p>
                  <p class="font-weight-light text-muted mb-0">allenmoreno@gmail.com</p>
                </div>
                <a class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
              
                <a href="../samples/logout.php" class="dropdown-item"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
          
            <li class="nav-item nav-category">
              <span class="nav-link">Dashboard</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../index.php">
                <span class="menu-title">Dashboard</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>

              <a class="nav-link" href="../samples/register.php">
                <span class="menu-title">Capture student</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
              
              <a class="nav-link" href="./users.php">
                <span class="menu-title">Registered students</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
              <a class="nav-link" href="./verify.php">
                <span class="menu-title">Verify Student</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
            </li>

          
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
           
            <div class="row">
             
             
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   <form method="post">
                     <div class="form-group">
                       <input type="text"
                         class="form-control" name="matric" id="" aria-describedby="helpId" placeholder="search student" >
                     </div>
                     <div class="form-group">
                       <input type="submit"
                         class="btn btn-primary" name="search" value="search">
                     </div>
                   </form>
                   <?php

                        if(isset($_GET['matric'])){
                          $no = $_GET['matric'];

                          $query = mysqli_query($conn,"SELECT * FROM users WHERE matricNo = '$no'");
                          while($row = mysqli_fetch_assoc($query)){
                            $img = $row['passport'];
                            $name = $row['firstName'];
                            $matricNo = $row['matricNo'];
                            $level = $row['level'];
                            $lastName = $row['lastName'];
                            $payed = $row['payed'];


                            $payed == "true" ? $payed = "yes" : $payed ="no";

                            echo '<div class="card " style="width:18rem;margin:0 auto;"> 
                            <img src="../../'.$img.'" alt="" class="card-img-top">
                            
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item"><a class="font-weight-bold">FirstName:</a> '.$name.'</li>
                              <li class="list-group-item"><a class="font-weight-bold">Last Name:</a> '.$lastName.'</li>
                              <li class="list-group-item"><a class="font-weight-bold"> MatricNo:</a> '.$matricNo.'</li>
                              <li class="list-group-item"><a class="font-weight-bold"> Level: </a>'.$level.'</li>
                              <li class="list-group-item"><a class="font-weight-bold"> Payed:</a> '.$payed.'</li>
                            </ul>
                          </div>';
                          }
                        }

                  ?>
                   
                  </div>
                </div>
              </div>
 
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Lucky All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="icon-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
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
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>