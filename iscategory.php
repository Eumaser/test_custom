<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Iscategory.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Iscategory();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;
    
    $action = escape($_REQUEST['action']);
    $o->iscategory_id = escape($_REQUEST['iscategory_id']);
    $o->iscategory_code = escape($_POST['iscategory_code']);
    $o->iscategory_seqno = escape($_POST['iscategory_seqno']);
    $o->iscategory_desc = escape($_POST['iscategory_desc']);
    $o->iscategory_status = escape($_POST['iscategory_status']);
    $o->isparent_id = escape($_POST['isparent_id']);

    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("iscategory.php?action=edit&iscategory_id=$o->iscategory_id",getSystemMsg(1,'Create data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("iscategory.php",getSystemMsg(0,'Create data'));
            }
            exit();
            break; 
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("iscategory.php?action=edit&iscategory_id=$o->iscategory_id",getSystemMsg(1,'Update data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("iscategory.php?action=edit&iscategory_id=$o->iscategory_id",getSystemMsg(0,'Update data'));
            }
            exit();
            break;    
        case "edit":
            if($o->fetchIscategoryDetail(" AND iscategory_id = '$o->iscategory_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("iscategory.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("iscategory.php",getSystemMsg(1,'Delete data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("iscategory.php?action=edit&iscategory_id=$o->iscategory_id",getSystemMsg(0,'Delete data'));
            }
            exit();
            break; 
        case "validate_iscategory":
            if($o->validateMiscategory($o->iscategory_code,$o->iscategory_id)){
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


