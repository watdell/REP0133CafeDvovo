<?php
    // Habilita exibição de erros para debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Captura os parâmetros da requisição
    $q = strval($_GET['q']);
    $c = strval($_GET['c']);
    $t = strval($_GET['t']);
    $d = strval($_GET['d']);
    $p = strval($_GET['p']);

    // Inclui a conexão com o banco de dados
    include '../../../serverside/config/dbConnection.php';
    $conn = dbConnection();

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Debug: Verificar parâmetros recebidos
    //echo "Parâmetros recebidos: q=$q, c=$c, t=$t, d=$d, p=$p<br>";

    // Ajuste do campo de ordenação se for por ID
    if ($c == 'id') {
        $c = 'id' . substr($t, 0, -1);
    }

    $order = 'id' . substr($t, 0, -1);

    // Preparação da consulta SQL
    $sql = "SELECT * FROM $t WHERE $c LIKE ? ORDER BY $order DESC LIMIT 30";
    //echo "Consulta SQL: $sql<br>";  // Debug: Exibe a consulta gerada

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    // Vinculação de parâmetros e execução da consulta
    $likeQuery = "%$q%";
    $stmt->bind_param("s", $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    // Debug: Verificação de resultados
    //if ($result->num_rows === 0) {
        //echo "Nenhum resultado encontrado para a consulta.<br>";
    //} else {
        //echo "Resultados encontrados: " . $result->num_rows . "<br>";
    //}

    // Renderização da tabela para entradas
    if ($t == 'entradas') {
        echo '<div class="table_header">
            <a style="width:20%">ID</a>
            <a style="width:20%">descrição</a>
            <a style="width:20%">valor</a>
            <a style="width:20%">data</a>';
        if ($d != 'innertable' && $p != 'caixa') {
            echo '<a style="width:7%">DEL</a>';
        }
        echo '</div><hr style="height:4px;background-color:black">';

        while ($row = $result->fetch_assoc()) {
            echo "<div class='itens_shown'>
                <a style='width:20%;overflow:hidden;'>{$row['identrada']}</a>
                <a style='width:20%;overflow:hidden;'>{$row['descricao']}</a>
                <a style='width:20%;overflow:hidden;'>{$row['valor']}</a>
                <a style='width:20%;overflow:hidden;'>{$row['data']}</a>";

            if ($d != 'innertable' && $p != 'caixa') {
                echo "<form id='field' action='entradas_del.php' method='post'>
                    <input type='hidden' name='id' value='{$row["identrada"]}'>
                    <button type='submit'>X</button>
                </form>";
            }
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
        }
        echo '</div><hr style="height:4px;background-color:black">';

        while ($row = $result->fetch_assoc()) {
            echo "<div class='itens_shown'>
                <a style='width:20%;overflow:hidden;'>{$row['iddespesa']}</a>
                <a style='width:20%;overflow:hidden;'>{$row['categoria']}</a>
                <a style='width:20%;overflow:hidden;'>{$row['descricao']}</a>
                <a style='width:20%;overflow:hidden;'>{$row['valor']}</a>
                <a style='width:20%;overflow:hidden;'>{$row['data']}</a>";

            if ($d != 'innertable') {
                echo "<form id='field' action='despesas_del.php' method='post'>
                    <input type='hidden' name='id' value='{$row["iddespesa"]}'>
                    <button type='submit'>X</button>
                </form>";
            }
            echo "</div><hr>";
        }
    }

    // Finaliza e fecha a conexão com o banco
    $stmt->close();
    $conn->close();
?>
