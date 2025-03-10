
<?php include ('../../../serverside/config/dbConnection.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Produtos</title>
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/relatorios/relatorio-produtos/relatorio-produtos.css">
</head>
<body>
    <?php include('../../../includes/produtos-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>
    <main class="content">
        <div class="navbar" id="navbar"></div>
        <div class="catalogo-container">
            <section class="catalogo-top">
                <h1>Catálogo de Produtos</h1>
                <div>
                    <button id="btn-list" class="btn-adicionar">Lista</button>
                    <button id="add-produto" onclick="fabricarProduto()" class="btn-adicionar">+ Adicionar Produto</button>
                </div>
            </section>
            <div class="catalogo-grid" id="catalogo-grid">
                
                 <?php
                 $conn = dbConnection();
                    $sql = "SELECT * FROM produto";
                    $stmt = $conn->prepare($sql);

                    if($stmt) {
                        $stmt->execute();
                        $result = $stmt->get_result();
                        

                        /* pode ser necessário depois.. 
                        $sql_img = "SELECT imagem, tipo_imagem FROM produto LIMIT 1";
                        $stmt_img = $conn->prepare($sql_img);
                        $stmt_img->execute();
                        $stmt_img->store_result();
                        $stmt_img->bind_result($imagem, $tipo_imagem);
                        $stmt_img->fetch();*/

                        while($row = $result->fetch_assoc()) {

                            $imagem = $row['imagem'];
                            $tipo_imagem = $row['tipo_imagem'];

                            if(!empty($imagem)) {
                                $imagem_base64 = base64_encode($imagem);
                                $src_imagem = 'data:' . $tipo_imagem . ';base64,' . $imagem_base64;
                            } else {
                                $src_imagem = '../../assets/images/img_padrao_cafe.png';
                            }
                            
                            ?>
                                <!-- Card de um produto -->

                                <div class="produto-card">
                                    <img class="img-produto" src="<?php echo $src_imagem; ?>" alt="Imagem do Produto" class="produto-imagem">
                                    <div class="produto-info">
                                        <h2 class="produto-nome"><?php echo $row['nome'] ?></h2>
                                        <p class="produto-descricao"><?php echo $row['descricao'] ?></p>
                                        <p><strong>Preço:</strong> R$ <?php echo number_format($row['preco_venda'], 2, ',','.') ?></p>
                                    </div>
                                    <div class="produto-acoes">
                                        <button onclick="abrirModalDetalhes(<?php echo $row['produto_id']; ?>);" class="btn-acao visualizar">👁️ Detalhes</button>
                                        <button id="btn-acao-editar" class="btn-acao editar" value=<?php echo $row['produto_id']; ?> onclick="alterarDados_enviarID(this.value)">✏️ Editar</button>
                                        <button id="btn-acao-excluir" class="btn-acao excluir" onclick="confirmarExclusao(<?php echo $row['produto_id']; ?>);">🗑️ Excluir</button>
                                    </div>
                                </div>

                                <!-- O loop while vai multiplicar este card conforme a qntd de produtos no db.. -->
                            <?php
                        }
                    } else {
                        echo "Erro na conexão da consulta" . $conn->error;
                    }  
                 ?>
                
            </div>
        </div>
    </main>

    <!-- modal para detalhe de informações -->
    <div id="container-modal-relatorio" class="container-modal-relatorio" style="display: none;">
        <div id="relatorio-container" class="relatorio-container">
            <!-- Cabeçalho do Relatório -->
            <header class="relatorio-header">
                <div class="header-title">
                    <h1>Produto: <span id="nome-produto"></span></h1>
                    <p><strong>Data de Cadastro:</strong> <span id="data-cadastro"></span></p>
                </div>
                <div class="header-actions">
                    <button class="btn-acao editar" id="btn-acao-editar-modal"  onclick="alterarDados_enviarID(this.value)">✏️ Editar</button>
                    <button id="excluir-produto-modal" class="btn-acao excluir">🗑️ Excluir</button>
                    <button onclick="fecharModalDetalhes()" class="btn-acao voltar">🔙 Voltar ao Catálogo</button>
                </div>
            </header>
        
            <!-- Resumo do Produto -->
            <section class="resumo-produto">
                <h2>Resumo</h2>
                <div class="resumo-detalhes">
                    <p><strong>Tipo de Venda:</strong> <span id="tipo-venda"></span></p>
                    <p><strong>Descrição:</strong> <span id="descricao-produto"></span></p>
                    <p><strong>Peso por Unidade:</strong> <span id="peso-unidade"></span></p>
                </div>
            </section>
        
            <!-- Tabela de Insumos -->
            <section class="insumos-utilizados">
                <h2>Insumos Utilizados</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Insumo</th>
                            <th>Quantidade</th>
                            <th>Unidade</th>
                            <th>Custo Total</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-insumos">
                        <!-- Linhas dos insumos serão populadas aqui -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Subtotal dos Custos:</strong></td>
                            <td id="subtotal-custo"></td>
                        </tr>
                    </tfoot>
                </table>
            </section>
        
            <!-- Informações Financeiras -->
            <section class="info-financeira">
                <h2>Informações Financeiras</h2>
                <div class="financeiro-detalhes">
                    <p><strong>Custo Total por Unidade:</strong> <span id="custo-total"></span></p>
                    <p><strong>Margem de Lucro:</strong> <span id="margem-lucro"></span></p>
                    <p><strong>Preço de Venda:</strong> <span id="preco-venda"></span></p>
                </div>
            </section>
        
            <!-- Controle de Estoque -->
            <section class="controle-estoque">
                <h2>Estoque</h2>
                <div class="estoque-detalhes">
                    <p><strong>Quantidade em Estoque:</strong> <span id="quantidade-estoque"></span></p>
                    <p><strong>Estoque Mínimo:</strong> <span id="estoque-minimo"></span></p>
                    <div id="disponibilidade-estoque" class="disponibilidade"></div>
                </div>
            </section>
            <input type="text" id="produto-id-hidden" hidden>
        </div>
    </div>
<script src="../../assets/js/relatorios/produtos/produtos.js"></script>
<script src="../../assets/js/main.js"></script>
</body>
</html>
