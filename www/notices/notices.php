<?php 
error_reporting(E_ALL);
/**
*	@Author : Daniel Victor Freire Feitosa	
*	@Vesion : 3.0.0	
*/
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>EhLab 3.0</title>
	<link rel="stylesheet" type="text/css" href="../css/notices.css" async defer>
</head>
<body>
<?php
	include_once("../config/database.conn.php");
	if(isset($e)):
?>
<!-- Código da página de instalação -->
<?php
	elseif(isset($con)):
?>
<header class="top">
	<nav class="menu">
		<ul>
			<li><h1>EHLab 3.0</h1></li>
			<li class="right"><a href="https://github.com/proxyanon/">GitHub</a></li>
		</ul>
	</nav>
</header>
<section class="main">
	<nav class="mini_menu">
		<ul>
			<li><a href="../index.php">Home</a></li>
			<li class="default"><a href="index">Notícias</a></li>
			<?php 
				if(isset($_SESSION['login'])):
			?>
			<li><a href="../login/home">Painel</a></li>
			<?php 
				else:
			?>
			<li><a href="../login/">Login</a></li>
			<?php 
				endif;
			?>
			<li><a href="../desafios.php">Desafios</a></li>
		</ul>
	</nav>
	<section class="content">
		<div class="disclaimer">
			<h1>Notícias</h1>
			<hr color="transparent" size="0">
			<div class="disclaimer_content">
			<ul>
			<?php 
				if(isset($_GET['id'])):
					$id = $_GET['id']; // $_GET['id'] sem nehuma tratamento gera o erro de SQLInjeciton
					$stmt = $con->prepare("SELECT * FROM notices WHERE id = $id");
					$stmt->execute();
					while($row = $stmt->fetchObject()):
					/*
					*
					*	Exemplo de ataque
					*	[Número de colunas] http://url/notices?id=1 order by 4
					*	[Pegar versão do MySQL] http://url/notices?id=-1 union select 1,2,3,@@version
					*/
			?>
					<h2><?php echo utf8_encode($row->title);?></h2><br>
						<li class="img"><img src="<?php echo $row->img;?>" width="280"></li>
						<li><p><?php echo $row->notice;?></p></li>
			<?php 
					endwhile;
				else:
			?>	
			<h2>Nenhuma notícia consta na base de dados.</h2>
			<?php endif;?>
			</ul>
			</div>
		</div>
	</section>
</section>
<?php
	else:
?>
<!-- Código da página de instalação -->
<?php
	endif;
?>
</body>
</html>