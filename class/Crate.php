<?php
/*
 * To change this tcrateate, choose Tools | Tcrateates
 * and open the tcrateate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Crate {

    public function Crate(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('crate_fcurrency_id','crate_tcurrency_id','crate_rate','crate_fdate',
                             'crate_tdate','crate_status','crate_desc');
        $table_value = array($this->crate_fcurrency_id,$this->crate_tcurrency_id,$this->crate_rate,$this->crate_fdate,
                             $this->crate_tdate,$this->crate_status,$this->crate_desc);
        $remark = "Insert Currency Rate.";
        if(!$this->save->SaveData($table_field,$table_value,'db_crate','crate_id',$remark)){
           return false;
        }else{
           $this->crate_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('crate_fcurrency_id','crate_tcurrency_id','crate_rate','crate_fdate',
                             'crate_tdate','crate_status','crate_desc');
        $table_value = array($this->crate_fcurrency_id,$this->crate_tcurrency_id,$this->crate_rate,$this->crate_fdate,
                             $this->crate_tdate,$this->crate_status,$this->crate_desc);
        
        $remark = "Update Currency Rate.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_crate','crate_id',$remark,$this->crate_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchCrateDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_crate WHERE crate_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->crate_id = $row['crate_id'];
            $this->crate_fcurrency_id = $row['crate_fcurrency_id'];
            $this->crate_tcurrency_id = $row['crate_tcurrency_id'];
            $this->crate_rate = $row['crate_rate'];
            $this->crate_fdate = $row['crate_fdate'];
            $this->crate_tdate = $row['crate_tdate'];
            $this->crate_status = $row['crate_status'];
            $this->crate_desc = $row['crate_desc'];
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_crate"," WHERE crate_id = '$this->crate_id'","Delete Currency Rate.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->crate_seqno = 10;
            $this->crate_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Currency Rate Management</title>
    <?php
    include_once 'css.php';
    $this->currencyFromCrtl = $this->select->getCurrencySelectCtrl($this->crate_fcurrency_id,'N');
    $this->currencyToCrtl = $this->select->getCurrencySelectCtrl($this->crate_tcurrency_id,'N');
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
            <h1>Currency Rate Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->crate_id > 0){ echo "Update Currency Rate";}else{ echo "Create New Currency Rate";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='crate.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='crate.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'crate_form' class="form-horizontal" action = 'crate.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="crate_fcurrency_id" class="col-sm-2 control-label">Currency (From)</label>
                          <div class="col-sm-3">
                               <select class="form-control select2" id="crate_fcurrency_id" name="crate_fcurrency_id">
                                   <?php echo $this->currencyFromCrtl;?>
                               </select>
                          </div>
                        </div> 
                        <div class="form-group">
                          <label for="crate_tcurrency_id" class="col-sm-2 control-label">Currency (To)</label>
                          <div class="col-sm-3">
                               <select class="form-control select2" id="crate_tcurrency_id" name="crate_tcurrency_id">
                                   <?php echo $this->currencyToCrtl;?>
                               </select>
                          </div>
                        </div> 
                        <div class="form-group">
                          <label for="crate_fdate" class="col-sm-2 control-label">Date (From)</label>
                          <div class="col-sm-3">
                               <input type="text" class="form-control datepicker" id="crate_fdate" name="crate_fdate" value = "<?php echo $this->crate_fdate;?>" placeholder= "Date (From)">
                          </div>
                        </div> 
                        <div class="form-group">
                          <label for="crate_tdate" class="col-sm-2 control-label">Date (To)</label>
                          <div class="col-sm-3">
                               <input type="text" class="form-control datepicker" id="crate_tdate" name="crate_tdate" value = "<?php echo $this->crate_tdate;?>" placeholder= "Date (To)">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="crate_rate" class="col-sm-2 control-label">Rate</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="crate_rate" name="crate_rate" placeholder="Rate" value = "<?php echo $this->crate_rate;?>" >
                          </div>
                        </div> 
                    <div class="form-group">
                      <label for="crate_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="crate_status" name="crate_status">
                             <option value = '1' <?php if($this->crate_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->crate_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="crate_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="crate_desc" name="crate_desc" placeholder="Remark"><?php echo $this->crate_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->crate_id;?>" name = "crate_id"/>
                    <?php
                    if($this->crate_id > 0){
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
    <title>Currency Rate Management</title>
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
            <h1>Currency Rate Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Crate Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='crate.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="crate_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Currency (From)</th>
                        <th>Currency (To)</th>
                        <th>Date (From)</th>
                        <th>Date (To)</th>
                        <th>Rate</th>
                        <th>Status</th>   
                        <th></th>   
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT crate.*,cf.currency_code as currency_from,ct.currency_code as currency_to
                              FROM db_crate crate 
                              INNER JOIN db_currency cf ON cf.currency_id = crate.crate_fcurrency_id
                              INNER JOIN db_currency ct ON ct.currency_id = crate.crate_tcurrency_id
                              WHERE crate.crate_id > 0";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['currency_from'];?></td>
                            <td><?php echo $row['currency_to'];?></td>
                            <td><?php echo $row['crate_fdate'];?></td>
                            <td><?php echo $row['crate_tdate'];?></td>
                            <td><?php echo $row['crate_rate'];?></td>
                            <td><?php if($row['crate_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'crate.php?action=edit&crate_id=<?php echo $row['crate_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('crate.php?action=delete&crate_id=<?php echo $row['crate_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th>No</th>
                        <th>Currency (From)</th>
                        <th>Currency (To)</th>
                        <th>Date (From)</th>
                        <th>Date (To)</th>
                        <th>Rate</th>
                        <th>Status</th>   
                        <th></th> 
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
        $('#crate_table').DataTable({
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
    public function getCurrencyRateDetail(){
        
        $date = date('Y-m-d');
        $wherestring = " AND crate_fdate <= '$date' AND crate_tdate >= '$date' ";
        $sql = "SELECT * FROM db_crate WHERE crate_tcurrency_id = '$this->crate_tcurrency_id' AND crate_status = '1' $wherestring order by crate_tdate DESC";
        $query = mysql_query($sql);
        $crate_rate = "1.0000";
        if($row = mysql_fetch_array($query)){
            $crate_rate = $row['crate_rate'];
        }else{
            $crate_rate = "1.0000";
        }
        return $crate_rate;
    }

}
?>
