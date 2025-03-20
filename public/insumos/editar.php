<?php
  include '../../serverside/queries/db_queries.php';
  include '../../serverside/config/dbConnection.php';
  include '../../includes/main-sidebar.php';

  $conn = dbConnection();
  
  $id = $_GET['id'];
  $nome = $_GET['nome'];
  $unidade_medida = $_GET['unidade_medida'];
  $custo_unitario = $_GET['custo_unitario'];
  $estoque_atual = $_GET['estoque_atual'];
  $data_validade = $_GET['data_validade'];
  $data_cadastro = $_GET['data_cadastro'];

  // Exemplo de como preencher um formulário de edição:
?> 


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/main.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php include('../../includes/main-sidebar.php'); ?>
    <?php include('../../includes/topbar.php'); ?>

    <main class="content">
        <div class="navbar" id="navbar"></div>
        <br>

        
        
    <form action="conexao_e.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>" required><br>

        <label for="unidade_medida">Unidade de Medida:</label>
        <input type="text" name="unidade_medida" value="<?php echo $unidade_medida; ?>" required><br>

        <label for="custo_unitario">Custo Unitário:</label>
        <input type="text" name="custo_unitario" value="<?php echo $custo_unitario; ?>" required><br>

        <label for="estoque_atual">Estoque Atual:</label>
        <input type="text" name="estoque_atual" value="<?php echo $estoque_atual; ?>" required><br>

        <label for="data_validade">Data de Validade:</label>
        <input type="text" name="data_validade" value="<?php echo $data_validade; ?>" required><br>

        <label for="data_cadastro">Data de Cadastro:</label>
        <input type="text" name="data_cadastro" value="<?php echo $data_cadastro; ?>" required><br>

        <button type="submit">Salvar alterações</button>
    </form>

        
        
<script>
    
</script>