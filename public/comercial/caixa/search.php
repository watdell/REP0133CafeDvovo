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
        echo '</div><hr style="height:4px;background-color:black">';

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
        echo '</div><hr style="height:4px;background-color:black">';

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
        echo "<br><a style='font-size:1.5rem;color:#5a3e2b;'>Vendas</a><br>";

        echo '<hr style="height:4px;background-color:black">';
    
        // Query for records where cliente_id is NOT an email (linked to itens_venda)
$sql1 = "
SELECT 
    iv.venda_id, 
    iv.produto, 
    p.nome AS produto_nome, 
    v.total, 
    v.cliente_id, 
    v.data_venda
FROM 
    itens_venda iv
JOIN 
    produto p ON p.produto_id = iv.produto
JOIN 
    vendas v ON v.venda_id = iv.venda_id
WHERE
    p.nome LIKE ? 
    AND v.cliente_id NOT LIKE '%@%'
ORDER BY
    iv.venda_id DESC
LIMIT 80
";

$stmt1 = $conn->prepare($sql1);
$searchQuery = "%$q%";
$stmt1->bind_param("s", $searchQuery);
$stmt1->execute();
$result1 = $stmt1->get_result();

// Group sales by venda_id
$vendas = [];

while ($row = $result1->fetch_assoc()) {
if (!isset($vendas[$row['venda_id']])) {
    $vendas[$row['venda_id']] = [
        'venda_id' => $row['venda_id'],
        'total' => $row['total'],
        'data_venda' => $row['data_venda'],
        'produtos' => []  
    ];
}
$vendas[$row['venda_id']]['produtos'][] = $row['produto_nome'];
}

// Display grouped sales (where cliente_id is NOT an email)
foreach ($vendas as $venda) {
echo "<div class='itens_shown'>
    <a style='width:20%;overflow:hidden;'>" . htmlspecialchars($venda['venda_id']) . "</a>
    <a style='width:20%;overflow:hidden;'>" . implode("<br>", array_map('htmlspecialchars', $venda['produtos'])) . "</a>
    <a style='width:20%;overflow:hidden;'>" . htmlspecialchars($venda['total']) . "</a>
    <a style='width:20%;overflow:hidden;'>" . htmlspecialchars($venda['data_venda']) . "</a>
</div><hr>";
}

// Query for records where cliente_id IS an email (from vendas only)
$sql2 = "
SELECT 
    venda_id, 
    cliente_id, 
    total, 
    data_venda
FROM 
    vendas
WHERE 
    cliente_id LIKE '%@%'
AND
    cliente_id LIKE '%". $q . "%'
ORDER BY 
    venda_id DESC
LIMIT 80
";

$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$result2 = $stmt2->get_result();

// Display sales where cliente_id is an email
while ($row = $result2->fetch_assoc()) {
echo "<div class='itens_shown'>
    <a style='width:20%;overflow:hidden;'>" . htmlspecialchars($row['venda_id']) . "</a>
    <input style='width:20%;background-color:transparent;border-color:transparent;color:#9e6632;font-weight: bold;padding:0px' value='" . htmlspecialchars($row['cliente_id']) . "'></input>
    <a style='width:20%;overflow:hidden;'>" . htmlspecialchars($row['total']) . "</a>
    <a style='width:20%;overflow:hidden;'>" . htmlspecialchars($row['data_venda']) . "</a>
</div><hr>";
}
    }
    $stmt->close();
