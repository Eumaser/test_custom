<?php
/*
 * To change this torderate, choose Tools | Torderates
 * and open the torderate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Backcharge {

    public function Backcharge(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function createBackcharge(){

        $table_field = array('backcharge_id','backcharge_project','backcharge_subcon','backcharge_no',
                             'backcharge_date','backcharge_remark','backcharge_status');
        $table_value = array($this->backcharge_id,$this->backcharge_project,$this->backcharge_subcon,$this->backcharge_no,
                             format_date_database($this->backcharge_date),$this->backcharge_remark,1);
        $remark = "Insert $this->document_code.<br> Document No : $this->order_no";
        if(!$this->save->SaveData($table_field,$table_value,'db_backcharge','backcharge_id',$remark)){
           return false;
        }else{
           $this->backcharge_id = $this->save->lastInsert_id;
           get_prefix_value($this->document_code,true,$this->backcharge_date);
           $this->createBackchargeLine();
           return true;
        }
    }
    public function updateBackcharge(){

        $table_field = array('backcharge_id','backcharge_project','backcharge_subcon','backcharge_no',
                             'backcharge_date','backcharge_remark','backcharge_status');
        $table_value = array($this->backcharge_id,$this->backcharge_project,$this->backcharge_subcon,$this->backcharge_no,
                             format_date_database($this->backcharge_date),$this->backcharge_remark,$this->backcharge_status);
        $remark = "Update $this->document_code.<br> Document No : $this->order_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_backcharge','backcharge_id',$remark,$this->backcharge_id)){
           return false;
        }else{
           $this->createBackchargeLine();
           return true;
        }
    }
    public function createBackchargeLine(){
        $this->deleteBackchargeLine();
        for($i=0;$i<sizeof($this->backchargeline);$i++){
            $table_field = array('bcline_backcharge_id','bcline_poline_id');
            $table_value = array($this->backcharge_id,$this->backchargeline[$i]);
            $remark = "Insert Back Charge Line";
            $this->save->SaveData($table_field,$table_value,'db_bcline','bcline_id',$remark);
        }
        return true;
    }
    public function fetchBackchargeDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_backcharge WHERE backcharge_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type ==1){
            $row = mysql_fetch_array($query);

            $this->backcharge_id = $row['backcharge_id'];
            $this->backcharge_project = $row['backcharge_project'];
            $this->backcharge_subcon = $row['backcharge_subcon'];
            $this->backcharge_no = $row['backcharge_no'];
            $this->backcharge_date = $row['backcharge_date'];
            $this->backcharge_remark = $row['backcharge_remark'];
            $this->backcharge_status = $row['backcharge_status'];
                    
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function fetchBackchargeLineDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_ordl WHERE ordl_id > 0 AND ordl_order_id = '$this->order_id' $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);

            $this->ordl_id = $row['ordl_id'];
            $this->ordl_pro_no = $row['ordl_pro_no'];
            $this->ordl_pro_id = $row['ordl_pro_id'];
            $this->ordl_pro_desc = $row['ordl_pro_desc'];
            $this->ordl_qty = $row['ordl_qty'];
            $this->ordl_uom = $row['ordl_uom'];
            $this->ordl_uprice = $row['ordl_uprice'];
            $this->ordl_disc = $row['ordl_disc'];
            $this->ordl_discamt = $row['ordl_discamt'];
            $this->ordl_istax = $row['ordl_istax'];
            $this->ordl_taxamt = $row['ordl_taxamt'];
            $this->ordl_total = $row['ordl_total'];
            $this->ordl_seqno = $row['ordl_seqno'];
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function delete(){
        $table_field = array('order_status');
        $table_value = array($this->order_status);
        $remark = "Delete $this->document_code.<br> Document No : $this->order_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_order','order_id',$remark,$this->order_id)){
           return false;
        }else{
           return true;
        }
    }
    public function deleteBackchargeLine(){
        if($this->save->DeleteData("db_bcline"," WHERE bcline_backcharge_id = '$this->backcharge_id'","Delete Backcharge Line.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory,$language,$lang;
        include_once 'Project.php';
        $p = new Project();
        if($action == 'create'){
            $this->backcharge_status = 1;
            $this->backcharge_date = system_date;
            $this->backcharge_no = get_prefix_value($this->document_code,false,$this->backcharge_date);
        }else{

        $this->subconCrtl = $this->select->getCustomerSelectCtrl($this->backcharge_subcon,'Y');
        }
        $this->projectCrtl = $this->select->getProjectSelectCtrl($this->backcharge_project,'Y');

        

         
        $label_col_sm = "col-sm-2";
        $field_col_sm = "col-sm-3";

    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->document_name . " "; if(($this->order_revtimes > 0) && ($this->document_type == 'QT')){ echo $this->order_no . " (Rev $this->order_revtimes)";}?></title>
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
            <h1><?php echo $this->document_name;?></h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='<?php echo $this->document_url;?>'">Back</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create') && ($this->order_id > 0)){?>
                <!--<button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='<?php echo $this->document_url;?>?action=createForm'">Create New</button>-->
                <?php }?>

                <h3 class="box-title"><?php if($this->order_id > 0){ echo "Update " . $this->document_code;}else{ echo "Create New " . $this->document_code;}?></h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create') && ($this->order_id > 0) && ($this->document_type == 'QT')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "duplicateDocument('<?php echo $this->order_id?>')">Duplicate</button>
                <?php }?>
              </div>
                
                <form id = 'order_form' class="form-horizontal" action = '<?php echo $this->document_url;?>?action=create' method = "POST" enctype="multipart/form-data">
                  <div class="box-body col-sm-9">

                        <?php 
                        $this->getBackchargeform($label_col_sm,$field_col_sm,$disabled);
                        ?>
                        
                  </div>
                  <div style = 'clear:both' ></div>
                  <div class="col-sm-12">
                      <?php if($this->backcharge_id > 0){?>
                        <h3>Purchasing Summary</h3>
                        <?php 
                        $this->getBackchargetable($label_col_sm,$field_col_sm,$disabled);
                        ?>
                      <?php }?>  
                  </div>
                  <div class="box-footer" style = 'clear:both'>
                  
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->backcharge_status;?>" name = "backcharge_status"/>
                    <input type = "hidden" value = "<?php echo $this->backcharge_id;?>" name = "backcharge_id"/>
                    <?php
                    if($this->order_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                        if($this->backcharge_status == 1){
                    ?>
                        <button type = "submit" class="btn btn-info">Save</button>
                        <?php
                        }?>
                    <?php }?> 
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'print') && ($this->backcharge_id > 0) && ($this->backcharge_status == 1)){?>
                &nbsp;&nbsp;&nbsp;            
                <button type = "button" class="btn btn-primary export"  >Export</button>
                
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
    <script src="dist/js/jquery.table2excel.js"></script>


    <script>

    var line_copy = '<tr id = "line_@i" class="tbl_grid_odd" line = "@i">' +
                    '<td style = "width:30px;padding-left:5px">@i</td>' + 
                    '<td style = "width:60px;"><input type = "text" id = "ordl_seqno_@i" class="form-control" value=""/></td>'+
                    '<td style = "width:120px;"><select style = "width:100%" id = "ordl_pro_id_@i" class="form-control invt_autocomplete "></select></td>'+
                    '<td style = "width:300px;"><textarea id = "ordl_pro_desc_@i" class="form-control"></textarea></td>'+
                    '<td style = "width:60px;"><input type = "text" id = "ordl_qty_@i" class="form-control calculate" value="1.00"/></td>'+
                    '<td style = "width:50px;"><select style = "width:100%" id = "ordl_uom_@i" class="form-control select2"><?php echo $this->uomCrtl;?></select></td>'+  
                    '<td style = "width:60px;"><input type = "text" id = "ordl_fuprice_@i" class="form-control calculate text-align-right" READONLY/></td>'+
                    //'<td style = "width:60px;"><input type = "text" id = "ordl_uprice_@i" class="form-control calculate text-align-right" READONLY/></td>'+
                    '<td style = "width:60px;"><input type = "text" id = "ordl_disc_@i" class="form-control calculate text-align-right"/></td>'+
                    '<td style = "width:100px;"><input readonly type = "text" id = "ordl_total_@i" class="form-control text-align-right"/></td>'+
                    '<td style = "width:120px;"><textarea id = "ordl_pro_remark_@i" class="form-control"></textarea></td>'+
                    '<td align = "center" class = "" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">' +
                    '<img id = "save_line_@i" ordl_id = "" class = "save_line" line = "@i" src = "dist/img/add.png" style = "cursor:pointer" alt = "Add New"/>' + 
                    '<img id = "delete_line_@i" ordl_id = "" class = "delete_line" line = "@i" src = "dist/img/delete_icon.png" style = "cursor:pointer" alt = "Delete"/>' + 
                    '</td>'+
                    '</tr>';
        
    $(document).ready(function() {

        <?php if($_REQUEST['isbottom'] == 1){?>
            $("html, body").animate({ scrollTop: $(document).height() },1000);
        <?php }?>

        $('#backcharge_project').on("change", function(e) { 
            getProjectDetail($(this).val());
        });
        $('.backchargeparent').on('click',function(){

                if($(this).is(':checked')){
                    $('.backchargeline').prop('checked',true);
                }else{
                    $('.backchargeline').prop('checked',false);
                }
                backchargechildren();
        });
        $('.backchargeline').on('click',function(){
            backchargechildren();
        });
        $("#order_form").validate({
              rules: 
              {
                  backcharge_project:
                  {
                      required: true
                  },
                  backcharge_date:
                  {
                      required: true
                  }
              },
              messages:
              {
                  backcharge_project:
                  {
                      required: "Please select project."
                  },
                  backcharge_date:
                  {
                      required: "Please select date."
                  }
              }
        });
        
$(".export").click(function(){
  $("#table2excel").table2excel({
    exclude: ".noExl",
    name: "Excel Document Name",
    filename: "myFileName",
    fileext: ".xls"
  }); 
});

        
    });

    function getProjectDetail(project_id){
         var data = "action=getProjectDetail&project_id="+project_id;
         $.ajax({
            type: "POST",
            url: "project.php",      
            data:data,
            success: function(data) { 
                var jsonObj = eval ("(" + data + ")");
                $('#backcharge_subcon').select2('val', 'All');
                $('#backcharge_subcon').html(jsonObj.subcon_option);
            }
         });
    }
    function backchargechildren(){
        $('.sub_total_class').html("0.00");
        $('.backchargeline').each(function(){
            var linetotal = $(this).attr('linetotal');
            var pid = $(this).attr('pid');

            if($(this).is(':checked')){
                var subtotal = $('#subtotal_'+pid).html();
                $('#subtotal_'+pid).html(RoundNum(parseFloat(linetotal) + parseFloat(subtotal),2));
            }
        });    
        var grand_total = 0;
        $('.sub_total_class').each(function(){
            grand_total = parseFloat(grand_total) + parseFloat($(this).html());
            $(this).html(changeNumberFormat(parseFloat(RoundNum($(this).html(),2))));
        });
        $('#grand_total').html(changeNumberFormat(RoundNum(grand_total,2)));
    }
    </script>
        <?php echo $this->generateDialogForm();?>
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
    <title><?php echo $this->document_code;?> Management</title>
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
            <h1><?php echo $this->document_code;?> Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $this->document_code;?> Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create') ){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='<?php echo $this->document_url;?>?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="order_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>Doc.No</th>
                        <th style = 'width:5%'>Date</th>
                        <th style = 'width:11%'>Project</th>
                        <th style = 'width:11%'>Sub-con</th>
                        <th style = 'width:8%'>Total</th>
                        <th style = 'width:5%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   

                      $sql = "SELECT bc.*,pr.partner_id,
                              CONCAT(pr.partner_code,' - ',pr.partner_name) as partner_name,pj.project_name,pj.project_code
                              FROM db_backcharge bc 
                              INNER JOIN db_project pj ON pj.project_id = bc.backcharge_project
                              LEFT JOIN db_partner pr ON pr.partner_id = bc.backcharge_subcon
                              WHERE bc.backcharge_id > 0 AND bc.backcharge_status = 1 $this->wherestring
                              ORDER BY bc.backcharge_no DESC,bc.backcharge_date DESC";

                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $row['backcharge_no'];?></td>
                            <td><?php echo format_date($row['backcharge_date']);?></td>
                            <td><?php echo $row['project_code'] . " - " . $row['project_name'];?></td>
                            <td><?php echo "<a href = 'partner.php?action=edit&partner_id={$row['partner_id']}' target = '_blank' >" . $row['partner_name'] . "</a>";?></td>
                            <td>
                                <?php 
                                $sql2 = "SELECT SUM(ordl_ftotal) as total
                                        FROM db_bcline bl 
                                        INNER JOIN db_ordl ol ON ol.ordl_id = bl.bcline_poline_id 
                                        WHERE bl.bcline_backcharge_id = '{$row['backcharge_id']}'";
                                $query2 = mysql_query($sql2);
                                if($row2 = mysql_fetch_array($query2)){
                                    echo num_format($row2['total']);
                                }else{
                                    echo num_format(0);
                                }
                                ?>
                            </td>
                            <td><?php if($row['backcharge_status'] == 1){ echo 'Active';}else if($row['backcharge_status'] == 0){ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if((getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')) && ($this->document_type == 'QT')){
                                ?>
                                <button type="button" class="btn btn-primary" onclick = "location.href = '<?php echo $this->document_url;?>?action=createForm&fi=1&order_customer=<?php echo $row['order_customer'];?>'">New</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = '<?php echo $this->document_url;?>?action=edit&backcharge_id=<?php echo $row['backcharge_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('<?php echo $this->document_url;?>?action=delete&backcharge_id=<?php echo $row['backcharge_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:5%'>Doc.No</th>
                        <th style = 'width:5%'>Date</th>
                        <th style = 'width:11%'>Project</th>
                        <th style = 'width:11%'>Sub-con</th>
                        <th style = 'width:8%'>Total</th>
                        <th style = 'width:5%'>Status</th>
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
        $('#order_table').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "order": [[1]]
        });

      });
    </script>
  </body>
</html>
    <?php
    }
    public function getBackchargeform($label_col_sm,$field_col_sm,$disabled){
        global $mandatory;
    ?>
        <div class="form-group">
            <label for="backcharge_no" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->document_code;?> No.</label>
            <div class="<?php echo $field_col_sm;?>">
              <input type="text" class="form-control" id="backcharge_no" name="backcharge_no" value = "<?php echo $this->backcharge_no;?>" READONLY>
            </div>
            <label for="backcharge_date" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->document_code;?> Date</label>
            <div class="<?php echo $field_col_sm;?>">
              <input type="text" class="form-control datepicker" id="backcharge_date" name="backcharge_date" value = "<?php echo format_date($this->backcharge_date);?>" placeholder=" <?php echo $this->document_code;?> Date" <?php echo $disabled;?>>
            </div>
        </div>  
            <div class="form-group">
              <label for="backcharge_project" class="<?php echo $label_col_sm;?> control-label">Project</label>
              <div class="<?php echo $field_col_sm;?>">
                   <select class="form-control select2" id="backcharge_project" name="backcharge_project" <?php echo $disabled;?> >
                       <?php echo $this->projectCrtl;?>
                   </select>
              </div>
              <label for="backcharge_subcon" class="<?php echo $label_col_sm;?> control-label">Sub-Con</label>
              <div class="<?php echo $field_col_sm;?>">
                   <select class="form-control select2" id="backcharge_subcon" name="backcharge_subcon" <?php echo $disabled;?>>
                       <?php echo $this->subconCrtl;?>
                   </select>
              </div>
            </div>
            
            <div class="form-group">
                <label for="backcharge_remark" class="<?php echo $label_col_sm;?> control-label">Remarks</label>
                <div class="<?php echo $field_col_sm;?>">
                      <textarea class="form-control" rows="3" id="backcharge_remark" name="backcharge_remark" placeholder="Remarks" <?php echo $disabled;?>><?php echo $this->backcharge_remark;?></textarea>
                </div>
                
            </div>
    <?php
    }
    public function getBackchargetable(){
    ?>    
     <div class="form-group">
        <table id="table2excel" class="table table-bordered table-hover table2excel">
            <thead>
              <tr class = ''>
                <th style = 'width:5%'>Item</th>
                <th style = 'width:8%'>Date</th>
                <th style = 'width:10%'>PO No.</th>
                <th style = 'width:11%'>D.O No.</th>
                <th style = 'width:15%'>Supplier</th>
                <th style = 'width:12%'>Material Name</th>
                <th style = 'width:5%;text-align:right'>Quantity</th>
                <th style = 'width:5%;text-align:right'>Price</th>
                <th style = 'width:10%;text-align:right'>Sub-Total</th>
                <th class = 'text-align-right' style = 'width:5%'><input type ='checkbox' class = 'backchargeparent' /> </th>
              </tr>
            </thead>
            <tbody>
            <?php   
                $sql = "
                    SELECT a.* FROM (
                      SELECT o.order_id,o.order_date,o.order_no,ol.ordl_pro_no,ol.ordl_qty,ol.ordl_fuprice,ol.ordl_ftotal,p.partner_name,
                        ol.ordl_id,0 as bcline_id
                      FROM db_order o
                      INNER JOIN db_partner p ON p.partner_id = o.order_customer
                      INNER JOIN db_ordl ol ON ol.ordl_order_id = o.order_id
                      WHERE o.order_status = 1 AND o.order_prefix_type = 'PO' 
                      AND o.order_project_id = '$this->backcharge_project' AND o.order_subcon = '$this->backcharge_subcon'
                      AND ol.ordl_id NOT IN (SELECT bcline_poline_id FROM db_bcline)

                      
                      UNION ALL
                      
                      SELECT o1.order_id,o1.order_date,o1.order_no,ol1.ordl_pro_no,ol1.ordl_qty,ol1.ordl_fuprice,ol1.ordl_ftotal,p1.partner_name,
                        ol1.ordl_id,bl1.bcline_id
                      FROM db_bcline bl1 
                      INNER JOIN db_ordl ol1 ON ol1.ordl_id = bl1.bcline_poline_id
                      INNER JOIN db_order o1 ON o1.order_id = ol1.ordl_order_id
                      INNER JOIN db_partner p1 ON p1.partner_id = o1.order_customer
                      WHERE o1.order_status = 1 AND o1.order_prefix_type = 'PO' 
                      AND o1.order_project_id = '$this->backcharge_project' AND o1.order_subcon = '$this->backcharge_subcon'
                      AND bl1.bcline_backcharge_id = '$this->backcharge_id' ANd bl1.bcline_id > 0
                      )a
                      ORDER BY a.order_date,a.order_no
                       ";
//echo $sql;die;
              $query = mysql_query($sql);

              $po_no = "";
              $sub_po_total = 0;
              $po_total = 0;

              $data = array();
              while($row = mysql_fetch_array($query)){
                 
                  $data[] = $row;
              }


             for($i=0;$i<sizeof($data);$i++){

                if($data[$i]['bcline_id'] > 0){ 
                    $sub_po_total = $sub_po_total + $data[$i]['ordl_ftotal'];
                    $po_total = $po_total + $data[$i]['ordl_ftotal'];
                }
            ?>
                <tr class = '<?php if($data[$i]['bcline_id'] <=0){ echo 'noExl';}?>'>
                    <td><?php echo $i+1;?></td>
                    <td><?php echo format_date($data[$i]['order_date']);?></td>
                    <td><?php echo "<a href = 'purchase_order.php?action=edit&order_id={$data[$i]['order_id']}' target = '_blank' >" . $data[$i]['order_no'] . "</a>";?></td>
                    <td>
                        <?php 
                           $do_query = getDataBySql("order_no,order_id","db_order"," WHERE order_generate_from = '{$data[$i]['order_id']}' AND order_status = '1'");
                           $do_no = "";
                           if($r_do = mysql_fetch_array($do_query)){
                           $do_no =  "<a href = 'delivery_order.php?action=edit&order_id={$r_do['order_id']}' target = '_blank'>" . $r_do['order_no'] . "</a>,";
                           }
                           echo rtrim($do_no,",");
                        ?>
                    </td>
                    <td><?php echo $data[$i]['partner_name'];?></td>
                    <td><?php echo $data[$i]['ordl_pro_no'];?></td>
                    <td class = "text-align-right"><?php echo $data[$i]['ordl_qty'];?></td>
                    <td class = "text-align-right"><?php echo num_format($data[$i]['ordl_fuprice']);?></td>
                    <td class = "text-align-right"><?php echo num_format($data[$i]['ordl_ftotal']);?></td>
                    <td class = "text-align-right noExl">
                       <input type ='checkbox' name = 'backchargeline[]' class = 'backchargeline' pid = '<?php echo $data[$i]['order_id'];?>' linetotal = '<?php echo $data[$i]['ordl_ftotal'];?>' value = '<?php echo $data[$i]['ordl_id'];?>' <?php if($data[$i]['bcline_id'] > 0){ echo 'CHECKED';}?>/> 
                       <input type ='hidden' name = 'bcline_id[]' value = '<?php echo $data[$i]['bcline_id'];?>' />
                    </td>
                </tr>
            <?php    
                     $po_no = $data[$i]['order_no'];
                    if(($po_no != $data[$i+1]['order_no']) && ($i > 0)){
                    ?>    
                    <tr class = ''>
                        <td colspan = '8' style = 'text-align:right' ><b>Sub-Total : </b></td>
                        <td style = 'text-align:right;font-weight:bold' class = 'sub_total_class' id = 'subtotal_<?php echo $data[$i]['order_id'];?>' ><?php echo num_format($sub_po_total);?></td>
                    </tr>
                    <?php
                        
                        $sub_po_total = 0;

                    }
                    
              }
            ?>
                    <tr class = ''>
                        <td colspan = '8' style = 'text-align:right' ><b>Total : </b></td>
                        <td style = 'text-align:right;font-weight:bold' id = 'grand_total'   ><?php echo num_format($po_total);?></td>
                    </tr>
            </tbody>
            <tfoot>
              <tr class = ''>
                <th style = 'width:5%'>Item</th>
                <th style = 'width:8%'>Date</th>
                <th style = 'width:10%'>PO No.</th>
                <th style = 'width:11%'>D.O No.</th>
                <th style = 'width:15%'>Supplier</th>
                <th style = 'width:12%'>Material Name</th>
                <th style = 'width:5%;text-align:right'>Quantity</th>
                <th style = 'width:5%;text-align:right'>Price</th>
                <th style = 'width:10%;text-align:right'>Sub-Total</th>
                <th style = 'width:5%'>&nbsp;</th>
              </tr>
            </tfoot>
        </table>
     </div>
    <?php    
    }
}
?>
