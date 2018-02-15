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
class Transittime {

    public function Transittime(){
        global $connection;
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        $this->db_conn = $connection;

    }
    public function create(){
        $table_field = array('transittime_code','transittime_desc','transittime_seqno','transittime_status');
        $table_value = array($this->transittime_code,$this->transittime_desc,$this->transittime_seqno,$this->transittime_status);
        $remark = "Insert Transit Time.";
        if(!$this->save->SaveData($table_field,$table_value,'db_transittime','transittime_id',$remark)){
           return false;
        }else{
           $this->transittime_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('transittime_code','transittime_desc','transittime_seqno','transittime_status');
        $table_value = array($this->transittime_code,$this->transittime_desc,$this->transittime_seqno,$this->transittime_status);
        
        $remark = "Update Transit Time.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_transittime','transittime_id',$remark,$this->transittime_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchTransittimeDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_transittime WHERE transittime_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);
            $this->transittime_id = $row['transittime_id'];
            $this->transittime_code = $row['transittime_code'];
            $this->transittime_desc = $row['transittime_desc'];
            $this->transittime_seqno = $row['transittime_seqno'];
            $this->transittime_status = $row['transittime_status'];
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_transittime"," WHERE transittime_id = '$this->transittime_id'","Delete Transit Time.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->transittime_seqno = 10;
            $this->transittime_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transit Time Management</title>
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
            <h1>Transit Time Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->currency_id > 0){ echo "Update Transit Time";}else{ echo "Create New Transit Time";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='transittime.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='transittime.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'transittime_form' class="form-horizontal" action = 'transittime.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="transittime_code" class="col-sm-2 control-label">Transit Time Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="transittime_code" name="transittime_code" placeholder="Transit Time Code" value = "<?php echo $this->transittime_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="transittime_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="transittime_seqno" name="transittime_seqno" value = "<?php echo $this->transittime_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="transittime_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="transittime_status" name="transittime_status">
                             <option value = '1' <?php if($this->transittime_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->transittime_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="transittime_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="transittime_desc" name="transittime_desc" placeholder="Remark"><?php echo $this->transittime_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->transittime_id;?>" name = "transittime_id"/>
                    <?php 
                    if($this->transittime_id > 0){
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
        $("#transittime_form").validate({
                  rules: 
                  {
                      transittime_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      transittime_code:
                      {
                          required: "Please enter Transit Time Code."
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
    <title>Transit Time Management</title>
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
            <h1>Transit Time Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Transit Time Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='transittime.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="transittime_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Transit Time Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT transittime.*
                              FROM db_transittime transittime 
                              WHERE transittime.transittime_id > 0 ORDER BY transittime.transittime_seqno, transittime.transittime_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['transittime_code'];?></td>
                            <td><?php echo nl2br($row['transittime_desc']);?></td>
                            <td><?php echo $row['transittime_seqno'];?></td>
                            <td><?php if($row['transittime_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'transittime.php?action=edit&transittime_id=<?php echo $row['transittime_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('transittime.php?action=delete&transittime_id=<?php echo $row['transittime_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Transit Time Code</th>
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
        $('#transittime_table').DataTable({
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
