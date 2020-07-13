  
    <aside id="slide-out" class="side-nav white fixed">
        <div class="side-nav-wrapper">
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-image">
                            <img src="assets/images/profile-image.png" class="circle" alt="">
                        </div>
                        <div class="sidebar-profile-info">

                        <?php
$sid=$_SESSION['stflogin'];
$sql = <<<EOF
SELECT name,sid,designation from staff where gmailid='$sid';
EOF;
$query = pg_query($sql);
$row=pg_fetch_array($query);
?> 
<?php if($row['designation']=='Director'){?>      
                <p>Director</p>
<?php } else if($row['designation']=='HOD'){?>
                <p>HOD</p>
<?php }
$sql = <<<EOF
SELECT name,sid,designation from staff where gmailid='$sid';
EOF;
$query = pg_query($sql);
$cnt=1;
if(pg_num_rows($query) > 0)
{
while($row_list=pg_fetch_array($query))
{         $desig=$row_list['designation'];      ?>
                                <p><?php echo $row_list['name'];?></p>
                                <span><?php echo $row_list['sid'];?></span>
                         <?php }} ?>
                         
                        </div>
                    </div>
            


                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                <?php if ($desig=='HOD'){?>
                    <li class="no-padding"><a class="waves-effect waves-grey" href="dashboard.php"><i class="material-icons">settings_input_svideo</i>Dashboard</a></li>
                <?php } elseif($desig=='Director') {?>
                    <li class="no-padding"><a class="waves-effect waves-grey" href="stf-dashboard.php"><i class="material-icons">settings_input_svideo</i>Dashboard</a></li>
                <?php } ?>
                    <li class="no-padding"><a class="waves-effect waves-grey" href="myprofile.php"><i class="material-icons">account_box</i>My Profiles</a></li>
                    <li class="no-padding"><a class="waves-effect waves-grey" href="stf-changepassword.php"><i class="material-icons">settings_input_svideo</i>Change Password</a></li>
                    
                    <?php if ($desig!='Director'){?>     
                        <li class="no-padding">
                            <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">apps</i>Leaves<i class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="apply-leave.php">Apply Leave</a></li>
                                    <li><a href="leavehistory.php">Leave History</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>



                            <li class="no-padding">
                                <a class="waves-effect waves-grey" href="logout.php"><i class="material-icons">exit_to_app</i>Sign Out</a>
                            </li>  
                </ul>
        </div>
    </aside>