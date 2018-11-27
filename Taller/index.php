<?php
    include('../config/config.php');
    include('../sesion.php');
    $userClass = new userClass();
    include('../clases/tablas.php');
    $tablas= new tablaServicio(); 

  ?>
<!DOCTYPE html>
  <html lang="es">
  <head>
    <?php include("head.php")?>
    <title>La Tuerca</title>
  </head>
  <body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <b class="logo-mini">
            <span class="light-logo"><img src="images/aries-light-2.png" alt="logo"></span>
          </b>
            <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">
          LA Tuerca
          </span>  
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav" >  
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-cog fa-spin"></i>
                </a>
                <ul class="dropdown-menu scale-up">
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="row no-gutters">
                      
                      <div class="col-12 text-left">
                        <a href="../logout.php"><i class="fa fa-power-off"></i> Logout</a>
                      </div>				
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar"> 
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <?php 
              if(in_array(22,$userClass->userDetails($_SESSION['uid']))){
                include('administrador-nav.php');
              }
              if(in_array(24,$userClass->userDetails($_SESSION['uid']))){
                include('usuario-nav.php');
              }
              if(in_array(23,$userClass->userDetails($_SESSION['uid']))){
                include('taller-nav.php');
              }
              
            ?>
            <!--?php ?--> 
            <!--??--> 
          </ul>	
        </section>
      </aside>
      <div class="content-wrapper" >
        <!-- contenido -->
        <?php 
          //$result= $userClass->userDetails($_SESSION['uid']);**/
          
        
          
          if(in_array(23,$userClass->userDetails($_SESSION['uid']))){
            include('taller-main.php');
          }

          if(in_array(24,$userClass->userDetails($_SESSION['uid']))){
           include('usuario-main.php');
          }
          
          if(in_array(22,$userClass->userDetails($_SESSION['uid']))){
            include('administrador-main.php');
            
          }
          
       
          
        ?>
   
        <!--?php include('taller-main.php')?-->
        <!--?php ?-->
        <!-- /contenido -->
      </div>
      <!-- footer -->
      <footer class="main-footer">
          <?php include("footer.php")?>
      </footer>
      <!-- footer -->

    </div>

  <!-------------------------MODALES--------------------------------->
  <!------Modal Contraseña------------------------------->
  
  <div class="modal center-modal fade" id="asignar-turno" tabindex="-1" style="display: block;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="asignarturnotitulo">Asignarturno Orden</h5>
          <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="">Asignacion de Turno: </label>
           <h5 id="asignarturnosolicitudnro"> NNN</h5>
          <div class="col-md-12 col-12">
            <form action="">
              <div class="form-group">
                <label for="dominioserv">Dimonio:</label>
                <input type="text" class="form-control" disabled  placeholder="AF-352-LS" id="dominioserv"> 
              </div>
              <div clase="form-check form-check-inline nuevo-turnoscroll" id="serviciocheckorden" >
                  <?php
                  $sth=$tablas->gettablaservicio();
                  $thservicio= $sth->fetchAll();
                  if($sth->rowCount()):
                    foreach($thservicio as $row){ ?>  
                    <input class="form-check-input col-4" type="checkbox" name="checkservicioserviciosorden" disabled id='a<?php echo $row['codserv']; ?>' value='<?php echo $row['codserv'];?>'> 
                    <label class="form-check-label col-6" for="a<?php echo $row['codserv']; ?>"><?php echo $row['nombre']; ?></label><br>                       
                    <?php }  ?>
                  <?php endif;  ?>
              </div>
              <div class="form-group">
                <label for="dominioserv">El cliente apreciaria el el turno sea:</label>
                <textarea type="text" id="observacioneclientesolicitud" class="form-control" disabled id="Info" style="resize:none"  rows="3"></textarea>
              </div>
              <div class="form-group">
              <label for="dominioserv">Observaciones:</label>
                <textarea type="text" id="tallerobservacioneclientesolicitud" class="form-control"  id="Info" style="resize:none"  rows="3"></textarea>
              </div>
              <div class="form-group">
                <input class="form-control" type="date" value="2011-08-19" id="fechasolicitudorden">
                <input class="form-control" type="time" value="13:45:00" id="horasolicitudorden">
              </div>
            </form>
          </div>

        </div>
          <div class="modal-footer modal-footer-uniform">
          <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" id="btnsolicitarturno"class="btn btn-bold btn-pure btn-primary float-right">Asignar Turno</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal center-modal fade" id="editar-orden" tabindex="-1" style="display: block;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarordenestitulo">Editar Orden</h5>
          <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12 col-12">
          <label for="">Orden a editar: </label>
           <h5 id="editarordennumero"> NNN</h5>
            <form id="formeditarturno" >
              <div class="form-group">
                <label for="dominioeditarorden">Dominio:</label>
                <input type="text" id="dominioeditarorden"class="form-control" disabled > 
              </div>
              <label>Seleccion de servicio</label>
              <div clase="form-check form-check-inline nuevo-turnoscroll" id="modificarturnochek" >
                  <?php
                  $sth=$tablas->gettablaservicio();
                  $thservicio= $sth->fetchAll();
                  if($sth->rowCount()):
                    foreach($thservicio as $row){ ?>  
                    <input class="form-check-input col-4" type="checkbox" name="checkserviciomodificar" id='<?php echo $row['codserv']; ?>' value='<?php echo $row['codserv']; ?>'> 
                    <label class="form-check-label col-6" for="<?php echo $row['codserv']; ?>"><?php echo $row['nombre']; ?></label><br>                       
                    <?php }  ?>
                  <?php endif;  ?>
              </div>
            
              <div class="form-group">
                <input class="form-control" type="date" id="editarordenfecha">
                <input class="form-control" type="time" id="editarordenhorario"  >
              </div>
              <div class="form-group"> 
                <label for="modificarturnoobservacion">Observaciones</label>
                <input class="form-control" id="modificarturnoobservacion"type="text">
              </div>
            </form>
          </div>

        </div>
          <div class="modal-footer modal-footer-uniform">
          <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" id="btnguardarturnomodificado" class="btn btn-bold btn-pure btn-primary float-right" disabled>Modificar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal center-modal fade" id="editar-taller" tabindex="-1" style="display: block;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar taller</h5>
          <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12 col-12">
            <form action="">
              <div class="form-group">
                <input type="text" class="form-control" id="editartallernombre" disabled > 
              </div>
              <div class="form-group">
                <input type="text" class="form-control" disabled  id="talleradministrador"> 
              </div>
              <div clase="form-check form-check-inline nuevo-turnoscroll" id="tallerserviciochek" >
                  <?php
                  $sth=$tablas->gettablaservicio();
                  $thservicio= $sth->fetchAll();
                  if($sth->rowCount()):
                    foreach($thservicio as $row){ ?>  
                    <input class="form-check-input col-4" type="checkbox" name="tallerservicioeditar" id='ts<?php echo $row['codserv']; ?>' value='<?php echo $row['codserv']; ?>'> 
                    <label class="form-check-label col-6" for="ts<?php echo $row['codserv']; ?>"><?php echo $row['nombre']; ?></label><br>                       
                    <?php }  ?>
                  <?php endif;  ?>
              </div>
            </form>
          </div>
        </div>
          <div class="modal-footer modal-footer-uniform">
          <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" id="modificarserviciostaller" disabled class="btn btn-bold btn-pure btn-primary float-right">Modificar servicios</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal center-modal fade" id="nuevo-turno" tabindex="-1" style="display: block;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nuevo Turno</h5>
          <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12 col-12">
            <form  id="formasignarturnonuevo">
              <div class="form-group">
                <input type="text" class="form-control"  placeholder="AF-352-LS" id="dominionuevoturno"  required=""> 
              </div>
            
              <label>Seleccion de servicio</label>
              <div clase="form-check form-check-inline nuevo-turnoscroll requiered" id="nuevo-turnoscroll" >
                  <?php
                  $sth=$tablas->gettablaservicio();
                  $thservicio= $sth->fetchAll();
                  if($sth->rowCount()):
                    foreach($thservicio as $row){ ?>  
                    <input class="form-check-input col-4" type="checkbox" name="checkservicio" id='<?php echo "cs".$row['codserv']; ?>' value='<?php echo $row['codserv']; ?>'> 
                    <label class="form-check-label col-6" for="<?php echo "cs".$row['codserv']; ?>"><?php echo $row['nombre']; ?></label><br>                       
                    <?php }  ?>
                  <?php endif;  ?>
              </div>
              
  
              <div class="form-group">
                <input class="form-control" type="date" value="2018-11-10" id="fechaordennuevoturno"  required>
                <input class="form-control" type="time" value="13:45" id="horaordennuevoturno"  required>
              </div>
              <div class="form-group"> 
              <label for="modificarturnoobservacion">Observaciones</label>
              <input class="form-control" id="obsdennuevoturno"type="text">
              </div>
              <div class="modal-footer modal-footer-uniform col-12">
                <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">cerrar</button>
                <button type="submit" class="btn btn-bold btn-pure btn-primary float-right">Cargar Turno</button>
              </div>
             
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal center-modal fade" id="ver-orden" tabindex="-1" style="display: block;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarordenestitulo">Ver Orden</h5>
          <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12 col-12">
          <label for="">Ver orden: </label>
           <h5 id="verdennumero"> NNN</h5>
            <form id="formeditarturno" >
              <div class="form-group">
                <label for="verdominioeditarorden">Dominio:</label>
                <input type="text" id="verdominioeditarorden"class="form-control" disabled > 
              </div>
              <label>Seleccion de servicio</label>
              <div clase="form-check form-check-inline nuevo-turnoscroll" id="verturnochek" >
                  <?php
                  $sth=$tablas->gettablaservicio();
                  $thservicio= $sth->fetchAll();
                  if($sth->rowCount()):
                    foreach($thservicio as $row){ ?>  
                    <input class="form-check-input col-4" type="checkbox" disabled name="checkserviciover" id='ver<?php echo $row['codserv']; ?>' value='<?php echo $row['codserv']; ?>'> 
                    <label class="form-check-label col-6" for="ver<?php echo $row['codserv']; ?>"><?php echo $row['nombre']; ?></label><br>                       
                    <?php }  ?>
                  <?php endif;  ?>
              </div>
            
              <div class="form-group">
                <input class="form-control" disabled type="date" id="verordenfecha">
                <input class="form-control" disabled type="time" id="verordenhorario"  >
              </div>
              <div class="form-group"> 
                <label for="verturnoobservacion">Observaciones</label>
                <input class="form-control" disabled id="verturnoobservacion"type="text">
              </div>
            </form>
          </div>

        </div>
          <div class="modal-footer modal-footer-uniform">
          <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" id="btnguardarturnomodificado" class="btn btn-bold btn-pure btn-primary float-right" disabled>Modificar</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal editar auto -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="modal-editarauto">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" >Editar vehiculo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Tipo de vehiculo</label>
            <select class="form-control select2" id="editarselecciontipo" style="width: 100%;">              
            </select>
        </div>
        <div class="form-group">
          <label>Marca</label>
            <select class="form-control select2" id="editarselectmarca" style="width: 100%;">              
            </select>
        </div>
        <div class="form-group">
          <label>Modelo</label>
            <select class="form-control select2" id="editarseleccionmodelo" style="width: 100%;">              
            </select>
        </div>
        <div class="form-group">
          <label for="añonuevoauto">Dominio</label>
          <input class="form-control select2" type="text" placeholder="ingrese dominio" id="editarnuevodominio"style="width: 100%;">              
        </div>
        <div class="form-group">
          <label for="añonuevoauto">Año</label>
          <input class="form-control select2" type="number" placeholder="Ingrese año" id="editarañonuevoauto"style="width: 100%;">              
        </div>
        <div class="form-group">
          <label for="añonuevoauto">Motor</label>
          <input class="form-control select2" type="text" placeholder="ingrese nro motor" id="editarnuevomotor"style="width: 100%;">              
        </div>
        <div class="form-group">
          <label for="añonuevoauto">Chasis</label>
          <input class="form-control select2" type="text" placeholder="Ingrese numero chasis" id="editarnuevochasis"style="width: 100%;">              
        </div>
                     
      </div>

      <div class="modal-footer modal-footer-uniform col-12">
        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-info float-right" id="btnactualizarauto" disabled onclick="editarvehiculocliente()"> Editar datos </button>       
      </div>
                    <!-- /.row -->
    </div>
                  <!-- /.box-body -->
  </div>
            
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="solicitartunro">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" >Solicitud de servicio</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
          <div class="box-body">
          <div class="form-group">
              <label for="selecciondevehiculocliente">Seleccione vehiculo:</label>
                <select  class="form-control" name="" id="selecciondevehiculocliente"></select>
              </div>
            <div class="form-group">
              <label for="listadetaller">Seleccione Taller:</label>
                <select  class="form-control" name=""  id="listadetaller"></select>
            </div>
            <div class="form-group">
              <label for="datosdeltaller">Datos del taller:</label>
                <textarea type="text" id="datosdeltaller" class="form-control" disabled id="Info" style="resize:none"  rows="3"></textarea>
              </div>

            <label>Seleccion de servicio</label>
            <div clase="form-check form-check-inline nuevo-turnoscroll" id="serviciosdetaller" >
              
            </div>
          
          </div>
          <div class="form-group">
              <label for="dominioserv">Observaciones para el turno (dia/horario):</label>
                <textarea type="text" id="observacionescliente" class="form-control"  id="Info" style="resize:none"  rows="3"></textarea>
              </div>
          <div class="modal-footer modal-footer-uniform col-12">
            <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-info float-right" onclick="guardarsolicitud()"> Solicitar </button>
          </div>
        
              <!-- /.box-body -->
      </div>
    </div>    
    </div>
