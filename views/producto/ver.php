<?php if (isset($product)): ?>
    <h1><?= $product->nombre ?></h1>
    
    <div id="detail-product">
        <div class="image">
            <?php if (isset($product->imagen) != null): ?>
                <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" alt="camiseta"/>
            <?php else: ?>
                <img src="<?= base_url ?>assets/img/camiseta.png"/>
            <?php endif; ?>
        </div>  
        <div class="data">
            <h4>Descripción:</h4><p class="descripcion"><?= $product->descripcion ?></p>
            <p class="price"><?= $product->precio ?> Cop</p>
            <a href="<?= base_url ?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>El producto no existe!</h1>
<?php endif; ?>





