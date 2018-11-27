jQuery(document).ready(function() 
{
  
    /*********************feCha */
    cargarpaginador();
    d=new Date();
    m=d.getUTCMonth()+1
    $fecha=d.getDate()+'/'+m+'/'+d.getFullYear()
    $("#fechaparaordenes").val($fecha.split("/").reverse().join("-"))
    //--taller
    cargarordenesdeservicio();
    cargarsolicitud();
    cargarordenescliente();
    //----cliente
    getdatosactualautocliente();
    getclienteproximoservicio();
    cargartipo();
    cargarmarca();
    listarmisautos();
    setInterval(revisar, 1000);
    cargarserviciosadministrador();
    cargartalleresadministrador(0);
   

    jQuery('#localidadnueva').keyup(function() {
      $(this).val($(this).val().toUpperCase());
    });
        
    $('#tunroscrollcliente').slimScroll({
      height: '150px'
    });

    $('#serviciocheckorden').slimScroll({
      height: '150px'
    });
    $('#tallerserviciochek').slimScroll({
      height: '150px'
    });
    
    $('#slimtest2').slimScroll({
          height: '150px'
    });
    $('#serviciosscroll').slimScroll({
        height: '150px'
    });
    $('#tablaeditarserviciodeorden').slimScroll({
      height: '150px'
    });
    $('#tallerservicio').slimScroll({
      height: '150px'
    });
    $('#nuevo-turnoscroll').slimScroll({
      height: '150px'
    });
    $('#asignarturnonuevo').slimScroll({
      height: '150px'
    });
    $('#modificarturnochek').slimScroll({
      height: '150px'
    });
    $('#nuevotallerservicios').slimScroll({
      height: '150px'
    });
    $('#localidadchek').slimScroll({
      height: '100px'
    });
    $('#editarlocalidadchek').slimScroll({
      height: '100px'
    });
    

    $('.modal').on('hidden.bs.modal', function(){
      $(this).removeData('bs.modal');
  });
   
    
    
  $('#sa-warning').click(function(){
      swal({
          title: "Quiere eliminar el vehiculo?",
          text: "Una vez eliminado, no podra ver el historial",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal({
              title:"Listo!",
              text:"Tu vehiculo se a eliminado", 
              icon: "success",
            });
          } else {
            swal({   
                  title:"Tu vehiculo esta a salvo",  
                  icon: "error"});
          }
      });
  });
  
  $('.eliminarorden').click(function(){
    swal({
        title: "¿Quiere eliminar el Orden?",
        text: "Una vez eliminado, Tendra que crear lo de nuevo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal({
            title:"Listo!",
            text:"se elimino", 
            icon: "success",
          });
        } else {
          swal({   
              title:"!Cancelado¡", 
                icon: "error"});
        }
      });
  });

  $('.eliminarsolicitud').click(function(){
    swal({
        title: "¿Quiere eliminar la Solicitud?",
        text: "Una vez eliminado, Tendra que crear lo de nuevo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal({
            title:"Listo!",
            text:"se elimino", 
            icon: "success",
          });
        } else {
          swal({   
              title:"!Cancelado¡", 
                icon: "error"});
        }
      });
  });

  $('.eliminarServicio').click(function(){
    swal({
        title: "¿Quiere eliminar el servicio?",
        text: "Una vez eliminado, Tendra que crear lo de nuevo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal({
            title:"Listo!",
            text:"se elimino", 
            icon: "success",
          });
        } else {
          swal({   
              title:"!Cancelado¡", 
                icon: "error"});
        }
      });
  });

  $('.baja-taller').click(function(){
    swal({
        title: "¿Quiere eliminar el Taller?",
        text: "Una vez eliminado, Tendra que crear lo de nuevo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal({
            title:"Listo!",
            text:"se elimino", 
            icon: "success",
          });
        } else {
          swal({   
              title:"!Cancelado¡", 
                icon: "error"});
        }
      });
  });


  $("#btnasignarturno").click(asignarorden)

////------------------botones con funciones de ajax-------------------

  $("#formasignarturnonuevo").submit(function(e){
      e.preventDefault();
      var select = [];
      $dominio=$("#dominionuevoturno").val();
      $fecha=$("#fechaordennuevoturno").val();
      $horario=$("#horaordennuevoturno").val();
      $obs=$("#obsdennuevoturno").val();
      $.each($("input[name='checkservicio']:checked"), function(){            
        select.push($(this).val());
      });
      if(select.length>0){
        $.ajax({
          url: "../clases/tabla.php",
          method: "GET",
          async: true,
          data: {funcion: "setordendeservicio",dominio:$dominio,fecha:$fecha,select:select,horario:$horario,obs:$obs},
          success: function(result) {
            if(result){
              swal({
                title: "¡Se cargo con exito!",
                text: " Turno para "+$dominio+" el dia "+$fecha,
                icon: "success",
                dangerMode: true,
              })
              cargarordenesdeservicio();
            }
            else{
              swal({
                title: "¡Ups!",
                text: "Pruebe de nuevo",
                icon: "error",
                dangerMode: true,
              })
            }

          }
      });
      }
      else{
        swal({
          title: "¡No selecciono servicio!",
          text: "Tiene que seleccionar un servicio",
          icon: "warning",
          dangerMode: true,
        })
      }
  })  

  $("#fechaparaordenes").change(cargarordenesdeservicio);

  $('#btnguardarturnomodificado').on("click",guardarturnoeditado);



$('#formeditarturno :checkbox').change(function() {
   $("#btnguardarturnomodificado").prop( "disabled", false );
});
$("#editarordenfecha").change(function(){
  $("#btnguardarturnomodificado").prop( "disabled", false );
})
$("#editarordenhorario").change(function(){
  $("#btnguardarturnomodificado").prop( "disabled", false );
})

$('#tallerserviciochek :checkbox').change(function() {
  $("#modificarserviciostaller").prop( "disabled", false );
});

$("#modificarserviciostaller").click(btnmodificarserviciotaller);

$("#listadetaller").change(cargardatostaller);

$("#selectmarca").change(cargarmodelo);
$("#selecciontipo").change(cargarmodelo);

$("#editarselectmarca").change(cargarmodeloeditar);
$("#editarselecciontipo").change(cargarmodeloeditar);

$("#editarseleccionmodelo").change(habilitarbotonupdate);
$("#editarnuevodominio").change(habilitarbotonupdate);
$("#editarañonuevoauto").change(habilitarbotonupdate);
$("#editarnuevomotor").change(habilitarbotonupdate);
$("#editarnuevochasis").change(habilitarbotonupdate);
$("#nombreservicioeditar").change( function(){
  $("#btneditarservicioadm").prop( "disabled", false );
});

$("#descripcionservicioeditar").change( function(){
  $("#btneditarservicioadm").prop( "disabled", false );
});
$("#localidadnuevotaller").change( function(){
  $("#cpnuevotaller").val($('#localidadnuevotaller option:selected').val());
});

$("#localidadnueva").keyup(cargarlocalidad);
$("#editarlocalidadnueva").keyup(editarcargarlocalidad);


$("#localidadchek").on('click', 'input[name="checkserviciotallersolicitud"]', function() {      
  $('input[name="checkserviciotallersolicitud"]').not(this).prop('checked', false);      
});
$("#editarlocalidadchek").on('click', 'input[name="editarcheckserviciotallersolicitud"]', function() {      
  $('input[name="editarcheckserviciotallersolicitud"]').not(this).prop('checked', false);
  $("#grupolocalidadcambiar").prop("hidden",true);
  $("#btneditartaller").prop("hidden",false);
  $("#editartallerlocalidad").val("");
});
 

$("#editarseleccionadministrador").change( function(){
  $("#btneditartaller").prop( "disabled", false );
});
$("#editarnumeronuevotaller").change( function(){
  $("#btneditartaller").prop( "disabled", false );
});
$("#editarcallenuevotaller").change( function(){
  $("#btneditartaller").prop( "disabled", false );
});
$("#editaremailnuevotaller").change( function(){
  $("#btneditartaller").prop( "disabled", false );
});
$("#editartelnuevotaller").change( function(){
  $("#btneditartaller").prop( "disabled", false );
});
$("#editarnombrenuevotaller").change( function(){
  $("#btneditartaller").prop( "disabled", false );
});





}) ///fin load




