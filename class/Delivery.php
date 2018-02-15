<?php
/*
 * To change this tdeliveryate, choose Tools | Tdeliveryates
 * and open the tdeliveryate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Delivery {

    public function Delivery(){
        global $connection;
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        $this->db_conn = $connection;

    }
    public function create(){
        $table_field = array('delivery_code','delivery_desc','delivery_seqno','delivery_status');
        $table_value = array($this->delivery_code,$this->delivery_desc,$this->delivery_seqno,$this->delivery_status);
        $remark = "Insert Delivery.";
        if(!$this->save->SaveData($table_field,$table_value,'db_delivery','delivery_id',$remark)){
           return false;
        }else{
           $this->delivery_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('delivery_code','delivery_desc','delivery_seqno','delivery_status');
        $table_value = array($this->delivery_code,$this->delivery_desc,$this->delivery_seqno,$this->delivery_status);
        
        $remark = "Update Delivery.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_delivery','delivery_id',$remark,$this->delivery_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchDeliveryDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_delivery WHERE delivery_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);
            $this->delivery_id = $row['delivery_id'];
            $this->delivery_code = $row['delivery_code'];
            $this->delivery_desc = $row['delivery_desc'];
            $this->delivery_seqno = $row['delivery_seqno'];
            $this->delivery_status = $row['delivery_status'];
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_delivery"," WHERE delivery_id = '$this->delivery_id'","Delete Delivery.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->delivery_seqno = 10;
            $this->delivery_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Delivery Management</title>
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
            <h1>Delivery Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->delivery_id > 0){ echo "Update Delivery";}else{ echo "Create New Delivery";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='delivery.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='delivery.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'delivery_form' class="form-horizontal" action = 'delivery.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="delivery_code" class="col-sm-2 control-label">Delivery Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="delivery_code" name="delivery_code" placeholder="Deliveryet Code" value = "<?php echo $this->delivery_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="delivery_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="delivery_seqno" name="delivery_seqno" value = "<?php echo $this->delivery_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="delivery_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="delivery_status" name="delivery_status">
                             <option value = '1' <?php if($this->delivery_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->delivery_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="delivery_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="delivery_desc" name="delivery_desc" placeholder="Remark"><?php echo $this->delivery_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->delivery_id;?>" name = "delivery_id"/>
                    <?php 
                    if($this->delivery_id > 0){
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
        $("#delivery_form").validate({
                  rules: 
                  {
                      delivery_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      delivery_code:
                      {
                          required: "Please enter Delivery Code."
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
    <title>Delivery Management</title>
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
            <h1>Delivery Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Delivery Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='delivery.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="delivery_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Delivery Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th> 
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT delivery.*
                              FROM db_delivery delivery 
                              WHERE delivery.delivery_id > 0 ORDER BY delivery.delivery_seqno,delivery.delivery_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['delivery_code'];?></td>
                            <td><?php echo nl2br($row['delivery_desc']);?></td>
                            <td><?php echo $row['delivery_seqno'];?></td>
                            <td><?php if($row['delivery_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'delivery.php?action=edit&delivery_id=<?php echo $row['delivery_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('delivery.php?action=delete&delivery_id=<?php echo $row['delivery_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Delivery Code</th>
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
        $('#delivery_table').DataTable({
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

}
?>
