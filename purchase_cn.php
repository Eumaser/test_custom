<?php
    include_once 'connect.php';
    include_once 'config.php';
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
    $o->document_type = 'PCN';
    $o->document_name = 'Credit Note (Purchase) Management';
    $o->document_code = 'Purchase Credit Note';
    $o->document_url = 'purchase_cn.php';
    $o->document_print_url = "sales_invoice_print.php"; //"purchase_invoice_print.php";
    $o->salesorderedby_label = "Ordered By";
    $o->custsupp_label = 'Supplier';
    $o->menu_id = 84;
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
    $o->invl_pro_type = "product"; //escape($_POST['invl_pro_type']);
    $o->invl_delivery_date = escape($_POST['invl_delivery_date']);
    
    
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
       case "delete":
               $o->invoice_status = 0;
               if($o->delete()){
                   rediectUrl("$o->document_url",getSystemMsg(1,'Delete data successfully'));
               }else{
                   rediectUrl("$o->document_url?action=edit&invoice_id=$o->invoice_id",getSystemMsg(0,'Delete data fail'));
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
       case "deleteline":
           if($o->deleteInvoiceLine()){
                $o->invoice_disctotal = $o->getTotalDiscAmt();
                $o->invoice_subtotal = $o->getSubTotalAmt();
                $o->invoice_taxtotal = $o->getTotalGstAmt();
               echo json_encode(array('status'=>1));
           }else{
               echo json_encode(array('status'=>0));
           }
           exit();
           break;
       case "generateDocument":
           if($o->generateDocument()){
               //echo json_encode(array('status'=>1,'tab'=>'sales_invoice_tab'));
               echo json_encode(array('status'=>1,'newid'=>$o->invoice_id,'newurl'=>$o->newurl));
           }else{
               echo json_encode(array('status'=>0,'tab'=>0));
           }
           exit();
           break;
       case "getDeliveryJson":
            if($o->fetchDeliveryDetail(" AND delivery_id = '$o->invoice_delivery_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'delivery_code'=>$o->delivery_code,
                                      'delivery_desc'=>$o->delivery_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getPriceJson":
            if($o->fetchPriceDetail(" AND price_id = '$o->invoice_price_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'price_code'=>$o->price_code,
                                      'price_desc'=>$o->price_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getPaymenttermJson":
            if($o->fetchPaymenttermDetail(" AND paymentterm_id = '$o->invoice_paymentterm_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'paymentterm_code'=>$o->paymentterm_code,
                                      'paymentterm_desc'=>$o->paymentterm_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getValidityJson":
            if($o->fetchValidityDetail(" AND validity_id = '$o->invoice_validity_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'validity_code'=>$o->validity_code,
                                      'validity_desc'=>$o->validity_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getTransittimeJson":
            if($o->fetchTransittimeDetail(" AND transittime_id = '$o->invoice_transittime_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'transittime_code'=>$o->transittime_code,
                                      'transittime_desc'=>$o->transittime_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getFreightchargeJson":
            if($o->fetchFreightchargeDetail(" AND freightcharge_id = '$o->invoice_freightcharge_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'freightcharge_code'=>$o->freightcharge_code,
                                      'freightcharge_desc'=>$o->freightcharge_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getPointofdeliveryJson":
            if($o->fetchPointofdeliveryDetail(" AND pointofdelivery_id = '$o->invoice_pointofdelivery_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'pointofdelivery_code'=>$o->pointofdelivery_code,
                                      'pointofdelivery_desc'=>$o->pointofdelivery_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getPrefixJson":
            if($o->fetchPrefixDetail(" AND prefix_id = '$o->invoice_prefix_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'prefix_code'=>$o->prefix_code,
                                      'prefix_desc'=>html_entity_decode($o->prefix_desc)));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getRemarksJson":
            if($o->fetchRemarksDetail(" AND remarks_id = '$o->invoice_remarks_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'remarks_code'=>$o->remarks_code,
                                      'remarks_desc'=>$o->remarks_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getCountryJson":
            if($o->fetchCountryJDetail(" AND country_id = '$o->invoice_country_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'country_code'=>$o->country_code,
                                      'country_desc'=>$o->country_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getItemListJson":
                $product_option = $o->select->getProductNameSelectCtrl("","Y","");
                echo json_encode(array('status'=>1,
                                      'product_option'=>$product_option));            
            exit();
            break;
        case "getItemDescJson":    
                if($pro->fetchProductDetail(" AND product_id = '$o->invoice_item_id'","","",1)){
                    echo json_encode(array('status'=>1,
                                           'item_desc'=>$pro->product_desc,
                                           'item_cost_price'=>$pro->product_cost_price));
                }else{
                   echo json_encode(array('status'=>0));
                }
            exit();
            break;
       case "createForm":
            $o->getInputForm('create');
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
