<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['update']))
{
$eid=intval($_GET['stfid']);
$sname=$_POST['name'];
$gender=$_POST['gender']; 
$doj=$_POST['doj']; 
$desig=$_POST['designation'];
$address=$_POST['address'];
$pin =$_POST['pincode'];
$mobileno=$_POST['mobileno'];

$sql=<<<EOF
update staff set name='$sname',Gender='$gender',Doj='$doj',permanent_address='$address',Pin='$pin',designation='$desig',Phoneno='$mobileno' where id='$eid';
EOF;
$query=pg_query($sql);

$msg="Staff record updated Successfully";
}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Update staff</title>
        
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
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
       <?php 
$eid=intval($_GET['stfid']);
$sql =<<<EOF
SELECT * from staff where id='$eid';
EOF;
$query=pg_query($sql);
$cnt=1;
if(pg_num_rows($query) > 0)
{
while($row_lists=pg_fetch_array($query))
{               ?> 
   <main class="mn-inner">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title">Update staff</div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="updatstf">
                                    <div>
                                        <h3>Update Staff Info</h3>
                                           <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo $error; ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo $msg; ?> </div><?php }?>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">

<div class="input-field col-12">
<label for="stfcode">Staff Code(Must be unique)</label>
<input  name="stfcode" id="stfcode" value="<?php echo $row_lists['sid'];?>" type="text" autocomplete="off" readonly required>
<span id="stfid-availability" style="font-size:12px;"></span> 
</div>


<div class="input-field col-12">
<label for="name">Full name</label>
<input id="name" name="name" value="<?php echo $row_lists['name'];?>"  type="text" required>
</div>


<div class="input-field col-12">
<label for="email">Email</label>
<input  name="email" type="email" id="email" value="<?php echo $row_lists['gmailid'];?>" readonly autocomplete="off" required>
<span id="emailid-availability" style="font-size:12px;"></span> 
</div>

<div class="input-field col-12">
<label for="phone">Mobile number</label>
<input id="phone" name="mobileno" type="tel" value="<?php echo $row_lists['phoneno'];?>" maxlength="10" autocomplete="off" required>
 </div>

</div>
</div>

<div class="col col-md-6">
<div class="row">
<div class="input-field col-12 col-md-6">
<select  name="gender" autocomplete="off" >
<option value="<?php echo $row_lists['gender'];?>"><?php echo $row_lists['gender'];?></option>                                          
<option value="Male" >Male</option>
<option value="Female" >Female</option>
<option value="Other" >Other</option>
</select>
</div>

<div class="input-field col-12 col-md-6">
<label for="joindate">Date of Join</label>
<input id="joindate" name="doj"  class="datepicker" value="<?php echo $row_lists['doj'];?>" >
</div>

   
<div class="input-field col-12 col-md-12">
<label for="designation">Designation</label>
<input id="designation" name="designation" type="text" value="<?php echo $row_lists['designation'];?>" autocomplete="off" required>
</div>

<div class="input-field col-12 col-md-12">
<label for="address">Address</label>
<input id="address" name="address" type="text"  value="<?php echo $row_lists['permanent_address'];?>" autocomplete="off" required>
</div>
                                                            
<div class="input-field col-12 col-md-12">
<label for="address">Pin</label>
<input id="address" name="pincode" type="text"  value="<?php echo $row_lists['pin'];?>" autocomplete="off" required>
</div>

                                                        
<div class="input-field col-12">
<button type="submit" name="update"  id="update" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>

</div>
<?php }}?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                     
                                    
                                        </section>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/form_elements.js"></script>
        
    </body>
</html>
<?php } ?> 