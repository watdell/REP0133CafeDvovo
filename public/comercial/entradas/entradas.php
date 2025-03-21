<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/assets/css/despesas/style.css?v=<?php echo time(); ?>">
    <script src="../../../public/assets/js/comercial/despesa/despesa.js?v=<?php echo time(); ?>"></script>
    <title>Document</title>

    <?php
        // Ativando a exibição de erros
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // Função para registrar logs de erro em arquivo
        function logError($message) {
            file_put_contents('error_log.txt', $message . PHP_EOL, FILE_APPEND);
        }

        try {
            include '../../../serverside/queries/db_queries.php';
            include '../../../serverside/config/dbConnection.php';

            // Estabelecendo a conexão com o banco de dados
            $conn = dbConnection();
            if (!$conn) {
                logError("Erro de conexão: " . mysqli_connect_error());
                die("Erro de conexão: " . mysqli_connect_error());
            }
            echo "<script>console.log('Conexão estabelecida com sucesso');</script>";

            // Função para criar um padrão de pesquisa
            function fiend($criteria) {
                $stu = $criteria . "%";
                return $stu;
            }

        } catch (Exception $e) {
            logError("Erro no bloco de conexão: " . $e->getMessage());
            die("Erro interno no servidor: " . $e->getMessage());
        }
    ?>
</head>

<body>
    <?php include('../../../includes/main-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>
    <header class="topbar">ENTRADAS</header>

    <main class="content">
        <div class="navbar" id="navbar"></div>

        <div class='table' style="flex-direction:column;">
            <div class="table-header" style="width:100%;display:flex;flex-direction:row;">
                <h2>Entradas</h2>
                <input id='search' type='search' autocomplete="off" style='width:50%' placeholder='pesquisar por...' oninput='search("entradas","select-search")'>
                <select id="select-search" style="margin-left:10px;width:17%" onchange="setcook()">
                    <option id="select-search-descricao" value="descricao">DESC</option>
                    <option id="select-search-id" value="id">ID</option>
                    <option id="select-search-valor" value="valor">VALOR</option>
                    <option id="select-search-data" value="data">DATA</option>
                </select>
                <button onclick="location.href='../index.php'">VOLTAR</button>
            </div>

            <div style="display:flex;flex-direction:row;">
                <div id='innertable' class="innertable" style="width:100%">
                    <!-- THIS IS WHERE THE MAGIC HAPPENS -->
                </div>
            </div>

            <div class="itens_shown" style="justify-content:space-between;padding-top:10px">

                <button onclick="location.href='entradas_create.php'" style='background-color:#b5651d;width:40%'>REGISTRAR NOVA ENTRADA</button>

                <div class="subtotal">
                    <a style="width:40%;font-size:30px">Subtotal:</a>
                    <a style="width:40%;font-size:30px">
                        <?php
                            try {
                                // Consulta para obter os valores
                                $sql = "SELECT valor FROM entradas";
                                $stmt = $conn->prepare($sql);
                                if (!$stmt) {
                                    logError("Erro na preparação da consulta: " . $conn->error);
                                    die("Erro na preparação da consulta: " . $conn->error);
                                }

                                // Executando a consulta
                                if (!$stmt->execute()) {
                                    logError("Erro na execução da consulta: " . $stmt->error);
                                    die("Erro na execução da consulta: " . $stmt->error);
                                }

                                // Obtendo o resultado
                                $result = $stmt->get_result();
                                if ($result === false) {
                                    logError("Erro ao obter o resultado: " . $stmt->error);
                                    die("Erro ao obter o resultado: " . $stmt->error);
                                }

                                $subtotal = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $subtotal += $row['valor'];
                                }
                                echo "R$" . number_format($subtotal, 2, ',', '.');
                                
                                // Fechando a conexão e a instrução
                                $stmt->close();
                                $conn->close();
                                echo "<script>console.log('Consulta e fechamento realizados com sucesso');</script>";

                            } catch (Exception $e) {
                                logError("Erro ao calcular o subtotal: " . $e->getMessage());
                                echo "Erro ao calcular o subtotal";
                            }
                        ?>
                    </a>
                </div>

            </div>
        
        </div>

    </main>

    <script src="../../assets/js/main.js"></script>
    <script>
        function setcook() {
            setCookie('select-search', document.getElementById("select-search").value, 2);
        }

        document.getElementById('select-search-' + getCookie('select-search', 'entr')).selected = true;
        search("entradas", "select-search");
    </script>
</body>
</html>