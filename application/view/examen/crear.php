<?php $this->layout('layout2'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Añadir Examen</div>

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
                    <form class="form-horizontal" method="POST" action="<?php echo URL; ?>examencontroller/anadir">                        

                        <div class="form-group">
                            <label for="fecha" class="col-md-4 control-label">Fecha</label>
                            <div class="col-md-6">
                                <input type="text" name="fecha" class="form-control" placeholder="dd/mm/aa" required="">
                            </div>
                        </div>                        

                        <div class="form-group">
                            <label for="categoria" class="col-md-4 control-label">Categoria</label>
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