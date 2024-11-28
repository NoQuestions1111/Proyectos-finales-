<?php

class conexion
{

    //variables para la conexion a la bd
    private $servidor = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $db_name = "contactos_camila";
    public $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->servidor;dbname=$this->db_name", $this->usuario, $this->contrasena);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $error) {
            echo "Error al establecer la conexion";
        }
    }

    public function ejecutar($sql)
    { //insertar/delete/actualizar
        $this->conexion->exec($sql); //ejecutra una instruccion sql
        return $this->conexion->lastInsertId(); //nos regresa o retorna un id insertado
    }
    
    public function consultar($sql){
        $sentecia = $this->conexion->prepare($sql);
        $sentecia->execute();
        return $sentecia->fetchAll();
    }
}

//new conexion();