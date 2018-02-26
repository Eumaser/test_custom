<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Order.php';
    include_once 'class/Partner.php';
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'language.php';
    $o = new Order();
    $b = new Partner();
    $s = new SavehandlerApi();
    $o->save = $s;
    $o->document_type = 'DO';
    $o->document_name = 'Delivery Order Management';
    $o->document_code = 'Delivery Order';
    $o->document_url = 'delivery_order.php';
    $o->document_print_url = "delivery_print.php";
    $o->custsupp_label = 'Customer';
    $o->salesorderedby_label = "Sales Person";
    $o->isstock = 0;


    $o->order_id = escape($_REQUEST['order_id']);
    $o->order_no = escape($_POST['order_no']);
    $o->order_date = escape($_POST['order_date']);
    $o->order_customer = escape($_POST['order_customer']);
    $o->order_salesperson = escape($_POST['order_salesperson']);
    $o->order_billaddress = escape($_POST['order_billaddress']);
    $o->order_attentionto = escape($_POST['order_attentionto']);
    $o->order_shipterm = escape($_POST['order_shipterm']);
    $o->order_term = escape($_POST['order_term']);
    $o->order_shipaddress = escape($_POST['order_shipaddress']);
    $o->order_customerref = escape($_POST['order_customerref']);
    $o->order_remark = escape($_POST['order_remark']);
    $o->order_customerpo = escape($_POST['order_customerpo']);
    $o->order_shipping_id = escape($_POST['order_shipping_id']);
    $o->order_attentionto_phone = escape($_POST['order_attentionto_phone']);
    $o->order_fax = escape($_POST['order_fax']);
    $o->order_subcon = escape($_POST['order_subcon']);
    $o->order_project_id = escape($_POST['order_project_id']);
    $o->order_attentionto_name = escape($_POST['order_attentionto_name']);
    $o->order_attentionto = escape($_POST['order_attentionto']);
    $o->order_attentionto_email = escape($_POST['order_attentionto_email']);
    $o->order_doc_type = escape($_POST['order_doc_type']);

    $o->order_delivery_date = escape($_POST['order_delivery_date']);
    $o->order_self_correction = escape($_POST['order_self_correction']);
    $o->order_supp_delivery = escape($_POST['order_supp_delivery']);
    $o->order_requestby = escape($_POST['order_requestby']);
    $o->order_agc_requestby = escape($_POST['order_agc_requestby']);
    $o->order_approvedby = escape($_POST['order_approvedby']);
    $o->order_verifiedby = escape($_POST['order_verifiedby']);

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
    $o->ordl_cancel_remark = escape($_POST['ordl_cancel_remark']);

    $o->order_regards = escape($_POST['order_regards']);
    $o->order_term_remark = escape($_POST['order_term_remark']);
    $o->generate_document_type = escape($_POST['generate_document_type']);
    $o->invoice_id = escape($_POST['invoice_id']);


    //edr variables to be used in orderfork table, using order class as base
    $o->orderfork_id = escape($_POST['orderfork_id']);
    $o->orderfork_brand = escape($_POST['orderfork_brand']);
    $o->orderfork_model = escape($_POST['orderfork_model']);
    $o->orderfork_capacity = escape($_POST['orderfork_capacity']);
    $o->orderfork_height = escape($_POST['orderfork_height']);
    $o->orderfork_mast = escape($_POST['orderfork_mast']);
    $o->orderfork_length = escape($_POST['orderfork_length']);
    $o->orderfork_attachment =escape($_POST['orderfork_attachment']);
    $o->orderfork_acc = escape($_POST['orderfork_acc']);
    $o->orderfork_serial =escape($_POST['orderfork_serial']);
    $o->orderfork_battery = escape($_POST['orderfork_battery']);
    $o->orderfork_bat_charger = escape($_POST['orderfork_bat_charger']);
    $o->orderfork_snr = escape($_POST['orderfork_snr']);


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
   //Generate Paramet
   $o->generateordlid = $_POST['generateordlid'];
   $o->generatecheckbox = $_POST['generatecheckbox'];
   $o->generateqty = $_POST['generateqty'];
   $action = $_REQUEST['action'];
   switch($action){
       case "create":
    //    print_r(gettype($o->order_doc_type));die();
                if($o->createOrder()){
                    rediectUrl("$o->document_url?action=edit&order_id=$o->order_id",getSystemMsg(1,'Create data successfully'));
                }else{
                    rediectUrl("$o->document_url?action=create_form",getSystemMsg(0,'Create data fail'));
                }
       break;
       case "edit":
            //$test = $o->fetchOrderDetail(" AND order_id = '$o->order_id'","","",1);
      //      echo '<pre>';
          //  print_r($test);die();
                if(($o->fetchOrderDetail(" AND order_id = '$o->order_id'","","",1))  && ($o->order_id > 0)){
                    $o->getInputForm("update");
                }else{
                   rediectUrl("$o->document_url",getSystemMsg(0,'Record Not Found.'));
                }
       break;
       case "update":
       //edr figure out why orderfork id no being retrieve
       // die( $o->orderfork_id);
               $o->status = 0;
               if($o->updateOrder()){
                   rediectUrl("$o->document_url?action=edit&order_id=$o->order_id",getSystemMsg(1,'Update data successfully'));
               }else{
                   rediectUrl("$o->document_url?action=edit&order_id=$o->order_id",getSystemMsg(0,'Update data fail'));
               }
       break;
       case "delete":
               $o->order_status = 0;
               if($o->delete()){
                   rediectUrl("$o->document_url",getSystemMsg(1,'Delete data successfully'));
               }else{
                   rediectUrl("$o->document_url?action=edit&order_id=$o->order_id",getSystemMsg(0,'Delete data fail'));
               }
       break;
       case "saveline":
       case "updateline":
            $o->calculateLineAmount();

            if($o->ordl_id > 0 && $action == 'updateline'){
                $issuccess = $o->updateOrderLine();
            }else{
                $issuccess = $o->createOrderLine();
            }
            if($issuccess){
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
               //echo json_encode(array('status'=>1,'tab'=>'sales_invoice_tab'));
               echo json_encode(array('status'=>1,'newid'=>$o->order_id,'newurl'=>$o->newurl));
           }else{
               echo json_encode(array('status'=>0,'tab'=>0));
           }
           exit();
           break;
       case "deleteline":
           if($o->deleteOrderLine()){
                $o->order_disctotal = $o->getTotalDiscAmt();
                $o->order_subtotal = $o->getSubTotalAmt();
                $o->order_taxtotal = $o->getTotalGstAmt();
                $o->updateOrderTotal();
               echo json_encode(array('status'=>1,'tab'=>'sodo_order_tab'));
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
       case "getGenerateLineData":
           $json = $o->getGenerateLineData();
           if($json){
               echo json_encode(array('status'=>1,'json'=>$json));
           }else{
               echo json_encode(array('status'=>0,'json'=>""));
           }
           exit();
           break;
       case "cancellineitems":
           if($o->cancelLineItems()){
               echo json_encode(array('status'=>1,'tab'=>''));
           }else{
               echo json_encode(array('status'=>0,'tab'=>0));
           }
           exit();
           break;
       case "reactivecancelitems":
           if($o->reactiveCancelItems()){
               echo json_encode(array('status'=>1,'tab'=>''));
           }else{
               echo json_encode(array('status'=>0,'tab'=>0));
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
