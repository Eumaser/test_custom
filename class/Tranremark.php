<?php
/*
 * To change this ttranremarkate, choose Tools | Ttranremarkates
 * and open the ttranremarkate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Tranremark {

    public function Tranremark(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('tranremark_code','tranremark_desc','tranremark_seqno','tranremark_status');
        $table_value = array($this->tranremark_code,$this->tranremark_desc,$this->tranremark_seqno,$this->tranremark_status);
        $remark = "Insert Tran Note.";
        if(!$this->save->SaveData($table_field,$table_value,'db_tranremark','tranremark_id',$remark)){
           return false;
        }else{
           $this->tranremark_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('tranremark_desc');
        $table_value = array($this->tranremark_desc);
        
        $remark = "Update Tran Note.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_tranremark','tranremark_id',$remark,$this->tranremark_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchTranremarkDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_tranremark WHERE tranremark_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->tranremark_id = $row['tranremark_id'];
            $this->tranremark_code = $row['tranremark_code'];
            $this->tranremark_desc = $row['tranremark_desc'];
            $this->tranremark_seqno = $row['tranremark_seqno'];
            $this->tranremark_status = $row['tranremark_status'];
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_tranremark"," WHERE tranremark_id = '$this->tranremark_id'","Delete Tranremarket.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->tranremark_seqno = 10;
            $this->tranremark_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transaction Remark Management</title>
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
            <h1>Transaction Remark Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->tranremark_id > 0){ echo "Update Transaction Remark";}else{ echo "Create New Transaction Remark";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='tranremark.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <!--<button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='tranremark.php?action=createForm'">Create New</button>-->
                <?php }?>
              </div>
                
                <form id = 'tranremark_form' class="form-horizontal" action = 'tranremark.php?action=create' method = "POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="tranremark_code" class="col-sm-1 control-label">Type</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="tranremark_code" disabled name="tranremark_code" placeholder="Type" value = "<?php echo $this->tranremark_code;?>" >
                      </div>
                    </div>  

                    <div class="form-group">
                      <label for="tranremark_desc" class="col-sm-1 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="7" id="tranremark_desc" name="tranremark_desc" placeholder="Notes"><?php echo $this->tranremark_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->tranremark_id;?>" name = "tranremark_id"/>
                    <?php 
                    if($this->tranremark_id > 0){
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
        $("#tranremark_form").validate({
                  rules: 
                  {
                      tranremark_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      tranremark_code:
                      {
                          required: "Please enter Tranremarket Code."
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
    <title>Transaction Remark Management</title>
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
            <h1>Transaction Remark Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Transaction Remark Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <!--<button class="btn btn-primary pull-right" onclick = "window.location.href='tranremark.php?action=createForm'">Create New + </button>-->
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tranremark_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Type</th>
                        <th style = 'width:40%'>Notes</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT tranremark.*
                              FROM db_tranremark tranremark 
                              WHERE tranremark.tranremark_id > 0 ORDER BY tranremark.tranremark_seqno,tranremark.tranremark_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['tranremark_code'];?></td>
                            <td><?php echo nl2br($row['tranremark_desc']);?></td>
                            <td><?php echo $row['tranremark_seqno'];?></td>
                            <td><?php if($row['tranremark_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'tranremark.php?action=edit&tranremark_id=<?php echo $row['tranremark_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <!--<button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('tranremark.php?action=delete&tranremark_id=<?php echo $row['tranremark_id'];?>','Confirm Delete?')">Delete</button>-->
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
                        <th style = 'width:15%'>Type</th>
                        <th style = 'width:40%'>Notes</th>
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
        $('#tranremark_table').DataTable({
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
