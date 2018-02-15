<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Package.php'; 
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'class/Excel_reader2.php';
    include_once 'class/Product.php'; 
    $o = new Package();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $ma = new Product();
    $o->save = $s;

    $action = escape($_REQUEST['action']);
    $o->package_id = escape($_REQUEST['package_id']);
    $o->package_part_no = escape($_POST['package_part_no']);
    $o->package_barcode = escape($_POST['package_barcode']);
    $o->package_desc = escape($_POST['package_desc']);
    $o->package_sale_price = escape($_POST['package_sale_price']);
    $o->package_cost_price = escape($_POST['package_cost_price']);
    $o->package_category = escape($_POST['package_category']);
    $o->package_category2 = escape($_POST['package_category2']);
    $o->package_category3 = escape($_POST['package_category3']);
    $o->package_brand = escape($_POST['package_brand']);
    $o->package_packagetype = escape($_POST['package_packagetype']);
    $o->package_outlet = escape($_POST['package_outlet']);
    $o->package_remark = escape($_POST['package_remark']);
    $o->package_seqno = escape($_POST['package_seqno']);
    $o->package_status = escape($_POST['package_status']);
    $o->package_part_no_cn = escape($_POST['package_part_no_cn']);
    $o->package_part_no_thai = escape($_POST['package_part_no_thai']);
    $o->package_desc_cn = escape($_POST['package_desc_cn']);
    $o->package_desc_thai = escape($_POST['package_desc_thai']);
    $o->package_custom_no = escape($_POST['package_custom_no']);
    $o->package_weight = escape($_POST['package_weight']);
    $o->package_uom = escape($_POST['package_uom']);
    $o->image_input = $_FILES['image_input'];
    $o->package_product_wastage = escape($_POST['package_product_wastage']);
    $o->package_labour_profit = escape($_POST['package_labour_profit']);
    
    $o->current_tab = $_REQUEST['current_tab'];
    
    $o->probom_id = escape($_POST['probom_id']);
    $o->probom_product_id = escape($_POST['probom_product_id']);
    $o->probom_qty = escape($_POST['probom_qty']);
    $o->probom_layer = escape($_POST['probom_layer']);
    $o->total_line_material = escape($_POST['total_line_material']);
    $o->probom_cost = escape($_POST['probom_cost']);
    $o->probom_sale = escape($_POST['probom_sale']);
    $o->probom_uom_id = escape($_POST['probom_uom_id']);
    
    
    $o->prolabour_id = escape($_POST['prolabour_id']);
    $o->prolabour_labour_id = escape($_POST['prolabour_labour_id']);
    $o->prolabour_qty = escape($_POST['prolabour_qty']);
    $o->prolabourlayer = escape($_POST['prolabourlayer']);
    $o->total_line_labour = escape($_POST['total_line_labour']);
    
    $o->line_type = escape($_POST['line_type']);
    $o->line_id = escape($_POST['line_id']);
    switch ($action) {
        case "create":
            if($o->create()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Create success.";
                rediectUrl("package.php?action=edit&package_id=$o->package_id&current_tab=$o->current_tab",getSystemMsg(1,'Create data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Create fail.";
                rediectUrl("package.php",getSystemMsg(0,'Create data fail'));
            }
            exit();
            break;
        case "update":
            if($o->update()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Update success.";
                rediectUrl("package.php?action=edit&package_id=$o->package_id&current_tab=$o->current_tab",getSystemMsg(1,'Update data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Update fail.";
                rediectUrl("package.php?action=edit&package_id=$o->package_id&current_tab=$o->current_tab",getSystemMsg(0,'Update data fail'));
            }
            exit();
            break;  
        case "edit":
            if($o->fetchPackageDetail(" AND p.package_id = '$o->package_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("package.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;  
        case "delete":
            if($o->delete()){
                $_SESSION['status_alert'] = 'alert-success';
                $_SESSION['status_msg'] = "Delete success.";
                rediectUrl("package.php",getSystemMsg(1,'Delete data successfully'));
            }else{
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("package.php",getSystemMsg(0,'Delete data fail'));
            }
            exit();
            break;   
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;   
        case "validate_package":
            $t = $gf->checkDuplicate("db_package",'package_part_no',$o->package_part_no,'package_id',$o->package_id);
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
        case "getPackageDetail":
            $o->itype = escape($_POST['itype']);
            $o->product_id = escape($_POST['product_id']);
            if($o->itype == 'package'){
                $r = $o->getPackageDetailTransaction();
                
                $product_labour_html = $o->getItemMeterialDetail();

                if(($_SESSION['empl_language'] == "chinese") && ($r['package_desc_cn'] != "")){//taiwan
                    $package_desc = $r['package_desc_cn'];
                }else if(($_SESSION['empl_language'] == "thai") && ($r['package_desc_thai'] != "")){//thailand
                    $package_desc = $r['package_desc_thai'];
                }else{
                    $package_desc = $r['package_desc'];
                }
            
                echo json_encode(array('package_barcode'=>$r['package_barcode'],'package_desc'=>$package_desc,
                                       'package_sales_price'=>$r['package_sales_price'],'package_cost_price'=>$r['package_cost_price'],
                                       'product_labour_html'=>$product_labour_html));
                
                
            }else if($o->itype == 'product'){
                if($ma->fetchProductDetail(" AND product_id = '$o->product_id'","","",2)){
                    echo json_encode(array( 'product_sale_price'=>$ma->product_sale_price,
                                        'product_cost_price'=>$ma->product_cost_price,
                                        'status'=>1));
                }
            }
            
            exit();
            break;
        case "add_product":
            if($o->createUpdatePackageBom()){
                $product_array = $ma->fetchProductDetail(" AND product_id = '$o->probom_product_id'","","",2);
                if($o->probom_id <=0){
                $line = "<tr><td>$o->total_line_product</td><td><a href = 'product.php?action=edit&product_id={$product_array['product_id']}' target = 'blank' >{$product_array['product_part_no']}</a></td><td>{$product_array['product_desc']}</td>" . 
                        "<td class = 'text-align-right'>$o->probom_qty</td><td class = 'text-align-right'>$ {$product_array['product_sale_price']}</td><td class = 'text-align-right'>$ {$product_array['product_sale_price']}</td>" . 
                        "<td class = 'text-align-right'>" . 
                            "<a title = 'edit' style = 'margin-left:10px;margin-right:10px;font-size:20px;' href = 'javascript:void(0)' id = 'delete_line_$i' productline_id = '{$row['productline_id']}' class = 'delete_line font-icon' line = '$i' ><i class='fa fa-edit' aria-hidden='true'></i></a>" . 
                            "<a title = 'delete' style = 'margin-left:10px;margin-right:10px;font-size:20px;color:red' href = 'javascript:void(0)' id = 'delete_line_<?php echo $i;?>' productline_id = '{$row['productline_id']}' class = 'delete_line font-icon' line = '<?php echo $i;?>' ><i class='fa fa-trash-o' aria-hidden='true'></i></a>" . 
                        "</td>" .         
                        "</tr>";
                }
                echo json_encode(array('status'=>1,'line'=>$line));
            }else{
                echo json_encode(array('status'=>0));
            }
            
            exit();
            break;
        case "add_labour":
            if($o->createUpdatePackageLabour()){
                echo json_encode(array('status'=>1,'line'=>$line));
            }else{
                echo json_encode(array('status'=>0));
            }
            
            exit();
            break;
        case "deleteline":
            if($o->line_type == 'product'){
                if($o->deleteProductLine()){
                    echo json_encode(array('status'=>1));
                }else{
                    echo json_encode(array('status'=>0));
                }
            }else if($o->line_type == 'labour'){
                if($o->deleteLabourLine()){
                    echo json_encode(array('status'=>1));
                }else{
                    echo json_encode(array('status'=>0));
                }
            }
            exit();
            break;
        case"import": 

           if($_FILES["import_file"]["size"] > 0){

                $file = $_FILES["import_file"]["tmp_name"]; 
                $handle = fopen($file,"r"); 

//                echo "<div style = 'text-align:center;width:500px;margin:250px auto 0px auto'><h3>Please Wait....</h3></div>";
                
                if($_FILES["import_file"]['type'] == 'text/csv'){
                  
                    do{ 
                        if(($data[0] == 'Account number (Parent customer)') || ($data[0] == '')){
                              continue;
                        }
                        if($data[0]){ 
                             $package_part_no = escape($data[0]);
                             
//                             $sql = "SELECT partner_id FROM db_partner WHERE partner_account_code = '{$data[0]}' AND partner_account_code != ''";
//                             $query = mysql_query($sql);
//                             if($row = mysql_fetch_array($query)){
//                                 $data[1] = str_replace("@1",",",$data[1]);
//                                 $data[1] = escape($data[1]);
//                                 $data[2] = str_replace("@1",",",$data[2]);
//                                 $data[2] = escape($data[2]);
//                                 $data[3] = str_replace("@1",",",$data[3]);
//                                 $data[3] = escape($data[3]);
//                                 $data[4] = str_replace("@1",",",$data[4]);
//                                 $data[4] = escape($data[4]);
//                                 $data[5] = str_replace("@1",",",$data[5]);
//                                 $data[5] = escape($data[5]);
//                                 $data[6] = str_replace("@1",",",$data[6]);
//                                 $data[6] = escape($data[6]);
//                                 $data[7] = str_replace("@1",",",$data[7]);
//                                 $data[7] = escape($data[7]);
//                                 $data[8] = str_replace("@1",",",$data[8]);
//                                 $data[8] = escape($data[8]);
//                                 $data[10] = str_replace("@1",",",$data[10]);
//                                 $data[10] = escape($data[10]);
//                                 $data[11] = str_replace("@1",",",$data[11]);
//                                 $data[11] = escape($data[11]);
//                                 $data[12] = str_replace("@1",",",$data[12]);
//                                 $data[12] = escape($data[12]);
//                                 
//                                
//
//                                 $sql1 = "INSERT INTO db_contact (contact_partner_id,contact_name,contact_tel,contact_address,
//                                         contact_cellphone,contact_department,contact_position,contact_jobtitle,contact_forename,contact_lastname) 
//                                         VALUES ('{$row['partner_id']}','{$data[1]}','{$data[3]}','{$data[2]}',
//                                         '{$data[4]}','{$data[5]}','{$data[6]}','{$data[7]}','{$data[8]}','{$data[9]}')";
//                                 mysql_query($sql1);
//                             }
                             
                             if($o->fetchPackageDetail(" AND p.package_part_no = '$package_part_no'","","",1)){
                                 $o->package_desc = $data[3];
                                 $o->package_sales_price = $data[13];
                                 $o->update();
                             }
                        } 
                    }while($data = fgetcsv($handle,2000)); 
                }else if($_FILES["import_file"]['type'] == 'application/vnd.ms-excel'){


                    $data = new Spreadsheet_Excel_Reader($_FILES["import_file"]["tmp_name"]);

//              count($data->sheets)
//               $data->sheets[$i]["cells"]
                    $s = 0;
                    for($i=0;$i<count($data->sheets);$i++){
                      
                         for($j=1;$j<=17;$j++){
                            $b = false;
                            if(($data->sheets[$i]["cells"][$j][1] == 'Material') || ($data->sheets[$i]["cells"][$j][1] == '')){
                                     continue;
                            }
                             for($k=1;$k<=3;$k++){
                                 $package_part_no = escape($data->sheets[$i]["cells"][$j][1]);
                                 
                                 if($o->fetchPackageDetail(" AND p.package_part_no = '$package_part_no'","","",1)){
                                     $o->package_desc = $data->sheets[$i]["cells"][$j][4];
                                     $o->package_sales_price = $data->sheets[$i]["cells"][$j][14];
                                     if($o->update()){
                                         $b = true;
                                     }else{
                                         $b = false;
                                     }
                                 }
//                                     echo $data->sheets[$i]["cells"][$j][$k] . "&nbsp";
                             }
                             if($b){
                                $s++;
                             }
                         }
                    }  
                }

                echo json_encode(array('status'=>1,'data'=>$s));
           }else{
               echo json_encode(array('status'=>0,'data'=>0));
           }
                exit();
                break;
        case "getItemLabour":
            
            echo json_encode(array("itemlabour"=>$o->select->getPackageLabourSelectCtrl("","Y"," AND p.prolabour_package_id = '$o->package_id' ")));
            
            
            
            exit();
            break;
        default: 
            $o->getListing();
            exit();
            break;
    }


