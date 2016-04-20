<?php

function __autoload($class_name) {
	$models = '../Models/';
	$controllers = '../Controllers/';
	if (file_exists($models.$class_name.'.php')){
		include $models.$class_name.'.php';
	}
	else
	if (file_exists($controllers.$class_name.'.php')) {
		include $controllers.$class_name.'.php';
	}
}

?>