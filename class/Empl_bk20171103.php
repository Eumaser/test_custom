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
class Empl {

    public function Empl(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $this->empl_login_password = md5("@#~x?\$" . $this->empl_login_password . "?\$");
        $table_field = array('empl_code','empl_name','empl_nric','empl_tel','empl_birthday',
                             'empl_group','empl_joindate','empl_address','empl_remark',
                             'empl_login_email','empl_login_password','empl_seqno','empl_status',
                             'empl_outlet','empl_email','empl_department','empl_bank',
                             'empl_bank_acc_no','empl_nationality','empl_emplpass',
                             'empl_resigndate','empl_confirmationdate','empl_mobile',
                             'empl_language','empl_type');
        $table_value = array(get_prefix_value("Empl code",true),$this->empl_name,$this->empl_nric,$this->empl_tel,format_date_database($this->empl_birthday),
                             $this->empl_group,format_date_database($this->empl_joindate),$this->empl_address,$this->empl_remark,
                             $this->empl_login_email,$this->empl_login_password,$this->empl_seqno,$this->empl_status,
                             $this->empl_outlet,$this->empl_email,$this->empl_department,$this->empl_bank,
                             $this->empl_bank_acc_no,$this->empl_nationality,$this->empl_emplpass,
                             $this->empl_resigndate,format_date_database($this->empl_confirmationdate),$this->empl_mobile,
                             $this->empl_language,'EMPLOYEE');
        $remark = "Insert Employee.";
        if(!$this->save->SaveData($table_field,$table_value,'db_empl','empl_id',$remark)){
           return false;
        }else{
           $this->empl_id = $this->save->lastInsert_id;
           $this->pictureManagement();
           $count = getDataCountBySql("db_leavetype", " WHERE status = 1");
          
           for($i=0;$i<sizeof($this->emplleave_days);$i++){
                    $this->createLeave($this->emplleave_leavetype[$i],$this->emplleave_days[$i]);
           }
           return true;
        }
    }
    public function update(){
        $new_password = $this->empl_login_password;
        $empl_id = $this->empl_id;
        $empl_login_email = $this->empl_login_email;

        if($this->empl_oldpassword != $new_password){
          $this->empl_login_password = md5("@#~x?\$" . $new_password . "?\$");
        }

        $table_field = array('empl_name','empl_nric','empl_tel','empl_birthday',
                             'empl_group','empl_joindate','empl_address','empl_remark',
                             'empl_login_email','empl_login_password','empl_seqno','empl_status',
                             'empl_outlet','empl_email','empl_department','empl_bank',
                             'empl_bank_acc_no','empl_nationality','empl_emplpass',
                             'empl_resigndate','empl_confirmationdate','empl_mobile',
                             'empl_language');
        $table_value = array($this->empl_name,$this->empl_nric,$this->empl_tel,$this->empl_birthday,
                             $this->empl_group,format_date_database($this->empl_joindate),$this->empl_address,$this->empl_remark,
                             $this->empl_login_email,$this->empl_login_password,$this->empl_seqno,$this->empl_status,
                             $this->empl_outlet,$this->empl_email,$this->empl_department,$this->empl_bank,
                             $this->empl_bank_acc_no,$this->empl_nationality,$this->empl_emplpass,
                             $this->empl_resigndate,format_date_database($this->empl_confirmationdate),$this->empl_mobile,
                             $this->empl_language);
        $remark = "Update Employee.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_empl','empl_id',$remark,$this->empl_id)){
           return false;
        }else{
           $this->pictureManagement();
           for($i=0;$i<sizeof($this->emplleave_days);$i++){ 
                if($this->emplleave_id[$i] > 0){
                     $this->updateLeave($this->emplleave_days[$i],$this->emplleave_id[$i]);
                }else{
                     $this->createLeave($this->emplleave_leavetype[$i],$this->emplleave_days[$i]);
                }
           }
           return true;
        }
    }
    public function createLeave($emplleave_leavetype,$emplleave_days){
        $table_field = array('emplleave_empl','emplleave_leavetype','emplleave_days');
        $table_value = array($this->empl_id,$emplleave_leavetype,$emplleave_days);
        $remark = "Create Employee Leaves.";
        if(!$this->save->SaveData($table_field,$table_value,'db_emplleave','emplleave_id',$remark)){
           
        }else{
          
        }
    }
    public function updateLeave($emplleave_days,$emplleave_id){


        $table_field = array('emplleave_days');
        $table_value = array($emplleave_days);
        $remark = "Update Employee Leaves.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_emplleave','emplleave_id',$remark,$emplleave_id," AND emplleave_empl = '$this->empl_id'")){
           return false;
        }else{
           return true;
        }
    }
    public function createSalary(){
        $table_field = array('emplsalary_empl_id','emplsalary_date','emplsalary_amount','emplsalary_remark','emplsalary_status',
                             'emplsalary_workday','emplsalary_hourly','emplsalary_overtime');
        $table_value = array($this->empl_id,format_date_database($this->emplsalary_date),$this->emplsalary_amount,$this->emplsalary_remark,1,
                             $this->emplsalary_workday,$this->emplsalary_hourly,$this->emplsalary_overtime);
        $remark = "Create Salary Adjustment.";
        if(!$this->save->SaveData($table_field,$table_value,'db_emplsalary','emplsalary_id',$remark)){
            return false;
        }else{
            return true;
        }
    }
    public function updateSalary(){

        $table_field = array('emplsalary_empl_id','emplsalary_date','emplsalary_amount','emplsalary_remark',
                             'emplsalary_workday','emplsalary_hourly','emplsalary_overtime');
        $table_value = array($this->empl_id,format_date_database($this->emplsalary_date),$this->emplsalary_amount,$this->emplsalary_remark,
                             $this->emplsalary_workday,$this->emplsalary_hourly,$this->emplsalary_overtime);
        $remark = "Update Salary Adjustment.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_emplsalary','emplsalary_id',$remark,$this->emplsalary_id," AND emplsalary_empl_id = '$this->empl_id'")){
           return false;
        }else{
           return true;
        }
    }
    public function pictureManagement(){
        if(!file_exists("dist/images/empl")){
           mkdir('dist/images/empl/');
        }
        $isimage = false;
        if($this->image_input['type'] == 'image/png' || $this->image_input['type'] == 'image/jpeg' || $this->image_input['type'] == 'image/gif'){
           $isimage = true;
        }

        if($this->image_input['size'] > 0 && $isimage == true){
            if($this->action == 'update'){
                unlink("dist/images/empl/{$this->empl_id}.png");
            }

                move_uploaded_file($this->image_input['tmp_name'],"dist/images/empl/{$this->empl_id}.png");
        }
    }
    public function fetchEmplDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_empl WHERE empl_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);
            $this->empl_id = $row['empl_id'];
            $this->empl_code = $row['empl_code'];
            $this->empl_name = $row['empl_name'];
            $this->empl_nric = $row['empl_nric'];
            $this->empl_tel = $row['empl_tel'];
            $this->empl_mobile = $row['empl_mobile'];
            $this->empl_email = $row['empl_email'];
            $this->empl_address = $row['empl_address'];
            $this->empl_remark = $row['empl_remark'];
            $this->empl_birthday = $row['empl_birthday'];
            $this->empl_joindate = $row['empl_joindate'];
            $this->empl_group = $row['empl_group'];
            $this->empl_seqno = $row['empl_seqno'];
            $this->empl_outlet = $row['empl_outlet'];
            $this->empl_status = $row['empl_status'];
            $this->empl_login_email = $row['empl_login_email'];
            $this->empl_login_password = $row['empl_login_password'];
            $this->empl_department = $row['empl_department'];
            $this->empl_bank = $row['empl_bank'];
            $this->empl_bank_acc_no = $row['empl_bank_acc_no'];
            $this->empl_nationality = $row['empl_nationality'];
            $this->empl_emplpass = $row['empl_emplpass'];
            $this->empl_resigndate = $row['empl_resigndate'];
            $this->empl_confirmationdate = $row['empl_confirmationdate'];
            $this->empl_language = $row['empl_language'];
            return true;
        }else if($type == 2){
            $row = mysql_fetch_array($query);
            return $row;
        }else{
             return $query;
        }
       
    }
    public function fetchSalaryDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_emplsalary WHERE emplsalary_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);
            $this->empl_id = $row['emplsalary_empl_id'];
            $this->emplsalary_date = $row['emplsalary_date'];
            $this->emplsalary_amount = $row['emplsalary_amount'];
            $this->emplsalary_overtime = $row['emplsalary_overtime'];
            $this->emplsalary_hourly = $row['emplsalary_hourly'];
            $this->emplsalary_workday = $row['emplsalary_workday'];
            $this->emplsalary_remark = $row['emplsalary_remark'];
            $this->emplsalary_empl_id = $row['emplsalary_empl_id'];
            $this->updateBy = $row['updateBy'];
            return true;
        }else if($type == 2){
            $row = mysql_fetch_array($query);
            return $row;
        }else{
             return $query;
        }
       
    }
    public function delete(){
        $table_field = array('empl_status');
        $table_value = array(0);
        $remark = "Delete Employee.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_empl','empl_id',$remark,$this->empl_id)){
           return false;
        }else{
           return true;
        }
    }
    public function deleteSalary(){
        $table_field = array('emplsalary_status');
        $table_value = array(0);
        $remark = "Delete Employee Salary.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_emplleave','emplleave_id',$remark,$this->emplsalary_id," AND emplsalary_empl_id = '$this->empl_id'")){
           return false;
        }else{
           return true;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->empl_seqno = 10;
            $this->empl_code = "-- System Generate --";
            $this->empl_status = 1;
        }
        $this->groupCrtl = $this->select->getGroupSelectCtrl($this->empl_group,'N');
        $this->countryCrtl = $this->select->getCountrySelectCtrl($this->empl_outlet);
        $this->departmentCrtl = $this->select->getDepartmentSelectCtrl($this->empl_department,'N');
        $this->currencyCrtl = $this->select->getCurrencySelectCtrl($this->empl_currency_id,'N');
        $this->outletCrtl = $this->select->getOutletSelectCtrl($this->empl_outlet,'N');
        $this->nationalityCrtl = $this->select->getNationalitySelectCtrl($this->empl_nationality,'N');
        $this->emplpassCrtl = $this->select->getEmplPassSelectCtrl($this->empl_emplpass,'N');
        $this->bankCrtl = $this->select->getBankSelectCtrl($this->empl_bank,'N');
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Employee Management</title>
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
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Employee Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->empl_id > 0){ echo "Update Employee";}else{ echo "Create New Employee";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='empl.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='empl.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'empl_form' class="form-horizontal" action = 'empl.php?action=create' method = "POST" enctype="multipart/form-data">
                    <input type ='hidden' name = 'current_tab' id = 'current_tab' value = "<?php echo $this->current_tab?>"/>
                  <div class="box-body">
                      
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li tab = "General" class="tab_header <?php if(($this->current_tab == "") || ($this->current_tab == "General")){ echo 'active';}?>"><a href="#general" data-toggle="tab">General</a></li>
                          <li tab = "Bank" class="tab_header <?php if($this->current_tab == "Bank"){ echo 'active';}?>" ><a href="#bank" data-toggle="tab">Bank</a></li>
                          <li tab = "Leave" class="tab_header <?php if($this->current_tab == "Leave"){ echo 'active';}?>"><a href="#leave" data-toggle="tab">Leave</a></li>
                          
                          <?php if($this->empl_id > 0){?>
                          <li tab = "Salary" class="tab_header <?php if($this->current_tab == "Salary"){ echo 'active';}?>"><a href="#salary" data-toggle="tab">Salary</a></li>
                          <?php }?>
                        </ul>
                      </div>
                      <div class="tab-content">
                          <div class=" tab-pane <?php if(($this->current_tab == "") || ($this->current_tab == "General")){ echo 'active';}?>" id="general">
                              <div class="col-sm-8">
                              <?php echo $this->getGeneralForm();?>
                              </div>
                              <div class="col-sm-4">
<!--                                 <a href = '<?php  echo "dist/qrcode/temp/teste5b834b18ccb59bdcfd13ff548884668.png";?>' download>-->
                                     <?php

                                 echo file_get_contents(webroot . "dist/qrcode/?data=$this->empl_code");
                                 ?>
                                 <!--</a>-->
                              
                                     <p></p>
                                    <?php if(file_exists("dist/images/empl/$this->empl_id.png")){?>
                                     <img src ="dist/images/empl/<?php echo $this->empl_id;?>.png" style = 'width:215px;height:215px;'/>
                                  <?php }else{?>
                                    <img src ='dist/img/avatar5.png'  />
                                   
                                  <?php }?>
                                     <p></p>
                                    <input type = "file" name = 'image_input' />
                              </div>
                          </div>
                          <div class=" tab-pane <?php if($this->current_tab == "Bank"){ echo 'active';}?>" id="bank">
                              <?php echo $this->getBankForm();?>
                          </div>
                          <div class=" tab-pane <?php if($this->current_tab == "Leave"){ echo 'active';}?>" id="leave">
                              <?php echo $this->getLeaveForm();?>
                          </div>
                          
                          <?php if($this->empl_id > 0){?>
                          <div class=" tab-pane <?php if($this->current_tab == "Salary"){ echo 'active';}?>" id="salary">
                              <?php echo $this->getSalaryForm();?>
                          </div>
                          <?php }?>
                      </div>
                        
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Back</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->empl_id;?>" name = "empl_id" id = "empl_id"/>
                    <?php
                    if($this->empl_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                    ?>
                    <button type = "submit" class="btn btn-info">Submit</button>
                    <?php }?>
                  </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    
    ?>
    <script>
    $(document).ready(function() {
        $("#empl_form").validate({
                  rules: 
                  {
                      empl_name:
                      {
                          required: true
                      },
                      empl_login_email:
                      {
                          required: true,
                          remote: {
                                  url: "empl.php?action=validate_email",
                                  type: "post",
                                  data: 
                                        {
                                            empl_id: function()
                                            {
                                                return $("#empl_id").val();
                                            }
                                        }
                              }
                      },
                      empl_login_password:
                      {
                        required: true,
                      },
                      empl_login_password_cm:
                      {
                        required: true,
                        minlength : 5,
                        equalTo : "#empl_login_password"
                      },
                      empl_outlet:
                      {
                        required: true
                      }
                  },
                  messages:
                  {
                      empl_name:
                      {
                          required: "Please enter customer first name."
                      },
                      customer_lname:
                      {
                          required: "Please enter customer last name."
                      },
                      customer_login_id:
                      {
                          required: "Please enter customer login email.",
                          remote: "Login email duplicate."
                      },
                      customer_login_password:
                      {
                            required: "Please enter Password."
                      },
                      customer_confirmpassword:
                      {
                            required: "Please enter Confirm Password."
                      },
                      empl_outlet:
                      {
                            required: "Please select Company."
                      }
                  }
              });
            $('.tab_header').click(function(){
                $('#current_tab').val($(this).attr('tab'));
            });
            $('.save_salary_btn').click(function(){
                var data = "action=saveSalary&empl_id=<?php echo $this->empl_id;?>&emplsalary_date="+$('#emplsalary_date').val()+"&emplsalary_amount="+$('#emplsalary_amount').val()+"&emplsalary_remark="+encodeURIComponent($('#emplsalary_remark').val());
                    data = data + "&emplsalary_workday="+encodeURIComponent($('#emplsalary_workday').val())+"&emplsalary_hourly="+encodeURIComponent($('#emplsalary_hourly').val())+"&emplsalary_overtime="+encodeURIComponent($('#emplsalary_overtime').val());
                    data = data + "&emplsalary_id="+$('#emplsalary_id').val();
                $.ajax({ 
                    type: 'POST',
                    url: 'empl.php',
                    cache: false,
                    data:data,
                    error: function(xhr) {
                        alert("System Error.");
                        issend = false;
                    },
                    success: function(data) {
                       var jsonObj = eval ("(" + data + ")");
                       if(jsonObj.status == 1){
                           window.location.reload();
                       }else{
                           alert("Fail to add line.");
                       }
                       issend = false;
                    }		
                 });
                 return false;
            });
        $('#empl_email').keyup(function(){
            $('#empl_login_email').val($(this).val());
        });
});
    </script>
  </body>
</html>
        <?php
        
    }
    public function getGeneralForm(){
        global $mandatory;
        
        if($this->empl_id <=0){
            $this->empl_joindate = system_date;
            
        }
        $this->emplsalary_date = system_date;
    ?>
    <div class="form-group">
          <label for="empl_code" class="col-sm-2 control-label">Code </label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="empl_code" name="empl_code" value = "<?php echo $this->empl_code;?>" disabled  >
          </div>
          <label for="empl_group" class="col-sm-2 control-label">Group <?php echo $mandatory;?></label>
          <div class="col-sm-3">
               <select class="form-control select2" id="empl_group" name="empl_group" style = 'width:100%'>
                   <?php echo $this->groupCrtl;?>
               </select>
          </div>
    </div>  
            <div class="form-group">
              <label for="empl_name" class="col-sm-2 control-label" >Name <?php echo $mandatory;?></label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="empl_name" name="empl_name" value = "<?php echo $this->empl_name;?>" placeholder="Name">
              </div>
              <label for="empl_nric" class="col-sm-2 control-label" >NRIC <?php echo $mandatory;?></label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="empl_nric" name="empl_nric" value = "<?php echo $this->empl_nric;?>" placeholder="NRIC">
              </div>
            </div>
            <div class="form-group">
                <label for="empl_email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="empl_email" name="empl_email" value = "<?php echo $this->empl_email;?>" placeholder="Email">
                </div>
                <label for="empl_birthday" class="col-sm-2 control-label">Birthday</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control datepicker" id="empl_birthday" name="empl_birthday" value = "<?php echo format_date($this->empl_birthday);?>" placeholder="Birthday">
                </div>
            </div>

        <div class="form-group">
          <label for="empl_mobile" class="col-sm-2 control-label">Mobile</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="empl_mobile" name="empl_mobile" value = "<?php echo $this->empl_mobile;?>" placeholder="Mobile">
          </div>
          <label for="empl_tel" class="col-sm-2 control-label">Home Tel</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="empl_tel" name="empl_tel" value = "<?php echo $this->empl_tel;?>" placeholder="Home Tel">
          </div>
        </div>
        <div class="form-group">
          <label for="empl_emplpass" class="col-sm-2 control-label">Type Of Pass</label>
          <div class="col-sm-3">
               <select class="form-control select2" id="empl_emplpass" name="empl_emplpass" style = 'width:100%' >
                   <?php echo $this->emplpassCrtl;?>
               </select>
          </div>
          <label for="empl_tel" class="col-sm-2 control-label">Nationality</label>
          <div class="col-sm-3">
               <select class="form-control select2" id="empl_nationality" name="empl_nationality" style = 'width:100%'>
                 <?php echo $this->nationalityCrtl;?>
               </select>
          </div>
        </div>
        <div class="form-group">
          <label for="empl_outlet" class="col-sm-2 control-label">Outlet</label>
          <div class="col-sm-3">
               <select class="form-control select2" id="empl_outlet" name="empl_outlet" style = 'width:100%'>
                 <?php echo $this->outletCrtl;?>
               </select>
          </div>
          <label for="empl_department" class="col-sm-2 control-label">Department</label>
          <div class="col-sm-3">
               <select class="form-control select2" id="empl_department" name="empl_department" style = 'width:100%'>
                 <?php echo $this->departmentCrtl;?>
               </select>
          </div>
        </div>
        <div class="form-group">
          <label for="empl_joindate" class="col-sm-2 control-label">Join Date</label>
          <div class="col-sm-3">
            <input type="text" class="form-control datepicker" id="empl_joindate" name="empl_joindate" value = "<?php echo format_date($this->empl_joindate);?>" placeholder="Join Date">
          </div>
          <label for="empl_joindate" class="col-sm-2 control-label">Resign Date</label>
          <div class="col-sm-3">
              <input type="text" class="form-control datepicker" id="empl_resigndate" name="empl_resigndate" value = "<?php echo format_date($this->empl_resigndate);?>" placeholder="Resign Date">
          </div>
        </div>
        <div class="form-group">
          <label for="empl_confirmationdate" class="col-sm-2 control-label">Confirmation Date</label>
          <div class="col-sm-3">
            <input type="text" class="form-control datepicker" id="empl_confirmationdate" name="empl_confirmationdate" value = "<?php echo format_date($this->empl_confirmationdate);?>" placeholder="Confirmation Date">
          </div> 
          <label for="empl_confirmationdate" class="col-sm-2 control-label">Language Prefer</label>
          <div class="col-sm-3">
                <div class="radio">
                      <label>
                        <input type="radio" name = "empl_language" value = 'english' <?php if(($this->empl_language == 'english') || ($this->empl_language == '')){ echo 'CHECKED';}?>>English
                      </label> 
                    &nbsp;
                      <label>
                        <input type="radio" name = "empl_language" value = 'chinese' <?php if($this->empl_language == 'chinese'){ echo 'CHECKED';}?>>Chinese
                      </label> 
                </div>
          </div>

        </div>
        <div class="form-group">
          <label for="empl_seqno" class="col-sm-2 control-label">Seq No</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="empl_seqno" name="empl_seqno" value = "<?php echo $this->empl_seqno;?>" placeholder="Seq No">
          </div>
          <label for="empl_status" class="col-sm-2 control-label">Status</label>
          <div class="col-sm-3">
               <select class="form-control" id="empl_status" name="empl_status">
                 <option value = '1' <?php if($this->empl_status == 1){ echo 'SELECTED';}?>>Active</option>
                 <option value = '0' <?php if($this->empl_status == 0){ echo 'SELECTED';}?>>In-active</option>
               </select>
          </div>
        </div>
        <div class="form-group">
          <label for="empl_address" class="col-sm-2 control-label">Address</label>
          <div class="col-sm-3">
                <textarea class="form-control" rows="3" id="empl_address" name="empl_address" placeholder="Address"><?php echo $this->empl_address;?></textarea>
          </div>
          <label for="empl_remark" class="col-sm-2 control-label">Remark</label>
          <div class="col-sm-3">
                <textarea class="form-control" rows="3" id="empl_remark" name="empl_remark" placeholder="Remark"><?php echo $this->empl_remark;?></textarea>
          </div>
        </div>
        <h3>Accounts</h3>

        <div class="form-group">
              <label for="empl_login_email" class="col-sm-2 control-label">Login ID <?php echo $mandatory;?></label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="empl_login_email" name="empl_login_email" value = "<?php echo $this->empl_login_email;?>" placeholder="Login Email">
              </div>
        </div>
        <div class="form-group">
              <label for="empl_login_password" class="col-sm-2 control-label" >Password <?php echo $mandatory;?></label>
              <div class="col-sm-3">
                <input type="password" class="form-control" id="empl_login_password" name="empl_login_password" value = "<?php echo $this->empl_login_password;?>" placeholder="Password">
              </div>
        </div>
        <div class="form-group">
              <label for="empl_login_password_cm" class="col-sm-2 control-label" >Confirm Password <?php echo $mandatory;?></label>
              <div class="col-sm-3">
                <input type="password" class="form-control" id="empl_login_password_cm" name="empl_login_password_cm" value = "<?php echo $this->empl_login_password;?>" placeholder="Confirm Password">
              </div>
        </div>
    <?php
    }
    public function getBankForm(){
    ?>
        <div class="form-group">
              <label for="empl_bank" class="col-sm-1 control-label">Bank</label>
              <div class="col-sm-3">
               <select class="form-control select2" id="empl_bank" name="empl_bank" style = 'width:100%' >
                   <?php echo $this->bankCrtl;?>
               </select>
              </div>
              <label for="empl_bank_acc_no" class="col-sm-1 control-label">Bank Account</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="empl_bank_acc_no" name="empl_bank_acc_no" value = "<?php echo $this->empl_bank_acc_no;?>" placeholder="Bank Account">
              </div>
        </div>
        <div class="form-group">

        </div>
    <?php
    }
    public function getSalaryForm(){
        if($this->emplsalary_id > 0){
           $this->fetchSalaryDetail(" AND emplsalary_id = '$this->emplsalary_id'","","",1);
        }else{
           $this->emplsalary_overtime = "0.00";
           $this->emplsalary_hourly = "0.00";
           $this->emplsalary_workday = 20;
           $this->emplsalary_amount = 0;
        }
    ?>
        <?php if($this->emplsalary_id > 0){?>
        <h3>Update Employee Salary  <button type="button" class="btn btn-primary" style="width:150px;margin-right:10px;" onclick="window.location.href='empl.php?action=edit&current_tab=Salary&empl_id=12'">Create New Salary &nbsp; <i class="fa fa-plus-square" aria-hidden="true"></i></button></h3>
        <?php }else{?>
        <h3>Create New Employee Salary</h3> 
        <?php }?>
        <div class="form-group">
              <label for="emplsalary_date" class="col-sm-2 control-label">Adjustment Date</label>
              <div class="col-sm-2">
               <input type="text" class="form-control datepicker" id="emplsalary_date" name="emplsalary_date" value = "<?php echo format_date($this->emplsalary_date);?>" placeholder="Adjustment Date">
              </div>
              <label for="emplsalary_amount" class="col-sm-2 control-label">Salary ($)</label>
              <div class="col-sm-2">
                  <input type="text" style = 'text-align:right' class="form-control" id="emplsalary_amount" name="emplsalary_amount" value = "<?php echo num_format($this->emplsalary_amount);?>" placeholder="Salary ($)">
              </div>
        </div>
        <div class="form-group">
              <label for="emplsalary_workday" class="col-sm-2 control-label">Total Working Days</label>
              <div class="col-sm-2">
               <input type="text" style = 'text-align:right' class="form-control" id="emplsalary_workday" name="emplsalary_workday" value = "<?php echo $this->emplsalary_workday;?>" placeholder="Total Working Days">
              </div>
              <label for="emplsalary_hourly" class="col-sm-2 control-label">Hourly Salary Rate</label>
              <div class="col-sm-2">
                <input type="text" style = 'text-align:right' class="form-control" id="emplsalary_hourly" name="emplsalary_hourly" value = "<?php echo $this->emplsalary_hourly;?>" placeholder="Hourly Salary">
              </div>
        </div>
        <div class="form-group">
              <label for="emplsalary_overtime" class="col-sm-2 control-label">Overtime Hourly Rate</label>
              <div class="col-sm-2">
               <input type="text" style = 'text-align:right' class="form-control" id="emplsalary_overtime" name="emplsalary_overtime" value = "<?php echo $this->emplsalary_overtime;?>" placeholder="Overtime Hourly ">
              </div>

        </div>
        <div class="form-group">
          <label for="emplsalary_remark" class="col-sm-2 control-label">Remark</label>
          <div class="col-sm-2">
                <textarea class="form-control" rows="3" id="emplsalary_remark" name="emplsalary_remark" placeholder="Remark"><?php echo $this->emplsalary_remark;?></textarea>
          </div>
          <div class="col-sm-3 "></div>
          <div class="col-sm-3 ">
              <button type = "button" class="btn btn-info save_salary_btn" >
                  <?php if($this->emplsalary_id > 0){?>
                  Update
                  <?php }else{?>
                  Save
                  <?php }?>
              </button>
              <input type = 'hidden' value = '<?php echo $this->emplsalary_id;?>' name = 'emplsalary_id' id = 'emplsalary_id'/>
          </div>
        </div>
        <table id="empl_table" class="table table-bordered table-hover dataTable">
                    <thead>
                      <tr>
                        <th style = 'width:3%'>No</th>
                        <th style = 'width:10%'>Adjustment Date</th>
                        <th style = 'width:10%'>Salary ($)</th>
                        <th style = 'width:10%'>Working Days</th>
                        <th style = 'width:10%'>Hourly Salary</th>
                        <th style = 'width:10%'>Overtime Hourly</th>
                        <th style = 'width:25%'>Remark</th>
                        <th style = 'width:10%'>Update By</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT ey.*
                              FROM db_emplsalary ey 
                              WHERE ey.emplsalary_empl_id = '{$this->empl_id}' AND ey.emplsalary_status = 1";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo format_date($row['emplsalary_date']);?></td>
                            <td><?php echo num_format($row['emplsalary_amount']);?></td>
                            <td><?php echo $row['emplsalary_workday'];?></td>
                            <td><?php echo num_format($row['emplsalary_hourly']);?></td>
                            <td><?php echo num_format($row['emplsalary_overtime']);?></td>
                            <td><?php echo nl2br($row['emplsalary_remark']);?></td>
                            <td><?php echo getDataCodeBySql("empl_name","db_empl","WHERE  empl_id = '{$row['updateBy']}'","");?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'empl.php?action=edit&current_tab=Salary&empl_id=<?php echo $this->empl_id;?>&emplsalary_id=<?php echo $row['emplsalary_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('empl.php?action=deletesalary&current_tab=Salary&empl_id=<?php echo $this->empl_id;?>&emplsalary_id=<?php echo $row['emplsalary_id'];?>','Confirm Delete?')">Delete</button>
                                <?php }?>
                            </td>
                        </tr>
                    <?php    
                        $i++;
                      }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style = 'width:3%'>No</th>
                        <th style = 'width:10%'>Adjustment Date</th>
                        <th style = 'width:10%'>Salary ($)</th>
                        <th style = 'width:10%'>Working Days</th>
                        <th style = 'width:10%'>Hourly Salary</th>
                        <th style = 'width:10%'>Overtime Hourly</th>
                        <th style = 'width:25%'>Remark</th>
                        <th style = 'width:10%'>Update By</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </tfoot>
                  </table>
    <?php
    }
    public function getLeaveForm(){
        
        $sql = "SELECT lt.*,el.emplleave_days,el.emplleave_id
                FROM db_leavetype lt
                LEFT JOIN db_emplleave el ON el.emplleave_leavetype = lt.leavetype_id AND el.emplleave_empl = '$this->empl_id'
                WHERE lt.leavetype_status = 1 
                GROUP BY lt.leavetype_id 
                ORDER BY lt.leavetype_seqno,lt.leavetype_code ";
   
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
        ?>
        <div class="form-group">
              <label for="emplleave_leavetype" class="col-sm-1 control-label"><?php echo $row['leavetype_code'];?></label>
              <div class="col-sm-3">
                <input type="hidden" class="form-control" id="emplleave_leavetype" name="emplleave_leavetype[]" value = "<?php echo $row['leavetype_id'];?>">  
                <input type="hidden" class="form-control" id="emplleave_id" name="emplleave_id[]" value = "<?php echo $row['emplleave_id'];?>">  
                <input type="text" class="form-control" id="emplleave_days" name="emplleave_days[]" value = "<?php echo $row['emplleave_days'];?>" placeholder="Days">
              </div>

        </div>
        <?php
        }
    }
    public function getListing(){
    ?>
    <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Employee Management</title>
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
      <div class="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Employee Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Employee Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='empl.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="empl_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:3%'>No</th>
                        <th style = 'width:25%'>Name</th>
                        <th style = 'width:15%'>Email</th>
                        <th style = 'width:10%'>Mobile</th>
                        <th style = 'width:8%'>Group</th>
                        <th style = 'width:8%'>Department</th>
                        <th style = 'width:8%'>Outlet</th>
                        <th style = 'width:8%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT empl.*,gp.group_code,dp.department_code,outl.outl_code
                              FROM db_empl empl 
                              INNER JOIN db_group gp ON gp.group_id = empl.empl_group
                              LEFT JOIN db_department dp ON dp.department_id = empl.empl_department
                              LEFT JOIN db_outl outl ON outl.outl_id = empl.empl_outlet
                              WHERE empl.empl_id > 0 AND empl.empl_status = 1 AND empl.empl_type = 'EMPLOYEE'";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['empl_name'];?></td>
                            <td><?php echo $row['empl_email'];?></td>
                            <td><?php echo $row['empl_mobile'];?></td>
                            <td><?php echo $row['group_code'];?></td>
                            <td><?php echo $row['department_code'];?></td>
                            <td><?php echo $row['outl_code'];?></td>
                            <td><?php if($row['empl_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'view')){
                                ?>
                                <!--<button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'empl.php?action=view&empl_id=<?php echo $row['empl_id'];?>'">View</button>-->
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'empl.php?action=edit&empl_id=<?php echo $row['empl_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('empl.php?action=delete&empl_id=<?php echo $row['empl_id'];?>','Confirm Delete?')">Delete</button>
                                <?php }?>
                            </td>
                        </tr>
                    <?php    
                        $i++;
                      }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style = 'width:3%'>No</th>
                        <th style = 'width:25%'>Name</th>
                        <th style = 'width:15%'>Email</th>
                        <th style = 'width:10%'>Mobile</th>
                        <th style = 'width:8%'>Group</th>
                        <th style = 'width:8%'>Department</th>
                        <th style = 'width:8%'>Outlet</th>
                        <th style = 'width:8%'>Status</th>
                        <th style = 'width:10%'></th>
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
        $('#empl_table').DataTable({
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

}
?>
