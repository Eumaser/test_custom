<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Empl.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Empl();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;
    
    $action = escape($_REQUEST['action']);
    $o->empl_id = escape($_REQUEST['empl_id']);
    if($action == 'update'){
        $o->fetchEmplDetail(" AND empl_id = '$o->empl_id'","","",1);
        $o->empl_oldpassword = $o->empl_login_password;
    }
   
    $o->empl_name = escape($_POST['empl_name']);
    $o->empl_nric = escape($_POST['empl_nric']);
    $o->empl_tel = escape($_POST['empl_tel']);
    $o->empl_mobile = escape($_POST['empl_mobile']);
    $o->empl_birthday = escape($_POST['empl_birthday']);
    $o->empl_joindate = escape($_POST['empl_joindate']);
    $o->empl_group = escape($_POST['empl_group']);
    $o->empl_address = escape($_POST['empl_address']);
    $o->empl_remark = escape($_POST['empl_remark']);
    $o->image_input = $_FILES['image_input'];
    $o->empl_seqno = escape($_POST['empl_seqno']);
    $o->empl_status = escape($_POST['empl_status']);
    $o->empl_email = escape($_POST['empl_email']);
    $o->empl_outlet = escape($_POST['empl_outlet']);
    $o->empl_login_email = escape($_POST['empl_login_email']);
    $o->empl_login_password = escape($_POST['empl_login_password']);
    $o->empl_department = escape($_POST['empl_department']);
    $o->empl_bank = escape($_POST['empl_bank']);
    $o->empl_bank_acc_no = escape($_POST['empl_bank_acc_no']);
    $o->empl_nationality = escape($_POST['empl_nationality']);
    $o->empl_emplpass = escape($_POST['empl_emplpass']);
    $o->empl_resigndate = escape($_POST['empl_resigndate']);
    $o->empl_confirmationdate = escape($_POST['empl_confirmationdate']);
    $o->emplleave_leavetype = $_POST['emplleave_leavetype'];
    $o->emplleave_id = $_POST['emplleave_id'];
    $o->emplleave_days = $_POST['emplleave_days'];
    $o->current_tab = escape($_REQUEST['current_tab']);
    $o->empl_language = escape($_REQUEST['empl_language']);
    
    
    //Salary
    $o->emplsalary_date = escape($_POST['emplsalary_date']);
    $o->emplsalary_amount = str_replace(",", "",escape($_POST['emplsalary_amount']));
    $o->emplsalary_overtime = str_replace(",", "",escape($_POST['emplsalary_overtime']));
    $o->emplsalary_hourly = str_replace(",", "",escape($_POST['emplsalary_hourly']));
    $o->emplsalary_workday = escape($_POST['emplsalary_workday']);
    $o->emplsalary_id = escape($_REQUEST['emplsalary_id']);
    $o->emplsalary_remark = escape($_POST['emplsalary_remark']);
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("empl.php?action=edit&empl_id=$o->empl_id&current_tab=General",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("empl.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("empl.php?action=edit&empl_id=$o->empl_id&current_tab=$o->current_tab",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("empl.php?action=edit&empl_id=$o->empl_id&current_tab=$o->current_tab",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchEmplDetail(" AND empl_id = '$o->empl_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("empl.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
        case "view":
            if($o->fetchEmplDetail(" AND empl_id = '$o->empl_id'","","",1)){
                $o->getInputForm("view");
            }else{
               rediectUrl("empl.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break; 
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("empl.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("empl.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "validate_email":
            $t = $gf->checkDuplicate("db_empl",'empl_login_email',$o->empl_login_email,'empl_id',$o->empl_id);
            if($t > 0){
                echo "false";
            }else{
                echo "true";
            }
            exit();
            break; 
        case "saveSalary":
            if($o->emplsalary_id > 0){
                if($o->updateSalary()){
                    echo json_encode(array('status'=>1));
                }else{
                    echo json_encode(array('status'=>0));
                }
            }else{
                if($o->createSalary()){
                    echo json_encode(array('status'=>1));
                }else{
                    echo json_encode(array('status'=>0));
                }
            }
            exit();
            break;
        case "deletesalary":
            if($o->deleteSalary()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("empl.php?action=edit&empl_id=$o->empl_id&current_tab=$o->current_tab",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("empl.php?action=edit&empl_id=$o->empl_id&current_tab=$o->current_tab",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break; 
        default: 
            $o->getListing();
            exit();
            break;
    }


