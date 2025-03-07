<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <style>
        
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        background-color: #f9f4e7; 
        color: #5c3e20; 
        line-height: 1.6;
        padding: 20px;
    }
    h1 {
        font-size: 32px; /* Tamanho grande para destaque */
        font-weight: bold; /* Negrito para chamar atenção */
        color: #5c3e20; /* Cor marrom escura */
        text-align: center; /* Centralizado para um design equilibrado */
        margin-bottom: 20px; /* Espaçamento inferior */
        text-transform: uppercase; /* Todas as letras em maiúsculo */
        
    }
    
    
    form {
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 20px;
        border-radius: 8px;
        background-color: #f9f4e7;
        border: 1px solid #dcd2b0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    label {
        font-size: 14px;
        font-weight: bold;
        color: #5c3e20;
        margin-bottom: 8px;
    }

    
    form input, select, textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        margin-bottom: 15px;
        background-color: #fff; 
        box-sizing: border-box;
    }

    textarea {
        height: 80px;
        resize: none; 
    }

    
    form input:focus, select:focus, textarea:focus {
        border-color: #5c3e20;
        outline: none;
        box-shadow: 0 0 4px rgba(92, 62, 32, 0.3); /* Sombra suave */
    }

    
    form button {
        padding: 10px 15px;
        background-color: #5c3e20; /* Botão marrom escuro */
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    form button:hover {
        background-color: #4a3217; /* Cor mais escura ao passar o mouse */
    }

    
    .info {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .info h3 {
        font-size: 16px;
        font-weight: bold;
        color: #5c3e20;
        margin-bottom: 5px;
    }
</style>

    </style>
</head>

<body>
    <?php include('../../../includes/main-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>

    <?php
        include('../../../serverside/config/dbConnection.php');
        $conn = dbConnection();

        $id = intval($_GET['id']);
        $sql = "SELECT * FROM servicos WHERE id_servicos=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $results = $stmt->get_result();
        echo "";
    ?>
    <div class="content">
        <h1>Atualizar Informações</h1>
        <form action="processar_atualizacao_servicos.php" method="post">
            <div class="ids info">
                <h3>ids</h3>
                <?php while ($row = $results->fetch_assoc()) { ?>
                    <input name="id" readonly value="<?php echo $row['id_servicos']; ?>">
                <?php }; ?>
            </div>

            <div class="tipo_s info">
                <h3>Tipos de Serviço</h3>
                <?php foreach ($results as $row) : ?>
                    <input name="tipo" value="<?php echo htmlspecialchars($row['tipo_servico']); ?>">
                <?php endforeach; ?>
            </div>

            <div class="preco_u info">
                <h3>Preços</h3>
                <?php foreach ($results as $row) : ?>
                    <input name="preco" value="<?php echo htmlspecialchars($row['preco']); ?>">
                <?php endforeach; ?>
            </div>

            <div class="precificacao_s info">
                <h3>Precificação</h3>
                <?php foreach ($results as $row) : ?>
                    <input name="precificacao" value="<?php echo htmlspecialchars($row['precificacao']); ?>">
                <?php endforeach; ?>
            </div>

            <button type="submit">atualizar</button>
            <button type="button" onclick="cancelar1()">Cancelar</button>
        </form>
    </div>
    <script>
        function cancelar1() {
            window.location.href = "servicos_home.php";
        }
    </script>
</body>

</html>
