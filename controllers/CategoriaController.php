<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController{
    
    public function index() {
        //comprobamos si el usuario es administrador
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        require_once 'views/categoria/index.php';
        
    }
    
    public function ver() {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            //Conseguir cateegoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();
            
            
            //Conseguir productos
            
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
            
        }
        
        require_once 'views/categoria/ver.php';
    }


    public function crear() {
        //comprobamos si el usuario es administrador
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }
    
    public function save() {
        //comprobamos si el usuario es administrador
        Utils::isAdmin();
        
        if(isset($_POST)){
            
            //Recoger los valores del formulario de registro
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            
            //Array de errores
            $errores_categoria = array();
            
            
            // Llenar un error al no incrustar datos en el nombre de la categoria
            if(empty($nombre)){
            $_SESSION['errores_general'] = "Por favor, llene el nombre de categoría.";
            }
            // VALIDAR EL NOMBRE DE LA CATEGORIA
            
            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                $nombre_validado = true;
            } else {
                $nombre_validado = false;
                
                $errores_categoria['nombre'] = "El nombre no es válido";
            }
            
            if (count($errores_categoria) == 0) {
                // Guardar la categoria en la bd
                $categoria = new Categoria();
                $categoria->setNombre($nombre);
                $save = $categoria->save();
                
                if ($save) {
                    $_SESSION['register'] = "El registro se ha completado con éxito";
                } else {
                    $_SESSION['register']['general'] = "Fallo al guardar la categoria";
                }
                
            }else {
                $_SESSION['errores'] = $errores_categoria;
            }
        }
        
        header("Location:".base_url."categoria/crear");
    }
    
}