</div>

<!-- Modal Consultar Turno -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="consultar-turno">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" >Ver Proximos turnos</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		  </div>
					<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
          <div class="box-body ">
            <table class="table tablas table-hover table-responsive " id="proximosturnosclientetabla">
              <thead>
                <tr>
                  <th class='d-none d-sm-block'>O. T.</th>
                  <th>Dominio</th>
                  <th>Taller</th>
                  <th>fecha</th>
                  <th class='d-none d-sm-block'>C. Serv.</th>
                </tr>
              </thead>
              <tbody id="proximosturnosclientebody">           
              
              </tbody>
            </table>
            
            
          </div>

							<!-- /.col -->
						
										<!-- /.col -->
					</div>
					<div class="modal-footer modal-footer-uniform">
						<button type="button" class="btn btn-bold btn-pure btn-secondary btn-block" data-dismiss="modal">Cerrar</button>
					</div>
									<!-- /.row -->
				</div>
								<!-- /.box-body -->
			</div>
		</div>
					<!-- /.modal-content -->
</div>



<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="consultar-solicitudes">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" >Ver Solicitudes</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		  </div>
					<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
          <div class="box-body ">
          <table class="table tablas table-hover table-responsive " id="solicitudesclientetabla">
                <thead>
                  <tr>
                    <th class="d-none d-sm-block">O. T.</th>
                    <th>Dominio</th>
                    <th>Taller</th>
                    <th>fecha</th>
                    <th class="d-none d-sm-block">C. Serv.</th>
                  </tr>
                </thead>
                <tbody id="solicitudesclientebody">           
                
                </tbody>
              </table>            
          </div>

							<!-- /.col -->
						
										<!-- /.col -->
					</div>
					<div class="modal-footer modal-footer-uniform">
						<button type="button" class="btn btn-bold btn-pure btn-secondary btn-block" data-dismiss="modal">Cerrar</button>
					</div>
									<!-- /.row -->
				</div>
								<!-- /.box-body -->
			</div>
		</div>
					<!-- /.modal-content -->
