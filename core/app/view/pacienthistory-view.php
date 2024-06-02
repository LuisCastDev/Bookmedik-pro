<section class="content">
<?php
$pacient = PacientData::getById($_GET["id"]);
?>
<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
<!--<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
  </ul>
</div>
-->
</div>
		<h1>Historial de Citas del Paciente</h1>
<h4>Paciente: <?php echo $pacient->name." ".$pacient->lastname;?></h4>

<div class="container mt-5 ">
  <form class="form-horizontal">
    <div class="form-group">
      <div class="col-md-3">
        <label for="nombre" class="col-lg-8 control-label">Nombre:</label>
      </div>
      <div class="col-md-3">
        <input type="text" class="form-control" id="nombre" value="<?php echo $pacient->name." ".$pacient->lastname;?>" readonly>
      </div>
      <div class="col-md-3">
        <label for="email" class="col-lg-8 control-label">Email:</label>
      </div>
      <div class="col-md-3">
        <input type="email" class="form-control" id="email" value="<?php echo !empty($pacient->email)? $pacient->email : 'email@ejemplo.com';?>" readonly>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-3">
        <label for="nombre" class="col-lg-8 control-label">Sexo:</label>
      </div>
      <div class="col-md-3">
        <input type="text" class="form-control" id="nombre" value="<?php echo $pacient->gender == 'h' ? 'Masculino':'Femenino';?>" readonly>
      </div>
      <div class="col-md-3">
        <label for="email" class="col-lg-8 control-label">Fecha de Nacimiento:</label>
      </div>
      <div class="col-md-3">
        <input type="email" class="form-control" id="email" value="<?php echo $pacient->day_of_birth;?>" readonly>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-3">
        <label for="nombre" class="col-lg-8 control-label">Documento de Identidad:</label>
      </div>
      <div class="col-md-3">
        <input type="text" class="form-control" id="nombre" value="<?php echo $pacient->no;?>" readonly>
      </div>
      <div class="col-md-3">
        <label for="nombre" class="col-lg-8 control-label">Seguro Medico:</label>
      </div>
      <div class="col-md-3">
        <input type="text" class="form-control" id="email" value="<?php echo $pacient->Medical_Insurance;?>" readonly>
      </div>
    </div>
    <div class="form-group mt-3">
      <div class="col-md-3">
        <label for="telefono" class="col-lg-8 control-label">Teléfono:</label>
      </div>
      <div class="col-md-3">
        <input type="tel" class="form-control" id="telefono" value="<?php echo $pacient->phone;?>" readonly>
      </div>
      <div class="col-md-3">
        <label for="direccion" class="col-lg-8 control-label">Dirección:</label>
      </div>
      <div class="col-md-3">
        <input type="text" class="form-control" id="direccion" value="<?php echo $pacient->address?>" readonly>
      </div>
    </div>
    
    <div class="form-group mt-3">
      <div class="col-md-3">
        <label for="telefono" class="col-lg-8 control-label">Ocupacion:</label>
      </div>
      <div class="col-md-3">
        <input type="tel" class="form-control" id="telefono" value="<?php echo $pacient->pob;?>" readonly>
      </div>
      <div class="col-md-3">
        <label for="direccion" class="col-lg-8 control-label">Alergias:</label>
      </div>
      <div class="col-md-3">
        <input type="text" class="form-control" id="direccion" value="<?php echo $pacient->alergy?>" readonly>
      </div>
    </div>
    <div class="form-group mt-3">
      <div class="col-md-3">
        <label for="mensaje" class="col-lg-8 control-label">Antecedentes:</label>
      </div>
      <div class="col-md-9">
        <textarea class="form-control" id="mensaje" rows="3" readonly><?php echo $pacient->record;?>.</textarea>
      </div>
    </div>
    <div class="form-group mt-3">
      <div class="col-md-3">
        <label for="mensaje" class="col-lg-8 control-label">Examen fisico:</label>
      </div>
      <div class="col-md-9">
        <textarea class="form-control" id="mensaje" rows="3" readonly><?php echo $pacient->physicalExam?>.</textarea>
      </div>
    </div>
  </form>
</div>

<br>
		<?php
		$users = ReservationData::getAllByPacientId($_GET["id"]);
		if(count($users)>0){
			// si hay usuarios
			?>
			<div class="box box-primary">
			<table class="table table-bordered table-hover">
			<thead>
			<th>Asunto</th>
			<th>Nota</th>
			<th>Medicacion</th>
			<th>Fecha</th>
			</thead>
			<?php
			foreach($users as $user){
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
				?>
				<tr>
				<td><?php echo $user->title; ?></td>
				<td><?php echo $user->note; ?></td>
				<td><?php echo str_replace(['[', ']',','], ' ', $user->medicaments); ?></td>
				<td><?php echo $user->date_at." ".$user->time_at; ?></td>
				</tr>
				<?php

			}
?>
</table>
</div>
<?php


		}else{
			echo "<p class='alert alert-danger'>No hay citas</p>";
		}


		?>


	</div>
  
</div>
<br>


</section>