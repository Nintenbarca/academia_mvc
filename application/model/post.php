<?php

class Post{

	private $id;
	private $titulo;
	private $resumen;
	private $contenido;
	private $user_id;
	private $categoria_id;

	public static $db;

	function __construct($titulo, $resumen, $contenido, $user_id, $categoria_id){

		$this->titulo = $titulo;
		$this->resumen = $resumen;
		$this->contenido = $contenido;
		$this->user_id = $user_id;
		$this->categoria_id = $categoria_id;
	}

	public static function getAll(){ 
		$sql = "SELECT * FROM posts"; 
        $query = Post::$db->prepare($sql);
        $query->execute();

        $posts = array();

        foreach ($query->fetchAll() as $row) {
        	$row  = (array)$row;
        	$nuevoPost = new Post($row['titulo'], $row['resumen'], $row['contenido'], $row['user_id'], $row['categoria_id']); 
        	$nuevoPost->id = $row['id'];
        	array_push($posts, $nuevoPost);
        }
        return $posts;
	}

	public static function get($id){
		$sql = "SELECT * FROM posts WHERE id = :id";
        $query = Post::$db->prepare($sql);
        $parameters = array(':id' => $id);
        $query->execute($parameters);

        $row = (array)$query->fetch();

        $nuevoPost = new Post($row['titulo'], $row['resumen'], $row['contenido'], 
        	$row['user_id'], $row['categoria_id']); 
        $nuevoPost->id = $row['id'];         
        
        return $nuevoPost;
	}

	public static function getByCategoria($categoria_id){
		$sql = "SELECT * FROM posts WHERE categoria_id = :categoria_id";
        $query = Post::$db->prepare($sql);
        $parameters = array(':categoria_id' => $categoria_id);
        $query->execute($parameters);

        $posts = array();

        foreach ($query->fetchAll() as $row) {
        	$row  = (array)$row;
        	$nuevoPost = new Post($row['titulo'], $row['resumen'], $row['contenido'], 
        		$row['user_id'], $row['categoria_id']); 
        	$nuevoPost->id = $row['id'];
        	array_push($posts, $nuevoPost);
        }
        return $posts;
	
	}
	/**
	public static function getByCategoria($categoriaId){
		$sql = "SELECT * FROM posts WHERE categoria_id = :categoria";
		$parameters = array(':categoria' => $categoriaId);
		$ids = Categoria::get($categoriaId)->getChildrenIdsAsList();
		$i = 0;
		foreach ($ids as $id) {
			$i += 1;
			$sql .= " OR categoria_id = :categoria".$i;
			$parameters[":categoria".$i] = $id;
		}
        $query = Post::$db->prepare($sql);
        $query->execute($parameters);

        $posts = array();

        foreach ($query->fetchAll() as $row) {
        	$row  = (array)$row;
        	$nuevoPost = new Post($row['titulo'], $row['resumen'], $row['contenido'], $row['user_id'], $row['categoria_id']); 
        	$nuevoPost->id = $row['id'];
        	array_push($posts, $nuevoPost);
        }
        return $posts;
	}
	*/

	public function insert(){		
        $sql = "INSERT INTO posts (titulo, resumen, contenido, user_id, categoria_id) VALUES (:titulo, :resumen, :contenido, :user_id, :categoria_id)";
        $query = Post::$db->prepare($sql);
        $parameters = array(':titulo' => $this->titulo, ':resumen' => $this->resumen, 
        	':contenido' => $this->contenido, ':user_id' => $this->user_id, 
        	':categoria_id' => $this->categoria_id);

        $query->execute($parameters);        
	}

	public function update(){		
        $sql = "UPDATE posts SET titulo = :titulo, resumen = :resumen, contenido = :contenido, user_id = :user_id, categoria_id = :categoria_id WHERE id = :id";
        $query = Post::$db->prepare($sql);
        $parameters = array(':titulo' => $this->titulo, ':resumen' => $this->resumen, 
        	':contenido' => $this->contenido, ':user_id' => $this->user_id, 
        	':categoria_id' => $this->categoria_id, ':id' => $this->id);

        $query->execute($parameters);        
	}

	public function delete(){
		$sql = "DELETE FROM posts WHERE id = :id";
        $query = Post::$db->prepare($sql);
        $parameters = array(':id' => $this->id);
        $query->execute($parameters);        
	}

	public function matches($query){
		include_once APP . "controller/categoriacontroller.php";
		new CategoriaController();
		$query = strtolower($query);		
		$categoria = Categoria::get($this->getCategoria());
		$post = $categoria->getNombreCompleto();
		$post = strtolower($post);
		if (strpos($post, $query) !== false) {
			return true;
		}

		return false;
	}

	public static function getByFilter($query){
		$allPosts = Post::getAll();
		$posts = array();
		foreach ($allPosts as $post) {
			if($post->matches($query)){
				array_push($posts, $post);
			}
		}
		return $posts;
	}

	public function getId(){
		return $this->id;
	}
	public function getTitulo(){
		return $this->titulo;
	}	
	public function getResumen(){
		return $this->resumen;
	}
	public function getContenido(){
		return $this->contenido;
	}
	public function getUserId(){
		return $this->user_id;
	}
	public function getCategoria(){
		return $this->categoria_id;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}	
	public function setResumen($resumen){
		$this->resumen = $resumen;
	}
	public function setContenido($contenido){
		$this->contenido = $contenido;
	}
	public function setCategoria($categoria_id){
		$this->categoria_id = $categoria_id;
	}
}