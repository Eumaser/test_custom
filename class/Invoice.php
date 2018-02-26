<?php
/* old vworking
 * To change this tinvoiceate, choose Tools | Tinvoiceates
 * and open the tinvoiceate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Invoice {

    public function Invoice(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();


    }
    public function createInvoice(){
        $invoice_no = get_prefix_value($this->document_code,true);

        $table_field = array('invoice_no','invoice_date','invoice_customer','invoice_salesperson',
                             'invoice_billaddress','invoice_attentionto','invoice_shipterm','invoice_term',
                             'invoice_shipaddress','invoice_customerref','invoice_remark','invoice_customerpo',
                             'invoice_currency','invoice_currencyrate','invoice_status','invoice_prefix_type',
                             'invoice_generate_from','invoice_outlet','invoice_attentionto_phone',
                             'invoice_fax','invoice_subcon','invoice_project_id','invoice_shipping_id','invoice_discheadertotal',
                             'invoice_paymentterm_id','invoice_delivery_id','invoice_price_id','invoice_validity_id',
                             'invoice_transittime_id','invoice_freightcharge_id','invoice_pointofdelivery_id','invoice_prefix_id',
                             'invoice_remarks_id','invoice_country_id','invoice_attentionto_email',
                             'invoice_attentionto_name','invoice_tnc','invoice_regards','invoice_payment',
                             'invoice_notes','invoice_paymentdate','invoice_paymentremark','invoice_doc_type'
                             );
        $table_value = array($invoice_no,format_date_database($this->invoice_date),$this->invoice_customer,$this->invoice_salesperson,
                             $this->invoice_billaddress,$this->invoice_attentionto,$this->invoice_shipterm,$this->invoice_term,
                             $this->invoice_shipaddress,$this->invoice_customerref,$this->invoice_remark,$this->invoice_customerpo,
                             $this->invoice_currency,$this->invoice_currencyrate,1,$this->document_type,
                             $this->invoice_generate_from,$_SESSION['empl_outlet'],$this->invoice_attentionto_phone,
                             $this->invoice_fax,$this->invoice_subcon,$this->invoice_project_id,$this->invoice_shipping_id,$this->invoice_discheadertotal,
                             $this->invoice_paymentterm_id,$this->invoice_delivery_id,$this->invoice_price_id,$this->invoice_validity_id,
                             $this->invoice_transittime_id,$this->invoice_freightcharge_id,$this->invoice_pointofdelivery_id,$this->invoice_prefix_id,
                             $this->invoice_remarks_id,$this->invoice_country_id,$this->invoice_attentionto_email,
                             $this->invoice_attentionto_name,$this->invoice_term_remark,$this->invoice_regards,$this->invoice_payment,
                             $this->invoice_notes,format_date_database($this->invoice_paymentdate),$this->invoice_paymentremark,$this->invoice_doc_type
                             );
        $remark = "Insert $this->document_code.<br> Document No : $invoice_no";
        if(!$this->save->SaveData($table_field,$table_value,'db_invoice','invoice_id',$remark)){
           return false;
        }else{
           $this->invoice_id = $this->save->lastInsert_id;

           //insert invofrk create code here
           $invfork_field = [
              'invfork_inv_id',
              'invfork_brand',
              'invfork_model',
              'invfork_capacity',
              'invfork_height',
              'invfork_mast',
              'invfork_length',
              'invfork_attachment',
              'invfork_acc',
              'invfork_serial',
              'invfork_battery',
              'invfork_bat_charger',
              'invfork_snr',
           ];
           $invfork_value = [
             $this->invoice_id,
             $this->invfork_brand,
             $this->invfork_model,
             $this->invfork_capacity,
             $this->invfork_height,
             $this->invfork_mast,
             $this->invfork_length,
             $this->invfork_attachment,
             $this->invfork_acc,
             $this->invfork_serial,
             $this->invfork_battery,
             $this->invfork_bat_charger,
             $this->invfork_snr,
          ];

          $dType =$this->document_type;
        //  if ($dType == 'DO' && $this->order_doc_type == '2') {
          if ( ($dType == 'SI' ) && $this->invoice_doc_type == '2') {
            $remark = "Insert to invfork $this->document_code.<br> Document No : $this->order_no";
            $this->save->SaveData($invfork_field,$invfork_value,'db_invfork','invfork_id',$remark);
          }else{
            unset($invfork_value);
          }

           return true;
        }
    }
    public function updateInvoice(){
        $table_field = array('invoice_date','invoice_customer','invoice_salesperson',
                             'invoice_billaddress','invoice_attentionto','invoice_shipterm','invoice_term',
                             'invoice_shipaddress','invoice_customerref','invoice_remark','invoice_customerpo',
                             'invoice_currency','invoice_currencyrate','invoice_status',
                             'invoice_attentionto_phone','invoice_fax','invoice_subcon',
                             'invoice_project_id','invoice_shipping_id','invoice_discheadertotal',
                             'invoice_paymentterm_id','invoice_delivery_id','invoice_price_id','invoice_validity_id',
                             'invoice_transittime_id','invoice_freightcharge_id','invoice_pointofdelivery_id','invoice_prefix_id',
                             'invoice_remarks_id','invoice_country_id','invoice_attentionto_email',
                             'invoice_attentionto_name','invoice_tnc','invoice_regards','invoice_payment',
                             'invoice_notes','invoice_paymentdate','invoice_paymentremark','invoice_doc_type');
        $table_value = array(format_date_database($this->invoice_date),$this->invoice_customer,$this->invoice_salesperson,
                             $this->invoice_billaddress,$this->invoice_attentionto,$this->invoice_shipterm,$this->invoice_term,
                             $this->invoice_shipaddress,$this->invoice_customerref,$this->invoice_remark,$this->invoice_customerpo,
                             $this->invoice_currency,$this->invoice_currencyrate,$this->invoice_status,
                             $this->invoice_attentionto_phone,$this->invoice_fax,$this->invoice_subcon,
                             $this->invoice_project_id,$this->invoice_shipping_id,$this->invoice_discheadertotal,
                             $this->invoice_paymentterm_id,$this->invoice_delivery_id,$this->invoice_price_id,$this->invoice_validity_id,
                             $this->invoice_transittime_id,$this->invoice_freightcharge_id,$this->invoice_pointofdelivery_id,$this->invoice_prefix_id,
                             $this->invoice_remarks_id,$this->invoice_country_id,$this->invoice_attentionto_email,
                             $this->invoice_attentionto_name,$this->invoice_term_remark,$this->invoice_regards,$this->invoice_payment,
                             $this->invoice_notes,format_date_database($this->invoice_paymentdate),$this->invoice_paymentremark,$this->invoice_doc_type);
        $remark = "Update $this->document_code.<br> Document No : $this->order_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_invoice','invoice_id',$remark,$this->invoice_id)){
           return false;
        }else{

          //insert invfork update code here
          $invfork_field = [
             'invfork_inv_id',
             'invfork_brand',
             'invfork_model',
             'invfork_capacity',
             'invfork_height',
             'invfork_mast',
             'invfork_length',
             'invfork_attachment',
             'invfork_acc',
             'invfork_serial',
             'invfork_battery',
             'invfork_bat_charger',
             'invfork_snr',
          ];
          $invfork_value = [
            $this->invoice_id,
            $this->invfork_brand,
            $this->invfork_model,
            $this->invfork_capacity,
            $this->invfork_height,
            $this->invfork_mast,
            $this->invfork_length,
            $this->invfork_attachment,
            $this->invfork_acc,
            $this->invfork_serial,
            $this->invfork_battery,
            $this->invfork_bat_charger,
            $this->invfork_snr,
         ];

         $dType =$this->document_type;
     //  if ($dType == 'DO' && $this->order_doc_type == '2') {
         if ( ($dType == 'SI' ) && $this->invoice_doc_type == '2') {
               $remark = "Update to invfork $this->document_code.<br> Document No : $this->order_no";
               $this->save->UpdateData($invfork_field,$invfork_value,'db_invfork','invfork_id',$remark,$this->invfork_id);
            //   ($table_field,$table_value,'db_invoice','invoice_id',$remark,$this->invoice_id)
         }else{
               unset($invfork_value);
         }


           return true;
        }
    }
    public function updateInvoiceTotal(){

        $this->invoice_grandtotal = ($this->invoice_subtotal - $this->invoice_disctotal) + $this->invoice_taxtotal;
        $subtotal = (($this->invoice_subtotal - $this->invoice_disctotal) - $this->invoice_discheadertotal);
        $gst = round($subtotal * (system_gst_percent/100),2);
        $this->invoice_grandtotal = $subtotal + $gst;
        $table_field = array('invoice_subtotal','invoice_disctotal','invoice_taxtotal','invoice_grandtotal','invoice_discheadertotal');
        $table_value = array($this->invoice_subtotal,$this->invoice_disctotal,$gst,$this->invoice_grandtotal,$this->invoice_discheadertotal);
        $this->fetchInvoiceDetail(" AND invoice_id = '$this->invoice_id'","","",1);
        $remark = "Update $this->document_code.<br> Document No : $this->invoice_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_invoice','invoice_id',$remark,$this->invoice_id)){
           return false;
        }else{
           return true;
        }
    }
    public function createInvoiceLine(){

        $table_field = array('invl_invoice_id','invl_pro_id','invl_pro_desc','invl_qty','invl_uom',
                             'invl_uprice','invl_fuprice','invl_disc','invl_istax','invl_taxamt','invl_total',
                             'invl_pro_no','invl_discamt','invl_seqno','invl_parent',
                             'invl_markup','invl_fdiscamt','invl_ftaxamt','invl_ftotal','invl_pro_remark',
                             'invl_item_type','invl_product_location');
        $table_value = array($this->invoice_id,$this->invl_pro_id,$this->invl_pro_desc,$this->invl_qty,$this->invl_uom,
                             $this->invl_uprice,$this->invl_fuprice,$this->invl_disc,$this->invl_istax,$this->invl_taxamt,$this->invl_total,
                             $this->invl_pro_no,$this->invl_discamt,$this->invl_seqno,$this->invl_parent,
                             $this->invl_markup,$this->invl_fdiscamt,$this->invl_ftaxamt,$this->invl_ftotal,$this->invl_pro_remark,
                             $this->invl_pro_type,$this->invl_product_location);
        $this->fetchInvoiceDetail(" AND invoice_id = '$this->invoice_id'","","",1);
        $remark = "Insert $this->document_code Line.<br> Document No : $this->invoice_no";
        if(!$this->save->SaveData($table_field,$table_value,'db_invl','invl_id',$remark)){
           return false;
        }else{
           $this->invl_id = $this->save->lastInsert_id;
           if($this->document_type == 'PCN'){
               if(!$this->generateStockTransaction($this->invl_id,'out')){
                   return false;
               }
               else{
                   return true;
               }
           }else if($this->document_type == 'SCN'){
               if(!$this->generateStockTransaction($this->invl_id,'in')){
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
    public function updateInvoiceLine(){
        $table_field = array('invl_invoice_id','invl_pro_id','invl_pro_desc','invl_qty','invl_uom',
                             'invl_uprice','invl_fuprice','invl_disc','invl_istax','invl_taxamt','invl_total',
                             'invl_pro_no','invl_discamt','invl_seqno','invl_markup',
                             'invl_fdiscamt','invl_ftaxamt','invl_ftotal','invl_pro_remark',
                             'invl_item_type','invl_product_location');
        $table_value = array($this->invoice_id,$this->invl_pro_id,$this->invl_pro_desc,$this->invl_qty,$this->invl_uom,
                             $this->invl_uprice,$this->invl_fuprice,$this->invl_disc,$this->invl_istax,$this->invl_taxamt,$this->invl_total,
                             $this->invl_pro_no,$this->invl_discamt,$this->invl_seqno,$this->invl_markup,
                             $this->invl_fdiscamt,$this->invl_ftaxamt,$this->invl_ftotal,$this->invl_pro_remark,
                             $this->invl_pro_type,$this->invl_product_location);
        $this->fetchInvoiceDetail(" AND invoice_id = '$this->invoice_id'","","",1);
        $remark = "Update $this->document_code Line.<br> Document No : $this->invoice_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_invl','invl_id',$remark,$this->invl_id)){
           return false;
        }else{
           if($this->document_type == 'PCN'){
               if(!$this->generateStockTransaction($this->invl_id,'out')){
                   return false;
               }
               else{
                   return true;
               }
           }else if($this->document_type == 'SCN'){
               if(!$this->generateStockTransaction($this->invl_id,'in')){
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

        if($this->invoice_currencyrate <= 0){
            $this->invoice_currencyrate = 1;
        }

        //foreign amount
        $this->invl_fuprice = $this->invl_fuprice;
        $subtotal = $this->invl_qty * $this->invl_fuprice;


        if($this->invl_disc > 0){
            $this->invl_fdiscamt = ROUND($subtotal * ($this->invl_disc/100),2);
            $this->invl_discamt = ROUND($this->invl_fdiscamt * $this->invoice_currencyrate,2);
        }else{
            $this->invl_discamt = 0;
        }

        $subtotal_afterdiscount = $subtotal - $this->invl_fdiscamt;

//        if($this->invl_istax > 0){
//            $this->invl_ftaxamt = ROUND($subtotal_afterdiscount * (system_gst_percent/100),2);
//            $this->invl_taxamt = ROUND($this->invl_ftaxamt * $this->invoice_currencyrate,2);
//        }else{
//            $this->invl_taxamt = 0;
//        }
        $this->invl_ftaxamt = 0;
        $this->invl_taxamt = 0;
        $this->invl_ftotal = $subtotal_afterdiscount + $this->invl_ftaxamt;


        //base amount
        $this->invl_total = ROUND($this->invl_ftotal * $this->invoice_currencyrate,2);
    }
    public function getTotalDiscAmt(){
        $sql = "SELECT SUM(invl_discamt) as discamt FROM db_invl WHERE invl_invoice_id = '$this->invoice_id'";
        $query = mysql_query($sql);
        if($row = mysql_fetch_array($query)){
            $total_discamt = $row['discamt'];
        }else{
            $total_discamt = 0;
        }
        return $total_discamt;
    }
    public function getSubTotalAmt(){
        $sql = "SELECT SUM(invl_fuprice*invl_qty) as subtotal FROM db_invl WHERE invl_invoice_id = '$this->invoice_id'";
        $query = mysql_query($sql);
        if($row = mysql_fetch_array($query)){
            $total_subtotal = $row['subtotal'];
        }else{
            $total_subtotal = 0;
        }
        return $total_subtotal;
    }
    public function getTotalGstAmt(){
        $sql = "SELECT SUM(invl_taxamt) as taxamt FROM db_invl WHERE invl_invoice_id = '$this->invoice_id'";
        $query = mysql_query($sql);
        if($row = mysql_fetch_array($query)){
            $total_taxamt = $row['taxamt'];
        }else{
            $total_taxamt = 0;
        }
        return $total_taxamt;
    }
    public function fetchInvoiceDetail($wherestring,$invoicestring,$wherelimit,$type){

        $sql =
        "SELECT o.*,invf.*,de.delivery_desc as delivery_desc,
                            co.country_desc as country_desc,
                            fr.freightcharge_desc as freightcharge_desc,
                            pd.pointofdelivery_desc as pointofdelivery_desc,
                            pf.prefix_desc as prefix_desc,
                            pr.price_desc as price_desc,
                            rm.remarks_desc as remarks_desc,
                            tt.transittime_desc as transittime_desc,
                            va.validity_desc as validity_desc,
                            pt.paymentterm_desc as paymentterm_desc
                FROM db_invoice o
                LEFT JOIN db_paymentterm pt ON pt.paymentterm_id = o.invoice_paymentterm_id
                    LEFT JOIN db_delivery de ON de.delivery_id = o.invoice_delivery_id
                    LEFT JOIN db_price pr ON pr.price_id = o.invoice_price_id
                    LEFT JOIN db_validity va ON va.validity_id = o.invoice_validity_id
                    LEFT JOIN db_transittime tt ON tt.transittime_id = o.invoice_transittime_id
                    LEFT JOIN db_freightcharge fr ON fr.freightcharge_id = o.invoice_freightcharge_id
                    LEFT JOIN db_pointofdelivery pd ON pd.pointofdelivery_id = o.invoice_pointofdelivery_id
                    LEFT JOIN db_prefix pf ON pf.prefix_id = o.invoice_prefix_id
                    LEFT JOIN db_remarks rm ON rm.remarks_id = o.invoice_remarks_id
                    LEFT JOIN db_country co ON co.country_id = o.invoice_country_id
                    LEFT JOIN db_invfork invf ON invf.invfork_inv_id  = o.invoice_id
                  WHERE o.invoice_id > 0  $wherestring $invoicestring $wherelimit";

        $query = mysql_query($sql);

          //edrs
      //    $row = mysql_fetch_array($query);
      //    return $row ;
        if($type > 0){
            $row = mysql_fetch_array($query);

            $this->invoice_id = $row['invoice_id'];
            $this->invoice_no = $row['invoice_no'];
            $this->invoice_date = $row['invoice_date'];
            $this->invoice_customer = $row['invoice_customer'];
            $this->invoice_salesperson = $row['invoice_salesperson'];
            $this->invoice_billaddress = $row['invoice_billaddress'];
            $this->invoice_attentionto = $row['invoice_attentionto'];
            $this->invoice_shipterm = $row['invoice_shipterm'];
            $this->invoice_term = $row['invoice_term'];
            $this->invoice_shipaddress = $row['invoice_shipaddress'];
            $this->invoice_customerref = $row['invoice_customerref'];
            $this->invoice_remark = $row['invoice_remark'];
            $this->invoice_customerpo = $row['invoice_customerpo'];
            $this->invoice_currency = $row['invoice_currency'];
            $this->invoice_currency_org = $row['invoice_currency'];
            $this->invoice_currencyrate = $row['invoice_currencyrate'];
            $this->invoice_status = $row['invoice_status'];
            $this->invoice_subtotal = $row['invoice_subtotal'];
            $this->invoice_disctotal = $row['invoice_disctotal'];
            $this->invoice_taxtotal = $row['invoice_taxtotal'];
            $this->invoice_grandtotal = $row['invoice_grandtotal'];
            $this->invoice_currency_code = getDataCodeBySql("currency_code","db_currency"," WHERE currency_id = '$this->invoice_currency'","");
            $this->invoice_fax = $row['invoice_fax'];
            $this->invoice_attentionto_phone = $row['invoice_attentionto_phone'];
            $this->invoice_subcon = $row['invoice_subcon'];
            $this->invoice_project_id = $row['invoice_project_id'];
            $this->invoice_discheadertotal = $row['invoice_discheadertotal'];
            $this->invoice_shipping_id = $row['invoice_shipping_id'];
            $this->invoice_shipaddress = $row['invoice_shipaddress'];

            $this->invoice_paymentterm_id = $row['invoice_paymentterm_id'];
            $this->invoice_delivery_id = $row['invoice_delivery_id'];
            $this->invoice_price_id = $row['invoice_price_id'];
            $this->invoice_validity_id = $row['invoice_validity_id'];
            $this->invoice_transittime_id = $row['invoice_transittime_id'];
            $this->invoice_freightcharge_id = $row['invoice_freightcharge_id'];
            $this->invoice_pointofdelivery_id = $row['invoice_pointofdelivery_id'];
            $this->invoice_prefix_id = $row['invoice_prefix_id'];
            $this->invoice_remarks_id = $row['invoice_remarks_id'];
            $this->invoice_country_id = $row['invoice_country_id'];
            $this->invoice_delivery_remark = html_entity_decode($row['delivery_desc']);
            $this->invoice_country_remark = html_entity_decode($row['country_desc']);
            $this->invoice_freightcharge_remark = html_entity_decode($row['freightcharge_desc']);
            $this->invoice_pointofdelivery_remark = html_entity_decode($row['pointofdelivery_desc']);
            $this->invoice_prefix_remark = html_entity_decode($row['prefix_desc']);
            $this->invoice_price_remark = html_entity_decode($row['price_desc']);
            $this->invoice_remarks_remark = html_entity_decode($row['remarks_desc']);
            $this->invoice_transittime_remark = html_entity_decode($row['transittime_desc']);
            $this->invoice_validity_remark = html_entity_decode($row['validity_desc']);
            $this->invoice_paymentterm_remark = html_entity_decode($row['paymentterm_desc']);
            $this->invoice_attentionto_email = $row['invoice_attentionto_email'];
            $this->invoice_attentionto_name = $row['invoice_attentionto_name'];
            $this->invoice_term_remark = $row['invoice_tnc'];
            $this->invoice_regards = $row['invoice_regards'];
            $this->invoice_prefix_type = $row['invoice_prefix_type'];
            $this->invoice_payment = $row['invoice_payment'];
            $this->invoice_notes = $row['invoice_notes'];
            $this->invoice_paymentdate = $row['invoice_paymentdate'];
            $this->invoice_paymentremark = $row['invoice_paymentremark'];

            //edr added invoice doc type
            $this->invoice_doc_type = $row['invoice_doc_type'];
            //edr added invfork data here
            $this->invfork_id = $row['invfork_id'];
            $this->invfork_brand = $row['invfork_brand'];
            $this->invfork_model = $row['invfork_model'];
            $this->invfork_capacity = $row['invfork_capacity'];
            $this->invfork_height = $row['invfork_height'];
            $this->invfork_mast = $row['invfork_mast'];
            $this->invfork_length = $row['invfork_length'];
            $this->invfork_attachment = $row['invfork_attachment'];
            $this->invfork_acc = $row['invfork_acc'];
            $this->invfork_serial = $row['invfork_serial'];
            $this->invfork_battery = $row['invfork_battery'];
            $this->invfork_bat_charger = $row['invfork_bat_charger'];
            $this->invfork_snr = $row['invfork_snr'];


            $this->invoice_generate_from_type = $row['invoice_generate_from_type'];
            $this->invoice_generate_from = $row['invoice_generate_from'];
        }
        return $query;
    }
    public function fetchInvoiceLineDetail($wherestring,$invoicestring,$wherelimit,$type){
        $sql = "SELECT * FROM db_invl WHERE invl_id > 0 AND invl_invoice_id = '$this->invoice_id' $wherestring $invoicestring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);

            $this->invl_id = $row['invl_id'];
            $this->invl_pro_no = $row['invl_pro_no'];
            $this->invl_pro_id = $row['invl_pro_id'];
            $this->invl_pro_desc = html_entity_decode($row['invl_pro_desc']);
            $this->invl_qty = $row['invl_qty'];
            $this->invl_uom = $row['invl_uom'];
            $this->invl_uprice = $row['invl_uprice'];
            $this->invl_disc = $row['invl_disc'];
            $this->invl_discamt = $row['invl_discamt'];
            $this->invl_istax = $row['invl_istax'];
            $this->invl_taxamt = $row['invl_taxamt'];
            $this->invl_total = $row['invl_total'];
            $this->invl_seqno = $row['invl_seqno'];
            $this->invl_markup = $row['invl_markup'];
            $this->invl_fdiscamt = $row['invl_fdiscamt'];
            $this->invl_ftaxamt = $row['invl_ftaxamt'];
            $this->invl_ftotal = $row['invl_ftotal'];
            $this->invl_pro_type = $row['invl_item_type'];
            $this->invl_product_location = $row['invl_product_location'];
        }
        return $query;
    }
    public function fetchInvoiceLine2Detail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT il.*,i.invoice_customer,i.invoice_no,p.product_cost_price "
                . " FROM db_invl il "
                . " LEFT JOIN db_invoice i ON i.invoice_id = il.invl_invoice_id "
                . " LEFT JOIN db_product p ON p.product_id = il.invl_pro_id "
                . " WHERE il.invl_id > 0 $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type == 1){
            $row = mysql_fetch_array($query);

            $this->invl_id              = $row['invl_id'];
            $this->invl_invoice_id        = $row['invl_invoice_id'];
            $this->invl_item_type        = $row['invl_item_type'];
            $this->invl_pro_id          = $row['invl_pro_id'];
            $this->invl_qty             = $row['invl_qty'];
            $this->invl_uom             = $row['invl_uom'];
            $this->product_cost_price   = $row['product_cost_price'];
            $this->invoice_customer       = $row['invoice_customer'];
            $this->invoice_no             = $row['invoice_no'];
            $this->invl_product_location = $row['invl_product_location'];
        }else if($type == 2){
            return mysql_fetch_array($query);
        }
        return $query;
    }

    public function delete(){
        $table_field = array('invoice_status');
        $table_value = array($this->invoice_status);
        $remark = "Delete $this->document_code.<br> Document No : $this->invoice_no";
        if(!$this->save->UpdateData($table_field,$table_value,'db_invoice','invoice_id',$remark,$this->invoice_id)){
           return false;
        }else{
           return true;
        }
    }
    public function deleteInvoiceLine(){
        if($this->save->DeleteData("db_invl"," WHERE invl_invoice_id = '$this->invoice_id' AND invl_id = '$this->invl_id'","Delete $this->document_code Invoice Line.")){
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
            $this->invoice_code = "-- System Generate --";
            $this->invoice_status = 1;
            $this->invoice_date = system_date;
            $this->invoice_no = get_prefix_value($this->document_code,false,$this->invoice_date);
            $this->invoice_currency = $_SESSION['empl_currency_id'];
            $this->invoice_currency_org = $_SESSION['empl_currency_id'];

        }else{
            /*
             * find project detail for filter subcon
             */
            $p->project_id = $this->invoice_project_id;
            $r = $p->getProjectDetailTransaction();
            $b = explode(',',$r['project_subcon']);
            for($i=0;$i<sizeof($b);$i++){
                $project_subcon .= "'" . $b[$i] . "',";
            }
            $project_subcon = trim($project_subcon,",");
            $subcon_wherestring = " AND partner_issubcon = 1 AND partner_id IN ($project_subcon)";
            $this->subconCrtl = $this->select->getCustomerSelectCtrl($this->invoice_subcon,'Y',$subcon_wherestring);
        }

        if($this->document_type == 'PCN'){
            $cust_wherestring = " AND partner_issupplier = 1";
            $empl_wherestring = " AND empl_group IN ('3')";
        }else{
            $cust_wherestring = " AND partner_iscustomer = 1 ";
            $empl_wherestring = " AND empl_group IN ('1')";
            if($_SESSION['empl_group'] >= 1){
               $cust_wherestring .= " AND partner_outlet = '{$_SESSION['empl_outlet']}'";
            }
        }
        $this->projectCrtl = $this->select->getProjectSelectCtrl($this->invoice_project_id,'Y');
        $this->employeeCrtl = $this->select->getEmployeeSelectCtrl($this->invoice_salesperson,'Y');
        $this->customerCrtl = $this->select->getCustomerSelectCtrl($this->invoice_customer,'Y',$cust_wherestring);
        $this->currencyCrtl = $this->select->getCurrencySelectCtrl($this->invoice_currency,'N');
        $this->shiptermCrtl = $this->select->getShipTermSelectCtrl($this->invoice_shipterm,'N');
        $this->contactCrtl = $this->select->getContactSelectCtrl($this->invoice_attentionto,'Y'," AND contact_partner_id = '$this->invoice_customer'");

        // Addedd by Ivan
        $this->deliveryCrtl = $this->select->getDeliverySelectCtrl($this->invoice_delivery_id,'Y');
        $this->priceCrtl = $this->select->getPriceSelectCtrl($this->invoice_price_id,'Y');
        $this->paymenttermCrtl = $this->select->getPaymenttermSelectCtrl($this->invoice_paymentterm_id,'Y');
        $this->validityCrtl = $this->select->getValiditySelectCtrl($this->invoice_validity_id,'Y');
        $this->transittimeCrtl = $this->select->getTransittimeSelectCtrl($this->invoice_transittime_id,'Y');
        $this->freightchargeCrtl = $this->select->getFreightchargeSelectCtrl($this->invoice_freightcharge_id,'Y');
        $this->pointofdeliveryCrtl = $this->select->getPointofdeliverySelectCtrl($this->invoice_pointofdelivery_id,'Y');
        $this->prefixCrtl = $this->select->getPrefixSelectCtrl($this->invoice_prefix_id,'Y');
        $this->remarksCrtl = $this->select->getRemarksSelectCtrl($this->invoice_remarks_id,'Y');
        $this->countryCrtl = $this->select->getCountrySelectCtrl($this->invoice_country_id,'Y');
        $this->prodCrtl = $this->select->getProductNameSelectCtrl("",'Y');

        $this->shippingCrtl = $this->select->getShippingAddressSelectCtrl($this->invoice_shipping_id,'Y'," AND shipping_partner_id = '$this->invoice_customer'" );
        $this->uomCrtl = $this->select->getUomSelectCtrl("",'N');
        $label_col_sm = "col-sm-2";
        $field_col_sm = "col-sm-3";

        //$this->invoice_currency_code = "SGD";
        //$this->invoice_currency_org = "SGD";
        $this->invoice_currency_code = "$";
        $this->invoice_currency_org = "$";

        //edr get document type list
        $this->docType = $this->select->getDocType($this->invoice_doc_type,'Y');
        $this->brandCrtl = $this->select->getBrandSelectCtrl($this->invfork_brand,'Y');
        $this->modelCrtl = $this->select->getForkModelCtrl($this->invfork_model,'Y');

        if($this->document_type == 'SI'){
            $isgenerated = getDataCountBySql("db_order"," WHERE (order_generate_from = '$this->invoice_id' AND order_generate_from_type = '$this->document_type' ) AND order_status = 1 AND order_generate_from > 0");
        }

        if($isgenerated > 0){
            $disabled = " DISABLED";
        }
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
      <div class="content-wrapper">
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><?php echo $this->document_name;?></h1>
            <!--edr form--->
        </section>
          <!-- Main content -->
          <section class="content">
              <form id = 'invoice_form' class="form-horizontal" action = '<?php echo $this->document_url;?>?action=create' method = "POST">
            <div class="box box-success">
              <div class="box-header with-binvoice">
                <h3 class="box-title"><?php if($this->invoice_id > 0){ echo "Update " . $this->document_code;}else{ echo "Create New " . $this->document_code;}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='<?php echo $this->document_url;?>'">Back</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create') && ($this->invoice_id > 0)){?>
                <!--<button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='<?php echo $this->document_url;?>?action=createForm'">Create New</button>-->
                <?php }?>

              </div>


                  <div class="box-body col-sm-9">
                        <div class="form-group">
                            <label for="invoice_no" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->document_code;?> No.</label>
                            <div class="<?php echo $field_col_sm;?>">
                              <input type="text" class="form-control" id="invoice_no" name="invoice_no" value = "<?php echo $this->invoice_no;?>" READONLY>
                            </div>
                            <label for="invoice_date" class="<?php echo $label_col_sm;?> control-label"><!--<?php echo $this->document_code;?>--> Date of Sales</label>
                            <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control datepicker" id="invoice_date" name="invoice_date" value = "<?php echo format_date($this->invoice_date);?>" placeholder=" <?php echo $this->document_code;?> Date" <?php echo $disabled;?>>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="invoice_customer" class="<?php echo $label_col_sm;?> control-label">Document Type</label>
                            <div class="<?php echo $field_col_sm;?>">
                                 <select class="form-control select2" id="invoice_doc_type" name="invoice_doc_type" <?php echo $disabled;?>>
                                     <?php echo $this->docType?>
                                 </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="invoice_customer" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->custsupp_label;?><?php echo $mandatory;?></label>
                            <div class="<?php echo $field_col_sm;?>">
                                 <select class="form-control select2" id="invoice_customer" name="invoice_customer" <?php echo $disabled;?>>
                                     <?php echo $this->customerCrtl;?>
                                 </select>
                            </div>
                            <label for="invoice_attentionto" class="<?php echo $label_col_sm;?> control-label">Attention To</label>
                            <div class="col-sm-3">
                                <select class="form-control select2" id="invoice_attentionto" name="invoice_attentionto" <?php echo $disabled;?>>
                                    <?php echo $this->contactCrtl;?>
                                </select>
                                <p></p>
                                <input type="text" class="form-control" id="invoice_attentionto_name" name="invoice_attentionto_name" value = "<?php echo $this->invoice_attentionto_name;?>" placeholder="Attention Name"  <?php echo $disabled;?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="invoice_billaddress" class="<?php echo $label_col_sm;?> control-label">Billing Address</label>
                            <div class="col-sm-3">
                                  <textarea class="form-control" rows="3" id="invoice_billaddress" name="invoice_billaddress" placeholder="Billing Address" <?php echo $disabled;?>><?php echo $this->invoice_billaddress;?></textarea>
                            </div>
                            <label for="invoice_shipaddress" class="<?php echo $label_col_sm;?> control-label">Shipping Address</label>
                            <div class="<?php echo $field_col_sm;?>">
                                    <textarea class="form-control" rows="3" id="invoice_shipaddress" name="invoice_shipaddress" placeholder="Shipping Address" <?php echo $disabled;?>><?php echo $this->invoice_shipaddress;?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="invoice_attentionto_phone" class="<?php echo $label_col_sm;?> control-label" >Phone No </label>
                            <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control" id="invoice_attentionto_phone" name="invoice_attentionto_phone" value = "<?php echo $this->invoice_attentionto_phone;?>" placeholder="Attention Phone No." <?php echo $disabled;?>>
                            </div>
                            <label for="invoice_fax" class="<?php echo $label_col_sm;?> control-label">Fax No.</label>
                            <div class="<?php echo $field_col_sm;?>">
                              <input type="text" class="form-control" id="invoice_fax" name="invoice_fax" value = "<?php echo $this->invoice_fax;?>" placeholder="Attention Fax No." <?php echo $disabled;?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="invoice_attentionto_email" class="<?php echo $label_col_sm;?> control-label" >Email </label>
                            <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control" id="invoice_attentionto_email" name="invoice_attentionto_email" value = "<?php echo $this->invoice_attentionto_email;?>" placeholder="Attention Email" <?php echo $disabled;?>>
                            </div>
                            <label for="invoice_salesperson" class="<?php echo $label_col_sm;?> control-label"><?php echo $this->salesorderedby_label;?></label>
                            <div class="<?php echo $field_col_sm;?>">
                                <select class="form-control select2" id="invoice_salesperson" name="invoice_salesperson" <?php echo $disabled;?> >
                                    <?php echo $this->employeeCrtl;?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="invoice_currency" class="<?php echo $label_col_sm;?> control-label"> Currency </label>
                            <div class="<?php echo $field_col_sm;?>">
                                <select class="form-control select2" id="invoice_currency" name="invoice_currency" <?php echo $disabled;?> >
                                    <?php echo $this->currencyCrtl;?>
                                </select>
                            </div>
                            <label for="invoice_notes" class="<?php echo $label_col_sm;?> control-label">Initial Remark</label>
                            <div class="<?php echo $field_col_sm;?>">
                                <textarea class="form-control" rows="3" id="invoice_notes" name="invoice_notes" placeholder="Initial Remark" <?php echo $readonly;?>><?php echo $this->invoice_notes;?></textarea>
                            </div>
                        </div>

                        <?php if($this->document_type == 'SI'){?>
                        <div class="form-group">
                            <label for="invoice_payment" class="<?php echo $label_col_sm;?> control-label"> Payment Status</label>
                            <div class="col-sm-2">
                                <select class="form-control select2" id="invoice_payment" name="invoice_payment" <?php echo $payment_disabled;?> >
                                    <option value="0" <?php if($this->invoice_payment == '0'){ echo "SELECTED"; } ?> > Unpaid </option>
                                    <option value="1" <?php if($this->invoice_payment == '1'){ echo "SELECTED"; } ?> > Paid </option>
                                </select>

                            </div>
                            <div class="col-sm-1">
                                <button type="button" data-loading-text="Loading..." id='show_btn' class="btn btn-primary payment-show" autocomplete="off">Show</button>
                            </div>
                            <label for="invoice_customerpo" class="<?php echo $label_col_sm;?> control-label">Purchase Order No.</label>
                            <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control" id="invoice_customerpo" name="invoice_customerpo" value = "<?php echo $this->invoice_customerpo;?>" placeholder="Purchase Order No." <?php //echo $disabled;?>>
                            </div>
                        </div>

                        <div class="form-group toggle-payment">
                            <label for="invoice_paymentdate" class="<?php echo $label_col_sm;?> control-label"> Date of Payment</label>
                           <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control datepicker" id="invoice_paymentdate" name="invoice_paymentdate" value = "<?php echo format_date($this->invoice_paymentdate);?>" placeholder=" <?php echo $this->document_code;?> Payment Date" <?php //echo $disabled;?>>
                            </div>
                            <label for="invoice_paymentremark" class="<?php echo $label_col_sm;?> control-label">Payment Remark</label>
                            <div class="<?php echo $field_col_sm;?>">
                                <textarea class="form-control" rows="3" id="invoice_paymentremark" name="invoice_paymentremark" placeholder="Payment Remark" <?php echo $readonly;?>><?php echo $this->invoice_paymentremark;?></textarea>

                            </div>
                        </div>

                        <!--forklifts--->
                        <div class="forklifts-inv">
                          <div class="form-group">
                              <input type="hidden" class="form-control" id="invfork_id" name="invfork_id" value = "<?php echo $this->invfork_id;?>" placeholder="Brand" >
                              <label for="invoice_currency" class="<?php echo $label_col_sm;?> control-label"> Brand </label>
                              <div class="<?php echo $field_col_sm;?>">
                                  <select class="form-control select2" id="invfork_brand" name="invfork_brand" <?php echo $disabled;?> >
                                      <?php echo $this->brandCrtl;?>
                                  </select>
                              </div>
                              <label for="invoice_notes" class="<?php echo $label_col_sm;?> control-label">Model </label>
                              <div class="<?php echo $field_col_sm;?>">
                                <select class="form-control select2" id="invfork_model" name="invfork_model" <?php echo $disabled;?> >
                                    <?php echo $this->modelCrtl;?>
                                </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="invoice_currency" class="<?php echo $label_col_sm;?> control-label">Capacity </label>
                              <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control" id="invfork_capacity" name="invfork_capacity" value = "<?php echo $this->invfork_capacity;?>" placeholder="Capacity" >

                              </div>
                              <label for="invoice_notes" class="<?php echo $label_col_sm;?> control-label">Height</label>
                              <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control" id="invfork_height" name="invfork_height" value = "<?php echo $this->invfork_height;?>" placeholder="Height" >

                              </div>
                          </div>

                          <div class="form-group">
                              <label for="invoice_currency" class="<?php echo $label_col_sm;?> control-label">Mast </label>
                              <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control" id="invfork_mast" name="invfork_mast" value = "<?php echo $this->invfork_mast;?>" placeholder="Mast" >

                              </div>
                              <label for="invoice_notes" class="<?php echo $label_col_sm;?> control-label">Length </label>
                              <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control" id="invfork_length" name="invfork_length" value = "<?php echo $this->invfork_length;?>" placeholder="Length" >

                              </div>
                          </div>

                          <div class="form-group">
                              <label for="invoice_currency" class="<?php echo $label_col_sm;?> control-label">Attachment </label>
                              <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control" id="invfork_attachment" name="invfork_attachment" value = "<?php echo $this->invfork_attachment;?>" placeholder="Attachment" >

                              </div>
                              <label for="invoice_notes" class="<?php echo $label_col_sm;?> control-label">Accessories</label>
                              <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control" id="invfork_acc" name="invfork_acc" value = "<?php echo $this->invfork_acc;?>" placeholder="Accesories" >

                              </div>
                          </div>

                          <div class="form-group">
                              <label for="invoice_currency" class="<?php echo $label_col_sm;?> control-label">Serial</label>
                              <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control" id="invfork_serial" name="invfork_serial" value = "<?php echo $this->invfork_serial;?>" placeholder="Serial" >

                              </div>
                              <label for="invoice_notes" class="<?php echo $label_col_sm;?> control-label">Battery</label>
                              <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control" id="invfork_battery" name="invfork_battery" value = "<?php echo $this->invfork_battery;?>" placeholder="Battery" >

                              </div>
                          </div>

                          <div class="form-group">
                              <label for="invoice_currency" class="<?php echo $label_col_sm;?> control-label">Battery Charger</label>
                              <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control" id="invfork_bat_charger" name="invfork_bat_charger" value = "<?php echo $this->invfork_bat_charger;?>" placeholder="Battery Charger" >

                              </div>
                              <label for="invoice_notes" class="<?php echo $label_col_sm;?> control-label">Charger S/Nr</label>
                              <div class="<?php echo $field_col_sm;?>">
                                <input type="text" class="form-control" id="invfork_snr" name="invfork_snr" value = "<?php echo $this->invfork_snr;?>" placeholder="Charger S/Nr" <?php //echo $disabled;?>>

                              </div>
                          </div>
                        </div>


                        <!---end of forklifts-->

                        <?php } ?>
                      <!-- Customer don have muti currency , so we hide it.-->
                        <!--<input type = 'hidden' id="invoice_currency" name="invoice_currency" value = '<?php echo $this->invoice_currency_org;?>'/>-->
                        <input type="hidden" class="form-control" id="invoice_currencyrate" name="invoice_currencyrate" value = "<?php echo $this->invoice_currencyrate;?>" placeholder="Currency Rate" READONLY>

                  </div><!-- /.box-body -->
                  <div class="box-body col-sm-3">
                      <!---extra right space???-->
                  </div>




                  <div class="box-footer" style = 'clear:both'>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->invoice_status;?>" name = "invoice_status"/>
                    <input type = "hidden" value = "<?php echo $this->invoice_id;?>" name = "invoice_id"/>
                    <?php
                    if($this->invoice_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                        if($isgenerated != 1){
                    ?>
                    <button type = "submit" class="btn btn-info">Save</button>
                        <?php }}?>
                    &nbsp;&nbsp;&nbsp;
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'print') && ($this->invoice_id > 0)){?>
                    <button type = "button" class="btn btn-primary"  onclick = "window.open('<?php echo $this->document_print_url;?>?action=<?php echo $this->document_type;?>&report_id=<?php echo $this->invoice_id;?>&matrix=0')">Print</button>
                    &nbsp;&nbsp;&nbsp;
                    <!--<button type = "button" class="btn btn-primary"  onclick = "window.open('<?php echo $this->document_print_url;?>?action=<?php echo $this->document_type;?>&report_id=<?php echo $this->invoice_id;?>&matrix=1')">Print (Matrix)</button>-->

                    <?php }?>
                    <?php
                    if($isgenerated > 0 ){
                        echo "<span style = 'margin-left:30px;color:red' ><b>This $this->document_code transaction already generated.</b></span>";
                    }
                   ?>
                  </div><!-- /.box-footer -->


            </div><!-- /.box -->
            <?php if($this->invoice_id > 0){?>
            <div class="box box-success">
                <div class="nav-tabs-custom" style = 'margin-top:5px;'>
                    <ul class="nav nav-tabs">
                      <li <?php if($_REQUEST['tab'] == "" || $_REQUEST['tab'] == 'detail_tab'){ echo 'class="active"';}?>><a href="#detail_tab" data-toggle="tab">Detail</a></li>
                      <?php if($this->document_type == 'SI'){ ?>
                      <li <?php if($_REQUEST['tab'] == 'sodo_order_tab'){ echo 'class="active"';}?>><a href="#sodo_order_tab" data-toggle="tab">Delivery Order</a></li>
                      <!--<li <?php if($_REQUEST['tab'] == 'sales_credit_note_tab'){ echo 'class="active"';}?>><a href="#sales_credit_note_tab" data-toggle="tab">Credit Note (Sales)</a></li>-->
                      <?php } ?>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane <?php if($_REQUEST['tab'] == "" || $_REQUEST['tab'] == 'detail_tab'){ echo 'active';}?>" id="detail_tab">
                            <?php echo $this->getAddItemDetailForm();?>
                        </div>
                        <div class="tab-pane <?php if($_REQUEST['tab'] == 'sodo_order_tab'){ echo 'active';}?>" id="sodo_order_tab">
                            <?php echo $this->getOrderGenerateTabTable();?>
                        </div>
                        <div class="tab-pane <?php if($_REQUEST['tab'] == 'sales_credit_note_tab'){ echo 'active';}?>" id="sales_credit_note_tab">
                            <?php echo $this->getInvoiceGenerateTabTable();?>
                        </div>
                    </div>
                </div>
            </div><!-- /.box -->
            <?php }?>
            </form>
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    ?>
    <script>

    var line_copy = '<tr id = "line_@i" class="tbl_grid_odd" line = "@i">' +
                    '<td style = "width:30px;padding-left:5px">@i</td>' +
