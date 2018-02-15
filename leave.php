<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Leave.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Leave();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->leave_id = escape($_REQUEST['leave_id']);
    $o->leave_type = escape($_POST['leave_type']);
    $o->leave_duration = escape($_POST['leave_duration']);
    $o->leave_datefrom = escape($_POST['leave_datefrom']);
    $o->leave_dateto = escape($_POST['leave_dateto']);
    $o->leave_period_half = escape($_POST['leave_period_half']);
    $o->leave_period_hourly = escape($_POST['leave_period_hourly']);
    $o->leave_reason = escape($_POST['leave_reason']);
    $o->leave_status = escape($_POST['leave_status']);
    $o->submit_btn = escape($_POST['submit_btn']);
    $o->org_leave_approvalstatus = escape($_POST['org_leave_approvalstatus']);

    
    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],"approved")){// HR
        $o->leave_approvalstatus = escape($_POST['leave_approvalstatus']);
    }else{//Normal Staff
        if($o->submit_btn == 'Confirm'){
            $o->leave_approvalstatus = "Pending";
        }else{
            $o->leave_approvalstatus = "Draft";
        }
    }

    if($o->leave_duration == "half_day"){
        $o->leave_dateto = $o->leave_datefrom;
        $o->leave_period_hourly = "";
        $o->leave_total_day = 0.5;
    }else if($o->leave_duration == "hourly"){
        $o->leave_dateto = $o->leave_datefrom;
        $o->leave_period_half = "";
        $o->leave_total_day = 0;
    }else{
        $o->leave_period_half = "";
        $o->leave_period_hourly = "";
        
        $o->leave_total_day = $o->calculateDateDifferent($o->leave_datefrom,$o->leave_dateto);

    }

    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("leave.php?action=edit&leave_id=$o->leave_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("leave.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if((getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],"approved")) && ($o->org_leave_approvalstatus <> 'Draft')){// HR
                $up = $o->updateApproveStatus();
            }else{// Normal Staff
                $up = $o->update();
            }
            if($up){
                if($o->leave_approvalstatus <> 'Draft'){
                    $o->updateApproveStatus();
                }
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("leave.php?action=edit&leave_id=$o->leave_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("leave.php?action=edit&leave_id=$o->leave_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchLeaveDetail(" AND leave_id = '$o->leave_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("leave.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("leave.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("leave.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "validate_email":
            $t = $gf->checkDuplicate("leave",'leave_login_email',$o->leave_login_email,'leave_id',$o->leave_id);
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


