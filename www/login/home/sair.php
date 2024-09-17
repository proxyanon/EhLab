<?php 
unset($_SESSION['login']);
@session_start();
session_destroy();
header("Location: ../../index.php");
echo '<script>document.location="../../index.php"</script>';
?>