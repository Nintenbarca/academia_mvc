<?php $this->layout('layout2'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

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
                    <form class="form-horizontal" method="POST" action="<?php echo URL; ?>usuariocontroller/trylogin">                        

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass" class="col-md-4 control-label">Contraseña</label>
                            <div class="col-md-6">
                                <input type="password" name="pass" class="form-control" required="">
                            </div>
                        </div>                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>