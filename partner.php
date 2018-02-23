<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Partner.php';
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'class/SelectControl.php';
    include_once 'language.php';
    include_once 'class/PHPExcel.php';
    $o->select = new SelectControl();
    $o = new Partner();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->partner_id = escape($_REQUEST['partner_id']);

    if($action == 'update'){
        $o->fetchPartnerDetail(" AND partner_id = '$o->partner_id'","","",1);
        $o->partner_oldpassword = $o->partner_login_password;
    }

    $o->partner_code = escape($_POST['partner_code']);
    $o->partner_name = escape($_POST['partner_name']);
    $o->partner_iscustomer = escape($_POST['partner_iscustomer']);
    $o->partner_issubcon = escape($_POST['partner_issubcon']);
    $o->partner_issupplier = escape($_POST['partner_issupplier']);
    $o->partner_debtor_account = escape($_POST['partner_debtor_account']);
    $o->partner_creditor_account = escape($_POST['partner_creditor_account']);
    $o->partner_bill_address = escape($_POST['partner_bill_address']);
    $o->partner_ship_address = escape($_POST['partner_ship_address']);
    $o->partner_sales_person = escape($_POST['partner_sales_person']);
    $o->partner_tel = escape($_POST['partner_tel']);
    $o->partner_tel2 = escape($_POST['partner_tel2']);
    $o->partner_fax = escape($_POST['partner_fax']);
    $o->partner_email = escape($_POST['partner_email']);
    $o->partner_currency = escape($_POST['partner_currency']);
    $o->partner_outlet = escape($_POST['partner_outlet']);
    $o->partner_remark = escape($_POST['partner_remark']);
    $o->partner_website = escape($_POST['partner_website']);
    $o->partner_credit_limit = escape($_POST['partner_credit_limit']);
    $o->partner_industry = escape($_POST['partner_industry']);
    $o->partner_seqno = escape($_POST['partner_seqno']);
    $o->partner_status = escape($_POST['partner_status']);
    $o->partner_postal_code = escape($_POST['partner_postal_code']);
    $o->partner_city = escape($_POST['partner_city']);
    $o->partner_house_no = escape($_POST['partner_house_no']);
    $o->partner_suburb = escape($_POST['partner_suburb']);
    $o->partner_address_type = escape($_POST['partner_address_type']);
    $o->current_tab = escape($_REQUEST['current_tab']);

    // Added by Ivan, for KC-Parts
    $o->partner_country = escape($_POST['partner_country']);

    $o->partner_name_cn = escape($_POST['partner_name_cn']);
    $o->partner_name_thai = escape($_POST['partner_name_thai']);
    $o->partner_bill_address_cn = escape($_POST['partner_bill_address_cn']);
    $o->partner_bill_address_thai = escape($_REQUEST['partner_bill_address_thai']);
    $o->partner_issitecoordinator = escape($_POST['partner_issitecoordinator']);

    //contact
    $o->contact_id = escape($_REQUEST['contact_id']);
    $o->contact_name = escape($_POST['contact_name']);
    $o->contact_tel = escape($_POST['contact_tel']);
    $o->contact_fax = escape($_POST['contact_fax']);
    $o->contact_email = escape($_POST['contact_email']);
    $o->contact_address = escape($_POST['contact_address']);
    $o->contact_remark = escape($_POST['contact_remark']);
    $o->contact_seqno = escape($_POST['contact_seqno']);
    $o->contact_status = escape($_POST['contact_status']);

    //Shipping Address
    $o->shipping_id = escape($_REQUEST['shipping_id']);
    $o->shipping_remark = escape($_POST['shipping_remark']);
    $o->shipping_address = escape($_POST['shipping_address']);
    $o->shipping_seqno = escape($_POST['shipping_seqno']);
    $o->shipping_status = escape($_POST['shipping_status']);
    $o->shipping_name = escape($_POST['shipping_name']);

    //Shipping Address
    $o->pempl_id = escape($_POST['pempl_id']);
    $o->pempl_name = escape($_POST['pempl_name']);
    $o->pempl_nric = escape($_POST['pempl_nric']);
    $o->pempl_issuedate = escape($_POST['pempl_issuedate']);
    $o->pempl_wpno = escape($_POST['pempl_wpno']);
    $o->pempl_expirydate = escape($_POST['pempl_expirydate']);
    $o->pempl_passport = escape($_POST['pempl_passport']);
    $o->pempl_passportissuedate = escape($_POST['pempl_passportissuedate']);
    $o->pempl_passportexpirydate = escape($_POST['pempl_passportexpirydate']);
    $o->pempl_position = escape($_POST['pempl_position']);

    $o->partner_login_password = escape($_POST['partner_login_password']);
    $o->partner_login_id = escape($_POST['partner_login_id']);

    $o->type = escape($_REQUEST['type']);

    if($o->type == 'supplier'){
        $o->label_name = "Supplier ";
        $o->partner_issupplier = 1;
    }else if($o->type == 'customer'){
        $o->label_name = "Customer ";
        $o->partner_iscustomer = 1;
    }else if($o->type == 'subcon'){
        $o->label_name = "Sub-Contractor ";
        $o->partner_issubcon = 1;
    }else if($o->type == 'sitecoordinator'){
        $o->label_name = "Site Coordinator ";
        $o->partner_issitecoordinator = 1;
    }

    switch ($action) {
        case "create":
            $q = $o->fetchPartnerDetail(" AND (partner_code LIKE '%$o->partner_code%' OR partner_name LIKE '%$o->partner_name%')","","",0);
            if(mysql_num_rows($q)>0){
                rediectUrl("partner.php?type=$o->type",getSystemMsg(0,'Customer Code/Name existed in database'));
            }else{
                if($o->create()){
                    $_SESSION['status_alert'] = 'alert-success';
                    $_SESSION['status_msg'] = "Create success.";
                    rediectUrl("partner.php?action=edit&current_tab=$o->current_tab&partner_id=$o->partner_id&type=$o->type",getSystemMsg(1,'Create data successfully'));
                }else{
                    $_SESSION['status_alert'] = 'alert-error';
                    $_SESSION['status_msg'] = "Create fail.";
                    rediectUrl("partner.php?type=$o->type",getSystemMsg(0,'Create data fail'));
                }
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("partner.php?action=edit&current_tab=$o->current_tab&partner_id=$o->partner_id&type=$o->type",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("partner.php?action=edit&current_tab=$o->current_tab&partner_id=$o->partner_id&type=$o->type",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;
        case "edit":
            if($o->fetchPartnerDetail(" AND partner_id = '$o->partner_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("partner.php?type=$o->type",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("partner.php?type=$o->type",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("partner.php?type=$o->type",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;
        case "createForm":
                $o->getInputForm('create');
            exit();
            break;
        case "contact":
            if($o->fetchPartnerDetail(" AND partner_id = '$o->partner_id'","","",1)){
                $o->getContact();
            }else{
               rediectUrl("partner.php?type=$o->type",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "create_contact":
            if($o->createContact()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("partner.php?action=edit_contact&current_tab=$o->current_tab&partner_id=$o->partner_id&contact_id=$o->contact_id&type=$o->type",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("partner.php?type=$o->type",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update_contact":
            if($o->updateContact()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("partner.php?action=edit_contact&current_tab=$o->current_tab&partner_id=$o->partner_id&contact_id=$o->contact_id&type=$o->type",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("partner.php?action=contact&current_tab=$o->current_tab&partner_id=$o->partner_id&contact_id=$o->contact_id&type=$o->type",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;
        case "edit_contact":
            if($o->fetchContactDetail(" AND contact_id = '$o->contact_id'","","",1)){
                if($o->fetchPartnerDetail(" AND partner_id = '$o->partner_id'","","",1)){
                    $o->getContact();
                }else{
                    rediectUrl("partner.php?type=$o->type",getSystemMsg(0,'Fetch Data'));
                }
            }else{
               rediectUrl("partner.php?type=$o->type",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "delete_contact":
            if($o->deleteContact()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("partner.php?action=contact&current_tab=$o->current_tab&partner_id=$o->partner_id&type=$o->type",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("partner.php?action=contact&current_tab=$o->current_tab&partner_id=$o->partner_id&type=$o->type",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;
        case "shipping_address":
            if($o->fetchPartnerDetail(" AND partner_id = '$o->partner_id'","","",1)){
                $o->getShippingAddress();
            }else{
               rediectUrl("partner.php?type=$o->type",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "create_shipping":
            if($o->createShippingAddress()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("partner.php?action=edit_shipping_address&current_tab=$o->current_tab&partner_id=$o->partner_id&shipping_id=$o->shipping_id&type=$o->type",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("partner.php?type=$o->type",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update_shipping":
            if($o->updateShippingAddress()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("partner.php?action=edit_shipping_address&current_tab=$o->current_tab&partner_id=$o->partner_id&shipping_id=$o->shipping_id&type=$o->type",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("partner.php?action=shipping_address&current_tab=$o->current_tab&partner_id=$o->partner_id&shipping_id=$o->shipping_id&type=$o->type",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;
        case "edit_shipping_address":
            if($o->fetchShippingAddress(" AND shipping_id = '$o->shipping_id'","","",1)){
                if($o->fetchPartnerDetail(" AND partner_id = '$o->partner_id'","","",1)){
                    $o->getShippingAddress();
                }else{
                    rediectUrl("partner.php?type=$o->type",getSystemMsg(0,'Fetch Data'));
                }
            }else{
               rediectUrl("partner.php?type=$o->type",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "delete_shipping_address":
            if($o->deleteContact()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("partner.php?action=shipping_address&current_tab=$o->current_tab&partner_id=$o->partner_id&type=$o->type",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("partner.php?action=shipping_address&current_tab=$o->current_tab&partner_id=$o->partner_id&type=$o->type",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;
        case "validate_partner":
            $t = $gf->checkDuplicate("db_partner",'partner_code',$o->partner_code,'partner_id',$o->partner_id);
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
        case "getShippingAddress":
            if($o->fetchShippingAddress(" AND shipping_id = '$o->shipping_id'","","",1)){
               echo json_encode(array('status'=>1,'shipping_address'=>$o->shipping_address,'shipping_name'=>$o->shipping_name,'partner_name'=>$o->partner_name));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getContactJson":
            if($o->fetchContactDetail(" AND contact_id = '$o->contact_id'","","",1)){
               echo json_encode(array('status'=>1,'contact_tel'=>$o->contact_tel,
                                      'contact_email'=>$o->contact_email,'contact_address'=>$o->contact_address,
                                      'contact_remark'=>$o->contact_remark,'contact_id'=>$o->contact_id,
                                      'contact_fax'=>$o->contact_fax,'contact_name'=>$o->contact_name));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "getPartnerDetailTransaction":
            $partner_bill_address = "";

            $r = $o->getPartnerDetailTransaction();
            $contact_option = $o->select->getContactSelectCtrl("","Y"," AND contact_partner_id = '$o->partner_id'");
            $shipping_option = $o->select->getShippingAddressSelectCtrl("","Y"," AND shipping_partner_id = '$o->partner_id'");

            if(($_SESSION['empl_outlet'] == 14) && ($r['partner_bill_address_cn'] != "")){//taiwan
                $partner_bill_address = $r['partner_bill_address_cn'];
            }else if(($_SESSION['empl_outlet'] == 13) && ($r['partner_bill_address_thai'] != "")){//thailand
                $partner_bill_address = $r['partner_bill_address_thai'];
            }else{
                $partner_bill_address = $r['partner_bill_address'];
            }

            echo json_encode(array('partner_bill_address'=>$partner_bill_address,'partner_ship_address'=>$r['partner_ship_address'],
                                   'partner_tel'=>$r['partner_tel'],'partner_email'=>$r['partner_email'],
                                   'partner_currency'=>$r['partner_currency'],'partner_credit_limit'=>$r['partner_credit_limit'],
                                   'partner_name'=>$r['partner_name'],'partner_code'=>$r['partner_code'],
                                   'partner_sales_person'=>$r['partner_sales_person'],'contact_option'=>$contact_option,
                                   'shipping_option'=>$shipping_option,
                                   'partner_fax'=>$r['partner_fax']));
            exit();
            break;
        case "getContactJson":
            if($o->fetchContactDetail(" AND contact_id = '$o->contact_id'","","",1)){
               echo json_encode(array('status'=>1,'contact_tel'=>$o->contact_tel,
                                      'contact_email'=>$o->contact_email,'contact_address'=>$o->contact_address,
                                      'contact_remark'=>$o->contact_remark,'contact_id'=>$o->contact_id,
                                      'contact_fax'=>$o->contact_fax));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "add_worker":
            if($o->createPartnerWorker()){
                echo json_encode(array('status'=>1,'line'=>$line));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
            break;
        case "fetch_worker":
            $r = $o->fetchWorkerDetail();
            if(is_array($r)){
                echo json_encode(array('status'=>1,'pempl_name'=>$r['pempl_name'],'pempl_nric'=>$r['pempl_nric'],
                                       'pempl_wpno'=>$r['pempl_wpno'],'pempl_issuedate'=>format_date($r['pempl_issuedate']),
                                       'pempl_expirydate'=>format_date($r['pempl_expirydate']),'pempl_passport'=>$r['pempl_passport'],
                                       'pempl_passportissuedate'=>format_date($r['pempl_passportissuedate']),'pempl_passportexpirydate'=>format_date($r['pempl_passportexpirydate']),
                                       'pempl_position'=>$r['pempl_position'],'pempl_id'=>$r['pempl_id']));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case "deleteline":
            if($o->deleteWorkerLine()){
                echo json_encode(array('status'=>1));
            }else{
                echo json_encode(array('status'=>0));
            }
            exit();
            break;
        case"import":

           if($_FILES["import_file"]["size"] > 0){

                $file = $_FILES["import_file"]["tmp_name"];
                $handle = fopen($file,"r");

                if($_FILES["import_file"]['type'] == 'text/csv'){
                    $seq = 10;
                    $s = 0;
                    do{
                        if($_REQUEST['import_action'] == 'Customer'){
                            if(($data[0] == 'Account number') || ($data[0] == '')){
                                  continue;
                            }
                            if($data[0]){
                                 $partner_account_code = escape($data[0]);
                                 if($partner_account_code != ""){
                                    if($o->fetchPartnerDetail(" AND partner_account_code = '$partner_account_code'","","",1)){
                                         if($o->partner_id > 0){
                                           $o->generateImportData($data,"partner");
                                           $o->update();
                                         }else{
                                           $o->generateImportData($data,"partner");
                                           $o->partner_account_code = $partner_account_code;
                                           $o->partner_status = 1;
                                           $o->partner_iscustomer = 1;
                                           if($partner_account_code == '30012'){
                                               $o->partner_issupplier = 1;
                                           }
                                           $o->partner_seqno = $seq;
                                           $o->create();
                                         }
                                    }else{
                                           $o->generateImportData($data,"partner");
                                           $o->create();
                                    }
                                    $seq = $seq + 10;
                                    $s++;
                                 }
                            }
                        }else if($_REQUEST['import_action'] == 'Contact'){
                            if(($data[0] == 'Account number (Parent customer)') || ($data[0] == '')){
                                  continue;
                            }
                            if($data[0]){
                                 $partner_account_code = escape($data[0]);
                                 if($partner_account_code != ""){
                                    if($o->fetchPartnerDetail(" AND partner_account_code = '$partner_account_code'","","",1)){
                                         if($o->partner_id > 0){
                                           $o->generateImportData($data,"contact");
                                           $o->contact_partner_id = $o->partner_id;
                                           $o->contact_status = 1;
                                           $o->contact_seqno = $seq;
                                           $o->createContact();
                                           $seq = $seq + 10;
                                           $s++;
                                         }
                                    }
                                 }
                            }
                        }
                    }while($data = fgetcsv($handle,20000));
                }else if($_FILES["import_file"]['type'] == 'application/vnd.ms-excel'){
                  //insert code here edrs

                  try {
                    $inputFileType = \PHPExcel_IOFactory::identify($file);
                    $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($file);
                  } catch (Exception $e) {
                    die('Error');
                  }
                  //$hrow = 4;
                  $test = [];
                //  var_dump($test);die();
                  $sheet = $objPHPExcel->getSheet(0);//sheet commodities
                  $highestRow = $sheet->getHighestRow();
                  $highestColumn = $sheet->getHighestColumn();
                    $i = 0;
                    $sd = 0;
                  //var_dump($highestRow);die();
                  for ($row=2; $row<=$highestRow ; $row++) {
                      $i++;
                      $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);

                      $partner_code = $rowData[$i][0];
                      $sql_select= "SELECT partner_id FROM db_partner WHERE partner_code = '$partner_code'";
                      $query_select = mysql_query($sql_select);
                      $select = mysql_fetch_array($query_select);

                      $country_code = $rowData[$i][4];
                    //    $country_code = 'GER';
                      $sql_country = "SELECT country_id FROM db_country WHERE country_code = '$country_code'";
                      $country_select = mysql_query($sql_country);
                      $country = mysql_fetch_array($country_select);
                      if (!empty($country)) {
                         $country_id = $country['country_id'];
                      }else{
                         $country_id = 0;
                      }

                      $o->partner_code = $rowData[$i][0];
                      $o->partner_tel =  $rowData[$i][1];
                      $o->partner_tel2 = $rowData[$i][2];
                      $o->partner_suburb = $rowData[$i][3];
                      $o->partner_country = $country_id;//4
                      $o->partner_bill_address = $rowData[$i][5];
                      $o->partner_name = $rowData[$i][6];
                      $o->partner_email = $rowData[$i][7];
                      $o->partner_fax = $rowData[$i][8];
                      $o->partner_remark = $rowData[$i][9];
                      $o->partner_status = 1;
                      $o->partner_iscustomer = 1;
                      $o->partner_address_type = 1;

                      if (!empty($select) ) {
                        $o->partner_id = $select['partner_id'];
                        if($o->update()){
                            $b = true;
                        }else{
                            $b = false;
                        }
                      }else{
                        if ($o->create()) {
                          $b = true;
                        }else{
                         $b = false;
                        }

                      }

                      if($b){
                         $sd++;
                      }


                    //  var_dump($country);die();
                  }
                //  echo '<pre>';
                //  print_r($test);die();
            //    print_r($test);
            //    die();
                  echo json_encode(array('status'=>1,'data'=>$sd));
                }


           }else{
               echo json_encode(array('status'=>0,'data'=>0));
           }
                exit();
                break;
        default:
            $o->getListing();
            exit();
            break;
    }
