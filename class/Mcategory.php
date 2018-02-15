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
class Mcategory {

    public function Mcategory(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('materialcategory_code','materialcategory_desc','materialcategory_seqno','materialcategory_status');
        $table_value = array($this->materialcategory_code,$this->materialcategory_desc,$this->materialcategory_seqno,$this->materialcategory_status);
        $remark = "Insert Mcategory.";
        if(!$this->save->SaveData($table_field,$table_value,'db_materialcategory','materialcategory_id',$remark)){
           return false;
        }else{
           $this->materialcategory_id = $this->save->lastInsert_id; 
           return true;
        }
    }
    public function update(){
        $table_field = array('materialcategory_code','materialcategory_desc','materialcategory_seqno','materialcategory_status');
        $table_value = array($this->materialcategory_code,$this->materialcategory_desc,$this->materialcategory_seqno,$this->materialcategory_status);
        $remark = "Update Mcategory.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_materialcategory','materialcategory_id',$remark,$this->materialcategory_id)){
           return false;
        }else{
           return true;
        }
    }
    public function delete(){
        if($this->save->DeleteData("db_materialcategory"," WHERE materialcategory_id = '$this->materialcategory_id'","Delete Mcategory.")){
            return true;
        }else{
            return false;
        }
    }
    public function fetchMcategoryDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT c.*
                FROM db_materialcategory c
                WHERE c.materialcategory_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->materialcategory_id = $row['materialcategory_id'];
            $this->materialcategory_code = $row['materialcategory_code'];
            $this->materialcategory_desc = $row['materialcategory_desc'];
            $this->materialcategory_seqno = $row['materialcategory_seqno'];
            $this->materialcategory_status = $row['materialcategory_status'];
        }
        return $query;
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->materialcategory_seqno = 10;
            $this->materialcategory_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Material Category Management</title>
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
            <h1>Material Category Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->materialcategory_id > 0){ echo "Update Material Category";}else{ echo "Create New Material Category";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='mcategory.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='mcategory.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'mcategory_form' class="form-horizontal" action = 'mcategory.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="materialcategory_code" class="col-sm-2 control-label">Material Category Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="materialcategory_code" name="materialcategory_code" placeholder="Material Category Code" value = "<?php echo $this->materialcategory_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="materialcategory_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="materialcategory_seqno" name="materialcategory_seqno" value = "<?php echo $this->materialcategory_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="materialcategory_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="materialcategory_status" name="materialcategory_status">
                             <option value = '1' <?php if($this->materialcategory_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->materialcategory_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="materialcategory_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="materialcategory_desc" name="materialcategory_desc" placeholder="Remark"><?php echo $this->materialcategory_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->materialcategory_id;?>" name = "materialcategory_id"/>
                    <?php 
                    if($this->materialcategory_id > 0){
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
    $(document).ready(function() {
        $("#mcategory_form").validate({
                  rules: 
                  {
                      materialcategory_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      materialcategory_code:
                      {
                          required: "Please enter Producttypeet Code."
                      }
                  }
              });
    
    
});
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
    <title>Material Category Management</title>
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
            <h1>Material Category Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Material Category Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='mcategory.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="mcategory_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Material Category Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT mcategory.*
                              FROM db_materialcategory mcategory 
                              WHERE mcategory.materialcategory_id > 0 ORDER BY materialcategory_seqno,materialcategory_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['materialcategory_code'];?></td>
                            <td><?php echo nl2br($row['materialcategory_desc']);?></td>
                            <td><?php echo $row['materialcategory_seqno'];?></td>
                            <td><?php if($row['materialcategory_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'mcategory.php?action=edit&materialcategory_id=<?php echo $row['materialcategory_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('mcategory.php?action=delete&materialcategory_id=<?php echo $row['materialcategory_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Material Category Code</th>
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
        $('#mcategory_table').DataTable({
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
    public function validateMcategory($mcategory_code,$materialcategory_id){
        if($mcategory_code != ""){
            if($materialcategory_id > 0){
                $wherestring = " AND materialcategory_id != '$materialcategory_id'";
            }
            $sql = "SELECT COUNT(*) as total FROM mcategory WHERE mcategory_code = '$mcategory_code' $wherestring";
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
}
?>
