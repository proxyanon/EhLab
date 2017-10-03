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
	<title>EhLab 3</title>
	<link rel="stylesheet" type="text/css" href="css/index.css" async defer>
</head>
<body>
<?php
	include_once("config/database.conn.php");
	if(isset($e)):
?>
<!-- Código da página de instalação -->
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
			<li class="default"><a href="#">Instalação</a></li>
		</ul>
	</nav>
	<section class="content">
			<div class="disclaimer">
				<h1>Instalação</h1>
				<hr color="transparent" size="0">
				<div class="disclaimer_content">
					<ul>
						<h2>Requerimentos</h2>
							<li><p>PHP 5.X.X/7.X.X</p></li>
							<li><p>MySQL 5.X.X</p></li>
						<br>
						<h2>Possíveis alterações</h2>
							<li><p>Usuário : root</p></li>
							<li><p>Senha : </p></li>
							<li><p>Host : localhost</p></li>
						<br>
						<h2>Termos</h2>
							<li style="list-style: none;">
								<textarea disabled>Aceitando os termos, você concorda que todo conhecimento adquirido com utilização do laborátorio é de sua total responsabilidade, eximindo os seus criadores de quaisquer danos causados por tais saberes.</textarea><br><br>
								<form method="post">
									<input type="checkbox" name="accept" value="accept"><span>Aceitar termos</span><br>
									<input type="submit" name="install" value="Instalar">
									<?php 
										if (isset($_POST['install'])) {
											$accept = filter_input(INPUT_POST, "accept", FILTER_SANITIZE_SPECIAL_CHARS);
											if(!empty($accept)):
												if($accept == "accept"):
													echo '<script>document.location="config/install.php";</script>';
												else:
													echo '<script>alert("Você precisa aceitar os termos de instalação")</script>';
												endif;
											else:
												echo '<script>alert("Você precisa aceitar os termos de instalação")</script>';
											endif;
										}
									?>
								</form>
							</li>
					</ul>
				</div>
			</div>
	</section>
</section>
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
			<li class="default"><a href="#">Home</a></li>
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
			<li><a href="desafios.php">Desafios</a></li>
		</ul>
	</nav>
	<section class="content">
		<div class="disclaimer">
			<h1>Bem-vindo(a)</h1>
			<hr color="transparent" size="0">
			<div class="disclaimer_content">
				<ul>
					<h2>Disclaimer</h2>
						<li><p>O EHLab (Ethical Hacker Laboratory) é uma plataforma livre, de código aberto, e foi desenvolvida com objetivo de ajudar a inciantes ou amantes da área de pentesting.</p></li>
					<h2>Tecnologias</h2>
						<li><p>PHP</p></li>
						<li><p>MySQL</p></li>
						<li><p>Html/Css/JavaScript</p></li>
					<h2>O que fazer ?</h2>
						<li><p>Descubra as falhas na programação das páginas e tente explora-las, com objetivo de completar os desafios e pontuar o score máximo.</p></li>
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