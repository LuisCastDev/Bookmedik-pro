<section class="content">
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
<script>
$(document).ready(function() {
    $('#datepicker').pickadate({
        min: new Date(), // Establece la fecha mínima a hoy
        format: 'dd-mm-yyyy' // Formato de la fecha
    });
});
</script>
</div>
		<h1>Mis Citas</h1>
<br>
<form class="form-horizontal" role="form">
<input type="hidden" name="view" value="medicreservations">
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
<select name="pacient_id" class="form-control">
<option value="">PACIENTE</option>
  <?php foreach($pacients as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["pacient_id"]) && $_GET["pacient_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
    <div class="col-lg-4" hidden>
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		  <input type="text" name="date_at" id="datepicker" value="<?php if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){ echo $_GET["date_at"]; } ?>" class="form-control" >
		</div>
    </div>

    <div class="col-lg-2">
    <button class="btn btn-primary btn-block">Buscar</button>
    </div>

  </div>
</form>

		<?php
$users= array();
if((isset($_GET["q"]) && isset($_GET["pacient_id"])  && isset($_GET["date_at"])) && ($_GET["q"]!="" || $_GET["pacient_id"]!="" || $_GET["date_at"]!="") ) {
$sql = "select * from reservation where ";
if($_GET["q"]!=""){
	$sql .= " title like '%$_GET[q]%' ";
}

if($_GET["pacient_id"]!=""){
if($_GET["q"]!=""){
	$sql .= " and ";
}
	$sql .= " pacient_id = ".$_GET["pacient_id"];
}

if($_SESSION["medic_id"]!=""){
if($_GET["q"]!=""||$_GET["pacient_id"]!=""){
	$sql .= " and ";
}

	$sql .= " medic_id = ".$_SESSION["medic_id"];
}



if($_GET["date_at"]!=""){
if($_GET["q"]!=""||$_GET["pacient_id"]!="" ||$_GET["medic_id"]!="" ){
	$sql .= " and ";
}

	$sql .= " date_at = \"".$_GET["date_at"]."\"";
}
		$users = ReservationData::getBySQL($sql);

}else{
	//	$users = ReservationData::getAllByMedicId($_SESSION["medic_id"]);
		$users = ReservationData::getPendingsDoctor($_SESSION["medic_id"]);



}
		if(count($users)>0){
			// si hay usuarios
			?>
			<div class="box box-primary">
			<table class="table table-bordered table-hover" id="myTable">
			<thead>
			<th>Asunto</th>
			<th>Paciente</th>
			<th>Medico</th>
			<th>Estado</th>
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
				<td><?php echo StatusData::getById($user->status_id)->name;?></td>
				<td><?php echo $user->date_at." ".$user->time_at; ?></td>
				<td style="width:20%;">
								<a href="index.php?view=prescription&id=<?php echo $user->id;?>" class="fa fa-pencil-square btn btn-info btn-xs">Consultar</a>
								
								
<a href="./?view=pacient&id=
<?php echo $pacient->id; ?>" class="btn btn-default btn-xs"><i class="fa fa-folder-open"></i> Archivos</a>


				
				<a onclick="confirmacion()" href="index.php?action=delreservation&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
				
				</td>
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
	$(document).ready(function() {
    $('#datepicker').datepicker({
        startDate: new Date("01/01/2000") // Establece la fecha mínima a hoy
    });
		});
	
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
			echo "<p class='alert alert-danger'>No hay pacientes</p>";
		}


		?>


	</div>
</div>
<script>
	function confirmacion(){
		if(confirm("¿Deseas eliminar esta cita?")){

			alert("Cita cancelada!");


		}
	}

</script>
<script type="text/javascript">

$(".pickadate2").pickadate(
  {
    format: 'yyyy-mm-dd',
    min: '<?php echo date('Y-m-d',time()-(24*60*60)); ?>',
 onSet: function(context) {
  if($("#medic_id").val()==""){
    alert("Debes seleccionar un medico!");
$('#time_at')
    .find('option')
    .remove()
    .end();
  }else{

$.get("./?action=gethours","medic_id="+$("#medic_id").val()+"&date_at="+$("#date_at").val(),function(data){
  $("#time_at").html(data);
    //      console.log((data));

  });


  }
  //      console.log((data));
    }
  }
  );


  $("#newreservation").submit(function(e){
    if($("#date_at").val()==""||$("#time_at").val()==""){
          e.preventDefault();
          alert("Debes seleccionar fecha y hora!");
    }

  });

$(document).ready(function(){

$("#category_id").change(function(){

$.get("./?action=getmedics","cat_id="+$("#category_id").val(),function(data){
  $("#medic_id").html(data);
 // console.log(data);
  });


});

});

</script>
</section>