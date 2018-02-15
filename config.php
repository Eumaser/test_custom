<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$sql_debug = 0;
error_reporting(0);
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$lang = 'en';
session_start();
date_default_timezone_set("Asia/Singapore"); 


define('system_datetime',date('Y-m-d H:i:s'));
define('system_date',date('Y-m-d'));
define('webroot',"http://localhost/kcparts/");
define('system_gst_percent',7);

$_SERVER["PHP_SELF"] = htmlspecialchars($_SERVER["PHP_SELF"]);

$session_expiry_time = time() + (60*30); // 30mins expiry ;

$url_path = explode("/",$_SERVER['PHP_SELF']);

if(basename($_SERVER['PHP_SELF']) != 'json_api.php'){
if($_SESSION['empl_id'] > 0 && basename($_SERVER['PHP_SELF']) != 'login.php'){
    if($_SESSION["empl_login_expiry"] < time()){
        unset($_SESSION['empl_id']);
        $_SESSION["error_msg"] = "<font color = 'red' >Your session has expired.</font>";
        header ("Location: " . webroot . "login.php");
    }else{
        if($_SESSION['empl_id'] <= 0 || basename($_SERVER['PHP_SELF']) == 'index.php'){
            unset($_SESSION['empl_id']);
            unset($_SESSION['empl_name']);
            unset($_SESSION['empl_code']);
            unset($_SESSION['empl_login_expiry']);  
            unset($_SESSION['empl_group']);
            unset($_SESSION['empl_department']);
            unset($_SESSION['empl_outlet']);  
            unset($_SESSION['empl_outlet_code']);
            unset($_SESSION['outl_gst']);
          $_SESSION["error_msg"] = "<font color = 'red' >Your session has expired.</font>";
          header ("Location: " . webroot . "login.php");  
        }
        $_SESSION["empl_login_expiry"] = $session_expiry_time;
        unset($_SESSION['error_msg']);
    }
}else{
   unset($_SESSION['empl_id']);
   
   if(basename($_SERVER['PHP_SELF']) != 'login.php'){
     if($_SESSION["empl_login_expiry"] < time()){
        $_SESSION["error_msg"] = "<font color = 'red' >Your session has expired.</font>";
        unset($_SESSION['empl_id']);
        unset($_SESSION['empl_name']);
        unset($_SESSION['empl_code']);   
        unset($_SESSION['empl_login_expiry']);
        unset($_SESSION['empl_group']);
        unset($_SESSION['empl_department']);
        unset($_SESSION['empl_outlet']);  
        unset($_SESSION['empl_outlet_code']); 
        unset($_SESSION['outl_gst']);
        header ("Location: " . webroot . "login.php");
     }  
   }
   
        unset($_SESSION['empl_id']);
        unset($_SESSION['empl_name']);
        unset($_SESSION['empl_code']);   
        unset($_SESSION['empl_login_expiry']);
        unset($_SESSION['empl_group']);
        unset($_SESSION['empl_department']);
        unset($_SESSION['empl_outlet']);  
        unset($_SESSION['empl_outlet_code']); 
        unset($_SESSION['outl_gst']);
}
}