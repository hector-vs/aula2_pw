<?php
    require_once './Database.php';
    require 'Cliente.php';
    $pdo = Database::conexao();
    if(isset($_POST)){
        $cliente = new Cliente();
        $cliente->nome = $_POST['nome'];
        $cliente->email = $_POST['email'];

        $cliente->cadCliente($pdo, $cliente->nome, $cliente->email);
    }
?>