/****funciones de ajax */



function getsesion(){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "getsesion"},
    dataType: "json",
    success: function(respuesta) {      
        if(respuesta != null){
         //  console.log(respuesta)
        }
  }
})

}



function cargarordenesdeservicio(){
  $fecha=$("#fechaparaordenes").val();
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "gettablaordenes",fecha:$fecha},
    dataType: "json",
    success: function(respuesta) {
      if ( $.fn.dataTable.isDataTable( '#tordenes') ) {
        table = $('#tordenes').DataTable();
        table.destroy();
      }
      if(respuesta != null && $.isArray(respuesta)){
        $('#tordenesbody').html("");      
            $.each(respuesta, function(index, value){ 
               if(value.estado==2){
                $("#tordenesbody").append("<tr class='bg-green'><td>" + value.oid + "</td><td>" + value.dominio + "</td><td><span class='text-muted'><i class='fa fa-clock-o'></i>" + value.horario +'</td><td class="d-none sm-block ">'+value.nombre+'</td><td> <a href="#" data-toggle="modal" data-target="#ver-orden" onclick="verdetalleorden('+value.oid+','+value.tipo+')"> <span class="label bg-info"><i class="fa fa-eye"></i></span></a><a href="#" onclick=eliminarorden('+value.oid+','+value.tipo+')> <span class="label label-danger"><i class="fa fa-ban"></i></span></a></td></tr>');
               }
               else{
                $("#tordenesbody").append("<tr><td>" + value.oid + "</td><td>" + value.dominio + "</td><td><span class='text-muted'><i class='fa fa-clock-o'></i>" + value.horario +'</td><td class="d-none sm-block ">'+value.nombre+'</td><td> <a href="#" data-toggle="modal" data-target="#editar-orden" onclick="cargareditarorden('+value.oid+','+value.tipo+')"> <span class="label bg-green"><i class="fa fa-pencil"></i></span></a><a href="#" onclick=eliminarorden('+value.oid+','+value.tipo+')> <span class="label label-danger"><i class="fa fa-ban"></i></span><a href="#" onclick=cumplimentarorden('+value.oid+','+value.tipo+','+value.vid+')> <span class="label label-info"><i class="fa fa-check"></a></td></tr>');
               }
            });
          
            $('#tordenes').DataTable( {
              dom: 'Bfrtip',
              language: {
                url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
              },
              buttons: [
                  {extend:'copyHtml5',text:'Copiar'},
                  {extend:'excelHtml5', text:'Exportar a excel'},
                  {extend:'pdfHtml5',text:'Exportar a pdf'},
                  {extend:'print', text:'Imprimir'}
              ]
              });
        }
      else{
        console.log("salio error")
      } 
  }
})
}


function cargarsolicitud(){ 
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "gettablaservicio"},
    dataType: "json",
    success: function(respuesta) {
      if ( $.fn.dataTable.isDataTable( '#solturnostaller') ) {
        table = $('#solturnostaller').DataTable();
        table.destroy();
      }
      if(respuesta != null){
        $('#solturnostallerbody').html("");      
            $.each(respuesta, function(index, value){ 
              
                var val="'"+value.observacion+"'";
                $("#solturnostallerbody").append("<tr><td>"+ value.sid +"</td><td>" + value.dominio + "</td><td >"+value.nombre+'</td><td> <a href="#" data-toggle="modal" data-target="#asignar-turno" onclick="generarordenservicio('+value.sid+','+val+')"> <span class="label bg-green"><i class="fa fa-pencil"></i></span></a><a href="#" onclick=eliminarsolicitudservicio('+value.sid+')> <span class="label label-danger"><i class="fa fa-ban"></i></span></a></td></tr>');
            });
            $('#solturnostaller').DataTable( {
              dom: 'Bfrtip',
              language: {
                url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
              },
              buttons: [
                {extend:'copyHtml5',text:'Copiar'},
                {extend:'excelHtml5', text:'Exportar a excel'},
                {extend:'pdfHtml5',text:'Exportar a pdf'},
                {extend:'print', text:'Imprimir'}
            ]
            });
          
        }
      else{
        console.log("salio error");
      }
              
  }
})
}

function cargareditarorden($oid,$t){
  if($t==1){
    $buscar="select `ordenes-detalle`.oid, servicios.nombre, vehiculos.dominio,`ordenes-detalle`.observacion,  ordenes.fecha, ordenes.horario, codser as codserv from `ordenes-detalle` inner join ordenes on `ordenes-detalle`.oid = ordenes.oid inner join vehiculos on vehiculos.vid = ordenes.vid inner join servicios on servicios.codserv = `ordenes-detalle`.codser where `ordenes-detalle`.estado!=0 and ordenes.estado!=0 and  ordenes.oid="+$oid
    $("#editarordenestitulo").text("Edicion de orden generada por solicitud")
  }
  else{
    $buscar='select ordenentaller.otid as oid, `ordenentaller-detalle`.codserv,`ordenentaller-detalle`.observacion, servicios.nombre, ordenentaller.fecha, ordenentaller.horario, ordenentaller.dominio from `ordenentaller-detalle` inner join  ordenentaller on ordenentaller.otid =`ordenentaller-detalle`.otid inner join servicios on servicios.codserv=`ordenentaller-detalle`.codserv where ordenentaller.estado!=0 and `ordenentaller-detalle`.estado!=0 and ordenentaller.otid='+$oid
   $("#editarordenestitulo").text("Edicion de orden generada en taller")
  }
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "cargareditarorden",buscar:$buscar},
    dataType: "json",
    success: function(respuesta) {      
        if(respuesta != null && $.isArray(respuesta)){
            $("#modificarturnochek").find('input:checkbox').removeAttr('checked');
            $.each(respuesta, function(index, value){               
              $("#modificarturnochek").find("input:checkbox[value="+value.codserv+"]").attr("checked", true);
            });
          $("#dominioeditarorden").val(respuesta[0].dominio);
          $("#editarordenfecha").val(respuesta[0].fecha.split("/").reverse().join("-"));
          $("#editarordenhorario").val(respuesta[0].horario);
          $("#modificarturnoobservacion").val(respuesta[0].observacion);
          $("#editarordennumero").text(respuesta[0].oid);
        }
        
      }
  });
}

function verdetalleorden($oid,$t){
  if($t==1){
    $buscar="select `ordenes-detalle`.oid, servicios.nombre, vehiculos.dominio,`ordenes-detalle`.observacion,  ordenes.fecha, ordenes.horario, codser as codserv from `ordenes-detalle` inner join ordenes on `ordenes-detalle`.oid = ordenes.oid inner join vehiculos on vehiculos.vid = ordenes.vid inner join servicios on servicios.codserv = `ordenes-detalle`.codser where `ordenes-detalle`.estado!=0 and ordenes.estado!=0 and  ordenes.oid="+$oid
    $("#editarordenestitulo").text("Edicion de orden generada por solicitud")
  }
  else{
    $buscar='select ordenentaller.otid as oid, `ordenentaller-detalle`.codserv,`ordenentaller-detalle`.observacion, servicios.nombre, ordenentaller.fecha, ordenentaller.horario, ordenentaller.dominio from `ordenentaller-detalle` inner join  ordenentaller on ordenentaller.otid =`ordenentaller-detalle`.otid inner join servicios on servicios.codserv=`ordenentaller-detalle`.codserv where ordenentaller.estado!=0 and `ordenentaller-detalle`.estado!=0 and ordenentaller.otid='+$oid
   $("#editarordenestitulo").text("Edicion de orden generada en taller")
  }
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "cargareditarorden",buscar:$buscar},
    dataType: "json",
    success: function(respuesta) {     
        if(respuesta != null && $.isArray(respuesta)){
            $("#verturnochek").find('input:checkbox').removeAttr('checked');
            $.each(respuesta, function(index, value){               
              $("#verturnochek").find("input:checkbox[value="+value.codserv+"]").attr("checked", true);
            });
          $("#verdominioeditarorden").val(respuesta[0].dominio);
          $("#verordenfecha").val(respuesta[0].fecha.split("/").reverse().join("-"));
          $("#verordenhorario").val(respuesta[0].horario);
          $("#verturnoobservacion").val(respuesta[0].observacion);
          $("#verdennumero").text(respuesta[0].oid);
        }
        
      }
  });
}

