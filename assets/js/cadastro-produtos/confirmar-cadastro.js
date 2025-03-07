

// Função para preencher os dados no modal de confirmação
function preencherModal() {
    // Variáveis dos campos que serão usados para preencher o modal
    const nome_produto = document.getElementById('nome-produto').value;
    const descricao_produto = document.getElementById('descricao-produto').value; // Pode não ser usado no modal
    const tipo_venda = document.getElementById('tipo-venda').value; // Pode não ser usado no modal
    const peso_por_pacote = document.getElementById('peso-por-pacote').value;
    const quantidade_capsulas = document.getElementById('quantidade-capsulas').value;
    const peso_por_capsula = document.getElementById('peso-por-capsula').value;
    const peso_total_capsulas = document.getElementById('peso-total-capsulas').value;
    const peso_total = document.getElementById('peso-total').value;
    const insumos = document.getElementsByName('insumo[]'); // Para array de insumos
    const qntd_insumos = document.getElementsByName('qntd-insumo[]'); // Para array de quantidades de insumos
    const menor_data = document.getElementById('insumo-menor-data').value; // Campo oculto
    const custo_total_unidade = document.getElementById('custo-total-unidade').value; // Pode não ser usado no modal
    const margem_lucro = document.getElementById('margem-lucro').value;
    const preco_venda = document.getElementById('preco-venda').value;
    const quantidade_para_estoque = document.getElementById('quantidade-para-estoque').value;
    const estoque_minimo = document.getElementById('estoque-minimo').value;

    // Variáveis para o modal com base nos IDs
    const nome_produto_modal = document.getElementById('nome-produto1');
    const data_cadastro_modal = document.getElementById('data-cadastro1');
    const quantidade_modal = document.getElementById('quantidade1');
    const peso_total_modal = document.getElementById('peso-total1');
    const validade_modal = document.getElementById('validade1');
    const insumos_lista_modal = document.getElementById('insumos-ul1');
    const custo_total_insumos_modal = document.getElementById('custo-total-insumos1');
    const margem_lucro_modal = document.getElementById('margem-lucro1');
    const preco_venda_modal = document.getElementById('preco-venda1');

    const hoje = new Date().toLocaleDateString(); // Data atual

    nome_produto_modal.textContent = `${nome_produto}`;
    data_cadastro_modal.textContent = `${hoje}`;
    quantidade_modal.textContent = quantidade_para_estoque; // Usando a quantidade para estoque
    peso_total_modal.textContent = `${peso_total} g`; // Usando o peso total
    validade_modal.textContent = menor_data; // Usando a data mínima (ou validade)

    // Preencher a lista de insumos
    insumos_lista_modal.innerHTML = ''; // Limpa a lista antes de adicionar novos insumos
    for (let i = 0; i < insumos.length; i++) {
        if (insumos[i].value) {
            // Criando um elemento li
            const li = document.createElement('li');
            // Buscando o atributo data-nome na opção do select que foi selecionado.
            let optionselected = insumos[i].options[insumos[i].selectedIndex];
            const nome = optionselected.getAttribute('data-nome');
            const unidadeMedida = optionselected.getAttribute('data-unidade_medida');
            const custoUnitario = optionselected.getAttribute('data-custo_unitario');
            const qntd = qntd_insumos[i].value;
            const subTotal = parseFloat(custoUnitario) * parseFloat(qntd);
            const subTotalvalorMoeda = converterParaMoeda(subTotal);
            li.innerHTML = `<div>${nome}</div><div class="div-qntd-unit-subtotal"><div>${qntd}&nbsp; X &nbsp; R$ ${custoUnitario}/${unidadeMedida}</div><div>Sub-total: ${subTotalvalorMoeda}</div></div>`; // Usando o valor do insumo

            insumos_lista_modal.appendChild(li);
        }
    }

    // Preencher resumo de custos
    custo_total_insumos_modal.textContent = `${custo_total_unidade}`; // Exemplo, pode precisar de ajuste
    margem_lucro_modal.textContent = `${margem_lucro}%`;
    preco_venda_modal.textContent = `${preco_venda}`;
}


function fecharConfirmarCadastro(){
    document.getElementById('main-confirmar-produto').style.display = "none";
}

function abrirConfirmarCadastro(){
    document.getElementById('main-confirmar-produto').style.display = "flex";
}