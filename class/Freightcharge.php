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
class Freightcharge {

    public function Freightcharge(){
        global $connection;
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        $this->db_conn = $connection;

    }
    public function create(){
        $table_field = array('freightcharge_code','freightcharge_desc','freightcharge_seqno','freightcharge_status');
        $table_value = array($this->freightcharge_code,$this->freightcharge_desc,$this->freightcharge_seqno,$this->freightcharge_status);
        $remark = "Insert Freight Charge.";
        if(!$this->save->SaveData($table_field,$table_value,'db_freightcharge','freightcharge_id',$remark)){
           return false;
        }else{
           $this->freightcharge_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('freightcharge_code','freightcharge_desc','freightcharge_seqno','freightcharge_status');
        $table_value = array($this->freightcharge_code,$this->freightcharge_desc,$this->freightcharge_seqno,$this->freightcharge_status);
        
        $remark = "Update Freight Charge.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_freightcharge','freightcharge_id',$remark,$this->freightcharge_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchFreightchargeDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_freightcharge WHERE freightcharge_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);
            $this->freightcharge_id = $row['freightcharge_id'];
            $this->freightcharge_code = $row['freightcharge_code'];
            $this->freightcharge_desc = $row['freightcharge_desc'];
            $this->freightcharge_seqno = $row['freightcharge_seqno'];
            $this->freightcharge_status = $row['freightcharge_status'];
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_freightcharge"," WHERE freightcharge_id = '$this->freightcharge_id'","Delete Freight Charge.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->freightcharge_seqno = 10;
            $this->freightcharge_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Freight Charge Management</title>
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
            <h1>Freight Charge Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->currency_id > 0){ echo "Update Freight Charge";}else{ echo "Create New Freight Charge";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='freightcharge.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='freightcharge.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'freightcharge_form' class="form-horizontal" action = 'freightcharge.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="freightcharge_code" class="col-sm-2 control-label">Freight Charge Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="freightcharge_code" name="freightcharge_code" placeholder="Freight Charge Code" value = "<?php echo $this->freightcharge_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="freightcharge_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="freightcharge_seqno" name="freightcharge_seqno" value = "<?php echo $this->freightcharge_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="freightcharge_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="freightcharge_status" name="freightcharge_status">
                             <option value = '1' <?php if($this->freightcharge_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->freightcharge_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="freightcharge_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="freightcharge_desc" name="freightcharge_desc" placeholder="Remark"><?php echo $this->freightcharge_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->freightcharge_id;?>" name = "freightcharge_id"/>
                    <?php 
                    if($this->freightcharge_id > 0){
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
        $("#freightcharge_form").validate({
                  rules: 
                  {
                      freightcharge_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      freightcharge_code:
                      {
                          required: "Please enter Freight Charge Code."
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
    <title>Freight Charge Management</title>
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
            <h1>Freight Charge Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Freight Charge Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='freightcharge.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="freightcharge_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Freight Charge Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT freightcharge.*
                              FROM db_freightcharge freightcharge 
                              WHERE freightcharge.freightcharge_id > 0 ORDER BY freightcharge.freightcharge_seqno, freightcharge.freightcharge_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['freightcharge_code'];?></td>
                            <td><?php echo nl2br($row['freightcharge_desc']);?></td>
                            <td><?php echo $row['freightcharge_seqno'];?></td>
                            <td><?php if($row['freightcharge_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'freightcharge.php?action=edit&freightcharge_id=<?php echo $row['freightcharge_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('freightcharge.php?action=delete&freightcharge_id=<?php echo $row['freightcharge_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Freight Charge Code</th>
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
        $('#freightcharge_table').DataTable({
          "paging": true,
          "lengthCharge": false,
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
