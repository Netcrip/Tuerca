<li class="divider header nav-small-cap">Usuario</li>
  <li class="header nav-small-cap">VEHICULOS</li>
    <li class="active">
      <a href="#" data-toggle="modal" data-target="#modal-altavehiculo">
        <i class="fa fa-car"></i> <span>Cargar Vehiculo</span>
      </a>
    </li>
    <li class="treeview">
      <a href="#" >
        <i class="fa fa-car"></i>
        <span>Mis Vehicuolos</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-right pull-right"></i>
        </span>     
      </a>        
      <ul class="treeview-menu" id="listadevehiculoscliente">
      </ul>
    </li>
    <li class="header nav-small-cap">TURNOS</li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-file-text"></i>
          <span>turnos</span>
          <span class="pull-right-container">
          <i class="fa fa-angle-right pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
          <li><a data-toggle="modal" data-target="#consultar-turno" onclick="proximoturnoscliente()"><i class="fa fa-eye"></i>Ver Turnos Asignados</a></li>
          <li><a href="#" data-toggle="modal" data-target="#consultar-solicitudes" onclick="solicitudesactivas()"><i class="fa fa-eye"></i>Ver Solicitudes</a></li>
          <li><a href="#" data-toggle="modal" data-target="#solicitartunro" onclick="cargarautoselect()"><i class="fa fa-pencil"></i>Solicitar Turno</a></li>
        </ul>
      </li>
      </li>
    </li>
  </li>
</li>