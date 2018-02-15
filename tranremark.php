<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Tranremark.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Tranremark();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->tranremark_id = escape($_REQUEST['tranremark_id']);
    $o->tranremark_code = escape($_POST['tranremark_code']);
    $o->tranremark_desc = escape($_POST['tranremark_desc']);
    $o->tranremark_seqno = escape($_POST['tranremark_seqno']);
    $o->tranremark_status = escape($_POST['tranremark_status']);
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("tranremark.php?action=edit&tranremark_id=$o->tranremark_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("tranremark.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("tranremark.php?action=edit&tranremark_id=$o->tranremark_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("tranremark.php?action=edit&tranremark_id=$o->tranremark_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchTranremarkDetail(" AND tranremark_id = '$o->tranremark_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("tranremark.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("tranremark.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("tranremark.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "validate_email":
            $t = $gf->checkDuplicate("tranremark",'tranremark_login_email',$o->tranremark_login_email,'tranremark_id',$o->tranremark_id);
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


