<?php

class Utils
{

    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }

    public static function isAdmin()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location:" . BASE_URL);
        } else {
            return true;
        }
    }

    public static function isIdentity()
    {
        if (!isset($_SESSION['identity'])) {
            header("Location:" . BASE_URL);
        } else {
            return true;
        }
    }

    public static function showCategorias()
    {
        require_once 'models/category.php';
        $categoria = new Category();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    public static function getCategoryById($id)
    {
        require_once 'models/category.php';
        $categoria = new Category();
        $categoria->setId($id);
        $categoria = $categoria->getOne();
        return $categoria;
    }

    public static function statsCarrito()
    {
        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if (isset($_SESSION['carrito'])) {
            $stats['count'] = 0;

            foreach ($_SESSION['carrito'] as $product) {
                $stats['count'] += $product['unidades'];
            }

            foreach ($_SESSION['carrito'] as $producto) {
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }
        }

        return $stats;
    }

    public static function showStatus($status)
    {
        $value = 'Pending';

        if ($status == 'pending') {
            $value = 'Pending';
        } elseif ($status == 'preparing') {
            $value = 'Preparing';
        } elseif ($status == 'ready') {
            $value = 'Ready to send';
        } elseif ($status = 'sent') {
            $value = 'Sent';
        }

        return $value;
    }

    public static function getFileExtension($fileName) {
        $tmp = explode(".", $fileName);
        return end($tmp);
    }

    public static function generateImageTitle($prefix, $imageName){
        $temp = explode(".", $imageName);
        $image_id = uniqid($prefix, true);
        return $image_id. '.' .end($temp);
    }

}
