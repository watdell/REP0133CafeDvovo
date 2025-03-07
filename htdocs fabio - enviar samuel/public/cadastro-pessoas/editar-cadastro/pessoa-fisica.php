<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/cadastro-pessoas/cadastro-pessoas.css">    
    <title>Atualizar Informações</title>
</head>
<body>
    <?php include('../../../includes/main-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>
        <main class="content">
            <div class="navbar" id="navbar"></div>
            <br>
            <?php
                include ('../../../serverside/config/dbConnection.php');
                include ('../../../serverside/queries/db_queries.php');

                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                $conn = dbConnection();

                $id = $_GET['id'];
                
                $query = getQuery('check_user_type');

                // Obtendo o tipo de usuário
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->bind_result($id, $tipo_usuario);
                $stmt->fetch(); // Chamada necessária para obter os resultados
                $stmt->close(); // Fechar a instrução

                // Verificar o tipo de usuário
                if ($tipo_usuario === "p_fisica") {

                    $query = getQuery('select_all_clientes_pf_by_id');

                    // Preparar a consulta para pessoas físicas
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $id); // Vincula o ID
                    $stmt->execute();
                    $stmt->bind_result($id, $nome, $email, $telefone, $data_nascimento, $pais, $cep, $estado, $cidade, $bairro, $rua, $numero, $complemento, $data_cadastro, $cpf_rg, $passaporte, $nacionalidade); // 15 variáveis
                    
                    if ($stmt->fetch()) {
                        // Formulário com os dados preenchidos
                        echo '<form class="formulario" action="../../../serverside/controllers/pessoas/atualizar_pessoa.php" method="POST">';
                        echo '<input type="hidden" name="id" value="' . htmlspecialchars($id) . '">';
                        echo '<label for="nome">Nome:</label>';
                        echo '<input type="text" id="nome" name="nome" value="' . htmlspecialchars($nome) . '" required><br>';

                        echo '<label for="email">Email:</label>';
                        echo '<input type="email" id="email" name="email" value="' . htmlspecialchars($email) . '" required><br>';

                        echo '<label for="telefone">Telefone:</label>';
                        echo '<input type="text" id="telefone" name="telefone" value="' . htmlspecialchars($telefone) . '" required><br>';

                        echo '<label for="data_nascimento">Data de Nascimento:</label>';
                        echo '<input type="text" id="data_nascimento" name="data_nascimento" value="' . htmlspecialchars($data_nascimento) . '" required><br>';

                        echo '<label for="pais">País:</label>';
                        echo '<input type="text" id="pais" name="pais" value="' . htmlspecialchars($pais) . '" required><br>';

                        echo '<label for="cep">CEP:</label>';
                        echo '<input type="text" id="cep" name="cep" value="' . htmlspecialchars($cep) . '" required><br>';

                        echo '<label for="estado">Estado:</label>';
                        echo '<input type="text" id="estado" name="estado" value="' . htmlspecialchars($estado) . '" required><br>';

                        echo '<label for="cidade">Cidade:</label>';
                        echo '<input type="text" id="cidade" name="cidade" value="' . htmlspecialchars($cidade) . '" required><br>';

                        echo '<label for="bairro">Bairro:</label>';
                        echo '<input type="text" id="bairro" name="bairro" value="' . htmlspecialchars($bairro) . '" required><br>';

                        echo '<label for="rua">Rua:</label>';
                        echo '<input type="text" id="rua" name="rua" value="' . htmlspecialchars($rua) . '" required><br>';

                        echo '<label for="numero">Número:</label>';
                        echo '<input type="text" id="numero" name="numero" value="' . htmlspecialchars($numero) . '" required><br>';

                        echo '<label for="complemento">Complemento:</label>';
                        echo '<input type="text" id="complemento" name="complemento" value="' . htmlspecialchars($complemento) . '"><br>';

                        echo '<label for="cpf_rg">CPF/RG:</label>';
                        echo '<input type="text" id="cpf_rg" name="cpf_rg" value="' . htmlspecialchars($cpf_rg ?? '') . '"><br>';

                        echo '<label for="passaporte">Passaporte:</label>';
                        echo '<input type="text" id="passaporte" name="passaporte" value="' . htmlspecialchars($passaporte ?? '') . '"><br>';

                        echo '<label for="nacionalidade">Nacionalidade:</label>';
                        echo '<input type="text" id="nacionalidade" name="nacionalidade" value="' . htmlspecialchars($nacionalidade) . '"><br>';

                        ?><br> <button class='register-btn' type='submit'>Atualizar</button><br> <?php
                        echo '</form>';
                    } else {
                        echo "Nenhum registro encontrado.";
                    }
                    
                    // Fechar a instrução
                    $stmt->close();
                }
            ?>  
    </main>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/cadastro-pessoas/cliente-pf.js"></script>
</body>
</html>