function verdetalleordenclieten($oid){
  $buscar="select `ordenes-detalle`.oid, servicios.nombre, vehiculos.dominio,`ordenes-detalle`.observacion,  ordenes.fecha, ordenes.horario, codser as codserv from `ordenes-detalle` inner join ordenes on `ordenes-detalle`.oid = ordenes.oid inner join vehiculos on vehiculos.vid = ordenes.vid inner join servicios on servicios.codserv = `ordenes-detalle`.codser where `ordenes-detalle`.estado!=0 and ordenes.estado!=0 and  ordenes.oid="+$oid 
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "cargareditarorden",buscar:$buscar},
    dataType: "json",
    success: function(respuesta) {     
        if(respuesta != null && $.isArray(respuesta)){
            $("#verturnochekcliente").find('input:checkbox').removeAttr('checked');
            $.each(respuesta, function(index, value){               
              $("#verturnochekcliente").find("input:checkbox[value="+value.codserv+"]").attr("checked", true);
            });
          $("#verdominioeditarordencliente").val(respuesta[0].dominio);
          $("#verordenfechacliente").val(respuesta[0].fecha.split("/").reverse().join("-"));
          $("#verordenhorariocliente").val(respuesta[0].horario);
          $("#verordenobservacioncliente").val(respuesta[0].observacion);
          $("#vernumeroordencliente").text(respuesta[0].oid);
        }
        
      }
  });
}
function extrastabla(){
  $('.tablas').DataTable( {
    dom: 'Bfrtip',
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
    },
    buttons: [
      {extend:'copyHtml5',text:'Copiar'},
      {extend:'excelHtml5', text:'Exportar a excel'},
      {extend:'pdfHtml5',text:'Exportar a pdf'},
      {extend:'print', text:'Imprimir'}
  ]
  });
}

function guardarturnoeditado(){
  var select = [];
  $oid=$("#editarordennumero").text();
  if($("#editarordenestitulo").text()=="Edicion de orden generada por solicitud"){
    $t=true;
  }
  else{
    $t=false;
  }
  $dominio=$("#dominionuevoturno").val();
  $fecha=$("#editarordenfecha").val();
  $horario=$("#editarordenhorario").val();
  $obs=$("#modificarturnoobservacion").val();
  $.each($("input[name='checkserviciomodificar']:checked"), function(){            
    select.push($(this).val());
  });
  if(select.length>0){
    $.ajax({
      url: "../clases/tabla.php",
      method: "GET",
      async: true,
      data: {funcion: "modificarturnoasignado",oid:$oid,t:$t,dominio:$dominio,fecha:$fecha,select:select,horario:$horario,obs:$obs},
      success: function(result) {
        if(result){
          swal({
            title: "¡Se modificado con exito!",
            text: " el Turno para el vehiculo: "+$dominio,
            icon: "success",
            dangerMode: true,
          })
          cargarordenesdeservicio();
        }
        else{
          swal({
            title: "¡Ups!",
            text: "Pruebe de nuevo",
            icon: "error",
            dangerMode: true,
          })
        }

      }
    });
    
  }
  else{
    swal({
      title: "¡No selecciono servicio!",
      text: "Tiene que seleccionar un servicio",
      icon: "warning",
      dangerMode: true,
    })
  }
}  

function eliminarorden($oid,$t){
  swal({
    title: "¿Quiere eliminar el servicio?",
    text: "Una vez eliminado, Tendra que crear lo de nuevo",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: "../clases/tabla.php",
        method: "GET",
        async: true,
        data: {funcion: "eliminarorden", oid:$oid, t:$t},
        success: function(result) {
          if(result){
            swal({
              title: "¡Se eliminado con exito!",
              text: "No se podra recuperar",
              icon: "success",
              dangerMode: true,
            })
            cargarordenesdeservicio();
          }
          else{
            swal({
              title: "¡Ups!",
              text: "Pruebe de nuevo",
              icon: "error",
              dangerMode: true,
            })
          }
    
        }
      });
    } else {
      swal({   
          title:"!Cancelado¡", 
            icon: "error"});
    }
  });
}
function generarordenservicio($sid,$ob)
{
  $("#observacioneclientesolicitud").val($ob);
  $("#asignarturnosolicitudnro").text($sid);

  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "cargarordenservicio",sid:$sid},
    dataType: "json",
    success: function(respuesta) {     
        if(respuesta != null && $.isArray(respuesta)){
            $("#serviciocheckorden").find('input:checkbox').removeAttr('checked');
            $.each(respuesta, function(index, value){               
              $("#serviciocheckorden").find("input:checkbox[value="+value.codserv+"]").attr("checked", true);

            });
            $("#dominioserv").val(respuesta[0].dominio)
        }
        
        
      }
  });
  

}
function asignarorden(){
  $sid=$("#asignarturnosolicitudnro").text();
  var $hora=$("#horasolicitudorden").val();
  var $fecha=$("#fechasolicitudorden").val();
  var $vid;
  var $tid;
  var $select=[];
  var $observacion=$("#tallerobservacioneclientesolicitud").val()
    $.ajax({
      url: "../clases/tabla.php",
      method: "GET",
      async: true,
      data: {funcion: "cargarordenservicio",sid:$sid},
      dataType: "json",
      success: function(respuesta) {     
          if(respuesta != null){
          $vid=respuesta[0].vid;
          $tid=respuesta[0].tid    
          }
          $.each($("input[name='checkservicioserviciosorden']:checked"), function(){            
            $select.push($(this).val());
          });
        }
        
    });

    $.ajax({
      url: "../clases/tabla.php",
      method: "GET",
      async: true,
      data: {funcion: "asignarturno", sid:$sid, vid:$vid, tid:$tid, fecha:$fecha, hora:$hora, select:$select, observacion:$observacion},
      dataType: "json",
      success: function(respuesta) {  
        if(respuesta){
          swal({
            title: "¡Se generado la orden con exito!",
            text: " el Turno para la solicitud "+$sid,
            icon: "success",
            dangerMode: true,
          })
        }
        cargarsolicitud();
      }
    });

    $(".modal .close").click();

}

function eliminarsolicitudservicio($sid){
  swal({
    title: "¿Quiere eliminar la solicitud?",
    text: "Una vez eliminada, el cliente tendra que crearla denuevo",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: "../clases/tabla.php",
        method: "GET",
        async: true,
        data: {funcion: "anularsolicitud", sid:$sid},
        dataType: "json",
        success: function(respuesta) {     
            if(respuesta){
              swal({
                title:"Listo!",
                text:"se elimino la solicitud", 
                icon: "success",
              });
              cargarsolicitud();
            }
          }
      });
    } else {
      swal({   
          title:"!Cancelado¡", 
            icon: "error"});
    }
  });
}

function cargarserviciostaller(){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "serviciostaller"},
    dataType: "json",
    success: function(respuesta) {     
        if(respuesta){
          $("#editartallernombre").val(respuesta[0].taller);
          $("#talleradministrador").val(respuesta[0].nombre);
          $("#tallerserviciochek").find('input:checkbox').removeAttr('checked');
            $.each(respuesta, function(index, value){               
              $("#tallerserviciochek").find("input:checkbox[value="+value.codserv+"]").attr("checked", true);

            });
          
        }
      }
  });

}

function btnmodificarserviciotaller(){
  var $select=[];
  $.each($("input[name='tallerservicioeditar']:checked"), function(){            
    $select.push($(this).val());
  });
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "modificarserviciotaller",select:$select},
    dataType: "json",
    success: function(respuesta) {     
        if(respuesta){
          swal({
            title: "¡Se modificado con exito!",
            text: "ya se encuentran disponibles los servicios configurados",
            icon: "success",
            dangerMode: true,
          })

            
        }
    }
  });
  $(".modal .close").click();
}

