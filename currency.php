<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Currency.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Currency();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->currency_id = escape($_REQUEST['currency_id']);
    $o->currency_code = escape($_POST['currency_code']);
    $o->currency_desc = escape($_POST['currency_desc']);
    $o->currency_seqno = escape($_POST['currency_seqno']);
    $o->currency_status = escape($_POST['currency_status']);
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("currency.php?action=edit&currency_id=$o->currency_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("currency.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("currency.php?action=edit&currency_id=$o->currency_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("currency.php?action=edit&currency_id=$o->currency_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchCurrencyDetail(" AND currency_id = '$o->currency_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("currency.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("currency.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("currency.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "validate_email":
            $t = $gf->checkDuplicate("currency",'currency_login_email',$o->currency_login_email,'currency_id',$o->currency_id);
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


