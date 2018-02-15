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
class Prefix {

    public function Prefix(){
        global $connection;
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        $this->db_conn = $connection;

    }
    public function create(){
        $table_field = array('prefix_code','prefix_desc','prefix_seqno','prefix_status');
        $table_value = array($this->prefix_code,$this->prefix_desc,$this->prefix_seqno,$this->prefix_status);
        $remark = "Insert Prefix.";
        if(!$this->save->SaveData($table_field,$table_value,'db_prefix','prefix_id',$remark)){
           return false;
        }else{
           $this->prefix_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('prefix_code','prefix_desc','prefix_seqno','prefix_status');
        $table_value = array($this->prefix_code,$this->prefix_desc,$this->prefix_seqno,$this->prefix_status);
        
        $remark = "Update Prefix.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_prefix','prefix_id',$remark,$this->prefix_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchPrefixDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_prefix WHERE prefix_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);
            $this->prefix_id = $row['prefix_id'];
            $this->prefix_code = $row['prefix_code'];
            $this->prefix_desc = html_entity_decode($row['prefix_desc']);
            $this->prefix_seqno = $row['prefix_seqno'];
            $this->prefix_status = $row['prefix_status'];
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_prefix"," WHERE prefix_id = '$this->prefix_id'","Delete Prefix.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->prefix_seqno = 10;
            $this->prefix_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prefix Management</title>
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
            <h1>Prefix Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->currency_id > 0){ echo "Update Prefix";}else{ echo "Create New Prefix";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='prefix.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='prefix.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'prefix_form' class="form-horizontal" action = 'prefix.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="prefix_code" class="col-sm-2 control-label">Prefix Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="prefix_code" name="prefix_code" placeholder="Prefix Code" value = "<?php echo $this->prefix_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="prefix_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="prefix_seqno" name="prefix_seqno" value = "<?php echo $this->prefix_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="prefix_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="prefix_status" name="prefix_status">
                             <option value = '1' <?php if($this->prefix_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->prefix_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="prefix_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="prefix_desc" name="prefix_desc" placeholder="Remark"><?php echo $this->prefix_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->prefix_id;?>" name = "prefix_id"/>
                    <?php 
                    if($this->prefix_id > 0){
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
        $("#prefix_form").validate({
                  rules: 
                  {
                      prefix_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      prefix_code:
                      {
                          required: "Please enter Prefix Code."
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
    <title>Prefix Management</title>
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
            <h1>Prefix Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Prefix Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='prefix.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="prefix_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Prefix Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT prefix.*
                              FROM db_prefix prefix 
                              WHERE prefix.prefix_id > 0 ORDER BY prefix.prefix_seqno, prefix.prefix_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['prefix_code'];?></td>
                            <td><?php echo nl2br(html_entity_decode($row['prefix_desc']));?></td>
                            <td><?php echo $row['prefix_seqno'];?></td>
                            <td><?php if($row['prefix_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'prefix.php?action=edit&prefix_id=<?php echo $row['prefix_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('prefix.php?action=delete&prefix_id=<?php echo $row['prefix_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Prefix Code</th>
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
        $('#prefix_table').DataTable({
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
