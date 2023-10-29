<?php 
$usuario = 'root';
$senha = '';
$database = 'login';
$host = 'localhost';

//conecta ao banco de dados
$mysqli = new mysqli($host, $usuario, $senha, $database);

//se a conexao der errado, 'mata' a execucao e retorna uma mensagem de erro
if ($mysqli -> error){
    die('Falha ao conectar ao banco de dados: ' .$mysqli->error);
}