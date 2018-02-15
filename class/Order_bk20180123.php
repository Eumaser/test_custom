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
class Order {

    public function Order(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function createOrder(){
        //if($this->document_type != 'PO'){
            if($this->order_rev != 1){
                $this->order_no = get_prefix_value($this->document_code,true,$this->order_date,$subprefix);
            }
        //}
        
        if($_SESSION['empl_type'] == 'SUBCON'){
            $this->order_subcon = $_SESSION['empl_id'];
            $order_salesperson_prefix = "SUBCON";
        }else{
            $order_salesperson_prefix = "EMPLOYEE";
        }
        $table_field = array('order_no','order_date','order_customer','order_salesperson',
                             'order_billaddress','order_attentionto','order_shipterm','order_term',
                             'order_shipaddress','order_customerref','order_remark','order_customerpo',
                             'order_currency','order_currencyrate','order_status','order_prefix_type',
                             'order_generate_from','order_generate_from_type',
                             'order_outlet','order_revtimes','order_revdatetime','order_revby','order_shipping_id',
                             'order_attentionto_phone','order_fax','order_subcon',
                             'order_project_id','order_delivery_date',
                             'order_job_no','order_requestby','order_agc_requestby',
                             'order_approvedby','order_verifiedby','order_regards',
                             'order_type','order_void_remarks','order_salesperson_prefix',
                             'order_paymentterm_id','order_delivery_id','order_price_id','order_validity_id',
                             'order_transittime_id','order_freightcharge_id','order_pointofdelivery_id','order_prefix_id',
                             'order_remarks_id','order_country_id','order_attentionto_email','order_attentionto_name',
                             'order_tnc','order_notes');
        $table_value = array($this->order_no,format_date_database($this->order_date),$this->order_customer,$this->order_salesperson,
                             $this->order_billaddress,$this->order_attentionto,$this->order_shipterm,$this->order_term,
                             $this->order_shipaddress,$this->order_customerref,$this->order_remark,$this->order_customerpo,
                             $this->order_currency,$this->order_currencyrate,1,$this->document_type,
                             $this->order_generate_from,$this->order_generate_from_type,
                             $_SESSION['empl_outlet'],$this->order_revtimes,$this->order_revdatetime,$this->order_revby,$this->order_shipping_id,
                             $this->order_attentionto_phone,$this->order_fax,$this->order_subcon,
                             $this->order_project_id,format_date_database($this->order_delivery_date),
                             $this->order_job_no,$this->order_requestby,$this->order_agc_requestby,
                             $this->order_approvedby,$this->order_verifiedby,$this->order_regards,
                             $this->order_type,$this->order_void_remarks,$order_salesperson_prefix,
                             $this->order_paymentterm_id, $this->order_delivery_id,$this->order_price_id,$this->order_validity_id,
                             $this->order_transittime_id, $this->order_freightcharge_id,$this->order_pointofdelivery_id,$this->order_prefix_id,
                             $this->order_remarks_id,$this->order_country_id,$this->order_attentionto_email,$this->order_attentionto_name,
                             $this->order_term_remark,$this->order_notes);
        $remark = "Insert $this->document_code.<br> Document No : $this->order_no";
        if(!$this->save->SaveData($table_field,$table_value,'db_order','order_id',$remark)){
           return false;
        }else{
           $this->order_id = $this->save->lastInsert_id;
           $this->saveAttachment($this->order_id,$this->order_attachment);
           return true;
        }
    }
    public function updateOrder(){
        
        if($_SESSION['empl_type'] == 'SUBCON'){
            $this->order_subcon = $_SESSION['empl_id'];
        }
        if($this->document_type == 'SO'){
            $table_field = array('order_shipaddress','order_shipping_id');
            $table_value = array($this->order_shipaddress,$this->order_shipping_id);
        }else{
            if($this->old_order_status == 1){
                $table_field = array('order_date','order_customer','order_salesperson',
                                     'order_billaddress','order_attentionto','order_shipterm','order_term',
                                     'order_shipaddress','order_customerref','order_remark','order_customerpo',
                                     'order_currency','order_currencyrate','order_status',
                                     'order_shipping_id','order_attentionto_phone',
                                     'order_fax','order_subcon',
                                     'order_project_id','order_delivery_date',
                                     'order_job_no','order_requestby','order_agc_requestby',
                                     'order_approvedby','order_verifiedby','order_regards',
                                     'order_type','order_void_remarks','order_salesperson_prefix',
                                     'order_paymentterm_id','order_delivery_id','order_price_id','order_validity_id',
                                     'order_transittime_id','order_freightcharge_id','order_pointofdelivery_id','order_prefix_id',
                                     'order_remarks_id','order_country_id','order_attentionto_email','order_attentionto_name',
                                     'order_tnc','order_notes');
                $table_value = array(format_date_database($this->order_date),$this->order_customer,$this->order_salesperson,
                                     $this->order_billaddress,$this->order_attentionto,$this->order_shipterm,$this->order_term,
                                     $this->order_shipaddress,$this->order_customerref,$this->order_remark,$this->order_customerpo,
                                     $this->order_currency,$this->order_currencyrate,$this->order_status,
                                     $this->order_shipping_id,$this->order_attentionto_phone,
                                     $this->order_fax,$this->order_subcon,
                                     $this->order_project_id,format_date_database($this->order_delivery_date),
                                     $this->order_job_no,$this->order_requestby,$this->order_agc_requestby,
                                     $this->order_approvedby,$this->order_verifiedby,$this->order_regards,
                                     $this->order_type,$this->order_void_remarks,$this->order_salesperson_prefix,
                                     $this->order_paymentterm_id, $this->order_delivery_id,$this->order_price_id,$this->order_validity_id,
                                     $this->order_transittime_id, $this->order_freightcharge_id,$this->order_pointofdelivery_id,$this->order_prefix_id,
                                     $this->order_remarks_id,$this->order_country_id,$this->order_attentionto_email,$this->order_attentionto_name,
                                     $this->order_term_remark,$this->order_notes);
           }else{
                $table_field = array('order_status');
                $table_value = array($this->order_status);
           }
        }
        $remark = "Update $this->document_code.<br> Document No : $this->order_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_order','order_id',$remark,$this->order_id)){
           return false;
        }else{
           $this->saveAttachment($this->order_id,$this->order_attachment);
           return true;
        }
    }
    public function updateOrderTotal(){
        
        $subtotal = (($this->order_subtotal - $this->order_disctotal) - $this->order_discheadertotal);
        $gst = round($subtotal * (system_gst_percent/100),2);
        $this->order_grandtotal = $subtotal + $gst;
        
        $table_field = array('order_subtotal','order_disctotal','order_taxtotal','order_grandtotal','order_discheadertotal');
        $table_value = array($this->order_subtotal,$this->order_disctotal,$gst,$this->order_grandtotal,$this->order_discheadertotal);
        $this->fetchOrderDetail(" AND order_id = '$this->order_id'","","",1);
        $remark = "Update $this->document_code.<br> Document No : $this->order_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_order','order_id',$remark,$this->order_id)){
           return false;
        }else{
           return true;
        }
    }
    public function createOrderLine(){

        $table_field = array('ordl_order_id','ordl_pro_id','ordl_pro_desc','ordl_qty','ordl_uom',
                             'ordl_uprice','ordl_disc','ordl_istax','ordl_taxamt','ordl_total',
                             'ordl_pro_no','ordl_discamt','ordl_seqno','ordl_parent','ordl_fuprice',
                             'ordl_ftotal','ordl_fdiscamt','ordl_ftaxamt','ordl_pro_remark','ordl_pfuprice',
                             'ordl_delivery_date','ordl_item_type','ordl_product_location');
        $table_value = array($this->order_id,$this->ordl_pro_id,$this->ordl_pro_desc,$this->ordl_qty,$this->ordl_uom,
                             $this->ordl_fuprice,$this->ordl_disc,$this->ordl_istax,$this->ordl_taxamt,$this->ordl_total,
                             $this->ordl_pro_no,$this->ordl_discamt,$this->ordl_seqno,$this->ordl_parent,$this->ordl_fuprice,
                             $this->ordl_ftotal,$this->ordl_fdiscamt,$this->ordl_ftaxamt,$this->ordl_pro_remark,$this->ordl_pfuprice,
                             format_date_database($this->ordl_delivery_date),$this->ordl_pro_type,$this->ordl_product_location);
        $this->fetchOrderDetail(" AND order_id = '$this->order_id'","","",1);
        $remark = "Insert $this->document_code Line.<br> Document No : $this->order_no";
        if(!$this->save->SaveData($table_field,$table_value,'db_ordl','ordl_id',$remark)){
           return false;
        }else{
           $this->ordl_id = $this->save->lastInsert_id;
           if($this->document_type == 'PU'){
               if(!$this->generateStockTransaction($this->ordl_id,'out')){
                   return false;
               }
               else{
                   return true;
               }
           }else if($this->document_type == 'GRN'){
               if(!$this->generateStockTransaction($this->ordl_id,'in')){
                   return false;
               }
               else{
                   return true;
               }
           }else{
               return true;
           } 
        }
    }
    public function updateOrderLine(){
        
        $table_field = array('ordl_order_id','ordl_pro_id','ordl_pro_desc','ordl_qty','ordl_uom',
                             'ordl_uprice','ordl_disc','ordl_istax','ordl_taxamt','ordl_total',
                             'ordl_pro_no','ordl_discamt','ordl_seqno','ordl_fuprice','ordl_pfuprice',
                             'ordl_ftotal','ordl_fdiscamt','ordl_ftaxamt','ordl_pro_remark',
                             'ordl_delivery_date','ordl_item_type','ordl_product_location');
        $table_value = array($this->order_id,$this->ordl_pro_id,$this->ordl_pro_desc,$this->ordl_qty,$this->ordl_uom,
                             $this->ordl_uprice,$this->ordl_disc,$this->ordl_istax,$this->ordl_taxamt,$this->ordl_total,
                             $this->ordl_pro_no,$this->ordl_discamt,$this->ordl_seqno,$this->ordl_fuprice,$this->ordl_pfuprice,
                             $this->ordl_ftotal,$this->ordl_fdiscamt,$this->ordl_ftaxamt,$this->ordl_pro_remark,
                             format_date_database($this->ordl_delivery_date),$this->ordl_pro_type,$this->ordl_product_location);
        $this->fetchOrderDetail(" AND order_id = '$this->order_id'","","",1);
        $remark = "Update $this->document_code Line.<br> Document No : $this->order_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_ordl','ordl_id',$remark,$this->ordl_id)){
           return false;
        }else{
           if($this->document_type == 'PU'){
               if(!$this->updateStockTransaction($this->ordl_id,'out')){
                   return false;
               }
               else{
                   return true;
               }
           }else if($this->document_type == 'GRN'){
               if(!$this->updateStockTransaction($this->ordl_id,'in')){
                   return false;
               }
               else{
                   return true;
               }
           }else{
               return true;
           } 
        }
    }
    public function calculateLineAmount(){

        if($this->order_currencyrate <= 0){
            $this->order_currencyrate = 1;
        }
        
        //foreign amount
        $subtotal = $this->ordl_qty * $this->ordl_fuprice;

        
        if($this->ordl_disc > 0){
            $this->ordl_fdiscamt = ROUND($subtotal * ($this->ordl_disc/100),2);
            $this->ordl_discamt = ROUND($this->ordl_fdiscamt * $this->order_currencyrate,2);
        }else{
            $this->ordl_discamt = 0;
        }
      
        $subtotal_afterdiscount = $subtotal - $this->ordl_fdiscamt; 

//        if($this->ordl_istax > 0){
//            $this->ordl_ftaxamt = ROUND($subtotal_afterdiscount * (system_gst_percent/100),2);
//            $this->ordl_taxamt = ROUND($this->ordl_ftaxamt * $this->order_currencyrate,2);
//        }else{
//            $this->ordl_taxamt = 0;
//        }
        $this->ordl_taxamt = 0;
        $this->ordl_ftaxamt = 0;
        $this->ordl_ftotal = $subtotal_afterdiscount + $this->ordl_ftaxamt;

        //base amount      
        $this->ordl_total = ROUND($this->ordl_ftotal * $this->order_currencyrate,2);
    }
    public function getTotalDiscAmt(){
        $sql = "SELECT SUM(ROUND(ol.ordl_discamt,2)) as discamt 
                FROM db_ordl ol
                INNER JOIN db_order o ON o.order_id = ol.ordl_order_id
                WHERE ol.ordl_order_id = '$this->order_id'";
        $query = mysql_query($sql);
        if($row = mysql_fetch_array($query)){
            $total_discamt = $row['discamt'];
        }else{
            $total_discamt = 0;
        }
        return $total_discamt;
    }
    public function getSubTotalAmt(){
        $sql = "SELECT SUM(ordl_fuprice*ordl_qty) as subtotal
                FROM db_ordl ol
                INNER JOIN db_order o ON o.order_id = ol.ordl_order_id
                WHERE ol.ordl_order_id = '$this->order_id'";
        $query = mysql_query($sql);
        if($row = mysql_fetch_array($query)){
            $total_subtotal = $row['subtotal'];
        }else{
            $total_subtotal = 0;
        }
        return $total_subtotal;
    }
    public function getTotalGstAmt(){
        $sql = "SELECT SUM(ol.ordl_taxamt) as taxamt 
                FROM db_ordl ol
                INNER JOIN db_order o ON o.order_id = ol.ordl_order_id
                WHERE ol.ordl_order_id = '$this->order_id'";
        $query = mysql_query($sql);
        if($row = mysql_fetch_array($query)){
            $total_taxamt = $row['taxamt'];
        }else{
            $total_taxamt = 0;
        }
        return $total_taxamt;
    }
    public function fetchOrderDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT o.*,de.delivery_desc as delivery_desc, 
                            co.country_desc as country_desc,
                            fr.freightcharge_desc as freightcharge_desc,
                            pd.pointofdelivery_desc as pointofdelivery_desc,
                            pf.prefix_desc as prefix_desc,
                            pr.price_desc as price_desc,
                            rm.remarks_desc as remarks_desc,
                            tt.transittime_desc as transittime_desc,
                            va.validity_desc as validity_desc,
                            pt.paymentterm_desc as paymentterm_desc
                FROM db_order o 
                LEFT JOIN db_paymentterm pt ON pt.paymentterm_id = o.order_paymentterm_id
                    LEFT JOIN db_delivery de ON de.delivery_id = o.order_delivery_id
                    LEFT JOIN db_price pr ON pr.price_id = o.order_price_id
                    LEFT JOIN db_validity va ON va.validity_id = o.order_validity_id
                    LEFT JOIN db_transittime tt ON tt.transittime_id = o.order_transittime_id
                    LEFT JOIN db_freightcharge fr ON fr.freightcharge_id = o.order_freightcharge_id
                    LEFT JOIN db_pointofdelivery pd ON pd.pointofdelivery_id = o.order_pointofdelivery_id
                    LEFT JOIN db_prefix pf ON pf.prefix_id = o.order_prefix_id
                    LEFT JOIN db_remarks rm ON rm.remarks_id = o.order_remarks_id
                    LEFT JOIN db_countryitem co ON co.country_id = o.order_country_id
                WHERE o.order_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type ==1){
            $row = mysql_fetch_array($query);

            $this->order_id = $row['order_id'];
            $this->order_no = $row['order_no'];
            $this->order_date = $row['order_date'];
            $this->order_customer = $row['order_customer'];
            $this->order_cust_acc_code = getDataCodeBySql("partner_account_code","db_partner"," WHERE partner_id = '$this->order_customer'","");
            $this->order_salesperson = $row['order_salesperson'];
            $this->order_salesperson_name = getDataCodeBySql("partner_name","db_partner"," WHERE partner_id = '$this->order_salesperson'","");
            $this->order_billaddress = $row['order_billaddress'];
            $this->order_attentionto = $row['order_attentionto'];
            $this->order_shipterm = $row['order_shipterm'];
            $this->order_term = $row['order_term'];
            $this->order_shipaddress = $row['order_shipaddress'];
            $this->order_customerref = $row['order_customerref'];
            $this->order_remark = $row['order_remark'];
            $this->order_customerpo = $row['order_customerpo'];
            $this->order_currency = $row['order_currency'];
            $this->order_currency_org = $row['order_currency'];
            $this->order_currency_code = getDataCodeBySql("currency_code","db_currency"," WHERE currency_id = '$this->order_currency'","");
            $this->order_currencyrate = $row['order_currencyrate'];
            $this->order_status = $row['order_status'];
            $this->order_subtotal = $row['order_subtotal'];
            $this->order_disctotal = $row['order_disctotal'];
            $this->order_taxtotal = $row['order_taxtotal'];
            $this->order_grandtotal = $row['order_grandtotal'];
            $this->order_revtimes = $row['order_revtimes'];
            $this->order_revdatetime = $row['order_revdatetime'];
            $this->order_revby = $row['order_revby'];
            $this->order_shipping_id = $row['order_shipping_id'];
            $this->order_attentionto_phone = $row['order_attentionto_phone'];
            $this->order_fax = $row['order_fax'];
            $this->order_notes = $row['order_notes'];
            $this->order_subcon = $row['order_subcon'];
            $this->order_project_id = $row['order_project_id'];
            $this->order_delivery_date = $row['order_delivery_date'];
            $this->order_job_no = $row['order_job_no'];
            $this->order_requestby = $row['order_requestby'];
            $this->order_agc_requestby = $row['order_agc_requestby'];
            $this->order_approvedby = $row['order_approvedby'];
            $this->order_verifiedby = $row['order_verifiedby'];
            $this->order_regards = $row['order_regards'];
            $this->order_type = $row['order_type'];
            $this->order_void_remarks = $row['order_void_remarks'];
            $this->order_salesperson_prefix = $row['order_salesperson_prefix'];    
            $this->order_discheadertotal = $row['order_discheadertotal'];
            //$this->order_paymentterm_remark = $row['order_paymentterm_remark'];
            
            $this->order_paymentterm_id = $row['order_paymentterm_id'];
            $this->order_delivery_id = $row['order_delivery_id'];
            $this->order_price_id = $row['order_price_id'];
            $this->order_validity_id = $row['order_validity_id'];
            $this->order_transittime_id = $row['order_transittime_id'];
            $this->order_freightcharge_id = $row['order_freightcharge_id'];
            $this->order_pointofdelivery_id = $row['order_pointofdelivery_id'];
            $this->order_prefix_id = $row['order_prefix_id'];
            $this->order_remarks_id = $row['order_remarks_id'];
            $this->order_country_id = $row['order_country_id'];
            $this->order_delivery_remark = html_entity_decode($row['delivery_desc']);
            $this->order_country_remark = html_entity_decode($row['country_desc']);
            $this->order_freightcharge_remark = html_entity_decode($row['freightcharge_desc']);
            $this->order_pointofdelivery_remark = html_entity_decode($row['pointofdelivery_desc']);
            $this->order_prefix_remark = html_entity_decode($row['prefix_desc']);
            $this->order_price_remark = html_entity_decode($row['price_desc']);
            $this->order_remarks_remark = html_entity_decode($row['remarks_desc']);
            $this->order_transittime_remark = html_entity_decode($row['transittime_desc']);
            $this->order_validity_remark = html_entity_decode($row['validity_desc']);
            $this->order_paymentterm_remark = html_entity_decode($row['paymentterm_desc']);
            $this->order_attentionto_name = $row['order_attentionto_name'];
            $this->order_attentionto_email = $row['order_attentionto_email'];
            $this->order_term_remark = $row['order_tnc'];
            $this->order_prefix_type = $row['order_prefix_type'];
            $this->order_generate_from = $row['order_generate_from'];
            $this->order_generate_from_type = $row['order_generate_from_type'];
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function fetchOrderLineDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_ordl WHERE ordl_id > 0 AND ordl_order_id = '$this->order_id' $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);

            $this->ordl_id = $row['ordl_id'];
            $this->ordl_pro_no = $row['ordl_pro_no'];
            $this->ordl_pro_id = $row['ordl_pro_id'];
            $this->ordl_pro_desc = html_entity_decode($row['ordl_pro_desc']);
            $this->ordl_qty = $row['ordl_qty'];
            $this->ordl_uom = $row['ordl_uom'];
            $this->ordl_uprice = $row['ordl_uprice'];
            $this->ordl_disc = $row['ordl_disc'];
            $this->ordl_discamt = $row['ordl_discamt'];
            $this->ordl_istax = $row['ordl_istax'];
            $this->ordl_taxamt = $row['ordl_taxamt'];
            $this->ordl_total = $row['ordl_total'];
            $this->ordl_seqno = $row['ordl_seqno'];
            $this->ordl_product_location = $row['ordl_product_location'];
            // Added by Ivan
            $this->ordl_item_type = $row['ordl_item_type'];
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function fetchDeliveryDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_delivery WHERE delivery_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type ==1){
            $row = mysql_fetch_array($query);
            $this->delivery_id = $row['delivery_id'];
            $this->delivery_code = $row['delivery_code'];
            $this->delivery_desc = html_entity_decode($row['delivery_desc']);
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function fetchPriceDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_price WHERE price_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type ==1){
            $row = mysql_fetch_array($query);
            $this->price_id = $row['price_id'];
            $this->price_code = $row['price_code'];
            $this->price_desc = html_entity_decode($row['price_desc']);
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function fetchPaymenttermDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_paymentterm WHERE paymentterm_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type ==1){
            $row = mysql_fetch_array($query);
            $this->paymentterm_id = $row['paymentterm_id'];
            $this->paymentterm_code = $row['paymentterm_code'];
            $this->paymentterm_desc = html_entity_decode($row['paymentterm_desc']);
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function fetchValidityDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_validity WHERE validity_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type ==1){
            $row = mysql_fetch_array($query);
            $this->validity_id = $row['validity_id'];
            $this->validity_code = $row['validity_code'];
            $this->validity_desc = html_entity_decode($row['validity_desc']);
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function fetchTransittimeDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_transittime WHERE transittime_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type ==1){
            $row = mysql_fetch_array($query);
            $this->transittime_id = $row['transittime_id'];
            $this->transittime_code = $row['transittime_code'];
            $this->transittime_desc = html_entity_decode($row['transittime_desc']);
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function fetchFreightchargeDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_freightcharge WHERE freightcharge_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type ==1){
            $row = mysql_fetch_array($query);
            $this->freightcharge_id = $row['freightcharge_id'];
            $this->freightcharge_code = $row['freightcharge_code'];
            $this->freightcharge_desc = html_entity_decode($row['freightcharge_desc']);
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function fetchPointofdeliveryDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_pointofdelivery WHERE pointofdelivery_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type ==1){
            $row = mysql_fetch_array($query);
            $this->pointofdelivery_id = $row['pointofdelivery_id'];
            $this->pointofdelivery_code = $row['pointofdelivery_code'];
            $this->pointofdelivery_desc = html_entity_decode($row['pointofdelivery_desc']);
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function fetchPrefixDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_prefix WHERE prefix_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type ==1){
            $row = mysql_fetch_array($query);
            $this->prefix_id = $row['prefix_id'];
            $this->prefix_code = $row['prefix_code'];
            $this->prefix_desc = html_entity_decode($row['prefix_desc']);
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function fetchRemarksDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_remarks WHERE remarks_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type ==1){
            $row = mysql_fetch_array($query);
            $this->prefix_id = $row['remarks_id'];
            $this->remarks_code = $row['remarks_code'];
            $this->remarks_desc = html_entity_decode($row['remarks_desc']);
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function fetchCountryJDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_countryitem WHERE country_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type ==1){
            $row = mysql_fetch_array($query);
            $this->country_id = $row['country_id'];
            $this->country_code = $row['country_code'];
            $this->country_desc = html_entity_decode($row['country_desc']);
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }
    public function fetchOrderLine2Detail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT ol.*,o.order_customer,o.order_no,p.product_cost_price "
                . " FROM db_ordl ol "
                . " LEFT JOIN db_order o ON o.order_id = ol.ordl_order_id "
                . " LEFT JOIN db_product p ON p.product_id = ol.ordl_pro_id "
                . " WHERE ol.ordl_id > 0 $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);

            $this->ordl_id              = $row['ordl_id'];
            $this->ordl_order_id        = $row['ordl_order_id'];
            $this->ordl_item_type        = $row['ordl_item_type'];
            $this->ordl_pro_id          = $row['ordl_pro_id'];
            $this->ordl_qty             = $row['ordl_qty'];
            $this->ordl_uom             = $row['ordl_uom'];
            $this->product_cost_price   = $row['product_cost_price'];
            $this->order_customer       = $row['order_customer'];
            $this->order_no             = $row['order_no'];
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
    public function deleteOrderLine(){
        if($this->save->DeleteData("db_ordl"," WHERE ordl_order_id = '$this->order_id' AND ordl_id = '$this->ordl_id'","Delete $this->document_code Order Line.")){
            return true;
        }else{
            return false;
        }
    }
    public function getInputForm($action){
        global $mandatory,$language,$lang,$quotation_tnc,$progressclaim_tnc;
        include_once 'Project.php';
        $p = new Project();
        if($action == 'create'){
            $this->order_status = 1;
            $this->order_date = system_date;
            $this->order_delivery_date = system_date;
            $this->order_no = get_prefix_value($this->document_code,false,$this->order_date);
            $this->order_salesperson = $_SESSION['empl_id'];
            $this->order_currency = $_SESSION['empl_currency_id'];
            $this->order_currency_org = $_SESSION['empl_currency_id'];
            if($_SESSION['empl_type'] == 'SUBCON'){
                $this->subconCrtl = $this->select->getCustomerSelectCtrl($_SESSION['empl_id'],'N'," AND partner_id = '{$_SESSION['empl_id']}'");
            }
            /*
            if($this->document_type == 'SO'){             
                $this->order_term_remark = $progressclaim_tnc;
            }else{
                $this->order_term_remark = $quotation_tnc;
            }
            */
        }else{
            if($this->document_type == 'QT'){
                $wherestring = " ot.order_id = '$this->order_id'";
            }else if($this->document_type == 'SO'){
                $wherestring = " os.order_id = '$this->order_id'";
            }else if($this->document_type == 'DO'){
                $wherestring = " od.order_id = '$this->order_id'";
            }else if($this->document_type == 'PO'){
                $wherestring = " op.order_id = '$this->order_id'";
            }
            $this->generated = $this->getGeneratedSql($wherestring);
        
        /*
         * find project detail for filter subcon
         */
        $p->project_id = $this->order_project_id;
        $r = $p->getProjectDetailTransaction();    
        $b = explode(',',$r['project_subcon']);
        for($i=0;$i<sizeof($b);$i++){
            $project_subcon .= "'" . $b[$i] . "',";
        }
        $project_subcon = trim($project_subcon,",");
        $subcon_wherestring = " AND partner_issubcon = 1 AND partner_id IN ($project_subcon)";
        $this->subconCrtl = $this->select->getCustomerSelectCtrl($this->order_subcon,'Y',$subcon_wherestring);
        }
        $this->order_currency_code = "SGD";

        if(($this->document_type == 'PRF') && ($_SESSION['empl_type'] == 'SUBCON')){
            $this->projectCrtl = $this->select->getProjectSelectCtrl($this->order_project_id,'Y'," AND project_site_coordinator LIKE '%{$_SESSION['empl_id']}%'");
        }else{
            $this->projectCrtl = $this->select->getProjectSelectCtrl($this->order_project_id,'Y');
        }
        if($_SESSION['empl_type'] == 'SUBCON'){
            $this->order_salesperson_name = $_SESSION['empl_name'];
            $this->order_salesperson = $_SESSION['empl_id'];
        }
        // Addedd by Ivan
        //if($this->document_type == 'QT') {
            $this->deliveryCrtl = $this->select->getDeliverySelectCtrl($this->order_delivery_id,'Y');
            $this->priceCrtl = $this->select->getPriceSelectCtrl($this->order_price_id,'Y');
            $this->paymenttermCrtl = $this->select->getPaymenttermSelectCtrl($this->order_paymentterm_id,'Y');
            $this->validityCrtl = $this->select->getValiditySelectCtrl($this->order_validity_id,'Y');
            $this->transittimeCrtl = $this->select->getTransittimeSelectCtrl($this->order_transittime_id,'Y');
            $this->freightchargeCrtl = $this->select->getFreightchargeSelectCtrl($this->order_freightcharge_id,'Y');
            $this->pointofdeliveryCrtl = $this->select->getPointofdeliverySelectCtrl($this->order_pointofdelivery_id,'Y');
            $this->prefixCrtl = $this->select->getPrefixSelectCtrl($this->order_prefix_id,'Y');
            $this->remarksCrtl = $this->select->getRemarksSelectCtrl($this->order_remarks_id,'Y');
            $this->countryCrtl = $this->select->getCountryItemSelectCtrl($this->order_country_id,'Y');
       // }
        //if(($this->document_type == 'PRF') || ($this->document_type == 'GRN') || ($this->document_type == 'PRF')){
        if($this->document_type == 'PO' || ($this->document_type == 'GRN')){
            $cust_wherestring = " AND partner_issupplier = 1";
            $empl_wherestring = " AND empl_group IN ('3')";
        }else{
            $cust_wherestring = " AND partner_iscustomer = 1 ";
            $empl_wherestring = " AND empl_group IN ('1')";
            if($_SESSION['empl_group'] >= 1){
               $cust_wherestring .= " AND partner_outlet = '{$_SESSION['empl_outlet']}'"; 
            }
        }
        $this->employeeCrtl = $this->select->getEmployeeSelectCtrl($this->order_salesperson,'Y'); //$empl_wherestring
        $this->requestbyCrtl = $this->select->getEmployeeSelectCtrl($this->order_requestby,'Y',$empl_wherestring);
        $this->agcrequestbyCrtl = $this->select->getEmployeeSelectCtrl($this->order_agc_requestby,'Y',$empl_wherestring);
        $this->shippingCrtl = $this->select->getShippingAddressSelectCtrl($this->order_shipping_id,'Y'," AND shipping_partner_id = '$this->order_customer'" );
        $this->customerCrtl = $this->select->getCustomerSelectCtrl($this->order_customer,'Y',$cust_wherestring);
        $this->supplierCrtl = $this->select->getCustomerSelectCtrl($this->order_customer,'Y',$cust_wherestring);
        $this->currencyCrtl = $this->select->getCurrencySelectCtrl($this->order_currency,'Y');
        $this->shiptermCrtl = $this->select->getShipTermSelectCtrl($this->order_shipterm,'N');

        $this->contactCrtl = $this->select->getContactSelectCtrl($this->order_attentionto,'Y'," AND contact_partner_id = '$this->order_customer'");
        
         
        $this->uomCrtl = $this->select->getUomSelectCtrl("",'N');
        $this->prodCrtl = $this->select->getProductNameSelectCtrl("",'Y');

        $label_col_sm = "col-sm-2";
        $field_col_sm = "col-sm-3";
        
        if($this->order_status != 1){
           $disabled = " DISABLED"; 
        }
        if(($this->generated['so_id'] > 0) && ($this->document_type == 'QT')){
            $disabled = " DISABLED"; 
            $isgenerated = 1;
        }
        if($this->document_type == 'QT'){
            $isgenerated = getDataCountBySql("db_invoice"," WHERE invoice_generate_from = '$this->order_id' AND invoice_generate_from_type = '$this->document_type' AND invoice_status = 1 AND invoice_generate_from > 0");
        }else if($this->document_type == 'PO'){
            $isgenerated = getDataCountBySql("db_invoice"," WHERE invoice_generate_from = '$this->order_id' AND invoice_generate_from_type = '$this->document_type' AND invoice_status = 1 AND invoice_generate_from > 0");
        }else if($this->document_type == 'DO'){
            $isgenerated = getDataCountBySql("db_order"," WHERE order_generate_from = '$this->order_id' AND order_generate_from_type = '$this->document_type' AND order_status = 1 AND order_generate_from > 0");
        }

        if($isgenerated > 0){
            $disabled = " DISABLED"; 
        }
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
                <button type = "button" class="btn btn-primary pull-right" style = '' onclick = "window.location.href='<?php echo $this->document_url;?>'">Back</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create') && ($this->order_id > 0)){?>
                <!--<button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='<?php echo $this->document_url;?>?action=createForm'">Create New</button>-->
                <?php }?>

                <h3 class="box-title"><?php if($this->order_id > 0){ echo "Update " . $this->document_code;}else{ echo "Create New " . $this->document_code;}?></h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create') && ($this->order_id > 0) && ($this->document_type == 'QT')){?>
                <!--<button type = "button" class="btn btn-primary pull-right" style = 'margin-right:10px;' onclick = "duplicateDocument('<?php echo $this->order_id?>')">Template</button>-->
                <?php }?>
              </div>
                
                <form id = 'order_form' class="form-horizontal" action = '<?php echo $this->document_url;?>?action=create' method = "POST" enctype="multipart/form-data">
                  <div class="box-body col-sm-9">
                      <!-- Customer don have multi currency , so we hide it.-->
                      <input type = 'hidden' id="order_currency" name="order_currency" value = '<?php echo $this->order_currency_org;?>'/>
                      <input type="hidden" class="form-control" id="order_currencyrate" name="order_currencyrate" value = "<?php echo $this->order_currencyrate;?>" placeholder="Currency Rate" READONLY>
                        <?php 
                        
                        switch ($this->document_type) {
                            case "PRF":
                            case "GRN":
                            case "PO":
                            case "DO":
                            case "PI":  
                                $this->getPRFForm($label_col_sm,$field_col_sm,$disabled);
                                break;
                            case "PU":
                                $this->getPickupForm($label_col_sm,$field_col_sm,$disabled);
                                break;
                            default:
//                                $this->getPRFForm($label_col_sm,$field_col_sm,$disabled);
                                $this->getOrderForm($label_col_sm,$field_col_sm,$disabled);
                                break;
                        }
                        ?>
                        
                  </div><!-- /.box-body -->
                  <div class="box-body col-sm-3"  >
                    <?php if($_SESSION['empl_type'] != 'SUBCON'){?>  
                    <div class="form-group" style = '<?php if($this->document_type == 'PRF' || $this->document_type == 'PU'){ echo 'display:none'; }?>'>
                        <label for="order_subtotal" class="col-sm-5 control-label">Total (<span class = 'base_currency_span'><?php echo $this->order_currency_code;?></span>)</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control text-align-right" id="order_subtotal" name="order_subtotal" value = "<?php echo num_format($this->order_subtotal - $this->order_disctotal);?>" disabled>
                        </div>
                    </div> 
                    <div class="form-group" style = '<?php if($this->document_type == 'PRF' || $this->document_type == 'PU'){ echo 'display:none'; }?>'>
                        <label for="order_discheadertotal" class="col-sm-5 control-label">Disc (<span class = 'base_currency_span'><?php echo $this->order_currency_code;?></span>)</label>
                        <div class="col-sm-7">
                              <input type="text" class="form-control text-align-right " id="order_discheadertotal" name="order_discheadertotal" value = "<?php echo num_format($this->order_discheadertotal);?>" <?php echo $disabled;?> >
                        </div>
                    </div>
                    <div class="form-group" style = '<?php if($this->document_type == 'PRF' || $this->document_type == 'PU'){ echo 'display:none'; }?>'>
                        <label for="" class="col-sm-5 control-label">Sub Total (<span class = 'base_currency_span'><?php echo $this->order_currency_code;?></span>)</label>
                        <div class="col-sm-7">
                              <input type="text" class="form-control text-align-right"  id = 'order_finalsubtotal' value = "<?php echo num_format($this->order_subtotal - $this->order_disctotal - $this->order_discheadertotal);?>" disabled>
                        </div>
                    </div>
                    <div class="form-group" style = '<?php if($this->document_type == 'PRF' || $this->document_type == 'PU'){ echo 'display:none'; }?>'>
                        <label for="order_taxtotal" class="col-sm-5 control-label">Tax Amount <?php echo system_gst_percent;?>%(<span class = 'base_currency_span'><?php echo $this->order_currency_code;?></span>)</label>
                        <div class="col-sm-7">
                              <input type="text" class="form-control text-align-right" id="order_taxtotal" name="order_taxtotal" value = "<?php echo num_format($this->order_taxtotal);?>" disabled>
                        </div>
                    </div>
                    <div class="form-group" style = '<?php if($this->document_type == 'PRF' || $this->document_type == 'PU'){ echo 'display:none'; }?>'>
                        <label for="order_grandtotal" class="col-sm-5 control-label">Grand Total (<span class = 'base_currency_span'><?php echo $this->order_currency_code;?></span>)</label>
                        <div class="col-sm-7">
                              <input type="text" class="form-control text-align-right" id="order_grandtotal" name="order_grandtotal" value = "<?php echo num_format($this->order_grandtotal);?>" disabled>
                        </div>
                    </div>
                    <?php }?>
                    <?php if($this->document_type == 'QT'){?>
                    <div class="form-group">
                        <label for="order_rev" class="col-sm-5 control-label">Revision</label>
                        <div class="col-sm-7">
                              <input type="checkbox"  id="order_rev" name="order_rev" value = "1" >
                        </div>
                    </div>
                    <?php }?>  
                    <?php 
                    if($_SESSION['empl_type'] == 'SUBCON'){
                    ?>
                      <input type = "hidden" value = "1" name = "order_status"/>
                    <?php }else if($this->document_type != 'PU'){?>  
                    <div class="form-group">
                        <label for="order_status" class="col-sm-5 control-label">Status </label>
                        <div class="col-sm-7">
                            <select class="form-control " name = 'order_status' id = 'order_status' >
                                <?php if($this->document_type == 'QT'){?>
                                <option value = '2' <?php if($this->order_status == '2'){ echo 'SELECTED';}?>>Award</option>
                                <option value = '-1' <?php if($this->order_status == '-1'){ echo 'SELECTED';}?>>Reject</option>
                                <option value = '-3' <?php if($this->order_status == '-3'){ echo 'SELECTED';}?>>Void</option>
                                <option value = '1' <?php if($this->order_status == '1'){ echo 'SELECTED';}?>>Pending</option>
                                <?php }else{?>
                                <option value = '1' <?php if($this->order_status == '1'){ echo 'SELECTED';}?>>Pending</option>
                                <option value = '3' <?php if($this->order_status == '3'){ echo 'SELECTED';}?>>Close</option>
                                <?php }?>
                                
                            </select>
                        </div>
                    </div>
                    <?php }?>
                  </div>
                    <div class="form-group" style = '<?php if(($this->order_status == '-3') || ($this->order_status == '3')){ }else{ echo 'display:none';}?>' id="order_void_remarks_div" >
                        <label for="order_void_remarks" class="<?php echo $label_col_sm;?> control-label">Remarks</label>
                        <div class="<?php echo $field_col_sm;?>">
                              <textarea  class="form-control" rows="3" id="order_void_remarks" name="order_void_remarks" placeholder="Remarks" <?php echo $disabled;?>><?php echo $this->order_void_remarks;?></textarea>
                        </div>
                    </div>
                  <div class="box-footer" style = 'clear:both'>
                    <!--<button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>-->
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->order_id;?>" name = "order_id"/>
                    <input type = "hidden" value = "<?php echo $this->order_status;?>" name = "old_order_status"/>
                    <?php
                    if($this->order_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                        if($this->order_status != -3){
                    ?>
                        <?php 
                            if($isgenerated != 1){

                        ?>
                        <button type = "submit" class="btn btn-info">Save</button>
                        <?php

                              }
                        }else{
                            
                            echo "<span style = 'color:red'>This quotation have be <b>Revision</b>.</span>";
                            $this->getRevQuotationOrderId($this->order_no);
                            echo " <span style = 'margin-left:30px;' >Click <a href = '$this->document_url?action=edit&order_id=$this->rev_neworder_id'><b>$this->rev_neworder_no (Rev $this->rev_neworder_revtimes)</b></a> to view the newest quotation.</span>";
                        }?>
                    <?php }?>
                 &nbsp;&nbsp;&nbsp;        
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'print') && ($this->order_id > 0) && (($this->order_status == 1) || ($this->order_status == 2))){?>
                 <?php if(($this->document_type == 'QT') || ($this->document_type == 'SO') || ($this->document_type == 'PO') || ($this->document_type == 'PRF') || ($this->document_type == 'DO') || ($this->document_type == 'PU' || ($this->document_type == 'GRN') )){?>
                <button type = "button" class="btn btn-primary"  onclick = "window.open('<?php echo $this->document_print_url;?>?action=<?php echo $this->document_type;?>&report_id=<?php echo $this->order_id;?>&format=1')">Print <?php if($this->document_type == 'QT'){ echo '1';}?></button>
                <?php 
                if($this->document_type == 'QT'){
                ?>&nbsp;&nbsp;&nbsp;   
                <!--<button type = "button" class="btn btn-primary"  onclick = "window.open('<?php echo $this->document2_print_url;?>?action=<?php echo $this->document_type;?>&report_id=<?php echo $this->order_id;?>&format=2')">Print 2</button>-->
                
                <?php }?>
                 <?php }
            
                    if($this->document_type == 'PRF'){
                    ?>      &nbsp;&nbsp;&nbsp;  
                        <button type = "button" class="btn btn-primary" id = "confirm_email" >Email</button>
                    <?php 
                    }
                 
                 ?>
                        
                <?php }?>
                
                    <?php if( ($_SESSION['empl_type'] == 'EMPLOYEE') && ($this->order_id > 0) && ($this->document_type == 'PO') && ($this->order_status == 1) ){?>
                    <!--<button type = 'button' class = "btn btn-primary pull-right generate_btn" title = "Generate Multiple PR to PO" generateto = "PO_multi">Generate From PR</button>-->
                    <?php }?>  
                   <?php 
                    if($isgenerated > 0 ){
                        echo "<span style = 'margin-left:30px;color:red' ><b>This $this->document_code transaction already generated.</b></span>";
                    }
                   ?>    
                  </div><!-- /.box-footer -->
                </form>
                
            </div><!-- /.box -->
            <?php if($this->order_id > 0){?>
            <div class="box box-success">
                <div class="nav-tabs-custom" style = 'margin-top:5px;'>
                    <ul class="nav nav-tabs">
                      <li <?php if($_REQUEST['tab'] == "" || $_REQUEST['tab'] == 'detail_tab'){ echo 'class="active"';}?>><a href="#detail_tab" data-toggle="tab">Detail</a></li>
                      
                      <?php
                      if($this->document_type == 'QT'){
                      ?>
                        <!--<li <?php if($_REQUEST['tab'] == 'sodo_order_tab'){ echo 'class="active"';}?>><a href="#sodo_order_tab" data-toggle="tab">Progress Claim</a></li>-->
                        <li <?php if($_REQUEST['tab'] == 'invoice_order_tab'){ echo 'class="active"';}?>><a href="#invoice_order_tab" data-toggle="tab">Sales Invoice</a></li>
                        <!--<li <?php if($_REQUEST['tab'] == 'sodo_order_tab'){ echo 'class="active"';}?>><a href="#sodo_order_tab" data-toggle="tab">Purchase Order</a></li>-->
                      <?php
                      }
                      ?>
                      <?php 
                      if(($this->document_type == 'PRF') && ($this->order_status > 0) && ($_SESSION['empl_type'] == 'EMPLOYEE')){
                      ?>
                      
                      <?php }else if($this->document_type == 'PO'){?>
                      <li <?php if($_REQUEST['tab'] == 'sodo_order_tab'){ echo 'class="active"';}?>><a href="#sodo_order_tab" data-toggle="tab">Goods Received</a></li>
                      <!--<li <?php if($_REQUEST['tab'] == 'note_order_tab'){ echo 'class="active"';}?>><a href="#note_order_tab" data-toggle="tab">Credit Note (Purchase)</a></li>-->
                      <?php }else if($this->document_type == 'GRN'){?>
                      <!--<li <?php if($_REQUEST['tab'] == 'sales_invoice_tab'){ echo 'class="active"';}?>><a href="#invoice_order_tab" data-toggle="tab">Purchase Invoice</a></li>-->
                      <?php }else if($this->document_type == 'DO'){?>
                      <li <?php if($_REQUEST['tab'] == 'pickup_tab'){ echo 'class="active"';}?>><a href="#pickup_tab" data-toggle="tab">Pickup List</a></li>
                      <?php }?>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane <?php if($_REQUEST['tab'] == "" || $_REQUEST['tab'] == 'detail_tab'){ echo 'active';}?>" id="detail_tab">
                            <?php echo $this->getAddItemDetailForm();?>
                        </div>
                        <div class="tab-pane <?php if($_REQUEST['tab'] == 'sodo_order_tab'){ echo 'active';}?>" id="sodo_order_tab">
                            <?php echo $this->getOrderGenerateTabTable();?>
                        </div>
                        <div class="tab-pane <?php if($_REQUEST['tab'] == 'note_order_tab'){ echo 'active';}?>" id="note_order_tab">
                            <?php echo $this->getInvoiceGenerateTabTable();?>
                        </div>
                        <div class="tab-pane <?php if($_REQUEST['tab'] == 'sales_invoice_tab'){ echo 'active';}?>" id="invoice_order_tab">
                            <?php echo $this->getInvoiceGenerateTabTable();?>
                        </div>
                        <div class="tab-pane <?php if($_REQUEST['tab'] == 'pickup_tab'){ echo 'active';}?>" id="pickup_tab">
                            <?php echo $this->getOrderGenerateTabTable();?>
                        </div>
                    </div>
                </div>
            </div><!-- /.box -->
            <?php }?> 
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php 
    include_once 'js.php';
    ?>
    
