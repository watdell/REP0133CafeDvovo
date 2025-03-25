<!-- Modal para edição de informações -->
<div id="container-modal-edicao" class="container-modal-edicao" style="display: visible;">
    <div id="edicao-container" class="edicao-container">
        <!-- Cabeçalho do Modal -->
        <header class="edicao-header">
            <h1>Editar Produto</h1>
            <button onclick="fecharModalEdicao()" class="btn-fechar">✖</button>
        </header>

        <!-- Formulário de Edição -->
        <form id="form-edicao-produto">
            <div class="grid-container">
                <!-- Informações Básicas -->
                <section class="info-produto">
                    <h2>Informações do Produto</h2>
                    <label>Nome do Produto:</label>
                    <input type="text" id="edit-nome-produto">
                    
                    <label>Data de Cadastro:</label>
                    <input type="date" id="edit-data-cadastro">
                    
                    <label>Tipo de Venda:</label>
                    <input type="text" id="edit-tipo-venda">
                    
                    <label>Descrição:</label>
                    <textarea id="edit-descricao-produto"></textarea>
                    
                    <label>Peso por Unidade:</label>
                    <input type="number" id="edit-peso-unidade" step="0.01">
                </section>

                <!-- Insumos -->
                <section class="insumos-utilizados">
                    <h2>Insumos Utilizados</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Insumo</th>
                                <th>Quantidade</th>
                                <th>Unidade</th>
                                <th>Custo Total</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-edit-insumos">
                            <!-- Linhas dinâmicas para edição de insumos -->
                        </tbody>
                    </table>
                    <button type="button" onclick="adicionarInsumoLinha()">+ Adicionar Insumo</button>
                </section>

                <!-- Informações Financeiras -->
                <section class="info-financeira">
                    <h2>Informações Financeiras</h2>
                    <label>Custo Total por Unidade:</label>
                    <input type="number" id="edit-custo-total" step="0.01">
                    
                    <label>Margem de Lucro (%):</label>
                    <input type="number" id="edit-margem-lucro" step="0.01">
                    
                    <label>Preço de Venda:</label>
                    <input type="number" id="edit-preco-venda" step="0.01">
                    
                    <label>Quantidade em Estoque:</label>
                    <input type="number" id="edit-quantidade-estoque">
                    
                    <label>Estoque Mínimo:</label>
                    <input type="number" id="edit-estoque-minimo">
                </section>
            </div>
            
            <input type="hidden" id="edit-produto-id">
            
            <button type="submit" class="btn-salvar">💾 Salvar Alterações</button>
        </form>
    </div>
</div>

<style>
.container-modal-edicao {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.edicao-container {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 70%;
    max-width: 900px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

.edicao-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.grid-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.insumos-utilizados {
    grid-column: span 2;
}

.btn-fechar {
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
}

form label {
    display: block;
    font-weight: bold;
    margin-top: 10px;
}

form input, form textarea, form select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button.btn-salvar {
    margin-top: 15px;
    padding: 10px;
    width: 100%;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}

button.btn-salvar:hover {
    background: #218838;
}

.insumos-utilizados table {
    width: 100%;
    margin-top: 10px;
    border-collapse: collapse;
}

.insumos-utilizados th, .insumos-utilizados td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}
</style>