</div>

<div class="modal center-modal fade" id="ver-ordencliente" tabindex="-1" style="display: block;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarordenestitulocliente">Ver Orden</h5>
          <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12 col-12">
          <label for="">Ver orden: </label>
           <h5 id="vernumeroordencliente"> NNN</h5>
            <form id="formeditarturnoformordenescliente" >
              <div class="form-group">
                <label for="verdominioeditarordencliente">Dominio:</label>
                <input type="text" id="verdominioeditarordencliente"class="form-control" disabled > 
              </div>
              <label>Seleccion de servicio</label>
              <div clase="form-check form-check-inline nuevo-turnoscroll" id="verturnochekcliente" >
                  <?php
                  $sth=$tablas->gettablaservicio();
                  $thservicio= $sth->fetchAll();
                  if($sth->rowCount()):
                    foreach($thservicio as $row){ ?>  
                    <input class="form-check-input col-4" type="checkbox" disabled name="checkserviciovercliente" id='ver<?php echo $row['codserv']; ?>' value='<?php echo $row['codserv']; ?>'> 
                    <label class="form-check-label col-6" for="ver<?php echo $row['codserv']; ?>"><?php echo $row['nombre']; ?></label><br>                       
                    <?php }  ?>
                  <?php endif;  ?>
              </div>
            
              <div class="form-group">
                <input class="form-control" disabled type="date" id="verordenfechacliente">
                <input class="form-control" disabled type="time" id="verordenhorariocliente"  >
              </div>
              <div class="form-group"> 
                <label for="verordenobservacioncliente">Observaciones</label>
                <input class="form-control" disabled id="verordenobservacioncliente"type="text">
              </div>
            </form>
          </div>

        </div>
          <div class="modal-footer modal-footer-uniform">
          <button type="button" class="btn btn-bold btn-pure btn-secondary btn-block" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


