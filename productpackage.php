<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Productpackage.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Productpackage();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->product_id = escape($_REQUEST['product_id']);
    $o->product_code = escape($_POST['product_code']);
    $o->product_category = escape($_POST['product_category']);
    $o->product_sale_price = escape($_POST['product_sale_price']);
    $o->product_cost_price = escape($_POST['product_cost_price']);
    $o->product_remark = escape($_POST['product_remark']);
    $o->product_desc = escape($_POST['product_desc']);
    $o->product_seqno = escape($_POST['product_seqno']);
    $o->product_status = escape($_POST['product_status']);
    $o->product_stock_availability = escape($_POST['product_stock_availability']);
    $o->product_name = escape($_POST['product_name']);
    $o->image_input = $_FILES['image_input'];
    $o->productline_partner_id = $_POST['productline_partner_id'];
    $o->productline_saleprice = $_POST['productline_saleprice'];
    $o->productline_id = $_POST['productline_id'];
    
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("productpackage.php?action=edit&product_id=$o->product_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("productpackage.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("productpackage.php?action=edit&product_id=$o->product_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("productpackage.php?action=edit&product_id=$o->product_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchProductpackageDetail(" AND product_id = '$o->product_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("productpackage.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("productpackage.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("productpackage.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break; 
        case "deleteline":
            if($o->deleteProductLine()){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "validate_email":
            $t = $gf->checkDuplicate("product",'product_login_email',$o->product_login_email,'product_id',$o->product_id);
            if($t > 0){
                echo "false";
            }else{
                echo "true";
            }
            exit();
            break; 
        default: 
            $o->getListing();
            exit();
            break;
    }


