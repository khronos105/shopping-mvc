<?php
require_once 'models/order.php';

class orderController{
	
	public function billing(){
		require_once 'views/order/billing.php';
	}
	
	public function add(){

		if(isset($_SESSION['identity'])){
			$usuario_id = $_SESSION['identity']->id;
			$fname = isset($_POST['fname']) ? $_POST['fname'] : false;
			$lname = isset($_POST['lname']) ? $_POST['lname'] : false;
            $phone = isset($_POST['phone']) ? $_POST['phone'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $country = isset($_POST['country']) ? $_POST['country'] : false;
            $city = isset($_POST['city']) ? $_POST['city'] : false;
            $address = isset($_POST['address']) ? $_POST['address'] : false;
            $zip = isset($_POST['zip']) ? $_POST['zip'] : false;



			$stats = Utils::statsCarrito();
			$coste = $stats['total'];

			//var_dump($_POST); die();
				
			if($fname &&
                $lname &&
                $phone &&
                $email &&
                $country &&
                $city &&
                $address &&
                $zip ){
				// Guardar datos en bd
				$order = new Order();
                $order->setUserId($usuario_id);
                $order->setFirstName($fname);
                $order->setLastName($lname);
                $order->setPhone($phone);
                $order->setEmail($email);
                $order->setCountry($country);
                $order->setCity($city);
                $order->setAdress($address);
                $order->setZip($zip);
                $order->setCoste($coste);
                $order->setDate();

				$save = $order->save();
                //var_dump($save); die();
				
				// Guardar linea pedido
				$save_linea = $order->save_linea();
				
				if($save && $save_linea){
					$_SESSION['order'] = "complete";
                    header("Location:".BASE_URL.'order/confirmado');
                    exit();
				}else {
                    $_SESSION['order'] = "Failed to store order in DB";
                }
			}else{
				$_SESSION['billing'] = "Please complete your billing details";
                header("Location:".BASE_URL. "order/billing");
                exit();
			}
		}else{
			// Redigir al index
			header("Location:".BASE_URL);
		}
	}
	
	public function confirmado(){
		if(isset($_SESSION['identity'])){

			$identity = $_SESSION['identity'];

			$order = new Order();
			$order->setUserId($identity->id);

			// Extract Order and It's products from db
			$orderAndProducts = $order->getLastOrderByUser();

			//var_dump($orderAndProducts);die();

            $order = $orderAndProducts['order'];
            $products = $orderAndProducts['products'];

            // var_dump($order);die();
            if(isset($_SESSION['order'])){
                $orderComplete = $_SESSION['order'];
            }else{
                header("Location:".BASE_URL);
                exit();
            }

            //var_dump($order);
            //var_dump($products);die();

            // Removeing session variables, cleaning cart and order status completed
            Utils::deleteSession('carrito');
            Utils::deleteSession('pedido');
		}
		require_once 'views/order/confirmado.php';
	}
	
	public function my_orders(){
		Utils::isIdentity();
		$user_id = $_SESSION['identity']->id;
		$order = new Order();
		
		// Sacar los pedidos del usuario
        $order->setUserId($user_id);
        $orders = $order->getAllByUser();
		
		require_once 'views/order/my_orders.php';
	}

    public function all_orders(){
        Utils::isAdmin();
        $gestion = true;

        $order = new Order();
        $orders = $order->getAll();

        require_once 'views/order/my_orders.php';
    }

	public function detail(){
		Utils::isIdentity();
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			// Sacar el pedido
			$order = new Order();
            $order->setId($id);
            $orderData = $order->getOrderData();

			// Sacar los poductos
            $orderProducts = $order->getProdsByOrder();
			
			require_once 'views/order/detail.php';
		}else{
			header('Location:'.BASE_URL.'order/my_orders');
		}
	}
	
	public function status(){
		Utils::isAdmin();
		if(isset($_POST['order_id']) && isset($_POST['order_status'])){
			// Recoger datos form
			$order_id = $_POST['order_id'];
			$order_status = $_POST['order_status'];
			
			// Upadate del pedido
			$order = new Order();
			$order->setId($order_id);
			$order->setStatus($order_status);
			$order->update();
			
			header("Location:".BASE_URL.'order/detail&id='.$order_id);
		}else{
			header("Location:".BASE_URL);
		}
	}
	
	
}
