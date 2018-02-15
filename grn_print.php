<?php
    include "connect.php";
    include "config.php";
    include_once 'include_function.php';
    include_once "class/Order.php";
    require('class/tcpdf/tcpdf.php');
    $o = new Order();
    $action = escape($_REQUEST['action']);
    $report_id = escape($_REQUEST['report_id']);

    $com_info = getCompanyInfo();
    $report_name = 'Good Received Notes';
    
    $sql = "SELECT o.*,pr.partner_name as customer_name,pr.partner_name_cn,e.empl_name as salesperson,
                    de.delivery_desc as delivery_desc, 
                    co.country_desc as country_desc,
                    fr.freightcharge_desc as freightcharge_desc,
                    pd.pointofdelivery_desc as pointofdelivery_desc,
                    pf.prefix_desc as prefix_desc,
                    pc.price_desc as price_desc,
                    rm.remarks_desc as remarks_desc,
                    tt.transittime_desc as transittime_desc,
                    va.validity_desc as validity_desc,
                    pt.paymentterm_desc as paymentterm_desc
            FROM db_order o
            INNER JOIN db_partner pr ON pr.partner_id = o.order_customer
            LEFT JOIN db_empl e ON e.empl_id = o.order_salesperson
            LEFT JOIN db_paymentterm pt ON pt.paymentterm_id = o.order_paymentterm_id
            LEFT JOIN db_delivery de ON de.delivery_id = o.order_delivery_id
            LEFT JOIN db_price pc ON pc.price_id = o.order_price_id
            LEFT JOIN db_validity va ON va.validity_id = o.order_validity_id
            LEFT JOIN db_transittime tt ON tt.transittime_id = o.order_transittime_id
            LEFT JOIN db_freightcharge fr ON fr.freightcharge_id = o.order_freightcharge_id
            LEFT JOIN db_pointofdelivery pd ON pd.pointofdelivery_id = o.order_pointofdelivery_id
            LEFT JOIN db_prefix pf ON pf.prefix_id = o.order_prefix_id
            LEFT JOIN db_remarks rm ON rm.remarks_id = o.order_remarks_id
            LEFT JOIN db_country co ON co.country_id = o.order_country_id
            WHERE o.order_id > 0 AND order_id = '$report_id'";
    $data_field_type = "order";
    $data_field_line_type = "ordl";
    $query = mysql_query($sql);		
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
            // Logo
            $toleft=137;
            //$this->Image('dist/img/iso logo.jpg',$toleft+10,0,30);
            $this->Image('dist/img/logo.jpg',12,15,45);
            $Y=$this->GetY();

            // Company Name
            $this->SetFont($font_name,'B',18);
            $this->sety($Y+5);
            $this->setX(112);
            $this->Cell(2,4,htmlspecialchars_decode($com_info['cprofile_name']),0,1,'C');	
            // Company Address
            $this->SetFont($font_name,'',10);
            $this->setX(60);
            $this->multicell(85,5, $com_info['cprofile_address'],0,'TL');
            // Company Contact (Phone)
            $this->SetFont($font_name,'B',10);
            $y = $this->gety();
            $this->sety($y);
            $this->setX(60);
            $this->Cell(2,4,"Tel : " . $com_info['cprofile_tel'],0,1,'L');	
            // Company Contact (Fax)
            $this->sety($y);
            $this->setx(95);
            $this->Cell(2,4,"Fax : " . $com_info['cprofile_fax'],0,1,'L');
            // Company Contact (Email)
            $this->setX(60);
            $this->Cell(2,4,"Email : " . $com_info['cprofile_email'],0,1,'L');
            // Company Contact (Reg No)
            $this->setX(60);
            $this->Cell(2,4,"Company Registration No : " . $com_info['cprofile_gst_no'],0,1,'L');	
            $this->sety($this->gety());

            $this->SetFont($font_name,'',10);

            $this->Ln(2);
            $this->sety($this->gety());
            $this->Ln(12);
            $this->sety($this->gety());
            // Move to the right
            $y = $this->gety();
            
            //$index=10;
            $this->SetFont($font_name,'B',12);	
            $this->SetTextColor(0,0,0); 
            $this->sety($Y+40);
            $this->Cell(2,8,$report_name.' : '.$data["{$data_field_type}_no"],0,1,'L');

            //$pdf->Line(10,$this->gety(),203,$this->gety());

            // Line break
            //$this->Ln(10);
            global $yg;
            $yg=$this->gety();
        }

        // Page footer
        function Footer()
        {
            global $com_info;
            // Position at 1.5cm from bottom
            $this->SetY(-15);
            // times italic 8
            $this->SetFont($font_name,'I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(),0,0,'C');
        }
    }
		
    // Instanciation of inherited class
    // Add a Unicode font (uses UTF-8)

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 40, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->AddPage();
    $pdf->SetFont($font_name,'',12);

    $A4Y=297;
    $w=97;
    $toleft=137;
    
    $pdf->setY(40);
    //customer address
    //$pdf->setY($pdf->gety());
    //$pdf->SetFont($font_name,'B',9);
    //$pdf->multicell(75,5,$data['customer_name'],0,'TL');
    //$pdf->multicell(50,5,htmlspecialchars_decode($data["{$data_field_type}_billaddress"]),0,'TL');

    // Customer: To, Attn, Email                               

    $pdf->SetFont($font_name,'',10);
    $pdf->ln(4);
    $pdf->setY($pdf->gety()+15);
    $y=$pdf->gety();
    $pdf->setx($pdf->getx());
    $pdf->SetFont($font_name,'B',10);
    $pdf->Cell(2,4,date('jS F Y'),0,1,'L');

    $pdf->SetFont($font_name,'',10);
    $pdf->ln(4);
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->Cell(2,4,'To',0,1,'L');
    $pdf->sety($y);	
    $pdf->setx(25);
    $pdf->SetFont($font_name,'B',10);
    $pdf->Cell(2,4,':  '.htmlspecialchars_decode($data['customer_name']),0,1,'L');	

    $pdf->SetFont($font_name,'',10);
    $pdf->ln(4);
    $pdf->setY($pdf->gety()-4);
    $y=$pdf->gety();
    $pdf->Cell(2,4,'Attn',0,1,'L');
    $pdf->sety($y);	
    $pdf->setx(25);
    $pdf->SetFont($font_name,'B',10);
    $pdf->Cell(2,4,':  '.$data['order_attentionto_name'],0,1,'L');

    $pdf->SetFont($font_name,'',10);
    $pdf->ln(4);
    $pdf->setY($pdf->gety()-4);
    $y=$pdf->gety();
    $pdf->Cell(2,4,'Email',0,1,'L');
    $pdf->sety($y);	
    $pdf->setx(25);
    $pdf->SetFont($font_name,'B',10);
    $pdf->Cell(2,4,':  '.$data['order_attentionto_email'],0,1,'L');

    $pdf->SetFont($font_name,'',10);
    $pdf->ln(4);
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->Cell(2,4,'Dear '.$data['order_attentionto_name'].',',0,1,'L');

    $pdf->SetFont($font_name,'',10);
    $pdf->ln(4);
    $pdf->setY($pdf->gety()+3);
    $y=$pdf->gety();
    $pdf->SetFont($font_name,'BU',10);
    $pdf->Multicell(0,4,'RE: ',0,'L');
    
    $pdf->SetFont($font_name,'',10);
    $pdf->ln(2);
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->Cell(2,4,'Thank you for your inquiry dated '.date('jS F Y',strtotime($data['order_date'])).', we are pleased to quote as follows :',0,1,'L');
    $pdf->setY($pdf->gety()+2);

    //$pdf->setY($pdf->GetY());
                                
    //item listing area

    $y = $pdf->GetY();
    $pdf->Line(10,$y,203,$y);
    $pdf->setY($y);
    $y = $pdf->GetY();
    $pdf->setY($y+1);
    $pdf->SetFont($font_name,'B',10);
    $pdf->cell(15,4,"Item No");
    $pdf->cell(30,4,"Part No");
    $pdf->cell(70,4,"Description",'','');
    $pdf->cell(25,4,"Qty",'','','L');
    $pdf->cell(20,4,"U/Price",'','','R');
    $pdf->cell(30,4,"Total Amt (S$)",'','','R');
    $pdf->setY($pdf->GetY());

    $pdf->setY($pdf->GetY()+1);
    // Line break
    $pdf->Ln();
    $ly=$pdf->GetY();
    $pdf->setY($ly);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(0);
    $pdf->Line(10,$ly,203,$ly);


    $pdf->SetFont($font_name,'',10);
    $pdf->ln();
    $x=$pdf->GetX();
    $y=$pdf->GetY()-2;
                        
    $sql = "SELECT ol.*,
        (ol.ordl_markup-ol.ordl_discamt) as ordl_markup,ol.ordl_pro_no,ol.ordl_pro_desc,ol.ordl_qty,ROUND(ol.ordl_markup,2) as ordl_uprice ,ROUND((ol.ordl_markup*ol.ordl_qty)-ol.ordl_discamt,2) as linetotal,ol.ordl_disc,ol.ordl_discamt as ordl_fdiscamt,
        uom.uom_code
        FROM db_ordl ol
        LEFT JOIN db_order o ON ol.ordl_order_id = o.order_id
        LEFT JOIN db_uom uom ON uom.uom_id = ol.ordl_uom
        WHERE o.order_id > 0 AND order_id = '$report_id'";                  

    $query = mysql_query($sql);
    $offsety1 = 0;
    $subtotal = 0;
    $disctotal = 0;
    $pdf->SetFont($font_name,'',10);

    $i = 1;
    while($row = mysql_fetch_array($query)){

        if( ($A4Y-($y+10+$pdf->getStringHeight(80, $row["{$data_field_line_type}_pro_desc"]))) < 20){
            $pdf->AddPage();
            $pdf->sety($yg);
            $pdf->Line(10,$yg,203,$yg);
            $pdf->setY($yg);
            $yg = $pdf->GetY();
            $pdf->SetFont($font_name,'B',10);
            $pdf->cell(15,4,"Item No");
            $pdf->cell(25,4,"Part No");
            $pdf->cell(70,4,"Description",'','');
            if($_REQUEST['format'] == 1){
                $pdf->cell(25,4,"Qty",'','','L');	
            }else{
                $pdf->cell(25,4,"");	
            }
            $pdf->cell(20,4,"U/Price",'','','R');
            if($_REQUEST['format'] == 1){
                $pdf->cell(30,4,"Total Amt (S$)",'','','R');
            }else{
                $pdf->cell(30,4,"",'','','R');
            }
            // Line break
            $pdf->Ln();
            $ly=$pdf->GetY();
            $pdf->SetDrawColor(0,0,0);
            $pdf->SetLineWidth(0);
            $pdf->Line(10,$ly,203,$ly);

            $pdf->SetFont($font_name,'',10);
            $pdf->ln();
            $x=$pdf->GetX();
            $y=$pdf->GetY();

            $offsety1=$yg; 
        }
                
        $pdf->SetY($y);
        $pdf->multicell($wc=15,5,$i,0,'TL');

        $prod = ($row['ordl_item_type']=='product')? "product" : "package";
        $sql = "SELECT ".$prod."_part_no FROM db_".$prod." WHERE ".$prod."_id = '".$row['ordl_pro_id']."' LIMIT 1 "; 
        $q = mysql_query($sql);
        while($item_code = mysql_fetch_array($q)){
            $pdf->SetY($y);
            $pdf->SetX($x=$x+$wc);
            $pdf->multicell($wc=25,5,htmlspecialchars_decode($item_code[$prod.'_part_no']),0,'TL');
        }
                  
        $pdf->SetY($y);
        $pdf->SetX($x=$x+$wc);

        $pdf->multicell($wc=70,5,htmlspecialchars_decode(htmlspecialchars_decode($row["{$data_field_line_type}_pro_desc"])),0,'TL');
        $offsety1=$pdf->gety();

        $pdf->SetY($y);
        $pdf->SetX($x=$x+$wc);
        $pdf->multicell($wc=25,5,$row["{$data_field_line_type}_qty"] . " " . $row["uom_code"],0,'TL');
        $pdf->SetY($y);
        $pdf->SetX($x=$x+$wc);
        $pdf->multicell($wc=25,5, num_format($row["ordl_fuprice"],$round_type),0,'R');
        $pdf->SetY($y);
        $pdf->SetX($x=$x+$wc);
        $pdf->multicell($wc=25,5, num_format(($row["ordl_fuprice"]*$row["{$data_field_line_type}_qty"])-$row["ordl_fdiscamt"],$round_type),0,'R');
        
        $yoffset=$pdf->gety();

        $x=$pdf->GetX();
        $y=$offsety1+5;

        //condition to check if the last line item is printable else will create a new line
        if( ($A4Y-($offsety1+10)) < 48){
            $pdf->AddPage();
            $pdf->sety($yg);
            $pdf->Line(10,$yg,203,$yg);
            $pdf->setY($yg);
            $yg = $pdf->GetY();
            $pdf->SetFont($font_name,'B',10);
            $pdf->cell(15,4,"Item No");
            $pdf->cell(25,4,"Part No");
            $pdf->cell(70,4,"Description",'','');
            $pdf->cell(25,4,"Qty");
            $pdf->cell(20,4,"U/Price",'','','R');
            $pdf->cell(30,4,"Total Amt (S$)",'','','R');

            // Line break
            $pdf->Ln();
            $ly=$pdf->GetY();
            $pdf->SetDrawColor(0,0,0);
            $pdf->SetLineWidth(0);
            $pdf->Line(10,$ly,203,$ly);

            $pdf->SetFont($font_name,'',10);
            $pdf->ln();
            $x=$pdf->GetX();
            $y=$pdf->GetY();

            $offsety1=$yg;
        }
        
        $subtotal = $subtotal + ($row["ordl_fuprice"] * $row["{$data_field_line_type}_qty"]);
        $disctotal = $disctotal + $row["ordl_fdiscamt"];
        $i++;
    }
    //setting the line from bottom up
    //$pdf->SetY(-130);	

    $y=$pdf->GetY();
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(0.25);
    $pdf->Line(10,$y+6,203,$y+6);	

    $pdf->ln();
    $pdf->SetY($pdf->GetY()+5);
    $pdf->setx(($w*2)-45);
    $pdf->SetFont($font_name,'B',12);
    $pdf->Cell(23,6,'Sub Total: ',0,0,'L',false);
    $pdf->setx(($w*2)-15);
    $pdf->SetFont($font_name,'',10);
    $pdf->Cell(23,6,'$' . num_format((($subtotal-$disctotal)-$data['invoice_discheadertotal']),$round_type),0,0,'R',false); 
    // $pdf->Cell(23,6,'$' . num_format((($subtotal-$disctotal)-$data['invoice_discheadertotal']) + (($subtotal-$disctotal)-$data['order_discheadertotal'])*(system_gst_percent/100),$round_type),0,0,'R',false); 
    
    $pdf->ln();
    $pdf->SetY($pdf->GetY());
    $pdf->setx(($w*2)-45);
    $pdf->SetFont($font_name,'B',12);
    $pdf->Cell(23,6,'GST 7%: ',0,0,'L',false);
    $pdf->setx(($w*2)-15);
    $pdf->SetFont($font_name,'',10);
    $pdf->Cell(23,6,'$' . num_format((($subtotal-$disctotal)-$data['invoice_discheadertotal'])*(system_gst_percent/100),$round_type),0,0,'R',false); 
    
    $pdf->ln();
    $pdf->SetY($pdf->GetY());
    $pdf->setx(($w*2)-45);
    $pdf->SetFont($font_name,'B',12);
    $pdf->Cell(23,6,'Total (NETT): ',0,0,'L',false);
    $pdf->setx(($w*2)-15);
    $pdf->Cell(23,6,'$' . num_format((($subtotal-$disctotal)-$data['invoice_discheadertotal'])+(($subtotal-$disctotal)-$data['invoice_discheadertotal'])*(system_gst_percent/100),$round_type),0,0,'R',false); 

    $pdf->sety($pdf->gety()+5);

    $y=$pdf->GetY();
    $pdf->SetY($y+10);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(0.25);
    $pdf->Line(10,$y+6,203,$y+6);
    
    if( ($A4Y-($y+85)) < 30){
        $pdf->AddPage();
        $offsety1=$yg;
        $pdf->sety($yg);	
    }

    $term = "We trust that you will find our quotation acceptable and look forward to receive your confirmation soon.";

    $pdf->SetFont($font_name,'B',10);
    $pdf->ln(2);
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->Cell(2,4,'DELIVERY',0,1,'L');
    $pdf->sety($y);	
    $pdf->setx(55);
    $pdf->SetFont($font_name,'',10);
    $pdf->Cell(2,4,':  ',0,1,'L');
    $pdf->sety($y);	
    $pdf->setx(60);
    $pdf->SetFont($font_name,'',10);
    $pdf->multicell(0,4,$data['delivery_desc'],0,'L');

    $pdf->SetFont($font_name,'B',10);
    $pdf->ln(2);
    $pdf->setY($pdf->gety()-1);
    $y=$pdf->gety();
    $pdf->Cell(2,4,'PRICE',0,1,'L');
    $pdf->sety($y);	
    $pdf->setx(55);
    $pdf->SetFont($font_name,'',10);
    $pdf->Cell(2,4,':  ',0,1,'L');
    $pdf->sety($y);	
    $pdf->setx(60);
    $pdf->SetFont($font_name,'',10);
    $pdf->multicell(0,4,$data['price_desc'],0,'L');

    $pdf->SetFont($font_name,'B',10);
    $pdf->ln(2);
    $pdf->setY($pdf->gety()-1);
    $y=$pdf->gety();
    $pdf->Cell(2,4,'PAYMENT',0,1,'L');
    $pdf->sety($y);	
    $pdf->setx(55);
    $pdf->SetFont($font_name,'',10);
    $pdf->Cell(2,4,':  ',0,1,'L');
    $pdf->sety($y);	
    $pdf->setx(60);
    $pdf->SetFont($font_name,'',10);
    $pdf->multicell(0,4,$data['paymentterm_desc'],0,'L');

    $pdf->SetFont($font_name,'B',10);
    $pdf->ln(2);
    $pdf->setY($pdf->gety()-1);
    $y=$pdf->gety();
    $pdf->Cell(2,4,'VALIDITY',0,1,'L');
    $pdf->sety($y);	
    $pdf->setx(55);
    $pdf->SetFont($font_name,'',10);
    $pdf->Cell(2,4,':  ',0,1,'L');
    $pdf->sety($y);	
    $pdf->setx(60);
    $pdf->SetFont($font_name,'',10);
    $pdf->multicell(0,4,$data['validity_desc'],0,'L');

    $pdf->SetFont($font_name,'B',10);
    $pdf->ln(2);
    $pdf->setY($pdf->gety()-1);
    $y=$pdf->gety();
    $pdf->Cell(2,4,'COUNTRY OF ORIGIN',0,1,'L');
    $pdf->sety($y);	
    $pdf->setx(55);
    $pdf->SetFont($font_name,'',10);
    $pdf->Cell(2,4,':  ',0,1,'L');
    $pdf->sety($y);	
    $pdf->setx(60);
    $pdf->SetFont($font_name,'',10);
    $pdf->multicell(0,4,$data['country_desc'],0,'L');

    $yoffset=$pdf->gety();

    $x=$pdf->GetX();
    $y=$offsety1+5; 

    $pdf->ln(5);
    $y = $pdf->gety();
    $pdf->SetY($y+5);
    $pdf->multicell(0,5,$term,0,'TL');

    $pdf->ln(5);
    $y = $pdf->gety();
    $pdf->SetY($y+5);
    $pdf->multicell(100,5,'Best Regards',0,'TL');
    $y = $pdf->gety();
    $pdf->SetY($y+5);
    $pdf->multicell(150,5,$data['salesperson'],0,'TL');
    $pdf->SetY($y);
    $pdf->SetX(131);
    
    $y = $pdf->gety();
    $pdf->SetFont($font_name,'I',10);
    $pdf->SetY($y+10);
    $pdf->multicell(50,5,$com_info['cprofile_address'],0,'TL');

    $pdf->Output("record/Test.pdf",'I');
?>     