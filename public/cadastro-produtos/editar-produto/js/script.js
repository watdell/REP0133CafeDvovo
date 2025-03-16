function verificaEstoque(elemento) {
    
    let qntd = parseFloat(document.getElementById(elemento.id).value);
    let id = elemento.id.replace("qntd-insumo-", "select-insumo-");

    let select = document.getElementById(id);

    let opcaoSelecionada = select.options[select.selectedIndex];
    let estoqueInsumo = parseFloat(opcaoSelecionada.getAttribute('data-estoque-atual'));

    if (qntd > estoqueInsumo) {
        window.alert("Estoque de insumo insuficiente");
        document.getElementById(elemento.id).value = ""
        document.getElementById(elemento.id).focus();
    }
}


function temInsumosIguais() {
    let selects = document.querySelectorAll('.insumo-select');
    let valores = new Set();

    for (let select of selects) {
        let valor = select.value;

        if (valores.has(valor) && valor !=="") {
            return true;
        }

        valores.add(valor);
    }
    return false;
}


function temInsumoVazio() {
    let selects = document.querySelectorAll('.insumo-select');

    for (let select of selects) {
        let valor = select.value;
        if (valor=='Selecione o insumo') {
            return true;
        }
    }
    return false;
}

function temCampoNumericoVazio() {
    let campos = document.querySelectorAll("input[type='number']");

    for (let campo of campos) {
        if (campo.value=="") {
            return true;
        }
    }
    return false;
}

function temValorNegativo() {
    let inputs = document.querySelectorAll("input[type='number']");

    for (let input of inputs) {
        if (parseFloat(input.value) < 0) {
            return true;
        }
    }

    return false;
}



document.getElementById("formulario-geral").addEventListener("submit", function(event) {
    event.preventDefault(); // Impede o envio inicial

    if (temInsumosIguais()) {
        window.alert("Há insumos iguais!");
    } 
    
    if (temInsumoVazio()) {
        window.alert("Selecione o insumo");
    }

    if (temValorNegativo()) {
        window.alert("Há valores negativos");
    }

    if (temCampoNumericoVazio()) {
        window.alert("Não pode ter campo numérico vazio");
    }
    
    if (!temInsumosIguais() && !temValorNegativo() && !temInsumoVazio() && !temCampoNumericoVazio()) {
        this.submit(); // Continua o envio do formulário
    }
});


function adicionarInsumo() {
    fetch('./buscar-produto.php')
    .then(response => response.json())
    .then(data => {
        
        
        // Cria um novo div para conter o select e o input
        const div = document.createElement("div");
        div.classList.add("insumo");
        div.id = `insumo-${indexJsLastIdFixedInsumos}`; // ID único para cada div

    
        // Cria o HTML para o label e o input
        const labelSelect = `<label for="select-insumo-${indexJsLastIdFixedInsumos}">Insumo: </label>`;
        const novoSelect = `<select name='insumo[]' class='insumo-select' style='width: 70%;' id='select-insumo-${indexJsLastIdFixedInsumos}'></select>`;
        const labelInput = `<label style='margin-left: 5px;' for='qntd-insumo-${indexJsLastIdFixedInsumos}'>g: </label>`;
        const input = `<input onblur='verificaEstoque(this)' style='width: 50px;' class='insumo-qntd' type="number" id="qntd-insumo-${indexJsLastIdFixedInsumos}" value='1' name="qntd-insumo[]" />`;
        const deleteIcon = `<i id='${indexJsLastIdFixedInsumos}'  onclick='deleteInsumoDiv(this)' class='icon-delete'>🗑️</i>`
        // Adiciona o select, labels e input ao div
        div.innerHTML = `${labelSelect}${novoSelect}${labelInput}${input}${deleteIcon}`;

        // Adiciona o div ao contêiner principal
        document.getElementById("div-insumos").appendChild(div);
        
        let dropdown = document.getElementById(`select-insumo-${indexJsLastIdFixedInsumos}`);
        
        // pra criar um option vazio
        const emptyOption = document.createElement('option');
        emptyOption.textContent = "Selecione o insumo";
        dropdown.appendChild(emptyOption);

        data.forEach(insumo => {
            const option = document.createElement('option');
            option.value = insumo.insumo_id;
            option.setAttribute('data-nome', insumo.nome);
            option.setAttribute('data-data_validade', insumo.data_validade);
            option.setAttribute('data-custo_unitario', insumo.custo_unitario);
            option.setAttribute('data-estoque-atual', insumo.estoque_atual);
            option.setAttribute('data-unidade_medida', insumo.unidade_medida);
            
            // Define o texto da opção no formato 'Nome - Preço/Unidade - disponível Estoque'
            option.textContent = `${insumo.nome} - R$ ${insumo.custo_unitario}/${insumo.unidade_medida} - disponível ${insumo.estoque_atual}/${insumo.unidade_medida}`;            
            dropdown.appendChild(option);    
        });

        dropdown.addEventListener('change', function() {
            somarCustoInsumos();
        });

        indexJsLastIdFixedInsumos++

    })
    .catch(error => {
        console.error('Erro ao obter insumos: ', error);
    })
  
}

