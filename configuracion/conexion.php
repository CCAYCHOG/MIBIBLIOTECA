<?php
class Conexion{
    private static function conectar($dbName, $user, $password, $server){
        try{
            $dsn = "mysql:host=$server;dbname=$dbName;charset=utf8mb4";
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(PDOException $e){
            echo '<div class="alert alert-danger alert-dismissable">';
            echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>';
            echo "Error: No se pudo conectar con la base de datos <strong>$dbName</strong><br>";
            echo "Detalle: " . $e->getMessage();
            echo '</div>';
            return null;
        }
    }

    public static function Biblioteca(){//Cambiar las credenciales según corresponda
        return self::conectar("basededatos", "usuario", "clave", "servidor");
    }
}