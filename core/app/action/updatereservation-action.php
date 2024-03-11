
<?php
	header('Content-Type: text/html; charset=utf-8');

	require('/xampp/htdocs/Bookmedik-pro/fpdf/fpdf.php');
	

	$pdf = new FPDF('P', 'mm', 'A5');
	$pdf->AddPage('L',array(127, 203.5));
	$pdf->SetFont('Arial', '', 8);
	$pdf->SetMargins(20,15,5);
	
	#mostrar edad del paciente.

	$pacient = PacientData::getById($_POST["pacient_id"]);
	$fecha_nacimiento = $pacient->day_of_birth;
	$fecha_nacimiento_dt = new DateTime($fecha_nacimiento);
	$fecha_actual = new DateTime();
	$diferencia = $fecha_actual->diff($fecha_nacimiento_dt);
	$esMes = false;
	$edad = $diferencia->y;
	if ($diferencia->y <=0) {
		$edad= $diferencia->m;
		$esMes = true;
	}
	
	$pdf->SetAutoPageBreak(false);


	


	
	$medicaments = json_decode($_POST["medicaments"],true);
	
	
	
	$x2 = $pdf->GetX();
	$y2 = $pdf->GetY();
	
	$x = $pdf->GetX();
	$y = $pdf->GetY();
	$pdf->SetXY($x +10,$y );
	$totalElementos = count($medicaments);
	$contador = 0;
	foreach ($medicaments as $medicacion){
// Tu texto largo
$textoLargo = utf8_decode("* ") . str_replace(["\r\n", "\r", "\n"], "\n", $medicacion);
$contador++;
$lineas =0;
$limiteCaracteres = 70;

// Posición inicial


// Dividir el texto en celdas
for ($i = 0; $i < strlen($textoLargo); $i += $limiteCaracteres) {
    
	// Obtener la parte del texto que cabe en la celda
    $parteTexto = substr($textoLargo, $i, $limiteCaracteres);
	
	
    // Agregar la parte del texto a la celda
    $pdf->Cell(18, 74,utf8_decode($parteTexto));

    // Mover a la siguiente posición
    $pdf->SetXY(18,$y + 4);

    // Actualizar la posición
    $x = $pdf->GetX();
    $y = $pdf->GetY();

	if($contador==$totalElementos){
		$pdf->SetXY($x2,$y2);
		$pdf->Cell(10,180 ,preg_replace('/[\d-]/', '',$pacient->name." ". $pacient->lastname ));
		if($esMes){
			$pdf->Cell(12,190 ,$edad.utf8_decode(" meses                                ").$_POST["date"]);
	}
	else {
		$pdf->Cell(12,190 ,$edad.utf8_decode(" años                                  ").$_POST["date"]);
	}
	}
}


}


$pdf_path = 'documento.pdf';
$pdf->Output('F', $pdf_path);
?>

<script>

async function abrirPDF() {
    var pdfURL = "<?php echo $pdf_path; ?>";
    await window.open(pdfURL, '_blank');
}


window.onload = async function() {
    await abrirPDF();
	await abrirCRUD()
};

function abrirCRUD(){
  window.location='index.php?view=medicreservations';
}



</script>







<?php


if(count($_POST)>0){
	$user = ReservationData::getById($_POST["id"]);
	$user->no = $_POST["no"];
	$user->title = $_POST["title"];
	$user->pacient_id = $_POST["pacient_id"];
	$user->medic_id = $_POST["medic_id"];
	$user->date_at = $_POST["date_at"];
	$user->time_at = $_POST["time_at"];
	$user->note = $_POST["note"];

	$user->status_id = $_POST["status_id"];
	$user->payment_id = $_POST["payment_id"];
	$user->price = $_POST["price"];
	$user->sick = $_POST["sick"];
	$user->symtoms = $_POST["symtoms"];
	$user->medicaments = preg_replace('/"/', '', $_POST["medicaments"]);
	//$user->record = $_POST["record"];
	$user->update();

Core::alert("Actualizado exitosamente!");

if(isset($_SESSION["medic_id"])){

// print "<script>window.location='index.php?view=medicreservations';</script>";



}else if(isset($_SESSION["user_id"])){
// print "<script>window.location='index.php?view=reservations';</script>";

}



}


?>