//window.addEventListener('load', atualizarDropdown);
document.getElementById('add-insumo').addEventListener('click', adicionarInsumo);



// Obter o último input de nome insumo[] para depois atualizar com os novos valores via AJAX em uma outra função
// Ela tbm é usada na função adicionarInsumo para a obtenção do id do ultimo select pra fazer o clone.
function obterUltimoSelect() {
    let insumos = document.querySelectorAll('select[name="insumo[]"]');

    // Obtém o último input
    let ultimoInsumo = insumos[insumos.length - 1];

    // Retorna o valor do último input
    return ultimoInsumo.id;
}


// Essa variável global é importante para armazenar o indice atual do contador dentro da função adicionarInsumo
// Ele vai ser utilizado para diferenciar os campos gerados dinamicamente pelo javascript no atributo id. ex: id="1", id="2", etc. 
//let insumoIndex = 0;

// Função para adicionar novos campos de select <select> e input <input> para seleção de mais insumo e quantidade deste.
// Essa função utiliza o método cloneNode, que vai clonar o primeiro select já preenchido.
function adicionarInsumo1() {
    //insumoIndex++; //incremento o contador da variavel global pra servir como parte do nome dos ids dos campos gerados dinamicamente.
    indexJsLastIdFixedInsumos++;

    // Cria um novo div para conter o select e o input
    const div = document.createElement("div");
    div.classList.add("insumo");
    div.id = `insumo-${indexJsLastIdFixedInsumos}`; // ID único para cada div

    // Seleciona o select original
    const idUltimoSelect = obterUltimoSelect();
    const ultimoSelect = document.getElementById(idUltimoSelect);

    // Clona o select original
    const novoSelect = ultimoSelect.cloneNode(true);

    // Atualiza o ID, name do novo select
    novoSelect.id = `select-insumo-${indexJsLastIdFixedInsumos}`;
    novoSelect.name = "insumo[]"; // Quando a gente declara o nome de um campo dessa forma 'nome[]' o form pega todos os campos com esse nome e forma uma array com os valores desses campos e envia para a outra página via post

    // Cria o HTML para o label e o input
    const labelSelect = `<label for="select-insumo-${indexJsLastIdFixedInsumos}">Insumo: </label>`;
    const labelInput = `<label style='margin-left: 5px;' for="qntd-insumo-${indexJsLastIdFixedInsumos}">g: </label>`;
    const input = `<input style = 'width: 50px;' class='insumo-qntd' type="text" id="qntd-insumo-${indexJsLastIdFixedInsumos}" value='1' name="qntd-insumo[]" />`;
    const deleteIcon = `<i id='${indexJsLastIdFixedInsumos}'  onclick='deleteInsumoDiv(this)' class='icon-delete'>🗑️</i>`
    // Adiciona o select, labels e input ao div
    div.innerHTML = `${labelSelect}${novoSelect.outerHTML}${labelInput}${input}${deleteIcon}`;

    // Adiciona o div ao contêiner principal
    document.getElementById("div-insumos").appendChild(div);

    // Após a inserção de novo select no formulário, agora aplicamos a inserçao do evento de escuta para esse elemento.
    // Caso a pessoa selecionar a opção "Adicionar Novo Insumo" será aberto o modal.
    detectarMudancaInsumoSelects();

    //Aplicamos também a atualização do evento de escuta para input aos campos de quantidade insumo para nos mostrar o subtotal.
    // Ele tbm será utilizado no detectarMudancaInsumoSelects para atualizar o subtotal caso a pessoa mudar o insumo.
    aplicarInputListenerQntdInsumos();

    document.querySelectorAll('.insumo-qntd').forEach(input => {
        input.addEventListener('input', atualizarPesoTotal);
    });

    atualizarSpanSubtotal(); // Pra atualizar o subtotal
    somarCustoInsumos(); // pra atualizar o total
}
// Como o primeiro select de insumos não é gerado dinamicamente, então temos que chamar a função de adicionar a escuta pra mudança de opção aqui também.
detectarMudancaInsumoSelects();
// Como o primeiro input de quantidade não é gerado dinamicamente, então temos que aplicar a escuta de evento ao carregar a página também.
aplicarInputListenerQntdInsumos();

