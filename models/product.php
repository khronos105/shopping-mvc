<?php

class Product
{
    private $id;
    private $category_id;
    private $title;
    private $description;
    private $price;
    private $stock;
    private $offer;
    private $date;
    private $image;

    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    function getId()
    {
        return $this->id;
    }

    function getCategory_id()
    {
        return $this->category_id;
    }

    function getTitle()
    {
        return $this->title;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getPrice()
    {
        return $this->price;
    }

    function getStock()
    {
        return $this->stock;
    }

    function getOffer()
    {
        return $this->offer;
    }

    function getDate()
    {
        return $this->date;
    }

    function getImage()
    {
        return $this->image;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setCategory_id($category_id)
    {
        $this->category_id = $category_id;
    }

    function setTitle($title)
    {
        $this->title = $this->db->real_escape_string($title);
    }

    function setDescription($description)
    {
        $this->description = $this->db->real_escape_string($description);
    }

    function setPrecio($price)
    {
        $this->price = $this->db->real_escape_string($price);
    }

    function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);
    }

    function setOffer($offer)
    {
        $this->offer = $this->db->real_escape_string($offer);
    }

    function setDate($date)
    {
        $this->date = $date;
    }

    function setImage($image)
    {
        $this->image = $image;
    }

    public function getImageTitle(){
        $image_title = $this->db->query("SELECT imagen FROM productos WHERE id = " . $this->id);
        return $image_title->fetch_object()->imagen;
    }

    public function getAll()
    {
        $products = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
        return $products;
    }

    public function getAllCategories()
    {
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
            . "INNER JOIN categorias c ON c.id = p.categoria_id "
            . "WHERE p.categoria_id = {$this->category_id} "
            . "ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getRandom($limit)
    {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
        return $productos;
    }

    public function getOne()
    {
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p"
        . " INNER JOIN categorias c ON c.id = p.categoria_id "
        . "WHERE c.id = p.categoria_id AND p.id = " . $this->id;
        $this->db->query($sql);
        $producto = $this->db->query($sql);
        return $producto->fetch_object();
    }

    public function save()
    {
        $sql = "INSERT INTO productos "
        ."VALUES(NULL, {$this->category_id}, "
        ."'{$this->title}', "
            ."'{$this->description}',"
            ."{$this->price}, "
            ."{$this->stock}, "
            ."null, "
            ."CURDATE(),"
            ."'{$this->image}');";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function edit()
    {
        $sql = "UPDATE productos SET "
            ."nombre='{$this->title}', "
            ."descripcion='{$this->description}', "
            ."precio={$this->price}, "
           ."stock={$this->stock}, "
            ."categoria_id = {$this->category_id}  ";

        if ($this->image != null) {
            $sql .= ", imagen='{$this->image}'";
        }

        $sql .= " WHERE id={$this->id};";


        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function delete()
    {
        $sql = "DELETE FROM productos WHERE id={$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

}
