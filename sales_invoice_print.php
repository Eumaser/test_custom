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
    
    switch ($action) {
    case 'QT':
    case 'PO':
        switch ($action) {
        case 'QT':
            $report_name = 'Quotation';
             break;
        case 'PO':
            $report_name = 'Purchase Order';
            break;
        default:
            break;
        }
        $report_name = 'Quotation';

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
        break;
    case 'SI':
    case 'SCN':  
    case 'PCN':
        if($action == 'SCN'){
            $report_name = 'Credit Note (Sales)';
        }else if($action == 'PCN'){
            $report_name = 'Credit Note (Purchase)';
        }else{
            $report_name = 'TAX INVOICE';
            //$report_name = 'Sales Invoice';
        }

        $sql = "SELECT o.*,pr.partner_name as customer_name,pr.partner_code as customer_code,pr.partner_name_cn,e.empl_name as salesperson,
                de.delivery_desc as delivery_desc, 
                co.country_desc as country_desc,
                fr.freightcharge_desc as freightcharge_desc,
                pd.pointofdelivery_desc as pointofdelivery_desc,
                pf.prefix_desc as prefix_desc,
                pc.price_desc as price_desc,
                rm.remarks_desc as remarks_desc,
                tt.transittime_desc as transittime_desc,
                va.validity_desc as validity_desc,
                pt.paymentterm_desc as paymentterm_desc,
                cr.currency_code as currency_code
        FROM db_invoice o
            INNER JOIN db_partner pr ON pr.partner_id = o.invoice_customer
            LEFT JOIN db_empl e ON e.empl_id = o.invoice_salesperson
            LEFT JOIN db_paymentterm pt ON pt.paymentterm_id = o.invoice_paymentterm_id
            LEFT JOIN db_delivery de ON de.delivery_id = o.invoice_delivery_id
            LEFT JOIN db_price pc ON pc.price_id = o.invoice_price_id
            LEFT JOIN db_validity va ON va.validity_id = o.invoice_validity_id
            LEFT JOIN db_transittime tt ON tt.transittime_id = o.invoice_transittime_id
            LEFT JOIN db_freightcharge fr ON fr.freightcharge_id = o.invoice_freightcharge_id
            LEFT JOIN db_pointofdelivery pd ON pd.pointofdelivery_id = o.invoice_pointofdelivery_id
            LEFT JOIN db_prefix pf ON pf.prefix_id = o.invoice_prefix_id
            LEFT JOIN db_remarks rm ON rm.remarks_id = o.invoice_remarks_id
            LEFT JOIN db_country co ON co.country_id = o.invoice_country_id
            LEFT JOIN db_currency cr ON cr.currency_id = o.invoice_currency
        WHERE o.invoice_id > 0 AND invoice_id = '$report_id'";
        $data_field_type = "invoice";
        $data_field_line_type = "invl";
        break;
    default:
        break;
    }
    $query = mysql_query($sql);		
    if($row = mysql_fetch_array($query)){   
        $data = $row; 
    }
    class PDF extends TCPDF
    {
        // Page header
        public function Header()
        {
            global $data,$com_info,$report_name,$report_draft,$data_field_type,$font_name,$pdf,$document_no,$action,$order_no;
            // Logo
            //$toleft=137;
            //$this->Image('dist/img/logo.jpg',12,15,45);
            //$Y=$this->GetY();

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
            $payment = ($data['invoice_payment'] == 1)? "PAID" : "UNPAID";
            $this->SetFont($font_name,'B',14);
            $this->sety(8);
            $this->setX(-50);
            //$x = $this->getX();
            $this->Cell(2,4,"{$report_name} ({$payment})",0,1,'C');	
           
            
            $pdf->SetFont($font_name,'',10);
            $pdf->setCellPaddings(2,0);
            $pdf->setY($yt+2);
            $y=$pdf->gety();
            $pdf->setX(125);
            $x = $pdf->getX();
            $pdf->Cell(35,5,'Invoice No: ',1,0,'L');    
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

            // Line break
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
    $pdf->multicell(90,5,htmlspecialchars_decode($data['invoice_attentionto_name']),'LR','L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(90,5,htmlspecialchars_decode($data['invoice_billaddress']),'LR','L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(45,5,'Tel : '.htmlspecialchars_decode($data['invoice_attentionto_phone']),'BL','L');
    $pdf->setY($y);
    $pdf->setx($pdf->getx()+40);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(45,5,'Fax : '.htmlspecialchars_decode($data['invoice_fax']),'BR','L');
    
    
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
    $pdf->multicell(90,5,htmlspecialchars_decode($data['invoice_attentionto_name']),'LR','L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx(105);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(90,5,htmlspecialchars_decode($data['invoice_shipaddress']),'LR','L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx(105);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(45,5,'Tel : '.htmlspecialchars_decode($data['invoice_attentionto_phone']),'BL','L');
    $pdf->setY($y);
    $pdf->setx(150);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(45,5,'Fax : '.htmlspecialchars_decode($data['invoice_fax']),'BR','L');
    
    
    $pdf->setY($y+20);
    $y = $pdf->GetY();
    $pdf->setY($y);
    $y = $pdf->GetY();
    $x = $pdf->GetX();
    $pdf->setY($y+1);
    $pdf->setX($x-5);
    $pdf->SetFont($font_name,'B',10);
    $x_header_top_start = 10;
    $y_header_border_start = $pdf->GetY();
     $y_header_border_end = $pdf->GetY();
    $pdf->cell(15,8,"Item",0,'','C');
    $pdf->cell(30,8,"Part No",0,'','C');
    $pdf->cell(65,8,"Description",0,'','C');
    $pdf->cell(15,8,"Qty",0,'','C');
    $pdf->cell(30,8,"U/Price",0,'','C');
    $pdf->cell(30,8,"Total Amt ($)",0,'','C');
   
//    echo $y_header_border_start;die;
    $pdf->Line($x_header_top_start,$y_header_border_start,$x_header_top_start,$y_header_border_end);
    $pdf->Line($x_header_top_start,$y_header_border_start,195,$y_header_border_end);
    $pdf->Line($x_header_top_start,$y_header_border_start+8,195,$y_header_border_end+8);
    $pdf->Line(10,$y_header_border_start,10,$y_header_border_start+8);
    $pdf->Line(25,$y_header_border_start,25,$y_header_border_start+8);
    $pdf->Line(55,$y_header_border_start,55,$y_header_border_start+8);
    $pdf->Line(120,$y_header_border_start,120,$y_header_border_start+8);
    $pdf->Line(135,$y_header_border_start,135,$y_header_border_start+8);
    $pdf->Line(165,$y_header_border_start,165,$y_header_border_start+8);
    $pdf->Line(195,$y_header_border_start,195,$y_header_border_start+8);
        
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
        (il.invl_markup-il.invl_discamt) as invl_markup,il.invl_pro_no,il.invl_pro_desc,il.invl_qty,ROUND(il.invl_markup,2) as invl_uprice ,ROUND((il.invl_markup*il.invl_qty)-il.invl_discamt,2) as linetotal,il.invl_disc,il.invl_discamt as invl_fdiscamt,
        uom.uom_code
        FROM db_invl il
        LEFT JOIN db_invoice i ON il.invl_invoice_id = i.invoice_id
        LEFT JOIN db_uom uom ON uom.uom_id = il.invl_uom
        WHERE i.invoice_id > 0 AND invoice_id = '$report_id'";                  

    $query = mysql_query($sql);
    $offsety1 = 0;
    $subtotal = 0;
    $disctotal = 0;
    $pdf->SetFont($font_name,'',10);
   
    $i = 1;
    $x=$pdf->GetX();
      while($row = mysql_fetch_array($query)){
                    $num_line = substr_count( $row["invl_pro_desc"], "\n" );
                    if($num_line > 1){
                        $bigstring = $row["invl_pro_desc"];
                        $smallstring = array();
                        $stringword = "";
                        for($a=0;$a<=$num_line;$a++){
                            if($a==$num_line){
                                $numpos = 0;
                                $stringword = $stringword.substr($bigstring, 0)."\n";
                                $bigstring = substr($bigstring,$numpos+1);
                                $smallstring[$a] = $stringword;
                                $stringword = "";
                            }else{
                                $numpos = strpos($bigstring,"\n");                                
                                $stringword = $stringword.substr($bigstring, 0, $numpos)."\n";
                                $bigstring = substr($bigstring,$numpos+1);
                                $smallstring[$a] = $stringword;
                                $stringword = "";
                            } 
                        }
             
                    }
                    

                    $pdf->SetFont($font_name,'',8);

                   
                    $pdf->SetFillColor(255, 255, 255);
                  
                  
                        $pdf->SetTextColor(0,0,0);
                        $y_border_start = $pdf->GetY();
                        $pdf->SetY($y);
                        $pdf->multicell($wc=10,5,$i,0,'L'); 

                        $pdf->SetY($y);
                        $pdf->SetX($x=$x+$wc);
                        if($row['invl_item_type'] == 'package'){
                            $sql3 = "SELECT package_part_no FROM db_package WHERE package_id = '{$row['invl_pro_id']}'";  
                            $query3 = mysql_query($sql3);
                            if($row3 = mysql_fetch_array($query3)){
                                $pdf->multicell($wc=30,5,html_entity_decode($row3['package_part_no']),0,'L'); 
                            }else{
                                $pdf->multicell($wc=30,5,"",0,'L'); 
                            }    
                        }else{
                            $sql3 = "SELECT product_part_no FROM db_product WHERE product_id = '{$row['invl_pro_id']}'";  
                            $query3 = mysql_query($sql3);
                            if($row3 = mysql_fetch_array($query3)){
                                $pdf->multicell($wc=30,5,html_entity_decode($row3['product_part_no']),0,'L'); 
                            }else{
                                $pdf->multicell($wc=30,5,"",0,'L'); 
                            }  
                        }
                        

                        $pdf->SetY($y);
                        $pdf->SetX($x=$x+$wc);
                         if($num_line > 1){                          
                            $pdf->multicell($wc=65,5,html_entity_decode($smallstring[0]),0,'L');   
                         }else{
                             $pdf->multicell($wc=65,5,html_entity_decode($row['invl_pro_desc']),0,'L');   
                         }
                        $offsety1=$pdf->gety();

                        $pdf->SetY($y);
                        $pdf->SetX($x=$x+$wc);
                        $pdf->multicell($wc=15,5,$row["invl_qty"],0,'C');

                        $pdf->SetY($y);
                        $pdf->SetX($x=$x+$wc);
                        $pdf->multicell($wc=30,5,num_format($row["invl_fuprice"],$round_type),0,'R');

                        $pdf->SetY($y);
                        $pdf->SetX($x=$x+$wc);
                        $pdf->multicell($wc=30,5,num_format($row["invl_total"],$round_type),0,'R');

                        $x=$pdf->GetX();
                        $y=$offsety1;                    
                        $y_border_end = $pdf->GetY();
                        $x_header_top_start = 10;
                        //Item 
                     
                        $pdf->Line($x_header_top_start,$y_border_start,$x_header_top_start,$y_border_end);
                        $pdf->Line($x_header_top_start+15,$y_border_start,$x_header_top_start+15,$y_border_end);
                        $pdf->Line($x_header_top_start+45,$y_border_start,$x_header_top_start+45,$y_border_end);
                        $pdf->Line($x_header_top_start+110,$y_border_start,$x_header_top_start+110,$y_border_end);
                        $pdf->Line($x_header_top_start+125,$y_border_start,$x_header_top_start+125,$y_border_end);
                        $pdf->Line($x_header_top_start+155,$y_border_start,$x_header_top_start+155,$y_border_end);
                        $pdf->Line($x_header_top_start+185,$y_border_start,$x_header_top_start+185,$y_border_end);
                   
                    $y_border_bottom=$pdf->GetY();
                    //condition to check if the last line item is printable else will create a new line
                    if( ($A4Y-($offsety2+7)) < 47){
                        $y = $offsety2;
                        // Draw a Closeing Border Bottom
                        $pdf->Line($x,$y,$x+180,$y);
                        
                        // Add New Page 
                        $pdf->AddPage();
                        $pdf->sety($yg);
                        
                        //
                        $pdf->SetFillColor(0, 52, 102);
                        $pdf->SetTextColor(255,255,255);
                        $x_header_top_start = $pdf->GetX();

                        $y = $pdf->GetY()+5;
                        $pdf->setY($y);
                        $y = $pdf->GetY()+2;
                        $pdf->SetFont($font_name,'B',8);
                        $pdf->setY($y);  
                        $x = $pdf->GetX();
                        $y_header_border_start = $pdf->GetY();
                        $pdf->multicell(10,8,"ITEM",0,'C',1);
                        $pdf->setY($y);
                        $pdf->setX($x+10);  
                        $x = $pdf->GetX();
                        $pdf->multicell(30,8,"PART NUMBER",0,'C',1);        
                        $pdf->setY($y);
                        $pdf->setX($x+30); 
                        $x = $pdf->GetX();
                        $pdf->multicell(65,8,"DESCRIPTION",0,'C',1); 
                        $pdf->setY($y);
                        $pdf->setX($x+65); 
                        $x = $pdf->GetX();
                        $pdf->multicell(15,8,"QTY",0,'C',1); 
                        $pdf->setY($y);
                        $pdf->setX($x+15); 
                        $x = $pdf->GetX();
                        $pdf->multicell(30,8,"UNIT PRICE \n(".$order_currency.")",0,'C',1); 
                        $pdf->setY($y);
                        $pdf->setX($x+30); 
                        $x = $pdf->GetX();
                        $x_header_top_end = $pdf->GetX();
                        $pdf->multicell(30,8,"AMOUNT \n(".$order_currency.")",0,'C',1); 
                        $y_header_border_end = $pdf->GetY();
						$y3 = $pdf->GetY();

                        $pdf->Line($x_header_top_start,$y_border_start,$x_header_top_start,$y_border_end);
                        $pdf->Line($x_header_top_start+10,$y_border_start,$x_header_top_start+10,$y_border_end);
                        $pdf->Line($x_header_top_start+25,$y_border_start,$x_header_top_start+25,$y_border_end);
                        $pdf->Line($x_header_top_start+55,$y_border_start,$x_header_top_start+55,$y_border_end);
                        $pdf->Line($x_header_top_start+120,$y_border_start,$x_header_top_start+120,$y_border_end);
                        $pdf->Line($x_header_top_start+145,$y_border_start,$x_header_top_start+145,$y_border_end);
                        $pdf->Line($x_header_top_start+165,$y_border_start,$x_header_top_start+165,$y_border_end);
                        $pdf->Line($x_header_top_start+195,$y_border_start,$x_header_top_start+195,$y_border_end);
						
						
                    

                        $pdf->setY($y);
                        //$y_border_start = $pdf->GetY();

                        $pdf->Line($x_header_top_start,$y,$x_header_top_end+30,$y);   // $pdf->Line(10,$y,203,$y);
                        $pdf->Line($x_header_top_start,$y+8,$x_header_top_end+30,$y+8);
                        $yg = $pdf->GetY();
                        //

                        // <!-- Blank Spacing
                        $y_header_border_start = $pdf->GetY();
                        $pdf->SetTextColor(0,0,0);
                        $pdf->SetY($y3);
                        $pdf->multicell($wc=10,5,'',0,'C', 0);         
                        $y_header_border_end = $pdf->GetY();
                        $y_border_bottom = $pdf->GetY();

                        $pdf->Line($x_header_top_start,$y_border_start,$x_header_top_start,$y_border_end);
                        $pdf->Line($x_header_top_start+10,$y_border_start,$x_header_top_start+10,$y_border_end);
                        $pdf->Line($x_header_top_start+25,$y_border_start,$x_header_top_start+25,$y_border_end);
                        $pdf->Line($x_header_top_start+55,$y_border_start,$x_header_top_start+55,$y_border_end);
                        $pdf->Line($x_header_top_start+120,$y_border_start,$x_header_top_start+120,$y_border_end);
                        $pdf->Line($x_header_top_start+145,$y_border_start,$x_header_top_start+145,$y_border_end);
                        $pdf->Line($x_header_top_start+165,$y_border_start,$x_header_top_start+165,$y_border_end);
                        $pdf->Line($x_header_top_start+195,$y_border_start,$x_header_top_start+195,$y_border_end);
                        // -->
						
                        $pdf->SetFont($font_name,'',8);
                        //$pdf->ln();
                        $x=$pdf->GetX();
                        $y=$pdf->GetY();

                        $offsety1=$yg;
                    }
                    
                    if($num_line>1){
                        for($a=1;$a<=$num_line;$a++){
                            $pdf->SetTextColor(0,0,0);
                            $y_border_start = $pdf->GetY();
                            $pdf->SetY($y);
                            $pdf->multicell($wc=10,5,'',0,'C', 0); 

                            $pdf->SetY($y);
                            $pdf->SetX($x=$x+$wc);
                            $pdf->multicell($wc=30,5,'',0,'L', 0);    

                            $pdf->SetY($y);
                            $pdf->SetX($x=$x+$wc);
                            $pdf->multicell($wc=65,5,html_entity_decode($smallstring[$a]),0,'L', 0);                            
                            //$pdf->multicell($wc=65,5,html_entity_decode($row['ProductDesc']),0,'L', 0);    
                            $offsety3=$pdf->gety();
                            $offsety_desc=$pdf->gety();

                            $pdf->SetY($y);
                            $pdf->SetX($x=$x+$wc);
                            $pdf->multicell($wc=15,5,'',0,'C', 0);

                            $pdf->SetY($y);
                            $pdf->SetX($x=$x+$wc);
                            $pdf->multicell($wc=30,5,'',0,'R', 0);

                            $pdf->SetY($y);
                            $pdf->SetX($x=$x+$wc);
                            $pdf->multicell($wc=30,5,'',0,'R', 0);

                            $x=$pdf->GetX();
                            $x_header_top_start = 10;
                            $y=$offsety3;
                             //$pdf->GetY();
                            //long description line
                            $pdf->Line(10,$y_border_start,10,$y);
                            $pdf->Line($x_header_top_start+15,$y_border_start,$x_header_top_start+15,$y);
                            $pdf->Line($x_header_top_start+45,$y_border_start,$x_header_top_start+45,$y);
                            $pdf->Line($x_header_top_start+110,$y_border_start,$x_header_top_start+110,$y);
                            $pdf->Line($x_header_top_start+125,$y_border_start,$x_header_top_start+125,$y);
                            $pdf->Line($x_header_top_start+155,$y_border_start,$x_header_top_start+155,$y);
                            $pdf->Line($x_header_top_start+185,$y_border_start,$x_header_top_start+185,$y);
                            if( ($A4Y-($offsety3+7)) < 42){
                                $y=$offsety3; //$y = $offsety2;
                                // Draw a Closeing Border Bottom
                                $pdf->Line(10,$y,$x+180,$y);

                                // Add New Page 
                                $pdf->AddPage();
                                $pdf->sety($yg);

                                //
//                                $pdf->SetFillColor(0, 52, 102);
//                                $pdf->SetTextColor(255,255,255);
                                $x_header_top_start = $pdf->GetX();

                                $y = $pdf->GetY()+5;
//                                $pdf->setY($y);
//                                $y = $pdf->GetY()+2;
                                $pdf->SetFont($font_name,'B',10);
                                $pdf->setY($y);   
                                $pdf->setx(10);
                                $x = $pdf->GetX();
                               
                                $y_header_border_start = $pdf->GetY();
                                $pdf->multicell(10,8,"Item",0,'C',1);
                                $pdf->setY($y);
                                $pdf->setX($x+10);  
                                $x = $pdf->GetX();
                                $pdf->multicell(30,8,"Part No",0,'C',1);        
                                $pdf->setY($y);
                                $pdf->setX($x+30); 
                                $x = $pdf->GetX();
                                $pdf->multicell(65,8,"Description",0,'C',1); 
                                $pdf->setY($y);
                                $pdf->setX($x+70); 
                                $x = $pdf->GetX();
                                $pdf->multicell(15,8,"Qty",0,'C',1); 
                                $pdf->setY($y);
                                $pdf->setX($x+15); 
                                $x = $pdf->GetX();
                                $pdf->multicell(30,8,"U/Price",0,'C',1); 
                                $pdf->setY($y);
                                $pdf->setX($x+30); 
                                $x = $pdf->GetX();
                                $x_header_top_end = $pdf->GetX();
                                $pdf->multicell(30,8,"Total Amt ($)",0,'C',1); 
                                $y_header_border_end = $pdf->GetY();
                                $y3 = $pdf->GetY();
//
//                                $pdf->Line($x_header_top_start,$y_header_border_start,$x_header_top_start,$y_header_border_end);
//                                $pdf->Line($x_header_top_start+10,$y_header_border_start,$x_header_top_start+10,$y_header_border_end);
//                                $pdf->Line($x_header_top_start+25,$y_header_border_start,$x_header_top_start+25,$y_header_border_end);
//                                $pdf->Line($x_header_top_start+105,$y_header_border_start,$x_header_top_start+105,$y_header_border_end);
//                                $pdf->Line($x_header_top_start+120,$y_header_border_start,$x_header_top_start+120,$y_header_border_end);
//                                $pdf->Line($x_header_top_start+150,$y_header_border_start,$x_header_top_start+150,$y_header_border_end);
//                                $pdf->Line($x_header_top_start+180,$y_header_border_start,$x_header_top_start+180,$y_header_border_end);

                                $pdf->setY($y);
                                //$y_border_start = $pdf->GetY();

                                $pdf->Line(10,$y,195,$y);   // $pdf->Line(10,$y,203,$y);
                                $pdf->Line(10,$y+8,195,$y+8);
                                $yg = $pdf->GetY();

                                // <!-- Blank Spacing
                                $y_header_border_start = $pdf->GetY();
                                $pdf->SetTextColor(0,0,0);
                                $pdf->SetY($y3);
                                $pdf->multicell($wc=10,5,'',0,'C', 0);         
                                $y_header_border_end = $pdf->GetY();
                                $y_border_bottom = $pdf->GetY();

                                $pdf->Line(10,$y_header_border_start,10,$y_header_border_end);
                                $pdf->Line($x_header_top_start+10,$y_header_border_start,$x_header_top_start+10,$y_header_border_end);
                                $pdf->Line($x_header_top_start+40,$y_header_border_start,$x_header_top_start+40,$y_header_border_end);
                                $pdf->Line($x_header_top_start+105,$y_header_border_start,$x_header_top_start+105,$y_header_border_end);
                                $pdf->Line($x_header_top_start+120,$y_header_border_start,$x_header_top_start+120,$y_header_border_end);
                                $pdf->Line($x_header_top_start+150,$y_header_border_start,$x_header_top_start+150,$y_header_border_end);
                                $pdf->Line($x_header_top_start+180,$y_header_border_start,$x_header_top_start+180,$y_header_border_end);
                                // -->

                                $pdf->SetFont($font_name,'',8);
                                //$pdf->ln();
                                $x=$pdf->GetX();
                                $y=$pdf->GetY();

                                $offsety1=$yg;
                            }

                        }
                        // <!-- Blank Spacing
                        
                        $pdf->SetTextColor(0,0,0);
                        $pdf->SetY($y);
                        $y_header_border_start = $pdf->GetY();
                        $pdf->multicell($wc=10,5,'',0,'C', 0);         
                        $y_header_border_end = $pdf->GetY();
                        $y= $pdf->GetY();
                        $y_border_bottom=$y;
                        $x_header_top_start = 10;
                        //footer line
                        $pdf->Line(10,$y_header_border_start,10,$y_header_border_end);
                        $pdf->Line($x_header_top_start+15,$y_header_border_start,$x_header_top_start+15,$y_header_border_end);
                        $pdf->Line($x_header_top_start+45,$y_header_border_start,$x_header_top_start+45,$y_header_border_end);
                        $pdf->Line($x_header_top_start+110,$y_header_border_start,$x_header_top_start+110,$y_header_border_end);
                        $pdf->Line($x_header_top_start+125,$y_header_border_start,$x_header_top_start+125,$y_header_border_end);
                        $pdf->Line($x_header_top_start+155,$y_header_border_start,$x_header_top_start+155,$y_header_border_end);
                        $pdf->Line($x_header_top_start+185,$y_header_border_start,$x_header_top_start+185,$y_header_border_end);
                        // -->
                    }

                    $subtotal = $subtotal + ($row["invl_fuprice"] * $row["invl_qty"]);
                    $disctotal = $disctotal + $row["invl_fdiscamt"];
                    $i++;
                }    
    
    
    
    $x=10;
    $y=$pdf->GetY();
    
    $i = 1;

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
    $pdf->Cell(30,6,'$' . num_format((($subtotal-$disctotal)-$data['invoice_discheadertotal']),$round_type),1,0,'R',false); 
    // $pdf->Cell(23,6,'$' . num_format((($subtotal-$disctotal)-$data['invoice_discheadertotal']) + (($subtotal-$disctotal)-$data['order_discheadertotal'])*(system_gst_percent/100),$round_type),0,0,'R',false); 
    
    $pdf->ln();
    $pdf->SetY($pdf->GetY());
    $pdf->setx(($w*2)-74);
    $pdf->SetFont($font_name,'B',10);
    $pdf->Cell(45,6,'GST @ 7%: ','BTL',0,'L',false);
    $pdf->setx(($w*2)-29);
    $pdf->SetFont($font_name,'',10);
    $pdf->Cell(30,6,'$' . num_format((($subtotal-$disctotal)-$data['invoice_discheadertotal'])*(system_gst_percent/100),$round_type),1,0,'R',false); 
    
    $pdf->ln();
    $pdf->SetY($pdf->GetY());
    $pdf->setx(($w*2)-74);
    $pdf->SetFont($font_name,'B',10);
    $pdf->Cell(45,6,'AMOUNT TOTAL: ','BTL',0,'L',false);
    $pdf->setx(($w*2)-29);
    $pdf->Cell(30,6,'$' . num_format((($subtotal-$disctotal)-$data['invoice_discheadertotal'])+(($subtotal-$disctotal)-$data['invoice_discheadertotal'])*(system_gst_percent/100),$round_type),1,0,'R',false); 
    
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
    //$pdf->Cell(0,0,'SINGAPORE DOLLAR '.TranslateNum2Word((($subtotal-$disctotal)-$data['invoice_discheadertotal'])+(($subtotal-$disctotal)-$data['invoice_discheadertotal'])*(system_gst_percent/100)),0,1,'L'); 
    if( ($A4Y-($y+30)) < 30){
//        $pdf->AddPage();
//        $offsety1=$yg;
//        $pdf->sety($yg);	
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
    $pdf->ln(3);
    $y = $pdf->gety();
    $pdf->SetY($y+3);
    $pdf->setx(-90);
    $pdf->multicell(90,5,strtoupper($com_info['cprofile_name']),0,'TL');
    
    $pdf->ln(5);
    $y = $pdf->gety();
    $pdf->SetY($y+10);
    $pdf->setx(-89);
    $pdf->multicell(70,5,'','B','TL');
    
    $pdf->Output("record/Test.pdf",'I');  
    
    function TranslateNum2Word($num){
        //$testNumber = '2143.45';

        $tempNum = explode( '.' , $num );

        $convertedNumber = ( isset( $tempNum[0] ) ? convertNumber( $tempNum[0] ) : '' );

        //  Use the below line if you don't want 'and' in the number before decimal point
        $convertedNumber = str_replace( ' and ' ,' ' ,$convertedNumber );

        //  In the below line if you want you can replace ' and ' with ' , '
        $convertedNumber .= ( ( isset( $tempNum[0] ) and isset( $tempNum[1] ) )  ? ' and ' : '' );

        $convertedNumber .= ( isset( $tempNum[1] ) ? convertNumber( $tempNum[1] ) .' cents' : '' );

        return ucwords(strtolower($convertedNumber));
    }
    
    function convertNumber($number)
    {
        list($integer, $fraction) = explode(".", (string) $number);

        $output = "";

        if ($integer{0} == "-")
        {
            $output = "negative ";
            $integer    = ltrim($integer, "-");
        }
        else if ($integer{0} == "+")
        {
            $output = "positive ";
            $integer    = ltrim($integer, "+");
        }

        if ($integer{0} == "0")
        {
            $output .= "zero";
        }
        else
        {
            $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
            $group   = rtrim(chunk_split($integer, 3, " "), " ");
            $groups  = explode(" ", $group);

            $groups2 = array();
            foreach ($groups as $g)
            {
                $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});
            }

            for ($z = 0; $z < count($groups2); $z++)
            {
                if ($groups2[$z] != "")
                {
                    $output .= $groups2[$z] . convertGroup(11 - $z) . (
                            $z < 11
                            && !array_search('', array_slice($groups2, $z + 1, -1))
                            && $groups2[11] != ''
                            && $groups[11]{0} == '0'
                                ? " and "
                                : ", "
                        );
                }
            }

            $output = rtrim($output, ", ");
        }

        if ($fraction > 0)
        {
            $output .= " point";
            for ($i = 0; $i < strlen($fraction); $i++)
            {
                $output .= " " . convertDigit($fraction{$i});
            }
        }

        return $output;
    }

    function convertGroup($index)
    {
        switch ($index)
        {
            case 11:
                return " decillion";
            case 10:
                return " nonillion";
            case 9:
                return " octillion";
            case 8:
                return " septillion";
            case 7:
                return " sextillion";
            case 6:
                return " quintrillion";
            case 5:
                return " quadrillion";
            case 4:
                return " trillion";
            case 3:
                return " billion";
            case 2:
                return " million";
            case 1:
                return " thousand";
            case 0:
                return "";
        }
    }

    function convertThreeDigit($digit1, $digit2, $digit3)
    {
        $buffer = "";

        if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
        {
            return "";
        }

        if ($digit1 != "0")
        {
            $buffer .= convertDigit($digit1) . " hundred";
            if ($digit2 != "0" || $digit3 != "0")
            {
                $buffer .= " and ";
            }
        }

        if ($digit2 != "0")
        {
            $buffer .= convertTwoDigit($digit2, $digit3);
        }
        else if ($digit3 != "0")
        {
            $buffer .= convertDigit($digit3);
        }

        return $buffer;
    }

    function convertTwoDigit($digit1, $digit2)
    {
        if ($digit2 == "0")
        {
            switch ($digit1)
            {
                case "1":
                    return "ten";
                case "2":
                    return "twenty";
                case "3":
                    return "thirty";
                case "4":
                    return "forty";
                case "5":
                    return "fifty";
                case "6":
                    return "sixty";
                case "7":
                    return "seventy";
                case "8":
                    return "eighty";
                case "9":
                    return "ninety";
            }
        } else if ($digit1 == "1")
        {
            switch ($digit2)
            {
                case "1":
                    return "eleven";
                case "2":
                    return "twelve";
                case "3":
                    return "thirteen";
                case "4":
                    return "fourteen";
                case "5":
                    return "fifteen";
                case "6":
                    return "sixteen";
                case "7":
                    return "seventeen";
                case "8":
                    return "eighteen";
                case "9":
                    return "nineteen";
            }
        } else
        {
            $temp = convertDigit($digit2);
            switch ($digit1)
            {
                case "2":
                    return "twenty-$temp";
                case "3":
                    return "thirty-$temp";
                case "4":
                    return "forty-$temp";
                case "5":
                    return "fifty-$temp";
                case "6":
                    return "sixty-$temp";
                case "7":
                    return "seventy-$temp";
                case "8":
                    return "eighty-$temp";
                case "9":
                    return "ninety-$temp";
            }
        }
    }

    function convertDigit($digit)
    {
        switch ($digit)
        {
            case "0":
                return "zero";
            case "1":
                return "one";
            case "2":
                return "two";
            case "3":
                return "three";
            case "4":
                return "four";
            case "5":
                return "five";
            case "6":
                return "six";
            case "7":
                return "seven";
            case "8":
                return "eight";
            case "9":
                return "nine";
        }
    }
?>     