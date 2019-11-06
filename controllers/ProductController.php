<?php
require_once 'models/product.php';

class productController{
	
	public function index(){
		$producto = new Product();
		$productos = $producto->getRandom(4);
	
		// renderizar vista
		require_once 'views/product/destacados.php';
	}
	
	public function view(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		
			$producto = new Product();
			$producto->setId($id);
			
			$product = $producto->getOne();
			
		}
		require_once 'views/product/view.php';
	}
	
	public function manage(){
		Utils::isAdmin();
		
		$product = new Product();
        $products = $product->getAll();

        //var_dump($products); die();
		
		require_once 'views/product/manage.php';
	}
	
	public function add(){
		Utils::isAdmin();
		require_once 'views/product/add.php';
	}
	
	public function save(){
		Utils::isAdmin();
		if(isset($_POST)){
			$title = isset($_POST['name']) ? $_POST['name'] : false;
			$description = isset($_POST['description']) ? $_POST['description'] : false;
			$price = isset($_POST['price']) ? $_POST['price'] : false;
			$stock = isset($_POST['stock']) ? $_POST['stock'] : false;
			$category = isset($_POST['category']) ? $_POST['category'] : false;
            $image = isset($_FILES['image']) ? $_FILES['image'] : false;
			
			if($title && $description && $price && $stock && $category){
				$producto = new Product();
				$producto->setTitle($title);
				$producto->setDescription($description);
				$producto->setPrecio($price);
				$producto->setStock($stock);
				$producto->setCategory_id($category);

                if(isset($_GET['id'])) {
                    $producto->setId($_GET['id']);
                }
				
				// Guardar la imagen
				if(isset($image)){
					$filename = $image['name'];
					$mimetype = $image['type'];

					if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){

						if(!is_dir('uploads/products')){
							mkdir('uploads/products', 0777, true);
						}

                        if(isset($_GET['id'])){
                            $newFileExtension = Utils::getFileExtension($image['name']);
                            $imageTitle = $producto->getImageTitle();
                            // In case that the image uploaded has different extension
                            /**
                             * In case that the image uploaded has different extension
                             * that the image from database has, first remove the old image
                             * and update the model with new title and store to db
                             */
                            if($newFileExtension != Utils::getFileExtension($imageTitle)){
                                unlink('uploads/products/' . $imageTitle);
                                $imageTitle = Utils::generateImageTitle('product_', $image['name']);
                                $producto->setImage($imageTitle);
                            }
                            move_uploaded_file($image['tmp_name'], 'uploads/products/'.$imageTitle);
                        }else{
                            $newfilename = Utils::generateImageTitle('product_', $image['name']);

                            move_uploaded_file($image['tmp_name'], 'uploads/products/'.$newfilename);

                            $producto->setImage($newfilename);
                        }
					}
				}
				
				if(isset($_GET['id'])){
					$save = $producto->edit();
				}else{
					$save = $producto->save();
				}
				
				if($save){
					$_SESSION['producto'] = "complete";
				}else{
					$_SESSION['producto'] = "failed";
				}
			}else{
				$_SESSION['producto'] = "failed";
			}
		}else{
			$_SESSION['producto'] = "failed";
		}
		header('Location:'.base_url.'product/manage');
	}
	
	public function edit(){
		Utils::isAdmin();
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$edit = true;
			
			$producto = new Product();
			$producto->setId($id);
			
			$pro = $producto->getOne();
			
			require_once 'views/product/add.php';
			
		}else{
			header('Location:'.base_url.'product/manage');
		}
	}
	
	public function delete(){
		Utils::isAdmin();
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$producto = new Product();
			$producto->setId($id);

			$image_title = $producto->getImageTitle();
			unlink('uploads/products/' . $image_title);
			
			$delete = $producto->delete();
			if($delete){
				$_SESSION['delete'] = 'complete';
			}else{
				$_SESSION['delete'] = 'failed';
			}
		}else{
			$_SESSION['delete'] = 'failed';
		}
		
		header('Location:'.base_url.'product/manage');
	}
	
}
