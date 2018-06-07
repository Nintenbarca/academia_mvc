<?php $this->layout('admin/layout'); 

?>

<h1>
    POSTS
    <small>Listado</small>
</h1>

<form class="buscador" action="/postcontroller/search" method="POST">    
    <input type="search" name="query">
    <input class="btn btn-primary btn-sm" type="submit" value="Buscar">
</form>

<div class="box">
        <div class="box-header">
            <h3 class="box-title">Listado de Posts</h3>
            <a href="/postcontroller/form" class="btn btn-primary pull-right" data-toggle="modal">
                <i class="fa fa-plus"></i>
                Crear Post
            </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Resumen</th> 
                    <th>Categoria</th>                                       
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($posts as $post) {?>

                <tr>
                    <td><?=$post->getId() ?></td>
                    <td><?=$post->getTitulo() ?></td>
                    <td><?=$post->getResumen() ?></td>   
                    <td><a href="/postcontroller/categoria/<?=$post->getCategoria() ?>"><?=Categoria::get($post->getCategoria())->getNombreCompleto() ?></a></td>
                    <td>
                        <a href="/postcontroller/detail/<?=$post->getId() ?>" target="_blank"
                           class="btn btn-xs btn-default">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="/postcontroller/editar/<?=$post->getId() ?>"
                           class="btn btn-xs btn-info">
                            <i class="fa fa-pencil"></i>
                        </a>                            
                        <form action="/postcontroller/borrar/<?=$post->getId() ?>"
                            method="POST" style="display: inline">                            
                            <button class="btn btn-xs btn-danger"
                                onclick="return confirm('¿Seguro que quiere eliminar esta publicacion?')">
                                <i class="fa fa-times"></i>
                            </button>
                        </form>
                    </td>
                </tr> 
                <?php                       
                } ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>