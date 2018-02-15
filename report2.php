<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Report2.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'class/SelectControl.php';
    include_once 'language.php';
    $o->select = new SelectControl();
    $o = new Report();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;
    $o->document_code = 'Quotation';
    
    $action     = escape($_REQUEST['action']);
    $o->type    = escape($_REQUEST['type']);
    $o->document_url = "report2.php?type=$o->type";
    $o->document_print_url = "report2_print.php?type=$o->type";
    
    $o->report_customer_id      = escape($_POST['report_customer_id']);
    $o->report_customer_name    = escape($_POST['report_customer_name']);
    $o->report_salesperson_id   = escape($_POST['report_salesperson_id']);
    $o->report_salesperson_name = escape($_POST['report_salesperson_name']);
    $o->report_invoice          = escape($_POST['report_invoice']);
    $o->report_date_from        = escape($_POST['report_date_from']);
    $o->report_date_to          = escape($_POST['report_date_to']);
    $o->report_date_to          = escape($_POST['report_date_to']);
    
    $o->report_product_id       = escape($_POST['report_product_id']);
    $o->report_product_name     = escape($_POST['report_product_name']);
    
    $o->current_tab               = escape($_POST['current_tab']);
    $whereSql = "WHERE ord.order_status = 1 AND (ord.order_prefix_type = 'QT')";
    $orderSql = '';
    
    if(!empty($o->report_invoice)){
        $whereSql .= " AND ord.order_no LIKE '%$o->report_invoice%' ";
    }    
    if(!empty($o->report_customer_name)){
        $whereSql .= " AND cust.partner_name LIKE '%$o->report_customer_name%' ";
    }    
    if(!empty($o->report_salesperson_name)){
        $whereSql .= " AND emp.empl_name LIKE '%$o->report_salesperson_name%' ";
    }
    //$dateFrom = $o->summary_date_from;
    //$dateTo= $o->summary_date_to;
    if(!empty($o->report_date_from) && !empty($o->report_date_to)){
        $whereSql .= " AND ord.order_date BETWEEN '".date('Y-m-d', strtotime($o->report_date_from))."' AND '".date('Y-m-d', strtotime($o->report_date_to))."' ";
    }else if(!empty($o->report_date_from)){
        $whereSql .= " AND ord.order_date >= '".date('Y-m-d', strtotime($o->report_date_from))."'";
    }else if(!empty($o->report_date_to)){
        $whereSql .= " AND ord.order_date <= '".date('Y-m-d', strtotime($o->report_date_to))."'";
    }
    
    if(!empty($o->report_product_id)){
        $whereSql .= " AND ordl.ordl_pro_id = '$o->report_product_id'";
    }
    /*
    if(!empty($o->detailed_invoice)){
        $whereSql .= " AND ord.order_no LIKE '%$o->detailed_invoice%' ";
    }  
    if(!empty($o->detailed_customer_name)){
        $whereSql .= " AND cust.partner_name LIKE '%$o->detailed_customer_name%' ";
    }    
    if(!empty($o->detailed_salesperson_name)){
        $whereSql .= " AND emp.empl_name LIKE '%$o->detailed_salesperson_name%' ";
    }
    if(!empty($o->detailed_date_from) && !empty($o->detailed_date_to)){
        $whereSql .= " AND ord.order_date BETWEEN '".date('Y-m-d', strtotime($o->detailed_date_from))."' AND '".date('Y-m-d', strtotime($o->detailed_date_to))."' ";
    }else if(!empty($o->detailed_date_from)){
        $whereSql .= " AND ord.order_date >= '".date('Y-m-d', strtotime($o->detailed_date_from))."'";
    }else if(!empty($o->detailed_date_to)){
        $whereSql .= " AND ord.order_date <= '".date('Y-m-d', strtotime($o->detailed_date_to))."'";
    }
    */
    
    
    
    $ranNum = rand(3, 20);
    if($o->type == 'summary'){
        $o->label_name = "Summary ";
        $o->current_tab = "Summary";
        $act = 'getSummary';
    }else if($o->type=='detailed'){
        $o->label_name = "Detailed ";
        $o->current_tab = "Detailed";
        $act = 'getDetailed';
    }
    
    switch ($action) {
        
        case "getCustomerJson":
            if($o->fetchCustomerDetail(" AND partner_id = '$o->report_customer_id'","","",1)){
                echo json_encode(array('status'=>1,
                                      'customer_id'=>$o->partner_id,
                                      'customer_name'=>html_entity_decode($o->partner_name)));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getSalespersonJson":
            if($o->fetchSalespersonDetail(" AND empl_id = '$o->report_salesperson_id'","","",1)){
                echo json_encode(array('status'=>1,
                                      'salesperson_id'=>$o->empl_id,
                                      'salesperson_name'=>html_entity_decode($o->empl_name)));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break; 
        case "getProductJson":
            if($o->fetchProductDetail(" AND product_id = '$o->report_product_id'","","",1)){
                echo json_encode(array('status'=>1,
                                      'product_id'=>$o->product_id,
                                      'product_desc'=>html_entity_decode($o->product_desc)));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break; 
        case "getSummary":
            $o->query = $o->fetchReportSummary($whereSql,$orderSql,"",0);
            if($o->query){
                $o->getInputForm($ranNum,$action);
            }else{
               rediectUrl("$o->document_url",getSystemMsg(0,'Record Not Found.'));
            }
            exit();
            break;
        case "getDetailed":
            $o->query = $o->fetchReportDetailed($whereSql,$orderSql,"",0);
            if($o->query){
                $o->getInputForm($ranNum,$action);
            }else{
               rediectUrl("$o->document_url",getSystemMsg(0,'Record Not Found.'));
            }
            exit();
            break;
        default: 
            $o->getInputForm(0,$act);
            exit();
            break;
    }
?>