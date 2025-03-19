<?php
    include '../../serverside/queries/db_queries.php';
    include '../../serverside/config/dbConnection.php';
    include '../../includes/main-sidebar.php';

    $conn = dbConnection();

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }
?>

<!DOCTYPE html>
<html lang="en">
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
                          </tr>";
                }
            
                echo "</tbody></table>";
            } else {
                echo "<p>Nenhum resultado encontrado.</p>";
            }
        ?>
    </main>
</body>