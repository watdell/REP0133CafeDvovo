<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/cadastrar-produtos/forms-style.css">
    <link rel="stylesheet" href="../assets/css/cadastrar-produtos/tabs-style.css">
    <link rel="stylesheet" href="../assets/css/cadastrar-produtos/modal-style.css">
    <link rel="stylesheet" href="../assets/css/cadastrar-produtos/confirmar-style.css">
    <title>Cadastro - Produto</title>
</head>
<body> 
    
    <?php include('../../includes/produtos-sidebar.php'); ?>
    <?php include('../../includes/topbar.php'); ?>

    <main class="content">
        <div class="navbar" id="navbar"></div>
        <section class="tab">
            <button id="btn-tab-produto" class="tablinks" onclick="abrirFormulario(event, 'produto')">Produto</button>
            <button id="btn-tab-insumos" class="tablinks" onclick="irProximoFormulario(event, 'insumos')">Insumos</button>
            <button id="btn-tab-financeiro" class="tablinks" onclick="irProximoFormulario(event, 'financeiro')">Financeiro</button>
            <button id="btn-tab-estoque" class="tablinks" onclick="irProximoFormulario(event, 'estoque')">Estoque</button>
        </section>

        <form id="formulario-geral" method="post" class="form-group" action="../../../serverside/controllers/produtos/cadastrar-produto.php" enctype="multipart/form-data">
            <section id="produto" class="tabcontent"> 
                <fieldset class="fieldset">
                    <legend>Cadastro de Produto</legend>

                    <label for="nome-produto">Nome do Produto:</label>
                    <div class="input-container">
                        <input type="text" style="margin-bottom: 0px;" name="nome-produto" id="nome-produto" placeholder="Ex: Cápsula de Café">
                        <div id="suggestions" class="suggestions"></div>
                    </div>
                    
                    <label style="margin-top: 10px;" for="descricao-produto">Descrição do Produto:</label>
                    <textarea name="descricao-produto" id="descricao-produto" placeholder="Descreva o produto" rows="4" cols="50"></textarea>
                    
                    <label for="tipo-venda">Tipo de Venda:</label>
                    <select name="tipo-venda" id="tipo-venda">
                        <option value="pacote">Pacote</option>
                        <option value="capsula">Cápsula</option>
                    </select>
                    
                    <div id="opcoes-pacote" class="tipo-venda-opcoes">
                        <label for="peso-por-pacote">Peso por Pacote (g):</label>
                        <input type="number" name="peso-por-pacote" id="peso-por-pacote" step="1" placeholder="Ex: 250">
                    </div>

                    <div id="opcoes-capsula" class="tipo-venda-opcoes" style="display: none;">
                        <label for="quantidade-capsulas">Nº de Cápsulas no Pacote:</label>
                        <input type="number" style="width: 80px;" name="quantidade-capsulas" id="quantidade-capsulas" placeholder="Ex: 10">
                        <label for="peso-por-capsula">Peso por Cápsula (g):</label>
                        <input type="number" style="width: 80px;" name="peso-por-capsula" id="peso-por-capsula" step="1" placeholder="Ex: 5">
                        <label for="peso-total-capsulas">Total (g):</label>
                        <input type="number" name="peso-total-capsulas" id="peso-total-capsulas" step="0.01" placeholder="Ex: 5" disabled>
                    </div>
                    
                    <!--<div id="opcoes-kit" class="tipo-venda-opcoes" style="display: none;">
                        <label for="quantidade-kit">Quantidade de Itens no Kit:</label>
                        <input type="number" style="width: 80px;" name="quantidade-kit" id="quantidade-kit" placeholder="Ex: 10">
                        <label for="peso-total-kit">Peso Total do Kit (g):</label>
                        <input type="number" name="peso-total-kit" id="peso-total-kit" step="1" placeholder="Ex: 500">
                    </div> -->
                </fieldset>
                <!-- Campo para Upload da Imagem -->
                <div class="imagem-upload">
                    <label for="imagem-produto">
                        <img id="preview-imagem" src="../assets/images/img_padrao_cafe.png" alt="Pré-visualização da Imagem do Produto" class="imagem-preview">
                    </label>
                    <input type="file" name="imagem-produto" id="imagem-produto" accept="image/*" style="display: none;" onchange="previewImage(event)">
                    <button type="button" class="btn-upload" onclick="document.getElementById('imagem-produto').click()">📷 Adicionar Imagem</button>
                </div>
            </section>
            
            <section id="insumos" class="tabcontent"> 
                <fieldset class="fieldset">
                    <legend>Insumos do Produto</legend>
                    <div class="div-insumo-pesototal-subtotal">
                        <div>
                            <label>Peso Unidade:</label>
                            <input style="width: 60px" type="text" id="peso-total" name="peso-total" value="" disabled> g
                        </div>
                        <div>
                            <span id="span-subtotal">Sub-Total:&nbsp;</span> 
                            <span id="span-subtotal-valor">R$ 0,00</span>
                        </div>
                    </div>
                    <div id="div-insumos">
                        <div class="insumo">
                            <label id="label-insumo" for="insumo-1">Insumo:</label>
                            <select style="width: 70%;" class="insumo-select" name="insumo[]" id="select-insumo-0">
                                <option>Saborizante de Caramelo - R$ 12/ml - disponível 1000/ml</option>                
                            </select>
                            <label for="quantidade-insumo-1">g:</label>
                            <input class="insumo-qntd" type="text" name="qntd-insumo[]" id="quantidade-insumo-0" style="width: 50px;" step="1">
                            <i id="0" onclick="deleteInsumoDiv(this)" class="icon-delete">🗑️</i>
                        </div>
                    </div>
                    <input id="insumo-menor-data" name="menor-data" type="text" hidden>
                    <input id="qntd-insumo-lista" name="qntd-insumo-lista[]" type="text" hidden>
                    <button id="add-insumo" type="button" class="register-btn">Adicionar insumo</button>
                </fieldset>
            </section>
            
            <section id="financeiro" class="tabcontent"> 
                <fieldset class="fieldset">
                    <legend>Informações Financeiras</legend>
                    <label for="custo-total-unidade">Custo Total por Unidade (R$):</label>
                    <input type="text" value="" name="custo-total-unidade" id="custo-total-unidade" step="1" placeholder="Ex: 10.00" disabled>
                    
                    <label for="margem-lucro">Margem de Lucro (%):</label>
                    <input type="number" name="margem-lucro" id="margem-lucro" step="1" placeholder="Ex: 20">
                    
                    <label for="preco-venda">Preço de Venda (R$):</label>
                    <input type="text" name="preco-venda" id="preco-venda" step="1" placeholder="Ex: 15.00" disabled>
                </fieldset>
            </section>

            <section id="estoque" class="tabcontent"> 
                <fieldset id="fieldset-estoque" class="fieldset">
                    <legend>Controle de Estoque</legend>
                    <label for="quantidade-estoque">Quantidade para estoque:</label>
                    <input type="number" name="quantidade-para-estoque" id="quantidade-para-estoque" value="1" placeholder="Quantidade para ter em estoque.">
                    
                    <label for="estoque-minimo">Estoque Mínimo:</label>
                    <div class="qntd-estoque-total-container">
                        <input type="number" name="estoque-minimo" value="0" id="estoque-minimo" placeholder="Ex: 10">  
                        <div id="check-estoque-possibilidade" class="check-estoque-possibilidade">Disponibilidade</div>
                    </div>
                    
                    <button type="button" onclick="submitForm()" class="register-btn">Salvar</button>
                </fieldset>
            </section>
        </form>
        <!-- Modal para add novo insumo -->
        <div id="modal-novo-insumo" class="modal">
            <div class="modal-content">
                <span id="close-modal" class="close">&times;</span>
                <h2>Criar Novo Insumo</h2>
                <form id="form-insumo" class="modal-form">
                    <label for="nome-insumo">Nome do Insumo:</label>
                    <input type="text" id="nome-insumo" name="insumo" placeholder="Ex: Café">
                    
                    <label for="estoque-atual">Quantidade em Estoque:</label>
                    <input type="number" id="estoque-atual" name="estoque-atual" placeholder="Ex: 150">
                    
                    <label for="unidade-medida">Medida:</label>
                    <select name="unidade-medida" id="unidade-medida">
                        <option value="g">g</option>
                        <option value="ml">ml</option>
                        <option value="un">un</option>
                        <option value="kg">kg</option>
                        <option value="l">l</option>
                    </select>

                    <label for="custo-total">Custo Total:</label>
                    <input type="number" id="custo-total" name="custo-total" placeholder="Ex: 500,00">

                    <label for="custo-unitario">Custo Unitário:</label>
                    <input type="text" id="custo-unitario" name="custo-unitario" placeholder="Automático" readonly>

                    <label for="data-validade">Data de Validade:</label>
                    <input type="date" id="data-validade" name="data-validade">
                    
                    <button id="btn-criar-insumo" type="button" onclick="adicionarInsumo()" class="openModal">Adicionar Insumo</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Modal para confirmar o cadastro de produto -->
    <div id="main-confirmar-produto" class="main-confirmar-produto">
        <div class="container-confirmar-produto">
            
            <!-- Card de um produto -->
            <div class="product-card">
                <div class="product-header">
                    <h2>Nome do Produto: <span id="nome-produto1"></span></h2>
                    <p>Data de Cadastro: <span id="data-cadastro1"></span> </p>
                </div>
                
                <div class="product-info">
                    <p><strong>Quantidade:</strong> <span id="quantidade1"></span></p>
                    <p><strong>Peso Total:</strong> <span id="peso-total1"></span></p>
                    <p><strong>Validade do Produto:</strong> <span id="validade1"></span></p>
                </div>
                
                <!-- Lista de insumos -->
                <div class="insumos-list">
                    <h3>Insumos:</h3>
                    <ul id="insumos-ul1"> 
                    </ul>
                </div>
                
                <!-- Resumo de custos -->
                <div class="cost-summary">
                    <h3>Resumo de Custos:</h3>
                    <ul>
                        <li><span>Custo Total dos Insumos</span><span id="custo-total-insumos1"></span></li>
                        <li><span>Margem de Lucro</span><span id="margem-lucro1"></span></li>
                        <li class="total"><span>Preço de Venda</span><span id="preco-venda1"></span></li>
                    </ul>
                </div>
            </div>
            
            <!-- Botão para exportar ou imprimir o relatório -->
            <div>
                <button type="button" id="confirmarEnvio"  class="btn-export">Confirmar</button>
                <button type="button" id="cancelarEnvio" class="btn-export">Voltar</button>
            </div>
        </div>
    </div>

    <script src="../assets/js/main.js"></script>    
    <script src="../assets/js/cadastro-produtos/ajax.js"></script>   
    <script src="../assets/js/cadastro-produtos/confirmar-cadastro.js"></script>   
    <script src="../assets/js/cadastro-produtos/controle-abas.js"></script>   
    <script src="../assets/js/cadastro-produtos/conversores-valor.js"></script>   
    <script src="../assets/js/cadastro-produtos/sessao-envio-form.js"></script>   
    <script src="../assets/js/cadastro-produtos/sessao-estoque.js"></script>   
    <script src="../assets/js/cadastro-produtos/sessao-financeiro.js"></script>   
    <script src="../assets/js/cadastro-produtos/sessao-insumos.js"></script>   
    <script src="../assets/js/cadastro-produtos/sessao-modal.js"></script>
    <script src="../assets/js/cadastro-produtos/sessao-produto.js"></script>      
    <script src="../assets/js/cadastro-produtos/validadores.js"></script>   
</body>
</html>
