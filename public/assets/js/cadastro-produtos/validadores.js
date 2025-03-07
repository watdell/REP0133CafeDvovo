
function validarFormSessaoProduto() {
    let mensagem = [];
    const divSuggestion = document.getElementById('suggestions');
    const nomeProduto = document.getElementById('nome-produto');
    const descricaoProduto = document.getElementById('descricao-produto');
    const selectTipoVenda = document.getElementById('tipo-venda');
    const optionSelectedTipoVenda = selectTipoVenda.options[selectTipoVenda.selectedIndex].value;

    const pesoPorPacote = document.getElementById('peso-por-pacote');
    const pesoTotalCapsulas = document.getElementById('peso-total-capsulas');

    if (!nomeProduto.value) {
        mensagem.push("Erro: Digite um nome para o produto. \n");
        nomeProduto.focus();
    }
    if (divSuggestion.innerHTML.trim()) {
        mensagem.push("Erro: Produto existente na base de dados. \n");
        nomeProduto.value = "";
        divSuggestion.style.display = 'none';
        nomeProduto.focus();
    }
    if (!descricaoProduto.value) {
        mensagem.push("Erro: Preencha o campo descrição. \n");
        descricaoProduto.focus()
    }

    switch(optionSelectedTipoVenda) {
        case 'pacote':
            if (!pesoPorPacote.value || parseFloat(pesoPorPacote.value) <= 0 ) {
                mensagem.push("Erro: Informe o peso do pacote (g). \n");
                pesoPorPacote.focus();
            }
        break;
        case 'capsula':
            if (!pesoTotalCapsulas.value || parseFloat(pesoTotalCapsulas.value) <= 0 ) {
                mensagem.push("Erro: Informe a Nº e o peso por cápsula. \n");
                document.getElementById('quantidade-capsulas').focus();
            }
        break;
    }

    return mensagem;
}



function validarFormSessaoInsumos() {
    let pesoTotalProduto = document.getElementById('peso-total');
    pesoTotalProduto = parseFloat(pesoTotalProduto.value);

    const allSelectsInsumo = document.querySelectorAll('.insumo-select');
    const allQntdInsumo = document.querySelectorAll('.insumo-qntd');

    let mensagem = [];

    let insumosColetados = [];

    for (const select1 of allSelectsInsumo) {
        const optionSelected = select1.options[select1.selectedIndex];

        if (insumosColetados.includes(optionSelected.value)) {
            const msgErro = `Erro: Insumo duplicado: ${optionSelected.textContent} \n`
            if (mensagem.includes(msgErro)) {
                continue;
            } 
            mensagem.push(msgErro);
        }
        insumosColetados.push(optionSelected.value);
    }

    let soma = 0;
    for (const qntd of allQntdInsumo) {
        if (qntd.value == '' || parseFloat(qntd.value) < 0) {
            const msgErro = "Erro: Digite uma quantidade de insumo válida. \n";
            if (mensagem.includes(msgErro)) {
                continue;
            }
            mensagem.push(msgErro);
        }
        if (parseFloat(qntd.value) == 0) {
            const msgErro = "Erro: Qntd de insumo precisa ser maior que zero. \n";
            if (mensagem.includes(msgErro)) {
                continue;
            }
            mensagem.push(msgErro);
        }
        soma += parseFloat(qntd.value);
    }

    console.log(soma);
    if (soma != pesoTotalProduto) {
        mensagem.push("Erro: A soma da quantidade de insumo precisa ser igual ao peso total! \n");
    } else {
        const resultadoSomaTotalQntd = somarCustoInsumos();
        const menorDataValidadeInsumo = verMenorData();

        if (resultadoSomaTotalQntd) {
            let custoTotalUnidade = document.getElementById('custo-total-unidade');
            let inputEscondidoMenorData = document.getElementById('insumo-menor-data');

            // Convertemos em valor moeda
            const valorMoeda = converterParaMoeda(resultadoSomaTotalQntd);

            // Atualizamos o valor do input desabilitado da sessão financeiro com o valor do total dos insumos para referência
            custoTotalUnidade.value = "";
            custoTotalUnidade.value = valorMoeda.trim();
            custoTotalUnidade.setAttribute('data-custo_total', resultadoSomaTotalQntd);

            // Colocamos o valor da menor data de validade dos insumos para poder ser enviada pelo formulário no final.
            // Ela será a data de validade do produto.
            inputEscondidoMenorData.value = menorDataValidadeInsumo;
            console.log(inputEscondidoMenorData.value);
        }
    }

    return mensagem;
}


function validarFormSessaoFinanceiro() {
    mensagem = [];
    const margemLucro = document.getElementById('margem-lucro');
    if (!margemLucro.value) {
        mensagem.push("Erro: Digite a margem de lucro. \n");
    }
    return mensagem;
}


function obterMenorDataValidade(datasDeValidade) {
    const dataHoje = new Date();
    let menorData = null;

    for (const dataValidade of datasDeValidade) {
        const data = new Date(dataValidade);
        if (data >= dataHoje) {
            if (menorData === null || data < menorData) {
                menorData = data;
            }
        }
    }
    return menorData ? menorData.toISOString().split('T')[0] : null;
}

function obterDatasValidade() {
    let listaDatas = [];
    
    document.querySelectorAll(".insumo-select").forEach(data => {
        const opcaoSelecionada = data.options[data.selectedIndex];
        const validade = new Date(opcaoSelecionada.getAttribute('data-data_validade'));
        listaDatas.push(validade);
    });
    
    return listaDatas; 
}  

function verMenorData() {
    const listaDatas = obterDatasValidade();
    const menorData = obterMenorDataValidade(listaDatas);
    
    return menorData;
}
