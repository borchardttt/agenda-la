<?php

$config = require 'config/database.php';

try {
	$dsn = "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}";
	$pdo = new PDO($dsn, $config['username'], $config['password']);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Definir modo de erro
	echo "Conexão estabelecida com sucesso!";
} catch (PDOException $e) {
	echo "Erro de conexão: " . $e->getMessage();
}
