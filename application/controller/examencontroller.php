<?php

class ExamenController extends Controller{

	public function loadModel(){
		Examen::$db = $this->db;
	}

	public function index(){
		error_reporting(0);
		session_start();
		include_once 'categoriacontroller.php';
		new CategoriaController();
		include_once 'preguntacontroller.php';
		new PreguntaController();
		$this->view->addData(['examenes'=>Examen::getAll()]);

		if (isset($_SESSION['user'])) {			
			if ($_SESSION['user']->isAdmin()) {
				echo $this->view->render('admin/examen/lista');
			}else{
				echo $this->view->render('examen/lista');
			}
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}			
	}

	public function categoria($categoria){
		session_start();
		include 'categoriacontroller.php';
		new CategoriaController();
		$examenes = Examen::getFromCategoria($categoria);
		$this->view->addData(['examenes'=> $examenes]);

		if (isset($_SESSION['user'])) {
			if ($_SESSION['user']->isAdmin()) {
				echo $this->view->render('admin/examen/lista');
			}else{
				echo $this->view->render('examen/lista');
			}
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}

		
	}

	public function detail($id){
		session_start();
		include_once 'categoriacontroller.php';
		new CategoriaController();
		include_once 'preguntacontroller.php';
		new PreguntaController();
		$this->view->addData(['examen'=>Examen::getById($id)]);
		if (isset($_SESSION['user'])) {
			if ($_SESSION['user']->isAdmin()) {
				echo $this->view->render('admin/examen/detalle');
			}else{
				echo $this->view->render('examen/detalle');
			}			
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}		
	}

	public function anadir(){
		session_start();
		if(!isset($_SESSION["errores"])){
			$_SESSION["errores"] = array();
		}

		if (isset($_SESSION['user']) && ($_SESSION['user']->isAdmin() || $_SESSION['user']->isProfesor())) {
			
			$americanDate = explode("/", $_POST['fecha']);
			$europeanDate = $americanDate[1]."/".$americanDate[0]."/".$americanDate[2];
			$fecha = strtotime($europeanDate);
			$categoria = $_POST['categoria'];
			$user_id = $_SESSION['user']->getId();

			if (strlen($_POST['fecha']) != 10) {
				array_push($_SESSION["errores"], "La fecha debe tener 10 caracteres");
			}

			if (empty($_SESSION['errores'])) {
				$examen = new Examen($fecha, $categoria, $user_id);
				$examen->insert();			
				$this->index();
			}else{
				$this->form();
			}

		}else{
			header('location: ' . URL);
		}
			
	}

	public function update(){
		session_start();
		if(!isset($_SESSION["errores"])){
			$_SESSION["errores"] = array();
		}

		if (isset($_SESSION['user'])) {
			$id = $_POST['id'];
			$americanDate = explode("/", $_POST['fecha']);
			$europeanDate = $americanDate[1]."/".$americanDate[0]."/".$americanDate[2];
			$fecha = strtotime($europeanDate);
			$categoria = $_POST['categoria'];
			$examen = Examen::getById($id);
			if ($_SESSION['user']->isAdmin() || $_SESSION['user']->getId() == 
				$examen->getUserId()) {	

				if (strlen($_POST['fecha']) != 10) {
					array_push($_SESSION["errores"], "La fecha debe tener 10 caracteres");
				}

				if (empty($_SESSION['errores'])) {
					$examen->setFecha($fecha);
					$examen->setCategoria($categoria);
					$examen->update();
					if ($_SESSION['user']->isAdmin()) {
						$this->index();
					}else{
						$this->editar($id);
					}
				}else{
					$this->editar($id);
				}

			}else{
				header('location: ' . URL);
			}		
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}		
		
	}

	public function editar($id){
		error_reporting(0);
		session_start();		
		include_once 'categoriacontroller.php';
		new CategoriaController();
		include_once 'preguntacontroller.php';
		new PreguntaController();
		$categorias = Categoria::getChildren();
		$examen = Examen::getById($id);		

		if (isset($_SESSION['user'])) {
			if ($examen != NULL && ($_SESSION['user']->getId() == $examen->getUserId() || 
					$_SESSION['user']->isAdmin())) {
				$this->view->addData(['examen' => $examen, 'categorias' => $categorias]);
				if ($_SESSION['user']->isAdmin()) {
					echo $this->view->render('admin/examen/editar');
				}else{
					echo $this->view->render('examen/editar');
				}
			}else{
				$this->index();
			}
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}		
	}

	public function search(){
		session_start();
		$query = $_POST['query'];

		$this->view->addData(['examenes'=>Examen::getByFilter($query)]);
		if (isset($_SESSION['user'])) {
			if ($_SESSION['user']->isAdmin()) {
				echo $this->view->render('admin/examen/lista');
			}else{
				echo $this->view->render('examen/lista');
			}
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}		
	}	

	public function borrar($id){
		session_start();
		if (isset($_SESSION['user'])) {
			$examen = Examen::getById($id);
			if ($_SESSION['user']->getId() == $examen->getUserId() || 
				$_SESSION['user']->isAdmin()) {
				$examen->delete();
			}else{
				header('location: ' . URL . 'examencontroller');
			}
			$this->index();
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}		
	}	

	public function form(){
		error_reporting(0);
		session_start();
		include_once 'categoriacontroller.php';
		new CategoriaController();
		$categorias = Categoria::getChildren();	
		$this->view->addData(['categorias'=> $categorias]);	
		if (isset($_SESSION['user'])) {
			if ($_SESSION['user']->isProfesor()) {
				echo $this->view->render('examen/crear');
			}elseif ($_SESSION['user']->isAdmin()) {
				echo $this->view->render('admin/examen/crear');
			}else{
				header('location: ' . URL);
			}			
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}
	}

}