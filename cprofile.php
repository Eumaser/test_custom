<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Cprofile.php';
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    $o = new Cprofile();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->cprofile_id = escape($_REQUEST['cprofile_id']);
    $o->cprofile_name = escape($_POST['cprofile_name']);
    $o->cprofile_tel = escape($_POST['cprofile_tel']);
    $o->cprofile_fax = escape($_POST['cprofile_fax']);
    $o->cprofile_email = escape($_POST['cprofile_email']);
    $o->cprofile_address = escape($_POST['cprofile_address']);
    $o->cprofile_description = escape($_POST['cprofile_description']);
    $o->cprofile_bank = escape($_POST['cprofile_bank']);
    $o->cprofile_account = escape($_POST['cprofile_account']);
    $o->cprofile_acc_code = escape($_POST['cprofile_acc_code']);
    $o->cprofile_facebook = escape($_POST['cprofile_facebook']);
    $o->cprofile_twitter = escape($_POST['cprofile_twitter']);
    $o->cprofile_google = escape($_POST['cprofile_google']);
    $o->cprofile_youtube = escape($_POST['cprofile_youtube']);
    $o->cprofile_gst_no = escape($_POST['cprofile_gst_no']);
    $o->cprofile_gst = escape($_POST['cprofile_gst']);
    $o->cprofile_country = escape($_POST['cprofile_country']);
    $o->cprofile_website = escape($_POST['cprofile_website']);
    $o->cprofile_business_no = escape($_POST['cprofile_business_no']);


    switch ($action) {
//        case "create":
//            if($o->create()){
//                $_SESSION['status_alert'] = 'alert-success';
//                $_SESSION['status_msg'] = "Create success.";
//                rediectUrl("cprofile.php?action=edit&cprofile_id=$o->cprofile_id",getSystemMsg(1,'Create data'));
//            }else{
//                $_SESSION['status_alert'] = 'alert-error';
//                $_SESSION['status_msg'] = "Create fail.";
//                rediectUrl("cprofile.php",getSystemMsg(0,'Create data'));
//            }
//            exit();
//            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("cprofile.php?action=edit&cprofile_id=$o->cprofile_id",getSystemMsg(1,'Update data'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("cprofile.php?action=edit&cprofile_id=$o->cprofile_id",getSystemMsg(0,'Update data'));
            }
            exit();
            break;
        case "edit":
            if($o->fetchCprofileDetail(" AND cprofile_id = '$o->cprofile_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("cprofile.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;
        default:
            $o->getListing();
            exit();
            break;
    }
