<?php
/*
 * To change this tvalidityate, choose Tools | Tvalidityates
 * and open the tvalidityate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Validity {

    public function Validity(){
        global $connection;
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        $this->db_conn = $connection;

    }
    public function create(){
        $table_field = array('validity_code','validity_desc','validity_seqno','validity_status');
        $table_value = array($this->validity_code,$this->validity_desc,$this->validity_seqno,$this->validity_status);
        $remark = "Insert Validity.";
        if(!$this->save->SaveData($table_field,$table_value,'db_validity','validity_id',$remark)){
           return false;
        }else{
           $this->validity_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('validity_code','validity_desc','validity_seqno','validity_status');
        $table_value = array($this->validity_code,$this->validity_desc,$this->validity_seqno,$this->validity_status);
        
        $remark = "Update Validity.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_validity','validity_id',$remark,$this->validity_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchValidityDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_validity WHERE validity_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);
            $this->validity_id = $row['validity_id'];
            $this->validity_code = $row['validity_code'];
            $this->validity_desc = $row['validity_desc'];
            $this->validity_seqno = $row['validity_seqno'];
            $this->validity_status = $row['validity_status'];
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_validity"," WHERE validity_id = '$this->validity_id'","Delete Validity.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->validity_seqno = 10;
            $this->validity_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Validity Management</title>
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
            <h1>Validity Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->currency_id > 0){ echo "Update Validity";}else{ echo "Create New Validity";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='validity.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='validity.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'validity_form' class="form-horizontal" action = 'validity.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="validity_code" class="col-sm-2 control-label">Validity </label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="validity_code" name="validity_code" placeholder="Validity" value = "<?php echo $this->validity_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="validity_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="validity_seqno" name="validity_seqno" value = "<?php echo $this->validity_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="validity_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="validity_status" name="validity_status">
                             <option value = '1' <?php if($this->validity_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->validity_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="validity_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="validity_desc" name="validity_desc" placeholder="Remark"><?php echo $this->validity_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->validity_id;?>" name = "validity_id"/>
                    <?php 
                    if($this->validity_id > 0){
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
        $("#validity_form").validate({
                  rules: 
                  {
                      validity_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      validity_code:
                      {
                          required: "Please enter Validity."
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
    <title>Validity Management</title>
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
            <h1>Validity Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Validity Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='validity.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="validity_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Validity </th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT validity.*
                              FROM db_validity validity 
                              WHERE validity.validity_id > 0 ORDER BY validity.validity_seqno,validity.validity_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['validity_code'];?></td>
                            <td><?php echo nl2br($row['validity_desc']);?></td>
                            <td><?php echo $row['validity_seqno'];?></td>
                            <td><?php if($row['validity_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'validity.php?action=edit&validity_id=<?php echo $row['validity_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('validity.php?action=delete&validity_id=<?php echo $row['validity_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Validity </th>
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
        $('#validity_table').DataTable({
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
