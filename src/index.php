<?php
	session_start();
	$DS = DIRECTORY_SEPARATOR;
	require_once (__DIR__ . $DS . 'lib' . $DS . 'File.php'); 
	//require_once "{$DS}home{$DS}ann2{$DS}cadieuxt{$DS}public_html{$DS}PHP{$DS}TD5{$DS}lib{$DS}File.php";
	require_once (File::build_path(array('controller','routeur.php')));

?>