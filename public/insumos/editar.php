<?php
  include '../../serverside/queries/db_queries.php';
  include '../../serverside/config/dbConnection.php';
  include '../../includes/main-sidebar.php';

  $conn = dbConnection();
  
  $id = $_POST['id_sel'];

  $sql="SELECT * FROM insumo WHERE insumo_id = $id";
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_array($result)) {
        $nome = $row['nome'];
        $unidade_medida= $row['unidade_medida'];
        $custo_unitario= $row['custo_unitario'];
        $estoque_atual= $row['estoque_atual'];
        $data_validade= $row ['data_validade'];
        };



  // Exemplo de como preencher um formulário de edição:
?> 


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/insumos/style.css?v=<?php echo time(); ?>">
    <title>Editar Insumo</title>
</head>
<body>
    <?php include('../../includes/main-sidebar.php'); ?>
    <?php include('../../includes/topbar.php'); ?>

    <main class="content">
        <!-- Cadastrar um insumo -->
        <div class='table edit-input'>
            <form action="conexao_e.php" method="POST">
            <input type="text" hidden name="id" value="<?php echo $id; ?>" required><br>

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

                <button id="submit" type="submit">Salvar alterações</button>
            </form>
        </div>
    </main>
</body>
</html>