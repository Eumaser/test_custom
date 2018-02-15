<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Labour.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Labour();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->labour_id = escape($_REQUEST['labour_id']);
    $o->labour_code = escape($_POST['labour_code']);
    $o->labour_sale_price = escape($_POST['labour_sale_price']);
    $o->labour_cost_price = escape($_POST['labour_cost_price']);
    $o->labour_remarks = escape($_POST['labour_remarks']);
    $o->labour_desc = escape($_POST['labour_desc']);
    $o->labour_seqno = escape($_POST['labour_seqno']);
    $o->labour_status = escape($_POST['labour_status']);
    
    $o->labourline_partner_id = $_POST['labourline_partner_id'];
    $o->labourline_desc = $_POST['labourline_desc'];
    $o->labourline_saleprice = $_POST['labourline_saleprice'];
    $o->labourline_id = $_POST['labourline_id'];
    
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("labour.php?action=edit&labour_id=$o->labour_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("labour.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("labour.php?action=edit&labour_id=$o->labour_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("labour.php?action=edit&labour_id=$o->labour_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchLabourDetail(" AND labour_id = '$o->labour_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("labour.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("labour.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("labour.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "deleteline":
            if($o->deleteLabourLine()){
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
            $t = $gf->checkDuplicate("labour",'labour_login_email',$o->labour_login_email,'labour_id',$o->labour_id);
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


