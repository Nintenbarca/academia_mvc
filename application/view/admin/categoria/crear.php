<?php $this->layout('admin/layout'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Añadir Categoria</div>

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
                    <form class="form-horizontal" method="POST" action="<?php echo URL; ?>categoriacontroller/anadir">                        

                        <div class="form-group">
                            <label for="nombre" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input type="text" name="nombre" class="form-control" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass" class="col-md-4 control-label">Categoria</label>
                            <div class="col-md-6">
                                <select name="categoria" class="form-control">
                                <?php foreach ($categorias as $categoria) {
                                    echo "<option value='". $categoria->getId() ."'>". $categoria->getNombreCompleto() .
                                    "</option>";
                                }
                                ?>            
                                </select>
                            </div>
                        </div>                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Añadir
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>