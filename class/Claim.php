<?php
/*
 * To change this tsorderate, choose Tools | Tsorderates
 * and open the tsorderate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Claim {

    public function Claim(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function createClaim(){
        $this->claim_status = 1;
        $claim_no = get_prefix_value("Claim",true);
        $table_field = array('claim_no','claim_engineers','claim_datefrom','claim_remark',
                             'claim_dateto','claim_status','claim_outlet');
        $table_value = array($claim_no,$this->claim_engineers,$this->claim_datefrom,$this->claim_remark,
                             $this->claim_dateto,$this->claim_status,$_SESSION['empl_outlet']);
        $remark = "Insert Claim.<br> Document No : $claim_no";
        if(!$this->save->SaveData($table_field,$table_value,'db_claim','claim_id',$remark)){
           return false;
        }else{
           $this->claim_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function updateClaim(){
        $this->claim_status = 1;
        $table_field = array('claim_engineers','claim_datefrom','claim_remark',
                             'claim_dateto','claim_status','claim_outlet');
        $table_value = array($this->claim_engineers,$this->claim_datefrom,$this->claim_remark,
                             $this->claim_dateto,$this->claim_status,$_SESSION['empl_outlet']);
        
        $remark = "Update Claim.<br> Document No : $this->claim_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_claim','claim_id',$remark,$this->claim_id)){
           return false;
        }else{
           return true;
        }
    }
    public function createClaimLine(){

        $table_field = array('clmd_claim_id','clmd_seqno','clmd_expenses_id','clmd_expenses_desc','clmd_date',
                             'clmd_currency_id','clmd_amt','clmd_rate','clmd_samt','clmd_eamt',
                             'clmd_isamex','clmd_isprep','clmd_ispriv');
        $table_value = array($this->claim_id,$this->clmd_seqno,$this->clmd_expenses_id,$this->clmd_expenses_desc,$this->clmd_date,
                             $this->clmd_currency_id,$this->clmd_amt,$this->clmd_rate,$this->clmd_samt,$this->clmd_eamt,
                             $this->clmd_isamex,$this->clmd_isprep,$this->clmd_ispriv);
        $this->fetchClaimDetail(" AND claim_id = '$this->claim_id'","","",1);
        $remark = "Insert $this->document_code Line.<br> Document No : $this->claim_no";
        if(!$this->save->SaveData($table_field,$table_value,'db_clmd','clmd_id',$remark)){
           return false;
        }else{
           $this->ordl_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function updateClaimLine(){
        $table_field = array('clmd_seqno','clmd_expenses_id','clmd_expenses_desc','clmd_date',
                             'clmd_currency_id','clmd_amt','clmd_rate','clmd_samt','clmd_eamt',
                             'clmd_isamex','clmd_isprep','clmd_ispriv');
        $table_value = array($this->clmd_seqno,$this->clmd_expenses_id,$this->clmd_expenses_desc,$this->clmd_date,
                             $this->clmd_currency_id,$this->clmd_amt,$this->clmd_rate,$this->clmd_samt,$this->clmd_eamt,
                             $this->clmd_isamex,$this->clmd_isprep,$this->clmd_ispriv);
        $this->fetchClaimDetail(" AND claim_id = '$this->claim_id'","","",1);
        $remark = "Update $this->document_code Line.<br> Document No : $this->claim_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_clmd','clmd_id',$remark,$this->clmd_id)){
           return false;
        }else{
           return true;
        }
    }
    public function createServJobLine(){

        $table_field = array('clms_clmd_id','clms_seqno','clms_sorder_id','clms_percent');
        $table_value = array($this->clmd_id,$this->clms_seqno,$this->clms_sorder_id,$this->clms_percent);
        
        $this->fetchClaimDetail(" AND claim_id = '$this->claim_id'","","",1);
        $remark = "Insert $this->document_code ServJob.<br> Document No : $this->claim_no";
        if(!$this->save->SaveData($table_field,$table_value,'db_clms','clms_id',$remark)){
           return false;
        }else{
           $this->ordl_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function updateServJobLine(){
        $table_field = array('clms_seqno','clms_sorder_id','clms_percent');
        $table_value = array($this->clms_seqno,$this->clms_sorder_id,$this->clms_percent);
        $this->fetchClaimDetail(" AND claim_id = '$this->claim_id'","","",1);
        $remark = "Update $this->document_code ServJob.<br> Document No : $this->claim_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_clms','clms_id',$remark,$this->clms_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchClaimDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_claim WHERE claim_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->claim_id = $row['claim_id'];
            $this->claim_no = $row['claim_no'];
            $this->claim_engineers = $row['claim_engineers'];
            $this->claim_datefrom = $row['claim_datefrom'];
            $this->claim_dateto = $row['claim_dateto'];
            $this->claim_status = $row['claim_status'];
            $this->claim_outlet = $row['claim_outlet'];
            $this->claim_remark = $row['claim_remark'];
            
        }
        return $query;
    }
    public function fetchClaimLineDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_clmd WHERE clmd_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->clmd_id = $row['clmd_id'];
            $this->clmd_seqno = $row['clmd_seqno'];
            $this->clmd_expenses_id = $row['clmd_expenses_id'];
            $this->clmd_expenses_desc = $row['clmd_expenses_desc'];
            $this->clmd_date = $row['clmd_date'];
            $this->clmd_currency_id = $row['clmd_currency_id'];
            $this->clmd_amt = $row['clmd_amt'];
            $this->clmd_rate = $row['clmd_rate'];
            $this->clmd_samt = $row['clmd_samt'];
            $this->clmd_eamt = $row['clmd_eamt'];
            $this->clmd_isamex = $row['clmd_isamex'];
            $this->clmd_isprep = $row['clmd_isprep'];
            $this->clmd_ispriv = $row['clmd_ispriv'];
            
        }
        return $query;
    }
    public function fetchServJobDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_clms WHERE clms_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->clms_id = $row['clms_id'];
            $this->clms_seqno = $row['clms_seqno'];
            $this->clms_sorder_id = $row['clms_sorder_id'];
            $this->clms_percent = $row['clms_percent'];
            
        }
        return $query;
    }
    public function deleteClaim(){
        if($this->save->DeleteData("db_claim"," WHERE claim_id = '$this->claim_id'","Delete Claim.")){
            return true;
        }else{
            return false;
        }
    }
    public function deleteOrderLine(){
        if($this->save->DeleteData("db_clmd"," WHERE clmd_claim_id = '$this->claim_id' AND clmd_id = '$this->clmd_id'","Delete $this->document_code Order Line.")){
            return true;
        }else{
            return false;
        }
    }
    public function deleteServJobLine(){
        if($this->save->DeleteData("db_clms"," WHERE clms_clmd_id = '$this->clmd_id' AND clms_id = '$this->clms_id'","Delete $this->document_code ServJob.")){
            return true;
        }else{
            return false;
        }
    }
    public function getListing(){
    ?>
    <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->document_name;?></title>
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
            <h1><?php echo $this->document_name;?></h1>

        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class = 'box-title'><?php echo $this->document_code;?> Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='<?php echo $this->document_url;?>?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="claim_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:3%'>No</th>
                        <th style = 'width:10%'>Claim No</th>
                        <th style = 'width:8%'>Date (From)</th>
                        <th style = 'width:11%'>Date (To)</th>
                        <th style = 'width:10%'>Engineers</th>
                        <th style = 'width:8%'>Status</th>
                        <th style = 'width:12%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style = 'width:3%'>No</th>
                        <th style = 'width:10%'>Claim No</th>
                        <th style = 'width:8%'>Date (From)</th>
                        <th style = 'width:11%'>Date (To)</th>
                        <th style = 'width:10%'>Engineers</th>
                        <th style = 'width:8%'>Status</th>
                        <th style = 'width:12%'></th>
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
        $('#claim_table').DataTable({
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "<?php echo $this->document_url;?>?action=getDataTable",  
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "iDisplayLength": 25,
                "aoColumns": [
                      null,
                      null,
                      null,
                      null,
                      null,
                      null,
                      {"sClass": "text-align-right" }
                  ]
        });

      });
    </script>
  </body>
</html>
    <?php
    }
    public function getDataTable(){
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array('No','claim_no','claim_datefrom','claim_dateto','empl_name','claim_status','');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "claim_id";
	
	/* DB table to use */
        $sTable = "db_claim";
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
        if($_SESSION['empl_group'] != 1){
            if($sWhere == ""){
               $sWhere = " WHERE (cm.insertBy = '{$_SESSION['empl_id']}' or cm.updateBy = '{$_SESSION['empl_id']}')";
            }else{
               $sWhere .= " AND (cm.insertBy = '{$_SESSION['empl_id']}' or cm.updateBy = '{$_SESSION['empl_id']}')"; 
            }
        }
        $sOrder = " ORDER BY cm.claim_no DESC";
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS cm.*,empl.empl_name
                  FROM db_claim cm 
                  LEFT JOIN db_empl empl ON empl.empl_id = cm.claim_engineers
                  
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
		for ($i=0;$i<10;$i++){
			if($aColumns[$i] == "No" ){
				$row[] = $b;
			}else if($aColumns[$i] != ""){
                            if($aColumns[$i] == 'claim_status'){
                                if($aRow[$aColumns[$i]] == 1){
                                    $row[] = "Active";
                                }else{
                                    $row[] = "In-Active";
                                }
                            }else{
                                $row[] = nl2br($aRow[$aColumns[$i]]);
                            }
			}else{
                           $btn = "";
                           if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                             $btn .= " <button type='button' class='btn btn-primary btn-info ' onclick = 'location.href = \"$this->document_url?action=edit_claim&claim_id={$aRow['claim_id']}\"'>Edit</button>";       
                           }
                           if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                             $btn .= " <button type='button' class='btn btn-primary btn-danger' onclick = 'confirmAlertHref(\"$this->document_url?action=delete_claim&claim_id={$aRow['claim_id']}\",\"Confirm Delete?\")'>Delete</button>";  
                           }
                                $row[] = $btn;
                        }
		}
		$output['aaData'][] = $row;
                $b++;
	}

	echo json_encode($output);
    }
    public function getClaimDetailTransaction(){
        
        $sorder_query = $this->fetchClaimDetail(" AND sorder_id = '$this->sorder_id'","","",0);
        
        if($row = mysql_fetch_array($sorder_query)){
            return $row;
        }else{
            return null;
        }
    }
    public function getInputForm(){
        global $mandatory,$language,$lang;
        $label_col_sm = "col-sm-2";
        $field_col_sm = "col-sm-2";
        
        $wherestring = " AND sorder_prefix_type = 'SO' AND sorder_tsstatus = '1'";
        if($_SESSION['empl_group'] > 1){
            $wherestring = " AND sorder_engineers = '{$_SESSION['empl_id']}'";
            $wherestring2 = " AND empl_id = '{$_SESSION['empl_id']}'";
        }
        $this->employeeCrtl = $this->select->getEmployeeSelectCtrl($this->claim_engineers,'N',$wherestring2);
        $this->serviceSOCrtl = $this->select->getServiceOrderSelectCtrl($this->claim_so,'Y',$wherestring);
        $this->currencyCrtl = $this->select->getCurrencySelectCtrl("",'Y');
        $this->expensesCtrl = $this->select->getExpensesSelectCtrl("",'N');
        
        if($this->claim_status == 2){
            $disabled = " disabled ";
        }else{
            $disabled = "";
        }
    ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->document_name;?></title>
    <?php
    include_once 'css.php';
    if($this->claim_id <= 0){
        $this->claim_datefrom = system_date;
        $this->claim_dateto = system_date;
        $action = "create_claim";
        $this->claim_no = get_prefix_value($this->document_code);
    }else{
        $action = "update_claim";
    }
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
            <h1><?php echo $this->document_name;?></h1>
        </section>
          <!-- Main content -->
          <section class="content">
        <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->claim_id > 0){ echo "Update " . $this->document_code;}else{ echo "Create New " . $this->document_code;}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='<?php echo $this->document_url;?>'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='<?php echo $this->document_url;?>?action=createForm'">Create New</button>
                <?php }?>
                <?php if((getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'print')) && ($this->claim_id > 0)){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.open('print.php?action=<?php echo $this->document_type;?>&report_id=<?php echo $this->claim_id;?>')">Print</button>
                <?php }?>
              </div>
                <form id = 'claim_form' class="form-horizontal" action = '<?php echo $this->document_url;?>' method = "POST">
                  <div class="box-body col-sm-12">
                        <div class="form-group">
                            <label for="claim_no" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->document_code;?> No.</label>
                            <div class="<?php echo $field_col_sm;?>">
                              <input type="text" class="form-control" id="claim_no" name="claim_no" value = "<?php echo $this->claim_no;?>" READONLY>
                            </div>
                            <label for = "claim_engineers" class="<?php echo $label_col_sm;?> control-label">Engineers</label>
                            <div class="<?php echo $field_col_sm;?>">
                                 <select class="form-control select2" id="claim_engineers" name="claim_engineers" <?php echo $disabled;?>>
                                     <?php echo $this->employeeCrtl;?>
                                 </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for = "claim_datefrom" class="<?php echo $label_col_sm;?> control-label"> Date (From) <?php echo $mandatory;?></label>
                            <div class="<?php echo $field_col_sm;?>">
                              <input type="text" class="form-control datepicker" id="claim_datefrom" name="claim_datefrom" value = "<?php echo $this->claim_datefrom;?>" placeholder="Claim Date (From)" <?php echo $disabled;?>>
                            </div>
                            <label for = "claim_dateto" class="<?php echo $label_col_sm;?> control-label"> Date (To) <?php echo $mandatory;?></label>
                            <div class="<?php echo $field_col_sm;?>">
                              <input type="text" class="form-control datepicker" id="claim_dateto" name="claim_dateto" value = "<?php echo $this->claim_dateto;?>" placeholder="Claim Date (To)" <?php echo $disabled;?>>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for = "claim_remark" class="<?php echo $label_col_sm;?> control-label">Remark</label>
                          <div class="<?php echo $field_col_sm;?>">
                                 <textarea class="form-control" rows="3" id="claim_remark" name="claim_remark" placeholder="Remark" <?php echo $disabled;?>><?php echo $this->claim_remark;?></textarea>
                          </div>
                        </div>
                  </div><!-- /.box-body -->
                      
                  <div class="box-footer" style = 'clear:both'>
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->claim_status;?>" name = "claim_status"/>
                    <input type = "hidden" value = "<?php echo $this->claim_id;?>" name = "claim_id"/>
                    <?php
                    if($this->claim_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                    ?>
                    <button type = "submit" class="btn btn-info" name = "smt" value = "Save">Save</button>
                    <?php 
                    }
                    ?>
                  </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
      
            <?php if($this->claim_id > 0){?>
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Expenses</h3>
              </div>
            <?php echo $this->getAddItemDetailForm();?>
            </div>
            <?php }?>
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    echo $this->getModalForm();
    ?>
    <script>
    var line_copy = '<tr id = "line_@i" class="tbl_grid_odd" line = "@i">' +
                    '<td style = "width:15px;padding-left:5px">@i</td>' + 
                    '<td style = "width:60px;"><input type = "text" id = "clmd_seqno_@i" class="form-control" value=""/></td>'+
                    '<td style = "width:180px;"><select id = "clmd_expenses_id_@i" class="form-control select2"><?php echo $this->expensesCtrl;?></select></td>'+
                    '<td class = ""><textarea id = "clmd_expenses_desc_@i" class="form-control"></textarea></td>'+
                    '<td style = "width:100px;"><input type = "text" id = "clmd_date_@i" class="form-control datepicker" value="<?php echo system_date;?>" /></td>'+
                    '<td style = "width:100px;"><select id = "clmd_currency_id_@i" line = "@i" class="form-control select2 currency_select2"><?php echo $this->currencyCrtl;?></select></td>'+
                    '<td style = "width:60px;"><input type = "text" line = "@i" id = "clmd_amt_@i" class="form-control calculate text-align-right" value="0.00"/></td>'+
                    '<td style = "width:60px;"><input type = "text" line = "@i" id = "clmd_rate_@i" class="form-control calculate text-align-right" value="0.00"/></td>'+
                    '<td style = "width:60px;"><input type = "text" id = "clmd_samt_@i" class="form-control text-align-right" value="0.00"/></td>'+
                    '<td style = "width:60px;"><input type = "text" id = "clmd_eamt_@i" class="form-control text-align-right" value="0.00"/></td>'+
                    '<td style = "width:20px;text-align:center"><input type = "checkbox" style = "width:20%" id = "clmd_isamex_@i" class = "minimal"/></td>'+
                    '<td style = "width:20px;text-align:center"><input type = "checkbox" style = "width:20%" id = "clmd_isprep_@i" class = "minimal"/></td>'+
                    '<td style = "width:20px;text-align:center"><input type = "checkbox" style = "width:20%" id = "clmd_ispriv_@i" class = "minimal"/></td>'+
                    '<td style = "width:20px;text-align:center"></td>'+
                    '<td align = "center" class = "" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">' +
                    '<img id = "save_line_@i" clmd_id = "" class = "save_line" line = "@i" src = "dist/img/add.png" style = "cursor:pointer" alt = "Add New"/>' + 
                    '</td>'+
                    '</tr>';
    $(document).ready(function() {
        addline();
        $(".select2").select2();
        
        $('.save_line').on('click',function(){
            saveline($(this).attr('line'),$(this).attr('clmd_id'));
        });
        $('.delete_line').on('click',function(){
            deleteline($(this).attr('clmd_id'));
        });
        $('.calculate').on('keyup',function(){
            calculateAmount($(this).attr('line'));
        });
        $('.currency_select2').on('change',function(){
            var data = "action=getCurrencyRateDetail&crate_tcurrency_id="+$(this).val();
            var line = $(this).attr('line');
             $.ajax({
                type: "POST",
                url: "crate.php",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#clmd_rate_'+line).val(jsonObj.crate_rate);
                    calculateAmount(line);
                }
             });
        });
        
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('.servjob').on('click',function(){
            refreshSevJobLine($(this).attr('clmd_id'));
            getClmdAjaxDetail($(this).attr('clmd_id'));
            $('#clmd_line_no').val($(this).attr('line')); 
            $('#clmd_id').val($(this).attr('clmd_id'));
            $('#myModal').modal('show');
        });
        $("#claim_form").validate({
                  rules: 
                  {
                      claim_datefrom:
                      {
                          required: true
                      },
                      claim_dateto:
                      {
                          required: true
                      }
                  },
                  messages:
                  {
                      claim_datefrom:
                      {
                          required: "<?php echo $language[$lang]['mandatory'];?>"
                      },
                      claim_dateto:
                      {
                          required: "<?php echo $language[$lang]['mandatory'];?>"
                      }
                  }
        });
        
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        
    });
    var issend = false;
    function saveline(line,clmd_id){
        if(issend){
            alert("<?php echo $language[$lang]['pleasewait'];?>");
            return false;
        }

        // Uncheck check 
        if($('#clmd_isamex_'+line).is(':checked')){
           var clmd_isamex = 1;
        }else{
           var clmd_isamex = 0;
        }
        
        // Uncheck check 
        if($('#clmd_isprep_'+line).is(':checked')){
           var clmd_isprep = 1;
        }else{
           var clmd_isprep = 0;
        }
        
        // Uncheck check 
        if($('#clmd_ispriv_'+line).is(':checked')){
           var clmd_ispriv = 1;
        }else{
           var clmd_ispriv = 0;
        }
        
        issend = true;
        if(clmd_id != ""){
            var action = 'updateline';
        }else{
            var action = 'saveline';
        }

        var data = "clmd_seqno="+encodeURIComponent($('#clmd_seqno_'+line).val());
            data += "&clmd_expenses_id="+encodeURIComponent($('#clmd_expenses_id_'+line).val());
            data += "&clmd_expenses_desc="+encodeURIComponent($('#clmd_expenses_desc_'+line).val());
            data += "&clmd_date="+encodeURIComponent($('#clmd_date_'+line).val());
            data += "&clmd_currency_id="+encodeURIComponent($('#clmd_currency_id_'+line).val());
            data += "&clmd_amt="+encodeURIComponent($('#clmd_amt_'+line).val());
            data += "&clmd_rate="+encodeURIComponent($('#clmd_rate_'+line).val());
            data += "&clmd_samt="+encodeURIComponent($('#clmd_samt_'+line).val());
            data += "&clmd_eamt="+encodeURIComponent($('#clmd_eamt_'+line).val());
            data += "&clmd_isamex="+clmd_isamex;
            data += "&clmd_isprep="+clmd_isprep;
            data += "&clmd_ispriv="+clmd_ispriv;
            data += "&action="+action;
            data += "&clmd_id="+clmd_id;
            data += "&claim_id=<?php echo $_REQUEST['claim_id'];?>";

        $.ajax({ 
            type: 'POST',
            url: '<?php echo $this->document_url;?>',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("<?php echo $language[$lang]['system_error']?>");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   window.location.reload();
               }else{
                   alert("<?php echo $language[$lang]['addeditline_error'];?>");
               }
               issend = false;
            }		
         });
         return false;
    }
    var issend = false;
    function saveclmsline(line,clms_id){
        if(issend){
            alert("<?php echo $language[$lang]['pleasewait'];?>");
            return false;
        }

        
        issend = true;
        if(clms_id != ""){
            var action = 'updateclmsline';
        }else{
            var action = 'saveclmsline';
        }

        var data = "clms_seqno="+encodeURIComponent($('#clms_seqno_'+line).val());
            data += "&clms_sorder_id="+encodeURIComponent($('#clms_sorder_id_'+line).val());
            data += "&clms_percent="+encodeURIComponent($('#clms_percent_'+line).val());
            data += "&action="+action;
            data += "&clms_id="+clms_id;
            data += "&clmd_id="+$('#clmd_id').val();
            data += "&claim_id=<?php echo $_REQUEST['claim_id'];?>";

        $.ajax({ 
            type: 'POST',
            url: '<?php echo $this->document_url;?>',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("<?php echo $language[$lang]['system_error']?>");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   refreshSevJobLine(jsonObj.clmd_id);
               }else{
                   alert("<?php echo $language[$lang]['addeditline_error'];?>");
               }
               issend = false;
            }		
         });
         return false;
    }
    function deleteline(clmd_id){
        var data = "action=deleteline&claim_id=<?php echo $this->claim_id;?>&clmd_id="+clmd_id;
        $.ajax({ 
            type: 'POST',
            url: '<?php echo $this->document_url;?>',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("<?php echo $language[$lang]['system_error']?>");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   window.location.reload();
               }else{
                   alert("<?php echo $language[$lang]['deleteline_error'];?>");
               }
               issend = false;
            }		
         });
         return false;
    }
    function deleteclmsline(clms_id,clmd_id){
        var data = "action=deleteclmsline&claim_id=<?php echo $this->claim_id;?>&clms_id="+clms_id+"&clmd_id="+clmd_id;
        $.ajax({ 
            type: 'POST',
            url: '<?php echo $this->document_url;?>',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("<?php echo $language[$lang]['system_error']?>");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   refreshSevJobLine(clmd_id);
               }else{
                   alert("<?php echo $language[$lang]['deleteline_error'];?>");
               }
               issend = false;
            }		
         });
         return false;
    }
    function getClmdAjaxDetail(clmd_id){
        var data = "action=getClmdAjaxDetail&claim_id=<?php echo $this->claim_id;?>&clmd_id="+clmd_id;
        $.ajax({ 
            type: 'POST',
            url: '<?php echo $this->document_url;?>',
            cache: false,
            data:data,
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
                $('#clmd_expenses_id').select2("val",jsonObj.clmd_expenses_id);
                $('#clmd_expenses_desc').val(jsonObj.clmd_expenses_desc);
                $('#clmd_date').val(jsonObj.clmd_date);
                $('#clmd_amt').val(jsonObj.clmd_amt);
                $('#clmd_currency_id').select2("val",jsonObj.clmd_currency_id);
            }		
         });
    }
    function refreshSevJobLine(clmd_id){
        var data = "action=refreshSevJobLine&claim_id=<?php echo $this->claim_id;?>&clmd_id="+clmd_id;
        $.ajax({ 
            type: 'POST',
            url: '<?php echo $this->document_url;?>',
            cache: false,
            data:data,
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
                $('.clms_tr').remove();
                $('#detail_last_tr_clms').before(jsonObj.html);
                $('.save_line_clms').on('click',function(){
                    saveclmsline($(this).attr('line'),$(this).attr('clms_id'));
                });
                $('.delete_line_clms').on('click',function(){
                    deleteclmsline($(this).attr('clms_id'),$(this).attr('clmd_id'));
                });
            }		
         });
    }
    function calculateAmount(line){
    
        var clmd_amt = $('#clmd_amt_'+line).val();
        var clmd_rate = $('#clmd_rate_'+line).val();
        if(isNaN(clmd_amt)){
            clmd_amt = 0;
        }
        if(isNaN(clmd_rate)){
            clmd_rate = 1;
        }
        var clmd_samt = clmd_amt * clmd_rate;
            $('#clmd_samt_'+line).val(RoundNum(clmd_samt,2));
        
    }
    function addline(){
        var addlinevalue = $('#total_line').val();
        var nextvalue = parseInt(addlinevalue)+1;
        var newline = line_copy.replace(/@i/g,nextvalue);
        $('#detail_last_tr').before(newline);
        $('#total_line').val(nextvalue);
        $('#clmd_seqno_'+nextvalue).val(nextvalue*10);
        

    }
    </script>
  </body>
