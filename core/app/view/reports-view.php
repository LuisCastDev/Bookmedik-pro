<?php if(!Core::$user->view_reports){ Core::redir("./?view=home"); } ?>
<section class="content">
<div class="row">
	<div class="col-md-12">
<h1>Reportes</h1>
<br>
<form class="form-horizontal" role="form">
<input type="hidden" name="view" value="reports">
        <?php
$pacients = PacientData::getAll();
$medics = MedicData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
        ?>

  <div class="form-group">

    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-male"></i></span>
<select name="pacient_id" class="form-control">
<option value="">PACIENTE</option>
  <?php foreach($pacients as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["pacient_id"]) && $_GET["pacient_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-support"></i></span>
<select name="medic_id" class="form-control">
<option value="">MEDICO</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["medic_id"]) && $_GET["medic_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
    <div class="col-lg-3">
		  <input type="text" name="start_at" value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="pickadate2 form-control" placeholder="Fecha inicio">
    </div>
    <div class="col-lg-3">
		  <input type="text" name="finish_at" value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="pickadate2 form-control" placeholder="Fecha Fin">
    </div>

  </div>
  <div class="form-group">

    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon">ESTADO</span>
<select name="status_id" class="form-control">
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["status_id"]) && $_GET["status_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon">PAGO</span>
<select name="payment_id" class="form-control">
  <?php foreach($payments as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["payment_id"]) && $_GET["payment_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
    <div class="col-lg-6">
    <button class="btn btn-primary btn-block">Procesar</button>
    </div>

  </div>
</form>

		<?php
$users= array();
if((isset($_GET["status_id"]) && isset($_GET["payment_id"]) && isset($_GET["pacient_id"]) && isset($_GET["medic_id"]) && isset($_GET["start_at"]) && isset($_GET["finish_at"]) ) && ($_GET["status_id"]!="" ||$_GET["payment_id"]!="" || $_GET["pacient_id"]!="" || $_GET["medic_id"]!="" || ($_GET["start_at"]!="" && $_GET["finish_at"]!="") ) ) {
$sql = "select * from reservation where ";
if($_GET["status_id"]!=""){
	$sql .= " status_id = ".$_GET["status_id"];
}

if($_GET["payment_id"]!=""){
if($_GET["status_id"]!=""){
	$sql .= " and ";
}
	$sql .= " payment_id = ".$_GET["payment_id"];
}


if($_GET["pacient_id"]!=""){
if($_GET["status_id"]!=""||$_GET["payment_id"]!=""){
	$sql .= " and ";
}
	$sql .= " pacient_id = ".$_GET["pacient_id"];
}

if($_GET["medic_id"]!=""){
if($_GET["status_id"]!=""||$_GET["pacient_id"]!=""||$_GET["payment_id"]!=""){
	$sql .= " and ";
}

	$sql .= " medic_id = ".$_GET["medic_id"];
}



if($_GET["start_at"]!="" && $_GET["finish_at"]){
if($_GET["status_id"]!=""||$_GET["pacient_id"]!="" ||$_GET["medic_id"]!="" ||$_GET["payment_id"]!="" ){
	$sql .= " and ";
}

	$sql .= " ( date_at >= \"".$_GET["start_at"]."\" and date_at <= \"".$_GET["finish_at"]."\" ) ";
}

//echo $sql;
		$users = ReservationData::getBySQL($sql);

}else{
		$users = ReservationData::getAllPendings();

}
		if(count($users)>0){
			// si hay usuarios
			$_SESSION["report_data"] = $users;
			?>
			<div class="panel panel-default">
			<div class="panel-heading">
			<a href="./report/report-xlsx.php" class="btn btn-success btn-xs pull-right"><i class="fa fa-download"></i> Descargar (.xlsx)</a>
			<a href="./report/report-word.php" class="btn btn-info btn-xs pull-right"><i class="fa fa-download"></i> Descargar (.docx)</a>
<a onclick="thePDF()" id="makepdf" class="btn btn-danger btn-xs pull-right" class=""><i class="fa fa-download"></i> Descargar PDF (.pdf)</a>

			Reportes</div>
			<table class="table table-bordered table-hover">
			<thead>
			<th>Asunto</th>
			<th>Paciente</th>
			<th>Medico</th>
			<th>Fecha</th>
			<th>Estado</th>
			<th>Pago</th>
			<th>Costo</th>
			</thead>
			<?php
			$total = 0;
			foreach($users as $user){
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
				?>
				<tr>
				<td><?php echo $user->title; ?></td>
				<td><?php echo $pacient->name." ".$pacient->lastname; ?></td>
				<td><?php echo $medic->name." ".$medic->lastname; ?></td>
				<td><?php echo $user->date_at." ".$user->time_at; ?></td>
				<td><?php echo $user->getStatus()->name; ?></td>
				<td><?php echo $user->getPayment()->name; ?></td>
				<td>$ <?php echo number_format($user->price,2,".",",");?></td>
				</tr>
				<?php
				$total += $user->price;

			}
			echo "</table>";
			?>
			<div class="panel-body">
			<h1>Total: $ <?php echo number_format($total,2,".",",");?></h1>
			</div>




<script type="text/javascript">
        function thePDF() {
var doc = new jsPDF('l', 'pt');
        doc.setFontSize(26);
        doc.text("BOOKMEDIK PRO", 40, 65);
        doc.setFontSize(18);
        doc.text("REPORTE", 40, 80);
        doc.setFontSize(12);
        doc.text("Fecha: <?php echo date("d-m-Y h:i:s");?> ", 40, 90);
var columns = [
    {title: "Id", dataKey: "id"}, 
    {title: "Fecha", dataKey: "date"}, 
    {title: "Hora", dataKey: "time"}, 
    {title: "Asunto", dataKey: "title"}, 
    {title: "Paciente", dataKey: "pacient"}, 
    {title: "Medico", dataKey: "medic"}, 
    {title: "Costo", dataKey: "price"}, 
    {title: "Status", dataKey: "status"}, 
    {title: "Pago", dataKey: "payment"}, 
    {title: "Fecha", dataKey: "created_at"}, 
];
var rows = [
  <?php foreach($users as $product):
				$pacientx  = $product->getPacient();
				$medicx = $product->getMedic();  ?>
    {
      "id": "<?php echo $product->no; ?>",
      "date": "<?php echo $product->date_at; ?>",
      "time": "<?php echo $product->time_at; ?>",
      "title": "<?php echo $product->title; ?>",
      "pacient": "<?php echo $pacientx->name." ".$pacient->lastname; ?>",
      "medic": "<?php echo $medicx->name." ".$medicx->lastname; ?>",
      "price": "$ <?php echo $product->price; ?>",
      "status": "<?php echo $product->getStatus()->name; ?>",
      "payment": "<?php echo $product->getPayment()->name; ?>",
      "created_at": "<?php echo $product->created_at; ?>",
      },
 <?php endforeach; ?>
];
doc.autoTable(columns, rows, {
    theme: 'grid',
    overflow:'linebreak',
    styles: { 
        fillColor: [100, 100, 100]
    },
    columnStyles: {
        id: {fillColor: 255}
    },
    margin: {top: 100},
    afterPageContent: function(data) {
    }
});
doc.setFontSize(12);
doc.text("Generado por el Sistema BookMedik Pro v3.8", 40, doc.autoTableEndPosY()+25);

doc.save('reports-<?php echo date("d-m-Y h:i:s",time()); ?>.pdf');
}
</script>













			<?php




		}else{
			echo "<p class='alert alert-danger'>No hay datos</p>";
		}


		?>


	</div>
</div>
</section>