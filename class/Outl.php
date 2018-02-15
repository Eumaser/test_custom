<?php
/*
 * To change this toutlate, choose Tools | Toutlates
 * and open the toutlate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Outl {

    public function Outl(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('outl_code','outl_desc','outl_seqno','outl_status');
        $table_value = array($this->outl_code,$this->outl_desc,$this->outl_seqno,$this->outl_status);
        $remark = "Insert Outlet.";
        if(!$this->save->SaveData($table_field,$table_value,'db_outl','outl_id',$remark)){
           return false;
        }else{
           $this->outl_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('outl_code','outl_desc','outl_seqno','outl_status');
        $table_value = array($this->outl_code,$this->outl_desc,$this->outl_seqno,$this->outl_status);
        
        $remark = "Update Outlet.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_outl','outl_id',$remark,$this->outl_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchOutlDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_outl WHERE outl_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->outl_id = $row['outl_id'];
            $this->outl_code = $row['outl_code'];
            $this->outl_desc = $row['outl_desc'];
            $this->outl_seqno = $row['outl_seqno'];
            $this->outl_status = $row['outl_status'];
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_outl"," WHERE outl_id = '$this->outl_id'","Delete Outlet.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->outl_seqno = 10;
            $this->outl_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Outlet Management</title>
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
            <h1>Outlet Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->outl_id > 0){ echo "Update Outlet";}else{ echo "Create New Outlet";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='outl.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='outl.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'outl_form' class="form-horizontal" action = 'outl.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="outl_code" class="col-sm-1 control-label">Outlet Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="outl_code" name="outl_code" placeholder="Outlet Code" value = "<?php echo $this->outl_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="outl_seqno" class="col-sm-1 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="outl_seqno" name="outl_seqno" value = "<?php echo $this->outl_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="outl_status" class="col-sm-1 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="outl_status" name="outl_status">
                             <option value = '1' <?php if($this->outl_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->outl_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="outl_desc" class="col-sm-1 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="outl_desc" name="outl_desc" placeholder="Remark"><?php echo $this->outl_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->outl_id;?>" name = "outl_id"/>
                    <?php 
                    if($this->outl_id > 0){
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
        $("#outl_form").validate({
                  rules: 
                  {
                      outl_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      outl_code:
                      {
                          required: "Please enter Outlet Code."
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
    <title>Outlet Management</title>
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
            <h1>Outlet Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Outlet Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='outl.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="outl_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Outlet Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT outl.*
                              FROM db_outl outl 
                              WHERE outl.outl_id > 0 ORDER BY outl.outl_seqno,outl.outl_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['outl_code'];?></td>
                            <td><?php echo nl2br($row['outl_desc']);?></td>
                            <td><?php echo $row['outl_seqno'];?></td>
                            <td><?php if($row['outl_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'outl.php?action=edit&outl_id=<?php echo $row['outl_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('outl.php?action=delete&outl_id=<?php echo $row['outl_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Outlet Code</th>
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
        $('#outl_table').DataTable({
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
