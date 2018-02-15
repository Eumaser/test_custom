<?php
/*
 * To change this tproductate, choose Tools | Tproductates
 * and open the tproductate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Product {

    public function Product(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('product_category','product_part_no','product_desc','product_remark',
                            'product_sale_price','product_cost_price','product_seqno','product_status',
                            'product_system_code','product_qty_blades','product_insert_types','product_diameter',
                            'product_width_depth','product_shaft_diameter','product_main_group','product_sub_group',
                            'product_n_wt','product_g_wt','product_usage','product_enginemodel',
                            'product_stock','product_cr_jabsco','product_cr_sherwood','product_cr_johnson',
                            'product_cr_volvo','product_cr_cef','product_cr_onan','product_cr_kashiyama',
                            'product_cr_yanmar','product_cr_doosan','product_cr_others','product_cr_detroits',
                            'product_cr_cummins','product_cr_cats','product_location','product_name',
                            'product_lowstock');
        $table_value = array($this->product_category,$this->product_part_no,$this->product_desc,$this->product_remark,
                            $this->product_sale_price,$this->product_cost_price,$this->product_seqno,1,
                            $this->product_system_code,$this->product_qty_blades,$this->product_insert_types,$this->product_diameter,
                            $this->product_width_depth,$this->product_shaft_diameter,$this->product_main_group,$this->product_sub_group,
                            $this->product_n_wt,$this->product_g_wt,$this->product_usage,$this->product_enginemodel,
                            $this->product_stock,$this->product_cr_jabsco,$this->product_cr_sherwood,$this->product_cr_johnson,
                            $this->product_cr_volvo,$this->product_cr_cef,$this->product_cr_onan,$this->product_cr_kashiyama,
                            $this->product_cr_yanmar,$this->product_cr_doosan,$this->product_cr_others,$this->product_cr_detroits,
                            $this->product_cr_cummins,$this->product_cr_cats,$this->product_location,$this->product_name,
                            $this->product_lowstock);
        $remark = "Insert Product.";
        if(!$this->save->SaveData($table_field,$table_value,'db_product','product_id',$remark)){
           return false;
        }else{
           $this->product_id = $this->save->lastInsert_id;
           $this->pictureManagement();
           return true;
        }
    }
    public function update(){
        $table_field = array('product_category','product_part_no','product_desc','product_remark',
                            'product_sale_price','product_cost_price','product_seqno','product_status',
                            'product_system_code','product_qty_blades','product_insert_types','product_diameter',
                            'product_width_depth','product_shaft_diameter','product_main_group','product_sub_group',
                            'product_n_wt','product_g_wt','product_usage','product_enginemodel',
                            'product_stock','product_cr_jabsco','product_cr_sherwood','product_cr_johnson',
                            'product_cr_volvo','product_cr_cef','product_cr_onan','product_cr_kashiyama',
                            'product_cr_yanmar','product_cr_doosan','product_cr_others','product_cr_detroits',
                            'product_cr_cummins','product_cr_cats','product_location','product_name',
                            'product_lowstock');
        $table_value = array($this->product_category,$this->product_part_no,$this->product_desc,$this->product_remark,
                            $this->product_sale_price,$this->product_cost_price,$this->product_seqno,$this->product_status,
                            $this->product_system_code,$this->product_qty_blades,$this->product_insert_types,$this->product_diameter,
                            $this->product_width_depth,$this->product_shaft_diameter,$this->product_main_group,$this->product_sub_group,
                            $this->product_n_wt,$this->product_g_wt,$this->product_usage,$this->product_enginemodel,
                            $this->product_stock,$this->product_cr_jabsco,$this->product_cr_sherwood,$this->product_cr_johnson,
                            $this->product_cr_volvo,$this->product_cr_cef,$this->product_cr_onan,$this->product_cr_kashiyama,
                            $this->product_cr_yanmar,$this->product_cr_doosan,$this->product_cr_others,$this->product_cr_detroits,
                            $this->product_cr_cummins,$this->product_cr_cats,$this->product_location,$this->product_name,
                            $this->product_lowstock);
        $remark = "Update Product.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_product','product_id',$remark,$this->product_id)){
           return false;
        }else{
           $this->pictureManagement(); 
           return true;
        }
    }
    public function pictureManagement(){
        if(!file_exists("dist/images/product")){
           mkdir('dist/images/product/');
        }
        $isimage = false;
        if($this->image_input['type'] == 'image/png' || $this->image_input['type'] == 'image/jpeg' || $this->image_input['type'] == 'image/gif'){
           $isimage = true;
        }

        if($this->image_input['size'] > 0 && $isimage == true){
            if($this->action == 'update'){
                unlink("dist/images/product/{$this->product_id}.png");
            }

                move_uploaded_file($this->image_input['tmp_name'],"dist/images/product/{$this->product_id}.png");
        }
    }
    public function fetchProductDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT p.*,empl.empl_code as insertBy,empl2.empl_code as updateBy
                FROM db_product p
                LEFT JOIN db_empl empl ON empl.empl_id = p.insertBy
                LEFT JOIN db_empl empl2 ON empl2.empl_id = p.updateBy
                WHERE p.product_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            /**$this->product_id = $row['product_id'];
            $this->product_code = $row['product_code'];
            $this->product_barcode = $row['product_barcode'];
            $this->product_desc = $row['product_desc'];
            $this->product_sale_price = $row['product_sale_price'];
            $this->product_cost_price = $row['product_cost_price'];
            $this->product_category = $row['product_category'];
            $this->product_category2 = $row['product_category2'];
            $this->product_category3 = $row['product_category3'];
            $this->product_brand = $row['product_brand'];
            $this->product_producttype = $row['product_producttype'];
            $this->product_outlet = $row['product_outlet'];
            $this->product_remark = $row['product_remark'];
            $this->product_seqno = $row['product_seqno'];
            $this->product_status = $row['product_status'];
            $this->product_code_cn = $row['product_code_cn'];
            $this->product_code_thai = $row['product_code_thai'];
            $this->product_desc_cn = $row['product_desc_cn'];
            $this->product_desc_thai = $row['product_desc_thai'];
            $this->update_by = $row['update_by'];
            $this->insertDateTime = $row['insertDateTime'];
            $this->insert_by = $row['insert_by'];
            $this->updateDateTime = $row['updateDateTime'];
            $this->product_isimport = $row['product_isimport'];
            $this->product_weight = $row['product_weight'];
            $this->product_custom_no = $row['product_custom_no'];
            $this->product_uom = $row['product_uom'];
            $this->product_material_wastage = $row['product_material_wastage'];
            $this->product_labour_profit = $row['product_labour_profit'];
            $this->partner_issitecoordinator = $row['partner_issitecoordinator'];**/
            
            // Updated for KC Part 04-09-2017
            $this->product_id           = $row['product_id'];
            $this->product_category     = $row['product_category'];
            //$this->product_part_no      = str_replace('\\','',escape(htmlspecialchars_decode($row['product_part_no'])));
            //$this->product_desc         = str_replace('\\','',escape(htmlspecialchars_decode($row['product_desc'])));
            $this->product_part_no      = html_entity_decode($row['product_part_no']);
            $this->product_desc         = html_entity_decode($row['product_desc']);
            $this->product_sale_price   = $row['product_sale_price'];
            $this->product_cost_price   = $row['product_cost_price'];
            $this->product_seqno        = $row['product_seqno'];
            $this->product_status       = $row['product_status'];
            $this->product_remark       = html_entity_decode($row['product_remark']);
            $this->updateBy            = $row['updateBy'];            
            $this->insertBy            = $row['insertBy'];
            $this->updateDateTime       = $row['updateDateTime'];
            $this->insertDateTime       = $row['insertDateTime'];
            $this->product_system_code  = $row['product_system_code'];
            $this->product_qty_blades    = $row['product_qty_blades'];
            $this->product_insert_types = $row['product_insert_types'];
            $this->product_diameter     = $row['product_diameter'];
            $this->product_width_depth  = $row['product_width_depth'];
            $this->product_shaft_diameter     = $row['product_shaft_diameter'];
            $this->product_main_group   = $row['product_main_group'];
            $this->product_sub_group    = $row['product_sub_group'];
            $this->product_n_wt         = $row['product_n_wt'];
            $this->product_g_wt         = $row['product_g_wt'];
            $this->product_usage        = html_entity_decode($row['product_usage']);
            $this->product_enginemodel  = html_entity_decode($row['product_enginemodel']);
            $this->product_stock        = $row['product_stock'];
            $this->product_cr_jabsco       = $row['product_cr_jabsco'];
            $this->product_cr_sherwood       = $row['product_cr_sherwood'];
            $this->product_cr_johnson       = $row['product_cr_johnson'];
            $this->product_cr_volvo       = $row['product_cr_volvo'];
            $this->product_cr_cef       = $row['product_cr_cef'];
            $this->product_cr_onan       = $row['product_cr_onan'];
            $this->product_cr_kashiyama       = $row['product_cr_kashiyama'];
            $this->product_cr_yanmar       = $row['product_cr_yanmar'];
            $this->product_cr_doosan       = $row['product_cr_doosan'];
            $this->product_cr_others       = $row['product_cr_others'];
            $this->product_cr_detroits       = $row['product_cr_detroits'];
            $this->product_cr_cummins       = $row['product_cr_cummins'];
            $this->product_cr_cats       = $row['product_cr_cats'];
            $this->product_location       = $row['product_location'];
            $this->product_name         = $row['product_name'];
            $this->product_lowstock     = $row['product_lowstock'];
            
            if($row['updateBy'] == 10000){
                $this->updateBy = "Webmaster";
            }
            if($row['insertBy'] == 10000){
                $this->insertBy = "Webmaster";
            }
        }
        return $query;
    }
    public function delete(){
        if($this->save->DeleteData("db_product"," WHERE product_id = '$this->product_id'","Delete Product.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->product_seqno = 10;
            $this->product_status = 1;
            $this->product_sale_price = "0.00";
            $this->product_cost_price = "0.00";
        }
        $this->categoryCtrl = $this->select->getItemCategorySelectCtrl($this->product_category,'Y');
        $this->maingroupCtrl = $this->select->getItemGroupSelectCtrl($this->product_main_group,'Y');
        $this->sub_groupCtrl = $this->select->getItemSubGroupSelectCtrl($this->product_sub_group,'Y',' AND subgroup_main_id = '.$this->product_main_group);
        /**$this->categoryCrtl2 = $this->select->getItemSubCategorySelectCtrl($this->product_category2,'Y');
        $this->categoryCrtl3 = $this->select->getItemSubSubCategorySelectCtrl($this->product_category3,'Y');**/
        
        
        //$this->producttypeCrtl = $this->select->getProducttypeSelectCtrl($this->product_producttype,'N');
        //$this->brandCrtl = $this->select->getBrandSelectCtrl($this->product_brand,'N');
        //$this->outletCrtl = $this->select->getOutletSelectCtrl($this->product_outlet,'N');
        //$this->uomCrtl = $this->select->getUomSelectCtrl($this->product_uom,'N');
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Item Management</title>
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
            <h1>Item Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->currency_id > 0){ echo "Update Product";}else{ echo "Create New Item";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = '' onclick = "window.location.href='product.php'">Back</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'margin-right:10px;' onclick = "window.location.href='product.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'product_form' class="form-horizontal" action = 'product.php?action=create' method = "POST" enctype="multipart/form-data">
                     <input type ='hidden' name = 'current_tab' id = 'current_tab' value = "<?php echo $this->current_tab?>"/>
                  <div class="box-body">
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li tab = "General" class="tab_header <?php if(($this->current_tab == "") || ($this->current_tab == "General")){ echo 'active';}?>"><a href="#general" data-toggle="tab">General</a></li>

                      </div>
                        <div class="tab-content">
                          <div class=" tab-pane <?php if(($this->current_tab == "") || ($this->current_tab == "General")){ echo 'active';}?>" id="general">
                              <?php echo $this->getGeneralForm();?>
                          </div>

                       </div>
                      
                      
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->product_status;?>" name = "product_status"/>
                    <input type = "hidden" value = "<?php echo $this->product_id;?>" name = "product_id" id = "product_id"/>
                    <?php
                    if($this->product_id > 0){
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
     

    

    <script>
    $(document).ready(function() {
        $("#product_form").validate({
                  rules: 
                  {
                      product_category:
                      {
                          required: true
                      }
                  }
    });
    $('.tab_header').click(function(){
        $('#current_tab').val($(this).attr('tab'));
    });
    
    
    $('#product_category').change(function(){
        var cat = $(this).val();
        if (cat == '7'){
            $('.cat-01').show();
            $('.cr-01').show();
            $('.cat-02').hide();
            $('.cr-02').hide();
        }else if (cat == '8'){
            $('.cat-02').show();
            $('.cr-02').show();
            $('.cat-01').hide();
            $('.cr-01').hide();
        }else{
            $('.cat-01').hide();
            $('.cr-01').hide();
            $('.cat-02').hide();
            $('.cr-02').hide();
        }
    });
    $('#product_main_group').change(function(){
        var maingroup = $('option:selected','#product_main_group').attr('value');
        var data = "action=getSubGroupJson&maingroup_id="+maingroup;
         $.ajax({
            type: "POST",
            url: "<?php echo $this->document_url;?>",      
            data:data,
            success: function(data) {
                var jsonObj = eval ("(" + data + ")");
                $('#product_sub_group').html(jsonObj.$subgroup_option);
                $('#product_sub_group').select2("val", "");
            }
         });
    });
});
    function deleteline(line_id,line_type){
        var data = "action=deleteline&product_id=<?php echo $this->product_id;?>&line_id="+line_id+"&line_type="+line_type;
        $.ajax({ 
            type: 'POST',
            url: 'product.php',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("System Error.");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                    window.location.href = 'product.php?action=edit&current_tab=' + $('#current_tab').val() + '&product_id=<?php echo $this->product_id;?>';
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
    <title>Item Management</title>
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
            <h1>Item Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Item Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='product.php?action=createForm'">Create New + </button>
                
                <!--<button style = 'margin-right:10px;' class="btn btn-primary pull-right import_btn" data-toggle="modal" data-target="#myModal">Import + </button>-->
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="product_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>U/P ($)</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT product.*,cy.category_code
                              FROM db_product product 
                              INNER JOIN db_category cy ON cy.category_id = product.product_category
                              WHERE product.product_id > 0 limit 0,100";
//                      $query = mysql_query($sql);
                      $i = 1;
                      while($row1 = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['category_code'];?></td>
                            <td><?php echo $row['product_part_no'];?></td>
                            <td><?php echo $row['product_name'];?></td>
                            <td><?php echo $row['product_desc'];?></td>
                            <td><?php echo $row['product_sale_price'];?></td>
                            <td><?php if($row['product_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'product.php?action=edit&product_id=<?php echo $row['product_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('product.php?action=delete&product_id=<?php echo $row['product_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th>Category</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>U/P ($)</th>
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
        $('#product_table').DataTable({
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "product.php?action=getDataTable",  
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
                      null,
                      null,
                      {"sClass": "text-align-right" }
                  ]
        });

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
              <h4 class="modal-title">Import Product</h4>
            </div>
                <div id="bar_blank">
   <div id="bar_color"></div>
  </div>
              <div id="status"></div>
            <form id = 'uploadForm' action = 'product.php' method = "POST" >  
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
	$aColumns = array('No','category_code','product_part_no','product_name','product_desc','product_sale_price','product_status','');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "product_id";
	
	/* DB table to use */
        $sTable = "db_product";
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
            $sOrder = "ORDER BY product.product_seqno,product.product_code";
        }
        
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS product.*,mc.category_code as category_code 
		FROM db_product product
                LEFT JOIN db_category mc ON mc.category_id = product.product_category
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
		for ($i=0;$i<9;$i++){
			if($aColumns[$i] == "No" ){
				$row[] = $b;
			}else if($aColumns[$i] != ""){
                            if($aColumns[$i] == 'product_status'){
                                if($aRow[$aColumns[$i]] == 1){
                                    $row[] = "Active";
                                }else{
                                    $row[] = "In-Active";
                                }
                            }else if($aColumns[$i] == 'product_sales_price'){
                                $sql1 = "
                                    SELECT SUM(a.total + (a.total * ({$aRow['product_labour_profit']}/100))) as final_total FROM (
                                        SELECT SUM( ((bom.probom_qty * bom.probom_layer) * ma.material_sale_price) + (((bom.probom_qty * bom.probom_layer) * ma.material_sale_price) * ({$aRow['product_material_wastage']}/100))  ) as total
                                            FROM db_probom bom
                                            INNER JOIN db_material ma ON ma.material_id = bom.probom_material_id
                                            WHERE bom.probom_product_id = '{$aRow['product_id']}' 

                                            UNION 

                                            SELECT SUM(pl.prolabour_qty*labour.labour_sale_price) as total
                                            FROM db_prolabour pl
                                            INNER JOIN db_labour labour ON labour.labour_id = pl.prolabour_labour_id
                                            WHERE pl.prolabour_product_id = '{$aRow['product_id']}'
                                            ) a
                                            
                                        ";
                                $query1 = mysql_query($sql1);
                                if($row1 = mysql_fetch_array($query1)){
                                    $row[] = num_format($row1['final_total']);
                                }else{
                                    $row[] = 0;
                                }
                            }else{
                                $row[] = html_entity_decode($aRow[$aColumns[$i]]);
                            }
			}else{
                           $btn = "";
                           if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                             $btn = "<button type='button' class='btn btn-primary btn-info ' onclick = 'location.href = \"product.php?action=edit&product_id={$aRow['product_id']}\"'>Edit</button>";       
                           }
                           if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                             $btn .= " <button type='button' class='btn btn-primary btn-danger' onclick = 'confirmAlertHref(\"product.php?action=delete&product_id={$aRow['product_id']}\",\"Confirm Delete?\")'>Delete</button>";  
                           }
                                $row[] = $btn;
                        }
		}
		$output['aaData'][] = $row;
                $b++;
	}

	echo json_encode($output);
    }
    public function getProductDetailTransaction(){
        
        $product_query = $this->fetchProductDetail(" AND p.product_id = '$this->product_id'","","",0);
        
        if($row = mysql_fetch_array($product_query)){
            return $row;
        }else{
            return null;
        }
    }
    public function getGeneralForm(){
        if($this->product_id > 0){
            if($this->product_category == 7){
                $c2 = "display:none";
            }else if($this->product_category == 8){
                $c1 = "display:none";
            }else{
                $c1 = "display:none";
                $c2 = "display:none";
            }
        }else{
            $c1 = "display:none";
            $c2 = "display:none";
        }
    ?>
        <div class="col-sm-9">
            <div class="form-group">
              <label for="product_category" class="col-sm-2 control-label">Category</label>
              <div class="col-sm-3">
                   <select class="form-control select2" id="product_category" name="product_category">
                       <?php echo $this->categoryCtrl;?>
                   </select>
              </div>
            </div>
            <div class="form-group">
              <label for="product_part_no" class="col-sm-2 control-label">Product Code</label>
              <div class="col-sm-3">
                   <input type="text" class="form-control" id="product_part_no" name="product_part_no" value = "<?php echo $this->product_part_no;?>" placeholder="Product Code">
              </div>
              <label for="product_name" class="col-sm-2 control-label">Product Name<?php echo $mandatory;?></label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="product_name" name="product_name" value = "<?php echo $this->product_name;?>" placeholder="Product Name">
              </div>
            </div>
            <div class="form-group">
              <label for="product_desc" class="col-sm-2 control-label">Description<?php echo $mandatory;?></label>
              <div class="col-sm-3">
                <textarea class="form-control" rows="2" id="product_desc" name="product_desc" placeholder="Description"><?php echo $this->product_desc;?></textarea>
              </div>
              <label for="product_location" class="col-sm-2 control-label">Location <?php echo $mandatory;?></label>
                <div class="col-sm-3">
                    <textarea class="form-control" rows="3" id="product_location" name="product_location" placeholder="Location"><?php echo $this->product_location;?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="product_cost_price" class="col-sm-2 control-label">Cost Price <?php echo $mandatory;?></label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="product_cost_price"  name="product_cost_price" placeholder="Cost Price" value = "<?php echo $this->product_cost_price;?>" >
                </div>
                <label for="product_sale_price" class="col-sm-2 control-label">Sale Price <?php echo $mandatory;?></label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="product_sale_price"  name="product_sale_price" placeholder="Sale Price" value = "<?php echo $this->product_sale_price;?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="product_stock" class="col-sm-2 control-label">Stock <?php echo $mandatory;?></label>
                <div class="col-sm-3">
                    <input type="number" step="1" class="form-control" id="product_stock"  name="product_stock" placeholder="Stock" value = "<?php echo $this->product_stock;?>" readonly>
                </div>
                <label for="product_lowstock" class="col-sm-2 control-label">Low Stock <?php echo $mandatory;?></label>
                <div class="col-sm-3">
                    <input type="number" step="1" class="form-control" id="product_lowstock"  name="product_lowstock" placeholder="Low Stock" value = "<?php echo $this->product_lowstock;?>" >
                </div>
            </div>
        </div>
    <div class="col-sm-3">
          <?php if(file_exists("dist/images/product/$this->product_id.png")){?>
            <img src ="dist/images/product/<?php echo $this->product_id;?>.png" style = 'width:215px;height:215px;'/>
          <?php }else{?>
            <img src ='dist/img/no_image.png'  />

          <?php }?>
             <p></p>
            <input type = "file" name = 'image_input' />
      </div>
        <div class="col-sm-9 cat-01" style="<?php echo $c1; ?>">
            <div class="form-group">
              <label for="product_qty_blades" class="col-sm-2 control-label">No. Blades</label>
                <div class="col-sm-3">
                    <input type="number" step="1" class="form-control" id="product_qty_blades"  name="product_qty_blades" placeholder="NO. Blades" value = "<?php echo $this->product_qty_blades;?>" >
                </div>
              <label for="product_insert_types" class="col-sm-2 control-label">Insert Types</label>
            <div class="col-sm-3">
                <input type="number" step="1" class="form-control" id="product_insert_types"  name="product_insert_types" placeholder="Insert Types" value = "<?php echo $this->product_insert_types;?>" >
              </div>
            </div>
            <div class="form-group">
              <label for="product_diameter" class="col-sm-2 control-label">Diameter (mm)<?php echo $mandatory;?></label>
              <div class="col-sm-3">
                   <input type="text" class="form-control" id="product_diameter" name="product_diameter" value = "<?php echo $this->product_diameter;?>" placeholder="Diameter">
              </div>
              <label for="product_width_depth" class="col-sm-2 control-label">Width/Depth (mm)<?php echo $mandatory;?></label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="product_width_depth" name="product_width_depth" value = "<?php echo $this->product_width_depth;?>" placeholder="Width/Depth">
              </div>
            </div>
            <div class="form-group">
                <label for="product_shaft_diameter" class="col-sm-2 control-label">Shaft Diameter (mm) <?php echo $mandatory;?></label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="product_shaft_diameter"  name="product_shaft_diameter" placeholder="Shaft Diameter" value = "<?php echo $this->product_shaft_diameter;?>" >
                </div>
            </div>
        </div>
        <div class="col-sm-9 cat-02" style="<?php echo $c2; ?>">
            <div class="form-group">
              <label for="product_main_group" class="col-sm-2 control-label">Main Product Group</label>
              <div class="col-sm-3">
                   <select class="form-control select2" id="product_main_group" name="product_main_group">
                       <?php echo $this->maingroupCtrl;?>
                   </select>
              </div>
              <label for="product_sub_group" class="col-sm-2 control-label">Sub Product Group</label>
              <div class="col-sm-3">
                   <select class="form-control select2" id="product_sub_group" name="product_sub_group">
                       <?php echo $this->sub_groupCtrl;?>
                   </select>
              </div>
            </div>
            <div class="form-group">
              <label for="product_n_wt" class="col-sm-2 control-label">N-WT (kg)<?php echo $mandatory;?></label>
              <div class="col-sm-3">
                   <input type="text" class="form-control" id="product_n_wt" name="product_n_wt" value = "<?php echo $this->product_n_wt;?>" placeholder="N-WT">
              </div>
              <label for="product_g_wt" class="col-sm-2 control-label">G-WT (kg)<?php echo $mandatory;?></label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="product_g_wt" name="product_g_wt" value = "<?php echo $this->product_g_wt;?>" placeholder="G-WT">
              </div>
            </div>
            <div class="form-group">
                <label for="product_system_code" class="col-sm-2 control-label">System Code <?php echo $mandatory;?></label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="product_system_code"  name="product_system_code" placeholder="System Code" value = "<?php echo $this->product_system_code;?>" >
                </div>
            </div>
        </div>
        <!-- Cross References
        <div class="col-sm-9 cr-01" style="<?php echo $c1; ?>">
            <div class="form-group">
              <label for="product_cr_jabsco" class="col-sm-2 control-label">JABSCO</label>
                <div class="col-sm-3">
                     <input type="text" class="form-control" id="product_cr_jabsco"  name="product_cr_jabsco" placeholder="JABSCO" value = "<?php echo $this->product_cr_jabsco;?>" >
                 </div>
              <label for="product_cr_sherwood" class="col-sm-2 control-label">SHERWOOD</label>
                <div class="col-sm-3">
                     <input type="text" class="form-control" id="product_cr_sherwood"  name="product_cr_sherwood" placeholder="SHERWOOD" value = "<?php echo $this->product_cr_sherwood;?>" >
                 </div>
            </div>
            <div class="form-group">
              <label for="product_cr_johnson" class="col-sm-2 control-label">JOHNSON</label>
              <div class="col-sm-3">
                   <input type="text" class="form-control" id="product_cr_johnson" name="product_cr_johnson" value = "<?php echo $this->product_cr_johnson;?>" placeholder="JOHNSON">
              </div>
              <label for="product_cr_volvo" class="col-sm-2 control-label">VOLVO</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="product_cr_volvo" name="product_cr_volvo" value = "<?php echo $this->product_cr_volvo;?>" placeholder="VOLVO">
              </div>
            </div>
            <div class="form-group">
                <label for="product_cr_cef" class="col-sm-2 control-label">CEF</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="product_cr_cef"  name="product_cr_cef" placeholder="CEF" value = "<?php echo $this->product_cr_cef;?>" >
                </div>
                <label for="product_cr_onan" class="col-sm-2 control-label">ONAN</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="product_cr_onan"  name="product_cr_onan" placeholder="ONAN" value = "<?php echo $this->product_cr_onan;?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="product_cr_kashiyama" class="col-sm-2 control-label">KASHIYAMA</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="product_cr_kashiyama"  name="product_cr_kashiyama" placeholder="KASHIYAMA" value = "<?php echo $this->product_cr_kashiyama;?>" >
                </div>
                <label for="product_cr_yanmar" class="col-sm-2 control-label">YANMAR</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="product_cr_yanmar"  name="product_cr_yanmar" placeholder="YANMAR" value = "<?php echo $this->product_cr_yanmar;?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="product_cr_doosan" class="col-sm-2 control-label">DOOSAN</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="product_cr_doosan"  name="product_cr_doosan" placeholder="DOOSAN" value = "<?php echo $this->product_cr_doosan;?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="product_usage" class="col-sm-2 control-label">Used In</label>
                <div class="col-sm-3">
                  <textarea class="form-control" rows="3" id="product_usage" name="product_usage" placeholder="Used In"><?php echo $this->product_usage;?></textarea>
                </div>
            </div>
        </div>
        <div class="col-sm-9 cr-02" style="<?php echo $c2; ?>">
            <div class="form-group">
              <label for="product_cr_jabsco" class="col-sm-2 control-label">JABSCO</label>
              <div class="col-sm-3">
                        <input type="text" class="form-control" id="product_cr_jabsco"  name="product_cr_jabsco" placeholder="JABSCO" value = "<?php echo $this->product_cr_jabsco;?>" >
              </div>
              <label for="product_cr_sherwood" class="col-sm-2 control-label">SHERWOOD</label>
              <div class="col-sm-3">
                        <input type="text" class="form-control" id="product_cr_sherwood"  name="product_cr_sherwood" placeholder="SHERWOOD" value = "<?php echo $this->product_cr_sherwood;?>" >
              </div>
            </div>
            <div class="form-group">
              <label for="product_cr_johnson" class="col-sm-2 control-label">JOHNSON</label>
              <div class="col-sm-3">
                   <input type="text" class="form-control" id="product_cr_johnson" name="product_cr_johnson" value = "<?php echo $this->product_cr_johnson;?>" placeholder="JOHNSON">
              </div>
              <label for="product_cr_volvo" class="col-sm-2 control-label">VOLVO</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="product_cr_volvo" name="product_cr_volvo" value = "<?php echo $this->product_cr_volvo;?>" placeholder="VOLVO">
              </div>
            </div>
            <div class="form-group">
                <label for="product_cr_others" class="col-sm-2 control-label">Others</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="product_cr_others"  name="product_cr_others" placeholder="Others" value = "<?php echo $this->product_cr_others;?>" >
                </div>
                <label for="product_cr_detroits" class="col-sm-2 control-label">Detroits</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="product_cr_detroits"  name="product_cr_detroits" placeholder="Detroits" value = "<?php echo $this->product_cr_detroits;?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="product_cr_cummins" class="col-sm-2 control-label">Cummims</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="product_cr_cummins"  name="product_cr_cummins" placeholder="Cummims" value = "<?php echo $this->product_cr_cummins;?>" >
                </div>
                <label for="product_cr_cats" class="col-sm-2 control-label">CAT</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="product_cr_cats"  name="product_cr_cats" placeholder="CAT" value = "<?php echo $this->product_cr_cats;?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="product_enginemodel" class="col-sm-2 control-label">Engine Model & P/N</label>
                <div class="col-sm-3">
                  <textarea class="form-control" rows="3" id="product_enginemodel" name="product_enginemodel" placeholder="Engine Model & P/N"><?php echo $this->product_enginemodel;?></textarea>
                </div>
            </div>
        </div>
        -->
      
    <?php
    }
   
    public function createUpdateProductBom(){
        
        if($this->probom_id > 0){
            $table_field = array('probom_material_id','probom_qty','probom_layer');
            $table_value = array($this->probom_material_id,$this->probom_qty,$this->probom_layer);
            $remark = "Update Product's Bom.";
            if(!$this->save->UpdateData($table_field,$table_value,'db_probom','probom_id',$remark,$this->probom_id)){
               return false;
            }else{
               $this->calculateProductPrice();
               return true;
            }
        }else{
            $table_field = array('probom_product_id','probom_material_id','probom_qty','probom_layer');
            $table_value = array($this->product_id,$this->probom_material_id,$this->probom_qty,$this->probom_layer);
            $remark = "Insert Product's Bom.";
            if(!$this->save->SaveData($table_field,$table_value,'db_probom','probom_id',$remark)){
               return false;
            }else{
               $this->calculateProductPrice();
               return true;
            }
        }
    }
    public function createUpdateProductLabour(){

        if($this->prolabour_id > 0){
            $table_field = array('prolabour_labour_id','prolabour_qty');
            $table_value = array($this->prolabour_labour_id,$this->prolabour_qty);
            $remark = "Update Product's Bom.";
            if(!$this->save->UpdateData($table_field,$table_value,'db_prolabour','prolabour_id',$remark,$this->prolabour_id)){
               return false;
            }else{
               $this->calculateProductPrice(); 
               return true;
            }
        }else{
            $table_field = array('prolabour_product_id','prolabour_labour_id','prolabour_qty');
            $table_value = array($this->product_id,$this->prolabour_labour_id,$this->prolabour_qty);
            $remark = "Insert Product's Bom.";
            if(!$this->save->SaveData($table_field,$table_value,'db_prolabour','prolabour_id',$remark)){
               return false;
            }else{
               $this->calculateProductPrice();
               return true;
            }
        }
    }
    public function deleteMaterialLine(){

        if($this->save->DeleteData("db_probom"," WHERE probom_product_id = '$this->product_id' AND probom_id = '$this->line_id'","Delete {$this->product_id} Material Line.")){
            $this->calculateProductPrice();
            return true;
        }else{
            return false;
        }
    }
    public function deleteLabourLine(){

        if($this->save->DeleteData("db_prolabour"," WHERE prolabour_product_id = '$this->product_id' AND prolabour_id = '$this->line_id'","Delete {$this->product_id} Labour Line.")){
            $this->calculateProductPrice();
            return true;
        }else{
            return false;
        }
    }
    public function getItemMeterialDetail(){
//        CONCAT(COALESCE(mc.materialcategory_code,''),' - ',COALESCE(ms.mscategory_code,''),' - ',COALESCE(mss.msscategory_code,''),' => $',m.material_sale_price) as material_code 
        $sql = "SELECT CONCAT(COALESCE(mc.materialcategory_code,''),' - ',COALESCE(ms.mscategory_code,''),' - ',COALESCE(mss.msscategory_code,''),' - ',COALESCE(m.material_code,''),' => $',m.material_sale_price) as material_code 
                FROM db_probom pm
                INNER JOIN db_material m ON m.material_id = pm.probom_material_id

                LEFT JOIN db_msscategory mss ON mss.msscategory_id = m.material_category
                LEFT JOIN db_mscategory ms ON ms.mscategory_id = mss.mssparent_id
                LEFT JOIN db_materialcategory mc ON ms.msparent_id = mc.materialcategory_id
                WHERE pm.probom_product_id = '$this->product_id'";
        $query = mysql_query($sql);
        $html = "[Material]\n";
        while($row = mysql_fetch_array($query)){
            $html .= " - " . $row['material_code'] . "\n";
        }
        $html .= "[Labour]\n";
        
        $sql = "SELECT CONCAT(l.labour_code,' => $',l.labour_sale_price) as labour_code 
                FROM db_prolabour pr
                INNER JOIN db_labour l ON l.labour_id = pr.prolabour_labour_id
                WHERE pr.prolabour_product_id = '$this->product_id'";
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $html .= " - " . $row['labour_code'] . "\n";
        }
        return $html;
    }
    public function calculateProductPrice(){
        $this->fetchProductDetail(" AND p.product_id = '$this->product_id'", $orderstring, $wherelimit, 1);
        $sql1 = "
            SELECT SUM(a.total + (a.total * ($this->product_labour_profit/100))) as final_total FROM (
                SELECT SUM( ((bom.probom_qty * bom.probom_layer) * ma.material_sale_price) + (((bom.probom_qty * bom.probom_layer) * ma.material_sale_price) * ($this->product_material_wastage/100))  ) as total
                    FROM db_probom bom
                    INNER JOIN db_material ma ON ma.material_id = bom.probom_material_id
                    WHERE bom.probom_product_id = '$this->product_id' 

                    UNION 

                    SELECT SUM(pl.prolabour_qty*labour.labour_sale_price) as total
                    FROM db_prolabour pl
                    INNER JOIN db_labour labour ON labour.labour_id = pl.prolabour_labour_id
                    WHERE pl.prolabour_product_id = '$this->product_id'
                    ) a

                ";
        $query1 = mysql_query($sql1);
        if($row1 = mysql_fetch_array($query1)){
            $final_total = num_format($row1['final_total']);
        }else{
            $final_total = 0;
        } 
        
        $sql = "UPDATE db_product SET product_sales_price = '$final_total' WHERE product_id = '$this->product_id'";
        mysql_query($sql);
    }
}
?>
