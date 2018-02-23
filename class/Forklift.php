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
class Forklift {

    public function Forklift(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();


    }
    public function create(){
   //     $prodExist = getDataCountBySql("db_forklift"," WHERE fork_model = '".trim($this->fork_model)."' AND product_status = 1");
        $forkExist = getDataCountBySql("db_forklift"," WHERE fork_model = '".trim($this->fork_model)."' ");
        if($forkExist > 0){
            return false;
        }
        $table_field = array('fork_brand','fork_model','fork_capacity','fork_height',
                            'fork_mast','fork_length','fork_attachment','fork_acc',
                            'fork_serial','fork_battery','fork_bat_charger','fork_snr');
        $table_value = array($this->fork_brand,$this->fork_model,$this->fork_capacity,$this->fork_height,
                            $this->fork_mast,$this->fork_length,$this->fork_attachment,
                            $this->fork_acc,$this->fork_serial,$this->fork_battery,$this->fork_bat_charger,$this->fork_snr);
        $remark = "Insert ForkLift.";
        if(!$this->save->SaveData($table_field,$table_value,'db_forklift','fork_id',$remark)){
           return false;
        }else{
            $this->fork_id = $this->save->lastInsert_id;
        //   $this->pictureManagement();
           return true;
        }
    }
    public function update(){
        $table_field = array('fork_brand','fork_model','fork_capacity','fork_height',
                            'fork_mast','fork_length','fork_attachment','fork_acc',
                            'fork_serial','fork_battery','fork_bat_charger','fork_snr');
        $table_value = array($this->fork_brand,$this->fork_model,$this->fork_capacity,$this->fork_height,
                            $this->fork_mast,$this->fork_length,$this->fork_attachment,
                            $this->fork_acc,$this->fork_serial,$this->fork_battery,$this->fork_bat_charger,$this->fork_snr);
        $remark = "Update ForkLift.";
      //  echo '<pre>';
      //  print_r($this->product_id);
      //  die('in up');

        if(!$this->save->UpdateData($table_field,$table_value,'db_forklift','fork_id',$remark,$this->fork_id)){
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
      /*  $sql = "SELECT p.*,empl.empl_code as insertBy,empl2.empl_code as updateBy
                FROM db_product p
                LEFT JOIN db_empl empl ON empl.empl_id = p.insertBy
                LEFT JOIN db_empl empl2 ON empl2.empl_id = p.updateBy
                WHERE p.product_id > 0  $wherestring $orderstring $wherelimit";*/

        $sql = "SELECT f.*,empl.empl_code as insertBy,empl2.empl_code as updateBy
              FROM db_forklift f
              LEFT JOIN db_empl empl ON empl.empl_id = f.insertBy
              LEFT JOIN db_empl empl2 ON empl2.empl_id = f.updateBy
              WHERE f.fork_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
      //  $row = mysql_fetch_array($query);
      //  return $query;

        if($type > 0){
            $row = mysql_fetch_array($query);

            // Updated for KC Part 04-09-2017
            $this->fork_id  = $row['fork_id'];
            $this->fork_brand = $row['fork_brand'];
            //$this->product_part_no      = str_replace('\\','',escape(htmlspecialchars_decode($row['product_part_no'])));
            //$this->product_desc         = str_replace('\\','',escape(htmlspecialchars_decode($row['product_desc'])));
            $this->fork_model = html_entity_decode($row['fork_model']);
            $this->fork_capacity = html_entity_decode($row['fork_capacity']);
            $this->fork_height = $row['fork_height'];
            $this->fork_mast = $row['fork_mast'];
            $this->fork_length = $row['fork_length'];
            $this->fork_attachment = $row['fork_attachment'];
            $this->fork_acc = $row['fork_acc'];
            $this->fork_serial = $row['fork_serial'];
            $this->fork_battery=$row['fork_battery'];
            $this->fork_bat_charger=$row['fork_bat_charger'];
            $this->fork_snr=$row['fork_snr'];
            $this->updateBy  = $row['updateBy'];
            $this->insertBy   = $row['insertBy'];
            $this->updateDateTime  = $row['updateDateTime'];
            $this->insertDateTime  = $row['insertDateTime'];

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
        if($this->save->DeleteData("db_forklift"," WHERE fork_id = '$this->fork_id'","Delete ForkLift.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory;
          $this->brandCrtl = $this->select->getBrandSelectCtrl($this->fork_brand,'Y');
      //  $this->categoryCtrl = $this->select->getItemCategorySelectCtrl($this->product_category,'Y');
    //    $this->maingroupCtrl = $this->select->getItemGroupSelectCtrl($this->product_main_group,'Y');
    //    $this->sub_groupCtrl = $this->select->getItemSubGroupSelectCtrl($this->product_sub_group,'Y',' AND subgroup_main_id = '.$this->product_main_group);
    //    $this->uomCtrl = $this->select->getUomSelectCtrl($this->product_uom,'Y');
        /**$this->c ategoryCrtl2 = $this->select->getItemSubCategorySelectCtrl($this->product_category2,'Y');
        $this->categoryCrtl3 = $this->select->getItemSubSubCategorySelectCtrl($this->product_category3,'Y');**/


        //$this->producttypeCrtl = $this->select->getProducttypeSelectCtrl($this->product_producttype,'N');

        //$this->outletCrtl = $this->select->getOutletSelectCtrl($this->product_outlet,'N');
        //$this->uomCrtl = $this->select->getUomSelectCtrl($this->product_uom,'N');
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Forklift Management</title>
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
            <h1>Forklift Management</h1>
        </section>

          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->currency_id > 0){ echo "Update Product";}else{ echo "Create New Fork Lift";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = '' onclick = "window.location.href='forklift.php'">Back to listing</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'margin-right:10px;' onclick = "window.location.href='product.php?action=createForm'">Create New</button>
                <?php }?>
              </div>

                <form id = 'forklift_form' class="form-horizontal" action = 'forklift.php?action=create' method = "POST" enctype="multipart/form-data">
                     <input type ='hidden' name = 'current_tab' id = 'current_tab' value = "<?php echo $this->current_tab?>"/>
                  <div class="box-body">
                      <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li tab = "General" class="tab_header <?php if(($this->current_tab == "") || ($this->current_tab == "General")){ echo 'active';}?>"><a href="#general" data-toggle="tab">General</a></li>

                      </div>
                        <div class="tab-content"><!--edr Form-->
                          <div class=" tab-pane <?php if(($this->current_tab == "") || ($this->current_tab == "General")){ echo 'active';}?>" id="general">
                              <?php echo $this->getGeneralForm();?>
                          </div>

                       </div>


                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)" style="display:none">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->fork_id;?>" name = "fork_id" id = "fork_id"/>
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
    <title>Forklift Management</title>
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
            <h1>Forklift Management</h1>
        </section>

        <?php //edr

      // $test =   $this->getDataTable();
    //    print_r($test);

      /*  $sql_test = "SELECT SQL_CALC_FOUND_ROWS fr.*,br.brand_code as brand_code
    		          FROM db_forklift fr
                    LEFT JOIN db_brand br ON br.brand_id = fr.fork_brand";
        $query_test = mysql_query($sql_test);
        print_r(mysql_fetch_array($query_test));*/
         ?>
         <!--edr index table--->
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Forklift Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='forklift.php?action=createForm'">Create New + </button>

              <!---  <button style = 'margin-right:10px;' class="btn btn-primary pull-right import_btn" data-toggle="modal" data-target="#myModal">Import + </button>--->
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="product_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Fork Brand</th>
                        <th>Fork Model</th>
                        <th>Fork Capacity</th>
                        <th>Fork Height</th>
                        <th>Fork Mast</th>
                        <th>Fork Length</th>
                        <th>Fork Attachment</th>
                        <!--<th>Status</th>-->
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                  /*  $sql = "SELECT forklift.*,br.brand_code
                            FROM db_forklift forklift
                            INNER JOIN db_brand br ON br.brand_id = forklift.fork_brand
                          WHERE forklift.fork_id > 0 limit 0,100";*/
                      $sql = "SELECT * from db_forklift";
                      $fork_query = mysql_query($sql);


                      $i = 1;
                      while($row = mysql_fetch_array($fork_query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['brand_code'];?></td>
                            <td><?php echo $row['fork_model'];?></td>
                            <td><?php echo $row['fork_capacity'];?></td>
                            <td><?php echo $row['fork_height'];?></td>
                            <td><?php echo $row['fork_mast'];?></td>
                            <td><?php echo $row['fork_length'];?></td>
                            <!--<td><?php if($row['product_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>-->
                            <td class = "text-align-right">
                                <?php
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'forklift.php?action=edit&fork_id=<?php echo $row['fork_id'];?>'">Edit</button>
                                <?php }?>
                                <?php
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('forklift.php?action=delete&fork_id=<?php echo $row['fork_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th>Fork Brand</th>
                        <th>Fork Model</th>
                        <th>Fork Capacity</th>
                        <th>Fork Height</th>
                        <th>Fork Mast</th>
                        <th>Fork Length</th>
                        <th>Fork Attachment</th>
                        <!--th>Status</th>-->
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
                "dom": '<"topleft"l><"topright"f>rt<"btmleft"i><"btmright"p><"clear">',
    "bProcessing": true,
    "bServerSide": true,
    "sAjaxSource": "forklift.php?action=getDataTable",
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
                      null,
                      {"sClass": "text-align-right" }
                  ]
        });
        $("div.topleft").addClass('col-sm-3');
        $("div.topright").css('text-align','left');
        $("div.btmleft").addClass('col-sm-6');
        $("div.btmright").addClass('col-sm-6');
        $("#product_table_filter").css('text-align','left');
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

  $aColumns = array('No','brand_code','fork_model','fork_capacity','fork_height','fork_mast','fork_attachment','fork_acc','');

	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "fork_id";

	/* DB table to use */
        $sTable = "db_forklift";
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
            $sOrder = "ORDER BY fr.fork_id";
        }

	$sQuery = "SELECT SQL_CALC_FOUND_ROWS fr.*,br.brand_code as brand_code
		        FROM db_forklift fr
            LEFT JOIN db_brand br ON br.brand_id = fr.fork_brand
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
                             $btn = "<button type='button' class='btn btn-primary btn-info ' onclick = 'location.href = \"forklift.php?action=edit&fork_id={$aRow['fork_id']}\"'>Edit</button>";
                           }
                           if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                             $btn .= " <button type='button' class='btn btn-primary btn-danger' onclick = 'confirmAlertHref(\"forklift.php?action=delete&fork_id={$aRow['fork_id']}\",\"Confirm Delete?\")'>Delete</button>";
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

    ?>
        <div class="col-sm-9">
            <div class="form-group">
              <label for="product_category" class="col-sm-2 control-label">Brand</label>
              <div class="col-sm-3">
                   <select class="form-control select2" id="fork_brand" name="fork_brand">
                       <?php echo $this->brandCrtl;?>
                   </select>
              </div>
            </div>

            <div class="form-group">
              <label for="product_part_no" class="col-sm-2 control-label">Model</label>
              <div class="col-sm-3">
                   <input type="text" class="form-control" id="fork_model" name="fork_model" value = "<?php echo $this->fork_model;?>" placeholder="Model">
              </div>
              <label for="product_name" class="col-sm-2 control-label">Capacity</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="fork_capacity" name="fork_capacity" value = "<?php echo $this->fork_capacity;?>" placeholder="Capacity">
              </div>
            </div>

            <div class="form-group">
              <label for="product_desc" class="col-sm-2 control-label">Height</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="fork_height" name="fork_height" value = "<?php echo $this->fork_height;?>" placeholder="Height">
              </div>
              <label for="product_location" class="col-sm-2 control-label">Mast</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="fork_mast" name="fork_mast" value = "<?php echo $this->fork_mast;?>" placeholder="Mast">
                </div>
            </div>

            <div class="form-group">
                <label for="product_cost_price" class="col-sm-2 control-label">Length </label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="fork_length"  name="fork_length" placeholder="Length" value = "<?php echo $this->fork_length;?>" >
                </div>
                <label for="product_sale_price" class="col-sm-2 control-label">Attachment </label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="fork_attachment"  name="fork_attachment" placeholder="Attachment" value = "<?php echo $this->fork_attachment;?>" >
                </div>
            </div>

            <div class="form-group">
                <label for="product_stock" class="col-sm-2 control-label">Accessory</label>
                <div class="col-sm-3">
                    <input type="text"  class="form-control" id="fork_acc"  name="fork_acc" placeholder="Accessory" value = "<?php echo $this->fork_acc;?>">
                </div>
                <label for="product_lowstock" class="col-sm-2 control-label">Truck Serial </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="fork_serial"  name="fork_serial" placeholder="Truck Serial" value = "<?php echo $this->fork_serial;?>" >
                </div>
            </div>

            <div class="form-group">
                <label for="product_stock" class="col-sm-2 control-label">Battery</label>
                <div class="col-sm-3">
                    <input type="text"  class="form-control" id="fork_battery"  name="fork_battery" placeholder="Battery" value = "<?php echo $this->fork_battery;?>">
                </div>
                <label for="product_lowstock" class="col-sm-2 control-label">Battery Charger </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="fork_bat_charger"  name="fork_bat_charger" placeholder="Battery Charger" value = "<?php echo $this->fork_bat_charger;?>" >
                </div>
            </div>

            <div class="form-group">
                <label for="product_stock" class="col-sm-2 control-label">Charger S/Nr</label>
                <div class="col-sm-3">
                    <input type="text"  class="form-control" id="fork_snr"  name="fork_snr" placeholder="Charger S/Nr" value = "<?php echo $this->fork_snr;?>">
                </div>

            </div>



        </div>


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
