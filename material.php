<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Material.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Material();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->material_id = escape($_REQUEST['material_id']);
    $o->material_code = escape($_POST['material_code']);
    $o->material_category = escape($_POST['material_category']);
    $o->material_sale_price = escape($_POST['material_sale_price']);
    $o->material_cost_price = escape($_POST['material_cost_price']);
    $o->material_remarks = escape($_POST['material_remarks']);
    $o->material_desc = escape($_POST['material_desc']);
    $o->material_seqno = escape($_POST['material_seqno']);
    $o->material_status = escape($_POST['material_status']);
    
    $o->materialline_partner_id = $_POST['materialline_partner_id'];
    $o->materialline_saleprice = $_POST['materialline_saleprice'];
    $o->materialline_id = $_POST['materialline_id'];
    
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("material.php?action=edit&material_id=$o->material_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("material.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("material.php?action=edit&material_id=$o->material_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("material.php?action=edit&material_id=$o->material_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchMaterialDetail(" AND material_id = '$o->material_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("material.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("material.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("material.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break; 
        case "deleteline":
            if($o->deleteMaterialLine()){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "validate_email":
            $t = $gf->checkDuplicate("material",'material_login_email',$o->material_login_email,'material_id',$o->material_id);
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


