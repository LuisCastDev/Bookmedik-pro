<section class="content">
<?php 
$reservation = ReservationData::getById($_GET["id"]);
$pacients = PacientData::getAll();
$medics = MedicData::getAll();
$statuses = StatusData::getAll();
$payments = PaymentData::getAll();
?>
<div class="row">
	<div class="col-md-10">
	<h1>Record Medico</h1>
  <hr>
<form class="form-horizontal" role="form" method="post" action="./?action=updatereservation">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Cedula o Pasaporte.</label>
    <div class="col-lg-10">
      <input type="text" name="no" value="<?php echo $reservation->no; ?>"  class="form-control" id="inputEmail1" placeholder="Cod.">
    </div>
  </div>


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Asunto</label>
    <div class="col-lg-10">
      <input type="text" name="title" value="<?php echo $reservation->title; ?>" required class="form-control" id="inputEmail1" placeholder="Asunto">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Paciente</label>
    <div class="col-lg-10">
<select name="pacient_id" class="form-control" required disabled>
<option value="">-- SELECCIONE --</option>
  <?php foreach($pacients as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->pacient_id){ echo "selected"; }?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Medico</label>
    <div class="col-lg-10">
<select name="medic_id" class="form-control" required disabled>
<option value="">-- SELECCIONE --</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->medic_id){ echo "selected"; }?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha/Hora</label>
    <div class="col-lg-5">
     
      <input type="text" name="date_at" id="date_at" default value="" required class="pickadate form-control"  placeholder="Fecha">
    </div>
    <script>
        const fechaActual = new Date();
        
      // Obtener el año, mes y día
      const year = fechaActual.getFullYear();
      const month = String(fechaActual.getMonth() + 1).padStart(2, '0'); // Sumar 1 al mes ya que los meses van de 0 a 11
      const day = String(fechaActual.getDate()).padStart(2, '0');
      
      // Formatear la fecha como "yyyy-mm-dd"
      const fechaFormateada = `${year}-${month}-${day}`;

      document.getElementById("date_at").value=fechaFormateada;
     
        </script>
    <div class="col-lg-5">
      <input type="text" name="time_at" value="<?php echo $reservation->time_at; ?>" required class="pickatime form-control" id="inputEmail1" placeholder="Hora">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Medicacion / Receta</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="note" placeholder="Aceptaminofen 500mg uso VO 1 C/12h  x 3 dias"><?php echo $reservation->note;?></textarea>
    </div>
    <!-- <label for="inputEmail1" class="col-lg-2 control-label">Síntomas e Historia de la Enfermedad</label>
    <div class="col-lg-4">
    <textarea class="form-control" name="sick" placeholder="Síntomas e Historia de la Enfermedad"><?php echo $reservation->sick;?></textarea>
    </div> -->
  </div>


      <div class="form-group">
    <!-- <label for="inputEmail1" class="col-lg-2 control-label">Sintomas</label> -->
    <!-- <div class="col-lg-4">
    <textarea class="form-control" name="symtoms" placeholder="Sintomas">
      <?php echo $reservation->symtoms;?>
    </textarea>
    </div> -->
    <!-- <label for="inputEmail1" class="col-lg-2 control-label">Medicacion</label> -->
    <!-- <div class="col-lg-4">
    <textarea class="form-control" name="medicaments" placeholder="Ingrese la medicacion"><?php echo $reservation->medicaments;?></textarea>
    </div> -->
  </div>


 

    

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="id" value="<?php echo $reservation->id; ?>">
      <button type="submit" class="btn btn-success">Generar receta</button>
    </div>
  </div>
</form>

	</div>
</div>
</section>