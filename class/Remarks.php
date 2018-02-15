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
class Remarks {

    public function Remarks(){
        global $connection;
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        $this->db_conn = $connection;

    }
    public function create(){
        $table_field = array('remarks_code','remarks_desc','remarks_seqno','remarks_status');
        $table_value = array($this->remarks_code,$this->remarks_desc,$this->remarks_seqno,$this->remarks_status);
        $remark = "Insert Remarks.";
        if(!$this->save->SaveData($table_field,$table_value,'db_remarks','remarks_id',$remark)){
           return false;
        }else{
           $this->remarks_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('remarks_code','remarks_desc','remarks_seqno','remarks_status');
        $table_value = array($this->remarks_code,$this->remarks_desc,$this->remarks_seqno,$this->remarks_status);
        
        $remark = "Update Remarks.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_remarks','remarks_id',$remark,$this->remarks_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchRemarksDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_remarks WHERE remarks_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);
            $this->remarks_id = $row['remarks_id'];
            $this->remarks_code = $row['remarks_code'];
            $this->remarks_desc = $row['remarks_desc'];
            $this->remarks_seqno = $row['remarks_seqno'];
            $this->remarks_status = $row['remarks_status'];
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_remarks"," WHERE remarks_id = '$this->remarks_id'","Delete Remarks.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->remarks_seqno = 10;
            $this->remarks_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Remarks Management</title>
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
            <h1>Remarks Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->currency_id > 0){ echo "Update Remarks";}else{ echo "Create New Remarks";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='remarks.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='remarks.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'remarks_form' class="form-horizontal" action = 'remarks.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="remarks_code" class="col-sm-2 control-label">Remarks Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="remarks_code" name="remarks_code" placeholder="Remarks Code" value = "<?php echo $this->remarks_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="remarks_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="remarks_seqno" name="remarks_seqno" value = "<?php echo $this->remarks_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="remarks_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="remarks_status" name="remarks_status">
                             <option value = '1' <?php if($this->remarks_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->remarks_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="remarks_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="remarks_desc" name="remarks_desc" placeholder="Remark"><?php echo $this->remarks_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->remarks_id;?>" name = "remarks_id"/>
                    <?php 
                    if($this->remarks_id > 0){
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
        $("#remarks_form").validate({
                  rules: 
                  {
                      remarks_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      remarks_code:
                      {
                          required: "Please enter Remarks Code."
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
    <title>Remarks Management</title>
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
            <h1>Remarks Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Remarks Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='remarks.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="remarks_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Remarks Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT remarks.*
                              FROM db_remarks remarks 
                              WHERE remarks.remarks_id > 0 ORDER BY remarks.remarks_seqno, remarks.remarks_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['remarks_code'];?></td>
                            <td><?php echo nl2br($row['remarks_desc']);?></td>
                            <td><?php echo $row['remarks_seqno'];?></td>
                            <td><?php if($row['remarks_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'remarks.php?action=edit&remarks_id=<?php echo $row['remarks_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('remarks.php?action=delete&remarks_id=<?php echo $row['remarks_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Remarks Code</th>
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
        $('#remarks_table').DataTable({
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
