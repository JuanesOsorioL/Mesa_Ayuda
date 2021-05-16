<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php 
    include "./Vista/VistaGestionAreas.php";
 ?>
<body>



    <header>
    </header>




    <main>
    <section>
    <form  method="POST"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" >

    <?php echo  $plantilla; ?>

    <input type="submit" value="Menu" name="btn" onclick="Menu();" >
    <input type="submit" value="Actualizar" name="btn" >

    </form>
    </section>



        <section>
            <?php 
            echo $menu; 
          
            ?>
        </section>
    </main>

    <footer>
    </footer>

</body>
</html>