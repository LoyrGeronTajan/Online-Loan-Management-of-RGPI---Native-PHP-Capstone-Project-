
<?php
session_start();

include "lib/config.php";

    if(isset($_POST['dlPdf']))
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
        
        /****** COMPANY INFORMATION ********/
        $sql_date = "SELECT * FROM cartorder WHERE status = 0 AND username = '".$_SESSION['username']."'";
        $query_run = mysqli_query($conn,$sql_date);

        
        /****** Invoice No *******/
        $invoice_query = "SELECT * from invoice WHERE invoiceUsername = '".$_SESSION['username']."'  ORDER BY invoiceId desc limit 1";
        $invoice_query_run = mysqli_query($conn,$invoice_query);
        $invoice = mysqli_fetch_assoc($invoice_query_run);

        
        /****** TIMEZONE AND DATE ********/
        date_default_timezone_set('Asia/Manila');
        $date = date('F d, Y');

        //CELL(width, height, text, border, endLine, [align])
        $pdf->Cell(130, 5, 'RIGHT GOODS PHILIPPINES INC.',0,0);
        $pdf->Cell(59, 5, 'RECEIPT',0,1);

        $pdf->Ln(5);  
        
        $pdf->Cell(130, 5, 'STMI Compound Brgy. Lawa Calamba',0,0);
        //$pdf->Cell(59, 5, '',0,1);
        $pdf->Cell(15, 5, 'Invoice No:',0,0);
        $pdf->Cell(40, 5,$invoice['invoiceNo'],0,1,'R');

        $pdf->Cell(130, 5, 'Brgy. Lawa Calamba City',0,0);
        $pdf->Cell(15, 5, 'Date:',0,0);
        $pdf->Cell(44, 5,$date,0,1,'R');

        $pdf->Cell(130, 5, '[63 49 545-5585]',0,0);
        $pdf->Cell(26, 5, 'Username:',0,0);
        $pdf->Cell(33, 5, $_SESSION['username'],0,1,'R');

        /****** CUSTOMER COMPANY INFORMATION ********/
        $sql_customer = "SELECT * FROM tbl_member WHERE username = '".$_SESSION['username']."'";
        $query_run = mysqli_query($conn,$sql_customer);
        $customer = mysqli_fetch_assoc($query_run);

        //EMPTY VERTICAL CELL
        $pdf->Cell(189, 10, '',0,1);

        $pdf->SetFont('Arial','b',12);

        $pdf->Cell(189, 10, 'BILL TO :',0,1);
        
        $pdf->Cell(189, 5, '      ' . 'COMPANY NAME                      : ' . $customer['company'],0,1);


        $pdf->Cell(189, 5,'      ' . 'CUSTOMER FULLNAME           : '. $customer['fullname'],0,1);


        $pdf->Cell(189, 5,'      ' . 'COMPANY ADDRESS               : '. $customer['address'],0,1);


        $pdf->Cell(189, 5,'      ' . 'CONTACT NUMBER                  : '. $customer['phone'],0,1);


        $pdf->Cell(189, 5,'      ' . 'COMPANY EMAIL ADDRESS   : '. $customer['email'],0,1); 

        $pdf->Ln(10);        
        
        $sql = "SELECT * FROM cartorder WHERE status = 1 AND username = '".$_SESSION['username']."'";
        $query_run = mysqli_query($conn,$sql);

        $pdf->SetLeftMargin(15);

      
        if (mysqli_num_rows($query_run) > 0) 
        {
            $total = 0.00;
            $subTotal = 0.12;
            $result = 0.00;
            $grandTotal = 0.00;

            $pdf->SetFont('Arial','B',12);
            $cellwidth = 140;
            
            $pdf->Cell('140','10','Product Description', '1','0','C');
                $pdf->Cell('10','10','QTY', '1','0','C');
                $pdf->Cell('15','10','Price', '1','0','C');
                $pdf->Cell('18','10','Total', '1','1','C');
                
            while($dlpdf = mysqli_fetch_assoc($query_run))
            {   $pdf->SetFont('Arial','',12);
                
                //RESIZE THE FONTSIZE
                while($pdf->GetStringWidth($dlpdf['order_productname']) > $cellwidth)
                {
                    $pdf->SetFontSize($tempfontsize -= 0.1);
                }
                 
                $pdf->Cell($cellwidth,'7',$dlpdf['order_productname'],'1','0', 'L');

                $pdf->Cell('10','7',  $dlpdf['order_productqty'], '1','0','C');
                $pdf->Cell('15','7', number_format($dlpdf['order_productprice'],2), '1','0','C');
                $pdf->Cell('18','7',number_format($dlpdf['productTotal'],2) , '1','1','C');
                $total += $dlpdf['productTotal'];
               
                        $result = $total * $subTotal;
                        $grandTotal = $total + $result;
            }
        }
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell('140','6.5','SUB TOTAL :', '1','0','R');
            $pdf->Cell('43','6.5',number_format($total,2), '1','1','R');
            $pdf->Cell('140','6.5','12% VAT :', '1','0','R');
            $pdf->Cell('43','6.5',number_format($result,2) , '1','1','R');

            $pdf->SetTextColor(194,8,8);

            $pdf->Cell('140','6.5','GRAND TOTAL :', '1','0','R');
            $pdf->Cell('43','6.5',number_format($grandTotal,2), '1','1','R');

            $pdf->SetTextColor(0,0,0);

            $pdf->Output();
    }
    

?>


