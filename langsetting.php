<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Langsetting.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'language.php';
    $p = new Langsetting();
    $s = new SavehandlerApi();
    $p->save = $s;
    $action = escape($_REQUEST['action']);
    $p->employee_group = escape($_REQUEST['employee_group']);
    $p->modules = escape($_REQUEST['modules']);
    $p->english = escape($_REQUEST['english']);
    $p->chinese = escape($_REQUEST['chinese']);
    $p->switch_language = escape($_REQUEST['language']);
    
    switch ($action) {
        case 'getResult':
        $p->getResult(); 
            exit();
            break;
        case 'saveResult':
        $p->saveResult(); 
            exit();
            break;
        case 'switchLanguage':
            $p->switchLanguage(); 
            echo json_encode(array('status'=>1));
            exit();
            break;
        default:
        $p->indexPage();

            break;
    }



?>
