<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Freightcharge.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Freightcharge();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->freightcharge_id = escape($_REQUEST['freightcharge_id']);
    $o->freightcharge_code = escape($_POST['freightcharge_code']);
    $o->freightcharge_desc = escape($_POST['freightcharge_desc']);
    $o->freightcharge_seqno = escape($_POST['freightcharge_seqno']);
    $o->freightcharge_status = escape($_POST['freightcharge_status']);
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("freightcharge.php?action=edit&freightcharge_id=$o->freightcharge_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("freightcharge.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("freightcharge.php?action=edit&freightcharge_id=$o->freightcharge_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("freightcharge.php?action=edit&freightcharge_id=$o->freightcharge_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchFreightchargeDetail(" AND freightcharge_id = '$o->freightcharge_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("freightcharge.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("freightcharge.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("freightcharge.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "getServiceFeesDetail":
            $query = $o->fetchFreightchargeDetail(" AND freightcharge_id = '$o->freightcharge_id'","","",0);
            $r = mysqli_fetch_array($query);
            
            echo json_encode(array('status'=>1,'freightcharge_desc'=>$r['freightcharge_desc']));
            exit();
            break;     
        case "getJsonData":
            $row = $o->fetchFreightchargeDetail(" AND freightcharge_id = '$o->freightcharge_id'","","",2);
            echo json_encode(array('remark'=>$row['freightcharge_desc']));
            exit();
            break;  
        default: 
            $o->getListing();
            exit();
            break;
    }


