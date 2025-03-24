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
                <td name="id_sel" value="' . $row["insumo_id"] . '">' . $row["insumo_id"] . '</td>
                <td>' . $row['nome'] . '</td>
                <td>' . $row['unidade_medida'] . '</td>
                <td>' . number_format($row['custo_unitario'], 2, ',', '.') . '</td>
                <td>' . $row['estoque_atual'] . '</td>
                <td>' . date('d/m/Y', strtotime($row['data_validade'])) . "</td>
                <td>" . date('d/m/Y', strtotime($row['data_cadastro'])) . "</td>
                <td><button onclick='confirmarExclusao(" . $row['insumo_id'] . ")'>Excluir</button></td>
                <td><form method='POST' action='editar.php'>
                    <input hidden value='" . $row["insumo_id"] . "' name='id_sel'> 
                    <button type='submit'>edição</button>  
                    </form>
                </td>
            </tr>";
        }

       
     
    $stmt->close();
    $conn->close();



    mysqli_close($conn);
    ?>
       
       