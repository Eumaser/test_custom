<header class="main-header">
<nav class="navbar navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <a href="dashboard.php" class="navbar-brand"><b>SKS</b></a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
        <i class="fa fa-bars"></i>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
      <ul class="nav navbar-nav">
        <?php
        $sql = "SELECT *
                FROM db_menu
                WHERE menu_parent = 0 AND menu_status = 1 ORDER BY menu_seqno";
        $query = mysql_query($sql);
        $i = 0;

        $file_server_name = explode('/',$_SERVER["PHP_SELF"]);
        while($row = mysql_fetch_array($query)){
            if(!getWindowPermission($row['menu_id'],'access')){
                continue;
            }
            if($file_server_name[2] == $row['menu_path']){
                $_SESSION['m'][$_SESSION['empl_id']] = $row['menu_id'];

            }else{
                $active = "";
            }
            $wherestring = " menu_parent = '{$row['menu_id']}' AND menu_path = '{$file_server_name[2]}'";

            if(checkMenuChildren($wherestring) > 0 || (($file_server_name[2]  == "dashboard.php") && ($row['menu_path']  == "dashboard.php"))){
                $active = "active ";
            }else{
                $active = "";
            }
        ?>
        <li class="<?php echo $active; if($row['menu_path'] == ""){ echo 'drowdown';}?>">
            <a href="<?php echo $row['menu_path'];?>" <?php if($row['menu_path'] == ""){ echo 'data-toggle="dropdown"';}?>>
                <?php
                 if($_SESSION['empl_language'] == 'chinese'){
                     if($row['menu_namecn']){
                        echo $row['menu_namecn'];
                     }else{
                        echo $row['menu_name'];
                     }
                 }else{
                     echo $row['menu_name'];
                 }

                if($row['menu_path'] == ""){
                    echo '<span class="caret"></span>';
                }
                ?>
            </a>
            <?php if($row['menu_path'] == ""){?>
            <ul class="dropdown-menu" role="menu">
              <?php
                $sql1 = "SELECT * FROM db_menu WHERE menu_parent = '{$row['menu_id']}' AND menu_status = 1 ORDER BY menu_seqno";
                $query1 = mysql_query($sql1);
                while($row1 = mysql_fetch_array($query1)){
                    if(!getWindowPermission($row1['menu_id'],'access')){
                        continue;
                    }
                    if($file_server_name[2] == $row1['menu_path']){
                        $_SESSION['m'][$_SESSION['empl_id']] = $row1['menu_id'];
                    }
              ?>
                 <li>
                     <a href="<?php echo $row1['menu_path'];?>">
                         <?php
                         if($_SESSION['empl_language'] == 'chinese'){
                            if($row1['menu_namecn']){
                               echo $row1['menu_namecn'];
                            }else{
                               echo $row1['menu_name'];
                            }
                         }else{
                             echo $row1['menu_name'];
                         }
                         ?>
                     </a>
                 </li>
              <?php
                }
              ?>
            </ul>
            <?php }?>
        </li>
        <?php
        $i++;
        }
        ?>
        <!--<li>
                     <a href="http://crmdemo.firstcomdemolinks.com/kcparts/" target = '_blank' >
                         Old System
                     </a>
                 </li>-->
      </ul>
    </div><!-- /.navbar-collapse -->
    <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
<!--          <li class="dropdown messages-menu">
             Menu toggle button
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                 inner menu: contains the messages
                <ul class="menu">
                  <li> start message
                    <a href="#">
                      <div class="pull-left">
                         User Image
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                       Message title and timestamp
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                       The message
                      <p>message</p>
                    </a>
                  </li> end message
                </ul> /.menu
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li> /.messages-menu -->

          <!-- Notifications Menu -->
<!--          <li class="dropdown notifications-menu">
             Menu toggle button
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                 Inner Menu: contains the notifications
                <ul class="menu">
                  <li> start notification
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li> end notification
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>-->
          <!-- Tasks Menu -->
<!--          <li class="dropdown tasks-menu">
             Menu Toggle Button
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                 Inner menu: contains the tasks
                <ul class="menu">
                  <li> Task item
                    <a href="#">
                       Task title and progress text
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                       The progress bar
                      <div class="progress xs">
                         Change the css width attribute to simulate progress
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li> end task item
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>-->
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
                  <?php if(file_exists("dist/images/empl/{$_SESSION['empl_id']}.png")){?>
                     <img src="dist/images/empl/<?php echo $_SESSION['empl_id'];?>.png" class="user-image" alt="User Image">
                  <?php }else{?>
                     <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                    <?php }?>
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $_SESSION['empl_name'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                  <?php if(file_exists("dist/images/empl/{$_SESSION['empl_id']}.png")){?>
                     <img src="dist/images/empl/<?php echo $_SESSION['empl_id'];?>.png" class="img-circle" alt="User Image">
                  <?php }else{?>
                     <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <?php }?>

                <p>
                  <?php echo $_SESSION['empl_name'];?>
                  <small></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="col-xs-6 text-center">
                  <a href="javascript:void(0)" class = 'btn btn-block btn-default btn-sm top_language' language = 'english'>English</a>
                </div>
                <div class="col-xs-6 text-center">
                  <a href="javascript:void(0)" class = 'btn btn-block btn-default btn-sm top_language' language = 'chinese'>Chinese</a>
                </div>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
<!--                <div class="pull-left">
                  <a href="empl.php?action=edit&empl_id=<?php echo $_SESSION['empl_id'];?>" class="btn btn-default btn-flat">Profile</a>
                </div>-->
                <div class="pull-right">
                  <a href="login.php?action=logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-custom-menu -->
  </div><!-- /.container-fluid -->
</nav>
</header>
