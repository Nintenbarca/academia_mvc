<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">   

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">  

  <style type="text/css">
    
    body {
    padding-top: 20px;
    padding-bottom: 20px;  
    background-image: url('/img/academia.jpg');
    }

    .navbar {
    margin-bottom: 20px;
    }

    .foto{
      height: 180px;
      width: 180px;
    }     

    @media (max-width: 768px){    
        .foto{  
        height: 130px;       
        width: 130px;                 
        }
    }  

    .logo{
      border-width: 1px;
      margin-top: 10px; 
      margin-bottom: 10px;
      height: 120px;
      width: 240px;     
    }

    .buscador{
      margin: 10px;
    }

  </style>

<head>

	<title>MINI</title>

</head>
<body>

<div class="container">    
      <!-- Static navbar -->      
      <nav class="navbar navbar-default">                    
        <div class="container-fluid">          
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>            
          </div>          
          <div id="navbar" class="navbar-collapse collapse"> 
            <ul class="nav navbar-nav">
              <li><a href="<?php echo URL; ?>">Home</a></li>  
              <li><a href="<?php echo URL; ?>postcontroller">Posts</a></li> 
              <?php
              error_reporting(0);
              session_start();
              if (isset($_SESSION['user'])) {?>                
                <li><a href="<?php echo URL; ?>examencontroller">Examen</a></li>                 
              <?php                
              } ?>                         
            </ul>             
            <ul class="nav navbar-nav navbar-right">
              <!-- Authentication Links -->                   
              <?php
              if (isset($_SESSION['user'])) {?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <?=$_SESSION['user']->getNombre() ?> 
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/usuariocontroller/logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-btn fa-sign-out"></i>Cerrar Sesión</a>

                        <form id="logout-form" action="/usuariocontroller/logout" method="POST" style="display: none;">                                   
                        </form>

                        </li>
                    </ul>
                </li>                
              <?php
              }else{?>
                <li><a href="<?php echo URL; ?>usuariocontroller/login">Login</a></li>
                <li><a href="<?php echo URL; ?>usuariocontroller/signup">Registrar</a></li>
              <?php
              }?>
            </ul> 
                             
          </div><!--/.nav-collapse -->                    
        </div><!--/.container-fluid -->
      </nav>  
      
      <div class="jumbotron">
        <?=$this->section('content')?> 
      </div>      
      
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>    

    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">		
	</script>

</body>
</html>