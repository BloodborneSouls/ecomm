<?php

namespace construInventory;

class Material{

    private $config;
    private $cn= null;

    public function __construct(){
        $this->config=parse_ini_file(__DIR__.'/../config.ini');

        $this->cn = new \PDO($this->config['dns'],$this->config['usuario'],
        $this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));

    }

    public function registrar($_params){
        $sql = "INSERT INTO `productos`(`nombre`, `descripcion`, `foto`, `precio`, `categoria_id`, `fecha`)
        VALUES (:nombre,:descripcion,:foto,:precio,:categoria_id,:fecha)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nombre" =>$_params['nombre'],
            ":descripcion" =>$_params[' descripcion'],
            ":foto" =>$_params['foto'],
            ":precio" =>$_params['precio'],
            ":categoria_id" =>$_params['categoria_id'],
            ":fecha" =>$_params['fecha']
        );

        if($resultado->execute($_array)){
            return true;
        }else{
            return false;
        }

    }

    public function actualizar($_params){
        $sql = "UPDATE `productos` SET `nombre`=:nombre,`descripcion`=:descripcion,`foto`=:foto,`precio`=:precio,
        `categoria_id`=:categoria_id,`fecha`=:fecha WHERE `id`=:id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nombre" =>$_params['nombre'],
            ":descripcion" =>$_params['descripcion'],
            ":foto" =>$_params['foto'],
            ":precio" =>$_params['precio'],
            ":categoria_id" =>$_params['categoria_id'],
            ":fecha" =>$_params['fecha'],
            ":id" => $_params['id']
        );  
        
        if($resultado->execute($_array)){
            return true;
        }else{
            return false;
        }
    }

    public function eliminar($id){
        $sql = "DELETE FROM `productos` WHERE `id`=:id";
        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":id" => $id
        );  
        
        if($resultado->execute($_array)){
            return true;
        }else{
            return false;
        }
    }

    public function mostrar(){
        $sql = "SELECT productos.id, nombre, descripcion,foto,cat,precio,fecha,estado FROM productos
        INNER JOIN categorias 
        on productos.categoria_id = categorias.id ORDER BY productos.id DESC
        ";
        $resultado = $this->cn->prepare($sql);
        
        if($resultado->execute()){
            return $resultado->fetchAll();
        }else{
            return false;
        }
    }

    public function mostrarPorId($id){
        $sql = "SELECT * FROM `productos` WHERE `id`=:id";
        $resultado = $this->cn->prepare($sql);
        
        $_array = array(
            ":id" => $id
        );  
        

        if($resultado->execute($_array)){
            return $resultado->fetch();
        }else{
            return false;
        }
    }

    public function mostrarElectronicos(){
        $sql="SELECT * FROM productos WHERE categoria_id=2";
        $resultado = $this->cn->prepare($sql);
        
        if($resultado->execute()){
            return $resultado->fetchAll();
        }else{
            return false;
        }
    }
    
    public function mostrarRopa(){
        $sql="SELECT * FROM productos WHERE categoria_id=1";
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute()){
            return $resultado->fetchAll();
        }else{
            return false;
        }
    }
    
    public function mostrarVideojuegos(){
        $sql="SELECT * FROM productos WHERE categoria_id=4";
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute()){
            return $resultado->fetchAll();
        }else{
            return false;
        }
    }

    public function mostrarDeportes(){
        $sql="SELECT * FROM productos WHERE categoria_id=5";
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute()){
            return $resultado->fetchAll();
        }else{
            return false;
        }
    }
    public function mostrarServicios(){
        $sql="SELECT * FROM productos WHERE categoria_id=3";
        $resultado = $this->cn->prepare($sql);

        if($resultado->execute()){
            return $resultado->fetchAll();
        }else{
            return false;
        }
    }
}