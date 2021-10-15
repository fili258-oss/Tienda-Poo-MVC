<h1>Gestión de productos</h1>

<a href="<?=base_url?>producto/crear" class="button button-agregar">Crear producto</a>

<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'):?>
<div class="alerta">El producto se ha creado correctamente</div>

<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'):?>
<div class="alerta alerta-error">El producto NO ha creado correctamente</div>
<?php endif;?>
<?php Utils::deteleSession('producto')?>


<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'):?>
<div class="alerta">El producto se ha borrado correctamente</div>

<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'):?>
<div class="alerta alerta-error">El producto NO ha borrado correctamente</div>
<?php endif;?>
<?php Utils::deteleSession('delete')?>


<table>
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>

        </tr>
    
    <?php while ($pro = $productos->fetch_object()):?>
        <tr>
            <td><?=$pro->id;?></td>
            <td><?=$pro->nombre;?></td>
            <td><?=$pro->precio;?></td>
            <td><?=$pro->stock;?></td>
            <td>
                <a href="<?=base_url?>producto/editar&id=<?=$pro->id?>" class="button button-editar">Editar</a>
                <a href="<?=base_url?>producto/eliminar&id=<?=$pro->id?>" class="button button-editar button-red">Eliminar</a>
            </td>

        </tr>    
    <?php endwhile;?>
</table>
