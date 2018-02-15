<?php
/*
 * To change this tcurrencyate, choose Tools | Tcurrencyates
 * and open the tcurrencyate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Currency {

    public function Currency(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('currency_code','currency_desc','currency_seqno','currency_status');
        $table_value = array($this->currency_code,$this->currency_desc,$this->currency_seqno,$this->currency_status);
        $remark = "Insert Currency.";
        if(!$this->save->SaveData($table_field,$table_value,'db_currency','currency_id',$remark)){
           return false;
        }else{
           $this->currency_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('currency_code','currency_desc','currency_seqno','currency_status');
        $table_value = array($this->currency_code,$this->currency_desc,$this->currency_seqno,$this->currency_status);
        
        $remark = "Update Currency.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_currency','currency_id',$remark,$this->currency_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchCurrencyDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_currency WHERE currency_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->currency_id = $row['currency_id'];
            $this->currency_code = $row['currency_code'];
            $this->currency_desc = $row['currency_desc'];
            $this->currency_seqno = $row['currency_seqno'];
            $this->currency_status = $row['currency_status'];
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_currency"," WHERE currency_id = '$this->currency_id'","Delete Currency.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->currency_seqno = 10;
            $this->currency_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Currency Management</title>
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
            <h1>Currency Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->currency_id > 0){ echo "Update Currency";}else{ echo "Create New Currency";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='currency.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='currency.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'currency_form' class="form-horizontal" action = 'currency.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="currency_code" class="col-sm-1 control-label">Currency Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="currency_code" name="currency_code" placeholder="Currency Code" value = "<?php echo $this->currency_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="currency_seqno" class="col-sm-1 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="currency_seqno" name="currency_seqno" value = "<?php echo $this->currency_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="currency_status" class="col-sm-1 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="currency_status" name="currency_status">
                             <option value = '1' <?php if($this->currency_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->currency_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="currency_desc" class="col-sm-1 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="currency_desc" name="currency_desc" placeholder="Remark"><?php echo $this->currency_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->currency_id;?>" name = "currency_id"/>
                    <?php
                    if($this->currency_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                    ?>
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
        $("#currency_form").validate({
                  rules: 
                  {
                      currency_name:
                      {
                          required: true
                      },
                      currency_email:
                      {
                          required: true,
                          email: true
                      },
                      currency_login_email:
                      {
                          email: true,
                          required: true,
                          remote: {
                                  url: "currency.php?action=validate_email",
                                  type: "post",
                                  data: 
                                        {
                                            customer_id: function()
                                            {
                                                return $("#customer_id").val();
                                            }
                                        }
                              }
                      },
                      currency_login_password:
                      {
                        required: true,
                      },
                      currency_login_password_cm:
                      {
                        required: true,
                        minlength : 5,
                        equalTo : "#currency_login_password"
                      }
                  },
                  messages:
                  {
                      currency_name:
                      {
                          required: "Please enter customer first name."
                      },
                      customer_lname:
                      {
                          required: "Please enter customer last name."
                      },
                      customer_login_id:
                      {
                          required: "Please enter customer login email.",
                          remote: "Login email duplicate."
                      },
                      customer_login_password:
                      {
                            required: "Please enter Password."
                      },
                      customer_confirmpassword:
                      {
                            required: "Please enter Confirm Password."
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
    <title>Currency Management</title>
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
            <h1>Currency Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Currency Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='currency.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="currency_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Currency Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>   
                        <th style = 'width:10%'></th>   
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT currency.*
                              FROM db_currency currency 
                              WHERE currency.currency_id > 0";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['currency_code'];?></td>
                            <td><?php echo nl2br($row['currency_desc']);?></td>
                            <td><?php echo $row['currency_seqno'];?></td>
                            <td><?php if($row['currency_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'currency.php?action=edit&currency_id=<?php echo $row['currency_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('currency.php?action=delete&currency_id=<?php echo $row['currency_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Currency Code</th>
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
        $('#currency_table').DataTable({
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
