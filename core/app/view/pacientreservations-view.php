<section class="content">
<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
</div>
		<h1>Consultas</h1>
<br>
<form class="form-horizontal" role="form">
<input type="hidden" name="view" value="pacientreservations">
        <?php
$pacients = PacientData::getAll();
$medics = MedicData::getAll();
        ?>

  <div class="form-group">
    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-search"></i></span>
		  <input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" class="form-control" placeholder="Palabra clave">
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
    <div class="col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		  <input type="text" name="date_at" value="<?php if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){ echo $_GET["date_at"]; } ?>" class="pickadate form-control" placeholder="Palabra clave">
		</div>
    </div>

    <div class="col-lg-2">
    <button class="btn btn-primary btn-block">Buscar</button>
    </div>

  </div>
</form>

		<?php
$users= array();
if((isset($_GET["q"])  && isset($_GET["medic_id"]) && isset($_GET["date_at"])) && ($_GET["q"]!="" || $_GET["medic_id"]!="" || $_GET["date_at"]!="") ) {
$sql = "select * from reservation where ";
if($_GET["q"]!=""){
	$sql .= " title like '%$_GET[q]%' and note like '%$_GET[q] %' ";
}

if($_SESSION["pacient_id"]!=""){
if($_GET["q"]!=""){
	$sql .= " and ";
}
	$sql .= " pacient_id = ".$_SESSION["pacient_id"];
}

if($_GET["medic_id"]!=""){
if($_GET["q"]!=""||$_GET["pacient_id"]!=""){
	$sql .= " and ";
}

	$sql .= " medic_id = ".$_GET["medic_id"];
}



if($_GET["date_at"]!=""){
if($_GET["q"]!=""||$_GET["pacient_id"]!="" ||$_GET["medic_id"]!="" ){
	$sql .= " and ";
}

	$sql .= " date_at = \"".$_GET["date_at"]."\"";
}

		$users = ReservationData::getBySQL($sql);

}else{
		$users = ReservationData::getAllByPacientId($_SESSION["pacient_id"]);

}
		if(count($users)>0){
			// si hay usuarios
			?>
			<div class="box box-primary">
			<table class="table table-bordered table-hover">
			<thead>
			<th>Asunto</th>
			<th>Paciente</th>
			<th>Medico</th>
			<th>Precio</th>
			<th>Fecha</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
				?>
				<tr>
				<td><?php echo $user->title; ?></td>
				<td><?php echo $pacient->name." ".$pacient->lastname; ?></td>
				<td><?php echo $medic->name." ".$medic->lastname; ?></td>
				<td>$ <?php echo $user->price ; ?></td>
				<td><?php echo $user->date_at." ".$user->time_at; ?></td>
				<td style="width:130px;">
				<a href="index.php?view=openchat&medic_id=<?php echo $medic->id;?>" class="btn btn-info btn-xs">Chat</a>
				<a href="index.php?action=processpayment&id=<?php echo $user->id;?>" class="btn btn-primary btn-xs">Pagar <i class="fa fa-paypal"></i></a>

				<!--
				<a href="index.php?action=delreservation&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
				-->
				</td>
				</tr>
				<?php

			}
			?>
			</table>
			</div>
			<?php
		}else{
			echo "<p class='alert alert-danger'>No hay pacientes</p>";
		}


		?>


	</div>
</div>
</section>