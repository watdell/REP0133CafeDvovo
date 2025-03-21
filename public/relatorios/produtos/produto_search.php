<?php
    // Coletando variáveis
$q = strval($_GET['q']);
$tipo = strval($_GET['tipo']);

// Incluindo a conexão com o banco de dados
include '../../../serverside/config/dbConnection.php';
$conn = dbConnection();

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta segura usando prepared statements
$sql = "SELECT * FROM produto WHERE nome LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $q . "%";
$stmt->bind_param("s", $searchTerm);

if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()) {
        $imagem = $row['imagem'];
        $tipo_imagem = $row['tipo_imagem'];

        // Verificação da imagem e preparação da exibição
        if (!empty($imagem)) {
            $imagem_base64 = base64_encode($imagem);
            $src_imagem = 'data:' . $tipo_imagem . ';base64,' . $imagem_base64;
        } else {
            $src_imagem = '../../assets/images/img_padrao_cafe.png';
        }

        if ($tipo==1) {
            echo '
            <div class="produto-card" style="display:flex;flex-direction:row;">
                <img class="img-produto" src="' . $src_imagem . '" alt="Imagem do Produto" class="produto-imagem" style="display:none">
                <div class="produto-info" style="display:flex;justify-content:space-between;width:100%;">
                    <h2 class="produto-nome" style="font-size:16px;color:#333;">' . $row['nome'] . '</h2>
                    <p class="produto-descricao" style="font-size:16px;color:#333;">' . $row['descricao'] . '</p>
                    <p><strong>Preço:</strong> R$ ' . number_format($row['preco_venda'], 2, ',','.') . '</p>
                </div>
                <div class="produto-acoes">
                    <button onclick="abrirModalDetalhes(' . $row['produto_id'] . ');" class="btn-acao visualizar">👁️</button>
                    <button id="btn-acao-editar" class="btn-acao editar" value=' . $row['produto_id'] . ' onclick="alterarDados_enviarID(this.value)">✏️</button>
                    <button id="btn-acao-excluir" class="btn-acao excluir" onclick="confirmarExclusao(' . $row['produto_id'] . ');">🗑️</button>
                </div>
            </div>';
        } else {
            echo '<div class="produto-card">
                <img class="img-produto" src="' . $src_imagem . '" alt="Imagem do Produto" class="produto-imagem"">
                <div class="produto-info">
                    <h2 class="produto-nome">' . $row['nome'] . '</h2>
                    <p class="produto-descricao">' . $row['descricao'] . '</p>
                    <p><strong>Preço:</strong> R$ ' . number_format($row['preco_venda'], 2, ',','.') . '</p>
                </div>
                <div class="produto-acoes">
                    <button onclick="abrirModalDetalhes(' . $row['produto_id'] . ');" class="btn-acao visualizar">👁️ Detalhes</button>
                    <button id="btn-acao-editar" class="btn-acao editar" value=' . $row['produto_id'] . ' onclick="alterarDados_enviarID(this.value)">✏️ Editar</button>
                    <button id="btn-acao-excluir" class="btn-acao excluir" onclick="confirmarExclusao(' . $row['produto_id'] . ');">🗑️ Excluir</button>
                </div>
            </div>';
        }
    }
}

$stmt->close();
$conn->close();
