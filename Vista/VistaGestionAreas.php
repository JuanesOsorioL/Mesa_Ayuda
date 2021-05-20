<?php

    include "./Modelo/Area.php";
    include "./Control/ControlArea.php";
    include "./Modelo/Empleado.php";
    include "./Control/ControlEmpleado.php";
    include "./Control/ControlConexion.php";
    
    $objArea=new Area("","","");
    $objControlArea=new ControlArea($objArea);
    $respuestaArea=$objControlArea-> consultarTodasAreas();
    $ArrayArea=$respuestaArea->fetch_all(MYSQLI_ASSOC);
    

   
   // session_start();
   // $menu="";
    $plantilla="";

if (isset($_POST['btn'])) {

    $bot=$_POST['btn'];
    switch ($bot) {

    case 'Actualizar':
        $ArrayAreauno=$ArrayArea;
        for ($e=0; $e < $respuestaArea->num_rows; $e++) { 

        $area;
        $cedula;

            if ($_POST['SelectEmpleado'][$e]!=="0") {
                $area=$ArrayAreauno[$e]['IDAREA'];
                $cedula=$_POST['SelectEmpleado'][$e];
            }else{
                $area=$ArrayAreauno[$e]['IDAREA'];
                $cedula=NULL;
            } 
              $objActualizarArea=new Area($area,"",$cedula);
              $objControlActualizarArea=new ControlArea($objActualizarArea);
              $r=$objControlActualizarArea-> modificarAreaFkempleado(); 
              //  print_r($r);
            }
            header("Location: ./GestionArea.php");
    break;


    case 'Menu':
        header("Location: ./Menu.php");
    break;

    default:
    break;
    }

} 




function select($ID){

    $objEmpleado=new Empleado("", "", "", "", "", "", "", "", "", "", "", "", "", "");
    $objControlEmpleado=new ControlEmpleado($objEmpleado);
    $respuestaEmpleado=$objControlEmpleado-> ConsultarSoloEmpleados();

    if ($respuestaEmpleado->num_rows!==0) {
            $ArrayEmpleado=$respuestaEmpleado->fetch_all(MYSQLI_ASSOC);
            $select="";
            for ($b=0; $b < $respuestaEmpleado->num_rows; $b++) { 

                if ($ArrayEmpleado[$b]['IDEMPLEADO']===$ID) {
                    $select=$select.'<option value="'.$ArrayEmpleado[$b]['IDEMPLEADO'].'" selected>'.$ArrayEmpleado[$b]['NOMBRE'].'</option>';
                } else {
                    $select=$select.'<option value="'.$ArrayEmpleado[$b]['IDEMPLEADO'].'">'.$ArrayEmpleado[$b]['NOMBRE'].'</option>';
                }
            }
        
        return  $selectEmpleado='
            <select name="SelectEmpleado[]">
                <option value="0">Ninguno</option>
                '.$select.'
            </select>';
    
    }else{
       return $selectEmpleado='
        <select ">
            <option value="0">No hay empleados Registrados</option>
            '.$select.'
        </select>';  
    }
}



    if ($respuestaArea->num_rows!==0) {
   



        $Resultado="";
    for ($i=0; $i < $respuestaArea->num_rows; $i++) { 
       $Resultado = $Resultado.' 
       <tr>
       <td >'.$ArrayArea[$i]['IDAREA'].'</td>
       <td>'.$ArrayArea[$i]['NOMBRE'].'</td>
       <td>'.select($ArrayArea[$i]['FKEMPLE']).'</td>
    </tr>';
    }
    
        $plantilla='
       
            <tr>
                <td colspan="3" class=" tituloprincipal" >Areas</td>
            </tr>
    
            <tr>
                <td class=" titulosecundario">ID</td>
                <td class=" titulosecundario">Nombre Area</td>
                <td class=" titulosecundario">Director Area</td>
            </tr>
    
            '.$Resultado.'
       
        ';
    
    
    } else {
       
    } 

















  /*  if (isset($_SESSION['Session'])) {
        switch ($_SESSION['Session']['Cargo']) {
            case '1':
        


                
            $menu=' 
                <table>
                    <tr>
                        <td><input type="button" value="Administrar usuarios"></td>
                        <td><input type="button" value="Gestión de áreas"></td>
                        <td><input type="button" value="Empledos "></td>
                        <td><input type="button" value="Cargos"></td>
                        <td><input type="button" value="Consultas "></td>
                        <td><input type="button" value="Informes"></td>
                        <td><input type="button" value="Cerrar seccion" onclick="Cerrarseccion();"></td>
                    </tr>
                </table>';
            
            break;
        
            default:

                include "./Modelo/Area.php";
                include "./Control/ControlArea.php";
                include "./Control/ControlConexion.php";
                

                $cedula=$_SESSION['Session']['Cedula'];
            
                $objArea=new Area("","",$cedula);
                $objControlArea=new ControlArea($objArea);
                $respuesta=$objControlArea-> ConsultarCedulaEnArea();
                
                if ($respuesta->num_rows!==0) {
                    $Array = $respuesta->fetch_all(MYSQLI_ASSOC);
                    print_r($Array); 
                    
                    $menu=' 
                    <table>
                        <tr>
                            <td><input type="button" value="Consultas "></td>
                            <td><input type="button" value="Informes"></td>
                            <td><input type="button" value="Mis Requerimientos"></td>
                            <td><input type="button" value="Requerimiento" onclick="Requerimiento();"></td>
                            <td><input type="button" value="Cerrar seccion" onclick="Cerrarseccion();"></td>
                        </tr>
                    </table>';
                } else {
                    $menu='
                        <table>
                            <tr>
                                <td><input type="button" value="Requerimiento" onclick="Requerimiento();"></td>
                                <td><input type="button" value="Mis Requerimientos"></td>
                                <td><input type="button" value="Cerrar seccion" onclick="Cerrarseccion();"></td>
                            </tr>
                        </table>';
                }
            break;
        }
    } else {
       
    }    */

?>