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

    /*$sql = "SELECT o.*,pr.partner_name as customer_name,pr.partner_name_cn,pr.partner_code as customer_code,
            e.empl_name as salesperson,e.empl_email as empl_email,
            g.group_desc,cr.currency_code as currency_code
        FROM db_order o
            INNER JOIN db_partner pr ON pr.partner_id = o.order_customer
            LEFT JOIN db_empl e ON e.empl_id = o.order_salesperson
            LEFT JOIN db_group g ON e.empl_group = g.group_id
            LEFT JOIN db_currency cr ON cr.currency_id = o.order_currency
        WHERE o.order_id > 0 AND order_id = '$report_id'";*/
      /*  $sql = "SELECT *
              FROM db_order o
              WHERE o.order_id > 0 AND order_id = '$report_id'";*/
        $sql = "SELECT o.*,pr.partner_name as customer_name
                FROM db_order o
                INNER JOIN db_partner pr ON pr.partner_id = o.order_customer
                WHERE o.order_id > 0 AND order_id = '$report_id'";
    $data_field_type = "order";
    $data_field_line_type = "ordl";
    $query = mysql_query($sql);

  /*  if (!$query) {
      die('Invalid query: ' . mysql_error());
    }*/

    if($row = mysql_fetch_array($query)){
        if($row['order_revtimes'] > 0){
            $row['order_no'] = $row['order_no'] . " (Rev {$row['order_revtimes']})";
        }
        $data = $row;
    }
    $test_data = date('d/m/Y',strtotime($data['order_date']));

  // echo '<pre>';
  // print_r($data);
  // die();

    class PDF extends TCPDF
    {
        // Page header
        public function Header()
        {
            global $data,$com_info,$report_name,$report_draft,$data_field_type,$font_name,$pdf,$document_no,$action,$order_no;

            // Company Name
            $this->SetFont($font_name,'B',16);
            $this->sety($Y+5);
          //  $this->setX($this->getX() - 10);
            $this->setX(13);
            //$x = $this->getX();
        //    $this->Cell(1,4,htmlspecialchars_decode($com_info['cprofile_name']),0,1,'C');
            $this->Cell(1,4,htmlspecialchars_decode($com_info['cprofile_name']),0,1,'L');
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
            $this->Cell(2,4,"Company Registration No : " . $com_info['cprofile_business_no'],0,1,'L');
            $this->sety($this->gety());


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
            $this->Cell(0,10,$data["{$data_field_type}_no"],0,0,'L');
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

    $pdf->setY(35);
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
    $pdf->multicell(90,5,'M/S:',0,'L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(90,5,htmlspecialchars_decode($data['customer_name']),0,'L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(90,5,htmlspecialchars_decode($data['order_billaddress']),0,'L');
  //  $yy = $pdf->getY();
  //  $pdf->setY($yy+10);
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'',10);
    $pdf->multicell(90,5,'Atn:',0,'L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(90,5,htmlspecialchars_decode($data['order_attentionto_name']),0,'L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(90,5,htmlspecialchars_decode($data['order_attentionto_phone']),0,'L');

    //insert here

    $y = $pdf->getY();
    $pdf->setY($yy+10);
    $y=$pdf->gety();
    $pdf->setX(105);
    $x = $pdf->getX();
    $pdf->SetFont($font_name,'',10);
    $pdf->multicell(90,5,'Ref No: SKS/SR',0,'L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx(105);
    $pdf->SetFont($font_name,'B',10);
    //$pdf->multicell(90,5,htmlspecialchars_deco{de($data['order_attentionto_name']),'LR','L');
    $pdf->multicell(90,5,"Date: {$test_data}",0,'L');
    $pdf->setY($pdf->gety());

  /*  $yy = $pdf->getY();
    $pdf->setY($yy+10);
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'',10);
  //  $pdf->multicell(90,5,'M/S:','TLR','L');
    $pdf->multicell(90,5,'Atn:',0,'L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'B',10);
  //  $pdf->multicell(90,5,htmlspecialchars_decode($data['order_attentionto_name']),'LR','L');
  //  $pdf->multicell(90,5,htmlspecialchars_decode($data['customer_name']),'LR','L');
    $pdf->multicell(90,5,htmlspecialchars_decode($data['order_attentionto_name']),0,'L');
    $pdf->setY($pdf->gety());
    $y=$pdf->gety();
    $pdf->setx($pdf->getx()-5);
    $pdf->SetFont($font_name,'B',10);
    $pdf->multicell(90,5,htmlspecialchars_decode($data['order_attentionto_phone']),0,'L');*/





    $pdf->setY($y+50);
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




    $pdf->ln(5);
    $y = $pdf->gety();

    $pdf->SetY($y+20);
    $pdf->setx(10);
    $pdf->multicell(70,5,'','B','TL');

    $pdf->SetY($y+20);
    $pdf->setx(-89);
    $pdf->multicell(70,5,'','B','TL');

    $pdf->ln(5);
    $pdf->SetY($y+30);
    $pdf->setx(20);
    $pdf->multicell(90,5,'Company or Vessel Stamp',0,'TL');


   $pdf->ln(5);
   $pdf->SetY($y+30);
  //  $pdf->sety(90);
    $pdf->setx(-70);
    $pdf->multicell(90,5,'Issue By',0,'TL');


  //  $pdf->ln(5);
  /*  $y = $pdf->gety();
    //$pdf->SetY($y+20);
    $pdf->setx(-89);
    $pdf->multicell(70,5,'','B','TL');
    $pdf->ln(5);
    $pdf->setx(-89);
    $pdf->multicell(90,5,'Company or Vessel Stamp',0,'TL');*/

    //$pdf->SetY($y);
    //$pdf->setx(-90);
    //$pdf->multicell(90,5,strtoupper($com_info['cprofile_name']),0,'TL');

  /*  $pdf->ln(5);
    $y = $pdf->gety();
    $pdf->SetY($y+10);
    $pdf->setx(-89);
    $pdf->multicell(70,5,'','B','TL');*/

    $pdf->Output("record/Test.pdf",'I');
?>
