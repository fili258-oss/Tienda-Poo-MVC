<?php

require_once 'models/usuario.php';

class usuarioController {

    public function index() {
        echo "Controlador Usuarios, Acción index.php";
    }

    public function registro() {
        require_once 'views/usuario/registro.php';
    }

    public function save() {
        
        if (isset($_POST)) {            
            //INICIAR SESIÓN
            //RECOGER LOS VALORES DEL FORMULARIO DE REGISTRO 
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
  
            //ARRAY DE ERRORES
            $errores = array();

            //VALIDAR LOS DATOS ANTES DE GUARDARLOS EN LA BASE DE DATOS
            //
            // VALIDAR LOS NOMBRES
            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                $nombres_validados = true;
            } else {
                $nombres_validados = false;
                $errores['nombre'] = "El nombre no es válido";
            }

            // VALIDAR LOS APELLIDOS
            if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
                $apellidos_validados = true;
            } else {
                $apellidos_validados = false;
                $errores['apellidos'] = "Los apellidos no son correctos";
            }

            // VALIDAR EL EMAIL
            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_validado = true;
            } else {
                $email_validado = false;
                $errores['email'] = "El email no es valido";
            }

            // VALIDAR LA CONTRASEÑA
            if (!empty($password)) {
                $password_validado = true;
            } else {
                $password_validado = false;
                $errores['password'] = "La contraseña está vacía";
            }
                
//            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
//            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
//            $email = isset($_POST['email']) ? $_POST['email'] : false;
//            $password = isset($_POST['password']) ? $_POST['password'] : false;
            if (count($errores) == 0) {
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                
                $save = $usuario->save();

                if ($save) {
                    $_SESSION['register'] = "El registro se ha completado con éxito";
                } else {
                    $_SESSION['register']['general'] = "Fallo al guardar el usuario!";
                }
            } else {
                $_SESSION['errores'] = $errores;
            }
        } else {
            $_SESSION['errores_general'] = "Por favor, llene todos los campos.";
        }
        header("Location:" . base_url . 'usuario/registro');
    }
    
    public function login() {
        if(isset($_POST)){
            /*identificar al usuario*/
            //Consulta a la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            
            
            $identity = $usuario->login();
            
            if($identity && is_object($identity)){
                
                $_SESSION['identity'] = $identity;
                
                if($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = "Identificación fallida!!";
            }
                                    
        }
        header("Location:".base_url);
    }
    
    public function logout() {
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        
        header("Location:".base_url);
    }
}// Fin de la clase