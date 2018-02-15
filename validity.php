<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Validity.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Validity();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->validity_id = escape($_REQUEST['validity_id']);
    $o->validity_code = escape($_POST['validity_code']);
    $o->validity_desc = escape($_POST['validity_desc']);
    $o->validity_seqno = escape($_POST['validity_seqno']);
    $o->validity_status = escape($_POST['validity_status']);
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("validity.php?action=edit&validity_id=$o->validity_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("validity.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("validity.php?action=edit&validity_id=$o->validity_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("validity.php?action=edit&validity_id=$o->validity_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchValidityDetail(" AND validity_id = '$o->validity_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("validity.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("validity.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("validity.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "getValidityDetail":
            $query = $o->fetchValidityDetail(" AND validity_id = '$o->validity_id'","","",0);
            $r = mysqli_fetch_array($query);
            
            echo json_encode(array('status'=>1,'validity_desc'=>$r['validity_desc']));
            exit();
            break; 
   
        case "getJsonData":
            $row = $o->fetchValidityDetail(" AND validity_id = '$o->validity_id'","","",2);
            echo json_encode(array('remark'=>$row['validity_desc']));
            exit();
            break; 
        default: 
            $o->getListing();
            exit();
            break;
    }