//                    '<td style = "width:60px;"><input type = "text" id = "invl_seqno_@i" class="form-control" value=""/></td>'+
                    <?php if($this->document_type != 'PCN'){?>
                    '<td style = "width:100px;"><select style = "width:100px" line = "@i" id = "invl_pro_type_@i" class="form-control invoice-type-item"><option value="product">Product</option><option value="package">Package</option></select>' +
                    <?php } ?>
                    '<td style = "width:350px;"><select style = "width:350px" line = "@i" id = "invl_pro_id_@i" class="form-control invoice-item-list "><?php echo $this->prodCrtl;?></select></td>'+
                    '<td style="max-width:280px;width:280px;"><textarea style="max-width:280px;width:280px;" id = "invl_pro_desc_@i" class="form-control"></textarea></td>'+
                    '<td style = "width:60px;"><input type = "text" id = "invl_qty_@i" class="form-control calculate" value="1.00"/></td>'+
                    '<td style = "width:80px;"><select id = "invl_uom_@i" class="form-control select2"><?php echo $this->uomCrtl;?></select></td>'+
                    '<td style = "width:80px;"><input type = "text" id = "invl_fuprice_@i" class="form-control calculate text-align-right"/></td>'+
//                    '<td style = "width:80px;"><input type = "text" id = "invl_uprice_@i" class="form-control calculate text-align-right"/></td>'+
                    '<td style = "width:60px;"><input type = "text" id = "invl_disc_@i" class="form-control calculate text-align-right"/></td>'+
