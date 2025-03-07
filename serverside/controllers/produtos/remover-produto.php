<?php
include ('../../config/dbConnection.php');

$conn = dbConnection();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Obtendo o ID via GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Converte para inteiro para maior segurança

    // Prepara a consulta SQL
    $stmt = $conn->prepare("DELETE FROM produto WHERE produto_id = ?");
    $stmt->bind_param("i", $id); // "i" indica que é um inteiro

    // Executa a consulta
    if ($stmt->execute()) {
        // Redireciona ou exibe uma mensagem de sucesso
        echo "<h2>Produto removido com sucesso!</h2>";
        echo "<p>Você será redirecionado em 2 segundos...</p>";
        echo '<meta http-equiv="refresh" content="2;url=\'../../../public/relatorios/produtos/produtos.php\'">';
    } else {
        echo "Erro ao remover o registro: " . $stmt->error;
    }

    // Fecha a declaração
    $stmt->close();
} else {
    echo "ID não fornecido ou inválido.";
}

// Fecha a conexão
$conn->close();
?>
