<?php 
	$contents["content"] = (!is_null($content ?? null)) ? dirname(__FILE__,2)."/{$content}.php" : "";
	$contents["styles"]  = (!is_null($styles  ?? null)) ? dirname(__FILE__,2)."/{$styles}.php"  : "";
	$contents["scripts"] = (!is_null($scripts ?? null)) ? dirname(__FILE__,2)."/{$scripts}.php" : "";
	include dirname(__FILE__,2).'\layouts\layout.php'  
?>
