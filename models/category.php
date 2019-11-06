<?php

class Category{
	private $id;
	private $title;
	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getId() {
		return $this->id;
	}

	function getTitle() {
		return $this->title;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setTitle($title) {
		$this->title = $this->db->real_escape_string($title);
	}

	public function getAll(){
		$categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
		return $categorias;
	}
	
	public function getOne(){
		$categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->id}");
		return $categoria->fetch_object();
	}

    public function save(){
        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->title}');";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM categorias WHERE id = {$this->id};";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }
	
	
}