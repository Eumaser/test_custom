<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Dashboard.php';
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Dashboard();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->dashboard_id = escape($_REQUEST['dashboard_id']);
    $o->dashboard_type = escape($_POST['dashboard_type']);
    $o->dashboard_duration = escape($_POST['dashboard_duration']);
    $o->dashboard_datefrom = escape($_POST['dashboard_datefrom']);
    $o->dashboard_dateto = escape($_POST['dashboard_dateto']);
    $o->dashboard_period_half = escape($_POST['dashboard_period_half']);
    $o->dashboard_period_hourly = escape($_POST['dashboard_period_hourly']);
    $o->dashboard_reason = escape($_POST['dashboard_reason']);
    $o->dashboard_status = escape($_POST['dashboard_status']);
    $o->submit_btn = escape($_POST['submit_btn']);
    $o->org_dashboard_approvalstatus = escape($_POST['org_dashboard_approvalstatus']);


    if($_SESSION['empl_group'] == '2'){// HR
        $o->dashboard_approvalstatus = escape($_POST['dashboard_approvalstatus']);
    }else{//Normal Staff
        if($o->submit_btn == 'Confirm'){
            $o->dashboard_approvalstatus = "Pending";
        }else{
            $o->dashboard_approvalstatus = "Draft";
        }
    }

    if($o->dashboard_duration == "half_day"){
        $o->dashboard_dateto = $o->dashboard_datefrom;
        $o->dashboard_period_hourly = "";
        $o->dashboard_total_day = 0.5;
    }else if($o->dashboard_duration == "hourly"){
        $o->dashboard_dateto = $o->dashboard_datefrom;
        $o->dashboard_period_half = "";
        $o->dashboard_total_day = 0;
    }else{
        $o->dashboard_period_half = "";
        $o->dashboard_period_hourly = "";
        $date1 = new DateTime($o->dashboard_datefrom);
        $date2 = new DateTime($o->dashboard_dateto);

        $diff = $date2->diff($date1)->format("%a");

        $o->dashboard_total_day = $diff+1;
    }

    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("dashboard.php?action=edit&dashboard_id=$o->dashboard_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("dashboard.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if((getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],"approved")) && ($o->org_dashboard_approvalstatus <> 'Draft')){// HR
                $up = $o->updateApproveStatus();
            }else{// Normal Staff
                $up = $o->update();
            }
            if($up){
                if($o->dashboard_approvalstatus <> 'Draft'){
                    $o->updateApproveStatus();
                }
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("dashboard.php?action=edit&dashboard_id=$o->dashboard_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("dashboard.php?action=edit&dashboard_id=$o->dashboard_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;
        case "edit":
            if($o->fetchDashboardDetail(" AND dashboard_id = '$o->dashboard_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("dashboard.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("dashboard.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("dashboard.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;
        case "validate_email":
            $t = $gf->checkDuplicate("dashboard",'dashboard_login_email',$o->dashboard_login_email,'dashboard_id',$o->dashboard_id);
            if($t > 0){
                echo "false";
            }else{
                echo "true";
            }
            exit();
            break;
        default:
          //die('test'); 
            $o->getInputForm();

            exit();
            break;
    }
