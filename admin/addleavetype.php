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
$leavetype=$_POST['leavetype'];
$description=$_POST['description'];
if ($description==""){
    $description="NULL";
}
$ttllv=$_POST['total'];
$sql=<<<EOF
INSERT INTO leavetype(leavetype,description,totalleaves) VALUES('$leavetype','$description','$ttllv');
EOF;
$query=pg_query($sql);
$lastInsertId = pg_affected_rows($query);
if($lastInsertId>0)
{
$msg="Leave type added Successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}

    ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>Admin | Add Leave Type</title>

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
    <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
    <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
    <style>
    .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }

    .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }
    </style>
</head>

<body>
    <?php include('includes/header.php');?>

    <?php include('includes/sidebar.php');?>
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Add Leave Type</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card rounded">
                    <div class="card-content">
                        <!-- <div class="row"> -->
                        <form name="chngpwd" method="post">
                            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong> :
                                <?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo $msg; ?> </div><?php }?>
                            <div class="row">
                                <div class="col-12 input-field">
                                <label for="leavetype">Leave Type</label>
                                <input id="leavetype" type="text" class="validate" autocomplete="off"
                                        name="leavetype" required>
                                    
                                </div>
                                <div class="col-12 input-field">
                                <label for="leave">Description</label>
                                    <textarea id="textarea1" class="materialize-textarea" name="description"
                                        length="500"></textarea>
                                </div>

                                <div class="col-12 input-field">
                                <label for="leave">Total leaves</label>
                                    <input id="leavetype" type="text" class="validate" autocomplete="off" name="total"
                                        required>
                                    
                                </div>



                                <div class="input-field col-12">
                                    <button type="submit" name="add"
                                        class="waves-effect waves-light btn red m-b-xs rounded-pill">ADD</button>

                                </div>




                            </div>

                        </form>
                        <!-- </div> -->
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
