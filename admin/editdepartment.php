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
$did=intval($_GET['deptid']); 
$deptid=$_POST['depid'];  
$deptname=$_POST['deptname'];
$deptshortname=$_POST['deptshortname'];
$sql=<<<EOF
update department set deptname='$deptname',deptshortname='$deptshortname',did='$depid' where id='$did';
EOF;
$query=pg_query($sql);
$msg="Department updated Successfully";
}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Update Department</title>
        
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
            <main class="mn-inner">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title">Update Department</div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-content">
                              
                                <div class="row">
                                    <form class="col-12" name="chngpwd" method="post">
                                          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
<?php 
$did=intval($_GET['deptid']);
$sql =<<<EOF
SELECT * from department WHERE id='$did';
EOF;
$query=pg_query($sql);
$results=pg_fetch_all($query);

$cnt=1;
if(pg_num_rows($query) > 0)
{
    while($row_list= pg_fetch_array($query))
    {               ?>  
    
                                            <div class="row">
                                                <div class="input-field col-12">
                                                <label for="deptname">Department Name</label>
    <input id="departmentname" type="text"  class="validate" autocomplete="off" name="departmentname" value="<?php echo $row_list['deptname'];?>"  required>
                                                    
                                                </div>
    
    
              <div class="input-field col-12">
              <label for="deptshortname">Department Short Name</label>
    <input id="departmentshortname" type="text"  class="validate" autocomplete="off" value="<?php echo $row_list['deptshortname'];?>" name="departmentshortname"  required>
                                                    
                                                </div>
                                                <div class="input-field col-12">
                                                <label for="deptshortname">Department Id</label>
    <input id="departmentid" type="text"  class="validate" autocomplete="off" value="<?php echo $row_list['did'];?>" name="depid"  required>
                                                    
                                                </div>

<?php }} ?>


<div class="input-field col s12">
<button type="submit" name="update" class="waves-effect waves-light btn red m-b-xs rounded-pill">UPDATE</button>

</div>




                                        </div>
                                       
                                    </form>
                                </div>
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