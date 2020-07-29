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
    


 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Total Leave </title>
        
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

                <link href="assets/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css"/>  
        <!-- Theme Styles -->
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
    <?php while ($row=pg_fetch_array($query1))
{
    if($row['designation'] == 'Director' or $row['designation'] == 'HOD')
    {?>
    <?php include('includes/hodheader.php');?>

        <?php include('includes/stfsidebar.php');?>
    <?php }else{ ?>
        <?php include('includes/header.php');?>

        <?php include('includes/sidebar.php');?>
    <?php } ?>

            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Leave History</div>
                    </div>
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Leave History</span>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo $msg; ?> </div><?php }?>
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
<?php $sql = <<<EOF
SELECT leavetable.id as lid,staff.name,staff.sid,staff.id,leavetable.LeaveType,leavetable.PostingDate, leavetable.status from leavetable join staff on leavetable.sid=staff.sid order by lid desc;
EOF;
$query=pg_query($sql);
$cnt=1;
if(pg_num_rows($query) > 0)
{
while($row_lists=pg_fetch_array($query))
{         
      ?>  

                                        <tr>
                                            <td> <b><?php echo $cnt;?></b></td>
                                              <td><a href="editstaff.php?sid=<?php echo $row_lists['id'];?>" target="_blank"><?php echo $row_lists['name'];?>(<?php echo $row_lists['sid'];?>)</a></td>
                                            <td><?php echo $row_lists['leavetype'];?></td>
                                            <td><?php echo $row_lists['postingdate'];?></td>
                                                                       <td><?php $stats=$row_lists['status'];
if($stats==1){
                                             ?>
<span style="color: yellow">Approved By HOD</span>
 <?php } if($stats==2)  { ?>
    <span style="color: green">Approved By Director</span>
 <?php } if($stats==3)  { ?>
    <span style="color: yellow">Approved By HOS/Admin</span>
 <?php } if($stats==4)  { ?>
                                                <span style="color: red">Not Approved</span>
                                                 <?php } if($stats==0)  { ?>
 <span style="color: blue">waiting for approval</span>
 <?php } ?>


                                             </td>

          <td>
           <td><a href="leave-details.php?leaveid=<?php echo $row_lists['lid'];?>" class="waves-effect waves-light btn blue m-b-xs"  > View Details</a></td>
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
         <script src="assets/js/pages/ui-modals.js"></script>
        <script src="assets/plugins/google-code-prettify/prettify.js"></script>
        
    </body>
</html>
<?php } } ?>