<div class="modal fade modal-wide" id="ProductDetailModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Item Transaction History</h4>
        </div>
        <div class="modal-body">
            <form id = 'worker_form' class="form-horizontal">
                <div class="col-sm-12">
                    <div class="form-group">
                      <label for="product_code" class="col-sm-1 control-label">Item</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control " id="product_code" value = "<?php echo $this->pempl_name;?>" placeholder="Name" disabled>
                      </div>
                      <label for="product_category" class="col-sm-1 control-label">Category</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control " id="product_category" value = "<?php echo $this->product_category;?>" placeholder="Category" disabled>
                      </div>
                      <label for="product_price" class="col-sm-2 control-label">Quotation Rate</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control " id="product_price" value = "<?php echo $this->product_price;?>" placeholder="Quotation Rate" disabled>
                      </div>
                    </div>

                </div>
                <div class="col-sm-12">
                    <table class = 'table tablenoborder table-empl-detail' style = 'margin-top:20px;' >
                        <tr>
                            <th style = 'width:5%'>No.</th>
                            <th style = 'width:10%'>Date</th>
                            <th style = 'width:10%'>Document No.</th>
                            <th style = 'width:10%'>Unit Price</th>
                            <th style = 'width:10%'>Qty</th>
                            <th style = 'width:10%'>UOM</th>
                            <th style = 'width:10%'>Disc(%)</th>  
                            <th style = 'width:10%'>Disc($)</th>
                            <th style = 'width:10%'>Subtotal</th>
                            <th style = 'width:5%'></th>
                        </tr>
                        <tr id = 'historylasttr'></tr>
                    </table>
                </div>
            </form>
            <div style = 'clear:both' ></div>
        </div>
        <div class="modal-footer">
          <small class = 'pull-left' >Shows latest 10 records</small>  
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div><input type ="hidden" id = 'product_current_itype'/>
    <script>

    var line_copy = '<tr id = "line_@i" class="tbl_grid_odd" line = "@i">' +
                    '<td style = "width:30px;padding-left:5px">@i</td>' + 
                    //'<td style = "width:60px;"><input type = "text" id = "ordl_seqno_@i" class="form-control" value=""/></td>'+
                    <?php if($this->document_type != 'PO' && $this->document_type != 'GRN'){?>
                    '<td style = "width:100px;"><select style = "width:100px;" line = "@i" id = "ordl_pro_type_@i" class="form-control order-quotation-type-item"><option value="product">Product</option><option value="package">Package</option></select>' + 
                    <?php } ?>
                    '<td style = "width:350px;"><select style = "width:350px;" line = "@i" id = "ordl_pro_id_@i" class="form-control order-quotation-item-list "><?php echo $this->prodCrtl;?></select>' + 
                    <?php if($_SESSION['empl_type'] != 'SUBCON'){?>
                    '<div style = "padding-top:8px;"><a href = "javascript:void(0)" class = "view_product_detail" style = "display:none;font-size:20px;cursor:pointer" id = "ordl_pdetail_id_@i" line = "@i" title = "Item Transaction History" ><i class="fa fa-fw fa-history"></i></a></div>' + 
                    <?php }?>
                    '</td>'+
                    '<td style = "width:300px;"><textarea rows="1" id = "ordl_pro_desc_@i" class="form-control"></textarea></td>'+
                    '<td style = "width:60px;"><input type = "text" id = "ordl_qty_@i" class="form-control calculate" value="1.00"/></td>'+
                    '<td style = "width:80px;"><select style = "width:100%" id = "ordl_uom_@i" class="form-control select2"><?php echo $this->uomCrtl;?></select></td>'+ 
                    <?php if($this->document_type != 'PRF' && $this->document_type != 'QT' && $this->document_type != 'PO' && $this->document_type != 'GRN'){?>
                    '<td style = "width:60px;"><input type = "text" id = "ordl_pfuprice_@i" class="form-control  text-align-right" disabled/></td>'+
                    <?php }?>
                    '<td style = "width:60px;"><input type = "text" id = "ordl_fuprice_@i" class="form-control calculate text-align-right" /></td>'+
                    //'<td style = "width:60px;"><input type = "text" id = "ordl_uprice_@i" class="form-control calculate text-align-right" READONLY/></td>'+
                    '<td style = "width:60px;"><input type = "text" id = "ordl_disc_@i" class="form-control calculate text-align-right"/></td>'+
                    '<td style = "width:100px;"><input readonly type = "text" id = "ordl_total_@i" class="form-control text-align-right"/></td>'+
                    <?php if($this->document_type == 'PU'){?>
                    '<td style = "width:300px;"><textarea rows="1" id = "ordl_prod_location_@i" class="form-control"></textarea></td>'+    
                    <?php }?>  
                    <?php if(($this->document_type == 'PRF') && ($this->document_type == 'GRN')){?>
                    '<td style = "width:100px;"><input  type = "text" id = "ordl_delivery_date_@i" class="form-control text-align-right datepicker"/></td>'+    
                    <?php }?>    
                    '<td style = "width:120px;"><textarea  rows="1" cols="15" id = "ordl_pro_remark_@i" class="form-control"></textarea></td>'+
                    '<td align = "center" class = "" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">' +
                    '<img id = "save_line_@i" ordl_id = "" class = "save_line" line = "@i" src = "dist/img/add.png" style = "cursor:pointer" alt = "Add New"/>' + 
                    '<img id = "delete_line_@i" ordl_id = "" class = "delete_line" line = "@i" src = "dist/img/delete_icon.png" style = "cursor:pointer" alt = "Delete"/>' + 
                    '<input type="hidden" id = "ordl_product_location_@i" class="form-control"/>' +
                    '</td>'+
                    '</tr>';
        
    $(document).ready(function() {
        <?php if($this->order_id == 0){?>
        getCurrency();
        <?php }?>
        <?php   if((($this->document_type == 'QT') || ($this->document_type == 'PO') || ($this->document_type == 'SO') || ($this->document_type == 'PRF')) &&  ($isgenerated <=0)){
                    if(($this->order_status == 1) || ($this->order_status == -1) || ($this->order_status == null)){
        ?>
        addline();
        <?php       }
                }else if($this->document_type == 'GRN'){
                    if($this->order_generate_from == 0 && $this->order_generate_from_type == null){
        ?>
                    addline();
        <?php       }     
                }?>
        <?php if($_REQUEST['isbottom'] == 1){?>
            $("html, body").animate({ scrollTop: $(document).height() },1000);
        <?php }?>
//        $(".select2").select2({
//            placeholder: "Select One"
//        });
        itemCodeAutoComplete();
        $('.invt_autocomplete').on("change", function(e) { 
           getProductDetail($(this).val(),$(this).closest("tr").attr('line'));
        });
        $('.save_line').on('click',function(){
            saveline($(this).attr('line'),$(this).attr('ordl_id'));
        });
         $('.update_line').on('click',function(){
            updateline($(this).attr('line'),$(this).attr('ordl_id'));
        });
        $('.delete_line').on('click',function(){
            deleteline($(this).attr('ordl_id'));
        });
        $('.calculate').on('keyup',function(){
            calculate($(this).closest("tr").attr('line'));
        });
        $('.isincludetax').on('ifChanged',function(){
            calculate($(this).closest("tr").attr('line'));
        });
        $('.view_product_detail').on('click',function(){
           var line =  $(this).attr('line');
           getProductHistory($('#ordl_pro_id_'+line).val(),line);
        });
        $('#order_status').change(function(){
            if(($(this).val() == '-3') || ($(this).val() == '3')){
                $('#order_void_remarks_div').css('display','');
            }else{
                $('#order_void_remarks_div').css('display','none');
            }
        });
        $('.generate_btn').on('click',function(){
            
            if($(this).attr('generateto') == 'PO_multi'){
                $('#generate_multi_line_title').html($(this).attr('title'));
                getGenerateLineData($(this).attr('generateto'));
            }else{
                generateDocument($(this).attr('generateto'));
            }
        });
        $('#order_project_id').on("change", function(e) { 
            getProjectDetail($(this).val());
        });
       
       $('#confirm_email').click(function(){
           if(confirm('Confirm Sent?')){
               window.location.href = "<?php echo $this->document_url;?>?action=emailbypr&order_id=<?php echo $this->order_id;?>";
           }else{
               return false;
           }
       });
        $('.reactive_cancel').on('click',function(){

            if(confirm('Confirm Re-active this product?')){
                var data = "action=reactivecancelitems&ordl_id="+$(this).attr('pid');
                 $.ajax({
                    type: "POST",
                    url: "<?php echo $this->document_url;?>",      
                    data:data,
                    success: function(data) {
                        var jsonObj = eval ("(" + data + ")");
                        if(jsonObj.status == 1){
                            alert("<?php echo $language[$lang]['reactive_cancel_success'];?>"); 
                            window.location.reload();
                        }else{
                            alert("<?php echo $language[$lang]['reactive_cancel_fail'];?>");    
                        }
                    }
                 });
            }
        });
        $('#order_customer').change(function(){
            var data = "action=getPartnerDetailTransaction&partner_id="+$(this).val()
             $.ajax({
                type: "POST",
                url: "partner.php",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");

                    //$('#order_attentionto').select2("destroy");
                    //$('#order_attentionto').select2();
                    //<?php if(($this->document_type == 'QT') || ($this->document_type == 'SI')){?>
                    //$('#order_shipping_id').select2("destroy");
                    //$('#order_shipping_id').select2();
                    //<?php }?>
                    //$('#order_billaddress').html(jsonObj.partner_name + "\n" + jsonObj.partner_bill_address);
                    //if(jsonObj.partner_ship_address != ""){
                    //    $('#order_shipaddress').html(jsonObj.partner_name + "\n" + jsonObj.partner_ship_address);
                    //}else{
                    //    $('#order_shipaddress').html(jsonObj.partner_name + "\n" + jsonObj.partner_bill_address);
                    //}

                    
                    //$('#order_fax').val(jsonObj.partner_fax);
                    //<?php if($_SESSION['empl_type'] != 'SUBCON'){?>
                    //$('#order_salesperson').val(jsonObj.order_salesperson);
                    //<?php }?>
                    
                    $('#order_attentionto').html(jsonObj.contact_option);
                    //$('#order_attentionto').select2("val", "");
                    $('#order_billaddress').val(jsonObj.partner_bill_address).text();
                    $('#order_shipaddress').val(jsonObj.partner_bill_address).text();
                    $('#order_attentionto_phone').val(jsonObj.partner_tel);
                    $('#order_fax').val(jsonObj.partner_fax);
                    $('#order_attentionto_email').val(jsonObj.partner_email);
                }
             });
        });
        $('#order_shipping_id').change(function(){
            var data = "action=getShippingAddress&shipping_id="+$(this).val()
             $.ajax({
                type: "POST",
                url: "partner.php",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#order_billaddress').html(jsonObj.partner_bill_address).text();
                    $('#order_shipaddress').html(jsonObj.partner_ship_address).text();
                }
             });
        });
        $('#order_attentionto').change(function(){
            var data = "action=getContactJson&contact_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "partner.php",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#order_attentionto_phone').val(jsonObj.contact_tel);
                    $('#order_fax').val(jsonObj.contact_fax);
                    $('#order_attentionto_name').val(jsonObj.contact_name);
                    $('#order_attentionto_email').val(jsonObj.contact_email);
                    if(jsonObj.contact_address != ""){
                    $('#order_shipaddress').html(jsonObj.contact_address).text();
                    }else{
                        var shipAddress = $('#order_shipaddress').text().html();
                        $('#order_shipaddress').html(shipAddress).text();
                    }
                }
             });
        });
        // Added by Ivan
        
        $('#order_price_id').change(function(){
            var data = "action=getPriceJson&order_price_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#order_price_remark').val(jsonObj.price_desc);
                }
             });
        });
        $('#order_delivery_id').change(function(){
            var data = "action=getDeliveryJson&order_delivery_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#order_delivery_remark').val(jsonObj.delivery_desc);
                }
             });
        });
        $('#order_paymentterm_id').change(function(){
            var data = "action=getPaymenttermJson&order_paymentterm_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#order_paymentterm_remark').val(jsonObj.paymentterm_desc);
                }
             });
        });
        $('#order_validity_id').change(function(){
            var data = "action=getValidityJson&order_validity_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#order_validity_remark').val(jsonObj.validity_desc);
                }
             });
        });
        $('#order_transittime_id').change(function(){
            var data = "action=getTransittimeJson&order_transittime_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#order_transittime_remark').val(jsonObj.transittime_desc);
                }
             });
        });
         $('#order_freightcharge_id').change(function(){
            var data = "action=getFreightchargeJson&order_freightcharge_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#order_freightcharge_remark').val(jsonObj.freightcharge_desc);
                }
             });
        });
        $('#order_pointofdelivery_id').change(function(){
            var data = "action=getPointofdeliveryJson&order_pointofdelivery_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#order_pointofdelivery_remark').val(jsonObj.pointofdelivery_desc);
                }
             });
        });
        $('#order_prefix_id').change(function(){
            var data = "action=getPrefixJson&order_prefix_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#order_prefix_remark').val(jsonObj.prefix_desc);
                }
             });
        });
        $('#order_remarks_id').change(function(){
            var data = "action=getRemarksJson&order_remarks_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#order_remarks_remark').val(jsonObj.remarks_desc);
                }
             });
        });
        $('#order_country_id').change(function(){
            var data = "action=getCountryJson&order_country_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#order_country_remark').val(jsonObj.country_desc);
                }
             });
        });
        
        $('.order-quotation-type-item').change(function(){
            var line = $(this).attr('line');
            var data = "action=getItemListJson&order_type_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#ordl_pro_id_' + line).html(jsonObj.product_option);
                    $('#ordl_pro_id_' + line).select2("val", "");
                }
             });
        });
        $('.order-quotation-item-list').change(function(){
            var line = $(this).attr('line');
            var qtype = $('option:selected','#ordl_pro_type_' + line).attr('value');
            var data = "action=getItemDescJson&qt_type=" + qtype + "&order_item_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#ordl_pro_desc_'+line).val(jsonObj.item_desc);
                    $('#ordl_product_location_'+line).val(jsonObj.item_product_location);
                    <?php if ($this->document_type == 'QT') { ?>
                    $('#ordl_pfuprice_'+line).val(jsonObj.item_sale_price);
                    $('#ordl_fuprice_'+line).val(jsonObj.item_sale_price);
                    $('#ordl_total_'+line).val(jsonObj.item_sale_price);
                    <?php }else{ ?>
                    $('#ordl_pfuprice_'+line).val(jsonObj.item_cost_price);
                    $('#ordl_fuprice_'+line).val(jsonObj.item_cost_price);
                    $('#ordl_total_'+line).val(jsonObj.item_cost_price);
                    <?php } ?>
                }
             });
        });
        <?php 
        if(($_REQUEST['fi'] == 1) && ($this->order_customer > 0)){
            echo "$('#order_customer').change();";
        }
        ?>
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
    
        $("#order_form").validate({
              rules: 
              {
                  order_customer:
                  {
                      required: true
                  },
                  <?php if($this->document_type == 'PRF'){?>
                  order_project_id:
                  {
                      required: true
                  }
                  <?php }?>
              },
              messages:
              {
                  order_customer:
                  {
                      required: "Please select customer."
                  },
                  <?php if($this->document_type == 'PRF'){?>
                  order_project_id:
                  {
                      required: "Please select project."
                  }
                  <?php }?>
              }
        });
        
        
        $('#order_discheadertotal').keyup(function(){
                //calculate header discount
       
                var order_discheadertotal = parseFloat($('#order_discheadertotal').val().replace(/,/gi, ""));
                console.log(order_discheadertotal)
                if(isNaN(order_discheadertotal)){
                   order_discheadertotal = 0;
                }

                var order_subtotal = parseFloat($('#order_subtotal').val().replace(/,/gi, ""));
                if(isNaN(order_subtotal)){
                   order_subtotal = 0;
                }

                var order_finalsubtotal = parseFloat(order_subtotal) - parseFloat(order_discheadertotal);

                $('#order_finalsubtotal').val(changeNumberFormat(RoundNum(order_finalsubtotal,2)));
                
                var order_taxtotal = parseFloat(order_finalsubtotal) * (parseFloat(system_gst_percent)/100);
                $('#order_taxtotal').val(changeNumberFormat(RoundNum(order_taxtotal,2)));
                
                var order_grandtotal = parseFloat(order_finalsubtotal) + parseFloat(order_taxtotal);
                $('#order_grandtotal').val(changeNumberFormat(RoundNum(order_grandtotal,2)));
                
                
        });
    });
    var issend = false;
    function saveline(line,ordl_id){
        
        var data = "&ordl_pro_type="+$('#ordl_pro_type_'+line).val();
            data += "&ordl_pro_id="+$('#ordl_pro_id_'+line).val();
            data += "&ordl_pro_desc="+encodeURIComponent($('#ordl_pro_desc_'+line).val());
            data += "&ordl_qty="+$('#ordl_qty_'+line).val();
            data += "&ordl_uom="+$('#ordl_uom_'+line).val();
            data += "&ordl_pfuprice="+$('#ordl_pfuprice_'+line).val();
            data += "&ordl_fuprice="+$('#ordl_fuprice_'+line).val();
            data += "&ordl_disc="+$('#ordl_disc_'+line).val();
            data += "&ordl_total="+$('#ordl_total_'+line).val();
            data += "&ordl_delivery_date="+$('#ordl_delivery_date_'+line).val();
            data += "&ordl_product_location="+encodeURIComponent($('#ordl_product_location_'+line).val());
            data += "&ordl_pro_remark="+encodeURIComponent($('#ordl_pro_remark_'+line).val());
            data += "&ordl_istax=1";
            
            //data += "&order_currencyrate=<?php echo $this->order_currencyrate;?>";
            //data += "&order_project_id="+$('#order_project_id').val();
            data += "&action=saveline";
            data += "&ordl_id="+ordl_id;
            data += "&order_id=<?php echo $_REQUEST['order_id'];?>";

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
                   alert(jsonObj.msg);
               }
               issend = false;
            }		
         });
         return false;
    }
    function updateline(line,ordl_id){
        
        var data = "&ordl_pro_type="+$('#ordl_pro_type_'+line).val();
            data += "&ordl_pro_id="+$('#ordl_pro_id_'+line).val();
            data += "&ordl_pro_desc="+encodeURIComponent($('#ordl_pro_desc_'+line).val());
            data += "&ordl_qty="+$('#ordl_qty_'+line).val();
            data += "&ordl_uom="+$('#ordl_uom_'+line).val();
            data += "&ordl_pfuprice="+$('#ordl_pfuprice_'+line).val();
            data += "&ordl_fuprice="+$('#ordl_fuprice_'+line).val();
            data += "&ordl_disc="+$('#ordl_disc_'+line).val();
            data += "&ordl_total="+$('#ordl_total_'+line).val();
            data += "&ordl_product_location="+encodeURIComponent($('#ordl_product_location_'+line).val());
            data += "&ordl_delivery_date="+$('#ordl_delivery_date_'+line).val();
            data += "&ordl_pro_remark="+encodeURIComponent($('#ordl_pro_remark_'+line).val());
            data += "&ordl_istax=1";
            
            //data += "&order_currencyrate=<?php echo $this->order_currencyrate;?>";
            //data += "&order_project_id="+$('#order_project_id').val();
            data += "&action=updateline";
            data += "&ordl_id="+ordl_id;
            data += "&order_id=<?php echo $_REQUEST['order_id'];?>";

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
                   alert(jsonObj.msg);
               }
               issend = false;
            }		
         });
         return false;
    }
    function deleteline(ordl_id){
        var data = "action=deleteline&order_id=<?php echo $this->order_id;?>&ordl_id="+ordl_id;
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
    function calculateAll(){
        for(var i = 1;i<=$('#total_line').val();i++){
            calculate(i);
        }
    }
    function calculate(line){
        var qty = parseFloat($('#ordl_qty_'+line).val().replace(/,/gi, ""));
        var funit_price = parseFloat($('#ordl_fuprice_'+line).val().replace(/,/gi, ""));
        var discount = parseFloat($('#ordl_disc_'+line).val().replace(/,/gi, ""));
        var rate = parseFloat($('#order_currencyrate').val().replace(/,/gi, ""));

        if(qty == ""){
           qty = 1;
        }

        if(isNaN(funit_price)){
           funit_price = 0;
        }
        if(isNaN(discount)){
           discount = 0;
        }
        if(isNaN(rate)){
           rate = 0;
        }
        var selling_price = funit_price * rate;
        
        var subtotal = parseFloat(qty) * RoundNum(parseFloat(selling_price),2);
        
        if(discount > 0){
            var disc_amt = RoundNum(parseFloat(subtotal) * (parseFloat(discount)/100),2);
        }else{
            var disc_amt = 0;
        }
        
        var subtotal_afterdiscount = parseFloat(subtotal) - parseFloat(disc_amt);
//        $('#ordl_istax_'+line).is(':checked')
//        if(1==1){
//           var fgst_amt = RoundNum(parseFloat(subtotal_afterdiscount) * (parseFloat(system_gst_percent)/100),2);
//        }else{
//           var fgst_amt = 0;
//        }
        var fgst_amt = 0;
        
        var fgrandtotal = RoundNum(parseFloat(subtotal_afterdiscount) + parseFloat(fgst_amt),2);
        var uprice = RoundNum(parseFloat(funit_price) * parseFloat(rate),2);

        $('#ordl_uprice_'+line).val(changeNumberFormat(RoundNum(uprice,2)));
        $('#ordl_ftotal_'+line).val(changeNumberFormat(fgrandtotal));
        
        var gst_amt = (RoundNum(subtotal_afterdiscount * rate,2)) * (parseFloat(system_gst_percent)/100);
        var grandtotal = parseFloat((RoundNum(subtotal_afterdiscount,2))) + parseFloat(RoundNum(fgst_amt,2));

        $('#ordl_total_'+line).val(changeNumberFormat(RoundNum(grandtotal,2)));
        $('#ordl_taxamt_'+line).val(changeNumberFormat(RoundNum(fgst_amt,2)));
        

        
    }
    function getProductDetail(product_id,line){
         var data = "action=getProductDetail&product_id="+product_id+"&itype="+$('#product_current_itype').val();
         $.ajax({
            type: "POST",
            url: "product.php",      
            data:data,
            success: function(data) { 
                var jsonObj = eval ("(" + data + ")");

                <?php if($_SESSION['empl_type'] == 'SUBCON'){?>
                    $('#ordl_pro_desc_'+line).html(jsonObj.product_desc);
                <?php }else{?>
                    $('#ordl_pro_desc_'+line).html(jsonObj.product_desc);
                <?php }?>    
                $('#ordl_pfuprice_'+line).val(jsonObj.product_sales_price);
                $('#ordl_fuprice_'+line).val(jsonObj.product_sales_price);
                
              
                
//                if(jsonObj.product_sales_price == 0){
//                    $('#ordl_fuprice_'+line).attr('readonly',false);
//                }else{
//                    $('#ordl_fuprice_'+line).attr('readonly',true);
//                }
                $('#ordl_pdetail_id_'+line).css('display','');
                calculate(line);
            }
         });
    }
    function itemCodeAutoComplete(){

        $(".invt_autocomplete").select2({
              placeholder: "Search for a Item",
              width: '100%',
//              minimumInputLength: 1,
              ajax: { 
                  url: 'autocomplete.php?action=item&document_type=<?php echo $this->document_type?>&order_project_id='+$('#order_project_id').val(),
                  dataType: 'json',
                  cache: true,
                    processResults: function (data, params) {
                      params.page = params.page || 1;

                      return {
                        results: data.items,
                        pagination: {
                          more: (params.page * 30) < data.total_count
                        }
                      };
                    }
              },
              initSelection: function(element, callback) {
                        var elementText = $(element)[0].textContent;
                        var data = {"value":elementText};
                    
                        
                        callback(data);

              },
              templateResult: function(data) {
                              return data.text;
              },
              templateSelection: function(data){ console.log(data);
                  $('#product_current_itype').val(data.itype);
                    return data.value;
              },
        });
    }
    function generateDocument(generate_document_type){
         var data = "action=generateDocument&order_id=<?php echo $this->order_id;?>&generate_document_type="+generate_document_type;
         var url = "<?php echo $this->document_url;?>";
         if(generate_document_type == 'SI'){
             url = "sales_invoice.php";
             var pid = "invoice_id";
         }else if(generate_document_type == 'PO'){
             url = "purchase_order.php";
             var pid = "order_id";
         }else if(generate_document_type == 'GRN'){
             url = "grn.php";
             var pid = "order_id";
         }else if(generate_document_type == 'PCN'){
             url = "purchase_cn.php";
             var pid = "invoice_id";
         }else if(generate_document_type == 'PU'){
             url = "pickup.php";
             var pid = "order_id";
         }else{
             var pid = "order_id";
         }
         $.ajax({
            type: "POST",
            url: url,      
            data:data,
            success: function(data) { 
                var jsonObj = eval ("(" + data + ")");
                if(jsonObj.status == 1){
                    alert("<?php echo $language[$lang]['generate_success'];?>");
                    window.location.href = jsonObj.newurl + "?action=edit&" + pid + "=" + jsonObj.newid;
                }else{
                    alert("<?php echo $language[$lang]['generate_error'];?>");
                }
            }
         });
    }
    function addline(){
        var addlinevalue = $('#total_line').val();
        var nextvalue = parseInt(addlinevalue)+1;
        var newline = line_copy.replace(/@i/g,nextvalue);
        $('#detail_last_tr').before(newline);
        $('#total_line').val(nextvalue);
        $('#ordl_seqno_'+nextvalue).val(nextvalue*10);
        
        $('.datepicker').datepicker({
            format: 'dd-M-yyyy',
            autoclose: true,
            pickerPosition: "bottom-left"
        }); 
    }
    function getCurrency(){
            var data = "action=getCurrencyRateDetail&crate_tcurrency_id="+$("#order_currency").val()
             $.ajax({
                type: "POST",
                url: "crate.php",      
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#order_currencyrate').val(jsonObj.crate_rate);
                    if($('#order_currency').val() > 0){
                        $('.base_currency_span').text($("#order_currency_org option:selected").text());
                    }
                    calculateAll();
                }
             });
    }
    function duplicateDocument(){
        
        
         var data = "action=duplicate&order_id=<?php echo $this->order_id;?>";
         var url = "<?php echo $this->document_url;?>";
         if(confirm("Confirm duplicate this quotation?")){
            $.ajax({
               type: "POST",
               url: url,      
               data:data,
               success: function(data) { 
                   var jsonObj = eval ("(" + data + ")");
                   if(jsonObj.status == 1){
                       alert("<?php echo $language[$lang]['duplicate_success'];?>");
                       window.location.href = "<?php echo $this->document_url;?>?action=edit&order_id=" + jsonObj.order_id;
                   }else{
                       alert("<?php echo $language[$lang]['duplicate_error'];?>");
                   }
               }
            });
            }
       
    }
    function getGenerateLineData(generate_type){
         $('#generate_type').val(generate_type);
         $('.parent_line').remove();
         var data = "action=getGenerateLineData&order_id=<?php echo $this->order_id;?>&generate_type="+generate_type;
         $.ajax({
            type: "POST",
            url: "<?php echo $this->document_url;?>",      
            data:data,
            success: function(data) { 
                var jsonObj = eval ("(" + data + ")");
                var html = "";

                if(jsonObj.status == 1){
                    var k = 0;
                    var kk = 1;
                    $('.generatelinetr').remove();
                    var order_id = "";
                    var order_id2 = "";
                    for(var i = 0;i<jsonObj.json.length;i++){
                        
                        kk++;
                        
                        if(order_id != jsonObj.json[i].order_id){
                            k++;
                            html += "<tr style = 'cursor:pointer' balance = '" + jsonObj.json[i].balance + "' order_id = '" + jsonObj.json[i].order_id + "' class = 'parent_line' >";
                            html += "<td>" + k + "</td>";
                            html += "<td>" + jsonObj.json[i].order_no + "</td>";
                            html += "<td>" + jsonObj.json[i].order_date + "</td>";
                            html += "<td>" + jsonObj.json[i].sales_person_name + "</td>";
                            html += "</tr>";
                            
                            order_id = jsonObj.json[i].order_id;
                            kk = 1;
                        }
                        
                        
                        html += "<tr style = 'display:none' balance = '" + jsonObj.json[i].balance + "' ordl_id = '" + jsonObj.json[i].ordl_id + "' class = 'generatelinetr children_line_" + jsonObj.json[i].order_id + "' >";
                        html += "<td colspan = '4'><table class = 'table tablenoborder table-empl-detail'>";
                        
                        if(order_id2 != jsonObj.json[i].order_id){
                        html += "<tr>" + 
                                "<th style = 'width:5%'>No.</th>" +
                                "<th style = 'width:10%'>Product Code.</th>" +
                                "<th style = 'width:30%'>Description</th>" +
                                "<th style = 'width:10%'>Unit Price</th>" +
                                "<th style = 'width:10%'>UOM</th>" +
                                "<th style = 'width:10%'>Qty</th>" +
                                "<th style = 'width:10%'>Balance</th>  " +
                                "<th style = 'width:10%'>Received Qty</th>" +
                                "<th style = 'width:5%'><input type = 'checkbox' class = 'generateparent_checkbox' order_id = '" + jsonObj.json[i].order_id + "'/></th>" +
                                "</tr>";
                        order_id2 = jsonObj.json[i].order_id;
                        }
                        
                        html += "<tr balance = '" + jsonObj.json[i].balance + "' ordl_id = '" + jsonObj.json[i].ordl_id + "' class = 'generatelinetr' >";
                        html += "<td style = 'width:5%'>" + kk + "<input type = 'hidden' id = 'generateordlid_" + jsonObj.json[i].ordl_id + "' name = 'generateordlid[" + i + "]' value = '"+ jsonObj.json[i].ordl_id +"' /></td>";
                        html += "<td style = 'width:10%'>" + jsonObj.json[i].ordl_pro_no + "<input type = 'hidden' id = 'generateorderid_" + jsonObj.json[i].ordl_id + "' name = 'generateorderid[" + i + "]' value = '"+ jsonObj.json[i].order_id +"' /></td>";
                        html += "<td style = 'width:30%'>" + nl2br(jsonObj.json[i].ordl_pro_desc) + "</td>";
                        html += "<td style = 'width:10%'>" + jsonObj.json[i].ordl_fuprice + "</td>";
                        html += "<td style = 'width:10%'>" + jsonObj.json[i].ordl_uom + "</td>";
                        html += "<td style = 'width:10%'>" + jsonObj.json[i].ordl_qty + "</td>";
                        html += "<td style = 'width:10%'>" + jsonObj.json[i].balance + "</td>";
                        html += "<td style = 'width:10%'><input type = 'text' id = 'generateqty_" + jsonObj.json[i].ordl_id + "' name = 'generateqty[" + i + "]' value = '0' class='form-control' style = 'text-align:right' /></td>";
                        html += "<td style = 'width:5%'><input type = 'checkbox' id = 'generatecheckbox_" + jsonObj.json[i].ordl_id + "' name = 'generatecheckbox[" + i + "]' style = 'text-align:right' class = 'generatechildren_checkbox generatechildren_checkbox_" + jsonObj.json[i].order_id + "' minimal' /></td>";
                        html += "</tr>";
                        
                        html += "</table></td></tr>";
                        
                       
                    } $('#generatelasttr').before(html);
                    $('.parent_line').on('click',function(){
                        if($(this).attr('isopen') == 1){
                            $('.children_line_'+$(this).attr('order_id')).css('display','none');
                        
                            $(this).attr('isopen','0');
                        }else{
                            $('.children_line_'+$(this).attr('order_id')).css('display','');
                        
                            $(this).attr('isopen','1');
                        }
                        
                    });
                    
                    $('.generateparent_checkbox').on('click',function(){

                            if($(this).is(':checked')){
                                $('.generatechildren_checkbox_' + $(this).attr('order_id')).prop('checked',true);
                            }else{
                                $('.generatechildren_checkbox_' + $(this).attr('order_id')).prop('checked',false);
                            }
                            $('.generatechildren_checkbox').each(function(){
                                generateChildrenCheckboxFunction($(this));
                            });

                    });
                    activeGenerateChildrenCheckbox();
                }else{
                    html = "<tr>";
                    html += "<td colspan = '9' style = 'text-align:center;padding-top:20px' ><b>No record found.</b></td>";
                    html += "</tr>";
                    $('#generatelasttr').before(html);
                }
            }
         });
        $('#generate_model').modal('show');
    }
    function activeGenerateChildrenCheckbox(){
    
        $('.generatechildren_checkbox').on('click',function(){
            generateChildrenCheckboxFunction($(this));
        });
    }
    function generateChildrenCheckboxFunction(obj){
        var ordl_id = obj.parent().parent().attr('ordl_id');
        var balance = obj.parent().parent().attr('balance');

        if(obj.is(':checked')){
            $('#generateqty_'+ordl_id).val(balance);
        }else{
            $('#generateqty_'+ordl_id).val(0);
        }    
    }
    function getProjectDetail(project_id){
         var data = "action=getProjectDetail&project_id="+project_id;
         $.ajax({
            type: "POST",
            url: "project.php",      
            data:data,
            success: function(data) { 
                var jsonObj = eval ("(" + data + ")");
                
                $('#order_job_no').val(jsonObj.project_code);
                <?php if($_SESSION['empl_type'] != 'SUBCON'){?>
                $('#order_subcon').select2('val', 'All');
                $('#order_subcon').html(jsonObj.subcon_option);
                <?php }?>
            }
         });
    }
    function getProductHistory(product_id,line){
         var data = "action=getProductHistory&order_id=<?php echo $this->order_id;?>&history_type=<?php echo $this->document_type;?>&product_id="+product_id+"&customer_id="+$('#order_customer').val();
         $.ajax({
            type: "POST",
            url: "quotation.php",      
            data:data,
            success: function(data) { 
                var jsonObj = eval ("(" + data + ")");
                
                var html = "";
                
                if(jsonObj.status == 1){
                    var k = 0;
                    $('.generatelinetr').remove();
                    $('.historyline').unbind('click');
                    
                    $('#product_code').val(jsonObj.product_code);
                    $('#product_price').val(jsonObj.product_sales_price);
                    $('#product_category').val(jsonObj.product_code);
                    $('#product_cost').val(jsonObj.product_cost_price);
                    
                    for(var i = 0;i<jsonObj.json.length;i++){
                        k = i + 1;
                        html = "<tr class = 'generatelinetr' >";
                        html += "<td>" + k + "</td>";
                        html += "<td>" + jsonObj.json[i].order_date + "</td>";
                        html += "<td>" + jsonObj.json[i].order_no + "</td>";
                        html += "<td>" + jsonObj.json[i].ordl_fuprice + "</td>";
                        html += "<td>" + jsonObj.json[i].ordl_qty + "</td>";
                        html += "<td>" + jsonObj.json[i].ordl_uom + "</td>";
                        html += "<td>" + jsonObj.json[i].ordl_disc + "</td>";
                        html += "<td>" + jsonObj.json[i].ordl_fdiscamt + "</td>";
                        html += "<td>" + jsonObj.json[i].ordl_ftotal + "</td>";
                        html += "<td><a class = 'historyline' href = 'javascript:void(0)' line = '" + line + "' pid = '" + jsonObj.json[i].ordl_id + "' title = 'Use this price.' style = 'cursor:pointer'  ><i class='fa fa-fw fa-refresh'></i></a></td>";
                        html += "</tr>";
                        $('#historylasttr').before(html);
                    }
                        $('.historyline').on('click',function(){
                            getHistoryLineDetail($(this).attr('pid'),line);
                        });
                }else{
                    html = "<tr>";
                    html += "<td colspan = '9' style = 'text-align:center;padding-top:20px' ><b>No record found.</b></td>";
                    html += "</tr>";
                    $('#historylasttr').before(html);
                }
                $('#ProductDetailModal').modal('show');
            }
         });
        
    }
    function getHistoryLineDetail(ordl_id,line){
         var data = "action=getHistoryLineDetail&ordl_id="+ordl_id;
         $.ajax({
            type: "POST",
            url: "quotation.php",      
            data:data,
            success: function(data) { 
                var jsonObj = eval ("(" + data + ")");
                console.log(jsonObj.json.ordl_uom);
                $('#ordl_uom_'+line).val(jsonObj.json.ordl_uom);
                $('#ordl_fuprice_'+line).val(jsonObj.json.ordl_fuprice);
                $('#ordl_disc_'+line).val(jsonObj.json.ordl_disc);
                calculate(line);
                $('#ProductDetailModal').modal('hide');
            }
         });
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
                        <th style = 'width:10%'>Doc.No</th>
                        <?php if($_SESSION['empl_type'] != 'SUBCON'){?> 
                        <?php if($this->document_type == 'PO' || $this->document_type == 'GRN'){?>
                        <th style = 'width:12%'>Supplier</th>
                        <?php }else{?>
                        <th style = 'width:12%'>Customer</th>
                        <?php }?>
                        <?php }?>                        
                        <th style = 'width:5%'>Date</th>
                        <?php if($this->document_type == 'SO'){?>
                        <th style = 'width:5%'>Customer PO</th>
                        <th style = 'width:5%'>Quotation No.</th>
                        <?php }else if($this->document_type == 'DO'){?>
                        <!--<th style = 'width:5%'>PO No.</th>
                        <th style = 'width:5%'>Invoice No.</th>-->
                        <?php }else if($this->document_type == 'PRF'){?>
                        <th style = 'width:10%'>Ordered By</th>
                        <?php }else if($this->document_type == 'GRN'){?>
                        <th style = 'width:5%'>PO No.</th>
                        <!--<th style = 'width:5%'>SI No.</th>-->
                        <?php } ?>
                        <?php if($_SESSION['empl_type'] != 'SUBCON'){?>
                        <th style = 'text-align:right;width:8%'>Total</th>
                        <th style = 'text-align:right;width:8%'>GST</th>
                        <th style = 'text-align:right;width:8%'>Total (incl. 7% GST)</th>
                        <?php }?>
                        <?php if($this->document_type != 'PO' && $this->document_type != 'GRN'){?>
                        <th style = 'width:5%'>Is Generated</th>
                        <?php }?> 
                        <th style = 'width:5%'>Status</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      if($this->document_type == 'PRF'){
                          if($_SESSION['empl_type'] != 'EMPLOYEE'){
                            $this->wherestring .= " AND o.order_salesperson = '{$_SESSION['empl_id']}'";
                          }
                      }
                      $sql = "SELECT o.*,pr.partner_id,
                              CONCAT(pr.partner_code,' - ',pr.partner_name) as partner_name,empl.empl_name as sales_person,cy.currency_code,
                              empl2.empl_name as revby,pro.project_code,pro.project_name 
                              FROM db_order o 
                              LEFT JOIN db_partner pr ON pr.partner_id = o.order_customer
                              LEFT JOIN db_empl empl ON empl.empl_id = o.order_salesperson
                              LEFT JOIN db_empl empl2 ON empl2.empl_id = o.order_revby
                              LEFT JOIN db_currency cy ON cy.currency_id = o.order_currency
                              LEFT JOIN db_project pro ON pro.project_id = o.order_project_id
                              WHERE o.order_id > 0 AND o.order_status != '0'  $this->wherestring
                              ORDER BY o.order_no DESC,o.order_date DESC,o.order_status DESC";

                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                          if($row['order_revtimes'] > 0){
                              $order_no = $row['order_no'] . " (Rev {$row['order_revtimes']})";
                          }else{
                              $order_no = $row['order_no'];
                          }
                          $sql1 = "SELECT image_id
                                    FROM db_image
                                    WHERE ref_id > 0
                                    AND ref_id = '".$row['order_id']."'";
                          $q1 = mysql_query($sql1);
                          //$num_attachment['countid'] = mysql_fetch_assoc($q1);
                              
                    ?>
                        <tr>
                            <td>
                                <?php 
                                    echo $order_no;
                                    if(mysql_num_rows($q1)>0){
                                        echo '<i class="fa fa-paperclip pull-right" style="font-size:25px;color:lightblue;text-shadow:2px 2px 1px #000000;margin-right:10px;"></i>';
                                    }
                                ?>
                                </td>
                            <?php if($_SESSION['empl_type'] != 'SUBCON'){?>
                            <td><?php echo "<a href = 'partner.php?action=edit&tab=$this->document_type&partner_id={$row['partner_id']}'>" . $row['partner_name'] . "</a>";?></td>
                            <?php }?>                            
                            <td><?php echo format_date($row['order_date']);?></td>
                            <?php if($this->document_type == 'SO'){?>
                            <td><?php echo $row['order_customerpo'];?></td>
                            <td>
                                <?php 
                                   $qt_query = getDataBySql("order_no,order_id","db_order"," WHERE order_id = '{$row['order_generate_from']}' AND order_status = '1'");
                                   $qt_no = "";
                                   while($r_qt = mysql_fetch_array($qt_query)){
                                   $qt_no =  "<a href = 'quotation_order.php?action=edit&order_id={$r_qt['order_id']}' target = '_blank'>" . $r_qt['order_no'] . "</a>,";
                                   }
                                   echo rtrim($qt_no,",");
                                ?>
                            </td>
                            <?php }else if($this->document_type == 'DO'){?>
                            <!--<td>
                                <?php 
                                   $do_query = getDataBySql("order_no,order_id","db_order"," WHERE order_id = '{$row['order_generate_from']}' AND order_status = '1'");
                                   $do_no = "";
                                   if($r_do = mysql_fetch_array($do_query)){
                                   $do_no =  "<a href = 'sales_order.php?action=edit&order_id={$r_do['order_id']}' target = '_blank'>" . $r_do['order_no'] . "</a>,";
                                   }
                                   echo rtrim($do_no,",");
                                ?>
                            </td>
                            <td>
                                <?php 
                                   $query2 = getDataBySql("*","db_invoice"," WHERE invoice_generate_from = '{$row['order_id']}'  AND invoice_status = 1"," ORDER BY invoice_date");
                                   $generated = "";
                                   while($row2 = mysql_fetch_array($query2)){
                                       $generated .= "<a href = 'purchase_order.php?action=edit&order_id={$row2['invoice_id']}'>{$row2['invoice_no']}</a>,";
                                   }
                                   echo "<b>" . rtrim($generated,',') . "</b>";
                                ?>
                            </td>-->
                            <?php }else if($this->document_type == 'PRF'){?>
                            <td>
                                <?php 
                                if($row['order_salesperson_prefix'] == 'SUBCON'){
                                    echo getDataCodeBySql("partner_name","db_partner"," WHERE partner_id = '{$row['order_salesperson']}'","");
                                }else if($row['order_salesperson_prefix'] == 'EMPLOYEE'){
                                    echo getDataCodeBySql("empl_name","db_empl"," WHERE empl_id = '{$row['order_salesperson']}'","");
                                }
                                ?>
                            </td>
                            <?php }else if($this->document_type == 'GRN'){?>
                            <td>
                                <?php 
                                   $do_query = getDataBySql("order_no,order_id","db_order"," WHERE order_id = '{$row['order_generate_from']}' AND order_status = '1'");
                                   $do_no = "";
                                   if($r_do = mysql_fetch_array($do_query)){
                                   $do_no =  "<a href = 'sales_order.php?action=edit&order_id={$r_do['order_id']}' target = '_blank'>" . $r_do['order_no'] . "</a>,";
                                   }
                                   echo rtrim($do_no,",");
                                ?>
                            </td>
                            <!--<td>
                                <?php 
                                   $query2 = getDataBySql("*","db_invoice"," WHERE invoice_generate_from = '{$row['order_id']}'  AND invoice_status = 1"," ORDER BY invoice_date");
                                   $generated = "";
                                   while($row2 = mysql_fetch_array($query2)){
                                       $generated .= "<a href = 'purchase_order.php?action=edit&order_id={$row2['invoice_id']}'>{$row2['invoice_no']}</a>,";
                                   }
                                   echo "<b>" . rtrim($generated,',') . "</b>";
                                ?>
                            </td>-->
                            <?php }?>
                            <?php if($_SESSION['empl_type'] != 'SUBCON'){?>
                            <td style="text-align:right;">
                                <?php 
                                $this->order_id = $row['order_id'];
                                echo num_format(($this->getSubTotalAmt() + $this->getTotalGstAmt()) - $this->getTotalDiscAmt());
                                ?>
                            </td>
                            <td style="text-align:right;">
                                <?php 
                                echo num_format($row['order_taxtotal']);
                                ?>
                            </td>
                            <td style="text-align:right;">
                                <?php 
                                echo num_format($row['order_grandtotal']);
                                ?>
                            </td>
                            <?php if($this->document_type != 'PO' && $this->document_type != 'GRN'){?>
                            <td>
                                <?php 
                                    $orderNoLink = $this->fetchOrderNoDetail($this->document_type,$row['order_id']);
                                    echo "<b>".$orderNoLink."</b>";
                                ?>
                            </td>
                            <?php }?>
                            <?php }?>
                            <td>
                                <?php 
                                if($row['order_status'] == 2){ 
                                    echo 'Completed';
                                }else if($row['order_status'] == 1){ 
                                    echo 'Pending';
                                }else if($row['order_status'] == -1){ 
                                    echo 'No Response';
                                }else if($row['order_status'] == -3){ 
                                    echo 'Void';
                                } 
                                 ?>
                            </td>
                            <td class = "text-align-right">
  
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = '<?php echo $this->document_url;?>?action=edit&order_id=<?php echo $row['order_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('<?php echo $this->document_url;?>?action=delete&order_id=<?php echo $row['order_id'];?>','Confirm Delete?')">Delete</button>
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
                        <th style = 'width:10%'>Doc.No</th>
                        <?php if($_SESSION['empl_type'] != 'SUBCON'){?>
                        <?php if($this->document_type == 'PO' || $this->document_type == 'GRN'){?>
                        <th style = 'width:12%'>Supplier</th>
                        <?php }else{?>
                        <th style = 'width:12%'>Customer</th>
                        <?php }?>
                        <?php }?>
                        <th style = 'width:5%'>Date</th>
                        <?php if($this->document_type == 'SO'){?>
                        <th style = 'width:5%'>Customer PO</th>
                        <th style = 'width:5%'>Quotation No.</th>
                        <?php }else if($this->document_type == 'DO'){?>
                        <!--<th style = 'width:5%'>PO No.</th>
                        <th style = 'width:5%'>Invoice No.</th>-->
                        <?php }else if($this->document_type == 'PRF'){?>
                        <th style = 'width:10%'>Ordered By</th>
                        <?php }else if($this->document_type == 'GRN'){?>
                        <th style = 'width:5%'>PO No.</th>
                        <!--<th style = 'width:5%'>SI No.</th>-->
                        <?php } ?>
                        <?php if($_SESSION['empl_type'] != 'SUBCON'){?>
                        <th style = 'text-align:right;width:8%'>Total</th>
                        <th style = 'text-align:right;width:8%'>GST</th>
                        <th style = 'text-align:right;width:8%'>Total (incl. 7% GST)</th>
                            <?php }?>
                        <?php if($this->document_type != 'PO' && $this->document_type != 'GRN'){?>
                        <th style = 'width:5%'>Is Generated</th>
                        <?php }?>
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
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "order": [[0, "desc"]]
        });

      });
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
            <!--<th class = ""  style = 'width:30px;'>Seq No</th>-->
            <?php if($this->document_type != 'PO' && $this->document_type != 'GRN' ){?>
            <th class = "" style = 'width:100px;'>Type</th>
            <?php } ?>
            <th class = "" style = 'width:100px;'>Product Code</th>
            <th class = "" style = 'width:300px;'>Description</th>
            <th class = "" style = 'width:60px;'>Qty</th>
            <th class = "" style = 'width:80px;'>UOM</th>
            <!--<th class = "" style = 'width:60px;'>U.Price(EURO)</th>-->
            <?php if($this->document_type != 'PRF' && $this->document_type !== 'QT' && $this->document_type !== 'PO' && $this->document_type !== 'GRN' && $this->document_type !== 'DO' && $this->document_type !== 'PU' ){?>
            <th class = "" style = 'width:60px;'>Quo. Rate</th>
            <?php }?>
            <?php if($this->document_type !== 'QT' && $this->document_type !== 'PO' && $this->document_type !== 'GRN'  && $this->document_type !== 'DO' && $this->document_type !== 'PU'){?>
            <th class = "" style = 'width:60px;'>Adjust</th>
            <?php }else if($this->document_type !== 'PU'){?>
            <!--<th class = "" style = 'width:60px;'>U.Price(<span class = 'base_currency_span'><?php echo $this->order_currency_code;?></span>)</th>-->
            <th class = "" style = 'width:60px;'>U/Price</th>
            
            <th class = "" style = 'width:60px;'>Disc %</th>
            <th class = "">Sub Total</th>
            <?php }?>
            <?php if($this->document_type == 'PU'){?>
            <th class = "" style = 'width:60px;'>Location</th>
            <?php }?>
            <?php if(($this->document_type == 'PRF')){?>
            <th class = "">Delivery Date</th>
            <?php }?>
            <th class = "" style = 'width:120px;'>Remark</th>
            <th class = "" style="width:80px;"></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM db_ordl WHERE ordl_id > 0 AND ordl_order_id > 0 AND ordl_order_id = '$this->order_id' ORDER BY ordl_seqno";
            $query = mysql_query($sql);
            $disabled = "";
            $readonly = "";
            while($row = mysql_fetch_array($query)){
                $line++;
                $this->uomCrtl = $this->select->getUomSelectCtrl($row['ordl_uom'],'N');
                $this->prodNameCrtl = $this->select->getProductNameSelectCtrl($row['ordl_pro_id'],'N');
                $this->packNameCrtl = $this->select->getPackageNameSelectCtrl($row['ordl_pro_id'],'N');
                if($this->document_type != 'PO'){
                    if($this->document_type == 'DO' || $this->document_type == 'PU'){
                        $readonly = " READONLY";
                        $disabled = " DISABLED";
                    }
                    if(($this->document_type == 'QT') && ($this->generated['so_id'] > 0)){
                        $readonly = " READONLY";
                        $disabled = " DISABLED";
                    }
                    if($this->document_type == 'GRN'){
                        $readonly = " READONLY";
                        $disabled = " DISABLED";
                    }
                }
                if(($this->order_status == -3) || ($this->order_status == 2) || ($this->order_status == 3)){
                        $readonly = " READONLY";
                        $disabled = " DISABLED"; 
                }
                //if($this->document_type == "PO"){
                //    $isgenerated = getDataCountBySql("db_invl invl INNER JOIN db_invoice invoice ON invoice.invoice_id = invl.invl_invoice_id"," WHERE invl.invl_parent = '{$row['ordl_id']}' AND invl.invl_parent_type = 'PO' AND invoice.invoice_status = '1'");
                //}else if($this->document_type == "QT"){
                //   $isgenerated = getDataCountBySql("db_order"," WHERE order_generate_from = '$this->order_id' AND order_generate_from_type = 'QT'");
                //}
                if($this->document_type == 'QT'){
                    $isgenerated = getDataCountBySql("db_invoice"," WHERE invoice_generate_from = '$this->order_id' AND invoice_generate_from_type = '$this->document_type' AND invoice_status = 1 AND invoice_generate_from > 0");
                }else if($this->document_type == 'PO'){
                    $isgenerated = getDataCountBySql("db_invoice"," WHERE invoice_generate_from = '$this->order_id' AND invoice_generate_from_type = '$this->document_type' AND invoice_status = 1 AND invoice_generate_from > 0");
                }else if($this->document_type == 'DO'){
                    $isgenerated = getDataCountBySql("db_order"," WHERE order_generate_from = '$this->order_id' AND order_generate_from_type = '$this->document_type' AND order_status = 1 AND order_generate_from > 0");
                }
                if($isgenerated > 0){
                        $readonly = " READONLY";
                        $disabled = " DISABLED"; 
                }
            ?>
                <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>">
                    <td style="width:30px;padding-left:5px"><?php echo $line;?></td>
                    <!--<td style="width:60px;"><input type = "text" id = "ordl_seqno_<?php echo $line;?>" class="form-control" value="<?php echo $row['ordl_seqno'];?>" <?php echo $readonly;?>/></td>-->
                    <?php if($this->document_type != 'PO' && $this->document_type != 'GRN'){?>
                    <td style="width:100px;">
                        <select style = "width:100px;" line = "<?php echo $line;?>" id = "ordl_pro_type_<?php echo $line;?>" class="form-control order-quotation-type-item" <?php echo $disabled;?>>
                            <option value="product" <?php if($row['ordl_item_type'] == 'product'){ echo "selected";} ?>>Product</option>
                            <option value="package" <?php if($row['ordl_item_type'] == 'package'){ echo "selected";} ?>>Package</option>
                        </select>
                    </td>
                    <?php } ?>
                    <td style="width:350px;">
                        <!--<select style = "width:350px;" line = "<?php echo $line;?>" id = "ordl_pro_id_<?php echo $line;?>" class="form-control invt_autocomplete order-quotation-item-list" <?php echo $disabled;?>>-->
                        <select style = "width:350px;" line = "<?php echo $line;?>" id = "ordl_pro_id_<?php echo $line;?>" class="form-control order-quotation-item-list" <?php echo $disabled;?>>
            <?php if($row['ordl_item_type']=='package')
                    {
                        echo $this->packNameCrtl;
                    }
                    else
                    {
                        echo $this->prodNameCrtl;
                    }
                     ?>
                        </select>
                        <?php if($_SESSION['empl_type'] != 'SUBCON'){?>
<!--                        <div style = "padding-top:8px;">
                            <a href = "javascript:void(0)" class = "view_product_detail" style = "font-size:20px;cursor:pointer" id = "ordl_pdetail_id_<?php echo $line;?>" line = "<?php echo $line;?>" title = "Item Transaction History" >
                                <i class="fa fa-fw fa-history"></i>
                            </a>
                        </div>-->
                        <?php }?>
                    </td>
                    </td>
<!-- Description --><td style="width:300px;"><textarea rows="1" cols="15" line = "<?php echo $line;?>" id = "ordl_pro_desc_<?php echo $line;?>" class="form-control text-align-left" <?php echo $readonly;?>><?php echo $row['ordl_pro_desc'];?></textarea></td>
<!-- Qty         --><td style="width:60px;"><input type = "text" line = "<?php echo $line;?>" id = "ordl_qty_<?php echo $line;?>" class="form-control calculate" value="<?php echo $row['ordl_qty'];?>" <?php echo $readonly;?>/></td>
<!-- UOM         --><td style="width:80px;"><select style = 'width:100%' id = "ordl_uom_<?php echo $line;?>" class="form-control " <?php echo $disabled;?>><?php echo $this->uomCrtl;?></select></td>      
                    <?php if($this->document_type != 'PRF' && $this->document_type == 'QT' && $this->document_type == 'PO' && ($this->document_type == 'DO')){?>
                    <td style="width:60px;"><input type = "text" line = "<?php echo $line;?>" id = "ordl_pfuprice_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo num_format($row['ordl_pfuprice']);?>" disabled/></td>
                    <?php }?>
                    <?php if(($this->document_type != 'PU')){?>
<!-- U/Price     --><td style="width:60px;"><input type = "text" line = "<?php echo $line;?>" id = "ordl_fuprice_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo num_format($row['ordl_fuprice']);?>" <?php echo $readonly;?>/></td>
                    <!--<td style="width:60px;"><input type = "text" line = "<?php echo $line;?>" id = "ordl_uprice_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo num_format($row['ordl_uprice']);?>" READONLY/></td>-->
<!-- Discount    --><td style="width:60px;"><input type = "text" line = "<?php echo $line;?>" id = "ordl_disc_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo num_format($row['ordl_disc']);?>" <?php echo $readonly;?>/></td>
<!-- Subtotal    --><td style = "width:100px;"><input type = "text" id = "ordl_total_<?php echo $line;?>" class="form-control text-align-right" readonly value = "<?php echo num_format($row['ordl_total']);?>"/></td>
                    <?php }?>
                    <?php if($this->document_type == 'PU'){?>
<!-- Location    --><td style="width:300px;"><textarea rows="1" cols="15" line = "<?php echo $line;?>" id = "ordl_prod_location_<?php echo $line;?>" class="form-control text-align-left" <?php echo $readonly;?>><?php echo $row['ordl_product_location'];?></textarea></td>
                    <?php }?>
                    <?php if(($this->document_type == 'PRF')){?>
                    <!--<td style="width:60px;"><input type = "text" line = "<?php echo $line;?>" id = "ordl_delivery_date_<?php echo $line;?>" class="form-control datepicker text-align-right" value = "<?php echo format_date($row['ordl_delivery_date']);?>" <?php echo $readonly;?>/></td>-->
                    <?php }?>
<!-- Remark      --><td style="width:120px;"><textarea  rows="1" cols="15"  id = "ordl_pro_remark_<?php echo $line;?>" class="form-control" <?php echo $readonly;?>><?php echo $row['ordl_pro_remark'];?></textarea></td>
                    <td align = "center" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">
                        <?php if(($row['ordl_id'] > 0) && ($disabled == "")){?>
                        <img id = "update_line_<?php echo $line;?>" ordl_id = "<?php echo $row['ordl_id'];?>" class = "update_line" line = "<?php echo $line;?>" src = "dist/img/update.png" style = "cursor:pointer" alt = "Update"/>
                        <?php }else{
                            if($disabled == ""){    
                        ?>
                        <img id = "save_line_<?php echo $line;?>" ordl_id = "<?php echo $row['ordl_id'];?>" class = "save_line" line = "<?php echo $line;?>" src = "dist/img/add.png" style = "cursor:pointer" alt = "Add New"/>
                        <?php 
                            }
                        }
                        if($disabled == ""){ 
                        ?>
                        <img id = "delete_line_<?php echo $line;?>" ordl_id = "<?php echo $row['ordl_id'];?>" class = "delete_line" line = "<?php echo $line;?>" src = "dist/img/delete_icon.png" style = "cursor:pointer" alt = "Delete"/>
                        <?php }?>
                        <input type="hidden" line = "<?php echo $line;?>" id = "ordl_product_location_<?php echo $line;?>" class="form-control text-align-left" value = "<?php echo num_format($row['ordl_product_location']);?>" <?php echo $readonly;?>/>
                    </td>
                </tr>
                <?php
                if($row['ordl_cancel_remark'] != ""){
                    echo "<tr>";
                    echo "<td colspan = '11' >";
                    echo " <p>Cancel Remark : " . $row['ordl_cancel_remark'];
                    if($_SESSION['empl_group'] == 1){
                        echo " <a href = 'javascript:void(0)' style = 'margin-left:15px;' pid = '" . $row['ordl_id'] . "' class = 'reactive_cancel' ><b>Re-Active</b></a></p>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            
            <?php
            }
            ?>
            <tr id = 'detail_last_tr'></tr>
        </tbody>
    </table>
    <input type = 'hidden' id = 'total_line' name = 'total_line' value = '<?php echo $line;?>'/>
    <?php    
    }
    public function getOrderGenerateTabTable(){
        
      if($this->document_type == 'QT'){ 
          /*$document_type = 'Progress Claim';
          $generate_to = 'SO';
          $partner_field = 'Customer';
          $menu_id = '6';// sales order menu id is 12
          $document_url = 'sales_order.php';
          $salesperson_field = "Ordered By";*/
          $document_type = 'Purchase Order';
          $generate_to = 'PO';
          $partner_field = 'Customer';
          $menu_id = '39';// purchase order in db_menu id is 39
          $document_url = 'purchase_order.php';
          $salesperson_field = "Ordered By";
      }else if($this->document_type == 'PO'){
          $document_type = 'Goods Received Note';
          $generate_to = 'GRN';
          $partner_field = 'Supplier';
          $menu_id = '13';// delivery order menu id is 13
          $document_url = 'grn.php';
          $salesperson_field = "Sales Person";
      }else if($this->document_type == 'DO'){
          /*$document_type = 'Purchase Invoice';
          $generate_to = 'PI';
          $partner_field = 'Supplier';
          $menu_id = '12';// sales order menu id is 12
          $document_url = 'purchase_invoice.php';
          $salesperson_field = "Ordered By";*/
          $document_type = 'Pickup List';
          $generate_to = 'PU';
          $partner_field = 'Supplier';
          $menu_id = '12';// pickup menu id is 12
          $document_url = 'pickup.php';
          $salesperson_field = "Ordered By";
      }else if($this->document_type == 'PRF'){ 
          $document_type = 'Purchase Order';
          $generate_to = 'PO';
          $partner_field = 'Supplier';
          $menu_id = '39';// sales order menu id is 12
          $document_url = 'purchase_order.php';
          $salesperson_field = "Ordered By";
      }
    ?>
    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title"><?php echo $document_type;?> Table</h3></div>
          <div class = "pull-right">
            <?php 
            if((getWindowPermission($menu_id,'generate'))){
                $allow = false;
                if(($this->document_type == 'SO') && ($this->generated['do_id'] <= 0) && ($this->generated['inv_id'] <= 0)){
                    $allow = true;
                }else if(($this->document_type == 'QT') && ($this->generated['po_id'] <= 0)){
                    $allow = true;
                }else if(($this->document_type == 'PO') && ($this->generated['so_id'] <= 0)){
                    $allow = true;
                }else if(($this->document_type == 'PRF') && (getDataCountBySql("db_order"," WHERE order_generate_from = '$this->order_id' AND order_status = 1 AND order_generate_from > 0") <= 0)){
                    $allow = true;
                }else{
                    $allow = true;
                }
                
                if($allow){
            ?>
               <button type = 'button' class = "btn btn-primary generate_btn" generateto = "<?php echo $generate_to;?>">Generate <?php echo $document_type;?></button>
            <?php 
                  }
                }?>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
                <th style = 'width:15%'>Document No</th>
                <th style = 'width:15%'><?php echo $partner_field;?></th>
                <th style = 'width:10%'>Date</th>
                <th style = 'width:15%'>Sub Total</th>
                <th style = 'width:10%'>Tax</th>
                <th style = 'width:10%'>Grand Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php   
              $sql = "SELECT o.*,partner.partner_name,empl.empl_name 
                      FROM db_order o 
                      INNER JOIN db_partner partner ON partner.partner_id = o.order_customer
                      LEFT JOIN db_empl empl ON empl.empl_id = o.order_salesperson
                      WHERE o.order_generate_from = '$this->order_id' AND order_generate_from_type = '$this->document_type' AND o.order_status = '1'";
              $query = mysql_query($sql);
              $i = 1;
              while($row = mysql_fetch_array($query)){
                  $subtotal = $this->getSubTotalAmt() - $this->getTotalDiscAmt();
                  $gst = ROUND($subtotal*(system_gst_percent/100),2);
                  $total = $subtotal + $gst;
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['order_no'];?></td>
                    <td><?php echo $row['partner_name'];?></td>
                    <td><?php echo $row['order_date'];?></td>
                    <td><?php echo num_format($subtotal);?></td>
                    <td><?php echo num_format($gst);?></td>
                    <td><?php echo num_format($total);?></td>
                    <td class = "text-align-right">
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                        ?>
                        <button type="button" class="btn btn-primary btn-info " onclick = "location.href = '<?php echo $document_url;?>?action=edit&order_id=<?php echo $row['order_id'];?>'">View</button>
                        <?php }?>
                    </td>
                </tr>
            <?php    
                $i++;
              }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    <?php
    }
    public function generateDocument(){
      include_once 'class/Partner.php';
      include_once 'class/Invoice.php';
      $o = new Invoice();  
      $p = new Partner();
      if($this->generate_document_type == 'DO'){
        $this->document_code = "Delivery Order";
        $this->newurl = 'delivery_order.php';
        $query = $o->fetchInvoiceDetail(" AND invoice_id = '$this->invoice_id'","","",0);
        $inv_id = $this->invoice_id;
        if($query){
            $this->invoice_generate_from = $this->invoice_id;
            $this->invoice_generate_from_type = $this->document_type;
            $this->document_type = $this->generate_document_type;
            $r = mysql_fetch_array($query);
            if($this->generateOrder($r)){
                $this->neworder_id = $this->order_id;
                $o->invoice_id = $inv_id;
                //$order->order_id = $this->order_id;
                $query = $o->fetchInvoiceLineDetail("","","",0);
                $this->order_disctotal = $o->getTotalDiscAmt();
                $this->order_subtotal = $o->getSubTotalAmt();
                $this->order_taxtotal = $o->getTotalGstAmt();

                $this->order_id = $this->neworder_id;
                $this->updateOrderTotal();
                while($row = mysql_fetch_array($query)){
                    $this->generateOrderLine($row,$this->neworder_id);
                }
                return true;
            }else{
                return false;
            } 
        }
        }else{
            if($this->fetchOrderDetail(" AND order_id = '$this->order_id'","","",1)){
                $this->order_generate_from = $this->order_id;
                $this->order_generate_from_type = $this->order_prefix_type;
                $this->document_type = $this->generate_document_type;
                if($this->generate_document_type == 'SI'){
                    $this->document_code = "Sales Invoice";
                    $this->newurl = 'sales_invoice.php';
    //                $generate = $this->getGeneratedSql(" op.order_id = '$this->order_id'");
    //                $rq = $this->fetchOrderDetail(" AND order_id = '{$generate['qt_id']}'","","",0);//Since PO generate SO, so we need find quotation customer detail
    //                $ro = mysql_fetch_array($rq);
    //                $this->order_customer = $ro['order_customer'];
    //                $p->fetchPartnerDetail(" AND partner_id = '$this->order_customer'","","",1);
    //                $this->order_billaddress = $p->partner_bill_address;
    //                if($p->partner_ship_address == ""){
    //                    $this->order_shipaddress = $p->partner_bill_address;
    //                }else{
    //                    $this->order_shipaddress = $p->partner_ship_address;
    //                }
    //                $this->order_attentionto = $ro['order_attentionto'];
                    //$this->newurl = 'sales_order.php';
                }else if($this->generate_document_type == 'PO'){
                    $this->document_code = "Purchase Order";
                    $p->fetchPartnerDetail(" AND partner_id = '$this->order_customer'","","",1);
                    $this->order_billaddress = $p->partner_bill_address;
                    //$this->order_attentionto = "";
                    $this->newurl = 'purchase_order.php';
                }else if($this->generate_document_type == 'GRN'){
                    $this->document_code = "Goods Received Note";
                    $p->fetchPartnerDetail(" AND partner_id = '$this->order_customer'","","",1);
                    $this->order_billaddress = $p->partner_bill_address;
                    //$this->order_attentionto = "";
                    $this->newurl = 'grn.php';
                }else if($this->generate_document_type == 'PU'){
                    $this->document_code = "Pickup List";
                    $p->fetchPartnerDetail(" AND partner_id = '$this->order_customer'","","",1);
                    $this->order_billaddress = $p->partner_bill_address;
                    //$this->order_attentionto = "";
                    $this->newurl = 'pickup.php';
                }
                $this->order_date = system_date;
                $this->order_revtimes = 0;
                $this->order_revdatetime = "";
                $this->order_revby = 0;
                $this->isgenerate = true;
                if($this->createOrder()){
                    $this->neworder_id = $this->order_id;
                    $this->order_id = $this->order_generate_from;//user old order id get total detail
                    $query = $this->fetchOrderLineDetail("","","",0);

                    $this->order_disctotal = $this->getTotalDiscAmt();
                    $this->order_subtotal = $this->getSubTotalAmt();
                    $this->order_taxtotal = $this->getTotalGstAmt();
                    $this->order_id = $this->neworder_id;
                    $this->updateOrderTotal();
                    while($row = mysql_fetch_array($query)){
                        $this->generateOrderLine($row,$this->neworder_id);
                    }

                    return true;
                }else{
                    return false;
                } 
          }else{
              return false;
          } 
        }
    }
    public function generateOrderLine($r,$order_id){
        if($this->document_type == 'DO'){
            $db_tbl = 'invl';
            $line_parent_type = 'Invoice';
        }else{
            $db_tbl = 'ordl';
            $line_parent_type = 'Order';
        }
        $table_field = array('ordl_order_id','ordl_pro_id','ordl_pro_desc','ordl_qty','ordl_uom',
                             'ordl_uprice','ordl_disc','ordl_istax','ordl_taxamt','ordl_total',
                             'ordl_pro_no','ordl_discamt','ordl_seqno','ordl_parent',
                             'ordl_fuprice','ordl_ftotal','ordl_fdiscamt',
                             'ordl_ftaxamt','ordl_pro_remark','ordl_parent_type','ordl_pfuprice',
                             'ordl_delivery_date','ordl_item_type','ordl_product_location');
        $table_value = array($order_id,$r[$db_tbl.'_pro_id'],escape(htmlspecialchars_decode($r[$db_tbl.'_pro_desc'])),$r[$db_tbl.'_qty'],$r[$db_tbl.'_uom'],
                             $r[$db_tbl.'_uprice'],$r[$db_tbl.'_disc'],$r[$db_tbl.'_istax'],$r[$db_tbl.'_taxamt'],$r[$db_tbl.'_total'],
                             escape(htmlspecialchars_decode($r[$db_tbl.'_pro_no'])),$r[$db_tbl.'_discamt'],$r[$db_tbl.'_seqno'],$r[$db_tbl.'_id'],
                             $r[$db_tbl.'_fuprice'],$r[$db_tbl.'_ftotal'],$r[$db_tbl.'_fdiscamt'],
                             $r[$db_tbl.'_ftaxamt'],escape(htmlspecialchars_decode($r[$db_tbl.'_pro_remark'])),$line_parent_type,$r[$db_tbl.'_pfuprice'],
                             $r[$db_tbl.'_delivery_date'],$r[$db_tbl.'_item_type'],$r[$db_tbl.'_product_location']);
        $this->fetchOrderDetail(" AND order_id = '$order_id'","","",1);
        $remark = "Insert $this->document_code Line.<br> Document No : $this->order_no";
        if(!$this->save->SaveData($table_field,$table_value,'db_ordl','ordl_id',$remark)){
           return false;
        }else{
           $this->ordl_id = $this->save->lastInsert_id;
           if($this->document_type == 'PU'){
               if(!$this->generateStockTransaction($this->ordl_id,'out')){
                   return false;
               }
               else{
                   return true;
               }
           }else if($this->document_type == 'GRN'){
               if(!$this->generateStockTransaction($this->ordl_id,'in')){
                   return false;
               }
               else{
                   return true;
               }
           }else{
               return true;
           }       
        }
    }
    public function generateStockTransaction($ordl_id,$action){
        include_once 'Product.php';
        include_once 'Package.php';
        $p = new Product();   
        $g = new Package();   
        //$packProdQty[] = array();
        $product_qty = 0;
        $this->fetchOrderLine2Detail(" AND ol.ordl_id = '$ordl_id'","","",1);
        if($this->ordl_item_type == 'product'){
            $p->fetchProductDetail(" AND product_id = '$this->ordl_pro_id'","","",1);
            $product_qty = $this->ordl_qty;
            if($action=='out'){            
                $stock_balance = $p->product_stock - $product_qty;
                $stock_desc = 'OUT';
                $pro_table_field = array('product_stock');        
                $pro_table_value = array($stock_balance);
            }else if($action=='in'){
                $stock_balance = $p->product_stock + $product_qty;
                $stock_desc = 'IN';
                $pro_table_field = array('product_stock');        
                $pro_table_value = array($stock_balance);
            }
            $st_table_field = array('documentline_id','ref_id','quantity','type',
                             'item_id','uom','cost','custsupp_id',
                             'document_date');
            $st_table_value = array($this->ordl_id,$this->ordl_order_id,$this->ordl_qty,$stock_desc,
                                $this->ordl_pro_id,$this->ordl_uom,$this->product_cost_price,$this->order_customer,
                                system_date);

            $remark = "Insert $this->ordl_pro_id transaction.<br> Document No : $this->order_no";
            $remarkProduct = "Update $p->product_id stock transaction.<br> Document No : $this->order_no";
            if(!$this->save->SaveData($st_table_field,$st_table_value,'db_stock_transaction','transaction_id',$remark)){
               return false;
            }else{
                if(!$this->save->UpdateData($pro_table_field,$pro_table_value,'db_product','product_id',$remarkProduct,$this->ordl_pro_id)){
                    return false;
                }
                else{
                    return true;
                }
            }
        }else if($this->ordl_item_type == 'package'){
            $query = $g->fetchPackageDetail(" AND package_id = '$this->ordl_pro_id'","","",0);
            while($row = mysql_fetch_array($query)){
                $p->fetchProductDetail(" AND product_id = '".$row['package_product_id']."'","","",1);
                $product_qty = $this->ordl_qty * $row['package_product_qty'];                
                if($action=='out'){            
                    $stock_balance = $p->product_stock - $product_qty;
                    $stock_desc = 'OUT';
                    $pro_table_field = array('product_stock');        
                    $pro_table_value = array($stock_balance);
                }else if($action=='in'){
                    $stock_balance = $p->product_stock + $product_qty;
                    $stock_desc = 'IN';
                    $pro_table_field = array('product_stock');        
                    $pro_table_value = array($stock_balance);
                }
                $st_table_field = array('documentline_id','ref_id','quantity','type',
                                 'item_id','uom','cost','custsupp_id',
                                 'document_date');
                $st_table_value = array($this->ordl_id,$this->ordl_order_id,$product_qty,$stock_desc,
                                    $row['package_product_id'],$this->ordl_uom,$row['product_cost_price'],$this->order_customer,
                                    system_date);

                $remark = "Insert $this->ordl_pro_id transaction.<br> Document No : $this->order_no";
                $remarkProduct = "Update $p->product_id stock transaction.<br> Document No : $this->order_no";
                if(!$this->save->SaveData($st_table_field,$st_table_value,'db_stock_transaction','transaction_id',$remark)){
                   return false;
                }else{
                    if(!$this->save->UpdateData($pro_table_field,$pro_table_value,'db_product','product_id',$remarkProduct,$row['package_product_id'])){
                        return false;
                    }
                }
                $product_qty = 0;
            }
            return true;
        }else{
            return false;
        }                
    }    
    public function updateStockTransaction($ordl_id,$action){
        include_once 'Product.php';
        include_once 'Package.php';
        $p = new Product();  
        $g = new Package();
        $product_qty = 0;
        $this->fetchOrderLine2Detail(" AND ol.ordl_id = '$ordl_id'","","",1);
        if($this->ordl_item_type == 'product'){
            $product_qty = $this->ordl_qty;        
            $p->fetchProductDetail(" AND product_id = '$this->ordl_pro_id'","","",1);
            $this->fetchPrevOrderLineDetail(" AND documentline_id = '$ordl_id' AND item_id = '$this->ordl_pro_id' AND type='$action'","","",1);
            $prev_qty = $this->trans_ordl_qty;
            if($action=='out'){            
                $stock_balance = ($p->product_stock + $prev_qty) - $product_qty;
                $stock_desc = 'OUT';
                $pro_table_field = array('product_stock');        
                $pro_table_value = array($stock_balance);
            }else if($action=='in'){
                $stock_balance = ($p->product_stock - $prev_qty) + $product_qty;
                $stock_desc = 'IN';
                $pro_table_field = array('product_stock');        
                $pro_table_value = array($stock_balance);
            }
            $st_table_field = array('documentline_id','ref_id','quantity','type',
                                    'item_id','uom','cost','custsupp_id',
                                    'document_date');
            $st_table_value = array($this->ordl_id,$this->ordl_order_id,$this->ordl_qty,$stock_desc,
                                    $this->ordl_pro_id,$this->ordl_uom,$this->product_cost_price,$this->order_customer,
                                    system_date);
            $remark = "Insert $this->ordl_pro_id transaction.<br> Document No : $this->order_no";
            $remarkProduct = "Update $p->product_id stock transaction.<br> Document No : $this->order_no";
            if(!$this->save->SaveData($st_table_field,$st_table_value,'db_stock_transaction','transaction_id',$remark)){
               return false;
            }else{
                if(!$this->save->UpdateData($pro_table_field,$pro_table_value,'db_product','product_id',$remarkProduct,$this->ordl_pro_id)){
                    return false;
                }
                else{
                    return true;
                }
            }
        }else if($this->ordl_item_type == 'package'){
            $query = $g->fetchPackageDetail(" AND package_id = '$this->ordl_pro_id'","","",0);
            while($row = mysql_fetch_array($query)){
               $p->fetchProductDetail(" AND product_id = '$this->ordl_pro_id'","","",1);
               $product_qty = $this->ordl_qty * $row['package_product_qty'];
               $this->fetchPrevOrderLineDetail(" AND documentline_id = '$ordl_id' AND item_id = '$this->ordl_pro_id' AND type='$action'","","",1);
               $prev_qty = $this->trans_ordl_qty;
               if($action=='out'){            
                    $stock_balance = ($p->product_stock + $prev_qty) - $product_qty;
                    $stock_desc = 'OUT';
                    $pro_table_field = array('product_stock');        
                    $pro_table_value = array($stock_balance);
                }else if($action=='in'){
                    $stock_balance = ($p->product_stock - $prev_qty) + $product_qty;
                    $stock_desc = 'IN';
                    $pro_table_field = array('product_stock');        
                    $pro_table_value = array($stock_balance);
                }
                $st_table_field = array('documentline_id','ref_id','quantity','type',
                                        'item_id','uom','cost','custsupp_id',
                                        'document_date');
                $st_table_value = array($this->ordl_id,$this->ordl_order_id,$this->ordl_qty,$stock_desc,
                                        $this->ordl_pro_id,$this->ordl_uom,$this->product_cost_price,$this->order_customer,
                                        system_date);
                $remark = "Insert $this->ordl_pro_id transaction.<br> Document No : $this->order_no";
                $remarkProduct = "Update $p->product_id stock transaction.<br> Document No : $this->order_no";
                if(!$this->save->SaveData($st_table_field,$st_table_value,'db_stock_transaction','transaction_id',$remark)){
                   return false;
                }else{
                    if(!$this->save->UpdateData($pro_table_field,$pro_table_value,'db_product','product_id',$remarkProduct,$this->ordl_pro_id)){
                        return false;
                    }
                    else{
                        return true;
                    }
                }
            }
        }                       
    }
    public function getInvoiceGenerateTabTable(){
      include_once 'Invoice.php';
      $invc = new Invoice();
      if($this->document_type == 'QT'){  
            $document_type = 'Sales Invoice';
            $partner_field = 'Customer';
            $generate_to = 'SI';
            $menu_id = '14';// sales invoice menu id is 13
            $document_url = 'sales_invoice.php';
      }else if($this->document_type == 'SCN'){
            $document_type = 'Credit Note (Sales)';
            $partner_field = 'Customer';//'Supplier';
            $generate_to = 'SCN';
            $menu_id = '78';// sales_cn menu id is 78
            $document_url = 'sales_cn.php'; 
      }elseif($this->document_type == 'PO'){
            $document_type = 'Credit Note (Purchase)';
            $partner_field = 'Supplier';//'Supplier';
            $generate_to = 'PCN';
            $menu_id = '84';// sales_cn menu id is 78
            $document_url = 'purchase_cn.php'; 
      }else{
            $document_type = 'Purchase Invoice';
            $partner_field = 'Supplier';
            $generate_to = 'PI';
            $menu_id = '54';// purchase invoice menu id is 13
            $document_url = 'purchase_invoice.php';   
      }
    ?>
    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title"><?php echo $document_type;?> Table</h3></div>
          <div class = "pull-right">
            <?php 
            if(getWindowPermission($menu_id,'generate')){
                $allow = false;
                if(($this->document_type == 'DO') && ($this->generated['inv_id'] <= 0)){
                    $allow = true;
                }else if(($this>document_type == 'PO') && (sizeof($this->getGenerateLineData()))){
                    $allow = true;
                }else{
                    $allow = true;
                }
                if($allow){
            ?>
               <button type = 'button' class = "btn btn-primary generate_btn" generateto = "<?php echo $generate_to;?>">Generate <?php echo $document_type;?></button>
            <?php }
            }?>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
                <th style = 'width:15%'>Document No</th>
                <th style = 'width:15%'><?php echo $partner_field;?></th>
                <th style = 'width:10%'>Date</th>
                <th style = 'width:15%'>Sub Total</th>
                <th style = 'width:10%'>Tax</th>
                <th style = 'width:10%'>Grand Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php   
              $sql = "SELECT i.*,partner.partner_name,empl.empl_name 
                      FROM db_invoice i 
                      INNER JOIN db_partner partner ON partner.partner_id = i.invoice_customer
                      LEFT JOIN db_empl empl ON empl.empl_id = i.invoice_salesperson
                      WHERE i.invoice_generate_from = '$this->order_id' AND i.invoice_status = '1'";
              $query = mysql_query($sql);
              $i = 1;
              while($row = mysql_fetch_array($query)){
                  $invc->invoice_id = $row['invoice_id'];
                  $subtotal = $invc->getSubTotalAmt() - $invc->getTotalDiscAmt();
                  $gst = ROUND($subtotal*(system_gst_percent/100),2);
                  $total = $subtotal + $gst;
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['invoice_no'];?></td>
                    <td><?php echo $row['partner_name'];?></td>
                    <td><?php echo $row['invoice_date'];?></td>
                    <td><?php echo num_format($subtotal);?></td>
                    <td><?php echo num_format($gst);?></td>
                    <td><?php echo num_format($total);?></td>
                    <td class = "text-align-right">
                        <?php 
                        if(getWindowPermission($menu_id,'update')){
                        ?>
                        <button type="button" class="btn btn-primary btn-info " onclick = "location.href = '<?php echo $document_url;?>?action=edit&invoice_id=<?php echo $row['invoice_id'];?>'">View</button>
                        <?php }?>
                    </td>
                </tr>
            <?php    
                $i++;
              }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    <?php
    }
    public function generateOrder($r){
        if($this->document_type == 'DO'){
            $db_tbl = 'invoice';
        }
        else{
            $db_tbl = 'order';
        }
        //$subprefix = getDataCodeBySql("project_code","db_project"," WHERE project_id = '{$r['order_project_id']}'","");
        //$subprefix = "/" . $subprefix . "/" . getDataCodeBySql("partner_code","db_partner"," WHERE partner_id = '{$r['order_customer']}'","") . "/";
        $order_no = get_prefix_value($this->document_code,true,system_date,$subprefix);
        $table_field = array('order_no','order_date','order_customer','order_salesperson',
                             'order_billaddress','order_attentionto','order_shipterm','order_term',
                             'order_shipaddress','order_customerref','order_remark','order_customerpo',
                             'order_currency','order_currencyrate','order_status','order_prefix_type',
                             'order_generate_from','order_outlet','order_attentionto_phone',
                             'order_fax','order_project_id','order_subcon','order_shipping_id',
                             'order_paymentterm_id','order_delivery_id','order_price_id','order_validity_id',
                             'order_transittime_id','order_freightcharge_id','order_pointofdelivery_id','order_prefix_id',
                             'order_remarks_id','order_country_id','order_generate_from_type','order_attentionto_email','order_attentionto_name',
                             'order_regards','order_tnc','order_notes');
        $table_value = array($order_no,system_date,$r[$db_tbl.'_customer'],$r[$db_tbl.'_salesperson'],
                             $r[$db_tbl.'_billaddress'],$r[$db_tbl.'_attentionto'],$r[$db_tbl.'_shipterm'],$r[$db_tbl.'_term'],
                             $r[$db_tbl.'_shipaddress'],$r[$db_tbl.'_customerref'],$r[$db_tbl.'_remark'],$r[$db_tbl.'_customerpo'],
                             $r[$db_tbl.'_currency'],$r[$db_tbl.'_currency'],1,$this->document_type,
                             $r[$db_tbl.'_id'],$_SESSION['empl_outlet'],$r[$db_tbl.'_attentionto_phone'],
                             $r[$db_tbl.'_fax'],$r[$db_tbl.'_project_id'],$r[$db_tbl.'_subcon'],$r[$db_tbl.'_shipping_id'],
                             $r[$db_tbl.'_paymentterm_id'],$r[$db_tbl.'_delivery_id'],$r[$db_tbl.'_price_id'],$r[$db_tbl.'_validity_id'],
                             $r[$db_tbl.'_transittime_id'],$r[$db_tbl.'_freightcharge_id'],$r[$db_tbl.'_pointofdelivery_id'],$r[$db_tbl.'_prefix_id'],
                             $r[$db_tbl.'_remarks_id'],$r[$db_tbl.'_country_id'],$r[$db_tbl.'_prefix_type'],$r[$db_tbl.'_attentionto_email'],$r[$db_tbl.'_attentionto_name'],
                             $r[$db_tbl.'_regards'],$r[$db_tbl.'_tnc'],$r[$db_tbl.'_notes']);
        $remark = "Insert $this->document_code.<br> Document No : $order_no";
        if(!$this->save->SaveData($table_field,$table_value,'db_order','order_id',$remark)){
           return false;
        }else{
           $this->order_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function changeOrderStatus($status,$order_id){
        $table_field = array('order_status');
        $table_value = array($status);
        $remark = "Update $this->document_code.<br> Document No : $this->order_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_order','order_id',$remark,$order_id)){
           return false;
        }else{
           return true;
        }
    }
    public function getRevQuotationOrderId($order_no){
        $sql = "SELECT * FROM db_order WHERE order_no = '$order_no' AND order_revtimes > 0 and order_status = '1'";
        $query = mysql_query($sql);
        if($row = mysql_fetch_array($query)){
            $this->rev_neworder_id = $row['order_id'];
            $this->rev_neworder_no = $row['order_no'];
            $this->rev_neworder_revtimes = $row['order_revtimes'];
        }
    }
    public function duplicate(){
       
        if($this->fetchOrderDetail(" AND order_id = '$this->order_id'","","",1)){
            $this->order_rev = 0;
            $this->order_revby = 0;
            $this->order_generate_from = 0;
            $this->order_revtimes = 0;
            $this->order_revdatetime = 0;
            $this->order_generate_from = 0;
            $query_line = $this->fetchOrderLineDetail("","","",0);
            if($this->createOrder()){
                while($row_line = mysql_fetch_array($query_line)){
                    $row_line['ordl_id'] = 0;
                    $this->generateOrderLine($row_line,$this->order_id);
                }
                $this->order_disctotal = $this->getTotalDiscAmt();
                $this->order_subtotal = $this->getSubTotalAmt();
                $this->order_taxtotal = $this->getTotalGstAmt();
                $this->updateOrderTotal();
                return true;
            }else{
                $this->error_msg = "Transaction header cannot create.";
                return false;
            }
        }else{
            $this->error_msg = "Transaction record not found.";
            return false;
        }
    }
    public function getGeneratedSql($wherestring,$returnsql = 0){
       $sql = "SELECT COALESCE(op.order_id,0) as po_id,
                      COALESCE(os.order_id,0) as so_id,
                      COALESCE(od.order_id,0) as do_id,
                      COALESCE(iv.invoice_id,0) as inv_id,
                      COALESCE(ip.invoice_id,0) as ip_id,
                      COALESCE(ot.order_id,0) as qt_id
               FROM db_order ot
               LEFT JOIN db_order op ON op.order_generate_from = ot.order_id AND op.order_status = 1
               LEFT JOIN db_order os ON os.order_generate_from = op.order_id AND os.order_status = 1
               LEFT JOIN db_order od ON od.order_generate_from = os.order_id AND od.order_status = 1
               LEFT JOIN db_invoice iv ON iv.invoice_generate_from = od.order_id AND iv.invoice_status = 1
               LEFT JOIN db_invoice ip ON ip.invoice_generate_from = od.order_id AND ip.invoice_status = 1
o               WHERE  $wherestring"; 

       if($returnsql == 1){
           return $sql;
       }else{
           $query = mysql_query($sql);
           if($row = mysql_fetch_array($query)){
               $so_id = $row['so_id'];
               $do_id = $row['do_id'];
               $inv_id = $row['inv_id'];
               $po_id = $row['po_id'];
               $qt_id = $row['qt_id'];
               $ip_id = $row['ip_id'];
           }else{
               $so_id = 0;
               $do_id = 0;
               $inv_id = 0;
               $po_id = 0;
               $qt_id = 0;
               $ip_id = 0;
           }
           return array('qt_id'=>$qt_id,'po_id'=>$po_id,'so_id'=>$so_id,'do_id'=>$do_id,'inv_id'=>$inv_id,'ip_id'=>$ip_id);
       }
    }
    public function generateDialogForm(){
        global $language,$lang;

    ?>
    <script>
    $(document).ready(function() {
        $('.generate_lineitem_btn').on('click',function(){
            if(confirm('Confirm generate those items?')){
                var data = "action=generatelineitems&generate_document_type=" + $('#generate_type').val() + "&order_id=<?php echo $this->order_id;?>&" + $('#generatelineform').serialize();
                 $.ajax({
                    type: "POST",
                    url: "<?php echo $this->document_url;?>",  
                    data:data,
                    success: function(data) {
                        var jsonObj = eval ("(" + data + ")");
                        if(jsonObj.status == 1){
                            alert("<?php echo $language[$lang]['generate_success'];?>");
                            window.location.href = "<?php echo $this->document_url;?>?action=edit&isbottom=1&order_id=<?php echo $_REQUEST['order_id']?>&tab="+jsonObj.tab;
                        }else{
                            alert("<?php echo $language[$lang]['generate_error'];?>");
                        }
                    }
                 });
            }
        });
        
        $('.generate_cancel_btn').on('click',function(){
            var remark = prompt("Please enter remark", "");
            if(remark != null){
                var data = "action=cancellineitems&generate_document_type=PI&order_id=<?php echo $this->order_id;?>&ordl_cancel_remark=" + encodeURIComponent(remark) + "&" + $('#generatelineform').serialize();
                 $.ajax({
                    type: "POST",
                    url: "purchase_order.php",  
                    data:data,
                    success: function(data) {
                        var jsonObj = eval ("(" + data + ")");
                        if(jsonObj.status == 1){
                            alert("<?php echo $language[$lang]['cancel_success'];?>");
                            window.location.href = "<?php echo $this->document_url;?>?action=edit&isbottom=1&order_id=<?php echo $_REQUEST['order_id']?>&tab="+jsonObj.tab;
                        }else{
                            alert("<?php echo $language[$lang]['cancel_fail'];?>");
                        }
                    }
                 });
            }
        });

    });
    </script>
    <div class="modal fade modal-wide" id="generate_model" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id = 'generate_multi_line_title' >Generate <?php echo $title;?></h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-9">
                    <div class="form-group">
                      <div class="col-sm-1">
                          Project
                      </div>
                      <div class="col-sm-1">
                          :
                      </div>
                      <div class="col-sm-7">
                          <b><?php echo getDataCodeBySql("CONCAT(project_code ,' - ' ,project_name)","db_project"," WHERE project_id = '$this->order_project_id'","");?></b>
                      </div>
                    </div>
                    <div style = 'clear:both' ></div>
                    <div class="form-group">
                      <div class="col-sm-1">
                          <?php echo $this->custsupp_label;?>
                      </div>
                      <div class="col-sm-1">
                          :
                      </div>
                      <div class="col-sm-7">
                          <b><?php echo getDataCodeBySql("CONCAT(partner_code ,' - ' ,partner_name)","db_partner"," WHERE partner_id = '$this->order_customer'","");?></b>
                      </div>
                    </div>
                </div>
                <div style = 'clear:both' ></div>
                <form id = 'generatelineform' >
                    <table class = 'table tablenoborder table-empl-detail' style = 'margin-top:20px;' >
                        <th style = 'width:5%'>No.</th>
                        <th style = 'width:5%'>Document No.</th>
                        <th style = 'width:5%'>Document Date</th>
                        <th style = 'width:5%'>Order By</th>
                        <tr id = 'generatelasttr'></tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <?php if($_SESSION['empl_group'] == 1){?>
              <button type="button" class="btn bg-yellow generate_cancel_btn" >Cancel Product</button>
              <?php }?>
              <button type="button" class="btn btn-info generate_lineitem_btn" >Save</button>
              <input type = "hidden" id = 'generate_type' value = ""/>
            </div>
          </div>

        </div>
  </div>
    <?php
    }
    public function getGenerateLineData($wherestring){
        
        //get total invoice generated quantity
        $subsql = "SELECT SUM(ordl.ordl_qty) 
                   FROM db_ordl ordl 
                   INNER JOIN db_order o ON o.order_id = ordl.ordl_order_id
                   WHERE ordl.ordl_parent = ordl.ordl_id AND o.order_status IN ('1','2')";
        
        $sql = "SELECT a.* FROM (
                SELECT ordl.*,COALESCE(($subsql),0) as generated_qty
                FROM db_order o
                INNER JOIN db_ordl ordl ON ordl.ordl_order_id = o.order_id
                WHERE o.order_status IN ('1','2') AND o.order_id = '$this->order_id' $wherestring AND ordl_cancel_remark  = ''
                )a 
                WHERE (a.ordl_qty - a.generated_qty) > 0
                ";

        $query = mysql_query($sql);
        $json = array();
        while($row = mysql_fetch_array($query)){
            
            $data["ordl_id"] = $row['ordl_id'];
            $data["ordl_pro_no"] = $row['ordl_pro_no'];
            $data["ordl_pro_id"] = $row['ordl_pro_id'];
            $data["ordl_pro_desc"] = $row['ordl_pro_desc'];
            $data["ordl_qty"] = num_format($row['ordl_qty']);
            $data["ordl_uom"] = getDataCodeBySql("uom_code","db_uom"," WHERE uom_id = '{$row['ordl_uom']}'","");
            $data["ordl_fuprice"] = $row['ordl_fuprice'];
            //Balance quantity
            $data["balance"] = num_format($row['ordl_qty'] - $row['generated_qty']);
            $json[] = $data;
        }
        return $json;
    }
    public function getMultiGenerateLineData(){
        //get this document detail
        $r = $this->fetchOrderDetail(" AND order_id = '$this->order_id'", $orderstring, $wherelimit, 2);
        $order_customer = $r['order_customer'];
        $order_project_id = $r['order_project_id'];
        
        
        //get total invoice generated quantity
        $subsql = "SELECT SUM(b.ordl_qty) 
                   FROM db_ordl b 
                   INNER JOIN db_order c ON c.order_id = b.ordl_order_id
                   WHERE b.ordl_parent = ordl.ordl_id AND c.order_status IN ('1','2')";
        
        $sql = "SELECT a.* FROM (
                SELECT ordl.*,o.order_no,o.order_id,o.order_date,o.order_salesperson_prefix,o.order_salesperson,COALESCE(($subsql),0) as generated_qty
                FROM db_order o
                INNER JOIN db_ordl ordl ON ordl.ordl_order_id = o.order_id
                WHERE o.order_prefix_type = 'PRF' AND o.order_status IN ('1','2') AND o.order_customer = '$order_customer' 
                AND o.order_project_id = '$order_project_id'  AND ordl_cancel_remark  = ''
                )a 
                WHERE (a.ordl_qty - a.generated_qty) > 0
                ORDER BY a.order_id,a.order_no
                ";

        $query = mysql_query($sql);
        $json = array();
        while($row = mysql_fetch_array($query)){
            
            $data["order_id"] = $row['order_id'];
            $data["order_date"] = $row['order_date'];
            $data["order_no"] = $row['order_no'];
            if($row['order_salesperson_prefix'] == 'SUBCON'){
                $data["sales_person_name"] = getDataCodeBySql("partner_name","db_partner"," WHERE partner_id = '{$row['order_salesperson']}'","");
            }else{
                $data["sales_person_name"] = getDataCodeBySql("empl_name","db_empl"," WHERE empl_id = '{$row['order_salesperson']}'","");
            }
            
            
            $data["ordl_id"] = $row['ordl_id'];
            $data["ordl_pro_no"] = $row['ordl_pro_no'];
            $data["ordl_pro_id"] = $row['ordl_pro_id'];
            $data["ordl_pro_desc"] = $row['ordl_pro_desc'];
            $data["ordl_qty"] = num_format($row['ordl_qty']);
            $data["ordl_uom"] = getDataCodeBySql("uom_code","db_uom"," WHERE uom_id = '{$row['ordl_uom']}'","");
            $data["ordl_fuprice"] = $row['ordl_fuprice'];
            //Balance quantity
            $data["balance"] = num_format($row['ordl_qty'] - $row['generated_qty']);
            $json[] = $data;
        }
        return $json;
    }
    public function getProjectTotalPOAmount($wherestring){
        
        //previous purchase order amount
        $sql = "SELECT SUM(o.order_grandtotal) as total
                FROM db_order o
                WHERE o.order_status = 1 $wherestring";
        $query = mysql_query($sql);
        if($row = mysql_fetch_array($query)){
            $previous_total = $row['total'];
        }else{
            $previous_total = 0;
        }

        return $previous_total;
    }
    public function getPRFForm($label_col_sm,$field_col_sm,$disabled){
        global $mandatory; 
    ?>
        <div class="form-group">
            <label for="order_code" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->document_code;?> No.</label>
            <div class="<?php echo $field_col_sm;?>">
              <input type="text" class="form-control" id="order_no" name="order_no" value = "<?php if(($this->order_revtimes > 0) && ($this->document_type == 'QT')){ echo $this->order_no . " (Rev $this->order_revtimes)";}else{ echo $this->order_no;}?>" <?php if($this->document_type == 'PO'){ echo '';}else{ echo 'READONLY';}?>>
            </div>
            <label for="order_date" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->document_code;?> Date</label>
            <div class="<?php echo $field_col_sm;?>">
              <input type="text" <?php if($this->document_type == 'PRF'){ echo 'READONLY';}?> class="form-control <?php if($this->document_type != 'PRF'){ echo 'datepicker';}?>" id="order_date" name="order_date" value = "<?php echo format_date($this->order_date);?>" placeholder=" <?php echo $this->document_code;?> Date" <?php echo $disabled;?>>
            </div>
        </div>  
            <div class="form-group" <?php if($this->document_type == 'PO' || $this->document_type == 'GRN' || $this->document_type == 'DO' || $this->document_type == 'PU'){ echo "style = 'display:none'";}?>>
              <label for="order_project_id" class="<?php echo $label_col_sm;?> control-label">Project Name <?php echo $mandatory;?></label>
              <div class="<?php echo $field_col_sm;?>">
                   <select class="form-control select2" id="order_project_id" name="order_project_id" <?php echo $disabled;?> >
                       <?php echo $this->projectCrtl;?>
                   </select>
              </div>
              <label for="order_job_no" class="<?php echo $label_col_sm;?> control-label">Job No.</label>
              <div class="<?php echo $field_col_sm;?>">
                <input type="text" class="form-control" id="order_job_no" name="order_job_no" value = "<?php echo $this->order_job_no;?>" placeholder="Job No." <?php echo $disabled;?> READONLY>
              </div>
            </div>
            <div class="form-group">
              <?php if($this->document_type != 'PRF'){?>  
              <label for="order_customer" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->custsupp_label;?> <?php echo $mandatory;?></label>
              <div class="<?php echo $field_col_sm;?>">
                   <select class="form-control select2" id="order_customer" name="order_customer" <?php echo $disabled;?>>
                       <?php echo $this->customerCrtl;?>
                   </select>
              </div>
              <?php }?>
              <label for="order_attentionto" class="<?php echo $label_col_sm;?> control-label">Attention To</label>
                <div class="col-sm-3">
                     <select class="form-control select2" id="order_attentionto" name="order_attentionto" <?php echo $disabled;?>>
                         <?php echo $this->contactCrtl;?>
                     </select>
                     <p></p>
                    <input type="text" class="form-control" id="order_attentionto_name" name="order_attentionto_name" value = "<?php echo $this->order_attentionto_name;?>" placeholder="Attention To Name" <?php echo $disabled;?>>
                </div>
            </div>  
            <?php if($this->document_type != 'PRF'){?>
            <div class="form-group">
                <label for="order_billaddress" class="<?php echo $label_col_sm;?> control-label">Billing Address</label>
                <div class="col-sm-3">
                      <textarea class="form-control" rows="3" id="order_billaddress" name="order_billaddress" placeholder="Billing Address" <?php echo $disabled;?>><?php echo $this->order_billaddress;?></textarea>
                </div>
                <label for="order_shipaddress" class="<?php echo $label_col_sm;?> control-label">Shipping Address</label>
                <div class="col-sm-3">
                      <textarea class="form-control" rows="3" id="order_shipaddress" name="order_shipaddress" placeholder="Shipping Address" <?php echo $disabled;?>><?php echo $this->order_shipaddress;?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="order_attentionto_phone" class="<?php echo $label_col_sm;?> control-label" > Phone No. </label>
                <div class="<?php echo $field_col_sm;?>">
                    <input type="text" class="form-control" id="order_attentionto_phone" name="order_attentionto_phone" value = "<?php echo $this->order_attentionto_phone;?>" placeholder="Attention Phone" <?php echo $disabled;?>>
                </div>
                <label for="order_fax" class="<?php echo $label_col_sm;?> control-label">Fax No.</label>
                <div class="<?php echo $field_col_sm;?>">
                    <input type="text" class="form-control" id="order_fax" name="order_fax" value = "<?php echo $this->order_fax;?>" placeholder="Fax No." <?php echo $disabled;?>>
                </div>
            </div>
            <div class="form-group">
                <label for="order_attentionto_email" class="<?php echo $label_col_sm;?> control-label" > Email </label>
                <div class="<?php echo $field_col_sm;?>">
                    <input type="text" class="form-control" id="order_attentionto_email" name="order_attentionto_email" value = "<?php echo $this->order_attentionto_email;?>" placeholder="Email" <?php echo $disabled;?>>
                </div>
                <label for="order_salesperson" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->salesorderedby_label;?></label>
                <div class="<?php echo $field_col_sm;?>">
                    <?php if(($this->document_type == 'PRF') && ($this->order_id > 0)){?>
                    <input type="text" class="form-control"  value = "<?php echo $this->order_salesperson_name;?>" disabled>
                    <input type="hidden" class="form-control" id="order_salesperson" name="order_salesperson" value = "<?php echo $this->order_salesperson;?>"  <?php echo $disabled;?>>
                    <?php }else{?>
                     <select class="form-control select2" id="order_salesperson" name="order_salesperson" <?php echo $disabled;?> >
                         <?php echo $this->employeeCrtl;?>
                     </select>
                    <?php }?>
                </div>
            </div>
    <?php if($this->document_type == 'PO') { ?>
            <div class="form-group">
                <label for="order_regards" class="<?php echo $label_col_sm;?> control-label">Regards</label>
                <div class="<?php echo $field_col_sm;?>">
                    <textarea class="form-control" rows="3" id="order_regards" name="order_regards" placeholder="Regards" <?php echo $disabled;?>><?php echo $this->order_regards;?></textarea>
                </div>
                <label for="order_remarks" class="<?php echo $label_col_sm;?> control-label"> Notes </label>
                <div class="<?php echo $field_col_sm;?>">
                    <select class="form-control select2" id="order_remarks_id" name="order_remarks_id" <?php echo $disabled;?> >
                        <?php echo $this->remarksCrtl;?>
                    </select>
                  <p></p>
                  <textarea class="form-control" rows="2" id="order_remarks_remark" name="order_remarks_remark" placeholder="Remarks" <?php echo $disabled;?>><?php echo $this->order_remarks_remark;?></textarea>
                </div>
            </div>
    <?php } ?>
            <?php if($this->document_type == 'GRN') { ?>
            <div class="form-group">
                <label for="order_transittime" class="<?php echo $label_col_sm;?> control-label">Transit Time (notes) </label>
                <div class="<?php echo $field_col_sm;?>">
                    <select class="form-control select2" id="order_transittime_id" name="order_transittime_id" <?php echo $disabled;?> >
                        <?php echo $this->transittimeCrtl;?>
                    </select>
                    <p></p>
                    <textarea class="form-control" rows="2" id="order_transittime_remark" name="order_transittime_remark" placeholder="Transit Time remark" <?php echo $disabled;?>><?php echo $this->order_transittime_remark;?></textarea>
                </div>
                <label for="order_freightcharge" class="<?php echo $label_col_sm;?> control-label"> Freight Charges (notes) </label>
                <div class="<?php echo $field_col_sm;?>">
                    <select class="form-control select2" id="order_freightcharge_id" name="order_freightcharge_id" <?php echo $disabled;?> >
                        <?php echo $this->freightchargeCrtl;?>
                    </select>
                  <p></p>
                  <textarea class="form-control" rows="2" id="order_freightcharge_remark" name="order_freightcharge_remark" placeholder="Freight Charges remark" <?php echo $disabled;?>><?php echo $this->order_freightcharge_remark;?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="order_delivery" class="<?php echo $label_col_sm;?> control-label"> Delivery (notes) </label>
                <div class="<?php echo $field_col_sm;?>">
                    <select class="form-control select2" id="order_delivery_id" name="order_delivery_id" <?php echo $disabled;?> >
                        <?php echo $this->deliveryCrtl;?>
                    </select>
                    <p></p>
                    <textarea class="form-control" rows="2" id="order_delivery_remark" name="order_delivery_remark" placeholder="Delivery remark" <?php echo $disabled;?>><?php echo $this->order_delivery_remark;?></textarea>
                </div>
                <label for="order_price" class="<?php echo $label_col_sm;?> control-label"> Price (notes) </label>
                <div class="<?php echo $field_col_sm;?>">
                    <select class="form-control select2" id="order_price_id" name="order_price_id" <?php echo $disabled;?> >
                        <?php echo $this->priceCrtl;?>
                    </select>
                  <p></p>
                  <textarea class="form-control" rows="2" id="order_price_remark" name="order_price_remark" placeholder="Price remark" <?php echo $disabled;?>><?php echo $this->order_price_remark;?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="order_paymentterm" class="<?php echo $label_col_sm;?> control-label"> Payment Terms</label>
                <div class="<?php echo $field_col_sm;?>">
                    <select class="form-control select2" id="order_paymentterm_id" name="order_paymentterm_id" <?php echo $disabled;?> >
                        <?php echo $this->paymenttermCrtl;?>
                    </select>
                   <p></p>
                   <textarea class="form-control" rows="2" id="order_paymentterm_remark" name="order_paymentterm_remark" placeholder="Payment Term remark" <?php echo $disabled;?>><?php echo $this->order_paymentterm_remark;?></textarea>
                </div>
                <label for="order_validity" class="<?php echo $label_col_sm;?> control-label"> Validity (notes) </label>
                <div class="<?php echo $field_col_sm;?>">
                     <select class="form-control select2" id="order_validity_id" name="order_validity_id" <?php echo $disabled;?> >
                         <?php echo $this->validityCrtl;?>
                     </select>
                    <p></p>
                    <textarea class="form-control" rows="2" id="order_validity_remark" name="order_validity_remark" placeholder="Validity remark" <?php echo $disabled;?>><?php echo $this->order_validity_remark;?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="order_pointofdelivery" class="<?php echo $label_col_sm;?> control-label">Point of Delivery (notes) </label>
                <div class="<?php echo $field_col_sm;?>">
                    <select class="form-control select2" id="order_pointofdelivery_id" name="order_pointofdelivery_id" <?php echo $disabled;?> >
                        <?php echo $this->pointofdeliveryCrtl;?>
                    </select>
                    <p></p>
                    <textarea class="form-control" rows="2" id="order_pointofdelivery_remark" name="order_pointofdelivery_remark" placeholder="Point of Delivery remark" <?php echo $disabled;?>><?php echo $this->order_pointofdelivery_remark;?></textarea>
                </div>
                <label for="order_prefix" class="<?php echo $label_col_sm;?> control-label"> Prefix (notes) </label>
                <div class="<?php echo $field_col_sm;?>">
                    <select class="form-control select2" id="order_prefix_id" name="order_prefix_id" <?php echo $disabled;?> >
                        <?php echo $this->prefixCrtl;?>
                    </select>
                  <p></p>
                  <textarea class="form-control" rows="2" id="order_prefix_remark" name="order_prefix_remark" placeholder="Prefix remark" <?php echo $disabled;?>><?php echo $this->order_prefix_remark;?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="order_country" class="<?php echo $label_col_sm;?> control-label">Country </label>
                <div class="<?php echo $field_col_sm;?>">
                    <select class="form-control select2" id="order_country_id" name="order_country_id" <?php echo $disabled;?> >
                        <?php echo $this->countryCrtl;?>
                    </select>
                    <p></p>
                    <textarea class="form-control" rows="2" id="order_country_remark" name="order_country_remark" placeholder="Country remark" <?php echo $disabled;?>><?php echo $this->order_country_remark;?></textarea>
                </div>
                <label for="order_remarks" class="<?php echo $label_col_sm;?> control-label"> Remarks </label>
                <div class="<?php echo $field_col_sm;?>">
                    <select class="form-control select2" id="order_remarks_id" name="order_remarks_id" <?php echo $disabled;?> >
                        <?php echo $this->remarksCrtl;?>
                    </select>
                  <p></p>
                  <textarea class="form-control" rows="2" id="order_remarks_remark" name="order_remarks_remark" placeholder="Remarks" <?php echo $disabled;?>><?php echo $this->order_remarks_remark;?></textarea>
                </div>
            </div>
    
            <?php } ?> 
        <?php }?>
        <div class="form-group">
            <!--<label for="order_term_remark" class="<?php echo $label_col_sm;?> control-label">T & C</label>
            <div class="<?php echo $field_col_sm;?>">
                <textarea class="form-control" rows="3" id="order_term_remark" name="order_term_remark" placeholder="T & C" <?php echo $disabled;?>><?php echo $this->order_term_remark;?></textarea>
            </div>-->
            <label for="order_currency" class="<?php echo $label_col_sm;?> control-label"> Currency </label>
            <div class="<?php echo $field_col_sm;?>">
                <select class="form-control select2" id="order_currency" name="order_currency" <?php echo $disabled;?> >
                    <?php echo $this->currencyCrtl;?>
                </select>
            </div>
            <?php if($this->document_type != 'PRF'){?>
            <label for="order_notes" class="<?php echo $label_col_sm;?> control-label">Initial Remark</label>
            <div class="<?php echo $field_col_sm;?>">
                <textarea class="form-control" rows="3" id="order_notes" name="order_notes" placeholder="Initial Remark" <?php echo $disabled;?>><?php echo $this->order_notes;?></textarea>
            </div>
            <?php }?>
        </div>
    <?php if($this->document_type == 'DO'){?>
    <div class="form-group">
        <label for="order_customerpo" class="<?php echo $label_col_sm;?> control-label">Purchase Order No.</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="order_customerpo" name="order_customerpo" value = "<?php echo $this->order_customerpo;?>" placeholder="Purchase Order No." <?php echo $disabled;?>>
        </div>
    </div>
    <?php } ?>
    <?php
    }  
    public function getPickupForm($label_col_sm,$field_col_sm,$disabled){
        global $mandatory; 
    ?>
        <div class="form-group">
            <label for="order_code" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->document_code;?> No.</label>
            <div class="<?php echo $field_col_sm;?>">
              <input type="text" class="form-control" id="order_no" name="order_no" value = "<?php if(($this->order_revtimes > 0) && ($this->document_type == 'QT')){ echo $this->order_no . " (Rev $this->order_revtimes)";}else{ echo $this->order_no;}?>" <?php if($this->document_type == 'PO'){ echo '';}else{ echo 'READONLY';}?>>
            </div>
            <label for="order_date" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->document_code;?> Date</label>
            <div class="<?php echo $field_col_sm;?>">
              <input type="text" <?php if($this->document_type == 'PRF'){ echo 'READONLY';}?> class="form-control <?php if($this->document_type != 'PRF'){ echo 'datepicker';}?>" id="order_date" name="order_date" value = "<?php echo format_date($this->order_date);?>" placeholder=" <?php echo $this->document_code;?> Date" <?php echo $disabled;?>>
            </div>
        </div> 
        <div class="form-group">
            <label for="order_do_code" class="<?php echo $label_col_sm;?> control-label">Delivery Order No.</label>
            <div class="<?php echo $field_col_sm;?>">
                <?php
                    $q2 = getDataBySql("do.order_no",'db_order pu LEFT JOIN db_order do ON pu.order_generate_from = do.order_id '," WHERE pu.order_id = '{$this->order_id}' AND (do.order_status = 1 OR do.order_status IS NULL) AND (pu.order_status = 1 OR pu.order_status IS NULL) ", $orderby);
                    while($r2 = mysql_fetch_array($q2)){
                        $do_num = $r2['order_no'];
                    }
                ?>
              <input type="text" class="form-control" id="order_do_code" name="order_do_code" value = "<?php echo $do_num; ?>" READONLY >
            </div>
            
        </div>  
            <div class="form-group">
              <?php if($this->document_type != 'PRF'){?>  
              <label for="order_customer" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->custsupp_label;?> <?php echo $mandatory;?></label>
              <div class="<?php echo $field_col_sm;?>">
                   <select class="form-control select2" id="order_customer" name="order_customer" <?php echo $disabled;?>>
                       <?php echo $this->customerCrtl;?>
                   </select>
              </div>
              <?php }?>
              <label for="order_attentionto" class="<?php echo $label_col_sm;?> control-label">Attention To</label>
                <div class="col-sm-3">
                     <select class="form-control select2" id="order_attentionto" name="order_attentionto" <?php echo $disabled;?>>
                         <?php echo $this->contactCrtl;?>
                     </select>
                     <p></p>
                    <input type="text" class="form-control" id="order_attentionto_name" name="order_attentionto_name" value = "<?php echo $this->order_attentionto_name;?>" placeholder="Attention To Name" <?php echo $disabled;?>>
                </div>
            </div>  

            
        <div class="form-group">
            <label for="order_notes" class="<?php echo $label_col_sm;?> control-label">Initial Remark</label>
            <div class="<?php echo $field_col_sm;?>">
                <textarea class="form-control" rows="3" id="order_notes" name="order_notes" placeholder="Initial Remark" <?php echo $disabled;?>><?php echo $this->order_notes;?></textarea>
            </div>
        </div>
    <?php
    } 
    public function getOrderForm($label_col_sm,$field_col_sm,$disabled){
        global $mandatory;
    ?>
    <input type ="hidden" name = 'order_requestby' value = '<?php echo $this->order_requestby;?>'/>
    <input type ="hidden" name = 'order_agc_requestby' value = '<?php echo $this->order_agc_requestby;?>'/>
    <input type ="hidden" name = 'order_delivery_date' value = '<?php echo $this->order_delivery_date;?>'/>
    <div class="form-group">
        <label for="order_code" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->document_code;?> No.</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="order_no" name="order_no" value = "<?php if(($this->order_revtimes > 0) && ($this->document_type == 'QT')){ echo $this->order_no . " (Rev $this->order_revtimes)";}else{ echo $this->order_no;}?>" READONLY>
        </div>            
        <label for="order_date" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->document_code;?> Date</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control datepicker" id="order_date" name="order_date" value = "<?php echo format_date($this->order_date);?>" placeholder=" <?php echo $this->document_code;?> Date" <?php echo $disabled;?>>
        </div>
    </div>  
    <div class="form-group">
        <label for="order_customer" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->custsupp_label;?> <?php echo $mandatory;?></label>
        <div class="<?php echo $field_col_sm;?>">
            <select class="form-control select2" id="order_customer" name="order_customer" <?php echo $disabled;?>>
                <?php echo $this->customerCrtl;?>
            </select>
        </div>
        <label for="order_attentionto" class="<?php echo $label_col_sm;?> control-label">Attention To</label>
        <div class="col-sm-3">
            <select class="form-control select2" id="order_attentionto" name="order_attentionto" <?php echo $disabled;?>>
                <?php echo $this->contactCrtl;?>
            </select>
            <p></p>
            <input type="text" class="form-control" id="order_attentionto_name" name="order_attentionto_name" value = "<?php echo $this->order_attentionto_name;?>" placeholder="Attention To Name" <?php echo $disabled;?>>
        </div>
    </div>
    <div class="form-group">
        <label for="order_billaddress" class="<?php echo $label_col_sm;?> control-label">Billing Address</label>
        <div class="col-sm-3">
              <textarea class="form-control" rows="3" id="order_billaddress" name="order_billaddress" placeholder="Billing Address" <?php echo $disabled;?>><?php echo $this->order_billaddress;?></textarea>
        </div>
        <label for="order_shipaddress" class="<?php echo $label_col_sm;?> control-label">Shipping Address</label>
        <div class="<?php echo $field_col_sm;?>">
              <textarea class="form-control" rows="3" id="order_shipaddress" name="order_shipaddress" placeholder="Shipping Address" <?php if(($this->document_type == 'SO') && ($this->generated['do_id'] == 0)){ echo '';}else{echo $disabled;}?>><?php echo $this->order_shipaddress;?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="order_attentionto_phone" class="<?php echo $label_col_sm;?> control-label" > Phone No. </label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="order_attentionto_phone" name="order_attentionto_phone" value = "<?php echo $this->order_attentionto_phone;?>" placeholder="Attention Phone" <?php echo $disabled;?>>
        </div>
        <label for="order_fax" class="<?php echo $label_col_sm;?> control-label">Fax No.</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="order_fax" name="order_fax" value = "<?php echo $this->order_fax;?>" placeholder="Fax No." <?php echo $disabled;?>>
        </div>
    </div>
    <div class="form-group">
        <label for="order_attentionto_email" class="<?php echo $label_col_sm;?> control-label" > Email </label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="order_attentionto_email" name="order_attentionto_email" value = "<?php echo $this->order_attentionto_email;?>" placeholder="Email" <?php echo $disabled;?>>
        </div>
        <label for="order_salesperson" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->salesorderedby_label;?></label>
        <div class="<?php echo $field_col_sm;?>">
            <select class="form-control select2" id="order_salesperson" name="order_salesperson" <?php echo $disabled;?> >
                <?php echo $this->employeeCrtl;?>
            </select>
        </div>
    </div>
    
    <!--
    <label for="order_shipping_id" class="<?php echo $label_col_sm;?> control-label" >Shipping Address Multi</label>
    <div class="col-sm-3">
        <select class="form-control select2" id="order_shipping_id" name="order_shipping_id" <?php if(($this->document_type == 'SO') && ($this->generated['do_id'] == 0)){ echo '';}else{echo $disabled;}?>>
            <?php echo $this->shippingCrtl;?>
        </select>
    </div>
    -->
            <!-- Hide following in Quotation -->
            <?php if($this->document_type !== 'QT' && $this->document_type !== 'DO') { ?>
            <div class="form-group">
              <label for="order_project_id" class="<?php echo $label_col_sm;?> control-label">Project Name </label>
              <div class="<?php echo $field_col_sm;?>">
                   <select class="form-control select2" id="order_project_id" name="order_project_id" <?php echo $disabled;?> >
                       <?php echo $this->projectCrtl;?>
                   </select>
              </div>
              <label for="order_type" class="<?php echo $label_col_sm;?> control-label">Quotation Type</label>
              <div class="<?php echo $field_col_sm;?>">
                   <select class="form-control select2" id="order_type" name="order_type" <?php echo $disabled;?> >
                       <option value = 'qt' <?php if($this->order_type == 'qt'){ echo 'SELECTED';}?>> Quotation</option>
                       <option value = 'vo' <?php if($this->order_type == 'vo'){ echo 'SELECTED';}?>> Variation Order</option>
                   </select>
              </div>
            </div>
            <?php } ?>
        
    <!-- Show following in Quotation -->
    <?php if($this->document_type == 'QT') { ?>
    <!--<div class="form-group">
        <label for="order_transittime" class="<?php echo $label_col_sm;?> control-label">Transit Time (notes) </label>
        <div class="<?php echo $field_col_sm;?>">
            <select class="form-control select2" id="order_transittime_id" name="order_transittime_id" <?php echo $disabled;?> >
                <?php echo $this->transittimeCrtl;?>
            </select>
            <p></p>
            <textarea class="form-control" rows="2" id="order_transittime_remark" name="order_transittime_remark" placeholder="Transit Time remark" <?php echo $disabled;?>><?php echo $this->order_transittime_remark;?></textarea>
        </div>
        <label for="order_freightcharge" class="<?php echo $label_col_sm;?> control-label"> Freight Charges (notes) </label>
        <div class="<?php echo $field_col_sm;?>">
            <select class="form-control select2" id="order_freightcharge_id" name="order_freightcharge_id" <?php echo $disabled;?> >
                <?php echo $this->freightchargeCrtl;?>
            </select>
          <p></p>
          <textarea class="form-control" rows="2" id="order_freightcharge_remark" name="order_freightcharge_remark" placeholder="Freight Charges remark" <?php echo $disabled;?>><?php echo $this->order_freightcharge_remark;?></textarea>
        </div>
    </div>-->
    <div class="form-group">
        <label for="order_delivery" class="<?php echo $label_col_sm;?> control-label"> Delivery (notes) </label>
        <div class="<?php echo $field_col_sm;?>">
            <select class="form-control select2" id="order_delivery_id" name="order_delivery_id" <?php echo $disabled;?> >
                <?php echo $this->deliveryCrtl;?>
            </select>
            <p></p>
            <textarea class="form-control" rows="2" id="order_delivery_remark" name="order_delivery_remark" placeholder="Delivery remark" <?php echo $disabled;?>><?php echo $this->order_delivery_remark;?></textarea>
        </div>
        <label for="order_price" class="<?php echo $label_col_sm;?> control-label"> Price (notes) </label>
        <div class="<?php echo $field_col_sm;?>">
            <select class="form-control select2" id="order_price_id" name="order_price_id" <?php echo $disabled;?> >
                <?php echo $this->priceCrtl;?>
            </select>
          <p></p>
          <textarea class="form-control" rows="2" id="order_price_remark" name="order_price_remark" placeholder="Price remark" <?php echo $disabled;?>><?php echo $this->order_price_remark;?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="order_paymentterm" class="<?php echo $label_col_sm;?> control-label"> Payment Terms </label>
        <div class="<?php echo $field_col_sm;?>">
            <select class="form-control select2" id="order_paymentterm_id" name="order_paymentterm_id" <?php echo $disabled;?> >
                <?php echo $this->paymenttermCrtl;?>
            </select>
           <p></p>
           <textarea class="form-control" rows="2" id="order_paymentterm_remark" name="order_paymentterm_remark" placeholder="Payment Term remark" <?php echo $disabled;?>><?php echo $this->order_paymentterm_remark;?></textarea>
        </div>
        <label for="order_validity" class="<?php echo $label_col_sm;?> control-label"> Validity (notes) </label>
        <div class="<?php echo $field_col_sm;?>">
             <select class="form-control select2" id="order_validity_id" name="order_validity_id" <?php echo $disabled;?> >
                 <?php echo $this->validityCrtl;?>
             </select>
            <p></p>
            <textarea class="form-control" rows="2" id="order_validity_remark" name="order_validity_remark" placeholder="Validity remark" <?php echo $disabled;?>><?php echo $this->order_validity_remark;?></textarea>
        </div>
    </div>
    <!--<div class="form-group">
        <label for="order_pointofdelivery" class="<?php echo $label_col_sm;?> control-label">Point of Delivery (notes) </label>
        <div class="<?php echo $field_col_sm;?>">
            <select class="form-control select2" id="order_pointofdelivery_id" name="order_pointofdelivery_id" <?php echo $disabled;?> >
                <?php echo $this->pointofdeliveryCrtl;?>
            </select>
            <p></p>
            <textarea class="form-control" rows="2" id="order_pointofdelivery_remark" name="order_pointofdelivery_remark" placeholder="Point of Delivery remark" <?php echo $disabled;?>><?php echo $this->order_pointofdelivery_remark;?></textarea>
        </div>
        <label for="order_prefix" class="<?php echo $label_col_sm;?> control-label"> Prefix (notes) </label>
        <div class="<?php echo $field_col_sm;?>">
            <select class="form-control select2" id="order_prefix_id" name="order_prefix_id" <?php echo $disabled;?> >
                <?php echo $this->prefixCrtl;?>
            </select>
          <p></p>
          <textarea class="form-control" rows="2" id="order_prefix_remark" name="order_prefix_remark" placeholder="Prefix remark" <?php echo $disabled;?>><?php echo $this->order_prefix_remark;?></textarea>
        </div>
    </div>-->
    <div class="form-group">
        <label for="order_regards" class="<?php echo $label_col_sm;?> control-label">Regards</label>
        <div class="<?php echo $field_col_sm;?>">
            <textarea class="form-control" rows="3" id="order_regards" name="order_regards" placeholder="Regards" <?php echo $disabled;?>><?php echo $this->order_regards;?></textarea>
        </div>
        <label for="order_remarks" class="<?php echo $label_col_sm;?> control-label"> Notes </label>
        <div class="<?php echo $field_col_sm;?>">
            <select class="form-control select2" id="order_remarks_id" name="order_remarks_id" <?php echo $disabled;?> >
                <?php echo $this->remarksCrtl;?>
            </select>
          <p></p>
          <textarea class="form-control" rows="2" id="order_remarks_remark" name="order_remarks_remark" placeholder="Remarks" <?php echo $disabled;?>><?php echo $this->order_remarks_remark;?></textarea>
        </div>
    </div>
    <?php } ?>
    <div class="form-group">
        <!--
        <label for="order_remark" class="<?php echo $label_col_sm;?> control-label">Remarks</label>
        <div class="<?php echo $field_col_sm;?>">
            <textarea class="form-control" rows="3" id="order_remark" name="order_remark" placeholder="Remark" <?php echo $disabled;?>><?php echo $this->order_remark;?></textarea>
        </div>
        -->
        
        <label for="order_country" class="<?php echo $label_col_sm;?> control-label">Country </label>
        <div class="<?php echo $field_col_sm;?>">
            <select class="form-control select2" id="order_country_id" name="order_country_id" <?php echo $disabled;?> >
                <?php echo $this->countryCrtl;?>
            </select>
            <p></p>
            <textarea class="form-control" rows="2" id="order_country_remark" name="order_country_remark" placeholder="Country remark" <?php echo $disabled;?>><?php echo $this->order_country_remark;?></textarea>
        </div>
        <label for="order_currency" class="<?php echo $label_col_sm;?> control-label"> Currency </label>
        <div class="<?php echo $field_col_sm;?>">
            <select class="form-control select2" id="order_currency" name="order_currency" <?php echo $disabled;?> >
                <?php echo $this->currencyCrtl;?>
            </select>
        </div>
        
    </div>
    <div class="form-group">
        <!--<label for="order_term_remark" class="<?php echo $label_col_sm;?> control-label">T & C</label>
        <div class="<?php echo $field_col_sm;?>">
            <textarea class="form-control" rows="3" id="order_term_remark" name="order_term_remark" placeholder="T & C" <?php echo $disabled;?>><?php echo $this->order_term_remark;?></textarea>
        </div>--> 
        <label for="order_regards" class="<?php echo $label_col_sm;?> control-label">Initial Remark</label>
        <div class="<?php echo $field_col_sm;?>">
            <textarea class="form-control" rows="3" id="order_notes" name="order_notes" placeholder="Initial Remark" <?php echo $disabled;?>><?php echo $this->order_notes;?></textarea>
        </div>
        <label for="order_delivery_date" class="<?php echo $label_col_sm;?> control-label" >Completion Date</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control datepicker" id="order_delivery_date" name="order_delivery_date" value = "<?php echo format_date($this->order_delivery_date);?>" placeholder="Completion Date" <?php echo $disabled;?>>
        </div>
    </div>
    <div class="form-group">
        <label for="order_attachment" class="<?php echo $label_col_sm;?> control-label">Attachment</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type = "file" name = "order_attachment[]" id = 'order_attachment' <?php echo $disabled;?>/>
            <p class="help-block">
                <?php 
                $sql = "SELECT * FROM db_image WHERE ref_id = '$this->order_id' AND ref_table = 'db_order' ORDER BY upload_field";
                $query = mysql_query($sql);
                $file_id = array();
                $file_name = array();
                $file_type = array();
                while($row = mysql_fetch_array($query)){
                    array_push($file_id, $row['image_id']);
                    array_push($file_name, $row['image']);
                    array_push($file_type, $row['image_type']);
                }
                $path = "upload/" . $this->document_type . "/" . $file_id[0] . "." . $file_type[0];
                if(file_exists($path)){?>
                 <a href = "<?php echo $path;?>" download><?php echo $file_name[0];?></a>
                <?php }?>
            </p>
            <input type = "file" name = "order_attachment[]" id = 'order_attachment' <?php echo $disabled;?>/>
            <p class="help-block">
                <?php 
                $path = "upload/" . $this->document_type . "/" . $file_id[1] . "." . $file_type[1];
                if(file_exists($path)){
                ?>
                <a href = "<?php echo $path;?>" download><?php echo $file_name[1];?></a>
               <?php }?>
            </p>
        </div>
    </div>

    <?php
    }
    public function cancelLineItems(){

        for($i=0;$i<sizeof($this->generateqty);$i++){
            if($this->generateqty[$i] <= 0){
                continue;
            }
            $ordl_id = escape($this->generateordlid[$i]);
            
            $table_field = array('ordl_cancel_remark');
            $table_value = array($this->ordl_cancel_remark);
            $remark = "Cancel line item";
            $this->save->UpdateData($table_field,$table_value,'db_ordl','ordl_id',$remark,$ordl_id);
        }
        return true;
    }
    public function reactiveCancelItems(){
            

        $table_field = array('ordl_cancel_remark');
        $table_value = array('');
        $remark = "Reactive Cancel line item";
        if($this->save->UpdateData($table_field,$table_value,'db_ordl','ordl_id',$remark,$this->ordl_id)){
            return true;
        }else{
            return false;
        }
    }
    public function saveAttachment($ref_id,$image_input){

        for($i=0;$i<sizeof($image_input['name']);$i++){
            $type = end(explode(".",$image_input['name'][$i]));
            $table_field = array('ref_table','ref_id','image','status','upload_field','image_type');
            $table_value = array("db_order",$ref_id,$image_input['name'][$i],1,$i,$type);
            $remark = "Insert db_order's attachment.";
            
            if((getDataCountBySql("db_image"," WHERE upload_field = '$i'") > 0) && ($image_input['size'][$i] > 0)){
//                echo "<pre>";
//                echo $image_input['name'][$i];die;
//                var_dump($image_input);die;
                if($this->action == 'update'){
                    $sql = "SELECT image_id,image_type FROM db_image WHERE ref_id = '$ref_id' AND upload_field = '$i'";
                    $query = mysql_query($sql);
                    if($row = mysql_fetch_array($query)){
                        unlink("upload/$this->document_type/{$row['image_id']}.{$row['image_type']}");
                    }

                    $sql = "DELETE FROM db_image WHERE ref_id = '$ref_id' AND upload_field = '$i'";
                    mysql_query($sql);
                }
            }
            
                if($image_input['size'][$i] > 0){
                    if($this->save->SaveData($table_field,$table_value,'db_image','image_id',$remark)){
                        $image_id = $this->save->lastInsert_id;
                        $this->pictureManagement($image_id,$this->document_type,$image_input,$i,$ref_id,$type);
                    }
                }
                
        }


    }
    public function pictureManagement($image_id,$folder_name,$image_input,$i,$ref_id,$type){

        if(!file_exists("upload/$folder_name")){
           mkdir("upload/$folder_name/");
        }

        if($image_input['size'][$i] > 0 ){

            
            move_uploaded_file($image_input['tmp_name'][$i],"upload/$folder_name/$image_id.$type");
        }
    }
    public function generateAttachment(){
        $sql = "SELECT FROM db_image WHERE ref_table = 'db_order'";
    }
    public function getProductHistory($wherestring){
        
        $sql = "SELECT o.order_no,o.order_date,ordl.ordl_qty,ordl.ordl_uom,ordl.ordl_fuprice,ordl.ordl_disc,ordl.ordl_fdiscamt,ordl.ordl_ftotal,ordl.ordl_id
                FROM db_order o
                INNER JOIN db_ordl ordl ON ordl.ordl_order_id = o.order_id AND ordl.ordl_pro_id = '$this->product_id'
                WHERE o.order_status = '1' AND o.order_customer = '$this->customer_id'  AND o.order_id <> '$this->order_id' $wherestring
                ORDER BY o.order_date DESC,o.order_no DESC
                limit 0,10
                ";
        $query = mysql_query($sql);
        $this->d = array();
        while($row = mysql_fetch_array($query)){
            
            $this->d[] = array('order_no'=>$row['order_no'],'order_date'=>format_date($row['order_date']),'ordl_qty'=>$row['ordl_qty'],
                               'ordl_uom'=>getDataCodeBySql("uom_code",'db_uom'," WHERE uom_id = '{$row['ordl_uom']}'", $orderby),'ordl_fuprice'=>num_format($row['ordl_fuprice']),'ordl_disc'=>$row['ordl_disc'],
                               'ordl_fdiscamt'=>num_format($row['ordl_fdiscamt']),'ordl_ftotal'=>num_format($row['ordl_ftotal']),
                               'ordl_id'=>$row['ordl_id']);
        }
        return true;
    }
    public function getHistoryLineDetail(){
        
        $sql = "SELECT ordl.*
                FROM db_ordl ordl
                WHERE ordl.ordl_id = '$this->ordl_id' 
                limit 0,10
                ";
        $query = mysql_query($sql);
        
        if($row = mysql_fetch_array($query)){
            
            $this->d = array('ordl_uom'=>$row['ordl_uom'],'ordl_fuprice'=>$row['ordl_fuprice'],'ordl_disc'=>$row['ordl_disc'],
                       'ordl_fdiscamt'=>$row['ordl_fdiscamt'],'ordl_ftotal'=>$row['ordl_ftotal'],
                       'ordl_id'=>$row['ordl_id']);
        }
        return true;
    }
    public function generateMultiLineItems(){
        include_once 'class/Order.php';
        $order = new Order();  
        $query = $order->fetchOrderDetail(" AND order_id = '$this->order_id'","","",0);
        $order->order_id = $this->order_id;
        if($query){
            $this->order_generate_from = $this->order_id;

            if($this->generate_document_type == 'PO_multi'){
                $this->document_code = "Request Form";
                $this->invl_parent_type = "PRF";
                $this->document_type = "PRF";
            }
            $this->order_date = system_date;
            $this->order_revtimes = 0;
            $this->order_revdatetime = "";
            $this->order_revby = 0;
            $this->isgenerate = true;
//            if($this->createOrder()){
//echo sizeof($this->generateqty);die;
                
                for($i=0;$i<sizeof($this->generateqty);$i++){
                    $invl_ordl_id = escape($this->generateordlid[$i]);
                    $generate_quantity = escape($this->generateqty[$i]);
                    
                    if($this->generatecheckbox[$i] != 'on'){
                        continue;
                    }
                    
                    if($generate_quantity <=0){
                        $generate_quantity = 0;
                    }
                    $order->order_id = escape($this->generateorderid[$i]);
                    //Double checking enough quantity for generate or not
                    $json = $order->getGenerateLineData(" AND ordl.ordl_id = '$invl_ordl_id'");
                    if(sizeof($json) > 0){
                        if($json[0]['balance'] > $generate_quantity){
                            $allow_generate_quantity = $generate_quantity ;
                        }else{
                            $allow_generate_quantity = $json[0]['balance'];
                        }
                    }else{
                        $allow_generate_quantity = 0;
                    }
                    
                    $query1 = $order->fetchOrderLineDetail(" AND ordl_id = '$invl_ordl_id'","","",0);
                    while($row = mysql_fetch_array($query1)){
                        $row['ordl_qty'] = $allow_generate_quantity;
                        $row['ordl_ftotal'] = $row['ordl_qty'] * $row['ordl_fuprice'];
                        $row['ordl_total'] = $row['ordl_ftotal']; 
                        $row['ordl_fdiscamt'] = ROUND($row['ordl_ftotal'] * ($row['ordl_disc']/100),2);
                        $row['ordl_discamt'] = $row['ordl_fdiscamt'];
                        if($row['ordl_istax'] == 1){
                           $row['ordl_ftaxamt'] = ROUND(($row['ordl_ftotal'] - $row['ordl_discamt'])*(system_gst_percent/100),2);
                           $row['ordl_taxamt'] = $row['ordl_ftaxamt'];
                        }
                        $row['ordl_total'] = $row['ordl_total'] + $row['ordl_taxamt'];
                        $row['ordl_ftotal'] = $row['ordl_ftotal'] + $row['ordl_ftaxamt'];
                        
                        $row['ordl_parent_type'] = $this->document_type;
                        $this->generateOrderLine($row,$this->order_id);
                    }
                }
                
              
                $this->order_disctotal = $this->getTotalDiscAmt();
                $this->order_subtotal = $this->getSubTotalAmt();
                $this->order_taxtotal = $this->getTotalGstAmt();
                $this->updateOrderTotal();
                return true;
//            }
        }else{
            return false;
        }
    }
    public function getGenerating(){
        
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
                <button class="btn btn-primary pull-right" id = 'create_new_purchase_order'>Create New Purchase Order</button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form id = 'selected_material_form' >  
                        <table id="order_table" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th style = 'width:5%'>Doc.No</th>
                                <th style = 'width:5%'>Project Name</th>
                                <th style = 'width:5%'>Site Coordinator</th>
                                <th style = 'width:11%'>Material</th>
                                <th style = 'width:4%'>Request Qty</th>
                                <th style = 'width:3%'>Request Balance</th>
                                <th style = 'width:15%'>Supplier</th>
                                <th style = 'width:3%;'></th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php   

                                $subsql = "SELECT SUM(ordl1.ordl_qty) 
                                           FROM db_ordl ordl1 
                                           INNER JOIN db_order o1 ON o1.order_id = ordl1.ordl_order_id
                                           WHERE ordl1.ordl_parent = ordl.ordl_id AND o1.order_status IN ('1','2')";

                                $sql = "SELECT a.* FROM (
                                        SELECT ordl.*,COALESCE(($subsql),0) as generated_qty,o.order_no,o.order_project_id,o.order_salesperson,o.order_id
                                        FROM db_order o
                                        INNER JOIN db_ordl ordl ON ordl.ordl_order_id = o.order_id
                                        WHERE o.order_status IN ('1','2') AND o.order_prefix_type = 'PRF' 
                                        )a 
                                        WHERE (a.ordl_qty - a.generated_qty) > 0
                                        ";
                      
                              $query = mysql_query($sql);
                              $i = 1;
                              while($row = mysql_fetch_array($query)){

                                  //$this->customerCrtl = $this->select->getMaterialSupplierSelectCtrl($this->order_customer,'Y'," AND material_id = '{$row['ordl_pro_id']}'");
                            ?>
                                <tr>
                                    <td><?php echo  "<a href = 'purchase_request.php?action=edit&order_id={$row['order_id']}' target = '_blank' >" . $row['order_no'] . "</a>";?></td>
                                    <td>
                                        <?php 
                                           echo "<a href = 'project.php?action=edit&project_id={$row['order_project_id']}' target = '_blank' >" . 
                                                   getDataCodeBySql('project_name','db_project'," WHERE project_id = '{$row['order_project_id']}'", $orderby) . 
                                                "</a>";           
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                           echo getDataCodeBySql('partner_name','db_partner'," WHERE partner_id = '{$row['order_salesperson']}'", $orderby)
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                           echo "<a href = 'material.php?action=edit&material_id={$row['ordl_pro_id']}' target = '_blank'>" . $row['ordl_pro_no'] . "</a>";
                                        ?>
                                    </td>
                                    <td><?php echo num_format($row['ordl_qty']);?></td>
                                    <td><?php echo num_format($row['ordl_qty'] - $row['generated_qty']);?></td>
                                    <td>
                                        <select style = 'width:100%' class="form-control select2" id="selected_supplier" name="selected_supplier[<?php echo $row['ordl_id'];?>]" >
                                            <?php echo $this->customerCrtl;?>
                                        </select>
                                    </td>
                                    <td class = "text-align-center">

                                        <?php 
                                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                        ?>
                                        <input type = 'checkbox' name = 'selected_material[]' value = '<?php echo $row['ordl_id'];?>'/>
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
                                <th style = 'width:5%'>Project Name</th>
                                <th style = 'width:5%'>Site Coordinator</th>
                                <th style = 'width:11%'>Material</th>
                                <th style = 'width:4%'>Request Qty</th>
                                <th style = 'width:3%'>Balance</th>
                                <th style = 'width:15%'>Supplier</th>
                                <th style = 'width:3%'></th>
                              </tr>
                            </tfoot>
                          </table>
                    </form>
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
          "paging": false,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "order": [[1]]
        });

            $('#create_new_purchase_order').click(function(){
                var data = "action=generatingpo&"+$('#selected_material_form').serialize();
                 $.ajax({
                    type: "POST",
                    url: "<?php echo $this->document_url;?>",      
                    data:data,
                    success: function(data) {
                        var jsonObj = eval ("(" + data + ")");
                        if(jsonObj.status == 1){
                            
                            window.location.href = 'purchase_order.php';
                        }else{
                            alert('Generate error.');
                            return false;
                        }
                    }
                 });
            });
      });
    </script>
  </body>
