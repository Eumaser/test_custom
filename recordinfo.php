<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Recordinfo.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Recordinfo();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->menu_id = escape($_POST['menu_id']);

    
    switch ($action) {   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;    
        default: 
            $o->fetchMenuDetail(" AND menu_id = '$o->menu_id'","","",1);
            $o->getRecordInfo();
            exit();
            break;
    }


