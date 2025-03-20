<?php
    $q = strval($_GET['q']);
    $t = 'insumo';

    include '../../serverside/config/dbConnection.php';

    $conn = dbConnection();

    $sql="SELECT * FROM $t WHERE nome LIKE '%".$q."%' ORDER BY nome ASC";
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_array($result)) {
        echo '<tr>
                <td>' . $row["insumo_id"] . '</td>
                <td>' . $row['nome'] . '</td>
                <td>' . $row['unidade_medida'] . '</td>
                <td>' . number_format($row['custo_unitario'], 2, ',', '.') . '</td>
                <td>' . $row['estoque_atual'] . '</td>
                <td>' . date('d/m/Y', strtotime($row['data_validade'])) . "</td>
                <td>" . date('d/m/Y', strtotime($row['data_cadastro'])) . "</td>
                <td><button onclick='confirmarExclusao(" . $row['insumo_id'] . ")'>Excluir</button></td>
                <td><button onclick='confirmarEdicao(". $row['insumo_id'] .")'>edição</button></td>
            </tr>";
        }

       
     
    $stmt->close();
    $conn->close();



    mysqli_close($conn);
    ?>
       
       