<?php
/*
 * To change this tleaveate, choose Tools | Tleaveates
 * and open the tleaveate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Leave {

    public function Leave(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('leave_type','leave_duration','leave_datefrom','leave_total_day',
                             'leave_dateto','leave_period_half','leave_period_hourly','leave_reason',
                             'leave_status','leave_empl_id','leave_approvalstatus');
        $table_value = array($this->leave_type,$this->leave_duration,format_date_database($this->leave_datefrom),$this->leave_total_day,
                             format_date_database($this->leave_dateto),$this->leave_period_half,$this->leave_period_hourly,$this->leave_reason,
                             1,$_SESSION['empl_id'],$this->leave_approvalstatus);
        $remark = "Insert Apply Leave.";
        if(!$this->save->SaveData($table_field,$table_value,'db_leave','leave_id',$remark)){
           return false;
        }else{
           $this->leave_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('leave_type','leave_duration','leave_datefrom','leave_total_day',
                             'leave_dateto','leave_period_half','leave_period_hourly','leave_reason',
                             'leave_approvalstatus');
        $table_value = array($this->leave_type,$this->leave_duration,format_date_database($this->leave_datefrom),$this->leave_total_day,
                             format_date_database($this->leave_dateto),$this->leave_period_half,$this->leave_period_hourly,$this->leave_reason,
                             $this->leave_approvalstatus);
        $remark = "Update Apply Leave.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_leave','leave_id',$remark,$this->leave_id)){
           return false;
        }else{
           return true;
        }
    }
    public function updateApproveStatus(){
        $table_field = array('leave_approvalstatus');
        $table_value = array($this->leave_approvalstatus);
        $remark = "Update Approve Status.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_leave','leave_id',$remark,$this->leave_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchLeaveDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_leave WHERE leave_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->leave_id = $row['leave_id'];
            $this->leave_empl_id = $row['leave_empl_id'];
            $this->leave_type = $row['leave_type'];
            $this->leave_duration = $row['leave_duration'];
            $this->leave_datefrom = $row['leave_datefrom'];
            $this->leave_total_day = $row['leave_total_day'];
            $this->leave_dateto = $row['leave_dateto'];
            $this->leave_period_half = $row['leave_period_half'];
            $this->leave_period_hourly = $row['leave_period_hourly'];
            $this->leave_reason = $row['leave_reason'];
            $this->leave_status = $row['leave_status'];
            $this->leave_approvalstatus = $row['leave_approvalstatus'];
        }
        return $query;
    }
    public function delete(){
        $table_field = array('leave_status');
        $table_value = array(0);
        $remark = "Delete Leave.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_leave','leave_id',$remark,$this->leave_id)){
           return false;
        }else{
           return true;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        include_once 'class/Empl.php';
        $e = new Empl();
        if($action == 'create'){
            $this->leave_seqno = 10;
            $this->leave_status = 1;
            $this->leave_datefrom = system_date;
            $this->leave_dateto = system_date;
            $this->leave_total_day = 1;
            $this->leave_approvalstatus = 'Draft';
            $this->leave_duration = "full_day";
            $empl_code = $_SESSION['empl_code'];
            $empl_name = $_SESSION['empl_name'];
        }else{
            $empl_data = $e->fetchEmplDetail(" AND empl_id = '$this->leave_empl_id'","","",2);
            $empl_code = $empl_data['empl_code'];
            $empl_name = $empl_data['empl_name'];
        }
        if($this->leave_approvalstatus != "Draft"){
            $disabled = " DISABLED";
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Leave Management</title>
    <?php
    include_once 'css.php';
    $this->leavetypeCrtl = $this->select->getLeaveTypeSelectCtrl($this->leave_type);
    ?>    
    <style>
        .tablenoborder tbody tr td{
            border:none ;
        }
        .tablenoborder tbody tr td{
            border:none ;
        }
        .table-empl-detail td:nth-child(3){
            font-weight: bold;
        }
        .empl-icon-label a i{
            font-size:22px;
        }
    </style>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      <!-- include header-->
      <?php include_once 'header.php';?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Leave Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->leave_id > 0){ echo "Update Leave";}else{ echo "Apply New Leave";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='leave.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='leave.php?action=createForm'">Create New</button>
                <?php }?>
              </div>

                <form id = 'leave_form' class="form-horizontal" action = 'leave.php?action=create' method = "POST">
                  <div class="box-body">
                    <div class="col-sm-8">  
                    <div class="form-group">
                      <label  class="col-sm-2 control-label">Employee Code</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control " value = "<?php echo $empl_code;?>" placeholder="Employee Code" disabled>
                      </div>
                      <?php
                      if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],"approved")){
                      ?>
                      <label class="control-label empl-icon-label">
                          <a href = '#' id = 'empl_view' data-toggle="modal" data-target="#myModal"><i class="fa fa-user" aria-hidden="true"></i></a>
                      </label>
                      <?php
                      }
                      ?>
                    </div>
                    <div class="form-group">  
                      <label  class="col-sm-2 control-label">Employee Name</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control " value = "<?php echo $empl_name;?>" placeholder="Employee Name" disabled>
                      </div>
                    </div>                      
                    <div class="form-group">
                      <label for="leave_type" class="col-sm-2 control-label">Leave Type <?php echo $mandatory;?></label>
                      <div class="col-sm-4">
                        <select class="form-control select2" id="leave_type" name="leave_type" <?php echo $disabled;?>>
                          <?php echo $this->leavetypeCrtl;?>
                        </select>
                      </div>
                    </div>  
                    <div class="form-group">
                      <label for="leave_duration" class="col-sm-2 control-label">Leave Duration <?php echo $mandatory;?></label>
                      <div class="col-sm-4">
                        <select class="form-control select2" id="leave_duration" name="leave_duration" <?php echo $disabled;?>>
                            <option value = "full_day" <?php if($this->leave_duration == 'full_day'){ echo 'SELECTED';}?>>Full Day Leave</option>
                            <option value = "half_day" <?php if($this->leave_duration == 'half_day'){ echo 'SELECTED';}?>>Half Day Leave</option>
                            <option value = "hourly" <?php if($this->leave_duration == 'hourly'){ echo 'SELECTED';}?>>Hourly Leave</option>
                        </select>
                      </div>
                    </div>  
                     <div class="form-group">
                         <label for="leave_datefrom" class="col-sm-2 control-label">Date<span id = 'from_text'> (From)</span></label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control datepicker" id="leave_datefrom" name="leave_datefrom" value = "<?php echo format_date($this->leave_datefrom);?>" placeholder="Date (From)" <?php echo $disabled;?>>
                      </div>
                      <label  class="col-sm-2 control-label">Total Days</label>
                      <div class="col-sm-2">
                        <input type="text" style = 'text-align:right' class="form-control" id="leave_total_day" value = "<?php echo $this->leave_total_day;?>" disabled>
                      </div>
                     </div>
                      <div class="form-group" id = 'date_to_div' style = '<?php if($this->leave_duration != 'full_day'){ echo 'display:none';}?>' >
                        <label for="leave_dateto" class="col-sm-2 control-label">Date (To)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control datepicker" id="leave_dateto" name="leave_dateto" value = "<?php echo format_date($this->leave_dateto);?>" placeholder="Date (To)" <?php echo $disabled;?>>
                        </div>
                      </div>
                      <div class="form-group day_hide" id = 'half_date_selection_div' style = '<?php if($this->leave_duration != 'half_day'){ echo 'display:none';}?>' >
                        <label for="leave_period" class="col-sm-2 control-label">Leave Period</label>
                        <div class="col-sm-4">
                            <select style = 'width:100%' class="form-control select2" id = 'leave_period' name = 'leave_period_half' <?php echo $disabled;?>>
                                <option value = 'first_half' <?php if($this->leave_period_half == 'first_half'){ echo 'SELECTED';}?>>First Half</option>
                                <option value = 'second_half' <?php if($this->leave_period_half == 'second_half'){ echo 'SELECTED';}?>>Second Half</option>
                            </select>
                        </div>
                      </div> 
                      <div class="form-group day_hide" id = 'hourly_selection_div' style = '<?php if($this->leave_duration != 'hourly'){ echo 'display:none';}?>' >
                        <label for="leave_period" class="col-sm-2 control-label">Leave Period</label>
                        <div class="col-sm-4">
                            <select style = 'width:100%' class="form-control select2" id = 'leave_period' name = 'leave_period_hourly' <?php echo $disabled;?>>
                                <option value="0"> - </option>
                                <option value="1" <?php if($this->leave_period_hourly == '1'){ echo 'SELECTED';}?>>One (01) Hour</option>
                                <option value="2" <?php if($this->leave_period_hourly == '2'){ echo 'SELECTED';}?>>Two (02) Hours</option>
                                <option value="3" <?php if($this->leave_period_hourly == '3'){ echo 'SELECTED';}?>>Three (03) Hours</option>
                                <option value="4" <?php if($this->leave_period_hourly == '4'){ echo 'SELECTED';}?>>Four (04) Hours</option>
                                <option value="5" <?php if($this->leave_period_hourly == '5'){ echo 'SELECTED';}?>>Five (05) Hours</option>
                                <option value="6" <?php if($this->leave_period_hourly == '6'){ echo 'SELECTED';}?>>Six (06) Hours</option>
                                <option value="7" <?php if($this->leave_period_hourly == '7'){ echo 'SELECTED';}?>>Seven (07) Hours</option>
                                <option value="8" <?php if($this->leave_period_hourly == '8'){ echo 'SELECTED';}?>>Eight (08) Hours</option>
                            </select>
                        </div>
                      </div> 
                    <div class="form-group">
                      <label for="leave_reason" class="col-sm-2 control-label">Reason</label>
                      <div class="col-sm-4">
                            <textarea class="form-control" rows="3" id="leave_reason" name="leave_reason" placeholder="Reason" <?php echo $disabled;?>><?php echo $this->leave_reason;?></textarea>
                      </div>
                      
                      <?php
                      if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],"approved")){
                      ?>
                            <label for="leave_approvalstatus" class="col-sm-2 control-label">Approval Status</label>
                            <div class="col-sm-2">
                                <select style = 'width:100%' class="form-control select2" id = 'leave_approvalstatus' name = 'leave_approvalstatus' >
                                    <option value = 'Draft' <?php if($this->leave_approvalstatus == 'Draft'){ echo 'SELECTED';}?>>Draft</option>
                                    <option value = 'Pending' <?php if($this->leave_approvalstatus == 'Pending'){ echo 'SELECTED';}?>>Pending</option>
                                    <option value = 'Approve' <?php if($this->leave_approvalstatus == 'Approve'){ echo 'SELECTED';}?>>Approve</option>
                                    <option value = 'Reject' <?php if($this->leave_approvalstatus == 'Reject'){ echo 'SELECTED';}?>>Reject</option>
                                    <option value = 'On-Hold' <?php if($this->leave_approvalstatus == 'On-Hold'){ echo 'SELECTED';}?>>On-Hold</option>
                                </select>
                                <input type = 'hidden' value = '<?php echo $this->leave_approvalstatus;?>' name = 'org_leave_approvalstatus'/>
                            </div>
                      <?php
                      }else{ //Normal Staff
                           if($this->leave_approvalstatus != 'Draft'){
                      ?> 
                            <label for="leave_approvalstatus" class="col-sm-2 control-label">Approval Status</label>
                            <div class="col-sm-4">
                                <label for="leave_reason" class="col-sm-3 control-label" style = 'color:red;' ><b><?php echo $this->getApprovalStatus($this->leave_approvalstatus);?></b></label>
                            </div>
                            <?php 
                           }
                      }
                      ?>
                    </div> 
                    </div>
                    <div class="col-sm-4" style = 'text-align:center' >    
                            <h3>Balance Leave Detail</h3>
                            <table class = 'table table-bordered table-hover dataTable ' >
                                <tr>
                                <th>Leave Code</th>
                                <th>Entitled</th>
                                <th>Taken</th>
                                <th>Pending</th>
                                <th>Available Balance</th>
                                </tr>
                            <?php
                            if(($_SESSION['empl_group'] == '4') && ($this->leave_id > 0)){// HR
                                $wherestring = "AND el.emplleave_empl = '$this->leave_empl_id'";
                                $wherestring2 = "AND leave_empl_id = '$this->leave_empl_id'";
                            }else{
                                $wherestring = "AND el.emplleave_empl = '{$_SESSION['empl_id']}'";
                                $wherestring2 = "AND leave_empl_id = '{$_SESSION['empl_id']}'";
                            }
                            $sql = "SELECT lt.*,el.emplleave_days,el.emplleave_id
                                    FROM db_leavetype lt
                                    LEFT JOIN db_emplleave el ON el.emplleave_leavetype = lt.leavetype_id $wherestring
                                    WHERE lt.leavetype_status = 1  ORDER BY lt.leavetype_seqno,lt.leavetype_code";

                            $query = mysql_query($sql);
                            while($row = mysql_fetch_array($query)){
                               $taken = getDataCodeBySql("SUM(leave_total_day)",'db_leave'," WHERE leave_approvalstatus = 'Approve' AND leave_type = '{$row['leavetype_id']}' $wherestring2");
                               if($taken == null){
                                   $taken = 0;
                               }
                            ?>
                                <tr>
                                    <td><?php echo $row['leavetype_code'];?></td>
                                    <td><?php echo $row['emplleave_days'];?></td>
                                    <td><?php echo $taken;?></td>
                                    <td><?php echo getDataCountBySql('db_leave'," WHERE leave_approvalstatus = 'Pending' AND leave_type = '{$row['leavetype_id']}' $wherestring2");?></td>
                                    <td><?php echo num_format($row['emplleave_days'] - $taken);?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            </table>
                   </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Back</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->leave_id;?>" name = "leave_id"/>
                    <?php 
                    if($this->leave_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],"approved")){
                    ?>
                            <button type = "submit" name = 'submit_btn' value = 'Save' class="btn btn-info">Save</button>
                    <?php
                    }else{//Normal Staff
                        if($this->leave_approvalstatus == 'Draft'){
                            if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){?>
                            <button type = "submit" name = 'submit_btn' value = 'Save' class="btn btn-info">Save</button>
                            &nbsp;&nbsp;&nbsp;
                            <button type = "submit" name = 'submit_btn' value = 'Confirm' class="btn btn-danger">Confirm</button>
                            <?php 
                            }
                        }
                    }
?>
                  </div><!-- /.box-footer -->
                  
                </form>
            </div><!-- /.box -->
          </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    
    ?>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $empl_data['empl_name'];?></h4>
        </div>
        <div class="modal-body">
            <table class = 'table tablenoborder table-empl-detail'  >
                <tr>
                    <td rowspan = '5'>
                     <?php if(file_exists("dist/images/empl/{$this->leave_empl_id}.png")){?>
                     <img src="dist/images/empl/<?php echo $this->leave_empl_id;?>.png" class="img-circle" alt="User Image" style = 'width:160px;height:160px;'>
                  <?php }else{?>
                     <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="img-circle">
                    <?php }?>
                    </td>
                </tr>
                <tr>
                    <td>Email Address</td>
                    <td> : </td>
                    <td><?php echo $empl_data['empl_email'];?></td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td> : </td>
                    <td><?php echo getDataCodeBySql("department_code","db_department"," WHERE department_id = '{$empl_data['empl_department']}'");?></td>
                </tr>
                <tr>
                    <td>Mobiles</td>
                    <td> : </td>
                    <td><?php echo $empl_data['empl_mobile'];?></td>
                </tr>
                <tr>
                    <td>Outlet</td>
                    <td> : </td>
                    <td><?php echo getDataCodeBySql("outl_code","db_outl"," WHERE outl_id = '{$empl_data['empl_outlet']}'");?></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
    <script>
    $(document).ready(function() {
        $("#leave_form").validate({
                  rules: 
                  {
                      leave_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      leave_code:
                      {
                          required: "Please enter Leave Code."
                      }
                  }
              });
        $('#leave_datefrom').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            pickerPosition: "bottom-left"
             }).on('changeDate', function (ev) {

              $('#leave_dateto').datepicker('setStartDate', ev.date);
              calcBusinessDays(new Date($('#leave_datefrom').val()),new Date($('#leave_dateto').val()))
        });
        $('#leave_dateto').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate:$('#leave_datefrom').val(),
            pickerPosition: "bottom-left"
             }).on('changeDate', function (ev) {
                calcBusinessDays(new Date($('#leave_datefrom').val()),new Date($('#leave_dateto').val()))

        });
         
        $('#leave_duration').change(function(){
            $('.day_hide').css('display','none');
            if($(this).val() == 'full_day'){
                $('#from_text').text(' (From)');
                $('#date_to_div').css('display','');
                $('#leave_total_day').val(1);
            }else if($(this).val() == 'half_day'){
                $('#from_text').text('');
                $('#half_date_selection_div').css('display','');
                $('#date_to_div').css('display','none');
                $('#leave_total_day').val(0.5);
            }else{
                $('#from_text').text('');
                $('#hourly_selection_div').css('display','');
                $('#date_to_div').css('display','none');
                $('#leave_total_day').val(1);
            }
        });
       
});
  function calcBusinessDays(dDate1, dDate2) { // input given as Date objects
    var iWeeks, iDateDiff, iAdjust = 0;
    if (dDate2 < dDate1){// error code if dates transposed
         $('#leave_total_day').val(0);
    } 
    var iWeekday1 = dDate1.getDay(); // day of week
    var iWeekday2 = dDate2.getDay();
    iWeekday1 = (iWeekday1 == 0) ? 7 : iWeekday1; // change Sunday from 0 to 7
    iWeekday2 = (iWeekday2 == 0) ? 7 : iWeekday2;
    if ((iWeekday1 > 5) && (iWeekday2 > 5)) iAdjust = 1; // adjustment if both days on weekend
    iWeekday1 = (iWeekday1 > 5) ? 5 : iWeekday1; // only count weekdays
    iWeekday2 = (iWeekday2 > 5) ? 5 : iWeekday2;

    // calculate differnece in weeks (1000mS * 60sec * 60min * 24hrs * 7 days = 604800000)
    iWeeks = Math.floor((dDate2.getTime() - dDate1.getTime()) / 604800000);

    if (iWeekday1 <= iWeekday2) {
      iDateDiff = (iWeeks * 5) + (iWeekday2 - iWeekday1);
    } else 
      iDateDiff = ((iWeeks + 1) * 5) - (iWeekday1 - iWeekday2);{
    }

    iDateDiff -= iAdjust // take into account both days on weekend

    iDateDiff = iDateDiff + 1; // add 1 because dates are inclusive

        if(iDateDiff < 1){
            iDateDiff = 0;
        }
        if($('#leave_duration').val() == 'half_day'){
            iDateDiff = 0.5;
        }
        $('#leave_total_day').val(iDateDiff);

  }

    </script>
  </body>
</html>
        <?php
        
    }
    public function getListing(){
    ?>
    <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Leave Management</title>
    <?php
    include_once 'css.php';
    
    ?>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      <!-- include header-->
      <?php include_once 'header.php';?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Leave Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Leave Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='leave.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="leave_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:13%'>Employee</th>
                        <th style = 'width:10%'>Leave Type</th>
                        <th style = 'width:15%'>Reason</th>
                        <th style = 'width:10%'>Leave From</th>
                        <th style = 'width:10%'>Leave To</th>
                        <th style = 'width:10%'>Leave Days</th>
                        <th style = 'width:13%'>Status</th>
                        <th style = 'width:14%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],"approved")){
                            $wherestring = "AND l.leave_approvalstatus <> 'Draft'";
                        }else{
                            $wherestring = "AND l.leave_empl_id = '{$_SESSION['empl_id']}'";
                        }
                      $sql = "SELECT l.*,empl.empl_name,lt.leavetype_code
                              FROM db_leave l 
                              INNER JOIN db_empl empl ON empl.empl_id = l.leave_empl_id
                              INNER JOIN db_leavetype lt ON lt.leavetype_id = l.leave_type
                              WHERE l.leave_id > 0 AND l.leave_status = '1' $wherestring
                              ORDER BY l.updateDateTime";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['empl_name'];?></td>
                            <td><?php echo $row['leavetype_code'];?></td>
                            <td><?php echo nl2br($row['leave_reason']);?></td>
                            <td><?php echo format_date($row['leave_datefrom']);?></td>
                            <td><?php echo format_date($row['leave_dateto']);?></td>
                            <td><?php echo $row['leave_total_day'];?></td>
                            <td><?php echo $this->getApprovalStatus($row['leave_approvalstatus']);?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'leave.php?action=edit&leave_id=<?php echo $row['leave_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                        if($row['leave_approvalstatus'] == 'Draft'){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('leave.php?action=delete&leave_id=<?php echo $row['leave_id'];?>','Confirm Delete?')">Delete</button>
                                <?php
                                        }
                                 }
                                 ?>
                            </td>
                        </tr>
                    <?php    
                        $i++;
                      }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:13%'>Employee</th>
                        <th style = 'width:10%'>Leave Type</th>
                        <th style = 'width:15%'>Reason</th>
                        <th style = 'width:10%'>Leave From</th>
                        <th style = 'width:10%'>Leave To</th>
                        <th style = 'width:10%'>Leave Days</th>
                        <th style = 'width:13%'>Status</th>
                        <th style = 'width:14%'></th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper --><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    ?>
    <script>
      $(function () {
        $('#leave_table').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

      });
    </script>
  </body>
</html>
    <?php
    }
    public function getApprovalStatus($status){
        
        switch ($status) {
            case "Pending":

                $return_status =  "<span style = 'color:red;font-weight:bold' >$status</span>";
                break;
            case "Draft":

                $return_status =  "<span style = 'color:black;font-weight:bold' >$status</span>";
                break;
            case "Approve":

                $return_status =  "<span style = 'color:Green;font-weight:bold' >$status</span>";
                break;
            case "On-Hold":

                $return_status =  "<span style = 'color:#99a5a9;font-weight:bold' >$status</span>";
                break;
            default:
                $return_status =  "<span style = 'color:black;font-weight:bold' >Unknown Status</span>";
                break;
        }
        return $return_status;
    }
    public function calculateDateDifferent($date_form,$date_to){
        $start = new DateTime($date_form);
        $end = new DateTime($date_to);
        // otherwise the  end date is excluded (bug?)
        $end->modify('+1 day');

        $interval = $end->diff($start);

        // total days
        $days = $interval->days;

        // create an iterateable period of date (P1D equates to 1 day)
        $period = new DatePeriod($start, new DateInterval('P1D'), $end);

        // best stored as array, so you can add more than one
        $holidays = array('2012-09-07');

        foreach($period as $dt) {
            $curr = $dt->format('D');

            // for the updated question
            if (in_array($dt->format('Y-m-d'), $holidays)) {
               $days--;
            }

            // substract if Saturday or Sunday
            if ($curr == 'Sat' || $curr == 'Sun') {
                $days--;
            }
        }
        return $days;
    }

}
?>
