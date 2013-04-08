<?php
require('../libs/fpdf/fpdf.php');
class PdfAlmacenes extends FPDF{
	function construct(){
		$pdf=$this;
		
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'¡Hola, Mundo!');
		$pdf->Output();
	}
}
?>