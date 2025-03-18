<?php
    $q = strval($_GET['q']);
    $c = 'data_venda';
    $t = strval($_GET['t']);

    include '../../../serverside/config/dbConnection.php';

    $conn = dbConnection();

if ($t == 'vendas') {

    $sql = "SELECT v.venda_id, v.data_venda, e.id_venda AS delivered 
        FROM $t v 
        LEFT JOIN entregas e ON v.venda_id = e.id_venda
        WHERE v.$c LIKE ? 
        ORDER BY v.venda_id DESC LIMIT 30";

    $stmt = $conn->prepare($sql);
    $searchTerm = "%".$q."%";
    $stmt->bind_param("s", $searchTerm); // Binding parameter for prepared statement
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<div class="table_header">
            <a style="width:15%">ID</a>
            <a style="width:25%">DATA DE VENDA</a>
            <a style="width:25%">DATA ESTIMADA</a>
            <a style="width:20%">OPÇÃO</a>
          </div>';
    echo '<hr style="height:4px;background-color:black">';

    while($row = mysqli_fetch_array($result)) {
        if ($row['delivered']) {
            $sett = "<button type='submit' style='background-color:rgb(104, 104, 104);min-width:20%;' disabled>ENTREGUE</button><hr>";
        } else {
            $sett = "<button type='submit' style='background-color:rgb(141, 82, 40);min-width:20%;'>ENTREGUE</button><hr>";
        }

        $date = new DateTime($row['data_venda']);
        $date->modify('+10 days');
        $estimatedDate = $date->format('Y-m-d');

        echo "<form class='itens_shown' action='entregas.php' method='post' style='width:100%;'>
                <input type='number' name='id' style='width:12%;overflow:hidden;' readonly value='" . $row['venda_id'] . "'>
                <input name='data' style='width:27%;overflow:hidden;' readonly value='" . $row['data_venda'] . "'>
                <input name='data_estimada' style='width:27%;overflow:hidden;' readonly value='" . $estimatedDate . "'>
                $sett
              </form>";
    }
} else if ($t == 'entregas') {
    $sql = "SELECT * FROM $t WHERE $c LIKE ? ORDER BY id_entrega DESC LIMIT 30";

    $stmt = $conn->prepare($sql);
    $searchTerm = "%".$q."%";
    $stmt->bind_param("s", $searchTerm); // Binding parameter for prepared statement
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<div class="table_header">
            <a style="width:15%">ID</a>
            <a style="width:25%">DATA DE VENDA</a>
            <a style="width:25%">DATA DE ENTREGA</a>
            <a style="width:20%">OPÇÃO</a>
          </div>';
    echo '<hr style="height:4px;background-color:black">';

    while($row = mysqli_fetch_array($result)) {
        echo "<form class='itens_shown' action='entregas_del.php' method='post' style='width:100%;'>
                <input type='number' name='id' style='width:12%;overflow:hidden;' readonly value='" . $row['id_venda'] . "'>
                <input style='width:27%;overflow:hidden;' readonly value='" . $row['data_venda'] . "'>
                <input style='width:27%;overflow:hidden;' readonly value='" . $row['data_entrega'] . "'>
                <button type='submit' style='background-color:#d9534f;min-width:20%;'>REVERTER</button><hr>
              </form>";
    }
}

    $stmt->close();
    $conn->close();

    mysqli_close($conn);