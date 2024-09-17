<?php 
/**
*	@Author : Daniel Victor Freire Feitosa	
*	@Vesion : 3.0.0	
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>EHLab 3.0.0</title>
	<link rel="stylesheet" type="text/css" href="../css/login.css" async defer>
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
			<li><a href="#">Home</a></li>
			<li><a href="../notices/">Notícias</a></li>
			<?php 
				if(isset($_SESSION['login'])):
			?>
			<li class="default"><a href="home/">Painel</a></li>
			<?php 
				else:
			?>
			<li class="default"><a href="#">Login</a></li>
			<?php 
				endif;
			?>
			<li><a href="../desafios.php">Desafios</a></li>
		</ul>
	</nav>
	<section class="content">
		<div class="disclaimer">
			<h1>CGI Login</h1>
			<hr color="transparent" size="0">
			<div class="disclaimer_content">
			<center>
				<section class="login">
					<form method="post">
						<img src="https://cdn2.iconfinder.com/data/icons/user/512/user_login_man-512.png" width="150"><br>
						<input type="text" name="username" placeholder="Nome de usuário"><br>
						<input type="password" name="password" placeholder="**********"><br>
						<?php
						// Sem falhas de injection, somente bruteforce
							if(isset($_POST['env'])):
								$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
								$pass = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
								$password = md5($pass);
								$stmt = $con->prepare("SELECT * FROM `administrators` WHERE `username` = ? AND `password` = ? LIMIT 1");
								$stmt->execute(array($username, $password));
								if($stmt->rowCount() <= 0):
									echo '<p class="error">Login falhou</p>';
								else:
									session_start();
									$_SESSION['login'] = $username;
									header("Location: home/");
									echo '<script>document.location="home/"</script>';
								endif;
							endif;
						?>
						<input type="submit" name="env" value="Entrar">
						<code>&copy;Copyrights reserved</code>
					</form>
				</section>
			</center>
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