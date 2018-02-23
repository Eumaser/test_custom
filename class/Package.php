<?php
/*
 * To change this tpackageate, choose Tools | Tpackageates
 * and open the tpackageate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Package {

    public function Package(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();


    }
    public function create(){
        $table_field = array('package_part_no','package_desc','package_sale_price','package_cost_price',
                             'package_category','package_brand','package_packagetype','package_outlet',
                             'package_barcode','package_remark','package_seqno','package_status',
                             'package_custom_no','package_weight','package_uom','package_product_wastage',
                             'package_labour_profit');
        $table_value = array($this->package_part_no,$this->package_desc,$this->package_sale_price,$this->package_cost_price,
                             $this->package_category,$this->package_brand,$this->package_packagetype,$this->package_outlet,
                             $this->package_barcode,$this->package_remark,$this->package_seqno,$this->package_status,
                             $this->package_custom_no,$this->package_weight,$this->package_uom,$this->package_product_wastage,
                             $this->package_labour_profit);
        $remark = "Insert Package.";
        if(!$this->save->SaveData($table_field,$table_value,'db_package','package_id',$remark)){
           return false;
        }else{
           $this->package_id = $this->save->lastInsert_id;
           $this->pictureManagement();
           return true;
        }
    }
    public function update(){
        $table_field = array('package_part_no','package_desc','package_sale_price','package_cost_price',
                             'package_category','package_brand','package_packagetype','package_outlet',
                             'package_barcode','package_remark','package_seqno','package_status',
                             'package_custom_no','package_weight','package_uom','package_product_wastage',
                             'package_labour_profit');
        $table_value = array($this->package_part_no,$this->package_desc,$this->package_sale_price,$this->package_cost_price,
                             $this->package_category,$this->package_brand,$this->package_packagetype,$this->package_outlet,
                             $this->package_barcode,$this->package_remark,$this->package_seqno,$this->package_status,
                             $this->package_custom_no,$this->package_weight,$this->package_uom,$this->package_product_wastage,
                             $this->package_labour_profit);
        $remark = "Update Package.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_package','package_id',$remark,$this->package_id)){
           return false;
        }else{
           $this->pictureManagement();
           return true;
        }
    }
    public function pictureManagement(){
        if(!file_exists("dist/images/package")){
           mkdir('dist/images/package/');
        }
        $isimage = false;
        if($this->image_input['type'] == 'image/png' || $this->image_input['type'] == 'image/jpeg' || $this->image_input['type'] == 'image/gif'){
           $isimage = true;
        }

        if($this->image_input['size'] > 0 && $isimage == true){
            if($this->action == 'update'){
                unlink("dist/images/package/{$this->package_id}.png");
            }

                move_uploaded_file($this->image_input['tmp_name'],"dist/images/package/{$this->package_id}.png");
        }
    }
    public function fetchPackageDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT p.*,empl.empl_code as insert_by,empl2.empl_code as update_by,b.probom_product_id as package_product_id,b.probom_qty as package_product_qty
                FROM db_package p
                LEFT JOIN db_empl empl ON empl.empl_id = p.insertBy
                LEFT JOIN db_empl empl2 ON empl2.empl_id = p.updateBy
                LEFT JOIN db_probom b ON b.probom_package_id = p.package_id
                WHERE p.package_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->package_id = $row['package_id'];
            $this->package_part_no = $row['package_part_no'];
            $this->package_barcode = $row['package_barcode'];
            $this->package_desc = $row['package_desc'];
            $this->package_sale_price = $row['package_sale_price'];
            $this->package_cost_price = $row['package_cost_price'];
            $this->package_category = $row['package_category'];
            $this->package_category2 = $row['package_category2'];
            $this->package_category3 = $row['package_category3'];
            $this->package_brand = $row['package_brand'];
            $this->package_packagetype = $row['package_packagetype'];
            $this->package_outlet = $row['package_outlet'];
            $this->package_remark = $row['package_remark'];
            $this->package_seqno = $row['package_seqno'];
            $this->package_status = $row['package_status'];
            $this->package_part_no_cn = $row['package_part_no_cn'];
            $this->package_part_no_thai = $row['package_part_no_thai'];
            $this->package_desc_cn = $row['package_desc_cn'];
            $this->package_desc_thai = $row['package_desc_thai'];
            $this->update_by = $row['update_by'];
            $this->insertDateTime = $row['insertDateTime'];
            $this->insert_by = $row['insert_by'];
            $this->updateDateTime = $row['updateDateTime'];
            $this->package_isimport = $row['package_isimport'];
            $this->package_weight = $row['package_weight'];
            $this->package_custom_no = $row['package_custom_no'];
            $this->package_uom = $row['package_uom'];
            $this->package_product_wastage = $row['package_product_wastage'];
            $this->package_labour_profit = $row['package_labour_profit'];
            $this->partner_issitecoordinator = $row['partner_issitecoordinator'];
            $this->package_product_id = $row['package_product_id'];
            $this->package_product_qty = $row['package_product_qty'];
            if($row['updateBy'] == 10000){
                $this->update_by = "Webmaster";
            }
            if($row['insertBy'] == 10000){
                $this->insert_by = "Webmaster";
            }
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_package"," WHERE package_id = '$this->package_id'","Delete Package.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->package_seqno = 10;
            $this->package_status = 1;
        }
        $this->categoryCrtl1 = $this->select->getItemCategorySelectCtrl($this->package_category,'Y');
        $this->categoryCrtl2 = $this->select->getItemSubCategorySelectCtrl($this->package_category2,'Y');
        $this->categoryCrtl3 = $this->select->getItemSubSubCategorySelectCtrl($this->package_category3,'Y');


        $this->packagetypeCrtl = $this->select->getPackagetypeSelectCtrl($this->package_packagetype,'N');
        $this->brandCrtl = $this->select->getBrandSelectCtrl($this->package_brand,'N');
        $this->outletCrtl = $this->select->getOutletSelectCtrl($this->package_outlet,'N');
        $this->uomCrtl = $this->select->getUomSelectCtrl($this->probom_uom_id,'N');

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Package Management</title>
    <?php
    include_once 'css.php';

    ?>
    <style>

    </style>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      <!-- include header-->
      <?php include_once 'header.php';?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Package Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->currency_id > 0){ echo "Update Package";}else{ echo "Create New Item";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = '' onclick = "window.location.href='package.php'">Back to listing</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'margin-right:10px;' onclick = "window.location.href='package.php?action=createForm'">Create New</button>
                <?php }?>
              </div>

                <form id = 'package_form' class="form-horizontal" action = 'package.php?action=create' method = "POST" enctype="multipart/form-data">
                     <input type ='hidden' name = 'current_tab' id = 'current_tab' value = "<?php echo $this->current_tab?>"/>
                  <div class="box-body">
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li tab = "General" class="tab_header <?php if(($this->current_tab == "") || ($this->current_tab == "General")){ echo 'active';}?>"><a href="#general" data-toggle="tab">General</a></li>
                          <?php if($this->package_id > 0){?>
                          <li tab = "Product" class="tab_header <?php if($this->current_tab == "Product"){ echo 'active';}?>" ><a href="#Product" data-toggle="tab">Product</a></li>
                          <!--<li tab = "Labour" class="tab_header <?php if($this->current_tab == "Labour"){ echo 'active';}?>"><a href="#Labour" data-toggle="tab">Job Scope</a></li>-->
                          <?php }?>
                        </ul>
                      </div>
                        <div class="tab-content">
                          <div class=" tab-pane <?php if(($this->current_tab == "") || ($this->current_tab == "General")){ echo 'active';}?>" id="general">
                              <?php echo $this->getGeneralForm();?>
                          </div>
                          <?php if($this->package_id > 0){?>
                          <div class=" tab-pane <?php if($this->current_tab == "Product"){ echo 'active';}?>" id="Product">
                              <?php echo $this->getProductForm();?>
                          </div>
                          <!--<div class=" tab-pane <?php if($this->current_tab == "Labour"){ echo 'active';}?>" id="Labour">
                              <?php echo $this->getLabourForm();?>
                          </div>-->
                          <?php }?>
                       </div>


                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)" style="display:none;">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->package_status;?>" name = "package_status"/>
                    <input type = "hidden" value = "<?php echo $this->package_id;?>" name = "package_id" id = "package_id"/>
                    <?php
                    if($this->package_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                    ?>
                    <button type = "submit" class="btn btn-info">Submit</button>
                    <?php }?>
                  </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';

    ?>

<div class="modal fade "  id="ProductModal" role="dialog">
    <div class="modal-dialog " style = 'width:60%'>

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Product Item Info</h4>
        </div>
        <div class="modal-body">
            <form id = 'product_form' class="form-horizontal">
                <div class="col-sm-12">
                    <div class="form-group">
                      <label for="probom_product_id" class="col-sm-2 control-label">Product <?php echo $mandatory;?></label>
                      <div class="col-sm-9">
                           <select class="form-control select2" id="probom_product_id" name="probom_product_id" style = 'width:100%' >
                               <?php echo $this->productCrtl;?>
                           </select>
                      </div>
                    </div>
                    <div style = 'clear:both' ></div>
                    <div class="form-group">
                      <label for="probom_qty" class="col-sm-2 control-label">Quantity</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control text-align-right" id="probom_qty" name="probom_qty" value = "<?php echo $this->probom_qty;?>" placeholder="Quantity">
                      </div>
                    </div>
                <div style = 'clear:both' ></div>
                    <div class="form-group">
                      <label for="probom_uom" class="col-sm-2 control-label">UOM</label>
                      <div class="col-sm-9">
                          <select class="form-control select2" id="probom_uom_id" name="probom_uom_id" style = 'width:100%' >
                               <?php echo $this->uomCrtl;?>
                           </select>
                      </div>
                    </div>
                    <div style = 'clear:both' ></div>
                    <div class="form-group">
                      <label for="probom_cost_price" class="col-sm-2 control-label">Cost Price</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control text-align-right" id="probom_cost" name="probom_cost" value = "<?php echo $this->probom_cost;?>" placeholder="Cost Price">
                      </div>
                    </div>
                <div class="form-group">
                      <label for="probom_sale_price" class="col-sm-2 control-label">Sale Price</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control text-align-right" id="probom_sale" name="probom_sale" value = "<?php echo $this->probom_sale;?>" placeholder="Sale Price">
                      </div>
                    </div>
                </div>
                <input type = 'hidden' name = 'probom_id' id = 'probom_id' value = '0'/>
            </form>
            <div style = 'clear:both' ></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id = 'add_product' >Add Product</button>
        </div>
      </div>

    </div>
  </div>

<div class="modal fade " id="LabourModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Labour Item Info</h4>
        </div>
        <div class="modal-body">
            <form id = 'labour_form' class="form-horizontal">
                <div class="col-sm-12">
                    <div class="form-group">
                      <label for="prolabour_labour_id" class="col-sm-3 control-label">Labour <?php echo $mandatory;?></label>
                      <div class="col-sm-6">
                           <select class="form-control select2" id="prolabour_labour_id" name="prolabour_labour_id" style = 'width:100%' >
                               <?php echo $this->labourCrtl;?>
                           </select>
                      </div>
                    </div>
                    <div style = 'clear:both' ></div>
                    <div class="form-group">
                      <label for="prolabour_qty" class="col-sm-3 control-label">Quantity</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control text-align-right" id="prolabour_qty" name="prolabour_qty" value = "<?php echo $this->prolabour_qty;?>" placeholder="Quantity">
                      </div>
                    </div>
                </div>
                <input type = 'hidden' name = 'prolabour_id' id = 'prolabour_id' value = '0'/>
            </form>
            <div style = 'clear:both' ></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id = 'add_labour' >Add Labour</button>
        </div>
      </div>

    </div>
  </div>
    <script>
    $(document).ready(function() {
        $("#package_form").validate({
                  rules:
                  {
                      package_part_no:
                      {
                          required: true
                      }
                  }
    });
    $('.tab_header').click(function(){
        $('#current_tab').val($(this).attr('tab'));
    });
    $('#addnewproduct').click(function(){
       $('#add_product').text("Add Product");
       $('#probom_product_id').select2('val',"");
       $('#probom_qty').val("");
       $('#probom_cost').val("");
       $('#probom_sale').val("");
       $('#probom_uom_id').select2('val',"");
       $('#probom_id').val(0);
       $('#ProductModal').modal('show');

    });
    $('select#probom_product_id').change(function(){
            var selectedVal = $(this).val();
            var data = "action=getPackageDetail&product_id="+selectedVal+"&itype=product";
            $.ajax({
                type: 'POST',
                url: 'package.php',
                cache: false,
                data:data,
                success: function(data) {
                   var jsonObj = eval ("(" + data + ")");
                   if(jsonObj.status == 1){
                        $('input#probom_sale').val(jsonObj.product_sale_price);
                        $('input#probom_cost').val(jsonObj.product_cost_price);
                   }else{
                       alert("Fail to update line.");
                   }
                   issend = false;
                }
             });

             return false;
        });
    $('#addnewlabour').click(function(){
       $('#add_labour').text("Add Labour");
       $('#probom_id').val(0);
       $('#LabourModal').modal('show');
    });
    $('.delete_line_probom').on('click',function(){
        deleteline($(this).attr('probom_id'),'product');
    });
    $('.delete_line_prolabour').on('click',function(){
        deleteline($(this).attr('prolabour_id'),'labour');
    });
    $('.edit_line_product').on('click',function(){
        $('#probom_product_id').select2('val',$(this).attr('probom_product_id'));
        $('#probom_qty').val($(this).attr('probom_qty'));
        $('#probom_cost').val($(this).attr('probom_cost'));
        $('#probom_sale').val($(this).attr('probom_sale'));
        $('#probom_uom_id').select2('val',$(this).attr('probom_uom_id'));
        $('#probom_id').val($(this).attr('probom_id'));
        $('#add_product').text("Update Product");

        $('#ProductModal').modal('show');

        //    Check the drop-down list before page load
//            if (selectedVal == $(this).attr('probom_product_id'))
//            { return selected and keyed in value  }
//            else
//            { allow drop-down list change event   }
//        $('select#probom_product_id').on('change',function(){
//            var selectedVal = $(this).find(':selected').val();
//            var data = "action=getPackageDetail&product_id="+selectedVal+"&itype=product";
//            $.ajax({
//                type: 'POST',
//                url: 'package.php',
//                cache: false,
//                data:data,
//                error: function(xhr) {
//                    alert("System Error.");
//                    issend = false;
//                },
//                success: function(data) {
//                   var jsonObj = eval ("(" + data + ")");
//                   if(jsonObj.status == 1){
//                        $('input#probom_sale').val(jsonObj.product_sale_price);
//                        $('input#probom_cost').val(jsonObj.product_cost_price);
//                   }else{
//                       alert("Fail to update line.");
//                   }
//                   issend = false;
//                }
//             });
//
//             return false;
//        });
    });

    $('.edit_line_labour').on('click',function(){

        $('#prolabour_labour_id').select2('val',$(this).attr('prolabour_labour_id'));
        $('#prolabour_qty').val($(this).attr('prolabour_qty'));
        $('#prolabour_layer').val($(this).attr('prolabour_layer'));
        $('#prolabour_id').val($(this).attr('prolabour_id'));
        $('#add_product').text("Update Labour");


        $('#LabourModal').modal('show');
    });
    $('#add_product').click(function(){
        var data = "action=add_product&package_id=<?php echo $this->package_id;?>&"+$('#product_form').serialize()+"&total_line_product="+$('#total_line_product').val()+"&current_tab=Product";
        $.ajax({
            type: 'POST',
            url: 'package.php',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("System Error.");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   window.location.href = 'package.php?action=edit&current_tab=Product&package_id=<?php echo $this->package_id;?>';
//                   $('#product_lasttr').before(jsonObj.line);
//                   $('#total_line_product').val(parseFloat($('#total_line_product').val())+1);
               }else{
                   alert("Fail to delete line.");
               }
               issend = false;
            }
         });
         return false;
    });

    $('#add_labour').click(function(){
        var data = "action=add_labour&package_id=<?php echo $this->package_id;?>&"+$('#labour_form').serialize()+"&total_line_labour="+$('#total_line_labour').val()+"&current_tab=Labour";
        $.ajax({
            type: 'POST',
            url: 'package.php',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("System Error.");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   window.location.href = 'package.php?action=edit&current_tab=Labour&package_id=<?php echo $this->package_id;?>';
//                   $('#product_lasttr').before(jsonObj.line);
//                   $('#total_line_product').val(parseFloat($('#total_line_product').val())+1);
               }else{
                   alert("Fail to delete line.");
               }
               issend = false;
            }
         });
         return false;
    });
    $('#package_labour_profit').on('keyup',function(){

        $('#profit_amt').text('$ ' + changeNumberFormat(RoundNum(($(this).val()/100) * $('#labour_subtotal').val(),2)));
        $('#Grandtotal_profit_amt').text('$ ' + changeNumberFormat( RoundNum(parseFloat(RoundNum(($(this).val()/100) * $('#labour_subtotal').val(),2)) + parseFloat($('#labour_subtotal').val()),2) ) );
    });
    $('#product_wastage').on('keyup',function(){

        $('#wastage_amt').text('$ ' + changeNumberFormat(RoundNum(($(this).val()/100) * $('#product_subtotal').val(),2)));
        $('#Grandtotal_wastage_amt').text('$ ' + changeNumberFormat( RoundNum(parseFloat(RoundNum(($(this).val()/100) * $('#product_subtotal').val(),2)) + parseFloat($('#product_subtotal').val()),2) ) );
    });
});
    function deleteline(line_id,line_type){
        var data = "action=deleteline&package_id=<?php echo $this->package_id;?>&line_id="+line_id+"&line_type="+line_type;
        $.ajax({
            type: 'POST',
            url: 'package.php',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("System Error.");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                    window.location.href = 'package.php?action=edit&current_tab=' + $('#current_tab').val() + '&package_id=<?php echo $this->package_id;?>';
               }else{
                   alert("Fail to delete line.");
               }
               issend = false;
            }
         });
         return false;
    }
    </script>
  </body>
</html>
        <?php

    }
    public function getListing(){
    ?>
    <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Package Management</title>
    <?php
    include_once 'css.php';

    ?>
    <style>

   </style>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      <!-- include header-->
      <?php include_once 'header.php';?>
      <!-- Full Width Column -->
      <div class="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Package Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Package Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='package.php?action=createForm'">Create New + </button>

                <!--<button style = 'margin-right:10px;' class="btn btn-primary pull-right import_btn" data-toggle="modal" data-target="#myModal">Import + </button>-->
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="package_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Part No</th>
                        <th>Description</th>
                        <th>U/Price ($)</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $sql = "SELECT package.*
                              FROM db_package package
                              WHERE package.package_id > 0 limit 0,100";
                      //$query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['package_part_no'];?></td>
                            <td><?php echo $row['package_desc'];?></td>
                            <td><?php echo $row['package_sale'];?></td>
                            <td><?php if($row['package_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'package.php?action=edit&package_id=<?php echo $row['package_id'];?>'">Edit</button>
                                <?php }?>
                                <?php
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('package.php?action=delete&package_id=<?php echo $row['package_id'];?>','Confirm Delete?')">Delete</button>
                                <?php }?>
                            </td>
                        </tr>
                    <?php
                        $i++;
                      }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Part No</th>
                        <th>Description</th>
                        <th>U/Price ($)</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper --><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    ?>
<script type="text/javascript" src="http://www.sanwebe.com/assets/public/js/jquery.form.min.js"></script>
    <script>

      $(function () {
        $('#package_table').DataTable({
                "dom": '<"topleft"l><"topright"f>rt<"btmleft"i><"btmright"p><"clear">',
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "package.php?action=getDataTable",
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "iDisplayLength": 25,
                "aoColumns": [
                      { "bSortable": false },
                      null,
                      null,
                      null,
                      null,
                      {"sClass": "text-align-right" }
                  ]
        });

        $("div.topleft").addClass('col-sm-3');
        $("div.topright").css('text-align','left');
        $("div.btmleft").addClass('col-sm-6');
        $("div.btmright").addClass('col-sm-6');
        $("#package_table_filter").css('text-align','left');
        $('.dataTables_filter input[type="search"]').css(
            {'width':'500px','display':'inline-block'}
         );

            $('#uploadForm').submit(function(e) {
                if($('#import_file').val()) {
                    e.preventDefault();
                    $('#loader-icon').show();
                    $(this).ajaxSubmit({
                        target:   '#targetLayer',
                        beforeSubmit: function() {
                            $("#targetLayer").html("<img style = 'width:100px;' src = 'dist/img/LoaderIcon.gif'/>");
                            $(".import_btn").val("Importing.......");
                            $(".import_btn").attr("disabled",true);
                        },
                        success:function (data){
                            jsonObj = eval('('+ data +')');
                            if(jsonObj.status == 1){
                                $("#targetLayer").html("<font color = 'green'><b>Import Success. &nbsp;&nbsp;&nbsp;" + jsonObj.data + "rows effect.</b></font>");
                            }else{
                                $("#targetLayer").html("<font color = 'red'><b>Import Fail.</b></font>");
                            }
                            $(".import_btn").val("Import");
                            $(".import_btn").attr("disabled",false);
                        },
                        resetForm: true
                    });
                    return false;
                }
            });

      });

    </script>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Import Package</h4>
            </div>
                <div id="bar_blank">
   <div id="bar_color"></div>
  </div>
              <div id="status"></div>
            <form id = 'uploadForm' action = 'package.php' method = "POST" >
                <div class="modal-body">

                    <input type = "file" name = 'import_file' id = 'import_file' style = 'display:inline;'/>

                    <input type = 'hidden' value ='import'  name = 'action' style = 'display:inline;'/>

                    <div id="targetLayer" style = 'display:inline;'></div>
                    <br>Xls,Csv file only.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type = 'submit' class="btn btn-primary pull-right import_btn" value ='Import' />
                </div>
            </form>
          </div>

        </div>
    </div>
  </body>
</html>
    <?php
    }
    public function getDataTable(){
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array('No','package_part_no','package_desc','package_sale_price','package_status','');

	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "package_id";

	/* DB table to use */
        $sTable = "db_package";
        /*
	 * Paging
	 */
	$sLimit = "";
	if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
		$sLimit = "LIMIT ".mysql_real_escape_string($_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}

	/*
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if($_GET['sSearch'] != ""){
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
                        if($aColumns[$i] == 'No' || $aColumns[$i] == ""){
                            continue;
                        }
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}

	/* Individual column filtering */
	for ($i=0;$i<count($aColumns);$i++){
                if($aColumns[$i] == 'No' || $aColumns[$i] == ""){
                    continue;
                }
		if($_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != ''){
			if ($sWhere == "" ){
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}

	/*
	 * SQL queries
	 * Get data to display
	 */

        if(isset($_GET['iSortCol_0'])){
            if($_GET['iSortCol_0'] != 0){
		$sOrder = "ORDER BY  ";
		for($i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ){
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ){
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}

		$sOrder = substr_replace( $sOrder, "", -2 );
		if($sOrder == "ORDER BY" ){
			$sOrder = "";
		}
            }
	}else{
            $sOrder = "ORDER BY package.package_seqno,package.package_part_no";
        }

	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS package.*
		FROM db_package package
		$sWhere
		$sOrder

		$sLimit

	";

	$rResult = mysql_query($sQuery);

	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query($sQuery);
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];

	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysql_query($sQuery);
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];


	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
        $b = $_GET['iDisplayStart']+1;
	while ($aRow = mysql_fetch_array($rResult)){
		$row = array();
		for ($i=0;$i<count($aColumns);$i++){
			if($aColumns[$i] == "No" ){
				$row[] = $b;
			}else if($aColumns[$i] != ""){
                            if($aColumns[$i] == 'package_status'){
                                if($aRow[$aColumns[$i]] == 1){
                                    $row[] = "Active";
                                }else{
                                    $row[] = "In-Active";
                                }
                            }else{
                                $row[] = html_entity_decode(escape($aRow[$aColumns[$i]]));
                            }
			}else{
                           $btn = "";
                           if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                             $btn = "<button type='button' class='btn btn-primary btn-info ' onclick = 'location.href = \"package.php?action=edit&package_id={$aRow['package_id']}\"'>Edit</button>";
                           }
                           if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                             $btn .= " <button type='button' class='btn btn-primary btn-danger' onclick = 'confirmAlertHref(\"package.php?action=delete&package_id={$aRow['package_id']}\",\"Confirm Delete?\")'>Delete</button>";
                           }
                                $row[] = $btn;
                        }
		}
		$output['aaData'][] = $row;
                $b++;
	}

	echo json_encode($output);
    }
    public function getPackageDetailTransaction(){

        $package_query = $this->fetchPackageDetail(" AND p.package_id = '$this->package_id'","","",0);

        if($row = mysql_fetch_array($package_query)){
            return $row;
        }else{
            return null;
        }
    }
    public function getGeneralForm(){
    ?>
        <div class="col-sm-9">
            <div class="form-group">
              <label for="package_part_no" class="col-sm-2 control-label">Part No <?php echo $mandatory;?></label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="package_part_no" name="package_part_no" value = "<?php echo $this->package_part_no;?>" placeholder="Package Code">
              </div>
            </div>
            <div class="form-group">
              <label for="package_desc" class="col-sm-2 control-label">Description <?php echo $mandatory;?></label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="package_desc" name="package_desc" value = "<?php echo $this->package_desc;?>" placeholder="Package Name">
              </div>
            </div>
            <div class="form-group">
              <label for="package_sale_price" class="col-sm-2 control-label">Package Sale Price <?php echo $mandatory;?></label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="package_sale_price" name="package_sale_price" value = "<?php echo $this->package_sale_price;?>" placeholder="Package Sale Price">
              </div>
            </div>
<!--            <div class="form-group">
              <label for="package_barcode" class="col-sm-2 control-label" >Add Profit </label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="package_barcode" name="package_barcode" value = "<?php echo $this->package_barcode;?>" placeholder="Add Profit">
              </div>
            </div>  -->
            <div class="form-group">
                <label for="package_remark" class="col-sm-2 control-label">Remark</label>
                <div class="col-sm-5">
                      <textarea class="form-control" rows="3" id="package_remark" name="package_remark" placeholder="Remark"><?php echo $this->package_remark;?></textarea>
                </div>
            </div>

      </div>
      <!--<div class="col-sm-3">
          <?php if(file_exists("dist/images/package/$this->package_id.png")){?>
            <img src ="dist/images/package/<?php echo $this->package_id;?>.png" style = 'width:215px;height:215px;'/>
          <?php }else{?>
            <img src ='dist/img/no_image.png'  />

          <?php }?>
             <p></p>
            <input type = "file" name = 'image_input' />
      </div>-->
    <?php
    }
    public function getProductForm(){
        global $mandatory;
        $this->productCrtl = $this->select->getProductSelectCtrl(0,'Y');
        //$this->uomCrtl = $this->select->getUomSelectCtrl(0,'Y');
    ?>

      <div class="col-sm-12" style = 'margin-bottom:10px;' >
          <div class = 'pull-left' ></div>
          <div class = 'pull-right'>

              <button type = 'button' class = 'btn btn-info' id = 'addnewproduct' style = 'margin-top:15px;' >Add New Product</button>

          </div>
      </div>
    <div style = 'clear:both'></div>
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:5%;padding-left:5px">No</th>
            <th class = "" style = 'width:15%;'>Part No</th>
            <th class = "" style = 'width:30%;'>Description</th>
            <th class = "text-align-right" style = 'padding-left:10px;width:3%;'>Quantity</th>
            <th class = "text-align-right" style = 'padding-left:10px;width:2%;'>UOM</th>
            <th class = "text-align-right" style = 'padding-left:10px;width:10%;'>Cost</th>
            <th class = "text-align-right" style = 'padding-left:10px;width:10%;'>Sale</th>
            <th class = "text-align-right" style = 'padding-left:10px;width:10%;'>Sum Cost ($)</th>
            <th class = "text-align-right" style = 'padding-left:10px;width:10%;'>Sum Sale ($)</th>
            <th class = "" style="width:5%"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT bom.*,ma.product_part_no,ma.product_sale_price,ma.product_cost_price,ma.product_id,ma.product_desc,um.uom_code
                  FROM db_probom bom
                  INNER JOIN db_product ma ON ma.product_id = bom.probom_product_id
                  LEFT JOIN db_uom um ON um.uom_id = bom.probom_uom_id
                  WHERE bom.probom_package_id = '$this->package_id'";
          $query = mysql_query($sql);
          $i=1;
          $subtotal = 0;
          $linetotal = 0;
          //$product_wastage = $this->package_product_wastage;
          while($row = mysql_fetch_array($query)){
              $sum_cost_price_item = ($row['probom_cost']*$row['probom_qty']);
              $sum_sale_price_item = ($row['probom_sale']*$row['probom_qty']);
              $sum_cost_amount += $sum_cost_price_item;
              $sum_sale_amount += $sum_sale_price_item;
              //$linetotal = (($row['probom_qty']*$row['probom_layer'])*$row['product_sale_price']);
              //$subtotal = $subtotal + (($row['probom_qty']*$row['probom_layer'])*$row['product_sale_price']);
          ?>
            <tr>
                <td><?php echo $i;?></td>
                <td class = 'text-align-left'><?php echo $row['product_part_no'];?></td>
                <td><?php echo "<a href = 'product.php?action=edit&product_id={$row['product_id']}' target = 'blank' >" . $row['product_desc'] . "</a>";?></td>
                <td class = 'text-align-right'><?php echo $row['probom_qty'];?></td>
                <td class = 'text-align-left'><?php echo $row['uom_code'];?></td>
                <td class = 'text-align-right'>$ <?php echo $row['probom_cost'];?></td>
                <td class = 'text-align-right'>$ <?php echo $row['probom_sale'];?></td>
                <td class = 'text-align-right'>$ <?php echo num_format($sum_cost_price_item);?></td>
                <td class = 'text-align-right'>$ <?php echo num_format($sum_sale_price_item);?></td>
                <td class = 'text-align-right'>
                    <a title = 'edit' style = "margin-left:10px;margin-right:10px;font-size:20px;" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" probom_id = "<?php echo $row['probom_id'];?>" probom_product_id = '<?php echo $row['probom_product_id'];?>' probom_qty = '<?php echo $row['probom_qty'];?>' probom_cost = '<?php echo $row['probom_cost'];?>' probom_sale = '<?php echo $row['probom_sale'];?>' probom_uom_id = '<?php echo $row['probom_uom_id'];?>' class = "edit_line_product font-icon" line = "<?php echo $i;?>" ><i class="fa fa-edit" aria-hidden="true"></i></a>

                    <a title = 'delete' style = "margin-left:10px;margin-right:10px;font-size:20px;color:red" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" probom_id = "<?php echo $row['probom_id'];?>" class = "delete_line_probom font-icon" line = "<?php echo $i;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                </td>
            </tr>
          <?php
          $i++;
          }
          ?>
            <tr id = 'product_lasttr' ></tr>
            <tr>
                <td colspan = '6' class ='text-align-right'>Total Cost and Sale</td>
                <td></td>
                <td class ='text-align-right' id = 'total_cost' >$ <?php echo num_format($sum_cost_amount);?></td>
                <td class ='text-align-right' id = 'total_sale' >$ <?php echo num_format($sum_sale_amount);?></td>
                <td></td>
            </tr>

        </tbody>

    </table>
    <input type = 'hidden' value = '<?php echo $i;?>' id = 'total_line_product' name = "total_line_product" />
    <?php
    }
    public function getLabourForm(){
    global $mandatory;
        $this->labourCrtl = $this->select->getLabourSelectCtrl(0,'Y');
    ?>

      <div class="col-sm-12" style = 'margin-bottom:10px;' >
          <div class = 'pull-left' ></div>
          <div class = 'pull-right'>

              <button type = 'button' class = 'btn btn-info' id = 'addnewlabour' style = 'margin-top:15px;' >Add New Job</button>

          </div>
      </div>
    <div style = 'clear:both'></div>
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:5%;padding-left:5px">No</th>
            <th class = "" style = 'width:20%;'>Job Scope</th>
            <th class = "text-align-right" style = 'padding-left:10px;width:5%;'>Quantity</th>
            <th class = "text-align-right" style = 'padding-left:10px;width:10%;'>Cost</th>
            <th class = "text-align-right" style = 'padding-left:10px;width:10%;'>Amount($)</th>
            <th class = "" style="width:10%"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT pl.*,labour.labour_code,labour.labour_desc,labour.labour_sale_price,labour.labour_sale_price,labour.labour_id
                  FROM db_prolabour pl
                  INNER JOIN db_labour labour ON labour.labour_id = pl.prolabour_labour_id
                  WHERE pl.prolabour_package_id = '$this->package_id'";

          $query = mysql_query($sql);
          $i=1;
          $subtotal = 0;
          $linetotal = 0;
          $labour_profit = $this->package_labour_profit;
          while($row = mysql_fetch_array($query)){
              $linetotal = ($row['prolabour_qty']*$row['labour_sale_price']);
              $subtotal = $subtotal + ($row['prolabour_qty']*$row['labour_sale_price']);
          ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo "<a href = 'labour.php?action=edit&labour_id={$row['labour_id']}' target = 'blank' >" . $row['labour_code'] . "</a>";?></td>
                <td class = 'text-align-right'><?php echo $row['prolabour_qty'];?></td>
                <td class = 'text-align-right'>$ <?php echo $row['labour_sale_price'];?></td>
                <td class = 'text-align-right'>$ <?php echo num_format($linetotal);?></td>
                <td class = 'text-align-right'>
                    <a title = 'edit' style = "margin-left:10px;margin-right:10px;font-size:20px;" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" prolabour_id = "<?php echo $row['prolabour_id'];?>" prolabour_labour_id = '<?php echo $row['prolabour_labour_id'];?>' prolabour_qty = '<?php echo $row['prolabour_qty'];?>' prolabour_layer = '<?php echo $row['prolabour_layer'];?>' class = "edit_line_labour font-icon" line = "<?php echo $i;?>" ><i class="fa fa-edit" aria-hidden="true"></i></a>

                    <a title = 'delete' style = "margin-left:10px;margin-right:10px;font-size:20px;color:red" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" prolabour_id = "<?php echo $row['prolabour_id'];?>" class = "delete_line_prolabour font-icon" line = "<?php echo $i;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                </td>
            </tr>
          <?php
          $i++;
          }
          ?>
            <tr id = 'labour_lasttr' ></tr>
            <tr>
                <td colspan = '5' class ='text-align-right' >$ <?php echo num_format($subtotal);?> <input type = 'hidden' id = 'labour_subtotal' value = '<?php echo $subtotal;?>'/></td>
                <td></td>
            </tr>
            <tr>
                <td colspan = '3' class ='text-align-right'>Total Profit</td>
                <td class ='text-align-right' ><input type = 'text' class="form-control" style = 'text-align:right;width:50%;display: inline;' id = 'package_labour_profit' name = 'package_labour_profit' value = '<?php echo $labour_profit;?>'  /> % </td>
                <td class ='text-align-right' id = 'profit_amt' >$ <?php echo num_format($subtotal * ($labour_profit/100));?></td>
                <td></td>
            </tr>
            <tr>
                <td colspan = '3' class ='text-align-right'>Total Labour Cost</td>
                <td></td>
                <td class ='text-align-right' id = 'Grandtotal_profit_amt' >$ <?php echo num_format($subtotal + ($subtotal * ($labour_profit/100)));?></td>
                <td></td>
            </tr>

        </tbody>

    </table>
    <input type = 'hidden' value = '<?php echo $i;?>' id = 'total_line_product' name = "total_line_product" />
    <?php
    }
    public function createUpdatePackageBom(){

        if($this->probom_id > 0){
            $table_field = array('probom_product_id','probom_qty','probom_cost','probom_sale','probom_uom_id');
            $table_value = array($this->probom_product_id,$this->probom_qty,$this->probom_cost,$this->probom_sale,$this->probom_uom_id);
            $remark = "Update Package's Bom.";
            if(!$this->save->UpdateData($table_field,$table_value,'db_probom','probom_id',$remark,$this->probom_id)){
               return false;
            }else{
               $this->calculatePackagePrice();
               return true;
            }
        }else{
            $table_field = array('probom_package_id','probom_product_id','probom_qty','probom_cost','probom_sale','probom_uom_id');
            $table_value = array($this->package_id,$this->probom_product_id,$this->probom_qty,$this->probom_cost,$this->probom_sale,$this->probom_uom_id);
            $remark = "Insert Package's Bom.";
            if(!$this->save->SaveData($table_field,$table_value,'db_probom','probom_id',$remark)){
               return false;
            }else{
               $this->calculatePackagePrice();
               return true;
            }
        }
    }
    public function createUpdatePackageLabour(){

        if($this->prolabour_id > 0){
            $table_field = array('prolabour_labour_id','prolabour_qty');
            $table_value = array($this->prolabour_labour_id,$this->prolabour_qty);
            $remark = "Update Package's Bom.";
            if(!$this->save->UpdateData($table_field,$table_value,'db_prolabour','prolabour_id',$remark,$this->prolabour_id)){
               return false;
            }else{
               $this->calculatePackagePrice();
               return true;
            }
        }else{
            $table_field = array('prolabour_package_id','prolabour_labour_id','prolabour_qty');
            $table_value = array($this->package_id,$this->prolabour_labour_id,$this->prolabour_qty);
            $remark = "Insert Package's Bom.";
            if(!$this->save->SaveData($table_field,$table_value,'db_prolabour','prolabour_id',$remark)){
               return false;
            }else{
               $this->calculatePackagePrice();
               return true;
            }
        }
    }
    public function deleteProductLine(){

        if($this->save->DeleteData("db_probom"," WHERE probom_package_id = '$this->package_id' AND probom_id = '$this->line_id'","Delete {$this->package_id} Product Line.")){
            $this->calculatePackagePrice();
            return true;
        }else{
            return false;
        }
    }
    public function deleteLabourLine(){

        if($this->save->DeleteData("db_prolabour"," WHERE prolabour_package_id = '$this->package_id' AND prolabour_id = '$this->line_id'","Delete {$this->package_id} Labour Line.")){
            $this->calculatePackagePrice();
            return true;
        }else{
            return false;
        }
    }
    public function getItemProductDetail(){
//        CONCAT(COALESCE(mc.productcategory_code,''),' - ',COALESCE(ms.mscategory_code,''),' - ',COALESCE(mss.msscategory_code,''),' => $',m.product_sale_price) as product_code
        $sql = "SELECT CONCAT(COALESCE(mc.category_code,''),' - ',COALESCE(ms.mscategory_code,''),' - ',COALESCE(mss.msscategory_code,''),' - ',COALESCE(m.product_part_no,''),' => $',m.product_sale_price) as product_code
                FROM db_probom pm
                INNER JOIN db_product m ON m.product_id = pm.probom_product_id

                LEFT JOIN db_msscategory mss ON mss.msscategory_id = m.product_category
                LEFT JOIN db_mscategory ms ON ms.mscategory_id = mss.mssparent_id
                LEFT JOIN db_category mc ON ms.msparent_id = mc.category_id
                WHERE pm.probom_package_id = '$this->package_id'";
        $query = mysql_query($sql);
        $html = "[Product]\n";
        while($row = mysql_fetch_array($query)){
            $html .= " - " . $row['product_code'] . "\n";
        }
        $html .= "[Labour]\n";

        $sql = "SELECT CONCAT(l.labour_code,' => $',l.labour_sale_price) as labour_code
                FROM db_prolabour pr
                INNER JOIN db_labour l ON l.labour_id = pr.prolabour_labour_id
                WHERE pr.prolabour_package_id = '$this->package_id'";
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $html .= " - " . $row['labour_code'] . "\n";
        }
        return $html;
    }
    public function calculatePackagePrice(){
        $this->fetchPackageDetail(" AND p.package_id = '$this->package_id'", $orderstring, $wherelimit, 1);
        $sql1 = "
            SELECT SUM(a.total + (a.total * ($this->package_labour_profit/100))) as final_total FROM (
                SELECT SUM( ((bom.probom_qty * bom.probom_layer) * ma.product_sale_price) + (((bom.probom_qty * bom.probom_layer) * ma.product_sale_price) * ($this->package_product_wastage/100))  ) as total
                    FROM db_probom bom
                    INNER JOIN db_product ma ON ma.product_id = bom.probom_product_id
                    WHERE bom.probom_package_id = '$this->package_id'

                    UNION

                    SELECT SUM(pl.prolabour_qty*labour.labour_sale_price) as total
                    FROM db_prolabour pl
                    INNER JOIN db_labour labour ON labour.labour_id = pl.prolabour_labour_id
                    WHERE pl.prolabour_package_id = '$this->package_id'
                    ) a

                ";
        $query1 = mysql_query($sql1);
        if($row1 = mysql_fetch_array($query1)){
            $final_total = num_format($row1['final_total']);
        }else{
            $final_total = 0;
        }

        $sql = "UPDATE db_package SET package_sales_price = '$final_total' WHERE package_id = '$this->package_id'";
        mysql_query($sql);
    }
}
?>
