<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Delivery.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Delivery();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->delivery_id = escape($_REQUEST['delivery_id']);
    $o->delivery_code = escape($_POST['delivery_code']);
    $o->delivery_desc = escape($_POST['delivery_desc']);
    $o->delivery_seqno = escape($_POST['delivery_seqno']);
    $o->delivery_status = escape($_POST['delivery_status']);
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("delivery.php?action=edit&delivery_id=$o->delivery_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("delivery.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("delivery.php?action=edit&delivery_id=$o->delivery_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("delivery.php?action=edit&delivery_id=$o->delivery_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchDeliveryDetail(" AND delivery_id = '$o->delivery_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("delivery.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("delivery.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("delivery.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "validate_email":
            $t = $gf->checkDuplicate("delivery",'delivery_login_email',$o->delivery_login_email,'delivery_id',$o->delivery_id);
            if($t > 0){
                echo "false";
            }else{
                echo "true";
            }
            exit();
            break;   
        case "getJsonData":
            $row = $o->fetchDeliveryDetail(" AND delivery_id = '$o->delivery_id'","","",2);
            echo json_encode(array('remark'=>$row['delivery_desc']));
            exit();
            break;    
        default: 
            $o->getListing();
            exit();
            break;
    }


