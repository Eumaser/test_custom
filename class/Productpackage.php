<?php
/*
 * To change this tmaterialate, choose Tools | Tmaterialates
 * and open the tmaterialate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Productpackage {

    public function Productpackage(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
        $table_field = array('product_code','product_name','product_desc','product_sale_price','product_category','product_cost_price',
                             'product_remark','product_status','product_stock_availability');
        $table_value = array($this->product_code,$this->product_name,$this->product_desc,$this->product_sale_price,$this->product_category,$this->product_cost_price,
                             $this->product_remark,$this->product_status,$this->product_stock_availability);
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
        $table_field = array('product_code','product_name','product_desc','product_sale_price',
                            'product_category','product_cost_price','product_remark','product_status',
                            'product_stock_availability');
        $table_value = array($this->product_code,$this->product_name,$this->product_desc,$this->product_sale_price,
                            $this->product_category,$this->product_cost_price,$this->product_remark,$this->product_status,
                            $this->product_stock_availability);
        
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
                unlink("dist/images/product/{$this->product_code}.png");
            }

                move_uploaded_file($this->image_input['tmp_name'],"dist/images/product/{$this->product_code}.png");
        }
    }
    public function createUpdateProductpackageLine(){

        for($i=1;$i<=sizeof($this->materialline_partner_id);$i++){
              if($this->materialline_partner_id[$i] <= 0){
                  continue;//skip if user not pick
              }
              $sale_price = str_replace(",", "",$this->materialline_saleprice[$i]);

            $table_field = array('product_id','materialline_partner_id','materialline_saleprice');
            $table_value = array($this->product_id,escape($this->materialline_partner_id[$i]),escape($sale_price));

            if($this->materialline_id[$i] > 0){
                $remark = "Update Productpackage Lines.";
                if(!$this->save->UpdateData($table_field,$table_value,'db_materialline','materialline_id',$remark,$this->materialline_id[$i]," AND product_id = '$this->product_id'")){
                   $true = false;
                } 
            }else{
                $remark = "Insert Productpackage Lines.";
                if(!$this->save->SaveData($table_field,$table_value,'db_materialline','materialline_id',$remark)){
                    $true = false;
                }
            }
     
        }  
        
    }
    public function fetchProductpackageDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_product WHERE product_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);
            $this->product_id = $row['product_id'];
            $this->product_code = $row['product_code'];
            $this->product_desc = $row['product_desc'];
            
            $this->product_sale_price = $row['product_sale_price'];
            $this->product_category = $row['product_category'];
            $this->product_cost_price = $row['product_cost_price'];
            $this->product_remark = $row['product_remark'];
            
            $this->product_seqno = $row['product_seqno'];
            $this->product_status = $row['product_status'];
            $this->product_stock_availability = $row['product_stock_availability'];
            $this->product_name = $row['product_name'];
        }else if($type == 2){
            return mysql_fetch_array($query);
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
        //$this->materialCrtl = $this->select->getProductpackageSubSubCategorySelectCtrl($this->product_category,'Y');
        //$this->supplierctrl1 = $this->select->getCustomerSelectCtrl(0,'Y'," AND partner_issupplier = '1'");
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product Management</title>
    <?php
    include_once 'css.php';
    
    ?>    
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
            <h1>Product Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->product_id > 0){ echo "Update Product";}else{ echo "Create New Product";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='productpackage.php'">Back</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <!--<button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='productpackage.php?action=createForm'">Create New</button>-->
                <?php }?>
              </div>
                
                <form id = 'product_form' class="form-horizontal" action = 'productpackage.php?action=create' method = "POST" enctype="multipart/form-data">
                  <div class="box-body">
                      <div class="col-sm-9">
                        <div class="form-group">
                            <label for="product_code" class="col-sm-2 control-label">Name <?php echo $mandatory;?></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="product_code"  name="product_code" placeholder="Product Code" value = "<?php echo $this->product_code;?>" >
                            </div>
                            <label for="product_name" class="col-sm-2 control-label">Product Name <?php echo $mandatory;?></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="product_name"  name="product_name" placeholder="Product Name" value = "<?php echo $this->product_name;?>" >
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
                            <label for="product_stock_availability" class="col-sm-2 control-label">Stock Availability <?php echo $mandatory;?></label>
                            <div class="col-sm-3">
                                <input type="number" step="1" class="form-control" id="product_stock_availability"  name="product_stock_availability" placeholder="Stock" value = "<?php echo $this->product_stock_availability;?>" >
                            </div>
                            <!--<label for="product_category" class="col-sm-2 control-label">Product Category </label>
                            <div class="col-sm-4">
                                <select class="form-control select2 " id="product_category" name="product_category" style = 'width:100%'>
                                   <?php echo $this->materialCrtl;?>
                                </select>
                            </div>
                            -->
                        </div>
                          <div class="form-group">
                            <label for="product_desc" class="col-sm-2 control-label">Product Description </label>
                            <div class="col-sm-3">
                                <textarea class="form-control" rows="7" id="product_desc" name="product_desc" placeholder="Description"><?php echo $this->product_desc;?></textarea>
                            </div>
                            <label for="product_remark" class="col-sm-2 control-label">Remarks</label>
                            <div class="col-sm-3">
                                <textarea class="form-control" rows="7" id="product_remark" name="product_remark" placeholder="Remarks"><?php echo $this->product_remark;?></textarea>
                            </div>
                        </div>
                     <!-- <div style = 'clear:both'></div>
                      <div class="col-sm-6">
                          <div class = 'pull-left' ><h3>Supplier List</h3></div>
                          <div class = 'pull-right'>
                              <?php if($this->product_status == 1){?>
                              <button type = 'button' class = 'btn btn-info addnewline' style = 'margin-top:15px;' >Add New Row</button>
                              <?php }?>
                          </div>
                      </div>
                      <div style = 'clear:both'></div>  
                      <div class="col-sm-6">
                        <?php echo $this->getAddSupplierDetailForm();?>
                      </div>
                      <div style = 'clear:both'></div> --> 
                      </div>
                      <div class="col-sm-3">
                        <?php if(file_exists("dist/images/product/$this->product_code.png")){?>
                            <img src ="dist/images/product/<?php echo $this->product_code;?>.png" style = 'width:215px;height:215px;'/>
                        <?php }else{?>
                            <img src ='dist/img/no_image.png'  />

                        <?php }?>
                             <p></p>
                        <input type = "file" name = 'image_input' />
                      </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->product_status;?>" name = "product_status"/>
                    <input type = "hidden" value = "<?php echo $this->product_id;?>" name = "product_id"/>
                    <?php 
                    if($this->product_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){?>
                    <button type = "submit" class="btn btn-info">Submit</button>
                    <?php }?>
                  </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <textarea style = 'display:none' id = 'testhtml' ><?php echo $this->supplierctrl1;?></textarea>
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    
    ?>
    <script>
    var line_copy = '<tr id = "line_@i" class="tbl_grid_odd" line = "@i">' +
                    '<td style = "width:5%;padding-left:5px">@i</td>' + 
                    '<td style = "width:20%;"><select style = "width:100%" name = "materialline_partner_id[@i]" id = "materialline_partner_id_@i" class="form-control select2 "></select></td>'+
                    '<td style = "width:10%;"><input type = "text" name = "materialline_saleprice[@i]" id = "materialline_saleprice_@i" line = "@i" class="form-control calculate text-align-right" value = "0.00"/></td>'+
                    '<td align = "center" class = "" style ="vertical-align:top;min-width:10%;padding-right:10px;padding-left:5px">' +
//                    '<a style = "margin-left:10px;margin-right:10px;" href = "#" id = "save_line_@i" claimsline_id = "" class = "save_line font-icon" line = "@i" ><i class="fa fa-plus" aria-hidden="true"></i></a>' + 
//                    '<a style = "margin-left:10px;margin-right:10px;" href = "#" id = "delete_line_@i" claimsline_id = "" class = "delete_line font-icon" line = "@i" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>' + 
                    '</td>'+
                    '</tr>';
    $(document).ready(function() {
        <?php if($this->product_status == 1){?>
        addline();
        <?php }?>
        $('.addnewline').click(function(){
            addline();
        });
        $('.delete_line').on('click',function(){
            deleteline($(this).attr('materialline_id'));
        });
       
        $("#product_form").validate({
                  rules: 
                  {
                      product_code:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      product_code:
                      {
                          required: "Please enter Productpackageet Code."
                      }
                  }
              });
    
    
    });
    var issend = false;
    function saveline(line,claimsline_id){
        if(issend){
            alert("Please wait...");
            return false;
        }

        issend = true;
        if(claimsline_id != ""){
            var action = 'updateline';
        }else{
            var action = 'saveline';
        }

        var data = "claimsline_date="+$('#claimsline_date_'+line).val();
            data += "&claimsline_type="+$('#claimsline_type_'+line).val();
            data += "&claimsline_desc="+encodeURIComponent($('#claimsline_desc_'+line).val());
            data += "&claimsline_receiptno="+$('#claimsline_receiptno_'+line).val();
            data += "&claimsline_amount="+$('#claimsline_amount_'+line).val();
            data += "&action="+action;
            data += "&claimsline_id="+claimsline_id;
            data += "&claims_id=<?php echo $this->claims_id;?>";

        $.ajax({ 
            type: 'POST',
            url: 'claims.php',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("System Error.");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   window.location.reload();
               }else{
                   alert("Add/Update Fail.");
               }
               issend = false;
            }		
         });
         return false;
    }
    function deleteline(materialline_id){
        var data = "action=deleteline&product_id=<?php echo $this->product_id;?>&materialline_id="+materialline_id;
        $.ajax({ 
            type: 'POST',
            url: 'productpackage.php',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("System Error.");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   window.location.reload();
               }else{
                   alert("Fail to delete line.");
               }
               issend = false;
            }		
         });
         return false;
    }
    function addline(){
        var addlinevalue = $('#total_line').val();
        var nextvalue = parseInt(addlinevalue)+1;
        var newline = line_copy.replace(/@i/g,nextvalue);
        $('#detail_last_tr').before(newline);
        $('#materialline_partner_id_'+nextvalue).html($('#testhtml').val());
        $('#total_line').val(nextvalue);
        $('#claimsline_seqno_'+nextvalue).val(nextvalue*10);
        $(".select2").select2();
        $('.calculate').on('keyup',function(){
            calculate();
        });
        $('.datepicker').datepicker({
            format: 'dd-M-yyyy',
            autoclose: true,
            pickerPosition: "bottom-left"
        });
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
    <title>Product Package Management</title>
    <?php
    include_once 'css.php';
    
    ?>
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
            <h1>Product Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Product Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='productpackage.php?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="product_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:25%'>Product</th>
                        <th style = 'width:10%'>Cost Price</th>
                        <th style = 'width:10%'>Sale Price</th>
                        <th style = 'width:10%'>Stock Availability</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT material.*,CONCAT(COALESCE(mc.materialcategory_code,''),' - ',COALESCE(ms.mscategory_code,''),' - ',COALESCE(mss.msscategory_code,'')) as  code 
                              FROM db_product material 
                              LEFT JOIN db_msscategory mss ON material.product_category = mss.msscategory_id
                              LEFT JOIN db_mscategory ms ON ms.mscategory_id = mss.mssparent_id
                              LEFT JOIN db_materialcategory mc ON ms.msparent_id = mc.materialcategory_id
                              
                              
                              WHERE material.product_id > 0 ORDER BY mc.materialcategory_code,ms.mscategory_code,mss.msscategory_code,material.product_code";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['product_code'] . ' - ' . $row['product_name'];?></td>
                            <td>$ <?php echo num_format($row['product_cost_price']);?></td>
                            <td>$ <?php echo num_format($row['product_sale_price']);?></td>
                            <td><?php echo $row['product_stock_availability'];?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'productpackage.php?action=edit&product_id=<?php echo $row['product_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('productpackage.php?action=delete&product_id=<?php echo $row['product_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:25%'>Product</th>
                        <th style = 'width:10%'>Cost Price</th>
                        <th style = 'width:10%'>Sale Price</th>
                        <th style = 'width:10%'>Stock Availability</th>
                        <th style = 'width:10%'></th>
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
    <script>
      $(function () {
        $('#product_table').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

      });
    </script>
  </body>
</html>
    <?php
    }
    public function getAddSupplierDetailForm(){
    $line = 0;  
    if($this->product_status != 1){
        $disabled = " DISABLED";
    }
    ?>    
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:5%;padding-left:5px">No</th>
            <th class = "" style = 'width:20%;'>Supplier</th>
            <th class = "" style = 'padding-left:10px;width:10%;'>Price</th>
            <th class = "" style="width:10%"></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT cl.*
                    FROM db_materialline cl
                    WHERE materialline_id > 0 AND product_id > 0 AND product_id = '$this->product_id' ORDER BY insertDateTime";
            $query = mysql_query($sql);
            while($row = mysql_fetch_array($query)){
                $line++;
                $this->supplierctrl = $this->select->getCustomerSelectCtrl($row['materialline_partner_id'],'Y'," AND partner_issupplier = '1'");
            ?>
                <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>">
                    <td style="width:5%;padding-left:5px"><?php echo $line;?></td>
                    <td style="width:80px;"><select style = 'width:100%' name = "materialline_partner_id[<?php echo $line;?>]" id = "materialline_partner_id_<?php echo $line;?>" class="form-control select2" <?php echo $disabled;?>><?php echo $this->supplierctrl;?></select></td>
                    <td style="width:60px;"><input type = "text" name = "materialline_saleprice[<?php echo $line;?>]" line = "<?php echo $line;?>" id = "materialline_saleprice_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo $row['materialline_saleprice'];?>" <?php echo $disabled;?>/></td>
                    <td align = "center" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">
                        <a style = "margin-left:10px;margin-right:10px;font-size:23px;color:red" href = "javascript:void(0)" id = "delete_line_<?php echo $line;?>" materialline_id = "<?php echo $row['materialline_id'];?>" class = "delete_line font-icon" line = "<?php echo $line;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        <input type = "hidden" name = "materialline_id[<?php echo $line;?>]" id = "materialline_id<?php echo $line;?>" class="form-control" value="<?php echo $row['materialline_id'];?>"/>
                    </td>
                </tr>
            
            <?php
            }
            ?>
            <tr id = 'detail_last_tr'></tr>
        </tbody>
    </table>
    <input type = 'hidden' id = 'total_line' name = 'total_line' value = '<?php echo $line;?>'/>
    <?php    
    }
    public function deleteProductpackageLine(){
        $this->materialline_id = escape($this->materialline_id);
        if($this->save->DeleteData("db_materialline"," WHERE product_id = '$this->product_id' AND materialline_id = '$this->materialline_id'","Delete {$this->product_id} Labour Line.")){
            return true;
        }else{
            return false;
        }
    }
    public function getProductCategoryName($pid,$wherestring){
        
       $sql = "SELECT mss.msscategory_id,mc.materialcategory_code,
            CONCAT(COALESCE(mc.materialcategory_code,''),' - ',COALESCE(ms.mscategory_code,''),' - ',COALESCE(mss.msscategory_code,'')) as  code 
            FROM db_productpackagecategory mc
            LEFT JOIN db_mscategory ms ON ms.msparent_id = mc.materialcategory_id
            LEFT JOIN db_msscategory mss ON ms.mscategory_id = mss.mssparent_id
            WHERE (mc.materialcategory_id = '$pid' or mc.materialcategory_id >0) and mc.materialcategory_status = 1 $wherestring
            ORDER BY mc.materialcategory_code  ASC";
       $query = mysql_query($sql);
       
       if($row = mysql_fetch_array($query)){
           return $row['code'];
       }else{
           return "";
       }
    }

}
?>
