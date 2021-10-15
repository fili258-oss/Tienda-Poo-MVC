<?php

class Pedido {

    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    //Geters and Setters

    function getId() {
        return $this->id;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCoste() {
        return $this->coste;
    }

    function getEstado() {
        return $this->estado;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setUsuario_id($usuario_id): void {
        $this->usuario_id = $usuario_id;
    }

    function setProvincia($provincia): void {
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    function setLocalidad($localidad): void {
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    function setDireccion($direccion): void {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setCoste($coste): void {
        $this->coste = $coste;
    }

    function setEstado($estado): void {
        $this->estado = $estado;
    }

    function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    function setHora($hora): void {
        $this->hora = $hora;
    }

    
    public function getAll() {
        $productos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
        return $productos;
    }
         
    public function getOne() {
        $producto = $this->db->query("SELECT us.nombre, us.apellidos, us.email, ped.provincia, ped.localidad, ped.direccion, ped.estado, ped.id, ped.coste FROM pedidos ped "
                . " INNER JOIN usuarios us ON us.id = ped.usuario_id "
                . " WHERE ped.id ={$this->getId()}"); 

       // Retornamos un objeto para que sea completamente usable
        return $producto->fetch_object();
    }
    public function getOneByUser() {
        $sql = "SELECT p.id, p.coste FROM pedidos p "
                //. "INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
                . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";
        $pedido = $this->db->query($sql);
        // Retornamos un objeto para que sea completamente usable
        return $pedido->fetch_object();
    }
    public function getAllByUser() {
        $sql = "SELECT p.* FROM pedidos p "
                . "WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
        $pedido = $this->db->query($sql);
        
        // Retornamos un objeto para que sea completamente usable
        
        return $pedido;
    }
    
    public function getProductsByPedido($id) {
        
//        $sql = "SELECT * FROM productos WHERE id IN "
//                . "(SELECT producto_id FROM lineas_pedidos WHERE pedido_id={$id})";
                                
        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
                . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
                . "WHERE lp.pedido_id={$id}";
        $productos = $this->db->query($sql);
        // Retornamos un array
        return $productos;
    }


    public function save() {
        $sql = "INSERT INTO pedidos VALUES(null, {$this->getUsuario_id()}, '{$this->getProvincia()}', '{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    
    public function saveLinea() {
        
        // LAST_INSERT_ID() SACARIA LA CLAVE PRIMARIA DEL ÚLTIMO INSERT QUE SE HAYA REALIZADO
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        
        foreach ($_SESSION['carrito'] as $elemento){ 
        $producto = $elemento['producto'];
        
        $insert = "INSERT INTO lineas_pedidos VALUES(null, {$pedido_id}, {$producto->id}, {$elemento['unidades']})";
        $save = $this->db->query($insert);
        
//        var_dump($producto);
//        var_dump($insert);
//        echo $this->db->error;
//        die();
        
        }
    
        
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    
    public function edit() {
        $sql = "UPDATE pedidos SET estado='{$this->getEstado()}'";
        $sql .= " WHERE id={$this->getId()};";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
    
    public function decrementStock($id,$stock) {
        $sql = "UPDATE productos SET stock = {$stock} WHERE id = {$id}";
        $stock = $this->db->query($sql);
        
        return $stock;
    }
}// Fin de la clase :)

