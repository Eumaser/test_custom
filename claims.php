<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Claims.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Claims();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->claims_id = escape($_REQUEST['claims_id']);
    $o->claims_title = escape($_POST['claims_title']);
    $o->claims_empl_id = escape($_POST['claims_empl_id']);
    $o->claims_date = escape($_POST['claims_date']);
    $o->claims_remark = escape($_POST['claims_remark']);
    $o->claims_status = escape($_POST['claims_status']);
    $o->submit_btn = escape($_POST['submit_btn']);
    $o->org_claims_approvalstatus = escape($_POST['org_claims_approvalstatus']);
    
    //Line item
    $o->claimsline_seqno_array = $_POST['claimsline_seqno'];
    $o->claimsline_date_array = $_POST['claimsline_date'];
    $o->claimsline_type_array = $_POST['claimsline_type'];
    $o->claimsline_desc_array = $_POST['claimsline_desc'];
    $o->claimsline_receiptno_array = $_POST['claimsline_receiptno'];
    $o->claimsline_amount_array = $_POST['claimsline_amount'];
    $o->claimsline_id_array = $_POST['claimsline_id'];
    $o->claimsline_id = escape($_REQUEST['claimsline_id']);
    
    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],"approved")){// HR
        $o->claims_approvalstatus = escape($_POST['claims_approvalstatus']);
    }else{//Normal Staff
        if($o->submit_btn == 'Confirm'){
            $o->claims_approvalstatus = "Pending";
        }else{
            $o->claims_approvalstatus = "Draft";
        }
    }

    switch ($action) {
        case "create":
            if($o->create()){
                $o->createUpdateClaimsLine();
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("claims.php?action=edit&claims_id=$o->claims_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("claims.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if((getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],"approved")) && ($o->org_claims_approvalstatus <> 'Draft')){// HR
                $up = $o->updateApproveStatus();
            }else{// Normal Staff
                $up = $o->update();
            }
            if($up){
                if($o->claims_approvalstatus <> 'Draft'){
                    $o->updateApproveStatus();
                }
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("claims.php?action=edit&claims_id=$o->claims_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("claims.php?action=edit&claims_id=$o->claims_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchClaimsDetail(" AND claims_id = '$o->claims_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("claims.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("claims.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("claims.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "updateline":
            if($o->UpdateClaimsSingleLine()){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "deleteline":
            if($o->deleteClaimsLine()){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        default: 
            $o->getListing();
            exit();
            break;
    }


