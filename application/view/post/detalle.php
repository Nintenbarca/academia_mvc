<?php $this->layout('layout2') ?>

<div class="container">
	<?php
	error_reporting(0);
	session_start();?>
	<ul class="list-group">	
		<li class="list-group-item">
			<?php
			echo "<h1>". $post->getTitulo() ."</h1>";	
			$categoria = Categoria::get($post->getCategoria());
			echo "<p><span class='label label-info'>". $categoria->getNombreCompleto() ."</span></p><br>";				
			echo "<p>". $post->getContenido() ."</p>";			

			if (isset($_SESSION['user']) && $_SESSION['user']->getId() == $post->getUserId()){?>
					<a href="<?php echo URL;?>postcontroller/editar/<?php echo $post->getId();?>" 
					class="btn btn-primary btn-sm">Editar</a>
					<a href="<?php echo URL;?>postcontroller/borrar/<?php echo $post->getId();?>" 
					class="btn btn-danger btn-sm">Borrar</a>
			<?php }	
			?>
		</li>
	</ul>
</div>