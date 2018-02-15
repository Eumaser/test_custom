<?php
/*
 * To change this tproducttypeate, choose Tools | Tproducttypeates
 * and open the tproducttypeate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Producttype {

    public function Producttype(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('producttype_code','producttype_desc','producttype_seqno','producttype_status');
        $table_value = array($this->producttype_code,$this->producttype_desc,$this->producttype_seqno,$this->producttype_status);
        $remark = "Insert Product Type.";
        if(!$this->save->SaveData($table_field,$table_value,'db_producttype','producttype_id',$remark)){
           return false;
        }else{
           $this->producttype_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('producttype_code','producttype_desc','producttype_seqno','producttype_status');
        $table_value = array($this->producttype_code,$this->producttype_desc,$this->producttype_seqno,$this->producttype_status);
        
        $remark = "Update Product Type.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_producttype','producttype_id',$remark,$this->producttype_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchProducttypeDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_producttype WHERE producttype_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->producttype_id = $row['producttype_id'];
            $this->producttype_code = $row['producttype_code'];
            $this->producttype_desc = $row['producttype_desc'];
            $this->producttype_seqno = $row['producttype_seqno'];
            $this->producttype_status = $row['producttype_status'];
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_producttype"," WHERE producttype_id = '$this->producttype_id'","Delete Product Type.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->producttype_seqno = 10;
            $this->producttype_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product Type Management</title>
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
            <h1>Product Type Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->producttype_id > 0){ echo "Update Product Type";}else{ echo "Create New Product Type";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='producttype.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='producttype.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'producttype_form' class="form-horizontal" action = 'producttype.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="producttype_code" class="col-sm-2 control-label">Product Type Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="producttype_code" name="producttype_code" placeholder="Producttypeet Code" value = "<?php echo $this->producttype_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="producttype_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="producttype_seqno" name="producttype_seqno" value = "<?php echo $this->producttype_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="producttype_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="producttype_status" name="producttype_status">
                             <option value = '1' <?php if($this->producttype_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->producttype_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="producttype_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="producttype_desc" name="producttype_desc" placeholder="Remark"><?php echo $this->producttype_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->producttype_id;?>" name = "producttype_id"/>
                    <?php 
                    if($this->producttype_id > 0){
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
        $("#producttype_form").validate({
                  rules: 
                  {
                      producttype_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      producttype_code:
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
    <title>Product Type Management</title>
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
            <h1>Product Type Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Product Type Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='producttype.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="producttype_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Product Type Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT producttype.*
                              FROM db_producttype producttype 
                              WHERE producttype.producttype_id > 0 ORDER BY producttype_seqno,producttype_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['producttype_code'];?></td>
                            <td><?php echo nl2br($row['producttype_desc']);?></td>
                            <td><?php echo $row['producttype_seqno'];?></td>
                            <td><?php if($row['producttype_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'producttype.php?action=edit&producttype_id=<?php echo $row['producttype_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('producttype.php?action=delete&producttype_id=<?php echo $row['producttype_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Product Type Code</th>
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
        $('#producttype_table').DataTable({
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
