<?php

require_once 'models/pedido.php';

class pedidoController {

    public function hacer() {

        require_once 'views/pedido/hacer.php';
    }

    public function add() {              
        
        if(isset($_POST['confirmar'])){
            
            //RECORREMOS EL CARRITO PARA RESTAR EL STOCK DE CADA PRODUCTO AGREGADO AL CARRITO
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                
                $stock = new Pedido();
                
                $producto = $elemento['producto'];
                if($elemento['unidades'] > 1){
                    $new_stock = $producto->stock - $elemento['unidades'];
                    
                }else{
                    $new_stock=$producto->stock--;
                }
                                
                $stock->decrementStock($producto->id, $new_stock);
                
            }            
        }         
        
        if (isset($_SESSION['identity'])) {

            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            if ($provincia && $localidad && $direccion) {
                //Guardar datos en la base de datos                        
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save = $pedido->save();
                
                //Guardar linea pedido
                $save_linea = $pedido->saveLinea();
                
                if ($save && $save_linea) {
                    $_SESSION['pedido'] = "complete";                                        
                    
                } else {
                    $_SESSION['pedido'] = "failed";
                }
            } else {
                $_SESSION['pedido'] = "failed";
            }
            header("Location:" . base_url."pedido/confirmado");
        } else {
            // Redirigir al index, todo quedo full guardando pedidos
            header("Location:" . base_url);
        }
    }

    public function confirmado() {            
                
        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identity->id);
            
           
                        
            $pedido = $pedido->getOneByUser();
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductsByPedido($pedido->id);
            
        }
        //vaciamos el carrito
        if(isset($_SESSION['carrito'])){
            Utils::deteleSession('carrito');
        }
        
                
        require_once 'views/pedido/confirmado.php';
    
    }
    
    public function mis_pedidos() {
        Utils::isIdentity();
        
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();
        
        //sacar los pedidos del usuario
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();
        
        // quede aquí------
        require_once 'views/pedido/mis_pedidos.php';
    }
    
    public function detalle() {
        Utils::isIdentity();
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
       
            //Sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();
                        
            //Sacar los productos            
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductsByPedido($id);
            
            
            require_once 'views/pedido/detalle.php';
        
        } else {
            header("Location:".base_url.'pedido/mis_pedidos');
        }
    }
    
    public function gestion() {
        Utils::isAdmin();
        $gestion = true;
        
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        require_once 'views/pedido/mis_pedidos.php';
    }
    
    public function estado() {
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            
            //Recogemos los datos del formulario
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            
            
            //Update del pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->edit();
            
            header("Location:".base_url.'pedido/detalle&id='.$id);
        } else {
            header("Location:".base_url);
        }
    }
}
