<?php

class Producto {

    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    //Geters and Setters

    function getId() {
        return $this->id;
    }

    function getCategoria_id() {
        return $this->categoria_id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getStock() {
        return $this->stock;
    }

    function getOferta() {
        return $this->oferta;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setCategoria_id($categoria_id): void {
        $this->categoria_id = $categoria_id;
    }

    function setNombre($nombre): void {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setDescripcion($descripcion): void {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function setPrecio($precio): void {
        $this->precio = $this->db->real_escape_string($precio);
    }

    function setStock($stock): void {
        $this->stock = $this->db->real_escape_string($stock);
    }

    function setOferta($oferta): void {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    function setFecha($fecha): void {
        $this->fecha = $fecha;
    }

    function setImagen($imagen): void {
        $this->imagen = $imagen;
    }

    public function getAll() {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
        return $productos;
    }
    public function getAllCategory() {
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
                . "INNER JOIN categorias c ON c.id = p.categoria_id "
                . "WHERE p.categoria_id = {$this->getCategoria_id()} AND p.stock > 0 "                
                . "ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getRandom($limit) {
        $productos = $this->db->query("SELECT * FROM productos WHERE stock > 0 ORDER BY RAND() LIMIT $limit");
        return $productos;
    }
            
    public function getOne() {
        $producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
        // Retornamos un objeto para que sea completamente usable
        return $producto->fetch_object();
    }
    
    
    public function save() {
        $sql = "INSERT INTO productos VALUES(null, {$this->getCategoria_id()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, null, CURDATE(), '{$this->getImagen()}')";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function edit() {
        $sql = "UPDATE productos SET categoria_id='{$this->getCategoria_id()}', nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()} ";

        if ($this->getImagen() != null) {
            $sql .= ", imagen='{$this->getImagen()}'";
        }

        $sql .= " WHERE id={$this->getId()};";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function delete() {
        $sql = "DELETE FROM productos WHERE id ={$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

}