<!-- Modal Alta auto -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="modal-altavehiculo">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" >Agregar vehiculo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Tipo de vehiculo</label>
            <select class="form-control select2" id="selecciontipo" style="width: 100%;">              
            </select>
        </div>
        <div class="form-group">
          <label>Marca</label>
            <select class="form-control select2" id="selectmarca" style="width: 100%;">              
            </select>
        </div>
        <div class="form-group">
          <label>Modelo</label>
            <select class="form-control select2" id="seleccionmodelo" style="width: 100%;">              
            </select>
        </div>
        <div class="form-group">
          <label for="añonuevoauto">Dominio</label>
          <input class="form-control select2" type="text" placeholder="ingrese dominio" id="nuevodominio"style="width: 100%;">              
        </div>
        <div class="form-group">
          <label for="añonuevoauto">Año</label>
          <input class="form-control select2" type="number" placeholder="Ingrese año" id="añonuevoauto"style="width: 100%;">              
        </div>
        <div class="form-group">
          <label for="añonuevoauto">Motor</label>
          <input class="form-control select2" type="text" placeholder="ingrese nro motor" id="nuevomotor"style="width: 100%;">              
        </div>
        <div class="form-group">
          <label for="añonuevoauto">Chasis</label>
          <input class="form-control select2" type="text" placeholder="Ingrese numero chasis" id="nuevochasis"style="width: 100%;">              
        </div>
                     
      </div>

      <div class="modal-footer modal-footer-uniform col-12">
        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-info float-right" onclick="cargarvehiculonuevo()"> Guardar Datos </button>       
      </div>
                    <!-- /.row -->
    </div>
                  <!-- /.box-body -->
  </div>
            