function cumplimentarorden($oid,$tipo,$vid){
   $fecha=$("#fechaparaordenes").val();
  swal({
      title: "¿Orden finalizada?",
      text: "¿Quiere dar por finalizada la Orden?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        if($tipo==1){
          swal({
            title:"Cumplimentar Orden",
            text:"Ingrese el quilometraje",
            content: "input",
          }).then((value) => {
            if($.isNumeric(value)){
              $.ajax({
                url: "../clases/tabla.php",
                method: "GET",
                async: true,
                data: {funcion: "cumplimentarorden", oid:$oid,tipo:true, vid:$vid,km:value,fecha:$fecha},
                dataType: "json",
                success: function(respuesta) { 
                  if(respuesta){
                    cargarordenesdeservicio();
                    swal({
                      title:"Listo!",
                      text:`Se dio por finalizada la orden y se cargaron los ${value} Km`, 
                      icon: "success",
                      
                    });
                  }
                 
                }
              });   
            }
            else{
              swal({
                title:"Error!",
                text:`El km debe de ser numerico`, 
                icon: "error",
                
              });
            }
                    
          });
        }
        else{
          $.ajax({
            url: "../clases/tabla.php",
            method: "GET",
            async: true,
            data: {funcion: "cumplimentarorden",oid:$oid,tipo:$tipo,vid:"null",km:"null",fecha:"null"},
            dataType: "json",
            success: function(respuesta) {  
              if(respuesta){
                cargarordenesdeservicio();
                swal({
                  title:"Listo!",
                  text:`Se dio por finalizada la orden`, 
                  icon: "success",
                  
                });
              }
            }
          });
        }   
      } 
      else {
        swal({   
            title:"!Cancelado¡", 
              icon: "error"
        });
      }
    });
}


//cliente

function getdatosactualautocliente(){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "getkmydomautocliente"},
    dataType: "json",
    success: function(respuesta) {     
        if(respuesta != null){
            $("#dominioautocliente").text(respuesta[0].dominio);
            $("#kmautocliente").text(respuesta[0].km);
        }
        
      }
  });

}

function getclienteproximoservicio(){
$.ajax({
  url: "../clases/tabla.php",
  method: "GET",
  async: true,
  data: {funcion: "getproximoserviciocliente"},
  dataType: "json",
  success: function(respuesta) {   
      if(respuesta != null){
        if(respuesta[0].servicio==null){
          $("#proximoserviciocliente").text("No registra proximo servicio");
        }
        else {
          ordendeservicio
            $("#ordendeservicio").val(respuesta[0].oid);
            $("#proximoserviciocliente").text(respuesta[0].servicio);
          
          
        }
          
      }
      
    }
});
}

function proximoturnoscliente(){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "proximoturnoscliente"},
    dataType: "json",
    success: function(respuesta) {
    
      if(respuesta != null){
        $('#proximosturnosclientebody').html("");      
            $.each(respuesta, function(index, value){ 
              if(new Date(value.fecha).getTime()> new Date().getTime()){
                $("#proximosturnosclientebody").append("<tr><td class='d-none d-sm-block'>" + value.oid + "</td><td>" + value.dominio + "</td><td>" + value.nombre+ "</td><td>" + value.fecha +'</td><td class="d-none d-sm-block">'+value.servicios+'</td></tr>');
              } 
               
            });
          
            
        }
      else{
        console.log("salio error")
      } 
  }
})
}

function cargarordenescliente(){
  
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "servicioauto"},
    dataType: "json",
    success: function(respuesta) {;
      if ( $.fn.dataTable.isDataTable( '#ordenescliente') ) {
        table = $('#ordenescliente').DataTable();
        table.destroy();
      }
      if(respuesta != null && $.isArray(respuesta)){
        $('#ordenesclientebody').html("");
        if(respuesta[0].oid==null){
          $('#ordenesclientebody').html("No registra");
        }   
        else{

           
            $.each(respuesta, function(index, value){ 
                $("#ordenesclientebody").append("<tr><td >" + value.oid + "</td><td>" + value.taller+ "</td><td><span class='text-muted'><i class='fa fa-clock-o'></i>" + value.fecha +'</td><td>'+value.servicio+'</td><td >'+value.km+'</td><td> <a href="#" data-toggle="modal" data-target="#ver-ordencliente" onclick="verdetalleordenclieten('+value.oid+')"> <span class="label bg-info"><i class="fa fa-eye"></i></span></a></span></a></td></tr>');
            });
        } 
            $('#ordenescliente').DataTable( {
              dom: 'Bfrtip',
              language: {
                url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
              },
              buttons: [
                {extend:'copyHtml5',text:'Copiar'},
                {extend:'excelHtml5', text:'Exportar a excel'},
                {extend:'pdfHtml5',text:'Exportar a pdf'},
                {extend:'print', text:'Imprimir'}
            ]
            });
        }
      else{
        console.log("salio error")
      } 
  }
})
}

function cargarautoselect(){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "selectvehiculos"},
    dataType: "json",
    success: function(respuesta) {
      if(respuesta != null){
            $('#selecciondevehiculocliente').empty();
            $('#selecciondevehiculocliente').append($('<option>', {
              value:"",
              text: "seleccione su vehiculo",
              hidden: true,
              selected: true
          }));
            $.each(respuesta, function(index, value){ 
              $('#selecciondevehiculocliente').append($('<option>', {
                value: value.vid,
                text: value.dominio
            }));
            });
          
        cargarlistadetaller()
      }
      else{
        console.log("salio error")
      } 
  }
})

}

function cargarsolicitudnuevoturno(){
  var $select=[]
  $.each($("input[name='servicioclientesolicitudchek']:checked"), function(){            
    $select.push($(this).val());
  });
  $vid=$('#selecciondevehiculocliente option:selected').val()
  $obs=$("#servicioclientesolicitudchek").val();
  d=new Date()
  $fecha=d.getFullYear+'-'+d.getUTCMonth+1+'-'+d.getDate
  if($select.length>0){
    $.ajax({
      url: "../clases/tabla.php",
      method: "GET",
      async: true,
      data: {funcion: "nuevasolicitud",vid:$vid},
      dataType: "json",
      success: function(respuesta) {     
         
          
        }
    });

  }
  else{
    swal({
      title: "¡No selecciono servicio!",
      text: "Tiene que seleccionar un servicio",
      icon: "warning",
      dangerMode: true,
    });

  }

}

function cargarlistadetaller(){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "listadetaller"},
    dataType: "json",
    success: function(respuesta) {
      if(respuesta != null){ 
        $('#listadetaller').empty(); 
        $('#listadetaller').append($('<option>', {
          value:"",
          text: "seleccionar el taller",
          hidden: true,
          selected: true
      }));
            $.each(respuesta, function(index, value){ 
              $('#listadetaller').append($('<option>', {
                value: value.tid,
                text: value.nombre
            }));
            });
          
            
        }
      else{
        console.log("salio error")
      } 
  }
})
 }

 function cargardatostaller(){
   $tid=$("#listadetaller").val();
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "obtenerdatostaller",tid:$tid},
    dataType: "json",
    success: function(respuesta) {
     $("#datosdeltaller").val(respuesta[0].nombre+" calle: "+respuesta[0].calle+" nro "+respuesta[0].nro+" localidad: "+respuesta[0].localidad+" tel: "+respuesta[0].telefono+" email: "+respuesta[0].email)
     cargarserviciosdetaller($tid)
    }
  })
 }

function cargarserviciosdetaller($tid){  
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "serviciodeltaller",tid:$tid},
    dataType: "json",
    success: function(respuesta) {
      $("#serviciosdetaller").empty();
      $.each(respuesta, function(index, value){ 
         $("#serviciosdetaller").append('<input class="form-check-input col-4" type="checkbox" name="checkserviciotallersolicitud"  id="scr'+value.codserv+'" value="'+value.codserv+'"> <label class="form-check-label col-6" for="scr'+value.codserv+'">'+value.nombre+'</label><br>');

      })
    }
  })
}

