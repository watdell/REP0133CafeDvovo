<?php
    $q = strval($_GET['q']);
    $c = strval($_GET['c']);
    $t = strval($_GET['t']);
    $d = strval($_GET['d']);
    $p = strval($_GET['p']);

    include '../../../serverside/config/dbConnection.php';

    $conn = dbConnection();

    if ($c == 'id') {
        $c = 'id' . substr($t, 0, -1);
    }

    $order = 'id' . substr($t, 0, -1);

    $sql="SELECT * FROM $t WHERE $c LIKE '%".$q."%' ORDER BY " . $order . " DESC LIMIT 30";
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($t == 'entradas') {

        echo '<div class="table_header">
        <a style="width:20%">ID</a>
        <a style="width:20%">descrição</a>
        <a style="width:20%">valor</a>
        <a style="width:20%">data</a>';
        if ($d != 'innertable' and $p != 'caixa') {
            echo '<a style="width:7%">DEL</a>';
        };
        echo '</div><hr style="height:4px;background-color:black"><br>';

        while($row = mysqli_fetch_array($result)) {
            echo "<div class='itens_shown'>
                <a style='width:20%;overflow:hidden;'>" . $row['identrada'] . "</a>
                <a style='width:20%;overflow:hidden;'>" . $row['descricao'] . "</a>
                <a style='width:20%;overflow:hidden;'>" . $row['valor'] . "</a>
                <a style='width:20%;overflow:hidden;'>" . $row['data'] . "</a>";

                if ($d != 'innertable' and $p != 'caixa') {
                    echo "<form id='field' action='entradas_del.php' method='post'>
                        <input type='hidden' name='id' value=" . $row["identrada"] . ">
                        <button type='submit'>X</button></form>";
                };
                echo "</div><hr>";
            }

    } else if ($t == 'despesas') {

        echo '<div class="table_header">
        <a style="width:19%">ID</a>
        <a style="width:19%">categoria</a>
        <a style="width:19%">descricao</a>
        <a style="width:19%">valor</a>
        <a style="width:19%">data</a>';
        if ($d != 'innertable') {
            echo '<a style="width:7%">DEL</a>';
        };
        echo '</div><hr style="height:4px;background-color:black"><br>';

        while($row = mysqli_fetch_array($result)) {
            echo "<div class='itens_shown'>
                <a style='width:20%;overflow:hidden;'>" . $row['iddespesa'] . "</a>
                <a style='width:20%;overflow:hidden;'>" . $row['categoria'] . "</a>
                <a style='width:20%;overflow:hidden;'>" . $row['descricao'] . "</a>
                <a style='width:20%;overflow:hidden;'>" . $row['valor'] . "</a>
                <a style='width:20%;overflow:hidden;'>" . $row['data'] . "</a>";

                if ($d != 'innertable') {
                    echo "<form id='field' action='despesas_del.php' method='post'>
                        <input type='hidden' name='id' value=" . $row["iddespesa"] . ">
                        <button type='submit'>X</button></form>";
                };
                echo "</div><hr>";
            }
    }

    if ($d == 'innertable2') {
        echo "<br><hr style='height:4px;background-color:black'><br>";
    
        $sql = "
        SELECT 
            iv.venda_id, 
            iv.produto, 
            p.nome AS produto_nome, 
            v.total, 
            v.data_venda
        FROM 
            itens_venda iv
        JOIN 
            produto p ON p.produto_id = iv.produto
        JOIN 
            vendas v ON v.venda_id = iv.venda_id
        WHERE
            p.nome
        LIKE
            '%" . $q . "%'
        ORDER BY
            iv.venda_id DESC
        LIMIT
            30
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    // Create an associative array to store venda_id groups
    $vendas = [];

    // Fetch rows and group them by venda_id
    while ($row = $result->fetch_assoc()) {
        // If this venda_id is not already in the array, initialize it
        if (!isset($vendas[$row['venda_id']])) {
            $vendas[$row['venda_id']] = [
                'venda_id' => $row['venda_id'],
                'total' => $row['total'],
                'data_venda' => $row['data_venda'],
                'produtos' => []  // Initialize an empty array to store products for this venda_id
            ];
        }

        // Add the product info to the venda_id group
        $vendas[$row['venda_id']]['produtos'][] = $row['produto_nome'];
    }

    // Now iterate over the grouped data and display it
    foreach ($vendas as $venda) {
        echo "<div class='itens_shown'>
            <a style='width:20%;overflow:hidden;'>" . $venda['venda_id'] . "</a>
            <a style='width:20%;overflow:hidden;'>" . implode("<br>", $venda['produtos']) . "</a>
            <a style='width:20%;overflow:hidden;'>" . $venda['total'] . "</a>
            <a style='width:20%;overflow:hidden;'>" . $venda['data_venda'] . "</a>
        </div><hr>";
    }
}

    $stmt->close();
    $conn->close();

    mysqli_close($conn);