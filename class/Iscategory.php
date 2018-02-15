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
class Iscategory {

    public function Iscategory(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('iscategory_code','iscategory_desc','iscategory_seqno','iscategory_status',
                             'isparent_id');
        $table_value = array($this->iscategory_code,$this->iscategory_desc,$this->iscategory_seqno,$this->iscategory_status,
                             $this->isparent_id);
        $remark = "Insert Iscategory.";
        if(!$this->save->SaveData($table_field,$table_value,'db_iscategory','iscategory_id',$remark)){
           return false;
        }else{
           $this->iscategory_id = $this->save->lastInsert_id; 
           return true;
        }
    }
    public function update(){
        $table_field = array('iscategory_code','iscategory_desc','iscategory_seqno','iscategory_status',
                             'isparent_id');
        $table_value = array($this->iscategory_code,$this->iscategory_desc,$this->iscategory_seqno,$this->iscategory_status,
                             $this->isparent_id);
        $remark = "Update Iscategory.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_iscategory','iscategory_id',$remark,$this->iscategory_id)){
           return false;
        }else{
           return true;
        }
    }
    public function delete(){
        if($this->save->DeleteData("db_iscategory"," WHERE iscategory_id = '$this->iscategory_id'","Delete Iscategory.")){
            return true;
        }else{
            return false;
        }
    }
    public function fetchIscategoryDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT c.*
                FROM db_iscategory c
                WHERE c.iscategory_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->iscategory_id = $row['iscategory_id'];
            $this->iscategory_code = $row['iscategory_code'];
            $this->iscategory_desc = $row['iscategory_desc'];
            $this->iscategory_seqno = $row['iscategory_seqno'];
            $this->iscategory_status = $row['iscategory_status'];
            $this->isparent_id = $row['isparent_id'];
        }
        return $query;
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->iscategory_seqno = 10;
            $this->iscategory_status = 1;
        }
        $this->materialCategoryCrtl = $this->select->getItemCategorySelectCtrl($this->isparent_id,'Y');
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Item Sub-Category Management</title>
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
            <h1>Item Sub-Category Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->iscategory_id > 0){ echo "Update Item Sub-Category";}else{ echo "Create New Item Sub-Category";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='iscategory.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='iscategory.php?action=createForm'">Create New</button>
                <?php }?>
              </div>

                <form id = 'iscategory_form' class="form-horizontal" action = 'iscategory.php?action=create' method = "POST">
                  <div class="box-body">
<!--                        <div class="form-group">
                          <label for="isparent_id" class="col-sm-2 control-label">Parent Category</label>
                          <div class="col-sm-3">
                               <select class="form-control select2" id="isparent_id" name="isparent_id" <?php echo $disabled;?>>
                                   <?php echo $this->materialCategoryCrtl;?>
                               </select>
                          </div>
                        </div> -->
                        <div class="form-group">
                          <label for="iscategory_code" class="col-sm-2 control-label">Item Sub-Category Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="iscategory_code" name="iscategory_code" placeholder="Item Sub-Category Code" value = "<?php echo $this->iscategory_code;?>" >
                          </div>
                        </div>  
                    <div class="form-group">
                      <label for="iscategory_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="iscategory_seqno" name="iscategory_seqno" value = "<?php echo $this->iscategory_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="iscategory_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="iscategory_status" name="iscategory_status">
                             <option value = '1' <?php if($this->iscategory_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->iscategory_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="iscategory_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="iscategory_desc" name="iscategory_desc" placeholder="Remark"><?php echo $this->iscategory_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->iscategory_id;?>" name = "iscategory_id"/>
                    <?php 
                    if($this->iscategory_id > 0){
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
        $("#iscategory_form").validate({
                  rules: 
                  {
                      iscategory_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      iscategory_code:
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
    <title>Item Sub-Category Management</title>
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
            <h1>Item Sub-Category Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Item Sub-Category Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='iscategory.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="iscategory_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <!--<th style = 'width:15%'>Parent Category Code</th>-->
                        <th style = 'width:15%'>Sub-Category Code</th>
                        <th style = 'width:30%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT iscategory.*,c.category_code
                              FROM db_iscategory iscategory 
                              LEFT JOIN db_category c ON c.category_id = iscategory.isparent_id
                              WHERE iscategory.iscategory_id > 0 ORDER BY c.category_code,iscategory_seqno,iscategory_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <!--<td><?php echo $row['category_code'];?></td>-->
                            <td><?php echo $row['iscategory_code'];?></td>
                            <td><?php echo nl2br($row['iscategory_desc']);?></td>
                            <td><?php echo $row['iscategory_seqno'];?></td>
                            <td><?php if($row['iscategory_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'iscategory.php?action=edit&iscategory_id=<?php echo $row['iscategory_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('iscategory.php?action=delete&iscategory_id=<?php echo $row['iscategory_id'];?>','Confirm Delete?')">Delete</button>
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
                        <!--<th style = 'width:15%'>Parent Category Code</th>-->
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
        $('#iscategory_table').DataTable({
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
    public function validateIscategory($iscategory_code,$iscategory_id){
        if($iscategory_code != ""){
            if($iscategory_id > 0){
                $wherestring = " AND iscategory_id != '$iscategory_id'";
            }
            $sql = "SELECT COUNT(*) as total FROM iscategory WHERE iscategory_code = '$iscategory_code' $wherestring";
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