function guardarsolicitud(){
  let $select=[];
  d= new Date();
  $fecha= d.getUTCFullYear()+"-"+(d.getUTCMonth()+1)+"-"+d.getDate();
  $obs=$("#observacionescliente").val();
  $vid=$("#selecciondevehiculocliente").val()
  $tid=$("#listadetaller").val()
  $.each($("input[name='checkserviciotallersolicitud']:checked"), function(){            
    $select.push($(this).val());
  });
  if($vid==""){
    swal({
      title: "Seleccione vehiculo",
      text: "debe seleccionar un vehiculo",
      icon: "error",
      dangerMode: true,
    })
  }
  else{
    if($tid==""){
      swal({
        title: "Seleccione taller",
        text: "debe seleccionar un taller",
        icon: "error",
        dangerMode: true,
      })
    }
    else{
      if($select>0){
        $.ajax({
          url: "../clases/tabla.php",
          method: "GET",
          async: true,
          data: {funcion: "generarsolicitud", vid:$vid, tid:$tid, select:$select, obs:$obs, fecha:$fecha},
          dataType: "json",
          success: function(respuesta) {
            if(respuesta){
              swal({
                title: "Se a generado la solicitud",
                text: "Espere a que el taller asigne un dia",
                icon: "success",
                dangerMode: true,
              })
            }            
          }
        })
        $(".modal .close").click();

      }
      else{
        swal({
          title: "Seleccione servicio",
          text: "debe seleccionar un servicio por lo menos",
          icon: "error",
          dangerMode: true,
        })
      }
    }
  }

}

function solicitudesactivas(){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "solicitudesactivas"},
    dataType: "json",
    success: function(respuesta) {
      if(respuesta != null){
        $('#solicitudesclientebody').html("");      
            $.each(respuesta, function(index, value){ 
                $("#solicitudesclientebody").append("<tr><td class='d-none d-sm-block'>" + value.sid + "</td><td>" + value.dominio + "</td><td>" + value.nombre+ "</td><td>" + value.fecha +'</td><td class="d-none d-sm-block">'+value.servicios+'</td></tr>');
              
               
            });
          
            
        }
      }
    })
}

function cargarmodelo(){
  $codtipo=$("#selecciontipo").val()
  $codmarca=$("#selectmarca").val()
  if($codtipo!="" || $codmarca!=""){
    $.ajax({
      url: "../clases/tabla.php",
      method: "GET",
      async: true,
      data: {funcion: "selectmodelo",codmarca:$codmarca,codtipo:$codtipo},
      dataType: "json",
      success: function(respuesta) {
        if(respuesta != null){ 
          $('#seleccionmodelo').empty(); 
          $('#seleccionmodelo').append($('<option>', {
            value:"",
            text: "seleccionar el modelo",
            hidden: true,
            selected: true
        }));
              $.each(respuesta, function(index, value){ 
                $('#seleccionmodelo').append($('<option>', {
                  value: value.codmodelo,
                  text: value.nombremodelo
              }));
              });
            
              
          }
        else{
          console.log("salio error")
        } 
    }
  })
  }
}
function cargarmarca(){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "selectmarca"},
    dataType: "json",
    success: function(respuesta) {
      if(respuesta != null){ 
        $('#selectmarca').empty(); 
        $('#selectmarca').append($('<option>', {
          value:"",
          text: "seleccionar la marca",
          hidden: true,
          selected: true
             }));
        $.each(respuesta, function(index, value){ 
            $('#selectmarca').append($('<option>', {
                value: value.codmarca,
                text: value.nombre
          }));
        });
          
            
        }
      else{
        console.log("salio error")
      } 
  }
})

}
function cargartipo(){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "selecttipovehiculo"},
    dataType: "json",
    success: function(respuesta) {
      if(respuesta != null){ 
        $('#selecciontipo').empty(); 
        $('#selecciontipo').append($('<option>', {
          value:"",
          text: "seleccionar el tipo de vehiculo",
          hidden: true,
          selected: true
      }));
            $.each(respuesta, function(index, value){ 
              $('#selecciontipo').append($('<option>', {
                value: value.codtipo,
                text: value.tipo
            }));
            });
          
            
        }
      else{
        console.log("salio error")
      } 
  }
})
}

function cargarvehiculonuevo(){
  $codmodelo=$("#seleccionmodelo").val()
  $dominio=$("#nuevodominio").val();
  $ano=$("#añonuevoauto").val()
  $motor=$("#nuevomotor").val()
  $chasis=$("#nuevochasis").val()
  if($codmodelo==null || $codmodelo==""){
    swal({
      title: "Seleccione modelo",
      text: "debe seleccionar un modelo",
      icon: "error",
      dangerMode: true,
    })
  }
  else
  {
    if($dominio==""){
      swal({
        title: "Ingrese dominio",
        text: "debe ingresar un dominio",
        icon: "error",
        dangerMode: true,
      })
    }
    else
    {
      if($ano==""){
        swal({
          title: "Ingrese un año",
          text: "debe ingresar un año",
          icon: "error",
          dangerMode: true,
        })
      }
      else
      {
        if($motor==""){
          swal({
            title: "Ingrese un numero de motor",
            text: "debe ingresar un numero de motor",
            icon: "error",
            dangerMode: true,
          })
        }
        else{
          if($chasis==""){
            swal({
              title: "Ingrese numero chasis",
              text: "debe ingresar un numero de chasis",
              icon: "error",
              dangerMode: true,
            })
          }
          else{

            $.ajax({
              url: "../clases/tabla.php",
              method: "GET",
              async: true,
              data: {funcion: "altaauto",codmodelo:$codmodelo,dominio:$dominio,ano:$ano,motor:$motor,chasis:$chasis},
              dataType: "json",
              success: function(respuesta) {
                if(respuesta){ 
                  listarmisautos();
                  $(".modal .close").click();
                  swal({
                    title: "Cargado con exito!",
                    text: "Se ah registrado con exito el vehiculo",
                    icon: "success",
                    dangerMode: true,
                  })
                      
                }
                else{
                  console.log("salio error")
                } 
              
              }
            })
          }
        }
      }
    }
  }
}

function listarmisautos(){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "getmisautos"},
    dataType: "json",
    success: function(respuesta){ 
      if(respuesta != null){ 
        $('#listadevehiculoscliente').empty(); 
        $.each(respuesta, function(index, value){ 
          
          $('#listadevehiculoscliente').append('<li ><a href="#" onclick="setvehiculo('+value.vid+')"><i class="fa fa-car"></i>'+value.dominio+'</a></li>');
                     
        })
      }
      else{
        console.log("salio error")
      } 
  }
})
}

function setvehiculo($vid){ 
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "setvehiculo",vid:$vid},
    dataType: "json",
    success: function(respuesta){ 
  }
})
getdatosactualautocliente();
cargarordenescliente();
getclienteproximoservicio();
}

function editarautotipo(){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "selecttipovehiculo"},
    dataType: "json",
    success: function(respuesta) {
      if(respuesta != null){ 
        $('#editarselecciontipo').empty(); 
            $.each(respuesta, function(index, value){ 
              $('#editarselecciontipo').append($('<option>', {
                value: value.codtipo,
                text: value.tipo
            }));
            });
          
            
        }
      else{
        console.log("salio error")
      } 
  }
})

}

function editarautomarca(){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "selectmarca"},
    dataType: "json",
    success: function(respuesta) {
      if(respuesta != null){ 
        $('#editarselectmarca').empty(); 
        $.each(respuesta, function(index, value){ 
            $('#editarselectmarca').append($('<option>', {
                value: value.codmarca,
                text: value.nombre
          }));
        });
          
            
        }
      else{
        console.log("salio error")
      } 
  }
  })
}

