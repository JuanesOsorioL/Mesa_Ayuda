<?php
    session_start();
    $Arrayfiltrado=array();
    if (isset($_POST['Accion'])) {

        $Accion=$_POST['Accion'];
        switch ($Accion) {

            case 'Seleccionar':
                echo print_r($_SESSION['Array']);

                include "../model/Empleado.php";
                include "../controller/ControlEmpleado.php"; 
                include "../controller/ControlConexion.php";

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


                echo $Observacion=' 
                <tr>
                    <td> Observaciones Anteriores</td>
                </tr>

                <tr>
                    <td><textarea name="observaciones" id="observaciones" rows="5" cols="50" disabled >'. $TodasObservaciones.'</textarea></td>
                   
                </tr>

                <tr>
                <form>
                    <td> <label for="Stotal">Solucion Total</label> 
                    <input type="radio" id="Stotal" name="option" checked ></td>

                    <td> <label for="Sparcial">Solucion Parcial</label> 
                    <input type="radio" id="Sparcial" name="option" ></td>
                    </form>
                </tr>
                
                <tr>
                    <tr>
                        <td><label for="" id="nombreempl">Radicado por: </label><label for="" id="empleadoradico">'.$respuestaEmpleadoNombrecreo.'</label></td>
                    <tr>
                        <td> Observaciones</td>
                    </tr>

                    </tr>
                    <td><textarea name="message" id="message" rows="10" cols="50"></textarea></td>
                </tr>

                <tr>
                    <td> <button type="button" id="Guardar" >Guardar</button></td>
                </tr>';

               
            break;

            case 'Cargar':

                if (isset($_SESSION['Session'])) {

                    include "../model/Detalle.php";
                    include "../controller/ControlDetalle.php";
                    include "../controller/ControlConexion.php";
                
                    $cedulaActual=$_SESSION['Session']['Cedula'];
            
                    $objDetalle=new Detalle("","","","","","",$_SESSION['Session']['Cedula']);
                    $objControlDetalle=new ControlDetalle($objDetalle);
                    $respuestaDetalle=$objControlDetalle->ConsultarRequerimientos(); 
                    $res=$respuestaDetalle->fetch_all(MYSQLI_ASSOC);
                
                    $ArrarFinal=array();
                    $cont=0;
                    $control=True;
                    $controldos=True;
                    $cadaIDReg="";
                    $Estado="";
                    $TodasObservaciones="";
                    $titulo="";
                    $FKEmplecreo="";
                    $FKEmpleAsignado="";
                     
                    for ($i=0; $i < count($res); $i++) { 
                     
                        $cadaIDReg= $res[$i]['IDREQ'];
                        for ($e=0; $e < count($res); $e++) {
                            if ($cadaIDReg===$res[$e]['IDREQ']) {
                                 $Estado=$res[$e]['FKESTADO'];
                                 $titulo=$res[$e]['TITULO'];
                                 $FKEmplecreo=$res[$e]['FKEMPLE'];
                                 $FKEmpleAsignado=$res[$e]['FKEMPLEASIGNADO'];
                                 $TodasObservaciones=$TodasObservaciones."* ".$res[$e]['OBSERVACION']."\n";//<---
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
                    //  print_r($ArrarFinal);/// aparece todos los requerimeintos con sus observaciones juntas
            
                    //djar solo los que le pertenece al registrado
                    $contador=0;
                    $controltres=True;
                  //  $Arrayfiltrado=array();
                    foreach ($ArrarFinal as $key => $value) {
                        if ($value['FKESTADO']!=="4" && $value['FKESTADO']!=="5" && $value['FKEMPLEASIGNADO']===$cedulaActual) {
                            $Arrayfiltrado[$contador]=array("FKESTADO" => $value['FKESTADO'],"IDREQ" => $value['IDREQ'],"OBSERVACION"=> $value['OBSERVACION'], "TITULO" => $value['TITULO'],"FKEMPLE" => $value['FKEMPLE'], "FKEMPLEASIGNADO" => $value['FKEMPLEASIGNADO']);
                            $contador++;
                            } 
                    } 
                    //;//array con solo los del empleado ingresado
            
                    $_SESSION['Array']=$Arrayfiltrado;
            
                    if ( count($Arrayfiltrado)!==0) {
                
                        $optionRequerimiento="";
                
                        foreach ($Arrayfiltrado as $key => $value) {
                
                            $cadaIDReg=$value['IDREQ'];
                            $FKEmplecreo=$value['FKEMPLE'];
                            $titulo=$value['TITULO'];
                            $optionRequerimiento=$optionRequerimiento.'<option value="'.$cadaIDReg.'@'. $FKEmplecreo.'">'. $titulo.'</option>';
                        }
                        echo $SiguienteSelect='
                            <tr>
                                <td>Mis Requerimientos Asignados</td>
                            </tr>
                            <tr>
                                <td><select name="SelectReque" id="SelectReque">'.$optionRequerimiento.'</select></td>
                                <td> <button type="button" id="Seleccionar"  >Seleccionar</button></td>  
                            </tr>'; 
                    }else{
                        echo $SiguienteSelect='
                        
                        <span>No hay Requerimientos Para Asignar<span>
                        
                        '; 
                    }
                }   
            break;

            case 'Guardar':

                $Resultado="";
                include "../model/Detalle.php";
                include "../controller/ControlDetalle.php";
                include "../controller/ControlConexion.php";

                $porciones = explode("@", strval($_POST['SelectReque']));
                $Estado="";
                $CapturarSelectRequerimiento=$porciones[0];/// fkreq
                $empleado=$porciones[1];
                $empleadoasignado=$_SESSION['Session']['Cedula']; // empleado a saginar

                if ($_POST['Stotal']==="true") {
                    $Estado="4";//estqado
                } else { 
                    $Estado="3";//estqado
                }
               
                $observacion=$_POST['message'];
                $FECHA= (new DateTime('now'))->format("Y-m-d");
   
               
                $objDetalle=new Detalle("",$FECHA,$observacion,$CapturarSelectRequerimiento, $Estado,$empleado,$empleadoasignado);
                $objControlDetalle=new ControlDetalle($objDetalle);
                $respuestaDetalle=$objControlDetalle->GuardarNuevoDetalleReg();

                $Resultado="id requerimeinto: ".$CapturarSelectRequerimiento." empleado: ". $empleado." estado: ". $Estado." observacion: ".$observacion." fecha: ".$FECHA." empleado asignado: ".  $empleadoasignado." se guardo ".$respuestaDetalle;

               
                echo $Resultado;    
            break;

            default:
                 
            break;
        }
    }

    

?>