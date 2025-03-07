<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <style>
        
        h1 {
            font-size: 32px; /* Tamanho grande para destaque */
            font-weight: bold; /* Negrito para chamar atenção */
            color: #5c3e20; /* Cor marrom escura */
            text-align: center; /* Centralizado para um design equilibrado */
            margin-bottom: 20px; /* Espaçamento inferior */
            text-transform: uppercase; /* Todas as letras em maiúsculo */
            
        }
       
        form {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr 1fr 0.5fr 0.5fr; /* Define as colunas em proporções */
            row-gap: 20px; /* Espaçamento vertical entre linhas */
            column-gap: 10px; /* Espaçamento horizontal entre colunas */
            padding: 40px; /* Espaçamento interno do formulário */
            background-color: #f9f9f9;
            border: 5px solid #ddd;
            border-radius: 8px;
            text-align: center;
        }

        form p {
            margin: 10px 0; /* Adiciona espaçamento entre os itens de cada coluna */
        }
        
        /* Botões */
        button {
            width: 100%; /* Ajusta o tamanho do botão ao tamanho da célula */
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 0px;
            font-size: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        

        button:hover {
            background-color: #0056b3;
        }

        /* Botões específicos */
        button[name="deletar"] {
            background-color: #dc3545;
        }

        button[name="deletar"]:hover {
            background-color: #c82333;
        }

        button#atualizar {
            background-color: #28a745;
        }

        button#atualizar:hover {
            background-color: #218838;
        }

        .botoes {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .botoes {
        display: flex;
        flex-direction: column; /* Coloca os itens em coluna */
        gap: 10px; /* Espaçamento entre os botões */
        align-items: flex-start; /* Alinha os botões à esquerda (opcional) */
        }

    .botoes button {
        background-color: #5c3e20; /* Cor de fundo personalizada */
        color: #fff; /* Cor do texto */
        border: none;
        border-radius: 4px;
        font-size: 14px;
        padding: 10px;
        cursor: pointer;
        width: 100%; /* Faz o botão ocupar toda a largura disponível */
        transition: background-color 0.3s ease;
        }

    .botoes button:hover {
        background-color: #4a3221; /* Cor ao passar o mouse */
    }
    </style>
</head>

<body>
    <?php include('../../../includes/main-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>

    <?php
    include('../../../serverside/config/dbConnection.php');
    $conn = dbConnection();

    $sql = "SELECT * FROM servicos;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    ?>
    <div class="content">
        <h1>Serviços já cadastrados:</h1>
        <form action="deletar_servicos.php" method="post">
            <div class="ids info">
                <h3>IDs</h3>
                <?php while ($row = $results->fetch_assoc()) { ?>
                    <p><?php echo $row['id_servicos']; ?></p>
                <?php }; ?>
            </div>

            <div class="tipo_s info">
                <h3>Tipos de Serviço</h3>
                <?php foreach ($results as $row) : ?>
                    <p><?php echo htmlspecialchars($row['tipo_servico']); ?></p>
                <?php endforeach; ?>
            </div>

            <div class="preco_u info">
                <h3>Preços</h3>
                <?php foreach ($results as $row) : ?>
                    <p><?php echo htmlspecialchars($row['preco']); ?></p>
                <?php endforeach; ?>
            </div>

            <div class="precificacao_s info">
                <h3>Precificação</h3>
                <?php foreach ($results as $row) : ?>
                    <p><?php echo htmlspecialchars($row['precificacao']); ?></p>
                <?php endforeach; ?>
            </div>

            <div class="info">
                <h3>Deletar</h3>
                <?php foreach ($results as $row) : ?>
                    <p><button type="button" onclick="confirmar1(this)" name="deletar" value="<?php echo htmlspecialchars($row['id_servicos']); ?>">X</button></p>
                <?php endforeach; ?>
            </div>
            <div class="info">
                <h3>Editar</h3>
                <?php foreach ($results as $row) : ?>
                    <p><button type="button" onclick="confirmar2(this)" id="atualizar" value="<?php echo htmlspecialchars($row['id_servicos']); ?>">Edit</button></p>
                <?php endforeach; ?>
            </div>
        </form>
    <div class="botoes">
        <button type="button" onclick="redirecionar()">Cadastrar Novo Serviço</button>
        <button type="button" onclick="home()">Voltar</button>
    </div>
    </div>

    <script>
        function home() {
            window.location.href = "../../comercial/index.php";
        }

        function redirecionar() {
            window.location.href = 'cadastro_serviço.php';
        }

        function confirmar1(btn) {
            console.log(btn.value);
            if (confirm("Deseja deletar?")) {
                window.location.href = "deletar_servicos.php?id=" + btn.value;
            }
        }

        function confirmar2(btn) {
            console.log(btn.value);
            if (confirm("Deseja atualizar?")) {
                window.location.href = "atualizar_servicos.php?id=" + btn.value;
            }
        }
    </script>
</body>

</html>
