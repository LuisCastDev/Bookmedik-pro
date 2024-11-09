
<section class="content">
<div class="row">
	<div class="col-md-12">
	<h1>Nuevo Paciente</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" enctype="multipart/form-data" action="index.php?view=addpacient" role="form">

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Imagen*</label>
    <div class="col-md-6">
      <input type="file" name="image">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">No. Cédula*</label>
    <div class="col-md-6">
      <input type="text"  name="no" class="form-control" id="no" placeholder="No. Cédula" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" required class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido</label>
    <div class="col-md-6">
      <input type="text" name="lastname"  class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Genero*</label>
    <div class="col-md-6">
<label class="checkbox-inline">
  <input type="radio" id="inlineCheckbox1" name="gender" required value="h"> Hombre
</label>
<label class="checkbox-inline">
  <input type="radio" id="inlineCheckbox2" name="gender" required value="m"> Mujer
</label>

    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha de Nacimiento</label>
    <div class="col-md-6">
      <input type="date" name="day_of_birth" class="form-control"  id="address1" placeholder="Fecha de Nacimiento">
    </div>
  </div>


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
    <div class="col-md-6">
      <input type="text" name="address" class="form-control"  id="address1" placeholder="Direccion">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Seguro *</label>
    <div class="col-md-6">
      <input type="text" name="cp" class="form-control"  id="address1" placeholder="Seguro ">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Ocupación*</label>
    <div class="col-md-6">
      <input type="text" name="pob" class="form-control"  id="address1" placeholder="Ocupación">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" class="form-control" id="email1" placeholder="Email">
      <p class="help-block">Si el email esta vacio se inhabilita el acceso al paciente.</p>
    </div>
  </div>
  <!-- <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Password*</label>
    <div class="col-md-6">
      <input type="password" name="password" class="form-control" id="email1" placeholder="Password">
      <p class="help-block">Si el password esta vacio se inhabilita el acceso al paciente.</p>
    </div>
  </div> -->

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Telefono*</label>
    <div class="col-md-6">
      <input type="text" name="phone" class="form-control" id="phone1" placeholder="Telefono">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Historial medico</label>
    <div class="col-md-6">
      <textarea name="record" class="form-control" id="record" placeholder="Condicion e historial del paciente"></textarea>
    </div>
  </div>
   
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Alergias</label>
    <div class="col-md-6">
      <textarea name="alergy" class="form-control" id="alergy" placeholder="Alergias que presenta el presente"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Examen físico</label>
    <div class="col-md-6">
      <textarea name="physicalExam" class="form-control" id="physicalExam" placeholder="Examen físico"></textarea>
    </div>
  </div>
  <p class="alert alert-info">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Paciente</button>
    </div>
  </div>
</form>

	</div>
</div>
</section>