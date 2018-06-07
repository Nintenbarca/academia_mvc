<?php

class PreguntaController extends Controller{

	public function loadModel(){
		Pregunta::$db = $this->db;
	}

	public function anadir(){
		session_start();
		if(!isset($_SESSION["errores"])){
			$_SESSION["errores"] = array();
		}

		if (isset($_SESSION['user'])) {
			if ($_SESSION['user']->isAdmin() || $_SESSION['user']->getId() == 
				$examen->getUserId()) {

				$enunciado = $_POST['enunciado'];
				$solucion = $_POST['solucion'];					
				$examen_id = $_POST['examen_id'];
				
				$pregunta = new Pregunta($enunciado, $solucion, $examen_id);
				$pregunta->insert();
				
				header('location: ' . URL . 'examencontroller/editar/'.$examen_id);
			}else{
				header('location: ' . URL . 'examencontroller');
			}
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}		
	}

	public function update(){
		session_start();
		include_once 'examencontroller.php';
		new ExamenController();
		$id = $_POST['id'];		
		$enunciado = $_POST['enunciado'];
		$solucion = $_POST['solucion'];		
		$pregunta = Pregunta::getById($id);
		$examen = Examen::getById($pregunta->getExamenId());

		if (isset($_SESSION['user'])) {
			if ($_SESSION['user']->getId() == $examen->getUserId() || 
				$_SESSION['user']->isAdmin()) {
			$pregunta->setEnunciado($enunciado);
			$pregunta->setSolucion($solucion);			
			$pregunta->update();
			header('location: ' . URL . 'examencontroller/editar/'.$pregunta->getExamenId());
			}else{
				header('location: ' . URL . 'examencontroller');
			}
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}		
	}

	public function borrar($id){
		session_start();
		if (isset($_SESSION['user'])) {
			$pregunta = Pregunta::getById($id);
			if ($_SESSION['user']->getId() == $pregunta->getExamenId() || 
				$_SESSION['user']->isAdmin()) {
				$pregunta->delete();
				header('location: ' . URL . 'examencontroller/editar/'.$pregunta->getExamenId());
			}else{
				header('location: ' . URL . 'examencontroller');
			}			
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}		
	}	
}