</div>
         


<div class="modal center-modal fade" id="editar-talleradm" tabindex="-1" style="display: block;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
        <h5 class="modal-title">Editar Taller</h5>
        <button type="button" class="close" data-dismiss="modal">
				  <span aria-hidden="true">×</span>
				</button>
			</div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label>Numero de taller</label>
                    <input type="text" class="form-control select2" id="nrotallereditar" disabled style="width: 100%;">              
                </select>
              </div> 
              <div class="form-group">
                <label>Nombre del taller</label>
                    <input type="text" class="form-control select2" id="editarnombrenuevotaller" placeholder="Ingrese nombre del taller" style="width: 100%;">              
                </select>
              </div>          
              <div class="form-group">
                <label>Telefono del taller</label>
                  <input type="email" class="form-control select2" id="editartelnuevotaller" placeholder="Ingrese nombre del taller" style="width: 100%;">              
                  </select>
              </div>
              <div class="form-group">
                <label>Email del taller</label>
                  <input type="email" class="form-control select2" id="editaremailnuevotaller" placeholder="Ingrese nombre del taller" style="width: 100%;">              
                  </select>
              </div>
              <div class="form-group">
                <label>Calle</label>
                  <input type="text"class="form-control select2" id="editarcallenuevotaller" placeholder="Ingrese nombre del taller" style="width: 100%;">              
                  </select>
              </div>
              <div class="form-group">
                <label>Numero</label>
                  <input type="text"class="form-control select2" id="editarnumeronuevotaller" placeholder="Ingrese nombre del taller" style="width: 100%;">              
                  </select>
              </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group" id="grupolocalidadcambiar">
                  <label>localidad</label>
                    <input type="text"class="form-control select2" id="editartallerlocalidad" disabled  style="width: 100%;">              
                    </select>
                </div>
                <div class="form-group">
                    <label> Cambiar Localidad:</label>
                    <input type="text"class="form-control select2" id="editarlocalidadnueva" placeholder="Ingrese localidad" style="width: 100%;">              
                    <div clase="form-check form-check-inline nuevo-turnoscroll " id="editarlocalidadchek" >
                    </div>  
                </div>
                <div class="form-group">
                    <label>Administrador del taller</label>
                      <select class="form-control select2" id="editarseleccionadministrador" style="width: 100%;">              
                      </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      <div class="modal-footer modal-footer-uniform">
        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="editartalleradmin()" id="btneditartaller" disabled class="btn btn-bold btn-pure btn-primary float-right">Editar taller</button>
			</div>
    </div>
	</div>
