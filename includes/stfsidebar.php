  
    <aside id="slide-out" class="side-nav white fixed">
        <div class="side-nav-wrapper bg-dark">
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
                <p class="text-white">Director</p>
<?php } else if($row['designation']=='HOD'){?>
                <p class="text-white">HOD</p>
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
                                <p class="text-white"><?php echo $row_list['name'];?></p>
                                <span class="text-white"><?php echo $row_list['sid'];?></span>
                         <?php }} ?>
                         
                        </div>
                    </div>
            


                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                <?php if ($desig=='HOD'){?>
                    <li class=""><a class="waves-effect waves-grey text-white" href="dashboard.php"><i class="fas fa-building    "></i>Dashboard</a></li>
                <?php } elseif($desig=='Director') {?>
                    <li class=""><a class="waves-effect waves-grey text-white" href="stf-dashboard.php"><i class="fas fa-building    "></i>Dashboard</a></li>
                <?php } ?>
                    <li class="p-0"><a class="waves-effect waves-grey text-white" href="myprofile.php"><i class="fas fa-portrait    "></i>My Profiles</a></li>
                    <li class="no-padding"><a class="waves-effect waves-grey text-white" href="stf-changepassword.php"><i class="fas fa-user-lock    "></i>Change Password</a></li>
                    
                    <?php if ($desig!='Director'){?>     
                        <li class="no-padding">
                            <a class="collapsible-header waves-effect waves-grey text-white"><i class="fas fa-calendar-alt    "></i>Leaves<i class="fa fa-chevron-right pl-3" aria-hidden="true"></i></a>
                            <div class="collapsible-body">
                                <ul class="bg-dark">
                                    <li><a href="apply-leave.php" class="text-white">Apply Leave</a></li>
                                    <li><a href="leavehistory.php" class="text-white">Leave History</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>



                            <li class="no-padding">
                                <a class="waves-effect waves-grey text-white" href="logout.php"><i class="fas fa-sign-out-alt    "></i> Sign Out</a>
                            </li>  
                </ul>
        </div>
    </aside>