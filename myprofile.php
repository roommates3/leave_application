<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['stflogin'])==0)
    {   
header('location:index.php');
}
else{
$stfid=$_SESSION['stflogin'];

$sql1=$_SESSION['stflogin'];
$stmt=<<<EOF
select designation from staff where gmailid='$sql1';
EOF;
$query1=pg_query($stmt);
// echo pg_num_rows($query1);
if(isset($_POST['update']))
{

$name=$_POST['name'];  
$gender=$_POST['gender']; 
$doj=$_POST['doj']; 
$department=$_POST['department']; 
$address=$_POST['address'];
$pin=$_POST['pin'];
$quarterno=$_POST['quarterno'];
$designation=$_POST['designation'];
$mobileno=$_POST['mobileno'];

$sql0=<<<EOF
update staff set name='$name',Gender='$gender',did='$department',designation='$designation',doj='$doj',quarter_no='$quarterno',permanent_address='$address',phoneno='$mobileno',pin='$pin' where gmailid='$stfid';
EOF;
$query0 = pg_query($sql0);
if(pg_affected_rows($query0) > 0)
{
    $msg="Staff record updated Successfully";

}
else {
    $error="Staff record updating error | Error ";    
}
}?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Update Staff</title>
        
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

    <?php   while ($row=pg_fetch_array($query1))
{ ?>
    <?php if($row['designation'] == 'Director')
    {?>
    <?php include('includes/stf-header.php');?>

        <?php include('includes/stfsidebar.php');?>
    <?php }else if($row['designation'] == 'HOD')
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
                        <div class="page-title">Update staff</div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <form id="example-form" method="post" name="updatstf">
                                    <div>
                                        <h3>Update staff Info</h3>
                                           <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo $error; ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo $msg; ?> </div><?php }?>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
<?php 
$stfid=$_SESSION['stflogin'];
$sql =<<<EOF
SELECT sid,name,gmailid,phoneno,doj,gender,designation,
quarter_no,permanent_address,pin,deptname,staff.did as staffdid from staff join department on staff.did=department.did where gmailid='$stfid';
EOF;
$query=pg_query($sql);
$cnt=1;
if(pg_num_rows($query)> 0)
{
while($row_list=pg_fetch_array($query))
{   ?>

 <div class="input-field col-12">
<label for="stfcode">Staff Code</label>
<input  name="stfcode" id="stfcode" value="<?php echo $row_list['sid'];?>" type="text" autocomplete="off" readonly required>
<span id="sid-availability" style="font-size:12px;"></span> 
</div>


<div class="input-field col-12">
<label for="name">Full name</label>
<input id="name" name="name" value="<?php echo $row_list['name'];?>"  type="text" required>
</div>


<div class="input-field col-12">
<label for="email">Email</label>
<input  name="email" type="email" id="email" value="<?php echo $row_list['gmailid'];?>" readonly autocomplete="off" required>
<span id="emailid-availability" style="font-size:12px;"></span> 
</div>

<div class="input-field col-12">
<label for="phone">Mobile number</label>
<input id="phone" name="mobileno" type="tel" value="<?php echo $row_list['phoneno'];?>" maxlength="10" autocomplete="off" required>
 </div>

</div>
</div>
                                                    
<div class="col-md-6">
<div class="row">
<div class="input-field col-12 col-md-6">
<select  name="gender" autocomplete="off">
<option value="<?php echo $row_list['gender'];?>"><?php echo $row_list['gender'];?></option>                                          
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Other">Other</option>
</select>

</div>

<div class="input-field col-12 col-md-6">
<label for="joindate">Date of Join</label>
<input id="joindate" name="doj"  class="datepicker" value="<?php echo $row_list['doj'];?>" readonly >
</div>

                                                    

<div class="input-field col-12 col-md-6">
<select  name="department" autocomplete="off">
<option value="<?php echo $row_list['staffdid'];?>"><?php echo $row_list['deptname'];?></option>
<?php 
$sql =<<<EOF
SELECT did,deptname from department;
EOF;
$query=pg_query($sql);
$cnt=1;
if(pg_num_rows($query)> 0)
{
while($row_lists=pg_fetch_array($query))
{   ?>                                            
<option value="<?php echo $row_lists['did'];?>"><?php echo $row_lists['deptname'];?></option>
<?php }} ?>
</select>
</div>
<div class="input-field col-12 col-md-6">
<label for="quarterno">Quarter Number</label>
<input id="quarterno" name="quarterno" value="<?php echo $row_list['quarter_no'];?>" type="text" autocomplete="off" required>
 </div>
   
<div class="input-field col-12 col-md-6">
<label for="designation">Designation</label>
<input id="designation" name="designation"  value="<?php echo $row_list['designation'];?>" type="text" autocomplete="off" required>
</div>


<div class="input-field col-12 col-md-6">
<label for="address">Address</label>
<input id="address" name="address"  value="<?php echo $row_list['permanent_address'];?>"  type="text"  autocomplete="off" required>
</div>

<div class="input-field col-12 col-md-6">
<label for="address">Pin</label>
<input id="address" name="pin"  value="<?php echo $row_list['pin'];?>"  type="text"  autocomplete="off" required>
</div>

                                                            

<?php }}?>
                                                        
<div class="input-field col-12">
<button type="submit" name="update"  id="update" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>

</div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/form_elements.js"></script>
        
    </body>
</html>
<?php } } ?> 