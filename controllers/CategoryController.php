<?php
require_once 'models/category.php';
require_once 'models/product.php';

class categoryController{
	
	public function index(){
		Utils::isAdmin();
		$categoria = new Category();
		$categorias = $categoria->getAll();
		
		require_once 'views/category/index.php';
	}
	
	public function view(){

	    // echo "qwe"; die();
	    if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			// Conseguir categoria
			$categoria = new Category();
			$categoria->setId($id);
			$categoria = $categoria->getOne();
			
			// Conseguir productos;
			$producto = new Product();
			$producto->setCategory_id($id);
			$productos = $producto->getAllCategories();
		}
		
		require_once 'views/category/view.php';
	}
	
	public function create(){
		Utils::isAdmin();
		require_once 'views/category/create.php';
	}

    public function add(){
        Utils::isAdmin();
        if(isset($_POST) && isset($_POST['title'])){
            // Guardar la categoria en bd
            $categoria = new Category();
            $categoria->setTitle($_POST['title']);
            $save = $categoria->save();
        }
        header("Location:".BASE_URL."category/index");
    }

    public function delete(){
        Utils::isAdmin();
        global $msg;
        if(isset($_POST) && isset($_POST['cat_id'])){
            $cat_id = $_POST['cat_id'];
            // Guardar la categoria en bd
            $categoria = new Category();
            $categoria->setId($cat_id);
            $delete = $categoria->delete();
            if($delete){
                $msg->warning('The category with ID ' . $cat_id . ' and all the products that contains was deleted');
            }
        }
        header("Location:".BASE_URL."category/index");
    }
	
}
