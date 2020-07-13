<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['stflogin'])==0)
    {   
header('location:index.php');
}
else{

 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Staff | Leave History</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

            
        <!-- Theme Styles -->
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
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

<?php 
$id=$_SESSION['stflogin'];
$sql1=<<<EOF
SELECT designation from staff where gmailid='$id';
EOF;

$query1=pg_query($sql1);
if (pg_num_rows($query1)>0)
{
    while($row_list=pg_fetch_array($query1))
    {
?>

    <body>
 
    <?php if( $row_list['designation'] == 'HOD')
    { ?>
    <?php include('includes/hodheader.php');?>

        <?php include('includes/stfsidebar.php');?>
    <?php }else{ ?>
        <?php include('includes/header.php');?>

        <?php include('includes/sidebar.php');?>
    <?php       }
    }
}?>

            <main class="mn-inner">
            <?php

$sid=$_SESSION['sid'];
$sql =<<<EOF
SELECT cl,scl,ml,el from leavetrack where sid=$sid;
EOF;
$query = pg_query($sql);
$leaverow=pg_fetch_array($query);
$clcount=$leaverow['cl'];
$sclcount=$leaverow['scl'];
$mlcount=$leaverow['ml'];
$elcount=$leaverow['el'];
?>
<!-- ===================================================================               -->
                    <div class="col s12 m12 l12">
                        <div class="page-title rr">Leave History</div>
                    </div>
            <div class="middle-content">
            
                <div class="row no-m-t no-m-b">

<!-- =============================================================================================================                     -->
                    <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title">Casual Leaves </span>
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($clcount);?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>
<!-- =============================================================================================================                     -->
                    <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title">Scl Casual Leaves </span>
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($sclcount);?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>
<!-- =============================================================================================================                     -->
                    <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title"> Maternity Leaves </span>
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($mlcount);?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>

<!-- =============================================================================================================                     -->

                    <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                                <span class="card-title">Earned Leaves</span>
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($elcount);?></span></span>
                            </div>
                            <div class="progress stats-card-progress">
                                <div class="determinate" style="width: 50%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- for remaining leaves -->
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<?php
echo $cl; 
$sql2=<<<EOF
select totalleaves from leavetype where leavetype='Casual Leave'; 
EOF;
$query2=pg_query($sql2);
$leaverow1=pg_fetch_array($query2);
$totalcl=$leaverow1['totalleaves'];
echo $totalcl;

$sql2=<<<EOF
select totalleaves from leavetype where leavetype='Maternity Leave'; 
EOF;
$query2=pg_query($sql2);
$leaverow1=pg_fetch_array($query2);
$totalml=$leaverow1['totalleaves'];
echo $totalml;

$sql2=<<<EOF
select totalleaves from leavetype where leavetype='Special Casual Leave'; 
EOF;
$query2=pg_query($sql2);
$leaverow1=pg_fetch_array($query2);
$totalscl=$leaverow1['totalleaves'];
echo $totalscl;

$sql2=<<<EOF
select totalleaves from leavetype where leavetype='Earned Leave'; 
EOF;
$query2=pg_query($sql2);
$leaverow1=pg_fetch_array($query2);
$totalel=$leaverow1['totalleaves'];


$remcl=$totalcl-$clcount;
$remscl=$totalscl-$sclcount;
$remml=$totalml-$mlcount;
$remel=$totalel-$elcount;

?>

<div class="middle-content">
                <div class="row no-m-t no-m-b">

<!-- =============================================================================================================                     -->
                    <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title">Remaining CL </span>
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($remcl);?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>
<!-- =============================================================================================================                     -->
                    <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title">Remaining SCL </span>
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($remscl);?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>
<!-- =============================================================================================================                     -->
                    <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title">Remaining ML </span>
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($remml);?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>

<!-- =============================================================================================================                     -->

                    <div class="col s12 m12 l2">
                        <div class="card stats-card">
                            <div class="card-content">
                                <span class="card-title">Remaining EL</span>
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($remel);?></span></span>
                            </div>
                            <div class="progress stats-card-progress">
                                <div class="determinate" style="width: 50%"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
<!-- ======================================================================================== -->
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Leave History</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th width="10">Sr no</th>
                                            <th width="100">Leave Type</th>
                                            <th>From</th>
                                            <th>To</th>
                                             <th>Description</th>
                                             <th width="120">Posting Date</th>
                                            <th width="150">Remark</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php 
$sid=$_SESSION['sid'];
$sql =<<<EOF
SELECT LeaveType,ToDate,FromDate,Description,PostingDate,AdminRemarkDate,AdminRemark,Status from leavetable where sid='$sid';
EOF;
$query=pg_query($sql);
$cnt=1;
if(pg_num_rows($query) > 0)
{
while($row_lists=pg_fetch_array($query))
{               ?>  
                                        <tr>
                                            <td> <?php echo $cnt;?></td>
                                            <td><?php echo $row_lists['leavetype'];?></td>
                                            <td><?php echo $row_lists['todate'];?></td>
                                            <td><?php echo $row_lists['fromdate'];?></td>
                                           <td><?php echo $row_lists['description'];?></td>
                                            <td><?php echo $row_lists['postingdate'];?></td>
                                            <td><?php if($row_lists['adminremark']=="")
                                            {
echo htmlentities('waiting for approval');
                                            } else
{

 echo $row_lists['adminremark']." "."at"." ".$row_lists['adminremarkdate'];
}

                                            ?></td>
                                                                                 <td>
                                                    <?php $stats=$row_lists['status'];
                                                        if($stats==1){
                                                        ?>
                                                 <span style="color: green">Approved</span>
                                                <?php } if($stats==2)  { ?>
                                                <span style="color: red">Not Approved</span>
                                                 <?php } if($stats==0)  { ?>
                                                <span style="color: blue">waiting for approval</span>
                                                <?php } ?>

                                             </td>
          
                                        </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
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
        <script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
        
    </body>
</html>
<?php } ?>