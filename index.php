<?php

	// include cuaca.php
	require("cuaca.php");
	
	// call function cuaca
	$cuaca = cuaca(); // return array print_r($cuaca);
	
	// JSON
	header('Content-Type: application/json');
	
	// mengijinkan semua host/domain/ip untuk menggunakan data JSON ini bila menggunakan AJAX
	// atau rubah tanda * menjadi domain yg di tentukan
	header('Access-Control-Allow-Origin: *');
	
	// convert array to JSON
	echo json_encode($cuaca, JSON_PRETTY_PRINT);
	
?>
