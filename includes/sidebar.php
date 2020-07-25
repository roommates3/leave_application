     <aside id="slide-out" class="side-nav white fixed bg-dark">
                <div class="side-nav-wrapper bg-dark">
                    <div class="sidebar-profile">
                        <div class="sidebar-profile-image">
                            <img src="assets/images/profile-image.png" class="circle" alt="">
                        </div>
                        <div class="sidebar-profile-info ">
                    <?php
$sid=$_SESSION['stflogin'];
$sql = <<<EOF
SELECT name,sid from staff where gmailid='$sid';
EOF;
$query = pg_query($sql);
$cnt=1;
if(pg_num_rows($query) > 0)
{
while($row_list=pg_fetch_array($query))
{               ?>
                                <p class="text-white"><?php echo $row_list['name'];?></p>
                                <span class="text-white"><?php echo $row_list['sid'];?></span>
                         <?php }} ?>
                        </div>
                    </div>

                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">

    <li class="no-padding"><a class="waves-effect waves-grey text-white" href="leavehistory.php"><i class="fas fa-building    "></i> Dashboard</a></li>

  <li class="no-padding"><a class="waves-effect waves-grey text-white" href="myprofile.php"><i class="fas fa-portrait    "></i> My Profiles</a></li>
  <li class="no-padding"><a class="waves-effect waves-grey text-white" href="stf-changepassword.php"><i class="fas fa-user-lock    "></i> Change Password</a></li>
                    <li class="no-padding">
                        <a class="collapsible-header waves-effect waves-dark text-white"><i class="fas fa-user    "></i> Leaves<i class="fa fa-chevron-right pl-3" aria-hidden="true"></i></a>
                        <div class="collapsible-body">
                            <ul class="bg-dark">
                                <li ><a href="apply-leave.php" class="text-white">Apply Leave</a></li>
                                <!-- <li><a href="leavehistory.php">Leave History</a></li> -->
                            </ul>
                        </div>
                    </li>



                  <li class="no-padding">
                                <a class="waves-effect waves-grey text-white" href="logout.php"><i class="fas fa-sign-out-alt    "></i>Sign Out</a>
                            </li>


                </ul>
                </div>
            </aside>
