<?php
header( 'Content-type: text/plain' );
include 'config.php';
$id = $_GET['id'];
$qry=mysqli_query($config,"SELECT * FROM salesid WHERE id='$id'");
$row=mysqli_fetch_assoc($qry);
$customer=$row['customer'];
$date=$row['salesdate'];
$totalcost=$row['salesamount'];
//find payments
$pmtqry=mysqli_query($config,"SELECT * FROM payments WHERE salesid='$id'");
$pmtrow=mysqli_fetch_assoc($pmtqry);
$paid=$pmtrow['amountpaid'];
$balance=$pmtrow['balance'];
if($balance>0){
    $title='INVOICE';
}else{
    $title="RECEIPT";
}
require( 'fpdf/fpdf.php' );
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont( 'Arial', 'B', 15 );
//title of the document
$pdf->Ln(26);
$pdf->Cell(10,6,'Macra Systems,',0,0,L);
//$pdf->Ln(6);
//$pdf->SetFont( 'Arial', 'B', 15 );
//$pdf->Cell(10,6,'P.O Box 98-10111',0,0,L);
$pdf->Ln(6);
$pdf->Cell(10,6,'Nairobi.',0,0,L);
$pdf->Ln(6);
$pdf->Cell(10,6,'Phone: 0708 138498',0,0,L);
$pdf->Ln(6);
$pdf->Cell(100,6,$title,0,0,R);
$pdf->Ln(10);
//about what we do
//$pdf->SetFont('Arial','i',8);
//$pdf->Cell(180,6,'Dealers in: Textbooks,chalks,geometrical sets,',0,0,R);
//$pdf->Ln(4);
//$pdf->Cell(180,6,'Exercise books,photocopying and phones.',0,0,R);
//$pdf->Ln(6);
//exit what we do
$pdf->SetFont( 'Arial', '', 12 );
$pdf->Cell(10,5,'Receipt No: '.$id,0,0,L);
$pdf->Ln(6);
$pdf->Cell(10,6,'Customer Name: '.$customer,0,0,L);
$pdf->Ln(6);
$pdf->Cell(10,6, 'Date: '.$date,0,0,L);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(60,6,'Item',1,0,L);
$pdf->Cell(40,6,'Unit Cost',1,0,L);
$pdf->Cell(40,6,'Quantity',1,0,L);
$pdf->Cell(40,6,'Cost (Ksh.)',1,0,L);
$pdf->SetFont( 'Arial', '', 12 );
$pdf->Ln(6);
//find individual items sold
$sqry=mysqli_query($config,"SELECT * FROM sales WHERE salesid='$id'");
while($srow=mysqli_fetch_assoc($sqry)){
    $pdf->Cell(60,6,$srow['itemname'],1,0,L);
    $pdf->Cell(40,6,number_format($srow['unitcost'],2),1,0,R);
    $pdf->Cell(40,6,$srow['quantity'],1,0,L);
    $pdf->Cell(40,6,number_format($srow['totalcost'],2),1,0,R);
    $pdf->Ln(6);
}
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->Cell(60,6,'',0,0,L);
    $pdf->Cell(40,6,'',0,0,L);
    $pdf->Cell(40,6,'Total Payable',1,0,L);
    $pdf->Cell(40,6,number_format($totalcost,2),1,0,R);
    $pdf->Ln(6);
    $pdf->Cell(60,6,'',0,0,L);
    $pdf->Cell(40,6,' ',0,0,L);
    $pdf->Cell(40,6,'Amount Paid',1,0,L);
    $pdf->Cell(40,6,number_format($paid,2),1,0,R);
    $pdf->Ln(6);
    $pdf->Cell(60,6,'',0,0,L);
    $pdf->Cell(40,6,' ',0,0,L);
    $pdf->Cell(40,6,'Balance',1,0,L);
    $pdf->Cell(40,6,number_format($balance,2),1,0,R);
$pdf->Ln(10);
$pdf->Cell(140,6,'Goods once sold are not re-accepted',0,0,R);
$pdf->Output( 'D', 'Receipt'.$id.'.pdf', false );
//header( 'location:invoices.php' );
?>