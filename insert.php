<?php
    include("conexao.php");

    if(isset($_POST)){
        $data = [
            "nome"=> $_POST['nome'],
            "email"=> $_POST['email'],
        ];
        $sql = "INSERT INTO tb_cliente (nome, email) VALUES (:nome, :email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindparam(":nome", $_POST['nome']);
        $stmt->bindparam(":email", $_POST['email']);
        $stmt->execute();

        if($stmt){
            echo("Cliente cadastrado com sucesso!!!");
            echo("<meta http-equiv='refresh' content='1; index.php'>");
        }else{
            echo("Erro ao cadastrar cliente!!!");
        }
    }
?>