<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Attendance {

    public function Attendance(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('attendance_empl','attendance_timein','attendance_timeout','attendance_project','attendance_date');
        $table_value = array($this->attendance_empl,$this->attendance_timein,$this->attendance_timeout,$this->attendance_project,system_date);
        $remark = "Insert Attendance.";
        if(!$this->save->SaveData($table_field,$table_value,'db_attendance','attendance_id',$remark)){
           return false;
        }else{
           $this->attendance_id = $this->save->lastInsert_id; 
           return true;
        }
    }
    public function update(){
        $table_field = array('attendance_code','attendance_name','description','seq_no','status');
        $table_value = array($this->attendance_code,$this->attendance_name,$this->description,$this->seq_no,$this->status);
        $remark = "Update Attendance.";
        if(!$this->save->UpdateData($table_field,$table_value,'attendance','attendance_id',$remark,$this->attendance_id)){
           return false;
        }else{
           return true;
        }
    }
    public function delete(){
        if($this->save->DeleteData("attendance"," WHERE attendance_id = '$this->attendance_id'","Delete Attendance.")){
            return true;
        }else{
            return false;
        }
    }
    public function fetchAttendanceDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT c.*
                FROM db_attendance c
                WHERE c.attendance_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->attendance_id = $row['attendance_id'];
            $this->attendance_code = $row['attendance_code'];
            $this->attendance_name = $row['attendance_name'];
            $this->description = $row['description'];
            $this->seq_no = $row['seq_no'];
            $this->status = $row['status'];
        }
        return $query;
    }
    public function getListing(){
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Attendance Management</title>
	<meta name="description" content="Attendance">
	<meta name="author" content="Jason">
	<meta name="keyword" content="Pro Vision">
	<!-- end: Meta -->
	<?php 
            include "include_helper.php";
        ?>
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->	
</head>
<body>
	<!-- start: Header -->
	<?php 
            include "top_menu.php";
        ?>
	<!-- start: Header -->
	<div class="container-fluid-full">
            <div class="row-fluid">
            <!-- start: Main Menu -->
            <?php 
            include "left_menu.php";
            ?>
            <!-- end: Main Menu -->	
    <!-- start: Content -->
    <div id="content" class="span10">
        <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="dashboard.php">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><i class="icon-table"></i><a href="#">Listing</a></li>
        <?php if($_SESSION['user_group'] == 2){?>
        <li style = 'float:right;padding-top:6px;padding-right:10px'>
            <i class="icon-plus-sign"></i>
            <a href="attendance.php?action=createForm">Create New Attendance</a>
        </li>
        <?php }?>
        </ul>
        <?php if($_SESSION['status_alert'] != ""){?>
            <div id = 'status_msg' class="alert <?php echo $_SESSION['status_alert'];?>">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo $_SESSION['status_msg']; unset($_SESSION['status_msg']);unset($_SESSION['status_alert']);?></strong>
            </div>
        <?php }?>
    <script>
      function deleteAttendance(attendance_id){
          if(confirm('Confirm delete?')){
              window.location.href = "attendance.php?action=delete&attendance_id="+attendance_id;
          }else{
              return false;
          }
      }  
    </script>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header">
                <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Attendance List</h2>
                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th style = 'width:5%'>No.</th>
                            <th style = 'width:15%'>Attendance Code</th>
                            <th style = 'width:15%'>Attendance Name</th>
                            <th style = 'width:40%'>Description</th>
                            <th style = 'width:10%'>Status</th>
                            <th style = 'width:10%'></th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        $query = $this->fetchAttendanceDetail();
                        $i = 1;
                        while($row = mysql_fetch_array($query)){
                        ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $row['attendance_code'];?></td>
                                <td><?php echo $row['attendance_name'];?></td>
                                <td><?php echo $row['description'];?></td>
                                <td>
                                    <?php getListingStatus($row['status']); ?>
                                </td>
                                <td>
                                    <a class="btn btn-info" href="attendance.php?action=edit&attendance_id=<?php echo $row['attendance_id'];?>">
					<i class="halflings-icon white edit"></i>  
                                    </a>
                                    <?php if($_SESSION['user_group'] == 2){?>
                                    <a class="btn btn-danger" href="#" onclick = "deleteAttendance('<?php echo $row['attendance_id'];?>')">
					<i class="halflings-icon white trash"></i> 
                                    </a>
                                    <?php }?>
                                </td>
                            </tr> 
                        <?php
                        $i++;
                        }
                        ?>                                       
                    </tbody>
                </table>  
     
            </div>
        </div><!--/span-->
    </div><!--/row-->
    </div><!--/.fluid-container-->
    <!-- end: Content -->
    </div><!--/#content.span10-->
    </div><!--/fluid-row-->

	<div class="clearfix"></div>
	
	<?php include_once '../customer/footer.php';?>
</body>
</html>

    <?php
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->penalty_rate = "0.0000";
            $this->interest_rate = "0.0000";
            $this->attendance_point = '0.00';
        }

        
         if($_SESSION['user_group'] == 1){
             $disabled = ' disabled';
         }
         if($this->attendance_id <= 0){
             $this->seq_no = 10;
             $this->status = 1;
         }
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Attendance Management</title>
	<meta name="description" content="Attendance Management">
	<meta name="author" content="Jason">
	<meta name="keyword" content="Pro Vision">
	<!-- end: Meta -->
	<?php 
            include "include_helper.php";
        ?>
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->	
        <script>
        $(document).ready(function(){
            $('#attendance_code').focus();
            $("#attendance_form").validate({
                  rules: 
                  {
                      attendance_code:
                      {
                          required: true,
                          remote: {
                            url: "attendance.php?action=validate_attendance",
                            type: "post",
                            data: 
                            {
                                attendance_id: function()
                                {
                                    return $("#attendance_id").val();
                                }
                            }
                          }
                      },
                      attendance_name:
                      {
                          required: true
                      }

                  },
                  messages:
                  {
                      attendance_code:
                      {
                          required: "Please enter target property.",
                          remote: "The Attendance is already in use."
                      },
                      attendance_name:
                      {
                          required: "Please enter mth repayment."
                      }
                  }
              });
        });
  
        </script> 
