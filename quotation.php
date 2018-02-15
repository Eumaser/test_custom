<?php

    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Order.php'; 
    include_once 'class/Partner.php';
    include_once 'class/Project.php';
    include_once 'class/Product.php';
    include_once 'class/Package.php';
    //include_once 'class/Productpackage.php';
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'class/SelectControl.php';
    include_once 'language.php';
    $o = new Order();
    $b = new Partner();
    $p = new Project();
    //$pro = new Productpackage();
    $pro = new Product();
    $pack = new Package();
    $s = new SavehandlerApi();
    $o->save = $s;
    $o->document_type = 'QT';
    $o->document_name = 'Quotation Management';
    $o->document_code = 'Quotation';
    $o->document_url = 'quotation.php';
    $o->custsupp_label = 'Customer';
    $o->salesorderedby_label = "Sales Person";
    $o->document_print_url = "quotation_print.php";
    $o->document2_print_url = "quotation2_print.php";
    $o->menu_id = 11;
    $o->isstock = 0;
    $o->select = new SelectControl();

    $o->order_id = escape($_REQUEST['order_id']);
    $o->order_no = escape($_POST['order_no']);
    $o->order_date = escape($_POST['order_date']);
    $o->order_customer = escape($_POST['order_customer']);
    $o->order_salesperson = escape($_POST['order_salesperson']);
    $o->order_billaddress = escape($_POST['order_billaddress']);
    $o->order_attentionto = escape($_POST['order_attentionto']);
    $o->order_shipterm = escape($_POST['order_shipterm']);
    $o->order_term_remark = escape($_POST['order_term_remark']);
    $o->order_shipaddress = escape($_POST['order_shipaddress']);
    $o->order_customerref = escape($_POST['order_customerref']);
    $o->order_remark = escape($_POST['order_remark']);
    $o->order_customerpo = escape($_POST['order_customerpo']);
    $o->order_shipping_id = escape($_POST['order_shipping_id']);
    $o->order_attentionto_phone = escape($_POST['order_attentionto_phone']);
    $o->order_fax = escape($_POST['order_fax']);
    $o->order_subcon = escape($_POST['order_subcon']);
    $o->order_project_id = escape($_POST['order_project_id']);
    $o->order_type = escape($_POST['order_type']);
    $o->order_void_remarks = escape($_POST['order_void_remarks']);
    $o->order_paymentterm_remark = escape($_POST['order_paymentterm_remark']);
    
    // Added by Ivan
    $o->order_delivery_id = escape($_POST['order_delivery_id']);
    $o->order_delivery_remark = escape($_POST['order_delivery_remark']);
    $o->order_price_id = escape($_POST['order_price_id']);
    $o->order_price_remark = escape($_POST['order_price_remark']);
    $o->order_paymentterm_id = escape($_POST['order_paymentterm_id']);
    $o->order_paymentterm_remark = escape($_POST['order_paymentterm_remark']);
    $o->order_validity_id = escape($_POST['order_validity_id']);
    $o->order_validity_remark = escape($_POST['order_validity_remark']);
    $o->order_country_id = escape($_POST['order_country_id']);
    $o->order_transittime_id = escape($_POST['order_transittime_id']);
    $o->order_freightcharge_id = escape($_POST['order_freightcharge_id']);
    $o->order_pointofdelivery_id = escape($_POST['order_pointofdelivery_id']);
    $o->order_prefix_id = escape($_POST['order_prefix_id']);
    $o->order_remarks_id = escape($_POST['order_remarks_id']);
    $o->order_notes = escape($_POST['order_notes']);
    
    $o->order_attentionto_email = escape($_POST['order_attentionto_email']);
    $o->order_attentionto_name = escape($_POST['order_attentionto_name']);
    $o->order_type_id = escape($_POST['order_type_id']);
    $o->qt_type = escape($_POST['qt_type']);
    $o->order_item_id = escape($_POST['order_item_id']);
    
    $o->order_delivery_date = escape($_POST['order_delivery_date']);
    $o->order_self_correction = escape($_POST['order_self_correction']);
    $o->order_supp_delivery = escape($_POST['order_supp_delivery']);
    $o->order_requestby = escape($_POST['order_requestby']);
    $o->order_agc_requestby = escape($_POST['order_agc_requestby']);
    $o->order_approvedby = escape($_POST['order_approvedby']);
    $o->order_verifiedby = escape($_POST['order_verifiedby']);
    $o->order_regards = escape($_POST['order_regards']);
    $o->history_type = escape($_POST['history_type']);
    
    $o->order_discheadertotal = str_replace(",", "",$_POST['order_discheadertotal']);
    
    $o->order_rev = escape($_POST['order_rev']);
    
    $o->order_currency = escape($_POST['order_currency']);
    $o->order_currencyrate = escape($_POST['order_currencyrate']);
    if($o->order_currencyrate <= 1){
        $o->order_currencyrate = "1.0000";
    }
    $o->order_status = $_REQUEST['order_status'];
    $o->old_order_status = $_REQUEST['old_order_status'];

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
    $o->ordl_pfuprice = str_replace(",", "",$_POST['ordl_pfuprice']);
    $o->ordl_ftotal = str_replace(",", "",$_POST['ordl_ftotal']);
    $o->ordl_pro_remark = str_replace(",", "",$_POST['ordl_pro_remark']);
    $o->ordl_cancel_remark = escape($_POST['ordl_cancel_remark']);
    //Added by Ivan
    $o->ordl_pro_type = escape($_POST['ordl_pro_type']);
    $o->ordl_total = escape($_POST['ordl_total']);
    $o->ordl_product_location = escape($_POST['ordl_product_location']);

    $o->generate_document_type = escape($_POST['generate_document_type']);
    
    $o->order_attachment = $_FILES['order_attachment'];

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
    if(!is_numeric($o->order_discheadertotal)){
        $o->order_discheadertotal = 0;
    }
    
    
   //Generate Parameters
   $o->generateordlid = $_POST['generateordlid'];
   $o->generatecheckbox = $_POST['generatecheckbox'];
   $o->generateqty = $_POST['generateqty'];
   
   $o->product_id = escape($_POST['product_id']);
   $o->customer_id = escape($_POST['customer_id']);

   $action = $_REQUEST['action'];
   switch($action){
       case "create":
                if($o->createOrder()){
                    rediectUrl("$o->document_url?action=edit&order_id=$o->order_id",getSystemMsg(1,'Create data successfully'));
                }else{
                    rediectUrl("$o->document_url?action=create_form",getSystemMsg(0,'Create data fail'));
                }
       break;
       case "edit":
                if(($o->fetchOrderDetail(" AND order_id = '$o->order_id'","","",1))  && ($o->order_id > 0)){
                    $o->getInputForm("update");
                }else{
                   rediectUrl("$o->document_url",getSystemMsg(0,'Record Not Found.'));
                }
       break;
       case "update":
                if(($o->old_order_status == 2) || ($o->old_order_status == -3)){
                    $o->changeOrderStatus($o->order_status,$o->order_id);
                    rediectUrl("$o->document_url?action=edit&order_id=$o->order_id",getSystemMsg(1,'Update data successfully'));
                    break;
                }
           
               $o->status = 0;
               if($o->order_rev == 1){
                    $old_order_id = $o->order_id;
                    $query = $o->fetchOrderDetail(" AND order_id = '$old_order_id'","","",0);
                    if($row = mysql_fetch_array($query)){
                       $o->order_revtimes = $row['order_revtimes'] + 1;
                       $o->order_revdatetime = system_datetime;
                       $o->order_revby = $_SESSION['empl_id'];
                       $o->order_no = $row['order_no'];
                       $o->order_date = system_datetime;
                       $o->order_void_remarks = "Revision";
                       $query_line = $o->fetchOrderLineDetail("","","",0);
                       if($o->createOrder()){
                           
                           while($row_line = mysql_fetch_array($query_line)){
                                $o->generateOrderLine($row_line,$o->order_id);
                            }
                            $o->changeOrderStatus(-3,$old_order_id);
                            rediectUrl("$o->document_url?action=edit&order_id=$o->order_id",getSystemMsg(1,'Revision data successfully'));
                       }else{
                            rediectUrl("$o->document_url?action=edit&order_id=$o->order_id",getSystemMsg(0,'Update data fail'));
                       }
                    }
               }else{
                    if($o->updateOrder()){

                        $o->order_disctotal = $o->getTotalDiscAmt();
                        $o->order_subtotal = $o->getSubTotalAmt();
                        $o->updateOrderTotal();
                        rediectUrl("$o->document_url?action=edit&order_id=$o->order_id",getSystemMsg(1,'Update data successfully'));
                    }else{
                        rediectUrl("$o->document_url?action=edit&order_id=$o->order_id",getSystemMsg(0,'Update data fail'));
                    }
               }
       break;
       case "delete":
               $o->order_status = "0";
               if($o->delete()){
                   rediectUrl("$o->document_url",getSystemMsg(1,'Delete data successfully'));
               }else{
                   rediectUrl("$o->document_url?action=edit&order_id=$o->order_id",getSystemMsg(0,'Delete data fail'));
               }
       break;
       case "saveline":
       case "updateline":    
            
            $o->calculateLineAmount();
           /*
           $pro->fetchProductDetail(" AND p.product_id = '$o->ordl_pro_id'", $orderstring, $wherelimit, 1);
                $o->ordl_pfuprice = $pro->product_sales_price;
                if($o->ordl_id > 0 && $action == 'updateline'){
                    $issuccess = $o->updateOrderLine();
                }else{
                    $issuccess = $o->createOrderLine();
                }
                if($issuccess){
                    $o->order_disctotal = $o->getTotalDiscAmt();
                    $o->order_subtotal = $o->getSubTotalAmt();
                    $o->updateOrderTotal();
                    echo json_encode(array('status'=>1));
                }else{
                    echo json_encode(array('status'=>0,'msg'=>$language[$lang]['addeditline_error']));
                }
                */
           if($o->ordl_pro_type == 'product')
           {
               $pro->fetchProductDetail(" AND p.product_id = '$o->ordl_pro_id'", $orderstring, $wherelimit, 1);
                $o->ordl_pfuprice = $pro->product_sales_price;
                if($o->ordl_id > 0 && $action == 'updateline'){
                    $issuccess = $o->updateOrderLine();
                }else{
                    $issuccess = $o->createOrderLine();
                }
                if($issuccess){
                    $o->order_disctotal = $o->getTotalDiscAmt();
                    $o->order_subtotal = $o->getSubTotalAmt();
                    $o->updateOrderTotal();
                    echo json_encode(array('status'=>1));
                }else{
                    echo json_encode(array('status'=>0,'msg'=>$language[$lang]['addeditline_error']));
                }
           }else if($o->ordl_pro_type == 'package')
           {
               $pro->fetchProductDetail(" AND p.product_id = '$o->ordl_pro_id'", $orderstring, $wherelimit, 1);
                $o->ordl_pfuprice = $pro->product_sales_price;
                if($o->ordl_id > 0 && $action == 'updateline'){
                    $issuccess = $o->updateOrderLine();
                }else{
                    $issuccess = $o->createOrderLine();
                }
                if($issuccess){
                    $o->order_disctotal = $o->getTotalDiscAmt();
                    $o->order_subtotal = $o->getSubTotalAmt();
                    $o->updateOrderTotal();
                    echo json_encode(array('status'=>1));
                }else{
                    echo json_encode(array('status'=>0,'msg'=>$language[$lang]['addeditline_error']));
                }
           }
            
            exit();
            break;
       case "deleteline":
           if($o->deleteOrderLine()){
                $o->order_disctotal = $o->getTotalDiscAmt();
                $o->order_subtotal = $o->getSubTotalAmt();
                $o->order_taxtotal = $o->getTotalGstAmt();
                $o->updateOrderTotal();
               echo json_encode(array('status'=>1));
           }else{
               echo json_encode(array('status'=>0));
           }
           exit();
           break;
       case "generateDocument":
           if($o->generateDocument()){
               echo json_encode(array('status'=>1,'newid'=>$o->order_id,'newurl'=>$o->newurl));
           }else{
               echo json_encode(array('status'=>0,'tab'=>0));
           }
           exit();
           break;
       case "duplicate":
           if($o->duplicate()){
               echo json_encode(array('status'=>1,'order_id'=>$o->order_id));
           }else{
               echo json_encode(array('status'=>0,'msg'=>$o->error_msg));
           }
           exit();
           break;
       case "getProductHistory":

           if($o->getProductHistory(" AND o.order_prefix_type = '$o->history_type'")){
               $pro->fetchProductDetail(" AND p.product_id = '$o->product_id'","","",1);
               echo json_encode(array('status'=>1,'json'=>$o->d,'product_code'=>$pro->product_code,'product_category'=>getDataCodeBySql('category_code','db_category'," WHERE category_id = '$pro->product_category'", $orderby),
                                      'product_sales_price'=>$pro->product_sales_price,'product_cost_price'=>$pro->product_cost_price));
           }else{
               echo json_encode(array('status'=>0,'msg'=>$o->error_msg));
           }
           exit();
           break;
       case "getHistoryLineDetail":
           if($o->getHistoryLineDetail()){
               echo json_encode(array('status'=>1,'json'=>$o->d));
           }else{
               echo json_encode(array('status'=>0,'msg'=>$o->error_msg));
           }
           exit();
           break;
       case "getDeliveryJson":
            if($o->fetchDeliveryDetail(" AND delivery_id = '$o->order_delivery_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'delivery_code'=>$o->delivery_code,
                                      'delivery_desc'=>$o->delivery_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
       case "getPriceJson":
            if($o->fetchPriceDetail(" AND price_id = '$o->order_price_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'price_code'=>$o->price_code,
                                      'price_desc'=>$o->price_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
       case "getPaymenttermJson":
            if($o->fetchPaymenttermDetail(" AND paymentterm_id = '$o->order_paymentterm_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'paymentterm_code'=>$o->paymentterm_code,
                                      'paymentterm_desc'=>$o->paymentterm_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
       case "getValidityJson":
            if($o->fetchValidityDetail(" AND validity_id = '$o->order_validity_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'validity_code'=>$o->validity_code,
                                      'validity_desc'=>$o->validity_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getTransittimeJson":
            if($o->fetchTransittimeDetail(" AND transittime_id = '$o->order_transittime_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'transittime_code'=>$o->transittime_code,
                                      'transittime_desc'=>$o->transittime_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getFreightchargeJson":
            if($o->fetchFreightchargeDetail(" AND freightcharge_id = '$o->order_freightcharge_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'freightcharge_code'=>$o->freightcharge_code,
                                      'freightcharge_desc'=>$o->freightcharge_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getPointofdeliveryJson":
            if($o->fetchPointofdeliveryDetail(" AND pointofdelivery_id = '$o->order_pointofdelivery_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'pointofdelivery_code'=>$o->pointofdelivery_code,
                                      'pointofdelivery_desc'=>$o->pointofdelivery_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getPrefixJson":
            if($o->fetchPrefixDetail(" AND prefix_id = '$o->order_prefix_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'prefix_code'=>$o->prefix_code,
                                      'prefix_desc'=>html_entity_decode($o->prefix_desc)));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getRemarksJson":
            if($o->fetchRemarksDetail(" AND remarks_id = '$o->order_remarks_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'remarks_code'=>$o->remarks_code,
                                      'remarks_desc'=>$o->remarks_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getCountryJson":
            if($o->fetchCountryJDetail(" AND country_id = '$o->order_country_id'","","",1)){
               echo json_encode(array('status'=>1,
                                      'country_code'=>$o->country_code,
                                      'country_desc'=>$o->country_desc));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
            
        case "getItemListJson":      
            if ($o->order_type_id == 1 || $o->order_type_id == "product"){
                $contact_option = $o->select->getProductNameSelectCtrl("","Y","");
                echo json_encode(array('status'=>1,
                                      'product_option'=>$contact_option));
            }
            else if ($o->order_type_id == 2 || $o->order_type_id == "package"){
                $contact_option = $o->select->getPackageNameSelectCtrl("","Y","");
                echo json_encode(array('status'=>1,
                                      'product_option'=>$contact_option));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getItemDescJson":      
            if ($o->qt_type == "product"){
                if($pro->fetchProductDetail(" AND product_id = '$o->order_item_id'","","",1)){
                    echo json_encode(array('status'=>1,
                                           'item_desc'=>html_entity_decode($pro->product_desc),
                                           'item_sale_price'=>$pro->product_sale_price,
                                           'item_product_location'=>$pro->product_location,
                                           'item_product_uom'=>$pro->product_uom));
                }else{
                   echo json_encode(array('status'=>0));
                }
            }else if ($o->qt_type == "package"){
                if($pack->fetchPackageDetail(" AND package_id = '$o->order_item_id'","","",1)){
                    echo json_encode(array('status'=>1,
                                           'item_desc'=>html_entity_decode($pack->package_desc),
                                           'item_sale_price'=>$pack->package_sale_price));
                }else{
                   echo json_encode(array('status'=>0));
                }
            }
            
            exit();
            break;
       case "createForm":
            $o->getInputForm('create');
            exit();
            break;  
       default:  
            if($_SESSION['empl_group'] > 1){
                $wherestring = " AND o.order_outlet = '{$_SESSION['empl_outlet']}'";
            }
            $o->wherestring .= " AND o.order_prefix_type = '$o->document_type' $wherestring";

            $o->getListing();
            exit();
            break; 
    }
    
?>
