<?php

class Utils {

    public static function deteleSession($name) {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function borrarErrores() {
        $borrado = false;

        if (isset($_SESSION['errores'])) {
            $_SESSION['errores'] = null;
            $borrado = true;
        }

        if (isset($_SESSION['errores_general'])) {
            $_SESSION['errores_general'] = null;
            $borrado = true;
        }

        if (isset($_SESSION['register'])) {
            $_SESSION['register'] = null;
            $borrado = true;
        }
        if (isset($_SESSION['error_login'])) {
            $_SESSION['error_login'] = null;
            $borrado = true;
            return $borrado;
        }
        if (isset($_SESSION['register'])) {
            $_SESSION['register'] = null;
            $borrado = true;
            return $borrado;
        }
        if (isset($_SESSION['producto'])) {
            $_SESSION['producto'] = null;
            $borrado = true;
            return $borrado;
        }
    }

    public static function mostrarErrores($errores, $campo) {
        $alerta = ' ';
        if (isset($errores[$campo]) && !empty($campo)) {
            $alerta = "<div class='alerta alerta-error'>" . $errores[$campo] . '</div>';
        }

        return $alerta;
    }

    public static function isAdmin() {
        if (!isset($_SESSION['admin'])) {
            header("Location:" . base_url);
        } else {
            return true;
        }
    }
    public static function isIdentity() {
        if (!isset($_SESSION['identity'])) {
            header("Location:" . base_url);
        } else {
            return true;
        }
    }

    public static function showCategorias() {

        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        return $categorias;
    }

    
    public static function statsCarrito() {
        $stats = array(
            'count' => 0,
            'total' => 0
        );
        
        if(isset($_SESSION['carrito'])){
            $stats['count'] = count($_SESSION['carrito']);
            
            foreach ($_SESSION['carrito'] as $producto) {
                $stats['total'] += $producto['precio']*$producto['unidades'];
            }
            
        }
        
        return $stats;
 }
 
 public static function showEstatus($status) {
     $value = 'Pendiente';
     if($status == 'confirm'){
         $value = 'Pendiente';
     } elseif($status == 'preparation') {
         $value = 'En preparación';
     }elseif($status == 'ready') {
         $value = 'Preparado para enviar';     
     }elseif($status == 'sended') {
          $value = 'enviado';
     }
     return $value;
 }
 
}
