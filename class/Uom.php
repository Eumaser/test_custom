<?php
/*
 * To change this tuomate, choose Tools | Tuomates
 * and open the tuomate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Uom {

    public function Uom(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('uom_code','uom_desc','uom_seqno','uom_status');
		
        $table_value = array($this->uom_code,$this->uom_desc,$this->uom_seqno,$this->uom_status);
        $remark = "Insert Uom.";
        if(!$this->save->SaveData($table_field,$table_value,'db_uom','uom_id',$remark)){
           return false;
        }else{
           $this->uom_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('uom_code','uom_desc','uom_seqno','uom_status');
        $table_value = array($this->uom_code,$this->uom_desc,$this->uom_seqno,$this->uom_status);
        
        $remark = "Update Uom.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_uom','uom_id',$remark,$this->uom_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchUomDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_uom WHERE uom_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->uom_id = $row['uom_id'];
            $this->uom_code = $row['uom_code'];
            $this->uom_desc = $row['uom_desc'];
            $this->uom_seqno = $row['uom_seqno'];
            $this->uom_status = $row['uom_status'];
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_uom"," WHERE uom_id = '$this->uom_id'","Delete Uom.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->uom_seqno = 10;
            $this->uom_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Uom Management</title>
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
            <h1>Uom Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->uom_id > 0){ echo "Update Uom";}else{ echo "Create New Uom";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='uom.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='uom.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'uom_form' class="form-horizontal" action = 'uom.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="uom_code" class="col-sm-1 control-label">Uom Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="uom_code" name="uom_code" placeholder="Uom Code" value = "<?php echo $this->uom_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="uom_seqno" class="col-sm-1 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="uom_seqno" name="uom_seqno" value = "<?php echo $this->uom_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="uom_status" class="col-sm-1 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="uom_status" name="uom_status">
                             <option value = '1' <?php if($this->uom_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->uom_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="uom_desc" class="col-sm-1 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="uom_desc" name="uom_desc" placeholder="Remark"><?php echo $this->uom_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->uom_id;?>" name = "uom_id"/>
                    <?php 
                    if($this->uom_id > 0){
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
        $("#uom_form").validate({
                  rules: 
                  {
                      uom_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      uom_code:
                      {
                          required: "Please enter Uom Code."
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
    <title>Uom Management</title>
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
            <h1>Uom Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Uom Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='uom.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="uom_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Uom Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT uom.*
                              FROM db_uom uom 
                              WHERE uom.uom_id > 0";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['uom_code'];?></td>
                            <td><?php echo nl2br($row['uom_desc']);?></td>
                            <td><?php echo $row['uom_seqno'];?></td>
                            <td><?php if($row['uom_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'uom.php?action=edit&uom_id=<?php echo $row['uom_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('uom.php?action=delete&uom_id=<?php echo $row['uom_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Uom Code</th>
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
        $('#uom_table').DataTable({
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
