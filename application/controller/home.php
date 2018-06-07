<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {        
        echo $this->view->render('home/index');
    }
    /*
    public function navegar(){
        session_start();
    	include_once 'categoriacontroller.php';
		new CategoriaController();
		include_once 'postcontroller.php';
		new PostController();

        if (isset($_SESSION['user'])) {

           $this->view->addData(['categorias' => Categoria::getTree()]);
           echo $this->view->render('home/browse');
        }else{
            header('location: ' . URL . 'usuariocontroller/login');
        }        	
    }
    */
}
