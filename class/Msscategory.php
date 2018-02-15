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
class Msscategory {

    public function Msscategory(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('msscategory_code','msscategory_desc','msscategory_seqno','msscategory_status',
                             'mssparent_id');
        $table_value = array($this->msscategory_code,$this->msscategory_desc,$this->msscategory_seqno,$this->msscategory_status,
                             $this->mssparent_id);
        $remark = "Insert Msscategory.";
        if(!$this->save->SaveData($table_field,$table_value,'db_msscategory','msscategory_id',$remark)){
           return false;
        }else{
           $this->msscategory_id = $this->save->lastInsert_id; 
           return true;
        }
    }
    public function update(){
        $table_field = array('msscategory_code','msscategory_desc','msscategory_seqno','msscategory_status',
                             'mssparent_id');
        $table_value = array($this->msscategory_code,$this->msscategory_desc,$this->msscategory_seqno,$this->msscategory_status,
                             $this->mssparent_id);
        $remark = "Update Msscategory.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_msscategory','msscategory_id',$remark,$this->msscategory_id)){
           return false;
        }else{
           return true;
        }
    }
    public function delete(){
        if($this->save->DeleteData("db_msscategory"," WHERE msscategory_id = '$this->msscategory_id'","Delete Msscategory.")){
            return true;
        }else{
            return false;
        }
    }
    public function fetchMsscategoryDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT c.*
                FROM db_msscategory c
                WHERE c.msscategory_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->msscategory_id = $row['msscategory_id'];
            $this->msscategory_code = $row['msscategory_code'];
            $this->msscategory_desc = $row['msscategory_desc'];
            $this->msscategory_seqno = $row['msscategory_seqno'];
            $this->msscategory_status = $row['msscategory_status'];
            $this->mssparent_id = $row['mssparent_id'];
        }
        return $query;
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->msscategory_seqno = 10;
            $this->msscategory_status = 1;
        }
        $this->materialCategoryCrtl = $this->select->getMaterialSubCategorySelectCtrl($this->mssparent_id,'Y');
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Material Sub Sub-Category Management</title>
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
            <h1>Material Sub Sub-Category Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->msscategory_id > 0){ echo "Update Material Sub-Category";}else{ echo "Create New Material Sub-Category";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='msscategory.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='msscategory.php?action=createForm'">Create New</button>
                <?php }?>
              </div>

                <form id = 'msscategory_form' class="form-horizontal" action = 'msscategory.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="mssparent_id" class="col-sm-2 control-label">Parent Category</label>
                          <div class="col-sm-3">
                               <select class="form-control select2" id="mssparent_id" name="mssparent_id" <?php echo $disabled;?>>
                                   <?php echo $this->materialCategoryCrtl;?>
                               </select>
                          </div>
                        </div> 
                        <div class="form-group">
                          <label for="msscategory_code" class="col-sm-2 control-label">Material Sub Sub-Category Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="msscategory_code" name="msscategory_code" placeholder="Material Sub-Category Code" value = "<?php echo $this->msscategory_code;?>" >
                          </div>
                        </div>  
                    <div class="form-group">
                      <label for="msscategory_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="msscategory_seqno" name="msscategory_seqno" value = "<?php echo $this->msscategory_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="msscategory_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="msscategory_status" name="msscategory_status">
                             <option value = '1' <?php if($this->msscategory_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->msscategory_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="msscategory_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="msscategory_desc" name="msscategory_desc" placeholder="Remark"><?php echo $this->msscategory_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->msscategory_id;?>" name = "msscategory_id"/>
                    <?php 
                    if($this->msscategory_id > 0){
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
        $("#msscategory_form").validate({
                  rules: 
                  {
                      msscategory_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      msscategory_code:
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
    <title>Material Sub Sub-Category Management</title>
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
            <h1>Material Sub Sub-Category Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Material Sub Sub-Category Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='msscategory.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="msscategory_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Parent Category Code</th>
                        <th style = 'width:15%'>Sub-Category Code</th>
                        <th style = 'width:30%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>`
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT mss.*,CONCAT(mc.materialcategory_code,' - ',ms.mscategory_code) as parent_code
                              FROM db_msscategory mss 
                              LEFT JOIN db_mscategory ms ON ms.mscategory_id = mss.mssparent_id 
                              LEFT JOIN db_materialcategory mc ON mc.materialcategory_id = ms.msparent_id
                              WHERE mss.msscategory_id > 0 ORDER BY mc.materialcategory_code ASC";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['parent_code'];?></td>
                            <td><?php echo $row['msscategory_code'];?></td>
                            <td><?php echo nl2br($row['msscategory_desc']);?></td>
                            <td><?php echo $row['msscategory_seqno'];?></td>
                            <td><?php if($row['msscategory_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'msscategory.php?action=edit&msscategory_id=<?php echo $row['msscategory_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('msscategory.php?action=delete&msscategory_id=<?php echo $row['msscategory_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Parent Category Code</th>
                        <th style = 'width:15%'>Sub-Category Code</th>
                        <th style = 'width:30%'>Remark</th>
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
        $('#msscategory_table').DataTable({
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
    public function validateMsscategory($msscategory_code,$msscategory_id){
        if($msscategory_code != ""){
            if($msscategory_id > 0){
                $wherestring = " AND msscategory_id != '$msscategory_id'";
            }
            $sql = "SELECT COUNT(*) as total FROM msscategory WHERE msscategory_code = '$msscategory_code' $wherestring";
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
