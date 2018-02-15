<?php
/*
 * To change this tcountryate, choose Tools | Tcountryates
 * and open the tcountryate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Country {

    public function Country(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('country_code','country_desc','country_seqno','country_status');
        $table_value = array($this->country_code,$this->country_desc,$this->country_seqno,$this->country_status);
        $remark = "Insert Country.";
        if(!$this->save->SaveData($table_field,$table_value,'db_country','country_id',$remark)){
           return false;
        }else{
           $this->country_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('country_code','country_desc','country_seqno','country_status');
        $table_value = array($this->country_code,$this->country_desc,$this->country_seqno,$this->country_status);
        
        $remark = "Update Country.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_country','country_id',$remark,$this->country_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchCountryDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_country WHERE country_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->country_id = $row['country_id'];
            $this->country_code = $row['country_code'];
            $this->country_desc = $row['country_desc'];
            $this->country_seqno = $row['country_seqno'];
            $this->country_status = $row['country_status'];
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_country"," WHERE country_id = '$this->country_id'","Delete Country.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->country_seqno = 10;
            $this->country_status = 1;
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Country Management</title>
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
            <h1>Country Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->country_id > 0){ echo "Update Country";}else{ echo "Create New Country";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='country.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='country.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'country_form' class="form-horizontal" action = 'country.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="country_code" class="col-sm-2 control-label">Country Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="country_code" name="country_code" placeholder="Countryet Code" value = "<?php echo $this->country_code;?>" >
                          </div>
                        </div>  
                        
                    
                    <div class="form-group">
                      <label for="country_seqno" class="col-sm-2 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="country_seqno" name="country_seqno" value = "<?php echo $this->country_seqno;?>" placeholder="Seq No">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="country_status" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-3">
                           <select class="form-control" id="country_status" name="country_status">
                             <option value = '1' <?php if($this->country_status == 1){ echo 'SELECTED';}?>>Active</option>
                             <option value = '0' <?php if($this->country_status == 0){ echo 'SELECTED';}?>>In-active</option>
                           </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="country_desc" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="country_desc" name="country_desc" placeholder="Remark"><?php echo $this->country_desc;?></textarea>
                      </div>
                    </div> 
                    
                     
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->country_id;?>" name = "country_id"/>
                    <?php 
                    if($this->country_id > 0){
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
        $("#country_form").validate({
                  rules: 
                  {
                      country_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      country_code:
                      {
                          required: "Please enter Country Code."
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
    <title>Country Management</title>
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
            <h1>Country Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Country Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='country.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="country_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Country Code</th>
                        <th style = 'width:40%'>Remark</th>
                        <th style = 'width:10%'>Seq No</th>
                        <th style = 'width:10%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT country.*
                              FROM db_country country 
                              WHERE country.country_id > 0 ORDER BY country.country_seqno,country.country_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['country_code'];?></td>
                            <td><?php echo nl2br($row['country_desc']);?></td>
                            <td><?php echo $row['country_seqno'];?></td>
                            <td><?php if($row['country_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'country.php?action=edit&country_id=<?php echo $row['country_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('country.php?action=delete&country_id=<?php echo $row['country_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:15%'>Country Code</th>
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
        $('#country_table').DataTable({
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
