<?php $this->layout('layout2');
error_reporting(0);
function DisplayCategoria($categoria, $marginlevel){

	$space = "";
	for ($i=0; $i < $marginlevel; $i++) { 
		$space .="·····";
	}
	
	echo "<tr><td><b>".$space.$categoria->getNombre()."</b></td>";
	echo "<td><a href = \"".URL."/postcontroller/categoria/".$categoria->getId()."\">Posts</a>";
	echo "<a href = \"".URL."/examencontroller/categoria/".$categoria->getId()."\">  Examenes</a></td></tr>";
	
	if (isset($categoria->children) && count($categoria->children)>0) {
		foreach ($categoria->children as $subcategoria) {
			DisplayCategoria($subcategoria, $marginlevel + 1);
		}
	}
}

?> 

<div class="container">
<table>
	<?php session_start();
		foreach ($categorias as $categoria) {
			DisplayCategoria($categoria,0);
			
		}		
	?>
</table>
</div>