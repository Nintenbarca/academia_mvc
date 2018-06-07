<?php

class Categoria{

	private $id;
	private $nombre;
	private $categoria_padre;
    private $is_parent_category;
    private $is_leaf_category;

	public static $db;

	function __construct($nombre, $categoria_padre, $is_parent_category = false, 
        $is_leaf_category = true){
    	$this->nombre = $nombre;
    	$this->categoria_padre = $categoria_padre;
        $this->is_parent_category = $is_parent_category;
        $this->is_leaf_category = $is_leaf_category;
	}

	public static function getAll(){ 
    	$sql = "SELECT * FROM categorias"; 
        $query = Categoria::$db->prepare($sql);
        $query->execute();

        $categorias = array();

        foreach ($query->fetchAll() as $row) {
        	$row  = (array)$row;
        	$nuevaCategoria = new Categoria($row['nombre'], $row['categoria_id'], 
                        $row['is_parent_category'], $row['is_leaf_category']); 
        	$nuevaCategoria->id = $row['id'];
        	array_push($categorias, $nuevaCategoria);
        }
        return $categorias;
	}     

	public static function getParent(){ 
		$sql = "SELECT * FROM categorias WHERE is_parent_category = 1"; 
        $query = Categoria::$db->prepare($sql);
        $query->execute();

        $categorias = array();

        foreach ($query->fetchAll() as $row) {
        	$row  = (array)$row;
        	$nuevaCategoria = new Categoria($row['nombre'], $row['categoria_id'], 
                        $row['is_parent_category'], $row['is_leaf_category']); 
        	$nuevaCategoria->id = $row['id'];
        	array_push($categorias, $nuevaCategoria);
        }
        return $categorias;
	}

        public static function getChildren(){ 
            $sql = "SELECT * FROM categorias WHERE is_leaf_category = 1"; 
            $query = Categoria::$db->prepare($sql);
            $query->execute();

            $categorias = array();

            foreach ($query->fetchAll() as $row) {
                    $row  = (array)$row;
                    $nuevaCategoria = new Categoria($row['nombre'], $row['categoria_id'], 
                            $row['is_parent_category'], $row['is_leaf_category']); 
                    $nuevaCategoria->id = $row['id'];
                    array_push($categorias, $nuevaCategoria);
            }
            return $categorias;
        }

	/**
        public static function getTree(){
		$categorias = Categoria::getAllParent();
		foreach ($categorias as $categoria) {
			$categoria->children = $categoria->getChildren();
		}
		return $categorias;
	}
        */

	public static function get($id){
		$sql = "SELECT * FROM categorias WHERE id = :id";
                $query = Categoria::$db->prepare($sql);
                $parameters = array(':id' => $id);
                $query->execute($parameters);

 		if ($query->rowCount()>0) {
 			$row = (array)$query->fetch();

        	        $nuevaCategoria = new Categoria($row['nombre'], $row['categoria_id'], 
                                $row['is_parent_category'], $row['is_leaf_category']);        
        	        $nuevaCategoria->id = $row['id'];
        	        return $nuevaCategoria;
 		}else{
 		     return false;
 		}
	}

	/**
        public function getChildren(){
		$sql = "SELECT * FROM categorias WHERE categoria_id = :categoria_padre";
                $query = Categoria::$db->prepare($sql);
                $parameters = array(':categoria_padre' => $this->id);
                $query->execute($parameters);

         	    $categorias = array();

                foreach ($query->fetchAll() as $row) {
                	$row  = (array)$row;
                	$nuevaCategoria = new Categoria($row['nombre'], $row['categoria_id']); 
                	$nuevaCategoria->id = $row['id'];
                	if (count($nuevaCategoria->getChildren()) > 0) {
                		$nuevaCategoria->children = $nuevaCategoria->getChildren();
                	}
                	array_push($categorias, $nuevaCategoria);
                }
                return $categorias;
	}
        */

	/**
        public function getChildrenIdsAsList(){
		$sql = "SELECT * FROM categorias WHERE categoria_id = :categoria_padre";
                $query = Categoria::$db->prepare($sql);
                $parameters = array(':categoria_padre' => $this->id);
                $query->execute($parameters);

                $list = array();

                foreach ($query->fetchAll() as $row) {
                	$row  = (array)$row;
                	$nuevaCategoria = new Categoria($row['nombre'], $row['categoria_id']); 
                	$nuevaCategoria->id = $row['id'];
                	array_push($list, $row['id']);
                	$childrenIds = $nuevaCategoria->getChildrenIdsAsList();

                	if (count($childrenIds) > 0) {
                		$list = array_merge($list, $childrenIds);
                	}
                }
                return $list;
	}
        */

	public function insert(){		
        $sql = "INSERT INTO categorias (nombre, categoria_id) 
        	VALUES (:nombre, :categoria_id)";
        $query = Categoria::$db->prepare($sql);
        $parameters = array(':nombre' => $this->nombre, 
        	':categoria_id' => $this->categoria_padre);

        $query->execute($parameters);
        $this->id = Categoria::$db->lastInsertId();
	}

    public function update(){               
        $sql = "UPDATE categorias SET nombre = :nombre, categoria_id = :categoria_id 
            WHERE id = :id";
        $query = Categoria::$db->prepare($sql);
        $parameters = array(':nombre' => $this->nombre, 
                ':categoria_id' => $this->categoria_padre, ':id' => $this->id);

        $query->execute($parameters);               
    }

    public function delete(){
        $sql = "DELETE FROM categorias WHERE id = :id";
        $query = Categoria::$db->prepare($sql);
        $parameters = array(':id' => $this->id);
        $query->execute($parameters);        
    }

	public function getId(){
		return $this->id;
	}

	public function getNombreCompleto(){
		$nombre = $this->getNombre();
		$c=Categoria::get($this->getCategoriaPadre());
		while ($c != false) {
			$nombre .= " de ".$c->getNombre();
			$c = Categoria::get($c->getCategoriaPadre());
		}
		return $nombre;
	}
	public function getNombre(){
		return $this->nombre;
	}

	public function getCategoriaPadre(){
		return $this->categoria_padre;
	}

        public function getParentId(){
                return $this->is_parent_category;
        }

        public function getChildId(){
                return $this->is_leaf_category;
        }

        public function setNombre($nombre){
                $this->nombre = $nombre;
        }

        public function setCategoriaPadre($categoria_padre){
                $this->categoria_padre = $categoria_padre;
        }
	
}