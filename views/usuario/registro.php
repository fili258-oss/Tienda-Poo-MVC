<h1>Registrarse</h1>

<?php if(isset($_SESSION['register'])):?>
<!--    <strong>Registro Completado Correctamente</strong>-->
    <div class="alerta"> <?= $_SESSION['register'] ?></div>
<?php elseif(isset($_SESSION['errores_general'])):?>
<!--    <strong>Registro Fallido</strong>-->
    <div class="alerta-error"> <?= $_SESSION['errores_general']?></div>
<?php endif;?>
       
    
<form action="<?=base_url?>usuario/save" method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" placeholder="Ingrese su Nombre" >
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'], 'nombre') : ' '; ?>   
    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" placeholder="Ingrese sus Apellidos" >
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'], 'apellidos') : ' '; ?>
    
    <label for="email">E-mail</label>
    <input type="email" name="email" placeholder="Ingrese Correo" >
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'], 'email') : ' '; ?>
    
    <label for="password">Contraseña</label>
    <input type="password" name="password" placeholder="Igrese una Contraseña" >
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'], 'password') : ' '; ?>
    
    <input type="submit" name="registrar" value="Registrarme">
</form>
<?php if (isset($_SESSION['errores']) || isset($_SESSION['register'])):?>
<?php Utils:: borrarErrores();?>
<?php endif;?>     
   
     