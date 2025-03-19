<?php
    // Ativando a exibição de erros
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Capturando os parâmetros recebidos via GET
    $q = strval($_GET['q']);
    $c = strval($_GET['c']);
    $t = strval($_GET['t']);
    $d = strval($_GET['d']);
    $p = strval($_GET['p']);

    // Incluindo a conexão com o banco de dados
    include '../../../serverside/config/dbConnection.php';

    // Função para registrar logs de erro em arquivo
    function logError($message) {
        file_put_contents('error_log.txt', $message . PHP_EOL, FILE_APPEND);
    }

    try {
        // Estabelecendo a conexão
        $conn = dbConnection();
        if (!$conn) {
            die("Erro na conexão: " . mysqli_connect_error());
        }
        //echo "Conexão estabelecida com sucesso.<br>";

        // Verificando se a conexão falhou
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Ajustando a coluna para a ordenação se for 'id'
        if ($c == 'id') {
            $c = 'id' . substr($t, 0, -1);
        }
        $order = 'id' . substr($t, 0, -1);

        // Construindo a consulta SQL
        $sql = "SELECT * FROM $t WHERE $c LIKE ? ORDER BY " . $order . " DESC LIMIT 30";
        //echo "Consulta SQL: " . $sql . "<br>";

        // Preparando a consulta
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            logError("Erro na preparação da consulta: " . $conn->error);
            die("Erro na preparação da consulta: " . $conn->error);
        }

        // Vinculando os parâmetros
        $param = '%' . $q . '%';
        $stmt->bind_param('s', $param);

        // Executando a consulta
        if (!$stmt->execute()) {
            logError("Erro na execução da consulta: " . $stmt->error);
            die("Erro na execução da consulta: " . $stmt->error);
        }
        //echo "Consulta executada com sucesso.<br>";

        // Obtendo o resultado
        $result = $stmt->get_result();
        if ($result === false) {
            logError("Erro ao obter o resultado: " . $stmt->error);
            die("Erro ao obter o resultado: " . $stmt->error);
        }

        // Verificando o número de resultados
        //echo "Número de resultados: " . $result->num_rows . "<br>";

        // Verificando o tipo de tabela e exibindo os resultados
        if ($t == 'entradas') {
            echo '<div class="table_header">
            <a style="width:20%">ID</a>
            <a style="width:20%">Descrição</a>
            <a style="width:20%">Valor</a>
            <a style="width:20%">Data</a>';
            if ($d != 'innertable' && $p != 'caixa') {
                echo '<a style="width:7%">DEL</a>';
            };
            echo '</div><hr style="height:4px;background-color:black"><br>';

            while ($row = $result->fetch_assoc()) {
                echo "<div class='itens_shown'>
                    <a style='width:20%;overflow:hidden;'>" . $row['identrada'] . "</a>
                    <a style='width:20%;overflow:hidden;'>" . $row['descricao'] . "</a>
                    <a style='width:20%;overflow:hidden;'>" . $row['valor'] . "</a>
                    <a style='width:20%;overflow:hidden;'>" . $row['data'] . "</a>";
                if ($d != 'innertable' && $p != 'caixa') {
                    echo "<form id='field' action='entradas_del.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["identrada"] . "'>
                        <button type='submit'>X</button></form>";
                };
                echo "</div><hr>";
            }

        } else if ($t == 'despesas') {
            echo '<div class="table_header">
            <a style="width:19%">ID</a>
            <a style="width:19%">Categoria</a>
            <a style="width:19%">Descrição</a>
            <a style="width:19%">Valor</a>
            <a style="width:19%">Data</a>';
            if ($d != 'innertable') {
                echo '<a style="width:7%">DEL</a>';
            };
            echo '</div><hr style="height:4px;background-color:black"><br>';

            while ($row = $result->fetch_assoc()) {
                echo "<div class='itens_shown'>
                    <a style='width:20%;overflow:hidden;'>" . $row['iddespesa'] . "</a>
                    <a style='width:20%;overflow:hidden;'>" . $row['categoria'] . "</a>
                    <a style='width:20%;overflow:hidden;'>" . $row['descricao'] . "</a>
                    <a style='width:20%;overflow:hidden;'>" . $row['valor'] . "</a>
                    <a style='width:20%;overflow:hidden;'>" . $row['data'] . "</a>";
                if ($d != 'innertable') {
                    echo "<form id='field' action='despesas_del.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["iddespesa"] . "'>
                        <button type='submit'>X</button></form>";
                };
                echo "</div><hr>";
            }
        }

        // Fechando a conexão e a instrução
        $stmt->close();
        $conn->close();
        //echo "Conexão encerrada com sucesso.<br>";

    } catch (Exception $e) {
        logError("Erro interno no servidor: " . $e->getMessage());
        echo "Erro interno no servidor: " . $e->getMessage();
    }
?>
