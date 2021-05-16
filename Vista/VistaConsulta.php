<?php

    session_start();

    $selectArea="";
    $selectRequerimiento="";
    $FkEmpleado="";
    $Observacion="";
    $selectEmpleado="";
  
    $SiguienteSelect="";

/*     if (isset($_POST['Accion'])) {
        $vari=$_POST['Accion'];
      
        echo "hola ".$vari;
       
    } */

   
   // if (isset($_SESSION['Areas'])) {

      /*   $option="";
        foreach ($_SESSION['Areas'] as $key => $value) {
            $option=$option.'<option value="'.$value['IDAREA'].'">'.$value['NOMBRE'].'</option>';
        }
        $selectArea='<select name="SelectArea" id="SelectArea">'.$option.'</select>'; */



        if (isset($_POST['Accion'])) {
            $Accion=$_POST['Accion'];
            switch ($Accion) {

                case 'Buscar':

                    include "../Modelo/Requerimiento.php";
                   // include "../Modelo/Detalle.php";
                  //  include "../Control/ControlDetalle.php";
                    include "../Control/ControlRequerimiento.php";
                    include "../Control/ControlConexion.php";

                    $objRequerimiento=new Requerimiento("",strval($_POST['SelectArea']),"");
                    $objControlRequerimiento=new ControlRequerimiento($objRequerimiento);
                    $respuesta=$objControlRequerimiento->ColsultarTodosLosID();
                    $respuestaRequerimiento=$respuesta->fetch_all(MYSQLI_ASSOC);
                //////////////////////////                  

               //  echo print_r($respuestaRequerimiento);


                    $ArrarFinal=array();
                // $optionRequerimiento="";
                    $cont=0;
                    $control=True;
                    $controldos=True;
                    $cadaIDReg="";
                    $Estado="";
                    $TodasObservaciones="";
                    $titulo="";
                    $FKEmplecreo="";
                    $FKEmpleAsignado="";

                for ($i=0; $i < count($respuestaRequerimiento); $i++) { 

                    $cadaIDReg= $respuestaRequerimiento[$i]['IDREQ'];
                    for ($e=0; $e < count($respuestaRequerimiento); $e++) {
                        if ($cadaIDReg===$respuestaRequerimiento[$e]['IDREQ']) {
                            $Estado=$respuestaRequerimiento[$e]['FKESTADO'];
                            $titulo=$respuestaRequerimiento[$e]['TITULO'];
                            $FKEmplecreo=$respuestaRequerimiento[$e]['FKEMPLE'];
                            $FKEmpleAsignado=$respuestaRequerimiento[$e]['FKEMPLEASIGNADO'];
                            $TodasObservaciones=$TodasObservaciones."* ".$respuestaRequerimiento[$e]['OBSERVACION']."\n";
                        }
                    }

                    if ($control) {
                        $ArrarFinal[$cont] = array("IDREQ" => $cadaIDReg,"OBSERVACION"=> $TodasObservaciones, "FKESTADO" => $Estado,"TITULO" => $titulo,"FKEMPLE" => $FKEmplecreo, "FKEMPLEASIGNADO" => $FKEmpleAsignado);

                        $TodasObservaciones="";
                        $control=false;
                        $cont++;
                    } else {
                        for ($d=0; $d < count($ArrarFinal); $d++) {

                            if ($ArrarFinal[$d]['IDREQ']===$cadaIDReg) {
                                $controldos=false;
                                $d=count($ArrarFinal);
                            } else {
                                $controldos=True;
                            }
                        }

                        if ($controldos) {
                            $ArrarFinal[$cont] =array("IDREQ" => $cadaIDReg,"OBSERVACION"=> $TodasObservaciones, "FKESTADO" => $Estado,"TITULO" => $titulo,"FKEMPLE" => $FKEmplecreo, "FKEMPLEASIGNADO" => $FKEmpleAsignado);
                            $TodasObservaciones="";
                            $cont++;
                        }
                    }
                    $TodasObservaciones="";
                } 

                

              //  echo print_r($ArrarFinal) ;//muestra requerimiento con su ultimo estado y todos las observaciones
                
                //segundo filtro
                //dejar solo los estados 1-2-3


                    $contador=0;
                    $controltres=True;
                    $Arrayfiltrado=array();
                    foreach ($ArrarFinal as $key => $value) {
                    if ($value['FKESTADO']!=="4" && $value['FKESTADO']!=="5") {
                        $Arrayfiltrado[$contador]=array("FKESTADO" => $value['FKESTADO'],"IDREQ" => $value['IDREQ'],"OBSERVACION"=> $value['OBSERVACION'], "TITULO" => $value['TITULO'],"FKEMPLE" => $value['FKEMPLE'], "FKEMPLEASIGNADO" => $value['FKEMPLEASIGNADO']);
                        $contador++;
                        } 
                    }  
                    $_SESSION['Array']=$Arrayfiltrado;
                // echo print_r($Arrayfiltrado);//muestra los ultimos requerimientos con estado 1-2-3 solamente

                

                if ( count($Arrayfiltrado)!==0) {

                        $optionRequerimiento="";

                        foreach ($Arrayfiltrado as $key => $value) {

                            $cadaIDReg=$value['IDREQ'];
                            $FKEmplecreo=$value['FKEMPLE'];
                            $titulo=$value['TITULO'];

                       ///  $Estado="";
                         //   $TodasObservaciones=$value['OBSERVACION'];
                          //  $FKEmpleAsignado=""; 

                            $optionRequerimiento=$optionRequerimiento.'<option value="'.$cadaIDReg.'@'. $FKEmplecreo.'">'. $titulo.'</option>';

                        }
                        echo $SiguienteSelect='
                            <tr>
                                <td>Requerimientos Sin Asignar</td>
                            </tr>
                            <tr>
                                <td><select name="SelectReque" id="SelectReque">'.$optionRequerimiento.'</select></td>
                                <td> <button type="button" id="Seleccionar" >Seleccionar</button></td>
                                        
                            </tr>'; 
                    }else{
                        echo $SiguienteSelect='
                        <tr>
                        <td>No hay Requerimientos Para Asignar</td>
                        </tr>
                        '; 
                    }   

                    

                ///////////////////////
                /*                    if ( $respuesta->num_rows!==0) {

                        $optionRequerimiento="";

                        foreach ($respuestaRequerimiento as $key => $value) {
                            $IDREQ=$value['IDREQ'];
                            // $FKAREA=$value['FKAREA'];
                            $FKESTADO="1";

                            $objDetalle=new Detalle("","","", $IDREQ, $FKESTADO,"","");
                            $objControlDetalle=new ControlDetalle($objDetalle);
                            $respuestaDetalle=$objControlDetalle->ConsulRequeSinAsignar(); 
                            $res=$respuestaDetalle->fetch_all(MYSQLI_ASSOC);

                            $FkEmpleado==$res[0]['FKEMPLEASIGNADO'];

                          $optionRequerimiento=$optionRequerimiento.'<option value="'.$IDREQ.'@'.$res[0]['FKEMPLE'].'">'.$res[0]['OBSERVACION'].'</option>';

                        }

                     
                        
                        echo $SiguienteSelect='
                        <tr>
                           <td>Requerimientos Sin Asignar</td>
                        </tr>
                        <tr>
                           <td><select name="SelectReque" id="SelectReque">'.$optionRequerimiento.'</select></td>
                           <td> <button type="button" id="Seleccionar" >Seleccionar</button></td>
                          
                        </tr>'; 
                    }
                    else{
                        echo $SiguienteSelect='
                        <tr>
                           <td>No hay Requerimientos Para Asignar</td>
                        </tr>
                        '; 
                    }  */
           
                break;
                

                case 'Seleccionar':
                      
                        include "../Modelo/Empleado.php";
                        include "../Control/ControlEmpleado.php"; 
                        include "../Control/ControlConexion.php";


                        //////traer el nombre del que lo radica y observaciones

                        $Estado="";
                        $TodasObservaciones="";
                        $FKEmpleAsignado="";
                        $porciones = explode("@", strval($_POST['SelectReque']));
                        $CapturarSelectRequerimiento=$porciones[0];/// fkreq
                        foreach ($_SESSION['Array'] as $key => $value) {
                            if ($cadaIDReg=$value['IDREQ']===$CapturarSelectRequerimiento) {
                                $Estado="";
                                $TodasObservaciones=$value['OBSERVACION'];
                                $FKEmpleAsignado=$value['FKEMPLE'];
                            }   
                        }

                        $objEmpleadoNombre=new Empleado($FKEmpleAsignado, "", "", "", "", "", "", "", "", "", "", "", "", "");
                        $objControlEmpleadoNombre=new ControlEmpleado($objEmpleadoNombre);
                        $respuestaEmpleadoNombrecreo=$objControlEmpleadoNombre-> ConsultarSoloNombre();
                        //////


                        $Observacion="";
                        $selectEmpleado="";
                        $objEmpleado=new Empleado("", "", "", "", "", "", "", "", "", strval($_POST['SelectArea']), "", "", "", "");
                        $objControlEmpleado=new ControlEmpleado($objEmpleado);
                        $respuestaEmpleado=$objControlEmpleado-> ConsultarSoloEmpleadosPorArea();
    
                        //////empleados
     
                       
 
                        if ($respuestaEmpleado->num_rows!==0) {
                            $ArrayEmpleado=$respuestaEmpleado->fetch_all(MYSQLI_ASSOC);
                            $select="";
    
                            for ($b=0; $b < $respuestaEmpleado->num_rows; $b++) { 
    
                                if ($ArrayEmpleado[$b]['IDEMPLEADO']===$FkEmpleado) {
                                    $select=$select.'<option value="'.$ArrayEmpleado[$b]['IDEMPLEADO'].'" selected>'.$ArrayEmpleado[$b]['NOMBRE'].'</option>';
                                } else { 
                                    $select=$select.'<option value="'.$ArrayEmpleado[$b]['IDEMPLEADO'].'">'.$ArrayEmpleado[$b]['NOMBRE'].'</option>';
                                } 
    
                                if ($FkEmpleado!==NULL) {
                                    $selected="selected";
                                } else {
                                    $selected="";
                                }
    
                                $selectEmpleado='<select name="SelectEmpleado" id="SelectEmpleado"><option value="0" '.$selected.'>Ninguno</option>'.$select.' </select>';
                            } 

                                echo $Observacion=' 
                                <tr>
                                    <td> Observaciones Anteriores</td>
                                </tr>

                                <tr>
                                    <td><textarea name="observaciones" id="observaciones" rows="5" cols="50" disabled >'. $TodasObservaciones.'</textarea></td>
                                   
                                </tr>

                                <tr>
                                <form action="/action_page.php">
                                    <td> <label for="cancelar">Cancelar</label><input type="radio" id="cancelar" name="option" value="Cancelar"></td>
                                    <td> <label for="asignar">Asignar</label><input type="radio" id="asignar" name="option" value="Asignar" checked></td>
                                    </form>
                                </tr>
                                
                                <tr>
                                    <tr>
                                        <td><label for="" id="nombreempl">Radicado por: </label><label for="" id="empleadoradico">'.$respuestaEmpleadoNombrecreo.'</label></td>
                                      
                                        <td>Asignar a: '.$selectEmpleado.'</td>

                                    <tr>
                                        <td> Observaciones</td>
                                    </tr>

                                    </tr>
                                    <td><textarea name="message" id="message" rows="10" cols="50"></textarea></td>
                                </tr>

                                <tr>
                                    <td> <button type="button" id="Guardar" >Guardar</button></td>
                                </tr>
                                ';
                        }else{
                            echo $Observacion='
                            <tr>
                               <td>No hay empleados Registrados de esta area, Para Asignar Reuqerimiento</td>
                            </tr>
                            '; 
                        }   
                break;


                case 'Guardar':
                    $Resultado="";
                    include "../Modelo/Detalle.php";
                    include "../Control/ControlDetalle.php";
                    include "../Control/ControlConexion.php";

                    $porciones = explode("@", strval($_POST['SelectReque']));
                    $Estado="";
                    $CapturarSelectRequerimiento=$porciones[0];/// fkreq
                    $empleado=$porciones[1];
                   
                    $CapturarSelectEmpleado=$_POST['SelectEmpleado'];
                    $empleadoasignado="";
                    if ($CapturarSelectEmpleado!=="0") {
                        $Estado="2";//estqado
                        $empleadoasignado=$CapturarSelectEmpleado;
                    } else {
                        $empleadoasignado=$_SESSION['Session']['Cedula']; // empleado a saginar
                        $Estado="5";//estqado
                    }
                    
                   
                    $observacion=$_POST['message'];
                    $FECHA= (new DateTime('now'))->format("Y-m-d h:i:s");
       
                   


                    $objDetalle=new Detalle("",$FECHA,$observacion,$CapturarSelectRequerimiento, $Estado,$empleado,$empleadoasignado);
                    $objControlDetalle=new ControlDetalle($objDetalle);
                    $respuestaDetalle=$objControlDetalle->GuardarNuevoDetalleReg();


                    $Resultado="id requerimeinto: ".$CapturarSelectRequerimiento." empleado: ". $empleado." estado: ". $Estado." observacion: ".$observacion." fecha: ".$FECHA." empleado asignado: ".  $empleadoasignado." se guardo ".$respuestaDetalle;

                    //$res=$respuestaDetalle->fetch_all(MYSQLI_ASSOC);
                    echo $Resultado; 
 
                      
                break;



                default:
                 
                break;
            }
        }
   // }

  
?>
