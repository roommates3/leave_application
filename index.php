
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['signin']))
{
$uname=$_POST['gmailid'];
$password=md5($_POST['password']);
$sql =<<< EOF
SELECT gmailid,Password,designation,sid from staff WHERE gmailid='$uname' and Password='$password';
EOF;

$query = pg_query($sql);
$result=pg_fetch_all($query);
$row=pg_fetch_array($query);
$_SESSION['sid']=$row['sid'];
if($result)
{
        $_SESSION['stflogin']=$_POST['gmailid'];
        echo "welcome";
        if ($row['designation']=='HOD'){
            echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
        }
        else if ($row['designation']=='Director'){
            echo "<script type='text/javascript'> document.location = 'stf-dashboard.php'; </script>";
        }
        else {
            echo "<script type='text/javascript'> document.location = 'leavehistory.php'; </script>";
        }
} 
else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?><!DOCTYPE html>
<html lang="en">
    <head>

        <!-- Title -->
        <title>Leave Management | Home Page</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/af78f6c7a9.js" crossorigin="anonymous"></script>
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">


        <!-- Theme Styles -->
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/stfcustom.css" rel="stylesheet" type="text/css"/>


    </head>
<?php 
$stmt=<<<EOF
select deptshortname from staff cross join department where staff.did=department.did and gmailid='$uname';
EOF;
$query1=pg_query($stmt);
$row1=pg_fetch_array($query1);
$_SESSION['dept']=$row1;
?>


    <body>
        <div class="loader-bg"></div>
        <div class="loader">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-spinner-teal lighten-1">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mn-content fixed-sidebar">
            <header class="mn-header navbar-fixed">
                <nav class="indigo darken-1">
                    <div class="nav-wrapper row">
                        <section class="material-design-hamburger navigation-toggle">
                            <a href="#" data-activates="slide-out" class="button-collapse show-on-large material-design-hamburger__icon">
                                <span class="material-design-hamburger__layer"></span>
                            </a>
                        </section>
                        <div class="header-title col s3">
                            <span class="chapter-title">Staff Leave Management System</span>
                        </div>


                        </form>


                    </div>
                </nav>
            </header>


            <aside id="slide-out" class="side-nav white fixed">
                <div class="side-nav-wrapper bg-dark">


                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion" style="">
                    <li>&nbsp;</li>
                    <li class="no-padding"><a class="waves-effect waves-grey text-white" href="index.php"><i class="fas fa-portrait    "></i>Staff Login</a></li>
                    <li class="no-padding"><a class="waves-effect waves-grey text-white" href="forgot-password.php"><i class="fas fa-portrait    "></i>Staff Password Recovery</a></li>

                       <li class="no-padding"><a class="waves-effect waves-grey text-white" href="admin/"><i class="fas fa-portrait    "></i>Admin Login</a></li>

                </ul>
                </div>
            </aside>
<<<<<<< HEAD
            <main class="mn-inner">
            <div class="card-title text-center text-capitalize"><h4>WELCOME TO STAFF LEAVE MANAGEMENT SYSTEM</h4></div>

                <div class="row w-75">
                        <div class="col-12">
                            <div class="card white darken-1">
                                <div class="card-content ">
                                    <div class="row p-0">
                                        <div class="col-12 col-md-6 p-0">
                                            <img src="assets/images/admin.jpg" class="img-fluid rounded-lg" alt="">
                                        </div>
                                        <div class="col-12 col-md-6 my-auto">
                                            <span class="text-center pl-2" style="font-size:20px;">Staff Login</span>
                                            <?php if($msg){?><div class="errorWrap"><strong>Error</strong> : <?php echo $msg; ?> </div><?php }?>
                                            <form name="signin" method="post">
                                                <div class="input-field col s12">
                                                    <input id="username" type="text" name="gmailid" class="validate" autocomplete="off" required >
                                                    <label for="email">Email Id</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input id="password" type="password" class="validate" name="password" autocomplete="off" required>
                                                    <label for="password">Password</label>
                                                </div>
                                                <div class="col s12 center-align m-t-sm">

=======
            <main class="mn-inner pt-0">
            <div class="card-title text-center"><h4>WELCOME TO STAFF LEAVE MANAGEMENT SYSTEM</h4></div>

                <div class="row sign-in-form">
                        <div class="col-12">
                            <div class="card white darken-1">
                                <div class="card-content ">
                                    <div class="row mb-0">
                                        <div class="col-12 col-md-5 p-0 card-img-new">
                                            <img src="assets/images/admin.jpg" class="img-fluid" style="" alt="">
                                        </div>
                                        <div class="col-12 col-md-7 my-auto">
                                            <div class="text-center pb-3 pt-2" style="font-size:20px;">STAFF LOGIN</div>
                                            <?php if($msg){?><div class="errorWrap"><strong>Error</strong> : <?php echo $msg; ?> </div><?php }?>
                                            <form name="signin" method="post">
                                                <div class="input-field col-12">
                                                    <input id="username" type="text" name="gmailid" class="validate rounded-pill border border-primary pl-4" autocomplete="off" required >
                                                    <label for="email" class="pl-4 pb-2">Email Id</label>
                                                </div>
                                                <div class="input-field col-12">
                                                    <input id="password" type="password" class="validate rounded-pill border border-primary pl-4" name="password" autocomplete="off" required>
                                                    <label for="password" class="pl-4 pb-2">Password</label>
                                                </div>
                                                <div class="col-12 center-align m-t-sm">
>>>>>>> b4c87c9406a37295a4e102f5585a364e11daf598
                                                    <input type="submit" name="signin" value="Sign in" class="waves-effect waves-light btn indigo rounded-pill">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
</div>
                    </div>
                </div>
            </main>

        </div>
        <div class="left-sidebar-hover"></div>

        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>

    </body>
</html>

