<?php
    $q = strval($_GET['q']);
    $c = strval($_GET['c']);
    $t = strval($_GET['t']);

    function dbConnection() {
        // Ativar relatórios de erro
        error_reporting(E_ALL);
        ini_set('display_errors', 0); // Desativa a exibição de erros no navegador (em produção, geralmente deve ser 0)
    
        // Configurações do banco de dados
        $host = 'localhost'; // Endereço do servidor
        $port = 3306;        // Porta do MySQL do XAMPP (verifique no painel de controle do XAMPP)
        $user = 'root';     // Nome de usuário do MySQL
        $password = ''; // Senha do MySQL
        $database = 'cafedvovo'; // Nome do banco de dados
    
        // Criando a conexão com o banco de dados
        $conn = new mysqli($host, $user, $password, $database, $port);
    
        // Definindo a codificação UTF-8 para aceitar caracteres especiais
        $conn->set_charset("utf8");
    
        // Verificando se a conexão foi bem-sucedida
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }
    
        // Retornando a conexão para ser usada nas outras funções ou páginas
        return $conn;
    }
    
    $conn = dbConnection();

    if ($c == 'id') {
        $c = 'id' . substr($t, 0, -1);
    }

    $sql="SELECT * FROM $t WHERE $c LIKE '%".$q."%'";
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($t == 'entradas') {

        echo '<div class="table_header">
        <a style="width:20%">ID</a>
        <a style="width:20%">descrição</a>
        <a style="width:20%">valor</a>
        <a style="width:20%">data</a>
        <a style="width:7%">DEL</a>
        </div><hr style="height:4px;background-color:black"><br>';

        while($row = mysqli_fetch_array($result)) {
            echo "<div class='itens_shown'>
                <a style='width:25%'>" . $row['identrada'] . "</a>
                <a style='width:25%'>" . $row['descricao'] . "</a>
                <a style='width:25%'>" . $row['valor'] . "</a>
                <a style='width:25%'>" . $row['data'] . "</a>
                <form id='field' action='entradas_del.php' method='post'>
                    <input type='hidden' name='id' value=" . $row["identrada"] . ">
                    <button type='submit'>X</button></form>
                </div><hr>";
            }

    } else if ($t == 'despesas') {

        echo '<div class="table_header">
        <a style="width:19%">ID</a>
        <a style="width:19%">categoria</a>
        <a style="width:19%">descricao</a>
        <a style="width:19%">valor</a>
        <a style="width:19%">data</a>
        <a style="width:7%">DEL</a>
        </div><hr style="height:4px;background-color:black"><br>';

        while($row = mysqli_fetch_array($result)) {
            echo "<div class='itens_shown'>
                <a style='width:20%'>" . $row['iddespesa'] . "</a>
                <a style='width:20%'>" . $row['categoria'] . "</a>
                <a style='width:20%'>" . $row['descricao'] . "</a>
                <a style='width:20%'>" . $row['valor'] . "</a>
                <a style='width:20%'>" . $row['data'] . "</a>
                <form id='field' action='despesas_del.php' method='post'>
                    <input type='hidden' name='id' value=" . $row["iddespesa"] . ">
                    <button type='submit'>X</button></form>
                </div><hr>";
            }
    }

    mysqli_close($conn);