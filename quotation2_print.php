<?php
    include "connect.php";
    include "config.php";
    include_once 'include_function.php';
    include_once "class/Order.php";
    include_once "class/Invoice.php";
    require('class/tcpdf/tcpdf.php');
    $o = new Order();
    $i = new Invoice();
    $action = escape($_REQUEST['action']);
    $report_id = escape($_REQUEST['report_id']);

    $com_info = getCompanyInfo();
    
    $report_name = 'Quotation';
    
    $sqlHeadInfo = "SELECT o.*,pr.partner_name as customer_name,pr.partner_name_cn,c.contact_name,e.empl_mobile,e.empl_name as salesperson
            FROM db_order o
            LEFT JOIN db_partner pr ON pr.partner_id = o.order_customer
            LEFT JOIN db_contact c ON c.contact_id = o.order_attentionto
            LEFT JOIN db_empl e ON e.empl_id = o.order_salesperson
            WHERE o.order_id > 0 AND order_id = '$report_id'";
    $data_field_type = "order";
    $data_field_line_type = "ordl";
    $query = mysql_query($sqlHeadInfo);		
    if($row = mysql_fetch_array($query)){   
        if($row['order_revtimes'] > 0){
            $row['order_no'] = $row['order_no'] . " (Rev {$row['order_revtimes']})";
        }
        $data = $row; 
    }
        
	class PDF extends TCPDF
        {
            // Page header
            public function Header()
            {
                global $data,$com_info,$report_name,$report_draft,$data_field_type,$font_name,$pdf,$document_no,$action,$order_no;
                //$para1 = "Thank you for your interest in our products and service. We are please to furnish the following for your perusal. Please do not hesitate to contact me should you require any clarification.";
                // Logo
                //$this->Image('dist/img/logo_firsttech.png', 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                // Set font
                $this->SetFont('helvetica', '', 8);
                // Title
                $header = '<table cellspacing="0" cellpadding="1">
                                <tr>
                                    <td rowspan="5" width="150px"><span style="text-align:center;"><img src="/crm_kcparts/dist/img/logo.jpg" alt="KC Parts & Services" width="120px"></span></td>
                                    <td colspan="2"><span style="font-size:150%;font-family:Arial Black;"><b>'.$com_info['cprofile_name'].'</b></span></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><span style="font-size:100%;font-family:Arial Black;"><b>'.$com_info['cprofile_address'].'</b></span></td>
                                </tr>
                                <tr>
                                    <td width="100px">Tel: '.$com_info['cprofile_tel'].'</td>
                                    <td>Fax: '.$com_info['cprofile_fax'].'</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Email: '.$com_info['cprofile_email'].'</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Company Registration No:'.$com_info[' cprofile_gst_no'].'</td>
                                </tr>
                                <tr>
                                    <td colspan="3"> </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><span style="font-size:150%;font-family:Arial Black;">QUOTATION NO: '.$data['order_no'].'</span></td>
                                    <td> </td>
                                </tr>
                        </table>';
                $this->writeHTML($header, true, false, false, false, ''); 
            }
				
            // Page footer
            function Footer()
            {
                global $com_info;
                // Position at 15 mm from bottom
                $this->SetY(-15);
                // Set font
                $this->SetFont('helvetica', 'I', 8);
                // Page number
                //'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages();
                //$footer = $com_info['cprofile_name'].' '.$com_info['cprofile_address'].' Tel: '.$com_info['cprofile_tel'].' Fax: '.$com_info['cprofile_fax'];
                //$footer .= '<br/> Email: '.$com_info['cprofile_email'].' Website: www.firsttechnology.com.sg';
                //$this->Cell(0, 10, $footer1, 0, false, 'L', 0, '', 0, false, 'T', 'M');
                //$this->Cell(0, 10, $footer2, 0, false, 'L', 0, '', 0, false, 'T', 'M');
                $this->Cell(0,10,'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(),0,0,'C');
                //$this->writeHTML($footer, true, false, false, false, '');
            }
        }
        // create new PDF document
        $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        //$pdf->SetCreator(PDF_CREATOR);
        //$pdf->SetAuthor('FirstCom Solutions');
        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);
        
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 30, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER + 10);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM + 5);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        // set font
        $pdf->SetFont('helvetica', 'B', 20);

        // add a page
        $pdf->AddPage();
        //$pdf->Write(0, 'First Technology Quotation', '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('helvetica', '', 8);
        
        $tbl = '
    <table width="800px" cellpadding="2" style="border-collapse:collapse;">
        <tr>
            <td colspan="2">'.date('jS F Y').'</td>
        </tr>
        <tr>
            <td colspan="2"> </td>
        </tr>
        <tr>
            <td width="30px">To</td>
            <td>: '.$data['customer_name'].'</td>
        </tr>
        <tr>
            <td>Attn</td>
            <td>: '.$data['contact_name'].'</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: '.$data['contact_Email'].'</td>
        </tr>
        <tr>
            <td colspan="2"> </td>
        </tr>
        <tr>
            <td colspan="2">Dear '.$data['contact_name'].' ,</td>
        </tr>
        <tr>
            <td colspan="2"><b><u>RE: GM 6V-71 ENGINE PARTS</u></b></td>
        </tr>
        <tr>
            <td colspan="2">Thank you for your inquiry dated '.date('jS F Y',strtotime($data['order_date'])).', we are pleased to quote as follows :</td>
        </tr>
        <tr>
            <td colspan="2"> </td>
        </tr>
    </table>
    <table cellpadding="2" style="border-collapse:collapse;">
        <thead>
            <tr>
                <th width="5%" style="text-align:center;border-top:1px solid thin;border-bottom:1px solid thin;border-left:1px solid thin;"> <b>ITEM</b> </th>
                <th width="15%" style="text-align:center;border-top:1px solid thin;border-bottom:1px solid thin;border-left:1px solid thin;"> <b>PART NO</b> </th>
                <th width="50%" style="text-align:center;border-top:1px solid thin;border-bottom:1px solid thin;border-left:1px solid thin;"> <b>DESCRIPTION</b> </th>
                <th width="5%" style="text-align:center;border-top:1px solid thin;border-bottom:1px solid thin;border-left:1px solid thin;"> <b>QTY</b> </th>
                <th width="12%" style="text-align:center;border-top:1px solid thin;border-bottom:1px solid thin;border-left:1px solid thin;"> <b>U/PRICE<br/> S$</b> </th>
                <th width="13%" style="text-align:center;border-top:1px solid thin;border-right:1px solid thin;border-bottom:1px solid thin;border-left:1px solid thin;"> <b>AMT<br/> S$</b> </th>
            </tr>
        </thead>
            <tr>
                <td width="5%" style="border-left:1px solid thin;"> </td>
                <td width="15%" style="border-left:1px solid thin;"> </td>
                <td width="50%" style="border-left:1px solid thin;"> </td>
                <td width="5%" style="border-left:1px solid thin;"> </td>
                <td width="12%" style="text-align:right;border-left:1px solid thin;"> </td>
                <td width="13%" style="text-align:right;border-left:1px solid thin;border-right:1px solid thin;"> </td>
            </tr>
            ';

    $sql = "SELECT ol.ordl_id, 
                ol.ordl_order_id, 
                p.product_part_no as ProductPartNo, 
                p.product_desc as ProductDesc, 
                ol.ordl_qty, 
                ol.ordl_fuprice, 
                ol.ordl_total,  
                ol.ordl_pro_remark 
            FROM `db_ordl` ol
            LEFT JOIN `db_order` o ON o.order_id = ol.ordl_order_id
            LEFT JOIN `db_product` p ON p.product_id = ol.ordl_pro_id
            WHERE o.order_id > 0 AND o.order_id = '$report_id' 
            ORDER BY ol.ordl_id";
            
