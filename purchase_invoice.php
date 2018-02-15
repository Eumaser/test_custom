<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Invoice.php'; 
    include_once 'class/Partner.php';
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'language.php';
    $o = new Invoice();
    $b = new Partner();
    $s = new SavehandlerApi();
    $o->save = $s;
    $o->document_type = 'PI';
    $o->document_name = 'Purchase Invoice Management';
    $o->document_code = 'Purchase Invoice';
    $o->document_url = 'purchase_invoice.php';
    $o->menu_id = 54;
    $o->isstock = 1;

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
    $o->invoice_subcon = escape($_POST['invoice_subcon']);
    $o->invoice_project_id = escape($_POST['invoice_project_id']);
    
    $o->invoice_delivery_date = escape($_POST['invoice_delivery_date']);
    $o->invoice_self_correction = escape($_POST['invoice_self_correction']);
    $o->invoice_supp_delivery = escape($_POST['invoice_supp_delivery']);
    $o->invoice_requestby = escape($_POST['invoice_requestby']);
    $o->invoice_agc_requestby = escape($_POST['invoice_agc_requestby']);
    $o->invoice_approvedby = escape($_POST['invoice_approvedby']);
    $o->invoice_verifiedby = escape($_POST['invoice_verifiedby']);

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
    $o->invl_uom = escape($_POST['invl_uom']);
    $o->invl_qty = str_replace(",", "",$_POST['invl_qty']);
    $o->invl_uprice = str_replace(",", "",$_POST['invl_uprice']);
    $o->invl_fuprice = str_replace(",", "",$_POST['invl_fuprice']);
    $o->invl_disc = str_replace(",", "",$_POST['invl_disc']);
    $o->invl_taxamt = str_replace(",", "",$_POST['invl_taxamt']);
    $o->invl_istax = str_replace(",", "",$_POST['invl_istax']);
    $o->invl_seqno = escape($_POST['invl_seqno']);
    
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

   //Generate Parameter
   $o->generateordlid = $_POST['generateordlid'];
   $o->generatecheckbox = $_POST['generatecheckbox'];
   $o->generateqty = $_POST['generateqty'];
   
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
                if((($o->fetchInvoiceDetail(" AND invoice_id = '$o->invoice_id'","","",1))&& ($o->invoice_id > 0))){
                    $o->getInputForm("update");
                }else{
                   rediectUrl("$o->document_url",getSystemMsg(0,'Fetch Data'));
                }
       break;
       case "update":
               $o->status = 0;
               if($o->updateInvoice()){
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
            $pro->fetchProductDetail(" AND p.product_id = '$o->ordl_pro_id'", $orderstring, $wherelimit, 1);
            $o->ordl_pfuprice = $pro->product_sales_price;
            $o->calculateLineAmount();

            if($o->invl_id > 0 && $action == 'updateline'){
                $issuccess = $o->updateInvoiceLine();
            }else{
                $issuccess = $o->createInvoiceLine();
            }
            if($issuccess){
                $o->invoice_disctotal = $o->getTotalDiscAmt();
                $o->invoice_subtotal = $o->getSubTotalAmt();
                $o->invoice_taxtotal = $o->getTotalGstAmt();
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
               echo json_encode(array('status'=>1,'tab'=>'sales_invoice_tab','newurl'=>'purchase_invoice.php','newid'=>$o->invoice_id));
           }else{
               echo json_encode(array('status'=>0,'tab'=>0));
           }
           exit();
           break;
       case "generatelineitems":
           if($o->generateMultiLineItems()){
               echo json_encode(array('status'=>1,'tab'=>'sales_invoice_tab'));
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
                $wherestring = " AND o.invoice_outlet = '{$_SESSION['empl_outlet']}'";
            }
            $o->wherestring .= " AND o.invoice_prefix_type = '$o->document_type' $wherestring";

            $o->getListing();
            exit();
            break; 
    }
    
?>
