<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Forklift.php';
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'class/Excel_reader2.php';
    include_once 'class/Material.php';
    $o = new Forklift();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $ma = new Material();
    $o->save = $s;


    $action   = escape($_REQUEST['action']);
    $o->fork_id  = escape($_REQUEST['fork_id']);
    $o->fork_brand   = escape($_REQUEST['fork_brand']);
    $o->fork_model   = escape($_REQUEST['fork_model']);
    $o->fork_capacity   = escape($_REQUEST['fork_capacity']);
    $o->fork_height   = escape($_REQUEST['fork_height']);
    $o->fork_mast   = escape($_REQUEST['fork_mast']);
    $o->fork_length   = escape($_REQUEST['fork_length']);
    $o->fork_attachment   = escape($_REQUEST['fork_attachment']);
    $o->fork_acc   = escape($_REQUEST['fork_acc']);
    $o->fork_serial   = escape($_REQUEST['fork_serial']);


    switch ($action) {
        case "create":
      //      $count_partno = getDataCountBySql("db_forklift", "WHERE product_part_no  = '$o->product_part_no' AND product_status = 1");
    //  $count_partno = getDataCountBySql("db_product", "WHERE product_part_no = '$o->product_part_no' AND product_status = 1");
      //edr resume here
            $forkExist = getDataCountBySql("db_forklift"," WHERE fork_model = '".trim($o->fork_model)."' ");

            if($forkExist>0){
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("forklift.php?action=createForm",getSystemMsg(0,'Create data fail: Product Part No exists in the list'));
            }else{
                if($o->create()){
                    $_SESSION['status_alert'] = 'alert-success';
                    $_SESSION['status_msg'] = "Create success.";
                    rediectUrl("forklift.php?action=edit&fork_id=$o->fork_id",getSystemMsg(1,'Create data successfully'));
                }else{
                    $_SESSION['status_alert'] = 'alert-error';
                    $_SESSION['status_msg'] = "Create fail.";
                    rediectUrl("forklift.php",getSystemMsg(0,'Create data fail'));
                }
            }

            exit();
            break;
        case "update":
                if($o->update()){
                    $_SESSION['status_alert'] = 'alert-success';
                    $_SESSION['status_msg'] = "Update success.";
                    rediectUrl("forklift.php?action=edit&fork_id=$o->fork_id",getSystemMsg(1,'Update data successfully'));
                }else{
                    $_SESSION['status_alert'] = 'alert-error';
                    $_SESSION['status_msg'] = "Update fail.";
                    rediectUrl("forklift.php?action=edit&fork_id=$o->fork_id",getSystemMsg(0,'Update data fail'));
                }


            exit();
            break;
        case "edit":

            if($o->fetchProductDetail(" AND f.product_id = '$f->fork_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("forklift.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "delete":
            //$order_prod = getDataCountBySql("db_ordl ol LEFT JOIN db_product p ON ol.ordl_pro_id = p.product_id LEFT JOIN db_order o ON ol.ordl_order_id = o.order_id", "WHERE p.product_id = '$o->product_id' AND o.order_status = 1");
            $order_prod = getDataCountBySql("db_ordl ol LEFT JOIN db_forklift p ON ol.ordl_pro_id = p.product_id LEFT JOIN db_order o ON ol.ordl_order_id = o.order_id", "WHERE p.product_id = '$o->fork_id' AND o.order_status = 1");
            if($order_prod>0){
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("forklift.php",getSystemMsg(0,'Delete fail: Forklift has in transaction'));
            }else{
                if($o->delete()){
                    $_SESSION['status_alert'] = 'alert-success';
                    $_SESSION['status_msg'] = "Delete success.";
                    rediectUrl("product.php",getSystemMsg(1,'Delete data successfully'));
                }else{
                    $_SESSION['status_alert'] = 'alert-error';
                    $_SESSION['status_msg'] = "Delete fail.";
                    rediectUrl("product.php",getSystemMsg(0,'Delete data fail'));
                }
            }

            exit();
            break;
        case "createForm":
            $o->getInputForm('create');
            exit();
            break;
        case "validate_product":
            $t = $gf->checkDuplicate("db_forklift",'fork_model',$o->fork_mode,'fork_id',$o->fork_id);
            if($t > 0){
                echo "false";
            }else{
                echo "true";
            }
            exit();
            break;
        case "getDataTable":
            $o->get();
            exit();
            break;
        case "getProductDetail":
            $o->itype = escape($_POST['itype']);
            if($o->itype == 'product'){
                $r = $o->getProductDetailTransaction();

                $material_labour_html = $o->getItemMeterialDetail();

                if(($_SESSION['empl_language'] == "chinese") && ($r['product_desc_cn'] != "")){//taiwan
                    $product_desc = $r['product_desc_cn'];
                }else if(($_SESSION['empl_language'] == "thai") && ($r['product_desc_thai'] != "")){//thailand
                    $product_desc = $r['product_desc_thai'];
                }else{
                    $product_desc = $r['product_desc'];
                }

                echo json_encode(array('product_barcode'=>$r['product_barcode'],'product_desc'=>$product_desc,
                                       'product_sales_price'=>$r['product_sales_price'],'product_cost_price'=>$r['product_cost_price'],
                                       'material_labour_html'=>$material_labour_html));


            }else if($o->itype == 'material'){
                $r = $ma->fetchMaterialDetail(" AND material_id = '$o->product_id'","","",2);

                $category = $ma->getMateriaCategoryName($r['material_category']);

                echo json_encode(array('product_desc'=>$r['material_desc'],'product_category'=>$category,
                                       'product_sales_price'=>$r['material_sale_price'],'product_cost_price'=>0,'material_labour_html'=>""));
            }

            exit();
            break;


        case"import":

           if($_FILES["import_file"]["size"] > 0){

                $file = $_FILES["import_file"]["tmp_name"];
                $handle = fopen($file,"r");
              //  die($_FILES["import_file"]['type']);
//                echo "<div style = 'text-align:center;width:500px;margin:250px auto 0px auto'><h3>Please Wait....</h3></div>";

                if($_FILES["import_file"]['type'] == 'text/csv'){

                    do{
                        if(($data[0] == 'Account number (Parent customer)') || ($data[0] == '')){
                              continue;
                        }
                        if($data[0]){
                             $product_code = escape($data[0]);

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

                             if($o->fetchProductDetail(" AND p.product_code = '$product_code'","","",1)){
                                 $o->product_desc = $data[3];
                                 $o->product_sales_price = $data[13];
                                 $o->update();
                             }
                        }
                    }while($data = fgetcsv($handle,2000));
                }else if($_FILES["import_file"]['type'] == 'application/vnd.ms-excel'){


                    $data = new Spreadsheet_Excel_Reader($_FILES["import_file"]["tmp_name"]);

                    $s = 0;
                    for($i=0;$i<count($data->sheets);$i++){

                         for($j=1;$j<=17;$j++){
                            $b = false;

                            if(($data->sheets[$i]["cells"][$j][1] == 'Product_name') || ($data->sheets[$i]["cells"][$j][1] == '')){
                                     continue;
                            }

                                 $product_code = escape($data->sheets[$i]["cells"][$j][3]);

                                //  echo '<pre>';
                                 //print_r($product_code);
                                 //die();//edr

                                 $sql_select= "SELECT product_id FROM db_product WHERE product_part_no = '$product_code'";
                                 $query_select = mysql_query($sql_select);
                                 $select = mysql_fetch_array($query_select);

                                 $o->product_name = $data->sheets[$i]["cells"][$j][1];//product name
                                 $o->product_id = $select['product_id'];

                                 $test =$data->sheets[$i]["cells"][$j][2];
                                 $sql_cat = "SELECT category_id FROM db_category WHERE category_code='$test'";
                                 $query = mysql_query($sql_cat);
                                 $row = mysql_fetch_array($query);
                                 $cat_id = $row['category_id'];
                                 $o->product_category = (int)$cat_id;

                                 $o->product_part_no = $data->sheets[$i]["cells"][$j][3];//product code
                                 $o->product_desc = $data->sheets[$i]["cells"][$j][4];//product desc
                                 $o->product_cost_price = $data->sheets[$i]["cellsInfo"][$j][5]['raw'];//product cost price
                                 $o->product_stock = $data->sheets[$i]["cellsInfo"][$j][6]['raw'];//product stock
                                 $o->product_n_wt = $data->sheets[$i]["cellsInfo"][$j][7]['raw'];//product n-wt
                                 $o->product_remark = $data->sheets[$i]["cells"][$j][8];//product remark
                                 $o->product_location = $data->sheets[$i]["cells"][$j][9];//location
                                 $o->product_sale_price = $data->sheets[$i]["cellsInfo"][$j][10]['raw'];//sales price
                                 $o->product_lowstock = $data->sheets[$i]["cellsInfo"][$j][11]['raw'];//product lowstock
                                 $o->product_g_wt = $data->sheets[$i]["cellsInfo"][$j][12]['raw'];//product g-wt

                                 $test =$data->sheets[$i]["cells"][$j][13];
                                 $sql_uom = "SELECT uom_id FROM db_uom WHERE uom_code='$test'";
                                 $query = mysql_query($sql_uom);
                                 $row = mysql_fetch_array($query);
                                 $uom_id = $row['uom_id'];
                                 $o->product_uom = (int)$uom_id;

                                 if (!empty($select) ) {
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

        default:

            $o->getListing();
            exit();
            break;
    }
