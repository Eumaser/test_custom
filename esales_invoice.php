<?php
    $sql_debug = 0;
    error_reporting(0);
    //error_reporting(E_ALL);
    //ini_set('display_errors', 1);
    $lang = 'en';
    session_start();
    date_default_timezone_set("Asia/Singapore"); 
    define('system_datetime',date('Y-m-d H:i:s'));
    define('system_date',date('Y-m-d'));
    define('webroot',"http://www.kcpartsservices0505.firstcomdemolinks.com/crm_kcparts/");
    define('system_gst_percent',7);
    //$_SERVER["PHP_SELF"] = htmlspecialchars($_SERVER["PHP_SELF"]);
    $session_expiry_time = time() + (60*30); // 30mins expiry ;
    include_once 'connect.php';
    include_once 'include_function.php';
    include_once 'class/Invoice.php'; 
    include_once 'class/Partner.php';
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'language.php';
    include_once 'class/Product.php';
    include_once 'class/Package.php';
    include_once 'class/SelectControl.php';

    $o = new Invoice();
    $b = new Partner();
    $s = new SavehandlerApi();
    $pro = new Product();
    $pack = new Package();
    $o->save = $s;
    $o->document_type = 'SI';
    $o->document_name = 'Sales Invoice Management';
    $o->document_code = 'Sales Invoice';
    $o->document_url = 'sales_invoice.php';
    $o->document_print_url = "sales_invoice_print.php";
    $o->salesorderedby_label = "Sales Person";
    $o->custsupp_label = 'Customer';
    $o->menu_id = 14;
    $o->isstock = 0;
    $o->select = new SelectControl();

    $o->invoice_id = escape($_REQUEST['invoice_id']);
    $o->invoice_no = escape($_POST['invoice_no']);
    $o->invoice_date = escape($_POST['invoice_date']);
    $o->invoice_customer = escape($_POST['invoice_customer']);
    $o->invoice_salesperson = escape($_POST['invoice_salesperson']);
    $o->invoice_billaddress = escape($_POST['invoice_billaddress']);
    $o->invoice_attentionto = escape($_POST['invoice_attentionto']);
    $o->invoice_shipterm = escape($_POST['invoice_shipterm']);
    $o->invoice_term = escape($_POST['invoice_term']);
    $o->invoice_shipaddress = escape($_POST['invoice_shipaddress']);
    $o->invoice_customerref = escape($_POST['invoice_customerref']);
    $o->invoice_remark = escape($_POST['invoice_remark']);
    $o->invoice_customerpo = escape($_POST['invoice_customerpo']);
    $o->invoice_attentionto_phone = escape($_POST['invoice_attentionto_phone']);
    $o->invoice_fax = escape($_POST['invoice_fax']);
    $o->invoice_attn_remark = str_replace(",", "",$_POST['invoice_attn_remark']);
    $o->invoice_weight = str_replace(",", "",$_POST['invoice_weight']);
    $o->invoice_project_id = str_replace(",", "",$_POST['invoice_project_id']);
    $o->invoice_discheadertotal = str_replace(",", "",$_POST['invoice_discheadertotal']);
    $o->invoice_shipping_id = escape($_POST['invoice_shipping_id']);
    $o->invoice_shipaddress = escape($_POST['invoice_shipaddress']);

    // Added by Ivan
    $o->invoice_delivery_id = escape($_POST['invoice_delivery_id']);
    $o->invoice_delivery_remark = escape($_POST['invoice_delivery_remark']);
    $o->invoice_price_id = escape($_POST['invoice_price_id']);
    $o->invoice_price_remark = escape($_POST['invoice_price_remark']);
    $o->invoice_paymentterm_id = escape($_POST['invoice_paymentterm_id']);
    $o->invoice_paymentterm_remark = escape($_POST['invoice_paymentterm_remark']);
    $o->invoice_validity_id = escape($_POST['invoice_validity_id']);
    $o->invoice_validity_remark = escape($_POST['invoice_validity_remark']);
    $o->invoice_country_id = escape($_POST['invoice_country_id']);
    $o->invoice_transittime_id = escape($_POST['invoice_transittime_id']);
    $o->invoice_freightcharge_id = escape($_POST['invoice_freightcharge_id']);
    $o->invoice_pointofdelivery_id = escape($_POST['invoice_pointofdelivery_id']);
    $o->invoice_prefix_id = escape($_POST['invoice_prefix_id']);
    $o->invoice_remarks_id = escape($_POST['invoice_remarks_id']);
    $o->invoice_attentionto_email = escape($_POST['invoice_attentionto_email']);
    $o->invoice_attentionto_name = escape($_POST['invoice_attentionto_name']);
    $o->qt_type = escape($_POST['qt_type']);
    $o->invoice_type_id = escape($_POST['invoice_type_id']);
    $o->invoice_item_id = escape($_POST['invoice_item_id']);
    $o->invoice_term_remark = escape($_POST['invoice_term_remark']);
    $o->invoice_regards = escape($_POST['invoice_regards']);

    $o->invoice_currency = escape($_POST['invoice_currency']);
    $o->invoice_currencyrate = escape($_POST['invoice_currencyrate']);
    if($o->invoice_currencyrate <= 1){
        $o->invoice_currencyrate = "1.0000";
    }
    $o->invoice_status = $_REQUEST['invoice_status'];

    $o->invl_id = escape($_POST['invl_id']);
    $o->invl_invoice_id = escape($_POST['invl_invoice_id']);
    $o->invl_pro_no = escape($_POST['invl_pro_no']);
    $o->invl_pro_id = escape($_POST['invl_pro_id']);
    $o->invl_pro_desc = escape($_POST['invl_pro_desc']);
    $o->invl_pro_remark = escape($_POST['invl_pro_remark']);
    $o->invl_uom = escape($_POST['invl_uom']);
    $o->invl_qty = str_replace(",", "",$_POST['invl_qty']);
    $o->invl_uprice = str_replace(",", "",$_POST['invl_uprice']);
    $o->invl_fuprice = str_replace(",", "",$_POST['invl_fuprice']);
    $o->invl_disc = str_replace(",", "",$_POST['invl_disc']);
    $o->invl_taxamt = str_replace(",", "",$_POST['invl_taxamt']);
    $o->invl_istax = str_replace(",", "",$_POST['invl_istax']);
    $o->invl_seqno = escape($_POST['invl_seqno']);
    $o->invl_markup = str_replace(",", "",$_POST['invl_markup']);
    $o->invl_pro_type = escape($_POST['invl_pro_type']);
    
    $o->e_invoice_num_pro   = escape($_REQUEST['n_pr']);
    if($o->e_invoice_num_pro > 0){
        for($z=0; $z < $o->e_invoice_num_pro;$z++){
            $o->e_invoice_order_id[$z]  = escape($_REQUEST['e_order_id_'.$z]);
            $o->e_invoice_firstname[$z] = escape($_REQUEST['e_firstname_'.$z]);
            $o->e_invoice_lastname[$z]  = escape($_REQUEST['e_lastname_'.$z]);
            $o->e_invoice_email[$z]     = escape($_REQUEST['e_email_'.$z]);
            $o->e_invoice_telephone[$z] = escape($_REQUEST['e_telephone_'.$z]); 
            $o->e_invoice_payment_address_1[$z] = escape($_REQUEST['e_payment_address_1_'.$z]);
            $o->e_invoice_payment_address_2[$z] = escape($_REQUEST['e_payment_address_2_'.$z]);
            $o->e_invoice_payment_city[$z]      = escape($_REQUEST['e_payment_city_'.$z]);
            $o->e_invoice_payment_postcode[$z]  = escape($_REQUEST['e_payment_postcode_'.$z]);
            $o->e_invoice_payment_country[$z]   = escape($_REQUEST['e_payment_country_'.$z]);
            $o->e_invoice_total[$z]     = escape($_REQUEST['e_total_'.$z]); 
            $o->e_invoice_shipping_code[$z]     = escape($_REQUEST['e_shipping_code_'.$z]); 
            $o->e_invoice_product_id[$z]        = escape($_REQUEST['e_product_id_'.$z]); 
            $o->e_invoice_model[$z]     = escape($_REQUEST['e_model_'.$z]);
            $o->e_invoice_quantity[$z]  = escape($_REQUEST['e_quantity_'.$z]); 
            $o->e_invoice_price[$z]     = escape($_REQUEST['e_price_'.$z]);
        }
    }
    
    $o->generate_document_type = escape($_POST['generate_document_type']);
    $o->order_id = escape($_POST['order_id']);
    
    if($o->invl_seqno == ""){
        $o->invl_seqno = 10;
    }
    if(!is_numeric($o->invl_uprice)){
        $o->invl_uprice = 0;
    }
    if(!is_numeric($o->invl_qty)){
        $o->invl_qty = 0;
    }
    if(!is_numeric($o->invl_disc)){
        $o->invl_disc = 0;
    }
    if(!is_numeric($o->discount_amount)){
        $o->discount_amount = 0;
    }
    if(!is_numeric($o->invoice_discheadertotal)){
        $o->invoice_discheadertotal = 0;
    }

   $action = $_REQUEST['action'];
   switch($action){
       case "create":
                if($o->createInvoice()){
                    rediectUrl("$o->document_url?action=edit&invoice_id=$o->invoice_id",getSystemMsg(1,'Create data successfully'));
                }else{
                    rediectUrl("$o->document_url?action=create_form",getSystemMsg(0,'Create data fail'));
                }
       break;
       case "edit":
                if($o->fetchInvoiceDetail(" AND invoice_id = '$o->invoice_id'","","",1)){
                    $o->getInputForm("update");
                }else{
                   rediectUrl("$o->document_url",getSystemMsg(0,'Fetch Data'));
                }
       break;
       case "update":
               $o->status = 0;
               if($o->updateInvoice()){

                    $o->invoice_disctotal = $o->getTotalDiscAmt();
                    $o->invoice_subtotal = $o->getSubTotalAmt();
                    $o->invoice_taxtotal = $o->getTotalGstAmt();
                    $o->updateInvoiceTotal();
                   rediectUrl("$o->document_url?action=edit&invoice_id=$o->invoice_id",getSystemMsg(1,'Update data successfully'));
               }else{
                   rediectUrl("$o->document_url?action=edit&invoice_id=$o->invoice_id",getSystemMsg(0,'Update data fail'));
               }
       break;
       case "saveline":
       case "updateline":   
            $o->calculateLineAmount();

            if($o->invl_id > 0 && $action == 'updateline'){
                $issuccess = $o->updateInvoiceLine();
            }else{
                $issuccess = $o->createInvoiceLine();
            }
            if($issuccess){
                $o->invoice_disctotal = $o->getTotalDiscAmt();
                $o->invoice_subtotal = $o->getSubTotalAmt();
                $o->updateInvoiceTotal();
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "generateDoc":
            $o->document_type = 'eSI';
            $o->document_code = 'e-Sales Invoice';
            if($o->generateDocument()){
               echo json_encode(array('status'=>1,
                                      'invoiceSql'=>$o->invoiceSql,
                                      'invlSql'=>$o->invlSql
                                      ));
           }else{
               echo json_encode(array('status'=>0));
           }
           
           exit();
           break; 
       default: 
            if($_SESSION['empl_group'] > 1){
                $wherestring = " AND o.invoice_outlet = '{$_SESSION['empl_outlet']}'";
            }
            $o->wherestring .= " AND o.invoice_prefix_type = '$o->document_type' $wherestring";

            $o->getListing();
            exit();
            break; 
    }
    
?>
