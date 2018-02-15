<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Mcategory.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Mcategory();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;
    
    $action = escape($_REQUEST['action']);
    $o->materialcategory_id = escape($_REQUEST['materialcategory_id']);
    $o->materialcategory_code = escape($_POST['materialcategory_code']);
    $o->materialcategory_seqno = escape($_POST['materialcategory_seqno']);
    $o->materialcategory_desc = escape($_POST['materialcategory_desc']);
    $o->materialcategory_status = escape($_POST['materialcategory_status']);

    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("mcategory.php?action=edit&materialcategory_id=$o->materialcategory_id",getSystemMsg(1,'Create data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("mcategory.php",getSystemMsg(0,'Create data'));
            }
            exit();
            break; 
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("mcategory.php?action=edit&materialcategory_id=$o->materialcategory_id",getSystemMsg(1,'Update data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("mcategory.php?action=edit&materialcategory_id=$o->materialcategory_id",getSystemMsg(0,'Update data'));
            }
            exit();
            break;    
        case "edit":
            if($o->fetchMcategoryDetail(" AND materialcategory_id = '$o->materialcategory_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("mcategory.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("mcategory.php",getSystemMsg(1,'Delete data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("mcategory.php?action=edit&materialcategory_id=$o->materialcategory_id",getSystemMsg(0,'Delete data'));
            }
            exit();
            break; 
        case "validate_mcategory":
            if($o->validateMmcategory($o->mcategory_code,$o->materialcategory_id)){
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


