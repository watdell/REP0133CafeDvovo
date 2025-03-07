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
    $stmt = $conn->prepare("DELETE FROM insumo WHERE insumo_id = ?");
    $stmt->bind_param("i", $id); // "i" indica que é um inteiro

    // Executa a consulta
    if ($stmt->execute()) {
        // Redireciona ou exibe uma mensagem de sucesso
        echo "Registro removido com sucesso.";
        echo '<script>
            setTimeout(function() {
                window.location.href = "../../paginas/paginas_de_produto/cadastro_insumo.php"; // Substitua pelo URL desejado
            }, 2000);
          </script>';
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
