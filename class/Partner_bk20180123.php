<?php
/*
 * To change this tpartnerate, choose Tools | Tpartnerates
 * and open the tpartnerate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Partner {

    public function Partner(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $this->partner_login_password = md5("@#~x?\$" . $this->partner_login_password . "?\$");
//        $db_server = "localhost";
//$db_name = "honghang";
//$db_user = "root";
//$db_passwd = "";
//$connection = mysql_connect($db_server,$db_user,$db_passwd);
//$db = mysql_select_db($db_name,$connection) or die("couldn't select Database");
//
//        $sql = "SELECT * FROM supplier";
//        $query = mysql_query($sql);
//        
//        while($row = mysql_fetch_array($query)){
//          
//        $table_field = array('partner_code','partner_name','partner_issupplier',
//                             'partner_bill_address','partner_tel','partner_email','partner_status');
//        $table_value = array(escape($row['code']),escape($row['name']),1,
//                             escape($row['address']),escape($row['telephone']),escape($row['email']),1);
//        $db_server = "localhost";
//$db_name = "crm_honghang";
//$db_user = "root";
//$db_passwd = "";
//$connection = mysql_connect($db_server,$db_user,$db_passwd);
//$db = mysql_select_db($db_name,$connection) or die("couldn't select Database");
//        $this->save->SaveData($table_field,$table_value,'db_partner','partner_id',$remark);
//        $this->partner_id = $this->save->lastInsert_id;
//        if($row['contact_person'] != ""){
//            $table_field = array('contact_partner_id','contact_name','contact_tel','contact_email',
//                                 'contact_remark','contact_status');
//            $table_value = array($this->partner_id,escape($row['contact_person']),
//                                 escape($row['contact_handphone']),escape($row['contact_email']),escape($row['remark']),1);
//
//            $this->save->SaveData($table_field,$table_value,'db_contact','contact_id',$remark);
//        }
//        
//        
//        }
//        die;
        $table_field = array('partner_code','partner_name','partner_iscustomer','partner_issupplier',
                             'partner_bill_address','partner_ship_address','partner_sales_person','partner_tel',
                             'partner_fax','partner_email','partner_currency','partner_outlet',
                             'partner_remark','partner_website','partner_credit_limit','partner_industry',
                             'partner_debtor_account','partner_creditor_account','partner_seqno','partner_status',
                             'partner_tel2','partner_postal_code','partner_city',
                             'partner_house_no','partner_suburb','partner_address_type','partner_group',
                             'partner_name_cn','partner_name_thai','partner_bill_address_cn','partner_bill_address_thai',
                             'partner_issubcon','partner_issitecoordinator','partner_login_password','partner_login_id',
                             'partner_country');
        $table_value = array($this->partner_code,$this->partner_name,$this->partner_iscustomer,$this->partner_issupplier,
                             $this->partner_bill_address,$this->partner_ship_address,$this->partner_sales_person,$this->partner_tel,
                             $this->partner_fax,$this->partner_email,$this->partner_currency,$this->partner_outlet,
                             $this->partner_remark,$this->partner_website,$this->partner_credit_limit,$this->partner_industry,
                             $this->partner_debtor_account,$this->partner_creditor_account,$this->partner_seqno,$this->partner_status,
                             $this->partner_tel2,$this->partner_postal_code,$this->partner_city,
                             $this->partner_house_no,$this->partner_suburb,$this->partner_address_type,$this->partner_group,
                             $this->partner_name_cn,$this->partner_name_thai,$this->partner_bill_address_cn,$this->partner_bill_address_thai,
                             $this->partner_issubcon,$this->partner_issitecoordinator,$this->partner_login_password,$this->partner_login_id,
                             $this->partner_country);
        $remark = "Insert Partner.";
        if(!$this->save->SaveData($table_field,$table_value,'db_partner','partner_id',$remark)){
           return false;
        }else{
            $this->partner_id = $this->save->lastInsert_id;

           return true;
        }
    }
    public function update(){
        
        $new_password = $this->partner_login_password;



        if($this->partner_oldpassword != $new_password){
          $this->partner_login_password = md5("@#~x?\$" . $new_password . "?\$");
        }
        $table_field = array('partner_code','partner_name','partner_iscustomer','partner_issupplier',
                             'partner_bill_address','partner_ship_address','partner_sales_person','partner_tel',
                             'partner_fax','partner_email','partner_currency','partner_outlet',
                             'partner_remark','partner_website','partner_credit_limit','partner_industry',
                             'partner_debtor_account','partner_creditor_account','partner_seqno','partner_status',
                             'partner_tel2','partner_postal_code','partner_city',
                             'partner_house_no','partner_suburb','partner_address_type','partner_group',
                             'partner_name_cn','partner_name_thai','partner_bill_address_cn','partner_bill_address_thai',
                             'partner_issubcon','partner_issitecoordinator','partner_login_password','partner_login_id',
                             'partner_country');
        $table_value = array($this->partner_code,$this->partner_name,$this->partner_iscustomer,$this->partner_issupplier,
                             $this->partner_bill_address,$this->partner_ship_address,$this->partner_sales_person,$this->partner_tel,
                             $this->partner_fax,$this->partner_email,$this->partner_currency,$this->partner_outlet,
                             $this->partner_remark,$this->partner_website,$this->partner_credit_limit,$this->partner_industry,
                             $this->partner_debtor_account,$this->partner_creditor_account,$this->partner_seqno,$this->partner_status,
                             $this->partner_tel2,$this->partner_postal_code,$this->partner_city,
                             $this->partner_house_no,$this->partner_suburb,$this->partner_address_type,$this->partner_group,
                             $this->partner_name_cn,$this->partner_name_thai,$this->partner_bill_address_cn,$this->partner_bill_address_thai,
                             $this->partner_issubcon,$this->partner_issitecoordinator,$this->partner_login_password,$this->partner_login_id,
                             $this->partner_country);
        $remark = "Update Partner.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_partner','partner_id',$remark,$this->partner_id)){
           return false;
        }else{
           return true;
        }
    }
    public function createContact(){
        $table_field = array('contact_partner_id','contact_name','contact_tel','contact_email',
                             'contact_address','contact_remark','contact_cellphone','contact_department',
                             'contact_position','contact_jobtitle','contact_forename','contact_lastname',       
                             'contact_seqno','contact_status','contact_fax');
        $table_value = array($this->partner_id,$this->contact_name,$this->contact_tel,$this->contact_email,
                             $this->contact_address,$this->contact_remark,$this->contact_cellphone,$this->contact_department,
                             $this->contact_position,$this->contact_jobtitle,$this->contact_forename,$this->contact_lastname,   
                             $this->contact_seqno,$this->contact_status,$this->contact_fax);
        $remark = "Insert Contact.";
        if(!$this->save->SaveData($table_field,$table_value,'db_contact','contact_id',$remark)){
           return false;
        }else{
           $this->contact_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function updateContact(){
        $table_field = array('contact_partner_id','contact_name','contact_tel','contact_email',
                             'contact_address','contact_remark','contact_cellphone','contact_department',
                             'contact_position','contact_jobtitle','contact_forename','contact_lastname',       
                             'contact_seqno','contact_status','contact_fax');
        $table_value = array($this->partner_id,$this->contact_name,$this->contact_tel,$this->contact_email,
                             $this->contact_address,$this->contact_remark,$this->contact_cellphone,$this->contact_department,
                             $this->contact_position,$this->contact_jobtitle,$this->contact_forename,$this->contact_lastname,   
                             $this->contact_seqno,$this->contact_status,$this->contact_fax);
        $remark = "Update Contact.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_contact','contact_id',$remark,$this->contact_id)){
           return false;
        }else{
           return true;
        }
    }
    public function createShippingAddress(){
        $table_field = array('shipping_partner_id','shipping_address','shipping_remark','shipping_name',
                             'shipping_seqno','shipping_status');
        $table_value = array($this->partner_id,$this->shipping_address,$this->shipping_remark,$this->shipping_name,
                             $this->shipping_seqno,$this->shipping_status);
        $remark = "Insert Shipping Address.";
        if(!$this->save->SaveData($table_field,$table_value,'db_shipaddress','shipping_id',$remark)){
           return false;
        }else{
           $this->shipping_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function updateShippingAddress(){
        $table_field = array('shipping_partner_id','shipping_address','shipping_remark','shipping_name',
                             'shipping_seqno','shipping_status');
        $table_value = array($this->partner_id,$this->shipping_address,$this->shipping_remark,$this->shipping_name,
                             $this->shipping_seqno,$this->shipping_status);
        $remark = "Update Shipping Address.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_shipaddress','shipping_id',$remark,$this->shipping_id)){
           return false;
        }else{
           return true;
        }
    }
    public function pictureManagement(){
        if(!file_exists("images/partner")){
           mkdir('images/partner/');
        }
        $isimage = false;
        if($this->image_input['type'] == 'image/png' || $this->image_input['type'] == 'image/jpeg' || $this->image_input['type'] == 'image/gif'){
           $isimage = true;
        }
        if($this->image_input['size'] > 0 && $isimage == true){
            if($this->action == 'update'){
                unlink("images/partner/{$this->partner_id}.jpeg");
            }
                move_uploaded_file($this->image_input['tmp_name'],"images/partner/{$this->partner_id}.jpeg");
        }
    }
    public function fetchPartnerDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_partner WHERE partner_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->partner_id = $row['partner_id'];
            $this->partner_code = $row['partner_code'];
            $this->partner_name = $row['partner_name'];
            $this->partner_iscustomer = $row['partner_iscustomer'];
            $this->partner_issupplier = $row['partner_issupplier'];
            $this->partner_debtor_account = $row['partner_debtor_account'];
            $this->partner_creditor_account = $row['partner_creditor_account'];
            $this->partner_bill_address = $row['partner_bill_address'];
            $this->partner_ship_address = $row['partner_ship_address'];
            $this->partner_sales_person = $row['partner_sales_person'];
            $this->partner_tel = $row['partner_tel'];
            $this->partner_tel2 = $row['partner_tel2'];
            $this->partner_fax = $row['partner_fax'];
            $this->partner_email = $row['partner_email'];
            $this->partner_currency = $row['partner_currency'];
            $this->partner_outlet = $row['partner_outlet'];
            $this->partner_remark = $row['partner_remark'];
            $this->partner_website = $row['partner_website'];
            $this->partner_credit_limit = $row['partner_credit_limit'];
            $this->partner_industry = $row['partner_industry'];
            $this->partner_seqno = $row['partner_seqno'];
            $this->partner_status = $row['partner_status'];
            $this->partner_postal_code = $row['partner_postal_code'];
            $this->partner_city = $row['partner_city'];
            $this->partner_house_no = $row['partner_house_no'];
            $this->partner_suburb = $row['partner_suburb'];
            $this->partner_address_type = $row['partner_address_type'];
            $this->partner_name_cn = $row['partner_name_cn'];
            $this->partner_name_thai = $row['partner_name_thai'];
            $this->partner_bill_address_cn = $row['partner_bill_address_cn'];
            $this->partner_bill_address_thai = $row['partner_bill_address_thai'];
            $this->partner_issubcon = $row['partner_issubcon'];
            $this->partner_issitecoordinator = $row['partner_issitecoordinator'];
            $this->partner_login_password = $row['partner_login_password'];
            $this->partner_login_id = $row['partner_login_id'];
            $this->partner_country = $row['partner_country'];
        }
        return $query;
    }
    public function fetchContactDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_contact WHERE contact_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->contact_id = $row['contact_id'];
            $this->contact_name = $row['contact_name'];
            $this->contact_tel = $row['contact_tel'];
            $this->contact_email = $row['contact_email'];
            $this->contact_address = $row['contact_address'];
            $this->contact_remark = $row['contact_remark'];
            $this->contact_cellphone = $row['contact_cellphone'];
            $this->contact_department = $row['contact_department'];
            $this->contact_position = $row['contact_position'];
            $this->contact_jobtitle = $row['contact_jobtitle'];
            $this->contact_forename = $row['contact_forename'];
            $this->contact_lastname = $row['contact_lastname'];
            $this->contact_seqno = $row['contact_seqno'];
            $this->contact_status = $row['contact_status'];
            $this->contact_fax = $row['contact_fax'];
        }
        return $query;
    }
    public function fetchShippingAddress($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_shipaddress WHERE shipping_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->shipping_id = $row['shipping_id'];
            $this->shipping_partner_id = $row['shipping_partner_id'];
            $this->shipping_address = $row['shipping_address'];
            $this->shipping_remark = $row['shipping_remark'];
            $this->shipping_seqno = $row['shipping_seqno'];
            $this->shipping_status = $row['shipping_status'];
            $this->shipping_name = $row['shipping_name'];
            $this->partner_name = getDataCodeBySql("partner_name",'db_partner'," WHERE partner_id = '{$row['shipping_partner_id']}'", $orderby);
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_partner"," WHERE partner_id = '$this->partner_id'","Delete Partner.")){
            return true;
        }else{
            return false;
        }
    }
    public function deleteContact(){
        if($this->save->DeleteData("db_contact"," WHERE contact_id = '$this->contact_id'","Delete Contact.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->partner_seqno = 10;
            $this->partner_status = 1;
        }

        $this->countryCrtl = $this->select->getCountrySelectCtrl($this->partner_country);
        $this->currencyCrtl = $this->select->getCurrencySelectCtrl($this->partner_currency,'N');
        $this->debtorCrtl = $this->select->getAccountSelectCtrl($this->partner_debtor_account,'N');
        $this->creditorCrtl = $this->select->getAccountSelectCtrl($this->partner_creditor_account,'N');
        $this->employeeCrtl = $this->select->getEmployeeSelectCtrl($this->partner_sales_person,'N');
        $this->industryCrtl = $this->select->getIndustrySelectCtrl($this->partner_industry,'N');
        $this->addresstypeCrtl = $this->select->getAddressTypeSelectCtrl($this->partner_address_type,'N');
        
        $label_col_sm = "col-sm-2";
        $field_col_sm = "col-sm-3";
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->label_name;?> Management</title>
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
            <h1><?php echo $this->label_name;?> Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->partner_id > 0){ echo "Update $this->label_name";}else{ echo "Create New $this->label_name";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='partner.php?type=<?php echo $this->type;?>'">Back</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='partner.php?action=createForm&type=<?php echo $this->type;?>'">Create New</button> 
                <?php }?>
                <?php   $next_id = $this->fetchNextPartnerID($this->partner_id);
                        if(isset($next_id["partner_id"]) && $next_id["partner_id"]>0){
                ?>            
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='partner.php?action=edit&current_tab=<?php echo $this->current_tab;?>&partner_id=<?php echo $next_id["partner_id"];?>&type=<?php echo $this->type;?>'">Next Customer</button> 
                <?php
                        }
                        $prev_id = $this->fetchPrevPartnerID($this->partner_id);
                        if(isset($prev_id["partner_id"]) && $prev_id["partner_id"]>0){
                ?>            
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='partner.php?action=edit&current_tab=<?php echo $this->current_tab;?>&partner_id=<?php echo $prev_id["partner_id"];?>&type=<?php echo $this->type;?>'">Prev Customer</button> 
                <?php            
                        }   
                ?>
              </div>
                
                <form id = 'partner_form' class="form-horizontal" action = 'partner.php?action=create' method = "POST">
                    <input type ='hidden' name = 'current_tab' id = 'current_tab' value = "<?php echo $this->current_tab?>"/>
                  <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li class="<?php if($this->current_tab == ""){ echo 'active';}?>"><a href="#general" data-toggle="tab">General</a></li>
                          <!--<li tab = "Account" class="tab_header <?php if($this->current_tab == "Account"){ echo 'active';}?>"><a href="#account" data-toggle="tab">Account</a></li>-->
                          <!--<li tab = "Address" class="tab_header <?php if($this->current_tab == "Address"){ echo 'active';}?>"><a href="#address" data-toggle="tab">Address</a></li>-->
                          <?php if($this->partner_id > 0){ ?>
                          <!--<li tab = "Material" class="tab_header <?php if($this->current_tab == "Material"){ echo 'active';}?>"><a href="#material" data-toggle="tab">Material</a></li>-->
                          <?php if($this->type == 'subcon'){?>
                          <li tab = "Labour" class="tab_header <?php if($this->current_tab == "Labour"){ echo 'active';}?>"><a href="#labour" data-toggle="tab">Labour</a></li>
                          <li tab = "worker_info" class="tab_header <?php if($this->current_tab == "worker_info"){ echo 'active';}?>"><a href="#worker_info" data-toggle="tab">Worker Info</a></li>
                           <?php }?>
                          <?php if($this->type == 'customer'){?>
                          <li tab = "qt_history" class="tab_header <?php if($this->current_tab == "qt_history"){ echo 'active';}?>"><a href="#qt_history" data-toggle="tab">Quotation History</a></li>
                          <li tab = "iv_history" class="tab_header <?php if($this->current_tab == "iv_history"){ echo 'active';}?>"><a href="#iv_history" data-toggle="tab">Sales Invoice History</a></li>
                          <li tab = "do_history" class="tab_header <?php if($this->current_tab == "do_history"){ echo 'active';}?>"><a href="#do_history" data-toggle="tab">Delivery Order History</a></li>
                          <?php }?>
                          <?php if($this->type == 'supplier'){?>
                          <li tab = "po_history" class="tab_header <?php if($this->current_tab == "po_history"){ echo 'active';}?>"><a href="#po_history" data-toggle="tab">Purchase Order History</a></li>
                          <?php }?>
<!--                          <li tab = "so_history" class="tab_header <?php if($this->current_tab == "so_history"){ echo 'active';}?>"><a href="#so_history" data-toggle="tab">Sales Order History</a></li>
                          <li tab = "do_history" class="tab_header <?php if($this->current_tab == "do_history"){ echo 'active';}?>"><a href="#do_history" data-toggle="tab">Delivery Order History</a></li>
                          <li tab = "iv_history" class="tab_header <?php if($this->current_tab == "iv_history"){ echo 'active';}?>"><a href="#iv_history" data-toggle="tab">Sales Invoice History</a></li>-->
                          <?php }?>
                        </ul>
                <div class="tab-content">
                  <div class="<?php if($this->current_tab == ""){ echo 'active';}?> tab-pane" id="general">
                        <div class="form-group">
                          <label for="partner_code" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->label_name;?> Code <?php echo $mandatory;?></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="partner_code" name="partner_code" value = "<?php echo $this->partner_code;?>" placeholder="Partner Code">
                          </div>
                          <label for="partner_name" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->label_name;?> Name<?php echo $mandatory;?></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="partner_name" name="partner_name" value = "<?php echo $this->partner_name;?>" placeholder="Partner Name">
                          </div>
                        </div>  
                        <div class="form-group">
                          <label for="partner_tel" class="<?php echo $label_col_sm;?> control-label">Telephone</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="partner_tel" name="partner_tel" value = "<?php echo $this->partner_tel;?>" placeholder="Tel">
                          </div>
                          <label for="partner_email" class="<?php echo $label_col_sm;?> control-label">Email</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="partner_email" name="partner_email" value = "<?php echo $this->partner_email;?>" placeholder="Email">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="partner_tel2" class="<?php echo $label_col_sm;?> control-label">Warehouse</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="partner_tel2" name="partner_tel2" value = "<?php echo $this->partner_tel2;?>" placeholder="Warehouse">
                          </div>
                          <label for="partner_fax" class="<?php echo $label_col_sm;?> control-label">Fax</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="partner_fax" name="partner_fax" value = "<?php echo $this->partner_fax;?>" placeholder="Fax">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="partner_suburb" class="<?php echo $label_col_sm;?> control-label">Sales Person</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="partner_suburb" name="partner_suburb" value = "<?php echo $this->partner_suburb;?>" placeholder="Suburb">
                          </div>
                            <label for="partner_status" class="<?php echo $label_col_sm;?> control-label">Status</label>
                            <div class="col-sm-3">
                                 <select class="form-control select2" id="partner_status" name="partner_status" style = 'width:100%'>
                                   <option value = '1' <?php if($this->partner_status == 1){ echo 'SELECTED';}?>>Active</option>
                                   <option value = '0' <?php if($this->partner_status == 0){ echo 'SELECTED';}?>>In-active</option>
                                 </select>
                            </div>
                        </div>
                      <div class="form-group">
                            <label for="partner_country" class="<?php echo $label_col_sm;?> control-label">Country</label>
                            <div class="col-sm-3">
                                 <select class="form-control select2" id="partner_country" name="partner_country" style = 'width:100%'>
                                   <?php echo $this->countryCrtl;?>
                                 </select>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="partner_bill_address" class="<?php echo $label_col_sm;?> control-label"> Address</label>
                          <div class="col-sm-3">
                                <textarea class="form-control" rows="3" id="partner_bill_address" name="partner_bill_address" placeholder="Billing Address"><?php echo $this->partner_bill_address;?></textarea>
                          </div>
                          <label for="partner_remark" class="<?php echo $label_col_sm;?> control-label">Remark</label>
                          <div class="col-sm-3">
                                <textarea class="form-control" rows="3" id="partner_remark" name="partner_remark" placeholder="Remark"><?php echo $this->partner_remark;?></textarea>
                          </div>
                        </div>

                      <?php if(($this->type == 'sitecoordinator') || ($this->type == 'subcon')){?>
                        <h4>Accounts</h4>

                        <div class="form-group">
                              <label for="empl_login_email" class="col-sm-2 control-label">Login ID <?php echo $mandatory;?></label>
                              <div class="col-sm-3">
                                <input type="text" class="form-control" class="form-control" name = 'partner_login_id' id = 'partner_login_id' value = "<?php echo $this->partner_login_id;?>"  >
                              </div>
                        </div>
                        <div class="form-group">
                              <label for="partner_login_password" class="col-sm-2 control-label" >Password <?php echo $mandatory;?></label>
                              <div class="col-sm-3">
                                <input type="password" class="form-control" id="partner_login_password" name="partner_login_password" value = "<?php echo $this->partner_login_password;?>" placeholder="Password">
                              </div>
                        </div>
                        <div class="form-group">
                              <label for="partner_login_password_cm" class="col-sm-2 control-label" >Confirm Password <?php echo $mandatory;?></label>
                              <div class="col-sm-3">
                                <input type="password" class="form-control" id="partner_login_password_cm" name="partner_login_password_cm" value = "<?php echo $this->partner_login_password;?>" placeholder="Confirm Password">
                              </div>
                        </div>
                      <?php }?>
                  </div><!-- /.general -->
                   <div class=" tab-pane <?php if($this->current_tab == "Account"){ echo 'active';}?>" id="account">
                        <div class="form-group">
                          <label for="partner_iscustomer" class="<?php echo $label_col_sm;?> control-label">Is Customer</label>
                          <div class="col-sm-1">                       
                            <input type="checkbox" class="minimal" id = 'partner_iscustomer' name = 'partner_iscustomer' value = '1' <?php if($this->partner_iscustomer == 1){ echo 'CHECKED';}?>>
                          </div>
                          <label for="partner_issupplier" class="<?php echo $label_col_sm;?> control-label">Is Supplier</label>
                          <div class="col-sm-1">                       
                            <input type="checkbox" class="minimal" id = 'partner_issupplier' name = 'partner_issupplier' value = '1' <?php if($this->partner_issupplier == 1){ echo 'CHECKED';}?>>
                          </div>
                          <label for="partner_issubcon" class="<?php echo $label_col_sm;?> control-label">Is Sub-Con</label>
                          <div class="col-sm-1">                       
                            <input type="checkbox" class="minimal" id = 'partner_issubcon' name = 'partner_issubcon' value = '1' <?php if($this->partner_issubcon == 1){ echo 'CHECKED';}?>>
                          </div>
                          <label for="partner_issitecoordinator" class="<?php echo $label_col_sm;?> control-label">Is Site Coordinator</label>
                          <div class="col-sm-1">                       
                            <input type="checkbox" class="minimal" id = 'partner_issitecoordinator' name = 'partner_issitecoordinator' value = '1' <?php if($this->partner_issitecoordinator == 1){ echo 'CHECKED';}?>>
                          </div>
                        </div>
<!--                        <div class="form-group">
                          <label for="partner_debtor_account" class="<?php echo $label_col_sm;?> control-label">Debtor Account</label>
                          <div class="col-sm-3">
                               <select class="form-control select2" id="partner_debtor_account" name="partner_debtor_account">
                                   <?php echo $this->debtorCrtl;?>
                               </select>
                          </div>
                          <label for="partner_creditor_account" class="<?php echo $label_col_sm;?> control-label">Creditor Account</label>
                          <div class="col-sm-3">
                               <select class="form-control select2" id="partner_creditor_account" name="partner_creditor_account">
                                   <?php echo $this->creditorCrtl;?>
                               </select>
                          </div>
                        </div>-->
                  </div>
                  <div class=" tab-pane <?php if($this->current_tab == "Address"){ echo 'active';}?>" id="address">
                        <div class="form-group">

                          <label for="partner_website" class="<?php echo $label_col_sm;?> control-label">Web Site</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="partner_website" name="partner_website" value = "<?php echo $this->partner_website;?>" placeholder="Web Site">
                          </div>

                        </div>
                        <div class="form-group">
                          <label for="partner_house_no" class="<?php echo $label_col_sm;?> control-label">House Tel</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="partner_house_no" name="partner_house_no" value = "<?php echo $this->partner_house_no;?>" placeholder="House Tel">
                          </div>
                          <label for="partner_address_type" class="<?php echo $label_col_sm;?> control-label">Address type</label>
                          <div class="col-sm-3">
                            <select class="form-control select2" id="partner_address_type" name="partner_address_type" style = 'width:100%'>
                                   <?php echo $this->addresstypeCrtl;?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="partner_postal_code" class="<?php echo $label_col_sm;?> control-label">Postal Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="partner_postal_code" name="partner_postal_code" value = "<?php echo $this->partner_postal_code;?>" placeholder="Postal Code">
                          </div>
                          <label for="partner_city" class="<?php echo $label_col_sm;?> control-label">City</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="partner_city" name="partner_city" value = "<?php echo $this->partner_city;?>" placeholder="City">
                          </div>
                        </div>
                        <div class="form-group">

                        </div>
<!--                        <div class="form-group">
                          <label for="partner_bill_address" class="<?php echo $label_col_sm;?> control-label">Billing Address</label>
                          <div class="col-sm-3">
                                <textarea class="form-control" rows="3" id="partner_bill_address" name="partner_bill_address" placeholder="Billing Address"><?php echo $this->partner_bill_address;?></textarea>
                          </div>
                          <label for="partner_ship_address" class="<?php echo $label_col_sm;?> control-label">Shipping Address</label>
                          <div class="col-sm-3">
                                <textarea class="form-control" rows="3" id="partner_ship_address" name="partner_ship_address" placeholder="Shipping Address"><?php echo $this->partner_ship_address;?></textarea>
                          </div>
                        </div>-->
                  </div><!-- /.address -->
                  <div class="<?php if($this->current_tab == "Material"){ echo 'active';}?> tab-pane" id="material">
                        <?php $this->getMaterial();?>
                  </div><!-- /.material -->
                  <div class="<?php if($this->current_tab == "Labour"){ echo 'active';}?> tab-pane" id="labour">
                        <?php $this->getLabour();?>
                  </div><!-- /.labour -->
                  <div class="<?php if($this->current_tab == "worker_info"){ echo 'active';}?> tab-pane" id="worker_info">
                        <?php $this->getWorkerInfo();?>
                  </div><!-- /.labour -->
                  <div class="<?php if($this->current_tab == "qt_history"){ echo 'active';}?> tab-pane" id="qt_history">
                        <?php $this->orderHistoryTable("QT");?>
                  </div><!-- /.quotation history -->
                  <div class="<?php if($this->current_tab == "po_history"){ echo 'active';}?> tab-pane" id="po_history">
                        <?php $this->orderHistoryTable("PO");?>
                  </div><!-- /.purchase order history -->
                  <div class="<?php if($this->current_tab == "so_history"){ echo 'active';}?> tab-pane" id="so_history">
                        <?php $this->orderHistoryTable("SO");?>
                  </div><!-- /.sales order history -->
                  <div class="<?php if($this->current_tab == "do_history"){ echo 'active';}?> tab-pane" id="do_history">
                        <?php $this->orderHistoryTable("DO");?>
                  </div><!-- /.delivery order history -->
                  <div class="<?php if($this->current_tab == "iv_history"){ echo 'active';}?> tab-pane" id="iv_history">
                        <?php $this->invoiceHistoryTable("SI");?>
                  </div><!-- /.invoice history -->
                </div><!-- /.tab-content -->
              </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer" style = 'clear:both'>
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->partner_id;?>" name = "partner_id" id = "partner_id"/>
                    <input type ="hidden" value = "<?php echo $this->type;?>" name = "type" />
                    <?php
                    if($this->partner_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                    ?>
                    <button type = "submit" class="btn btn-info">Save</button>
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
<div class="modal fade" id="WorkerModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Worker Info</h4>
        </div>
        <div class="modal-body">
            <form id = 'worker_form' class="form-horizontal">
                <div class="col-sm-12">
                    <div class="form-group">
                      <label for="pempl_name" class="col-sm-3 control-label">Name</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control " id="pempl_name" name="pempl_name" value = "<?php echo $this->pempl_name;?>" placeholder="Name">
                      </div>
                    </div>
                    <div style = 'clear:both' ></div>
                    <div class="form-group">
                      <label for="pempl_nric" class="col-sm-3 control-label">NRIC / FIN</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control " id="pempl_nric" name="pempl_nric" value = "<?php echo $this->pempl_nric;?>" placeholder="NRIC / FIN">
                      </div>
                    </div>
                    <div style = 'clear:both' ></div>
                    <div class="form-group">
                      <label for="pempl_wpno" class="col-sm-3 control-label">Permit No.</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control " id="pempl_wpno" name="pempl_wpno" value = "<?php echo $this->pempl_wpno;?>" placeholder="Work Permit No.">
                      </div>
                    </div>
                    <div style = 'clear:both' ></div>
                    <div class="form-group">
                      <label for="pempl_issuedate" class="col-sm-3 control-label">Permit Issue Date</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control datepicker" id="pempl_issuedate" name="pempl_issuedate" value = "<?php echo $this->pempl_issuedate;?>" placeholder="Work Issue Date">
                      </div>
                    </div>
                    <div style = 'clear:both' ></div>
                    <div class="form-group">
                      <label for="pempl_expirydate" class="col-sm-3 control-label">Permit Expiry Date</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control datepicker" id="pempl_expirydate" name="pempl_expirydate" value = "<?php echo $this->pempl_expirydate;?>" placeholder="Work Expiry Date">
                      </div>
                    </div>
                    <div style = 'clear:both' ></div>
                    <div class="form-group">
                      <label for="pempl_passport" class="col-sm-3 control-label">Passport No.</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control " id="pempl_passport" name="pempl_passport" value = "<?php echo $this->pempl_passport;?>" placeholder="Passport No.">
                      </div>
                    </div>
                    <div style = 'clear:both' ></div>
                    <div class="form-group">
                      <label for="pempl_passportissuedate" class="col-sm-3 control-label">Passport Issue Date</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control datepicker" id="pempl_passportissuedate" name="pempl_passportissuedate" value = "<?php echo $this->pempl_passportissuedate;?>" placeholder="Passport Issue Date">
                      </div>
                    </div>
                    <div style = 'clear:both' ></div>
                    <div class="form-group">
                      <label for="pempl_passportexpirydate" class="col-sm-3 control-label">Passport Expiry Date</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control datepicker" id="pempl_passportexpirydate" name="pempl_passportexpirydate" value = "<?php echo $this->pempl_passportexpirydate;?>" placeholder="Passport Expiry Date">
                      </div>
                    </div>
                    <div style = 'clear:both' ></div>
                    <div class="form-group">
                      <label for="pempl_position" class="col-sm-3 control-label">Position</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control " id="pempl_position" name="pempl_position" value = "<?php echo $this->pempl_position;?>" placeholder="Position">
                      </div>
                    </div>
                </div>
                <input type = 'hidden' name = 'pempl_id' id = 'pempl_id' value = '0'/>
            </form>
            <div style = 'clear:both' ></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id = 'add_worker' >Add Worker</button>
          <button type="submit" class="btn btn-primary" id = 'add_worker_new' >Add Worker & New</button>
        </div>
      </div>
      
    </div>
  </div>
    <script>
    $(document).ready(function() {
        
        $('#partner_code').keyup(function(){
            $('#partner_login_id').val($(this).val());
        });
        <?php if($_REQUEST['isnew'] == 1){?>
               $('#WorkerModal').modal('show');
        <?php }?>        
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        $('.tab_header').click(function(){
            $('#current_tab').val($(this).attr('tab'));
        });
        $('#addnewworker').click(function(){
           $('#add_worker_new').css('display',''); 
           $('#WorkerModal').modal('show');
           $('#p_empl_name').focus();
        });
        $('.delete_line').on('click',function(){
            deleteline($(this).attr('pempl_id'));
        });
        $("#partner_form").validate({
                  rules: 
                  {
//                      partner_code:
//                      {
//                          required: true,
//                          remote: {
//                                  url: "partner.php?action=validate_partner",
//                                  type: "post",
//                                  data: 
//                                        {
//                                            partner_id: function()
//                                            {
//                                                return $("#partner_id").val();
//                                            }
//                                        }
//                              }
//                      },
                      partner_account_name1:
                      {
                          required: true,        
                      }
                  },
                  messages:
                  {
//                      partner_code:
//                      {
//                          required: "Please enter Partner Account Code.",
//                          remote: "Partner Account Code duplicate."
//                      }
                  }
              });
    $('.edit_line_worker').on('click',function(){
        $('#add_worker_new').css('display','none');
        var data = "action=fetch_worker&partner_id=<?php echo $this->partner_id;?>&pempl_id="+$(this).attr('pempl_id');
        $.ajax({ 
            type: 'POST',
            url: 'partner.php',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("System Error.");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                    $('#pempl_id').val(jsonObj.pempl_id);
                    $('#pempl_name').val(jsonObj.pempl_name);
                    $('#pempl_nric').val(jsonObj.pempl_nric);
                    $('#pempl_wpno').val(jsonObj.pempl_wpno);
                    $('#pempl_issuedate').val(jsonObj.pempl_issuedate);
                    $('#pempl_expirydate').val(jsonObj.pempl_expirydate);
                    $('#pempl_passport').val(jsonObj.pempl_passport);
                    $('#pempl_passportissuedate').val(jsonObj.pempl_passportissuedate);
                    $('#pempl_passportexpirydate').val(jsonObj.pempl_passportexpirydate);
                    $('#pempl_position').val(jsonObj.pempl_position);
                    
                    $('#add_worker').text("Update Worker");
                    $('#WorkerModal').modal('show');
               }else{
                   alert("Fail to fetch data.");
               }
               issend = false;
            }		
         });
         return false;
    });
    $('#add_worker,#add_worker_new').click(function(){
        if($(this).attr('id') == 'add_worker_new'){
           var isnew = 1;
        }else{
           var isnew = 0;
        }
        var data = "action=add_worker&type=<?php echo $this->type;?>&partner_id=<?php echo $this->partner_id;?>&"+$('#worker_form').serialize()+"&total_line_material="+$('#total_line_material').val()+"&current_tab=worker_info";
        $.ajax({ 
            type: 'POST',
            url: 'partner.php',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("System Error.");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   window.location.href = 'partner.php?action=edit&type=<?php echo $this->type;?>&current_tab=worker_info&partner_id=<?php echo $this->partner_id;?>&isnew='+isnew;
//                   $('#material_lasttr').before(jsonObj.line);
//                   $('#total_line_material').val(parseFloat($('#total_line_material').val())+1);
               }else{
                   alert("Fail to delete line.");
               }
               issend = false;
            }		
         });
         return false;
    });
});
    function deleteline(pempl_id){
        var data = "action=deleteline&partner_id=<?php echo $this->partner_id;?>&pempl_id="+pempl_id;
        $.ajax({ 
            type: 'POST',
            url: 'partner.php',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("System Error.");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                    window.location.href = 'partner.php?action=edit&current_tab=worker_info&partner_id=<?php echo $this->partner_id;?>';
               }else{
                   alert("Fail to delete line.");
               }
               issend = false;
            }		
         });
         return false;
    }
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
    <title><?php echo $this->label_name;?> Management</title>
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
            <h1><?php echo $this->label_name;?> Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $this->label_name;?> Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='partner.php?action=createForm&type=<?php echo $this->type;?>'">Create New + </button>
                <?php }?>
                <!--<button style = 'margin-right:10px;' class="btn btn-primary pull-right import_btn" data-toggle="modal" data-target="#myModal">Import + </button>-->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="partner_table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th style = 'width:10%'>Code</th>
                        <th style = 'width:15%'>Name</th>
                        <th style = 'width:10%'>Telephone</th>
                        <th style = 'width:30%' >Address</th>
                        <?php 
                        if($_REQUEST['type'] == 'subcon'){
                        ?>
                        <th style = 'width:10%' >Total Workers</th>
                        <?php
                        }
                        ?>
                        <th style = 'width:15%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT partner.*,cy.currency_code,country.country_code 
                              FROM db_partner partner 
                              INNER JOIN db_currency cy ON cy.currency_id = partner.partner_currency
                              INNER JOIN db_country country ON country.country_id = partner.partner_outlet
                              WHERE partner.partner_id > 0 ORDER BY partner.partner_code";
//                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        
                    <?php    
                        $i++;
                      }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Telephone</th>
                        <th>Address</th>
                        <?php 
                        if($_REQUEST['type'] == 'subcon'){
                        ?>
                        <th style = 'width:10%' >Total Workers</th>
                        <?php
                        }
                        ?>
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
    <script type="text/javascript" src="http://www.sanwebe.com/assets/public/js/jquery.form.min.js"></script>
    <script>
 jQuery.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw )
{
    // DataTables 1.10 compatibility - if 1.10 then `versionCheck` exists.
    // 1.10's API has ajax reloading built in, so we use those abilities
    // directly.
    if ( jQuery.fn.dataTable.versionCheck ) {
        var api = new jQuery.fn.dataTable.Api( oSettings );
 
        if ( sNewSource ) {
            api.ajax.url( sNewSource ).load( fnCallback, !bStandingRedraw );
        }
        else {
            api.ajax.reload( fnCallback, !bStandingRedraw );
        }
        return;
    }
 
    if ( sNewSource !== undefined && sNewSource !== null ) {
        oSettings.sAjaxSource = sNewSource;
    }
 
    // Server-side processing should just call fnDraw
    if ( oSettings.oFeatures.bServerSide ) {
        this.fnDraw();
        return;
    }
 
    this.oApi._fnProcessingDisplay( oSettings, true );
    var that = this;
    var iStart = oSettings._iDisplayStart;
    var aData = [];
 
    this.oApi._fnServerParams( oSettings, aData );
 
    oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aData, function(json) {
        /* Clear the old information from the table */
        that.oApi._fnClearTable( oSettings );
 
        /* Got the data - add it to the table */
        var aData =  (oSettings.sAjaxDataProp !== "") ?
            that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )( json ) : json;
 
        for ( var i=0 ; i<aData.length ; i++ )
        {
            that.oApi._fnAddData( oSettings, aData[i] );
        }
 
        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
 
        that.fnDraw();
 
        if ( bStandingRedraw === true )
        {
            oSettings._iDisplayStart = iStart;
            that.oApi._fnCalculateEnd( oSettings );
            that.fnDraw( false );
        }
 
        that.oApi._fnProcessingDisplay( oSettings, false );
 
        /* Callback user function - for event handlers etc */
        if ( typeof fnCallback == 'function' && fnCallback !== null )
        {
            fnCallback( oSettings );
        }
    }, oSettings );
};
      $(function () {
        var partner_table = $('#partner_table').DataTable({
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "partner.php?action=getDataTable&type=<?php echo $this->type;?>",  
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "iDisplayLength": 25,
                "aoColumns": [
                      null,
                      null,
                      null,
                      null, 
                      <?php 
                        if($_REQUEST['type'] == 'subcon'){
                      ?>
                      {"sClass": "text-align-center" },
                      <?php
                        }
                      ?>
                      {"sClass": "text-align-right" }
                  ]
        });

           $('#uploadForm').submit(function(e) {
               if($('#import_action').val() == ""){
                   alert('Please Select Import Type.');
                   $('#import_action').focus();
                   return false;
               }
                if($('#import_file').val()){
                    e.preventDefault();
                    $('#loader-icon').show();
                    $(this).ajaxSubmit({ 
                        target:   '#targetLayer', 
                        beforeSubmit: function() {
                            $("#targetLayer").html("<img style = 'width:100px;' src = 'dist/img/LoaderIcon.gif'/>");
                            $(".import_btn").val("Importing.......");
//                            $(".import_btn").attr("disabled",true);
                        },
                        success:function (data){
                            jsonObj = eval('('+ data +')');
                            if(jsonObj.status == 1){
                                $("#targetLayer").html("<font color = 'green'><b>Import Success. &nbsp;&nbsp;&nbsp;" + jsonObj.data + " rows effect.</b></font>");
                                partner_table.ajax.url("partner.php?action=getDataTable");
                                partner_table.draw();
                            }else{
                                $("#targetLayer").html("<font color = 'red'><b>Import Fail.</b></font>");
                            }
                            $(".import_btn").val("Import");
//                            $(".import_btn").attr("disabled",false);
                        },
                        resetForm: true 
                    }); 
                    return false; 
                }
            });
      });
     
    </script>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Import Product</h4>
            </div>
                <div id="bar_blank">
   <div id="bar_color"></div>
  </div>
              <div id="status"></div>
            <form id = 'uploadForm' action = 'partner.php' method = "POST" >  
                <div class="modal-body">
                    <b>Import Type</b>
                    <select name = 'import_action' id = 'import_action' class = 'form-control'>
                        <option value = ''>Select One</option>
                        <option value = 'Customer'>Customer</option>
                        <option value = 'Contact'>Contact</option>
                    </select>
                    <br>
                    <input type = "file" name = 'import_file' id = 'import_file' style = 'display:inline;'/>
                    
                    <input type = 'hidden' value ='import'  name = 'action' style = 'display:inline;'/>

                    <div id="targetLayer" style = 'display:inline;'></div>
                    <br>Xls,Csv file only.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type = 'submit' class="btn btn-primary pull-right import_btn" value ='Import' />
                </div>
            </form>
          </div>

        </div>
    </div>
  </body>
