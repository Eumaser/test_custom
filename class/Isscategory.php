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
class Isscategory {

    public function Isscategory(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('isscategory_code','isscategory_desc','isscategory_seqno','isscategory_status',
                             'issparent_id');
        $table_value = array($this->isscategory_code,$this->isscategory_desc,$this->isscategory_seqno,$this->isscategory_status,
                             $this->issparent_id);
        $remark = "Insert Isscategory.";
        if(!$this->save->SaveData($table_field,$table_value,'db_isscategory','isscategory_id',$remark)){
           return false;
        }else{
           $this->isscategory_id = $this->save->lastInsert_id; 
           return true;
        }
    }
    public function update(){
        $table_field = array('isscategory_code','isscategory_desc','isscategory_seqno','isscategory_status',
                             'issparent_id');
        $table_value = array($this->isscategory_code,$this->isscategory_desc,$this->isscategory_seqno,$this->isscategory_status,
                             $this->issparent_id);
        $remark = "Update Isscategory.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_isscategory','isscategory_id',$remark,$this->isscategory_id)){
           return false;
        }else{
           return true;
        }
    }
    public function delete(){
        if($this->save->DeleteData("db_isscategory"," WHERE isscategory_id = '$this->isscategory_id'","Delete Isscategory.")){
            return true;
        }else{
            return false;
        }
    }
    public function fetchIsscategoryDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT c.*
                FROM db_isscategory c
                WHERE c.isscategory_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->isscategory_id = $row['isscategory_id'];
            $this->isscategory_code = $row['isscategory_code'];
            $this->isscategory_desc = $row['isscategory_desc'];
            $this->isscategory_seqno = $row['isscategory_seqno'];
            $this->isscategory_status = $row['isscategory_status'];
            $this->issparent_id = $row['issparent_id'];
        }
        return $query;
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->isscategory_seqno = 10;
            $this->isscategory_status = 1;
        }
        $this->materialCategoryCrtl = $this->select->getItemSubCategorySelectCtrl($this->issparent_id,'Y');
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Item Sub Sub-Category Management</title>
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
            <h1>Item Sub Sub-Category Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->isscategory_id > 0){ echo "Update Item Sub-Category";}else{ echo "Create New Item Sub-Category";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='isscategory.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='isscategory.php?action=createForm'">Create New</button>
                <?php }?>
              </div>

                <form id = 'isscategory_form' class="form-horizontal" action = 'isscategory.php?action=create' method = "POST">
                  <div class="box-body">
<!--                        <div class="form-group">
                          <label for="issparent_id" class="col-sm-2 control-label">Parent Category</label>
                          <div class="col-sm-3">
                               <select class="form-control select2" id="issparent_id" name="issparent_id" <?php echo $disabled;?>>
                                   <?php echo $this->materialCategoryCrtl;?>
                               </select>
                          </div>
                        </div> -->
                        <div class="form-group">
                          <label for="isscategory_code" class="col-sm-2 control-label">Item Sub Sub-Category Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="isscategory_code" name="isscategory_code" placeholder="Item Sub-Category Code" value = "<?php echo $this->isscategory_code;?>" >
                          </div>
                        </div>  
                    <div class="form-group">
                      <label for="isscategory_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="isscategory_seqno" name="isscategory_seqno" value = "<?php echo $this->isscategory_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="isscategory_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="isscategory_status" name="isscategory_status">
                             <option value = '1' <?php if($this->isscategory_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->isscategory_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="isscategory_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="isscategory_desc" name="isscategory_desc" placeholder="Remark"><?php echo $this->isscategory_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->isscategory_id;?>" name = "isscategory_id"/>
                    <?php 
                    if($this->isscategory_id > 0){
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
        $("#isscategory_form").validate({
                  rules: 
                  {
                      isscategory_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      isscategory_code:
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
    <title>Item Sub Sub-Category Management</title>
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
            <h1>Item Sub Sub-Category Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Item Sub Sub-Category Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='isscategory.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="isscategory_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <!--<th style = 'width:25%'>Parent Category Code</th>-->
                        <th style = 'width:15%'>Sub-Category Code</th>
                        <th style = 'width:20%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT mss.*,CONCAT(mc.category_code,' - ',ms.iscategory_code) as parent_code
                              FROM db_isscategory mss 
                              LEFT JOIN db_iscategory ms ON ms.iscategory_id = mss.issparent_id 
                              LEFT JOIN db_category mc ON mc.category_id = ms.isparent_id
                              WHERE mss.isscategory_id > 0 ORDER BY mc.category_code ASC";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php // echo $row['parent_code'];?></td>
                            <td><?php echo $row['isscategory_code'];?></td>
                            <td><?php echo nl2br($row['isscategory_desc']);?></td>
                            <td><?php echo $row['isscategory_seqno'];?></td>
                            <td><?php if($row['isscategory_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'isscategory.php?action=edit&isscategory_id=<?php echo $row['isscategory_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('isscategory.php?action=delete&isscategory_id=<?php echo $row['isscategory_id'];?>','Confirm Delete?')">Delete</button>
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
                        <!--<th style = 'width:25%'>Parent Category Code</th>-->
                        <th style = 'width:15%'>Sub-Category Code</th>
                        <th style = 'width:20%'>Remark</th>
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
        $('#isscategory_table').DataTable({
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
    public function validateIsscategory($isscategory_code,$isscategory_id){
        if($isscategory_code != ""){
            if($isscategory_id > 0){
                $wherestring = " AND isscategory_id != '$isscategory_id'";
            }
            $sql = "SELECT COUNT(*) as total FROM isscategory WHERE isscategory_code = '$isscategory_code' $wherestring";
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
