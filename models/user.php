<?php

class User
{
    private $id;
    private $fname;
    private $lname;
    private $password;
    private $email;
    private $phone;
    private $city;
    private $country;
    private $address;
    private $zip;
    private $role;
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

    function getEmail()
    {
        return $this->email;
    }

    function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function getRole()
    {
        return $this->role;
    }

    function getImage()
    {
        return $this->image;
    }

    function generateID()
    {
        $id = uniqid('user_', true);
        $this->setId($id);
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function getCountry()
    {
        return $this->country;
    }

    function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setFirstName($fname)
    {
        $this->fname = $this->db->real_escape_string($fname);
    }

    function setLastName($lname)
    {
        $this->lname = $this->db->real_escape_string($lname);
    }

    function setPhone($phone)
    {
        $this->phone = $this->db->real_escape_string($phone);
    }

    function setCountry($country)
    {
        $this->country = $this->db->real_escape_string($country);
    }

    function setCity($city)
    {
        $this->city = $this->db->real_escape_string($city);
    }

    function setAdress($address)
    {
        $this->address = $this->db->real_escape_string($address);
    }

    function setZip($zip)
    {
        $this->zip = $this->db->real_escape_string($zip);
    }

    function setRole($role)
    {
        $this->role = $role;
    }

    function setImage($image)
    {
        $this->image = $image;
    }

    function getImageTitle()
    {
        $image_title = $this->db->query("SELECT image FROM usuarios WHERE id = '" . $this->id . "'");
        return $image_title->fetch_object()->image;
    }

    private function getUserFromDB()
    {
        $sql = "SELECT * FROM usuarios WHERE id = '{$this->id}'";
        $user = $this->db->query($sql);
        if ($user && $user->num_rows == 1) {
            $user = $user->fetch_object();
            if ($user) {
                return $user;
            }
        }
        return false;
    }

    public function register()
    {
        $sql = "INSERT INTO usuarios VALUES('{$this->id}', '{$this->fname}', '{$this->lname}', '{$this->email}', '{$this->getPassword()}', 'user', null, null, null, null, null, null);";


        //var_dump($sql);die();

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function updateUserData()
    {
        $sql = "UPDATE usuarios SET  fname = '{$this->fname}', lname = '{$this->lname}', email = '{$this->email}', image = '{$this->image}' WHERE id = '" . $this->id . "';";
        $save = $this->db->query($sql);

        //var_dump($sql);die();

        $result = false;
        if ($save) {
            $result = $this->getUserFromDB();
        }
        return $result;
    }

    public function updateBilling()
    {
        $sql = "UPDATE usuarios SET  phone = " . $this->phone . ", country = '{$this->country}', city = '{$this->city}', address = '{$this->address}', zip = " . $this->zip . " WHERE id = '" . $this->id . "';";
        $save = $this->db->query($sql);

        //var_dump($sql);die();

        $result = false;
        if ($save) {
            $result = $this->getUserFromDB();
        }
        return $result;
    }

    public function login()
    {
        $result = false;
        $email = $this->email;
        $password = $this->password;

        // Comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();

            // Verificar la contraseña
            $verify = password_verify($password, $usuario->password);

            if ($verify) {
                $result = $usuario;
            }
        }

        return $result;
    }

    public function updatePassword($newPass)
    {
        $newPass = password_hash($this->db->real_escape_string($newPass), PASSWORD_BCRYPT, ['cost' => 4]);

        $sql = "SELECT password FROM usuarios WHERE id = " . $this->id . ";";
        $checkedPass = $this->db->query($sql);

        if ($checkedPass && $checkedPass->num_rows == 1) {
            $usuario = $checkedPass->fetch_object();
            $verify = password_verify($this->password, $usuario->password);

            if ($verify) {
                $sql = "UPDATE usuarios SET password ='" . $newPass . "' WHERE id = '" . $this->id . "';";
                $checkedPass = $this->db->query($sql);
                return $checkedPass;
                //var_dump($checkedPass);die();
            }
        }

        return false;
    }
}
