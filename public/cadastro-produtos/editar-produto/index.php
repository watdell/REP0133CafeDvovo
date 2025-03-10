<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Produto</title>
    
    <!-- Estilos -->
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/cadastrar-produtos/forms-style.css">
    <link rel="stylesheet" href="../../assets/css/cadastrar-produtos/tabs-style.css">
    <link rel="stylesheet" href="../../assets/css/cadastrar-produtos/modal-style.css">
    <link rel="stylesheet" href="../../assets/css/cadastrar-produtos/confirmar-style.css">
</head>
<body>
    <?php 
        include('../../../includes/produtos-sidebar.php'); 
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
    ?>

    <main class="content">
        <form id="formulario-geral" method="post" action="../../../serverside/controllers/produtos/alterar-produto.php" enctype="multipart/form-data">
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
                        $sqlInsumos = "SELECT * FROM insumo";
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
                            <div class="insumo" id="insumo-<?php echo $index; ?>">
                                <label for="insumo-<?php echo $row['insumo_id']; ?>">Insumo:</label>
                                <select style="width: 70%;" class="insumo-select" id="insumo" name="insumo[]">
                                    <?php foreach ($insumosDisponiveis as $insumo) { ?>
                                        <option value="<?php echo $insumo['insumo_id']; ?>" data-custo_unitario="<?php echo $row['custo_unitario']; ?>"
                                            <?php echo ($insumo['insumo_id'] == $row['insumo_id']) ? 'selected' : ''; ?>>
                                            <?php echo $insumo['nome'] ." ----- R$ ".number_format($insumo['custo_unitario'], 2, ',', '.')." ".$insumo['unidade_medida']." ----- Estoque ".$insumo['estoque_atual']." ".$insumo['unidade_medida']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <label for="quantidade-insumo-<?php echo $row['insumo_id']; ?>"><?php echo $row['unidade_medida']; ?>:</label>
                                <input class="insumo-qntd" type="number" name="qntd-insumo[]" value="<?php echo $row['qntd_insumo']; ?>" style="width: 50px;" step="1">
                                <i onclick="deleteInsumoDiv(this)" id="<?php echo $index; ?>" data-insumo-id = "<?php echo $row['insumo_id']; ?>" class="icon-delete">🗑️</i>
                            </div>
                    <?php
                        $index++;
                    } ?>
                    <script>
                        indexJsLastIdFixedInsumos = <?php echo $index; ?>
                    </script>
                </div>
                <input type="hidden" id="insumos-removidos" name="insumos-removidos">
                <button id="add-insumo" type="button" class="register-btn">Adicionar insumo</button>
            </fieldset>


            <fieldset class="fieldset">
                <legend>Informações Financeiras</legend>
                <label for="margem-lucro">Margem de Lucro (%):</label>
                <input type="text" name="margem-lucro" id="margem-lucro" value="<?php echo $row_product['margem_lucro']; ?>">
                
                <label for="preco-venda">Preço de Venda (R$):</label>
                <input type="text" name="preco-venda" id="preco-venda" value="<?php echo $row_product['preco_venda']; ?>">
            </fieldset>
            
            <fieldset class="fieldset">
                <legend>Controle de Estoque</legend>
                <label for="quantidade-estoque">Quantidade para estoque:</label>
                <input type="number" name="quantidade-para-estoque" id="quantidade-para-estoque" value="<?php echo $row_product['estoque_atual']; ?>">
                
                <label for="estoque-minimo">Estoque Mínimo:</label>
                <input type="number" name="estoque-minimo" id="estoque-minimo" value="<?php echo $row_product['estoque_minimo']; ?>">
            </fieldset>
            
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
