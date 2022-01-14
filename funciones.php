<?php
include "config.php";
use PHPMailer\PHPMailer\PHPMailer;

function get_row($table,$row, $id, $equal){
    global $con2;
    $query=mysqli_query($con2,"select $row from $table where $id='$equal'");
    
    $rw=mysqli_fetch_array($query);
    $value=$rw[$row];
    return $value;
}

function consulta_curp_old($curp){
    $curp_busqueda = (string) strtoupper(ltrim($curp));
     $curp_busqueda = (string) strtoupper(ltrim($curp));
        $token = 'SASS_Jalisco';

        $curl = curl_init();

    curl_setopt_array($curl, array(

      CURLOPT_URL => "https://ws.difjalisco.gob.mx/validaCurp2/".$curp_busqueda."/".$token,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $response = json_decode($response);
    $response = simplexml_load_string($response[3]->value);
    $curp = $response[3]->CURP;
   
    $apellido1 = $response[3]->apellido1;
    $apellido2 = $response[3]->apellido2;
    $nombre = $response[3]->nombres;
    $sexo = $response[3]->sexo;
    $fecha_nac = $response[3]->fechNac;
    $fecha_nac= explode("/",$fecha_nac);
    $fecha_nac=$fecha_nac[2]."-".$fecha_nac[1]."-".$fecha_nac[0];



    $num_entidad_registro = $response[3]->numEntidadReg;
    $cve_municipio_registro = $response[3]->cveMunicipioReg;
   
    $matriz = array($curp, $nombre, $apellido1, $apellido2, $sexo, $fecha_nac, $num_entidad_registro, $cve_municipio_registro);
   
    if ($curp != '' || $curp != NULL)
        return $matriz;
    else
        return "Error";

       


    

}

function consulta_curp2($curp){

   $curp_busqueda = (string) strtoupper(ltrim($curp));
     $curp_busqueda = (string) strtoupper(ltrim($curp));
        $token = 'SASS_Jalisco';

        $curl = curl_init();

    curl_setopt_array($curl, array(

      CURLOPT_URL => "https://ws.difjalisco.gob.mx/validaCurp2/".$curp_busqueda."/".$token,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $prov=$response;
    $response = json_decode($response);
    
    $response = simplexml_load_string($response[3]->value);
    $curp = $response[3]->CURP;
   
    $apellido1 = $response[3]->apellido1;
    $apellido2 = $response[3]->apellido2;
    $nombre = $response[3]->nombres;
    $sexo = $response[3]->sexo;
    $fecha_nac = $response[3]->fechNac;
    $fecha_nac= explode("/",$fecha_nac);
    $fecha_nac=$fecha_nac[2]."-".$fecha_nac[1]."-".$fecha_nac[0];
    $muerto = $response[3]->statusCurp;


    $num_entidad_registro = $response[3]->numEntidadReg;
    $cve_municipio_registro = $response[3]->cveMunicipioReg;
   
    $matriz = array($curp, $nombre, $apellido1, $apellido2, $sexo, $fecha_nac, $num_entidad_registro, $cve_municipio_registro,
        $muerto);
   
    if ($curp != '' || $curp != NULL)
        return $matriz;
    else
        return "Error";

       


}
 
function consulta_curp($curp){

   $curp_busqueda = (string) strtoupper(ltrim($curp));
     $curp_busqueda = (string) strtoupper(ltrim($curp));
        $token = 'SASS_Jalisco';

     

    $url='https://ws.difjalisco.gob.mx/validaCurp2/'.$curp_busqueda.'/'.$token.'';
    
    $response = leerjson($url);
    
    $prov=$response;
    $response = json_decode($response);
    
    $response = simplexml_load_string($response[3]->value);
    $curp = $response[3]->CURP;
   
    $apellido1 = $response[3]->apellido1;
    $apellido2 = $response[3]->apellido2;
    $nombre = $response[3]->nombres;
    $sexo = $response[3]->sexo;
    $fecha_nac = $response[3]->fechNac;
    $fecha_nac= explode("/",$fecha_nac);
    $fecha_nac=$fecha_nac[2]."-".$fecha_nac[1]."-".$fecha_nac[0];
    $muerto = $response[3]->statusCurp;


    $num_entidad_registro = $response[3]->numEntidadReg;
    $cve_municipio_registro = $response[3]->cveMunicipioReg;
   
    $matriz = array($curp, $nombre, $apellido1, $apellido2, $sexo, $fecha_nac, $num_entidad_registro, $cve_municipio_registro,
        $muerto);
   
    if ($curp != '' || $curp != NULL)
        return $matriz;
    else
        return "Error";

       


}

function leerjson($url){
   $fichero_url = fopen ($url, "r");
   $texto = "";
   while ($trozo = fgets($fichero_url, 1024)){
      $texto .= $trozo;
   }
   return $texto;
}

function conectar() {
  global $servidordb;
  global $userdb;
  global $passdb;
  global $nombredb;
 
  if(!($con = mysql_connect($servidordb,$userdb,$passdb)))
  {die("No se hizo la conexion al servidor favor de verificar");
    }
  if(!mysql_select_db($nombredb,$con))
  {die("No se hizo la conexi�n con la base de datos favor de verificar");
    }//*/
  return $con;
}

$con=conectar();

function obten($cad){
  if(isset($_POST[$cad])){
    $retorno=($_POST[$cad]);
  }else{
    if(isset($_GET[$cad])){
      $retorno=($_GET[$cad]);
        }else{
        $retorno="";
      }
    }
  
  return $retorno;
}

function obteniva(){
    $con=conectar();
    $iva=mysql_este("select iva from configuracion limit 1","iva",$con);
    return $iva;
}

function actualiza_captura_edo_cta($id_cap,$cliente){
    $con=conectar();
    $sql="update captura_edo_cta set cliente_asignado='$cliente' where id='$id_cap'";
    mysql_query($sql,$con);

}
 
function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                            
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                            
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                            
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO PESOS $xdecimales/100 M.N.";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN PESO $xdecimales/100 M.N. ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " PESOS $xdecimales/100 M.N. "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

// END FUNCTION

function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}


function valorenletras($x) 
{ 
  if ($x<0) { $signo = "menos ";} 
  else      { $signo = "";} 
  $x = abs ($x); 
  $C1 = $x; 

  $G6 = floor($x/(1000000));  // 7 y mas 

  $E7 = floor($x/(100000)); 
  $G7 = $E7-$G6*10;   // 6 

  $E8 = floor($x/1000); 
  $G8 = $E8-$E7*100;   // 5 y 4 

  $E9 = floor($x/100); 
  $G9 = $E9-$E8*10;  //  3 

  $E10 = floor($x); 
  $G10 = $E10-$E9*100;  // 2 y 1 


  $G11 = round(($x-$E10)*100,0);  // Decimales 
  ////////////////////// 

  $H6 = unidades($G6); 

  if($G7==1 AND $G8==0) { $H7 = "Cien "; } 
  else {    $H7 = decenas($G7); } 

  $H8 = unidades($G8); 

  if($G9==1 AND $G10==0) { $H9 = "Cien "; } 
  else {    $H9 = decenas($G9); } 

  $H10 = unidades($G10); 

  if($G11 < 10) { $H11 = "0".$G11; } 
  else { $H11 = $G11; } 

  ///////////////////////////// 
      if($G6==0) { $I6=" "; } 
  elseif($G6==1) { $I6="Millón "; } 
          else { $I6="Millones "; } 
            
  if ($G8==0 AND $G7==0) { $I8=" "; } 
          else { $I8="Mil "; } 
            
  $I10 = "Pesos "; 
  $I11 = "/100 M.N. "; 

  $C3 = $signo.$H6.$I6.$H7.$I7.$H8.$I8.$H9.$I9.$H10.$I10.$H11.$I11; 

  return $C3; //Retornar el resultado 

} 

function unidades($u) 
{ 
  if ($u==0)  {$ru = " ";} 
  elseif ($u==1)  {$ru = "Un ";} 
  elseif ($u==2)  {$ru = "Dos ";} 
  elseif ($u==3)  {$ru = "Tres ";} 
  elseif ($u==4)  {$ru = "Cuatro ";} 
  elseif ($u==5)  {$ru = "Cinco ";} 
  elseif ($u==6)  {$ru = "Seis ";} 
  elseif ($u==7)  {$ru = "Siete ";} 
  elseif ($u==8)  {$ru = "Ocho ";} 
  elseif ($u==9)  {$ru = "Nueve ";} 
  elseif ($u==10) {$ru = "Diez ";} 

  elseif ($u==11) {$ru = "Once ";} 
  elseif ($u==12) {$ru = "Doce ";} 
  elseif ($u==13) {$ru = "Trece ";} 
  elseif ($u==14) {$ru = "Catorce ";} 
  elseif ($u==15) {$ru = "Quince ";} 
  elseif ($u==16) {$ru = "Dieciseis ";} 
  elseif ($u==17) {$ru = "Decisiete ";} 
  elseif ($u==18) {$ru = "Dieciocho ";} 
  elseif ($u==19) {$ru = "Diecinueve ";} 
  elseif ($u==20) {$ru = "Veinte ";} 

  elseif ($u==21) {$ru = "Veintiun ";} 
  elseif ($u==22) {$ru = "Veintidos ";} 
  elseif ($u==23) {$ru = "Veintitres ";} 
  elseif ($u==24) {$ru = "Veinticuatro ";} 
  elseif ($u==25) {$ru = "Veinticinco ";} 
  elseif ($u==26) {$ru = "Veintiseis ";} 
  elseif ($u==27) {$ru = "Veintisiente ";} 
  elseif ($u==28) {$ru = "Veintiocho ";} 
  elseif ($u==29) {$ru = "Veintinueve ";} 
  elseif ($u==30) {$ru = "Treinta ";} 

  elseif ($u==31) {$ru = "Treintayun ";} 
  elseif ($u==32) {$ru = "Treintaydos ";} 
  elseif ($u==33) {$ru = "Treintaytres ";} 
  elseif ($u==34) {$ru = "Treintaycuatro ";} 
  elseif ($u==35) {$ru = "Treintaycinco ";} 
  elseif ($u==36) {$ru = "Treintayseis ";} 
  elseif ($u==37) {$ru = "Treintaysiete ";} 
  elseif ($u==38) {$ru = "Treintayocho ";} 
  elseif ($u==39) {$ru = "Treintaynueve ";} 
  elseif ($u==40) {$ru = "Cuarenta ";} 

  elseif ($u==41) {$ru = "Cuarentayun ";} 
  elseif ($u==42) {$ru = "Cuarentaydos ";} 
  elseif ($u==43) {$ru = "Cuarentaytres ";} 
  elseif ($u==44) {$ru = "Cuarentaycuatro ";} 
  elseif ($u==45) {$ru = "Cuarentaycinco ";} 
  elseif ($u==46) {$ru = "Cuarentayseis ";} 
  elseif ($u==47) {$ru = "Cuarentaysiete ";} 
  elseif ($u==48) {$ru = "Cuarentayocho ";} 
  elseif ($u==49) {$ru = "Cuarentaynueve ";} 
  elseif ($u==50) {$ru = "Cincuenta ";} 

  elseif ($u==51) {$ru = "Cincuentayun ";} 
  elseif ($u==52) {$ru = "Cincuentaydos ";} 
  elseif ($u==53) {$ru = "Cincuentaytres ";} 
  elseif ($u==54) {$ru = "Cincuentaycuatro ";} 
  elseif ($u==55) {$ru = "Cincuentaycinco ";} 
  elseif ($u==56) {$ru = "Cincuentayseis ";} 
  elseif ($u==57) {$ru = "Cincuentaysiete ";} 
  elseif ($u==58) {$ru = "Cincuentayocho ";} 
  elseif ($u==59) {$ru = "Cincuentaynueve ";} 
  elseif ($u==60) {$ru = "Sesenta ";} 

  elseif ($u==61) {$ru = "Sesentayun ";} 
  elseif ($u==62) {$ru = "Sesentaydos ";} 
  elseif ($u==63) {$ru = "Sesentaytres ";} 
  elseif ($u==64) {$ru = "Sesentaycuatro ";} 
  elseif ($u==65) {$ru = "Sesentaycinco ";} 
  elseif ($u==66) {$ru = "Sesentayseis ";} 
  elseif ($u==67) {$ru = "Sesentaysiete ";} 
  elseif ($u==68) {$ru = "Sesentayocho ";} 
  elseif ($u==69) {$ru = "Sesentaynueve ";} 
  elseif ($u==70) {$ru = "Setenta ";} 

  elseif ($u==71) {$ru = "Setentayun ";} 
  elseif ($u==72) {$ru = "Setentaydos ";} 
  elseif ($u==73) {$ru = "Setentaytres ";} 
  elseif ($u==74) {$ru = "Setentaycuatro ";} 
  elseif ($u==75) {$ru = "Setentaycinco ";} 
  elseif ($u==76) {$ru = "Setentayseis ";} 
  elseif ($u==77) {$ru = "Setentaysiete ";} 
  elseif ($u==78) {$ru = "Setentayocho ";} 
  elseif ($u==79) {$ru = "Setentaynueve ";} 
  elseif ($u==80) {$ru = "Ochenta ";} 

  elseif ($u==81) {$ru = "Ochentayun ";} 
  elseif ($u==82) {$ru = "Ochentaydos ";} 
  elseif ($u==83) {$ru = "Ochentaytres ";} 
  elseif ($u==84) {$ru = "Ochentaycuatro ";} 
  elseif ($u==85) {$ru = "Ochentaycinco ";} 
  elseif ($u==86) {$ru = "Ochentayseis ";} 
  elseif ($u==87) {$ru = "Ochentaysiete ";} 
  elseif ($u==88) {$ru = "Ochentayocho ";} 
  elseif ($u==89) {$ru = "Ochentaynueve ";} 
  elseif ($u==90) {$ru = "Noventa ";} 

  elseif ($u==91) {$ru = "Noventayun ";} 
  elseif ($u==92) {$ru = "Noventaydos ";} 
  elseif ($u==93) {$ru = "Noventaytres ";} 
  elseif ($u==94) {$ru = "Noventaycuatro ";} 
  elseif ($u==95) {$ru = "Noventaycinco ";} 
  elseif ($u==96) {$ru = "Noventayseis ";} 
  elseif ($u==97) {$ru = "Noventaysiete ";} 
  elseif ($u==98) {$ru = "Noventayocho ";} 
  else            {$ru = "Noventaynueve ";} 
  return $ru; //Retornar el resultado 
} 

function decenas($d) 
{ 
    if ($d==0)  {$rd = "";} 
  elseif ($d==1)  {$rd = "Ciento ";} 
  elseif ($d==2)  {$rd = "Doscientos ";} 
  elseif ($d==3)  {$rd = "Trescientos ";} 
  elseif ($d==4)  {$rd = "Cuatrocientos ";} 
  elseif ($d==5)  {$rd = "Quinientos ";} 
  elseif ($d==6)  {$rd = "Seiscientos ";} 
  elseif ($d==7)  {$rd = "Setecientos ";} 
  elseif ($d==8)  {$rd = "Ochocientos ";} 
  else            {$rd = "Novecientos ";} 
  return $rd; //Retornar el resultado 
} 
function select_x($label,$columnas,$nombre,$valor,$parametros,$cadena) {
  if($columnas==2){$columnas="col-md-2";}elseif($columnas==4){$columnas="col-md-4";}elseif($columnas==6){$columnas="col-md-6";}elseif($columnas==8){$columnas="col-md-8";}elseif($columnas==10){$columnas="col-md-10";}elseif($columnas==12){$columnas="col-md-12";}
  $retorno='
      <div class="'.$columnas.'">
    <label for="'.$nombre.'" class="control-label mb-10 text-left"  style="text-transform: none !important;">'.$label.'</label>
         <select name="'.$nombre.'" id="'.$nombre.'" '.$parametros.' class="form-control rounded-input">'."\n";
        $opciones=explode("|",$cadena);
        $j=count($opciones);
        for ($i=0;$i<$j;$i++) {
          $opcion=explode("=",$opciones[$i]);
          if ($opcion[1]==$valor) { $selecciona="selected";}else{$selecciona=""; }
          $retorno.= '<option '.$selecciona.' value="'.$opcion[1].'">'.$opcion[0].'</option>'."\n";
        }
    $retorno.='</select>
  </div>';
  return $retorno;
}

function redondea($numero){
  $retorno=round($numero,2);

  return $retorno;

}

function select_x_buscar($label,$columnas,$nombre,$valor,$parametros,$cadena) {
  if($columnas==2){$columnas="col-md-2";}elseif($columnas==4){$columnas="col-md-4";}elseif($columnas==6){$columnas="col-md-6";}elseif($columnas==8){$columnas="col-md-8";}elseif($columnas==10){$columnas="col-md-10";}elseif($columnas==12){$columnas="col-md-12";}
  $retorno='
      
   		<label>
         <select name="'.$nombre.'" id="'.$nombre.'" '.$parametros.' class="form-control">'."\n";
        $opciones=explode("|",$cadena);
        $j=count($opciones);
        for ($i=0;$i<$j;$i++) {
          $opcion=explode("=",$opciones[$i]);
          if ($opcion[1]==$valor) { $selecciona="selected";}else{$selecciona=""; }
          $retorno.= '<option '.$selecciona.' value="'.$opcion[1].'">'.$opcion[0].'</option>'."\n";
        }
    $retorno.='</select>
	</label>
  ';
  return $retorno;
}

function select_sql($label,$columnas,$nombre,$valor,$parametros,$sql,$campo_nombre,$campo_clave,$con) {
  if($columnas==2){$columnas="col-md-2";}elseif($columnas==4){$columnas="col-md-4";}elseif($columnas==6){$columnas="col-md-6";}elseif($columnas==8){$columnas="col-md-8";}elseif($columnas==10){$columnas="col-md-10";}elseif($columnas==12){$columnas="col-md-12";}
  
  $retorno='
  <div class="'.$columnas.'">
    <label for="'.$nombre.'" class="control-label mb-10 text-left">'.$label.'</label>
         <select name="'.$nombre.'" id="'.$nombre.'" '.$parametros.' class="form-control rounded-input">
          <option value=""></option>'."\n";
         // echo $sql;
        $result = mysql_query($sql, $con) or die (mysql_error());
        while ($row=mysql_fetch_array($result)) {
          if($row["$campo_clave"]==$valor){$selecciona="selected";}else{$selecciona="";}
          $retorno.= '<option '.$selecciona.' value="'.utf8_decode($row["$campo_clave"]).'">'.($row["$campo_nombre"]).'</option>'."\n";
        } // Fin while.
  $retorno.='</select>
  </div>';
  return $retorno;
}  // Fin funci�n sql.

function select_sql_edo($label,$columnas,$nombre,$valor,$parametros,$sql,$campo_nombre,$campo_clave,$con) {
  if($columnas==2){$columnas="col-md-2";}elseif($columnas==4){$columnas="col-md-4";}elseif($columnas==6){$columnas="col-md-6";}elseif($columnas==8){$columnas="col-md-8";}elseif($columnas==10){$columnas="col-md-10";}elseif($columnas==12){$columnas="col-md-12";}
  
  $retorno='
  <div class="'.$columnas.'">
    <label for="'.$nombre.'" class="control-label mb-10 text-left">'.$label.'</label>
         <select name="'.$nombre.'" id="'.$nombre.'" '.$parametros.' class="form-control rounded-input">
          <option value=""></option>'."\n";
         // echo $sql;
        $result = mysql_query($sql, $con) or die (mysql_error());
        while ($row=mysql_fetch_array($result)) {
          if($row["$campo_clave"]==$valor){$selecciona="selected";}else{$selecciona="";}
          $retorno.= '<option '.$selecciona.' value="'.utf8_decode($row["$campo_clave"]).'">'.($row["$campo_nombre"]).'</option>'."\n";
        }  // Fin while.
  $retorno.='</select>
  </div>';
  return $retorno;
}  // Fin funci�n sql.

function select_sql2($nombre,$valor,$parametros,$sql,$campo_nombre,$campo_clave,$con) {
  
  $retorno='
         <select name="'.$nombre.'" id="'.$nombre.'" '.$parametros.' class="form-control rounded-input">
          <option value=""></option>'."\n";
        $result = mysql_query($sql, $con) or die (mysql_error());
        while ($row=mysql_fetch_array($result)) {
          if($row["$campo_clave"]==$valor){$selecciona="selected";}else{$selecciona="";}
          $retorno.= '<option '.$selecciona.' value="'.utf8_decode($row["$campo_clave"]).'">'.($row["$campo_nombre"]).'</option>'."\n";
        }  // Fin while.
  $retorno.='</select>';
  return $retorno;
}  // Fin funci�n sql.
 
function select_sql_buscar($label,$columnas,$nombre,$valor,$parametros,$sql,$campo_nombre,$campo_clave,$con) {
  if($columnas==2){$columnas="col-md-2";}elseif($columnas==4){$columnas="col-md-4";}elseif($columnas==6){$columnas="col-md-6";}elseif($columnas==8){$columnas="col-md-8";}elseif($columnas==10){$columnas="col-md-10";}elseif($columnas==12){$columnas="col-md-12";}
  $retorno='
  <label>
  
   
         <select name="'.$nombre.'" id="'.$nombre.'" '.$parametros.' class="form-control">
          <option value="">'.$label.'</option>'."\n";
        $result = mysql_query($sql, $con) or die (mysql_error());
        while ($row=mysql_fetch_array($result)) {
          if($row["$campo_clave"]==$valor){$selecciona="selected";}else{$selecciona="";}
          $retorno.= '<option '.$selecciona.' value="'.utf8_decode($row["$campo_clave"]).'">'.utf8_decode($row["$campo_nombre"]).'</option>'."\n";
        }  // Fin while.
  $retorno.='</select>
  </label>';
  return $retorno;
}  // Fin funci�n sql buscar.

function mysql_este($sql,$campo,$con){
 $retorno="";
 $result = mysql_query($sql, $con) or die(mysql_error());
 if($row=mysql_fetch_array($result)){
   $retorno=$row[$campo];
 }
 return $retorno;
}

function acceso($apartado) {
  $respuesta="no";
  $accesos=obten("permisos_inventario_bomberos");
  if ($accesos=="") $accesos="|";
  $accesos=explode("|",$accesos);
  $j=count($accesos);
  for ($i=0;$i<$j;$i++) {
    if ($apartado==$accesos[$i]) {
      $respuesta="si";
      break;
    }
  }
  return $respuesta;
}

function quitar_acentos($cadena) {
  $cadena=str_replace("�","a",$cadena);
  $cadena=str_replace("�","e",$cadena);
  $cadena=str_replace("�","i",$cadena);
  $cadena=str_replace("�","o",$cadena);
  $cadena=str_replace("�","u",$cadena);
  $cadena=str_replace("�","A",$cadena);
  $cadena=str_replace("�","E",$cadena);
  $cadena=str_replace("�","I",$cadena);
  $cadena=str_replace("�","O",$cadena);
  $cadena=str_replace("�","U",$cadena);
  $cadena=str_replace("'","�",$cadena);
  $cadena=str_replace("%","",$cadena);
  return $cadena;
}  // Fin funci�n cadena.

function cambiar_acentos($cadena) {
  $cadena=str_replace("�","�",$cadena);
  $cadena=str_replace("�","�",$cadena);
  $cadena=str_replace("�","�",$cadena);
  $cadena=str_replace("�","�",$cadena);
  $cadena=str_replace("�","�",$cadena);
  $cadena=str_replace("�","�",$cadena);
  $cadena=str_replace("�","�",$cadena);
  $cadena=str_replace("�","�",$cadena);
  $cadena=str_replace("�","�",$cadena);
  $cadena=str_replace("�","�",$cadena);
  $cadena=str_replace("'","�",$cadena);
  $cadena=str_replace("%","",$cadena);
  return $cadena;
}  // Fin funci�n cadena.

function buscaValor($cadenaPermisos,$valorBuscar){
  $cadenaPermisos=explode("|",$cadenaPermisos);
  for($indCom=0;$indCom<count($cadenaPermisos);$indCom++)
  {if($valorBuscar==$cadenaPermisos[$indCom])
    {return $cadenaPermisos[$indCom];
    }//IF
    }//FOR
}//buscaValor 
  
function campo($label,$columnas,$type,$nombre,$valor,$parametros,$tamanio,$maximo) {
  if($columnas==2){$columnas="col-md-2";}elseif($columnas==4){$columnas="col-md-4";}elseif($columnas==6){$columnas="col-md-6";}elseif($columnas==8){$columnas="col-md-8";}elseif($columnas==10){$columnas="col-md-10";}elseif($columnas==12){$columnas="col-md-12";}
  return "
    <div class='$columnas'> 
      <label for='$nombre' class='control-label mb-10'>$label</label>
      <input type='$type' value='$valor' name='$nombre' id='$nombre' size='$tamanio' maxlength='$maximo' $parametros class='form-control rounded-input'>
    </div> 
    ";
}

function label($label,$columnas) {
  if($columnas==2){$columnas="col-md-2";}elseif($columnas==4){$columnas="col-md-4";}elseif($columnas==6){$columnas="col-md-6";}elseif($columnas==8){$columnas="col-md-8";}elseif($columnas==10){$columnas="col-md-10";}elseif($columnas==12){$columnas="col-md-12";}
  return "
    <div class='$columnas'> 
      <label for='$nombre' class='control-label mb-10'>$label</label> 
    </div>
  
  ";
}

function hiddenInsert($label,$columnas,$type,$nombre,$valor,$parametros,$tamanio,$maximo) {
  if($columnas==2){$columnas="col-md-2";}elseif($columnas==4){$columnas="col-md-4";}elseif($columnas==6){$columnas="col-md-6";}elseif($columnas==8){$columnas="col-md-8";}elseif($columnas==10){$columnas="col-md-10";}elseif($columnas==12){$columnas="col-md-12";}
  return " 
      <input type='hidden' value='$valor' name='$nombre' id='$nombre' size='$tamanio' maxlength='$maximo' $parametros class='form-control rounded-input'> 
  ";
} //inserta id de usario a las llaves foraneas

function imagen($label,$nombre,$columnas,$parametros,$archivo,$urlbase) {
  if($columnas==2){$columnas="col-md-2";}elseif($columnas==4){$columnas="col-md-4";}elseif($columnas==6){$columnas="col-md-6";}elseif($columnas==8){$columnas="col-md-8";}elseif($columnas==10){$columnas="col-md-10";}elseif($columnas==12){$columnas="col-md-12";}
  if($archivo){$archivo='<a href="'.$urlbase.$archivo.'" target="_blank">Archivo</a>';}else{$archivo="";}
  return "
  <div class='$columnas'>
    <label for='$nombre' class='control-label'>$label: $archivo</label>
  <input type='file' name='$nombre' id='$nombre' $parametros class='form-control'>
  </div>
  ";
}

function invierte_fecha($fechita) {
    if($fechita!=""){
      if(strpos($fechita,'-')>0){
        $fecha=explode('-',$fechita);
      }else{
        $fecha=explode('/',$fechita);
      }
      $dia=$fecha[2];
      $mes=$fecha[1];
      $anio=$fecha[0];
      $fechita=$dia."/".$mes."/".$anio;
    }
  return $fechita;
}

function memo($label,$columnas,$nombre,$valor,$parametros) {
  if($columnas==2){$columnas="col-md-2";}elseif($columnas==4){$columnas="col-md-4";}elseif($columnas==6){$columnas="col-md-6";}elseif($columnas==8){$columnas="col-md-8";}elseif($columnas==10){$columnas="col-md-10";}elseif($columnas==12){$columnas="col-md-12";}
  return "

      <div class='$columnas'>
      <label for='$nombre' class='control-label'>$label</label>
      <textarea name='$nombre' id='$nombre' $parametros class='form-control $columnas'>$valor</textarea>
      </div>
  ";
}

function wisi($label,$columnas,$nombre,$valor,$parametros) {
  if($columnas==2){$columnas="col-md-2";}elseif($columnas==4){$columnas="col-md-4";}elseif($columnas==6){$columnas="col-md-6";}elseif($columnas==8){$columnas="col-md-8";}elseif($columnas==10){$columnas="col-md-10";}elseif($columnas==12){$columnas="col-md-12";}
  return '
 
          <div class="row"> <br />
            <div class="'.$columnas.'"> <br />
              <div class="panel panel-default card-view" <br />
                <div class="panel-heading"> 
                  <div class="pull-left">
                    <h6 class="panel-title txt-dark">'.$label.'</h6> 
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                  <div class="panel-body">
                   
                      <div class="form-group">
                      <textarea id="summernote" name="'.$nombre.'" style="height: 550px;">'.utf8_decode($valor).'</textarea>
                      </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>

  ';
}

function wisicolor($label,$columnas,$nombre,$valor,$parametros) {
  if($columnas==2){$columnas="col-md-2";}elseif($columnas==4){$columnas="col-md-4";}elseif($columnas==6){$columnas="col-md-6";}elseif($columnas==8){$columnas="col-md-8";}elseif($columnas==10){$columnas="col-md-10";}elseif($columnas==12){$columnas="col-md-12";}
  return '

          <link rel="stylesheet" href="vendors/bower_components/summernote/dist/summernote.css" />
          <div class="row">
            <div class="'.$columnas.'">
              <div class="panel panel-default card-view">
                <div class="panel-heading">
                  <div class="pull-left">
                    <h6 class="panel-title txt-dark">'.$label.'</h6>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                  <div class="panel-body">
                      <div class="form-group">
                      <textarea class="summernote form-control" rows="15" placeholder="Ingresa texto" name="'.$nombre.'">'.$valor.'</textarea>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>




  ';
}

function calculaedad($fecha){
    list($anyo,$mes,$dia) = explode("-",$fecha);
    $anyo_dif  = date("Y") - $anyo;
    $mes_dif = date("m") - $mes;
    $dia_dif   = date("d") - $dia;
    if ($dia_dif < 0 || $mes_dif < 0) $anyo_dif--;
    return $anyo_dif;
}
 
function salto_linea($tama�o,$texto){
  
  return'
  <div class="col-xs-12">
  <hr style="border: 0; height: 1px;   background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));" />
  <p align="center" style="font-size:'.$tama�o.'px;">'.$texto.'</p>
  <br>
  </div> 
    '; 
}
  
function comprimirImagen($newNomb)
{
  $rtOriginal=$newNomb;
  $original = imagecreatefromjpeg($rtOriginal);
         
  //Definir tama�o m�ximo y m�nimo
  $max_ancho = 1500;
  $max_alto = 1500;
        
  //Recoger ancho y alto de la original
  list($ancho,$alto)=getimagesize($rtOriginal);

  //Calcular proporci�n ancho y alto
  $x_ratio = $max_ancho / $ancho;
  $y_ratio = $max_alto / $alto;
        
  if( ($ancho <= $max_ancho) && ($alto <= $max_alto) )
  {
    //Si es m�s peque�a que el m�ximo no redimensionamos
    $ancho_final = $ancho;
    $alto_final = $alto;
  }
        
  //si no calculamos si es m�s alta o m�s ancha y redimensionamos
  elseif (($x_ratio * $alto) < $max_alto)
  {
    $alto_final = ceil($x_ratio * $alto);
    $ancho_final = $max_ancho;
  }
  else
  {
    $ancho_final = ceil($y_ratio * $ancho);
    $alto_final = $max_alto;
  }


  //Crear lienzo en blanco con proporciones
  $lienzo=imagecreatetruecolor($ancho_final,$alto_final);

  //Copiar $original sobre la imagen que acabamos de crear en blanco ($tmp)
  imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);

  //Limpiar memoria
  imagedestroy($original);

  //Definimos la calidad de la imagen final
  $cal=90;

  //Se crea la imagen final en el directorio indicado
  imagejpeg($lienzo,$newNomb,$cal);
}

function subeImagen($nombre_imagen,$nomb_tabla,$campo_img,$ubicacion,$con,$link){
  $id=mysql_este("select max(id) as maximo from $nomb_tabla ","maximo",$con);
    
      $archivo=basename($_FILES[$nombre_imagen]['name']);
      $formato=explode(".",$archivo);
      $cont=count($formato);
      $extencion=$_FILES[$nombre_imagen]['type'];
      $ubic=$ubicacion;
      if($archivo)//IF DEL ARCHIVO
      {
        if ($extencion=="image/jpeg"||$extencion=="application/pdf"
          ||$extencion=="application/msword"||$extencion=="application/vnd.ms-excel"
          ||$extencion=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
          ||$extencion=="application/vnd.openxmlformats-officedocument.wordprocessingml.document"
          ||$extencion=="application/vnd.openxmlformats-officedocument.presentationml.presentation"
          ||$extencion=="application/vnd.ms-powerpoint")//IF DE LA EXTENSION
        {
          $hash=md5(date("Y-m-d H:i:s"));
          $ubicacion=$ubic."/".$nombre_imagen."_".$id."_".$hash.".".$formato[($cont-1)];
          $newNomb=$ubic."/".$nombre_imagen."_".$id."_".$hash.".".$formato[($cont-1)];
          //$ubicacion_thumb=$ubic."/".$nomb_tabla."_".$nombre_imagen."_".$id."_".$hash.".".$formato[($cont-1)].".thumb";
            if(file_exists($newNomb))//IF DONDE SI EXISTE EL ARCHIVO LO BORRA PARA SUSTITUIRLO
            {
              unlink($newNomb);
          }//FIN DEL IF DONDE SI EXISTE EL ARCHIVO LO BORRA PARA SUSTITUIRLO
          $file=strlen($_FILES[$nombre_imagen]['tmp_name']);
          
            if($file>0)//IF DONDE SI HAY CADENA PARA SUBIR EL ARCHIVO
            {
              if ($_FILES[$nombre_imagen]['size']<4096000)//IF DONDE SI EL ARCHIVO PESA MENOS DE 4 MegaBytes
              {
                if(copy($_FILES[$nombre_imagen]['tmp_name'], $ubicacion))//IF DONDE SI SE COPIO BIEN EL ARCHIVO
                {
                  rename($ubicacion,$newNomb);
                  $consul_imagen = "UPDATE $nomb_tabla SET $campo_img = '$ubicacion' WHERE id= '$id' ";
                  mysql_query("begin",$con);
                mysql_query($consul_imagen,$con);
                mysql_query("commit",$con);
                
              }//FIN DEL IF DONDE SI SE COPIO BIEN EL ARCHIVO
            }else { echo alerta_bota('El archivo pesa mas de 4 Mb','error', ''.$link.'');
        }
            //FIN DEL IF DONDE SI EL ARCHIVO PESA MENOS DE 4 MegaBytes
            }//FIN DEL IF DONDE SI HAY CADENA PARA SUBIR EL ARCHIVO
        
        if ($extencion=="image/jpeg"){
            comprimirImagen($ubicacion);
            //comprimirThumb($ubicacion_thumb);
          }
        }
        else 
        {
          echo alerta_bota('Formato de archivo no permitido','error', ''.$link.'');
        }
      }
}
    
function comprimirThumb($newNomb)
{
  $rtOriginal=$newNomb;
  $original = imagecreatefromjpeg($rtOriginal);
         
  //Definir tama�o m�ximo y m�nimo
  $max_ancho = 120;
  $max_alto = 120;
        
  //Recoger ancho y alto de la original
  list($ancho,$alto)=getimagesize($rtOriginal);

  //Calcular proporci�n ancho y alto
  $x_ratio = $max_ancho / $ancho;
  $y_ratio = $max_alto / $alto;
        
  if( ($ancho <= $max_ancho) && ($alto <= $max_alto) )
  {
    //Si es m�s peque�a que el m�ximo no redimensionamos
    $ancho_final = $ancho;
    $alto_final = $alto;
  }
        
  //si no calculamos si es m�s alta o m�s ancha y redimensionamos
  elseif (($x_ratio * $alto) < $max_alto)
  {
    $alto_final = ceil($x_ratio * $alto);
    $ancho_final = $max_ancho;
  }
  else
  {
    $ancho_final = ceil($y_ratio * $ancho);
    $alto_final = $max_alto;
  }


  //Crear lienzo en blanco con proporciones
  $lienzo=imagecreatetruecolor($ancho_final,$alto_final);

  //Copiar $original sobre la imagen que acabamos de crear en blanco ($tmp)
  imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);

  //Limpiar memoria
  imagedestroy($original);

  //Definimos la calidad de la imagen final
  $cal=95;

  //Se crea la imagen final en el directorio indicado
  imagejpeg($lienzo,$newNomb,$cal);
}
 
function actualizaImagen($id,$nombre_imagen,$nomb_tabla,$campo_img,$ubicacion,$con,$link){
    
      $archivo=basename($_FILES[$nombre_imagen]['name']);
      $formato=explode(".",$archivo);
      $cont=count($formato);
      
      //echo $cont;
      
      
      //echo "<br /><br /><br /><br /><h1>HOLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</h1>";
      
      $extencion=$_FILES[$nombre_imagen]['type'];
      $ubic=$ubicacion;
      if($archivo)//IF DEL ARCHIVO
      {
        //echo "<br /><br /><br /><br /><h1>HOLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</h1>";

        if ($extencion=="image/jpeg"||$extencion=="application/pdf"
          ||$extencion=="application/msword"||$extencion=="application/vnd.ms-excel"
          ||$extencion=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
          ||$extencion=="application/vnd.openxmlformats-officedocument.wordprocessingml.document"
          ||$extencion=="application/vnd.openxmlformats-officedocument.presentationml.presentation"
          ||$extencion=="application/vnd.ms-powerpoint")//IF DE LA EXTENSION
        {

          $hash=md5(date("Y-m-d H:i:s"));
          $ubicacion=$ubic."/".$nomb_tabla."_".$nombre_imagen."_".$id."_".$hash.".".$formato[($cont-1)];
          $newNomb=$ubic."/".$nomb_tabla."_".$nombre_imagen."_".$id."_".$hash.".".$formato[($cont-1)];
          //$ubicacion_thumb=$ubic."/".$nomb_tabla."_".$nombre_imagen."_".$id."_".$hash.".".$formato[($cont-1)].".thumb";


  
            if(file_exists($newNomb))//IF DONDE SI EXISTE EL ARCHIVO LO BORRA PARA SUSTITUIRLO
            {
              unlink($newNomb);
          }//FIN DEL IF DONDE SI EXISTE EL ARCHIVO LO BORRA PARA SUSTITUIRLO
          $file=strlen($_FILES[$nombre_imagen]['tmp_name']);
          
            if($file>0)//IF DONDE SI HAY CADENA PARA SUBIR EL ARCHIVO
            {
              if ($_FILES[$nombre_imagen]['size']<4096000)//IF DONDE SI EL ARCHIVO PESA MENOS DE 4 MegaBytes
              {
                if(copy($_FILES[$nombre_imagen]['tmp_name'], $ubicacion))//IF DONDE SI SE COPIO BIEN EL ARCHIVO
                {
                  rename($ubicacion,$newNomb);
                  $consul_imagen = "UPDATE $nomb_tabla SET $campo_img = '$newNomb' WHERE id= '$id' ";
                  mysql_query("begin",$con);
                mysql_query($consul_imagen,$con);
                mysql_query("commit",$con);
                  //echo "<br /><br /><br /><br />".$consul_imagen;
              }//FIN DEL IF DONDE SI SE COPIO BIEN EL ARCHIVO
            }else { echo alerta_bota('Alerta','El archivo pesa mas de 4 Mb', ''.$link.'');
        }
            //FIN DEL IF DONDE SI EL ARCHIVO PESA MENOS DE 4 MegaBytes
            }//FIN DEL IF DONDE SI HAY CADENA PARA SUBIR EL ARCHIVO
        
        if ($extencion=="image/jpeg"){
            comprimirImagen($ubicacion);
          //comprimirThumb($ubicacion_thumb);
          }
        }
        else 
        {
          echo alerta_bota('Alerta','Formato de archivo no permitido', ''.$link.'');
        }
      }//*/
}

function mailer_movimientos($id_cliente){
    
    $con=conectar();
    $fecha=date("Y-m-d");
    $hora=date("H:i:s");
    $sql_mailer="insert into mailer_movimientos (cliente,fecha,hora,enviado)
    values ('$id_cliente','$fecha','$hora','no')";
    mysql_query($sql_mailer,$con);

}
    
function mailer($mail_destino,$nombre_destino,$asunto,$mensaje){

  /**
   * This example shows settings to use when sending via Google's Gmail servers.
   * This uses traditional id & password authentication - look at the gmail_xoauth.phps
   * example to see how to use XOAUTH2.
   * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
   */
  //Import PHPMailer classes into the global namespace
  require_once 'mailer/src/PHPMailer.php';
  require_once 'mailer/src/SMTP.php';
  //Create a new PHPMailer instance
  $mail = new PHPMailer;
  //Tell PHPMailer to use SMTP
  $mail->isSMTP();
  //Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 0;
  //Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';
  // use
  // $mail->Host = gethostbyname('smtp.gmail.com');
  // if your network does not support SMTP over IPv6
  //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 587;
  //Set the encryption system to use - ssl (deprecated) or tls
  $mail->SMTPSecure = 'tls';
  //Whether to use SMTP authentication
  $mail->SMTPAuth = true;
  //Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = "jefatura.sistemas@ssas.mx";
  //Password to use for SMTP authentication
  $mail->Password = "1nf0rm4t1c4@SDIS";
  //Set who the message is to be sent from
  $mail->setFrom('jefatura.sistemas@ssas.mx', 'Jefatura Sistemas');
  //Set an alternative reply-to address
  //$mail->addReplyTo('ingfcoalv@gmail.com', 'Francisco Alvarado');
  //Set who the message is to be sent to
  $mail->addAddress($mail_destino, $nombre_destino);
  //Set the subject line
  $mail->Subject = $asunto;
  //Read an HTML message body from an external file, convert referenced images to embedded,
  //convert HTML into a basic plain-text alternative body
  //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
  //Replace the plain text body with one created manually
  //$mail->AltBody = 'This is a plain-text message body';
  $mail->IsHTML(true); 
  $mail->Body    = $mensaje;
  //$mail->MsgHTML = $mensaje;
  //Attach an image file
  //$mail->addAttachment('images/phpmailer_mini.png');
  //send the message, check for errors
  if (!$mail->send()) {
      return "Mailer Error: " . $mail->ErrorInfo;
  } else {
      return "Message sent!";
      //Section 2: IMAP
      //Uncomment these to save your message in the 'Sent Mail' folder.
      #if (save_mail($mail)) {
      #    echo "Message saved!";
      #}
  }
  //Section 2: IMAP
  //IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
  //Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
  //You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
  //be useful if you are trying to get this working on a non-Gmail IMAP server.
}
 
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}?>