<?php
/*
 * To change this tcategoryate, choose Tools | Tcategoryates
 * and open the tcategoryate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Category {

    public function Category(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('category_code','category_desc','category_seqno','category_status');
        $table_value = array($this->category_code,$this->category_desc,$this->category_seqno,$this->category_status);
        $remark = "Insert Category.";
        if(!$this->save->SaveData($table_field,$table_value,'db_category','category_id',$remark)){
           return false;
        }else{
           $this->category_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('category_code','category_desc','category_seqno','category_status');
        $table_value = array($this->category_code,$this->category_desc,$this->category_seqno,$this->category_status);
        
        $remark = "Update Category.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_category','category_id',$remark,$this->category_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchCategoryDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_category WHERE category_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->category_id = $row['category_id'];
            $this->category_code = $row['category_code'];
            $this->category_desc = $row['category_desc'];
            $this->category_seqno = $row['category_seqno'];
            $this->category_status = $row['category_status'];
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_category"," WHERE category_id = '$this->category_id'","Delete Category.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->category_seqno = 10;
            $this->category_status = 1;
        }

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
      <div class="content-wrapper">
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Category Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->category_id > 0){ echo "Update Category";}else{ echo "Create New Category";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='category.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='category.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'category_form' class="form-horizontal" action = 'category.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="category_code" class="col-sm-2 control-label">Category Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="category_code" name="category_code" placeholder="Categoryet Code" value = "<?php echo $this->category_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="category_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="category_seqno" name="category_seqno" value = "<?php echo $this->category_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="category_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="category_status" name="category_status">
                             <option value = '1' <?php if($this->category_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->category_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="category_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="category_desc" name="category_desc" placeholder="Remark"><?php echo $this->category_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->category_id;?>" name = "category_id"/>
                    <?php 
                    if($this->category_id > 0){
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
        $("#category_form").validate({
                  rules: 
                  {
                      category_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      category_code:
                      {
                          required: "Please enter Category Code."
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
            <h1>Category Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Category Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right"  onclick = "window.location.href='category.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="category_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Category Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT category.*
                              FROM db_category category 
                              WHERE category.category_id > 0 ORDER BY category.category_seqno,category.category_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['category_code'];?></td>
                            <td><?php echo nl2br($row['category_desc']);?></td>
                            <td><?php echo $row['category_seqno'];?></td>
                            <td><?php if($row['category_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'category.php?action=edit&category_id=<?php echo $row['category_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('category.php?action=delete&category_id=<?php echo $row['category_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Category Code</th>
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

}
?>
