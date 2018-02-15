<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Transittime.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Transittime();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->transittime_id = escape($_REQUEST['transittime_id']);
    $o->transittime_code = escape($_POST['transittime_code']);
    $o->transittime_desc = escape($_POST['transittime_desc']);
    $o->transittime_seqno = escape($_POST['transittime_seqno']);
    $o->transittime_status = escape($_POST['transittime_status']);
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("transittime.php?action=edit&transittime_id=$o->transittime_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("transittime.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("transittime.php?action=edit&transittime_id=$o->transittime_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("transittime.php?action=edit&transittime_id=$o->transittime_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchTransittimeDetail(" AND transittime_id = '$o->transittime_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("transittime.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("transittime.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("transittime.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "getServiceFeesDetail":
            $query = $o->fetchTransittimeDetail(" AND transittime_id = '$o->transittime_id'","","",0);
            $r = mysqli_fetch_array($query);
            
            echo json_encode(array('status'=>1,'transittime_desc'=>$r['transittime_desc']));
            exit();
            break;     
        case "getJsonData":
            $row = $o->fetchTransittimeDetail(" AND transittime_id = '$o->transittime_id'","","",2);
            echo json_encode(array('remark'=>$row['transittime_desc']));
            exit();
            break;  
        default: 
            $o->getListing();
            exit();
            break;
    }


