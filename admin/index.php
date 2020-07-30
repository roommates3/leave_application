<?php
session_start();
include('includes/config.php');
if(isset($_POST['signin']))
{
$uname=$_POST['username'];

$password=md5($_POST['password']);
$sql =<<< EOF
SELECT UserName,Password from admin WHERE UserName='$uname' and Password='$password';
EOF;

$query = pg_query($sql)or die(pg_last_error());
$result=pg_fetch_all($query);

if($result)
{
$_SESSION['alogin']=$_POST['username'];
echo "welcome";
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";} 
else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Leave management system |  Admin</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        
        
        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/af78f6c7a9.js" crossorigin="anonymous"></script>
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">        
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
    </head>
    <!-- <body class="signin-page">

        <div class="mn-content valign-wrapper">

            <main class="mn-inner container">
            <h4 align="center"><a href="../index.php">Leave Management System | Admin Login</a></h4>
                <div class="valign">
                      <div class="row">

                          <div class="col s12 m6 l4 offset-l4 offset-m3">
                              <div class="card white darken-1">
                                  <div class="card-content ">
                                      <span class="card-title">Sign In</span>
                                       <div class="row">
                                           <form class="col s12" name="signin" method="post">
                                               <div class="input-field col s12">
                                                   <input id="username" type="text" name="username" class="validate" autocomplete="off" required >
                                                   <label for="email">Username</label>
                                               </div>
                                               <div class="input-field col s12">
                                                   <input id="password" type="password" class="validate" name="password" autocomplete="off" required>
                                                   <label for="password">Password</label>
                                               </div>
                                               <div class="col s12 right-align m-t-sm">
                                                
                                                   <input type="submit" name="signin" value="Sign in" class="waves-effect waves-light btn teal">
                                               </div>
                                           </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                </div>
            </main>
        </div> -->
        <body>
        <div class="container">
        <div class="row text-center">
            <div class="col">
            <h3 class="text-capitalize text-dark"><a href="../index.php" >Leave Management System | Admin Login</a></h3>
            </div>
            </div>
        </div>
        <div class="container w-75 ">
                    <!-- <main class="mn-inner container"> -->
            
                      <div class="row shadow-lg rounded bg-white p-4" style="border-radius:15px !important;">
                            <div class="col-4 p-0">
                            <img src="../assets/images/admin.jpg" alt="" class="img-fluid admin-img rounded" style="border-radius:15px !important;">
                            </div>
                          <div class="col my-auto">
                              <div class="card" style="height:100%; box-shadow: none; border:none;">
                                  <div class="card-content ">
                                      <span class="card-title text-center"><h1>Sign In</h1></span>
                                       <div class="row">
                                           <form class="col-12" name="signin" method="post">
                                               <div class="input-field col-12">
                                                   <input id="username" type="text" name="username" class="validate pl-4 border border-primary rounded-pill" autocomplete="off" required >
                                                   <label for="email" class="pl-4 pb-2">Username</label>
                                               </div>
                                               <div class="input-field col-12">
                                                   <input id="password" type="password" class="validate pl-4 border border-primary rounded-pill " name="password" autocomplete="off" required>
                                                   <label for="password" class="pl-4 pb-2" >Password</label>
                                               </div>
                                               <div class="col-12 text-center m-t-sm">
                                                
                                                   <input type="submit" name="signin" value="Sign in" class="waves-effect waves-light btn indigo rounded-pill">
                                               </div>
                                           </form>
                                           <div class="col-12 text-center m-t-sm">
                                                    <a href="../index.php"><button class="btn bg-white text-dark rounded-pill" style="border:1px solid #3f51b5 ;">Staff Login</button></a>
                                               </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                </div>
            <!-- </main> -->
        </div>
        <!-- Javascripts -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        
    </body>
</html>