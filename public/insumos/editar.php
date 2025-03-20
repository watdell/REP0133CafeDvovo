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

        <input type="search" id="search" onchange="search('searchbody')"></input>
        
        <table border="1" cellspacing='0' cellpadding='8'>
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Unidade de Medida</th>
                <th>Custo Unitário (R$)</th>
                <th>Estoque Atual</th>
                <th>Data de Validade</th>
                                <th>Data de Cadastro</th>
                                <th>Excluir</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
        <tbody id='searchbody'></tbody></table>

        

        <?php
            /*$sql = "SELECT * FROM insumo";
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
                                <th>Excluir</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody id='searchbody'>TEST";
                
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
                            <td><button onclick='editarInsumo({$row['insumo_id']})'>Editar</button></td>
                          </tr>";
                }
                          
            
                echo "</tbody></table>";
            } else {
                echo "<p>Nenhum resultado encontrado.</p>";
            }*/
        ?>
    </main>
        <script src="insumos.js"></script>
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
    search('searchbody');
</script>

  