//            "SELECT ol.*,
//                (ol.ordl_markup-ol.ordl_discamt) as ordl_markup,
//                ol.ordl_pro_no,
//                ol.ordl_pro_desc,
//                ol.ordl_qty,
//                ROUND(ol.ordl_markup,2) as ordl_uprice ,
//                ROUND((ol.ordl_markup*ol.ordl_qty)-ol.ordl_discamt,2) as linetotal,
//                ol.ordl_disc,
//                ol.ordl_discamt as ordl_fdiscamt,
//                uom.uom_code
//            FROM db_ordl ol
//            LEFT JOIN db_order o ON ol.ordl_order_id = o.order_id
//            LEFT JOIN db_uom uom ON uom.uom_id = ol.ordl_uom
//            WHERE o.order_id > 0 AND order_id = '$report_id'"; 
    $query = mysql_query($sql);
    $i = 1;
    $sum_ctotal = 0;
    $sum_ftotal = 0;
    $sum_gp = 0;
    $current_cat = '';
    while($row = mysql_fetch_array($query)){
$tbl .= '<tr nobr="true">
        <td width="5%" style="border-left:1px solid thin;"> '.$i.' </td>
        <td width="15%" style="border-left:1px solid thin;"> '.$row['ProductPartNo'].' </td>
        <td width="50%" style="border-left:1px solid thin;"> '.$row['ProductDesc'].' </td>
        <td width="5%" style="border-left:1px solid thin;"> '.$row['ordl_qty'].'</td>
        <td width="12%" style="text-align:right;border-left:1px solid thin;"> $ '.$row['ordl_fuprice'].'</td>
        <td width="13%" style="text-align:right;border-left:1px solid thin;border-right:1px solid thin;"> $ '.$row['ordl_total'].' </td>
    </tr>

    <tr>
        <td width="5%" style="border-left:1px solid thin;"> </td>
        <td width="15%" style="border-left:1px solid thin;"> </td>
        <td width="50%" style="border-left:1px solid thin;"> </td>
        <td width="5%" style="border-left:1px solid thin;"> </td>
        <td width="12%" style="border-left:1px solid thin;"> </td>
        <td width="13%" style="border-left:1px solid thin;border-right:1px solid thin;"> </td>
    </tr>';
        $sum_ftotal += $row['ordl_total'];
        $i++;
    }
    /**$qtype = $data['order_type'];
    switch($qtype){
        case 'nm':
            while($row = mysql_fetch_array($query)){
                if ($row["category_id"] != $current_cat) {
                $current_cat = $row["category_id"];
    $tbl .= '<tr nobr="true">
                <td width="10%" style="border-left:1px solid thin;"> </td>
                <td width="55%" style="background-color:#99ccff;border-left:1px solid thin;"> '.$row['Category'].'</td>
                <td width="5%" style="border-left:1px solid thin;"> </td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;"> </td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;border-right:1px solid thin;"> </td>
            </tr>';
                }  
    $tbl .= '<tr nobr="true">
                <td width="10%" style="border-left:1px solid thin;"> '.$i.' </td>
                <td width="55%" style="border-left:1px solid thin;"> '.$row['ProductName'].' </td>
                <td width="5%" style="border-left:1px solid thin;"> '.$row['ordl_qty'].'</td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;"> $ '.$row['ordl_fuprice'].'</td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;border-right:1px solid thin;"> $ '.$row['ordl_total'].' </td>
            </tr>
            <tr nobr="true">
                <td width="10%" style="border-left:1px solid thin;"> </td>
                <td width="55%" style="border-left:1px solid thin;"> '.$row['ProductDesc'].' </td>
                <td width="5%" style="border-left:1px solid thin;"> </td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;"> </td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;border-right:1px solid thin;"> </td>
            </tr>
            <tr>
                <td width="10%" style="border-left:1px solid thin;"> </td>
                <td width="55%" style="border-left:1px solid thin;"> </td>
                <td width="5%" style="border-left:1px solid thin;"> </td>
                <td width="15%" style="border-left:1px solid thin;"> </td>
                <td width="15%" style="border-left:1px solid thin;border-right:1px solid thin;"> </td>
            </tr>';
                $sum_ftotal += $row['ordl_total'];
                $i++;
            }
            break;
        case 'pj':
            if($data['order_generate_from']==0 && $data['order_type']=='pj'){
                while($row = mysql_fetch_array($query)){
    $tbl .= '<tr nobr="true">
                <td width="10%" style="border-left:1px solid thin;"> '.$i.' </td>
                <td width="55%" style="border-left:1px solid thin;"> '.$row['Category'].' </td>
                <td width="5%" style="border-left:1px solid thin;"> '.$row['ordl_qty'].'</td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;"> $ '.$row['ordl_fuprice'].'</td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;border-right:1px solid thin;"> $ '.$row['ordl_total'].' </td>
            </tr>
            <tr>
                <td width="10%" style="border-left:1px solid thin;"> </td>
                <td width="55%" style="border-left:1px solid thin;"> </td>
                <td width="5%" style="border-left:1px solid thin;"> </td>
                <td width="15%" style="border-left:1px solid thin;"> </td>
                <td width="15%" style="border-left:1px solid thin;border-right:1px solid thin;"> </td>
            </tr>';
                $sum_ftotal += $row['ordl_total'];
                $i++;
                }
            }else{
                while($row = mysql_fetch_array($query)){
                    if ($row["category_id"] != $current_cat) {
                    $current_cat = $row["category_id"];
    $tbl .= '<tr nobr="true">
                <td width="10%" style="background-color:#99ccff;border-left:1px solid thin;"> '.$i.'</td>
                <td width="55%" style="background-color:#99ccff;border-left:1px solid thin;"> '.$row['Category'].'</td>
                <td width="5%" style="border-left:1px solid thin;"> </td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;"> </td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;border-right:1px solid thin;"> </td>
            </tr>';
                    }
    $tbl .= '<tr nobr="true">
                <td width="10%" style="border-left:1px solid thin;"> '.$row['ProductCode'].' </td>
                <td width="55%" style="border-left:1px solid thin;"> '.$row['ProductName'].' </td>
                <td width="5%" style="border-left:1px solid thin;"> '.$row['ordl_qty'].'</td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;"> $ '.$row['ordl_fuprice'].'</td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;border-right:1px solid thin;"> $ '.$row['ordl_total'].' </td>
            </tr>
            <tr nobr="true">
                <td width="10%" style="border-left:1px solid thin;"> </td>
                <td width="55%" style="border-left:1px solid thin;"> '.$row['ProductDesc'].' </td>
                <td width="5%" style="border-left:1px solid thin;"> </td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;"> </td>
                <td width="15%" style="text-align:right;border-left:1px solid thin;border-right:1px solid thin;"> </td>
            </tr>
            <tr>
                <td width="10%" style="border-left:1px solid thin;"> </td>
                <td width="55%" style="border-left:1px solid thin;"> </td>
                <td width="5%" style="border-left:1px solid thin;"> </td>
                <td width="15%" style="border-left:1px solid thin;"> </td>
                <td width="15%" style="border-left:1px solid thin;border-right:1px solid thin;"> </td>
            </tr>';
                    $sum_ftotal += $row['ordl_total'];
                    $i++;
                }
            }
            break;
        default:
    }**/
