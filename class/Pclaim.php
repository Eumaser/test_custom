<?php
/*
 * To change this tpclaimate, choose Tools | Tpclaimates
 * and open the tpclaimate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Pclaim {

    public function Pclaim(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        
        if($this->smt == 'Confirm'){
            $this->pclaim_status = 2;
        }else{
            $this->pclaim_status = 1;
        }
        
        $this->pclaim_no = get_prefix_value("Pclaim",true);
        $table_field = array('pclaim_date','pclaim_amount','pclaim_remarks',
                             'pclaim_project_id','pclaim_no','pclaim_status');
        $table_value = array($this->pclaim_date,$this->pclaim_amount,$this->pclaim_remarks,
                             $this->pclaim_project_id,$this->pclaim_no,$this->pclaim_status);
        $remark = "Insert Pclaim.";
        if(!$this->save->SaveData($table_field,$table_value,'db_pclaim','pclaim_id',$remark)){
           return false;
        }else{
           $this->pclaim_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        
        if($this->smt == 'Confirm'){
            $this->pclaim_status = 2;
        }else if($this->smt == 'Certified Confirm'){
            $this->pclaim_status = 3;
        }
        
        $table_field = array('pclaim_date','pclaim_amount','pclaim_remarks',
                             'pclaim_project_id','pclaim_status');
        $table_value = array($this->pclaim_date,$this->pclaim_amount,$this->pclaim_remarks,
                             $this->pclaim_project_id,$this->pclaim_status);
        $remark = "Update Pclaim.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_pclaim','pclaim_id',$remark,$this->pclaim_id)){
           return false;
        }else{
           return true;
        }
    }
    public function createClaimLine(){

        $table_field = array('pclaimline_pclaim_id','pclaimline_pro_desc','pclaimline_qty','pclaimline_uprice','pclaimline_pro_remark',
                             'pclaimline_total','pcliamline_pro_id');
        $table_value = array($this->pclaim_id,$this->pclaimline_pro_desc,$this->pclaimline_qty,$this->pclaimline_uprice,$this->pclaimline_pro_remark,
                             $this->pclaimline_uprice * $this->pclaimline_qty,$this->pcliamline_pro_id);

        $remark = "Insert $this->document_code Line.<br> Document No : $this->order_no";
        if(!$this->save->SaveData($table_field,$table_value,'db_pclaimline','pclaimline_id',$remark)){
           return false;
        }else{
           $this->pclaimline_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function updateClaimLine(){
        
        if($this->isqa == 1){
            $table_field = array('pclaimline_cerqty','pclaimline_ceruprice','pclaimline_certotal','pclaimline_cerremark');
            $table_value = array($this->pclaimline_cerqty,$this->pclaimline_ceruprice,$this->pclaimline_certotal,$this->pclaimline_cerremark);
        }else{
            $table_field = array('pclaimline_pro_desc','pclaimline_qty','pclaimline_uprice','pclaimline_pro_remark',
                                 'pclaimline_total','pcliamline_pro_id');
            $table_value = array($this->pclaimline_pro_desc,$this->pclaimline_qty,$this->pclaimline_uprice,$this->pclaimline_pro_remark,
                                 $this->pclaimline_uprice * $this->pclaimline_qty,$this->pcliamline_pro_id);   
        }
        


        $remark = "Update $this->document_code Line.<br> Document No : $this->order_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_pclaimline','pclaimline_id',$remark,$this->pclaimline_id)){
           return false;
        }else{
           return true;
        }
    }
    public function deleteClaimLine(){
        if($this->save->DeleteData("db_pclaimline"," WHERE pclaimline_pclaim_id = '$this->pclaim_id' AND pclaimline_id = '$this->pclaimline_id'","Delete $this->document_code Order Line.")){
            return true;
        }else{
            return false;
        }
    }
    public function fetchPclaimDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT p.*,empl.empl_code as insert_by,empl2.empl_code as update_by,
                COALESCE((SELECT SUM(pclaimline_total) FROM db_pclaimline WHERE pclaimline_pclaim_id = p.pclaim_id),2) as total_amt
                FROM db_pclaim p
                LEFT JOIN db_empl empl ON empl.empl_id = p.insertBy
                LEFT JOIN db_empl empl2 ON empl2.empl_id = p.updateBy
                WHERE p.pclaim_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->pclaim_id = $row['pclaim_id'];
            $this->pclaim_date = $row['pclaim_date'];
            $this->pclaim_amount = $row['total_amt'];
            $this->pclaim_remarks = $row['pclaim_remarks'];
            $this->pclaim_project_id = $row['pclaim_project_id'];
            $this->pclaim_no = $row['pclaim_no'];
            $this->pclaim_status = $row['pclaim_status'];

        }
        return $query;
    }
    public function delete(){
        $table_field = array('pclaim_status');
        $table_value = array(0);
        $remark = "Delete Pclaim.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_pclaim','pclaim_id',$remark,$this->pclaim_id)){
           return false;
        }else{
           return true;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->pclaim_seqno = 10;
            $this->pclaim_status = 1;
            $this->pclaim_no = get_prefix_value("Pclaim",false);
            $this->pclaim_amount = 0;
        }
        $this->projectCrtl = $this->select->getProjectSelectCtrl($this->pclaim_project_id,'Y');
        $this->labourCrtl = $this->select->getLabourSelectCtrl("",'N');
        
        if(($this->pclaim_status == 2) || ($this->pclaim_status == 3)){
            $disabled = " DISABLED";
        }
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Progress Claim Management</title>
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
            <h1>Progress Claim Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->pclaim_id > 0){ echo "Update Progress Claim";}else{ echo "Create New Progress Claim";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='pclaim.php?isqa=<?php echo $this->isqa;?>'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='pclaim.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'pclaim_form' class="form-horizontal" action = 'pclaim.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="pclaim_no" class="col-sm-1 control-label">Claim No.</label>
                          <div class="col-sm-3">
                               <input type="text" class="form-control" id="pclaim_no" name="pclaim_no" value = "<?php echo $this->pclaim_no;?>" placeholder="Claim No." READONLY <?php echo $disabled;?>>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="pclaim_date" class="col-sm-1 control-label" >Claim Date</label>
                          <div class="col-sm-3">
                              <input type="text" class="form-control datepicker" id="pclaim_date" name="pclaim_date" value = "<?php echo format_date($this->pclaim_date);?>" placeholder="Claim Date" READONLY <?php echo $disabled;?>>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="pclaim_project_id" class="col-sm-1 control-label">Project Name <?php echo $mandatory;?></label>
                            <div class="col-sm-3">
                                 <select class="form-control select2" id="pclaim_project_id" name="pclaim_project_id" <?php echo $disabled;?>>
                                     <?php echo $this->projectCrtl;?>
                                 </select>
                            </div>
                        </div>
                      <?php 
                      if($this->pclaim_id > 0){
                      ?>
                        <div class="form-group">
                          <label for="pclaim_amount" class="col-sm-1 control-label">Claim Amount</label>
                          <div class="col-sm-3">
                              <input READONLY type="text" style = 'text-align:right' class="form-control" id="pclaim_amount" name="pclaim_amount" value = "<?php echo num_format($this->pclaim_amount);?>" placeholder="Claim Amount" <?php echo $disabled;?>>
                          </div>
                        </div> 
                      <?php }?>
                        <div class="form-group">
                          <label for="pclaim_remarks" class="col-sm-1 control-label">Remark</label>
                          <div class="col-sm-3">
                                <textarea class="form-control" rows="3" id="pclaim_remarks" name="pclaim_remarks" placeholder="Remark" <?php echo $disabled;?>><?php echo $this->pclaim_remarks;?></textarea>
                          </div>
                        </div> 


                  </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $this->isqa;?>" name = "isqa"/>
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->pclaim_status;?>" name = "pclaim_status"/>
                    <input type = "hidden" value = "<?php echo $this->pclaim_id;?>" name = "pclaim_id" id = "pclaim_id"/>
                    <?php
                    if($this->pclaim_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if((getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)) && (($this->pclaim_status != 2) && ($this->pclaim_status != 3) )){
                    ?>
                    <button type = "submit" name = "smt" value = "Save" class="btn btn-info">Save</button>
                     &nbsp;&nbsp;&nbsp;
                    <button type = "submit" name = "smt" value = "Confirm" class="btn btn-info">Confirm</button>

                    <?php }
                    if($this->isqa == 1){
                    ?>
                     &nbsp;&nbsp;&nbsp;
                    <button type = "submit" name = "smt" value = "Certified Confirm" class="btn btn-info">Certified Confirm</button>
                    <?php
                    }else{
                        if($this->pclaim_status == 2){
                            echo '<span class="label label-warning">Pending for Certified (等待认证)</span>';
                        }else if($this->pclaim_status == 3){
                            echo '<span class="label label-success">Certified Completed (认证成功)</span>';
                        }
                    }
                    ?>
                  </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
            <?php if($this->pclaim_id > 0){?>
            <div class="box box-success">
                <div class="nav-tabs-custom" style = 'margin-top:5px;'>
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#detail_tab" data-toggle="tab">Detail</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane <?php if($_REQUEST['tab'] == "" || $_REQUEST['tab'] == 'detail_tab'){ echo 'active';}?>" id="detail_tab">
                            <?php echo $this->getAddItemDetailForm();?>
                        </div>
                    </div>
                </div>
            </div><!-- /.box -->
            <?php }?> 
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    
    ?>
    
    <textarea style = 'display:none' id = 'pcliamline_pro_list'><?php echo $this->labourCrtl;?></textarea>
    <script>
        
    var line_copy = '<tr id = "line_@i" class="tbl_grid_odd" line = "@i">' +
                    '<td style = "width:30px;padding-left:5px">@i</td>' + 
                    '<td style = "width:150px;padding-left:5px"><select style = "width:100%" id = "pcliamline_pro_id_@i" class="form-control pcliamline_pro_class "></select></td>' + 
                    '<td style = "width:300px;"><textarea id = "pclaimline_pro_desc_@i" class="form-control"></textarea></td>'+
                    '<td style = "width:60px;"><input type = "text" id = "pclaimline_qty_@i" class="form-control calculate" value="1.00"/></td>'+
                    '<td style = "width:60px;"><input type = "text" id = "pclaimline_uprice_@i" class="form-control calculate text-align-right" /></td>'+
                    '<td style = "width:100px;"><input readonly type = "text" id = "pclaimline_total_@i" class="form-control text-align-right"/></td>'+
                    '<td style = "width:120px;"><textarea id = "pclaimline_pro_remark_@i" class="form-control"></textarea></td>'+
                    '<td align = "center" class = "" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">' +
                    '<img id = "save_line_@i" pclaimline_id = "" class = "save_line" line = "@i" src = "dist/img/add.png" style = "cursor:pointer" alt = "Add New"/>' + 
                    '<img id = "delete_line_@i" pclaimline_id = "" class = "delete_line" line = "@i" src = "dist/img/delete_icon.png" style = "cursor:pointer" alt = "Delete"/>' + 
                    '</td>'+
                    '</tr>';   
        
        
    $(document).ready(function() {
        
        <?php 
        if(($this->pclaim_id > 0) && ($this->pclaim_status == 1) ){
        ?>
        addline();
        <?php }?> 
        
        $('.pcliamline_pro_class').on('change',function(){
            getLabourDescription($(this).val(),$(this).closest("tr").attr('line'));
        });
        
        
        $('.save_line').on('click',function(){
            saveline($(this).attr('line'),$(this).attr('pclaimline_id'));
        });
        $('.delete_line').on('click',function(){
            deleteline($(this).attr('pclaimline_id'));
        });
        $('.calculate').on('keyup',function(){
            calculate($(this).closest("tr").attr('line'));
        });
        
        $("#pclaim_form").validate({
                  rules: 
                  {
                      pclaim_code:
                      {
                          required: true,
                          remote: {
                                  url: "pclaim.php?action=validate_pclaim",
                                  type: "post",
                                  data: 
                                        {
                                            pclaim_id: function()
                                            {
                                                return $("#pclaim_id").val();
                                            }
                                        }
                              }
                      }
                  },
                  messages:
                  {
                      pclaim_code:
                      {
                          required: "Please enter Pclaim Code.",
                          remote: "Pclaim Code duplicate."
                      }
                  }
              });
    
             
    });
    var issend = false;
    function saveline(line,pclaimline_id){
        if(issend){
            alert("Please wait.");
            return false;
        }

        issend = true;
        if(pclaimline_id != ""){
            var action = 'updateline';
        }else{
            var action = 'saveline';
        }
        
        var data = "pclaimline_pro_desc="+encodeURIComponent($('#pclaimline_pro_desc_'+line).val());
            data += "&pclaimline_qty="+$('#pclaimline_qty_'+line).val();
            data += "&pclaimline_uprice="+$('#pclaimline_uprice_'+line).val();
            data += "&pclaimline_pro_remark="+encodeURIComponent($('#pclaimline_pro_remark_'+line).val());
            data += "&pcliamline_pro_id="+$('#pcliamline_pro_id_'+line).val();
            
            data += "&pclaimline_cerqty="+$('#pclaimline_cerqty_'+line).val();
            data += "&pclaimline_ceruprice="+$('#pclaimline_ceruprice_'+line).val();
            data += "&pclaimline_cerremark="+encodeURIComponent($('#pclaimline_cerremark_'+line).val());
            
            data += "&action="+action;
            data += "&pclaimline_id="+pclaimline_id;
            data += "&pclaim_id=<?php echo $_REQUEST['pclaim_id'];?>";
            data += "&isqa=<?php echo $_REQUEST['isqa'];?>";

        $.ajax({ 
            type: 'POST',
            url: '<?php echo $this->document_url;?>',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("error");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   window.location.reload();
               }else{
                   alert(jsonObj.msg);
               }
               issend = false;
            }		
         });
         return false;
    }
    function deleteline(pclaimline_id){
        var data = "action=deleteline&order_id=<?php echo $this->order_id;?>&pclaimline_id="+pclaimline_id;
        $.ajax({ 
            type: 'POST',
            url: '<?php echo $this->document_url;?>',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("<?php echo $language[$lang]['system_error']?>");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   window.location.reload();
               }else{
                   alert("<?php echo $language[$lang]['deleteline_error'];?>");
               }
               issend = false;
            }		
         });
         return false;
    }
    function calculateAll(){
        for(var i = 1;i<=$('#total_line').val();i++){
            calculate(i);
        }
    }
    function calculate(line){
        var qty = parseFloat($('#pclaimline_qty_'+line).val().replace(/,/gi, ""));
        var funit_price = parseFloat($('#pclaimline_uprice_'+line).val().replace(/,/gi, ""));


        if(qty == ""){
           qty = 1;
        }

        if(isNaN(funit_price)){
           funit_price = 0;
        }

        
        var subtotal = parseFloat(qty) * RoundNum(parseFloat(funit_price),2);

        $('#pclaimline_total_'+line).val(changeNumberFormat(RoundNum(subtotal,2)));

        

        
    }
    function addline(){
        var addlinevalue = $('#total_line').val();
        var nextvalue = parseInt(addlinevalue)+1;
        var newline = line_copy.replace(/@i/g,nextvalue);
        $('#detail_last_tr').before(newline);
        $('#total_line').val(nextvalue);
        
        $('#pcliamline_pro_id_'+nextvalue).html($('#pcliamline_pro_list').val());
        
        $('.datepicker').datepicker({
            format: 'dd-M-yyyy',
            autoclose: true,
            pickerPosition: "bottom-left"
        }); 
    }
    function getLabourDescription(id,line){
        
        var data = "action=getLabourDescription&pcliamline_pro_id="+id;
        $.ajax({ 
            type: 'POST',
            url: '<?php echo $this->document_url;?>',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("error");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status > 0){
                    $('#pclaimline_pro_desc_'+line).val(jsonObj.desc);
//                    $('#pclaimline_uprice_'+line).val(jsonObj.price);
                    calculate(line);
               }else{
                   alert('Data not found.');
               }
            }		
         });
    }
    </script>
    <?php 
    echo $this->workDialogForm();
    echo $this->claimDialogForm();
    echo $this->workersDialogForm();
    echo $this->voDialogForm();
    echo $this->equipmentDialogForm();
    ?>
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
    <title>Progress Claim Management</title>
    <?php
    include_once 'css.php';
    
    ?>
    <style>
    
   </style>
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
            <h1>Progress Claim Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Claim Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='pclaim.php?action=createForm'">Create New + </button>
                
                <!--<button style = 'margin-right:10px;' class="btn btn-primary pull-right import_btn" data-toggle="modal" data-target="#myModal">Import + </button>-->
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="pclaim_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:10%'>Claim No.</th>
                        <th style = 'width:8%'>Claim Date</th>
                        <th style = 'width:10%'>Project Name</th>
                        <th style = 'width:15%;'>Claim Amount</th>
                        <th style = 'width:18%'>Remarks</th>
                        <th style = 'width:12%'>Submitted By</th>
                        <th style = 'width:12%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                        
                       if($_SESSION['empl_group'] == 7){
                           $wherestring = " AND (pclaim.insertBy = '{$_SESSION['empl_id']}' OR pclaim.updateBy = '{$_SESSION['empl_id']}')";
                       }else{
                           $wherestring = "";
                       }
                       
                       if($this->isqa == 1){
                           $wherestring_qa = " AND pclaim.pclaim_status IN ('2','3')";
                       }else{
                           $wherestring_qa = "";
                       }
                    
                      $sql = "SELECT pclaim.*,p.project_name,pa.partner_name as insert_by
                              FROM db_pclaim pclaim 
                              LEFT JOIN db_project p ON p.project_id = pclaim.pclaim_project_id
                              LEFT JOIN db_partner pa ON pa.partner_id = pclaim.insertBy
                              WHERE pclaim.pclaim_status > 0 $wherestring $wherestring_qa
                              ORDER BY pclaim.pclaim_no DESC";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['pclaim_no'];?></td>
                            <td><?php echo format_date($row['pclaim_date']);?></td>
                            <td><?php echo $row['project_name'];?></td>
                            <td><?php echo num_format($row['pclaim_amount']);?></td>
                            <td><?php echo nl2br($row['pclaim_remarks']);?></td>
                            <td><?php echo $row['insert_by'];?></td>
                            <td>
                                <?php 
                                if($row['pclaim_status'] == 2){
                                    echo '<span class="label label-warning">Pending for Certified (等待认证)</span>';
                                }else if($row['pclaim_status'] == 3){
                                    echo '<span class="label label-success">Certified Completed (认证成功)</span>';
                                }else if($row['pclaim_status'] == 1){
                                    echo '<span class="label label-primary">Pending for Submit (等待提交)</span>';
                                }
                                ?>
                            </td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'pclaim.php?action=edit&pclaim_id=<?php echo $row['pclaim_id'];?>&isqa=<?php echo $this->isqa;?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('pclaim.php?action=delete&pclaim_id=<?php echo $row['pclaim_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:10%'>Claim No.</th>
                        <th style = 'width:8%'>Claim Date</th>
                        <th style = 'width:10%'>Project Name</th>
                        <th style = 'width:15%'>Claim Amount</th>
                        <th style = 'width:18%'>Remarks</th>
                        <th style = 'width:12%'>Submitted By</th>
                        <th style = 'width:12%'>Status</th>
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
<!--<script type="text/javascript" src="http://www.sanwebe.com/assets/public/js/jquery.form.min.js"></script>-->
    <script>

      $(function () {
        $('#pclaim_table').DataTable({
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
    public function getDataTable(){
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array('No','customer_name','pclaim_code','pclaim_name','pclaim_loaref','pclaim_price','0','0','');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "pclaim_id";
	
	/* DB table to use */
        $sTable = "db_pclaim";
        /* 
	 * Paging
	 */
	$sLimit = "";
	if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
		$sLimit = "LIMIT ".mysql_real_escape_string($_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if($_GET['sSearch'] != ""){
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
                        if($aColumns[$i] == 'No' || $aColumns[$i] == ""){
                            continue;
                        }
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ($i=0;$i<count($aColumns);$i++){
                if($aColumns[$i] == 'No' || $aColumns[$i] == ""){
                    continue;
                }
		if($_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != ''){
			if ($sWhere == "" ){
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
        if($sWhere == ""){
            $sWhere = " WHERE pclaim.pclaim_status = '1'";
        }else{
            $sWhere = " AND pclaim.pclaim_status = '1'";
        }
	/*
	 * SQL queries
	 * Get data to display
	 */

        if(isset($_GET['iSortCol_0'])){
            if($_GET['iSortCol_0'] != 0){
		$sOrder = "ORDER BY  ";
		for($i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ){
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ){
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if($sOrder == "ORDER BY" ){
			$sOrder = "";
		}
            }
	}else{
            $sOrder = "ORDER BY pclaim.pclaim_seqno,pclaim.pclaim_code";
        }
        
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS pclaim.*,ps.pclaimstatus_code,p.partner_name as customer_name
		FROM db_pclaim pclaim
                LEFT JOIN db_pclaimstatus ps ON ps.pclaimstatus_id = pclaim.pclaim_progress
                LEFT JOIN db_partner p ON p.partner_id = pclaim.pclaim_customer
		$sWhere
		$sOrder
		$sLimit
	";

	$rResult = mysql_query($sQuery);
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query($sQuery);
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysql_query($sQuery);
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	

	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
        $b = $_GET['iDisplayStart']+1;
	while ($aRow = mysql_fetch_array($rResult)){
		$row = array();
		for ($i=0;$i<sizeof($aColumns);$i++){
			if($aColumns[$i] == "No" ){
				$row[] = $b;
			}else if($aColumns[$i] != ""){
                            if($aColumns[$i] == 'pclaim_status'){
                                if($aRow[$aColumns[$i]] == 1){
                                    $row[] = "Active";
                                }else{
                                    $row[] = "In-Active";
                                }
                            }else if(($aColumns[$i] == 'pclaim_startdate') || ($aColumns[$i] == 'pclaim_enddate') || ($aColumns[$i] == 'pclaim_completeddate')){
                                $row[] = format_date(($aRow[$aColumns[$i]]));
                            }else{
                                $row[] = ($aRow[$aColumns[$i]]);
                            }
			}else{
                           $btn = "";
                           if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                             $btn = "<button type='button' class='btn btn-primary btn-info ' onclick = 'location.href = \"pclaim.php?action=edit&pclaim_id={$aRow['pclaim_id']}\"'>Edit</button>";       
                           }
                           if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                             $btn .= " <button type='button' class='btn btn-primary btn-danger' onclick = 'confirmAlertHref(\"pclaim.php?action=delete&pclaim_id={$aRow['pclaim_id']}\",\"Confirm Delete?\")'>Delete</button>";  
                           }
                                $row[] = $btn;
                        }
		}
		$output['aaData'][] = $row;
                $b++;
	}

	echo json_encode($output);
    }
    public function getAddItemDetailForm(){
    $line = 0;  
    
    ?>    
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:30px;padding-left:5px">No</th>
            <th class = "" style = 'width:150px;max-width:150px'>Labour</th>
            <th class = "" style = 'width:300px;'>Description</th>
            <th class = "" style = 'width:60px;'>Qty</th>
            <th class = "" style = 'width:60px;'>U.Price</th>
            <th class = "">Sub Total</th>
            <th class = "" style = 'width:120px;'>Remark</th>
            <th class = "" style="width:80px;"></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM db_pclaimline WHERE pclaimline_id > 0 AND pclaimline_pclaim_id > 0 AND pclaimline_pclaim_id = '$this->pclaim_id'";
            $query = mysql_query($sql);
            $disabled = "";
            $readonly = "";
            while($row = mysql_fetch_array($query)){
                $line++;
                if(($this->pclaim_status == 2) || ($this->pclaim_status == 3)){
                    $readonly = " READONLY";
                    $disabled = " DISABLED";
                }
                $labourCrtl = $this->select->getLabourSelectCtrl($row['pcliamline_pro_id'],'N');
            ?>
                <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>">
                    <td style="width:30px;padding-left:5px"><?php echo $line;?></td>
                    <td style="width:150px;"><select style = "width:100%" id = "pcliamline_pro_id_<?php echo $line;?>" class="form-control pcliamline_pro_class " <?php echo $disabled;?>><?php echo $labourCrtl;?></select></td>
                    <td style="width:300px;"><textarea id = "pclaimline_pro_desc_<?php echo $line;?>" class="form-control" <?php echo $readonly;?>><?php echo $row['pclaimline_pro_desc'];?></textarea></td>
                    <td style="width:60px;"><input type = "text" line = "<?php echo $line;?>" id = "pclaimline_qty_<?php echo $line;?>" class="form-control calculate" value="<?php echo $row['pclaimline_qty'];?>" <?php echo $readonly;?>/></td>
                    <td style="width:60px;"><input type = "text" line = "<?php echo $line;?>" id = "pclaimline_uprice_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo num_format($row['pclaimline_uprice']);?>" <?php echo $readonly;?>  /></td>
                    <td style = "width:100px;"><input type = "text" id = "pclaimline_total_<?php echo $line;?>" class="form-control text-align-right" readonly value = "<?php echo num_format($row['pclaimline_total']);?>"/></td>
                    <td style="width:120px;"><textarea id = "pclaimline_pro_remark_<?php echo $line;?>" class="form-control" <?php echo $readonly;?>><?php echo $row['pclaimline_pro_remark'];?></textarea></td>
                    <td align = "center" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">
                        <?php if(($row['pclaimline_id'] > 0) && ($disabled == "")){?>
                        <img id = "save_line_<?php echo $line;?>" pclaimline_id = "<?php echo $row['pclaimline_id'];?>" class = "save_line" line = "<?php echo $line;?>" src = "dist/img/update.png" style = "cursor:pointer" alt = "Update"/>
                        <?php }else{
                            if($disabled == ""){    
                        ?>
                        <img id = "save_line_<?php echo $line;?>" pclaimline_id = "<?php echo $row['pclaimline_id'];?>" class = "save_line" line = "<?php echo $line;?>" src = "dist/img/add.png" style = "cursor:pointer" alt = "Add New"/>
                        <?php 
                            }
                        }
                        if($disabled == ""){ 
                        ?>
                        <img id = "delete_line_<?php echo $line;?>" pclaimline_id = "<?php echo $row['pclaimline_id'];?>" class = "delete_line" line = "<?php echo $line;?>" src = "dist/img/delete_icon.png" style = "cursor:pointer" alt = "Delete"/>
                        <?php }?>
                    </td>
                </tr>
                <?php
                
                if($this->isqa == 1 || $this->pclaim_status == 3){
                    
                    if($this->pclaim_status == 3){
                        $readonly = " READONLY";
                        $disabled = " DISABLED";
                    }else{
                        $readonly = " ";
                        $disabled = " ";
                    }

                ?>
                <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>">
                    <td style="width:30px;padding-left:5px;color:red"><b>Certified</b></td>
                    <td style="width:150px;"><select style = "width:100%" id = "pcliamline_pro_id_<?php echo $line;?>" class="form-control pcliamline_pro_class " disabled><?php echo $labourCrtl;?></select></td>
                    <td style="width:300px;"><textarea id = "pclaimline_pro_desc_<?php echo $line;?>" class="form-control" <?php echo $readonly;?> readonly><?php echo $row['pclaimline_pro_desc'];?></textarea></td>
                    <td style="width:60px;"><input type = "text" line = "<?php echo $line;?>" id = "pclaimline_cerqty_<?php echo $line;?>" class="form-control calculate" value="<?php echo $row['pclaimline_cerqty'];?>" <?php echo $readonly;?>/></td>
                    <td style="width:60px;"><input type = "text" line = "<?php echo $line;?>" id = "pclaimline_ceruprice_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo num_format($row['pclaimline_ceruprice']);?>" <?php echo $readonly;?>  /></td>
                    <td style = "width:100px;"><input type = "text" id = "pclaimline_certotal_<?php echo $line;?>" class="form-control text-align-right" readonly value = "<?php echo num_format($row['pclaimline_cerqty']*$row['pclaimline_ceruprice']);?>"/></td>
                    <td style="width:120px;"><textarea id = "pclaimline_cerremark_<?php echo $line;?>" class="form-control" <?php echo $readonly;?>><?php echo $row['pclaimline_cerremark'];?></textarea></td>
                    <td align = "center" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">
                        <?php if($this->pclaim_status == 2){?>
                        <img id = "save_line_<?php echo $line;?>" pclaimline_id = "<?php echo $row['pclaimline_id'];?>" class = "save_line" line = "<?php echo $line;?>" src = "dist/img/update.png" style = "cursor:pointer" alt = "Update"/>
                        <?php }?>
                    </td>
                </tr>
                <?php }?>
            
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
