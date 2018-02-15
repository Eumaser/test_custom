<?php
/*
 * To change this tbrandate, choose Tools | Tbrandates
 * and open the tbrandate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Brand {

    public function Brand(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('brand_code','brand_desc','brand_seqno','brand_status');
        $table_value = array($this->brand_code,$this->brand_desc,$this->brand_seqno,$this->brand_status);
        $remark = "Insert Brand.";
        if(!$this->save->SaveData($table_field,$table_value,'db_brand','brand_id',$remark)){
           return false;
        }else{
           $this->brand_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('brand_code','brand_desc','brand_seqno','brand_status');
        $table_value = array($this->brand_code,$this->brand_desc,$this->brand_seqno,$this->brand_status);
        
        $remark = "Update Brand.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_brand','brand_id',$remark,$this->brand_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchBrandDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_brand WHERE brand_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->brand_id = $row['brand_id'];
            $this->brand_code = $row['brand_code'];
            $this->brand_desc = $row['brand_desc'];
            $this->brand_seqno = $row['brand_seqno'];
            $this->brand_status = $row['brand_status'];
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_brand"," WHERE brand_id = '$this->brand_id'","Delete Brand.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->brand_seqno = 10;
            $this->brand_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Brand Management</title>
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
            <h1>Brand Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->brand_id > 0){ echo "Update Brand";}else{ echo "Create New Brand";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='brand.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='brand.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'brand_form' class="form-horizontal" action = 'brand.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="brand_code" class="col-sm-2 control-label">Brand Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="brand_code" name="brand_code" placeholder="Brandet Code" value = "<?php echo $this->brand_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="brand_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="brand_seqno" name="brand_seqno" value = "<?php echo $this->brand_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="brand_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="brand_status" name="brand_status">
                             <option value = '1' <?php if($this->brand_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->brand_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="brand_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="brand_desc" name="brand_desc" placeholder="Remark"><?php echo $this->brand_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->brand_id;?>" name = "brand_id"/>
                    <?php 
                    if($this->brand_id > 0){
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
        $("#brand_form").validate({
                  rules: 
                  {
                      brand_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      brand_code:
                      {
                          required: "Please enter Brand Code."
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
    <title>Brand Management</title>
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
            <h1>Brand Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Brand Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right"  onclick = "window.location.href='brand.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="brand_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Brand Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT brand.*
                              FROM db_brand brand 
                              WHERE brand.brand_id > 0 ORDER BY brand.brand_seqno,brand.brand_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['brand_code'];?></td>
                            <td><?php echo nl2br($row['brand_desc']);?></td>
                            <td><?php echo $row['brand_seqno'];?></td>
                            <td><?php if($row['brand_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'brand.php?action=edit&brand_id=<?php echo $row['brand_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('brand.php?action=delete&brand_id=<?php echo $row['brand_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Brand Code</th>
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
        $('#brand_table').DataTable({
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
