<?php
require('/xampp/htdocs/Bookmedik-pro/fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(300, 60, $_POST["medicaments"]);

$pdfContent = $pdf->Output('', 'S');

$html = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impresión del PDF</title>
</head>
<body>
    <script>
        // Función para abrir una nueva ventana con el cuadro de diálogo de impresión
        function imprimirPDF() {
            var ventanaImpresion = window.open('', '_blank');
            ventanaImpresion.document.write('<html><head><title>Imprimir PDF</title></head><body>');
            ventanaImpresion.document.write('<embed width="100%" height="100%" type="application/pdf" src="data:application/pdf;base64,' + btoa('{$pdfContent}') + '">');
            ventanaImpresion.document.write('</body></html>');
            ventanaImpresion.document.close();
            ventanaImpresion.print();
        }

        // Llamar a la función para abrir la nueva ventana con el cuadro de diálogo de impresión
        imprimirPDF();
    </script>
</body>
</html>
HTML;

// Imprimir el contenido HTML
echo $html;
?>
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
	$user->medicaments = $_POST["medicaments"];

	$user->update();

Core::alert("Actualizado exitosamente!");

if(isset($_SESSION["medic_id"])){
print "<script>window.location='index.php?view=medicreservations';</script>";

}else if(isset($_SESSION["user_id"])){
print "<script>window.location='index.php?view=reservations';</script>";

}



}


?>


