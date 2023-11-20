<?php

spl_autoload_register(function($classname){
	$filename = 'class'.DIRECTORY_SEPARATOR.$classname.'.php';
	if(file_exists($filename)){
		require_once($filename);
	}else{
		echo 'classe nao existe';
		
	}		

});





?>