<?php
    include_once 'connect.php';
    include_once 'system.php';
    include_once 'include_function.php';
    include_once 'class/Crate.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Crate();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->crate_id = escape($_REQUEST['crate_id']);
    $o->crate_fcurrency_id = escape($_POST['crate_fcurrency_id']);
    $o->crate_tcurrency_id = escape($_POST['crate_tcurrency_id']);
    $o->crate_rate = escape($_POST['crate_rate']);
    $o->crate_fdate = escape($_POST['crate_fdate']);
    $o->crate_tdate = escape($_POST['crate_tdate']);
    $o->crate_status = escape($_POST['crate_status']);
    $o->crate_desc = escape($_POST['crate_desc']);
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("crate.php?action=edit&crate_id=$o->crate_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("crate.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("crate.php?action=edit&crate_id=$o->crate_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("crate.php?action=edit&crate_id=$o->crate_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchCrateDetail(" AND crate_id = '$o->crate_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("crate.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("crate.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("crate.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "getCurrencyRateDetail":
            $crate_rate = $o->getCurrencyRateDetail();
            echo json_encode(array('crate_rate'=>$crate_rate));
            exit();
            break;  
        default: 
            $o->getListing();
            exit();
            break;
    }


