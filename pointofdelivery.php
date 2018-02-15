<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Pointofdelivery.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Pointofdelivery();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->pointofdelivery_id = escape($_REQUEST['pointofdelivery_id']);
    $o->pointofdelivery_code = escape($_POST['pointofdelivery_code']);
    $o->pointofdelivery_desc = escape($_POST['pointofdelivery_desc']);
    $o->pointofdelivery_seqno = escape($_POST['pointofdelivery_seqno']);
    $o->pointofdelivery_status = escape($_POST['pointofdelivery_status']);
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("pointofdelivery.php?action=edit&pointofdelivery_id=$o->pointofdelivery_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("pointofdelivery.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("pointofdelivery.php?action=edit&pointofdelivery_id=$o->pointofdelivery_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("pointofdelivery.php?action=edit&pointofdelivery_id=$o->pointofdelivery_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchPointofdeliveryDetail(" AND pointofdelivery_id = '$o->pointofdelivery_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("pointofdelivery.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("pointofdelivery.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("pointofdelivery.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "getServiceFeesDetail":
            $query = $o->fetchPointofdeliveryDetail(" AND pointofdelivery_id = '$o->pointofdelivery_id'","","",0);
            $r = mysqli_fetch_array($query);
            
            echo json_encode(array('status'=>1,'pointofdelivery_desc'=>$r['pointofdelivery_desc']));
            exit();
            break;     
        case "getJsonData":
            $row = $o->fetchPointofdeliveryDetail(" AND pointofdelivery_id = '$o->pointofdelivery_id'","","",2);
            echo json_encode(array('remark'=>$row['pointofdelivery_desc']));
            exit();
            break;  
        default: 
            $o->getListing();
            exit();
            break;
    }


