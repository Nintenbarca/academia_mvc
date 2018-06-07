<?php

class Examen{

	private $id;
	private $fecha;
	private $categoria;
	private $user_id;

	public static $db;

	function __construct($fecha, $categoria, $user_id){
		$this->fecha = $fecha;
		$this->categoria = $categoria;	
		$this->user_id = $user_id;
	}

	public static function getAll(){ 
		$sql = "SELECT * FROM examenes"; 
        $query = Examen::$db->prepare($sql);
        $query->execute();

        $examenes = array();

        foreach ($query->fetchAll() as $row) {
        	$row  = (array)$row;
        	$nuevoexamen = new Examen($row['fecha'], $row['categoria'], $row['user_id']); 
        	$nuevoexamen->id = $row['id'];
        	array_push($examenes, $nuevoexamen);
        }
        return $examenes;
	}

	public static function getFromCategoria($categoria){ 
		$sql = "SELECT * FROM examenes WHERE categoria = :categoria"; 
        $query = Examen::$db->prepare($sql);
        $parameters = array(':categoria' => $categoria);
        $query->execute($parameters);

        $examenes = array();

        foreach ($query->fetchAll() as $row) {
        	$row  = (array)$row;
        	$nuevoExamen = new Examen($row['fecha'], $row['categoria'], $row['user_id']);
        	$nuevoExamen->id = $row['id'];
        	array_push($examenes, $nuevoExamen);
        }
        return $examenes;
	}

	public static function getById($id){
		$sql = "SELECT * FROM examenes WHERE id = :id";
        $query = Examen::$db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

 		if ($query->rowCount()>0) {
 			$row = (array)$query->fetch();

	        $nuevoExamen = new Examen($row['fecha'], $row['categoria'], $row['user_id']);
	        $nuevoExamen->id = $row['id'];
	        return $nuevoExamen;
 		}else{
 			return false;
 		}
	}

	public function insert(){		
        $sql = "INSERT INTO examenes (fecha, categoria, user_id) VALUES (:fecha, :categoria, :user_id)";
        $query = Examen::$db->prepare($sql);
        $parameters = array(':fecha' => $this->fecha, ':categoria' => $this->categoria, 
        	':user_id' => $this->user_id);
        $query->execute($parameters);        
	}

	public function update(){		
        $sql = "UPDATE examenes SET fecha = :fecha, categoria = :categoria WHERE id = :id";
        $query = Examen::$db->prepare($sql);
        $parameters = array(':fecha' => $this->fecha, ':categoria' => $this->categoria, 
        	':id' => $this->id);
        $query->execute($parameters);        
	}

	public function delete(){
		$sql = "DELETE FROM examenes WHERE id = :id";
        $query = Examen::$db->prepare($sql);
        $parameters = array(':id' => $this->id);
        $query->execute($parameters);        
	}

	public function matches($query){
		include_once APP . "controller/categoriacontroller.php";
		new CategoriaController();
		$query = strtolower($query);		
		$categoria = Categoria::get($this->getCategoria());
		$examen = $categoria->getNombreCompleto();
		$examen = strtolower($examen);
		if (strpos($examen, $query) !== false) {
			return true;
		}

		return false;
	}

	public static function getByFilter($query){
		$allExamenes = Examen::getAll();
		$examenes = array();
		foreach ($allExamenes as $examen) {
			if($examen->matches($query)){
				array_push($examenes, $examen);
			}
		}
		return $examenes;
	}

	public function getId(){
		return $this->id;
	}

	public function getFecha(){
		return date('d/m/Y', $this->fecha);
	}

	public function getCategoria(){
		return $this->categoria;
	}

	public function getUserId(){
		return $this->user_id;
	}

	public function getPreguntas(){
		return Pregunta::getFromExamen($this->id);
	}

	public function setFecha($fecha){
		$this->fecha = $fecha;
	}	
	public function setCategoria($categoria){
		$this->categoria = $categoria;
	}
}