</div>


<div class="modal center-modal fade" id="nuevo-servicio" tabindex="-1" style="display: block;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        <h5 class="modal-title">Alta de servicio</h5>
        <button type="button" class="close" data-dismiss="modal">
				  <span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
        <div class="col-md-12 col-12">
          <form action="">
            <div class="form-group">
              <label for="nombreservicio">Nombre del servicio</label>
              <input type="text" class="form-control" id="nombreservicio"   > 
            </div>
            <div class="form-group">
              <label for="descripcionservicio">Descripcion del servicio</label>
              <input type="text" class="form-control" id="descripcionservicio"   > 
            </div>
          
          </form>
        </div>
			</div>
      <div class="modal-footer modal-footer-uniform col-12">
        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-bold btn-pure btn-primary float-right" onclick="nuevoserviciosadministrador()">Crear servicio</button>
			</div>
		</div>
	</div>
</div>

<div class="modal center-modal fade" id="editars-servicio" tabindex="-1" style="display: block;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        <h5 class="modal-title">Alta de servicio</h5>
        <button type="button" class="close" data-dismiss="modal">
				  <span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
        <div class="col-md-12 col-12">
          <form action="">
            <div class="form-group">
              <label for="nombreservicio">Codigo de servicio</label>
              <input type="text" class="form-control" id="codservicioaditar"  disabled > 
            </div>
            <div class="form-group">
              <label for="nombreservicio">Nombre del servicio</label>
              <input type="text" class="form-control" id="nombreservicioeditar"   > 
            </div>
            <div class="form-group">
              <label for="descripcionservicio">Descripcion del servicio</label>
              <input type="text" class="form-control" id="descripcionservicioeditar"   > 
            </div>
          
          </form>
        </div>
			</div>
      <div class="modal-footer modal-footer-uniform col-12">
        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btneditarservicioadm"class="btn btn-bold btn-pure btn-primary float-right" disabled onclick="editarnuevoserviciosadministrador()">Modificar servicio</button>
			</div>
		</div>
	</div>
