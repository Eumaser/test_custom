<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Paymentterm.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Paymentterm();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->paymentterm_id = escape($_REQUEST['paymentterm_id']);
    $o->paymentterm_code = escape($_POST['paymentterm_code']);
    $o->paymentterm_desc = escape($_POST['paymentterm_desc']);
    $o->paymentterm_seqno = escape($_POST['paymentterm_seqno']);
    $o->paymentterm_status = escape($_POST['paymentterm_status']);
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("paymentterm.php?action=edit&paymentterm_id=$o->paymentterm_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("paymentterm.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("paymentterm.php?action=edit&paymentterm_id=$o->paymentterm_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("paymentterm.php?action=edit&paymentterm_id=$o->paymentterm_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchPaymenttermDetail(" AND paymentterm_id = '$o->paymentterm_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("paymentterm.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("paymentterm.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("paymentterm.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "validate_email":
            $t = $gf->checkDuplicate("paymentterm",'paymentterm_login_email',$o->paymentterm_login_email,'paymentterm_id',$o->paymentterm_id);
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


