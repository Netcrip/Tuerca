
<?php
class tablaServicio
{
   function gettablaservicio() {
        try {
            $db   = getDB();
            $stmt = $db->prepare("select codserv, nombre, descripcion from servicios where estado!=0");
            $stmt->execute();
            return $stmt;
        }   
        catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
 
    }
    function gettablataller() {
        try {
            $db   = getDB();
            $stmt = $db->prepare("select tid,nombre,telefono,email,calle,nro, cp.localidad from talleres
            inner join cp on talleres.codloca = cp.codlocalidad
            where talleres.estado!=0");
            $stmt->execute();
            return $stmt;
        }   
        catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
 
    }
    function gettablaordenes(){
       try {
            $db   = getDB();
            $stmt = $db->prepare("select ordenes.oid, ordenes.vid, ordenes.tid, vehiculos.dominio, ordenes.horario, servicios.nombre from  ordenes 
            inner join `ordenes-detalle` on `ordenes-detalle`.oid = ordenes.oid  
            inner join servicios on `ordenes-detalle`.codser = servicios.codserv
            inner join vehiculos on vehiculos.vid = ordenes.vid
            where ordenes.estado!=0  and `ordenes-detalle`.estado!=0
            union 
            select ordenentaller.otid as oid, null as vid, null as tid,  ordenentaller.dominio, ordenentaller.horario, servicios.nombre from  ordenentaller 
            inner join `ordenentaller-detalle` on `ordenentaller-detalle`.otid = ordenentaller.otid  
            inner join servicios on `ordenentaller-detalle`.codserv = servicios.codserv
            where ordenentaller.estado!=0  and `ordenentaller-detalle`.estado!=0");
            $stmt->execute();
            return $stmt;
        }   
        catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }

     
    }
    function gettablasolicitudes(){
        try {
            $db   = getDB();
            $stmt = $db->prepare("select solicitud.sid, solicitud.vid, solicitud.tid, vehiculos.dominio, servicios.nombre from  solicitud 
            inner join `solicitud-detalle` on `solicitud-detalle`.sid = solicitud.sid  
            inner join servicios on `solicitud-detalle`.codserv = servicios.codserv
            inner join vehiculos on vehiculos.vid = solicitud.vid
            where solicitud.estado!=0  and `solicitud-detalle`.estado!=0");
            $stmt->execute();
            return $stmt;
        }   
        catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }

     
    }
    function gettablaservicioauto($vid){
        try {
        $db   = getDB();
        $stmt = $db->prepare("select ordenes.oid, ordenes.vid, talleres.nombre as taller, ordenes.tid, kilometros.km, vehiculos.dominio, ordenes.fecha, servicios.nombre from  ordenes 
        inner join `ordenes-detalle` on `ordenes-detalle`.oid = ordenes.oid  
        inner join servicios on `ordenes-detalle`.codser = servicios.codserv
        inner join vehiculos on vehiculos.vid = ordenes.vid
        inner join talleres on talleres.tid = ordenes.tid
        inner join kilometros on kilometros.oid= ordenes.oid
        where vehiculos.vid=:vid and ordenes.estado!=0  and `ordenes-detalle`.estado!=0");
        $stmt->bindParam("vid", $vid, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
        }   
        catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    function getkilometrajeauto($vid){
        try {
        $db   = getDB();
        $stmt = $db->prepare("select km from kilometros where vid=0
        ORDER BY kmid DESC LIMIT 1");
        $stmt->bindParam("vid", $vid, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
        }   
        catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }

    function setordendeservicio(){
        try {
        $tid=1;
        $dominio="ac-251";
        $fecha="19/11/18";
        $horario="10:30";
        $codserv="2";
        $obs="observer";
        $db   = getDB();
        $stmt = $db->prepare("insert into ordenentaller values (tid,dominio,fecha,horario) values (:tid,:dominio,:fecha,:horario);");
        $stmt->bindParam("tid", $tid, PDO::PARAM_STR);
        $stmt->bindParam("dominio", $dominio, PDO::PARAM_STR);
        $stmt->bindParam("fecha", $fecha, PDO::PARAM_STR);
        $stmt->bindParam("horario", $horario, PDO::PARAM_STR);
        $stmt->execute();
        $temp = $sth->fetch(PDO::FETCH_ASSOC);
        $stmt2 = $db->prepare("insert into `ordenentaller-detalle` values (otid,codserv,observacion) values (:otid,:codserv,:observacion);");
        $stmt2->bindParam("otid", $temp, PDO::PARAM_STR);
        $stmt2->bindParam("codserv", $codserv, PDO::PARAM_STR);
        $stmt2->bindParam("observacion", $obs, PDO::PARAM_STR);
        $stmt2->execute();
        }   
        catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
}
?>