<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Prefix.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Prefix();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->prefix_id = escape($_REQUEST['prefix_id']);
    $o->prefix_code = escape($_POST['prefix_code']);
    $o->prefix_desc = htmlentities(escape($_POST['prefix_desc']));
    $o->prefix_seqno = escape($_POST['prefix_seqno']);
    $o->prefix_status = escape($_POST['prefix_status']);
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("prefix.php?action=edit&prefix_id=$o->prefix_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("prefix.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("prefix.php?action=edit&prefix_id=$o->prefix_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("prefix.php?action=edit&prefix_id=$o->prefix_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchPrefixDetail(" AND prefix_id = '$o->prefix_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("prefix.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("prefix.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("prefix.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "getServiceFeesDetail":
            $query = $o->fetchPrefixDetail(" AND prefix_id = '$o->prefix_id'","","",0);
            $r = mysqli_fetch_array($query);
            
            echo json_encode(array('status'=>1,'prefix_desc'=>$r['prefix_desc']));
            exit();
            break;     
        case "getJsonData":
            $row = $o->fetchPrefixDetail(" AND prefix_id = '$o->prefix_id'","","",2);
            echo json_encode(array('remark'=>$row['prefix_desc']));
            exit();
            break;  
        default: 
            $o->getListing();
            exit();
            break;
    }


