<?php 
require_once("includes/config.php");
// code for stfid availablity
if(!empty($_POST["stfcode"])) {
	$stfid=$_POST["stfcode"];
	
$sql =<<<EOF
SELECT sid FROM staff WHERE sid='$stfid';
EOF;
$query=pg_query($sql);
$results=pg_fetch_all($query);

if(pg_num_rows($query) > 0)
{
echo "<span style='color:red'> Staff id already exists .</span>";
 echo "<script>$('#add').prop('disabled',true);</script>";
} else{
	
echo "<span style='color:green'> Staff id available for Registration .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

// code for emailid availablity
if(!empty($_POST["gmailid"])) {
$sid= $_POST["gmailid"];
$sql =<<<EOF
SELECT gmailid FROM staff WHERE gmailid='$sid';
EOF;
$query1=pg_query($sql);
$results=pg_fetch_all($query1);

if(pg_num_rows($query1) > 0)
{
echo "<span style='color:red'> Email id already exists.</span>";
 echo "<script>$('#add').prop('disabled',true);</script>";
} else{
	
echo "<span style='color:green'> Email id available for Registration.</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}




?>
