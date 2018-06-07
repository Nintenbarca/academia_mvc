<?php $this->layout('admin/layout'); 

?>

<h1>
    CATEGORIAS
    <small>Listado</small>
</h1>

<div class="box">
        <div class="box-header">
            <h3 class="box-title">Listado de Categorias</h3>
            <a href="/categoriacontroller/form" class="btn btn-primary pull-right" data-toggle="modal">
                <i class="fa fa-plus"></i>
                Crear Categoria
            </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="posts-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Curso</th> 
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($categorias as $categoria) {?>

                <tr>
                    <td><?=$categoria->getId() ?></td>                      
                    <td><?=Categoria::get($categoria->getId())->getNombreCompleto() ?></td>
                </tr> 
                <?php                       
                } ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>