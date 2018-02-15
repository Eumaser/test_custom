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
    $report_name = 'Delivery Order';
    
    $sql = "SELECT o.*,pr.partner_name as customer_name,pr.partner_name_cn,pr.partner_code as customer_code,
            e.empl_name as salesperson,e.empl_email as empl_email, 
            g.group_desc,cr.currency_code as currency_code           
        FROM db_order o
            INNER JOIN db_partner pr ON pr.partner_id = o.order_customer
            LEFT JOIN db_empl e ON e.empl_id = o.order_salesperson
            LEFT JOIN db_group g ON e.empl_group = g.group_id
            LEFT JOIN db_currency cr ON cr.currency_id = o.order_currency
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
            
            // Company Name
            $this->SetFont($font_name,'B',18);
            $this->sety($Y+5);
            $this->setX($this->getX() + 50);
            //$x = $this->getX();
            $this->Cell(2,4,htmlspecialchars_decode($com_info['cprofile_name']),0,1,'C');	
            // Company Address
            $this->SetFont($font_name,'',10);
            $yt = $pdf->getY();
            $this->setX(13);
            $this->multicell(85,5, $com_info['cprofile_address'],0,'TL');
            // Company Contact (Phone)
            $this->SetFont($font_name,'B',10);
            $y = $this->gety();
            $this->sety($y);
            $this->setX(13);
            $this->Cell(2,4,"Tel : " . $com_info['cprofile_tel'],0,1,'L');	
            // Company Contact (Fax)
            $this->sety($y);
            $this->setx(49);
            $this->Cell(2,4,"Fax : " . $com_info['cprofile_fax'],0,1,'L');
            // Company Contact (Email)
            $this->setX(13);
            $this->Cell(2,4,"Email : " . $com_info['cprofile_email'],0,1,'L');
            // Company Contact (Reg No)
            $this->setX(13);
            $this->Cell(2,4,"Company Registration No : " . $com_info['cprofile_gst_no'],0,1,'L');	
            $this->sety($this->gety());

            $this->SetFont($font_name,'B',14);
            $this->sety(8);
            $this->setX(-50);
            //$x = $this->getX();
            $this->Cell(2,4,$report_name,0,1,'C');	
           
            
            $pdf->SetFont($font_name,'',10);
            $pdf->setCellPaddings(2,0);
            $pdf->setY($yt+2);
            $y=$pdf->gety();
            $pdf->setX(125);
            $x = $pdf->getX();
            $pdf->Cell(35,5,$report_name.' No: ',1,0,'L');    
            $pdf->SetFont($font_name,'',10);
            $pdf->sety($y);
            $y=$pdf->gety();
            $pdf->setX($x+35);
            $pdf->Cell(0,5,$data["{$data_field_type}_no"],1,0,'L');

            $pdf->SetFont($font_name,'',10);
            $pdf->setY($y+5);
            $y=$pdf->gety();
            $pdf->setX(125);
            $x = $pdf->getX();
            $pdf->Cell(35,5,'Date: ',1,1,'L');    
            $pdf->SetFont($font_name,'',10);
            $pdf->sety($y);
            $y=$pdf->gety();
            $pdf->setX($x+35);
            $pdf->Cell(0,5,date('d-M-Y',strtotime($data["{$data_field_type}_date"])),1,1,'L');

            $pdf->SetFont($font_name,'',10);
            $pdf->setY($y+5);
            $y=$pdf->gety();
            $pdf->setX(125);
            $x = $pdf->getX();
            $pdf->Cell(35,5,'Purchase Order No: ',1,1,'L');    
            $pdf->SetFont($font_name,'',10);
            $pdf->sety($y);
            $y=$pdf->gety();
            $pdf->setX($x+35);
            $pdf->Cell(0,5,$data["{$data_field_type}_customerpo"],1,1,'L');
            
            $pdf->SetFont($font_name,'',10);
            $pdf->setY($y+5);
            $y=$pdf->gety();
            $pdf->setX(125);
            $x = $pdf->getX();
            $pdf->Cell(35,5,'Payment Due: ',1,1,'L');    
            $pdf->SetFont($font_name,'',10);
            $pdf->sety($y);
            $y=$pdf->gety();
            $pdf->setX($x+35);
            $pdf->Cell(0,5,date('d-M-Y',strtotime('+1 month',strtotime($data["{$data_field_type}_date"]))),1,1,'L');
            
            $pdf->SetFont($font_name,'',10);
            $pdf->setY($y+5);
            $y=$pdf->gety();
            $pdf->setX(125);
            $x = $pdf->getX();
            $pdf->Cell(35,5,'Customer Code: ',1,1,'L');    
            $pdf->SetFont($font_name,'',10);
            $pdf->sety($y);
            $y=$pdf->gety();
            $pdf->setX($x+35);
            $pdf->Cell(0,5,$data["customer_code"],1,1,'L');
            
            $pdf->SetFont($font_name,'',10);
            $pdf->setY($y+5);
            $y=$pdf->gety();
            $pdf->setX(125);
            $x = $pdf->getX();
            $pdf->Cell(35,5,'Currency Code: ',1,1,'L');    
            $pdf->SetFont($font_name,'',10);
            $pdf->sety($y);
            $y=$pdf->gety();
            $pdf->setX($x+35);
            $pdf->Cell(0,5,$data['currency_code'],1,1,'L');	
            
            global $yg;
            $yg=$this->gety();
            
        }

        // Page footer
        function Footer()
        {
            global $com_info,$data,$data_field_type;
            // Position at 1.5cm from bottom
            $this->SetY(-15);
            // times italic 8
            $this->SetFont($font_name,'I',8);
            // Page number
            //$this->Cell(0,10,'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(),0,0,'C');
            $this->Cell(0,10,$data["{$data_field_type}_no"],0,0,'C');
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

    $yy = $pdf->getY();
    $pdf->setY($yy+10);
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'',10);
    $pdf->multicell(90,5,'Sold To:','TLR','L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(90,5,htmlspecialchars_decode($data['order_attentionto_name']),'LR','L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(90,5,htmlspecialchars_decode($data['order_billaddress']),'LR','L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(45,5,'Tel : '.htmlspecialchars_decode($data['order_attentionto_phone']),'BL','L');
    $pdf->setY($y);
    $pdf->setx($pdf->getx()+40);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(45,5,'Fax : '.htmlspecialchars_decode($data['order_fax']),'BR','L');
    
    
    //$y = $pdf->getY();
    $pdf->setY($yy+10);
    $y=$pdf->gety();
    $pdf->setX(105);
    $x = $pdf->getX();
    $pdf->SetFont($font_name,'',10);
    $pdf->multicell(90,5,'Ship To:','TLR','L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx(105);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(90,5,htmlspecialchars_decode($data['order_attentionto_name']),'LR','L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx(105);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(90,5,htmlspecialchars_decode($data['order_shipaddress']),'LR','L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx(105);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(45,5,'Tel : '.htmlspecialchars_decode($data['order_attentionto_phone']),'BL','L');
    $pdf->setY($y);
    $pdf->setx(150);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(45,5,'Fax : '.htmlspecialchars_decode($data['order_fax']),'BR','L');
    
    
    $pdf->setY($y+20);
    $y = $pdf->GetY();
    $pdf->setY($y);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $pdf->setY($y+1);
    $pdf->setX($x-5);
    $pdf->SetFont($font_name,'B',10);
    $pdf->cell(15,8,"Item",1,'','C');
    $pdf->cell(30,8,"Part No",1,'','C');
    $pdf->cell(65,8,"Description",1,'','C');
    $pdf->cell(25,8,"Qty",1,'','C');
    $pdf->cell(20,8,"U/Price",1,'','C');
    $pdf->cell(30,8,"Total Amt (S$)",1,'','C');
    
    $pdf->setY($pdf->GetY());
    $pdf->setY($pdf->GetY());
    $pdf->Ln();
    $ly=$pdf->GetY();
    //$pdf->setY($ly);
    //$pdf->SetDrawColor(0,0,0);
    //$pdf->SetLineWidth(0);
    //$pdf->Line(10,$ly,203,$ly);
    
    //$pdf->SetFont($font_name,'',10);
    //$pdf->ln();
    //$x=$pdf->GetX();
    $y=$pdf->GetY();
    
    $sql = "SELECT il.*,
        (il.ordl_markup-il.ordl_discamt) as ordl_markup,il.ordl_pro_no,il.ordl_pro_desc,il.ordl_qty,ROUND(il.ordl_markup,2) as ordl_uprice ,ROUND((il.ordl_markup*il.ordl_qty)-il.ordl_discamt,2) as linetotal,il.ordl_disc,il.ordl_discamt as ordl_fdiscamt,
        uom.uom_code
        FROM db_ordl il
        LEFT JOIN db_order i ON il.ordl_order_id = i.order_id
        LEFT JOIN db_uom uom ON uom.uom_id = il.ordl_uom
        WHERE i.order_id > 0 AND order_id = '$report_id'";                  

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
            $pdf->SetFont($font_name,'B',10);
            $pdf->cell(15,8,"Item",1,'','C');
            $pdf->cell(25,8,"Part No",1,'','C');
            $pdf->cell(65,8,"Description",1,'','C');
            $pdf->cell(25,8,"Qty",1,'','C');
            $pdf->cell(20,8,"U/Price",1,'','C');
            $pdf->cell(30,8,"Total Amt (S$)",1,'','C');
            
            $pdf->Ln();
            $ly=$pdf->GetY();
            $pdf->SetDrawColor(0,0,0);
            $pdf->SetLineWidth(0);
            //$pdf->Line(10,$ly,203,$ly);

            $pdf->SetFont($font_name,'',10);
            $pdf->ln();
            $x=$pdf->GetX();
            $y=$pdf->GetY();

            $offsety1=$yg; 
        }
        
        $pdf->SetY($pdf->GetY());
        $pdf->SetX($x-5);
        $y=$pdf->GetY();
        $x=$pdf->GetX();
        $pdf->multicell($wc=15,8,$i,'RL','TL');
        
        
        $prod = ($row['ordl_item_type']=='product')? "product" : "package";
        $sql = "SELECT ".$prod."_part_no FROM db_".$prod." WHERE ".$prod."_id = '".$row['ordl_pro_id']."' LIMIT 1 "; 
        $q = mysql_query($sql);
        while($item_code = mysql_fetch_array($q)){
            $pdf->SetY($y);
            $pdf->SetX($x+$wc);
            $x=$pdf->GetX();
            $pdf->multicell($wc=30,8,htmlspecialchars_decode($item_code[$prod.'_part_no']),'RL','TL');
        }
                  
        $pdf->SetY($y);
        $pdf->SetX($x+$wc);
        $x=$pdf->GetX();
        $pdf->multicell($wc=65,8,htmlspecialchars_decode(htmlspecialchars_decode($row["{$data_field_line_type}_pro_desc"])),'RL','TL');
        //$offsety1=$pdf->gety();

        $pdf->SetY($y);
        $pdf->SetX($x+$wc);
        $x=$pdf->GetX();
        $pdf->multicell($wc=25,8,$row["{$data_field_line_type}_qty"] . " " . $row["uom_code"],'RL','C');
        
        $pdf->SetY($y);
        $pdf->SetX($x+$wc);
        $x=$pdf->GetX();
        $pdf->multicell($wc=20,8, num_format($row["ordl_fuprice"],$round_type),'RL','R');

        $pdf->SetY($y);
        $pdf->SetX($x+$wc);
        $x=$pdf->GetX();
        $pdf->multicell($wc=30,8, num_format(($row["ordl_fuprice"]*$row["{$data_field_line_type}_qty"])-$row["ordl_fdiscamt"],$round_type),'RL','R');
        
        $yoffset=$pdf->gety();

        $x=$pdf->GetX();
        $y=$offsety1+5;
    
        if( ($A4Y-($offsety1+10)) < 48){
            $pdf->AddPage();
            $pdf->sety($yg);
            $pdf->Line(10,$yg,203,$yg);
            $pdf->setY($yg);
            $yg = $pdf->GetY();
            $pdf->SetFont($font_name,'B',10);
            $pdf->cell(15,8,"Item",1,'','C');
            $pdf->cell(25,8,"Part No",1,'','C');
            $pdf->cell(65,8,"Description",1,'','C');
            $pdf->cell(25,8,"Qty",1,'','C');
            $pdf->cell(20,8,"U/Price",1,'','C');
            $pdf->cell(30,8,"Total Amt (S$)",1,'','C');

            $pdf->Ln();
            $ly=$pdf->GetY();
            $pdf->SetDrawColor(0,0,0);
            $pdf->SetLineWidth(0);
            //$pdf->Line(10,$ly,203,$ly);

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
    //$pdf->Line(10,$y+6,203,$y+6);
    $y=$pdf->GetY();
    $x=$pdf->GetX();
    
    $pdf->ln();
    $pdf->SetY($y);
    $pdf->setx(10);
    $pdf->SetFont($font_name,'B',10);
    $pdf->Cell(110,6,'','T',0,'L',false);
    
    $pdf->ln();
    $pdf->SetY($y);
    $pdf->setx(($w*2)-74);
    $pdf->SetFont($font_name,'B',10);
    $pdf->Cell(45,6,'AMOUNT: ','BTL',0,'L',false);
    $pdf->setx(($w*2)-29);
    $pdf->SetFont($font_name,'',10);
    $pdf->Cell(30,6,'$' . num_format((($subtotal-$disctotal)-$data['order_discheadertotal']),$round_type),1,0,'R',false); 
    // $pdf->Cell(23,6,'$' . num_format((($subtotal-$disctotal)-$data['order_discheadertotal']) + (($subtotal-$disctotal)-$data['order_discheadertotal'])*(system_gst_percent/100),$round_type),0,0,'R',false); 
    
    $pdf->ln();
    $pdf->SetY($pdf->GetY());
    $pdf->setx(($w*2)-74);
    $pdf->SetFont($font_name,'B',10);
    $pdf->Cell(45,6,'GST @ 7%: ','BTL',0,'L',false);
    $pdf->setx(($w*2)-29);
    $pdf->SetFont($font_name,'',10);
    $pdf->Cell(30,6,'$' . num_format((($subtotal-$disctotal)-$data['order_discheadertotal'])*(system_gst_percent/100),$round_type),1,0,'R',false); 
    
    $pdf->ln();
    $pdf->SetY($pdf->GetY());
    $pdf->setx(($w*2)-74);
    $pdf->SetFont($font_name,'B',10);
    $pdf->Cell(45,6,'AMOUNT TOTAL: ','BTL',0,'L',false);
    $pdf->setx(($w*2)-29);
    $pdf->Cell(30,6,'$' . num_format((($subtotal-$disctotal)-$data['order_discheadertotal'])+(($subtotal-$disctotal)-$data['order_discheadertotal'])*(system_gst_percent/100),$round_type),1,0,'R',false); 
    
    $pdf->sety($pdf->gety()+5);
    
    $y=$pdf->GetY();
    $pdf->SetY($y+10);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(0.25);
    //$pdf->Line(10,$y+6,203,$y+6);
    
    //$pdf->ln(2);
    //$pdf->SetY($pdf->GetY());
    //$pdf->SetFont($font_name,'B',11);    
    //$pdf->Cell(2,4,'SINGAPORE DOLLAR ',0,1,'L');
    //$pdf->SetY($pdf->GetY());
    //$pdf->setx(60);
    //$pdf->Cell(0,0,'SINGAPORE DOLLAR '.TranslateNum2Word((($subtotal-$disctotal)-$data['order_discheadertotal'])+(($subtotal-$disctotal)-$data['order_discheadertotal'])*(system_gst_percent/100)),0,1,'L'); 
//    if( ($A4Y-($y+85)) < 30){
//        $pdf->AddPage();
//        $offsety1=$yg;
//        $pdf->sety($yg);	
//    } 
    if( ($A4Y-($y+30)) < 30){	
        $pdf->AddPage();
        $yb=$pdf->gety();
        $offsety1=$yb;
        $y = $pdf->sety($yb);	
    } 
    /*
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
    $pdf->SetY($y);
    $pdf->multicell(0,5,$term,0,'TL');
    */
    $pdf->ln(5);
    $y = $pdf->gety();
    $pdf->SetY($y+20);
    $pdf->setx(10);
    $pdf->multicell(70,5,'','B','TL'); 
    
    
    $pdf->ln(5);
    $pdf->setx(20);
    $pdf->multicell(90,5,'Company or Vessel Stamp',0,'TL'); 
    
    
    $pdf->SetY($y);
    $pdf->setx(-90);
    $pdf->multicell(90,5,strtoupper($com_info['cprofile_name']),0,'TL');
    
    $pdf->ln(5);
    $y = $pdf->gety();
    $pdf->SetY($y+10);
    $pdf->setx(-89);
    $pdf->multicell(70,5,'','B','TL');    
    
    $pdf->Output("record/Test.pdf",'I');
?>     