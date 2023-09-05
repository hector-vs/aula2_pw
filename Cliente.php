<?php
    require_once './Database.php';
    $pdo = Database::conexao();

    final class Cliente {
        public $nome;
        public $email;

        function cadCliente($pdo, $nome, $email){
            if(!empty($nome) || !empty($email)){
                $sql = "SELECT * FROM tb_cliente WHERE email = :email";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                if($stmt->rowCount() > 0){
                    echo("O Email digitado já foi cadastrado!");
                    echo("<meta http-equiv='refresh' content='1; index.php'>");

                }else{
                    try{
                        $sql = "INSERT INTO tb_cliente (nome, email) VALUES (:nome, :email)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':nome', $nome);
                        $stmt->bindParam(':email', $email);
                        if($stmt->execute()){ 
                            echo("Cliente cadastrado!");
                            echo("<meta http-equiv='refresh' content='1; index.php'>"); 
                        }else{
                            throw new Exception('Ocorreu um erro ao cadastrar cliente!');  
                        }
                    }catch(PDOException $e){
                        echo 'Error: '.$e->getMessage();
                    }
                }
            }else{
                echo "Preencha todos os campos!";
            }
        }
    }
?>