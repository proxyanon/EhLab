<?php 
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
	<link rel="stylesheet" type="text/css" href="css/desafios.css" async defer>
	<script type="text/javascript" src="login/home/js/jquery.min.js"></script>
</head>
<body>
<?php
	include_once("config/database.conn.php");
	if(isset($e)):
?>
<!-- Código da página de instalação -->
<?php
	elseif(isset($con)):
?>
<!-- Código da página inical -->
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
			<li><a href="index.php">Home</a></li>
			<li><a href="notices/">Notícias</a></li>
			<?php 
				if(isset($_SESSION['login'])):
			?>
			<li><a href="login/home/">Painel</a></li>
			<?php 
				else:
			?>
			<li><a href="login/">Login</a></li>
			<?php 
				endif;
			?>
			<li class="default"><a href="desafios.php">Desafios</a></li>
		</ul>
	</nav>
	<section class="content">
		<div class="disclaimer">
			<h1>Desafios</h1>
			<hr color="transparent" size="0">
			<div class="disclaimer_content">
				<ul>
				<?php 
					$pontos = 0;
					$st = $con->prepare("SELECT * FROM `score`");
					$st->execute();
					$n = $st->fetchObject();
					$score = (int) $n->pass + $n->file + $n->true_f;
				?>
					<h2>Score</h2>
						<li><p>Score atual : <b><?php echo $score;?> pontos</b></p></li>
						<li><p>Score máximo : <b>100 pontos</b></p></li>
					<h2>Desafios</h2>
						<li><p>Senha do administrador (nível : fácil)</p></li>
						<a href="#" class="pass">Adicionar flag</a>
						<div id="flag_pass">
						<span class="close" id="close_pass">X</span>
							<form method="post" enctype="multipart/form-data">
								<h3>Flag : Senha do administrador</h3>
								<img src="http://www.iconsdb.com/icons/preview/orange/key-6-xxl.png" width="100">
								<input type="password" name="password" placeholder="Flag aqui"><br>
								<input type="submit" name="send1" value="Enviar">
							</form>
						</div>
						<li><p>Crie um arquivo neste caminho : <b>home/own3d_flag.txt </b>(nível : médio)</p></li>
						<a href="#" class="file">Adicionar flag</a>
						<div id="flag_file">
						<span class="close" id="close_file">X</span>
							<form method="post" enctype="multipart/form-data">
								<h3>Flag : Criar arquivo</h3>
								<img src="http://www.iconsdb.com/icons/preview/orange/key-6-xxl.png" width="100"><br>
								<code>home/own3d_flag.txt</code>
								<input type="submit" name="send2" value="Validar arquivo">
							</form>
						</div>
						<li><p>True Flag (nível : difícil)</p></li>
						<a href="#" class="true">Adicionar flag</a>
						<div id="flag_true">
						<span class="close" id="close_true">X</span>
							<form method="post" enctype="multipart/form-data">
								<h3>Flag : Flag True</h3>
								<img src="http://www.iconsdb.com/icons/preview/orange/key-6-xxl.png" width="100">
								<input type="password" name="true_f" placeholder="Flag aqui"><br>
								<input type="submit" name="send3" value="Enviar">
							</form>
						</div>
				</ul>
			</div>
		</div>
<script type="text/javascript">
// não mexe nessa porra
$(document).ready(function(){$("#close_pass").click(function (){$("#flag_pass").toggle("slow");});$("#close_file").click(function (){$("#flag_file").toggle("slow");});$("#close_true").click(function (){$("#flag_true").toggle("slow");});$(".pass").click(function(){$("#flag_pass").toggle("slow");});$(".file").click(function(){$("#flag_file").toggle("slow");});$(".true").click(function(){$("#flag_true").toggle("slow");});});
</script>
		<?php 
			$error_flag = '<script>alert("Flag inválida !\r\nVocê não pontuou");</script>';
			$success_flag = '<script>alert("Parabéns desafio concluido\r\nVocê ganhou pontos");</script>';
			function upd_score($con, $flag, $pontos){
				$stmt = $con->prepare("UPDATE `score` SET `$flag` = ?");
				$stmt->execute(array($pontos));
				return true;
			}
			if(isset($_POST['send1'])):
				// flag senha admin
				$pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
				$password = md5($pass);
				if(empty($pass)):
				else:
					$query1 = $con->prepare("SELECT `password` FROM `administrators` WHERE `password` = ?");
					$query1->execute(array($password));
					if($query1->rowCount() <= 0):
						echo $error_flag;
					else:
						if(upd_score($con, "pass", 20) == true):
							echo $success_flag;
						else:
							echo $error_flag;
						endif;
					endif;
				endif;
			elseif(isset($_POST['send2'])):
				// flag file
				$flag = "login/home/own3d_flag.txt";
				if(is_file($flag) && file_exists($flag)):
					if(upd_score($con, "file", 30) == true):
						echo $success_flag;
					else:
						echo $error_flag;
					endif;
				else:
					echo $error_flag;
				endif;
			elseif(isset($_POST['send3'])):
				// flag true
				$true = "#Th1sM4yB3f_l4g.estegonografia";
				$enter_flag = filter_input(INPUT_POST, "true_f", FILTER_SANITIZE_SPECIAL_CHARS);
				if($enter_flag == $true):
					if(upd_score($con, "true_f", 50) == true):
						echo $success_flag;
					else:
						echo $error_flag;
					endif;
				else:
					echo $error_flag;
				endif;

			endif;	
		?>
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