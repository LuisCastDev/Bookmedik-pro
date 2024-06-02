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
<form class="form-horizontal" id="prescription-form" role="form" method="post" action="./?action=updatereservation">
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
<select name="pacient_id"  id="pacient_id" class="form-control"  required >
<option value="">-- SELECCIONE --</option>
  <?php foreach($pacients as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->pacient_id){ echo "selected"; }?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div hidden class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Medico</label>
    <div class="col-lg-10">
<select name="medic_id" id="medic_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->medic_id){ echo "selected"; }?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group" hidden>
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


  <div class="form-group" >
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha</label>
    <div class="col-lg-5">
     
      <input type="date" name="date" id="date"  value="<?php echo date('Y-m-d'); ?>" required class="pickadate form-control"  placeholder="Fecha">
    </div>
    
    
  </div>

  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nota</label>
    <div class="col-lg-4">
    <textarea class="form-control" name="note" placeholder="Nota"><?php echo $reservation->note;?></textarea>
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Síntomas e Historia de la Enfermedad</label>
    <div class="col-lg-4">
    <textarea class="form-control" name="sick" placeholder="Síntomas e Historia de la Enfermedad"><?php echo $reservation->sick;?></textarea>
    </div>
  </div>


      <div class="form-group" hidden>
    <label for="inputEmail1" class="col-lg-2 control-label">Sintomas</label>
    <div class="col-lg-4">
    <textarea class="form-control" name="symtoms" placeholder="Sintomas"><?php echo $reservation->symtoms;?></textarea>
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Antecedentes del paciente</label>
    <div class="col-lg-4">
    <textarea class="form-control" name="record" placeholder="Antecedentes del paciente"><?php echo $reservation->record;?></textarea>
    </div>
  </div>
  <div class="form-group" hidden >
    <label for="inputEmail1" class="col-lg-2 control-label">Estado de la cita</label>
    <div class="col-lg-10">
<select name="status_id" class="form-control" required >
  <?php foreach($statuses as $p):?>
    <option value="2"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Medicacion / Receta</label>
    <div class="col-lg-8">
    <textarea class="form-control" name="medicament" placeholder="Aceptaminofen 500mg uso VO 1 C/12h  x 3 dias" id="medicament"><?php echo $reservation->medicaments;?></textarea>
    
    </div>
    <button onclick="agregarElemento()" type="button" class="btn btn-primary">Agregar Elemento</button>
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

 
  <div class="form-group" hidden>
    <label for="inputEmail1" class="col-lg-2 control-label">Costo</label>
    <div class="col-lg-10">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" class="form-control" value="<?php echo $reservation->price;?>" name="price" placeholder="Costo">
</div>
    </div>
  </div>
  <div class="form-group" hidden>
    <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>
    <div class="col-lg-10">
<select name="payment_id" class="form-control" required>
  <?php foreach($payments as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($p->id==$reservation->payment_id){ echo "selected"; }?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
    
  </div>

  <div class="form-group" id="contenedorElementos">
    
  
    </div>
  </div>
    <!-- Contenedor para mostrar los elementos -->
    <!-- <div id="contenedorElementos"></div> -->

    <script>
      

        var arreglo = []; // Arreglo para almacenar los elementos
        var selectElement = document.getElementById("pacient_id");


        var selectedOption = selectElement.options[selectElement.selectedIndex];
        function agregarElemento() {
            // Obtener el valor ingresado en el input
            var elemento = document.getElementById("medicament").value;

            // Verificar si el valor no está vacío
            if (elemento.trim() !== '') {
                // Agregar el elemento al arreglo
                arreglo.push(elemento);

                // Limpiar el input
                document.getElementById("medicament").value = '';

                // Actualizar la visualización de los elementos
                mostrarElementos();
            }
        }
        document.getElementById("prescription-form").addEventListener("submit", function(event) {
    // Obtener el arreglo desde algún lugar (supongamos que se llama 'miArreglo')
    var miArreglo = obtenerArreglo();

    // Verificar si el arreglo está vacío
    if (miArreglo.length === 0) {
        // Evitar que el formulario se envíe
        event.preventDefault();
        alert("la receta está vacía. Por favor, llénela antes de imprimir.");
    }
});
function obtenerArreglo() {
    return arreglo;
}
        function mostrarElementos() {
            // Obtener el contenedor de los elementos
            var contenedor = document.getElementById("contenedorElementos");

            // Limpiar el contenedor
            contenedor.innerHTML = '';

            // Crear un campo de texto para cada elemento del arreglo
            arreglo.forEach(function(elemento, index) {
                var inputElemento = document.createElement("input");
                inputElemento.type = "text";
                inputElemento.classList="col-lg-4";
                inputElemento.style="margin:3px 0px 0px 18.5%"
                inputElemento.value = `${elemento}`;

                // Agregar un botón para eliminar el elemento
                var btnEliminar = document.createElement("a");
                btnEliminar.textContent = "Eliminar";
                btnEliminar.classList="btn btn-danger btn-xs";
                btnEliminar.style="margin:5px 2px 2px 3px"
                btnEliminar.onclick = function() {
                    eliminarElemento(index);
                };

                // Agregar el campo de texto y el botón al contenedor
                contenedor.appendChild(inputElemento);
                contenedor.appendChild(btnEliminar);
                contenedor.appendChild(document.createElement("br")); // Agregar salto de línea
            });
            document.getElementById("medicaments").value = JSON.stringify(arreglo);
            document.getElementById("pacient").value = selectedOption.textContent || selectedOption.innerText;;

        }

        function eliminarElemento(index) {
            // Eliminar el elemento del arreglo
            arreglo.splice(index, 1);

            // Actualizar la visualización de los elementos
            mostrarElementos();
        }

        // Obtener el elemento select
      

        // Obtener el texto de la opción seleccionada
       
       

    </script>

<input type="hidden" id="pacient" name="pacient">
<input type="hidden" id="medicaments" name="medicaments">
<br>
  <div class="form-group">
    <div class="col-lg-offset-1 col-lg-10">
    <input type="hidden" name="id" value="<?php echo $reservation->id; ?>">
      <button type="submit" class="btn btn-success btn-lg btn-block" name="Enviar Formulario">Generar receta</button>
    </div>
  </div>
</form>

	</div>
</div>
</section>
