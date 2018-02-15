<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Backcharge.php'; 
    include_once 'class/Partner.php';
    include_once 'class/Project.php';
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'language.php';
    $o = new Backcharge();
    $b = new Partner();
    $s = new SavehandlerApi();
    $p = new Project();
    $o->save = $s;
    $o->document_type = 'PO';
    $o->document_name = 'Back Charge Management';
    $o->document_code = 'Back Charge';
    $o->document_url = 'backcharge.php';
    $o->custsupp_label = 'Supplier';
    $o->salesorderedby_label = "Backchargeed By";
    $o->menu_id = 12;
    $o->isstock = 0;

    $o->backcharge_id = escape($_REQUEST['backcharge_id']);
    $o->backcharge_project = escape($_POST['backcharge_project']);
    $o->backcharge_subcon = escape($_POST['backcharge_subcon']);
    $o->backcharge_no = escape($_POST['backcharge_no']);
    $o->backcharge_date = escape($_POST['backcharge_date']);
    $o->backcharge_remark = escape($_POST['backcharge_remark']);
    $o->backcharge_status = escape($_POST['backcharge_status']);
    
    $o->backchargeline = $_POST['backchargeline'];
    $o->bcline_id = escape($_POST['bcline_id']);
    
   $action = $_REQUEST['action'];
   switch($action){
       case "create":
                if($o->createBackcharge()){
                    rediectUrl("$o->document_url?action=edit&backcharge_id=$o->backcharge_id",getSystemMsg(1,'Create data successfully'));
                }else{
                    rediectUrl("$o->document_url?action=create_form",getSystemMsg(0,'Create data fail'));
                }
       break;
       case "edit":
                if(($o->fetchBackchargeDetail(" AND backcharge_id = '$o->backcharge_id'","","",1))  && ($o->backcharge_id > 0)){
                    $o->getInputForm("update");
                }else{
                   rediectUrl("$o->document_url",getSystemMsg(0,'Record Not Found.'));
                }
       break;
       case "update":
               $o->status = 0;
               if($o->updateBackcharge()){
                   rediectUrl("$o->document_url?action=edit&backcharge_id=$o->backcharge_id",getSystemMsg(1,'Update data successfully'));
               }else{
                   rediectUrl("$o->document_url?action=edit&backcharge_id=$o->backcharge_id",getSystemMsg(0,'Update data fail'));
               }
       break;
       case "delete":
               $o->order_status = 0;
               if($o->delete()){
                   rediectUrl("$o->document_url",getSystemMsg(1,'Delete data successfully'));
               }else{
                   rediectUrl("$o->document_url?action=edit&backcharge_id=$o->backcharge_id",getSystemMsg(0,'Delete data fail'));
               }
       break;
       case "export":
    $data = array(
		array("First Name" => "Nitya", "Last Name" => "Maity", "Email" => "nityamaity87@gmail.com", "Message" => "Test message by Nitya"),
		array("First Name" => "Codex", "Last Name" => "World", "Email" => "info@codexworld.com", "Message" => "Test message by CodexWorld"),
		array("First Name" => "John", "Last Name" => "Thomas", "Email" => "john@gmail.com", "Message" => "Test message by John"),
		array("First Name" => "Michael", "Last Name" => "Vicktor", "Email" => "michael@gmail.com", "Message" => "Test message by Michael"),
		array("First Name" => "Sarah", "Last Name" => "David", "Email" => "sarah@gmail.com", "Message" => "Test message by Sarah")
	);
	
	function filterData(&$str)
	{
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
		if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
	}
	
	// file name for download
	$fileName = "codexworld_export_data" . date('Ymd') . ".xls";
	
	// headers for download
	header("Content-Disposition: attachment; filename=\"$fileName\"");
	header("Content-Type: application/vnd.ms-excel");
	
	$flag = false;
	foreach($data as $row) {
		if(!$flag) {
			// display column names as first row
			echo implode("\t", array_keys($row)) . "\n";
			$flag = true;
		}
		// filter data
		array_walk($row, 'filterData');
		echo implode("\t", array_values($row)) . "\n";
	}
	
	exit;

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
    
?>
