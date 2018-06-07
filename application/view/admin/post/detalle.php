<?php $this->layout('layout2') ?> 

<div class="container">	
	<ul class="list-group">	
		<li class="list-group-item">
			<?php
			echo "<h1>". $post->getTitulo() ."</h1>";
			$categoria = Categoria::get($post->getCategoria());
			echo "<p><span class='label label-info'>". $categoria->getNombreCompleto() ."</span>
				</p>";					
			echo "<p>". $post->getContenido() ."</p>";
			?>
		</li>
	</ul>
</div>