function cargarmodeloeditar(){
  $codtipo=$("#editarselecciontipo").val()
  $codmarca=$("#editarselectmarca").val()
  if($codtipo!="" || $codmarca!=""){
    $.ajax({
      url: "../clases/tabla.php",
      method: "GET",
      async: true,
      data: {funcion: "selectmodelo",codmarca:$codmarca,codtipo:$codtipo},
      dataType: "json",
      success: function(respuesta) {
        if(respuesta != null){ 
          $('#editarseleccionmodelo').empty(); 
          $('#editarseleccionmodelo').append($('<option>', {
            value:"",
            text: "seleccionar el modelo",
            hidden: true,
            selected: true
        }));
              $.each(respuesta, function(index, value){ 
                $('#editarseleccionmodelo').append($('<option>', {
                  value: value.codmodelo,
                  text: value.nombremodelo
              }));
              });
            
              
          }
        else{
          console.log("salio error")
        } 
    }
  })
  }
}


function todoslosdatosvehiculo(){
  editarautomarca();
  editarautotipo();
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "todoslosdatosvehiculo"},
    dataType: "json",
    success: function(respuesta){ 
      $('#editarseleccionmodelo').empty(); 

      $('#editarselecciontipo option[value='+respuesta[0].codtipo+']').prop("selected", true);
      $('#editarselectmarca option[value='+respuesta[0].codmarca+']').prop("selected", true);
      $('#editarseleccionmodelo').append($('<option>', {
        value: respuesta[0].codmodelo,
        text: respuesta[0].nombremodelo,
        hidden: true,
        selected: true
    }));
    $("#editarnuevodominio").val(respuesta[0].dominio);
    $("#editarañonuevoauto").val(respuesta[0].año);
    $("#editarnuevomotor").val(respuesta[0].motor);
    $("#editarnuevochasis").val(respuesta[0].chasis);
    
  }
})
}


function editarvehiculocliente(){
  $codmodelo=$("#editarseleccionmodelo").val()
  $dominio=$("#editarnuevodominio").val();
  $ano=$("#editarañonuevoauto").val()
  $motor=$("#editarnuevomotor").val()
  $chasis=$("#editarnuevochasis").val()
  if($codmodelo==null || $codmodelo==""){
    swal({
      title: "Seleccione modelo",
      text: "debe seleccionar un modelo",
      icon: "error",
      dangerMode: true,
    })
  }
  else
  {
    if($dominio==""){
      swal({
        title: "Ingrese dominio",
        text: "debe ingresar un dominio",
        icon: "error",
        dangerMode: true,
      })
    }
    else
    {
      if($ano==""){
        swal({
          title: "Ingrese un año",
          text: "debe ingresar un año",
          icon: "error",
          dangerMode: true,
        })
      }
      else
      {
        if($motor==""){
          swal({
            title: "Ingrese un numero de motor",
            text: "debe ingresar un numero de motor",
            icon: "error",
            dangerMode: true,
          })
        }
        else{
          if($chasis==""){
            swal({
              title: "Ingrese numero chasis",
              text: "debe ingresar un numero de chasis",
              icon: "error",
              dangerMode: true,
            })
          }
          else{
            $.ajax({
              url: "../clases/tabla.php",
              method: "GET",
              async: true,
              data: {funcion: "updateauto",codmodelo:$codmodelo,dominio:$dominio,ano:$ano,motor:$motor,chasis:$chasis},
              dataType: "json",
              success: function(respuesta) {
                if(respuesta){ 
                  listarmisautos();
                  swal({
                    title: "Actualizo con exito!",
                    text: "Se ah registrado con exito el vehiculo",
                    icon: "success",
                    dangerMode: true,
                  })

                }
                else{
                  console.log("salio error")
                } 
              
              }
            })
          }
        }
      }
    }
  }
}

function habilitarbotonupdate(){
  $("#btnactualizarauto").prop('disabled', false);
}

function eliminarautocliente(){
  swal({
    title: "¿Quiere eliminar el vehiculo?",
    text: "Una vez eliminado, no podra acceder a sus datos",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: "../clases/tabla.php",
        method: "GET",
        async: true,
        data: {funcion: "eliminarauto"},
        dataType: "json",
        success: function(respuesta) {
          if(respuesta){
            listarmisautos();
            getdatosactualautocliente();
            getclienteproximoservicio();
            swal({
              title: "Eliminado",
              text: "Se ah eliminado el vehiculo",
              icon: "success",
              dangerMode: true,
            })
          } 
      }
      })
    } else {
      swal({   
          title:"!Cancelado¡", 
            icon: "error"});
    }
  });
 
}

function revisar(){
  if($("#dominioautocliente").text()==""){
    desabilitar();
  }
  else{
    abilitar();
  }
}

function desabilitar(){
  $("#usuariodato1").prop("hidden",true);
  $("#usuariodato2").prop("hidden",true);
  $("#Seleccionevehiculo").prop("hidden",false);
}
function abilitar(){
  $("#usuariodato1").prop("hidden",false);
  $("#usuariodato2").prop("hidden",false);
  $("#Seleccionevehiculo").prop("hidden",true);
}

function cargarkmcliente(){
  d=new Date()
  $fecha=d.getFullYear()+'-'+(d.getUTCMonth()+1)+'-'+d.getDate()
  swal({
    title:"Ingrese el Kilometraje",
    content: "input",
  }).then((value) => {
    if(value!="" && $.isNumeric(value)){
      $.ajax({
        url: "../clases/tabla.php",
        method: "GET",
        async: true,
        data: {funcion: "cargarkmcliente", km:value,fecha:$fecha},
        dataType: "json",
        success: function(respuesta) {
          if(respuesta){
            swal(`Se modifico el Kilometraje a: ${value} Km`);
            getdatosactualautocliente();
          }
          
      }
      })
    }
    
  });
  
}


function cargarserviciosadministrador(){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "serviciosadministrado"},
    dataType: "json",
    success: function(respuesta) {
      if ( $.fn.dataTable.isDataTable( '#tablaservicioadministrador') ) {
        table = $('#tablaservicioadministrador').DataTable();
        table.destroy();
      }
      if(respuesta != null && $.isArray(respuesta)){
        $('#tablaservicioadministradorbody').html("");
        if(respuesta[0].codserv==null){
          $('#tablaservicioadministradorbody').html("Sin servicios cargados");
        }   
        else{
            $.each(respuesta, function(index, value){ 
                $("#tablaservicioadministradorbody").append("<tr><td>" + value.codserv + "</td><td>" + value.nombre+ "</td><td><span class='text-muted'>" + value.descripcion +'</td><td> <a href="#" data-toggle="modal" data-target="#editars-servicio" onclick="cargarformularioservicioservicioaeditar('+value.codserv+",'"+value.nombre+"','"+value.descripcion+"'"+')"> <span class="label bg-info"><i class="fa fa-pencil"></i></span></a><a href="#" onclick="eliminarservicioadm('+value.codserv+')"> <span class="label bg-danger"><i class="fa fa-ban"></i></span></a></span></a></td></tr>');
            });
        } 
            $('#tablaservicioadministrador').DataTable( {
              dom: 'Bfrtip',
              language: {
                url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
              },
              buttons: [
                {extend:'copyHtml5',text:'Copiar'},
                {extend:'excelHtml5', text:'Exportar a excel'},
                {extend:'pdfHtml5',text:'Exportar a pdf'},
                {extend:'print', text:'Imprimir'}
            ]
            });
        }
      else{
        console.log("salio error")
      } 
  }
})

}



function nuevoserviciosadministrador(){
  var $nombre=$("#nombreservicio").val();
  var $desc=$("#descripcionservicio").val();
  if($nombre==""){
    swal({
      title: "Ingrese un numbre",
      text: "debe ingresar un nombre",
      icon: "error",
      dangerMode: false,
    })
  }
  else{
    if($desc==""){
      swal({
        title: "Ingrese una descripcion",
        text: "debe ingresar una descripcion",
        icon: "error",
        dangerMode: false,
      })
    }
    else{
      $.ajax({
        url: "../clases/tabla.php",
        method: "GET",
        async: true,
        data: {funcion: "nuevoservicio", nombre:$nombre,desc:$desc},
        dataType: "json",
        success: function(respuesta) {
          if(respuesta){
            swal({
              title: "Nuevo servicio",
              text: "se encuentra disponible el nuevo servicio",
              icon: "success",
              dangerMode: true,
            })
            cargarserviciosadministrador();
          }
          
      }
      })
    }
  }
 
}


