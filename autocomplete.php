<?php
   include_once 'connect.php';
   include_once 'config.php';
   include_once 'include_function.php';
   include_once 'class/AutoComplete.php';

   $o = new AutoComplete();
   $action = $_REQUEST['action'];
   switch($action){
       case "item":
           $q = escape($_REQUEST['q']);
           $o->getItemAutoComplete($q);
           exit;
           break;
       case "uom":
           $q = escape($_REQUEST['q']);
           $o->getUomAutoComplete($q);
           exit;
           break;
       case "process":
           $q = escape($_REQUEST['q']);
           $o->getProcessAutoComplete($q);
           exit;
           break;
       case "location":
           $q = escape($_REQUEST['q']);
           $o->getLocationAutoComplete($q);
           exit;
           break;
       case "bpartner":
           $q = escape($_REQUEST['q']);
           $o->getBpartnerAutoComplete($q);
           exit;
           break;
       case "employee":
           $q = escape($_REQUEST['q']);
           $o->getEmployeeAutoComplete($q);
           exit;
           break;
       default:
           
   }
?>
