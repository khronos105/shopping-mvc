<?php
require_once 'models/user.php';

class UserController{
	
	public function index(){
        global $msg;
        $identity = $_SESSION['identity'];

        if($identity->phone == null ||
            $identity->country == null ||
            $identity->city == null ||
            $identity->address == null ||
            $identity->zip == null ){
            $msg->warning('Please complete your billing data.');
        }

        require_once 'views/user/index.php';
	}

    public function register(){
        require_once 'views/user/register.php';
    }

    public function login(){
        require_once 'views/user/login.php';
    }

    public function reset_pass(){
        require_once 'views/user/reset_pass.php';
    }

    public function billing(){
        require_once 'views/user/billing.php';
    }
	
	public function registerAction(){
		if(isset($_POST)){

            $fname = isset($_POST['fname']) ? $_POST['fname'] : false;
            $lname = isset($_POST['lname']) ? $_POST['lname'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $password2 = isset($_POST['password2']) ? $_POST['password2'] : false;

			if($fname && $lname && $email && $password && ($password == $password2)){
				$user = new User();
                $user->generateID();
                $user->setFirstName($fname);
				$user->setLastName($lname);
				$user->setEmail($email);
				$user->setPassword($password);

				//var_dump($user);die();

				$save = $user->register();
				if($save){
					$_SESSION['register'] = "complete";
                    header("Location:".BASE_URL.'user/login');
                    exit();
				}else{
					$_SESSION['register'] = "failed";
				}
			}else{
				$_SESSION['register'] = "failed";
			}
		}else{
			$_SESSION['register'] = "failed";
		}
		header("Location:".BASE_URL.'user/register');
	}

    public function updateUserData(){
        global $msg;
        if(isset($_POST)){

            $fname = isset($_POST['fname']) ? $_POST['fname'] : false;
            $lname = isset($_POST['lname']) ? $_POST['lname'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $image = isset($_FILES['image']) ? $_FILES['image'] : false;

            //var_dump($_FILES['image']); die();

            if($fname || $lname || $email || $image){
                $user = new User();
                $user->setId($_SESSION['identity']->id);
                $user->setFirstName($fname);
                $user->setLastName($lname);
                $user->setEmail($email);

                $newfilename = $_SESSION['identity']->id. '.' . Utils::getFileExtension($image["name"]);

                if($image['type'] == 'image/jpeg' || $image['type'] == 'image/jpg' || $image['type'] == 'image/png'){
                    if(!is_dir('uploads/users')){
                        mkdir('uploads/users', 0777);
                    }





                    $newFileExtension = Utils::getFileExtension($image['name']);
                    $imageTitle = $user->getImageTitle();
                    /**
                     * In case that the image uploaded has different extension
                     * that the image from database has, first remove the old image
                     * and update the model with new title and store to db
                     */
                    if(($imageTitle!=null) && ($newFileExtension != Utils::getFileExtension($imageTitle))){
                        unlink('uploads/users/' . $imageTitle);
                    }
                    $imageTitle = Utils::generateImageTitle('user_' , $image['name']);
                    $user->setImage($imageTitle);
                    move_uploaded_file($image['tmp_name'], 'uploads/users/'.$imageTitle);
                }else{
                    $msg->error('El formato de la imagen es incorrecto');
                    header("Location:".BASE_URL."user/index");
                    exit();
                }

                $user = $user->updateUserData();

                if(is_object($user)){
                    $_SESSION['identity'] = $user;
                    $msg->success('Your data were updated succesfuly');
                }else{
                    $msg->error('Failed to update the database');
                }
            }else{
                $msg->error('Pleace enter your data correctly');
            }
        }else{
            $msg->error('Data not sent correctly');
        }
        header("Location:".BASE_URL."user/index");
        exit();
    }

    public function updateBilling(){
        global $msg;
        if(isset($_POST)){

            $phone = isset($_POST['phone']) ? $_POST['phone'] : false;
            $city = isset($_POST['city']) ? $_POST['city'] : false;
            $country = isset($_POST['country']) ? $_POST['country'] : false;
            $address = isset($_POST['address']) ? $_POST['address'] : false;
            $zip = isset($_POST['zip']) ? $_POST['zip'] : false;

            //var_dump($_POST); die();

            if( $phone &&
                $country &&
                $city &&
                $address &&
                $zip){
                $user = new User();
                $user->setId($_SESSION['identity']->id);
                $user->setPhone($phone);
                $user->setCountry($country);
                $user->setCity($city);
                $user->setAdress($address);
                $user->setZip($zip);

                $user = $user->updateBilling();

                if(is_object($user)){
                    $_SESSION['identity'] = $user;
                    $msg->success('Your billing were updated succesfuly');
                }else{
                    $msg->error('Failed to update the database');
                }
            }else{
                $msg->error('Pleace enter your data correctly');
            }
        }else{
            $msg->error('Data not sent correctly');
        }
        header("Location:".BASE_URL."user/billing");
    }

    public function resetPass(){
        global $msg;
        if(isset($_POST)){

            $oldPassword = isset($_POST['oldPassword']) ? $_POST['oldPassword'] : false;
            $newPassword = isset($_POST['newPassword']) ? $_POST['newPassword'] : false;
            $newPassword2 = isset($_POST['newPassword2']) ? $_POST['newPassword2'] : false;

            //var_dump($_POST); die();

            if( $oldPassword &&
                $newPassword &&
                $newPassword2 &&
                ($newPassword == $newPassword2)){
                $user = new User();
                $user->setId($_SESSION['identity']->id);
                $user->setPassword($oldPassword);

                // Verify password
                if($user->updatePassword($newPassword)){

                    $_SESSION['identity']->password = $newPassword;
                    $msg->success('Your password is updated succesfuly');

                }else{
                    $msg->error('Failed, you entered a wrong password');
                }
            }else{
                $msg->error('Pleace enter your passwords correctly');
            }
        }else{
            $msg->error('Data not sent correctly');
        }
        header("Location:".BASE_URL."user/reset_pass");
    }
	
	public function loginAction(){
		if(isset($_POST)){
			// Identificar al usuario
			// Consulta a la base de datos
			$user = new User();
			$user->setEmail($_POST['email']);
			$user->setPassword($_POST['password']);
			
			$identity = $user->login();
			
			if($identity && is_object($identity)){
				$_SESSION['identity'] = $identity;
				
				if($identity->role == 'admin'){
					$_SESSION['admin'] = true;
				}

                header("Location:".BASE_URL."user/index");
				exit();
				
			}else{
				$_SESSION['error_login'] = 'Authentication failed.';
			}
		
		}
		header("Location:".BASE_URL."user/login");
		exit();
	}
	
	public function logout(){
        $_SESSION = array();

        // Finalmente, destruir la sesión.
        session_destroy();
		
		header("Location:".BASE_URL);
	}
	
} // fin clase
