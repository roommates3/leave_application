<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>Admin | Dashboard</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <meta name="description" content="Responsive Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/af78f6c7a9.js" crossorigin="anonymous"></script>
    <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
    <link href="../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <?php include('includes/header.php');?>
    <?php include('includes/sidebar.php');?>

    <main class="mn-inner">
        <div class="middle-content">
            <div class="row no-m-t no-m-b">
                <div class="col s12 m12 l4">
                    <div class="card stats-card">
                        <div class="card-content">

                            <span class="card-title">Total Regd Staff</span>
                            <span class="stats-counter">
                                <?php
$sql =<<<EOF
SELECT id from staff;
EOF;
$query=pg_query($sql);
$stfcount=pg_num_rows($query);
?>

                                <span class="counter"><?php echo htmlentities($stfcount);?></span></span>
                        </div>
                        <div id="sparkline-bar"></div>
                    </div>
                </div>
                <div class="col s12 m12 l4">
                    <div class="card stats-card">
                        <div class="card-content">

                            <span class="card-title">Listed Departments </span>
                            <?php
$sql =<<<EOF
SELECT id from department;
EOF;
$query=pg_query($sql);
$dptcount=pg_num_rows($query);
?>
                            <span class="stats-counter"><span class="counter"><?php echo htmlentities($dptcount);?></span></span>
                        </div>
                        <div id="sparkline-line"></div>
                    </div>
                </div>
                <div class="col s12 m12 l4">
                    <div class="card stats-card">
                        <div class="card-content">
                            <span class="card-title">Listed leave Type</span>
                            <?php
$sql =<<<EOF
SELECT id from leavetype;
EOF;
$query=pg_query($sql);
$leavtypcount=pg_num_rows($query);
?>
                            <span class="stats-counter"><span
                                    class="counter"><?php echo htmlentities($leavtypcount);?></span></span>

                        </div>
                        <div class="progress stats-card-progress">
                            <div class="determinate" style="width: 70%"></div>
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
                                        <th width="200">Staff Name</th>
                                        <th width="120">Leave Type</th>

                                        <th width="180">Posting Date</th>
                                        <th>Status</th>
                                        <th align="center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $sql =<<<EOF
SELECT leavetable.id as lid,staff.name,staff.sid,staff.id,leavetable.leavetype,leavetable.postingdate,leavetable.Status,leavetable.fwdstatus from leavetable join staff on leavetable.sid=staff.sid where staff.designation='HOD' order by lid desc limit 6;
EOF;
$query=pg_query($sql);
$cnt=1;
if(pg_num_rows($query)> 0)
{
while($row_lists=pg_fetch_array($query))
{       $fwd=$row_lists['fwdstatus'];  
      ?>

                                    <tr>
                                        <td> <b><?php echo $cnt;?></b></td>
                                        <td><a href="editstaff.php?stfid=<?php echo $row_lists['id'];?>"
                                                target="_blank"><?php echo $row_lists['name'];?>(<?php echo $row_lists['sid'];?>)</a>
                                        </td>
                                        <td><?php echo $row_lists['leavetype'];?></td>
                                        <td><?php echo $row_lists['postingdate'];?></td>
                                        <td><?php $stats=$row_lists['status'];
                                                    if($stats==1){ ?>
                                            <span style="color: green">Approved</span>
                                            <?php } if($stats==2)  { ?>
                                            <span style="color: red">Not Approved</span>
                                            <?php } if($stats==0)  { ?>
                                            <span style="color: blue">waiting for approval</span>
                                            <?php } ?> </td>
                                        <td><a href="leave-details.php?leaveid=<?php echo $row_lists['lid'];?>"
                                                class="waves-effect waves-light btn blue m-b-xs"> View Details</a></td>

                                    </tr>
                                    <?php $cnt++;} }?>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

    <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
    <script src="../assets/plugins/counter-up-master/jquery.counterup.min.js"></script>
    <script src="../assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="../assets/plugins/chart.js/chart.min.js"></script>
    <script src="../assets/plugins/flot/jquery.flot.min.js"></script>
    <script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>
    <script src="../assets/plugins/flot/jquery.flot.symbol.min.js"></script>
    <script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
    <script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../assets/plugins/curvedlines/curvedLines.js"></script>
    <script src="../assets/plugins/peity/jquery.peity.min.js"></script>
    <script src="../assets/js/alpha.min.js"></script>
    <script src="../assets/js/pages/dashboard.js"></script>

</body>

</html>
<?php } ?>