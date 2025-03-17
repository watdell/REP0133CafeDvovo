<?php
    $q = strval($_GET['q']);
    $tipo = strval($_GET['tipo']);

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

    $sql = "SELECT * FROM produto WHERE nome LIKE '%" . $q . "%'";
    $stmt = $conn->prepare($sql);

    if($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {

            $imagem = $row['imagem'];
            $tipo_imagem = $row['tipo_imagem'];

            if(!empty($imagem)) {
                $imagem_base64 = base64_encode($imagem);
                $src_imagem = 'data:' . $tipo_imagem . ';base64,' . $imagem_base64;
            } else {
                $src_imagem = '../../assets/images/img_padrao_cafe.png';
            }

            if ($tipo==1) {

                echo '<div class="produto-card" style="display:flex;flex-direction:row;">
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

    mysqli_close($conn);