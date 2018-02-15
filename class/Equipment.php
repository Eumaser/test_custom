<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Equipment {

    public function Equipment(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('equipment_code','equipment_desc','equipment_seqno','equipment_status','equipment_project');
        $table_value = array($this->equipment_code,$this->equipment_desc,$this->equipment_seqno,$this->equipment_status,$this->equipment_project);
        $remark = "Insert Equipment.";
        if(!$this->save->SaveData($table_field,$table_value,'db_equipment','equipment_id',$remark)){
           return false;
        }else{
           $this->equipment_id = $this->save->lastInsert_id; 
           return true;
        }
    }
    public function update(){
        $table_field = array('equipment_code','equipment_desc','equipment_seqno','equipment_status','equipment_project');
        $table_value = array($this->equipment_code,$this->equipment_desc,$this->equipment_seqno,$this->equipment_status,$this->equipment_project);
        $remark = "Update Equipment.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_equipment','equipment_id',$remark,$this->equipment_id)){
           return false;
        }else{
           return true;
        }
    }
    public function delete(){
        if($this->save->DeleteData("db_equipment"," WHERE equipment_id = '$this->equipment_id'","Delete Equipment.")){
            return true;
        }else{
            return false;
        }
    }
    public function fetchEquipmentDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT c.*
                FROM db_equipment c
                WHERE c.equipment_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->equipment_id = $row['equipment_id'];
            $this->equipment_code = $row['equipment_code'];
            $this->equipment_desc = $row['equipment_desc'];
            $this->equipment_seqno = $row['equipment_seqno'];
            $this->equipment_status = $row['equipment_status'];
            $this->equipment_project = $row['equipment_project'];
        }
        return $query;
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->equipment_seqno = 10;
            $this->equipment_status = 1;
        }
        $this->projectCrtl = $this->select->getProjectSelectCtrl($this->equipment_project,'Y');
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Equipment Management</title>
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
            <h1>Equipment Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->equipment_id > 0){ echo "Update Equipment";}else{ echo "Create New Equipment";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='equipment.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='equipment.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'equipment_form' class="form-horizontal" action = 'equipment.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="equipment_code" class="col-sm-2 control-label">Equipment Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="equipment_code" name="equipment_code" placeholder="Equipment Code" value = "<?php echo $this->equipment_code;?>" >
                          </div>
                        </div>  
  
                    <div class="form-group">  
                      <label for="equipment_project" class="col-sm-2 control-label">Location</label>
                      <div class="col-sm-3">
                            <select class="form-control select2" id="equipment_project" name="equipment_project" <?php echo $disabled;?> >
                                <?php echo $this->projectCrtl;?>
                            </select>
                      </div>
                    </div> 
                    
                    <div class="form-group">
                      <label for="equipment_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="equipment_seqno" name="equipment_seqno" value = "<?php echo $this->equipment_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="equipment_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="equipment_status" name="equipment_status">
                             <option value = '1' <?php if($this->equipment_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->equipment_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="equipment_desc" class="col-sm-2 control-label">Remarks</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="equipment_desc" name="equipment_desc" placeholder="Remark"><?php echo $this->equipment_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->equipment_id;?>" name = "equipment_id"/>
                    <?php 
                    if($this->equipment_id > 0){
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
        $("#equipment_form").validate({
                  rules: 
                  {
                      equipment_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      equipment_code:
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
    <title>Equipment Management</title>
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
            <h1>Equipment Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Equipment Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='equipment.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="equipment_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Equipment Code</th>
                        <th style = 'width:15%'>Location</th>
                        <th style = 'width:40%'>Remarks</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT equipment.*,p.project_name,p.project_outlet
                              FROM db_equipment equipment 
                              LEFT JOIN db_project p ON p.project_id = equipment.equipment_project
                              WHERE equipment.equipment_id > 0 ORDER BY equipment_seqno,equipment_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['equipment_code'];?></td>
                            <td><?php echo $row['project_name'] . " - " . $row['project_outlet'];?></td>
                            <td><?php echo nl2br($row['equipment_desc']);?></td>
                            <td><?php echo $row['equipment_seqno'];?></td>
                            <td><?php if($row['equipment_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'equipment.php?action=edit&equipment_id=<?php echo $row['equipment_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('equipment.php?action=delete&equipment_id=<?php echo $row['equipment_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Equipment Code</th>
                        <th style = 'width:15%'>Location</th>
                        <th style = 'width:40%'>Remarks</th>
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
        $('#equipment_table').DataTable({
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
    public function validateEquipment($equipment_code,$equipment_id){
        if($equipment_code != ""){
            if($equipment_id > 0){
                $wherestring = " AND equipment_id != '$equipment_id'";
            }
            $sql = "SELECT COUNT(*) as total FROM equipment WHERE equipment_code = '$equipment_code' $wherestring";
            $query = mysql_query($sql);
            if($row = mysql_fetch_array($query)){
                $total = $row['total'];
            }else{
                $total = 0;
            }
            if($total > 0){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
}
?>
