<?php

class AdminController extends Controller{

	public function index(){
        session_start();

        if (isset($_SESSION['user']) && $_SESSION['user']->isAdmin()) {
            echo $this->view->render('admin/dashboard');
        }else{
            header('location: ' . URL);
        }       
    }
}