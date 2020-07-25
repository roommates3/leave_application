<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['add']))
{
$sid=$_POST['stfcode'];
$name=$_POST['name'];
$gender=$_POST['gender'];
$address=$_POST['address'];
$pin=$_POST['pin'];
$mobileno=$_POST['mobileno'];
$quarterno=$_POST['quarterno'];
$doj=$_POST['doj'];
$designation=$_POST['designation'];
$department=$_POST['department']; 
$gmailid=$_POST['gmail']; 
$password=md5($_POST['password']);


$sql=<<<EOF
INSERT INTO staff(sid, name, gender, permanent_address, quarter_no, doj, designation, did, gmailid, password, phoneno,pin) VALUES($sid,'$name','$gender','$address', '$quarterno','$doj','$designation','$department','$gmailid','$password','$mobileno','$pin');
EOF;
$query=pg_query($sql);
if(pg_num_rows($query)>0)
{
$msg="Employee record added Successfully";
}
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Add Staff</title>
        
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
<script type="text/javascript">
function valid()
{
if(document.addstaff.password.value!= document.addstaff.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.addstaff.confirmpassword.focus();
return false;
}
return true;
}
</script>

<script>
function checkAvailabilitystfid() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'stfcode='+$("#stfcode").val(),
type: "POST",
success:function(data){
$("#stfid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

<script>
function checkAvailabilityEmailid() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'gmailid='+$("#gmailid").val(),
type: "POST",
success:function(data){
$("#emailid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>



    </head>
    <body>
  <?php include('includes/header.php');?>
            
       <?php include('includes/sidebar.php');?>
   <main class="mn-inner">
    <div class="row">
    <div class="col s12">
                        <div class="page-title">Add staff</div>
                    </div>
    </div>
                <div class="row">
                    
                    <div class="col">
                        <div class="card rounded-lg">
                            <div class="card-content">
                                <form id="example-form" method="post" name="addstf">
                                    <div>
                                        <h3>Staff Info</h3>
                                        <section>
                                            <div class="wizard-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
     <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo $error; ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo $msg; ?> </div><?php }?>


 <div class="input-field col-12">
<label for="stfcode">Staff Code(Must be unique)</label>
<input  name="stfcode" id="stfcode" onBlur="checkAvailabilitystfid()" type="text" autocomplete="off" required>
<span id="stfid-availability" style="font-size:12px;"></span> 
</div>

<div class="input-field col-12 col-md-6">
<label for="name">Full name</label>
<input id="name" name="name" type="text" required>
</div>

<div class="input-field col-12">
<label for="gmailid">Email</label>
<input  name="gmailid" type="email" id="gmailid" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" onBlur="checkAvailabilityEmailid()" autocomplete="off" required>
<span id="emailid-availability" style="font-size:12px;"></span> 
</div>

<div class="input-field col-12">
<label for="password">Password</label>
<input id="password" name="password" pattern=".{6,}" type="password" autocomplete="off" required>
</div>

<div class="input-field col-12">
<label for="confirm">Confirm password</label>
<input id="confirm" name="confirmpassword" pattern=".{6,}" type="password" autocomplete="off" required>
</div>
</div>
</div>
                                                    
<div class="col-md-6">
<div class="row">
<div class="input-field col-12 col-md-6">
<select  name="gender" autocomplete="off">
<option value="">Gender...</option>                                          
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Other">Other</option>
</select>
</div>

<div class="input-field col-12 col-md-6">
<label for="doj">Date of join</label>
<input id="doj" name="doj" type="date" class="datepicker" autocomplete="off" >
</div>

                                                    

<div class="input-field col-12 col-md-6">
<select  name="department" autocomplete="off">
<option value="">Department...</option>
<?php 
$sql =<<<EOF
SELECT did,deptname from department;
EOF;
$query=pg_query($sql);
$results=pg_fetch_all($query);
$cnt=1;
if(pg_num_rows($query)>0)
{
  while($row_list=pg_fetch_array($query))
{   ?>                                            
<option value="<?php echo $row_list['did'];?>"><?php echo $row_list['deptname'];?></option>
<?php }} ?>
</select>
</div>

<div class="input-field col-12 col-md-6">
<label for="address">Address</label>
<input id="address" name="address" type="text" autocomplete="off" required>
</div>

<div class="input-field col-12 col-md-3">
<label for="address">Pin</label>
<input id="address" name="pin" pattern="^[1-9][0-9]{5}$" type="text" autocomplete="off" required>
</div>

<div class="input-field col-12 col-md-6">
<label for="quarterno">Quarter Number</label>
<input id="quarterno" name="quarterno" type="text" autocomplete="off" required>
 </div>
   
<div class="input-field col-12 col-md-6">
<label for="designation">Designation</label>
<input id="designation" name="designation" type="text" autocomplete="off" required>
</div>

                                                            
<div class="input-field col-12">
<label for="phone">Mobile number</label>
<input id="phone" name="mobileno" type="tel" maxlength="10" autocomplete="off" required>
 </div>

                                                        
<div class="input-field col s12">
<button type="submit" name="add" onclick="return valid();" id="add" class="waves-effect waves-light btn red m-b-xs rounded-pill">ADD</button>

</div>

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