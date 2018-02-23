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
class Cprofile {

    public function Cprofile(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();


    }
    public function create(){
        $table_field = array('cprofile_name','cprofile_tel','cprofile_fax','cprofile_email',
                             'cprofile_contactemail','cprofile_ccemail','cprofile_description',
                             'cprofile_address','cprofile_bank','cprofile_account','cprofile_acc_code',
                             'cprofile_facebook','cprofile_twitter','cprofile_google','cprofile_youtube');
        $table_value = array($this->cprofile_name,$this->cprofile_tel,$this->cprofile_fax,$this->cprofile_email,
                             $this->cprofile_contactemail,$this->cprofile_ccemail,$this->cprofile_description,
                             $this->cprofile_address,$this->cprofile_bank,$this->cprofile_account,$this->cprofile_acc_code,
                             $this->cprofile_facebook,$this->cprofile_twitter,$this->cprofile_google,$this->cprofile_youtube);
        $remark = "Insert Cprofile.";
        if(!$this->save->SaveData($table_field,$table_value,'cprofile','cprofile_id',$remark)){
           return false;
        }else{
           $this->cprofile_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('cprofile_name','cprofile_tel','cprofile_fax','cprofile_email',
                             'cprofile_contactemail','cprofile_ccemail','cprofile_description',
                             'cprofile_address','cprofile_bank','cprofile_account','cprofile_acc_code',
                             'cprofile_facebook','cprofile_twitter','cprofile_google','cprofile_youtube',
                             'cprofile_gst_no','cprofile_gst','cprofile_country','cprofile_website','cprofile_business_no');
        $table_value = array($this->cprofile_name,$this->cprofile_tel,$this->cprofile_fax,$this->cprofile_email,
                             $this->cprofile_contactemail,$this->cprofile_ccemail,$this->cprofile_description,
                             $this->cprofile_address,$this->cprofile_bank,$this->cprofile_account,$this->cprofile_acc_code,
                             $this->cprofile_facebook,$this->cprofile_twitter,$this->cprofile_google,$this->cprofile_youtube,
                             $this->cprofile_gst_no,$this->cprofile_gst,$this->cprofile_country,$this->cprofile_website,$this->cprofile_business_no);
        $remark = "Update Cprofile.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_cprofile','cprofile_id',$remark,$this->cprofile_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchCprofileDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT c.*
                FROM db_cprofile c
                WHERE c.cprofile_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->cprofile_id = $row['cprofile_id'];
            $this->cprofile_name = $row['cprofile_name'];
            $this->cprofile_tel = $row['cprofile_tel'];
            $this->cprofile_fax = $row['cprofile_fax'];
            $this->cprofile_email = $row['cprofile_email'];
            $this->cprofile_contactemail = $row['cprofile_contactemail'];
            $this->cprofile_ccemail = $row['cprofile_ccemail'];
            $this->cprofile_description = $row['cprofile_description'];
            $this->cprofile_address = $row['cprofile_address'];
            $this->cprofile_bank = $row['cprofile_bank'];
            $this->cprofile_account = $row['cprofile_account'];
            $this->cprofile_acc_code = $row['cprofile_acc_code'];
            $this->cprofile_facebook = $row['cprofile_facebook'];
            $this->cprofile_twitter = $row['cprofile_twitter'];
            $this->cprofile_google = $row['cprofile_google'];
            $this->cprofile_youtube = $row['cprofile_youtube'];
            $this->cprofile_gst_no = $row['cprofile_gst_no'];
            $this->cprofile_gst = $row['cprofile_gst'];
            $this->cprofile_country = $row['cprofile_country'];
            $this->cprofile_website = $row['cprofile_website'];
            $this->cprofile_business_no = $row['cprofile_business_no'];
        }
        return $query;
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->cprofile_status = 1;
        }
        $this->countryCrtl = $this->select->getCountrySelectCtrl($this->cprofile_country);
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Company Profile Management</title>
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
            <h1>Company Profile Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo "Update Company Profile";?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='cprofile.php'">Search</button>
              </div>

                <form id = 'cprofile_form' class="form-horizontal" action = 'cprofile.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="cprofile_name" class="col-sm-2 control-label">Company Name <?php echo $mandatory;?></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="cprofile_name" name="cprofile_name" placeholder="Company Name" value = "<?php echo $this->cprofile_name;?>" >
                          </div>
                          <label for="cprofile_tel" class="col-sm-2 control-label">Tel</label>
                          <div class="col-sm-3">
                              <input type="text" class="form-control" id="cprofile_tel" name="cprofile_tel" value = "<?php echo $this->cprofile_tel;?>" placeholder="Tel">
                           </div>
                        </div>
                    <div class="form-group">
                      <label for="cprofile_fax" class="col-sm-2 control-label">Fax</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="cprofile_fax" name="cprofile_fax" value = "<?php echo $this->cprofile_fax;?>" placeholder="Fax">
                      </div>
                      <label for="cprofile_email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="cprofile_email" name="cprofile_email" value = "<?php echo $this->cprofile_email;?>" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="cprofile_country" class="col-sm-2 control-label">Country <?php echo $mandatory;?></label>
                      <div class="col-sm-3">
                               <select class="form-control select2" id="cprofile_country" name="cprofile_country">
                                   <?php echo $this->countryCrtl;?>
                               </select>
                      </div>

