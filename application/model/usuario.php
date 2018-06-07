<?php

class Usuario{

	private $id;
	private $nombre;
	private $apellidos;
	private $email;	
	private $pass;
	private $is_profesor;
	private $is_admin;

	public static $db;

	function __construct($nombre, $apellidos, $email, $pass, $is_profesor = false, 
		$is_admin = false){
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->email = $email;		
		$this->pass = $pass;	
		$this->is_profesor = $is_profesor;
		$this->is_admin = $is_admin;
	}

	public static function getAll(){ 
		$sql = "SELECT * FROM usuarios"; 
        $query = Usuario::$db->prepare($sql);
        $query->execute();

        $usuarios = array();

        foreach ($query->fetchAll() as $row) {
        	$row  = (array)$row;
        	$nuevoUsuario = new Usuario($row['nombre'], $row['apellidos'], 
        		$row['email'], $row['pass'], $row['is_profesor'], $row['is_admin']); 
        	$nuevoUsuario->id = $row['id'];
        	array_push($usuarios, $nuevoUsuario);
        }
        return $usuarios;
	}

	public static function getByEmail($email){
		$sql = "SELECT * FROM usuarios WHERE email = :email";
        $query = Usuario::$db->prepare($sql);
        $parameters = array(':email' => $email);
        $query->execute($parameters);

 		if ($query->rowCount()>0) {
 			$row = (array)$query->fetch();

	        $nuevoUsuario = new Usuario($row['nombre'], $row['apellidos'], 
	        	$row['email'], $row['pass'], $row['is_profesor'], $row['is_admin']);         
	        $nuevoUsuario->id = $row['id'];
	        return $nuevoUsuario;
 		}else{
 			return false;
 		}
	}

	public static function getById($id){
		$sql = "SELECT * FROM usuarios WHERE id = :id";
        $query = Usuario::$db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

 		if ($query->rowCount()>0) {
 			$row = (array)$query->fetch();

	        $nuevoUsuario = new Usuario($row['nombre'], $row['apellidos'], 
	        	$row['email'], $row['pass'], $row['is_profesor'], $row['is_admin']);         
	        $nuevoUsuario->id = $row['id'];
	        return $nuevoUsuario;
 		}else{
 			return false;
 		}
	}

	public function insert(){		
        $sql = "INSERT INTO usuarios (nombre, apellidos, email, pass) 
        	VALUES (:nombre, :apellidos, :email, :pass)";
        $query = Usuario::$db->prepare($sql);
        $parameters = array(':nombre' => $this->nombre, ':apellidos' => $this->apellidos, ':email' => $this->email, ':pass' => $this->pass);

        $query->execute($parameters);
        $this->id = Usuario::$db->lastInsertId();
	}

	public function getId(){
		return $this->id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getApellidos(){
		return $this->apellidos;
	}

	public function getEmail(){
		return $this->email;
	}

	public function isProfesor(){
		return $this->is_profesor;
	}

	public function isAdmin(){
		return $this->is_admin;
	}

	public function auth($pass){
		return ($this->pass == md5($pass));
	}
}