function eliminarservicioadm($codserv){
  swal({
    title: "¿Quiere eliminar el vehiculo?",
    text: "Una vez eliminado, no podra acceder a sus datos",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: "../clases/tabla.php",
        method: "GET",
        async: true,
        data: {funcion: "eliminarservicioadm", codserv:$codserv},
        dataType: "json",
        success: function(respuesta) {
          if(respuesta){
            swal({
              title: "Se elimino servicio",
              text: "Se elimino el servicio",
              icon: "success",
              dangerMode: true,
            })
            cargarserviciosadministrador();
            $(".modal .close").click();
          }
      }
      })
    } else {
      swal({   
          title:"!Cancelado¡", 
            icon: "error"});
    }
  });
}

function cargarformularioservicioservicioaeditar($codigo,$nombre,$desc){
 $("#codservicioaditar").val($codigo);
 $("#nombreservicioeditar").val($nombre);
 $("#descripcionservicioeditar").val($desc);

}
function editarnuevoserviciosadministrador($codserv){
  var $codserv=$("#codservicioaditar").val();
  var $nombre=$("#nombreservicioeditar").val();
  var $desc=$("#descripcionservicioeditar").val();
  if($nombre==""){
    swal({
      title: "Ingrese un nombre",
      text: "debe ingresar un nombre",
      icon: "error",
      dangerMode: false,
    })
  }
  else{
    if($desc==""){
      swal({
        title: "Ingrese una descripcion",
        text: "debe ingresar una descripcion",
        icon: "error",
        dangerMode: false,
      })
    }
    else{
      $.ajax({
        url: "../clases/tabla.php",
        method: "GET",
        async: true,
        data: {funcion: "nuevoservicioeditar", nombre:$nombre,desc:$desc,codserv:$codserv},
        dataType: "json",
        success: function(respuesta) {
          if(respuesta){
            swal({
              title: "Nuevo servicio",
              text: "se encuentra disponible el nuevo servicio",
              icon: "success",
              dangerMode: true,
            })
            cargarserviciosadministrador();
          }
          
      }
      })
    }
 }  
}

function cargardamdtallernuevo(){
   $.ajax({
     url: "../clases/tabla.php",
     method: "GET",
     async: true,
     data: {funcion: "datosadministradortaller"},
     dataType: "json",
     success: function(respuesta) {
       if(respuesta != null){
         $('#seleccionadministrador').empty();
         $('#seleccionadministrador').append($('<option>', {
           value:"",
           text: "seleccione el administrador",
           hidden: true,
           selected: true
       }));
         $.each(respuesta, function(index, value){ 
           $('#seleccionadministrador').append($('<option>', {
             value: value.uid,
             text: value.nombre+" "+ value.apellido
         }));
         });
      
         
       }
   }
   })
   $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "todoslosservicios"},
    dataType: "json",
    success: function(respuesta) {
      $("#nuevotallerservicios").empty();
      $.each(respuesta, function(index, value){ 
         $("#nuevotallerservicios").append('<input class="form-check-input col-4" type="checkbox" name="nuevotallerservicioselect"  id="snt'+value.codserv+'" value="'+value.codserv+'"> <label class="form-check-label col-6" for="snt'+value.codserv+'">'+value.nombre+'</label><br>');

      })
    }
  })
 
 }

function nuevotaller(){
let $select=[];
var regex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
$nombre=$("#nombrenuevotaller").val();
$telefono=$("#telnuevotaller").val();
$email=$("#emailnuevotaller").val();
$calle=$("#callenuevotaller").val();
$nro=$("#numeronuevotaller").val();
$codloca=$("input[name='checkserviciotallersolicitud']:checked").val();
$uid=$("#seleccionadministrador").val();
$.each($("input[name='nuevotallerservicioselect']:checked"), function(){            
  $select.push($(this).val());
});

if($nombre==""){
  swal({
    title: "Error!",
    text: "Debe ingresar un nombre",
    icon: "error",
    dangerMode: true,
  })
}
else{
  if($telefono=="" || !$.isNumeric($telefono)){
    swal({
      title: "Error!",
      text: "Debe ingresar un telefono correcto",
      icon: "error",
      dangerMode: true,
    })

  }
  else{
    if(!regex.test($email)){
      swal({
        title: "Error!",
        text: "Debe ingresar un email correcto",
        icon: "error",
        dangerMode: true,
      })

    }
    else{
      if($calle==""){
        swal({
          title: "Error!",
          text: "Debe indicar una calle",
          icon: "error",
          dangerMode: true,
        })
      }
      else{
        if($nro==""){
          swal({
            title: "Error!",
            text: "Debe indicar una altura",
            icon: "error",
            dangerMode: true,
          })
        }
        else{
          if($codloca==""){
            swal({
              title: "Error!",
              text: "Debe seleccionar una localidad",
              icon: "error",
              dangerMode: true,
            })
          }
          else{
            if($uid==""){
              swal({
                title: "Error!",
                text: "Debe seleccionar un Administrador",
                icon: "error",
                dangerMode: true,
              })
            }
            else{
              if($select.length>0){
                $.ajax({
                  url: "../clases/tabla.php",
                  method: "GET",
                  async: true,
                  data: {funcion: "altanuevotaller",select:$select,nombre:$nombre,telefono:$telefono,email:$email,calle:$calle,nro:$nro,codloca:$codloca,uid:$uid},
                  dataType: "json",
                  success: function(respuesta) {
                    if(respuesta){ 
                      cambiarpaginador();
                      swal({
                        title: "Creado con exito!",
                        text: "Se ah registrado con exito el Taller",
                        icon: "success",
                        dangerMode: true,
                      })
                      $(".modal .close").click();
                                           
    
                    }
                    else{
                      console.log("salio error")
                    } 
                  
                  }
                })
              }
              else{
                swal({
                  title: "Error!",
                  text: "Debe seleccionar un servicio al menos",
                  icon: "error",
                  dangerMode: true,
                })

              }
            }
          }
        }
      }
    }
  }
}

}



function cargarlocalidad(){
  $texto=$("#localidadnueva").val();
  if($texto.length>3){
    $.ajax({
      url: "../clases/tabla.php",
      method: "GET",
      async: true,
      data: {funcion: "todosloscp",text:"%"+$texto+"%"},
      dataType: "json",
      success: function(respuesta) {
        if(respuesta != null){
          $("#localidadchek").empty();
          $.each(respuesta, function(index, value){ 
             $("#localidadchek").append('<input class="form-check-input col-4" type="checkbox" name="checkserviciotallersolicitud"  id="loc'+value.codlocalidad+'" value="'+value.codlocalidad+'"> <label class="form-check-label col-6" for="loc'+value.codlocalidad+'">'+value.localidad+" ("+value.cp+")"+'</label><br>');
    
          })
       
          
        }
    }
    })
  }
  else{
    $("#localidadchek").empty();
  }
 
}

function cargareditartalleradm($tid){
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "getdatostaller",tid:$tid},
    dataType: "json",
    success: function(respuesta) {
      if(respuesta != null){
        $("#nrotallereditar").val($tid);
        $("#editarnombrenuevotaller").val(respuesta[0].nomtaller);
        $("#editartelnuevotaller").val(respuesta[0].telefono);
        $("#editaremailnuevotaller").val(respuesta[0].email);
        $("#editarcallenuevotaller").val(respuesta[0].calle);
        $("#editarnumeronuevotaller").val(respuesta[0].nro);    
        $("#editartallerlocalidad").val(respuesta[0].localidad);   
        $('#editarseleccionadministrador').empty();
        $('#editarseleccionadministrador').append($('<option>', {
          value: respuesta[0].uid,
          text:  respuesta[0].nombre+" "+ respuesta[0].apellido,
          hidden: true,
          selected: true
        }));
        $.ajax({
          url: "../clases/tabla.php",
          method: "GET",
          async: true,
          data: {funcion: "datosadministradortaller"},
          dataType: "json",
          success: function(respuesta) {
            if(respuesta != null){
              $.each(respuesta, function(index, value){ 
                $('#editarseleccionadministrador').append($('<option>', {
                  value: value.uid,
                  text: value.nombre+" "+ value.apellido
              }));
              });
           
              
            }
        }
        })  
      }
  }
  })
}

