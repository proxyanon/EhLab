<?php
/*
*	@version : 3.0.0
*	Instalação expressa EHLab 3.0.0
*/
$passwd_admin = md5(rand()); // gera uma senha aleatória para o usuário administrador
$host = "localhost";$user = "root";$pass = ""; // altere se necessário
$con = new PDO("mysql:host=".$host.";dbname=", $user, $pass);
$stmt = $con->prepare("CREATE DATABASE ehlab3");
$stmt->execute();
$stmt = $con->prepare("USE ehlab3");
$stmt->execute();
$stmt = $con->prepare("CREATE TABLE administrators (id int(11) NOT NULL,username varchar(155) NOT NULL,password varchar(200) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");
$stmt->execute();
$stmt = $con->prepare("INSERT INTO administrators (id, username, password) VALUES (1, 'administrator', '".$passwd_admin."')");
$stmt->execute();
$stmt = $con->prepare("CREATE TABLE notices (id int(11) NOT NULL,notice mediumtext NOT NULL,img varchar(155) NOT NULL,title varchar(155) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");
$stmt->execute();
$stmt = $con->prepare("INSERT INTO notices (id, notice, img, title) VALUES (1, 'Cicada 3301 &eacute; um nome dado a uma organiza&ccedil;&atilde;o enigm&aacute;tica que, em seis ocasi&otilde;es, postou um conjunto de quebra-cabe&ccedil;as e jogos de realidade alternativa complexos para possivelmente recrutar decifradores de c&oacute;digos do p&uacute;blico.\r\n<br><br>\r\nO primeiro quebra-cabe&ccedil;a da internet come&ccedil;ou em 4 de janeiro de 2012 e durou por aproximadamente um m&ecirc;s.', 'img/cicada.png', 'Cicada 3301'), (2, 'Criptografia &eacute; o estudo dos princ&iacute;pios e t&eacute;cnicas pelas quais a informa&ccedil;&atilde;o pode ser transformada da sua forma original para outra ileg&iacute;vel, de forma que possa ser conhecida apenas por seu destinat&aacute;rio o que a torna dif&iacute;cil de ser lida por algu&eacute;m n&atilde;o autorizado. \r\n<br><br>\r\n&Eacute; um ramo da Matem&aacute;tica, parte da Criptologia. H&aacute; dois tipos de chaves criptogr&aacute;ficas: chaves sim&eacute;tricas (criptografia de chave &uacute;nica) e chaves assim&eacute;tricas (criptografia de chave p&uacute;blica).', 'img/cript.png', 'Criptografia')");
$stmt->execute();
$stmt = $con->prepare("CREATE TABLE score (id int(11) NOT NULL,pass int(11) NOT NULL,file int(11) NOT NULL,true_f int(11) NOT NULL, firewall int(11) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");
$stmt->execute();
$stmt = $con->prepare("INSERT INTO score (id, pass, file, true_f) VALUES (1, 0, 0, 0)");
$stmt->execute();
$stmt = $con->prepare("ALTER TABLE administrators ADD PRIMARY KEY (id)");
$stmt->execute();
$stmt = $con->prepare("ALTER TABLE notices ADD PRIMARY KEY (id)");
$stmt->execute();
$stmt = $con->prepare("ALTER TABLE score ADD PRIMARY KEY (id)");
$stmt->execute();
$stmt = $con->prepare("ALTER TABLE administrators MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2");
$stmt->execute();
$stmt = $con->prepare("ALTER TABLE notices MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13");
$stmt->execute();
$stmt = $con->prepare("ALTER TABLE score MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2");
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Instalando EhLab 3</title>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css?family=Roboto');
		*{padding: 0px;box-sizing: border-box;margin:0px;}
		body{width: 100%;height: 100%;background-color: black;background-image: url('bg.gif');background-size: 100%;}
		section.success{position: absolute;width: 100%;padding: 8px;top: 25%;text-align: center;background-color: rgba(0,0,0,.85);z-index: 99;padding-bottom: 40px;padding-top: 20px;}
		section.success h1 {font-family: arial, sans-serif;font-weight: normal;color: white;font-size: 2em;}
		section.success a{text-decoration: none;padding: 8px;background-color: orange;border-radius: 5px;color: white;font-weight: normal;font-family: arial;font-weight: bold;}
		section.success p {font-family: 'Roboto', sans-serif;color: white;font-size: 14px;position: relative;top: 10px;}
	</style>
</head>
<body>
<section class="success">
	<h1>Instalação concluída</h1>
	<p>É hora de raciocinar e resolver os desafios</p><br><br>
	<a href="../index.php">EhLab 3</a>
</section>
</body>
</html>
