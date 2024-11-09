<?php

$dns = 'mysql:host=localhost;dbname=sflbanco';
$user = 'root';
$pass = '';

try{
    $conexao = new PDO($dns,$user,$pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");    
} catch (Exception $e) {
    echo 'Falha na conexao ..'.$e.getMessage();
}



return $conexao;