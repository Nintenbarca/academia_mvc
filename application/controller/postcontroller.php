<?php

class PostController extends Controller{

	public function loadModel(){
		Post::$db = $this->db;
	}

	public function index()	{
		error_reporting(0);
		session_start();
		include_once 'categoriacontroller.php';
		new CategoriaController();
		include_once 'usuariocontroller.php';
		new UsuarioController();		
		$this->view->addData(['posts'=>Post::getAll(), 'categorias'=> Categoria::getAll()]);
		if (isset($_SESSION['user']) && $_SESSION['user']->isAdmin()) {
			echo $this->view->render('admin/post/lista');
		}else{
			echo $this->view->render('post/lista');
		}        
	}
	public function categoria($categoriaId)	{
		session_start();
		include_once 'categoriacontroller.php';
		new CategoriaController();
		include_once 'usuariocontroller.php';
		new UsuarioController();
		$this->view->addData(['posts'=>Post::getByCategoria($categoriaId), 
			'categorias'=> Categoria::getAll()]);
        if (isset($_SESSION['user']) && $_SESSION['user']->isAdmin()) {
			echo $this->view->render('admin/post/lista');
		}else{
			echo $this->view->render('post/lista');
		} 
	}

	public function detail($id){		
		session_start();
		include_once 'categoriacontroller.php';
		new CategoriaController();
		include_once 'usuariocontroller.php';
		new UsuarioController();
		$this->view->addData(['post'=>Post::get($id)]);
		if (isset($_SESSION['user']) && $_SESSION['user']->isAdmin()) {
			echo $this->view->render('admin/post/detalle');
		}else{
			echo $this->view->render('post/detalle');
		}	
	}

	public function anadir(){
		session_start();
		if(!isset($_SESSION["errores"])){
			$_SESSION["errores"] = array();
		}

		if (isset($_SESSION['user'])) {

			$titulo = $_POST['titulo'];
			$resumen = $_POST['resumen'];
			$contenido = $_POST['contenido'];
			$user_id = $_SESSION['user']->getId();
			$categoria = $_POST['categoria'];				

			if (strlen($titulo) < 3) {
				array_push($_SESSION["errores"], "El titulo debe tener al menos 3 
					caracteres");
			}elseif (strlen($titulo) > 20) {
				array_push($_SESSION["errores"], "El titulo no puede tener mas de 20 
					caracteres");
			}

			if (strlen($resumen) > 50) {
				array_push($_SESSION["errores"], "El resumen no puede tener mas de 50 
					caracteres");
			}

			if (strlen($contenido) > 200) {
				array_push($_SESSION["errores"], "El contenido no puede tener mas de 200 caracteres");
			}

			if (empty($_SESSION["errores"])) {
				$post = new Post($titulo, $resumen, $contenido, $user_id, $categoria);
				$post->insert();			
				header('location: ' . URL . 'postcontroller');								
			}else{			
				$this->form();					
			}

		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}		
	}

	public function tryEditar(){
		session_start();
		if(!isset($_SESSION["errores"])){
			$_SESSION["errores"] = array();
		}	

		if (isset($_SESSION['user'])) {

			$id = $_POST['id'];
			$titulo = $_POST['titulo'];
			$resumen = $_POST['resumen'];
			$contenido = $_POST['contenido'];		
			$categoria = $_POST['categoria'];
			$post = Post::get($id);				

			if (strlen($titulo) < 3) {
				array_push($_SESSION["errores"], "El titulo debe tener al menos 3 
					caracteres");
			}elseif (strlen($titulo) > 20) {
				array_push($_SESSION["errores"], "El titulo no puede tener mas de 20 
					caracteres");
			}

			if (strlen($resumen) > 50) {
				array_push($_SESSION["errores"], "El resumen no puede tener mas de 50 
					caracteres");
			}

			if (strlen($contenido) > 200) {
				array_push($_SESSION["errores"], "El contenido no puede tener mas de 200 caracteres");
			}		

			if ($_SESSION['user']->getId() == $post->getUserId() || $_SESSION['user']->isAdmin()) {
				if (empty($_SESSION['errores'])) {
					$post->setTitulo($titulo);
					$post->setResumen($resumen);
					$post->setContenido($contenido);
					$post->setCategoria($categoria);
					$post->update();
					if ($_SESSION['user']->isAdmin()) {
						$this->index();
					}else{
						$this->detail($id);
					}					
				}else{
					$this->editar($id);
				}			
			}else{
				header('location: ' . URL . 'postcontroller');
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
		$categorias = Categoria::getChildren();
		$post = Post::get($id);

		if ($post != NULL && isset($_SESSION['user']) && ($_SESSION['user']->getId() == 
			$post->getUserId() || $_SESSION['user']->isAdmin())){
			$this->view->addData(['post' => $post, 'categorias' => $categorias]);
			if ($_SESSION['user']->isAdmin()) {
				echo $this->view->render('admin/post/editar');
			}else{
				echo $this->view->render('post/editar');
			}			
		}else{
			$this->index();
		}				
	}	

	public function search(){
		session_start();
		$query = $_POST['query'];

		$this->view->addData(['posts'=>Post::getByFilter($query)]);
		if (isset($_SESSION['user'])) {
			if ($_SESSION['user']->isAdmin()) {
				echo $this->view->render('admin/post/lista');
			}else{
				echo $this->view->render('post/lista');
			}
		}else{
			echo $this->view->render('post/lista');
		}		
	}	

	public function borrar($id){
		session_start();
		if (isset($_SESSION['user'])) {
			$post = Post::get($id);
			if ($_SESSION['user']->getId() == $post->getUserId() || $_SESSION['user']->isAdmin()) {
				$post->delete();
			}
			$this->index();
		}else{
			header('location: ' . URL . 'usuariocontroller/login');
		}		
	}	

	public function form(){
		include_once 'categoriacontroller.php';
		new CategoriaController();
		$categorias = Categoria::getChildren();
		session_start();
		if (isset($_SESSION['user'])) {
			$this->view->addData(['categorias'=> $categorias]);
				if ($_SESSION['user']->isAdmin()) {
					echo $this->view->render('admin/post/crear');
				}else{
					echo $this->view->render('post/crear');
				}			
		}else{
			$this->index();
		}		
	}
}