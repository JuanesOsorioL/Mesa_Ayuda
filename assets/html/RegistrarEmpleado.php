<!DOCTYPE html>
<html lang="en">

  <head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Style -->
    <link rel="stylesheet" href="../style/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <script src="../script/view/javascript/Utilidades.js"></script>

    <title>RegistrarEmpleado</title>

  </head>

  <body>
  
    <?php 

      $Cedula="";
      $Nombre="";
      $Telefono="";
      $Email="";
      $Direccion="";
      $X="";
      $Y="";
      $Area="0";
      $Usuario="";
      $Pass="";
      $msj="";
    
      include "../script/view/VistaRegistroEmpleado.php";
    
      if (isset($_POST['btn'])) {

        $bot=$_POST['btn'];
        switch ($bot) {
    
          case "Regresar":
            header("Location: ../../index.php");
          break;
    
          case 'Guardar':
            $Cedula=$_POST["txtIDEmpleado"];
            $Nombre=$_POST["txtNombre"];
            $Telefono=$_POST["txtTelefono"];
            $Email=$_POST["txtEmail"];
            $Direccion=$_POST["txtDireccion"];
            $X=$_POST["txtX"];
            $Y=$_POST["txtY"];
            $Area=$_POST["Area"];
            $Usuario=$_POST["txtUsuario"];
            $Pass=$_POST["txtContraseña"];
            $msj= guardar();

            if ( $msj==="Empleado Guardado Con Exito") {
              $Cedula="";
              $Nombre="";
              $Telefono="";
              $Email="";
              $Direccion="";
              $X="";
              $Y="";
              $Area="0";
              $Usuario="";
              $Pass="";
            }

          break;
        }
      }
    ?>

    <header>

      <div class="header--logo">
        <a href="../../index.php" class="bt-menu"><img class="header__a--img" src="../img/Logo.png" alt="logo"></a>
      </div>
  
  
      <div class="header--menu">

        <span>Menu</span>
        <nav class="header--nav">
          <ul class="nav--ul">
            <li class="nav__ul--li"><a href="#"><span class="icon-house"></span>Quienes Somos</a></li>
            <li class="nav__ul--li"><a href="#"><span class="icon-suitcase"></span>Servicios</a></li>
            <li class="nav__ul--li"><a href="#"><span class="icon-rocket"></span>Productos</a></li>
            <li class="nav__ul--li"><a href="#"><span class="icon-earth"></span>Estructura Organizacional</a>
            </li>
            <li class="nav__ul--li"><a href="#"><span class="icon-mail"></span>Contactos</a></li>
          </ul>
        </nav>
  
      </div>
  
      <div class="header--loguin"></div>

    </header>
  
    <main>
      <section class="registrar_empleado">
        <form class="section--form" method="POST" enctype='multipart/form-data'
          action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
  
          <table class="form--table">
            <tr class="form--fila_titulo">
              <td colspan="2">Registro de Empleados</td>
            </tr>
            <tr class="form--fila">
              <td class="col-sm-2 col-form-label">Cedula: </td>
              <td><input type="text" class="form--texto" id="IDEmple" name="txtIDEmpleado" value="<?php echo $Cedula;?>">
              </td>
            </tr>
            <tr class="form--fila">
              <td class="col-sm-2 col-form-label">Nombre: </td>
              <td><input type="text" class="form--texto" name="txtNombre" value="<?php echo $Nombre;?>"></td>
            </tr>
            <tr class="form--fila">
              <td class="col-sm-2 col-form-label">Foto: </td>
  
              <td>
                <input type="button" class="btn-Agregar" name="btn" value="Subir Foto" onclick="subirFoto(event)" />
                <input name='Imagen' class="form--input-foto" type='file'>
              </td>
            </tr>
            <tr class="form--fila">
              <td class="col-sm-2 col-form-label">CV: </td>
              <td>
                <input type="button" class="btn-Agregar" name="btn" value="Subir CV" onclick="subirCV(event)" />
                <input name='HojaVida' class="form--input-cv" type='file'>
              </td>
            </tr>
            <tr class="form--fila">
              <td class="col-sm-2 col-form-label">Telefono: </td>
              <td><input type="text" class="form--texto" name="txtTelefono" value="<?php echo $Telefono;?>"></td>
            </tr>
            <tr class="form--fila">
              <td class="col-sm-2 col-form-label">Email: </td>
              <td><input type="text" class="form--texto" name="txtEmail" value="<?php echo $Email;?>"></td>
            </tr>
            <tr class="form--fila">
              <td class="col-sm-2 col-form-label">Direccion: </td>
              <td><input type="text" class="form--texto" name="txtDireccion" value="<?php echo $Direccion;?>"></td>
            </tr>
            <tr class="form--fila">
              <td class="col-sm-2 col-form-label">X: </td>
              <td><input type="text" class="form--texto" name="txtX" value="<?php echo $X;?>"></td>
            </tr>
            <tr class="form--fila">
              <td class="col-sm-2 col-form-label">Y: </td>
              <td><input type="text" class="form--texto" name="txtY" value="<?php echo $Y;?>"></td>
            </tr>
  
            <tr class="form--fila">
              <td class="col-sm-2 col-form-label">Area: </td>
              <td>
                <select id="Area" name="Area" class="form--texto">
                  <option value="0">Seleccione</option>
                  <?php CargarListarArea(); ?>
                </select>
              </td>
            </tr>
  
            <tr class="form--fila">
              <td class="col-sm-2 col-form-label">Usuario: </td>
              <td><input type="text" class="form--texto" name="txtUsuario" value="<?php echo $Usuario;?>"></td>
            </tr>
            <tr class="form--fila">
              <td class="col-sm-2 col-form-label">Clave: </td>
              <td><input type="text" class="form--texto" name="txtContraseña" value="<?php echo $Pass;?>"></td>
            </tr>
            <tr class="form--fila_boton">
              <td colspan="2"><input type="submit" name="btn" value="Guardar" class="btn-Guardar" />
                <input type="submit" name="btn" value="Regresar" class="btn-Regresar" />
              </td>
            </tr>
          </table>
        </form>
      </section>
  
      <section class="mensaje">
        <?php echo $msj;?>
      </section>
    </main>
  
    <footer>
      <div class="footer-contenedor">
  
        <div class="redessociales">
  
          <div class="circulo">
            <i class="fab fa-twitter-square"></i>
          </div>
          <div class="circulo">
            <i class="fab fa-linkedin"></i>
          </div>
          <div class="circulo">
            <i class="fab fa-telegram"></i>
          </div>
          <div class="circulo">
            <i class="fab fa-facebook-square"></i>
          </div>
  
        </div>
  
        <div class="texto">
          <span>Mesa De Ayuda - Colombia</span>
          <span>© 2020 Copyright</span>
        </div>
  
      </div>
    </footer>

  </body>
  <!-- <script src="../script/view/javascript/menu.js"></script> -->
  </html>