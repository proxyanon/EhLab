<?php 
/**
*	@Author : Daniel Victor Freire Feitosa	
*	@Vesion : 3.0.0	
*/
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['login'])):
	header("Location: ../index.php");
	echo '<script>document.location="../index.php"</script>';
	exit();
else:
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>EHLab 3.0.0</title>
	<link rel="stylesheet" type="text/css" href="../../css/home.css" async defer>
	<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
<?php
	include_once("../../config/database.conn.php");
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
			<li><h1>EHLab 3.0.0</h1></li>
			<li class="right"><a href="https://github.com/proxyanon/">GitHub</a></li>
		</ul>
	</nav>
</header>
<section class="main">
	<nav class="mini_menu">
		<ul>
			<li><a href="../../index.php">Home</a></li>
			<li><a href="../../notices/">Notícias</a></li>
			<?php 
				if(isset($_SESSION['login'])):
			?>
			<li class="default"><a href="#">Painel</a></li>
			<?php 
				else:
			?>
			<li><a href="../index.php">Login</a></li>
			<?php 
				endif;
			?>
			<li><a href="../../desafios.php">Desafios</a></li>
		</ul>
	</nav>
	<section class="content">
		<div class="disclaimer">
			<h1>Olá <?php
				$username = $_SESSION['login'];
				echo $username;
			?></h1>
			<hr color="transparent" size="0">
			<div class="disclaimer_content">
				<ul class="left">
					<h2>Conteúdo</h2>
						<li><a href="#" class="create_notice">Criar notícia</a></li>
						<div class="create_content" id="notice">
						<!-- Enviar notícias com falha de upload de imagem-->
						<form method="post" enctype="multipart/form-data">	
							<input type="text" name="title" placeholder="Título"/><br>
							<textarea name="notice" placeholder="Notícia" maxlength="500"></textarea><br>
							<input type="file" name="file"/><br>
							<?php 
								if (isset($_POST["send"])):
									$title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
									$notice = filter_input(INPUT_POST, "notice", FILTER_SANITIZE_SPECIAL_CHARS);
									$file = $_FILES["file"];
									$dir = "../../notices/img/";
									if(!empty($title) && !empty($notice)):
										if(is_file($file["tmp_name"]) && !empty($file)):
											$dst = $dir.$file["name"];
											$notice_dir = "img/".$file["name"];
											$type_array = array("image/png", "image/png", "image/jpeg", "image/webp", "image/bmp");
											/*
											*	Falha de upload de imagem
											*	ex : [ burpsuite | 127.0.0.1:8080 ]
											*	altere a requisição no [ Content-type=application/ocstream ]
											*	para [ Content-type=image/png ], e pronto shell upada
											*/
											if(in_array($file["type"], $type_array)):
												if(move_uploaded_file($file["tmp_name"], $dst)):
													$stmt = $con->prepare("INSERT INTO `notices` (`title`, `notice`, `img`) VALUES (?,?,?)");
													$stmt->execute(array($title, $notice, $notice_dir));
													echo "<p class='success'>Notícia criada</p>";
												endif;
											endif;
										endif;
									endif;
								endif;
							?>
							<input type="submit" name="send" value="Enviar">
						</form>
						</div>
						<li><a href="#" class="delete_notice">Excluir notícia</a></li>
						<div class="create_content" id="delete">
							<?php 
								$query = $con->prepare("SELECT * FROM `notices` ORDER BY `id` DESC");
								$query->execute();
								if($query->rowCount() <= 0):
									echo '<h2>Nenhuma notícia na base de dados.</h2>';
								else:
									while($row = $query->fetchObject()):
							?>
							<p><a href="index.php?act=del&id=<?php echo $row->id;?>">X</a> <?php echo $row->title;endwhile;endif;?></p>
							<?php 
								if(isset($_GET['act']) && isset($_GET['id'])):
									$id_g = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
									$id = (int) $id_g;
									if(is_numeric($id) && !empty($id) && $_GET['act'] == 'del'):
										if($username):
											$del = $con->prepare("DELETE FROM `notices` WHERE `id` = ?");
											$del->execute(array($id));
											echo '<script>document.location="index.php"</script>';
										endif;
									endif;
								endif;
							?>
						</div>
					<br><br>
					<h2>Perfil</h2>
						<li><a href="#" class="change_pass">Alterar senha</a></li>
						<div class="create_content" id="pass">
							<form method="post" enctype="multipart/form-data">
								<input type="password" name="old_pass" placeholder="Senha atual"><br>
								<input type="password" name="new_pass" placeholder="Nova senha"><br>
								<?php 
									if(isset($_POST['send2'])):
										// sem falhas
										if(!empty($_POST['old_pass']) && !empty($_POST['new_pass'])):
											$old = filter_input(INPUT_POST, "old_pass", FILTER_SANITIZE_SPECIAL_CHARS);
											$new = filter_input(INPUT_POST, "new_pass", FILTER_SANITIZE_SPECIAL_CHARS);
											$old_pass = md5($old);
											$new_pass = md5($new);
											$stmt = $con->prepare("SELECT `password` FROM `administrators` WHERE `password` = ?");
											$stmt->execute(array($old_pass));
											if($stmt->rowCount() > 0):
												$upd = $con->prepare("UPDATE `administrators` SET `password` = ? WHERE `username` = ?");
												$upd->execute(array($new_pass, $username));
												echo "<p class='success'>Notícia criada</p>";
											else:
												echo '<p class="error">Senha atual incorreta</p>';
											endif;
										endif;
									endif;
								?>
								<input type="submit" name="send2" value="Enviar">
							</form>
						</div>
						<li><a href="#" class="change_user">Alterar nome de usuário</a></li>
						<div class="create_content" id="user">
							<form method="post" enctype="multipart/form-data">
								<input type="text" name="new_name" placeholder="Novo nome"><br>
								<?php 
									if(isset($_POST['send3'])):
										$new_name = filter_input(INPUT_POST, "new_name", FILTER_SANITIZE_SPECIAL_CHARS);
										if(!empty($new_name)):
											$upd2 = $con->prepare("UPDATE `administrators` SET `username` = ? WHERE `username` = ?");
											$upd2->execute(array($new_name, $username));
										else:
											echo '<p class="error">Senha atual incorreta</p>';
										endif;
									endif;
								?>
								<input type="submit" name="send3" value="Envar">
							</form>
						</div>
				</ul>
				<script type="text/javascript">
					$(document).ready(function(){
						$('.create_notice').click(function(){
							$('#notice').toggle("slow");
						});
						$('.change_pass').click(function(){
							$('#pass').toggle("slow");
						});
						$('.delete_notice').click(function(){
							$('#delete').toggle("slow");
						});
						$('.change_user').click(function(){
							$('#user').toggle("slow");
						});
					});
				</script>
				<ul class="right">
					<h2>Conta</h2>
					<li><a href="sair.php">Sair</a></li>
					<li><a href="../../index.php">Home</a></li>
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
<?php
endif;
?>