//                    '<td style = "width:20px;"><input type = "checkbox" style = "width:20%" id = "invl_istax_@i" class = "minimal isincludetax"/></td>'+
                    '<td style = "width:100px;"><input readonly type = "text" id = "invl_total_@i" class="form-control text-align-right"/></td>'+
                    '<td style = "width:120px;"><textarea rows="1" id = "invl_pro_remark_@i" class="form-control"></textarea></td>'+
                    '<td align = "center" class = "" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">' +
                    '<img id = "save_line_@i" invl_id = "" class = "save_line" line = "@i" src = "dist/img/add.png" style = "cursor:pointer" alt = "Add New"/>' +
                    '<img id = "delete_line_@i" invl_id = "" class = "delete_line" line = "@i" src = "dist/img/delete_icon.png" style = "cursor:pointer" alt = "Delete"/>' +
                    '<input type="hidden" id = "invl_product_location_@i" class="form-control"/>' +
                    '</td>'+
                    '</tr>';

    $(document).ready(function() {
        <?php
            if($this->document_type == 'SI' && $this->document_type != 'SCN' && $this->document_type != 'PCN' && $isgenerated != 1){
        ?>
            addline();
        <?php
            }else if($this->document_type == 'SI' || $this->document_type == 'PCN' || $this->document_type == 'SCN'){
                if($this->invoice_generate_from == 0 && $this->invoice_generate_from_type == null && $isgenerated != 1){
        ?>
                addline();
        <?php
                }
            }
        ?>
//        $(".select2").select2({
//            placeholder: "Select One"
//        });



        itemCodeAutoComplete();
        $('.invt_autocomplete').on("change", function(e) {
           getProductDetail($(this).val(),$(this).closest("tr").attr('line'));
        });
        $('.save_line').on('click',function(){
            saveline($(this).attr('line'),$(this).attr('invl_id'));
        });
        $('.delete_line').on('click',function(){
            deleteline($(this).attr('invl_id'));
        });
        $('.calculate').on('keyup',function(){
            calculate($(this).closest("tr").attr('line'));
        });
        $('.isincludetax').on('ifChanged',function(){
            calculate($(this).closest("tr").attr('line'));
        });
        $('.generate_btn').on('click',function(){
            generateDocument($(this).attr('generateto'));
        });
        $('#invoice_project_id').on("change", function(e) {
            getProjectDetail($(this).val());
        });
        $('#invoice_currency').on('change',function(){
            var data = "action=getCurrencyRateDetail&crate_tcurrency_id="+$(this).val()
             $.ajax({
                type: "POST",
                url: "crate.php",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_currencyrate').val(jsonObj.crate_rate);
                }
             });
        });
        $('#invoice_attentionto').change(function(){
            var data = "action=getContactJson&contact_id="+$(this).val()
             $.ajax({
                type: "POST",
                url: "partner.php",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_attentionto_phone').val(jsonObj.contact_tel);
                    $('#invoice_fax').val(jsonObj.contact_fax);
                }
             });
        });
        $('#invoice_customer').change(function(){
            var data = "action=getPartnerDetailTransaction&partner_id="+$(this).val()
             $.ajax({
                type: "POST",
                url: "partner.php",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");

                    //$('#invoice_attentionto').select2("destroy");
                    //$('#invoice_attentionto').select2();
                    //$('#invoice_shipping_id').select2("destroy");
                    //$('#invoice_shipping_id').select2();
                    $('#invoice_billaddress').html(jsonObj.partner_bill_address);
                    $('#invoice_shipaddress').val(jsonObj.partner_bill_address);
                    //Base on Login User
//                    $('#invoice_currency').val(jsonObj.partner_currency);
                    $('#invoice_salesperson').val(jsonObj.invoice_salesperson);
                    $('#invoice_attentionto').html(jsonObj.contact_option);
                    //$('#invoice_attentionto').select2("val", "");
                    $('#invoice_attentionto').val(0);
                    //$('#invoice_shipping_id').html(jsonObj.shipping_option);

                    //$('#order_attentionto').html(jsonObj.contact_option);
                    //$('#order_attentionto').select2("val", "");
                    //$('#order_billaddress').val(jsonObj.partner_name + "\n" + jsonObj.partner_bill_address).text();
                    //$('#order_shipaddress').val(jsonObj.partner_bill_address).text();
                }
             });
        });

        $('#invoice_shipping_id').change(function(){
            var data = "action=getShippingAddress&shipping_id="+$(this).val()
             $.ajax({
                type: "POST",
                url: "partner.php",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_shipaddress').html(jsonObj.shipping_address);
                }
             });
        });

        $('#invoice_attentionto').change(function(){
            var data = "action=getContactJson&contact_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "partner.php",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_attentionto_phone').val(jsonObj.contact_tel);
                    $('#invoice_attentionto_name').val(jsonObj.contact_name);
                    $('#invoice_fax').val(jsonObj.contact_fax);
                    if(jsonObj.contact_address != ""){
                        $('#invoice_shipaddress').val(jsonObj.contact_address);
                    }else{
                        var shipAddress = $('#invoice_shipaddress').val();
                        $('#invoice_shipaddress').val(shipAddress);
                    }
                }
             });
        });
        $('#invoice_price_id').change(function(){
            var data = "action=getPriceJson&invoice_price_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_price_remark').val(jsonObj.price_desc);
                }
             });
        });
        $('#invoice_delivery_id').change(function(){
            var data = "action=getDeliveryJson&invoice_delivery_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_delivery_remark').val(jsonObj.delivery_desc);
                }
             });
        });
        $('#invoice_paymentterm_id').change(function(){
            var data = "action=getPaymenttermJson&invoice_paymentterm_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_paymentterm_remark').val(jsonObj.paymentterm_desc);
                }
             });
        });
        $('#invoice_validity_id').change(function(){
            var data = "action=getValidityJson&invoice_validity_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_validity_remark').val(jsonObj.validity_desc);
                }
             });
        });
        $('#invoice_transittime_id').change(function(){
            var data = "action=getTransittimeJson&invoice_transittime_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_transittime_remark').val(jsonObj.transittime_desc);
                }
             });
        });
         $('#invoice_freightcharge_id').change(function(){
            var data = "action=getFreightchargeJson&invoice_freightcharge_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_freightcharge_remark').val(jsonObj.freightcharge_desc);
                }
             });
        });
        $('#invoice_pointofdelivery_id').change(function(){
            var data = "action=getPointofdeliveryJson&invoice_pointofdelivery_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_pointofdelivery_remark').val(jsonObj.pointofdelivery_desc);
                }
             });
        });
        $('#invoice_prefix_id').change(function(){
            var data = "action=getPrefixJson&invoice_prefix_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_prefix_remark').val(jsonObj.prefix_desc);
                }
             });
        });
        $('#invoice_remarks_id').change(function(){
            var data = "action=getRemarksJson&invoice_remarks_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_remarks_remark').val(jsonObj.remarks_desc);
                }
             });
        });
        $('#invoice_country_id').change(function(){
            var data = "action=getCountryJson&invoice_country_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invoice_country_remark').val(jsonObj.country_desc);
                }
             });
        });
        $('.invoice-type-item').change(function(){
            var line = $(this).attr('line');
            var data = "action=getItemListJson&invoice_type_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invl_pro_id_' + line).html(jsonObj.product_option);
                    $('#invl_pro_id_' + line).select2("val", "");
                }
             });
        });
        $('.invoice-item-list').change(function(){
            var line = $(this).attr('line');
            var qtype = $('option:selected','#invl_pro_type_' + line).attr('value');
            var data = "action=getItemDescJson&qt_type=" + qtype + "&invoice_item_id="+$(this).val();
             $.ajax({
                type: "POST",
                url: "<?php echo $this->document_url;?>",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invl_product_location_'+line).val(jsonObj.item_product_location);
                    <?php if ($this->document_type == 'SI' || $this->document_type == 'SCN') { ?>
                    $('#invl_pro_desc_'+line).val(jsonObj.item_desc);
                    $('#invl_fuprice_'+line).val(jsonObj.item_sale_price);
                    $('#invl_total_'+line).val(jsonObj.item_sale_price);
                    <?php }else{ ?>
                    $('#invl_pro_desc_'+line).val(jsonObj.item_desc);
                    $('#invl_fuprice_'+line).val(jsonObj.item_cost_price);
                    $('#invl_total_'+line).val(jsonObj.item_cost_price);
                    <?php } ?>
                }
             });
        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });

        $("#invoice_form").validate({
              rules:
              {
                  invoice_name:
                  {
                      required: true
                  }
              },
              messages:
              {
                  invoice_name:
                  {
                      required: "Please enter customer first name."
                  }
              }
        });


        $('#invoice_discheadertotal').keyup(function(){
                //calculate header discount

                var invoice_discheadertotal = parseFloat($('#invoice_discheadertotal').val().replace(/,/gi, ""));
                console.log(invoice_discheadertotal)
                if(isNaN(invoice_discheadertotal)){
                   invoice_discheadertotal = 0;
                }

                var invoice_subtotal = parseFloat($('#invoice_subtotal').val().replace(/,/gi, ""));
                if(isNaN(invoice_subtotal)){
                   invoice_subtotal = 0;
                }

                var invoice_finalsubtotal = parseFloat(invoice_subtotal) - parseFloat(invoice_discheadertotal);

                $('#invoice_finalsubtotal').val(changeNumberFormat(RoundNum(invoice_finalsubtotal,2)));

                var invoice_taxtotal = parseFloat(invoice_finalsubtotal) * (parseFloat(system_gst_percent)/100);
                $('#invoice_taxtotal').val(changeNumberFormat(RoundNum(invoice_taxtotal,2)));

                var invoice_grandtotal = parseFloat(invoice_finalsubtotal) + parseFloat(invoice_taxtotal);
                $('#invoice_grandtotal').val(changeNumberFormat(RoundNum(invoice_grandtotal,2)));


        });

        $(".toggle-payment").hide();
        $("button.payment-show").click(function(){
            if($(this).text()=== "Show"){
                $(this).text("Hide");
            }else{
                $(this).text("Show");
            }
            $(".toggle-payment").toggle();
        });

    });
    var issend = false;
    function saveline(line,invl_id){
        if(issend){
            alert("<?php echo $language[$lang]['pleasewait'];?>");
            return false;
        }

        // Uncheck check
        /*if($('#invl_istax_'+line).is(':checked')){
           var invl_istax = 1;
        }else{
           var invl_istax = 0;
        }
        issend = true;*/
        if(invl_id != ""){
            var action = 'updateline';
        }else{
            var action = 'saveline';
        }

        var data = "invl_seqno="+$('#invl_seqno_'+line).val();
            data += "&invl_pro_id="+$('#invl_pro_id_'+line).val();
            //data += "&invl_pro_no="+$('#invl_pro_id_'+line).select2('data')[0].text;
            data += "&invl_pro_desc="+encodeURIComponent($('#invl_pro_desc_'+line).val());
            data += "&invl_pro_remark="+encodeURIComponent($('#invl_pro_remark_'+line).val());
            data += "&invl_qty="+$('#invl_qty_'+line).val();
            data += "&invl_uom="+$('#invl_uom_'+line).val();
            data += "&invl_fuprice="+$('#invl_fuprice_'+line).val();
            data += "&invl_disc="+$('#invl_disc_'+line).val();
            //data += "&invl_istax="+invl_istax;
            data += "&invl_istax=1";
            data += "&invl_pro_type="+$('#invl_pro_type_'+line).val();
            data += "&invl_product_location="+encodeURIComponent($('#invl_product_location_'+line).val());
            data += "&action="+action;
            //data += "&action=saveline";
            data += "&invl_id="+invl_id;
            data += "&invoice_id=<?php echo $_REQUEST['invoice_id'];?>";

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
    function deleteline(invl_id){
        var data = "action=deleteline&invoice_id=<?php echo $this->invoice_id;?>&invl_id="+invl_id;
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
    function calculate(line){
        var qty = parseFloat($('#invl_qty_'+line).val().replace(/,/gi, ""));
        var unit_price = parseFloat($('#invl_fuprice_'+line).val().replace(/,/gi, ""));
        var discount = parseFloat($('#invl_disc_'+line).val().replace(/,/gi, ""));

        if(qty == ""){
           qty = 1;
        }
        if(isNaN(unit_price)){
           unit_price = 0;
        }
        if(isNaN(discount)){
           discount = 0;
        }

        var subtotal = parseFloat(qty) * parseFloat(unit_price);

        if(discount > 0){
            var disc_amt = RoundNum(parseFloat(subtotal) * (parseFloat(discount)/100),2);
        }else{
            var disc_amt = 0;
        }

        var subtotal_afterdiscount = parseFloat(subtotal) - parseFloat(disc_amt);

//        if($('#invl_istax_'+line).is(':checked')){
//           var gst_amt = RoundNum(parseFloat(subtotal_afterdiscount) * (parseFloat(system_gst_percent)/100),2);
//        }else{
//           var gst_amt = 0;
//        }
        var gst_amt = 0;
        var grandtotal = RoundNum(parseFloat(subtotal_afterdiscount) + parseFloat(gst_amt),2);

        $('#invl_total_'+line).val(changeNumberFormat(grandtotal));
        $('#invl_taxamt_'+line).val(changeNumberFormat(RoundNum(gst_amt,2)));
    }
    function getProductDetail(product_id,line){
         var data = "action=getProductDetail&product_id="+product_id;
         $.ajax({
            type: "POST",
            url: "product.php",
            data:data,
            success: function(data) {
                var jsonObj = eval ("(" + data + ")");

                $('#invl_pro_desc_'+line).html(jsonObj.product_desc);
                $('#invl_fuprice_'+line).val(jsonObj.product_sales_price);
                calculate(line);
            }
         });
    }
    function itemCodeAutoComplete(){

        $(".invt_autocomplete").select2({
              placeholder: "Search for a Item",
//              minimumInputLength: 2,
              ajax: {
                  url: 'autocomplete.php?action=item&document_type=<?php echo $this->document_type;?>',
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
              templateSelection: function(data){
                    return data.value;
              },
        });
    }
    function generateDocument(generate_document_type){
         var data = "action=generateDocument&invoice_id=<?php echo $this->invoice_id;?>&generate_document_type="+generate_document_type;
         var url = "<?php echo $this->document_url;?>";
         var pid = "invoice_id";
         if(generate_document_type == 'SCN'){
             url = "sales_cn.php";
         }else if(generate_document_type == 'DO'){
             url = "delivery_order.php";
             pid = "order_id";
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
                    //window.location.href = "<?php echo $this->document_url;?>?action=edit&invoice_id=<?php echo $_REQUEST['invoice_id']?>&tab="+jsonObj.tab;
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
        $('#invl_seqno_'+nextvalue).val(nextvalue*10);
    }
    function getProjectDetail(project_id){
         var data = "action=getProjectDetail&project_id="+project_id;
         $.ajax({
            type: "POST",
            url: "project.php",
            data:data,
            success: function(data) {
                var jsonObj = eval ("(" + data + ")");
                $('#invoice_subcon').select2('val', 'All');
                $('#invoice_subcon').html(jsonObj.subcon_option);
            }
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
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='<?php echo $this->document_url;?>?action=createForm'">Create New + </button>
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="invoice_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>Doc.No</th>
                        <?php if($this->document_type == 'PCN' || $this->document_type == 'SCN'){?>
                        <th style = 'width:12%'>Supplier</th>
                        <?php }else{?>
                        <th style = 'width:12%'>Customer</th>
                        <?php }?>
                        <th style = 'width:8%'>Date</th>
                        <?php if($this->document_type != 'SI' && $this->document_type != 'PCN' && $this->document_type != 'SCN'){?>
                        <th style = 'width:10%'>Project Name</th>
                        <?php if($this->document_type == 'PI'){?>
                            <th style = 'width:10%'>Goods Received Note</th>
                        <?php }else{?>
                        <th style = 'width:10%'>Job No.</th>
                        <?php }?>
                        <?php }?>
                        <th style = 'text-align:right;width:5%'>Total</th>
                        <th style = 'text-align:right;width:5%'>GST</th>
                        <th style = 'text-align:right;width:5%'>Total (incl. 7% GST)</th>
                        <?php if($this->document_type != 'PCN' && $this->document_type != 'SCN'){?>
                        <th style = 'width:5%'>Is Generated</th>
                        <?php }?>
                        <th style = 'width:10%'>Payment Status</th>
                        <!--<th style = 'width:5%'>Status</th>-->
                        <th style = 'width:9%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $sql = "SELECT o.*,pr.partner_id,
                              CONCAT(pr.partner_code,' - ',pr.partner_name) as partner_name,empl.empl_name as sales_person,pro.project_code,pro.project_name
                              FROM db_invoice o
                              INNER JOIN db_partner pr ON pr.partner_id = o.invoice_customer
                              LEFT JOIN db_empl empl ON empl.empl_id = o.invoice_salesperson
                              LEFT JOIN db_project pro ON pro.project_id = o.invoice_project_id
                              WHERE o.invoice_id > 0 AND o.invoice_status = 1 $this->wherestring ORDER BY o.invoice_no DESC";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $row['invoice_no'];?></td>
                            <td><?php echo "<a href = 'partner.php?action=edit&tab=$this->document_type&partner_id={$row['partner_id']}'>" . $row['partner_name'] . "</a>";?></td>
                            <td><?php echo format_date($row['invoice_date']);?></td>
                            <?php if($this->document_type != 'SI' && $this->document_type != 'PCN' && $this->document_type != 'SCN'){?>
                            <td><?php echo $row['project_code'] . " - " . $row['project_name'];?></td>
                            <?php if(($this->document_type == 'SI') || ($this->document_type == 'SCN')){?>
                            <td><?php echo $row['invoice_customerpo'];?></td>
                            <?php } if($this->document_type == 'PI'){?>
                            <td>
                                <?php
                                   $qt_query = getDataBySql("order_no,order_id","db_order"," WHERE order_id = '{$row['invoice_generate_from']}' AND order_status = '1'");
                                   $qt_no = "";
                                   while($r_qt = mysql_fetch_array($qt_query)){
                                   $qt_no =  "<a href = 'grn.php?action=edit&order_id={$r_qt['order_id']}' target = '_blank'>" . $r_qt['order_no'] . "</a>,";
                                   }
                                   echo rtrim($qt_no,",");
                                ?>
                            </td>
                            <?php }} ?>
                            <td style="text-align:right;">
                                <?php
                                $this->invoice_id = $row['invoice_id'];
                                echo num_format($this->getSubTotalAmt() + $this->getTotalGstAmt());
                                ?>
                            </td>
                            <td style="text-align:right;">
                                <?php
                                echo num_format($row['invoice_taxtotal']);
                                ?>
                            </td>
                            <td style="text-align:right;">
                                <?php
                                    echo num_format($row['invoice_grandtotal']);
                                ?>
                            </td>
                            <?php if($this->document_type != 'PCN' && $this->document_type != 'SCN'){?>
                            <td>
                                <?php
                                    $orderNoLink = $this->fetchOrderNoDetail($this->document_type,$row['invoice_id']);
                                    $orderNoLink = str_replace(",", ",<br>", $orderNoLink);
                                    echo "<b>".$orderNoLink."</b>";
                                ?>
                            </td>
                            <?php }?>
                            <td><?php if($row['invoice_payment'] == 1){ echo 'Paid';}else{ echo 'Unpaid';}?></td>
                            <!--<td><?php if($row['invoice_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>-->
                            <td class = "text-align-right">
                                <?php
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = '<?php echo $this->document_url;?>?action=edit&invoice_id=<?php echo $row['invoice_id'];?>'">Edit</button>
                                <?php }?>
                                <?php
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('<?php echo $this->document_url;?>?action=delete&invoice_id=<?php echo $row['invoice_id'];?>','Confirm Delete?')">Delete</button>
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
                        <?php if($this->document_type == 'PCN' || $this->document_type == 'SCN'){?>
                        <th style = 'width:12%'>Supplier</th>
                        <?php }else{?>
                        <th style = 'width:12%'>Customer</th>
                        <?php }?>
                        <th style = 'width:8%'>Date</th>
                        <?php if($this->document_type != 'SI' && $this->document_type != 'PCN' && $this->document_type != 'SCN'){?>
                        <?php if($this->document_type == 'PI'){?>
                            <th style = 'width:10%'>Goods Received Note</th>
                        <?php }else{?>
                        <th style = 'width:10%'>Project Name</th>
                        <th style = 'width:10%'>Job No.</th>
                        <?php }} ?>
                        <th style = 'text-align:right;width:5%'>Total</th>
                        <th style = 'text-align:right;width:5%'>GST</th>
                        <th style = 'text-align:right;width:5%'>Total (incl. 7% GST)</th>
                        <?php if($this->document_type != 'PCN' && $this->document_type != 'SCN'){?>
                        <th style = 'width:5%'>Is Generated</th>
                        <?php }?>
                        <!--<th style = 'width:5%'>Status</th>-->
                        <th style = 'width:9%'></th>
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
        $('#invoice_table').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "invoiceing": true,
          "info": true,
          "autoWidth": false,
          "order": [[2, "desc"], [0, "desc"]]
        });

      });
    </script>
  </body>
</html>
    <?php
    }
    public function getAddItemDetailForm(){
    $line = 0;
        if($this->document_type == 'SI'){
            $isgenerated = getDataCountBySql("db_order"," WHERE order_generate_from = '$this->invoice_id' AND order_generate_from_type = '$this->document_type' AND order_status = 1 AND order_generate_from > 0");
        }
    ?>
    <table id="detail_table" class="table transaction-detail">
        <thead>
          <tr>
            <th class = "" style="width:30px;padding-left:5px">No</th>
            <!--<th class = ""  style = 'width:30px;'>Seq No</th>-->
            <?php if($this->document_type != 'PCN'){?>
            <th class = "" style = 'width:120px;'>Type</th>
            <?php } ?>
            <th class = "" style = 'width:120px;'>Part No</th>
            <th class = "" style = 'width:200px;'>Description</th>
            <th class = "" style = 'width:60px;'>Qty</th>
            <th class = "" style = 'width:80px;'>UOM</th>
            <!--<th class = "" style = 'width:80px;'>U.Price(Foreign)</th>-->
            <th class = "" style = 'width:80px;'>U.Price(<span class = 'base_currency_span'><?php echo $this->invoice_currency_code;?></span>)</th>
            <th class = "" style = 'width:60px;'>Disc %</th>
            <th class = "" style="width:60px;">Sub Total(<span class = 'base_currency_span'><?php echo $this->invoice_currency_code;?></span>)</th>
            <th class = "" style="">Remark</th>
            <th class = "" style=""></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM db_invl WHERE invl_id > 0 AND invl_invoice_id > 0 AND invl_invoice_id = '$this->invoice_id' ORDER BY invl_seqno";
            $query = mysql_query($sql);
            while($row = mysql_fetch_array($query)){
                $line++;
                $this->uomCrtl = $this->select->getUomSelectCtrl($row['invl_uom'],'N');
                $this->prodNameCrtl = $this->select->getProductNameSelectCtrl($row['invl_pro_id'],'N');
                $this->packNameCrtl = $this->select->getPackageNameSelectCtrl($row['invl_pro_id'],'N');
                if($this->document_type == 'SI' && $isgenerated == 1){
                    $readonly = " READONLY";
                    $disabled = " DISABLED";
                }
            ?>
                <tr id = "line_<?php echo $line;?>" class="tbl_grid_odd" line = "<?php echo $line;?>">
                    <td style="width:30px;padding-left:5px"><?php echo $line;?></td>
                    <!--<td style="width:60px;"><input type = "text" id = "invl_seqno_<?php echo $line;?>" class="form-control" value="<?php echo $row['invl_seqno'];?>" <?php echo $readonly;?>/></td>-->
                    <?php if($this->document_type != 'PCN'){?>
                    <td style="width:100px;">
                        <!--<select style = 'width:100%' id = "invl_pro_id_<?php echo $line;?>" class="form-control invt_autocomplete " <?php echo $disabled;?>>
                            <option value = '<?php echo $row['invl_pro_id'];?>'><?php echo $row['invl_pro_no'];?></option>
                        </select>-->
                        <select style = "width:100px;" line = "<?php echo $line;?>" id = "invl_pro_type_<?php echo $line;?>" class="form-control invoice-type-item" <?php echo $disabled;?>>
                            <option value="product" <?php if($row['invl_item_type'] == 'product'){ echo "selected";} ?>>Product</option>
                            <option value="package" <?php if($row['invl_item_type'] == 'package'){ echo "selected";} ?>>Package</option>
                        </select>
                    </td>
                    <?php } ?>
                    <td style="width:350px;" >
                        <!--<textarea id = "invl_pro_desc_<?php echo $line;?>" class="form-control" <?php echo $readonly;?>><?php echo $row['invl_pro_desc'];?></textarea>-->
                        <select style = "width:350px;" line = "<?php echo $line;?>" id = "invl_pro_id_<?php echo $line;?>" class="form-control invoice-item-list" <?php echo $disabled;?>>
                        <?php if($row['invl_item_type']=='product')
                        {
                            echo $this->prodNameCrtl;
                        }
                        else
                        {
                            echo $this->packNameCrtl;
                        }
                         ?>
                        </select>
                    </td>
                    <td style="max-width:280px;width:280px;"><textarea style="max-width:280px;width:280px;" id = "invl_pro_desc_<?php echo $line;?>" class="form-control" <?php echo $readonly;?>><?php echo html_entity_decode($row['invl_pro_desc']);?></textarea></td>
                    <td style="width:60px;"><input type = "text" id = "invl_qty_<?php echo $line;?>" class="form-control calculate" value="<?php echo $row['invl_qty'];?>" <?php echo $readonly;?>/></td>
                    <td style="width:80px;"><select style = 'width:100%' id = "invl_uom_<?php echo $line;?>" class="form-control select2" <?php echo $disabled;?>><?php echo $this->uomCrtl;?></select></td>
                    <td style="width:60px;"><input type = "text" id = "invl_fuprice_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo num_format($row['invl_fuprice']);?>" <?php echo $readonly;?>/></td>
                    <!--<td style="width:60px;"><input type = "text" id = "invl_uprice_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo num_format($row['invl_uprice']);?>" <?php echo $readonly;?>/></td>-->

                    <td style="width:60px;"><input type = "text" id = "invl_disc_<?php echo $line;?>" class="form-control calculate text-align-right" value = "<?php echo $row['invl_disc'];?>" <?php echo $readonly;?>/></td>
                    <!--<td style="width:20px;"><input type = "checkbox" id = "invl_istax_<?php echo $line;?>" class = "minimal isincludetax" <?php if($row['invl_istax'] == 1){ echo 'CHECKED';}?> <?php echo $disabled;?>/></td>
                    <td style = "width:80px;"><input type = "text" id = "invl_taxamt_<?php echo $line;?>" class="form-control text-align-right" readonly value = "<?php echo num_format($row['invl_taxamt']);?>"/></td>-->
                    <td style = "width:100px;"><input type = "text" id = "invl_total_<?php echo $line;?>" class="form-control text-align-right" readonly value = "<?php echo num_format($row['invl_total']);?>"/></td>
                    <td style="max-width:250px;width:250px;"><textarea style="max-width:250px;width:250px;" id = "invl_pro_remark_<?php echo $line;?>" class="form-control" <?php echo $readonly;?>><?php echo $row['invl_pro_remark'];?></textarea></td>
                    <td align = "center" style ="vertical-align:top;padding-right:10px;padding-left:5px">
                        <?php if(($row['invl_id'] > 0)&& ($disabled == "")){?>
                        <img id = "save_line_<?php echo $line;?>" invl_id = "<?php echo $row['invl_id'];?>" class = "save_line" line = "<?php echo $line;?>" src = "dist/img/update.png" style = "cursor:pointer" alt = "Update"/>
                        <?php }else{
                            if($disabled == ""){
                        ?>
                        <img id = "save_line_<?php echo $line;?>" invl_id = "<?php echo $row['invl_id'];?>" class = "save_line" line = "<?php echo $line;?>" src = "dist/img/add.png" style = "cursor:pointer" alt = "Add New"/>
                        <?php }
                            }
                            if($disabled == ""){
                        ?>
                        <img id = "delete_line_<?php echo $line;?>" invl_id = "<?php echo $row['invl_id'];?>" class = "delete_line" line = "<?php echo $line;?>" src = "dist/img/delete_icon.png" style = "cursor:pointer" alt = "Delete"/>
                        <?php }?>
                        <input type="hidden" line = "<?php echo $line;?>" id = "invl_product_location_<?php echo $line;?>" class="form-control text-align-left" value = "<?php echo num_format($row['invl_product_location']);?>" <?php echo $readonly;?>/>
                    </td>
                </tr>

            <?php
            }
            ?>
            <tr id = 'detail_last_tr'></tr>
            <tr id="invoice_total_price">
                <td colspan="8" align="right">Total (<span class = 'base_currency_span'><?php echo $this->invoice_currency_code;?></span>):</td>
                <td class="invoice-subtotal text-align-right" style="width: 100px;"><input type="text" class="form-control text-align-right" id="invoice_subtotal" name="invoice_subtotal" value = "<?php echo num_format($this->invoice_subtotal - $this->invoice_disctotal);?>" disabled></td>
                <!--<td class="invoice-subtotal text-align-right"><label for="invoice_subtotal" class="invl-invoice-price invoice-subtotal"><?php echo num_format($this->invoice_subtotal - $this->invoice_disctotal);?></label></td>-->
                <td colspan="2"></td>
            </tr>
            <?php //if(!empty($this->invoice_discheadertotal) && ($this->invoice_discheadertotal > 0)){?>
            <tr id="invoice_discount_price">
                <td colspan="8" align="right">Disc (<span class = 'base_currency_span'><?php echo $this->invoice_currency_code;?></span>):</td>
                <td class="invoice-discheadertotal text-align-right" style="width: 100px;"><input type="text" class="form-control text-align-right" id="invoice_discheadertotal" name="invoice_discheadertotal" value = "<?php echo num_format($this->invoice_discheadertotal);?>" <?php echo $disabled; ?> ></td>
                <!--<td class="invoice-discheadertotal text-align-right"><label for="invoice_discheadertotal" class="invl-invoice-price invoice-discheadertotal"><?php echo num_format($this->invoice_discheadertotal);?></label></td>-->
                <td colspan="2"></td>
            </tr>
            <tr id="invoice_subtotal_price">
                <td colspan="8" align="right">Sub Total (<span class = 'base_currency_span'><?php echo $this->invoice_currency_code;?></span>):</td>
                <td class="invoice-fin-subtotal text-align-right" style="width: 100px;"><input type="text" class="form-control invoice-fin-subtotal text-align-right"  id = 'invoice_finalsubtotal' name = 'invoice_finalsubtotal' value = "<?php echo num_format(($this->invoice_subtotal - $this->invoice_disctotal) - $this->invoice_discheadertotal);?>" disabled></td>
                <!--<td class="invoice-fin-subtotal text-align-right"><label for="invoice_fin_subtotal" class="invl-invoice-price invoice-fin-subtotal"><?php echo num_format($this->invoice_subtotal - $this->invoice_disctotal - $this->invoice_discheadertotal);?></label></td>-->
                <td colspan="2"></td>
            </tr>
            <?php //} ?>
            <tr id="invoice_tax_price">
                <td colspan="8" align="right">Tax Amount <?php echo system_gst_percent;?>%(<span class = 'base_currency_span'><?php echo $this->invoice_currency_code;?></span>):</td>
                <td class="invoice-taxtotal text-align-right" style="width: 100px;"><input type="text" class="form-control invoice-taxtotal text-align-right" id="invoice_taxtotal" name="invoice_taxtotal" value = "<?php echo num_format($this->invoice_taxtotal);?>" disabled></td>
                <!--<td class="invoice-taxtotal text-align-right"><label for="invoice_taxtotal" class="invl-invoice-price invoice-taxtotal"><?php echo num_format($this->invoice_taxtotal);?></label></td>-->
                <td colspan="2"></td>
            </tr>
            <tr id="invoice_grandtotal_price">
                <td colspan="8" align="right"><b>Grand Total (<span class = 'base_currency_span'><?php echo $this->invoice_currency_code;?></span>)</b>:</td>
                <td class="invoice-grandtotal text-align-right" style="width: 100px;"><input type="text" class="form-control invoice-grandtotal text-align-right" id="invoice_grandtotal" name="invoice_grandtotal" value = "<?php echo num_format($this->invoice_grandtotal);?>" disabled></td>
                <!--<td class="invoice-grandtotal text-align-right"><label for="invoice_grandtotal" class="invl-invoice-price invoice-grandtotal"><?php echo num_format($this->invoice_grandtotal);?></label></td>-->
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>
    <input type = 'hidden' id = 'total_line' name = 'total_line' value = '<?php echo $line;?>'/>
    <?php
    }
    public function getOrderGenerateTabTable(){
      include_once 'Order.php';
      if($this->document_type == 'SI'){
          /*$document_type = 'Progress Claim';
          $generate_to = 'SO';
          $partner_field = 'Customer';
          $menu_id = '6';// sales order menu id is 12
          $document_url = 'sales_order.php';
          $salesperson_field = "Ordered By";*/
          $document_type = 'Delivery Order';
          $generate_to = 'DO';
          $partner_field = 'Customer';
          $menu_id = '85';// purchase order in db_menu id is 39
          $document_url = 'delivery_order.php';
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
                <th style = 'width:10%'>Date</th>
                <th style = 'width:15%'><?php echo $partner_field;?></th>
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
                      WHERE o.order_generate_from = '$this->invoice_id' AND order_generate_from_type = '$this->document_type' AND o.order_status = '1'";
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
                    <td><?php echo $row['order_date'];?></td>
                    <td><?php echo $row['partner_name'];?></td>
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
    public function getInvoiceGenerateTabTable(){

      if($this->document_type == 'QT'){
          $document_type = 'Sales Invoice';
          $generate_to = 'SO';
          $partner_field = 'Customer';
          $menu_id = '12';// sales invoice menu id is 12
          $document_url = 'sales_invoice.php';
      }else if($this->document_type == 'SI'){
          $document_type = 'Sales Credit Note';
          $generate_to = 'SCN';
          $partner_field = 'Customer';
          $menu_id = '13';// delivery invoice menu id is 13
          $document_url = 'sales_cn.php';
      }else if($this->document_type == 'SO'){
          $document_type = 'Delivery Invoice';
          $generate_to = 'DO';
          $partner_field = 'Customer';
          $menu_id = '13';// delivery invoice menu id is 13
          $document_url = 'delivery_invoice.php';
      }
    ?>
    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title"><?php echo $document_type;?> Table</h3></div>
          <div class = "pull-right">
            <?php
            if(getWindowPermission($menu_id,'generate')){
            ?>
               <button type = 'button' class = "btn btn-primary generate_btn" generateto = "<?php echo $generate_to;?>">Generate <?php echo $document_type;?></button>
            <?php }?>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-binvoiceed table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
                <th style = 'width:15%'>Document No</th>
                <th style = 'width:10%'>Date</th>
                <th style = 'width:15%'><?php echo $partner_field;?></th>
                <th style = 'width:15%'>Sales Person</th>
                <th style = 'width:15%'>Sub Total</th>
                <th style = 'width:10%'>Tax</th>
                <th style = 'width:10%'>Grand Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php
              $sql = "SELECT o.*,partner.partner_name,empl.empl_name
                      FROM db_invoice o
                      INNER JOIN db_partner partner ON partner.partner_id = o.invoice_customer
                      LEFT JOIN db_empl empl ON empl.empl_id = o.invoice_salesperson
                      WHERE o.invoice_generate_from = '$this->invoice_id' AND o.invoice_status = '1'";
              $query = mysql_query($sql);
              $i = 1;
              while($row = mysql_fetch_array($query)){
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['invoice_no'];?></td>
                    <td><?php echo $row['invoice_date'];?></td>
                    <td><?php echo $row['partner_name'];?></td>
                    <td><?php echo $row['empl_name'];?></td>
                    <td><?php echo $this->getSubTotalAmt() - $this->getTotalDiscAmt();?></td>
                    <td><?php echo $this->getTotalGstAmt();?></td>
                    <td><?php echo num_format(($this->getSubTotalAmt() - $this->getTotalDiscAmt()) + $this->getTotalGstAmt());?></td>
                    <td class = "text-align-right">
                        <?php
                        if(getWindowPermission($_SESSION['m'][$_SESSION['partner_id']],'update')){
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
    public function generateDocument(){
      include_once 'class/Order.php';
      $order = new Order();
      if($this->document_type == 'SI'){
            $this->document_code = "Sales Invoice";
            $this->newurl = 'sales_invoice.php';

            $query = $order->fetchOrderDetail(" AND order_id = '$this->order_id'","","",0);
            if($query){
                $this->invoice_generate_from = $this->order_id;
                $this->order_generate_from_type = $this->order_prefix_type;
                $this->document_type = $this->generate_document_type;

                $r = mysql_fetch_array($query);
                if($this->generateInvoice($r)){
                    $this->newinvoice_id = $this->invoice_id;
                    $order->order_id = $this->order_id;
                    $query = $order->fetchOrderLineDetail("","","",0);
                    $this->invoice_disctotal = $order->getTotalDiscAmt();
                    $this->invoice_subtotal = $order->getSubTotalAmt();
                    $this->invoice_taxtotal = $order->getTotalGstAmt();
                    $this->invoice_discheadertotal = $r['order_discheadertotal'];
                    $this->invoice_id = $this->newinvoice_id;
                    $this->updateInvoiceTotal();
                    while($row = mysql_fetch_array($query)){
                        $this->generateInvoiceLine($row,$this->newinvoice_id);
                    }
                    return true;
                }else{
                    return false;
                }
          }else{
              return false;
          }
      }else if($this->document_type == 'PCN'){
            $this->document_code = "Purchase Credit Note";
            $this->newurl = 'purchase_cn.php';

            $query = $order->fetchOrderDetail(" AND order_id = '$this->order_id'","","",0);
            if($query){
                $this->invoice_generate_from = $this->order_id;
                $this->order_generate_from_type = $this->document_type;
                $this->document_type = $this->generate_document_type;

                $r = mysql_fetch_array($query);
                if($this->generateInvoice($r)){
                    $this->newinvoice_id = $this->invoice_id;
                    $order->order_id = $this->order_id;
                    $query = $order->fetchOrderLineDetail("","","",0);
                    $this->invoice_disctotal = $order->getTotalDiscAmt();
                    $this->invoice_subtotal = $order->getSubTotalAmt();
                    $this->invoice_taxtotal = $order->getTotalGstAmt();

                    $this->invoice_id = $this->newinvoice_id;
                    $this->updateInvoiceTotal();
                    while($row = mysql_fetch_array($query)){
                        $this->generateInvoiceLine($row,$this->newinvoice_id);
                    }
                    return true;
                }else{
                    return false;
                }
          }else{
              return false;
          }
      }else if($this->generate_document_type == 'SCN'){
            $this->document_code = "Sales Credit Note";
            $this->newurl = 'sales_cn.php';

            $query = $this->fetchInvoiceDetail(" AND invoice_id = '$this->invoice_id'","","",0);
            $inv_id = $this->invoice_id;
            if($query){
                $this->invoice_generate_from = $this->invoice_id;
                $this->invoice_generate_from_type = $this->document_type;
                $this->document_type = $this->generate_document_type;


                $r = mysql_fetch_array($query);
                if($this->generateInvoice($r)){
                    $this->newinvoice_id = $this->invoice_id;
                    $this->invoice_id = $inv_id;
                    //$order->order_id = $this->order_id;
                    $query = $this->fetchInvoiceLineDetail("","","",0);
                    $this->invoice_disctotal = $this->getTotalDiscAmt();
                    $this->invoice_subtotal = $this->getSubTotalAmt();
                    $this->invoice_taxtotal = $this->getTotalGstAmt();

                    $this->invoice_id = $this->newinvoice_id;
                    $this->updateInvoiceTotal();
                    while($row = mysql_fetch_array($query)){
                        $this->generateInvoiceLine($row,$this->newinvoice_id);
                    }
                    return true;
                }else{
                    return false;
                }
            }
      }else if($this->document_type == 'eSI'){
                include_once 'Partner.php';
                include_once 'Product.php';
                $b      = new Partner();
                $pro    = new Product();
                $this->document_code = "e-Sales Invoice";
                $this->invoiceSql = '';
                $this->invlSql = '';
                $invoice = array();
                $invoiceline=array();
                $m = 0;
                /*
                 * Fetch and Insert Customer Detail
                 */
                $custCode = "CE-Z001";
                $b->fetchPartnerDetail(" AND partner_code = '".$custCode."'","","",1);
                $invoice = array(
                    'invoice_customer'          => $b->partner_id,
                    'invoice_attentionto_name'  => $this->e_invoice_firstname[$m] .' '. $this->e_invoice_lastname[$m],
                    'invoice_attentionto_email' => $this->e_invoice_email[$m],
                    'invoice_attentionto_phone' => $this->e_invoice_telephone[$m],
                    'invoice_billaddress'       => $this->e_invoice_payment_address_1[$m] .' '. $this->e_invoice_payment_address_2[$m] .' \n'. $this->e_invoice_payment_postcode[$m] .' '. $this->e_invoice_payment_city[$m] .' '. $this->e_invoice_payment_country[$m],
                    'invoice_shipaddress'       => $this->e_invoice_payment_address_1[$m] .' '. $this->e_invoice_payment_address_2[$m] .' \n'. $this->e_invoice_payment_postcode[$m] .' '. $this->e_invoice_payment_city[$m] .' '. $this->e_invoice_payment_country[$m],
                    'invoice_remark'            => 'e-SO ' . $this->e_invoice_order_id[$m] .', customer from e-commerce: \n' . $this->e_invoice_firstname[$m] .' '. $this->e_invoice_lastname[$m] .' \n'. $this->e_invoice_email[$m] .' \n'. $this->e_invoice_telephone[$m]  .' \n'. $this->e_invoice_payment_address_1[$m] .' '. $this->e_invoice_payment_address_2[$m] .' \n'. $this->e_invoice_payment_postcode[$m] .' '. $this->e_invoice_payment_city[$m] .' '. $this->e_invoice_payment_country[$m]
                );
                /*
                 * Generate Invoice
                 */
                if($this->generateInvoice($invoice)){
                    $this->newinvoice_id = $this->invoice_id;
                    while($m < $this->e_invoice_num_pro){
                        $pro->fetchProductDetail(" AND product_part_no = '" . $this->e_invoice_model[$m] ."'","","",1);
                        $invoiceline = array(
                            'invl_pro_id'       => $pro->product_id,
                            'invl_pro_desc'     => $pro->product_desc,
                            'invl_qty'          => $this->e_invoice_quantity[$m],
                            'invl_uprice'       => $this->e_invoice_price[$m],
                            'invl_total'        => $this->e_invoice_price[$m] * $this->e_invoice_quantity[$m],
                            'invl_fuprice'      => $this->e_invoice_price[$m],
                            'invl_ftotal'       => $this->e_invoice_price[$m] * $this->e_invoice_quantity[$m],
                            'invl_item_type'    => "product"
                        );
                        /*
                        * Generate Invoiceline
                        */
                        if($invoiceline){
                            $this->generateInvoiceLine($invoiceline,$this->newinvoice_id);
                        }else{
                            return false;
                        }
                        $this->invlSql      .= $this->invl_sql;
                        $m++;
                    }
                    $m=0;
                    if($this->e_invoice_shipping_code[$m] == 'flat.flat'){
                        $pro->fetchProductDetail(" AND product_part_no = 'flat15'","","",1);
                        $invoiceline = array(
                            'invl_pro_id'       => $pro->product_id,
                            'invl_pro_desc'     => $pro->product_desc,
                            'invl_qty'          => 1,
                            'invl_uprice'       => $pro->product_sale_price,
                            'invl_total'        => $pro->product_sale_price * 1,
                            'invl_fuprice'      => $pro->product_sale_price,
                            'invl_ftotal'       => $pro->product_sale_price * 1,
                            'invl_item_type'    => "product"
                        );
                        /*
                        * Generate Invoiceline
                        */
                        if($invoiceline){
                            $this->generateInvoiceLine($invoiceline,$this->newinvoice_id);
                        }else{
                            return false;
                        }
                        $this->invlSql      .= $this->invl_sql;
                    }
                    /*
                    * Update Total for Invoice
                    */
                    $this->invoice_disctotal = $this->getTotalDiscAmt();
                    $this->invoice_subtotal = $this->getSubTotalAmt();
                    $this->invoice_taxtotal = $this->getTotalGstAmt();
                    $this->invoice_id = $this->newinvoice_id;
                    $this->updateInvoiceTotal();
                    $this->invoiceSql   .= $this->invoice_sql;
                    //$this->inv      = $invoice;
                    //$this->invl      = $invoiceline;
                    return true;
                }else{
                    return false;
                }
    }else{
        return false;
    }
}
    public function generateInvoice($r){
        $invoice_no = get_prefix_value($this->document_code,true,system_date,$subprefix);
        if($this->document_type == 'SI' || $this->document_type == 'PCN'){
            $db_tbl = 'order';
        }else if($this->document_type == 'SCN'){
            $db_tbl = 'invoice';
        }else if($this->document_type == 'eSI'){
            $db_tbl = 'invoice';
            $invoice_no = get_prefix_value($this->document_code,true,system_date,$subprefix);
        }
        //$subprefix = getDataCodeBySql("project_code","db_project"," WHERE project_id = '{$r['order_project_id']}'","");
        //$subprefix = "/" . $subprefix . "/" . getDataCodeBySql("partner_code","db_partner"," WHERE partner_id = '{$r['order_customer']}'","") . "/";

        $table_field = array('invoice_no','invoice_date','invoice_customer','invoice_salesperson',
                             'invoice_billaddress','invoice_attentionto','invoice_shipterm','invoice_term',
                             'invoice_shipaddress','invoice_customerref','invoice_remark','invoice_customerpo',
                             'invoice_currency','invoice_currencyrate','invoice_status','invoice_prefix_type',
                             'invoice_generate_from','invoice_outlet','invoice_attentionto_phone',
                             'invoice_fax','invoice_project_id','invoice_subcon','invoice_shipping_id',
                             'invoice_paymentterm_id','invoice_delivery_id','invoice_price_id','invoice_validity_id',
                             'invoice_transittime_id','invoice_freightcharge_id','invoice_pointofdelivery_id','invoice_prefix_id',
                             'invoice_remarks_id','invoice_country_id','invoice_generate_from_type','invoice_attentionto_email','invoice_attentionto_name',
                             'invoice_regards','invoice_tnc','invoice_notes');
        $table_value = array($invoice_no,system_date,$r[$db_tbl.'_customer'],$r[$db_tbl.'_salesperson'],
                             $r[$db_tbl.'_billaddress'],$r[$db_tbl.'_attentionto'],$r[$db_tbl.'_shipterm'],$r[$db_tbl.'_term'],
                             $r[$db_tbl.'_shipaddress'],$r[$db_tbl.'_customerref'],$r[$db_tbl.'_remark'],$r[$db_tbl.'_customerpo'],
                             $r[$db_tbl.'_currency'],$r[$db_tbl.'_currency'],1,$this->document_type,
                             $r[$db_tbl.'_id'],$_SESSION['empl_outlet'],$r[$db_tbl.'_attentionto_phone'],
                             $r[$db_tbl.'_fax'],$r[$db_tbl.'_project_id'],$r[$db_tbl.'_subcon'],$r[$db_tbl.'_shipping_id'],
                             $r[$db_tbl.'_paymentterm_id'],$r[$db_tbl.'_delivery_id'],$r[$db_tbl.'_price_id'],$r[$db_tbl.'_validity_id'],
                             $r[$db_tbl.'_transittime_id'],$r[$db_tbl.'_freightcharge_id'],$r[$db_tbl.'_pointofdelivery_id'],$r[$db_tbl.'_prefix_id'],
                             $r[$db_tbl.'_remarks_id'],$r[$db_tbl.'_country_id'],$r[$db_tbl.'_prefix_type'],$r[$db_tbl.'_attentionto_email'],$r[$db_tbl.'_attentionto_name'],
                             $r[$db_tbl.'_regards'],$r[$db_tbl.'_tnc'],$r[$db_tbl.'_notes']);
        $remark = "Insert $this->document_code.<br> Document No : $invoice_no";
        if(!$this->save->SaveData($table_field,$table_value,'db_invoice','invoice_id',$remark)){
           return false;
        }else{
           $this->invoice_id = $this->save->lastInsert_id;
           $this->invoice_sql = $this->save->sqlStatement;
           return true;
        }
    }
    public function generateInvoiceLine($r,$invoice_id){
        if($this->document_type == 'SI' || $this->document_type == 'PCN'){
            $db_tbl = 'ordl';
            $line_parent_type = 'Order';
        }else { //if($this->document_type == 'SCN')
            $db_tbl = 'invl';
            $line_parent_type = 'Invoice';
        }
        $table_field = array('invl_invoice_id','invl_pro_id','invl_pro_desc','invl_qty','invl_uom',
                             'invl_uprice','invl_disc','invl_istax','invl_taxamt','invl_total',
                             'invl_pro_no','invl_discamt','invl_seqno','invl_parent',
                             'invl_fuprice','invl_ftotal','invl_fdiscamt','invl_ftaxamt',
                             'invl_parent_type','invl_pro_remark','invl_item_type','invl_product_location');
        $table_value = array($invoice_id,$r[$db_tbl.'_pro_id'],$r[$db_tbl.'_pro_desc'],$r[$db_tbl.'_qty'],$r[$db_tbl.'_uom'],
                             $r[$db_tbl.'_uprice'],$r[$db_tbl.'_disc'],$r[$db_tbl.'_istax'],$r[$db_tbl.'_taxamt'],$r[$db_tbl.'_total'],
                             $r[$db_tbl.'_pro_no'],$r[$db_tbl.'_discamt'],$r[$db_tbl.'_seqno'],$r[$db_tbl.'_id'],
                             $r[$db_tbl.'_fuprice'],$r[$db_tbl.'_ftotal'],$r[$db_tbl.'_fdiscamt'],$r[$db_tbl.'_ftaxamt'],
                             $line_parent_type,$r[$db_tbl.'_pro_remark'],$r[$db_tbl.'_item_type'],$r[$db_tbl.'_product_location']);
        $this->fetchInvoiceDetail(" AND invoice_id = '$invoice_id'","","",1);
        $remark = "Insert $this->document_code Line.<br> Document No : $this->invoice_no";
        if(!$this->save->SaveData($table_field,$table_value,'db_invl','invl_id',$remark)){
           return false;
        }else{
           $this->invl_id = $this->save->lastInsert_id;
           $this->invl_sql = $this->save->sqlStatement;
           if($this->document_type == 'PCN'){
               if(!$this->generateStockTransaction($this->invl_id,'out')){
                   return false;
               }else{
                   return true;
               }
           }else if($this->document_type == 'SCN'){
               if(!$this->generateStockTransaction($this->invl_id,'in')){
                   return false;
               }else{
                   return true;
               }
           }else{
               return true;
           }
        }
    }
    public function generateStockTransaction($invl_id,$action){
        include_once 'Product.php';
        include_once 'Package.php';
        $p = new Product();
        $g = new Package();
        $product_qty = 0;
        $this->fetchInvoiceLine2Detail(" AND il.invl_id = '$invl_id'","","",1);
        if($this->invl_item_type == 'product'){
            $p->fetchProductDetail(" AND product_id = '$this->invl_pro_id'","","",1);
            $product_qty = $this->invl_qty;
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
            $st_table_value = array($this->invl_id,$this->invl_invoice_id,$this->invl_qty,$stock_desc,
                                $this->invl_pro_id,$this->invl_uom,$this->product_cost_price,$this->invoice_customer,
                                system_date);

            $remark = "Insert $this->invl_pro_id transaction.<br> Document No : $this->invoice_no";
            $remarkProduct = "Update $p->product_id stock transaction.<br> Document No : $this->invoice_no";
            if(!$this->save->SaveData($st_table_field,$st_table_value,'db_stock_transaction','transaction_id',$remark)){
               return false;
            }else{
                if(!$this->save->UpdateData($pro_table_field,$pro_table_value,'db_product','product_id',$remarkProduct,$this->invl_pro_id)){
                    return false;
                }
                else{
                    return true;
                }
            }
        }else if($this->invl_item_type == 'package'){
            $query = $g->fetchPackageDetail(" AND package_id = '$this->invl_pro_id'","","",0);
            while($row = mysql_fetch_array($query)){
                $p->fetchProductDetail(" AND product_id = '".$row['package_product_id']."'","","",1);
                $product_qty = $this->invl_qty * $row['package_product_qty'];
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
                $st_table_value = array($this->invl_id,$this->invl_invoice_id,$product_qty,$stock_desc,
                                    $row['package_product_id'],$this->invl_uom,$row['product_cost_price'],$this->invoice_customer,
                                    system_date);

                $remark = "Insert $this->invl_pro_id transaction.<br> Document No : $this->invoice_no";
                $remarkProduct = "Update $p->product_id stock transaction.<br> Document No : $this->invoice_no";
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
    public function generateMultiLineItems(){
        include_once 'class/Order.php';
        $order = new Order();
        $query = $order->fetchOrderDetail(" AND order_id = '$this->order_id'","","",0);
        $order->order_id = $this->order_id;
        if($query){
            $this->invoice_generate_from = $this->order_id;
            $this->document_type = $this->generate_document_type;
            if($this->generate_document_type == 'SI'){
                $this->document_code = "Sales Invoice";
                $this->invl_parent_type = "DO";
            }else if($this->generate_document_type == 'PI'){
                $this->document_code = "Purchase Invoice";
                $this->invl_parent_type = "DO";
            }
            $r = mysql_fetch_array($query);
            if($this->generateInvoice($r)){
                $this->newinvoice_id = $this->invoice_id;

                for($i=0;$i<sizeof($this->generateqty);$i++){
                    $invl_ordl_id = escape($this->generateordlid[$i]);
                    $generate_quantity = escape($this->generateqty[$i]);

                    if($generate_quantity <=0){
                        $generate_quantity = 0;
                    }
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
                        $this->generateInvoiceLine($row,$this->newinvoice_id);
                    }
                }

                $this->invoice_id = $this->newinvoice_id;
                $this->invoice_disctotal = $this->getTotalDiscAmt();
                $this->invoice_subtotal = $this->getSubTotalAmt();
                $this->invoice_taxtotal = $this->getTotalGstAmt();
                $this->updateInvoiceTotal();
                return true;
            }
        }else{
            return false;
        }
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
        $sql = "SELECT * FROM db_country WHERE country_id > 0  $wherestring $orderstring $wherelimit";
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
    public function fetchOrderNoDetail($docType,$orderNo){

        if($docType == 'QT'){
            $selectSql = " qt.order_id as QT_ID, qt.order_no as QT_No, si.invoice_id as SI_ID, si.invoice_no as SI_No, do.order_id as DO_ID, do.order_no as DO_No, pu.order_id as PU_ID, pu.order_no as PU_No " ;
            $fromSql = " db_order qt LEFT JOIN db_invoice si ON si.invoice_generate_from = qt.order_id AND si.invoice_generate_from_type = qt.order_prefix_type
                        LEFT JOIN db_order do ON do.order_generate_from = si.invoice_id AND do.order_generate_from_type = si.invoice_prefix_type
                        LEFT JOIN db_order pu ON pu.order_generate_from = do.order_id AND pu.order_generate_from_type = do.order_prefix_type ";
            $whereSql = " WHERE qt.order_id = '".$orderNo."' AND (qt.order_status = 1 OR qt.order_status IS NULL) AND (si.invoice_status = 1 OR si.invoice_status IS NULL) AND (do.order_status = 1 OR do.order_status IS NULL) AND (pu.order_status = 1 OR pu.order_status IS NULL)";
        }else if($docType == 'SI'){
            $selectSql = " si.invoice_id as SI_ID, si.invoice_no as SI_No, do.order_id as DO_ID, do.order_no as DO_No, pu.order_id as PU_ID, pu.order_no as PU_No " ;
            $fromSql = " db_invoice si LEFT JOIN db_order do ON do.order_generate_from = si.invoice_id AND do.order_generate_from_type = si.invoice_prefix_type
                        LEFT JOIN db_order pu ON pu.order_generate_from = do.order_id AND pu.order_generate_from_type = do.order_prefix_type ";
            $whereSql = " WHERE si.invoice_id = '".$orderNo."' AND (si.invoice_status = 1 OR si.invoice_status IS NULL) AND (do.order_status = 1 OR do.order_status IS NULL) AND (pu.order_status = 1 OR pu.order_status IS NULL)";
        }else if($docType == 'DO'){
            $selectSql = " do.order_id as DO_ID, do.order_no as DO_No, pu.order_id as PU_ID, pu.order_no as PU_No " ;
            $fromSql = " db_order do LEFT JOIN db_order pu ON pu.order_generate_from = do.order_id AND pu.order_generate_from_type = do.order_prefix_type ";
            $whereSql = " WHERE do.order_id = '".$orderNo."' AND (do.order_status = 1 OR do.order_status IS NULL) AND (pu.order_status = 1 OR pu.order_status IS NULL)";
        }else if($docType == 'PU'){
            $selectSql = " pu.order_id as PU_ID, pu.order_no as PU_No " ;
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
                    $generated .= "<a href = 'sales_invoice.php?action=edit&invoice_id=".$row2['SI_ID']."'>".$row2['SI_No']."</a>,";
                }
            }
            if($docType != 'DO'){
                if(isset($row2['DO_ID']) && $row2['DO_ID'] > 0){
                    $generated .= "<a href = 'delivery_order.php?action=edit&order_id=".$row2['DO_ID']."'>".$row2['DO_No']."</a>,";
                }
            }
            if($docType != 'PU'){
               if(isset($row2['PU_ID']) && $row2['PU_ID'] > 0){
                    $generated .= "<a href = 'pickup.php?action=edit&order_id=".$row2['PU_ID']."'>".$row2['PU_No']."</a>,";
                }
            }
        }
        return rtrim($generated,',');
    }
}
?>
