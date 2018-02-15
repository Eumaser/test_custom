<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Equipment.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Equipment();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;
    
    $action = escape($_REQUEST['action']);
    $o->equipment_id = escape($_REQUEST['equipment_id']);
    $o->equipment_code = escape($_POST['equipment_code']);
    $o->equipment_seqno = escape($_POST['equipment_seqno']);
    $o->equipment_desc = escape($_POST['equipment_desc']);
    $o->equipment_status = escape($_POST['equipment_status']);
    $o->equipment_project = escape($_POST['equipment_project']);

    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("equipment.php?action=edit&equipment_id=$o->equipment_id",getSystemMsg(1,'Create data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("equipment.php",getSystemMsg(0,'Create data'));
            }
            exit();
            break; 
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("equipment.php?action=edit&equipment_id=$o->equipment_id",getSystemMsg(1,'Update data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("equipment.php?action=edit&equipment_id=$o->equipment_id",getSystemMsg(0,'Update data'));
            }
            exit();
            break;    
        case "edit":
            if($o->fetchEquipmentDetail(" AND equipment_id = '$o->equipment_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("equipment.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("equipment.php",getSystemMsg(1,'Delete data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("equipment.php?action=edit&equipment_id=$o->equipment_id",getSystemMsg(0,'Delete data'));
            }
            exit();
            break; 
        case "validate_equipment":
            if($o->validateMequipment($o->equipment_code,$o->equipment_id)){
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


