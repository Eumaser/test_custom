<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Remarks.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Remarks();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->remarks_id = escape($_REQUEST['remarks_id']);
    $o->remarks_code = escape($_POST['remarks_code']);
    $o->remarks_desc = escape($_POST['remarks_desc']);
    $o->remarks_seqno = escape($_POST['remarks_seqno']);
    $o->remarks_status = escape($_POST['remarks_status']);
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("remarks.php?action=edit&remarks_id=$o->remarks_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("remarks.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("remarks.php?action=edit&remarks_id=$o->remarks_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("remarks.php?action=edit&remarks_id=$o->remarks_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchRemarksDetail(" AND remarks_id = '$o->remarks_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("remarks.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("remarks.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("remarks.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "getServiceFeesDetail":
            $query = $o->fetchRemarksDetail(" AND remarks_id = '$o->remarks_id'","","",0);
            $r = mysqli_fetch_array($query);
            
            echo json_encode(array('status'=>1,'remarks_desc'=>$r['remarks_desc']));
            exit();
            break;     
        case "getJsonData":
            $row = $o->fetchRemarksDetail(" AND remarks_id = '$o->remarks_id'","","",2);
            echo json_encode(array('remark'=>$row['remarks_desc']));
            exit();
            break;  
        default: 
            $o->getListing();
            exit();
            break;
    }


