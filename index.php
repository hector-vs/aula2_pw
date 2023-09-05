<?php
    require_once './Database.php';
    $pdo = Database::conexao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade PW</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    ?>
    <header>
        <label for="nome">Cadastrar cliente:</label>
        <form method="post" action="insert.php">
            <input type="text" name="nome" id="nome" placeholder="Nome">
            <input type="email" name="email" id="email" placeholder="Email">
            <input class="enviar" type="submit" value="CADASTRAR">
        </form>
    </header>
    <nav>
        <h2>Pesquisar clientes</h2>
        <form method="POST" action="">
            <label for="nome_cliente">Nome: </label>
            <input type="text" id="nome_cliente" name="nome_cliente" placeholder="Digite o nome" value="<?php if(isset($dados['nome_cliente'])){ echo $dados['nome_cliente']; } ?>"><br><br>
            <input type="submit" name="pesqCliente" id="pesqCliente"><br><br>
        </form>
    </nav>
    <main>
    <?php
        if (!empty($dados['pesqCliente'])) {
            $nome = "%".$dados['nome_cliente']."%";
            $query_clientes = "SELECT id, nome, email FROM tb_cliente WHERE nome LIKE :nome ORDER BY id ASC";
            $result_clientes = $pdo->prepare($query_clientes);
            $result_clientes->bindParam(':nome', $nome, PDO::PARAM_STR);

            $result_clientes->execute();

            while ($row_cliente = $result_clientes->fetch(PDO::FETCH_ASSOC)) {
                extract($row_cliente);
                echo "ID: $id <br>";
                echo "Nome: $nome <br>";
                echo "E-mail: $email <br>";

                echo "<hr>";
            }
        }
    ?>
    </main>
    <div>
        <h2>Todos os clientes:</h2>
        <?php
            $query_clientes = "SELECT id, nome, email FROM tb_cliente ORDER BY id ASC";
            $result_clientes = $pdo->prepare($query_clientes);
            $result_clientes->execute();

            while ($row_cliente = $result_clientes->fetch(PDO::FETCH_ASSOC)) {
                extract($row_cliente);
                echo "ID: $id <br>";
                echo "Nome: $nome <br>";
                echo "E-mail: $email <br>";
                echo "<hr>";
            }
        ?>
    </div>
</body>
</html>