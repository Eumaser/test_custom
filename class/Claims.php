<?php
/*
 * To change this tclaimsate, choose Tools | Tclaimsates
 * and open the tclaimsate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Claims {

    public function Claims(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('claims_title','claims_date','claims_remark','claims_status',
                             'claims_empl_id','claims_approvalstatus');
        $table_value = array($this->claims_title,format_date_database($this->claims_date),$this->claims_remark,1,
                             $_SESSION['empl_id'],$this->claims_approvalstatus);
        $remark = "Insert Apply Claims.";
        if(!$this->save->SaveData($table_field,$table_value,'db_claims','claims_id',$remark)){
           return false;
        }else{
           $this->claims_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('claims_title','claims_date','claims_remark','claims_status',
                             'claims_empl_id','claims_approvalstatus');
        $table_value = array($this->claims_title,format_date_database($this->claims_date),$this->claims_remark,1,
                             $_SESSION['empl_id'],$this->claims_approvalstatus);
        $remark = "Update Apply Claims.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_claims','claims_id',$remark,$this->claims_id)){
           return false;
        }else{
           $this->createUpdateClaimsLine();
           return true;
        }
    }
    public function updateApproveStatus(){
        $table_field = array('claims_approvalstatus');
        $table_value = array($this->claims_approvalstatus);
        $remark = "Update Approve Status.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_claims','claims_id',$remark,$this->claims_id)){
           return false;
        }else{
           return true;
        }
    }
    public function createUpdateClaimsLine(){

        include_once 'Claimstype.php';
        $ct = new Claimstype();
        $true = true;
        $total_claims_amount = 0;
        for($i=1;$i<=sizeof($this->claimsline_type_array);$i++){
            if($this->claimsline_type_array[$i] <= 0){
                continue;//skip if user not pick
            }
            $claims_amount = str_replace(",", "",$this->claimsline_amount_array[$i]);
            $ct->fetchClaimstypeDetail(" AND claimstype_id = '{$this->claimsline_type_array[$i]}'","","",1);
            if($ct->claimstype_maxamt > 0){
                if($claims_amount > $ct->claimstype_maxamt){
                   $claims_amount = $ct->claimstype_maxamt;
                }
            }
            $table_field = array('claimsline_seqno','claimsline_date','claimsline_type','claimsline_desc',
                                 'claimsline_receiptno','claimsline_amount','claimsline_claims_id');
            $table_value = array($this->claimsline_seqno_array[$i],format_date_database($this->claimsline_date_array[$i]),$this->claimsline_type_array[$i],$this->claimsline_desc_array[$i],
                                 $this->claimsline_receiptno_array[$i],$claims_amount,$this->claims_id);
            
            if($this->claimsline_id_array[$i] > 0){
                $remark = "Update Claims Lines.";
                if(!$this->save->UpdateData($table_field,$table_value,'db_claimsline','claimsline_id',$remark,$this->claimsline_id_array[$i]," AND claimsline_claims_id = '$this->claims_id'")){
                   $true = false;
                }else{

                } 
            }else{
                $remark = "Insert Claims Lines.";
                if(!$this->save->SaveData($table_field,$table_value,'db_claimsline','claimsline_id',$remark)){
                   $true = false;
                }else{

                } 
            }
            if(is_numeric($claims_amount)){
                $total_claims_amount = $total_claims_amount + $claims_amount;
            }
        }
        $this->UpdateClaimsAmount($total_claims_amount);

    }
    public function UpdateClaimsAmount($total_claims_amount){
            $table_field = array('claims_amount');
            $table_value = array($total_claims_amount);
            $remark = "Update Claims Amount.";
            if(!$this->save->UpdateData($table_field,$table_value,'db_claims','claims_id',$remark,$this->claims_id)){
               return false;
            }else{
                return true;
            } 
    }
    public function UpdateClaimsSingleLine(){
            $table_field = array('claimsline_seqno','claimsline_date','claimsline_type','claimsline_desc',
                                 'claimsline_receiptno','claimsline_amount');
            $table_value = array($this->claimsline_seqno_array,format_date_database($this->claimsline_date_array),$this->claimsline_type_array,$this->claimsline_desc_array,
                                 $this->claimsline_receiptno_array,$this->claimsline_amount_array);
            $remark = "Update Claims Lines.";
            if(!$this->save->UpdateData($table_field,$table_value,'db_claimsline','claimsline_id',$remark,$this->claimsline_id," AND claimsline_claims_id = '$this->claims_id'")){
               return false;
            }else{
                return true;
            } 
    }
    public function fetchClaimsDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_claims WHERE claims_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->claims_id = $row['claims_id'];
            $this->claims_empl_id = $row['claims_empl_id'];
            $this->claims_title = $row['claims_title'];
            $this->claims_date = $row['claims_date'];
            $this->claims_amount = $row['claims_amount'];
            $this->claims_remark = $row['claims_remark'];
            $this->claims_status = $row['claims_status'];
            $this->claims_approvalstatus = $row['claims_approvalstatus'];
        }
        return $query;
    }
    public function delete(){
        $table_field = array('claims_status');
        $table_value = array(0);
        $remark = "Delete Claims.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_claims','claims_id',$remark,$this->claims_id)){
           return false;
        }else{
           return true;
        }
    }
    public function deleteClaimsLine(){
        if($this->save->DeleteData("db_claimsline"," WHERE claimsline_claims_id = '$this->claims_id' AND claimsline_id = '$this->claimsline_id'","Delete {$this->claims_id} Order Line.")){
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
            $this->claims_seqno = 10;
            $this->claims_status = 1;
            $this->claims_date = system_date;
            $this->claims_dateto = system_date;
            $this->claims_total_day = 1;
            $this->claims_approvalstatus = 'Draft';
            $this->claims_duration = "full_day";
            $empl_data = $e->fetchEmplDetail(" AND empl_id = '{$_SESSION['empl_id']}'","","",2);
            $empl_code = $_SESSION['empl_code'];
            $empl_name = $_SESSION['empl_name'];
        }else{
            $empl_data = $e->fetchEmplDetail(" AND empl_id = '$this->claims_empl_id'","","",2);
            $empl_code = $empl_data['empl_code'];
            $empl_name = $empl_data['empl_name'];
        }
        if($this->claims_approvalstatus != "Draft"){
            $disabled = " DISABLED";
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Claims Management</title>
    <?php
    include_once 'css.php';
    $this->claimstypeCrtl = $this->select->getClaimsTypeSelectCtrl();
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
            <h1>Claims Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->claims_id > 0){ echo "Update Claims";}else{ echo "Submit New Claims";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='claims.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='claims.php?action=createForm'">Create New</button>
                <?php }?>
              </div>

                <form id = 'claims_form' class="form-horizontal" action = 'claims.php?action=create' method = "POST">
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
                      <label for="claims_title" class="col-sm-2 control-label">Title <?php echo $mandatory;?></label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" id="claims_title" name="claims_title" value = "<?php echo $this->claims_title;?>" placeholder="Title" <?php echo $disabled;?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="claims_amount" class="col-sm-2 control-label">Amount</label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="claims_amount" name="claims_amount" value = "<?php echo num_format($this->claims_amount);?>" placeholder="Amount" <?php echo $disabled;?> READONLY>
                      </div>
                    </div>
                     <div class="form-group">
                         <label for="claims_date" class="col-sm-2 control-label">Date</label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control datepicker" id="claims_date" name="claims_date" value = "<?php echo format_date($this->claims_date);?>" placeholder="Date" <?php echo $disabled;?>>
                      </div>
                     </div>   
                    <div class="form-group">
                      <label for="claims_remark" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-4">
                            <textarea class="form-control" rows="3" id="claims_remark" name="claims_remark" placeholder="Remark" <?php echo $disabled;?>><?php echo $this->claims_remark;?></textarea>
                      </div>
                      
                      <?php
                      if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],"approved")){
                      ?>
                            <label for="claims_approvalstatus" class="col-sm-2 control-label">Approval Status</label>
                            <div class="col-sm-2">
                                <select style = 'width:100%' class="form-control select2" id = 'claims_approvalstatus' name = 'claims_approvalstatus' >
                                    <option value = 'Draft' <?php if($this->claims_approvalstatus == 'Pending'){ echo 'SELECTED';}?>>Draft</option>
                                    <option value = 'Pending' <?php if($this->claims_approvalstatus == 'Pending'){ echo 'SELECTED';}?>>Pending</option>
                                    <option value = 'Approve' <?php if($this->claims_approvalstatus == 'Approve'){ echo 'SELECTED';}?>>Approve</option>
                                    <option value = 'Reject' <?php if($this->claims_approvalstatus == 'Reject'){ echo 'SELECTED';}?>>Reject</option>
                                    <option value = 'On-Hold' <?php if($this->claims_approvalstatus == 'On-Hold'){ echo 'SELECTED';}?>>On-Hold</option>
                                </select>
                                <input type = 'hidden' value = '<?php echo $this->claims_approvalstatus;?>' name = 'org_claims_approvalstatus'/>
                            </div>
                      <?php
                      }else{ //Normal Staff
                           if($this->claims_approvalstatus != 'Draft'){
                      ?> 
                            <label for="claims_approvalstatus" class="col-sm-2 control-label">Approval Status</label>
                            <div class="col-sm-4">
                                <label for="claims_reason" class="col-sm-3 control-label" style = 'color:red;' ><b><?php echo $this->getApprovalStatus($this->claims_approvalstatus);?></b></label>
                            </div>
                            <?php 
                           }
                      }
                      ?>
                    </div> 
                    </div>
                    <div class="col-sm-4" style = 'text-align:center' >    
                            
                   </div>
                      <div style = 'clear:both'></div>
                      <div>
                          <div class = 'pull-left' ><h3>Reimbursement Items</h3></div>
                          <div class = 'pull-right'>
                              <?php if($this->claims_approvalstatus == 'Draft'){?>
                              <button type = 'button' class = 'btn btn-info addnewline' style = 'margin-top:15px;' >Add New Row</button>
                              <?php }?>
                          </div>
                      </div>
                      <div style = 'clear:both'></div>  
                        
                        <?php echo $this->getAddItemDetailForm();?>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Back</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->claims_id;?>" name = "claims_id"/>
                    <?php 
                    if($this->claims_id > 0){
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
                        if($this->claims_approvalstatus == 'Draft'){
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
                     <?php if(file_exists("dist/images/empl/{$this->claims_empl_id}.png")){?>
                     <img src="dist/images/empl/<?php echo $this->claims_empl_id;?>.png" class="img-circle" alt="User Image"  >
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
                    '<td style = "width:10%;"><input type = "text" name = "claimsline_seqno[@i]" id = "claimsline_seqno_@i" class="form-control" value="@i"/></td>'+
                    '<td style = "width:10%;"><input type = "text" name = "claimsline_date[@i]" id = "claimsline_date_@i" class="form-control datepicker" value=""/></td>'+
                    '<td style = "width:10%;"><select name = "claimsline_type[@i]" id = "claimsline_type_@i" class="form-control select2 "><?php echo $this->claimstypeCrtl;?></select></td>'+
                    '<td class = "width:30%;"><textarea name = "claimsline_desc[@i]" id = "claimsline_desc_@i" class="form-control"></textarea></td>'+
                    '<td style = "width:15%;"><input type = "text" name = "claimsline_receiptno[@i]" id = "claimsline_receiptno_@i" class="form-control"/></td>'+
                    '<td style = "width:10%;"><input type = "text" name = "claimsline_amount[@i]" id = "claimsline_amount_@i" line = "@i" class="form-control calculate text-align-right" /></td>'+


                    '<td align = "center" class = "" style ="vertical-align:top;min-width:10%;padding-right:10px;padding-left:5px">' +
                    //'<a style = "margin-left:10px;margin-right:10px;" href = "#" id = "save_line_@i" claimsline_id = "" class = "save_line font-icon" line = "@i" ><i class="fa fa-plus" aria-hidden="true"></i></a>' + 
                    //'<a style = "margin-left:10px;margin-right:10px;" href = "#" id = "delete_line_@i" claimsline_id = "" class = "delete_line font-icon" line = "@i" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>' + 
                    '</td>'+
                    '</tr>';
    $(document).ready(function() {
        <?php if($this->claims_approvalstatus == 'Draft'){?>
        addline();
        <?php }?>

        $('.addnewline').click(function(){
            addline();
        });
        $('.save_line').on('click',function(){
            saveline($(this).attr('line'),$(this).attr('claimsline_id'));
        });
        $('.delete_line').on('click',function(){
            deleteline($(this).attr('claimsline_id'));
        });
        $('.calculate').on('keyup',function(){
            calculate();
        });
        $("#claims_form").validate({
                  rules: 
                  {
                      claims_title:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      claims_title:
                      {
                          required: "Please enter Claims Title."
                      }
                  }
        });
});
    var issend = false;
    function saveline(line,claimsline_id){
        if(issend){
            alert("Please wait...");
            return false;
        }

        issend = true;
        if(claimsline_id != ""){
            var action = 'updateline';
        }else{
            var action = 'saveline';
        }

        var data = "claimsline_seqno="+$('#claimsline_seqno_'+line).val();
            data += "&claimsline_date="+$('#claimsline_date_'+line).val();
            data += "&claimsline_type="+$('#claimsline_type_'+line).val();
            data += "&claimsline_desc="+encodeURIComponent($('#claimsline_desc_'+line).val());
            data += "&claimsline_receiptno="+$('#claimsline_receiptno_'+line).val();
            data += "&claimsline_amount="+$('#claimsline_amount_'+line).val();
            data += "&action="+action;
            data += "&claimsline_id="+claimsline_id;
            data += "&claims_id=<?php echo $this->claims_id;?>";

        $.ajax({ 
            type: 'POST',
            url: 'claims.php',
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
                   alert("Add/Update Fail.");
               }
               issend = false;
            }		
         });
         return false;
    }
    function deleteline(claims_id){
        var data = "action=deleteline&claims_id=<?php echo $this->claims_id;?>&claimsline_id="+claims_id;
        $.ajax({ 
            type: 'POST',
            url: 'claims.php',
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
                   alert("Fail to delete line.");
               }
               issend = false;
            }		
         });
         return false;
    }
    function addline(){
        var addlinevalue = $('#total_line').val();
        var nextvalue = parseInt(addlinevalue)+1;
        var newline = line_copy.replace(/@i/g,nextvalue);
        $('#detail_last_tr').before(newline);
        $('#total_line').val(nextvalue);
        $('#claimsline_seqno_'+nextvalue).val(nextvalue*10);
        $(".select2").select2();
        $('.calculate').on('keyup',function(){
            calculate();
        });
        $('.datepicker').datepicker({
            format: 'dd-M-yyyy',
            autoclose: true,
            pickerPosition: "bottom-left"
        });
    }
    function calculate(){
        var total_claims_amount = 0;
        $('.calculate').each(function(){
            var line = $(this).attr('line');
            var line_amount = $(this).val().replace(/,/gi, "");
            if(isNaN(line_amount)){
                line_amount = 0;
            }
            if($('#claimsline_type_'+line).val() > 0){
                checkClaimsLimit($('#claimsline_type_'+line).val(),line);
                total_claims_amount = parseFloat(total_claims_amount) + parseFloat(line_amount);
            }
        });
        $('#claims_amount').val(changeNumberFormat(total_claims_amount));
    }
    function checkClaimsLimit(claimstype_id,line){

        var data = "action=checkClaimsLimit&claimstype_id=" + claimstype_id;
        $.ajax({ 
            type: 'POST',
            url: 'claimstype.php',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("System Error.");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   var line_amount = $('#claimsline_amount_'+line).val().replace(/,/gi, "");
                   if(jsonObj.claims_limit > 0){
                       if(parseFloat(line_amount) > parseFloat(jsonObj.claims_limit)){
                           
                           $('#claimsline_amount_'+line).css('border','2px solid red');
                           if(!$('#claimsline_amount_'+line).hasClass('limit_error')){
                            alert('Claims Limit.');
                           }
                           $('#claimsline_amount_'+line).addClass('limit_error');
                           return false;
                       }else{
                           $('#claimsline_amount_'+line).css('border','1px solid #828282');
                       }
                   }
               }

            }		
         });
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
    <title>Claims Management</title>
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
            <h1>Claims Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Claims Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='claims.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="claims_table" class="table table-bordered table-hover">
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
                            $wherestring = "AND (l.claims_approvalstatus <> 'Draft' OR l.insertBy = '{$_SESSION['empl_id']}')";
                        }else{
                            $wherestring = "AND l.claims_empl_id = '{$_SESSION['empl_id']}'";
                        }
                      $sql = "SELECT l.*,empl.empl_name
                              FROM db_claims l 
                              INNER JOIN db_empl empl ON empl.empl_id = l.claims_empl_id
                             
                              WHERE l.claims_id > 0 AND l.claims_status = '1' $wherestring
                              ORDER BY l.updateDateTime";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['empl_name'];?></td>
                            <td><?php echo $row['claims_title'];?></td>
                            <td><?php echo format_date($row['claims_date']);?></td>
                            <td><?php echo nl2br($row['claims_remark']);?></td>
                            <td><?php echo num_format(getDataCodeBySql("SUM(claimsline_amount)","db_claimsline"," WHERE claimsline_claims_id = '{$row['claims_id']}'",""));?></td>
                            <td><?php echo $this->getApprovalStatus($row['claims_approvalstatus']);?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'claims.php?action=edit&claims_id=<?php echo $row['claims_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                        if($row['claims_approvalstatus'] == 'Draft'){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('claims.php?action=delete&claims_id=<?php echo $row['claims_id'];?>','Confirm Delete?')">Delete</button>
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
        $('#claims_table').DataTable({
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
    public function getAddItemDetailForm(){
    $line = 0;  
    if($this->claims_approvalstatus <> 'Draft'){
        $disabled = " DISABLED";
    }
    ?>    
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:5%;padding-left:5px">No</th>
            <th class = ""  style = 'width:5%'>Seq No</th>
            <th class = "" style = 'width:10%;'>Date</th>
            <th class = "" style = 'width:10%;'>Claims Type</th>
            <th class = "" style = 'width:30%;'>Description</th>
            <th class = "" style = 'width:15%'>Receipt No</th>
            <th class = "" style = 'width:10%'>Amount</th>
            <th class = "" style="width:10%"></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM db_claimsline WHERE claimsline_id > 0 AND claimsline_claims_id > 0 AND claimsline_claims_id = '$this->claims_id' ORDER BY claimsline_seqno";
            $query = mysql_query($sql);
            while($row = mysql_fetch_array($query)){
                $line++;
                $this->claimstypelineCrtl = $this->select->getClaimsTypeSelectCtrl($row['claimsline_type']);
            ?>
                <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>">
                    <td style="width:5%;padding-left:5px"><?php echo $line;?></td>
                    <td style="width:60px;"><input type = "text" name = "claimsline_seqno[<?php echo $line;?>]" id = "claimsline_seqno_<?php echo $line;?>" class="form-control" value="<?php echo $row['claimsline_seqno'];?>" <?php echo $disabled;?>/></td>
                    <td style="width:180px;"><input type = "text" name = "claimsline_date[<?php echo $line;?>]" id = "claimsline_date_<?php echo $line;?>" class="form-control datepicker" value="<?php echo format_date($row['claimsline_date']);?>" <?php echo $disabled;?>/></td>
                    <td style="width:80px;"><select style = 'width:100%' name = "claimsline_type[<?php echo $line;?>]" id = "claimsline_type_<?php echo $line;?>" class="form-control select2" <?php echo $disabled;?>><?php echo $this->claimstypelineCrtl;?></select></td>
                    <td style="width:250px;"><textarea name = "claimsline_desc[<?php echo $line;?>]" id = "claimsline_desc_<?php echo $line;?>" class="form-control" <?php echo $disabled;?>><?php echo $row['claimsline_desc'];?></textarea></td>
                    <td style="width:60px;"><input type = "text" name = "claimsline_receiptno[<?php echo $line;?>]" line = "<?php echo $line;?>" id = "claimsline_receiptno_<?php echo $line;?>" class="form-control" value="<?php echo $row['claimsline_receiptno'];?>" <?php echo $disabled;?>/></td>
                    <td style="width:60px;"><input type = "text" name = "claimsline_amount[<?php echo $line;?>]" line = "<?php echo $line;?>" id = "claimsline_amount_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo $row['claimsline_amount'];?>" <?php echo $disabled;?>/></td>
                    <td align = "center" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">
                        <?php 
                        if($this->claims_approvalstatus == 'Draft'){
                            if($row['claimsline_id'] > 0){
                        ?>
                            <a style = "margin-left:10px;margin-right:10px;" href = "javascript:void(0)" id = "save_line_<?php echo $line;?>" claimsline_id = "<?php echo $row['claimsline_id'];?>" class = "save_line font-icon" line = "<?php echo $line;?>" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php }else{?>
                            <a style = "margin-left:10px;margin-right:10px;" href = "javascript:void(0)" id = "save_line_<?php echo $line;?>" claimsline_id = "<?php echo $row['claimsline_id'];?>" class = "save_line font-icon" line = "<?php echo $line;?>" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php }?>
                        <a style = "margin-left:10px;margin-right:10px;" href = "javascript:void(0)" id = "delete_line_<?php echo $line;?>" claimsline_id = "<?php echo $row['claimsline_id'];?>" class = "delete_line font-icon" line = "<?php echo $line;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        <?php }?>
                        <input type = "hidden" name = "claimsline_id[<?php echo $line;?>]" id = "claimsline_id<?php echo $line;?>" class="form-control" value="<?php echo $row['claimsline_id'];?>"/>
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
}
?>
