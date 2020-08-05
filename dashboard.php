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
$cnt=1;
$sql1=<<<EOF
select staff.designation, department.deptshortname,leavetable.status,department.did,leavetable.fwdstatus from staff join department on staff.did=department.did cross join leavetable where staff.gmailid='$id';
EOF;
$query1=pg_query($sql1);
if (pg_num_rows($query1)>0)
{
    if($row_list=pg_fetch_array($query1))
    {   $dept=$row_list['did'];
        $d1=$row_list['deptshortname'];
        $fwd=$row_list['fwdstatus'];
        // echo $fwd;
?>

    <body>
 
    <?php if($row_list['designation'] == 'HOD')
    { ?>
    <?php include('includes/hodheader.php');?>

        <?php include('includes/stfsidebar.php');?>
    <?php } ?>
    
        <main class="mn-inner">
            <div class="middle-content">
                <div class="row no-m-t no-m-b">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title">Total leaves</span>
                                <span class="stats-counter">
<?php
$des=$row_list['designation'];
$sid=$_SESSION['sid'];
$sql =<<<EOF
SELECT leavetable.id from staff join leavetable on staff.sid=leavetable.sid join department on department.did=staff.did and department.deptshortname='$d1' where not staff.sid='$sid' and not staff.designation='$des';
EOF;
$query = pg_query($sql);
// echo $query;
$tlcount = pg_num_rows($query);
// echo $tlcount;
?>

                                    <span class="counter"><?php echo $tlcount;?></span></span>
                            </div>
                            <div id="sparkline-bar"></div>
                        </div>
                    </div>

<!-- =============================================================================================================                     -->
                        <div class="col-12 col-md-6 col-lg-3">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title">Approved Leaves </span>
    <?php
$sid=$_SESSION['sid'];
$st=1;
$sql =<<<EOF
SELECT leavetable.id from staff join leavetable on staff.sid=leavetable.sid join department on department.did=staff.did where department.deptshortname='$d1' and status='$st' and not staff.sid='$sid' and not staff.designation='$des';
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
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card stats-card">
                            <div class="card-content">
                            
                                <span class="card-title"> Pending Leaves </span>
    <?php
$sid=$_SESSION['sid'];
$st=0;
$sql =<<<EOF
SELECT leavetable.id from staff join leavetable on staff.sid=leavetable.sid join department on department.did=staff.did where department.deptshortname='$d1' and status='$st' and not staff.sid='$sid' not staff.designation='$des';
EOF;
$query=pg_query($sql);
$sclcount=pg_num_rows($query);
?>                            
                                <span class="stats-counter"><span class="counter"><?php echo htmlentities($sclcount);?></span></span>
                            </div>
                            <div id="sparkline-line"></div>
                        </div>
                    </div>



                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card stats-card">
                            <div class="card-content">
                                <span class="card-title">Not Approved Leaves</span>
                                    <?php
$sid=$_SESSION['sid'];
$st=2;
$sql =<<<EOF
SELECT leavetable.id from staff join leavetable on staff.sid=leavetable.sid join department on department.did=staff.did where department.deptshortname='$d1' and status='$st' and not staff.sid='$sid' and not staff.designation='$des';
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
<!-- ============================================================================================================ -->
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
<?php $sqlNew =<<<EOF
SELECT leavetable.id as lid,staff.name,staff.sid,staff.id,leavetable.leavetype,leavetable.postingdate,leavetable.Status from leavetable join staff on leavetable.sid=staff.sid where staff.did='$dept' and not staff.sid='$sid' and not staff.designation='$des' order by lid desc limit 6;
EOF;
$queryNew=pg_query($sqlNew);
// echo $queryNew;
$cnt=1;
if(pg_num_rows($queryNew)> 0)
{
while($row_lists=pg_fetch_array($queryNew))
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
          
          <td><a href="leave-details.php?leaveid=<?php echo $row_lists['lid'];?>" class="waves-effect waves-light btn indigo m-b-xs rounded-pill"  > view details</a></td>
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
