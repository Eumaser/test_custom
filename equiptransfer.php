<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Equiptransfer.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'class/Equipment.php'; 
    $o = new Equiptransfer();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    
    $e = new Equipment();
    $o->save = $s;
    
    $action = escape($_REQUEST['action']);
    $o->equiptransfer_id = escape($_REQUEST['equiptransfer_id']);
    $o->equiptransfer_equip_id = escape($_REQUEST['equiptransfer_equip_id']);
    $o->equiptransfer_currentlocation = escape($_POST['equiptransfer_currentlocation']);
    $o->equiptransfer_transferto = escape($_POST['equiptransfer_transferto']);
    $o->equiptransfer_desc = escape($_POST['equiptransfer_desc']);
    $o->equiptransfer_status = escape($_POST['equiptransfer_status']);
    $o->equiptransfer_date = escape($_POST['equiptransfer_date']);

    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("equiptransfer.php?action=edit&equiptransfer_id=$o->equiptransfer_id",getSystemMsg(1,'Create data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("equiptransfer.php",getSystemMsg(0,'Create data'));
            }
            exit();
            break; 
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("equiptransfer.php?action=edit&equiptransfer_id=$o->equiptransfer_id",getSystemMsg(1,'Update data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("equiptransfer.php?action=edit&equiptransfer_id=$o->equiptransfer_id",getSystemMsg(0,'Update data'));
            }
            exit();
            break;    
        case "edit":
            if($o->fetchEquiptransferDetail(" AND equiptransfer_id = '$o->equiptransfer_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("equiptransfer.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("equiptransfer.php",getSystemMsg(1,'Delete data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("equiptransfer.php?action=edit&equiptransfer_id=$o->equiptransfer_id",getSystemMsg(0,'Delete data'));
            }
            exit();
            break; 
        case "fetchequipment":
            if($e->fetchEquipmentDetail(" AND equipment_id = '$o->equiptransfer_equip_id'","","",1)){
                echo json_encode(array('equipment_project'=>$e->equipment_project,'status'=>1));
            }else{
               rediectUrl("equiptransfer.php",getSystemMsg(0,'Fetch Data'));
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


