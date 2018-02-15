<?php
/*
 * To change this tshiptermate, choose Tools | Tshiptermates
 * and open the tshiptermate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Shipterm {

    public function Shipterm(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('shipterm_code','shipterm_desc','shipterm_seqno','shipterm_status');
        $table_value = array($this->shipterm_code,$this->shipterm_desc,$this->shipterm_seqno,$this->shipterm_status);
        $remark = "Insert Shipping Term.";
        if(!$this->save->SaveData($table_field,$table_value,'db_shipterm','shipterm_id',$remark)){
           return false;
        }else{
           $this->shipterm_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('shipterm_code','shipterm_desc','shipterm_seqno','shipterm_status');
        $table_value = array($this->shipterm_code,$this->shipterm_desc,$this->shipterm_seqno,$this->shipterm_status);
        
        $remark = "Update Shipping Term.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_shipterm','shipterm_id',$remark,$this->shipterm_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchShiptermDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_shipterm WHERE shipterm_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->shipterm_id = $row['shipterm_id'];
            $this->shipterm_code = $row['shipterm_code'];
            $this->shipterm_desc = $row['shipterm_desc'];
            $this->shipterm_seqno = $row['shipterm_seqno'];
            $this->shipterm_status = $row['shipterm_status'];
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_shipterm"," WHERE shipterm_id = '$this->shipterm_id'","Delete Shipping Term.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->shipterm_seqno = 10;
            $this->shipterm_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shipping Term Management</title>
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
            <h1>Shipping Term Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->currency_id > 0){ echo "Update Shipping Term";}else{ echo "Create New Shipping Term";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='shipterm.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='shipterm.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'shipterm_form' class="form-horizontal" action = 'shipterm.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="shipterm_code" class="col-sm-2 control-label">Shipping Term Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="shipterm_code" name="shipterm_code" placeholder="Shiptermet Code" value = "<?php echo $this->shipterm_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="shipterm_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="shipterm_seqno" name="shipterm_seqno" value = "<?php echo $this->shipterm_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="shipterm_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="shipterm_status" name="shipterm_status">
                             <option value = '1' <?php if($this->shipterm_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->shipterm_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="shipterm_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="shipterm_desc" name="shipterm_desc" placeholder="Remark"><?php echo $this->shipterm_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->shipterm_id;?>" name = "shipterm_id"/>
                    <?php 
                    if($this->shipterm_id > 0){
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
        $("#shipterm_form").validate({
                  rules: 
                  {
                      shipterm_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      shipterm_code:
                      {
                          required: "Please enter Shipping Term Code."
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
    <title>Shipping Term Management</title>
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
            <h1>Shipping Term Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Shipping Term Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='shipterm.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="shipterm_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Shipping Term Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT shipterm.*
                              FROM db_shipterm shipterm 
                              WHERE shipterm.shipterm_id > 0 ORDER BY shipterm.shipterm_seqno,shipterm.shipterm_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['shipterm_code'];?></td>
                            <td><?php echo nl2br($row['shipterm_desc']);?></td>
                            <td><?php echo $row['shipterm_seqno'];?></td>
                            <td><?php if($row['shipterm_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'shipterm.php?action=edit&shipterm_id=<?php echo $row['shipterm_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('shipterm.php?action=delete&shipterm_id=<?php echo $row['shipterm_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Shipping Term Code</th>
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
        $('#shipterm_table').DataTable({
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
