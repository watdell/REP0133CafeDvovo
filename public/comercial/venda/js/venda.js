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
    td2.innerHTML = `<input class='produto-qntd' type='number' name='qntd-produto[]' id='produto-qntd-${produtoIndex}' min='1' oninput='calcularSubtotal(this)' style='width: 60px;' value='1'>`;

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


function atualizarPreco(select) {
    let selectedOption = select.options[select.selectedIndex]; 
    let precoUnitario = parseFloat(selectedOption.getAttribute("data-preco")) || 0;

    let row = select.closest("tr");
    row.querySelector(".valor-unit").value = formatarNumero(precoUnitario); 
    calcularSubtotal(row.querySelector(".produto-qntd")); 
    atualizarTotal();
}

function calcularSubtotal(input) {
    let row = input.closest("tr");
    let preco = converterParaNumero(row.querySelector(".valor-unit").value);
    let qntd = converterParaNumero(input.value);
    let subtotal = preco * qntd;

    row.querySelector(".sub-total").value = formatarNumero(subtotal);
    atualizarTotal();
}

function atualizarTotal() {
    let subtotal = 0;

    document.querySelectorAll(".sub-total").forEach(input => {
        let numero = converterParaNumero(input.value);
        subtotal += numero;
    });

    let desconto = converterParaNumero(document.getElementById("desconto").value);
    let total = subtotal - (subtotal * desconto / 100);

    if (total < 0) total = 0;

    document.getElementById("total").value = formatarNumero(total, 2); // 4 casas decimais
}

// 🔹 Função para converter valores formatados em número (1.234,56 → 1234.56)
function converterParaNumero(valor) {
    if (!valor) return 0;
    return parseFloat(valor.replace(/\./g, "").replace(",", ".")) || 0;
}

// 🔹 Função para formatar número no padrão brasileiro (1234.56 → "1.234,56")
function formatarNumero(valor, casasDecimais = 2) {
    return valor.toLocaleString("pt-BR", { minimumFractionDigits: casasDecimais, maximumFractionDigits: casasDecimais });
}

document.querySelectorAll(".produto-qntd, #desconto").forEach(input => {
    input.addEventListener("input", atualizarTotal);
});

let select = document.getElementById('select-produto-0');
atualizarPreco(select);

document.getElementById('formulario-geral').addEventListener('submit', function(event) {
    event.preventDefault();

    if (emptyValueQntd()) {
        alert("Preencha a quantidade!");
        return;
    }

    if (confirm("Deseja registrar essa venda?")) {
        this.submit();
    }
});

function emptyValueQntd() {
    return Array.from(document.querySelectorAll('.produto-qntd')).some(element => !element.value);
}