</html>
    <?php
    }
    public function generatingpo(){
        foreach($_POST['selected_material'] as $b){
            $supplier[$_POST['selected_supplier'][$b]][] = $b;
        }
      
        $count = 0;
        foreach($supplier as $c => $g){

            if($c > 0){
                $count++;
                 $this->order_customer = $c;
                 $this->order_date = system_date;
                 $this->order_generate_from_type = 'PRF';
                 $this->document_type = "PO";
                 $this->order_prefix_type = "PO";
                 $this->document_code = "Purchase Order";
                 $this->createOrder();

                 foreach($g as $t){
                     $sql = "SELECT * FROM db_ordl WHERE ordl_id = '$t'";
                     $query = mysql_query($sql);
                     if($row = mysql_fetch_array($query)){
                         $this->generateOrderLine($row,$this->order_id);
                     }
                 }

            }
        }
        if($count > 0){
            return true;
        }else{
            return false;
        }

    }
    public function emailByPR(){


            require 'dist/PHPMailerAutoload.php';
                        $my_file = "recordTest.pdf";

            $mail = new PHPMailer;
//            include_once 'class/Emailsetup.php';
//
//            $em = new Emailsetup();
//            $em->fetchEmailsetupDetail(" AND emailsetup_id = '1'","","",1);


            // Set PHPMailer to use the sendmail transport
            $mail->isSendmail();
            //Set who the message is to be sent from
            $mail->setFrom('system@kcparts.com', 'No-Reply');
            //Set an alternative reply-to address
           //$mail->addReplyTo('replyto@kcparts.com', 'First Last');
            //Set who the message is to be sent to

            $to_array = explode(",","kcparts@kcparts.com");
//            $to_array = explode(",","jasonchong3329@gmail.com");

            foreach($to_array as $t){
                $mail->addAddress($t);
            }

            $cc_array = explode(",","jasonchong@firstcom.com.sg");

            foreach($cc_array as $c){
                $mail->addCC($c);
            }
            //Set who the message is to be sent to

            
            $r = $this->fetchOrderDetail(" AND order_id = '$this->order_id' AND order_prefix_type = 'PRF'", $orderstring, $wherelimit,2);
     
            $order_by = getDataCodeBySql('partner_name',"db_partner"," WHERE partner_id = '{$r['order_salesperson']}'", $orderby);
            $order_date = format_date($r['order_date']);
            $project_name = getDataCodeBySql('project_name',"db_project"," WHERE project_id = '{$r['order_project_id']}'", $orderby);
            
            
            //Set the subject line
            $mail->Subject = "1 new Request Form - " . system_datetime ;
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            
            $html = <<<EOF
 
<html>
        <head>
          <title>Notification of Request Form</title>
        </head>
        <body>
         <p>Greetings ,</p>
         <p>New Request Form.</p>
         <br>
         <table width = '100%' style = 'width:100%' rules="all" style="border-color: #666;" cellpadding="10">
              <tr>
                 <td style='background: #eee;width:45%'><strong>Request form submitted by</strong></td>
                 <td>$order_by</td>
             </tr>
             <tr>
                 <td style='background: #eee;'><strong>Project Name</strong></td>
                 <td>$project_name</td>
             </tr>
             <tr>
                 <td style='background: #eee;'><strong>Request Form No.</strong></td>
                 <td>{$r['order_no']}</td>
             </tr>
              <tr>
                 <td style='background: #eee;'><strong>Request Form date</strong></td>
                 <td>$order_date</td>
             </tr>
         </table>
         <br>

        </body>
    </html>
                    
                    
                    
EOF;
            
            
            $mail->msgHTML($html);
            //Replace the plain text body with one created manually
            $mail->AltBody = $html;
            //Attach an image file
//            $mail->addAttachment($my_file);

            if (!$mail->send()) {
               return false;
               // echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                return true;
               // echo "Message sent!";
            }
    }
    public function fetchOrderNoDetail($docType,$orderNo){
        
        if($docType == 'QT'){
            $selectSql = " qt.order_id as QT_ID, si.invoice_id as SI_ID, do.order_id as DO_ID, pu.order_id as PU_ID " ;
            $fromSql = " db_order qt LEFT JOIN db_invoice si ON si.invoice_generate_from = qt.order_id AND si.invoice_generate_from_type = qt.order_prefix_type
                        LEFT JOIN db_order do ON do.order_generate_from = si.invoice_id AND do.order_generate_from_type = si.invoice_prefix_type
                        LEFT JOIN db_order pu ON pu.order_generate_from = do.order_id AND pu.order_generate_from_type = do.order_prefix_type ";
            $whereSql = " WHERE qt.order_id = '".$orderNo."' AND (qt.order_status = 1 OR qt.order_status IS NULL) AND (si.invoice_status = 1 OR si.invoice_status IS NULL) AND (do.order_status = 1 OR do.order_status IS NULL) AND (pu.order_status = 1 OR pu.order_status IS NULL)";
        }else if($docType == 'SI'){
            $selectSql = " si.invoice_id as SI_ID, do.order_id as DO_ID, pu.order_id as PU_ID " ;
            $fromSql = " db_invoice si LEFT JOIN db_order do ON do.order_generate_from = si.invoice_id AND do.order_generate_from_type = si.invoice_prefix_type
                        LEFT JOIN db_order pu ON pu.order_generate_from = do.order_id AND pu.order_generate_from_type = do.order_prefix_type ";
            $whereSql = " WHERE si.invoice_id = '".$orderNo."' AND (si.invoice_status = 1 OR si.invoice_status IS NULL) AND (do.order_status = 1 OR do.order_status IS NULL) AND (pu.order_status = 1 OR pu.order_status IS NULL)";
        }else if($docType == 'DO'){
            $selectSql = " do.order_id as DO_ID, pu.order_id as PU_ID " ;
            $fromSql = " db_order do LEFT JOIN db_order pu ON pu.order_generate_from = do.order_id AND pu.order_generate_from_type = do.order_prefix_type ";
            $whereSql = " WHERE do.order_id = '".$orderNo."' AND (do.order_status = 1 OR do.order_status IS NULL) AND (pu.order_status = 1 OR pu.order_status IS NULL)";
        }else if($docType == 'PU'){
            $selectSql = " pu.order_id as PU_ID " ;
            $fromSql = " db_order pu ";
            $whereSql = " WHERE pu.order_id = '".$orderNo."' AND (pu.order_status = 1 OR pu.order_status IS NULL)";
        }
        /*
        $sql = "SELECT qt.order_id as QT_ID, qt.order_no as QT_No, si.invoice_id as SI_ID, si.invoice_no as SI_No, do.order_id as DO_ID, do.order_no as DO_No, pu.order_id as PU_ID, pu.order_no as PU_No
FROM db_order qt
	LEFT JOIN db_invoice si ON si.invoice_generate_from = qt.order_id
    LEFT JOIN db_order do ON do.order_generate_from = si.invoice_id
    LEFT JOIN db_order pu ON pu.order_generate_from = do.order_id
WHERE qt.order_id = 110
	AND qt.order_status = 1
    AND si.invoice_status = 1
    AND do.order_status = 1
    AND pu.order_status = 1";
         */
        //$sql = "SELECT " . $selectSql . " FROM " . $fromSql . " WHERE " . $whereSql;
        
        $query2 = getDataBySql($selectSql,$fromSql,$whereSql);
        $generated = "";
        while($row2 = mysql_fetch_array($query2)){
            if($docType != 'SI'){
               if(isset($row2['SI_ID']) && $row2['SI_ID'] > 0){
                    $generated .= "<a href = 'sales_invoice.php?action=edit&invoice_id=".$row2['SI_ID']."'>SI</a>,";
                } 
            }
            if($docType != 'DO'){
                if(isset($row2['DO_ID']) && $row2['DO_ID'] > 0){
                    $generated .= "<a href = 'delivery_order.php?action=edit&order_id=".$row2['DO_ID']."'>DO</a>,";
                }
            }
            if($docType != 'PU'){
               if(isset($row2['PU_ID']) && $row2['PU_ID'] > 0){
                    $generated .= "<a href = 'pickup.php?action=edit&order_id=".$row2['PU_ID']."'>PU</a>,";
                } 
            }      
        }
        return rtrim($generated,',');
    }
}
?>