if($data['order_remark']<>''){ 
    $tbl .= '
            <tr>
                <td width="5%" style="border-left:1px solid thin;"> </td>
                <td width="15%" style="border-left:1px solid thin;"> </td>
                <td width="50%" style="border-left:1px solid thin;"> </td>
                <td width="5%" style="border-left:1px solid thin;"> </td>
                <td width="12%" style="border-left:1px solid thin;"> </td>
                <td width="13%" style="border-left:1px solid thin;border-right:1px solid thin;"> </td>
            </tr>';
}
    $tbl .= ' 
            <tr nobr="true">
                <td colspan="6" style="text-align:center;border-top:1px solid thin;"> </td>
            </tr>
            <tr nobr="true">
                <td width="5%" style="text-align:center;"> </td>
                <td width="15%" style="text-align:center;"> </td>
                <td width="50%" style="text-align:left;font-size:150%;">TOTAL (NETT)</td>
                <td width="5%" style="text-align:center;"></td>
                <td width="12%" style="text-align:center;">  </td>
                <td width="13%" style="text-align:right;"> $ '.number_format(($sum_ftotal + ($sum_ftotal*0.07)),2).' </td>
            </tr>
            <tr nobr="true">
                <td colspan="6" style="text-align:center;border-bottom:1px solid thin;"> </td>
            </tr>
        </table>';
    
    //$tnc = "A 20% charge will be imposed for cancellation of order after confirmation.<br/>";
    //$tnc .= "Terms: 30 days. upon delivery; Validity: 14 days from date of quotation.<br/>";
    //$tnc .= "Any additional job required would be charge at the prevailing rate.<br/>";
    
    $para2 = "We trust that you will find our quotation acceptable and look forward to receive your confirmation soon.<br/>";
    
        $tbl .= '<table width="800px" cellpadding="2" style="border-collapse:collapse;">
            <tr>
                <td colspan="5"> </td>
            </tr>
            <tr>
                <td width="120px">DELIVERY</td>
                <td width="10px">: </td>
                <td colspan="3">'.$data['order_delivery_remark'].'</td>
            </tr>
            <tr>
                <td>PRICE</td>
                <td width="10px">: </td>
                <td colspan="3">'.$data['order_price_remark'].'</td>
            </tr>
            <tr>
                <td>PAYMENT</td>
                <td width="10px">: </td>
                <td colspan="3">'.$data['order_paymentterm_remark'].'</td>
            </tr>
            <tr>
                <td>VALIDITY</td>
                <td width="10px">: </td>
                <td colspan="3">'.$data['order_validity_remark'].'</td>
            </tr>
            <tr>
                <td>COUNTRY OF ORIGIN</td>
                <td width="10px">: </td>
                <td colspan="3">'.$data['order_country'].'</td>
            </tr>
            <tr>
                <td colspan="5"> </td>
            </tr>
            <tr>
                <td colspan="5">'.$para2.'</td>
            </tr>
            <tr>
                <td colspan="5"> </td>
            </tr>
            <tr>
                <td colspan="5">Best Regards</td>
            </tr>
            <tr>
                <td colspan="5"></td>
            </tr> 
            <tr>
                <td colspan="2">'.$data['salesperson'].'</td>
                <td colspan="3"> </td>
            </tr>
            <tr>
                <td colspan="2">'.$com_info['cprofile_address'].'</td>
                <td colspan="3"> </td>
            </tr>            
        </table>';
    
    
        $pdf->setY(40);
        $pdf->writeHTML($tbl, true, false, false, false, '');
        //$pdf->setY(-20);
        //$pdf->writeHTML($tbl2, true, false, false, false, '');        
        //Close and output PDF document
        $pdf->Output('example_048.pdf', 'I');

                /**$pdf->ln(5);
                $y = $pdf->gety();
                $pdf->SetY($y+10);
                $pdf->multicell(100,5,'Best Regards',0,'TL');
                $y = $pdf->gety();
                $pdf->SetY($y+5);
                $pdf->multicell(150,5,'Willie Teo',0,'TL');
                $pdf->SetY($y);
                $pdf->SetX(131);
                **/                
                $pdf->Output("record/Test.pdf",'I');

				
?>     