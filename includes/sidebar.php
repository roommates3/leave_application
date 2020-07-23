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
SELECT name,sid from staff where gmailid='$sid';
EOF;
$query = pg_query($sql);
$cnt=1;
if(pg_num_rows($query) > 0)
{
while($row_list=pg_fetch_array($query))
{               ?>
                                <p><?php echo $row_list['name'];?></p>
                                <span><?php echo $row_list['sid'];?></span>
                         <?php }} ?>
                        </div>
                    </div>

                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">

    <li class="no-padding"><a class="waves-effect waves-grey" href="leavehistory.php"><i class="fas fa-building    "></i> Dashboard</a></li>

  <li class="no-padding"><a class="waves-effect waves-grey" href="myprofile.php"><i class="fas fa-portrait    "></i> My Profiles</a></li>
  <li class="no-padding"><a class="waves-effect waves-grey" href="stf-changepassword.php"><i class="fas fa-user-lock    "></i> Change Password</a></li>
                    <li class="no-padding">
                        <a class="collapsible-header waves-effect waves-grey"><i class="fas fa-user    "></i> Leaves<i class="fa fa-chevron-right pl-3" aria-hidden="true"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="apply-leave.php">Apply Leave</a></li>
                                <!-- <li><a href="leavehistory.php">Leave History</a></li> -->
                            </ul>
                        </div>
                    </li>



                  <li class="no-padding">
                                <a class="waves-effect waves-grey" href="logout.php"><i class="fas fa-sign-out-alt    "></i>Sign Out</a>
                            </li>


                </ul>
                </div>
            </aside>
