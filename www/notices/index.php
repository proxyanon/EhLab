<?php 
/**
*	@Author : Daniel Victor Freire Feitosa	
*	@Vesion : 3.0.0	
*/
session_start();
ini_set("default_charset", "utf-8");
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
			<li class="default"><a href="#">Notícias</a></li>
			<?php 
				if(isset($_SESSION['login'])):
			?>
			<li><a href="../login/home/">Painel</a></li>
			<?php 
				else:
			?>
			<li><a href="../login">Login</a></li>
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
				// Puxa as noticias do database
				$stmt = $con->prepare("SELECT * FROM `notices` ORDER BY `id` DESC LIMIT 10");
				$stmt->execute();
				if($stmt->rowCount() > 0):
					while($row = $stmt->fetchObject()):
			?>
					<h2><?php echo utf8_encode($row->title);?></h2><br>
						<li class="img"><img src="<?php echo $row->img;?>" width="280"></li>
						<li><p><?php echo utf8_encode($row->notice);?></p> <a href="notices?id=<?php echo $row->id;?>">Visualizar</a></li><br>
			<?php 
					endwhile;
				else:
			?>	
			<h2>Nenhuma notícia consta na base de dados</h2>
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