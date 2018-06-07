<?php

class Pregunta{

	private $id;
	private $enunciado;
	private $solucion;	
	private $examen_id;

	public static $db;

	function __construct($enunciado, $solucion, $examen_id){
		$this->enunciado = $enunciado;
		$this->solucion = $solucion;		 		
		$this->examen_id = $examen_id;
	}

	public static function getFromExamen($examen_id){ 
		$sql = "SELECT * FROM preguntas WHERE examen_id = :examen_id"; 
        $query = Pregunta::$db->prepare($sql);
        $parameters = array(':examen_id' => $examen_id);
        $query->execute($parameters);

        $preguntas = array();

        foreach ($query->fetchAll() as $row) {
        	$row  = (array)$row;
        	$nuevaPregunta = new Pregunta($row['enunciado'], $row['solucion'], $row['examen_id']);
        	$nuevaPregunta->id = $row['id'];
        	array_push($preguntas, $nuevaPregunta);
        }
        return $preguntas;
	}

	public static function getById($id){
		$sql = "SELECT * FROM preguntas WHERE id = :id";
        $query = Pregunta::$db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

 		if ($query->rowCount()>0) {
 			$row = (array)$query->fetch();

	        $nuevaPregunta = new Pregunta($row['enunciado'], $row['solucion'], $row['examen_id']);
	        $nuevaPregunta->id = $row['id'];
	        return $nuevaPregunta;
 		}else{
 			return false;
 		}
	}

	public function insert(){		
        $sql = "INSERT INTO preguntas (enunciado, solucion, examen_id) VALUES (:enunciado, :solucion, :examen_id)";
        $query = Pregunta::$db->prepare($sql);
        $parameters = array(':enunciado' => $this->enunciado, ':solucion' => $this->solucion, 
        	':examen_id' => $this->examen_id);
        $query->execute($parameters);        
	}

	public function update(){		
        $sql = "UPDATE preguntas SET enunciado = :enunciado, solucion = :solucion, 
        	examen_id = :examen_id WHERE id = :id";
        $query = Pregunta::$db->prepare($sql);
        $parameters = array(':enunciado' => $this->enunciado, ':solucion' => $this->solucion, 
        	':examen_id' => $this->examen_id, ':id' => $this->id);

        $query->execute($parameters);        
	}

	public function delete(){
		$sql = "DELETE FROM preguntas WHERE id = :id";
        $query = Pregunta::$db->prepare($sql);
        $parameters = array(':id' => $this->id);
        $query->execute($parameters);        
	}

	public function getId(){
		return $this->id;
	}

	public function getEnunciado(){
		return $this->enunciado;
	}

	public function getSolucion(){
		return $this->solucion;
	}	

	public function getExamenId(){
		return $this->examen_id;
	}

	public function setEnunciado($enunciado){
		$this->enunciado = $enunciado;
	}

	public function setSolucion($solucion){
		$this->solucion = $solucion;
	}
	
}