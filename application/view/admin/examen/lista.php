<?php $this->layout('admin/layout'); 

?>

<h1>
    EXAMENES
    <small>Listado</small>
</h1>

<form class="buscador" action="/examencontroller/search" method="POST">    
    <input type="search" name="query">
    <input class="btn btn-primary btn-sm" type="submit" value="Buscar">
</form>

<div class="box">
        <div class="box-header">
            <h3 class="box-title">Listado de Examenes</h3>
            <a href="/examencontroller/form" class="btn btn-primary pull-right" data-toggle="modal">
                <i class="fa fa-plus"></i>
                Crear Examen
            </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Curso</th>                     
                    <th>Fecha</th>                                       
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($examenes as $examen) {?>

                <tr>
                    <td><?=$examen->getId() ?></td>                      
                    <td><a href="/examencontroller/categoria/<?=$examen->getCategoria() ?>"><?=Categoria::get($examen->getCategoria())->getNombreCompleto() ?></a></td>
                    <td><?=$examen->getFecha() ?></td>  
                    <td>
                        <a href="/examencontroller/detail/<?=$examen->getId() ?>" target="_blank"
                           class="btn btn-xs btn-default">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="/examencontroller/editar/<?=$examen->getId() ?>"
                           class="btn btn-xs btn-info">
                            <i class="fa fa-pencil"></i>
                        </a>                            
                        <form action="/examencontroller/borrar/<?=$examen->getId() ?>"
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