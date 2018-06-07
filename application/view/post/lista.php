<?php $this->layout('layout2') ?> 

<div class="container">
	<h1>Posts</h1>
	<form class="buscador" action="/postcontroller/search" method="POST">		
		<input type="search" name="query">
		<input class="btn btn-primary btn-sm" type="submit" value="Buscar">
	</form><br>
	<?php
	error_reporting(0);	
	session_start();?>
	<ul class="list-group">			
		<?php
		foreach ($posts as $post) { ?>
			<li class="list-group-item">
				<?php
				echo "<h2><a href=\"".URL."postcontroller/detail/".$post->getId()."\">"
					.$post->getTitulo()."</a></h2>";		
				echo "<p>". $post->getResumen() ."</p>";							
				$categoria = Categoria::get($post->getCategoria());
				echo "<p><span class='label label-info'>". $categoria->getNombreCompleto() ."</span></p><br>"; ?>
			</li>			
		<?php
		}?>		
	</ul>
		<?php
		if (isset($_SESSION['user'])) {?>
			<a href="<?php echo URL;?>postcontroller/form" class="btn btn-primary btn-sm">Crear Post</a>
  		<?php 
		}?>
</div>