<?php
require('fpdf.php');
include('inc/header.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Move to the right
    $this->Cell(276,5,'PURCHASE DETAILS',0,0,'C');
    // Title
    // Line break
    $this->Ln();
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
function headerTable(){
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM buy WHERE userid='$user_id'";
    $result = dbquery($sql);

    $this->SetFont('Arial','I',12);
    $this->Cell(40,10,'Brand',1,0,'C');
    $this->Cell(40,10,'Model',1,0,'C');
    $this->Cell(70,10,'Price',1,0,'C');
    $this->Cell(60,10,'Reg/no',1,0,'C');
    $this->Cell(30,10,'Date',1,0,'C');
    while ($row = fetch_data($result)) {
        $this->Cell(40,10, $row["brand"] ,3,0,'C');
    $this->Cell(40,10,$row["model"],3,0,'C');
    $this->Cell(70,10,$row["price"],3,0,'C');
    $this->Cell(60,10,$row["checkno"],3,0,'C');
    $this->Cell(30,10,time(),3,0,'C');
    }
    $this->Ln();
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->headerTable();
$pdf->Output();
?>