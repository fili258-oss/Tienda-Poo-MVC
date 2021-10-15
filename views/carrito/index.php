<h1>Carrito de la compra</h1>
<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >=1):?>
<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Eliminar</th>
        
    </tr>
    <?php foreach ($carrito as $indice => $elemento): 
        $producto = $elemento['producto'];
    ?>
    <tr>
        <td>
            <?php if (isset($producto->imagen) != null): ?>
                <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito"/>
            <?php else: ?>
                <img src="<?= base_url ?>assets/img/camiseta.png" class="img_carrito"/>
            <?php endif; ?>
        </td>
        <td> 
            <a href="<?= base_url?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a>
        </td>
        <td> 
            <?=$producto->precio?>
        </td>
        <td> 
           
            <?=$elemento['unidades']?>
            <div class="updown-unidades">
               <a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="button">+</a>
               <a href="<?=base_url?>carrito/down&index=<?=$indice?>" class="button">-</a>
            </div>
        </td>
        <td> 
            <div class="delete-cart"><a href="<?=base_url?>carrito/delete&index=<?=$indice?>" class="button button-pedido button-red">Quitar producto</a></div>
        </td>
    </tr>
    <?php endforeach;?>
    
</table>
<br/>

<?php $stats = Utils::statsCarrito();?>
<div class="total">
    <h3>Total: $<?=$stats['total']?> Cop</h3>
</div>

<div class="delete-cart"><a href="<?=base_url?>carrito/delete_all" class="button button-pedido button-red">Vaciar carrito</a></div>
<div class="confirm-cart"><a href="<?=base_url?>pedido/hacer" class="button button-pedido">Confirmar pedido</a></div>
<?php else:?>
    <p>El carrito está vacio, añade algun producto</p>
<?php endif;?>