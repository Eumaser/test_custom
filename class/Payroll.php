<?php
/*
 * To change this tpayrollate, choose Tools | Tpayrollates
 * and open the tpayrollate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Payroll {

    public function Payroll(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('payroll_outlet','payroll_department','payroll_salary_date','payroll_startdate',
                             'payroll_enddate','payroll_status');
        $table_value = array($this->payroll_outlet,$this->payroll_department,format_date_database($this->payroll_salary_date),format_date_database($this->payroll_startdate),
                             format_date_database($this->payroll_enddate),$this->payroll_status);
        $remark = "Insert Payroll.";
        if(!$this->save->SaveData($table_field,$table_value,'db_payroll','payroll_id',$remark)){
           return false;
        }else{
           $this->payroll_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('payroll_title','payroll_date','payroll_remark','payroll_status',
                             'payroll_empl_id','payroll_approvalstatus');
        $table_value = array($this->payroll_title,format_date_database($this->payroll_date),$this->payroll_remark,1,
                             $_SESSION['empl_id'],$this->payroll_approvalstatus);
        $remark = "Update Apply Payroll.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_payroll','payroll_id',$remark,$this->payroll_id)){
           return false;
        }else{
           $this->createUpdatePayrollLine();
           return true;
        }
    }
    public function updateApproveStatus(){
        $table_field = array('payroll_approvalstatus');
        $table_value = array($this->payroll_approvalstatus);
        $remark = "Update Approve Status.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_payroll','payroll_id',$remark,$this->payroll_id)){
           return false;
        }else{
           return true;
        }
    }
    public function createUpdatePayrollLine(){

        include_once 'Payrolltype.php';
        $ct = new Payrolltype();
        $true = true;
        $total_payroll_amount = 0;
        for($i=1;$i<=sizeof($this->payrollline_type_array);$i++){
            if($this->payrollline_type_array[$i] <= 0){
                continue;//skip if user not pick
            }
            $payroll_amount = str_replace(",", "",$this->payrollline_amount_array[$i]);
            $ct->fetchPayrolltypeDetail(" AND payrolltype_id = '{$this->payrollline_type_array[$i]}'","","",1);
            if($ct->payrolltype_maxamt > 0){
                if($payroll_amount > $ct->payrolltype_maxamt){
                   $payroll_amount = $ct->payrolltype_maxamt;
                }
            }
            $table_field = array('payrollline_seqno','payrollline_date','payrollline_type','payrollline_desc',
                                 'payrollline_receiptno','payrollline_amount','payrollline_payroll_id');
            $table_value = array($this->payrollline_seqno_array[$i],format_date_database($this->payrollline_date_array[$i]),$this->payrollline_type_array[$i],$this->payrollline_desc_array[$i],
                                 $this->payrollline_receiptno_array[$i],$payroll_amount,$this->payroll_id);
            
            if($this->payrollline_id_array[$i] > 0){
                $remark = "Update Payroll Lines.";
                if(!$this->save->UpdateData($table_field,$table_value,'db_payrollline','payrollline_id',$remark,$this->payrollline_id_array[$i]," AND payrollline_payroll_id = '$this->payroll_id'")){
                   $true = false;
                }else{

                } 
            }else{
                $remark = "Insert Payroll Lines.";
                if(!$this->save->SaveData($table_field,$table_value,'db_payrollline','payrollline_id',$remark)){
                   $true = false;
                }else{

                } 
            }
            if(is_numeric($payroll_amount)){
                $total_payroll_amount = $total_payroll_amount + $payroll_amount;
            }
        }
        $this->UpdatePayrollAmount($total_payroll_amount);

    }
    public function UpdatePayrollAmount($total_payroll_amount){
            $table_field = array('payroll_amount');
            $table_value = array($total_payroll_amount);
            $remark = "Update Payroll Amount.";
            if(!$this->save->UpdateData($table_field,$table_value,'db_payroll','payroll_id',$remark,$this->payroll_id)){
               return false;
            }else{
                return true;
            } 
    }
    public function UpdatePayrollSingleLine(){
            $table_field = array('payrollline_seqno','payrollline_date','payrollline_type','payrollline_desc',
                                 'payrollline_receiptno','payrollline_amount');
            $table_value = array($this->payrollline_seqno_array,format_date_database($this->payrollline_date_array),$this->payrollline_type_array,$this->payrollline_desc_array,
                                 $this->payrollline_receiptno_array,$this->payrollline_amount_array);
            $remark = "Update Payroll Lines.";
            if(!$this->save->UpdateData($table_field,$table_value,'db_payrollline','payrollline_id',$remark,$this->payrollline_id," AND payrollline_payroll_id = '$this->payroll_id'")){
               return false;
            }else{
                return true;
            } 
    }
    public function fetchPayrollDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_payroll WHERE payroll_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->payroll_id = $row['payroll_id'];
            $this->payroll_outlet = $row['payroll_outlet'];
            $this->payroll_department = $row['payroll_department'];
            $this->payroll_salary_date = $row['payroll_salary_date'];
            $this->payroll_startdate = $row['payroll_startdate'];
            $this->payroll_enddate = $row['payroll_enddate'];
            $this->payroll_status = $row['payroll_status'];
        }
        return $query;
    }
    public function delete(){
        $table_field = array('payroll_status');
        $table_value = array(0);
        $remark = "Delete Payroll.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_payroll','payroll_id',$remark,$this->payroll_id)){
           return false;
        }else{
           return true;
        }
    }
    public function deletePayrollLine(){
        if($this->save->DeleteData("db_payrollline"," WHERE payrollline_payroll_id = '$this->payroll_id' AND payrollline_id = '$this->payrollline_id'","Delete {$this->payroll_id} Order Line.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        include_once 'class/Empl.php';
        $e = new Empl();
        if($action == 'create'){
            $this->payroll_seqno = 10;
            $this->payroll_status = 1;
            $this->payroll_startdate = system_date_monthstart;
            $this->payroll_enddate = system_date_monthend;
            $this->payroll_salary_date = system_date;
            $this->payroll_total_day = 1;
            $this->payroll_approvalstatus = 'Draft';
            $this->payroll_duration = "full_day";
            $empl_data = $e->fetchEmplDetail(" AND empl_id = '{$_SESSION['empl_id']}'","","",2);
            $empl_code = $_SESSION['empl_code'];
            $empl_name = $_SESSION['empl_name'];
        }else{
            $empl_data = $e->fetchEmplDetail(" AND empl_id = '$this->payroll_empl_id'","","",2);
            $empl_code = $empl_data['empl_code'];
            $empl_name = $empl_data['empl_name'];
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Payroll Management</title>
    <?php
    include_once 'css.php';
    $this->outletCrtl = $this->select->getOutletSelectCtrl($this->payroll_outlet);
    $this->departmentCrtl = $this->select->getDepartmentSelectCtrl($this->payroll_department);
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
            <h1>Payroll Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->payroll_id > 0){ echo "Update Payroll";}else{ echo "Apply New Payroll";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='payroll.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='payroll.php?action=createForm'">Create New</button>
                <?php }?>
              </div>

                <form id = 'payroll_form' class="form-horizontal" action = 'payroll.php?action=create' method = "POST">
                  <div class="box-body">
                    <div class="col-sm-12">  
                    <div class="form-group">
                      <label for ="payroll_outlet" class="col-sm-2 control-label">Outlet</label>
                      <div class="col-sm-2">
                        <select class="form-control select2" id="payroll_outlet" name="payroll_outlet">
                          <?php echo $this->outletCrtl;?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">  
                      <label for ="payroll_department" class="col-sm-2 control-label">Departments</label>
                      <div class="col-sm-2">
                        <select class="form-control select2" id="payroll_department" name="payroll_department">
                          <?php echo $this->departmentCrtl;?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="payroll_salary_date" class="col-sm-2 control-label">Salary Date <?php echo $mandatory;?></label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control datepicker" id="payroll_salary_date" name="payroll_salary_date" value = "<?php echo format_date($this->payroll_salary_date);?>" placeholder="Payroll Salary Date" <?php echo $disabled;?>>
                      </div>
                    </div>
                     <div class="form-group">
                         <label for="payroll_startdate" class="col-sm-2 control-label">Payslip Period (Start Date)</label>
                      <div class="col-sm-2">
                          <input type="text" class="form-control datepicker" id="payroll_startdate" name="payroll_startdate" value = "<?php echo format_date($this->payroll_startdate);?>" placeholder="Payslip Period (Start Date)" <?php echo $disabled;?>>
                      </div>
                     </div> 
                     <div class="form-group">
                         <label for="payroll_enddate" class="col-sm-2 control-label">Payslip Period (End Date)</label>
                      <div class="col-sm-2">
                          <input type="text" class="form-control datepicker" id="payroll_enddate" name="payroll_enddate" value = "<?php echo format_date($this->payroll_enddate);?>" placeholder="Payslip Period (End Date)" <?php echo $disabled;?>>
                      </div>
                     </div>  
                     <div class="form-group">
                      <div class="col-sm-2">
                          
                      </div>
                      <div class="col-sm-2">
                          <button type = 'button' class = 'btn btn-info preview_payslips' style = 'margin-top:15px;' >Preview Payslips</button>
                      </div>
                     </div>
                    </div>
                      <div style = 'clear:both'></div>  
                        
                        <?php echo $this->getAddItemDetailForm();?>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Back</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->payroll_id;?>" name = "payroll_id"/>
                    <?php 
                    if($this->payroll_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],"approved")){// HR
                         if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'approved')){
                    ?>
                            <button type = "submit" name = 'submit_btn' value = 'Save' class="btn btn-info">Save</button>
                    <?php
                         }
                    }else{//Normal Staff
                        if($this->payroll_approvalstatus == 'Draft'){
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
                     <?php if(file_exists("dist/images/empl/{$this->payroll_empl_id}.png")){?>
                     <img src="dist/images/empl/<?php echo $this->payroll_empl_id;?>.png" class="img-circle" alt="User Image"  >
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
    var line_copy = '<tr id = "line_@i" class="tbl_grid_odd" line = "@i">' +
                    '<td style = "width:5%;padding-left:5px">@i</td>' + 
                    '<td style = "width:10%;"><input type = "text" name = "payrollline_seqno[@i]" id = "payrollline_seqno_@i" class="form-control" value="@i"/></td>'+
                    '<td style = "width:10%;"><input type = "text" name = "payrollline_date[@i]" id = "payrollline_date_@i" class="form-control datepicker" value=""/></td>'+
                    '<td style = "width:10%;"><select name = "payrollline_type[@i]" id = "payrollline_type_@i" class="form-control select2 "><?php echo $this->payrolltypeCrtl;?></select></td>'+
                    '<td class = "width:30%;"><textarea name = "payrollline_desc[@i]" id = "payrollline_desc_@i" class="form-control"></textarea></td>'+
                    '<td style = "width:15%;"><input type = "text" name = "payrollline_receiptno[@i]" id = "payrollline_receiptno_@i" class="form-control"/></td>'+
                    '<td style = "width:10%;"><input type = "text" name = "payrollline_amount[@i]" id = "payrollline_amount_@i" line = "@i" class="form-control calculate text-align-right" /></td>'+


                    '<td align = "center" class = "" style ="vertical-align:top;min-width:10%;padding-right:10px;padding-left:5px">' +
                    //'<a style = "margin-left:10px;margin-right:10px;" href = "#" id = "save_line_@i" payrollline_id = "" class = "save_line font-icon" line = "@i" ><i class="fa fa-plus" aria-hidden="true"></i></a>' + 
                    //'<a style = "margin-left:10px;margin-right:10px;" href = "#" id = "delete_line_@i" payrollline_id = "" class = "delete_line font-icon" line = "@i" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>' + 
                    '</td>'+
                    '</tr>';
    $(document).ready(function() {
        $('.preview_payslips').on('click',function(){
            getPayslipsListing();
        });
        $("#payroll_form").validate({
                  rules: 
                  {
                      payroll_title:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      payroll_title:
                      {
                          required: "Please enter Payroll Title."
                      }
                  }
        });
});
    var issend = false;
    function getPayslipsListing(){
        if(issend){
            alert("Please wait...");
            return false;
        }

        issend = true;


        var data = "payroll_outlet="+$('#payroll_outlet').val();
            data += "&payroll_department="+$('#payroll_department').val();
            data += "&payroll_salary_date="+$('#payroll_salary_date').val();
            data += "&payroll_startdate="+$('#payroll_startdate').val();
            data += "&payroll_enddate="+$('#payroll_enddate').val();
            data += "&action=previewPayslip";

        $.ajax({ 
            type: 'POST',
            url: 'payroll.php',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("System Error.");
                issend = false;
            },
            success: function(data) {
                issend = false;
               var jsonObj = eval ("(" + data + ")");
               var row = "";
               var b = 1;
               $('.payslipslisting').remove();
               var grand_amt = 0;
               if(jsonObj){
               for(var i = 0;i<jsonObj.length;i++){
                   row = row + "<tr class = 'payslipslisting'>"
                         + "<td>" + b + "</td>"
                         + "<td>" + jsonObj[i]['empl_name'] + "</td>"
                         + "<td>" + jsonObj[i]['department_code'] + "</td>"
                         + "<td style = 'text-align:right'>" + changeNumberFormat(RoundNum(jsonObj[i]['salary'],2)) + "</td>"
                         + "<td style = 'text-align:right'>" + changeNumberFormat(RoundNum(jsonObj[i]['empl_addtional'],2)) + "</td>"
                         + "<td style = 'text-align:right'>" + changeNumberFormat(RoundNum(jsonObj[i]['empl_deductions'],2)) + "</td>"
                         + "<td style = 'text-align:right'>" + changeNumberFormat(RoundNum(jsonObj[i]['cpf_employee'],2)) + "</td>"
                         + "<td style = 'text-align:right'>" + changeNumberFormat(RoundNum(((parseFloat(jsonObj[i]['empl_addtional']) + parseFloat(jsonObj[i]['salary'])) - (parseFloat(jsonObj[i]['empl_deductions']) + parseFloat(jsonObj[i]['cpf_employee']))),2)) + "</td>"
                         + "<td style = 'text-align:right'><a href = 'payroll.php?action=previewPayslipDetail&empl_id=" + jsonObj[i]['empl_id'] + "&payroll_startdate=" + jsonObj[i]['payroll_startdate'] +"&payroll_enddate="+ jsonObj[i]['payroll_enddate'] +"' class='btn btn-info ' target = '_blank'> View </a></td>"
                         + "</tr>";
                         grand_amt = parseFloat(grand_amt) + ((parseFloat(jsonObj[i]['empl_addtional']) + parseFloat(jsonObj[i]['salary'])) - (parseFloat(jsonObj[i]['empl_deductions']) + parseFloat(jsonObj[i]['cpf_employee'])));
                         
                 b++;
               }
               row = row + "<tr class = 'payslipslisting'><td colspan = '7' style = 'text-align:right;font-weight:bold;font-size:16px;'> Total : </td><td style = 'text-align:right;font-weight:bold;font-size:16px;' >" + changeNumberFormat(RoundNum(grand_amt,2)) + "</td><td></td></tr>";
               }else{
                   row = row + "<tr class = 'payslipslisting'><td colspan = '7' style = 'text-align:center;font-weight:bold;font-size:16px;'> No Record Found.</td></tr>";
               }
               $('#detail_last_tr').before(row);
               
            }		
         });
         return false;
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
    <title>Payroll Management</title>
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
            <h1>Payroll Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Payroll Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='payroll.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="payroll_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:13%'>Employee</th>
                        <th style = 'width:10%'>Title</th>
                        <th style = 'width:10%'>Date</th>
                        <th style = 'width:25%'>Remark</th>
                        <th style = 'width:10%'>Amount</th>
                        <th style = 'width:13%'>Status</th>
                        <th style = 'width:14%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],"approved")){// HR
                            $wherestring = "AND l.payroll_approvalstatus <> 'Draft'";
                        }else{
                            $wherestring = "AND l.payroll_empl_id = '{$_SESSION['empl_id']}'";
                        }
                      $sql = "SELECT l.*,empl.empl_name
                              FROM db_payroll l 
                              INNER JOIN db_empl empl ON empl.empl_id = l.payroll_empl_id
                             
                              WHERE l.payroll_id > 0 AND l.payroll_status = '1' $wherestring
                              ORDER BY l.updateDateTime";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['empl_name'];?></td>
                            <td><?php echo $row['payroll_title'];?></td>
                            <td><?php echo format_date($row['payroll_date']);?></td>
                            <td><?php echo nl2br($row['payroll_remark']);?></td>
                            <td><?php echo num_format(getDataCodeBySql("SUM(payrollline_amount)","db_payrollline"," WHERE payrollline_payroll_id = '{$row['payroll_id']}'",""));?></td>
                            <td><?php echo $this->getApprovalStatus($row['payroll_approvalstatus']);?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'payroll.php?action=edit&payroll_id=<?php echo $row['payroll_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                        if($row['payroll_approvalstatus'] == 'Draft'){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('payroll.php?action=delete&payroll_id=<?php echo $row['payroll_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:10%'>Title</th>
                        <th style = 'width:10%'>Date</th>
                        <th style = 'width:25%'>Remark</th>
                        <th style = 'width:10%'>Amount</th>
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
        $('#payroll_table').DataTable({
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
    public function getAddItemDetailForm(){
    $line = 0;  
    if($this->payroll_approvalstatus <> 'Draft'){
        $disabled = " DISABLED";
    }
    ?>    
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:5%;padding-left:5px">No</th>
            <th class = "" style = 'width:10%;'>Employee Name</th>
            <th class = "" style = 'width:10%;'>Department</th>
            <th class = "" style = 'width:10%;text-align:right'>Salary</th>
            <th class = "" style = 'width:15%;text-align:right'>Additional</th>
            <th class = "" style = 'width:15%;text-align:right'>Deductions</th>
            <th class = "" style = 'width:15%;text-align:right'>CPF</th>
            <th class = "" style = 'width:10%;text-align:right'>Total</th>
            <th class = "" style="width:10%;text-align:right"></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM db_payrollline WHERE payrollline_id > 0 AND payrollline_payroll_id > 0 AND payrollline_payroll_id = '$this->payroll_id' ORDER BY payrollline_seqno";
            $query = mysql_query($sql);
            while($row = mysql_fetch_array($query)){
                $line++;
                $this->payrolltypelineCrtl = $this->select->getPayrollTypeSelectCtrl($row['payrollline_type']);
            ?>
                <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>">
                    <td style="width:5%;padding-left:5px"><?php echo $line;?></td>
                   
                    <td style="width:180px;"><input type = "text" name = "payrollline_date[<?php echo $line;?>]" id = "payrollline_date_<?php echo $line;?>" class="form-control datepicker" value="<?php echo format_date($row['payrollline_date']);?>" <?php echo $disabled;?>/></td>
                    <td style="width:80px;"><select style = 'width:100%' name = "payrollline_type[<?php echo $line;?>]" id = "payrollline_type_<?php echo $line;?>" class="form-control select2" <?php echo $disabled;?>><?php echo $this->payrolltypelineCrtl;?></select></td>
                    <td style="width:250px;"><textarea name = "payrollline_desc[<?php echo $line;?>]" id = "payrollline_desc_<?php echo $line;?>" class="form-control" <?php echo $disabled;?>><?php echo $row['payrollline_desc'];?></textarea></td>
                    <td style="width:60px;"><input type = "text" name = "payrollline_receiptno[<?php echo $line;?>]" line = "<?php echo $line;?>" id = "payrollline_receiptno_<?php echo $line;?>" class="form-control" value="<?php echo $row['payrollline_receiptno'];?>" <?php echo $disabled;?>/></td>
                    <td style="width:60px;"><input type = "text" name = "payrollline_amount[<?php echo $line;?>]" line = "<?php echo $line;?>" id = "payrollline_amount_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo $row['payrollline_amount'];?>" <?php echo $disabled;?>/></td>
                    <td align = "center" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">
                        <?php 
                        if($this->payroll_approvalstatus == 'Draft'){
                            if($row['payrollline_id'] > 0){
                        ?>
                            <a style = "margin-left:10px;margin-right:10px;" href = "javascript:void(0)" id = "save_line_<?php echo $line;?>" payrollline_id = "<?php echo $row['payrollline_id'];?>" class = "save_line font-icon" line = "<?php echo $line;?>" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php }else{?>
                            <a style = "margin-left:10px;margin-right:10px;" href = "javascript:void(0)" id = "save_line_<?php echo $line;?>" payrollline_id = "<?php echo $row['payrollline_id'];?>" class = "save_line font-icon" line = "<?php echo $line;?>" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php }?>
                        <a style = "margin-left:10px;margin-right:10px;" href = "javascript:void(0)" id = "delete_line_<?php echo $line;?>" payrollline_id = "<?php echo $row['payrollline_id'];?>" class = "delete_line font-icon" line = "<?php echo $line;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        <?php }?>
                        <input type = "hidden" name = "payrollline_id[<?php echo $line;?>]" id = "payrollline_id<?php echo $line;?>" class="form-control" value="<?php echo $row['payrollline_id'];?>"/>
                    </td>
                </tr>
            
            <?php
            }
            ?>
            <tr id = 'detail_last_tr'></tr>
        </tbody>
    </table>
    <input type = 'hidden' id = 'total_line' name = 'total_line' value = '<?php echo $line;?>'/>
    <?php    
    }
    public function previewPayslip(){
        include_once 'class/Empl.php';
        
        $e = new Empl();
        //create filter
        if($this->payroll_outlet > 0){
            $wherestring = " AND empl.empl_outlet = '$this->payroll_outlet'"; 
        }
        if($this->payroll_department > 0){
            $wherestring .= " AND empl.empl_department = '$this->payroll_department'"; 
        }
        //convert date to sql
        $this->payroll_startdate = format_date_database($this->payroll_startdate);
        $this->payroll_enddate = format_date_database($this->payroll_enddate);
        
        //subsql for get employee salary at between payroll start date & end date, and get latest salary data.
        $subsql = "SELECT emplsalary_amount FROM db_emplsalary WHERE emplsalary_date BETWEEN '$this->payroll_startdate' AND '$this->payroll_enddate' AND emplsalary_empl_id = empl.empl_id order BY emplsalary_id DESC limit 0,1";
        
        //subsql2 for get employee addtional at between payroll start date & end date, and get latest data.
        $subsql2 = "SELECT SUM(claims_amount) FROM db_claims WHERE claims_date BETWEEN '$this->payroll_startdate' AND '$this->payroll_enddate' AND claims_empl_id = empl.empl_id and claims_status = 1 AND claims_approvalstatus = 'Approve'";
        

        $sql = "SELECT empl.empl_id,empl.empl_name,ed.department_code,COALESCE(($subsql),0) as empl_salary,
                COALESCE(($subsql2),0) as empl_addtional,ep.emplpass_cpf
                FROM db_empl empl
                LEFT JOIN db_department ed ON ed.department_id = empl.empl_department
                LEFT JOIN db_emplpass ep ON ep.emplpass_id = empl.empl_emplpass
                WHERE empl.empl_status = '1' $wherestring";
        
        $query = mysql_query($sql);
        $i = 0;    
        while($row = mysql_fetch_array($query)){
            $empl_salary_array = $e->fetchSalaryDetail(" AND emplsalary_empl_id = '{$row['empl_id']}' AND emplsalary_date BETWEEN '$this->payroll_startdate' AND '$this->payroll_enddate'","ORDER BY emplsalary_id DESC","limit 0,1",2);
            $b[$i]['empl_name'] = $row['empl_name'];
            $b[$i]['empl_id'] = $row['empl_id'];
            $b[$i]['department_code'] = $row['department_code'];
            $b[$i]['empl_salary'] = $empl_salary_array['emplsalary_amount'];
            $b[$i]['empl_addtional'] = $this->getAddtionalSalary($row['empl_id'],$this->payroll_startdate,$this->payroll_enddate);
            $b[$i]['empl_deductions'] = $this->getDeductionsSalary($row['empl_id'],$this->payroll_startdate,$this->payroll_enddate,$empl_salary_array);
            if($row['emplpass_cpf'] == 1){
                $b[$i]['cpf_employee'] = (($empl_salary_array['emplsalary_amount'] + $b[$i]['empl_addtional']) - $b[$i]['empl_deductions']) * CPF_employee;
                $b[$i]['cpf_employer'] = (($empl_salary_array['emplsalary_amount'] + $b[$i]['empl_addtional']) - $b[$i]['empl_deductions']) * CPF_employer;
            }else{
                $b[$i]['cpf_employee'] = 0;
                $b[$i]['cpf_employer'] = 0;
            }

            $b[$i]['salary'] = $empl_salary_array['emplsalary_amount'] ? $empl_salary_array['emplsalary_amount'] : 0;
            $b[$i]['payroll_startdate'] = $this->payroll_startdate;
            $b[$i]['payroll_enddate'] = $this->payroll_enddate;

            $i++;
        }
     echo json_encode($b);
     exit();
    }
    public function getAddtionalSalary($empl_id,$datefrom,$dateto){
        
        $sql = "
            SELECT SUM(a.addtional_amt) as addtional_amt FROM (
                SELECT COALESCE(SUM(claims_amount),0) as addtional_amt 
                FROM db_claims 
                WHERE claims_date BETWEEN '$datefrom' AND '$dateto'
                AND claims_empl_id = '$empl_id' and claims_status = 1 AND claims_approvalstatus = 'Approve' 
                    
                UNION ALL

                SELECT COALESCE(SUM(l.additional_amount),0) as addtional_amt
                FROM db_additional l
                LEFT JOIN db_additionaltype alt ON alt.additionaltype_id = l.additional_type
                WHERE l.additional_date BETWEEN '$datefrom' AND '$dateto' AND l.additional_empl_id = '$empl_id' and l.additional_status = 1
                )a    

               ";
        $query = mysql_query($sql);
        $addtional_amt = 0;
        if($row = mysql_fetch_array($query)){
            $addtional_amt = $row['addtional_amt'];
        }else{
            $addtional_amt = 0;
        }
        return ROUND($addtional_amt,2);
    }
    public function getDeductionsSalary($empl_id,$datefrom,$dateto,$empl_salary_array){
        
        $salary_montly = $empl_salary_array['emplsalary_amount'];
        $total_workingdays = $empl_salary_array['emplsalary_workday'];
        $hourly_salary = $empl_salary_array['emplsalary_hourly'];
        $total_workinghours = $empl_salary_array['emplsalary_hourly'];
        
        if(($hourly_salary == "") || ($hourly_salary <=0)){
            $hourly_salary = ROUND(($salary_montly / $total_workingdays)/$total_workinghours,2);
        }
        $sql = "
                SELECT SUM(a.deductions_amt) as deductions_amt FROM (
                SELECT COALESCE(SUM((CASE WHEN lt.leavetype_isdeduct = '1' THEN (CASE WHEN l.leave_duration IN ('half_day','full_day') THEN leave_total_day * $hourly_salary ELSE leave_period_hourly * $hourly_salary END) ELSE 0 END)),0) as deductions_amt 
                FROM db_leave l
                INNER JOIN db_leavetype lt ON lt.leavetype_id = l.leave_type
                WHERE ((l.leave_datefrom BETWEEN '$datefrom' AND '$dateto') OR (l.leave_dateto BETWEEN '$datefrom' AND '$dateto'))
                AND l.leave_empl_id = '$empl_id' and l.leave_status = 1 AND l.leave_approvalstatus = 'Approve'  
                    
                UNION ALL
                
                SELECT SUM(l.deductions_amount) as deductions_amt
                FROM db_deductions l
                WHERE l.deductions_date BETWEEN '$datefrom' AND '$dateto' AND l.deductions_empl_id = '$empl_id' and l.deductions_status = 1
                    )a
                ";
        
        $query = mysql_query($sql);
        $deductions_amt = 0;
        if($row = mysql_fetch_array($query)){
            $deductions_amt = $row['deductions_amt'];
        }else{
            $deductions_amt = 0;
        }
        return ROUND($deductions_amt,2);
    }
    public function previewPayslipDetail(){
    include_once 'class/Empl.php';
        
        $e = new Empl();
        $empl_salary_array = $e->fetchSalaryDetail(" AND emplsalary_empl_id = '$this->empl_id' AND emplsalary_date BETWEEN '$this->payroll_startdate' AND '$this->payroll_enddate'","ORDER BY emplsalary_id DESC","limit 0,1",2);
        $empl_array = $e->fetchEmplDetail(" AND empl_id = '$this->empl_id'","","",2);
        $this->emplpass_cpf = getDataCodeBySql("emplpass_cpf","db_emplpass"," WHERE emplpass_id = '{$empl_array['empl_emplpass']}'");
        $department_code = getDataCodeBySql("department_code","db_department"," WHERE department_id = '{$empl_array['empl_department']}'");
        $outlet_code = getDataCodeBySql("outl_code","db_outl"," WHERE outl_id = '{$empl_array['empl_outlet']}'");
        $bank_code = getDataCodeBySql("bank_code","db_bank"," WHERE bank_id = '{$empl_array['empl_bank']}'");
    ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Payroll Management</title>
    <?php
    include_once 'css.php';
    $this->outletCrtl = $this->select->getOutletSelectCtrl($this->empl_outlet);
    $this->departmentCrtl = $this->select->getDepartmentSelectCtrl($this->empl_department);
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
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <!-- include header-->
      <?php include_once 'header.php';?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Payroll Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Salary Payslips</h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='payroll.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='payroll.php?action=createForm'">Create New</button>
                <?php }?>
              </div>

                <form id = 'payroll_form' class="form-horizontal" action = 'payroll.php?action=create' method = "POST">
                  <div class="box-body">
                    <div class="col-sm-12">  
                       <div class="col-sm-12" style = 'text-align:center'>  
                        <h3>Salary Payslip of <?php echo $empl_array['empl_name'];?></h3>
                       </div>
                    <h4>Salary Information</h4>
                    <div class="form-group">
                      <label for ="payroll_outlet" class="col-sm-2 control-label">Employee Code : </label>
                      <div class="col-sm-2">
                       <label for ="payroll_outlet" class="col-sm-7 control-label"><?php echo $empl_array['empl_code'];?></label>
                      </div>
                      <label for ="payroll_outlet" class="col-sm-2 control-label">Outlet : </label>
                      <div class="col-sm-4">
                       <label for ="payroll_outlet" class="col-sm-6 control-label"><?php echo $outlet_code;?></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for ="payroll_outlet" class="col-sm-2 control-label">Employee Name : </label>
                      <div class="col-sm-2">
                       <label for ="payroll_outlet" class="col-sm-7 control-label"><?php echo $empl_array['empl_name'];?></label>
                      </div>
                      <label for ="payroll_outlet" class="col-sm-2 control-label">Department : </label>
                      <div class="col-sm-4">
                       <label for ="payroll_outlet" class="col-sm-6 control-label"><?php echo $department_code;?></label>
                      </div>
                    </div>
                    <div class="form-group">  
                      <label for ="payroll_department" class="col-sm-2 control-label">Salary Date : </label>
                      <div class="col-sm-2">
                          <label for ="payroll_outlet" class="col-sm-7 control-label"><?php echo format_date($this->payroll_startdate);?></label>
                      </div>
                      <label for ="payroll_outlet" class="col-sm-2 control-label">Bank : </label>
                      <div class="col-sm-4">
                       <label for ="payroll_outlet" class="col-sm-6 control-label"><?php echo $bank_code;?></label>
                      </div>         
                    </div>
                    <div class="form-group">  
                      <label for ="payroll_department" class="col-sm-2 control-label">Salary : </label>
                      <div class="col-sm-2">
                          <label for ="payroll_outlet" class="col-sm-7 control-label">
                              <?php 
                              echo num_format($empl_salary_array['emplsalary_amount']);
                              $this->summary['Basic_Salary'] = $empl_salary_array['emplsalary_amount'];
                              ?>
                          </label>
                      </div>
                      <label for ="payroll_outlet" class="col-sm-2 control-label">Bank Code : </label>
                      <div class="col-sm-4">
                       <label for ="payroll_outlet" class="col-sm-6 control-label"><?php echo $empl_array['empl_bank_acc_no'];?></label>
                      </div>  
                    </div>
                     <h4>Salary Payslip Period</h4>
                     <div class="form-group">
                         <label for="payroll_startdate" class="col-sm-2 control-label">Payslip Period (Start Date) : </label>
                      <div class="col-sm-2">
                          <label for ="payroll_outlet" class="col-sm-7 control-label"><?php echo format_date($this->payroll_startdate);?></label>
                      </div>
                     </div> 
                     <div class="form-group">
                         <label for="payroll_enddate" class="col-sm-2 control-label">Payslip Period (End Date) : </label>
                      <div class="col-sm-2">
                          <label for ="payroll_outlet" class="col-sm-7 control-label"><?php echo format_date($this->payroll_enddate);?></label>
                      </div>
                     </div>
                     <div class="form-group">
                      <div class="col-sm-6">
                        <h4>Additional Items</h4>
                        <?php echo $this->getAdditionalItemsListing();?>
                      </div>
                      <div class="col-sm-6">
                        <h4>Deductions Items</h4>
                        <?php echo $this->getDeductionsItemsListing($empl_salary_array);?>
                      </div>
                     </div><h4>CPF</h4>
                         <?php 
                            if($this->emplpass_cpf == 1){// have CPF
                                $this->CPF_Employer = ($this->summary['Basic_Salary'] + $this->summary['Additional_Items'] - $this->summary['Deductions_Items']) * CPF_employer;
                                $this->CPF_Employee = ($this->summary['Basic_Salary'] + $this->summary['Additional_Items'] - $this->summary['Deductions_Items']) * CPF_employee;
                            }else{
                                $this->CPF_Employer = 0;
                                $this->CPF_Employer = 0;
                            }
                         ?>
                     <div class="form-group">

                         <label for="payroll_enddate" class="col-sm-2 control-label">Employer CPF : </label>
                         <div class="col-sm-2">
                                <label for ="payroll_outlet" class="col-sm-7 control-label"><?php echo num_format($this->CPF_Employer);?></label>
                          </div>
                     </div>
                     <div class="form-group">

                         <label for="payroll_enddate" class="col-sm-2 control-label">Employee CPF : </label>
                         <div class="col-sm-2">
                                <label for ="payroll_outlet" class="col-sm-7 control-label"><?php echo num_format($this->CPF_Employee);?></label>
                          </div>
                     </div>
                     <div class="form-group">
                      <div class="col-sm-6">
                        <h4>Summary</h4>
                        <?php echo $this->getSummaryItemsListing();?>
                      </div>

                     </div>
                    </div>
                      <div style = 'clear:both'></div>
                      
                        

                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Back</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->payroll_id;?>" name = "payroll_id"/>
                    <?php 
                    if($this->payroll_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
?>
                    <button type = "submit" name = 'submit_btn' value = 'Save' class="btn btn-info">Save</button>
                    &nbsp;&nbsp;&nbsp;
                    <button type = "submit" name = 'submit_btn' value = 'Save' class="btn btn-info">Print</button>
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
                     <?php if(file_exists("dist/images/empl/{$this->payroll_empl_id}.png")){?>
                     <img src="dist/images/empl/<?php echo $this->payroll_empl_id;?>.png" class="img-circle" alt="User Image"  >
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
        
    });
   
    </script>
  </body>
</html>

    <?php
    }
    public function getAdditionalItemsListing(){
    $line = 0;  

    ?>    
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:5%;padding-left:5px">No</th>
            <th class = "" style = 'width:10%;'>Items</th>
            <th class = "" style = 'width:10%;text-align:right'>Amount</th>
            <th class = "" style="width:10%;text-align:right"></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT ct.claimstype_code as title ,cl.claimsline_amount as claims_amount
                    FROM db_claims c
                    INNER JOIN db_claimsline cl ON cl.claimsline_claims_id = c.claims_id
                    LEFT JOIN db_claimstype ct ON ct.claimstype_id = cl.claimsline_type
                    WHERE c.claims_date BETWEEN '$this->payroll_startdate' AND '$this->payroll_enddate' AND c.claims_empl_id = '$this->empl_id' and c.claims_status = 1 AND c.claims_approvalstatus = 'Approve'
                  
                    UNION ALL
                    
                    SELECT alt.additionaltype_code as title,l.additional_amount as claims_amount
                    FROM db_additional l
                    LEFT JOIN db_additionaltype alt ON alt.additionaltype_id = l.additional_type
                    WHERE l.additional_date BETWEEN '$this->payroll_startdate' AND '$this->payroll_enddate' AND l.additional_empl_id = '$this->empl_id' and l.additional_status = 1
                    ";
            $query = mysql_query($sql);
            $total_amt = 0;
            while($row = mysql_fetch_array($query)){
                $total_amt = $total_amt + $row['claims_amount'];
                $line++;
            ?>
                <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>">
                    <td style="width:5%;padding-left:5px"><?php echo $line;?></td>
                    <td><?php echo $row['title'];?></td>
                    <td style = 'text-align:right' ><?php echo num_format($row['claims_amount']);?></td>
                    <td></td>
                </tr>
            
            <?php
            }
            ?>
                <tr>
                    <td colspan = '2' style = 'text-align:right;font-weight:bold'>Total : </td>
                    <td style = 'text-align:right;font-weight:bold'>
                        <?php 
                        echo num_format($total_amt);
                        $this->summary["Additional_Items"] = $total_amt;
                        ?>
                    </td>
                    <td></td>
                </tr>
        </tbody>
    </table>
    <?php    
    }
    public function getDeductionsItemsListing($empl_salary_array){
    $line = 0;  

    ?>    
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:5%;padding-left:5px">No</th>
            <th class = "" style = 'width:10%;'>Items</th>
            <th class = "" style = 'width:10%;text-align:right'>Amount</th>
            <th class = "" style="width:10%;text-align:right"></th>
          </tr>
        </thead>
        <tbody>
            <?php
        $salary_montly = $empl_salary_array['emplsalary_amount'];
        $total_workingdays = $empl_salary_array['emplsalary_workday'];
        $hourly_salary = $empl_salary_array['emplsalary_hourly'];
        $total_workinghours = $empl_salary_array['emplsalary_hourly'];
        
        if(($hourly_salary == "") || ($hourly_salary <=0)){
            $hourly_salary = ROUND(($salary_montly / $total_workingdays)/$total_workinghours,2);
        }
        $sql = "SELECT 'Unpaid Leave' as title,COALESCE((CASE WHEN lt.leavetype_isdeduct = '1' THEN (CASE WHEN l.leave_duration IN ('half_day','full_day') THEN leave_total_day * $hourly_salary ELSE leave_period_hourly * $hourly_salary END) ELSE 0 END),0) as deductions_amt 
                FROM db_leave l
                INNER JOIN db_leavetype lt ON lt.leavetype_id = l.leave_type
                WHERE ((l.leave_datefrom BETWEEN '$this->payroll_startdate' AND '$this->payroll_enddate') OR (l.leave_dateto BETWEEN '$this->payroll_startdate' AND '$this->payroll_enddate'))
                AND l.leave_empl_id = '$this->empl_id' and l.leave_status = 1 AND l.leave_approvalstatus = 'Approve'

                UNION ALL
                
                SELECT l.deductions_title as title,l.deductions_amount as deductions_amt
                FROM db_deductions l
                WHERE l.deductions_date BETWEEN '$this->payroll_startdate' AND '$this->payroll_enddate' AND l.deductions_empl_id = '$this->empl_id' and l.deductions_status = 1
                ";
        
            $query = mysql_query($sql);
            $total_amt = 0;
            while($row = mysql_fetch_array($query)){
                $total_amt = $total_amt + $row['deductions_amt'];
                $line++;
            ?>
                <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>">
                    <td style="width:5%;padding-left:5px"><?php echo $line;?></td>
                    <td><?php echo $row['title'];?></td>
                    <td style = 'text-align:right' ><?php echo num_format($row['deductions_amt']);?></td>
                    <td></td>
                </tr>
            
            <?php
            }
            ?>
                <tr>
                    <td colspan = '2' style = 'text-align:right;font-weight:bold'>Total : </td>
                    <td style = 'text-align:right;font-weight:bold'>
                        <?php 
                        echo num_format($total_amt);
                        $this->summary["Deductions_Items"] = $total_amt;
                        ?></td>
                    <td></td>
                </tr>
        </tbody>
    </table>
    <?php    
    }
    public function getSummaryItemsListing(){
    $line = 0;  

    ?>    
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:5%;padding-left:5px">No</th>
            <th class = "" style = 'width:10%;'>Items</th>
            <th class = "" style = 'width:10%;text-align:right'>Amount</th>
            <th class = "" style="width:10%;text-align:right"></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $total_amt = 0;
            $k = 1;
            if($this->emplpass_cpf == 1){// have CPF
//                $this->summary['CPF_Employer'] = ($this->summary['Basic_Salary'] + $this->summary['Additional_Items'] - $this->summary['Deductions_Items']) * CPF_employer;
                $this->summary['CPF_Employee'] = ($this->summary['Basic_Salary'] + $this->summary['Additional_Items'] - $this->summary['Deductions_Items']) * CPF_employee;
            }else{
//                $this->summary['CPF_Employer'] = 0;
                $this->summary['CPF_Employee'] = 0;
            }
            
            $this->summary['Lervy'] = 0;
            foreach($this->summary as $b => $c){
                $name = str_replace("_"," ",$b);
                if(($name == "Deductions Items") || ($name == "CPF Employee")){
                    $c = $c * -1;
                }
                $total_amt = $total_amt + $c;
            ?>
                <tr>
                    <td style="width:5%;padding-left:5px"><?php echo $k;?></td>
                    <td><?php echo $name;?></td>
                    <td style = 'text-align:right' ><?php echo num_format($c);?></td>
                    <td></td>
                </tr>
            <?php
            $k++;
            }
            ?>
                <tr>
                    <td colspan = '2' style = 'text-align:right;font-weight:bold'>Net Pay : </td>
                    <td style = 'text-align:right;font-weight:bold'><?php echo num_format($total_amt);?></td>
                    <td></td>
                </tr>
        </tbody>
    </table>
    <?php    
    }
}
?>
