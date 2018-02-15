<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Productgroup{
    public function Productgroup(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
    }
    public function createMain(){
        $table_field = array('maingroup_name','maingroup_remark','maingroup_seqno','maingroup_status');
        $table_value = array($this->maingroup_name,$this->maingroup_remark,$this->maingroup_seqno,$this->maingroup_status);
        $remark = "Insert Product Main Group: $this->maingroup_name";
        if(!$this->save->SaveData($table_field,$table_value,'db_maingroup','maingroup_id',$remark)){
           return false;
        }else{
           $this->maingroup_id = $this->save->lastInsert_id;
           //$this->pictureManagement();
           return true;
        }
    }
    public function updateMain(){
        $table_field = array('maingroup_name','maingroup_remark','maingroup_seqno','maingroup_status');
        $table_value = array($this->maingroup_name,$this->maingroup_remark,$this->maingroup_seqno,$this->maingroup_status);
        $remark = "Update Product Main Group: $this->maingroup_name";
        if(!$this->save->UpdateData($table_field,$table_value,'db_maingroup','maingroup_id',$remark,$this->maingroup_id)){
           return false;
        }else{
           //$this->maingroup_id = $this->save->lastInsert_id;
           //$this->pictureManagement();
           return true;
        }
    }
    public function createSubLine(){

        $table_field = array('subgroup_main_id','subgroup_name',
                            'subgroup_remark','subgroup_seqno','subgroup_status');
        $table_value = array($this->maingroup_id,$this->subgroup_name,
                                $this->subgroup_remark,$this->subgroup_seqno,$this->subgroup_status);
        $this->fetchMainDetail(" AND maingroup_id = '$this->maingroup_id'","","",1);
        $remark = "Insert Sub Group.<br> Main Group : $this->maingroup_id";
        if(!$this->save->SaveData($table_field,$table_value,'db_subgroup','subgroup_id',$remark)){
           return false;
        }else{
           $this->subgroup_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function updateSubLine(){
        
        $table_field = array('subgroup_main_id','subgroup_name',
                             'subgroup_remark','subgroup_seqno','subgroup_status');
        $table_value = array($this->maingroup_id,$this->subgroup_name,
                             $this->subgroup_remark,$this->subgroup_seqno,$this->subgroup_status);
        $this->fetchSubLineDetail(" AND subgroup_main_id = '$this->maingroup_id'","","",1);
        $remark = "Update Sub Group.<br> Main Group : $this->subgroup_main_id";
        if(!$this->save->UpdateData($table_field,$table_value,'db_subgroup','subgroup_id',$remark,$this->subgroup_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchMainDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_maingroup WHERE maingroup_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->maingroup_id = $row['maingroup_id'];
            $this->maingroup_name = $row['maingroup_name'];
            $this->maingroup_remark = $row['maingroup_remark'];
            $this->maingroup_seqno = $row['maingroup_seqno'];
            $this->maingroup_status = $row['maingroup_status'];
        }
        return $query;
    }
    public function fetchSubLineDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_subgroup WHERE subgroup_id > 0 AND subgroup_main_id = '$this->maingroup_id' $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);
            $this->subgroup_id = $row['subgroup_id'];
            $this->subgroup_main_id = $row['subgroup_main_id'];
            $this->subgroup_name = $row['subgroup_name'];
            $this->subgroup_remark = $row['subgroup_remark'];
            $this->subgroup_seqno = $row['subgroup_seqno'];
            $this->subgroup_status = $row['subgroup_status'];
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_maingroup"," WHERE maingroup_id = '$this->maingroup_id'","Delete Main Group.")){
            return true;
        }else{
            return false;
        }
    }
    public function deleteSubLine(){
        if($this->save->DeleteData("db_subgroup"," WHERE subgroup_main_id = '$this->maingroup_id' AND subgroup_id = '$this->subgroup_id'","Delete $this->maingroup_id Subgroup Line.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->maingroup_seqno = 10;
            $this->maingroup_status = 1;
        }
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product Main Group Management</title>
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
            <h1>Product Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->product_id > 0){ echo "Update Product Main Group";}else{ echo "Create New Product Main Group";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='productgroup.php'">Back</button>
              </div>
                
                <form id = 'product_form' class="form-horizontal" action = 'productgroup.php?action=create' method = "POST" enctype="multipart/form-data">
                  <div class="box-body">
                      <div class="col-sm-9">
                        <div class="form-group">
                            <label for="maingroup_name" class="col-sm-2 control-label">Name <?php echo $mandatory;?></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="maingroup_name"  name="maingroup_name" placeholder="Name" value = "<?php echo $this->maingroup_name;?>" >
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="maingroup_status" class="col-sm-2 control-label">Status <?php echo $mandatory;?></label>
                            <div class="col-sm-3">
                            <select class="form-control" id="maingroup_status" name="maingroup_status">
                              <option value = '1' <?php if($this->maingroup_status == 1){ echo 'SELECTED';}?>>Active</option>
                              <option value = '0' <?php if($this->maingroup_status == 0){ echo 'SELECTED';}?>>In-active</option>
                            </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="maingroup_remark" class="col-sm-2 control-label">Remark <?php echo $mandatory;?></label>
                            <div class="col-sm-3">
                                <textarea class="form-control" rows="3" id="maingroup_remark" name="maingroup_remark" placeholder="Remark"><?php echo $this->maingroup_remark;?></textarea>
                            </div>
                        </div>
                      </div>
                      
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->maingroup_status;?>" name = "maingroup_status"/>
                    <input type = "hidden" value = "<?php echo $this->maingroup_id;?>" name = "maingroup_id"/>
                    <?php 
                    if($this->product_id > 0){
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
            <?php if($this->maingroup_id > 0){?>
            <div class="box box-success">
                <div class="nav-tabs-custom" style = 'margin-top:5px;'>
                    <ul class="nav nav-tabs">
                      <li <?php if($_REQUEST['tab'] == "" || $_REQUEST['tab'] == 'sub_tab'){ echo 'class="active"';}?>><a href="#sub_tab" data-toggle="tab">Sub Group</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane <?php if($_REQUEST['tab'] == "" || $_REQUEST['tab'] == 'sub_tab'){ echo 'active';}?>" id="sub_tab">
                            <?php echo $this->getAddSubGroupForm();?>
                        </div>                        
                    </div>
                </div>
            </div><!-- /.box -->
            <?php }?> 
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <textarea style = 'display:none' id = 'testhtml' ><?php echo $this->supplierctrl1;?></textarea>
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    
    ?>
    <script>
    var line_copy = '<tr id = "line_@i" class="tbl_grid_odd" line = "@i">' +
                    '<td style = "width:30px;padding-left:5px">@i</td>' + 
                    '<td style = "width:100px;"><input type = "text" id = "subgroup_name_@i" class="form-control" value=""/></td>'+
                    '<td style = "width:100px;"><select style = "width:100px;" line = "@i" id = "subgroup_status_@i" class="form-control" ><option value="1" selected >Active</option><option value="0" >In-active</option></select></td>'+
                    '<td style="width:120px;"><textarea  rows="1" cols="15"  id = "subgroup_remark_@i" class="form-control" ></textarea></td>' +
                    '<td align = "center" class = "" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">' +
                    '<img id = "save_line_@i" ordl_id = "" class = "save_line" line = "@i" src = "dist/img/add.png" style = "cursor:pointer" alt = "Add New"/>' + 
                    '<img id = "delete_line_@i" ordl_id = "" class = "delete_line" line = "@i" src = "dist/img/delete_icon.png" style = "cursor:pointer" alt = "Delete"/>' + 
                    '</td>'+
                    '</tr>';
    $(document).ready(function() {
        <?php if($this->maingroup_status == 1){?>
        addline();
        <?php }?>
        $('.save_line').on('click',function(){
            saveline($(this).attr('line'),$(this).attr('subgroup_id'));
        });
        $('.update_line').on('click',function(){
            saveline($(this).attr('line'),$(this).attr('subgroup_id'));
        });
        $('.delete_line').on('click',function(){
            deleteline($(this).attr('subgroup_id'));
        });
       
        $("#product_form").validate({
                  rules: 
                  {
                      product_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      product_code:
                      {
                          required: "Please enter Productpackageet Code."
                      }
                  }
              });
    
    
    });
    var issend = false;
    function saveline(line,subgroup_id){
        if(issend){
            alert("Please wait...");
            return false;
        }

        issend = true;
        if(subgroup_id != ""){
            var action = 'updateline';
        }else{
            var action = 'saveline';
        }

        var data = "subgroup_name="+$('#subgroup_name_'+line).val();
            data += "&subgroup_status="+$('#subgroup_status_'+line).val();
            data += "&subgroup_remark="+encodeURIComponent($('#subgroup_remark_'+line).val());
            data += "&action="+action;
            data += "&subgroup_id="+subgroup_id;
            data += "&maingroup_id=<?php echo $this->maingroup_id;?>";

        $.ajax({ 
            type: 'POST',
            url: '<?php echo $this->document_url;?>',
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
    function deleteline(subgroup_id){
        var data = "action=deleteline&maingroup_id=<?php echo $this->maingroup_id;?>&subgroup_id="+subgroup_id;
        $.ajax({ 
            type: 'POST',
            url: '<?php echo $this->document_url;?>',
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
        $('#subgroup_seqno_'+nextvalue).val(nextvalue*10);
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
    <title>Category Management</title>
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
            <h1>Product Group Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Product Group Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right"  onclick = "window.location.href='productgroup.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="category_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Group Name</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT * FROM db_maingroup WHERE maingroup_id > 0 ";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['maingroup_name'];?></td>
                            <td><?php echo nl2br($row['maingroup_remark']);?></td>
                            <td><?php echo $row['maingroup_seqno'];?></td>
                            <td><?php if($row['maingroup_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'productgroup.php?action=edit&maingroup_id=<?php echo $row['maingroup_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('productgroup.php?action=delete&maingroup_id=<?php echo $row['maingroup_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Group Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
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
        $('#category_table').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
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
    public function getAddSubGroupForm(){
    $line = 0;  
    
    ?>    
    <table id="sub_table" class="table transaction-sub">
        <thead>
          <tr>
            <th class = '' style='width:30px;padding-left:5px'>No</th>
            <th class = '' style ='width:100px;'>Name</th>
            <th class = '' style ='width:100px;'>Status</th>
            <th class = '' style ='width:120px;'>Remark</th>
            <th class = '' style='width:80px;'></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM db_subgroup WHERE subgroup_id > 0 AND subgroup_main_id > 0 AND subgroup_main_id = '$this->maingroup_id' ";
            $query = mysql_query($sql);
            $disabled = "";
            $readonly = "";
            while($row = mysql_fetch_array($query)){
                $line++;

                /**if(($this->order_status == -3) || ($this->order_status == 2) || ($this->order_status == 3)){
                    $readonly = " READONLY";
                    $disabled = " DISABLED"; 
                }**/
            ?>
                <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>">
                    <td style="width:30px;padding-left:5px"><?php echo $line;?></td>
                    <td style="width:100px;"><input type = "text" line = "<?php echo $line;?>" id = "subgroup_name_<?php echo $line;?>" class="form-control" value="<?php echo $row['subgroup_name'];?>" <?php echo $readonly;?>/></td>
                    <td style="width:100px;">
                        <select style = "width:100px;" line = "<?php echo $line;?>" id = "subgroup_status_<?php echo $line;?>" class="form-control" <?php echo $disabled;?>>
                            <option value="1" <?php if($row['subgroup_status'] == '1'){ echo "selected";} ?>>Active</option>
                            <option value="0" <?php if($row['subgroup_status'] == '0'){ echo "selected";} ?>>In-active</option>
                        </select>
                    </td>                    
                    <td style="width:120px;"><textarea  rows="1" cols="15"  id = "subgroup_remark_<?php echo $line;?>" class="form-control" <?php echo $readonly;?>><?php echo $row['subgroup_remark'];?></textarea></td>
                    <td align = "center" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">
                        <?php if(($row['subgroup_id'] > 0) && ($disabled == "")){?>
                        <img id = "update_line_<?php echo $line;?>" subgroup_id = "<?php echo $row['subgroup_id'];?>" class = "update_line" line = "<?php echo $line;?>" src = "dist/img/update.png" style = "cursor:pointer" alt = "Update"/>
                        <?php }else{
                            if($disabled == ""){    
                        ?>
                        <img id = "save_line_<?php echo $line;?>" subgroup_id = "<?php echo $row['subgroup_id'];?>" class = "save_line" line = "<?php echo $line;?>" src = "dist/img/add.png" style = "cursor:pointer" alt = "Add New"/>
                        <?php 
                            }
                        }
                        if($disabled == ""){ 
                        ?>
                        <img id = "delete_line_<?php echo $line;?>" subgroup_id = "<?php echo $row['subgroup_id'];?>" class = "delete_line" line = "<?php echo $line;?>" src = "dist/img/delete_icon.png" style = "cursor:pointer" alt = "Delete"/>
                        <?php }?>
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