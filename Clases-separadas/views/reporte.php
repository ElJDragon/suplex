<?php
include_once '../../fpdf/fpdf.php';
$host="localhost";
$user="root";
$psw="";
$bd="cuarto";

$conn=mysqli_connect($host,$user,$psw,$bd);
if (!$conn) {
    die(json_encode("Error".mysqli_connect_error()));
}
$sql="SELECT * FROM estudiantes";
$rs=$conn->query($sql);

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",12);
$pdf->Cell(108,10,"Estudiantes",1);
$pdf->Ln();
$pdf->Cell(30,10,"Cedula",1);
$pdf->Cell(30,10,"Nombre",1);
$pdf->Cell(30,10,"Apellido",1);
$pdf->Cell(30,10,"Telefono",1);
$pdf->Cell(30,10,"Direccion",1);
$pdf->Ln();
while ($row=$rs->fetch_assoc()) {
    $pdf->Cell(30,10,$row['estCedula'],1);
$pdf->Cell(30,10,$row['estNombre'],1);
$pdf->Cell(30,10,$row['estApellido'],1);
$pdf->Cell(30,10,$row['estTelefono'],1);
$pdf->Cell(30,10,$row['estDireccion'],1);
$pdf->Ln();
}
$pdf->Output();
?>
