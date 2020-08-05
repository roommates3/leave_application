<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['stflogin'])==0)
    {   
header('location:index.php');
}
else{

if(isset($_POST['apply']))
{
$sid=$_SESSION['sid'];
$leavetype=$_POST['leavetype'];
$fromdate=$_POST['fromdate'];  
$todate=$_POST['todate'];
$description=$_POST['description'];  
$status=0;
$sqlmain=<<<EOF
select designation from staff where sid=$sid;
EOF;
$querymain= pg_query($sqlmain);
$rowmain=pg_fetch_array($querymain);
$des=$rowmain['designation'];
if($des=='HOD'){
$isread=1;
$fwdstatus=1;
}else{
$isread=0;
$fwdstatus=0;
}
$noofdays=$_POST['nod'];
$prefromdate=$_POST['pfromdate'];
$pretodate=$_POST['ptodate'];

$suffromdate=$_POST['sfromdate'];
$suftodate=$_POST['stodate'];
$prenoofdays=$_POST['pnod'];
$sufnoofdays=$_POST['snod'];
$position=$_POST['yposition'];
$classesmissed=$_POST['noc'];
$alt_arrangement=$_POST['alterarr'];
$stleave=$_POST['stno'];



//leave application inserting into the leave table 
if($fromdate > $todate){
                $error=" ToDate should be greater than FromDate ";
           }
$sql2=<<<EOF
INSERT INTO leavetable (LeaveType,ToDate,FromDate,Description,Status,IsRead,sid,
noofdays, prefromdate, pretodate, suffromdate, suftodate, prenoofdays, sufnoofdays, position,
classesmissed, alt_arrangement,stationleave,fwdstatus) VALUES('$leavetype','$fromdate','$todate','$description','$status',
'$isread','$sid','$noofdays','$prefromdate','$pretodate','$suffromdate','$suftodate','$prenoofdays','$sufnoofdays',
'$position','$classesmissed','$alt_arrangement','$stleave','$fwdstatus');
EOF;
$query2 =pg_query($sql2);
$lastInsertId = pg_num_rows($query2);

$msg="Leave applied successfully";

$cl=0;
$scl=0;
$ml=0;
$el=0;

$sql3=<<<EOF
insert into leavetrack (cl,scl,ml,sid,el)( select '$cl','$scl','$ml','$sid','$el' where not exists ( select '$sid' from leavetrack where sid='$sid'));
EOF;
$query3=pg_query($sql3);
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Staff | Apply Leave</title>
        
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

body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 0px; /* Location of the box */
  left: 0;
  top: 0;
  border: 1px solid red;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  margin-bottom: 0px;
  margin-top: 50px;
  /* display: block; */
  max-height: 100%;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  /* margin-left: 300px; */
  padding: 0;
  /* border: 1px solid #888; */
  width: 100%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s;
  border: 1px solid black;
  /* box-sizing: border; */
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #999999 ;
  color: white;
}

.modal-body {padding: 2px 16px;}

#mybtn{
    background-color: green;
}

        </style>
 


    </head>

    <?php 
$id=$_SESSION['stflogin'];
$stmt=<<<EOF
SELECT sid,name,gmailid,phoneno,doj,gender,designation,
quarter_no,permanent_address,pin,deptname from staff join department on staff.did=department.did where gmailid='$id';
EOF;