</head>
<body>
	<!-- start: Header -->
	<?php 
            include "top_menu.php";
        ?>
	<!-- start: Header -->
    <div class="container-fluid-full">
        <div class="row-fluid">
        <!-- start: Main Menu -->
        <?php 
        include "left_menu.php";
        ?>
        <!-- end: Main Menu -->
        <!-- start: Content -->
            <div id="content" class="span10">
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="dashboard.php">Home</a>
                        <i class="icon-angle-right"></i> 
                    </li>
                    <li>
                        <i class="icon-table"></i>
                        <a href="attendance.php">Listing</a>
                        <i class="icon-angle-right"></i> 
                    </li>
                    <li>
                        <i class="icon-edit"></i>
                        <a href="#">Attendance Management</a>
                    </li>
                    <?php if($_SESSION['user_group'] == 2){?>
                    <li style = 'float:right;padding-top:6px;padding-right:10px'>
                        <i class="icon-plus-sign"></i>
                        <a href="attendance.php?action=createForm">Create New Attendance</a>
                    </li>
                    <?php }?>
                </ul>
             <?php if($_SESSION['status_alert'] != ""){?>
            <div id = 'status_msg' class="alert <?php echo $_SESSION['status_alert'];?>">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo $_SESSION['status_msg']; unset($_SESSION['status_msg']);unset($_SESSION['status_alert']);?></strong>
            </div>
           <?php }?>
            <div class="row-fluid sortable">
                <div class="box span12">
                <div class="box-header" data-original-title>
                <h2><i class="halflings-icon white edit"></i><span class="break"></span><?php if($this->attendance_id > 0){ echo 'Update Attendance';}else{ echo 'Create New Attendance';}?></h2>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" id = "attendance_form" method="post" enctype="multipart/form-data" >
                        <fieldset>
                            <div>
                                <div class="control-group" style = "width:50%;float:left">
                                    <label class="control-label" for="seq_no">Seq No. </label>
                                    <div class="controls">
                                    <input type="text" class="input-medium " value = "<?php echo $this->seq_no;?>" <?php echo $disabled;?> id="seq_no" name="seq_no">
                                    </div>
                                </div>
                                <div class="control-group" style = "width:50%;float:left">
                                        <label class="control-label">Status</label>
                                        <div class="controls">
                                          <label class="radio">
                                                <input type="radio" name="status" id="status_y" <?php echo $disabled;?> value="1" <?php if($this->status == 1){ echo 'checked';} ?>>
                                                Active
                                          </label>
                                          <div style="clear:both"></div>
                                          <label class="radio">
                                                <input type="radio" name="status" id="status_n" <?php echo $disabled;?> value="0" <?php if($this->status == 0){ echo 'checked';} ?>>
                                                In-active
                                          </label>
                                        </div>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div>
                                <div class="control-group" style = "width:50%;float:left">
                                    <label class="control-label" for="attendance_code">Attendance Code <?php echo $mandatory;?></label>
                                    <div class="controls">
                                    <input type="text" class="input-medium " value = "<?php echo $this->attendance_code;?>" <?php echo $disabled;?> id="attendance_code" name="attendance_code">
                                    </div>
                                </div>
                                <div class="control-group" style = "width:50%;float:left">
                                    <label class="control-label" for="attendance_name">Attendance Name <?php echo $mandatory;?></label>
                                    <div class="controls">
                                    <input type="text" class="input-medium" value = "<?php echo $this->attendance_name;?>" <?php echo $disabled;?> id="attendance_name" name="attendance_name">
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div>
                               <div class="control-group hidden-phone" style = "width:100%;float:left">
                                    <label class="control-label" for="description">Description</label>
                                    <div class="controls">
                                    <textarea id="target_period_remark" name="description" <?php echo $disabled;?> rows="3" ><?php echo $this->description;?></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div style="clear:both"></div>
                            <div class="form-actions">
                                <input type = "hidden" name = "attendance_id" id = 'attendance_id' value = "<?php echo $this->attendance_id;?>"/>
                                <input type = "hidden" name = "action" value = "<?php echo $action;?>"/>
                                <?php if($_SESSION['user_group'] == 2){?>
                                <button type="submit" class="btn btn-primary"  id = 'save_changes'>Save changes</button>
                                <?php }?>
                                <button type="button" class="btn" onclick = "window.location.href = 'attendance.php'">Back</button>
                            </div>
                        </fieldset>                           
                    </form>  
                </div>
                </div><!--/span-->
            </div><!--/row-->
        </div><!--/.fluid-container-->
    <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row--><?php include_once '../customer/footer.php';?>
</body>
</html>

            
        <?php
        
    }
    public function validateAttendance($attendance_code,$attendance_id){
        if($attendance_code != ""){
            if($attendance_id > 0){
                $wherestring = " AND attendance_id != '$attendance_id'";
            }
            $sql = "SELECT COUNT(*) as total FROM attendance WHERE attendance_code = '$attendance_code' $wherestring";
            $query = mysql_query($sql);
            if($row = mysql_fetch_array($query)){
                $total = $row['total'];
            }else{
                $total = 0;
            }
            if($total > 0){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
    public function updateTimeOut(){
        $table_field = array('attendance_timeout');
        $table_value = array($this->attendance_timeout);
        $remark = "Update Attendance.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_attendance','attendance_id',$remark,$this->attendance_id)){
           return false;
        }else{
           return true;
        }
    }
}
?>
