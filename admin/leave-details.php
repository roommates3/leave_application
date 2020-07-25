<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

// code for update the read notification status
$isread=1;
$did=intval($_GET['leaveid']);  
date_default_timezone_set('Asia/Kolkata');
$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
$sql=<<<EOF
update leavetable set IsRead='$isread' where id=$did;
EOF;
$query=pg_query($sql);

// code for action taken on leave
if(isset($_POST['update']))
{ 
$did=intval($_GET['leaveid']);
$description=$_POST['description'];
$status=$_POST['status'];
if($status==0)
{
    $fwd=1;
}
else if($status==1){
    $fwd=2;
}
else{
    $fwd=3;
}   
date_default_timezone_set('Asia/Kolkata');
$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
$sql=<<<EOF
update leavetable set AdminRemark='$description',Status='$status',fwdstatus='$fwd',AdminRemarkDate='$admremarkdate' where id='$did';
EOF;
$query=pg_query($sql);
$msg="Leave updated Successfully";
}



 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Leave Details </title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        
        
        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/af78f6c7a9.js" crossorigin="anonymous"></script>
        <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">
        <link href="../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">


                <link href="../assets/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css"/>  
        <!-- Theme Styles -->
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
$lid=intval($_GET['leaveid']);
$sql =<<<EOF
SELECT leavetable.id as lid,staff.name,staff.sid,staff.id,staff.Gender,staff.phoneno,staff.gmailid,leavetable.LeaveType,leavetable.ToDate,
leavetable.FromDate,leavetable.Description,leavetable.fwdstatus,leavetable.PostingDate,leavetable.Status,leavetable.AdminRemark,leavetable.AdminRemarkDate from 
leavetable join staff on leavetable.sid=staff.sid where leavetable.id='$lid';
EOF;
$query=pg_query($sql);
$results=pg_fetch_all($query);
// echo $results;
$cnt=1;
if(pg_num_rows($query) > 0)
{
while($row_lists=pg_fetch_array($query))
{       $fwdstatus=$row_lists['fwdstatus'];  
      ?>  
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title" style="font-size:24px;">Leave Details</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Leave Details</span>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo $msg; ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                               
                                 
                                    <tbody>
                                   

                                        <tr>
                                            <td style="font-size:16px;"> <b>Staff Name :</b></td>
                                            <td><a href="editstaff.php?stfid=<?php echo $row_lists['id'];?>" target="_blank"><?php echo $row_lists['name'];?></a></td>
                                            <td style="font-size:16px;"><b>Staff Id :</b></td>
                                            <td><?php echo $row_lists['sid'];?></td>
                                            <td style="font-size:16px;"><b>Gender :</b></td>
                                            <td><?php echo $row_lists['gender'];?></td>
                                        </tr>

                                        <tr>
                                            <td style="font-size:16px;"><b>Staff Email id :</b></td>
                                            <td><?php echo $row_lists['gmailid'];?></td>
                                            <td style="font-size:16px;"><b>Staff Contact No. :</b></td>
                                            <td><?php echo $row_lists['phoneno'];?></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>

                                        <tr>
                                            <td style="font-size:16px;"><b>Leave Type :</b></td>
                                            <td><?php echo $row_lists['leavetype'];?></td>
                                            <td style="font-size:16px;"><b>Leave Date . :</b></td>
                                            <td>From <?php echo $row_lists['fromdate'];?> to <?php echo $row_lists['todate'];?></td>
                                            <td style="font-size:16px;"><b>Posting Date</b></td>
                                            <td><?php echo $row_lists['postingdate'];?></td>
                                        </tr>

                                        <tr>
                                            <td style="font-size:16px;"><b>Staff Leave Description : </b></td>
                                            <td colspan="5"><?php echo $row_lists['description'];?></td>
                                        </tr>

                                        <tr>
                                        <td style="font-size:16px;"><b>leave Status :</b></td>
                                        <td colspan="5"><?php $stats=$row_lists['status'];
                                        if($stats==1){ ?>
                                        <span style="color: green">Approved</span>
                                        <?php } if($stats==2)  { ?>
                                        <span style="color: red">Not Approved</span>
                                        <?php } if($stats==0)  { ?>
                                        <span style="color: blue">waiting for approval</span>
                                        <?php } ?>
                                        </td>
                                        </tr>

                                        <tr>
                                        <td style="font-size:16px;"><b>Admin Remark: </b></td>
                                        <td colspan="5"><?php
                                        if($row_lists['adminremark']==""){
                                        echo "waiting for Approval";  
                                        }
                                        else{
                                        echo $row_lists['adminremark'];
                                        }
                                        ?></td>
                                        </tr>

                                        <tr>
                                        <td style="font-size:16px;"><b>Admin Action taken date : </b></td>
                                        <td colspan="5"><?php
                                        if($row_lists['adminremarkdate']==""){
                                        echo "NA";  
                                        }
                                        else{
                                        echo $row_lists['adminremarkdate'];
                                        }
                                        ?></td>
                                        </tr>
                                        
                                        <?php 
                                        if($stats==0 and $fwdstatus==0)
                                        { ?>

                                        <tr>
                                        <td colspan="5">
                                        <a class="modal-trigger waves-effect waves-light btn red rounded-pill" readonly href="#modal1">Take&nbsp;Action</a>
                                        <form name="adminaction" method="post">
                                        <div id="modal1" class="modal modal-fixed-footer" style="height: 60%">
                                            <div class="modal-content" style="width:90%">
                                                <h4>Leave take action</h4>
                                                <select class="browser-default" name="status" required="">
                                                                                    <option value="">Choose your option</option>
                                                                                    <option value="0">Forward</option>
                                                                                    <option value="2">Not Approved</option>

                                                                                </select></p>
                                            <p><textarea id="textarea1" name="description" class="materialize-textarea" name="description" placeholder="Description" length="500" maxlength="500" required></textarea></p>
                                            </div>
                                            <div class="modal-footer" style="width:90%">
                                            <input type="submit" class="waves-effect waves-light btn blue m-b-xs" name="update" value="Submit">
                                            </div>
                                        </div>
                                   
                                        </td>
                                        </tr>

                                        <?php } elseif($stats==0 and $fwdstatus==1) {?>

                                        <?php if ($des=='Director'){?>
                                        <tr>
                                        <td colspan="5">
                                        <a class="modal-trigger waves-effect waves-light btn" href="#modal1">Take&nbsp;Action</a>
                                        <form name="adminaction" method="post">
                                        <div id="modal1" class="modal modal-fixed-footer" style="height: 60%">
                                            <div class="modal-content" style="width:90%">
                                                <h4>Leave take action</h4>
                                                <select class="browser-default" name="status" required="">
                                                                                    <option value="">Choose your option</option>
                                                                                    <option value="1">Approved</option>
                                                                                    <option value="2">Not Approved</option>
                                                                                </select></p>
                                                                                <p><textarea id="textarea1" name="description" class="materialize-textarea" name="description" placeholder="Description" length="500" maxlength="500" required></textarea></p>
                                            </div>
                                            <div class="modal-footer" style="width:90%">
                                            <input type="submit" class="waves-effect waves-light btn blue m-b-xs" name="update" value="Submit">
                                            </div>
                                        </div> 
                                        
                                        </td>
                                        </tr>
                                        <?php } ?>
                                        <?php } elseif($stats==2 and $fwdstatus=3) {?>
                                        <tr>
                                        <td colspan="5">
                                        <a class="modal-trigger waves-effect waves-light btn" href="#modal1">Rejected!</a>
                                        <form name="adminaction" method="post">
                                        <div id="modal1" class="modal modal-fixed-footer" style="height: 60%">
                                            <div class="modal-content" style="width:90%">
                                                <h4>Leave take action</h4>
                                                <!-- <select class="browser-default" name="status" required=""> -->
                                                                                    <option value="">Rejected</option>
                                                                                <!-- </select></p>                                            </div> -->
                                            <div class="modal-footer" style="width:90%">
                                            <!-- <input type="submit" class="waves-effect waves-light btn blue m-b-xs" name="update" value="Submit"> -->
                                            </div>
                                        </div> 
                                        
                                        </td>
                                        </tr>
                                        <?php } elseif($stats==1) {?>
                                        <tr>
                                        <td colspan="5">
                                        <a class="modal-trigger waves-effect waves-light btn" href="#modal1">&nbsp;Approved!</a>
                                        <form name="adminaction" method="post">
                                        <div id="modal1" class="modal modal-fixed-footer" style="height: 60%">
                                            <div class="modal-content" style="width:90%">
                                                <h4>Leave take action</h4>
                                                <!-- <select class="browser-default" name="status" required=""> -->
                                                <option value="" align=center>Approved!</option>
                                                <!-- </select> -->
                                            </div>
                                            <div class="modal-footer" style="width:90%">
                                            <!-- <input type="submit" class="waves-effect waves-light btn blue m-b-xs" name="update" value="Submit"> -->
                                            </div>
                                        </div>
                                         
                                        </td>
                                        </tr>

                                        <?php }  ?>

                                        </form> </tr>
                                         <?php $cnt++;} } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->

        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
         <script src="assets/js/pages/ui-modals.js"></script>
        <script src="assets/plugins/google-code-prettify/prettify.js"></script>
        
        
    </body>
</html>
<?php } ?>