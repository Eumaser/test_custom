<?php
/*
 * To change this tleavetypeate, choose Tools | Tleavetypeates
 * and open the tleavetypeate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Leavetype {

    public function Leavetype(){

        

    }
    public function create(){
        $table_field = array('leavetype_code','leavetype_desc','leavetype_isdeduct','leavetype_seqno','leavetype_status');
        $table_value = array($this->leavetype_code,$this->leavetype_desc,$this->leavetype_isdeduct,$this->leavetype_seqno,$this->leavetype_status);
        $remark = "Insert Leavetype.";
        if(!$this->save->SaveData($table_field,$table_value,'db_leavetype','leavetype_id',$remark)){
           return false;
        }else{
           $this->leavetype_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('leavetype_code','leavetype_desc','leavetype_isdeduct','leavetype_seqno','leavetype_status');
        $table_value = array($this->leavetype_code,$this->leavetype_desc,$this->leavetype_isdeduct,$this->leavetype_seqno,$this->leavetype_status);
        
        $remark = "Update Leavetype.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_leavetype','leavetype_id',$remark,$this->leavetype_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchLeavetypeDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_leavetype WHERE leavetype_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->leavetype_id = $row['leavetype_id'];
            $this->leavetype_code = $row['leavetype_code'];
            $this->leavetype_desc = $row['leavetype_desc'];
            $this->leavetype_isdeduct = $row['leavetype_isdeduct'];
            $this->leavetype_seqno = $row['leavetype_seqno'];
            $this->leavetype_status = $row['leavetype_status'];
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_leavetype"," WHERE leavetype_id = '$this->leavetype_id'","Delete Prod-Grp.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->leavetype_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Leave Type Management</title>
    <?php
    include_once 'css.php';
    include_once 'js.php';
    ?>

    <script src="dist/ckeditor/ckeditor.js"></script>
    <script>
    $(document).ready(function() {
//        CKEDITOR.replace('leavetype_desc');
    
    
    });
    </script>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
 <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      <!-- include header-->
      <?php include_once 'header.php';?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Leave Type Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->leavetype_id > 0){ echo "Update Leave Type";}else{ echo "Create New Leave Type";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='leavetype.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='leavetype.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'leavetype_form' class="form-horizontal" action = 'leavetype.php?action=create' method = "POST" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="leavetype_code" class="col-sm-2 control-label">Leave Type Code</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="leavetype_code" name="leavetype_code" placeholder="Leavetype Code" value = "<?php echo $this->leavetype_code;?>" <?php echo $readonly;?>>
                      </div>
                      <label for="leavetype_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="leavetype_seqno" name="leavetype_seqno" placeholder="Seq No" value = "<?php echo $this->leavetype_seqno;?>" <?php echo $readonly;?>>
                      </div>
                    </div>   
                    <div class="form-group">
                      <label for="leavetype_isdeduct" class="col-sm-2 control-label">Is Deduct</label>
                      <div class="col-sm-3">
                        <input type="checkbox" value = '1' id="leavetype_isdeduct" name="leavetype_isdeduct" <?php if($this->leavetype_isdeduct == 1){ echo 'CHECKED';}?> <?php echo $readonly;?>>
                      </div>

                    </div>
                    <div class="form-group">
                      <label for="leavetype_desc" class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-3">
                      <textarea id="rleavetype_desc" name="leavetype_desc" class="form-control" rows="3" placeholder="Description" <?php echo $readonly;?>><?php echo $this->leavetype_desc;?></textarea>
                      </div>
                        <label for="leavetype_status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-3">
                             <select class="form-control" id="leavetype_status" name="leavetype_status">
                                  <option value = '0' <?php if($this->leavetype_status == 0){ echo 'SELECTED';}?>>In-Active</option>
                                  <option value = '1' <?php if($this->leavetype_status == 1){ echo 'SELECTED';}?>>Active</option>
                             </select>
                        </div>
                    </div>

                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->leavetype_id;?>" name = "leavetype_id"/>
                    <?php 
                    if($this->leavetype_id > 0){
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
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->

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
    <title>Leave Type Management</title>
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Leave Type Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Leave Type Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='leavetype.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="leavetype_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Leave Type</th>
                        <th style = 'width:50%'>Description</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT leavetype.*
                              FROM db_leavetype leavetype 
                              WHERE leavetype.leavetype_id > 0 
                              ORDER BY leavetype.leavetype_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['leavetype_code'];?></td>
                            <td><?php echo $row['leavetype_desc'];?></td>
                            <td><?php 
                            if($row['leavetype_status'] == 1){ 
                                echo 'Active';
                            }else{
                                echo 'In-Active';
                            }
                            ?>
                            </td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'leavetype.php?action=edit&leavetype_id=<?php echo $row['leavetype_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('leavetype.php?action=delete&leavetype_id=<?php echo $row['leavetype_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Leave Type</th>
                        <th style = 'width:50%'>Description</th>
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
        $('#leavetype_table').DataTable({
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
