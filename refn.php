<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Refn.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'language.php';
    $o = new Refn();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->refn_id = escape($_REQUEST['refn_id']);
    $o->refn_outl_id = escape($_POST['refn_outl_id']);
    $o->refn_menu_id = escape($_POST['refn_menu_id']);
    $o->refn_menu_name = escape($_POST['refn_menu_name']);
    $o->refn_prefix = escape($_POST['refn_prefix']);
    $o->refn_suffix = escape($_POST['refn_suffix']);
    $o->refn_length = escape($_POST['refn_length']);
    $o->refn_value = escape($_POST['refn_value']);
    
    switch ($action) {
        case "getResult":
            if($o->fetchRefnDetail(" AND refn_name = '$o->refn_menu_name' AND refn_outl_id = '$o->refn_outl_id'","","",1)){
                echo json_encode(array("status"=>1,'refn_value'=>$o->refn_value,'refn_length'=>$o->refn_length,
                                       'refn_suffix'=>$o->refn_suffix,'refn_prefix'=>$o->refn_prefix,
                                       'refn_id'=>$o->refn_id));
            }else{
                echo json_encode(array("status"=>0));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                echo json_encode(array("status"=>1));
            }else{
                echo json_encode(array("status"=>0));
            }
            exit();
            break;
        default: 
            $o->getInputForm();
            exit();
            break;
    }


