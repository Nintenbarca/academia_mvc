<?php $this->layout('layout2') ?>

<div class="container">
	<h1>Examenes</h1>
	<form class="buscador" action="/examencontroller/search" method="POST">		
		<input type="search" name="query">
		<input class="btn btn-primary btn-sm" type="submit" value="Buscar">
	</form><br>
	<?php
	error_reporting(0);
	session_start();?>
	<ul class="list-group">	
		<?php
		foreach ($examenes as $examen) { ?>
		<li class="list-group-item">
			<?php
			$categoria = Categoria::get($examen->getCategoria());
			echo "<h2><a href=\"".URL."examencontroller/detail/".$examen->getId()."\">Examen de ".$categoria->getNombreCompleto(). " del ".$examen->getFecha()."</a></h2><br>";	?>
		</li>
		<?php	
		}

		if (isset($_SESSION['user']) && $_SESSION['user']->isProfesor()) {?>
			<a href="<?php echo URL;?>examencontroller/form" class="btn btn-primary btn-sm">Crear Examen</a>
		<?php }

		?>	

</div>