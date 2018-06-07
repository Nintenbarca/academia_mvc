<?php $this->layout('layout2') ?> 

<div class="container">
	<?php session_start();

	if (isset($_SESSION['user'])) {
		echo "<h1>Bienvenido ". $_SESSION['user']->getNombre() ."</h1>";
	}else{
		echo "<h1>Bienvenido</h1>";

	}	
	?>    
</div>