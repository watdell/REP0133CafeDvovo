<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Produto</title>
    
    <!-- Estilos -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/cadastrar-produtos/forms-style.css">
    <link rel="stylesheet" href="../../assets/css/cadastrar-produtos/tabs-style.css">
    <link rel="stylesheet" href="../../assets/css/cadastrar-produtos/modal-style.css">
    <link rel="stylesheet" href="../../assets/css/cadastrar-produtos/confirmar-style.css">
</head>
<body>
    <?php 
        include('../../../includes/main-sidebar.php'); 
        include('../../../includes/topbar.php'); 
        include('../../../serverside/config/dbConnection.php'); 
        
        $produto_id = $_GET['id']; 
        $conn = dbConnection();
        $sql = "SELECT * FROM produto WHERE produto_id = ?";
        $stmt_product = $conn->prepare($sql);
        $stmt_product->bind_param("i", $produto_id);
        $stmt_product->execute();
        $result_product = $stmt_product->get_result();
        $row_product = $result_product->fetch_assoc();

        $produtoId = "";

        $imagem = $row_product['imagem'];
        $tipo_imagem = $row_product['tipo_imagem'];
        $produtoId = $row_product['produto_id'];

        if(!empty($imagem)) {
            $imagem_base64 = base64_encode($imagem);
            $src_imagem = 'data:' . $tipo_imagem . ';base64,' . $imagem_base64;
        } else {
            $src_imagem = '../../assets/images/img_padrao_cafe.png';
        }  
    ?>

    <main class="content">
        <form class="form-group323" id="formulario-geral" method="post" action="../../../serverside/controllers/produtos/alterar-produto.php" enctype="multipart/form-data">
            <div class="info-e-imagem">
                <fieldset class="fieldset">
                    <legend>Cadastro de Produto</legend>
                    
                    <label for="nome-produto">Nome do Produto:</label>
                    <input type="text" name="nome-produto" id="nome-produto" value="<?php echo htmlspecialchars($row_product['nome']); ?>">
                    
                    <label for="descricao-produto">Descrição do Produto:</label>
                    <textarea name="descricao-produto" id="descricao-produto"><?php echo htmlspecialchars($row_product['descricao']); ?></textarea>
                    
                    <label for="tipo-venda">Tipo de Venda:</label>
                    <select name="tipo-venda" id="tipo-venda">
                        <option value="pacote" <?php echo ($row_product['tipo'] == 'pacote') ? 'selected' : ''; ?>>Pacote</option>
                        <option value="capsula" <?php echo ($row_product['tipo'] == 'capsula') ? 'selected' : ''; ?>>Cápsula</option>
                    </select>
                    
                    <div id="opcoes-pacote" class="tipo-venda-opcoes">
                        <label for="peso-por-pacote">Peso por Pacote (g):</label>
                        <input type="number" name="peso-por-pacote" id="peso-por-pacote" step="1" value="<?php echo $row_product['peso']; ?>">
                    </div>
                </fieldset>

                <fieldset class="fieldset imagem-editar">
                    <legend>Editar Foto</legend>
                    <div>
                        <img id="preview-imagem" class="img-produto" height="250px" width="250px" style="border-radius: 10px;" src="<?php echo $src_imagem; ?>" alt="Imagem do Produto" class="produto-imagem">
                        <input type="file" name="imagem-produto" id="imagem-produto" accept="image/*" style="display: none;" onchange="previewImage(event)"><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn-upload" onclick="document.getElementById('imagem-produto').click()">📷 Alterar Imagem</button>
                    </div>
                </fieldset>
            </div>
            
            
            <fieldset class="fieldset">
                <legend>Insumos do Produto</legend>
                
                <div class="div-insumo-pesototal-subtotal">
                    <div>
                        <label>Peso Unidade:</label>
                        <input style="width: 60px" type="text" id="peso-total" name="peso-total" disabled> g
                    </div>
                    <div>
                        <span id="span-subtotal">Sub-Total:&nbsp;</span> 
                        <span id="span-subtotal-valor">R$ 0,00</span>
                    </div>
                </div>
                <div id="div-insumos">
                    <script>
                        let indexJsLastIdFixedInsumos = 0; 
                    </script>
                    <?php 
                        // Conectar ao banco
                        $conn = dbConnection();

                        // Buscar todos os insumos disponíveis
                        $sqlInsumos = "SELECT * FROM insumo ORDER BY nome ASC";
                        $resultInsumos = $conn->query($sqlInsumos);

                        // Criar um array para armazenar todos os insumos disponíveis
                        $insumosDisponiveis = [];
                        while ($rowInsumo = $resultInsumos->fetch_assoc()) {
                            $insumosDisponiveis[] = $rowInsumo;
                        }

                        // Buscar os insumos já cadastrados no produto
                        $sqlProdutoInsumo = "SELECT pi.*, i.nome, i.unidade_medida, i.estoque_atual, i.custo_unitario 
                                            FROM produto_insumo pi 
                                            JOIN insumo i ON pi.insumo_id = i.insumo_id 
                                            WHERE pi.produto_id = ?";
                        $stmt = $conn->prepare($sqlProdutoInsumo);
                        $stmt->bind_param("i", $produto_id);
                        
                        if($stmt) {
                            $stmt->execute();
                            $result = $stmt->get_result();
                        }

                        $index = 0;
                        // Exibir os insumos cadastrados no produto
                        while ($row = $result->fetch_assoc()) { ?>
                            <div style="margin-top: 5px;" class="insumo" id="insumo-<?php echo $index; ?>">
                                <label for="select-insumo-<?php echo $index; ?>">Insumo:</label>
                                <select style="width: 70%;" class="insumo-select" id="select-insumo-<?php echo $index; ?>" name="insumo[]">
                                    <?php foreach ($insumosDisponiveis as $insumo) { ?>
                                        <option value="<?php echo $insumo['insumo_id']; ?>" data-estoque-atual="<?php echo $insumo['estoque_atual']; ?>" data-custo_unitario="<?php echo $row['custo_unitario']; ?>"
                                            <?php echo ($insumo['insumo_id'] == $row['insumo_id']) ? 'selected' : ''; ?>>
                                            <?php echo $insumo['nome'] ." ----- R$ ".number_format($insumo['custo_unitario'], 2, ',', '.')." ".$insumo['unidade_medida']." ----- Estoque ".$insumo['estoque_atual']." ".$insumo['unidade_medida']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <label for="quantidade-insumo-<?php echo $row['insumo_id']; ?>"><?php echo $row['unidade_medida']; ?>:</label>
                                <input onblur="verificaEstoque(this)" class="insumo-qntd" data-insumo-id="<?php echo $row['insumo_id']; ?>" id="qntd-insumo-<?php echo $index; ?>" type="number" name="qntd-insumo[]" value="<?php echo $row['qntd_insumo']; ?>" style="width: 50px;" step="1">
                                <i onclick="deleteInsumoDiv(this)" id="<?php echo $index; ?>" data-insumo-id = "<?php echo $row['insumo_id']; ?>" class="icon-delete">🗑️</i>
                            </div>
                    <?php
                        $index++;
                        } 
                    ?>
                    <script>
                        indexJsLastIdFixedInsumos = <?php echo $index; ?>
                    </script>
                </div>
                <input type="hidden" id="insumos-removidos" name="insumos-removidos">
                <br>
                <button id="add-insumo" type="button" class="register-btn">Adicionar insumo</button>
            </fieldset>

            <div class="financ-estoque-info">
                <fieldset class="fieldset">
                    <legend>Informações Financeiras</legend>
                    <label for="margem-lucro">Margem de Lucro (%):</label>
                    <input type="number" name="margem-lucro" id="margem-lucro" value="<?php echo $row_product['margem_lucro']; ?>">
                    
                    <label for="preco-venda">Preço de Venda (R$):</label>
                    <input type="number" name="preco-venda" id="preco-venda" value="<?php echo $row_product['preco_venda']; ?>">
                </fieldset>
                
                <fieldset class="fieldset">
                    <legend>Controle de Estoque</legend>
                    <label for="quantidade-estoque">Quantidade para estoque:</label>
                    <input type="number" name="quantidade-para-estoque" id="quantidade-para-estoque" value="<?php echo $row_product['estoque_atual']; ?>">
                    
                    <label for="estoque-minimo">Estoque Mínimo:</label>
                    <input type="number" name="estoque-minimo" id="estoque-minimo" value="<?php echo $row_product['estoque_minimo']; ?>">
                </fieldset>            
            </div>            
            
            
            <button type="submit" class="register-btn">Salvar</button>
            <input type="hidden" name="produto_id" value="<?php echo $produto_id; ?>">
        </form>
    </main>

    <!-- Scripts -->
    <script src="../../assets/js/main.js"></script>
    <script src="./js/script.js"></script>
    <script src="../../assets/js/cadastro-produtos/conversores-valor.js"></script>
    <script src="../../assets/js/cadastro-produtos/validadores.js"></script>
</body>
</html>
