<?php
    $q = strval($_GET['q']);
    $c = 'data_venda';
    $t = 'vendas';

    include '../../../serverside/config/dbConnection.php';

    $conn = dbConnection();

    function DateMod($mod,$vencDate) {
        $vencDate->modify($mod);
        return $vencDate->format('Y-m-d H:i:s');
    };

    $sql="SELECT * FROM $t WHERE $c LIKE '%".$q."%' ORDER BY venda_id DESC LIMIT 30";
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($t == 'vendas') {

        echo '<div class="table_header">
        <a  style="width:15%">ID</a>
        <a  style="width:25%">DATA DE VENDA</a>
        <a  style="width:25%">DATA ESTIMADA</a>
        <a  style="width:20%">OPT</a>
        </div>';
        echo '<hr style="height:4px;background-color:black">';

        while($row = mysqli_fetch_array($result)) {
            echo "<form class='itens_shown' action='entregas.php' method='post' style='width:100%;'>
                    <input type='number' name='id' style='width:12%;overflow:hidden;' readonly value=" . $row['venda_id'] ."></input>
                    <input name='data' style='width:27%;overflow:hidden;' readonly value='" . $row['data_venda'] ."'></input>
                    <input name='data' style='width:27%;overflow:hidden;' readonly value='" . DateMod('+3 day',new DateTime($row['data_venda'])) ."'></input>
                    <button type='submit' style='background-color:rgb(141, 82, 40);min-width:20%;'>ENTREGUE</button>
                </form><hr>";
        }
    }

    $stmt->close();
    $conn->close();

    mysqli_close($conn);