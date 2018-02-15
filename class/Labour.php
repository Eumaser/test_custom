<?php
/*
 * To change this tlabourate, choose Tools | Tlabourates
 * and open the tlabourate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Labour {

    public function Labour(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('labour_code','labour_desc','labour_sale_price','labour_cost_price',
                             'labour_remarks','labour_status');
        $table_value = array($this->labour_code,$this->labour_desc,$this->labour_sale_price,$this->labour_category,
                             $this->labour_remarks,$this->labour_status);
        $remark = "Insert Labour.";
        if(!$this->save->SaveData($table_field,$table_value,'db_labour','labour_id',$remark)){
           return false;
        }else{
           $this->labour_id = $this->save->lastInsert_id;
           $this->createUpdateLabourLine();
           return true;
        }
    }
    public function update(){
        $table_field = array('labour_code','labour_desc','labour_sale_price','labour_cost_price',
                             'labour_remarks','labour_status');
        $table_value = array($this->labour_code,$this->labour_desc,$this->labour_sale_price,$this->labour_category,
                             $this->labour_remarks,$this->labour_status);
        
        $remark = "Update Labour.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_labour','labour_id',$remark,$this->labour_id)){
           return false;
        }else{
           $this->createUpdateLabourLine();
           return true;
        }
    }
    public function createUpdateLabourLine(){

        for($i=1;$i<=sizeof($this->labourline_partner_id);$i++){
              if($this->labourline_partner_id[$i] <= 0){
                  continue;//skip if user not pick
              }
              $sale_price = str_replace(",", "",$this->labourline_saleprice[$i]);

            $table_field = array('labour_id','labourline_partner_id','labourline_desc','labourline_saleprice');
            $table_value = array($this->labour_id,escape($this->labourline_partner_id[$i]),escape($this->labourline_desc[$i]),escape($sale_price));

            if($this->labourline_id[$i] > 0){
                $remark = "Update Labour Lines.";
                if(!$this->save->UpdateData($table_field,$table_value,'db_labourline','labourline_id',$remark,$this->labourline_id[$i]," AND labour_id = '$this->labour_id'")){
                   $true = false;
                } 
            }else{
                $remark = "Insert Labour Lines.";
                if(!$this->save->SaveData($table_field,$table_value,'db_labourline','labourline_id',$remark)){
                    $true = false;
                }
            }
     
        }  
        
    }
    public function fetchLabourDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_labour WHERE labour_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->labour_id = $row['labour_id'];
            $this->labour_code = $row['labour_code'];
            $this->labour_desc = $row['labour_desc'];
            
            $this->labour_sale_price = $row['labour_sale_price'];
            $this->labour_category = $row['labour_category'];
            $this->labour_cost_price = $row['labour_cost_price'];
            $this->labour_remarks = $row['labour_remarks'];
            
            $this->labour_seqno = $row['labour_seqno'];
            $this->labour_status = $row['labour_status'];
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_labour"," WHERE labour_id = '$this->labour_id'","Delete Labouret.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->labour_seqno = 10;
            $this->labour_status = 1;
            $this->labour_sale_price = "0.00";
            $this->labour_cost_price = "0.00";
        }
        $this->supplierctrl1 = $this->select->getCustomerSelectCtrl(0,'Y'," AND partner_issubcon = '1'");
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Labour Management</title>
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
            <h1>Labour Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->labour_id > 0){ echo "Update Labour";}else{ echo "Create New Labour";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='labour.php'">Back</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <!--<button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='labour.php?action=createForm'">Create New</button>-->
                <?php }?>
              </div>
                
                <form id = 'labour_form' class="form-horizontal" action = 'labour.php?action=create' method = "POST">
                  <div class="box-body">
                    <div class="form-group">
                        <label for="labour_code" class="col-sm-1 control-label">Name <?php echo $mandatory;?></label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="labour_code"  name="labour_code" placeholder="Name" value = "<?php echo $this->labour_code;?>" >
                        </div>
                        <label for="labour_sale_price" class="col-sm-2 control-label">Quotation Rate</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control text-align-right" id="labour_sale_price"  name="labour_sale_price" placeholder="Selling Price" value = "<?php echo $this->labour_sale_price;?>" >
                        </div>
                    </div>   
                    <div class="form-group">
                      <label for="labour_desc" class="col-sm-1 control-label">Description</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="7" id="labour_desc" name="labour_desc" placeholder="Description"><?php echo $this->labour_desc;?></textarea>
                      </div>
                      <label for="labour_remarks" class="col-sm-2 control-label">Remarks</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="7" id="labour_remarks" name="labour_remarks" placeholder="Remarks"><?php echo $this->labour_remarks;?></textarea>
                      </div>
                    </div>
                      <div style = 'clear:both'></div>
                      <div class="col-sm-6">
                          <div class = 'pull-left' ><h3>Sub Contractor</h3></div>
                          <div class = 'pull-right'>
                              <?php if($this->labour_status == 1){?>
                              <button type = 'button' class = 'btn btn-info addnewline' style = 'margin-top:15px;' >Add New Row</button>
                              <?php }?>
                          </div>
                      </div>
                      <div style = 'clear:both'></div>  
                      <div class="col-sm-6">
                        <?php echo $this->getAddSupplierDetailForm();?>
                      </div>
                      <div style = 'clear:both'></div>  
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->labour_status;?>" name = "labour_status"/>
                    <input type = "hidden" value = "<?php echo $this->labour_id;?>" name = "labour_id"/>
                    <?php 
                    if($this->labour_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){?>
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
    var line_copy = '<tr id = "line_@i" class="tbl_grid_odd" line = "@i">' +
                    '<td style = "width:5%;padding-left:5px">@i</td>' + 
                    '<td style = "width:20%;"><select style = "width:100%" name = "labourline_partner_id[@i]" id = "labourline_partner_id_@i" class="form-control select2 "><?php echo $this->supplierctrl1;?></select></td>'+
                    '<td class = "width:30%;"><textarea name = "labourline_desc[@i]" id = "labourline_desc_@i" class="form-control"></textarea></td>'+
                    '<td style = "width:10%;"><input type = "text" name = "labourline_saleprice[@i]" id = "labourline_saleprice_@i" line = "@i" class="form-control calculate text-align-right" value = "0.00"/></td>'+
                    '<td align = "center" class = "" style ="vertical-align:top;min-width:10%;padding-right:10px;padding-left:5px">' +
                    //'<a style = "margin-left:10px;margin-right:10px;" href = "#" id = "save_line_@i" claimsline_id = "" class = "save_line font-icon" line = "@i" ><i class="fa fa-plus" aria-hidden="true"></i></a>' + 
                    //'<a style = "margin-left:10px;margin-right:10px;" href = "#" id = "delete_line_@i" claimsline_id = "" class = "delete_line font-icon" line = "@i" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>' + 
                    '</td>'+
                    '</tr>';
    $(document).ready(function() {
        <?php if($this->labour_status == 1){?>
        addline();
        <?php }?>
        $('.addnewline').click(function(){
            addline();
        });
        $('.delete_line').on('click',function(){
            deleteline($(this).attr('labourline_id'));
        });
        $("#labour_form").validate({
                  rules: 
                  {
                      labour_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      labour_code:
                      {
                          required: "Please enter Labouret Code."
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

        var data = "claimsline_date="+$('#claimsline_date_'+line).val();
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
    function deleteline(labourline_id){
        var data = "action=deleteline&labour_id=<?php echo $this->labour_id;?>&labourline_id="+labourline_id;
        $.ajax({ 
            type: 'POST',
            url: 'labour.php',
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
    <title>Labour Management</title>
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
            <h1>Labour Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Labour Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='labour.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="labour_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Name</th>
                        <th style = 'width:40%'>Description</th>
                        <th style = 'width:15%'>Quotation Rate</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT labour.*
                              FROM db_labour labour 
                              WHERE labour.labour_id > 0 ORDER BY labour.labour_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['labour_code'];?></td>
                            <td><?php echo nl2br($row['labour_desc']);?></td>
                            <td>$<?php echo num_format($row['labour_sale_price']);?></td>
                            <td><?php if($row['labour_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'labour.php?action=edit&labour_id=<?php echo $row['labour_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <!--<button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('labour.php?action=delete&labour_id=<?php echo $row['labour_id'];?>','Confirm Delete?')">Delete</button>-->
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
                        <th style = 'width:15%'>Name</th>
                        <th style = 'width:40%'>Description</th>
                        <th style = 'width:15%'>Quotation Rate</th>
                        <th style = 'width:10%'>Status</th>
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
        $('#labour_table').DataTable({
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
    public function getAddSupplierDetailForm(){
    $line = 0;  
    if($this->labour_status != 1){
        $disabled = " DISABLED";
    }
    ?>    
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:5%;padding-left:5px">No</th>
            <th class = "" style = 'width:20%;'>Sub Contractor</th>
            <th class = "" style = 'padding-left:10px;width:30%;'>Remarks</th>
            <th class = "" style = 'padding-left:10px;width:10%;'>Price</th>
            <th class = "" style="width:10%"></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT cl.*
                    FROM db_labourline cl
                    WHERE labourline_id > 0 AND labour_id > 0 AND labour_id = '$this->labour_id' ORDER BY insertDateTime";
            $query = mysql_query($sql);
            while($row = mysql_fetch_array($query)){
                $line++;
                $this->supplierctrl = $this->select->getCustomerSelectCtrl($row['labourline_partner_id'],'Y'," AND partner_issubcon = '1'");
            ?>
                <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>">
                    <td style="width:5%;padding-left:5px"><?php echo $line;?></td>
                    <td style="width:80px;"><select style = 'width:100%' name = "labourline_partner_id[<?php echo $line;?>]" id = "labourline_partner_id_<?php echo $line;?>" class="form-control select2" <?php echo $disabled;?>><?php echo $this->supplierctrl;?></select></td>
                    <td style="width:80px;"><textarea name = "labourline_desc[<?php echo $line;?>]" id = "labourline_desc_<?php echo $line;?>" class="form-control" <?php echo $disabled;?>><?php echo $row['labourline_desc'];?></textarea></td>
                    <td style="width:60px;"><input type = "text" name = "labourline_saleprice[<?php echo $line;?>]" line = "<?php echo $line;?>" id = "labourline_saleprice_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo $row['labourline_saleprice'];?>" <?php echo $disabled;?>/></td>
                    <td align = "center" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">
                        <a style = "margin-left:10px;margin-right:10px;font-size:23px;color:red" href = "javascript:void(0)" id = "delete_line_<?php echo $line;?>" labourline_id = "<?php echo $row['labourline_id'];?>" class = "delete_line font-icon" line = "<?php echo $line;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        <input type = "hidden" name = "labourline_id[<?php echo $line;?>]" id = "labourline_id<?php echo $line;?>" class="form-control" value="<?php echo $row['labourline_id'];?>"/>
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
    public function deleteLabourLine(){
        $this->labourline_id = escape($this->labourline_id);
        if($this->save->DeleteData("db_labourline"," WHERE labour_id = '$this->labour_id' AND labourline_id = '$this->labourline_id'","Delete {$this->labour_id} Labour Line.")){
            return true;
        }else{
            return false;
        }
    }

}
?>
