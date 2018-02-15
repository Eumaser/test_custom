<?php 
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Project.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'class/Excel_reader2.php';
    $o = new Project();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->project_id = escape($_REQUEST['project_id']);
    $o->project_code = escape($_POST['project_code']);
    $o->project_code_cn = escape($_POST['project_code_cn']);
    $o->project_name = escape($_POST['project_name']);
    $o->project_desc = escape($_POST['project_desc']);
    $o->project_desc_cn = escape($_POST['project_desc_cn']);
    $o->project_price = escape($_POST['project_price']);
    $o->project_limit = escape($_POST['project_limit']);
    $o->project_startdate = format_date_database(escape($_POST['project_startdate']));
    $o->project_enddate = format_date_database(escape($_POST['project_enddate']));
    $o->project_completeddate = format_date_database(escape($_POST['project_completeddate']));
    $o->project_outlet = escape($_POST['project_outlet']);
    $o->project_remark = escape($_POST['project_remark']);
    $o->project_progress = escape($_POST['project_progress']);
    $o->project_seqno = escape($_POST['project_seqno']);
    $o->project_status = escape($_POST['project_status']);
    $o->project_leader = escape($_POST['project_leader']);
    $o->project_loaref = escape($_POST['project_loaref']);
    
    $project_subcon = $_POST['project_subcon'];

    foreach($project_subcon as $b){
        $o->project_subcon = $o->project_subcon . $b . ",";
    }
        $o->project_subcon = trim($o->project_subcon,",");
        
    $project_subcon = $_POST['project_subcon'];

    $project_site_coordinator = $_POST['project_site_coordinator'];

    foreach($project_site_coordinator as $b){
        $o->project_site_coordinator = $o->project_site_coordinator . $b . ",";
    }
        $o->project_site_coordinator = trim($o->project_site_coordinator,","); 

    /* Claim*/
    $o->pclaim_id = escape($_POST['pclaim_id']);
    $o->pclaim_type = escape($_POST['pclaim_type']);
    if($o->pclaim_type == 'site'){
        $o->pclaim_by = escape($_POST['pclaim_by_coordinator']);
    }else{
        $o->pclaim_by = escape($_POST['pclaim_by_contractor']);
    }
    
    $o->pclaim_date = escape($_POST['pclaim_date']);
    if($o->pclaim_date == ""){
        $o->pclaim_date = system_date;
    }
    $o->pclaim_amount = escape($_POST['pclaim_amount']);
    $o->project_status = escape($_POST['project_status']);
    $o->pclaim_remarks = escape($_POST['pclaim_remarks']);
    
    $o->pempl_id = escape($_POST['pempl_id']);
    $o->pworker_remarks = escape($_POST['pworker_remarks']);
    $o->pworker_id = escape($_REQUEST['pworker_id']);
    $o->project_customer = escape($_POST['project_customer']);

    
    $o->vo_id = escape($_POST['vo_id']);
    $o->vo_date = escape($_POST['vo_date']);
    $o->vo_ref = escape($_POST['vo_ref']);
    $o->vo_amount = escape($_POST['vo_amount']);
    $o->vo_remarks = escape($_POST['vo_remarks']); 
    
    $o->pequipment_id = escape($_POST['pequipment_id']);
    $o->pequipment_equipment = escape($_POST['pequipment_equipment']);
    $o->pequipment_remarks = escape($_POST['pequipment_remarks']);
    $o->pequipment_location = escape($_POST['pequipment_location']);
    
    
    $o->pattendance_id = escape($_REQUEST['pattendance_id']);
    $o->pattendance_date = escape($_POST['pattendance_date']);
    $o->pattendance_ina = escape($_POST['pattendance_ina']);
    if($o->pattendance_ina == 'on'){
        $o->pattendance_ina = 1;
    }else{
        $o->pattendance_ina = 0;
    }
    $o->pattendance_outa = escape($_POST['pattendance_outa']);
    $o->pattendance_inb = escape($_POST['pattendance_inb']);
    if($o->pattendance_inb == 'on'){
        $o->pattendance_inb = 1;
    }else{
        $o->pattendance_inb = 0;
    }
    
    $o->pattendance_outb = escape($_POST['pattendance_outb']);
    $o->pattendance_inc = escape($_POST['pattendance_inc']);
    if($o->pattendance_inc == 'on'){
        $o->pattendance_inc = 1;
    }else{
        $o->pattendance_inc = 0;
    }
    $o->pattendance_outc = escape($_POST['pattendance_outc']);
    $o->pattendance_remarks = escape($_POST['pattendance_remarks']);
    $o->pattendance_pempl = escape($_REQUEST['pattendance_pempl']);
    $o->pattendance_project = escape($_REQUEST['pattendance_project']);
    
    $o->pw_id = escape($_POST['pw_id']);
    $o->pw_pwlocation = escape($_POST['pw_pwlocation']);
    $o->pw_labour = escape($_POST['pw_labour']);
    $o->pw_qty = escape($_POST['pw_qty']);
    $o->pw_subcon = escape($_POST['pw_subcon']);
    $o->pw_remarks = escape($_POST['pw_remarks']);
    $o->pw_proaward_id = escape($_POST['pw_proaward_id']);
    
    
    $o->pwl_id = escape($_POST['pwl_id']);
    $o->pwl_ordl_id = escape($_POST['pwl_ordl_id']);
    $o->pwl_qty = escape($_POST['pwl_qty']);
    
    
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("project.php?action=edit&project_id=$o->project_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("project.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":

            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("project.php?action=edit&project_id=$o->project_id",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("project.php?action=edit&project_id=$o->project_id",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchProjectDetail(" AND p.project_id = '$o->project_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("project.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("project.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("project.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "validate_project":
            $t = $gf->checkDuplicate("db_project",'project_code',$o->project_code,'project_id',$o->project_id);
            if($t > 0){
                echo "false";
            }else{
                echo "true";
            }
            exit();
            break;  
        case "getDataTable":
            $o->getDataTable();
            exit();
            break;
        case "createClaim":
            if($o->createClaim()){
                echo json_encode(array('status'=>1,'tab'=>'claim_tab'));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "fetch_claim":
            $r = $o->fetchClaimDetail();
            if(is_array($r)){
                echo json_encode(array('status'=>1,'pclaim_date'=>format_date($r['pclaim_date']),'pclaim_amount'=>$r['pclaim_amount'],
                                       'pclaim_remarks'=>$r['pclaim_remarks'],'pempl_issuedate'=>format_date($r['pempl_issuedate']),
                                       'pclaim_type'=>$r['pclaim_type'],'pclaim_by'=>$r['pclaim_by'],'pclaim_id'=>$r['pclaim_id']));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "createSubconWorker":
            if($o->pworker_id > 0){
                $success_msg = "Update subcon's worker successfully.";
                $fail_msg = "Update subcon's worker fail";
            }else{
                $success_msg = "Create subcon's worker successfully.";
                $fail_msg = "Create subcon's worker fail";
            }
            if($o->createSubconWorker()){
                echo json_encode(array('status'=>1,'tab'=>'worker_tab','msg'=>$success_msg));
            }else{
                echo json_encode(array('status'=>0,'msg'=>$fail_msg));
            }
            exit();
            break;
        case "fetch_subcon_worker":
            $r = $o->fetchSubconWorkerDetail();
            if(is_array($r)){
                echo json_encode(array('status'=>1,'pempl_id'=>$r['pempl_id'],'pworker_remarks'=>$r['pworker_remarks'],'pworker_id'=>$r['pworker_id']));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "createVO":
            if($o->createVO()){
                echo json_encode(array('status'=>1,'tab'=>'vo_tab'));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "fetch_vo":
            $r = $o->fetchVODetail();
            if(is_array($r)){
                echo json_encode(array('status'=>1,'vo_id'=>$r['pempl_name'],'vo_ref'=>$r['vo_ref'],'vo_id'=>$r['vo_id'],
                                       'vo_date'=>format_date($r['pempl_wpno']),'vo_amount'=>num_format($r['vo_amount'])));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "createEquipment":
            if($o->createEquipment()){
                echo json_encode(array('status'=>1,'tab'=>'equip_tab'));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "fetch_equipment":
            $r = $o->fetchEquipmentDetail();
            if(is_array($r)){
                echo json_encode(array('status'=>1,'pequipment_id'=>$r['pequipment_id'],'pequipment_equipment'=>$r['pequipment_equipment'],'pequipment_location'=>$r['pequipment_location'],
                                       'pequipment_remarks'=>$r['pequipment_remarks']));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "delete_subcon_worker":

            if($o->deleteSubconWorker()){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "delete_project_claim":
            
            if($o->deleteProjectClaim()){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getProjectDetail":
            $r = $o->getProjectDetailTransaction();
            if(($_SESSION['empl_language'] == "chinese") && ($r['project_desc_cn'] != "")){//taiwan
                $project_desc = $r['project_desc_cn'];
            }else if(($_SESSION['empl_language'] == "thai") && ($r['project_desc_thai'] != "")){//thailand
                $project_desc = $r['project_desc_thai'];
            }else{
                $project_desc = $r['project_desc'];
            }
            if($_SESSION['empl_type'] == 'SUBCON'){
                $project_subcon = "'{$_SESSION['empl_id']}'";//subcon
                $subcon_option = $o->select->getCustomerSelectCtrl($_SESSION['empl_id'],'N'," AND partner_issubcon = 1 AND partner_id IN ($project_subcon)");
            }else{
                $b = explode(',',$r['project_subcon']);
                for($i=0;$i<sizeof($b);$i++){
                    $project_subcon .= "'" . $b[$i] . "',";
                }
                $project_subcon = trim($project_subcon,",");
                 $subcon_option = $o->select->getCustomerSelectCtrl('','Y'," AND partner_issubcon = 1 AND partner_id IN ($project_subcon)");
            }

           
            
            echo json_encode(array('project_limit'=>$r['project_limit'],'project_desc'=>$project_desc,
                                   'project_price'=>$r['project_price'],'project_progress'=>$r['project_progress'],
                                   'project_code'=>$r['project_code'],'subcon_option'=>$subcon_option));
            exit();
            break;
        case "attendance":
            
            $o->getAttendanceForm();
            exit();
            break;
        case "pattendance_create":
           
            if($o->pattendance_id > 0){
//                if($o->updateProjectAttendance()){
//                    $_SESSION['status_alert'] = 'alert-success';
//                    $_SESSION['status_msg'] = "Create success.";
//                    rediectUrl("project.php?action=attendance&pattendance_project=$o->pattendance_project&pattendance_pempl=$o->pattendance_pempl",getSystemMsg(1,'Create data successfully'));
//                }else{
//                    $_SESSION['status_alert'] = 'alert-error';
//                    $_SESSION['status_msg'] = "Create fail.";
//                    rediectUrl("project.php?action=attendance&pattendance_project=$o->pattendance_project&pattendance_pempl=$o->pattendance_pempl",getSystemMsg(0,'Create data fail'));
//                }
            }else{
                if($o->createProjectAttendance()){
                    $_SESSION['status_alert'] = 'alert-success';
                    $_SESSION['status_msg'] = "Create success.";
                    rediectUrl("project.php?action=attendance&pattendance_project=$o->pattendance_project&pattendance_pempl=$o->pattendance_pempl",getSystemMsg(1,'Create data successfully'));
                }else{
                    $_SESSION['status_alert'] = 'alert-error';
                    $_SESSION['status_msg'] = "Create fail.";
                    rediectUrl("project.php?action=attendance&pattendance_project=$o->pattendance_project&pattendance_pempl=$o->pattendance_pempl",getSystemMsg(0,'Create data fail'));
                }
            }
            exit();
            break;
        case "deleteProjectAttendance":
            if($o->deleteProjectAttendance()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("project.php?action=attendance&pattendance_project=$o->pattendance_project&pattendance_pempl=$o->pattendance_pempl",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("project.php?action=attendance&pattendance_project=$o->pattendance_project&pattendance_pempl=$o->pattendance_pempl",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;
        case "refreshProjectWorkLine":
            $html = $o->getProjectWorkLine();
            echo json_encode(array('html'=>$html));
            exit();
            break;

        case "createWork":
            if($o->createWork()){
                echo json_encode(array('status'=>1,'tab'=>'work_tab'));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "fetch_work":
            $r = $o->fetchWorkDetail();
            if(is_array($r)){
                echo json_encode(array('status'=>1,'pw_project_id'=>$r['pw_project_id'],'pwdescription'=>$r['pwdescription'],
                                       'pwsubcon'=>$r['pwsubcon'],'pwlocation'=>$r['pwlocation'],'pw_id'=>$r['pw_id']));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "delete_project_work":
            
            if($o->deleteProjectWork()){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
       case "savepwlline":
       case "updatepwlline":    

            if($action == 'updatepwlline'){
                $issuccess = $o->updateWorkLine();
            }else{
                $issuccess = $o->createWorkLine();
            }
            if($issuccess){
                echo json_encode(array('status'=>1,'pw_id'=>$o->pw_id));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "viewawardeditem":
            $sql = "SELECT COUNT(*) as total FROM db_proaward WHERE proaward_project = '$o->project_id'";
            $query = mysql_query($sql);
            if($row = mysql_fetch_array($query)){
                $total = $row['total'];
            }else{
                $total = 0;
            }
            if($total > 0){
                $o->islockaward = true;
            }else{
                $o->islockaward = false;
            }
            $o->viewAwardedItem();
            exit();
            break;
        case "lock_award_items":
                $o->lock_award_items();
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("project.php?action=viewawardeditem&project_id=$o->project_id",getSystemMsg(1,'Update data successfully'));
            exit();
            break;
        case "unlock_award_items":
                $o->unlock_award_items();
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("project.php?action=viewawardeditem&project_id=$o->project_id",getSystemMsg(1,'Update data successfully'));
            exit();
            break;
        case "viewSubconItem":
            $sql = "SELECT COUNT(*) as total FROM db_proaward WHERE proaward_project = '$o->project_id'";
            $query = mysql_query($sql);
            if($row = mysql_fetch_array($query)){
                $total = $row['total'];
            }else{
                $total = 0;
            }
            if($total > 0){
                $o->islockaward = true;
            }else{
                $o->islockaward = false;
            }
            $o->viewSubconItem();
            exit();
            break;
        case "uploadpicture":
            $o->uploadpictureform();
            
            exit();
            break;
        case "deletepicture":
            $o->image_id = escape($_REQUEST['image_id']);
            $o->image_type = escape($_REQUEST['image_type']);
            if($o->deletepicture()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("project.php?action=uploadpicture&project_id=$o->project_id",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("project.php?action=uploadpicture&project_id=$o->project_id",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;
        case "project_file":
            $o->project_file_remarks = escape($_POST['project_file_remarks']);
            if($o->createProjectFiles()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("project.php?action=uploadpicture&project_id=$o->project_id",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("project.php?action=uploadpicture&project_id=$o->project_id",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        default: 
            $o->getListing();
            exit();
            break;
    }


