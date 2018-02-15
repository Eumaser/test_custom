<?php
    include "connect.php";
    include "config.php";
    include_once 'include_function.php';
    require('class/tcpdf/tcpdf.php');

    $type   = escape($_REQUEST['type']);
    $action = escape($_REQUEST['action']);
    
    $report_customer_id      = escape($_REQUEST['report_customer_id']);
    $report_customer_name    = htmlentities(urldecode(escape($_REQUEST['report_customer_name'])));
    $report_salesperson_id   = escape($_REQUEST['report_salesperson_id']);
    $report_salesperson_name = htmlentities(urldecode(escape($_REQUEST['report_salesperson_name'])));
    $report_order          = escape($_REQUEST['report_order']);
    $report_date_from        = escape($_REQUEST['report_date_from']);
    $report_date_to          = escape($_REQUEST['report_date_to']);
    $report_product_id       = escape($_REQUEST['report_product_id']);
    
    if(!empty($report_order)){
        $whereSql .= " AND ord.order_no LIKE '%".$report_order."%' ";
    }    
    if(!empty($report_customer_name)){
        $whereSql .= " AND cust.partner_name LIKE '%".$report_customer_name."%' ";
    }    
    if(!empty($report_salesperson_name)){
        $whereSql .= " AND emp.empl_name LIKE '%".$report_salesperson_name."%' ";
    }
    if(!empty($report_date_from) && !empty($report_date_to)){
        $whereSql .= " AND ord.order_date BETWEEN '".date('Y-m-d', strtotime($report_date_from))."' AND '".date('Y-m-d', strtotime($report_date_to))."' ";
    }else if(!empty($report_date_from)){
        $whereSql .= " AND ord.order_date >= '".date('Y-m-d', strtotime($report_date_from))."'";
    }else if(!empty($report_date_to)){
        $whereSql .= " AND ord.order_date <= '".date('Y-m-d', strtotime($report_date_to))."'";
    }
    
    
    
    if($type == 'summary'){
        $label_name = "Summary ";
        $act = 'getSummary';
    }else if($type=='detailed'){
        $label_name = "Detailed ";
        $act = 'getDetailed';
        if(!empty($report_product_id)){
            $whereSql .= " AND ordl.ordl_pro_id = '".$report_product_id."'";
        }
    }
    
    $com_info = getCompanyInfo();
    $report_name = 'Quotation '.$label_name.' Report';
    //$document_name = 'QUOTATION';
    
    
    $data_field_type = "order";
    $data_field_line_type = "ordl";
    
    
    class PDF extends TCPDF
    {
        // Page header
        public function Header()
        {
            global $data,$com_info,$report_name,$report_draft,$data_field_type,$font_name,$pdf,$document_no,$action,$order_no;
            // Logo
            $toleft=137;
            //$this->Image('dist/img/iso logo.jpg',$toleft+10,0,30);
            $this->Image('dist/img/logo.jpg',18,10,55);
            $Y=$this->GetY();

            // Company Name
            $this->SetFont($font_name,'B',18);
            $this->sety($Y+5);
            $this->setX(142);
            $this->Cell(2,4,htmlspecialchars_decode($com_info['cprofile_name']),0,1,'C');	
            // Company Address
            $this->SetFont($font_name,'',10);
            $this->setX(90);
            $this->multicell(85,5, $com_info['cprofile_address'],0,'TL');
            // Company Contact (Phone)
            $this->SetFont($font_name,'B',10);
            $y = $this->gety();
            $this->sety($y);
            $this->setX(90);
            $this->Cell(2,4,"Tel : " . $com_info['cprofile_tel'],0,1,'L');	
            // Company Contact (Fax)
            $this->sety($y);
            $this->setx(125);
            $this->Cell(2,4,"Fax : " . $com_info['cprofile_fax'],0,1,'L');
            // Company Contact (Email)
            $this->setX(90);
            $this->Cell(2,4,"Email : " . $com_info['cprofile_email'],0,1,'L');
            // Company Contact (Reg No)
            $this->setX(90);
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
            $this->SetFont($font_name,'B',15);	
            $this->SetTextColor(0,0,0); 
            $this->sety($Y+40);
            $this->Cell(2,8,$report_name,0,1,'L');

            global $yg;
            $yg=$this->gety();
        }

        // Page footer
        function Footer()
        {
            global $data,$data_field_type,$com_info;
            // Position at 1.5cm from bottom
            $this->SetY(-15);
            $this->SetFont($font_name,'',8);
            $this->Cell(0,10,$data["{$data_field_type}_no"],0,0,'L');
            // Position at 1.5cm from bottom
            $this->SetY(-15);
            // times italic 8
            $this->SetFont($font_name,'I',8);
            // Page number
            $this->Cell(0,10,'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(),0,0,'C'); 

            $y = $this->getY();
            $this->setY($y+3);
            $this->setX(-50);
            $this->SetFont($font_name,'',8);	
            $this->SetTextColor(0,0,0);            
            $this->Cell(0,2,'Date: ',0,0,'L');
            //$x = $this->getx();
            $this->setY($y+3);
            $this->setX(-15);
            $this->SetFont($font_name,'',8);	
            $this->SetTextColor(0,0,0);             
            $this->Cell(0,2,date('d F Y'),0,0,'R');
        }
    }
		
    // Instanciation of inherited class
    // Add a Unicode font (uses UTF-8)

    // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
    // Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
    // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 40, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER + 10);
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM + 3);

    $pdf->AddPage();
    $pdf->SetFont($font_name,'',12);

    $A4Y=297;
    $w=97;
    $toleft=137;
    
    $pdf->setY(40);
   
    $pdf->ln(2);
    $pdf->setY($pdf->gety()+10);
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()+90);
    //$pdf->SetFont($font_name,'B',10);
    
    if($type=='summary'){
        $y = $pdf->GetY();
        $pdf->Line(10,$y,203,$y);
        $pdf->setY($y);
        $y = $pdf->GetY();
        $pdf->setY($y+1);
        $pdf->SetFont($font_name,'B',10);
        $pdf->cell(8,4,"No",'','L');
        $pdf->cell(28,4,"Order",'','L');
        $pdf->cell(22,4,"Date",'','C');
        $pdf->cell(40,4,"Customer",'','','L');	
        $pdf->cell(35,4,"Sales Person",'','','L');
        $pdf->cell(18,4,"SubTotal",'','','R');
        $pdf->cell(15,4,"GST",'','','R');
        $pdf->cell(18,4,"Total",'','','R');
        // Line break
        $pdf->Ln();
        $ly=$pdf->GetY();
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0);
        $pdf->Line(10,$ly,203,$ly);
        $pdf->SetFont($font_name,'',10);
        $pdf->ln();
        $x=$pdf->GetX();
        $y=$pdf->GetY()-2;
        $i = 1;

        $offsety1 = 0;
        $sql = "SELECT  ord.order_no, 
                        ord.order_date, 
                        ord.order_customer, 
                        cust.partner_name,
                        ord.order_salesperson, 
                        emp.empl_name,
                        ord.order_subtotal,
                        ord.order_taxtotal,
                        ord.order_grandtotal,
                        ord.order_id, 
                        ord.order_prefix_type
                FROM `db_order` ord
                    LEFT JOIN `db_partner` cust ON cust.partner_id = ord.order_customer
                    LEFT JOIN `db_empl` emp ON emp.empl_id = ord.order_salesperson
                WHERE ord.order_status = 1 AND (ord.order_prefix_type = 'QT')
                $whereSql ORDER BY ord.order_date DESC, ord.order_id DESC ";
        $query = mysql_query($sql);		
        while($row = mysql_fetch_array($query)){
            if( ($A4Y-($y+10+$pdf->getStringHeight(80, $row["{$data_field_line_type}_pro_desc"]))) < 20){
                $pdf->AddPage();
                $pdf->sety($yg);
                $pdf->Line(10,$yg,203,$yg);
                $pdf->setY($yg);
                $yg = $pdf->GetY();
                $pdf->SetFont($font_name,'B',10);
                $pdf->cell(8,4,"No",'','L');
                $pdf->cell(28,4,"Order",'','L');
                $pdf->cell(22,4,"Date",'','C');
                $pdf->cell(40,4,"Customer",'','','L');	
                $pdf->cell(35,4,"Sales Person",'','','L');
                $pdf->cell(18,4,"SubTotal",'','','R');
                $pdf->cell(15,4,"GST",'','','R');
                $pdf->cell(18,4,"Total",'','','R');
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
            $x=$pdf->GetX();
            $pdf->multicell($wc=8,5,$i,0,'TL');

            $pdf->SetY($y);
            $pdf->SetX($x=$x+$wc);
            $pdf->multicell($wc=28,5,htmlspecialchars_decode($row["order_no"]),0,'L');

            $pdf->SetY($y);
            $pdf->SetX($x=$x+$wc);
            $pdf->multicell($wc=22,5,$row["order_date"],0,'C');        

            $pdf->SetY($y);
            $pdf->SetX($x=$x+$wc);
            $pdf->multicell($wc=40,5,htmlspecialchars_decode($row["partner_name"]),0,'L');
            $offsety1=$pdf->gety();

            $pdf->SetY($y);
            $pdf->SetX($x=$x+$wc);
            $pdf->multicell($wc=35,5,htmlspecialchars_decode($row["empl_name"]),0,'L');

            $pdf->SetY($y);
            $pdf->SetX($x=$x+$wc);
            $pdf->multicell($wc=18,5, num_format($row["order_subtotal"],$round_type),0,'R');

            $pdf->SetY($y);
            $pdf->SetX($x=$x+$wc);
            $pdf->multicell($wc=15,5, num_format($row["order_taxtotal"],$round_type),0,'R');

            $pdf->SetY($y);
            $pdf->SetX($x=$x+$wc);
            $pdf->multicell($wc=18,5, num_format($row["order_grandtotal"],$round_type),0,'R');
            $yoffset=$pdf->gety();

            $x=$pdf->GetX();
            $y=$offsety1+5;
            
            //condition to check if the last line item is printable else will create a new line
            if( ($A4Y-($offsety1+10)) < 20){
                $pdf->AddPage();
                $pdf->sety($yg);
                $pdf->Line(10,$yg,203,$yg);
                $pdf->setY($yg);
                $yg = $pdf->GetY();
                $pdf->SetFont($font_name,'B',10);
                $pdf->cell(8,4,"No",'','L');
                $pdf->cell(28,4,"Order",'','L');
                $pdf->cell(22,4,"Date",'','C');
                $pdf->cell(40,4,"Customer",'','','L');	
                $pdf->cell(35,4,"Sales Person",'','','L');
                $pdf->cell(18,4,"SubTotal",'','','R');
                $pdf->cell(15,4,"GST",'','','R');
                $pdf->cell(18,4,"Total)",'','','R');

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
            $grandtotal = $grandtotal + $row["order_grandtotal"];
            $i++;
        }
        if( ($A4Y-($y+30)) < 30){
            $pdf->AddPage();
            $yb=$pdf->gety();
            $offsety1=$yb;
            $y = $pdf->sety($yb);	
        } 
        $yt=$pdf->GetY();
        $pdf->setY($yt+5);
        $y=$pdf->GetY();
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0);
        $pdf->Line(10,$y,203,$y);
        $y=$pdf->GetY();
        $pdf->SetY($y);
        $pdf->SetX(-100);
        $pdf->SetFont($font_name,'B',16);
        $pdf->multicell($wc=50,5,"Total Amount: ",0,'R');
        $pdf->SetY($y);
        $pdf->SetX(-60);
        $pdf->multicell($wc=50,5,number_format($grandtotal,2),0,'R');
    }else if($type=='detailed'){
        $y = $pdf->GetY();
        //$pdf->Line(10,$y,203,$y);
        $pdf->setY($y+5);
        $y = $pdf->GetY();
        $pdf->setY($y+1);
        $pdf->SetFont($font_name,'B',10);
        //$pdf->cell(10,4,"No",'','L');
        //$pdf->cell(35,4,"Order",'','L');
        //$pdf->cell(60,4,"Customer",'','','L');
        //$pdf->cell(25,4,"Date",'','C');
        // Line break
        $pdf->Ln();
        $ly=$pdf->GetY();
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetLineWidth(0);
        //$pdf->Line(10,$ly,203,$ly);        
        $pdf->ln();
        $x=$pdf->GetX();
        $y=$pdf->GetY()-2;
        $i = 1;

        $offsety1 = 0;
        $sql = "SELECT  ord.order_no, 
                        ord.order_date, 
                        ord.order_customer, 
                        cust.partner_name,
                        ord.order_salesperson, 
                        emp.empl_name,
                        ord.order_subtotal,
                        ord.order_taxtotal,
                        ord.order_grandtotal,
                        ord.order_id, 
                        ord.order_prefix_type,
                        COUNT(ordl.ordl_pro_id) as ordl_pro_id
                FROM `db_order` ord
                    LEFT JOIN `db_partner` cust ON cust.partner_id = ord.order_customer
                    LEFT JOIN `db_empl` emp ON emp.empl_id = ord.order_salesperson
                    LEFT JOIN `db_ordl` ordl ON ordl.ordl_order_id = ord.order_id
                WHERE ord.order_status = 1 AND (ord.order_prefix_type = 'QT' )
                $whereSql GROUP BY ord.order_no
                    HAVING COUNT(ordl.ordl_pro_id) > 0
                    ORDER BY ord.order_date DESC, ord.order_id DESC ";
        $query = mysql_query($sql);		
        while($row = mysql_fetch_array($query)){
            if( ($A4Y-($y+10+$pdf->getStringHeight(80, $row["partner_name"]))) < 20){
                $pdf->AddPage();
                $pdf->sety($yg);
                //$pdf->Line(10,$yg,203,$yg);
                //$pdf->setY($yg);
                $yg = $pdf->GetY();
                //$pdf->SetFont($font_name,'B',10);
                //$pdf->cell(10,4,"No",'','L');
                //$pdf->cell(35,4,"Order",'','L');
                //$pdf->cell(60,4,"Customer",'','','L');
                //$pdf->cell(25,4,"Date",'','C');                	
                // Line break
                $pdf->Ln();
                //$ly=$pdf->GetY();
                //$pdf->SetDrawColor(0,0,0);
                //$pdf->SetLineWidth(0);
                //$pdf->Line(10,$ly,203,$ly);

                $pdf->ln();
                $x=$pdf->GetX();
                $y=$pdf->GetY();

                $offsety1=$yg; 
            }

            $pdf->SetY($y);
            $x=$pdf->GetX();
            $pdf->multicell($wc=10,5,$i,'B','TL');

            $pdf->SetY($y);
            $pdf->SetX($x=$x+$wc);
            $pdf->multicell($wc=35,5,$row["order_no"],'B','L');

            $pdf->SetY($y);
            $pdf->SetX($x=$x+$wc);
            $pdf->multicell($wc=100,5,htmlspecialchars_decode($row["partner_name"]),'B','L');
            $offsety1=$pdf->gety();
            
            $pdf->SetY($y);
            $pdf->SetX($x=$x+$wc);
            $pdf->multicell($wc=25,5,format_date($row["order_date"]),'B','C');
            $yoffset=$pdf->gety();

            $x=$pdf->GetX();
            $y=$offsety1+1;
            $j = 1;        
        
            //$y = $pdf->GetY();
            //$pdf->Line(10,$y,203,$y);
            $pdf->setY($y);
            $pdf->setX($x+10);
            $xh = $pdf->GetX();
            //$pdf->setY($y+1);
            //$pdf->SetFont($font_name,'I',10);
            //$pdf->cell(10,4,"",'TB','','L');
            //$pdf->cell(100,4,"Product Name",'TB','','L');	
            //$pdf->cell(12,4,"Qty",'TB','','L');
            //$pdf->cell(15,4,"U/Price",'TB','','R');
            //$pdf->cell(15,4,"Total",'TB','','R');
            //$pdf->setY($pdf->GetY());
            $pdf->Ln();
            $y = $pdf->gety();
            //////$offsety1=$pdf->gety();
            //$y=$offsety1+1;
            $detailSql = "SELECT    ordl.ordl_id,
                                    ordl.ordl_item_type,
                                    (CASE when (ordl.ordl_item_type = 'package') 
                                        THEN
                                        (   SELECT CONCAT(package_part_no,' ',package_desc) as product_name
                                            FROM `db_package`                                    
                                            WHERE package_id = ordl.ordl_pro_id
                                        )
                                        ELSE
                                        (   SELECT CONCAT(product_part_no,' ',product_desc) as product_name
                                            FROM `db_product`                                    
                                            WHERE product_id = ordl.ordl_pro_id
                                        )
                                    END) as product_name,
                                    (CASE when (ordl.ordl_item_type = 'package') 
                                        THEN
                                            'NA'
                                        ELSE
                                            cat.category_desc
                                    END) as category_desc,
                                    ordl.ordl_pro_id,
                                    ordl.ordl_qty,
                                    ordl.ordl_uprice,
                                    ordl.ordl_total
                        FROM `db_ordl` ordl
                                LEFT JOIN db_product prod ON prod.product_id = ordl.ordl_pro_id
                                LEFT JOIN db_category cat ON cat.category_id = prod.product_category
                        WHERE ordl.ordl_order_id = '".$row['order_id']."' 
                        ORDER BY ordl.ordl_id, ordl.ordl_item_type ASC";
            $dquery = mysql_query($detailSql);
            while($drow = mysql_fetch_array($dquery)){ 
                if( ($A4Y-($y+10+$pdf->getStringHeight(80, $drow["product_name"]))) < 20){
                    $pdf->AddPage();
                    $pdf->sety($yg);
                    //$pdf->Line(10,$yg,203,$yg);
                    //$pdf->setY($yg);
                    $yg = $pdf->GetY();
                    //$pdf->SetFont($font_name,'B',10);
                    //$pdf->cell(10,4,"No",'','L');
                    //$pdf->cell(35,4,"Order",'','L');
                    //$pdf->cell(60,4,"Customer",'','','L');
                    //$pdf->cell(25,4,"Date",'','C');                	
                    // Line break
                    $pdf->Ln();
                    //$ly=$pdf->GetY();
                    //$pdf->SetDrawColor(0,0,0);
                    //$pdf->SetLineWidth(0);
                    //$pdf->Line(10,$ly,203,$ly);

                    $pdf->ln();
                    $x=$pdf->GetX();
                    $y=$pdf->GetY();

                    $offsety1=$yg; 
                }
                $pdf->SetY($y);
                $pdf->SetX($xh);
                $y=$pdf->GetY();
                $x=$pdf->GetX();
                $pdf->SetFont($font_name,'I',10);
                $pdf->multicell($wc=8,8,$j,'','TL');      

                $pdf->SetY($y);
                $pdf->SetX($x=$x+$wc);
                $x=$pdf->GetX();
                $pdf->multicell($wc=100,8,htmlspecialchars_decode($drow["product_name"]),'','L');
                $offsety1=$pdf->gety();

                $pdf->SetY($y);
                $pdf->SetX($x=$x+$wc);
                $x=$pdf->GetX();
                $pdf->multicell($wc=12,8,$drow["ordl_qty"],'','L');

                $pdf->SetY($y);
                $pdf->SetX($x=$x+$wc);
                $x=$pdf->GetX();
                $pdf->multicell($wc=15,8,num_format($drow["ordl_uprice"],$round_type),'','R');

                $pdf->SetY($y);
                $pdf->SetX($x=$x+$wc);
                $x=$pdf->GetX();
                $pdf->multicell($wc=15,8,num_format($drow["ordl_total"],$round_type),'','R');
                $offsety1=$pdf->gety();

                //$x=$pdf->GetX();
                $y=$offsety1+1;
                $j++;
            }
            $pdf->SetY($y);
            $pdf->setx(($w*2)-65);
            $pdf->SetFont($font_name,'B',10);
            $pdf->Cell(20,6,'Sub Total: ',0,0,'R',false);
            $pdf->setx(($w*2)-42);
            $pdf->SetFont($font_name,'',10);
            $pdf->Cell(23,6,'$' . num_format($row["order_subtotal"],$round_type),0,0,'R',false); 

            $pdf->ln();
            $pdf->SetY($pdf->GetY());
            $pdf->setx(($w*2)-65);
            $pdf->SetFont($font_name,'B',10);
            $pdf->Cell(20,6,'7%: GST: ',0,0,'R',false);
            $pdf->setx(($w*2)-42);
            $pdf->SetFont($font_name,'',10);
            $pdf->Cell(23,6,'$' . num_format($row["order_taxtotal"],$round_type),0,0,'R',false); 

            $pdf->ln();
            $pdf->SetY($pdf->GetY());
            $pdf->setx(($w*2)-65);
            $pdf->SetFont($font_name,'B',10);
            $pdf->Cell(20,6,'Total : ',0,0,'R',false);
            $pdf->setx(($w*2)-42);
            $pdf->SetFont($font_name,'B',10);
            $pdf->Cell(23,6,'$' . num_format($row["order_grandtotal"],$round_type),0,0,'R',false); 

            
            
            $offsety1=$pdf->gety();

            //$x=$pdf->GetX();
            $y=$offsety1+15;
            //condition to check if the last line item is printable else will create a new line
            if( ($A4Y-($offsety1+10)) < 20){
                $pdf->AddPage();
                $pdf->sety($yg);
                //$pdf->Line(10,$yg,203,$yg);
                //$pdf->setY($yg);
                $yg = $pdf->GetY();
                //$pdf->SetFont($font_name,'B',10);
                //$pdf->cell(8,4,"No",'','L');
                //$pdf->cell(28,4,"Order",'','L');
                //$pdf->cell(40,4,"Customer",'','','L');	
                //$pdf->cell(22,4,"Date",'','C');

                // Line break
                $pdf->Ln();
                //$ly=$pdf->GetY();
                //$pdf->SetDrawColor(0,0,0);
                //$pdf->SetLineWidth(0);
                //$pdf->Line(10,$ly,203,$ly);

                //$pdf->SetFont($font_name,'',10);
                $pdf->ln();
                $x=$pdf->GetX();
                $y=$pdf->GetY();

                $offsety1=$yg;
            }

            $i++;
        }
    }
    
    $pdf->ln(10);
     
    $pdf->Output("record/Test.pdf",'I');
?>     