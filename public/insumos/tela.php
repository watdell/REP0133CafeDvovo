<?php
  include '../../serverside/queries/db_queries.php';
  include '../../serverside/config/dbConnection.php';
  include '../../includes/main-sidebar.php';

  $conn = dbConnection();
    
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
        <button onclick="abrirmodal()">Gerenciar insumos</button>
        <div id="crudModal" class="modal">

            <div class="modal-content">
                <span onclick="fecharModal()" style="cursor:pointer; float:right;">&times;</span>
                <h2>Adicionar Insumo</h2>
                <form method="POST" action="conexao.php">
                    <label>Nome:</label>
                    <input type="text" name="nome" required><br><br>

                    <label>Unidade de Medida:</label>
                    <input type="text" name="unidade_medida" required><br><br>

                    <label>Custo Unitário (R$):</label>
                    <input type="number" step="0.01" name="custo_unitario" required><br><br>

                    <label>Estoque Atual:</label>
                    <input type="number" name="estoque_atual" required><br><br>

                    <label>Data de Validade:</label>
                    <input type="date" name="data_validade" required><br><br>

                    <button type="submit" name="action" value="create">Adicionar</button>
                </form>
            </div>
        </div>
        

        <?php
            $sql = "SELECT * FROM insumo";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1' cellspacing='0' cellpadding='8'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Unidade de Medida</th>
                                <th>Custo Unitário (R$)</th>
                                <th>Estoque Atual</th>
                                <th>Data de Validade</th>
                                <th>Data de Cadastro</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>";
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['insumo_id']}</td>
                            <td>{$row['nome']}</td>
                            <td>{$row['unidade_medida']}</td>
                            <td>" . number_format($row['custo_unitario'], 2, ',', '.') . "</td>
                            <td>{$row['estoque_atual']}</td>
                            <td>" . date('d/m/Y', strtotime($row['data_validade'])) . "</td>
                            <td>" . date('d/m/Y', strtotime($row['data_cadastro'])) . "</td>
                            <td><button onclick='confirmarExclusao({$row['insumo_id']})'>Excluir</button></td>
                          </tr>";
                }
            
                echo "</tbody></table>";
            } else {
                echo "<p>Nenhum resultado encontrado.</p>";
            }
        ?>
        <script>
    function abrirmodal() {
        document.getElementById("crudModal").style.display = "block";
    }

    function fecharModal() {
        document.getElementById("crudModal").style.display = "none";
    }
    function confirmarExclusao(id) {
            if (confirm("Tem certeza que deseja excluir este insumo?")) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'conexcao_d.php'; // Defina a URL de destino para o mesmo arquivo ou outro.

                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'insumo_id';
                input.value = id;
                form.appendChild(input);

                var actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'delete';
                form.appendChild(actionInput);

                document.body.appendChild(form);
                form.submit();
            }
        }
</script>
  