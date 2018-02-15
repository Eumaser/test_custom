<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report
 *
 * @author admin
 */
class Report {
    //put your code here
    public function Report(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
    }
    public function getInputForm($ranNum,$action){
        global $mandatory;
        
        $this->CustomerCrtl = $this->select->getCustomerSelectCtrl($this->report_customer_id,"Y"," AND partner_iscustomer = 1 ");
        $this->SalespersonCrtl = $this->select->getEmployeeSelectCtrl($this->report_salesperson_id);
        $this->productCrtl = $this->select->getProductSelectCtrl($this->report_product_id,"Y");
        
        $label_col_sm = "col-sm-2";
        $field_col_sm = "col-sm-3";
    ?>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $this->document_code . " " . $this->label_name; ?> Report</title>
    <?php include_once 'css.php'; ?>    
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
                        <h1><?php echo $this->document_code . " " . $this->label_name; ?> Report</h1>
                    </section>
<!-- Main content -->
                    <section class="content">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "printBtn()">Print</button>
                            </div>
                
                            <form id = 'report_form' class="form-horizontal" action = 'report.php?type=<?php echo $this->type; ?>' method = "POST" enctype="multipart/form-data">
                                <input type ='hidden' name = 'current_tab' id = 'current_tab' value = "<?php echo $this->current_tab; ?>"/>
                                <div class="box-body">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="<?php if($this->current_tab == ""){ echo 'active'; }?>"><a href="#<?php echo $this->type;?>" data-toggle="tab"><?php echo $this->label_name; ?></a></li>
                                            <!--<li tab = "Summary" class="tab_header <?php if($this->current_tab == "" || $this->current_tab == "Summary"){ echo 'active'; }?>"><a href="#summary" data-toggle="tab">Summary</a></li>
                                            <li tab = "Detailed" class="tab_header <?php if($this->current_tab == "Detailed"){ echo 'active';  }?>"><a href="#detailed" data-toggle="tab">Detailed</a></li>-->
                                        </ul>
                                        <div class="tab-content">
                                            <div class="active tab-pane" id="<?php echo $this->type;?>">
                                                <div class="form-group">
                                                    <label for="report_customer_name" class="<?php echo $label_col_sm;?> control-label">Customer Name</label>
                                                    <div class="col-sm-3">
                                                        <select class="form-control select2" id="report_customer_id" name="report_customer_id" >
                                                            <?php echo $this->CustomerCrtl;?>
                                                        </select>
                                                        <p></p>
                                                        <input type="text" class="form-control" id="report_customer_name" name="report_customer_name" value = "<?php echo $this->report_customer_name;?>" placeholder="Customer Name">
                                                    </div>
                                                    <label for="report_salesperson_name" class="<?php echo $label_col_sm;?> control-label">Sales Person Name</label>
                                                    <div class="col-sm-3">
                                                        <select class="form-control select2" id="report_salesperson_id" name="report_salesperson_id" >
                                                            <?php echo $this->SalespersonCrtl;?>
                                                        </select>
                                                        <p></p>
                                                        <input type="text" class="form-control" id="report_salesperson_name" name="report_salesperson_name" value = "<?php echo $this->report_salesperson_name;?>" placeholder="Sales Person Name">
                                                    </div>
                                                </div>  
                                                <div class="form-group">
                                                    <label for="report_invoice" class="<?php echo $label_col_sm;?> control-label">Sales Invoice No.</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="report_invoice" name="report_invoice" value = "<?php echo $this->report_invoice;?>" placeholder="IV/170100001">
                                                    </div>
                                                    <?php if($this->type == 'detailed'){ ?>
                                                    <label for="report_product" class="<?php echo $label_col_sm;?> control-label">Product</label>
                                                    <div class="col-sm-3">
                                                        <select class="form-control select2" id="report_product_id" name="report_product_id" >
                                                            <?php echo $this->productCrtl;?>
                                                        </select>
                                                        <p></p>
                                                        <input type="text" class="form-control" id="report_product_name" name="report_product_name" value = "<?php echo $this->report_product_name;?>" placeholder="Product Name">
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="report_date_from" class="<?php echo $label_col_sm;?> control-label">Date from</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control datepicker" id="report_date_from" name="report_date_from" value = "<?php echo $this->report_date_from;?>" placeholder="Date from">
                                                    </div>
                                                    <label for="report_date_to" class="<?php echo $label_col_sm;?> control-label">Date To</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control datepicker" id="report_date_to" name="report_date_to" value = "<?php echo $this->report_date_to;?>" placeholder="Date to">
                                                    </div>
                                                </div>                                                    
                                            </div><!-- /.summary -->
                                            <!--<div class=" tab-pane <?php if($this->current_tab == "Detailed"){ echo 'active'; $this->type = 'detailed';}?>" id="detailed">
                                                <div class="form-group">
                                                    <label for="detailed_customer_name" class="<?php echo $label_col_sm;?> control-label">Customer Name <?php echo $mandatory;?></label>
                                                    <div class="col-sm-3">
                                                        <select class="form-control select2" id="detailed_customer_id" name="detailed_customer_id" >
                                                            <?php echo $this->dCustomerCrtl;?>
                                                        </select>
                                                        <p></p>
                                                        <input type="text" class="form-control" id="detailed_customer_name" name="detailed_customer_name" value = "<?php echo $this->detailed_customer_name;?>" placeholder="d Customer Name">
                                                    </div>
                                                    <label for="detailed_salesperson_name" class="<?php echo $label_col_sm;?> control-label">Sales Person Name<?php echo $mandatory;?></label>
                                                    <div class="col-sm-3">
                                                        <select class="form-control select2" id="detailed_salesperson_id" name="detailed_salesperson_id" >
                                                            <?php echo $this->dSalespersonCrtl;?>
                                                        </select>
                                                        <p></p>
                                                        <input type="text" class="form-control" id="detailed_salesperson_name" name="detailed_salesperson_name" value = "<?php echo $this->detailed_salesperson_name;?>" placeholder="Sales Person Name">
                                                    </div>
                                                </div>  
                                                <div class="form-group">
                                                    <label for="detailed_invoice" class="<?php echo $label_col_sm;?> control-label">Sales Invoice No.</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="detailed_invoice" name="detailed_invoice" value = "<?php echo $this->detailed_invoice;?>" placeholder="IV/170100001">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="detailed_date_from" class="<?php echo $label_col_sm;?> control-label">Date from</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control datepicker" id="detailed_date_from" name="detailed_date_from" value = "<?php echo $this->detailed_date_from;?>" placeholder="Date from">
                                                    </div>
                                                    <label for="detailed_date_to" class="<?php echo $label_col_sm;?> control-label">Date To</label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control datepicker" id="detailed_date_to" name="detailed_date_to" value = "<?php echo $this->detailed_date_to;?>" placeholder="Date to">
                                                    </div>
                                                </div>
                                            </div>--><!-- /.detailed -->
                                        </div><!-- /.tab-content -->
                                    </div>
                                    <div id="hidden_form_container" style="display:none;"></div>
                                </div><!-- /.box-body -->
                                <div class="box-footer" style = 'clear:both'>
                                    <button type="button" data-loading-text="Loading..." id = 'reset_btn' class="btn btn-default" onclick = "resetBtn()">Reset</button>
                                    &nbsp;&nbsp;&nbsp;
                                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                                    <input type = "hidden" value = "<?php echo $this->type;?>" name = "type" />
                    <?php                        
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                    ?>
                                    <button type = "submit" class="btn btn-info">Search</button>
                <?php }?>
                                </div><!-- /.box-footer -->
                            </form>
                        </div><!-- /.box -->
                <?php if($ranNum > 0){?>
                        <div class="box box-success">
                        <?php if($this->type == "summary"){ ?>
                            <div class="nav-tabs-custom" style = 'margin-top:5px;'>
                                <ul class="nav nav-tabs">
                                    <li <?php if($this->current_tab == "" || $this->current_tab == 'Summary'){ echo 'class="active"';}?>><a href="#summary_tab" data-toggle="tab">Summary</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane <?php if($this->current_tab == "" || $this->current_tab == 'Summary'){ echo 'active';}?>" id="summary_tab">
                                    <?php echo $this->getSummaryTable();?>
                                </div>                                
                            </div>
                        <?php }else if($this->type == "detailed"){ ?>
                            <div class="nav-tabs-custom" style = 'margin-top:5px;'>
                                <ul class="nav nav-tabs">
                                    <li <?php if($this->current_tab == "Detailed"){ echo 'class="active"';}?>><a href="#detailed_tab" data-toggle="tab">Detailed</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane <?php if($this->current_tab == "Detailed"){ echo 'active';}?>" id="detailed_tab">
                                    <?php echo $this->getDetailedTable();?>
                                </div>                                
                            </div>
                        <?php } ?>
                        </div>
                <?php }?>        
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
        
        $('.edit_line_worker').on('click',function(){
            $('#add_worker_new').css('display','none');
            var data = "action=fetch_worker&partner_id=<?php echo $this->partner_id;?>&pempl_id="+$(this).attr('pempl_id');
            $.ajax({ 
                type: 'POST',
                url: 'partner.php',
                cache: false,
                data:data,
                error: function(xhr) {
                    alert("System Error.");
                    issend = false;
                },
                success: function(data) {
                   var jsonObj = eval ("(" + data + ")");
                   if(jsonObj.status == 1){
                        $('#pempl_id').val(jsonObj.pempl_id);
                        $('#pempl_name').val(jsonObj.pempl_name);
                        $('#pempl_nric').val(jsonObj.pempl_nric);
                        $('#pempl_wpno').val(jsonObj.pempl_wpno);
                        $('#pempl_issuedate').val(jsonObj.pempl_issuedate);
                        $('#pempl_expirydate').val(jsonObj.pempl_expirydate);
                        $('#pempl_passport').val(jsonObj.pempl_passport);
                        $('#pempl_passportissuedate').val(jsonObj.pempl_passportissuedate);
                        $('#pempl_passportexpirydate').val(jsonObj.pempl_passportexpirydate);
                        $('#pempl_position').val(jsonObj.pempl_position);                    
                        $('#add_worker').text("Update Worker");
                        $('#WorkerModal').modal('show');
                   }else{
                       alert("Fail to fetch data.");
                   }
                   issend = false;
                }		
            });
            return false;
        });
        $('#report_customer_id').change(function(){
            var data = "action=getCustomerJson&report_customer_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#report_customer_name').val(jsonObj.customer_name);
                }
             });
        });
        $('#report_salesperson_id').change(function(){
            var data = "action=getSalespersonJson&report_salesperson_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#report_salesperson_name').val(jsonObj.salesperson_name);
                }
             });
        });
        $('#report_product_id').change(function(){
            var data = "action=getProductJson&report_product_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#report_product_name').val(jsonObj.product_desc);
                }
             });
        });
    });
    function resetBtn(){
        $('#report_customer_id').removeAttr('value');
        $('#report_customer_name').removeAttr('value');
        $('#report_salesperson_id').removeAttr('value');
        $('#report_salesperson_name').removeAttr('value');
        $('#report_invoice').removeAttr('value');
        $('#report_date_from').removeAttr('value');
        $('#report_date_to').removeAttr('value');        
        window.location.href = '<?php echo $this->document_url; ?>';
    }
    function printBtn(){

            var theForm,newInput1,newInput2,newInput3,newInput4,newInput5,newInput6,newInput7,newInput8,newInput9; 
            var customer_id     = $('#report_customer_id').val();
            var customer_name   = $('#report_customer_name').val();
            var salesperson_id  = $('#report_salesperson_id').val();
            var salesperson_name = $('#report_salesperson_name').val();
            var invoice         = $('#report_invoice').val();
            var date_from       = $('#report_date_from').val();
            var date_to         = $('#report_date_to').val();
            var product_id         = $('#report_product_id').val();
            
            // Start by creating a <form>
            theForm = document.createElement('form');
            theForm.action = 'report_print.php';
            theForm.method = 'post';
            theForm.target = "_blank";
            // Next create the <input>s in the form and give them names and values
            newInput1 = document.createElement('input');
            newInput1.type = 'hidden';
            newInput1.name = 'report_customer_id';
            newInput1.value = customer_id;
            newInput2 = document.createElement('input');
            newInput2.type = 'hidden';
            newInput2.name = 'report_customer_name';
            newInput2.value = encodeURIComponent(customer_name);
            newInput3 = document.createElement('input');
            newInput3.type = 'hidden';
            newInput3.name = 'report_salesperson_id';
            newInput3.value = salesperson_id;
            newInput4 = document.createElement('input');
            newInput4.type = 'hidden';
            newInput4.name = 'report_salesperson_name';
            newInput4.value = encodeURIComponent(salesperson_name);
            newInput5 = document.createElement('input');
            newInput5.type = 'hidden';
            newInput5.name = 'report_invoice';
            newInput5.value = invoice;
            newInput6 = document.createElement('input');
            newInput6.type = 'hidden';
            newInput6.name = 'report_date_from';
            newInput6.value = date_from;
            newInput7 = document.createElement('input');
            newInput7.type = 'hidden';
            newInput7.name = 'report_date_to';
            newInput7.value = date_to;
            newInput8 = document.createElement('input');
            newInput8.type = 'hidden';
            newInput8.name = 'type';
            newInput8.value = '<?php echo $this->type; ?>';
            newInput9 = document.createElement('input');
            newInput9.type = 'hidden';
            newInput9.name = 'report_product_id';
            newInput9.value = product_id;
            // Now put everything together...
            theForm.appendChild(newInput1);
            theForm.appendChild(newInput2);
            theForm.appendChild(newInput3);
            theForm.appendChild(newInput4);
            theForm.appendChild(newInput5);
            theForm.appendChild(newInput6);
            theForm.appendChild(newInput7);
            theForm.appendChild(newInput8);
            theForm.appendChild(newInput9);
            // ...and it to the DOM...
            document.getElementById('hidden_form_container').appendChild(theForm);
            // ...and submit it
            theForm.submit();
    }
    </script>
  </body>