$query11=pg_query($stmt);
if (pg_num_rows($query11)>0)
{
    while($row=pg_fetch_array($query11))
    {   $dep=$row['deptname'];
        $phn=$row['phoneno'];
        $pincode=$row['pin'];
        $add=$row['permanent_address'];
        ?>

    <body>
 
    <?php if($row['designation'] == 'Director' or $row['designation'] == 'HOD')
    {?>
    <?php include('includes/header.php');?>

        <?php include('includes/stfsidebar.php');?>
    <?php }else{ ?>
        <?php include('includes/header.php');?>

        <?php include('includes/sidebar.php');?>
    <?php } ?>

       
   <main class="mn-inner">
                <div class="row row-card">
                    <div class="col-12">
                        <div class="page-title">Apply for Leave</div>
                    </div>
                    <div class="col-12 rf1">
                        <div class="card1">
                            <div class="card-content1">

                                <form id="example-form" method="post" name="addstf">
                                    <!-- <div class="row"> -->
                                        <h3><b><strong>Apply for Leave</b></strong></h3>
                                        <h6><b>*</b> - Fill "No" if not needed.</h6>
                                        <!-- <section> -->
                                            <!-- <div class="wizard-content w-100"> -->
                                                <!-- <div class="row row-card2">
                                                    <div class="col-12 col-md-12"> -->
                                                        <!-- <div class="row"> -->
     <?php if($error){?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>




<div class="row">
<div class="col-12 col-md-12">
    <div class="row">
        <div class="input-field col-12 col-md-1">
            <label for="c1"><b><strong>1.</b></strong></label>
        </div>
        <div class="input-field col-12 col-md-3">
            <select  name="title" autocomplete="off">
                <option value="">Dr./ Mr./ Ms.</option>                                          
                <option value="Dr."><b>Dr.</b></option>
                <option value="Mr."><b>Mr.</b></option>
                <option value="Ms."><b>Ms.</b></option>
            </select>
        </div>
        
        <div class="input-field col-12 col-md-8">
            <label class="active" for="fullname"><b><strong>Name of Applicant</b></strong></label>
            <input id="fullname" name="fullname" value="<?php echo $row['name'];?>"  type="text" required>
        </div>
    </div>

    <div class="row row-b">
        <div class="input-field col-12 col-md-1">
            <label for="c1"><b><strong>2.</b></strong></label>
        </div>
        <div class="input-field col-12 col-md-3">
        <label class="active" for="designation"><b><strong>Designation</b></strong></label>
        <input id="designation" name="designation"  value="<?php echo $row['designation'];?>" type="text" autocomplete="off" required>
        </div>

        <div class="input-field col-12 col-md-8">
        <select  name="department" autocomplete="off">
        <option value="<?php echo $dep; ?>"><?php echo $dep;?></option>
        </select>
        </div>
    </div>

    <div class="row row-c">
        <div class="input-field col-12 col-md-1">
            <label ><b><strong>3.</b></strong></label>
        </div>
        <div class="input-field col-12 col-md-3">
        <select  name="leavetype" autocomplete="off">
        <option value=""><b><strong>Select leave type...</b></strong></option>
<?php 
$sql =<<<EOF
SELECT leavetype from leavetype;
EOF;
$query=pg_query($sql);
$cnt=1;
if(pg_num_rows($query) > 0)
{
while($row_lists=pg_fetch_array($query))
{   ?>                                            
        <option value="<?php echo $row_lists['leavetype'];?>"><?php echo $row_lists['leavetype'];?></option>
        <?php }} ?>
        </select>
        </div>

                <div class="input-field col-12 col-md-3">
                <label for="fromdate"><b><strong>FromDate</b></strong></label>
                <input id="from_date" name="fromdate"  class="datepicker" type="date" onchange="cal()" value="" required >
                </div>

                <div class="input-field col-12 col-md-3">
                <label for="todate"><b><strong>ToDate</b></strong></label>
                <input id="to_date" name="todate"  class="datepicker" type="date" onchange="cal()" value="" required >
                </div>

        <div class="input-field col-12 col-md-2">
        <label for="nod"><b><strong>No. of Days</b></strong></label>
        <input id="nod1" name="nod" type="text" value="" required >
        </div>
    </div>

    <div class="row row-d">
    <div class="input-field col-12 col-md-1">
                <label><b><strong>*4.</b></strong></label>
            </div>
        <div class="input-field col-12 col-md-2">
            <label><b><strong>Holidays(Prefixing / Suffixing)</b></strong></label>
                </div>

                    <div class="input-field col-12 col-md-1">
                    <label><b><strong>Prefix :</b></strong></label>
                    </div>

                        <div class="input-field col-12 col-md-3">
                        <label class="active" for="fromdate"><b><strong>FromDate</b></strong></label>
                        <input id="from_date1" name="pfromdate"  class="datepicker" type="date" onchange="cal()" value="NULL" required >
                        </div>

                    <div class="input-field col-12 col-md-3">
                    <label class="active" for="todate"><b><strong>ToDate</b></strong></label>
                    <input id="to_date1" name="ptodate"  class="datepicker" type="date" onchange="cal()" value="NULL" required >
                    </div>

                <div class="input-field col-12 col-md-2">
            <label class="active" for="nod"><b><strong>No. of Days</b></strong></label>
        <input id="nod11" name="pnod" type="text" value="NULL" required >
        </div>
    </div>

    <div class="row row-d1">
            <div class="input-field col-12 col-md-3">
            <label><b><strong>                               </b></strong></label>
            </div>

            <div class="input-field col-12 col-md-1">
            <label><b><strong>Suffix :</b></strong></label>
            </div>

            <div class="input-field col-12 col-md-3">
            <label class="active" for="fromdate"><b><strong>FromDate</b></strong></label>
            <input id="from_date2" name="sfromdate"  class="datepicker" type="text" onchange="cal()" value="NULL" required >
            </div>

            <div class="input-field col-12 col-md-3">
            <label class="active" for="todate"><b><strong>ToDate</b></strong></label>
            <input id="to_date2" name="stodate"  class="datepicker" type="text" onchange="cal()" value="NULL" required >
            </div>

            <div class="input-field col-12 col-md-2">
            <label class="active" for="nod"><b><strong>No. of Days</b></strong></label>
            <input id="nod12" name="snod" type="text" value="NULL" required >
            </div>
    </div>

    <div class="row row-e">
        <div class="input-field col-12 col-md-1">
            <label><b><strong>5.</b></strong></label>
        </div>
        <div class="input-field col-12 col-md-11">
            <label for="description"><b><strong>Reason for leave</b></strong></label>    
            <textarea id="description" name="description" class="materialize-textarea" length="500" required></textarea>
        </div>
    </div>

<!-- pop up form =================================================================================================-->

    <div class="row row-e1">
        <div class="input-field col-12 col-md-1">
            <label><b><strong>6.</b></strong></label>
        </div>
        <div class="input-field col-12 col-md-3">
            <label><b><strong>Whether Station Leave permission required or not</b></strong></label>
        </div>
        <div class="input-field col-12 col-md-2">
            <label for="stdate"><b><strong>Yes/No</b></strong></label>
            <input id="stdate" name="stno"  type="text" required>
        </div>
    </div>

    <div class="row row-e2">
        <div class="input-field col-12 col-md-1">
            <label><b><strong>7.</b></strong></label>
        </div>
        <div class="input-field col-12 col-md-6">
            <label><b><strong>Are you holding any other position like HOD, HOC, HOS, Warden,Chairman of a Committee etc. If so, please enclose the approval/
            consent of appropriate authority for the period of leave.</b></strong></label>
        </div>
        <div class="input-field col-12 col-md-3">
            <label for="hold"><b><strong>Yes(Mention) / No</b></strong></label>
            <input id="hold" name="yposition"  type="text" required >
        </div>
            
    </div>
                

        
   

<!-- ---------------------------------------------------------------------------pop up form end -->


    <div class="row row-e3">
            <div class="input-field col-12 col-md-1">
                <label><b><strong>8.</b></strong></label>
            </div>
            <div class="input-field col-12 col-md-6">
            <label><b><strong>Arrangement for classes during the
            proposed leave (for faculty members)</b></strong></label>
            </div>

            <div class="input-field col-12 col-md-3">
            <label for="noc"><b><strong>No. of Classes Missed</b></strong></label>
            <input id="noc" name="noc" type="text" required >
            </div>

            <div class="input-field col-12 col-md-2">
            <label for="aa"><b><strong>Alt. Arrangement</b></strong></label>
            <input id="aa" name="alterarr" type="text" required >
            </div>
    </div>

    <div class="row row-e4">
            <div class="input-field col-12 col-md-1">
                <label><b><strong>9.</b></strong></label>
            </div>
            <div class="input-field col-12 col-md-6">
            <label class="active" for="address" ><b><strong>Address while on leave</b></strong></label>    
            <input id="address" name="address" type="text" length="500" value="<?php echo $add;?>" required>
            </div>
            <div class="input-field col-12 col-md-3">
            <label class="active" for="mobileno"><b><strong>Contact Phone No. </b></strong></label>
            <input id="mobileno" name="mobileno" type="text" value="<?php echo $phn;?>" required >
            </div>
            <div class="input-field col-12 col-md-2">
            <label class="active" for="pin"><b><strong>Pin</b></strong></label>
            <input id="pin" name="pin" type="text" value="<?php echo $pincode;?>" required >
            </div>

    </div>

    <div class="row row-f">
            <button type="submit" name="apply" id="apply" class="waves-effect waves-light btn indigo m-b-xs">Apply</button>
    </div>                                             
</div>
</div>
                                            <!-- </div>
                                        </section>
                                      </section> -->
                                    <!-- </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        <!-- </div> -->
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/form_elements.js"></script>
          <script src="assets/js/pages/form-input-mask.js"></script>
                <script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
                <script>
                    // Get the modal
                    var modal = document.getElementById('myModal');

                    // Get the button that opens the modal
                    var btn = document.getElementById("myBtn");

                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];

                    // When the user clicks the button, open the modal 
                    btn.onclick = function() {
                    modal.style.display = "block";
                    }

                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                    modal.style.display = "none";
                    }

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                    }
                </script>
                <script type="text/javascript">
                    function GetDays(){
                            var dropdt = new Date(document.getElementById("to_date").value);
                            var pickdt = new Date(document.getElementById("from_date").value);
                            return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
                                       }
                    // function GetDays1(){
                    //         var dropdt = new Date(document.getElementById("to_date1").value);
                    //         var pickdt = new Date(document.getElementById("from_date1").value);
                    //         return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
                    //                 }

                    // function GetDays2(){
                    //         var dropdt = new Date(document.getElementById("to_date2").value);
                    //         var pickdt = new Date(document.getElementById("from_date2").value);
                    //         return parseInt((dropdt - pickdt) / (24 * 3600 * 1000));
                    //     }

                    function cal() {
                            if(document.getElementById("to_date")){
                                document.getElementById("nod1").value=GetDays();}
                            // }else if(document.getElementById("to_date1")){
                            //     document.getElementById("nod11").value=GetDays1();
                            // }else if(document.getElementById("to_date2")){
                            //     document.getElementById("nod12").value=GetDays2();
                            // }
                                    }   

                </script>
    </body>
</html>
<?php }  } } ?> 
