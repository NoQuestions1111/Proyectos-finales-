<?php

class conexion
{

    //variables para la conexion a la bd
    private $servidor = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $db_name = "proyecto_camila";
    public $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->servidor;dbname=$this->db_name", $this->usuario, $this->contrasena);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conexion establecida";
        } catch (PDOException $error) {
            echo "Error al establecer la conexion";
        }
    }
    //esta funcion nos permite hacer un insert,delete,update
    public function ejecutar($sql, $params)
    {
        // Preparar la consulta SQL
        $stmt = $this->conexion->prepare($sql);
        
        // Ejecutar la consulta con los parámetros
        $stmt->execute($params);
        
        // Obtener el último ID insertado (en caso de que lo necesites)
        return $this->conexion->lastInsertId();
    }
    
    //esta funcion nos permite consultar todos los datos
    public function consultar($sql){
        $sentecia = $this->conexion->prepare($sql);
        $sentecia->execute();
        return $sentecia->fetchAll();
    }
}
//solo para verificar si hay conexion accediendo al conexion.php
//new conexion();