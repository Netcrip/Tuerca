 <section class="content-header text-center dropdown-toggle " data-toggle="collapse" href="#Usuario">
    <h1>
      Bienvenido al la Tuerca
    </h1> 
  </section>
  <section>
  <div class="collapse" id="Usuario">
    <section id="usuariodato1" class="content-header">
          <h1>
            <small>Dominio:</small><h2 id="dominioautocliente"></h2>
            <a onclick="todoslosdatosvehiculo()" id="modificarauto" data-toggle="modal" data-target="#modal-editarauto"> <span class="label label-info"><i class="fa fa-pencil"></i></span></a>
            <a onclick="eliminarautocliente()" id="eliminarauto" ><span class="label label-danger"><i class="fa fa-ban"></i></span></a>
          </h1>   
    </section>
          <!-- Main content -->
    <section id="usuariodato2" class="content">
      <div class="row">
        <div class="small-box bg-info col-md-6 col-12">
          <div class="inner">
            <h3 id="kmautocliente"></h3>
            <p>Kilometros</p>
          </div>
          <div class="icon">
            <i class="fa fa-car"></i>
          </div>
            <a href="#" onclick="cargarkmcliente()" class="small-box-footer">Cargar Km.<i  class="fa fa-arrow-right"></i></a>
        </div>       
        <div class="small-box bg-success col-12 col-md-6">
          <div class="inner">
            <h3>Proximo Servicio</h3>
            <p id="proximoserviciocliente"></p>
          </div>
          <div hidden id="ordendeservicio">
          </div>
          <div class="icon">
            <i class="fa fa-info"></i>
          </div>
          <a  data-toggle="modal" data-target="#consultar-turno"  onclick="proximoturnoscliente()" class="small-box-footer"><i class="fa fa-info"></i></a>
        </div>         
       <!-- /tabla -->  
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Servicios</h3>
          </div>
        </div>
                  <!-- /.box-header -->
        <div class="box-body ">
          <table class="table tablas table-hover table-responsive " id="ordenescliente">
            <thead>
              <tr>
                <th >Ordent Trabajo</th>
                <th>Taller</th>
                <th>fecha</th>
                <th>Servicio</th>
                <th>Km</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id="ordenesclientebody">           
            
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <section>
      <div id="Seleccionevehiculo">
        <div class="jumbotron">
          <h1 class="display-4 text-center">Hola!</h1>
          <p class="lead text-center">Por favor selecciona un vehiculo</p>
          <hr class="my-4">
          <p class="text-center">si no tienes vehiculo por favor usa el boton de abajo para agregar.</p>
          <p class="lead text-center">
            <a class="btn btn-primary btn-lg" href="#" data-toggle="modal" data-target="#modal-altavehiculo" role="button">Nuevo vehiculo</a>
          </p>
        </div>
      </div>
    </section>
  </div>
  </section>






