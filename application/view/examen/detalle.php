<?php $this->layout('layout2');
$categoria = Categoria::get($examen->getCategoria());
?>

<div class="container">
	<?php
	error_reporting(0);
	session_start();
	$i = 1; ?>

	<ul class="list-group">	
		<li class="list-group-item">
			<h1>Detalles del Examen</h1><br>
			
			<p><span class="label label-info">Examen de <?=$categoria->getNombreCompleto()?></span></p>
			<p><?=$examen->getFecha()?></p><br>		

			<h3>Preguntas:</h3><br>	
		
			<?php
			foreach ($examen->getPreguntas() as $pregunta) {
				echo "<p><b>".$i. ". " .str_replace("\n", "<br>", $pregunta->getEnunciado())."</b>
					</p>";
				echo "<p>" .str_replace("\n", "<br>", $pregunta->getSolucion())."</p><br>";
				$i++;
			} ?>
		</li>
	</ul>

		<?php
		if (isset($_SESSION['user']) && $_SESSION['user']->getId() == $examen->getUserId()){?>
			<a href="<?php echo URL;?>examencontroller/editar/<?php echo $examen->getId();?>" 
			class="btn btn-primary btn-sm">Editar</a>			
	<?php }
	
	?>

</div>