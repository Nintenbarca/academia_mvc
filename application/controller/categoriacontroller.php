<?php

class CategoriaController extends Controller{

	public function loadModel(){
		Categoria::$db = $this->db;
	}

	public function index(){
		error_reporting(0);
		session_start();
		$categorias = Categoria::getChildren();
		if (isset($_SESSION['user'])) {
			$this->view->addData(['categorias'=> $categorias]);
			if ($_SESSION['user']->isAdmin()) {
				echo $this->view->render('admin/categoria/lista');
			}else{
				header('location: ' . URL);
			}
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}
	}

	public function anadir(){		
		session_start();
		if (isset($_SESSION['user'])) {
			$nombre = $_POST['nombre'];
			$categoria_padre = $_POST['categoria'];
			if ($_SESSION['user']->isAdmin()) {
				$categoria = new Categoria($nombre, $categoria_padre);
				$categoria->insert();
				$this->index();
			}else{
				header('location: ' . URL);
			}		
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}
	}

	public function update(){
		session_start();
		if (isset($_SESSION['user'])) {
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
			$categoria_padre = $_POST['categoria'];
			$categoria = Categoria::get($id);
			if ($_SESSION['user']->isAdmin()) {	
				$categoria->setNombre($nombre);
				$categoria->setCategoriaPadre($categoria_padre);
				$categoria->update();
				$this->index();
			}else{
				header('location: ' . URL);
			}		
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}
	}

	public function editar($id){
		session_start();
		if (isset($_SESSION['user'])) {
			$categoria = Categoria::get($id);
			$categorias = Categoria::getParent();
			$this->view->addData(['categoria' => $categoria, 'categorias' => $categorias]);
			if ($_SESSION['user']->isAdmin()) {
				echo $this->view->render('admin/categoria/editar');
			}else{
				header('location: ' . URL);
			}
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}
	}

	public function borrar($id){
		session_start();
		if (isset($_SESSION['user'])) {
			$categoria = Categoria::get($id);
			if ($_SESSION['user']->isAdmin()) {
				$categoria->delete();
				$this->index();
			}else{
				header('location: ' . URL);
			}			
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}		
	}	

	public function form(){
		session_start();
		$categorias = Categoria::getParent();		
		if (isset($_SESSION['user'])) {			
			$this->view->addData(['categorias'=> $categorias]);
			if ($_SESSION['user']->isAdmin()) {
				echo $this->view->render('admin/categoria/crear');
			}else{
				header('location: ' . URL);
			}			
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}
	}
}