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
class Mscategory {

    public function Mscategory(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('mscategory_code','mscategory_desc','mscategory_seqno','mscategory_status',
                             'msparent_id');
        $table_value = array($this->mscategory_code,$this->mscategory_desc,$this->mscategory_seqno,$this->mscategory_status,
                             $this->msparent_id);
        $remark = "Insert Mscategory.";
        if(!$this->save->SaveData($table_field,$table_value,'db_mscategory','mscategory_id',$remark)){
           return false;
        }else{
           $this->mscategory_id = $this->save->lastInsert_id; 
           return true;
        }
    }
    public function update(){
        $table_field = array('mscategory_code','mscategory_desc','mscategory_seqno','mscategory_status',
                             'msparent_id');
        $table_value = array($this->mscategory_code,$this->mscategory_desc,$this->mscategory_seqno,$this->mscategory_status,
                             $this->msparent_id);
        $remark = "Update Mscategory.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_mscategory','mscategory_id',$remark,$this->mscategory_id)){
           return false;
        }else{
           return true;
        }
    }
    public function delete(){
        if($this->save->DeleteData("db_mscategory"," WHERE mscategory_id = '$this->mscategory_id'","Delete Mscategory.")){
            return true;
        }else{
            return false;
        }
    }
    public function fetchMscategoryDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT c.*
                FROM db_mscategory c
                WHERE c.mscategory_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->mscategory_id = $row['mscategory_id'];
            $this->mscategory_code = $row['mscategory_code'];
            $this->mscategory_desc = $row['mscategory_desc'];
            $this->mscategory_seqno = $row['mscategory_seqno'];
            $this->mscategory_status = $row['mscategory_status'];
            $this->msparent_id = $row['msparent_id'];
        }
        return $query;
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->mscategory_seqno = 10;
            $this->mscategory_status = 1;
        }
        $this->materialCategoryCrtl = $this->select->getMaterialCategorySelectCtrl($this->msparent_id,'Y');
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Material Sub-Category Management</title>
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
            <h1>Material Sub-Category Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->mscategory_id > 0){ echo "Update Material Sub-Category";}else{ echo "Create New Material Sub-Category";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='mscategory.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='mscategory.php?action=createForm'">Create New</button>
                <?php }?>
              </div>

                <form id = 'mscategory_form' class="form-horizontal" action = 'mscategory.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="msparent_id" class="col-sm-2 control-label">Parent Category</label>
                          <div class="col-sm-3">
                               <select class="form-control select2" id="msparent_id" name="msparent_id" <?php echo $disabled;?>>
                                   <?php echo $this->materialCategoryCrtl;?>
                               </select>
                          </div>
                        </div> 
                        <div class="form-group">
                          <label for="mscategory_code" class="col-sm-2 control-label">Material Sub-Category Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="mscategory_code" name="mscategory_code" placeholder="Material Sub-Category Code" value = "<?php echo $this->mscategory_code;?>" >
                          </div>
                        </div>  
                    <div class="form-group">
                      <label for="mscategory_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="mscategory_seqno" name="mscategory_seqno" value = "<?php echo $this->mscategory_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="mscategory_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="mscategory_status" name="mscategory_status">
                             <option value = '1' <?php if($this->mscategory_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->mscategory_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="mscategory_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="mscategory_desc" name="mscategory_desc" placeholder="Remark"><?php echo $this->mscategory_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->mscategory_id;?>" name = "mscategory_id"/>
                    <?php 
                    if($this->mscategory_id > 0){
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
        $("#mscategory_form").validate({
                  rules: 
                  {
                      mscategory_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      mscategory_code:
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
    <title>Material Sub-Category Management</title>
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
            <h1>Material Sub-Category Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Material Sub-Category Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='mscategory.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="mscategory_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Parent Category Code</th>
                        <th style = 'width:15%'>Sub-Category Code</th>
                        <th style = 'width:30%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT mscategory.*,mc.materialcategory_code
                              FROM db_mscategory mscategory 
                              LEFT JOIN db_materialcategory mc ON mc.materialcategory_id = mscategory.msparent_id
                              WHERE mscategory.mscategory_id > 0 ORDER BY mc.materialcategory_code,mscategory_seqno,mscategory_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['materialcategory_code'];?></td>
                            <td><?php echo $row['mscategory_code'];?></td>
                            <td><?php echo nl2br($row['mscategory_desc']);?></td>
                            <td><?php echo $row['mscategory_seqno'];?></td>
                            <td><?php if($row['mscategory_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'mscategory.php?action=edit&mscategory_id=<?php echo $row['mscategory_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('mscategory.php?action=delete&mscategory_id=<?php echo $row['mscategory_id'];?>','Confirm Delete?')">Delete</button>
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
        $('#mscategory_table').DataTable({
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
    public function validateMscategory($mscategory_code,$mscategory_id){
        if($mscategory_code != ""){
            if($mscategory_id > 0){
                $wherestring = " AND mscategory_id != '$mscategory_id'";
            }
            $sql = "SELECT COUNT(*) as total FROM mscategory WHERE mscategory_code = '$mscategory_code' $wherestring";
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
