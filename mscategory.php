<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Mscategory.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Mscategory();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;
    
    $action = escape($_REQUEST['action']);
    $o->mscategory_id = escape($_REQUEST['mscategory_id']);
    $o->mscategory_code = escape($_POST['mscategory_code']);
    $o->mscategory_seqno = escape($_POST['mscategory_seqno']);
    $o->mscategory_desc = escape($_POST['mscategory_desc']);
    $o->mscategory_status = escape($_POST['mscategory_status']);
    $o->msparent_id = escape($_POST['msparent_id']);

    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("mscategory.php?action=edit&mscategory_id=$o->mscategory_id",getSystemMsg(1,'Create data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("mscategory.php",getSystemMsg(0,'Create data'));
            }
            exit();
            break; 
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("mscategory.php?action=edit&mscategory_id=$o->mscategory_id",getSystemMsg(1,'Update data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("mscategory.php?action=edit&mscategory_id=$o->mscategory_id",getSystemMsg(0,'Update data'));
            }
            exit();
            break;    
        case "edit":
            if($o->fetchMscategoryDetail(" AND mscategory_id = '$o->mscategory_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("mscategory.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("mscategory.php",getSystemMsg(1,'Delete data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("mscategory.php?action=edit&mscategory_id=$o->mscategory_id",getSystemMsg(0,'Delete data'));
            }
            exit();
            break; 
        case "validate_mscategory":
            if($o->validateMmscategory($o->mscategory_code,$o->mscategory_id)){
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


