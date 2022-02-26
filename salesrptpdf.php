<?php
header( 'Content-type: text/plain' );
include 'config.php';
$sdate = $_GET['sdate'];
$edate=$_GET['edate'];
$extract=explode('-',$edate);
$extracteddate=$extract[2]-1;
$exactdate=$extract[0].'-'.$extract[1].'-'.$extracteddate;
$sqry=mysqli_query($config,"SELECT * FROM salesid WHERE salesdate>='$sdate' AND salesdate<'$edate'");
require( 'fpdf/fpdf.php' );
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont( 'Arial', 'B', 15 );
//title of the document
$pdf->Ln(26);
$pdf->Cell(10,6,'Macra Systems',0,0,L);
//$pdf->Ln(6);
//$pdf->SetFont( 'Arial', 'B', 15 );
//$pdf->Cell(10,6,'P.O Box 98-10111',0,0,L);

$pdf->Ln(6);
$pdf->Cell(10,6,'Nairobi',0,0,L);
$pdf->Ln(6);
$pdf->Cell(10,6,'Phone: 0708 138498',0,0,L);
$pdf->Ln(6);
$pdf->Cell(100,6,'Sales Report',0,0,R);
$pdf->Ln(10);

$pdf->SetFont( 'Arial', '', 12 );

$pdf->Ln(6);
$pdf->Cell(10,6, 'Date: From '.$sdate.' To: '.$exactdate,0,0,L);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,6,'Item',1,0,L);
$pdf->Cell(30,6,'Unit Cost',1,0,L);
$pdf->Cell(30,6,'Quantity',1,0,L);
$pdf->Cell(30,6,'Cost (Ksh.)',1,0,L);
$pdf->Cell(30,6,'Margin (Ksh.)',1,0,L);
$pdf->SetFont( 'Arial', '', 12 );
$pdf->Ln(6);
$pdf->SetFont('Arial','',12);
//Sales Report here
$totalsalesamount=0;
$totalmargin=0;
while($srow=mysqli_fetch_assoc($sqry)){
    $sid=$srow['id'];
    //find individual items sold
    $salesqry=mysqli_query($config,"SELECT * FROM sales WHERE salesid='$sid'");
    while($salesrow=mysqli_fetch_assoc($salesqry)){
        $itemname=$salesrow['itemname'];
        //find item on list to determine margin
        $itmqry=mysqli_query($config,"SELECT * FROM items WHERE itemname='$itemname'");
        $itmrow=mysqli_fetch_assoc($itmqry);
        $buyingprice=$itmrow['buyingprice'];
        $singlemargin=$salesrow['unitcost']-$buyingprice;
        $margin=$singlemargin*$salesrow['quantity'];
        $pdf->Cell(60,6,$salesrow['itemname'],1,0,L);
        $pdf->Cell(30,6,$salesrow['unitcost'],1,0,L);
        $pdf->Cell(30,6,$salesrow['quantity'],1,0,L);
        $pdf->Cell(30,6,number_format($salesrow['totalcost'],2),1,0,R);
        $pdf->Cell(30,6,number_format($margin,2),1,0,R);
        $pdf->Ln(6);
        $totalmargin=$totalmargin+$margin;
    }
   $totalsalesamount=$totalsalesamount+$srow['salesamount'];
}
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,6,'',0,0,L);
$pdf->Cell(30,6,'',0,0,L);
$pdf->Cell(30,6,'Total',1,0,L);
$pdf->Cell(30,6,number_format($totalsalesamount,2),1,0,R);
$pdf->Cell(30,6,number_format($totalmargin,2),1,0,R);
$attendantfee=$totalmargin*0.3;
$pdf->Ln(10);
$pdf->SetFont('Arial','i',10);
$pdf->Cell(60,6,'Attendant Fee: Ksh.'.number_format($attendantfee,2),0,0,L);
$pdf->Output( 'D', 'Sales Report '.$sdate.'_'.$exactdate.'.pdf', false );
//header( 'location:invoices.php' );
?>