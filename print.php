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
            
            $sql = "SELECT o.*,pr.partner_name as customer_name,pr.partner_name_cn,c.contact_name
                    FROM db_order o
                    INNER JOIN db_partner pr ON pr.partner_id = o.order_customer
                    LEFT JOIN db_contact c ON c.contact_id = o.order_attentionto
                    WHERE o.order_id > 0 AND order_id = '$report_id'";
            $data_field_type = "order";
            $data_field_line_type = "ordl";
            break;
        
    case 'SI':
            $report_name = 'TAX INVOICE';
            
            $sql = "SELECT i.*,pr.partner_name as customer_name,pr.partner_name_cn,c.contact_name
                    FROM db_invoice i
                    INNER JOIN db_partner pr ON pr.partner_id = i.invoice_customer
                    LEFT JOIN db_contact c ON c.contact_id = i.invoice_attentionto
                    WHERE i.invoice_id > 0 AND i.invoice_id = '$report_id'";
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
				    $toleft=137;
				    $this->Image('dist/img/logo.png',$toleft+10,5,40);
				    $Y=$this->GetY();
				   

				   // times bold 15
				   $this->SetFont($font_name,'B',18);
                                    

                                    $this->sety($Y+5);
                                    $this->Cell(2,4,$com_info['cprofile_name'],0,1,'L');	
                                    $this->SetFont($font_name,'',10);
                                    $this->multicell(85,5, $com_info['cprofile_address'],0,'TL');

                                    $this->SetFont($font_name,'B',10);
                                    $y = $this->gety();
                                    $this->sety($y);
                                    $this->Cell(2,4,"Tel : " . $com_info['cprofile_tel'],0,1,'L');	
                                    
                                    $this->sety($y);
                                    $this->setx(45);
                                    $this->Cell(2,4,"Fax : " . $com_info['cprofile_fax'],0,1,'L');	
                                    $this->sety($y);
                                    
                                    $this->SetFont($font_name,'',10);
                                    
                                    $this->Ln();
                                    $this->sety($this->gety());
                                    $this->Cell(2,4,"GST Registration No. " . $com_info['cprofile_gst_no'],0,1,'L');	
                                    $this->sety($this->gety());
                                    
                                    
                                    $this->Ln(2);
                                    $this->sety($this->gety());
                                    $pdf->Line(10,$this->gety(),203,$this->gety());	
                                    
                                    $this->Ln(12);
                                    $this->sety($this->gety());
				    // Move to the right
                                    $y = $this->gety();
				    $index=10;
				    $this->SetFont($font_name,'B',15);	
                                    $this->SetTextColor(0,0,0); 
				    $this->sety($Y+30);
				    $this->Cell($toleft+10);
				    $this->Cell(2,8,$report_name,0,1,'L');
                                    
				    $y=$this->gety();
                                    $this->SetFont($font_name,'B',9);
				    $this->sety($y);
				    $this->Cell($toleft + 6);
				    $this->Cell(0,4,'GST REG No : '.$com_info['cprofile_gst_no'],0,1,'L');
                                     
				    $y=$this->gety()+2;
                                    $this->sety($y);
				    $this->SetFont($font_name,'',9);
                                    $this->Cell($toleft);
				    $this->Cell(0,4,'No',0,1,'L');
				    $this->sety($y);
				    $this->Cell($toleft+ $index);
				    $this->Cell(0,4,' : '.$data["{$data_field_type}_no"],0,1,'L');
                                    
				    $y=$this->gety()+2;
                                    $this->sety($y);
				    $this->SetFont($font_name,'',9);
                                    $this->Cell($toleft);
				    $this->Cell(0,4,'Date',0,1,'L');
				    $this->sety($y);
				    $this->Cell($toleft+ $index);
				    $this->Cell(0,4,' : '.format_date($data["{$data_field_type}_date"]),0,1,'L');
                                    
				    $y=$this->GetY()+2;
                                    $this->sety($y);
                                    $this->Cell($toleft);
				    $this->Cell(10,4,'Tel',0,0,'L');
				    $this->sety($y);
				    $this->Cell($toleft+ $index);
				    $this->Cell(0,4,' : '.$data["{$data_field_type}_attentionto_phone"],0,1,'L');
                                    
				    $y=$this->GetY()+2;
                                    $this->sety($y);
                                    $this->Cell($toleft);
				    $this->Cell(10,4,'Job No.',0,0,'L');
				    $this->sety($y);
				    $this->Cell($toleft+ $index);
				    $this->Cell(0,4,' : '.$data["{$data_field_type}_customerpo"],0,1,'L');


				    
				    // Line break

				    $this->Ln(10);
				    global $yg;
				    $yg=$this->gety();
			
					
				}
				
				// Page footer
				function Footer()
				{
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
				$pdf->AddPage();
				$pdf->SetFont($font_name,'',12);

				$A4Y=297;
				$w=97;
				$toleft=137;
				
			
				$Y1=$yg;
								
								

                                $pdf->setY(30);

                                
                                //customer address
                                $pdf->setY($pdf->gety());
				$pdf->SetFont($font_name,'B',9);
//				$pdf->multicell(75,5,$data['customer_name'],0,'TL');
				$pdf->multicell(50,5,$data["{$data_field_type}_billaddress"],0,'TL');
				
				$pdf->SetFont($font_name,'',9);
				$pdf->ln(4);
				$y=$pdf->gety();
				$pdf->Cell(2,4,'Attn',0,1,'L');
				$pdf->sety($y);	
				$pdf->setx(20);
				$pdf->Cell(2,4,':  '.$data['contact_name'],0,1,'L');	
				
				$pdf->SetFont($font_name,'',9);
				$pdf->ln(4);
				$y=$pdf->gety();
				$pdf->Cell(2,4,'Our Ref',0,1,'L');
				$pdf->sety($y);	
				$pdf->setx(25);
				$pdf->Cell(2,4,':  '.$data["{$data_field_type}_customerref"],0,1,'L');	
                                
                                $pdf->ln(4);
                                $pdf->setY($pdf->gety());
				$pdf->SetFont($font_name,'',9);
				$pdf->multicell(0,5,$data["{$data_field_type}_regards"],0,'TL');
		
                                $pdf->setY($pdf->GetY());
                                
                        //item listing area

                        $y = $pdf->GetY();
                        $pdf->Line(10,$y,203,$y);
                        $pdf->setY($y);
                        $y = $pdf->GetY();
                        $pdf->setY($y+1);
                        $pdf->SetFont($font_name,'B',10);
                        $pdf->cell(15,4,"Item");
                        $pdf->cell(100,4,"Description",'','','C');
                        $pdf->cell(25,4,"Quantity");	
                        $pdf->cell(25,4,"Unit Price",'','','R');
                        $pdf->cell(25,4,"Amount",'','','R');
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
    if($action == 'SI'){
        $sql = "SELECT o.*,pr.partner_account_name1 as customer_name,empl.empl_name as sales_person,
            (ol.invl_markup-ol.invl_discamt) as invl_markup,ol.invl_pro_no,ol.invl_pro_desc,ol.invl_qty,ROUND(ol.invl_markup,2) as invl_uprice ,ROUND((ol.invl_markup*ol.invl_qty)-ol.invl_discamt,2) as linetotal,cy.currency_code,ol.invl_disc,ol.invl_discamt as invl_fdiscamt,
            uom.uom_code,sm.shipterm_code,sm.shipterm_desc,o.invoice_attentionto_name as contact_name,pr.partner_account_code
            FROM db_invl ol
            LEFT JOIN db_invoice o ON ol.invl_invoice_id = o.invoice_id
            LEFT JOIN db_uom uom ON uom.uom_id = ol.invl_uom
            INNER JOIN db_partner pr ON pr.partner_id = o.invoice_customer
            LEFT JOIN db_empl empl ON empl.empl_id = o.invoice_salesperson
            LEFT JOIN db_currency cy ON cy.currency_id = o.invoice_currency
            LEFT JOIN db_shipterm sm ON sm.shipterm_id = o.invoice_shipterm
            LEFT JOIN db_contact ct ON ct.contact_id = o.invoice_attentionto
            WHERE o.invoice_id > 0 AND invoice_id = '$report_id'";

    }else {
        $sql = "SELECT o.*,
            ol.ordl_pro_no,ol.ordl_pro_desc,ol.ordl_qty,ol.ordl_fuprice ,
            uom.uom_code,ol.ordl_disc,ol.ordl_fdiscamt
            FROM db_order o
            INNER JOIN db_ordl ol ON ol.ordl_order_id = o.order_id
            LEFT JOIN db_uom uom ON uom.uom_id = ol.ordl_uom
            WHERE o.order_id > 0 AND order_id = '$report_id'";
    }                    

            $query = mysql_query($sql);
            $offsety1 = 0;
            $subtotal = 0;
            $disctotal = 0;
            $pdf->SetFont($font_name,'',9);
            $i = 1;
            while($row = mysql_fetch_array($query)){

                $pdf->SetY($y);
                $pdf->multicell($wc=15,5,$i,0,'TL');

                $pdf->SetY($y);
                $pdf->SetX($x=$x+$wc);

                $pdf->multicell($wc=105,5, $row["{$data_field_line_type}_pro_no"],0,'TL');
                $offsety1=$pdf->gety();
                
                $pdf->SetY($y);
                $pdf->SetX($x=$x+$wc);
                $pdf->multicell($wc=25,5,$row["{$data_field_line_type}_qty"] . ' ' . $row['uom_code'],0,'TL');
                
                $pdf->SetY($y);
                $pdf->SetX($x=$x+$wc);
                $pdf->multicell($wc=25,5, num_format($row["ordl_fuprice"],$round_type),0,'R');

                $pdf->SetY($y);
                $pdf->SetX($x=$x+$wc);
                $pdf->multicell($wc=25,5, num_format($row["ordl_fuprice"]*$row["{$data_field_line_type}_qty"],$round_type),0,'R');
                $yoffset=$pdf->gety();

                $x=$pdf->GetX();
                $y=$offsety1+5;

                //condition to check if the last line item is printable else will create a new line
                if( ($A4Y-($offsety1+10)) < 48){
                    $pdf->AddPage();
                    $pdf->sety($yg);
                    $pdf->SetFont($font_name,'B',9);
                    $pdf->cell(15,4,"Item No.");
                    $pdf->cell(105,4,"Work Description",'','','C');
                    $pdf->cell(25,4,"Qty");	
                    $pdf->cell(25,4,"Unit Rate ($)",'','','R');
                    $pdf->cell(25,4,"Total Cost ($)",'','','R');

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
            
                if( ($A4Y-($y+45)) < 40){
                        $pdf->AddPage();
                        $offsety1=$yg;
                        $pdf->sety($yg);	
                }


                //setting the line from bottom up
                $pdf->SetY(-60);	


                $y=$pdf->GetY();
                $pdf->SetDrawColor(0,0,0);
                $pdf->SetLineWidth(0.5);
                $pdf->Line(10,$y+6,203,$y+6);	

                $pdf->ln();
                $pdf->SetY($pdf->GetY()+1);
                $pdf->setx(($w*2)-40);
                $pdf->SetFont($font_name,'B',9);
                $pdf->Cell(23,6,'Total Cost ',0,0,'L',false);
                $pdf->setx(($w*2)-15);
                $pdf->Cell(23,6,'$' . num_format(($subtotal-$disctotal) + ($subtotal-$disctotal)*(system_gst_percent/100),$round_type),0,0,'R',false);
                
                $pdf->sety($pdf->gety());

                if( ($A4Y-($pdf->gety()+15+$pdf->getStringHeight(80, $data["{$data_field_type}_remark"]))) < 20){
                    $pdf->AddPage();
                    $pdf->SetY(90);
                    $offsety1=$pdf->gety();
                }
                $pdf->ln(10);
                $pdf->SetY($pdf->gety());
                $y = $pdf->gety();
                $pdf->SetFont($font_name,'',9);
                $pdf->multicell(20,5,'Note :',0,'TL');
                $pdf->SetY($y);
                $pdf->setx(20);
                $pdf->multicell(0,5,$data["{$data_field_type}_remark"],0,'TL');
                $checky=$pdf->gety();
                                
                $pdf->Output("record/Test.pdf",'I');

				
?>     