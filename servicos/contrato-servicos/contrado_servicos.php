<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Serviço</title>
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <style>
        /* Estilos básicos para o formulário e tabela */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 20px;
            margin-top: 40px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
        }

        input, select, button {
            padding: 10px;
            margin-top: 5px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        button[type="reset"] {
            background-color: #f44336;
            color: white;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.8;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .alert {
            padding: 10px;
            margin-top: 20px;
            border: 1px solid;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <?php 
        include('../../../includes/main-sidebar.php');
        include('../../../includes/topbar.php');
        include('../../../serverside/config/dbConnection.php');
    
        $conn = dbConnection();
        $message = '';

        // Função de inserção (Create)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $servico = $_POST['tabela'];
            $idCliente = $_POST['idCliente'];
            $quantidade = $_POST['quantidade'];
            $data_inicio = $_POST['data_inicio'];
            $data_final = $_POST['data_final'];
            
            // Prevenção contra SQL Injection
            $sql = "INSERT INTO contratos_servico (id_servicos, pessoa_id, quantidade, data_inicio, data_final)
                    VALUES (:id_servicos, :pessoa_id, :quantidade, :data_inicio, :data_final)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_servicos', $servico);
            $stmt->bindParam(':pessoa_id', $idCliente);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':data_inicio', $data_inicio);
            $stmt->bindParam(':data_final', $data_final);

            if ($stmt->execute()) {
                $message = '<div class="alert alert-success">Contrato de serviço inserido com sucesso!</div>';
            } else {
                $message = '<div class="alert alert-error">Erro ao inserir contrato.</div>';
            }
        }
    ?>

    <main class="content">
        <h1>Contrato de Serviço</h1>

        <!-- Exibir mensagem de sucesso ou erro -->
        <?php if ($message) { echo $message; } ?>

        <!-- Formulário para inserir contrato -->
        <form method="POST">
            <label for="tabela">Tipo de Serviço</label>
            <select id="tabela" name="tabela" required>
                <option value="0" selected disabled hidden>Selecione o tipo de serviço</option>
                <option value="1">Torrar</option>
                <option value="2">Moer</option>
                <option value="3">Armazenar</option>
                <option value="4">Todos serviços</option>
            </select>

            <label for="idCliente">ID Cliente:</label>
            <select id="idCliente" name="idCliente" required>
                <?php
                // Consulta para pegar o pessoa_id e nome da tabela pessoa
                $query = "SELECT pessoa_id, nome FROM pessoa";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    // Exibe as opções com nome do cliente e id
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['pessoa_id']}'>Cliente: {$row['nome']}</option>";
                    }
                } else {
                    echo "<option value='' disabled>Nenhum cliente disponível</option>";
                }
                ?>
            </select>

            <label for="quantidade">Quantidade</label>
            <input type="text" id="quantidade" name="quantidade" placeholder="Quantidade do serviço" required>

            <label for="data_inicio">Data Início</label>
            <input type="date" id="data_inicio" name="data_inicio" required>

            <label for="data_final">Data Final</label>
            <input type="date" id="data_final" name="data_final" required>

            <div>
                <button type="submit">Salvar Contrato</button>
                <button type="reset">Cancelar</button>
            </div>
        </form>

        <!-- Leitura de Contratos (Read) -->
        <h2>Contratos Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Contrato</th>
                    <th>Tipo Serviço</th>
                    <th>Nome Cliente</th>
                    <th>Quantidade</th>
                    <th>Data Início</th>
                    <th>Data Final</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Consulta para exibir contratos existentes com o nome do cliente
                    $sql = "SELECT c.id_contratos, c.id_servicos, c.pessoa_id, c.quantidade, c.data_inicio, c.data_final, p.nome 
                            FROM contratos_servico c 
                            JOIN pessoa p ON c.pessoa_id = p.pessoa_id";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $contratos = $stmt->fetchAll();

                    foreach ($contratos as $contrato) {
                        echo "<tr>";
                        echo "<td>" . $contrato['id_contratos'] . "</td>";
                        echo "<td>" . $contrato['id_servicos'] . "</td>";
                        echo "<td>" . $contrato['nome'] . "</td>";  // Exibe o nome do cliente
                        echo "<td>" . $contrato['quantidade'] . "</td>";
                        echo "<td>" . $contrato['data_inicio'] . "</td>";
                        echo "<td>" . $contrato['data_final'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
