<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['stflogin'])==0)
    {   
header('location:index.php');
}
else{
$sql1=$_SESSION['stflogin'];
$stmt=<<<EOF
select designation from staff where gmailid='$sql1';
EOF;
$query1=pg_query($stmt);
// Code for change password 
if(isset($_POST['change']))
    {
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$username=$_SESSION['stflogin'];
$sql =<<<EOF
SELECT Password FROM staff WHERE gmailId='$username' and Password='$password';
EOF;
$query=pg_query($sql);
$result=pg_fetch_array($query);

if(pg_num_rows($query) > 0)
{
$con=<<<EOF
update staff set Password='$newpassword' where gmailid='$username';
EOF;
$changepwd=pg_query($con);

$msg="Your Password succesfully changed";
}
else {
$error="Your current password is wrong";    
}
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Staff | Change Password</title>
        
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
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/stfcustom.css" rel="stylesheet" type="text/css"/>
        <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body>


<?php 

while ($row=pg_fetch_array($query1))
{
<<<<<<< HEAD
    if($row['designation'] == 'Director' or $row['designation'] == 'HOD')
=======
    if($row['designation'] == 'Director')
    {?>
    <?php include('includes/stf-header.php');?>

        <?php include('includes/stfsidebar.php');?>
    <?php }else if($row['designation'] == 'HOD')
>>>>>>> b4c87c9406a37295a4e102f5585a364e11daf598
    {?>
    <?php include('includes/hodheader.php');?>

        <?php include('includes/stfsidebar.php');?>
    <?php }else{ ?>
        <?php include('includes/header.php');?>

        <?php include('includes/sidebar.php');?>
    <?php } ?>
  
  
            <main class="mn-inner">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title">Change Password</div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-content">
                              
                                <div class="row">
                                    <form class="col-12" name="chngpwd" method="post">
                                          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                        <div class="row">
                                            <div class="input-field col-12">
<input id="password" type="password"  class="validate" autocomplete="off" name="password"  required>
                                                <label for="password" style="margin-left:-90%;">Current Password</label>
                                            </div>

  <div class="input-field col-12">
 <input id="password" type="password" name="newpassword" class="validate" autocomplete="off" required>
                                                <label for="password" style="margin-left:-90%;">New Password</label>
                                            </div>

<div class="input-field col-12">
<input id="password" type="password" name="confirmpassword" class="validate" autocomplete="off" required>
 <label for="password" style="margin-left:-90%;">Confirm Password</label>
</div>


<div class="input-field col-12">
<button type="submit" name="change" class="waves-effect waves-light btn indigo m-b-xs" onclick="return valid();">Change</button>

</div>




                                        </div>
                                       
                                    </form>
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
        <script src="assets/js/pages/form_elements.js"></script>
        
    </body>
</html>
<?php }} ?> 