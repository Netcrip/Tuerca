<section class="content-header text-center dropdown-toggle" data-toggle="collapse" href="#Administracion">
  <h1 >
    Administracion
  </h1>  
</section>
<section>
  <div class="collapse" id="Administracion">
    <section>
      <div class="box">
        <h2>Administrar Talleres</h2>
      </div>
      <div class="form-group col-md-4">
      <label for="inputState">Talleres</label>
        <select id="pagtalleres" class="form-control" onChange="cambiarpaginador()">
        </select>
      </div>
      <div class="box-body ">
      <table class="table table-hover table-responsive tablas" id="talleresadministrador">
        <thead>
          <tr>
            <th>Id Taller</th>
            <th>Nombre</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="talleresadministradorbody">
        </tbody>
      </table>
    </div>
          <!-- Tabla para -->   
    <div class="box">
      <h2>Administrar Servicios</h2>
    </div>
    <div class="box-body">
      <table class="table table-hover table-responsive tablas" id="tablaservicioadministrador">
        <thead >
          <tr>
            <th>Id servicio</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody  id="tablaservicioadministradorbody">
    
        </tbody>
      </table>
    </div>

    </section>
  </div>

</section>

