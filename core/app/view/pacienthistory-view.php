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
<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination button {
            margin: 0 5px;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</div>
		<h1>Historial de Citas del Paciente</h1>
<h4>Paciente: <?php echo $pacient->name." ".$pacient->lastname;?></h4>

<div class="container mt-5 overflow-auto" style="margin-right:40%" >
  <form class="form-horizontal" >
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
			<table class="table table-bordered table-hover " id="myTable">
			<thead>
			<th>Asunto</th>
			<th>Nota</th>
			<th>Fecha de cita</th>
			<th>Accion</th>
			</thead>
			<?php
			foreach($users as $user){
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
				?>
				<tr>
				<td><?php echo $user->title; ?></td>
				<td class="overflow-hidden max" ><?php echo $user->note; ?></td>
			
				<td><?php echo $user->date_at." ".$user->time_at; ?></td>
        <td style="width:270px;">
				<!-- <a href="cesion.php?id= ?php echo $user->id;?>" target="_blank" class="btn btn-info btn-xs">Cesion de Datos</a> -->
				<a href="index.php?view=pacientprescription&id=<?php echo $user->id;?>" class="btn btn-info btn-xs">Ver más</a>
				</tr>
				<?php

			}
?>
</table>
<div class="pagination">
    <button id="prevBtn" onclick="prevPage()">Anterior</button>
    <button id="nextBtn" onclick="nextPage()">Siguiente</button>
</div>
<script>
    // JavaScript para la paginación
    const rowsPerPage = 10;
    let currentPage = 1;
    const table = document.getElementById('myTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    function displayRows() {
        for (let i = 0; i < rows.length; i++) {
            rows[i].style.display = 'none';
        }
        let start = (currentPage - 1) * rowsPerPage;
        let end = start + rowsPerPage;
        for (let i = start; i < end && i < rows.length; i++) {
            rows[i].style.display = '';
        }
        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = currentPage === totalPages;
    }

    function nextPage() {
        if (currentPage < totalPages) {
            currentPage++;
            displayRows();
        }
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            displayRows();
        }
    }

    window.onload = displayRows;
</script>
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