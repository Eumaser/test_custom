<?php
    include_once 'connect.php';
    include_once 'config.php';
    include_once 'include_function.php';
    include_once 'class/Product.php';
    include_once 'class/SavehandlerApi.php';
    include_once 'class/GeneralFunction.php';
    include_once 'class/Excel_reader2.php';
    include_once 'class/Material.php';
    $o = new Product();
    $s = new SavehandlerApi();
    $gf = new GeneralFunction();
    $ma = new Material();
    $o->save = $s;
    /*
    $action = escape($_REQUEST['action']);
    $o->product_id = escape($_REQUEST['product_id']);
    $o->product_code = escape($_POST['product_code']);
    $o->product_barcode = escape($_POST['product_barcode']);
    $o->product_desc = escape($_POST['product_desc']);
    $o->product_sales_price = escape($_POST['product_sales_price']);
    $o->product_cost_price = escape($_POST['product_cost_price']);
    $o->product_category = escape($_POST['product_category']);
    $o->product_category2 = escape($_POST['product_category2']);
    $o->product_category3 = escape($_POST['product_category3']);
    $o->product_brand = escape($_POST['product_brand']);
    $o->product_producttype = escape($_POST['product_producttype']);
    $o->product_outlet = escape($_POST['product_outlet']);
    $o->product_remark = escape($_POST['product_remark']);
    $o->product_seqno = escape($_POST['product_seqno']);
    $o->product_status = escape($_POST['product_status']);
    $o->product_code_cn = escape($_POST['product_code_cn']);
    $o->product_code_thai = escape($_POST['product_code_thai']);
    $o->product_desc_cn = escape($_POST['product_desc_cn']);
    $o->product_desc_thai = escape($_POST['product_desc_thai']);
    $o->product_custom_no = escape($_POST['product_custom_no']);
    $o->product_weight = escape($_POST['product_weight']);
    $o->product_uom = escape($_POST['product_uom']);
    $o->image_input = $_FILES['image_input'];
    $o->product_material_wastage = escape($_POST['product_material_wastage']);
    $o->product_labour_profit = escape($_POST['product_labour_profit']);
    */

    // Edited on 05-09-2017
    $action                     = escape($_REQUEST['action']);
    $o->product_id              = escape($_REQUEST['product_id']);
    $o->product_category        = escape($_REQUEST['product_category']);
    $o->product_part_no         = stripslashes(htmlspecialchars_decode($_REQUEST['product_part_no']));
    $o->product_desc            = stripslashes(htmlspecialchars_decode($_REQUEST['product_desc']));
    //$o->product_part_no         = str_replace('\\','',escape(htmlspecialchars_decode(htmlspecialchars_decode($_REQUEST['product_part_no']))));
    //$o->product_desc            = str_replace('\\','',escape(htmlspecialchars_decode(htmlspecialchars_decode($_REQUEST['product_desc']))));
    $o->product_cost_price      = escape($_REQUEST['product_cost_price']);
    $o->product_sale_price      = escape($_REQUEST['product_sale_price']);
    $o->product_stock           = escape($_REQUEST['product_stock']);
    $o->product_qty_blades      = escape($_REQUEST['product_qty_blades']);
    $o->product_insert_types    = escape($_REQUEST['product_insert_types']);
    $o->product_diameter        = escape($_REQUEST['product_diameter']);
    $o->product_width_depth     = escape($_REQUEST['product_width_depth']);
    $o->product_shaft_diameter  = escape($_REQUEST['product_shaft_diameter']);
    $o->product_main_group       = escape($_REQUEST['product_main_group']);
    $o->product_sub_group        = escape($_REQUEST['product_sub_group']);
    $o->product_n_wt            = escape($_REQUEST['product_n_wt']);
    $o->product_g_wt            = escape($_REQUEST['product_g_wt']);
    $o->product_system_code     = escape($_REQUEST['product_system_code']);
    /*$o->product_cr_jabsco       = escape($_REQUEST['product_cr_jabsco']);
    $o->product_cr_sherwood     = escape($_REQUEST['product_cr_sherwood']);
    $o->product_cr_johnson      = escape($_REQUEST['product_cr_johnson']);
    $o->product_cr_volvo        = escape($_REQUEST['product_cr_volvo']);
    $o->product_cr_cef          = escape($_REQUEST['product_cr_cef']);
    $o->product_cr_onan         = escape($_REQUEST['product_cr_onan']);
    $o->product_cr_kashiyama    = escape($_REQUEST['product_cr_kashiyama']);
    $o->product_cr_yanmar       = escape($_REQUEST['product_cr_yanmar']);
    $o->product_cr_doosan       = escape($_REQUEST['product_cr_doosan']);

    $o->product_cr_others       = escape($_REQUEST['product_cr_others']);
    $o->product_cr_detroits     = escape($_REQUEST['product_cr_detroits']);
    $o->product_cr_cummins      = escape($_REQUEST['product_cr_cummins']);
    $o->product_cr_cats         = escape($_REQUEST['product_cr_cats']);*/
    $o->product_uom           = escape($_REQUEST['product_uom']);
    $o->product_enginemodel     = escape($_REQUEST['product_enginemodel']);
    $o->maingroup_id            = escape($_POST['maingroup_id']);
    $o->image_input             = $_FILES['image_input'];
    $o->product_remark          = escape($_POST['product_remark']);
    $o->product_seqno           = escape($_POST['product_seqno']);
    $o->product_status          = escape($_POST['product_status']);
    $o->product_location           = escape($_REQUEST['product_location']);
    $o->product_name           = stripslashes(htmlspecialchars_decode($_REQUEST['product_name']));
    $o->product_lowstock        = escape($_REQUEST['product_lowstock']);

    $o->current_tab = $_REQUEST['current_tab'];

    $o->probom_id = escape($_POST['probom_id']);
    $o->probom_material_id = escape($_POST['probom_material_id']);
    $o->probom_qty = escape($_POST['probom_qty']);
    $o->probom_layer = escape($_POST['probom_layer']);
    $o->total_line_material = escape($_POST['total_line_material']);


    $o->prolabour_id = escape($_POST['prolabour_id']);
    $o->prolabour_labour_id = escape($_POST['prolabour_labour_id']);
    $o->prolabour_qty = escape($_POST['prolabour_qty']);
    $o->prolabourlayer = escape($_POST['prolabourlayer']);
    $o->total_line_labour = escape($_POST['total_line_labour']);

    $o->line_type = escape($_POST['line_type']);
    $o->line_id = escape($_POST['line_id']);
    switch ($action) {
        case "create":
            $count_partno = getDataCountBySql("db_product", "WHERE product_part_no = '$o->product_part_no' AND product_status = 1");
            if($count_partno>0){
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("product.php?action=createForm",getSystemMsg(0,'Create data fail: Product Part No exists in the list'));
            }else{
                if($o->create()){
                    $_SESSION['status_alert'] = 'alert-success';
                    $_SESSION['status_msg'] = "Create success.";
                    rediectUrl("product.php?action=edit&product_id=$o->product_id",getSystemMsg(1,'Create data successfully'));
                }else{
                    $_SESSION['status_alert'] = 'alert-error';
                    $_SESSION['status_msg'] = "Create fail.";
                    rediectUrl("product.php",getSystemMsg(0,'Create data fail'));
                }
            }

            exit();
            break;
        case "update":
//            $count_partno = getDataCountBySql("db_product", "WHERE product_part_no = '$o->product_part_no' AND product_status = 1");
//            if($count_partno>0){
//                $_SESSION['status_alert'] = 'alert-error';
//                $_SESSION['status_msg'] = "Delete fail.";
//                rediectUrl("product.php?action=edit&product_id=$o->product_id",getSystemMsg(0,'Update data fail: This Product Part No has existed in the list'));
//            }else{
                if($o->update()){
                    $_SESSION['status_alert'] = 'alert-success';
                    $_SESSION['status_msg'] = "Update success.";
                    rediectUrl("product.php?action=edit&product_id=$o->product_id",getSystemMsg(1,'Update data successfully'));
                }else{
                    $_SESSION['status_alert'] = 'alert-error';
                    $_SESSION['status_msg'] = "Update fail.";
                    rediectUrl("product.php?action=edit&product_id=$o->product_id",getSystemMsg(0,'Update data fail'));
                }
//            }

            exit();
            break;
        case "edit":
            if($o->fetchProductDetail(" AND p.product_id = '$o->product_id'","","",1)){
                $o->getInputForm("update");
            }else{
               rediectUrl("product.php",getSystemMsg(0,'Fetch Data'));
            }
            exit();
            break;
        case "delete":
            $order_prod = getDataCountBySql("db_ordl ol LEFT JOIN db_product p ON ol.ordl_pro_id = p.product_id LEFT JOIN db_order o ON ol.ordl_order_id = o.order_id", "WHERE p.product_id = '$o->product_id' AND o.order_status = 1");
            if($order_prod>0){
                $_SESSION['status_alert'] = 'alert-error';
                $_SESSION['status_msg'] = "Delete fail.";
                rediectUrl("product.php",getSystemMsg(0,'Delete fail: Product has in transaction'));
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
            $t = $gf->checkDuplicate("db_product",'product_code',$o->product_code,'product_id',$o->product_id);
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

        case "deleteline":
            if($o->line_type == 'material'){
                if($o->deleteMaterialLine()){
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
                  /*  $reader = new Spreadsheet_Excel_Reader($_FILES["import_file"]["tmp_name"]);

                    $reader->setUTFEncoder('iconv');
                    $reader->setOutputEncoding('CP1251');
                //    $reader->setOutputEncoding('UTF-8');
                    foreach($reader->sheets as $k=>$data)
                   {


                      foreach($data['cells'] as $row)
                      {
                          foreach($row as $cell)
                          {
                              echo "$cell\t";
                          }
                          echo "\n";
                      }
                   }
                   echo '<pre>';
                   print_r($reader);
                   die();*/

//              count($data->sheets)
//               $data->sheets[$i]["cells"]
                    $s = 0;
                    for($i=0;$i<count($data->sheets);$i++){

                         for($j=1;$j<=17;$j++){
                            $b = false;

                            if(($data->sheets[$i]["cells"][$j][1] == 'Product_name') || ($data->sheets[$i]["cells"][$j][1] == '')){
                                     continue;
                            }
                            // for($k=1;$k<=3;$k++){$k
                                 $product_code = escape($data->sheets[$i]["cells"][$j][3]);

                                //  echo '<pre>';
                                 //print_r($product_code);
                                 //die();//edr

                                 $sql_select= "SELECT product_id FROM db_product WHERE product_part_no = '$product_code'";
                                 $query_select = mysql_query($sql_select);
                                 $select = mysql_fetch_array($query_select);
                                 if (!empty($select) ) {
                                   print_r('UPDATEs');
                                 }else{
                                   print_r('creates');
                                 }
                                // $dumb = $o->fetchProductDetail(" AND p.product_code = '$product_code'","","",1);
                                 echo '<pre>';
                                 print($product_code);
                                 echo '<br>';
                                 var_dump($select);die();


                                 if($o->fetchProductDetail(" AND p.product_part_no = '$product_code'","","",1)){
                                   die('fetchProductDetail');
                                     $o->product_desc = $data->sheets[$i]["cells"][$j][4];
                                     $o->product_sales_price = $data->sheets[$i]["cells"][$j][14];
                                     if($o->update()){
                                         $b = true;
                                     }else{
                                         $b = false;
                                     }
                                 }else{//SELECT * FROM `db_category`
                                  // die('ntest');

                                  $o->product_name = $data->sheets[$i]["cells"][$j][1];//product name

                                  $test =$data->sheets[$i]["cells"][$j][2];
                                  $sql_cat = "SELECT category_id FROM db_category WHERE category_code='$test'";
                                  $query = mysql_query($sql_cat);
                                  $row = mysql_fetch_array($query);
                                  $cat_id = $row['category_id'];
                                  $o->product_category = (int)$cat_id;
                                  die('ntest');
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

                                 $test = $o->create();

                                 }
//                                     echo $data->sheets[$i]["cells"][$j][$k] . "&nbsp";
                          //edr innsert here
                  //      }//$k
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

            echo json_encode(array("itemlabour"=>$o->select->getProductLabourSelectCtrl("","Y"," AND p.prolabour_product_id = '$o->product_id' ")));



            exit();
            break;
        case "getSubGroupJson":
            if ($o->maingroup_id > 0){
                $subgroup_option = $o->select->getItemSubGroupSelectCtrl("","Y"," AND subgroup_main_id = ".$o->maingroup_id);
                echo json_encode(array('status'=>1,
                                      '$subgroup_option'=>$subgroup_option));
            }else{
               echo json_encode(array('status'=>0));
            }
            exit();
            break;
        default:
            $o->getListing();
            exit();
            break;
    }
