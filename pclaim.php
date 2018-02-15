<?php 
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Pclaim.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'class/Excel_reader2.php';
    $o = new Pclaim();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->pclaim_id = escape($_REQUEST['pclaim_id']);
    $o->pclaim_project_id = escape($_POST['pclaim_project_id']);
    $o->pclaim_amount = str_replace(",", "",escape($_POST['pclaim_amount']));
    $o->pclaim_remarks = escape($_POST['pclaim_remarks']);
    $o->pclaim_status = escape($_POST['pclaim_status']);
    $o->smt = escape($_POST['smt']);
    
    if($o->pclaim_date == ""){
        $o->pclaim_date = system_date;
    }

    $o->pclaimline_qty = str_replace(",", "",$_POST['pclaimline_qty']);
    $o->pclaimline_uprice = str_replace(",", "",$_POST['pclaimline_uprice']);
    $o->pclaimline_pro_remark = str_replace(",", "",$_POST['pclaimline_pro_remark']);
    $o->pclaimline_pro_desc = escape($_POST['pclaimline_pro_desc']);
    $o->pclaimline_id = escape($_REQUEST['pclaimline_id']);
    $o->pcliamline_pro_id = escape($_POST['pcliamline_pro_id']);
    $o->isqa = escape($_REQUEST['isqa']);
    
    $o->pclaimline_cerqty = escape($_POST['pclaimline_cerqty']);
    $o->pclaimline_ceruprice = escape($_REQUEST['pclaimline_ceruprice']);
    $o->pclaimline_cerremark = escape($_POST['pclaimline_cerremark']);
    
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("pclaim.php?action=edit&pclaim_id=$o->pclaim_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("pclaim.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":

            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("pclaim.php?action=edit&pclaim_id=$o->pclaim_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("pclaim.php?action=edit&pclaim_id=$o->pclaim_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchPclaimDetail(" AND p.pclaim_id = '$o->pclaim_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("pclaim.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("pclaim.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("pclaim.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "validate_pclaim":
            $t = $gf->checkDuplicate("db_pclaim",'pclaim_code',$o->pclaim_code,'pclaim_id',$o->pclaim_id);
            if($t > 0){
                echo "false";
            }else{
                echo "true";
            }
            exit();
            break;  
       case "saveline":
       case "updateline":    
            if($o->pclaimline_id > 0 && $action == 'updateline'){
                $issuccess = $o->updateClaimLine();
            }else{
                $issuccess = $o->createClaimLine();
            }
            if($issuccess){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0,'msg'=>$language[$lang]['addeditline_error']));
            }
            exit();
            break;
       case "deleteline":
           if($o->deleteOrderLine()){
               echo json_encode(array('status'=>1));
           }else{
               echo json_encode(array('status'=>0));
           }
           exit();
           break;
        case "getLabourDescription":
                $sql = "SELECT * FROM db_labour WHERE labour_id = '$o->pcliamline_pro_id'  ";
                $query = mysql_query($sql);
                
                if($row = mysql_fetch_array($query)){
                    echo json_encode(array('status'=>1,'desc'=>$row['labour_desc']));
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


