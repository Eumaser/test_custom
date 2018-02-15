<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Isscategory.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Isscategory();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;
    
    $action = escape($_REQUEST['action']);
    $o->isscategory_id = escape($_REQUEST['isscategory_id']);
    $o->isscategory_code = escape($_POST['isscategory_code']);
    $o->isscategory_seqno = escape($_POST['isscategory_seqno']);
    $o->isscategory_desc = escape($_POST['isscategory_desc']);
    $o->isscategory_status = escape($_POST['isscategory_status']);
    $o->issparent_id = escape($_POST['issparent_id']);

    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("isscategory.php?action=edit&isscategory_id=$o->isscategory_id",getSystemMsg(1,'Create data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("isscategory.php",getSystemMsg(0,'Create data'));
            }
            exit();
            break; 
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("isscategory.php?action=edit&isscategory_id=$o->isscategory_id",getSystemMsg(1,'Update data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("isscategory.php?action=edit&isscategory_id=$o->isscategory_id",getSystemMsg(0,'Update data'));
            }
            exit();
            break;    
        case "edit":
            if($o->fetchIsscategoryDetail(" AND isscategory_id = '$o->isscategory_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("isscategory.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("isscategory.php",getSystemMsg(1,'Delete data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("isscategory.php?action=edit&isscategory_id=$o->isscategory_id",getSystemMsg(0,'Delete data'));
            }
            exit();
            break; 
        case "validate_isscategory":
            if($o->validateMisscategory($o->isscategory_code,$o->isscategory_id)){
                echo "true";
            }else{
                echo "false";
            }
            exit();
            break;
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;
        default: 
            $o->getListing();
            exit();
            break;
    }