</div>

<div class="modal center-modal fade" id="editar-servicio" tabindex="-1" style="display: block;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
        <h5 class="modal-title">Nuevo Turno</h5>
        <button type="button" class="close" data-dismiss="modal">
				  <span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
        <div class="col-md-12 col-12">
          <form action="">
            <div class="form-group">
              <input type="text" class="form-control" disabled  placeholder="AF-352-LS" > 
            </div>
            <div class="form-group">
                  <label>Taller</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option value="">Seleccione Taller:</option>
                    <option >T1</option>
                    <option >T2</option>
                    <option >T3</option>
                  </select>
            </div>
            <div class="form-group">
              <input class="form-control" type="date" value="2011-08-19" id="fecha">
              <input class="form-control" type="time" value="13:45:00" id="hora">
            </div>
          </form>
        </div>
			</div>
      <div class="modal-footer modal-footer-uniform">
        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-bold btn-pure btn-primary float-right">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div class="modal center-modal fade" id="nuevo-taller" tabindex="-1" style="display: block;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
        <h5 class="modal-title">Nuevo Taller</h5>
        <button type="button" class="close" data-dismiss="modal">
				  <span aria-hidden="true">×</span>
				</button>
			</div>
 
			<div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label>Nombre del taller</label>
                    <input type="text" class="form-control select2" id="nombrenuevotaller" placeholder="Ingrese nombre del taller" style="width: 100%;">              
                </select>
              </div>          
              <div class="form-group">
                <label>Telefono del taller</label>
                  <input type="email" class="form-control select2" id="telnuevotaller" placeholder="Ingrese nombre del taller" style="width: 100%;">              
                  </select>
              </div>
              <div class="form-group">
                <label>Email del taller</label>
                  <input type="email" class="form-control select2" id="emailnuevotaller" placeholder="Ingrese nombre del taller" style="width: 100%;">              
                  </select>
              </div>
              <div class="form-group">
                <label>Calle</label>
                  <input type="text"class="form-control select2" id="callenuevotaller" placeholder="Ingrese nombre del taller" style="width: 100%;">              
                  </select>
              </div>
              <div class="form-group">
                <label>Numero</label>
                  <input type="text"class="form-control select2" id="numeronuevotaller" placeholder="Ingrese nombre del taller" style="width: 100%;">              
                  </select>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                  <label>Localidad:</label>
                  <input type="text"class="form-control select2" id="localidadnueva" placeholder="Ingrese localidad" style="width: 100%;">              
                  <div clase="form-check form-check-inline nuevo-turnoscroll " id="localidadchek" >
                  </div>  
              </div>
              <div class="form-group">
                  <label>Administrador del taller</label>
                    <select class="form-control select2" id="seleccionadministrador" style="width: 100%;">              
                    </select>
              </div>
              <div class="form-group">
                  <label>Seleccion de servicio</label>
                  <div clase="form-check form-check-inline nuevo-turnoscroll " id="nuevotallerservicios" >
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
        
      <div class="modal-footer modal-footer-uniform">
        <button type="button" class="btn btn-bold btn-pure btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="nuevotaller()"class="btn btn-bold btn-pure btn-primary float-right">Crear taller</button>
			</div>
    </div>
	</div>
</div>
  
  </body>
</html>


