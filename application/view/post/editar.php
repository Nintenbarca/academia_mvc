<?php $this->layout('layout2'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Post</div>

                <div class="panel-body">
                <?php 
                error_reporting(0);
                session_start();
                if (!empty($_SESSION["errores"])) {
                    echo "<ul>";
                    while (!empty($_SESSION["errores"])) {
                        echo "<li style='color: red'>".array_pop($_SESSION["errores"])."</li>";
                    }
                    echo "</ul>";
                }?>
                    <form class="form-horizontal" method="POST" action="<?php echo URL; ?>postcontroller/tryEditar">        

                        <input type="hidden" name="id" value="<?php echo $post->getId();?>">

                        <div class="form-group">
                            <label for="titulo" class="col-md-4 control-label">Titulo</label>
                            <div class="col-md-6">
                                <input type="text" name="titulo" class="form-control" value="<?php echo $post->getTitulo();?>" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="resumen" class="col-md-4 control-label">Resumen</label>
                            <div class="col-md-6">
                                <input type="text" name="resumen" class="form-control" value="<?php echo $post->getResumen();?>" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contenido" class="col-md-4 control-label">Contenido</label>
                            <div class="col-md-6">
                               <textarea name="contenido" class="form-control" required=""><?php echo $post->getContenido();?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="categoria" class="col-md-4 control-label">Categoria</label>
                            <div class="col-md-6">
                                <select name="categoria" class="form-control">
                                <?php foreach ($categorias as $categoria) {
                                    echo '<option value="'.$categoria->getId().'"';
                                    if($categoria->getId() == $post->getCategoria()){
                                        echo ' selected';
                                    }
                                    echo '>';
                                    echo $categoria->getNombreCompleto();
                                    echo '</option>';
                                }
                                ?>            
                                </select>
                            </div>
                        </div>                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>