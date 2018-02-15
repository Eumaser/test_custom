<?php

    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Order.php'; 
    include_once 'class/Partner.php';
    include_once 'class/Project.php';
    include_once 'class/Product.php';
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'language.php';
    $o = new Order();
    $b = new Partner();
    $p = new Project();
    $pro = new Product();
    $s = new SavehandlerApi();
    $o->save = $s;
    $o->document_type = 'PGT';
    $o->document_name = 'Generating Management';
    $o->document_code = 'Generating';
    $o->document_url = 'purchase_generating.php';
    $o->custsupp_label = "Supplier";
    $o->salesorderedby_label = "Ordered By";
    $o->menu_id = 11;
    $o->isstock = 0;

    $o->order_id = escape($_REQUEST['order_id']);
    $o->order_no = escape($_POST['order_no']);
    $o->order_date = escape($_POST['order_date']);
    if(escape($_REQUEST['fi']) == 1){
      $o->order_customer = escape($_REQUEST['order_customer']);  
    }else{
      $o->order_customer = escape($_POST['order_customer']); 
    }
 
    $o->order_salesperson = escape($_POST['order_salesperson']);
    $o->order_billaddress = escape($_POST['order_billaddress']);
    $o->order_attentionto = escape($_POST['order_attentionto']);
    $o->order_shipterm = escape($_POST['order_shipterm']);
    $o->order_term = escape($_POST['order_term']);
    $o->order_shipaddress = escape($_POST['order_shipaddress']);
    $o->order_customerref = escape($_POST['order_customerref']);
    $o->order_remark = escape($_POST['order_remark']);
    $o->order_customerpo = escape($_POST['order_customerpo']);
    $o->order_rev = escape($_POST['order_rev']);
    $o->order_shipping_id = escape($_POST['order_shipping_id']);
    $o->order_attentionto_phone = escape($_POST['order_attentionto_phone']);
    $o->order_fax = escape($_POST['order_fax']);
    $o->order_subcon = escape($_POST['order_subcon']);
    $o->order_project_id = escape($_POST['order_project_id']);
    $o->order_regards = escape($_POST['order_regards']);
    
    $o->order_delivery_date = escape($_POST['order_delivery_date']);
    $o->order_job_no = escape($_POST['order_job_no']);
    $o->order_requestby = escape($_POST['order_requestby']);
    $o->order_agc_requestby = escape($_POST['order_agc_requestby']);
    $o->order_approvedby = escape($_POST['order_approvedby']);
    $o->order_verifiedby = escape($_POST['order_verifiedby']);
    
    $o->order_attachment = $_FILES['order_attachment'];

    $o->order_currency = escape($_POST['order_currency']);
    $o->order_currencyrate = escape($_POST['order_currencyrate']);
    if($o->order_currencyrate <= 1){
        $o->order_currencyrate = "1.0000";
    }
    $o->order_status = $_REQUEST['order_status'];

    $o->ordl_id = escape($_POST['ordl_id']);
    $o->ordl_order_id = escape($_POST['ordl_order_id']);
    $o->ordl_pro_no = escape($_POST['ordl_pro_no']);
    $o->ordl_pro_id = escape($_POST['ordl_pro_id']);
    $o->ordl_pro_desc = escape($_POST['ordl_pro_desc']);
    $o->ordl_uom = escape($_POST['ordl_uom']);
    $o->ordl_qty = str_replace(",", "",$_POST['ordl_qty']);
    $o->ordl_uprice = str_replace(",", "",$_POST['ordl_uprice']);
    $o->ordl_disc = str_replace(",", "",$_POST['ordl_disc']);
    $o->ordl_taxamt = str_replace(",", "",$_POST['ordl_taxamt']);
    $o->ordl_istax = str_replace(",", "",$_POST['ordl_istax']);
    $o->ordl_seqno = escape($_POST['ordl_seqno']);
    $o->ordl_fuprice = str_replace(",", "",$_POST['ordl_fuprice']);
    $o->ordl_ftotal = str_replace(",", "",$_POST['ordl_ftotal']);
    $o->ordl_pro_remark = str_replace(",", "",$_POST['ordl_pro_remark']);
    $o->ordl_pfuprice = escape($_POST['ordl_pfuprice']);
    
    $o->generate_document_type = escape($_POST['generate_document_type']);
    
    if($o->ordl_seqno == ""){
        $o->ordl_seqno = 10;
    }
    if(!is_numeric($o->ordl_uprice)){
        $o->ordl_uprice = 0;
    }
    if(!is_numeric($o->ordl_qty)){
        $o->ordl_qty = 0;
    }
    if(!is_numeric($o->ordl_disc)){
        $o->ordl_disc = 0;
    }
    if(!is_numeric($o->discount_amount)){
        $o->discount_amount = 0;
    }

   $action = $_REQUEST['action'];
   $o->action = $action;
   switch($action){
       
       case "generatingpo":
           if($o->generatingpo()){
               echo json_encode(array('status'=>1));
           }else{
               echo json_encode(array('status'=>0,'tab'=>0));
           }
           exit();
           break;
       default:  
            if($_SESSION['empl_group'] > 1){
                $wherestring = " AND o.order_outlet = '{$_SESSION['empl_outlet']}'";
            }
            $o->wherestring .= " AND o.order_prefix_type = '$o->document_type' $wherestring";

            $o->getGenerating();
            exit();
            break; 
    }
    
?>
