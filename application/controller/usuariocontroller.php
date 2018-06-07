<?php

class UsuarioController extends Controller{

	public function loadModel(){
		Usuario::$db = $this->db;
	}	

	public function trySignUp(){
		session_start();
		if(!isset($_SESSION["errores"])){
			$_SESSION["errores"] = array();
		}

		if (! $_POST) {
			$this->signUp();
		}else{
			$nombre = $_POST['nombre'];
			$apellidos = $_POST['apellidos'];
			$email = $_POST['email'];			
			$pass = md5($_POST['pass']);
			$pass2 = md5($_POST['pass2']);
			$usuario = Usuario::getByEmail($email);

			if (strlen($nombre) < 3) {
				array_push($_SESSION["errores"], "El nombre debe tener al menos 3 caracteres");		
			}

			if (strlen($apellidos) < 5) {
				array_push($_SESSION["errores"], "Los apellidos deben tener al menos 5 caracteres");		
			}

			if (strlen($email) < 5) {
				array_push($_SESSION["errores"], "El email debe tener al menos 5 caracteres");		
			}			

			if (strlen($pass) < 5) {
				array_push($_SESSION["errores"], "La contraseña deben tener al menos 5 caracteres");		
			}
	
			if ($pass != $pass2) {
				array_push($_SESSION["errores"], "Las contraseñas necesitan ser iguales");		
			}

			if ($usuario != false) {
				array_push($_SESSION["errores"], "Ya existe un usuario con este email");
			}

			if (empty($_SESSION["errores"])) {
				$usuario = new Usuario($nombre, $apellidos, $email, $pass);
				$usuario->insert();
				$this->tryLogin();
			}else{
				$this->signUp();
			}
		}		
	}

	public function tryLogin(){
		session_start();
		if(!isset($_SESSION["errores"])){
			$_SESSION["errores"] = array();
		}

		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$usuario = Usuario::getByEmail($email);		

		if($usuario != false){
			if ($usuario->auth($pass)) {
				session_start();
				$_SESSION['user'] = $usuario;

				if ($_SESSION['user']->isAdmin()) {
					header('location: ' . URL . 'admincontroller');
				}else{
					header('location: ' . URL );
				}
				
			}else{
				array_push($_SESSION["errores"], "Email/contraseña incorrectos");
				$this->login();
			}
		}else{
			array_push($_SESSION["errores"], "Email/contraseña incorrectos");
			$this->login();
		}
	}

	public function logout(){
		session_start();
		session_destroy();
		$this->login();
	}

	public function login(){
		echo $this->view->render('usuarios/login');			
	}
	
	public function signUp(){
		echo $this->view->render('usuarios/registrar');		
	}
}