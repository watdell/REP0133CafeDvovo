<?php
// Configurações do banco de dados
$servername = "localhost"; // Endereço do servidor do banco de dados
$username = "root";        // Nome de usuário para acesso ao banco
$password = "";            // Senha para o usuário do banco
$dbname = "meubanco";      // Nome do banco de dados a ser utilizado
$port = "3306"; // Porta, caso necessário.

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) { // Verifica se ocorreu algum erro durante a conexão
    die("Falha na conexão: " . $conn->connect_error); // Exibe uma mensagem e interrompe o script
}

// Recebe os dados enviados pelo formulário via método POST
$nome = $_POST['nome'] ?? null;       // Recebe o nome do formulário (ou null se não enviado)
$email = $_POST['email'] ?? null;     // Recebe o e-mail do formulário (ou null se não enviado)
$acao = $_POST['acao'] ?? null;       // Recebe a ação selecionada no formulário (ou null se não enviado)
$id = isset($_POST['id']) ? $_POST['id'] : null; // Recebe o ID do formulário, se fornecido

// Verifica qual ação foi solicitada no formulário e executa a operação correspondente
if ($acao == 'inserir') {
    // Insere um novo registro no banco de dados
    $sql = "INSERT INTO usuarios (nome, email) VALUES (?, ?)"; // Consulta SQL com placeholders
    $stmt = $conn->prepare($sql); // Prepara a consulta para ser executada
    if ($stmt === false) { // Verifica se houve erro ao preparar a consulta
        die("Erro ao preparar a consulta: " . $conn->error); // Interrompe o script se houver erro
    }
    $stmt->bind_param("ss", $nome, $email); // Substitui os placeholders pelos valores de $nome e $email
    if ($stmt->execute()) { // Executa a consulta preparada
        echo "Novo registro criado com sucesso!"; // Mensagem de sucesso
    } else {
        echo "Erro ao criar registro: " . $stmt->error; // Mensagem de erro
    }
    $stmt->close(); // Fecha o statement para liberar recursos

} elseif ($acao == 'atualizar' && $id !== null) {
    // Atualiza um registro existente no banco de dados
    $sql = "UPDATE usuarios SET nome=?, email=? WHERE id=?"; // Consulta SQL com placeholders
    $stmt = $conn->prepare($sql); // Prepara a consulta para ser executada
    if ($stmt === false) { // Verifica se houve erro ao preparar a consulta
        die("Erro ao preparar a consulta: " . $conn->error); // Interrompe o script se houver erro
    }
    $stmt->bind_param("ssi", $nome, $email, $id); // Substitui os placeholders pelos valores de $nome, $email e $id
    if ($stmt->execute()) { // Executa a consulta preparada
        echo "Registro atualizado com sucesso!"; // Mensagem de sucesso
    } else {
        echo "Erro ao atualizar registro: " . $stmt->error; // Mensagem de erro
    }
    $stmt->close(); // Fecha o statement para liberar recursos

} elseif ($acao == 'excluir' && $id !== null) {
    // Exclui um registro do banco de dados
    $sql = "DELETE FROM usuarios WHERE id=?"; // Consulta SQL com placeholder
    $stmt = $conn->prepare($sql); // Prepara a consulta para ser executada
    if ($stmt === false) { // Verifica se houve erro ao preparar a consulta
        die("Erro ao preparar a consulta: " . $conn->error); // Interrompe o script se houver erro
    }
    $stmt->bind_param("i", $id); // Substitui o placeholder pelo valor de $id
    if ($stmt->execute()) { // Executa a consulta preparada
        echo "Registro excluído com sucesso!"; // Mensagem de sucesso
    } else {
        echo "Erro ao excluir registro: " . $stmt->error; // Mensagem de erro
    }
    $stmt->close(); // Fecha o statement para liberar recursos

} elseif ($acao == 'consultar') {
    // Consulta e exibe todos os registros do banco de dados
    $sql = "SELECT id, nome, email FROM usuarios"; // Consulta SQL para selecionar todos os registros
    $stmt = $conn->prepare($sql); // Prepara a consulta para ser executada
    if ($stmt === false) { // Verifica se houve erro ao preparar a consulta
        die("Erro ao preparar a consulta: " . $conn->error); // Interrompe o script se houver erro
    }

    // Executa a consulta
    $stmt->execute();

    // Associa os resultados da consulta às variáveis
    $stmt->bind_result($id, $nome, $email);

    // Exibe os resultados em formato de tabela
    echo "<h2>Lista de Usuários</h2>";
    echo "<table border='1'><tr><th>ID</th><th>Nome</th><th>E-mail</th></tr>";
    while ($stmt->fetch()) { // Itera sobre os resultados da consulta
        echo "<tr><td>$id</td><td>$nome</td><td>$email</td></tr>"; // Exibe cada registro como uma linha da tabela
    }
    echo "</table>";

    // Fecha o statement para liberar recursos
    $stmt->close();
} else {
    // Caso nenhuma ação válida tenha sido selecionada
    echo "Ação inválida ou ID não fornecido para atualizar/excluir.";
}

// Fecha a conexão com o banco de dados para liberar recursos
$conn->close();
?>
