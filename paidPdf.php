<?php
session_start();

include "lib/config.php";

    if(isset($_POST['btn-print-newcommer1']))
    {
        include 'pdf/fpdf.php';

        class PDF extends FPDF
        {
        // Page header
            function Header()
            {
                // Logo
                $this->Image('assets/img/icon2.png',10,6,20);
                // Arial bold 15
                $this->SetFont('Arial','B',15);
            

                // Move to the right
                $this->Cell(50);
                // Title
                $this->Cell(100,10,'Right Goods Philippines Inc.',1,0,'C');
                // Line break
                $this->Ln(20);

                //Put the watermark
                $this->SetFont('Arial','B',35);
                $this->SetTextColor(230, 238, 255);
                $this->RotatedText(45,220,'RIGHT GOODS PHILIPPINES INC.',45);
            }

                function RotatedText($x, $y, $txt, $angle)
                {
                //Text rotated around its origin
                $this->Rotate($angle,$x,$y);
                $this->Text($x,$y,$txt);
                $this->Rotate(0);
    
                }
            // Page footer
            function Footer()
            {
                // Position at 1.5 cm from bottom
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial','I',8);
                // Page number
                $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
            }
            
                                                //Cell with horizontal scaling if text is too wide
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max(strlen($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }

        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }
            
                //Cell with horizontal scaling only if necessary
                function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
                {
                    $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
                }
        }
        // Instanciation of inherited class
        $pdf = new PDF('P','mm','A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',12); 

        //DEFINE A VARIABLE
        $title = 'RIGHT GOODS PHILIPPINE INC.';
        $fontsize = 12;
        $tempfontsize = $fontsize;


        $pdf->SetTitle($title);
    
        /****** TIMEZONE AND DATE ********/
        date_default_timezone_set('Asia/Manila');
        $date = date('F d, Y');

        //CELL(width, height, text, border, endLine, [align])
        $pdf->Cell(130, 5, 'RIGHT GOODS PHILIPPINES INC.',0,0);
        $pdf->Cell(59, 5, 'RECEIPT',0,1);

        $pdf->Ln(5);  
        
        $pdf->Cell(130, 5, 'STMI Compound Brgy. Lawa Calamba',0,0);
        //$pdf->Cell(59, 5, '',0,1);
        $pdf->Cell(15, 5, 'Date:',0,0);
        $pdf->Cell(44, 5,$date,0,1,'R');

        $pdf->Cell(130, 5, 'Brgy. Lawa Calamba City',0,0);
        $pdf->Cell(15, 5, '',0,0);
        $pdf->Cell(44, 5,'',0,1,'R');

        $pdf->Cell(130, 5, '[63 49 545-5585]',0,0);
        $pdf->Cell(26, 5, '',0,0);
        $pdf->Cell(33, 5,' ',0,1,'R');

        $pdf->Ln(10);        
        
        $sql = "SELECT * FROM tbl_newcommer WHERE status = 'pending'";
        $query_run = mysqli_query($conn,$sql);

        $pdf->SetLeftMargin(15);

        if (mysqli_num_rows($query_run) > 0) 
        {
            $pdf->SetFont('Arial','B',12);
            $cellwidth = 70;
            
                $pdf->Cell('70','10','Company Name', '1','0','C');
                $pdf->Cell('30','10','Email', '1','0','C');
                $pdf->Cell('30','10','Business Permit', '1','0','C');
                $pdf->Cell('30','10','Tin ID', '1','1','C');
                
            while($dlpdf = mysqli_fetch_assoc($query_run))
            {   $pdf->SetFont('Arial','',12);
                
                //RESIZE THE FONTSIZE
                while($pdf->GetStringWidth($dlpdf['newcommer_company']) > $cellwidth)
                {
                    $pdf->SetFontSize($tempfontsize -= 0.1);
                }
                 
                $pdf->Cell($cellwidth,'7',$dlpdf['newcommer_company'],'1','0', 'L');

                $pdf->Cell('10','7', $dlpdf['newcommer_email'] , '1','0','C');
                $pdf->Cell('15','7', $dlpdf['newcommer_tinNumber'] , '1','0','C');
                $pdf->Cell('18','7', $dlpdf['newcommer_businessPermit'] , '1','1','C');

            }
        }
            $pdf->SetFont('Arial','B',12);
            

            $pdf->SetTextColor(0,0,0);

            $pdf->Output();
    }// END OF DLPDF
     if (isset($_POST['btn-print-paid'])) 
     {
         
        include "lib/config.php";//connection to database
        include 'pdf/fpdf.php';
        class PDF extends FPDF
        {
        // Page header
            function Header()
            {
                // Logo
                $this->Image('assets/img/icon2.png',10,6,20);
                // Arial bold 15
                $this->SetFont('Arial','B',15);
            

                // Move to the right
                $this->Cell(50);
                // Title
                $this->Cell(100,10,'Right Goods Philippines Inc.',1,0,'C');
                // Line break
                $this->Ln(20);

                //Put the watermark
                $this->SetFont('Arial','B',35);
                $this->SetTextColor(230, 238, 255);
                $this->RotatedText(45,220,'RIGHT GOODS PHILIPPINES INC.',45);
            }

                function RotatedText($x, $y, $txt, $angle)
                {
                //Text rotated around its origin
                $this->Rotate($angle,$x,$y);
                $this->Text($x,$y,$txt);
                $this->Rotate(0);
    
                }
            
            // Page footer
            function Footer()
            {
                // Position at 1.5 cm from bottom
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial','I',8);
                // Page number
                $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
            }
            
                                                //Cell with horizontal scaling if text is too wide
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max(strlen($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }

        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }
            
                //Cell with horizontal scaling only if necessary
                function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
                {
                    $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
                }
        }
 

        // Instanciation of inherited class
        $pdf = new PDF('P','mm','A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',12); 

        //DEFINE A VARIABLE
        $title = 'RIGHT GOODS PHILIPPINE INC.';
        $fontsize = 12;
        $tempfontsize = $fontsize;


        $pdf->SetTitle($title);

        /****** TIMEZONE AND DATE ********/
        date_default_timezone_set('Asia/Manila');
        $date = date('F d, Y');

        //CELL(width, height, text, border, endLine, [align])
        $pdf->Cell(130, 5, 'RIGHT GOODS PHILIPPINES INC.',0,0);
        $pdf->Cell(59, 5, 'PAID TRANSACTION',0,1);

        $pdf->Ln(5);  
        
        $pdf->Cell(130, 5, 'STMI Compound Brgy. Lawa Calamba',0,0);
        //$pdf->Cell(59, 5, '',0,1);
        $pdf->Cell(15, 5, 'Date:',0,0);
        $pdf->Cell(44, 5,$date,0,1,'R');

        $pdf->Cell(130, 5, 'Brgy. Lawa Calamba City',0,0);
        $pdf->Cell(15, 5, '',0,0);
        $pdf->Cell(44, 5,'',0,1,'R');

        $pdf->Cell(130, 5, '[63 49 545-5585]',0,0);
        $pdf->Cell(26, 5, '',0,0);
        $pdf->Cell(33, 5,' ',0,1,'R');

        $pdf->Ln(10); 
        
        $width_cell=array(30.5,30.5,30.5,30.5,30.5,30.5);
        
        //Background color of header//
        $pdf->SetFillColor(193,229,252);
        
        // Header starts /// 
        //First header column //

        $pdf->Cell($width_cell[2],10,'Account Name',1,0,'C',true); 
        $pdf->Cell($width_cell[0],10,'Invoice No.',1,0,'C',true);
        $pdf->Cell($width_cell[1],10,'KAE',1,0,'C',true);
        //Second header column//
        $pdf->Cell($width_cell[1],10,'Username',1,0,'C',true);
        //Third header column//
        
        $pdf->Cell($width_cell[3],10,'Date Paid',1,0,'C',true);
        $pdf->Cell($width_cell[4],10,'Amount',1,1,'C',true);

        $pdf->SetFont('Arial','',14);
        //Background color of header//
        $pdf->SetFillColor(235,236,236); 
        //to give alternate background fill color to rows// 
        $fill=false;
        
        //SQL to get 10 records
        $sql="SELECT invoice.invoiceNo,invoice.kaeName, invoice.invoiceUsername, invoice.invoiceCompany, invoice.datePaid, SUM(cartorder.productTotal) AS 'Total_Balance' FROM cartorder LEFT JOIN invoice ON invoice.invoiceNo = cartorder.invoiceNo WHERE invoice.status = 'paid' and invoice.archive = 'NO' GROUP BY invoice.invoiceNo";

        
        $cellwidth = 30.5;
        $total = 0.00;
        $subTotal = 0.12;
        $result = 0.00;
        $grandTotal = 0.00;

        /// each record is one row  ///
        foreach ($conn->query($sql) as $row) {
        $pdf->SetFont('Arial','',12);

         
        $result = $row['Total_Balance'] * $subTotal;
        $grandTotal = $row['Total_Balance'] + $result;
        
        $pdf->CellFitScale('30.5','7',$row['invoiceCompany'],1,0,'C',$fill);
        
       
        $pdf->CellFitScale('30.5','7',$row['invoiceNo'],'1','0', 'C');
        $pdf->CellFitScale('30.5','7',$row['kaeName'],'1','0', 'C');
        $pdf->CellFitScale('30.5','7',$row['invoiceUsername'],1,0,'C',$fill);
        $pdf->CellFitScale('30.5','7',$row['datePaid'],1,0,'C',$fill);
        $pdf->CellFitScale('30.5','7',number_format($grandTotal,2),1,1,'C',$fill);

        //to give alternate background fill  color to rows//
        $fill = !$fill;

        }
        /// end of records /// 
        
        
        $pdf->Output();

     }

?>