                    </div>
                    <div class="form-group">
                      <label for="cprofile_gst_no" class="col-sm-2 control-label">GST No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="cprofile_gst_no" name="cprofile_gst_no" value = "<?php echo $this->cprofile_gst_no;?>" placeholder="GST No">
                      </div>
                      <label for="cprofile_gst" class="col-sm-2 control-label">GST %</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="cprofile_gst" name="cprofile_gst" value = "<?php echo $this->cprofile_gst;?>" placeholder="GST %">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="cprofile_gst_no" class="col-sm-2 control-label">Website</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="cprofile_website" name="cprofile_website" value = "<?php echo $this->cprofile_website;?>" placeholder="Website">
                      </div>
                      <label for="cprofile_gst" class="col-sm-2 control-label">Business No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="cprofile_business_no" name="cprofile_business_no" value = "<?php echo $this->cprofile_business_no;?>" placeholder="Business No">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="cprofile_address" class="col-sm-2 control-label">Address</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="cprofile_address" name="cprofile_address" placeholder="Address"><?php echo $this->cprofile_address;?></textarea>
                      </div>
                      <label for="cprofile_description" class="col-sm-2 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="cprofile_description" name="cprofile_description" placeholder="Remark"><?php echo $this->cprofile_description;?></textarea>
                      </div>
                    </div>

                      <h4>Bank</h4>
                    <div class="form-group">
                      <label for="cprofile_bank" class="col-sm-2 control-label">Bank</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="cprofile_bank" name="cprofile_bank" value = "<?php echo $this->cprofile_bank;?>" placeholder="Bank">
                      </div>
                      <label for="cprofile_account" class="col-sm-2 control-label">Bank Account</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="cprofile_account" name="cprofile_account" value = "<?php echo $this->cprofile_account;?>" placeholder="Bank Account">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="cprofile_acc_code" class="col-sm-2 control-label">Bank Code</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="cprofile_acc_code" name="cprofile_acc_code" value = "<?php echo $this->cprofile_acc_code;?>" placeholder="Bank Code">
                      </div>

                    </div>
                      <h4>Social</h4>
                    <div class="form-group">
                      <label for="cprofile_facebook" class="col-sm-2 control-label">Facebook</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="cprofile_facebook" name="cprofile_facebook" value = "<?php echo $this->cprofile_facebook;?>" placeholder="Facebook">
                      </div>
                      <label for="cprofile_twitter" class="col-sm-2 control-label">Twitter</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="cprofile_twitter" name="cprofile_twitter" value = "<?php echo $this->cprofile_twitter;?>" placeholder="Twitter">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="cprofile_google" class="col-sm-2 control-label">Google</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="cprofile_google" name="cprofile_google" value = "<?php echo $this->cprofile_google;?>" placeholder="Google">
                      </div>
                      <label for="cprofile_youtube" class="col-sm-2 control-label">Youtube</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="cprofile_youtube" name="cprofile_youtube" value = "<?php echo $this->cprofile_youtube;?>" placeholder="Youtube">
                      </div>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->cprofile_id;?>" name = "cprofile_id"/>
                    <?php
                    if($this->cprofile_id > 0){
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
        $("#cprofile_form").validate({
                  rules:
                  {
                      cprofile_name:
                      {
                          required: true
                      },
                      cprofile_country:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      cprofile_name:
                      {
                          required: "Please enter Company Name."
                      },
                      cprofile_country:
                      {
                          required: "Please select country."
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
    <title>Company Profile Management</title>
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
            <h1>Company Profile Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Company Profile Table</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="country_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:25%'>Name</th>
                        <th style = 'width:10%'>Country</th>
                        <th style = 'width:10%'>Tel</th>
                        <th style = 'width:10%'>Fax</th>
                        <th style = 'width:10%'>Bank</th>
                        <th style = 'width:10%'>Account</th>
                        <th style = 'width:10%'>Account Code</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $sql = "SELECT cprofile.*
                              FROM db_cprofile cprofile
                              WHERE cprofile.cprofile_id > 0 ORDER BY cprofile.cprofile_name";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['cprofile_name'];?></td>
                            <td><?php echo getDataCodeBySql("country_code","db_country"," WHERE country_id = '{$row['cprofile_country']}'","");?></td>
                            <td><?php echo $row['cprofile_tel'];?></td>
                            <td><?php echo $row['cprofile_fax'];?></td>
                            <td><?php echo $row['cprofile_bank'];?></td>
                            <td><?php echo $row['cprofile_account'];?></td>
                            <td><?php echo $row['cprofile_acc_code'];?></td>
                            <td class = "text-align-right">
                                <?php
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'cprofile.php?action=edit&cprofile_id=<?php echo $row['cprofile_id'];?>'">Edit</button>
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
                        <th style = 'width:25%'>Name</th>
                        <th style = 'width:10%'>Country</th>
                        <th style = 'width:10%'>Tel</th>
                        <th style = 'width:10%'>Fax</th>
                        <th style = 'width:10%'>Bank</th>
                        <th style = 'width:10%'>Account</th>
                        <th style = 'width:10%'>Account Code</th>
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
