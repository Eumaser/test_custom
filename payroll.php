<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Payroll.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Payroll();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->payroll_id = escape($_REQUEST['payroll_id']);
    $o->payroll_outlet = escape($_POST['payroll_outlet']);
    $o->payroll_department = escape($_POST['payroll_department']);
    $o->payroll_salary_date = escape($_POST['payroll_salary_date']);
    $o->payroll_startdate = escape($_REQUEST['payroll_startdate']);
    $o->payroll_enddate = escape($_REQUEST['payroll_enddate']);
    $o->action = escape($_POST['action']);
    $o->empl_id = escape($_REQUEST['empl_id']);

    
    switch ($action) {
        case "create":
            if($o->create()){

                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("payroll.php?action=edit&payroll_id=$o->payroll_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("payroll.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if((getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],"approved")) && ($o->org_payroll_approvalstatus <> 'Draft')){// HR
                $up = $o->updateApproveStatus();
            }else{// Normal Staff
                $up = $o->update();
            }
            if($up){
                if($o->payroll_approvalstatus <> 'Draft'){
                    $o->updateApproveStatus();
                }
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("payroll.php?action=edit&payroll_id=$o->payroll_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("payroll.php?action=edit&payroll_id=$o->payroll_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchPayrollDetail(" AND payroll_id = '$o->payroll_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("payroll.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("payroll.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("payroll.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "updateline":
            if($o->UpdatePayrollSingleLine()){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "deleteline":
            if($o->deletePayrollLine()){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "previewPayslip":
            if($o->previewPayslip()){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;  
        case "previewPayslipDetail":
           $o->previewPayslipDetail();
            exit();
            break; 
        default: 
            $o->getListing();
            exit();
            break;
    }