</html>
    <?php
    }
    public function getAddItemDetailForm(){
    $line = 0;  
    
    ?>    
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:30px;padding-left:5px">No</th>
            <th class = "">Seq No</th>
            <th class = "">RCP Code</th>
            <th class = "">Description</th>
            <th class = "">Date</th>
            <th class = "">Currency</th>
            <th class = "">RCP Amount</th>
            <th class = "">Exch Rate</th>
            <th class = "">S Amount</th>
            <th class = "">E Amount</th>
            <th class = "" style = "text-align:center">Amex</th>
            <th class = "" style = "text-align:center">Prep</th>
            <th class = "" style = "text-align:center">Priv</th>
            <th class = ""></th>
            <th class = "" style="width:80px;"></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM db_clmd WHERE clmd_id > 0 AND clmd_claim_id > 0 AND clmd_claim_id = '$this->claim_id' ORDER BY clmd_seqno";
            $query = mysql_query($sql);
            while($row = mysql_fetch_array($query)){
                $line++;
                $currencyCrtl = $this->select->getCurrencySelectCtrl($row['clmd_currency_id'],'Y',$wherestring);
                $expensesCtrl = $this->select->getExpensesSelectCtrl($row['clmd_expenses_id'],'N');
            ?>
                <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>">
                    <td style = "width:15px;padding-left:5px"><?php echo $line;?></td>
                    <td style = "width:60px;"><input type = "text" id = "clmd_seqno_<?php echo $line;?>" class="form-control" value="<?php echo $row['clmd_seqno'];?>"/></td>
                    <td style = "width:180px;"><select id = "clmd_expenses_id_<?php echo $line;?>" class="form-control select2"><?php echo $expensesCtrl;?></select></td>
                    <td class = ""><textarea id = "clmd_expenses_desc_<?php echo $line;?>" class="form-control"><?php echo $row['clmd_expenses_desc'];?></textarea></td>
                    <td style = "width:100px;"><input type = "text" id = "clmd_date_<?php echo $line;?>" class="form-control datepicker" value="<?php echo $row['clmd_date'];?>" /></td>
                    <td style = "width:100px;"><select line = "<?php echo $line;?>" id = "clmd_currency_id_<?php echo $line;?>" class="form-control select2 currency_select2"><?php echo $currencyCrtl;?></select></td>
                    <td style = "width:60px;"><input type = "text" line = "<?php echo $line;?>" id = "clmd_amt_<?php echo $line;?>" class="form-control calculate text-align-right" value="<?php echo num_format($row['clmd_amt']);?>"/></td>
                    <td style = "width:60px;"><input type = "text" line = "<?php echo $line;?>" id = "clmd_rate_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo num_format($row['clmd_rate']);?>"/></td>
                    <td style = "width:60px;"><input type = "text" id = "clmd_samt_<?php echo $line;?>" class="form-control text-align-right" value = "<?php echo num_format($row['clmd_samt']);?>"/></td>
                    <td style = "width:60px;"><input type = "text" id = "clmd_eamt_<?php echo $line;?>" class="form-control text-align-right" value="<?php echo num_format($row['clmd_eamt']);?>"/></td>
                    <td style = "width:20px;text-align:center"><input type = "checkbox" style = "width:20%" id = "clmd_isamex_<?php echo $line;?>" class = "minimal" <?php if($row['clmd_isamex'] == 1){ echo 'CHECKED';}?>/></td>
                    <td style = "width:20px;text-align:center"><input type = "checkbox" style = "width:20%" id = "clmd_isprep_<?php echo $line;?>" class = "minimal" <?php if($row['clmd_isprep'] == 1){ echo 'CHECKED';}?>/></td>
                    <td style = "width:20px;text-align:center"><input type = "checkbox" style = "width:20%" id = "clmd_ispriv_<?php echo $line;?>" class = "minimal" <?php if($row['clmd_ispriv'] == 1){ echo 'CHECKED';}?>/></td>
                    <td style = "width:20px;text-align:center"><button class = "btn servjob" line = "<?php echo $line;?>" clmd_id = "<?php echo $row['clmd_id'];?>" clmd_expenses_id = "<?php echo $row['clmd_expenses_id'];?>">ServJob</button></td>
                    <td align = "center" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">
                        <?php if($row['clmd_id'] > 0){?>
                        <img id = "save_line_<?php echo $line;?>" clmd_id = "<?php echo $row['clmd_id'];?>" class = "save_line" line = "<?php echo $line;?>" src = "dist/img/update.png" style = "cursor:pointer" alt = "Update"/>
                        <?php }else{?>
                        <img id = "save_line_<?php echo $line;?>" clmd_id = "<?php echo $row['clmd_id'];?>" class = "save_line" line = "<?php echo $line;?>" src = "dist/img/add.png" style = "cursor:pointer" alt = "Add New"/>
                        <?php }?>
                        <img id = "delete_line_<?php echo $line;?>" clmd_id = "<?php echo $row['clmd_id'];?>" class = "delete_line" line = "<?php echo $line;?>" src = "dist/img/delete_icon.png" style = "cursor:pointer" alt = "Delete"/>
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
    public function getAddServJobDetailForm(){
    $line = 0;  
    
    ?>    
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:30px;padding-left:5px">No</th>
            <th class = "">Seq No</th>
            <th class = "">Services Job No</th>
            <th class = "">Percentage Share</th>
            <th class = "" style="width:80px;"></th>
          </tr>
        </thead>
        <tbody>
            <tr id = 'detail_last_tr_clms'></tr>
        </tbody>
    </table>
    <input type = 'hidden' id = 'total_line_clms' name = 'total_line_clms' value = '<?php echo $line;?>'/>
    

    <?php    
    }
    public function getModalForm(){
        $label_col_sm = "col-sm-2";
        $field_col_sm = "col-sm-4";
    ?>
    
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog ">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Expenses Receipt Job</h4>
              </div>
              <div class="modal-body">
                <div class="box box-success">
                  <form id = 'claim_form' class="form-horizontal" action = '<?php echo $this->document_url;?>' method = "POST"  style = 'padding:10px;'>
                    <div class="form-group">
                        <label for="claim_no" class="<?php echo $label_col_sm;?> control-label">Claim No.</label>
                        <div class="<?php echo $field_col_sm;?>">
                          <input type="text" class="form-control" value = "<?php echo $this->claim_no;?>" DISABLED>
                        </div>
                        <label for = "clmd_line_no" class="<?php echo $label_col_sm;?> control-label"> Line No.</label>
                        <div class="<?php echo $field_col_sm;?>">
                          <input type="text" class="form-control datepicker" id="clmd_line_no" name="clmd_line_no" value = "" DISABLED>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for = "clmd_expenses_id" class="<?php echo $label_col_sm;?> control-label"> Expenses Code</label>
                        <div class="<?php echo $field_col_sm;?>">
                           <select style = 'width:100%' id = "clmd_expenses_id" class="form-control select2" DISABLED><?php echo $this->expensesCtrl;?></select>
                        </div>
                        <label for = "clmd_expenses_desc" class="<?php echo $label_col_sm;?> control-label"> Expenses Desc</label>
                        <div class="<?php echo $field_col_sm;?>">
                          <textarea id = "clmd_expenses_desc" class="form-control" DISABLED></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for = "clmd_date" class="<?php echo $label_col_sm;?> control-label"> Date</label>
                        <div class="<?php echo $field_col_sm;?>">
                          <input type="text" class="form-control datepicker" id="clmd_date" name="clmd_date" value = "" DISABLED>
                        </div>
                        <label for = "clmd_currency_id" class="<?php echo $label_col_sm;?> control-label"> Currency</label>
                        <div class="<?php echo $field_col_sm;?>">
                          <select style = 'width:100%' id = "clmd_currency_id" class="form-control select2" DISABLED><?php echo $this->currencyCrtl;?></select>
                        </div>
                    </div>
                      <input type="hidden" class="form-control" id="clmd_id" name="clmd_id" value = "" >
                  </form>
                </div>
                <?php echo $this->getAddServJobDetailForm();?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
    <?php
    }
    public function getServJobLine(){
        $sql = "SELECT * FROM db_clms WHERE clms_id > 0 AND clms_clmd_id > 0 AND clms_clmd_id = '$this->clmd_id' ORDER BY clms_seqno";
        $query = mysql_query($sql);
        $html = "";
        $line = 0;
        while($row = mysql_fetch_array($query)){
            $line++;
            $currencyCrtl = $this->select->getCurrencySelectCtrl($row['clms_currency_id'],'Y',$wherestring);
            $servicesSOCtrl = $this->select->getServiceOrderSelectCtrl($row['clms_sorder_id'],'N');
            
            $clms_id = $row['clms_id'];
            
            $html .= "<tr id = 'line_$line' class='tbl_grid_odd clms_tr' line = '$line'>";
            $html .= "<td style = 'width:15px;padding-left:5px'>$line</td>";
            $html .= "<td style = 'width:60px;'><input type = 'text' id = 'clms_seqno_$line' class='form-control' value='{$row['clms_seqno']}'/></td>";
            $html .= "<td style = 'width:220px;'><select style = 'width:100%' id = 'clms_sorder_id_$line' class='form-control select2'>$servicesSOCtrl</select></td>";
            $html .= "<td style = 'width:60px;'><input type = 'text' id = 'clms_percent_$line' class='form-control calculate text-align-right' value = '" . num_format($row['clms_percent']) . "'/></td>";
            $html .= "<td align = 'center' style ='vertical-align:top;width:80px;padding-right:10px;padding-left:5px'>";
            $html .= "<img id = 'save_line_$line' clms_id = '$clms_id' clmd_id = '$this->clmd_id' class = 'save_line_clms' line = '$line' src = 'dist/img/update.png' style = 'cursor:pointer' alt = 'Update'/>";
            $html .= "<img id = 'delete_line_$line' clms_id = '$clms_id' clmd_id = '$this->clmd_id' class = 'delete_line_clms' line = '$line' src = 'dist/img/delete_icon.png' style = 'cursor:pointer' alt = 'Delete'/>";
            $html .= "</td></tr>";
        }
        $servicesSOCtrl = $this->select->getServiceOrderSelectCtrl("",'N');
        $line = $line + 1;
        $html .= "<tr id = 'line_$line' class='tbl_grid_odd clms_tr' line = ''>";
        $html .= "<td style = 'width:15px;padding-left:5px'>$line</td>";
        $html .= "<td style = 'width:60px;'><input type = 'text' id = 'clms_seqno_$line' class='form-control' value='" . $line*10 ."'/></td>";
        $html .= "<td style = 'width:220px;'><select style = 'width:100%' id = 'clms_sorder_id_$line' class='form-control select2'>$servicesSOCtrl</select></td>";
        $html .= "<td style = 'width:60px;'><input type = 'text' id = 'clms_percent_$line' class='form-control calculate text-align-right' value=''/></td>";
        $html .= "<td align = 'center' class = '' style ='vertical-align:top;width:80px;padding-right:10px;padding-left:5px'>";
        $html .= "<img id = 'save_line_$line' clms_id = '' class = 'save_line_clms' line = '$line' src = 'dist/img/add.png' style = 'cursor:pointer' alt = 'Add New'/>";

        return $html;
    }
    public function getClmdAjaxDetail(){
        
        $query = $this->fetchClaimLineDetail(" AND clmd_id = '$this->clmd_id'","","",0);
        return mysql_fetch_array($query);
    }
}
?>
