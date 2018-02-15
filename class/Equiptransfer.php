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
class Equiptransfer {

    public function Equiptransfer(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('equiptransfer_equip_id','equiptransfer_currentlocation','equiptransfer_transferto',
                             'equiptransfer_desc','equiptransfer_status','equiptransfer_date');
        $table_value = array($this->equiptransfer_equip_id,$this->equiptransfer_currentlocation,$this->equiptransfer_transferto,
                             $this->equiptransfer_desc,$this->equiptransfer_status,format_date_database($this->equiptransfer_date));
        $remark = "Insert Equiptransfer.";
        if(!$this->save->SaveData($table_field,$table_value,'db_equiptransfer','equiptransfer_id',$remark)){
           return false;
        }else{
           $this->equiptransfer_id = $this->save->lastInsert_id; 
           return true;
        }
    }
    public function update(){
        $table_field = array('equiptransfer_equip_id','equiptransfer_currentlocation','equiptransfer_transferto',
                             'equiptransfer_desc','equiptransfer_status','equiptransfer_date');
        $table_value = array($this->equiptransfer_equip_id,$this->equiptransfer_currentlocation,$this->equiptransfer_transferto,
                             $this->equiptransfer_desc,$this->equiptransfer_status,format_date_database($this->equiptransfer_date));
        $remark = "Update Equiptransfer.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_equiptransfer','equiptransfer_id',$remark,$this->equiptransfer_id)){
           return false;
        }else{
           return true;
        }
    }
    public function delete(){
        if($this->save->DeleteData("db_equiptransfer"," WHERE equiptransfer_id = '$this->equiptransfer_id'","Delete Equiptransfer.")){
            return true;
        }else{
            return false;
        }
    }
    public function fetchEquiptransferDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT c.*
                FROM db_equiptransfer c
                WHERE c.equiptransfer_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->equiptransfer_id = $row['equiptransfer_id'];
            $this->equiptransfer_equip_id = $row['equiptransfer_equip_id'];
            $this->equiptransfer_currentlocation = $row['equiptransfer_currentlocation'];
            $this->equiptransfer_transferto = $row['equiptransfer_transferto'];
            $this->equiptransfer_desc = $row['equiptransfer_desc'];
            $this->equiptransfer_status = $row['equiptransfer_status'];
            $this->equiptransfer_date = $row['equiptransfer_date'];
        }
        return $query;
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->equiptransfer_seqno = 10;
            $this->equiptransfer_status = 1;
            $this->equiptransfer_date = system_date;
        }
        $this->equipmentCrtl = $this->select->getEquipmentSelectCtrl($this->equiptransfer_equip_id,'Y');
        $this->transferfromCrtl = $this->select->getProjectSelectCtrl($this->equiptransfer_currentlocation,'Y');
        $this->transfertoCrtl = $this->select->getProjectSelectCtrl($this->equiptransfer_transferto,'Y');
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Equipment Transfer Management</title>
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
            <h1>Equipment Transfer Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->equiptransfer_id > 0){ echo "Update Equipment Transfer";}else{ echo "Create New Equipment Transfer";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='equiptransfer.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='equiptransfer.php?action=createForm'">Create New</button>
                <?php }?>
              </div>

                <form id = 'equiptransfer_form' class="form-horizontal" action = 'equiptransfer.php?action=create' method = "POST">
                  <div class="box-body">
                    <div class="form-group">
                        <label for="equiptransfer_date" class="col-sm-2 control-label">Transfer Date</label>
                        <div class="col-sm-3">
                          <input READONLY type="text" class="form-control" id="equiptransfer_date" name="equiptransfer_date" value = "<?php echo format_date($this->equiptransfer_date);?>"  <?php echo $disabled;?>>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="equiptransfer_equip_id" class="col-sm-2 control-label">Equipment Transfer Code</label>
                      <div class="col-sm-3">
                            <select class="form-control select2" id="equiptransfer_equip_id" name="equiptransfer_equip_id" <?php echo $disabled;?> >
                                <?php echo $this->equipmentCrtl;?>
                            </select>
                      </div>
                    </div>  
                    <div class="form-group">  
                      <label for="equiptransfer_currentlocation" class="col-sm-2 control-label">Transfer From</label>
                      <div class="col-sm-3">
                            <select class="form-control select2" id="equiptransfer_currentlocation" name="equiptransfer_currentlocation" <?php echo $disabled;?> >
                                <?php echo $this->transferfromCrtl;?>
                            </select>
                      </div>
                    </div> 
                    <div class="form-group">  
                      <label for="equiptransfer_transferto" class="col-sm-2 control-label">Transfer To</label>
                      <div class="col-sm-3">
                            <select class="form-control select2" id="equiptransfer_transferto" name="equiptransfer_transferto" <?php echo $disabled;?> >
                                <?php echo $this->transfertoCrtl;?>
                            </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="equiptransfer_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="equiptransfer_status" name="equiptransfer_status">
                             <option value = '1' <?php if($this->equiptransfer_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->equiptransfer_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="equiptransfer_desc" class="col-sm-2 control-label">Remarks</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="equiptransfer_desc" name="equiptransfer_desc" placeholder="Remark"><?php echo $this->equiptransfer_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->equiptransfer_id;?>" name = "equiptransfer_id"/>
                    <?php 
                    if($this->equiptransfer_id > 0){
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

        $('#equiptransfer_equip_id').change(function(){
                var data = "action=fetchequipment&equiptransfer_equip_id="+$(this).val();
                 $.ajax({
                    type: "POST",
                    url: "equiptransfer.php",      
                    data:data,
                    success: function(data) {
                        var jsonObj = eval ("(" + data + ")");
                        if(jsonObj.status == 1){
                          $('#equiptransfer_currentlocation').select2('val',jsonObj.equipment_project);
                        }else{
                            alert("<?php echo $language[$lang]['reactive_cancel_fail'];?>");    
                        }
                    }
                 });
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
    <title>Equipment Transfer Management</title>
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
            <h1>Equipment Transfer Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Equipment Transfer Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='equiptransfer.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="equiptransfer_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Equipment Code</th>
                        <th style = 'width:15%'>Transfer From</th>
                        <th style = 'width:15%'>Transfer To</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT et.*,eq.equipment_code
                              FROM db_equiptransfer et 
                              LEFT JOIN db_equipment eq ON eq.equipment_id = et.equiptransfer_equip_id
                              WHERE et.equiptransfer_id > 0 ORDER BY et.equiptransfer_date DESC";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['equipment_code'];?></td>
                            <td><?php echo getDataCodeBySql("CONCAT(project_code,' - ',project_outlet)","db_project"," WHERE project_id = '{$row['equiptransfer_currentlocation']}'", $orderby)?></td>
                            <td><?php echo getDataCodeBySql("CONCAT(project_code,' - ',project_outlet)","db_project"," WHERE project_id = '{$row['equiptransfer_transferto']}'", $orderby)?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'equiptransfer.php?action=edit&equiptransfer_id=<?php echo $row['equiptransfer_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('equiptransfer.php?action=delete&equiptransfer_id=<?php echo $row['equiptransfer_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Transfer From</th>
                        <th style = 'width:15%'>Transfer To</th>
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
        $('#equiptransfer_table').DataTable({
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
    public function validateEquiptransfer($equiptransfer_code,$equiptransfer_id){
        if($equiptransfer_code != ""){
            if($equiptransfer_id > 0){
                $wherestring = " AND equiptransfer_id != '$equiptransfer_id'";
            }
            $sql = "SELECT COUNT(*) as total FROM equiptransfer WHERE equiptransfer_code = '$equiptransfer_code' $wherestring";
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
