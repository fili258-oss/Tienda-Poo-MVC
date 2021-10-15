<h1>Crear nueva categoría</h1>

<?php if(isset($_SESSION['register'])):?>
    <div class="alerta"> <?= $_SESSION['register'] ?></div>

<?php endif;?>     
<?php if(isset($_SESSION['errores_general'])):?>
    <div class="alerta alerta-error"> <?= $_SESSION['errores_general']?></div>
<?php endif;?>
<form action="<?=base_url?>categoria/save" method="post">

    <label for="nombre">Nombre</label>    
    <input type="text" name="nombre" >
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'], 'nombre') : ' '; ?>   
    <input type="submit" name="name" value="Guardar">
    
</form>
    
<?php if (isset($_SESSION['errores']) || isset($_SESSION['register']) || isset($_SESSION['errores_general'])):?>
<?php Utils:: borrarErrores();?>
<?php endif;?> 

