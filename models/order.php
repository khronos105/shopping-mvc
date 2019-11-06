<?php

class Order{
	private $id;
	private $user_id;
    private $fname;
    private $lname;
    private $phone;
    private $email;
    private $city;
    private $country;
    private $address;
    private $zip;
	private $coste;
	private $date;
	private $status;

	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getId() {
		return $this->id;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setUserId($user_id) {
		$this->user_id = $user_id;
	}

    function setFirstName($fname) {
        $this->fname = $this->db->real_escape_string($fname);
    }

    function setLastName($lname) {
        $this->lname = $this->db->real_escape_string($lname);
    }

    function setPhone($phone) {
        $this->phone = $this->db->real_escape_string($phone);
    }

    function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

    function setCountry($country) {
        $this->country = $this->db->real_escape_string($country);
    }

    function setCity($city) {
        $this->city = $this->db->real_escape_string($city);
    }

    function setAdress($address) {
        $this->address = $this->db->real_escape_string($address);
    }

    function setZip($zip) {
        $this->zip = $this->db->real_escape_string($zip);
    }

    function setCoste($coste) {
        $this->coste = $coste;
    }

    function setDate() {
        $this->date = date('H:i:s d-m-Y');
    }

    function setStatus($status) {
        $this->status = $status;
    }

	public function getAll(){
		$productos = $this->db->query("SELECT id, cost, status, DATE_FORMAT( date, \"%d-%m-%Y\") AS date, time FROM pedidos ORDER BY id DESC");
		return $productos;
	}
	
	public function getOrderData(){
		$order = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->id}");
		return $order->fetch_object();
	}
	
	public function getLastOrderByUser(){
	    $response = [];

		$sql = "SELECT * FROM pedidos WHERE user_id = '{$this->user_id}' ORDER BY id DESC LIMIT 1";
			
		$order = $this->db->query($sql);

        //var_dump($order);die();

        $response['order'] = $order->fetch_object();
        $this->setId($response['order']->id);

        $response['products'] = $this->getProdsByOrder();

		return $response;
	}
	
	public function getAllByUser(){
		$sql = "SELECT id, cost, status, DATE_FORMAT( date, \"%d-%m-%Y\") AS date, time FROM pedidos WHERE user_id = '{$this->user_id}' ORDER BY id DESC";

		//var_dump($sql);die();
			
		$pedido = $this->db->query($sql);
			
		return $pedido;
	}
	
	
	public function getProdsByOrder($id = null){

	    if(!$id){
	        $id = $this->id;
        }
	
		$sql = "SELECT pr.*, lp.unidades FROM productos pr  INNER JOIN lineas_pedidos lp ON pr.id = lp.product_id WHERE lp.order_id={$id}";

        //var_dump($sql);die();
				
		$productos = $this->db->query($sql);

        //var_dump($productos);die();

        //$productos = $productos->fetch_object();
			
		return $productos;
	}
	
	public function save(){
		$sql = "INSERT INTO pedidos VALUES(NULL, '{$this->user_id}', '{$this->fname}', '{$this->lname}', '{$this->email}', {$this->phone}, '{$this->country}', '{$this->city}', '{$this->address}', {$this->zip}, {$this->coste}, 'pending', CURDATE(), CURTIME());";
		$save = $this->db->query($sql);

		//var_dump($sql); die();
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function save_linea(){
		$sql = "SELECT LAST_INSERT_ID() as 'order';";
		$query = $this->db->query($sql);
		$pedido_id = $query->fetch_object()->order;

		//var_dump($sql); die();

		foreach($_SESSION['carrito'] as $item){
			$producto = $item['producto'];
			
			$insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id}, {$item['unidades']})";
			$save = $this->db->query($insert);
           //var_dump($this->db->error); die();
//			var_dump($producto);
//			var_dump($insert);
//			echo $this->db->error;
//			die();
		}
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function update(){
		$sql = "UPDATE pedidos SET status='{$this->status}' WHERE id={$this->id};";
		
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
}
