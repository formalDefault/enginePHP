<?php
session_start();
include("funciones.php");
$con=conectar();
$opc=obten("opc");
switch ($opc) 
{
	case '1':
		$estado_radica=obten("estado_nac");
    echo select_sql2("municipio","",'required="required" class="form-control"',"SELECT id,municipio FROM tcat_municipios WHERE id_estado='$estado_radica' ORDER BY municipio ASC","municipio","id",$con);
	break;

  case '2':
    $estado_radica=obten("estado_radica");
    echo select_sql2("municipio","",'required="required" class="form-control"',"SELECT id,municipio FROM tcat_municipios WHERE id_estado='$estado_radica' ORDER BY municipio ASC","municipio","id",$con);
  break; 

  case '3':
    $firma=mysql_real_escape_string(obten("firma"));
    $usuario=$_SESSION["admindif_admin_id"];
    $firma=sha1(md5($usuario.$firma));
    $qv="select id from firma_dig where llave_dif='$firma' and usuario='$usuario' limit 1";
    //echo $qv;
    $con=conectar();
    $qv=mysql_query($qv,$con);
    $res=mysql_fetch_array($qv);
    $res_1=$res["id"];
    //echo $res_1;
    if($res_1){
      echo '<input value="" name="token" id="token" size="18" maxlength="100" disabled placeholder="Firma Correcta" class="form-control rounded-input" type="text">';

    }else{
      echo '<input value="" name="token" id="token" size="18" maxlength="100" disabled placeholder="Firma Invalida" class="form-control rounded-input" type="text">';
    }
  break; 

  case '4':
    $cuenta=obten("cuenta_bancaria");
    //echo "<h1>HOLAAAAAAAAAA</h1>";
    echo select_sql2("nombre_corto","",'required="required" class="form-control"',"SELECT id,nombre_corto FROM bancos WHERE razon='$cuenta'","nombre_corto","id",$con);
  break; 

  case '5':
    $municipio_radica=obten("municipio_radica");
    $municipio_radica=mysql_este('select id_mun_edo from tcat_municipios where id='.$municipio_radica.'',"id_mun_edo",$con);
    $estado_radica=obten("estado_radica");

    //echo $estado_radica;
    echo select_sql2("nombre_corto","",'required="required" class="form-control"',"SELECT id,colonia FROM tcat_colonias WHERE id_estado='$estado_radica' and id_c_mun_fed='$municipio_radica' order by colonia","colonia","id",$con);
  break; 

  case '6':
    $colonia=obten("colonia");
    //echo "<h1>HOLAAAAAAAAAA</h1>";
    $cp=mysql_este("select cp from tcat_colonias where id='$colonia'","cp",$con);
    //echo "select cp from tcat_colonias where colonia='$colonia'";
    echo $cp;
  break; 

  case '7':
    $cliente=obten("razon");
    //echo "<h1>HOLAAAAAAAAAA</h1>";
    echo select_sql2("id_clave_corta","",'required="required" class="form-control"',"SELECT id,razon_social FROM claves_cortas WHERE id_cliente='$cliente'","razon_social","id",$con);
  break; 
  case '8':
    $tipo_asentamiento=obten("tipo_asentamiento");
    //echo "<h1>HOLAAAAAAAAAA</h1>";
    $cp=mysql_este("select tipo_asentamiento from tcat_colonias where id='$tipo_asentamiento'","tipo_asentamiento",$con);
    //echo "select tipo_asentamiento from tcat_colonias where id='$tipo_asentamiento'";
    echo $cp;
  break; 

  case '9':
    $sede=obten("sede");
    //echo "<h1>HOLAAAAAAAAAA</h1>";
    
    echo select_sql2("area","",'required="required" class="form-control"',"SELECT id,area FROM c_areas WHERE sede='$sede' order by area","area","id",$con);

  break; 

  case '10':
    $parroquia=obten("parroquia");
    $id_decanato=mysql_este("select id,decanato from cat_parroquias where id='$parroquia'","decanato",$con);
    
   

    //echo $estado_radica;
        
    echo select_sql3("decanato","",'required="required" class="form-control"',"SELECT id,decanato FROM cat_decanatos WHERE id='$id_decanato' order by decanato","decanato","id",$con);
  break; 
        
  case '11':
    $parroquia=obten("parroquia");
    $id_vicaria=mysql_este("select id,vicaria from cat_parroquias where id='$parroquia'","vicaria",$con);
   

    //echo $estado_radica;
    
    echo select_sql3("vicaria","",'required="required" class="form-control"',"SELECT id,vicaria FROM cat_vicarias WHERE id='$id_vicaria' order by vicaria","vicaria","id",$con);
  break; 

  case '12':
    $vicaria=obten("vicaria"); 

    // echo $estado_radica;
    echo select_sql2("decanato","","","SELECT cat_decanatos.id, cat_decanatos.decanato
    FROM cat_parroquias
    LEFT JOIN cat_decanatos ON (cat_decanatos.id=cat_parroquias.decanato)
    LEFT JOIN cat_vicarias ON (cat_vicarias.id=cat_parroquias.vicaria)
    WHERE cat_vicarias.id='$vicaria' group by cat_decanatos.decanato order by cat_decanatos.decanato","decanato","id",$con);
 
  break; 
        
  case '13':
    $decanato=obten("decanato");
   

    //echo $estado_radica;
    
    echo select_sql2("parroquia","",'required" class="form-control"',"SELECT cat_parroquias.id, cat_parroquias.parroquia
    FROM cat_parroquias
    LEFT JOIN cat_decanatos ON (cat_decanatos.id=cat_parroquias.decanato)
    LEFT JOIN cat_vicarias ON (cat_vicarias.id=cat_parroquias.vicaria)
    WHERE cat_decanatos.id = '$decanato' group by cat_parroquias.parroquia order by cat_parroquias.parroquia","parroquia","id",$con);
    
  break; 

  case '14':
    $parroquia=obten("parroquia");
   

    //echo $estado_radica;

    $tipo=mysql_este("select tipo from cat_parroquias where id='$parroquia'","tipo",$con);
  
    echo $tipo;
    break;

  case '15':
    $parroquia=obten("parroquia");
      
    $saldo=mysql_este("SELECT saldo_global FROM informe_tesoreria 
    WHERE id = (SELECT MAX(id) FROM informe_tesoreria) -1
    AND id_parroquia='$parroquia'
    ORDER BY id","saldo_global",$con);
      //echo "select cp from tcat_colonias where colonia='$colonia'";
      echo $saldo;
    break; 

  case '16':
    $fecha=obten("fecha_cita");
      $con=conectar();
      $servicio=obten("area");
      if($servicio==1){
    $query="SELECT * FROM (
SELECT ('09:00') AS dia,1 as id
UNION ALL SELECT ('10:00'),2 as id
UNION ALL SELECT ('11:00'),3 as id
) AS fechas WHERE dia NOT IN (
SELECT hora_cita FROM casos_emergentes WHERE fecha_cita='$fecha' and servicio='$servicio'
)";
}elseif($servicio==2){
    $query="SELECT * FROM (
SELECT ('08:30') AS dia,1 as id
UNION ALL SELECT ('09:10'),2 as id
UNION ALL SELECT ('09:50'),3 as id
UNION ALL SELECT ('10:30'),4 as id
UNION ALL SELECT ('11:10'),5 as id
UNION ALL SELECT ('11:50'),6 as id
UNION ALL SELECT ('12:30'),7 as id
UNION ALL SELECT ('13:10'),8 as id
UNION ALL SELECT ('13:50'),8 as id
) AS fechas WHERE dia NOT IN (
SELECT hora_cita FROM casos_emergentes WHERE fecha_cita='$fecha' and servicio='$servicio'
)";
}elseif($servicio==3){
    $query="SELECT * FROM (
SELECT ('09:50') as dia,3 as id
UNION ALL SELECT ('10:30'),4 as id
UNION ALL SELECT ('11:10'),5 as id
UNION ALL SELECT ('11:50'),6 as id
UNION ALL SELECT ('12:30'),7 as id
UNION ALL SELECT ('13:10'),8 as id
UNION ALL SELECT ('13:50'),8 as id
) AS fechas WHERE dia NOT IN (
SELECT hora_cita FROM casos_emergentes WHERE fecha_cita='$fecha' and servicio='$servicio'
)";
}
echo $query;
    $query=mysql_query($query,$con);
    while($row=mysql_fetch_array($query)){
      $fin=$fin."|".$row["dia"]."=".$row["dia"];
    }
    //echo $fin;
    echo select_x("Hora Cita","4","hora_cita",$hora_cita,"",$fin);

    break; 

  case '17':
    $producto=obten("producto");
    //$producto=addcslashes($producto);
      
    $producto=mysql_este("SELECT descripcion FROM far_productos 
    WHERE codigo_barras = '$producto' limit 1","descripcion",$con);
      //echo "select cp from tcat_colonias where colonia='$colonia'";
      echo $producto;
    break; 

  case '18':
    $tipo=obten("tipo");
    //$producto=addcslashes($producto);
      
    echo select_sql3("categoria","",'required="required" class="form-control"',"SELECT id,categoria FROM pf_cat_egresos_categoria WHERE tipo='$tipo' order by categoria","categoria","id",$con);
      //echo "select cp from tcat_colonias where colonia='$colonia'";
      
    break; 

  case '19':
    $tipo=obten("tipo");
    $categoria=obten("categoria");
    //$producto=addcslashes($producto);
      
    echo select_sql3("sub_categoria","",'required="required" class="form-control"',"SELECT id,sub_categoria FROM pf_cat_egresos_sub_categoria WHERE tipo='$tipo' and categoria='$categoria' order by sub_categoria","sub_categoria","id",$con);
      //echo "select cp from tcat_colonias where colonia='$colonia'";
      
    break; 
  case '20':
    $tipo=obten("tipo");
    $categoria=obten("categoria");
    $sub_categoria=obten("sub_categoria");
    //$producto=addcslashes($producto);
      
    echo select_sql3("producto_servicio","",'required="required" class="form-control"',"SELECT id,producto_servicio FROM pf_cat_egresos_productos WHERE tipo='$tipo' and categoria='$categoria'
     and sub_categoria='$sub_categoria' order by producto_servicio","producto_servicio","id",$con);
      //echo "select cp from tcat_colonias where colonia='$colonia'";
      
    break; 

    case '21':
      $parroquia=obten("parroquia");
    //$producto=addcslashes($producto);
      
    $parroquia=mysql_este("SELECT COUNT(alta_voluntarios.id) AS cuanta FROM alta_voluntarios
                           WHERE alta_voluntarios.id_parroquia = $parroquia
                           AND alta_voluntarios.status_form = 'Concluido'","cuenta",$con);
      //echo "select cp from tcat_colonias where colonia='$colonia'";
      echo $parroquia;
        
      break; 

      case '22':
        $parroquia=obten("parroquia");
       
    
        //echo $estado_radica;
        
        echo select_sql3("tipo","",'required="required" class="form-control"',"SELECT cat_parroquias.id, cat_parroquias.tipo
        FROM cat_parroquias
        WHERE cat_parroquias.id = '$parroquia'
        order by parroquia","tipo","id",$con);
      break;
      
      case '23':
        $parroquia=obten("parroquia");
       
    
        //echo $estado_radica;
        
        echo select_sql3("voluntarios","",'required="required" class="form-control"',"SELECT COUNT(alta_voluntarios.id) AS voluntarios
        FROM alta_voluntarios
        LEFT JOIN cat_parroquias ON (cat_parroquias.id=alta_voluntarios.id_parroquia)
        WHERE cat_parroquias.id = '$parroquia'
        ORDER BY cat_parroquias.parroquia","voluntarios","id",$con);
      break;

      case '24':
        $parroquia=obten("parroquia");
          
        $saldo_inicial=mysql_este("select count(id_parroquia) as contador from informe_tesoreria where id_parroquia='$parroquia'","contador",$con);
          //echo "select cp from tcat_colonias where colonia='$colonia'";
          echo $saldo_inicial;
        break; 

        case '25':
          $tipo_evento=obten("tipo_evento");
          
      
      
          //echo $estado_radica;
              
          echo select_sql3("$tipo_evento","",'required="required" class="form-control"',"SELECT id,$tipo_evento
          FROM $tipo_evento
          ORDER BY $tipo_evento.$tipo_evento","$tipo_evento","id",$con);
        break;   

        case '26':
          $parroquia=obten("parroquia");
   
          //echo $parroquia;

          echo select_sql3("decanato","",'required="required" class="form-control"',"SELECT `cat_decanatos`.`id`,`cat_decanatos`.`decanato`
          FROM `cat_parroquias` 
          LEFT JOIN `cat_decanatos` ON (`cat_decanatos`.`id`=`cat_parroquias`.`decanato`)
          WHERE `cat_parroquias`.`id` = $parroquia","decanato","id",$con);
        
        break;   
  
        case '27':
          $parroquia=obten("parroquia");
   
          //echo $parroquia;

          echo select_sql3("vicaria","",'required="required" class="form-control"',"SELECT `cat_vicarias`.`id`,`cat_vicarias`.`vicaria`
          FROM `cat_parroquias` 
          LEFT JOIN `cat_vicarias` ON (`cat_parroquias`.`vicaria`=`cat_vicarias`.`id`)
          WHERE `cat_parroquias`.`id` = $parroquia","vicaria","id",$con);
        
        break;   

        case '28':
          $formulario=obten("id_formulario");
          $campania=obten("id_campania");

          $result=mysql_este("SELECT COUNT(cobija_pobre) AS contador 
          FROM registro_beneficiarios_campanias
          WHERE id_campania = '$campania' AND id_formulario = '$formulario' AND cobija_pobre = 1","contador",$con);

          echo $result;
        
        break;


        case '29':
          $formulario=obten("id_formulario");
          $campania=obten("id_campania");

          $result=mysql_este("SELECT COUNT(cena_navidenia) AS contador 
          FROM registro_beneficiarios_campanias
          WHERE id_campania = '$campania' AND id_formulario = '$formulario' AND cena_navidenia = 1","contador",$con);

          echo $result;

        break; 

          case '30':
            $formulario=obten("id_formulario");
            $campania=obten("id_campania");
  
            $result=mysql_este("SELECT COUNT(otros) AS contador 
            FROM registro_beneficiarios_campanias
            WHERE id_campania = '$campania' AND id_formulario = '$formulario' AND otros = 1","contador",$con);
  
            echo $result;
        
        break;

        case '31':
          $campania=obten("id_campania");

          $result=mysql_este("SELECT cuota FROM c_campanias WHERE id='$campania'","cuota",$con);

          echo $result;
      
        break;

        case '32': //Extrae Estado de Codigo Postal
          $cp=obten("cp");
          echo mysql_este("SELECT id_estado FROM tcat_colonias WHERE cp = '$cp' LIMIT 1;","id_estado",$con);
        break;

        case '33': //Extrae Municipio de Codigo Postal
          $cp=obten("cp");
          echo mysql_este("SELECT tcat_municipios.id
                            FROM tcat_colonias 
                            INNER JOIN tcat_municipios ON (tcat_colonias.id_c_mun_fed = tcat_municipios.id_mun_edo) AND (tcat_colonias.id_estado = tcat_municipios.id_estado)
                            WHERE cp = '$cp' LIMIT 1;",
                          "id",
                          $con);
        break;

        case '34': //Extrae Colonia de Codigo Postal
          $cp=obten("cp");
          echo select_sql2("colonia","",'required="required" class="form-control"',"SELECT id,colonia FROM tcat_colonias WHERE cp='$cp' ORDER BY colonia","colonia","id",$con);
        break;

        case '35': //Extrae puesto con filtro de programa
          $programa=obten("programa");
          echo select_sql2("puesto","",'required="required" class="form-control"',"SELECT id,puesto FROM c_puestos WHERE programa = $programa;","puesto","id",$con);
        break;

        case '36': //Extrae puesto con filtro de programa
          $puesto=obten("puesto");
          echo mysql_este("SELECT c_niveles.id FROM c_niveles INNER JOIN c_puestos ON (c_puestos.nivel = c_niveles.id) WHERE c_puestos.id = $puesto;","id",$con);
        break;

        
        case '37':
          $municipio_radica=obten("municipio_nac");
          $municipio_radica=mysql_este('select id_mun_edo from tcat_municipios where id='.$municipio_radica.'',"id_mun_edo",$con); 

          //echo $estado_radica;
          echo select_sql2("nombre_corto","",'required="required" class="form-control"',"SELECT id,colonia FROM tcat_colonias WHERE id_estado=14 and id_c_mun_fed='$municipio_radica' order by colonia","colonia","id",$con);
        break; 


}
?>