</html>
        <?php
        
    }
    public function fetchReportSummary($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT 
                    inv.invoice_no, 
                    inv.invoice_date, 
                    inv.invoice_customer, 
                    cust.partner_name,
                    inv.invoice_salesperson, 
                    emp.empl_name,
                    inv.invoice_subtotal,
                    inv.invoice_taxtotal,
                    inv.invoice_grandtotal,
                    inv.invoice_id, 
                    inv.invoice_prefix_type
                FROM `db_invoice` inv
                    LEFT JOIN `db_partner` cust ON cust.partner_id = inv.invoice_customer
                    LEFT JOIN `db_empl` emp ON emp.empl_id = inv.invoice_salesperson  
                $wherestring ORDER BY inv.invoice_date DESC, inv.invoice_id DESC $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->summary_invoice_no           = $row['invoice_no'];
            $this->summary_invoice_date         = $row['invoice_date'];
            $this->summary_invoice_customer     = $row['invoice_customer'];
            $this->summary_partner_name         = $row['partner_name'];
            $this->summary_invoice_salesperson  = $row['invoice_salesperson'];
            $this->summary_empl_name            = $row['empl_name'];
            $this->summary_invoice_subtotal     = $row['invoice_subtotal'];
            $this->summary_invoice_taxtotal     = $row['invoice_taxtotal'];
            $this->summary_invoice_grandtotal   = $row['invoice_grandtotal'];
            $this->summary_invoice_id           = $row['invoice_id'];
            $this->summary_invoice_prefix_type  = $row['invoice_prefix_type'];            
        }
        return $query;
    } 
    public function fetchReportDetailed($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT 
                    inv.invoice_no, 
                    inv.invoice_date, 
                    inv.invoice_customer, 
                    cust.partner_name,
                    inv.invoice_salesperson, 
                    emp.empl_name,
                    inv.invoice_subtotal,
                    inv.invoice_taxtotal,
                    inv.invoice_grandtotal,
                    inv.invoice_id, 
                    inv.invoice_prefix_type,
                    COUNT(invl.invl_pro_id) as invl_pro_id
                FROM `db_invoice` inv
                    LEFT JOIN `db_partner` cust ON cust.partner_id = inv.invoice_customer
                    LEFT JOIN `db_empl` emp ON emp.empl_id = inv.invoice_salesperson  
                    LEFT JOIN `db_invl` invl ON invl.invl_invoice_id = inv.invoice_id
                $wherestring GROUP BY inv.invoice_no
                    HAVING COUNT(invl.invl_pro_id) > 0
                    ORDER BY inv.invoice_date DESC, inv.invoice_id DESC $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->summary_invoice_no           = $row['invoice_no'];
            $this->summary_invoice_date         = $row['invoice_date'];
            $this->summary_invoice_customer     = $row['invoice_customer'];
            $this->summary_partner_name         = $row['partner_name'];
            $this->summary_invoice_salesperson  = $row['invoice_salesperson'];
            $this->summary_empl_name            = $row['empl_name'];
            $this->summary_invoice_subtotal     = $row['invoice_subtotal'];
            $this->summary_invoice_taxtotal     = $row['invoice_taxtotal'];
            $this->summary_invoice_grandtotal   = $row['invoice_grandtotal'];
            $this->summary_invoice_id           = $row['invoice_id'];
            $this->summary_invoice_prefix_type  = $row['invoice_prefix_type'];            
        }
        return $query;
    } 
    public function fetchCustomerDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_partner WHERE partner_status = 1 and partner_iscustomer = 1 and (partner_id > 0 $wherestring ) $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->partner_id = $row['partner_id'];
            $this->partner_name = html_entity_decode($row['partner_name']);            
        }
        return $query;
    }
    public function fetchSalespersonDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_empl WHERE empl_status = 1 and (empl_id > 0 $wherestring ) $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->empl_id = $row['empl_id'];
            $this->empl_name = html_entity_decode($row['empl_name']);            
        }
        return $query;
    }
    public function fetchProductDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_product WHERE product_status = 1 and (product_id > 0 $wherestring ) $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->product_id = $row['product_id'];
            $this->product_desc = html_entity_decode($row['product_desc']);            
        }
        return $query;
    }
    public function getSummaryTable(){
    $line = 0;     
    ?>    
    <table id="summary_table" class="table summary-data table-bordered table-striped">
        <thead>
          <tr>
            <th class = "" style = 'width:30px;padding-left:5px'>No</th>
            <th class = "" style = 'width:100px;'>Invoice</th>
            <th class = "" style = 'width:100px;'>Date</th>
            <th class = "" style = 'width:300px;'>Customer</th>
            <th class = "" style = 'width:300px;'>Sales Person</th>
            <th class = "" style = 'width:80px;'>Total</th>
            <th class = "" style = 'width:80px;'>GST</th>
            <th class = "" style = 'width:80px;'>Total (Gross)</th>            
          </tr>
        </thead>
        <tbody>
        <?php
            $grandtotal= 0;
            while($row = mysql_fetch_array($this->query)){ 
                $line++;
        ?>
            <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>">
                <td style="width:30px;padding-left:5px"><?php echo $line;?></td>
                <td style="width:100px;padding-left:5px"><?php echo $row['invoice_no'];?></td>
                <td style="width:100px;padding-left:5px"><?php echo format_date($row['invoice_date']);?></td>
                <td style="width:300px;padding-left:5px"><?php echo $row['partner_name'];?></td>
                <td style="width:300px;padding-left:5px"><?php echo $row['empl_name'];?></td>
                <td style="width:80px;padding-left:5px"><?php echo $row['invoice_subtotal'];?></td>
                <td style="width:80px;padding-left:5px"><?php echo $row['invoice_taxtotal'];?></td>
                <td style="width:80px;padding-left:5px"><?php echo $row['invoice_grandtotal'];?></td>
            </tr>               
        <?php
                $grandtotal = $grandtotal + $row['invoice_grandtotal'];
            }
        ?>
            <tr id = 'detail_last_tr'></tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" style = 'padding:20px;text-align:right;font-weight:700;'>Total Amount:</td>                
                <td class = "" style = 'padding:20px;width:80px;font-weight:700;'><?php echo $grandtotal; ?></td>            
            </tr>
        </tfoot>
    </table>
    <input type = 'hidden' id = 'total_line' name = 'total_line' value = '<?php echo $line;?>'/>
    <?php    
    }
    public function getDetailedTable(){
    $line = 0;     
    ?>    
    <table id="summary_table" class="table summary-data table-bordered">
        <thead>
          <tr>
            <th class = "" style = 'width:30px;padding-left:5px'>No</th>
            <th class = "" style = 'width:100px;'>Invoice</th>
            <th class = "" style = 'width:100px;'>Date</th>
            <th class = "" style = 'width:300px;'>Customer</th>
            <th class = "" style = 'width:300px;'>Sales Person</th>
            <th class = "" style = 'width:80px;'>Total</th>
            <th class = "" style = 'width:80px;'>GST</th>
            <th class = "" style = 'width:80px;'>Total (Gross)</th>            
          </tr>
        </thead>
        <tbody>
        <?php
            while($row = mysql_fetch_array($this->query)){ 
                $line++;
                //$c = 1-$c;
                $mcolor = "FBDDC8"; //($c==0)?"FBDDC8":"FAB483";
        ?>
            <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>" style="background-color:#<?php echo $mcolor; ?>;">
                <td style="width:30px;padding-left:5px"><b><?php echo $line;?></b></td>
                <td style="width:100px;padding-left:5px"><b><?php echo $row['invoice_no'];?></b></td>
                <td style="width:100px;padding-left:5px"><b><?php echo format_date($row['invoice_date']);?></b></td>
                <td style="width:300px;padding-left:5px"><b><?php echo $row['partner_name'];?></b></td>
                <td style="width:300px;padding-left:5px"><b><?php echo $row['empl_name'];?></b></td>
                <td style="width:80px;padding-left:5px"><b><?php echo $row['invoice_subtotal'];?></b></td>
                <td style="width:80px;padding-left:5px"><b><?php echo $row['invoice_taxtotal'];?></b></td>
                <td style="width:80px;padding-left:5px"><b><?php echo $row['invoice_grandtotal'];?></b></td>
            </tr>     
            <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>" style="background-color:#FAD097;">
                <td style="width:30px;padding-left:5px"></td>
                <td style="width:100px;padding-left:5px"><i>Type</i></td>       
                <td style="width:100px;padding-left:5px"><i>Category</i></td>
                <td colspan="2" style="width:300px;padding-left:5px"><i>Product Name</i></td>                        
                <td style="width:80px;padding-left:5px"><i>Qty</i></td>
                <td style="width:80px;padding-left:5px"><i>U/Price</i></td>
                <td style="width:80px;padding-left:5px"><i>Total</i></td>
            </tr>
        <?php
                $detailSql = "SELECT    invl.invl_id,
                                        invl.invl_item_type,
                                        (CASE when (invl.invl_item_type = 'package') 
                                            THEN
                                            (   SELECT CONCAT(package_part_no,' ',package_desc) as product_name
                                                FROM `db_package`                                    
                                                WHERE package_id = invl.invl_pro_id
                                            )
                                            ELSE
                                            (   SELECT CONCAT(product_part_no,' ',product_desc) as product_name
                                                FROM `db_product`                                    
                                                WHERE product_id = invl.invl_pro_id
                                            )
                                        END) as product_name,
                                        (CASE when (invl.invl_item_type = 'package') 
                                            THEN
                                                'NA'
                                            ELSE
                                                cat.category_desc
                                        END) as category_desc,
                                        invl.invl_pro_id,
                                        invl.invl_qty,
                                        invl.invl_uprice,
                                        invl.invl_total
                            FROM `db_invl` invl
                                    LEFT JOIN db_product prod ON prod.product_id = invl.invl_pro_id
                                    LEFT JOIN db_category cat ON cat.category_id = prod.product_category
                            WHERE invl.invl_invoice_id = '".$row['invoice_id']."' 
                            ORDER BY invl.invl_id, invl.invl_item_type ASC";
                
                        /*"SELECT    invl.invl_id,
                                        invl.invl_item_type,
                                        invl.invl_pro_id,
                                        invl.invl_qty,
                                        invl.invl_uprice,
                                        invl.invl_total
                            FROM `db_invl` invl
                                LEFT JOIN db_product prod ON prod.product_id = invl.invl_pro_id
                                LEFT JOIN db_category cat ON cat.category_id = prod.product_category
                            WHERE invl.invl_invoice_id = '".$row['invoice_no']."' 
                            ORDER BY invl.invl_id, invl.invl_item_type ASC";*/
                $dquery = mysql_query($detailSql);
                $c = 0;
                while($drow = mysql_fetch_array($dquery)){ 
                    $c = 1-$c;
                    $color = ($c==0)?"FFFFFF":"FCF3B7";
        ?>   
            <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>" style="background-color:#<?php echo $color; ?>;">
                <td style="width:30px;padding-left:5px"></td>
                <td style="width:100px;padding-left:5px"><?php echo $drow['invl_item_type'];?></td>       
                <td style="width:100px;padding-left:5px"><?php echo $drow['category_desc'];?></td>
                <td colspan="2" style="width:300px;padding-left:5px"><?php echo $drow['product_name'];?></td>                        
                <td style="width:80px;padding-left:5px"><?php echo $drow['invl_qty'];?></td>
                <td style="width:80px;padding-left:5px"><?php echo $drow['invl_uprice'];?></td>
                <td style="width:80px;padding-left:5px"><?php echo $drow['invl_total'];?></td>
            </tr>
        <?php       
                }             
            }
        ?>
            <tr id = 'detail_last_tr'></tr>
        </tbody>
    </table>
    <input type = 'hidden' id = 'total_line' name = 'total_line' value = '<?php echo $line;?>'/>
    <?php    
    }
}
