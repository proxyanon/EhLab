<?php 
/**
*	@Author : Daniel Victor Freire Feitosa	
*	@Vesion : 3.0.0	
*/
//ob_flush(); libera o cache para criação de sessões
define("host", "localhost"); // altere se necessário
define("user", "root"); // altere se necessário
define("password", ""); // altere se necessário
define("dbname", "ehlab3");
	try{
		$con = new PDO("mysql:host=".host.";dbname=".dbname, user, password);
		return $con;
	}catch(PDOException $e){
		return $e;
	}
?>