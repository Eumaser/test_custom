<?php
/*
 * To change this tpaymenttermate, choose Tools | Tpaymenttermates
 * and open the tpaymenttermate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Paymentterm {

    public function Paymentterm(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('paymentterm_code','paymentterm_desc','paymentterm_seqno','paymentterm_status');
        $table_value = array($this->paymentterm_code,$this->paymentterm_desc,$this->paymentterm_seqno,$this->paymentterm_status);
        $remark = "Insert Payment Term Note.";
        if(!$this->save->SaveData($table_field,$table_value,'db_paymentterm','paymentterm_id',$remark)){
           return false;
        }else{
           $this->paymentterm_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('paymentterm_code','paymentterm_desc','paymentterm_seqno','paymentterm_status');
        $table_value = array($this->paymentterm_code,$this->paymentterm_desc,$this->paymentterm_seqno,$this->paymentterm_status);
        
        $remark = "Update Payment Term Note.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_paymentterm','paymentterm_id',$remark,$this->paymentterm_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchPaymenttermDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_paymentterm WHERE paymentterm_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->paymentterm_id = $row['paymentterm_id'];
            $this->paymentterm_code = $row['paymentterm_code'];
            $this->paymentterm_desc = $row['paymentterm_desc'];
            $this->paymentterm_seqno = $row['paymentterm_seqno'];
            $this->paymentterm_status = $row['paymentterm_status'];
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_paymentterm"," WHERE paymentterm_id = '$this->paymentterm_id'","Delete Paymenttermet.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->paymentterm_seqno = 10;
            $this->paymentterm_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Payment Term Management</title>
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
            <h1>Payment Term Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->paymentterm_id > 0){ echo "Update Payment Term";}else{ echo "Create New Payment Term";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='paymentterm.php'">Back</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='paymentterm.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'paymentterm_form' class="form-horizontal" action = 'paymentterm.php?action=create' method = "POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="paymentterm_code" class="col-sm-1 control-label">Type</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="paymentterm_code" name="paymentterm_code" placeholder="Type" value = "<?php echo $this->paymentterm_code;?>" >
                      </div>
                    </div>  
                    <div class="form-group">
                      <label for="paymentterm_seqno" class="col-sm-1 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="paymentterm_seqno" name="paymentterm_seqno" value = "<?php echo $this->paymentterm_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="paymentterm_status" class="col-sm-1 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="paymentterm_status" name="paymentterm_status">
                             <option value = '1' <?php if($this->paymentterm_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->paymentterm_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="paymentterm_desc" class="col-sm-1 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="7" id="paymentterm_desc" name="paymentterm_desc" placeholder="Remark"><?php echo $this->paymentterm_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->paymentterm_id;?>" name = "paymentterm_id"/>
                    <?php 
                    if($this->paymentterm_id > 0){
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
        $("#paymentterm_form").validate({
                  rules: 
                  {
                      paymentterm_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      paymentterm_code:
                      {
                          required: "Please enter Payment Term Code."
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
    <title>Payment Term Management</title>
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
            <h1>Payment Term Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Payment Term Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='paymentterm.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="paymentterm_table" class="table table-bordered table-hover">
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
                      $sql = "SELECT paymentterm.*
                              FROM db_paymentterm paymentterm 
                              WHERE paymentterm.paymentterm_id > 0 ORDER BY paymentterm.paymentterm_seqno,paymentterm.paymentterm_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['paymentterm_code'];?></td>
                            <td><?php echo nl2br($row['paymentterm_desc']);?></td>
                            <td><?php echo $row['paymentterm_seqno'];?></td>
                            <td><?php if($row['paymentterm_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'paymentterm.php?action=edit&paymentterm_id=<?php echo $row['paymentterm_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('paymentterm.php?action=delete&paymentterm_id=<?php echo $row['paymentterm_id'];?>','Confirm Delete?')">Delete</button>
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
        $('#paymentterm_table').DataTable({
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