</html>
    <?php
    }
    public function getContact(){
        global $mandatory;
        if($this->contact_id <= 0){
            $this->contact_seqno = 10;
            $this->contact_status = 1;
            $action = "create_contact";
        }else{
            $action = "update_contact";
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->label_name;?> Management</title>
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
            <h1><?php echo $this->label_name;?> Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->contact_id > 0){ echo "Update Contact Person";}else{ echo "Create New Contact Person";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='partner.php?type=<?php echo $this->type;?>'">Back</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='partner.php?action=contact&partner_id=<?php echo $this->partner_id;?>&type=<?php echo $this->type;?>'">Create New Contact</button>
                <?php }?>
              </div>
                
                <form id = 'contact_form' class="form-horizontal" action = 'partner.php?action=create_contact' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="contact_tel" class="col-sm-1 control-label"><?php echo $this->label_name;?> Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" value = "<?php echo $this->partner_code;?>"  disabled>
                          </div>
                          <label for="contact_email" class="col-sm-1 control-label"><?php echo $this->label_name;?> Name</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" value = "<?php echo $this->partner_name;?>"  disabled>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="contact_name" class="col-sm-1 control-label">Name <?php echo $mandatory;?></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="contact_name" name="contact_name" value = "<?php echo $this->contact_name;?>" placeholder="Contact Name">
                          </div>
                          <label for="contact_fax" class="col-sm-1 control-label">Fax</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="contact_fax" name="contact_fax" value = "<?php echo $this->contact_fax;?>" placeholder="Contact Fax">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="contact_tel" class="col-sm-1 control-label">Tel</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="contact_tel" name="contact_tel" value = "<?php echo $this->contact_tel;?>" placeholder="Contact Tel">
                          </div>
                          <label for="contact_email" class="col-sm-1 control-label">Email</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="contact_email" name="contact_email" value = "<?php echo $this->contact_email;?>" placeholder="Contact Email">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="contact_seqno" class="col-sm-1 control-label">Seq No</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="contact_seqno" name="contact_seqno" value = "<?php echo $this->contact_seqno;?>" placeholder="Contact Seq No">
                          </div>
                          <label for="contact_status" class="col-sm-1 control-label">Status</label>
                          <div class="col-sm-3">
                               <select class="form-control select2" id="contact_status" name="contact_status">
                                 <option value = '1' <?php if($this->contact_status == 1){ echo 'SELECTED';}?>>Active</option>
                                 <option value = '0' <?php if($this->contact_status == 0){ echo 'SELECTED';}?>>In-active</option>
                               </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="contact_address" class="col-sm-1 control-label">Address</label>
                          <div class="col-sm-3">
                                <textarea class="form-control" rows="3" id="contact_address" name="contact_address" placeholder="Contact Address"><?php echo $this->contact_address;?></textarea>
                          </div>
                          <label for="contact_remark" class="col-sm-1 control-label">Remark</label>
                          <div class="col-sm-3">
                                <textarea class="form-control" rows="3" id="contact_remark" name="contact_remark" placeholder="Contact Remark"><?php echo $this->contact_remark;?></textarea>
                          </div>
                        </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->contact_id;?>" name = "contact_id" id = "contact_id"/>
                    <input type = "hidden" value = "<?php echo $this->partner_id;?>" name = "partner_id" id = "partner_id"/>
                    <input type ="hidden" value = "<?php echo $this->type;?>" name = "type" />
                    <?php
                    if($this->partner_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                    ?>
                    <button type = "submit" class="btn btn-info">Save</button>
                    <?php }?>
                  </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
          </section><!-- /.content -->
          
          <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Contact Person Table</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="partner_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:3%'>No</th>
                        <th style = 'width:15%'>Name</th>
                        <th style = 'width:10%'>Tel</th>
                        <th style = 'width:15%'>Email</th>
                        <th style = 'width:15%'>Address</th>
                        <th style = 'width:15%'>Remark</th>
                        <th style = 'width:10%'>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT contact.*
                              FROM db_contact contact 
                              WHERE contact.contact_partner_id = '$this->partner_id' AND contact.contact_status = '1'";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['contact_name'];?></td>
                            <td><?php echo $row['contact_tel'];?></td>
                            <td><?php echo $row['contact_email'];?></td>
                            <td><?php echo nl2br($row['contact_address']);?></td>
                            <td><?php echo nl2br($row['contact_remark']);?></td>
                            <td><?php if($row['contact_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'partner.php?action=edit_contact&partner_id=<?php echo $this->partner_id;?>&contact_id=<?php echo $row['contact_id'];?>&type=<?php echo $this->type;?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('partner.php?action=delete_contact&partner_id=<?php echo $this->partner_id;?>&contact_id=<?php echo $row['contact_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th>Name</th>
                        <th>Tel</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Remark</th>
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
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    
    ?>
    <script>
    $(document).ready(function() {
        $('#partner_table').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "iDisplayLength": 50
        });
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        $("#contact_form").validate({
                  rules: 
                  {
                      contact_name:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      contact_name:
                      {
                          required: "Please enter Contact Name."
                      }
                  }
              });
    
    
});
    </script>
  </body>
</html>
        <?php
        
    }
    public function getShippingAddress(){
        global $mandatory;
        if($this->shipping_id <= 0){
            $this->shipping_seqno = 10;
            $this->shipping_status = 1;
            $action = "create_shipping";
        }else{
            $action = "update_shipping";
        }

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->label_name;?> Management</title>
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
            <h1><?php echo $this->label_name;?> Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->contact_id > 0){ echo "Update Shipping Address";}else{ echo "Create New Shipping Address";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='partner.php?type=<?php echo $_REQUEST['type'];?>'">Back</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='partner.php?action=createForm&type=<?php echo $_REQUEST['type'];?>'">Create New Partner</button>
                <button type = "button" class="btn btn-primary btn-warning pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='partner.php?action=contact&partner_id=<?php echo $this->partner_id;?>&type=<?php echo $_REQUEST['type'];?>'">Create New Contact</button>
                <button type = "button" class="btn  bg-purple pull-right" style = 'margin-right:10px;' onclick = "window.location.href='partner.php?action=shipping_address&partner_id=<?php echo $this->partner_id;?>&type=<?php echo $_REQUEST['type'];?>'">Create New Shipping Address</button>
                <?php }?>
              </div>
                
                <form id = 'contact_form' class="form-horizontal" action = 'partner.php?action=create_contact' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="partner_code" class="col-sm-1 control-label"><?php echo $this->label_name;?> Code</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" value = "<?php echo $this->partner_code;?>"  disabled>
                          </div>
                          <label for="partner_name" class="col-sm-1 control-label"><?php echo $this->label_name;?> Name</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" value = "<?php echo $this->partner_name;?>"  disabled>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="shipping_name" class="col-sm-1 control-label">Shipping Name</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="shipping_name" name="shipping_name" value = "<?php echo $this->shipping_name;?>"  >
                          </div>

                        </div>
                        <div class="form-group">
                          <label for="shipping_seqno" class="col-sm-1 control-label">Seq No</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="shipping_seqno" name="shipping_seqno" value = "<?php echo $this->shipping_seqno;?>" placeholder="Shipping Seq No">
                          </div>
                          <label for="shipping_status" class="col-sm-1 control-label">Status</label>
                          <div class="col-sm-3">
                               <select class="form-control select2" id="contact_status" name="shipping_status">
                                 <option value = '1' <?php if($this->shipping_status == 1){ echo 'SELECTED';}?>>Active</option>
                                 <option value = '0' <?php if($this->shipping_status == 0){ echo 'SELECTED';}?>>In-active</option>
                               </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="shipping_address" class="col-sm-1 control-label">Shipping Address</label>
                          <div class="col-sm-3">
                                <textarea class="form-control" rows="3" id="contact_address" name="shipping_address" placeholder="Shipping Address"><?php echo $this->shipping_address;?></textarea>
                          </div>
                          <label for="shipping_remark" class="col-sm-1 control-label">Remark</label>
                          <div class="col-sm-3">
                                <textarea class="form-control" rows="3" id="contact_remark" name="shipping_remark" placeholder="Shipping Remark"><?php echo $this->shipping_remark;?></textarea>
                          </div>
                        </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->shipping_id;?>" name = "shipping_id" id = "shipping_id"/>
                    <input type = "hidden" value = "<?php echo $this->partner_id;?>" name = "partner_id" id = "partner_id"/>
                    <?php
                    if($this->partner_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                    ?>
                    <button type = "submit" class="btn btn-info">Save</button>
                    <?php }?>
                  </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
          </section><!-- /.content -->
          
          <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Shipping Address Table</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="partner_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:3%'>No</th>
                         <th style = 'width:15%'>Shipping Name</th>
                        <th style = 'width:25%'>Shipping Address</th>
                        <th style = 'width:35%'>Remark</th>
                        <th style = 'width:10%'>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT sp.*
                              FROM db_shipaddress sp 
                              WHERE sp.shipping_partner_id = '$this->partner_id' AND sp.shipping_status = '1'";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['shipping_name'];?></td>
                            <td><?php echo nl2br($row['shipping_address']);?></td>
                            <td><?php echo nl2br($row['shipping_remark']);?></td>
                            <td><?php if($row['shipping_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'partner.php?action=edit_shipping_address&partner_id=<?php echo $this->partner_id;?>&shipping_id=<?php echo $row['shipping_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('partner.php?action=delete_shipping_address&partner_id=<?php echo $this->partner_id;?>&shipping_id=<?php echo $row['shipping_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:3%'>No</th>
                        <th style = 'width:15%'>Shipping Name</th>
                        <th style = 'width:25%'>Shipping Address</th>
                        <th style = 'width:35%'>Remark</th>
                        <th style = 'width:10%'>Status</th>
                        <th></th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
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
        $('#partner_table').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "iDisplayLength": 50
        });
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        $("#contact_form").validate({
                  rules: 
                  {
                      contact_name:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      contact_name:
                      {
                          required: "Please enter Contact Name."
                      }
                  }
              });
    
    
});
    </script>
  </body>
</html>
        <?php
        
    }
    public function getDataTable(){
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        if($_REQUEST['type'] == 'subcon'){
            $aColumns = array('partner_code','partner_name','partner_tel','partner_bill_address','total_workers','');
        }else{
            $aColumns = array('partner_code','partner_name','partner_tel','partner_bill_address','');
        }
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "partner_id";
	
	/* DB table to use */
        $sTable = "db_partner";
        /* 
	 * Paging
	 */
	$sLimit = "";
	if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
		$sLimit = "LIMIT ".mysql_real_escape_string($_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if($_GET['sSearch'] != ""){
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
                        if($aColumns[$i] == 'No' || $aColumns[$i] == ""){
                            continue;
                        }
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ($i=0;$i<count($aColumns);$i++){
                if($aColumns[$i] == 'No' || $aColumns[$i] == ""){
                    continue;
                }
		if($_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != ''){
			if ($sWhere == "" ){
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
        if(isset($_GET['iSortCol_0'])){
//            if($_GET['iSortCol_0'] != 0){
		$sOrder = "ORDER BY  ";
		for($i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ){
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ){
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if($sOrder == "ORDER BY" ){
			$sOrder = "";
		}
//            }
          
	}else{
            $sOrder = "ORDER BY partner.partner_code,product.partner_name";
        }
        if($sWhere == ""){
            $sWhere = " WHERE partner.partner_id > 0 ";
        }
        if($this->type == 'supplier'){
            $sWhere .= " AND partner.partner_issupplier = '1'";
        }else if($this->type == 'customer'){
            $sWhere .= " AND partner.partner_iscustomer = '1'";
        }else if($this->type == 'subcon'){
            $sWhere .= " AND partner.partner_issubcon = '1'";
        }else if($this->type == 'sitecoordinator'){
            $sWhere .= " AND partner.partner_issitecoordinator = '1'";
        }
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
                SELECT SQL_CALC_FOUND_ROWS partner.*,empl.empl_code,(SELECT COUNT(*) FROM db_pempl WHERE pempl_partner_id = partner.partner_id) as total_workers
                FROM db_partner partner 
                LEFT JOIN db_empl empl ON empl.empl_id = partner.partner_sales_person
		$sWhere
		$sOrder
		$sLimit
	";
      
	$rResult = mysql_query($sQuery);
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query($sQuery);
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysql_query($sQuery);
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	

	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
        $b = $_GET['iDisplayStart']+1;
	while ($aRow = mysql_fetch_array($rResult)){
		$row = array();
		for ($i=0;$i<sizeof($aColumns);$i++){
			if($aColumns[$i] == "No" ){
				$row[] = $b;
			}else if($aColumns[$i] != ""){
                            if($aColumns[$i] == 'partner_status'){
                                if($aRow[$aColumns[$i]] == 1){
                                    $row[] = "Active";
                                }else{
                                    $row[] = "In-Active";
                                }
                            }else if($aColumns[$i] == 'total_workers'){
                                $row[] = "<a href = 'partner.php?action=edit&current_tab=worker_info&partner_id=" . $aRow['partner_id'] . "&type=subcon' target = '_blank'>" . $aRow[$aColumns[$i]] . "</a>";
                            }else{
                                $row[] = ($aRow[$aColumns[$i]]);
                            }
			}else{
                           $btn = "";
                           if((getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create'))){
                               if($this->type == 'customer'){
                                //$btn .= "<button type='button' class='btn  bg-purple ' onclick = 'location.href = \"partner.php?action=shipping_address&partner_id={$aRow['partner_id']}&type={$this->type}\"'>Multi Shipping</button>"; 
                               } 
                                $btn .= " <button type='button' class='btn btn-primary btn-warning ' onclick = 'location.href = \"partner.php?action=contact&partner_id={$aRow['partner_id']}&type={$this->type}\"'>Contact</button>";
                                
                           }else{
                               $btn = "";
                           }
                           if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                             $btn .= " <button type='button' class='btn btn-primary btn-info ' onclick = 'location.href = \"partner.php?action=edit&partner_id={$aRow['partner_id']}&type={$this->type}\"'>Edit</button>";       
                           }
                           if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                             $btn .= " <button type='button' class='btn btn-primary btn-danger' onclick = 'confirmAlertHref(\"partner.php?action=delete&partner_id={$aRow['partner_id']}\",\"Confirm Delete?\")'>Delete</button>";  
                           }
                                $row[] = $btn;
                        }
		}
		$output['aaData'][] = $row;
                $b++;
	}

	echo json_encode($output);
    }
    public function getPartnerDetailTransaction(){
        
        $partner_query = $this->fetchPartnerDetail(" AND partner_id = '$this->partner_id'","","",0);
        
        if($row = mysql_fetch_array($partner_query)){
            return $row;
        }else{
            return null;
        }
    }
    public function orderHistoryTable($document_type){
        include_once 'class/Order.php';
        $order = new Order();
        if($document_type == 'SO'){ 
            $document_name = 'Sales Order';
            $partner_field = 'Customer';
            $document_url = 'sales_order.php';
        }else if($document_type == 'DO'){
            $document_name = 'Delivery Order';
            $partner_field = 'Customer';
            $document_url = 'delivery_order.php';
        }else if($document_type == 'QT'){
            $document_name = 'Quotation';
            $partner_field = 'Customer';
            $document_url = 'quotation.php';
        }else if($document_type == 'PO'){
            $document_name = 'Purchase Order';
            $partner_field = 'Supplier';
            $document_url = 'purchase_order.php';
        }
    ?>
    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title"><?php echo $document_name;?> History Table</h3></div>
          <div class = "pull-right">

          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
                <th style = 'width:15%'>Document No</th>
                <th style = 'width:10%'>Date</th>
                <th style = 'width:15%'><?php echo $partner_field;?></th>
                <th style = 'width:15%'>Sales Person</th>
                <th style = 'width:15%'>Sub Total</th>
                <th style = 'width:10%'>Tax</th>
                <th style = 'width:10%'>Grand Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php   
              $sql = "SELECT o.*,partner.partner_name as partner_name,empl.empl_name 
                      FROM db_order o 
                      INNER JOIN db_partner partner ON partner.partner_id = o.order_customer
                      LEFT JOIN db_empl empl ON empl.empl_id = o.order_salesperson
                      WHERE order_prefix_type = '$document_type' AND o.order_status = '1' AND o.order_customer = '$this->partner_id'
                      ORDER BY o.order_date DESC,o.order_no DESC";
              $query = mysql_query($sql);
              $i = 1;
              while($row = mysql_fetch_array($query)){
                  $order->order_id = $row['order_id'];
                  if($row['order_revtimes'] > 0){
                      $order_no = $row['order_no'] . " (Rev {$row['order_revtimes']})";
                  }else{
                      $order_no = $row['order_no'];
                  }
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $order_no;?></td>
                    <td><?php echo format_date($row['order_date']);?></td>
                    <td><?php echo $row['partner_name'];?></td>
                    <td><?php echo $row['empl_name'];?></td>
                    <td><?php echo num_format($row['order_subtotal']);?></td>
                    <td><?php echo num_format($row['order_taxtotal']);?></td>
                    <td><?php echo num_format($row['order_grandtotal']);?></td>
                    <td class = "text-align-right">
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                        ?>
                        <button type="button" class="btn btn-primary btn-info " onclick = "window.open('<?php echo $document_url;?>?action=edit&order_id=<?php echo $row['order_id'];?>')" >View</button> <!-- "location.href = '<?php echo $document_url;?>?action=edit&order_id=<?php echo $row['order_id'];?>'" -->
                        <?php }?>
                    </td>
                </tr>
            <?php    
                $i++;
              }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <?php
    }
    public function invoiceHistoryTable($document_type){
        
      include_once 'class/Invoice.php';
      $invoice = new Invoice();
      $document_name = 'Tax Invoice';
      $partner_field = 'Customer';
      $document_url = 'sales_invoice.php';
    ?>
    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title"><?php echo $document_name;?> History Table</h3></div>
          <div class = "pull-right">

          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
                <th style = 'width:15%'>Document No</th>
                <th style = 'width:10%'>Date</th>
                <th style = 'width:15%'><?php echo $partner_field;?></th>
                <th style = 'width:15%'>Sales Person</th>
                <th style = 'width:15%'>Sub Total</th>
                <th style = 'width:10%'>Tax</th>
                <th style = 'width:10%'>Grand Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php   
              $sql = "SELECT i.*,partner.partner_name,empl.empl_name 
                      FROM db_invoice i 
                      INNER JOIN db_partner partner ON partner.partner_id = i.invoice_customer
                      LEFT JOIN db_empl empl ON empl.empl_id = i.invoice_salesperson
                      WHERE i.invoice_status = '1' AND i.invoice_customer = '$this->partner_id'
                      ORDER BY i.invoice_date DESC,i.invoice_no DESC";
              $query = mysql_query($sql);
              $i = 1;
              while($row = mysql_fetch_array($query)){
                  $invoice->invoice_id = $row['invoice_id'];
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['invoice_no'];?></td>
                    <td><?php echo format_date($row['invoice_date']);?></td>
                    <td><?php echo $row['partner_name'];?></td>
                    <td><?php echo $row['empl_name'];?></td>
                    <td><?php echo num_format($row['invoice_subtotal']); ?></td> <!-- num_format($invoice->getSubTotalAmt() - $invoice->getTotalDiscAmt()); -->
                    <td><?php echo num_format($row['invoice_taxtotal']);?></td>
                    <td><?php echo num_format($row['invoice_grandtotal']);?></td>
                    <td class = "text-align-right">
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                        ?>
                        <button type="button" class="btn btn-primary btn-info " onclick = "window.open('<?php echo $document_url;?>?action=edit&invoice_id=<?php echo $row['invoice_id'];?>')">View</button>
                        <?php }?>
                    </td>
                </tr>
            <?php    
                $i++;
              }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    <?php
    }
    public function generateImportData($exceldata,$action){
       
        switch ($action) {
            case "partner":
           $this->partner_account_name1 = escape($exceldata[1]);
           $this->partner_account_name2 = escape($exceldata[2]);
           $this->partner_account_name3 = escape($exceldata[3]);
           $this->partner_account_name4 = escape($exceldata[4]);
           $this->partner_bill_address = escape($exceldata[5]);
           $this->partner_house_no = escape($exceldata[6]);
           $this->partner_postal_code = escape($exceldata[7]);
           $this->partner_city = escape($exceldata[8]);
           $this->partner_suburb = escape($exceldata[9]);
           $this->partner_outlet = getDataCodeBySql("country_id","db_country"," WHERE UPPER(country_code) = '".escape(strtoupper($exceldata[10]))."'","");
           $this->partner_website = escape($exceldata[11]);
           $this->partner_currency = getDataCodeBySql("currency_id","db_currency"," WHERE UPPER(currency_code) = '".escape(strtoupper($exceldata[12]))."'","");
           $this->partner_group = getDataCodeBySql("partnergroup_id","db_partnergroup"," WHERE UPPER(partnergroup_code) = '".escape(strtoupper($exceldata[13]))."'","");
           $this->partner_address_type = getDataCodeBySql("partneraddresstype_id","db_partneraddresstype"," WHERE UPPER(partneraddresstype_code) = '".escape(strtoupper($exceldata[14]))."'","");
                break;
            case "contact":
           $this->contact_name = escape($exceldata[1]);
           $this->contact_address = escape($exceldata[2]);
           $this->contact_tel = escape($exceldata[3]);
           $this->contact_cellphone = escape($exceldata[4]);
           $this->contact_department = escape($exceldata[5]);
           $this->contact_position = escape($exceldata[6]);
           $this->contact_jobtitle = escape($exceldata[7]);
           $this->contact_forename = escape($exceldata[8]);
           $this->contact_lastname = escape($exceldata[9]);
           break;
            default:
                break;
        }

    }
    public function getMaterial(){
    
    ?>
    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title">Material Table</h3></div>
          <div class = "pull-right">

          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
                <th style = 'width:15%'>Category</th>
                <th style = 'width:10%'>Code</th>
                <th style = 'width:35%'>Description</th>
                <th style = 'width:15%'>Cost Price</th>
                <th style = 'width:15%'>Sale Price</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php   
                $sql = "SELECT ma.*,mal.materialline_saleprice
                    FROM db_materialline mal
                    INNER JOIN db_material ma ON ma.material_id = mal.material_id AND ma.material_status = '1'
                    WHERE mal.materialline_partner_id = '$this->partner_id'";    
              $query = mysql_query($sql);
              $i = 1;
              while($row = mysql_fetch_array($query)){
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo getDataCodeBySql("materialcategory_code","db_materialcategory"," WHERE materialcategory_id = '{$row['material_category']}'", $orderby);;?></td>
                    <td><?php echo $row['material_code'];?></td>
                    <td><?php echo $row['material_desc'];?></td>
                    <td><?php echo num_format($row['materialline_saleprice']);?></td>
                    <td><?php echo num_format($row['material_sale_price']);?></td>
                    <td class = "text-align-right">
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                        ?>
                        <a class="btn btn-primary btn-info " target = '_blank' href = 'material.php?action=edit&material_id=<?php echo $row['material_id'];?>'>View</a>
                        <?php }?>
                    </td>
                </tr>
            <?php    
                $i++;
              }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
    <?php
    }
    public function getLabour(){
    
    ?>
    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title">Labour Table</h3></div>
          <div class = "pull-right">

          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
                <th style = 'width:10%'>Code</th>
                <th style = 'width:35%'>Description</th>
                <th style = 'width:15%'>Cost Price</th>
                <th style = 'width:15%'>Sale Price</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php   
                $sql = "SELECT ma.*,mal.labourline_saleprice
                    FROM db_labourline mal
                    INNER JOIN db_labour ma ON ma.labour_id = mal.labour_id AND ma.labour_status = '1'
                    WHERE mal.labourline_partner_id = '$this->partner_id'";
              $query = mysql_query($sql);
              $i = 1;
              while($row = mysql_fetch_array($query)){
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['labour_code'];?></td>
                    <td><?php echo $row['labour_desc'];?></td>
                    <td><?php echo num_format($row['labourline_saleprice']);?></td>
                    <td><?php echo num_format($row['labour_sale_price']);?></td>
                    <td class = "text-align-right">
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                        ?>
                        <a class="btn btn-primary btn-info " target = '_blank' href = 'labour.php?action=edit&labour_id=<?php echo $row['labour_id'];?>'>View</a>
                        <?php }?>
                    </td>
                </tr>
            <?php    
                $i++;
              }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
    <?php
    }
    public function getWorkerInfo(){
    global $mandatory;
       
    ?>

      <div class="col-sm-12" style = 'margin-bottom:10px;' >
          <div class = 'pull-left' ></div>
          <div class = 'pull-right'>

              <button type = 'button' class = 'btn btn-info' id = 'addnewworker' style = 'margin-top:15px;' >Add New Worker</button>

          </div>
      </div>
    <div style = 'clear:both'></div>  
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:5%;padding-left:5px">No</th>
            <th class = "" style = 'width:10%;'>Name</th>
            <th class = "" style = 'width:10%;'>NRIC / FIN</th>
            <th class = "" style = 'width:10%;'>Permit No.</th>
            <th class = "" style = 'width:10%;'>Permit Expiry</th>
            <th class = "" style = 'width:10%;'>Passport No.</th>
            <th class = "" style = 'width:10%;'>Passport Expiry</th>
            <th class = "" style = 'width:10%;'>Position</th>
            <th class = "" style="width:10%"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT pempl.*
                  FROM db_pempl pempl
                  WHERE pempl.pempl_partner_id = '$this->partner_id'";
          $query = mysql_query($sql);
          $i=1;

          while($row = mysql_fetch_array($query)){

          ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $row['pempl_name'];?></td>
                <td><?php echo $row['pempl_nric'];?></td>
                <td><?php echo $row['pempl_wpno'];?></td>
                <td><?php echo format_date($row['pempl_expirydate']);?></td>
                <td><?php echo $row['pempl_passport'];?></td>
                <td><?php echo format_date($row['pempl_passportexpirydate']);?></td>
                <td><?php echo $row['pempl_position'];?></td>
                <td>
                    <?php 
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                    ?>
                    <a title = 'edit' style = "margin-left:10px;margin-right:10px;font-size:20px;" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" pempl_id = "<?php echo $row['pempl_id'];?>" class = "edit_line_worker font-icon" line = "<?php echo $i;?>" ><i class="fa fa-edit" aria-hidden="true"></i></a>
                    <?php }?>
                    <?php 
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                    ?>
                    <a title = 'delete' style = "margin-left:10px;margin-right:10px;font-size:20px;color:red" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" pempl_id = "<?php echo $row['pempl_id'];?>" class = "delete_line font-icon" line = "<?php echo $i;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <?php }?>
                </td>
            </tr>
          <?php  
          $i++;
          }
          ?>
            <tr id = 'material_lasttr' ></tr>

        </tbody>

    </table>
    <input type = 'hidden' value = '<?php echo $i;?>' id = 'total_line_material' name = "total_line_material" />
    <?php
    }
    public function createPartnerWorker(){
        
        if($this->pempl_id > 0){
            
            $table_field = array('pempl_name','pempl_nric','pempl_issuedate',
                                 'pempl_wpno','pempl_expirydate','pempl_passport','pempl_passportissuedate',
                                 'pempl_passportexpirydate','pempl_position');
            $table_value = array($this->pempl_name,$this->pempl_nric,format_date_database($this->pempl_issuedate),
                                 $this->pempl_wpno,format_date_database($this->pempl_expirydate),$this->pempl_passport,format_date_database($this->pempl_passportissuedate),
                                 format_date_database($this->pempl_passportexpirydate),$this->pempl_position);
            $remark = "Update Partner's Worker.";
            if(!$this->save->UpdateData($table_field,$table_value,'db_pempl','pempl_id',$remark,$this->pempl_id)){
               return false;
            }else{
               return true;
            }
        }else{
            $table_field = array('pempl_partner_id','pempl_name','pempl_nric','pempl_issuedate',
                                 'pempl_wpno','pempl_expirydate','pempl_passport','pempl_passportissuedate',
                                 'pempl_passportexpirydate','pempl_position');
            $table_value = array($this->partner_id,$this->pempl_name,$this->pempl_nric,format_date_database($this->pempl_issuedate),
                                 $this->pempl_wpno,format_date_database($this->pempl_expirydate),$this->pempl_passport,format_date_database($this->pempl_passportissuedate),
                                 format_date_database($this->pempl_passportexpirydate),$this->pempl_position);
            $remark = "Insert Partner's Worker.";
            if(!$this->save->SaveData($table_field,$table_value,'db_pempl','pempl_id',$remark)){
               return false;
            }else{
               $this->partner_id = $this->save->lastInsert_id;
               return true;
            }
        }
    }
    public function fetchWorkerDetail(){
        
       $sql = "SELECT * FROM db_pempl WHERE pempl_id = '$this->pempl_id'"; 
       $query = mysql_query($sql);
       
       return mysql_fetch_array($query);
    }
    public function fetchPrevPartnerID($partner_id){
        
       $sql = "SELECT partner_id FROM `db_partner` WHERE partner_id = (SELECT max(partner_id) FROM `db_partner` WHERE partner_id < ".$partner_id." AND partner_iscustomer = 1 and partner_status = 1)"; 
       $query = mysql_query($sql);
       
       
       return mysql_fetch_array($query); //$row["partner_id"];
    }
    public function fetchNextPartnerID($partner_id){
        
       $sql = "SELECT partner_id FROM `db_partner` WHERE partner_id = (SELECT min(partner_id) FROM `db_partner` WHERE partner_id > ".$partner_id." AND partner_iscustomer = 1 and partner_status = 1)"; 
       $query = mysql_query($sql);
       //$row = mysql_fetch_array($query);
       
       return mysql_fetch_array($query); //$row["partner_id"];
    }
    public function deleteWorkerLine(){
        if($this->save->DeleteData("db_pempl"," WHERE pempl_partner_id = '$this->partner_id' AND pempl_id = '$this->pempl_id'","Delete {$this->partner_id} Worker Line.")){
            return true;
        }else{
            return false;
        }
    }
}
?>
