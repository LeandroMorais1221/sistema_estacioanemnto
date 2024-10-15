<?php
try{
    $conexao = new mysqli("localhost","root","", "dbestacionamento");
}
catch(Exception $e){
    die("Erro ao efetuar conexão com o banco de dados " . $e);
}

?>