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
        <title>Dashboard</title>
        
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
        <link href="assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
        <link href="assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">

        	
        <!-- Theme Styles -->
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/stfcustom.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <?php 
$id=$_SESSION['stflogin'];
$sql1=<<<EOF
select staff.designation, department.deptshortname,leavetable.status,department.did,leavetable.fwdstatus from staff join department on staff.did=department.did cross join leavetable where staff.gmailid='$id';
EOF;
$query1=pg_query($sql1);
if (pg_num_rows($query1)>0)
{
    if($row_list=pg_fetch_array($query1))
    { $des=$row_list['designation'];
        $fwd=$row_list['fwdstatus'];
?>

    <body>
 
    
    <?php include('includes/stf-header.php');?>

    <?php include('includes/stfsidebar.php');?>

        <main class="mn-inner">
            <div class="middle-content">
                <div class="row no-m-t no-m-b">
                    <div class="col s12 m12 l3">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title">Total leaves</span>
                                <span class="stats-counter">
<?php
$sql =<<<EOF
SELECT id from leavetable where fwdstatus='$fwd';
EOF;
$query = pg_query($sql);
$tlcount = pg_num_rows($query);
?>

                                    <span class="counter"><?php echo $tlcount;?></span></span>
                            </div>
                            <div id="sparkline-bar"></div>
                        </div>
                    </div>

<!-- =============================================================================================================                     -->
                        <div class="col s12 m12 l3">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title">Approved Leaves </span>
    <?php
$fwd1=2;
$st=1;
$sql =<<<EOF
SELECT id from leavetable where fwdstatus='$fwd1' and status='$st';
EOF;
$query=pg_query($sql);
$Clcount=pg_num_rows($query);
?>                            
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($Clcount);?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>


                    <div class="col s12 m12 l3">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title">Pending Leaves </span>
    <?php
$st=0;
$sql =<<<EOF
SELECT id from leavetable where fwdstatus='$fwd' and status='$st';
EOF;
$query=pg_query($sql);
$Clcount=pg_num_rows($query);
?>                            
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($Clcount);?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>
<!-- =============================================================================================================                     -->

                    <div class="col s12 m12 l3">
                        <div class="card stats-card">
                            <div class="card-content">
                                <span class="card-title">Not Approved Leaves</span>
<?php
$fwd2=3;
$st=2;
$sql =<<<EOF
SELECT id from leavetable where fwdstatus='$fwd2' and status='$st';
EOF;
$query=pg_query($sql);
$clcount=pg_num_rows($query);
?>   
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($clcount);?></span></span>
                      
                            </div>
                            <div class="progress stats-card-progress">
                                <div class="determinate" style="width: 50%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                 
                    <div class="row no-m-t no-m-b">
                        <div class="col s12 m12 l12">
                            <div class="card invoices-card">
                                <div class="card-content">
                                 
                                    <span class="card-title">Latest Leave Applications</span>
                             <table id="example" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th>Sr no</th>
                                            <th width="160">Staff Name</th>
                                            <th width="120">Leave Type</th>

                                             <th width="130">Posting Date</th>                 
                                            <th>Status</th>
                                            <th align="center">Action</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php 
$fwdst=0;
$sql =<<<EOF
SELECT leavetable.id as lid,staff.name,staff.sid,staff.id,leavetable.leavetype,leavetable.postingdate,leavetable.Status from leavetable join staff on leavetable.sid=staff.sid where not leavetable.fwdstatus=$fwdst order by lid desc limit 6;
EOF;
$query=pg_query($sql);
$cnt=1;
if(pg_num_rows($query)> 0)
{
while($row_lists=pg_fetch_array($query))
{         
      ?>  

                                        <tr>
                                            <td> <b><?php echo $cnt;?></b></td>
                                            <td><a href="editstaff.php?stfid=<?php echo $row_lists['id'];?>" target="_blank"><?php echo $row_lists['name'];?>(<?php echo $row_lists['sid'];?>)</a></td>
                                            <td><?php echo $row_lists['leavetype'];?></td>
                                            <td><?php echo $row_lists['postingdate'];?></td>
                                            <td><?php $stats=$row_lists['status'];
                                                if($stats==1){
                                                ?>
                                                <span style="color: green">Approved   </span>
                                                <?php } if($stats==2)  { ?>
                                                <span style="color: red">Not Approved</span>
                                                <?php } if($stats==0)  { ?>
                                                <span style="color: blue">waiting for approval</span>
 <?php } ?>


                                             </td>

          <td>
          <?php //if($fwd==1){?>
          <td><a href="leave-details.php?leaveid=<?php echo $row_lists['lid'];?>" class="waves-effect waves-light btn indigo m-b-xs"  > view details</a></td>
          <?php //} ?>
                                    </tr>
                                         <?php $cnt++;} }?>
                                         <?php }} ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
            </main>
          
        </div>

        
        
        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="assets/plugins/counter-up-master/jquery.counterup.min.js"></script>
        <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="assets/plugins/chart.js/chart.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="assets/plugins/peity/jquery.peity.min.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/dashboard.js"></script>
        
    </body>
</html>
<?php } ?>
