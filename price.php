<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Price.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Price();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->price_id = escape($_REQUEST['price_id']);
    $o->price_code = escape($_POST['price_code']);
    $o->price_desc = escape($_POST['price_desc']);
    $o->price_seqno = escape($_POST['price_seqno']);
    $o->price_status = escape($_POST['price_status']);
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("price.php?action=edit&price_id=$o->price_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("price.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("price.php?action=edit&price_id=$o->price_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("price.php?action=edit&price_id=$o->price_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchPriceDetail(" AND price_id = '$o->price_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("price.php",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("price.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("price.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "getServiceFeesDetail":
            $query = $o->fetchPriceDetail(" AND price_id = '$o->price_id'","","",0);
            $r = mysqli_fetch_array($query);
            
            echo json_encode(array('status'=>1,'price_desc'=>$r['price_desc']));
            exit();
            break;     
        case "getJsonData":
            $row = $o->fetchPriceDetail(" AND price_id = '$o->price_id'","","",2);
            echo json_encode(array('remark'=>$row['price_desc']));
            exit();
            break;  
        default: 
            $o->getListing();
            exit();
            break;
    }


