<?php
/*
 * To change this tpriceate, choose Tools | Tpriceates
 * and open the tpriceate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Pointofdelivery {

    public function Pointofdelivery(){
        global $connection;
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        $this->db_conn = $connection;

    }
    public function create(){
        $table_field = array('pointofdelivery_code','pointofdelivery_desc','pointofdelivery_seqno','pointofdelivery_status');
        $table_value = array($this->pointofdelivery_code,$this->pointofdelivery_desc,$this->pointofdelivery_seqno,$this->pointofdelivery_status);
        $remark = "Insert Point of Delivery.";
        if(!$this->save->SaveData($table_field,$table_value,'db_pointofdelivery','pointofdelivery_id',$remark)){
           return false;
        }else{
           $this->pointofdelivery_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('pointofdelivery_code','pointofdelivery_desc','pointofdelivery_seqno','pointofdelivery_status');
        $table_value = array($this->pointofdelivery_code,$this->pointofdelivery_desc,$this->pointofdelivery_seqno,$this->pointofdelivery_status);
        
        $remark = "Update Point of Delivery.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_pointofdelivery','pointofdelivery_id',$remark,$this->pointofdelivery_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchPointofdeliveryDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_pointofdelivery WHERE pointofdelivery_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);
            $this->pointofdelivery_id = $row['pointofdelivery_id'];
            $this->pointofdelivery_code = $row['pointofdelivery_code'];
            $this->pointofdelivery_desc = $row['pointofdelivery_desc'];
            $this->pointofdelivery_seqno = $row['pointofdelivery_seqno'];
            $this->pointofdelivery_status = $row['pointofdelivery_status'];
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_pointofdelivery"," WHERE pointofdelivery_id = '$this->pointofdelivery_id'","Delete Point of Delivery.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->pointofdelivery_seqno = 10;
            $this->pointofdelivery_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Point of Delivery Management</title>
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
            <h1>Point of Delivery Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->currency_id > 0){ echo "Update Point of Delivery";}else{ echo "Create New Point of Delivery";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='pointofdelivery.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='pointofdelivery.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'pointofdelivery_form' class="form-horizontal" action = 'pointofdelivery.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="pointofdelivery_code" class="col-sm-2 control-label">Point of Delivery Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="pointofdelivery_code" name="pointofdelivery_code" placeholder="Point of Delivery Code" value = "<?php echo $this->pointofdelivery_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="pointofdelivery_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="pointofdelivery_seqno" name="pointofdelivery_seqno" value = "<?php echo $this->pointofdelivery_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="pointofdelivery_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="pointofdelivery_status" name="pointofdelivery_status">
                             <option value = '1' <?php if($this->pointofdelivery_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->pointofdelivery_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="pointofdelivery_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="pointofdelivery_desc" name="pointofdelivery_desc" placeholder="Remark"><?php echo $this->pointofdelivery_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->pointofdelivery_id;?>" name = "pointofdelivery_id"/>
                    <?php 
                    if($this->pointofdelivery_id > 0){
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
        $("#pointofdelivery_form").validate({
                  rules: 
                  {
                      pointofdelivery_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      pointofdelivery_code:
                      {
                          required: "Please enter Point of Delivery Code."
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
    <title>Point of Delivery Management</title>
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
            <h1>Point of Delivery Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Point of Delivery Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='pointofdelivery.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="pointofdelivery_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Point of Delivery Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT pointofdelivery.*
                              FROM db_pointofdelivery pointofdelivery 
                              WHERE pointofdelivery.pointofdelivery_id > 0 ORDER BY pointofdelivery.pointofdelivery_seqno, pointofdelivery.pointofdelivery_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['pointofdelivery_code'];?></td>
                            <td><?php echo nl2br($row['pointofdelivery_desc']);?></td>
                            <td><?php echo $row['pointofdelivery_seqno'];?></td>
                            <td><?php if($row['pointofdelivery_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'pointofdelivery.php?action=edit&pointofdelivery_id=<?php echo $row['pointofdelivery_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('pointofdelivery.php?action=delete&pointofdelivery_id=<?php echo $row['pointofdelivery_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Point of Delivery Code</th>
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
        $('#pointofdelivery_table').DataTable({
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
