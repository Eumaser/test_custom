<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Msscategory.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Msscategory();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;
    
    $action = escape($_REQUEST['action']);
    $o->msscategory_id = escape($_REQUEST['msscategory_id']);
    $o->msscategory_code = escape($_POST['msscategory_code']);
    $o->msscategory_seqno = escape($_POST['msscategory_seqno']);
    $o->msscategory_desc = escape($_POST['msscategory_desc']);
    $o->msscategory_status = escape($_POST['msscategory_status']);
    $o->mssparent_id = escape($_POST['mssparent_id']);

    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("msscategory.php?action=edit&msscategory_id=$o->msscategory_id",getSystemMsg(1,'Create data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("msscategory.php",getSystemMsg(0,'Create data'));
            }
            exit();
            break; 
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("msscategory.php?action=edit&msscategory_id=$o->msscategory_id",getSystemMsg(1,'Update data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("msscategory.php?action=edit&msscategory_id=$o->msscategory_id",getSystemMsg(0,'Update data'));
            }
            exit();
            break;    
        case "edit":
            if($o->fetchMsscategoryDetail(" AND msscategory_id = '$o->msscategory_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("msscategory.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("msscategory.php",getSystemMsg(1,'Delete data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("msscategory.php?action=edit&msscategory_id=$o->msscategory_id",getSystemMsg(0,'Delete data'));
            }
            exit();
            break; 
        case "validate_msscategory":
            if($o->validateMmsscategory($o->msscategory_code,$o->msscategory_id)){
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