function editarcargarlocalidad(){
  $texto=$("#editarlocalidadnueva").val();
  if($texto.length>3){
    $.ajax({
      url: "../clases/tabla.php",
      method: "GET",
      async: true,
      data: {funcion: "todosloscp",text:"%"+$texto+"%"},
      dataType: "json",
      success: function(respuesta) {
        if(respuesta != null){
          $("#editarlocalidadchek").empty();
          $.each(respuesta, function(index, value){ 
             $("#editarlocalidadchek").append('<input class="form-check-input col-4" type="checkbox" name="editarcheckserviciotallersolicitud"  id="loc'+value.codlocalidad+'" value="'+value.codlocalidad+'"> <label class="form-check-label col-6" for="loc'+value.codlocalidad+'">'+value.localidad+" ("+value.cp+")"+'</label><br>');
    
          })
       
          
        }
    }
    })
  }
  else{
    $("#localidadchek").empty();
  }
 
}
function editartalleradmin(){
  var regex = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
  $tid=$("#nrotallereditar").val();
  $nombre=$("#editarnombrenuevotaller").val();
  $telefono=$("#editartelnuevotaller").val();
  $email=$("#editaremailnuevotaller").val();
  $calle=$("#editarcallenuevotaller").val();
  $nro=$("#editarnumeronuevotaller").val();
  $codloca=$("input[name='editarcheckserviciotallersolicitud']:checked").val();
  $uid=$("#editarseleccionadministrador").val();

  if($nombre==""){
    swal({
      title: "Error!",
      text: "Debe ingresar un nombre",
      icon: "error",
      dangerMode: true,
    })
  }
  else{
    if($telefono=="" || !$.isNumeric($telefono)){
      swal({
        title: "Error!",
        text: "Debe ingresar un telefono correcto",
        icon: "error",
        dangerMode: true,
      })
  
    }
    else{
      if(!regex.test($email)){
        swal({
          title: "Error!",
          text: "Debe ingresar un email correcto",
          icon: "error",
          dangerMode: true,
        })
  
      }
      else{
        if($calle==""){
          swal({
            title: "Error!",
            text: "Debe indicar una calle",
            icon: "error",
            dangerMode: true,
          })
        }
        else{
          if($nro==""){
            swal({
              title: "Error!",
              text: "Debe indicar una altura",
              icon: "error",
              dangerMode: true,
            })
          }
          else{
            if($codloca=="" && $("#editartallerlocalidad").val()!=""){
              swal({
                title: "Error!",
                text: "Debe seleccionar una localidad",
                icon: "error",
                dangerMode: true,
              })
            }
            else{
              if($uid==""){
                swal({
                  title: "Error!",
                  text: "Debe seleccionar un Administrador",
                  icon: "error",
                  dangerMode: true,
                })
              }
              else{
                  if($("#editartallerlocalidad").val()!=""){
                    $.ajax({
                      url: "../clases/tabla.php",
                      method: "GET",
                      async: true,
                      data: {funcion: "editarnuevotallersinloca",tid:$tid,nombre:$nombre,telefono:$telefono,email:$email,calle:$calle,nro:$nro,uid:$uid},
                      dataType: "json",
                      success: function(respuesta) {
                        if(respuesta){ 
                          cambiarpaginador();
                          swal({
                            title: "Actualizo con exito!",
                            text: "Se ah actualizo con exito el Taller",
                            icon: "success",
                            dangerMode: true,
                          })
                          $(".modal .close").click();
                          cambiarpaginador();
                                               
                  
                        }
                        else{
                          console.log("salio error")
                        } 
                      
                      }
                    })
                   
                    }
                  else{            
                    $.ajax({              
                      url: "../clases/tabla.php",
                      method: "GET",
                      async: true,
                      data: {funcion: "editarnuevotaller",tid:$tid,nombre:$nombre,telefono:$telefono,email:$email,calle:$calle,nro:$nro,codloca:$codloca,uid:$uid},
                      dataType: "json",
                      success: function(respuesta) {
                        if(respuesta){ 
                          cambiarpaginador();
                          swal({
                            title: "Actualizo con exito!",
                            text: "Se actualizo con exito el Taller",
                            icon: "success",
                            dangerMode: true,
                          })
                          $(".modal .close").click();
                          cambiarpaginador();
                                               
                  
                        }
                        else{
                          console.log("salio error")
                        } 
                      
                      }
                    })
                  }
                
              }
            }
          }
        }
      }
    }
    }
  }

function eliminartalleradm($tid){
  
  swal({
    title: "¿Quiere eliminar el Taller?",
    text: "Una vez eliminado, Tendra que crear lo de nuevo",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: "../clases/tabla.php",
        method: "GET",
        async: true,
        data: {funcion: "eliminartaller",tid:$tid},
        dataType: "json",
        success: function(respuesta) {
            if(respuesta){
              cambiarpaginador();
              swal({
                title:"Listo!",
                text:"se elimino el taller", 
                icon: "success",
              });
              
          }
      }
      })
      
    } else {
      swal({   
          title:"!Cancelado¡", 
            icon: "error"});
    }
  });
  
}


function cargarpaginador(){
  $('#pagtalleres').empty();
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "paginaciontablatalleresadm"},
    dataType: "json",
    success: function(respuesta) {
        $pagina=Math.round(respuesta/100);        
        $pagina=$pagina
        
        for(i=0;i<=$pagina;i++ ){
              $('#pagtalleres').append($('<option>', {
              value: i,
              text: (i*100)+"-"+(((i+1)*100)-1),
          }));
        }

        
    }
  })
}

function cambiarpaginador(){
  $desde=$("#pagtalleres").val();
  cargartalleresadministrador($desde)
}

function cargartalleresadministrador($de){
  $desde=(parseInt($de)*100)
  $hasta=(100)
  $.ajax({
    url: "../clases/tabla.php",
    method: "GET",
    async: true,
    data: {funcion: "talleresadministrador",desde:$desde,hasta:$hasta},
    dataType: "json",
    success: function(respuesta) {
      
      if(respuesta != null && $.isArray(respuesta)){
        $('#talleresadministradorbody').html("");
        if($.isEmptyObject(respuesta)){
          $('#talleresadministradorbody').html("Sin servicios cargados");
        }   
        else{
            $.each(respuesta, function(index, value){ 
                $("#talleresadministradorbody").append("<tr><td>" + value.tid + "</td><td>" + value.nombre+ "</td><td><span class='text-muted'>" + value.calle+" "+value.nro+'</td><td>' + value.telefono + '</td><td> <a href="#" data-toggle="modal" data-target="#editar-talleradm" onclick="cargareditartalleradm('+value.tid+')"> <span class="label bg-info"><i class="fa fa-pencil"></i></span></a><a onclick="eliminartalleradm('+value.tid+')"> <span class="label bg-danger"><i class="fa fa-ban"></i></span></a></span></a></td></tr>');
            });
        } 
        if ( $.fn.dataTable.isDataTable( '#talleresadministrador') ) {
          table = $('#talleresadministrador').DataTable().destroy();
          $('#talleresadministrador').DataTable( {
            dom: 'Bfrtip',
            language: {
              url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            buttons: [
              {extend:'copyHtml5',text:'Copiar'},
              {extend:'excelHtml5', text:'Exportar a excel'},
              {extend:'pdfHtml5',text:'Exportar a pdf'},
              {extend:'print', text:'Imprimir'}
          ]
          });
        }
            
        }
      else{
        console.log("salio error")
      } 
  }
})


}

//sin
 