// Obter o último input de nome produto[] para depois atualizar com os novos valores via AJAX em uma outra função
// Ela tbm é usada na função adicionarProduto para a obtenção do id do ultimo select pra fazer o clone.
function obterUltimoSelect() {
    let produtos = document.querySelectorAll('select[name="produto[]"]');

    // Obtém o último input
    let ultimoProduto = produtos[produtos.length - 1];

    // Retorna o valor do último input
    return ultimoProduto.id;
}


// Essa variável global é importante para armazenar o indice atual do contador dentro da função adicionarProduto
// Ele vai ser utilizado para diferenciar os campos gerados dinamicamente pelo javascript no atributo id. ex: id="1", id="2", etc. 
let produtoIndex = 0;
let ultimaLinhaInserida = document.getElementById("linhaFixa"); // Começa como a linha fixa

function adicionarProduto() {
    produtoIndex++;

    // Seleciona a linha fixa apenas para a primeira referência
    var linhaFixa = document.getElementById("linhaFixa");

    // Seleciona o último select existente
    const idUltimoSelect = obterUltimoSelect();
    const ultimoSelect = document.getElementById(idUltimoSelect);

    // Clona o select original
    const novoSelect = ultimoSelect.cloneNode(true);
    novoSelect.id = `select-produto-${produtoIndex}`;
    novoSelect.name = "produto[]"; 

    // Cria uma nova linha
    var novaLinha = document.createElement("tr");
    novaLinha.classList.add("sub-row");

    // Cria novas células (td)
    var td1 = document.createElement("td");
    td1.innerHTML = `${novoSelect.outerHTML}`;

    var td2 = document.createElement("td");
    td2.innerHTML = `<input class='produto-qntd' type='number' name='qntd-produto[]' id='produto-qntd-${produtoIndex}' min='1' oninput='calcularSubtotal(this)' style='width: 50px;' value='1'>`;

    var td3 = document.createElement("td");
    td3.innerHTML = `<input class='valor-unit' type='text' name='valor-unit[]' id='valor-unit-${produtoIndex}' style='width: 70px;'>`;

    var td4 = document.createElement("td");
    td4.innerHTML = `<input class='sub-total' type='text' name='sub-total[]' id='sub-total-${produtoIndex}' style='width: 70px;'>`;

    var td5 = document.createElement("td");
    var btnRemover = document.createElement("button");
    btnRemover.classList.add("icon-delete");
    btnRemover.innerHTML = "🗑️";
    btnRemover.onclick = function() {
        novaLinha.remove();
        // Se a linha removida for a última, ajustamos a referência para a anterior
        if (ultimaLinhaInserida === novaLinha) {
            ultimaLinhaInserida = document.getElementById("linhaFixa");
        }
        atualizarTotal();
    };


    td5.appendChild(btnRemover);

    // Adiciona as células na nova linha
    novaLinha.appendChild(td1);
    novaLinha.appendChild(td2);
    novaLinha.appendChild(td3);
    novaLinha.appendChild(td4);
    novaLinha.appendChild(td5);

    // Insere a nova linha abaixo da última linha inserida
    ultimaLinhaInserida.parentNode.insertBefore(novaLinha, ultimaLinhaInserida.nextSibling);

    // Atualiza a referência da última linha inserida
    ultimaLinhaInserida = novaLinha;

    let preco_unit1 = parseFloat(document.getElementById("valor-unit").value);
    let qntd1 = parseFloat(document.getElementById("produto-qntd").value);
    document.getElementById(`valor-unit-${produtoIndex}`).value = parseFloat(preco_unit1).toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById(`sub-total-${produtoIndex}`).value = (parseFloat(preco_unit1) * parseFloat(1)).toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    //Aqui ele coloca o onchange no select que foi criado dinamicamente
    detectarMudancaProdutoSelects();
    atualizarTotal();

}

// Aqui é adicionado o evento de escuta para o click no botão de adicionar insumo. Se clicado a função de adicionarInsumo1 é acionada.
document.getElementById('add-produto').addEventListener('click', adicionarProduto);


// Nâo está em uso agora, mas pode ser útil em um outro momento.
/*
function AtualizarDadosProduto(id) {
    let params = new URLSearchParams({ id: id });

    fetch(`./buscar-dados-produto.php?${params.toString()}`)
        .then(response => response.json()) // Converte a resposta para JSON
        .then(data => {
            if (data.erro) {
                alert("Erro: " + data.erro); // Se houver erro, exibe o alerta
            } else {
                //alert("Produto ID: " + data.produto_id); // Exibe o ID no alerta            
            }
        })
        .catch(error => {
            console.error('Erro na requisição:', error);
            alert('Ocorreu um erro. Tente novamente.');
        });
}*/


// Função responsável por pegar o evento change no select dos insumos e verificar se a opção selecionada foi "Adicionar Novo Insumo"
function detectarMudancaProdutoSelects() {
    document.querySelectorAll('.produto-select').forEach(select => {
        
        select.addEventListener('change', function() {            
            AtualizarDadosProduto(this.value); // Envia o valor selecionado (ID do produto) 
        });

    });
}

// Esse aqui é pra quando carregar a página pra ele colocar o onchange no primeiro select estático criado.
window.addEventListener('load', detectarMudancaProdutoSelects);


function atualizarPreco(select) {
    let selectedOption = select.options[select.selectedIndex]; // Obtém a opção selecionada
    let precoUnitario = selectedOption.getAttribute("data-preco"); // Obtém o preço do atributo data-preco
    
    let row = select.closest("tr"); // Encontra a linha correspondente
    row.querySelector(".valor-unit").value = parseFloat(precoUnitario).toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2 }); // Define o valor unitário
    calcularSubtotal(row.querySelector(".produto-qntd")); // Atualiza o subtotal
    atualizarTotal();
}

function calcularSubtotal(input) {
    let row = input.closest("tr");
    let preco = parseFloat(row.querySelector(".valor-unit").value) || 0;
    let qntd = parseInt(input.value) || 0;
    row.querySelector(".sub-total").value = (preco * qntd).toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    atualizarTotal();
}

function atualizarTotal() {
    let subtotal = 0;

    // Soma os subtotais dos produtos
    document.querySelectorAll(".sub-total").forEach(input => {
        let valor = parseFloat(input.value.replace(",", ".")) || 0; // Converte vírgula para ponto
        subtotal += valor;
    });

    let desconto = parseFloat(document.getElementById("desconto").value.replace(",", ".")) || 0;
    let total = subtotal - desconto;

    // Evita valores negativos
    if (total < 0) {
        total = 0;
    }

    // Exibe o total formatado com vírgula
    document.getElementById("total").innerText = total.toLocaleString("pt-BR", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

// Distribui o evento para ser atualizado o subtotal e o total quando o usuario digitar algo nos inputs de quantidade e desconto, criados de forma fixa 
document.querySelectorAll(".produto-qntd, .desconto").forEach(input => {
    input.addEventListener("input", atualizarTotal);
});

// Atualiza o preço unitário e subtotal do primeiro select que é carregado de forma fixa junto com a página
let select = document.getElementById('select-produto-0');
atualizarPreco(select);




