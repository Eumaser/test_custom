<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Productgroup.php';
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'class/SelectControl.php';
    include_once 'language.php';
    $p = new Productgroup();
    $s = new SavehandlerApi();
    $p->save = $s;
    $p->select = new SelectControl();
    $p->document_url = 'productgroup.php';
    $p->maingroup_id        = escape($_REQUEST['maingroup_id']);
    $p->maingroup_name      = escape($_REQUEST['maingroup_name']);
    $p->maingroup_remark    = escape($_REQUEST['maingroup_remark']);
    $p->maingroup_seqno     = escape($_REQUEST['maingroup_seqno']);
    $p->maingroup_status    = escape($_REQUEST['maingroup_status']);

    $p->subgroup_id      = escape($_POST['subgroup_id']);
    $p->subgroup_main_id = escape($_POST['subgroup_main_id']);
    $p->subgroup_name    = escape($_POST['subgroup_name']);
    $p->subgroup_remark  = escape($_POST['subgroup_remark']);
    $p->subgroup_seqno   = escape($_POST['subgroup_seqno']);
    $p->subgroup_status  = escape($_POST['subgroup_status']);
    
    $action = $_REQUEST['action'];
    switch($action){
        case "create":
            if($p->createMain()){
                rediectUrl("$p->document_url?action=edit&maingroup_id=$p->maingroup_id",getSystemMsg(1,'Create data successfully'));
            }else{
                rediectUrl("$p->document_url?action=create_form",getSystemMsg(0,'Create data fail'));
            }
            break;
        case "createForm":
            $p->getInputForm('create');
            exit();
            break;
        case "edit":
            if(($p->fetchMainDetail(" AND maingroup_id = '$p->maingroup_id'","","",1))  && ($p->maingroup_id > 0)){
                $p->getInputForm("update");
            }else{
                rediectUrl("$p->document_url",getSystemMsg(0,'Record Not Found.'));
            }
            break;
        case "update":
            //$p->status = 0;
            if($p->updateMain()){
                rediectUrl("$p->document_url?action=edit&maingroup_id=$p->maingroup_id",getSystemMsg(1,'Update data successfully'));
            }else{
                rediectUrl("$p->document_url?action=edit&maingroup_id=$p->maingroup_id",getSystemMsg(0,'Update data fail'));
            }
            break;
        case "delete":
            $p->order_status = "0";
            if($p->delete()){
                rediectUrl("$p->document_url",getSystemMsg(1,'Delete data successfully'));
            }else{
                rediectUrl("$p->document_url?action=edit&maingroup_id=$p->maingroup_id",getSystemMsg(0,'Delete data fail'));
            }
            break;
        case "saveline":
        case "updateline":
            if($p->subgroup_id > 0 && $action == 'updateline'){
                $issuccess = $p->updateSubLine();
            }else{
                $issuccess = $p->createSubLine();
            }
            if($issuccess){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0,'msg'=>$language[$lang]['addeditline_error']));
            }
            exit();
            break;
        case "deleteline":
            if($p->deleteSubLine()){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        default:  
            $p->getListing();
            exit();
            break; 
    }   