<?php
        
        // constantes com as credenciais de acesso ao banco MySQL
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'basebdr');
        define('DB_USER', 'user');
        define('DB_PASS', 'senha');

	//Criar a conexao
	$conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
	
	if(!$conn){
		die("Falha na conexao: " . mysqli_connect_error());
	}else{
		//echo "Conexao realizada com sucesso";
	}	
	
?>

