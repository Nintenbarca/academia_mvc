<?php $this->layout('layout2'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Examen</div>

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
                    <form class="form-horizontal" method="POST" action="<?php echo URL; ?>examencontroller/update">    

                    <input type="hidden" name="id" value="<?php echo $examen->getId();?>">

                        <div class="form-group">
                            <label for="fecha" class="col-md-4 control-label">Fecha</label>
                            <div class="col-md-6">
                                <input type="text" name="fecha" class="form-control" placeholder="dd/mm/aa" value="<?php echo $examen->getFecha();?>" required="">
                            </div>
                        </div>                        

                        <div class="form-group">
                            <label for="categoria" class="col-md-4 control-label">Categoria</label>
                            <div class="col-md-6">
                                <select name="categoria" class="form-control">
                                <?php foreach ($categorias as $categoria) {
                                    echo '<option value="'.$categoria->getId().'"';
                                    if($categoria->getId() == $examen->getCategoria()){
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
            <div class="panel panel-default">
                <div class="panel-heading">Editar Preguntas</div>
                <div class="panel-body">
                    <?php foreach ($examen->getPreguntas() as $pregunta) {                     
                        
                        if (!empty($_SESSION["errores"])) {
                            echo "<ul>";
                            while (!empty($_SESSION["errores"])) {
                                echo "<li style='color: red'>".array_pop($_SESSION["errores"])."</li>";
                            }
                            echo "</ul>";
                        }?>
                        <form class="form-horizontal" method="POST" action="<?php echo URL; ?>preguntacontroller/update">    

                        <input type="hidden" name="id" value="<?php echo $pregunta->getId();?>">

                        <div class="form-group">
                            <label for="enunciado" class="col-md-4 control-label">Enunciado</label>
                            <div class="col-md-6">
                                <input type="text" name="enunciado" class="form-control" value="<?php echo $pregunta->getEnunciado();?>" required="">
                            </div>
                        </div>   

                        <div class="form-group">
                            <label for="solucion" class="col-md-4 control-label">Solucion</label>
                            <div class="col-md-6">
                                <textarea name="solucion" class="form-control" required=""><?php echo $pregunta->getSolucion();?></textarea>
                            </div>
                        </div>                             

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                                <a href="<?php echo URL;?>preguntacontroller/borrar/<?php echo $pregunta->getId();?>" class="btn btn-danger">Borrar</a>
                            </div>
                        </div> 
                    </form>
                    <?php
                    }?>                     

                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Añadir Preguntas</div>
                <div class="panel-body">
                    <?php                    
                    if (!empty($_SESSION["errores"])) {
                        echo "<ul>";
                        while (!empty($_SESSION["errores"])) {
                            echo "<li style='color: red'>".array_pop($_SESSION["errores"])."</li>";
                        }
                        echo "</ul>";
                    }?>
                    <form class="form-horizontal" method="POST" action="<?php echo URL; ?>preguntacontroller/anadir">    

                        <input type="hidden" name="examen_id" value="<?php echo $examen->getId();?>">

                        <div class="form-group">
                            <label for="enunciado" class="col-md-4 control-label">Enunciado</label>
                            <div class="col-md-6">
                                <input type="text" name="enunciado" class="form-control" 
                                required="">
                            </div>
                        </div>   

                        <div class="form-group">
                            <label for="solucion" class="col-md-4 control-label">Solucion</label>
                            <div class="col-md-6">
                                <textarea name="solucion" class="form-control" required=""></textarea>
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