// Aqui é adicionado o evento de escuta para o click no botão de adicionar insumo. Se clicado a função de adicionarInsumo1 é acionada.
//document.getElementById('add-insumo').addEventListener('click', adicionarInsumo1);


// Função responsável por pegar o evento change no select dos insumos e verificar se a opção selecionada foi "Adicionar Novo Insumo"
function detectarMudancaInsumoSelects() {
    document.querySelectorAll('.insumo-select').forEach(select => {
        
        select.addEventListener('change', function() {
           
            atualizarSpanSubtotal(); // Importante caso a pessoa mude o insumo no select.

            // Pegando dados do atributo e levando pro input em financeiro. (novo preço)
            const resultadoSomaTotalQntd = somarCustoInsumos();
            let custoTotalUnidade = document.getElementById('custo-total-unidade');
            custoTotalUnidade.setAttribute('data-custo_total', resultadoSomaTotalQntd);
            calcMargemLucro(); // Importante para recalcular a margem de lucro lá em financeiro baseado no novo preço
        });

    });
}

let insumosRemovidos = []; 
function deleteInsumoDiv(elemento) {
    const id = elemento.id;
    const div = document.getElementById(`insumo-${id}`);
    const insumoId = elemento.getAttribute('data-insumo-id');
  
    if(insumoId) {
        insumosRemovidos.push(insumoId);
    }

    document.getElementById("insumos-removidos").value = JSON.stringify(insumosRemovidos);
    div.remove(); // Remove completamente do DOM
}




// Somar todos os preços dos insumos multiplicado pela sua quantidade
function somarCustoInsumos() {
    let totalCusto = 0;

    document.querySelectorAll('.insumo-select').forEach(select => {
        const optionSelected = select.options[select.selectedIndex];
        const custoUnitario = parseFloat(optionSelected.getAttribute('data-custo_unitario')) || 0;

        // Obtém a quantidade do insumo
        const inputQuantidade = select.closest('.insumo').querySelector('.insumo-qntd');
        const quantidade = parseFloat(inputQuantidade.value) || 0;

        // Soma o custo considerando a quantidade selecionada
        totalCusto += custoUnitario * quantidade;
    });

    return totalCusto;
}


function atualizarSpanSubtotal() {
    const spanSubTotal = document.getElementById('span-subtotal-valor');
    const result = somarCustoInsumos();
    const valorMoeda = converterParaMoeda(result);
    spanSubTotal.textContent = valorMoeda;
}

function aplicarInputListenerQntdInsumos() {
    document.querySelectorAll('.insumo-qntd').forEach(select => {
        select.addEventListener('input', () => {
            atualizarSpanSubtotal();
        });
    })
}

//atualiza o peso total
function atualizarPesoTotal() {
    let totalPeso = 0;
    
    // Seleciona todos os inputs de quantidade de insumo
    document.querySelectorAll('.insumo-qntd').forEach(input => {
        let quantidade = parseFloat(input.value) || 0; // Converte para número, trata NaN como 0
        totalPeso += quantidade;
    });
    
    // Atualiza o campo de peso total
    document.getElementById('peso-total').value = totalPeso.toFixed(2);
}

// Adiciona o evento de input para recalcular sempre que houver mudança
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.insumo-qntd').forEach(input => {
        input.addEventListener('input', atualizarPesoTotal);
    });

    // Executa a função uma vez ao carregar a página
    
    atualizarPesoTotal();
});




