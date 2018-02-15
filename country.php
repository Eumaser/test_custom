<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Country.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Country();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->country_id = escape($_REQUEST['country_id']);
    $o->country_code = escape($_POST['country_code']);
    $o->country_desc = escape($_POST['country_desc']);
    $o->country_seqno = escape($_POST['country_seqno']);
    $o->country_status = escape($_POST['country_status']);
    $o->category = escape($_REQUEST['cat']);
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("country.php?action=edit&country_id=$o->country_id&cat=$o->category",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("country.php?cat=$o->category",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("country.php?action=edit&country_id=$o->country_id&cat=$o->category",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("country.php?action=edit&country_id=$o->country_id&cat=$o->category",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchCountryDetail(" AND country_id = '$o->country_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("country.php?cat=$o->category",getSystemMsg(0,'Fetch Data fail'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("country.php?cat=$o->category",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("country.php?cat=$o->category",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "getServiceFeesDetail":
            $query = $o->fetchCountryDetail(" AND country_id = '$o->country_id'","","",0);
            $r = mysqli_fetch_array($query);
            
            echo json_encode(array('status'=>1,'country_desc'=>$r['country_desc']));
            exit();
            break;     
        case "getJsonData":
            $row = $o->fetchCountryDetail(" AND country_id = '$o->country_id'","","",2);
            echo json_encode(array('remark'=>$row['country_desc']));
            exit();
            break;  
        default: 
            $o->getListing();
            exit();
            break;
    }


