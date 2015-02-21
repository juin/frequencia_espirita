<? 
require_once("config/util.php"); 
$url = "http://192.168.100.13/frequencia_espirita/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sistema de Gerenciamento de frequencia</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap -->
  <link href="<? echo $url ?>bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <script src="<? echo $url ?>js/bootstrap.min.js"></script>
  <script src="<? echo $url ?>js/jquery.min.js"></script>
</head>
<body>

	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">Frequência Espírita</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="#">Ínicio</a></li>
	        <li><a href="#">Relatórios</a></li>
	        <li class="dropdown">
	          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cadastros
	          <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	          	<li><a href="#">Logradouro</a></li>
				<li><a href="#">Bairro</a></li>
		      	<li><a href="#">Cidade</a></li>
		      	<li><a href="#">Coordenação</a></li>
		      	<li><a href="#">Atividade</a></li>
	          </ul>
	        </li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Registrar-se</a></li>
	        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>

<div class="container">
	