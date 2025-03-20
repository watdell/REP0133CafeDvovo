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
    btnRemover.classList.add("button-smal");
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


function enviarParametrosAjax() {
    let params = new URLSearchParams({
        cep_origem: document.getElementById("cep_origem").value,
        cep_destino: document.getElementById("cep_destino").value,
        peso: document.getElementById("peso").value,
        valor_declarado: document.getElementById("valor_declarado").value,
        largura: document.getElementById("largura").value,
        altura: document.getElementById("altura").value,
        comprimento: document.getElementById("comprimento").value
    });

    // Faz a requisição GET com os parâmetros na URL
    fetch(`calculo-frete.php?${params.toString()}`, {
        method: "GET"
    })
    .then(response => {
        console.log(response); // Log da resposta para debug

        if (!response.ok) {
            throw new Error("Erro na resposta do servidor: " + response.statusText);
        }

        return response.text(); // Primeiro retorna como texto para debug
    })
    .then(texto => {
        console.log("Resposta do servidor:", texto);

        try {
            const data = JSON.parse(texto);

            let resultado = "";
            if (data && Array.isArray(data)) {
                data.forEach((servico, index) => {
                    if (!servico.error) {
                        resultado += `
                            <label style="display:block; cursor:pointer;">
                                <div style='display:flex; flex-direction:row; gap:10px'>
                                    <div> 
                                        <input onclick='registrarVenda()' type="radio" style="margin-top:10px" name="frete" value='${JSON.stringify(servico)}'>  
                                    </div>
                                    <div>
                                        <strong>${servico.name}</strong>
                                        <br>
                                        <div style='display:flex; flex-direction:row;'>
                                            Prazo: <input type='number' oninput='registrarVenda()' style='width: 60px; height: 20px; margin-bottom: 0px;' value='${servico.delivery_time}' > &nbsp;dias 
                                        </div>
                                        Valor: R$ ${servico.price}
                                    </div>
                                </div>
                            </label>
                            <br><br>
                        `;
                    } else {
                        resultado += `${servico.name}: ${servico.error}<br><br>`; 
                    }
                });

                // Adiciona o botão de registrar venda
                //resultado += `<button id="registrar-venda-btn">Registrar Venda</button>`;
            } else {
                resultado = "Erro ao calcular o frete.";
            }

            document.getElementById("resultado").innerHTML = resultado;

            // Adiciona o evento ao botão "Registrar Venda"
            //document.getElementById("registrar-venda-btn").addEventListener("click", registrarVenda);
        } catch (e) {
            console.error("Erro ao analisar a resposta como JSON:", e);
            document.getElementById("resultado").innerHTML = "Erro ao calcular o frete.";
        }
    })
    .catch(error => console.error("Erro:", error));
}

document.getElementById('cliente').addEventListener('change', enviarParametrosAjax);

document.getElementById("calcular-frete-btn").addEventListener("click", function(event) {
    // Captura os valores dos campos
    enviarParametrosAjax();
});

// Função para capturar o serviço selecionado e enviá-lo ao backend
function registrarVenda() {
    let selecionado = document.querySelector("input[name='frete']:checked");

    if (!selecionado) {
        alert("Selecione um serviço de frete antes de registrar a venda.");
        return;
    }

    let servicoSelecionado = JSON.parse(selecionado.value);

    let prazoInput = selecionado.closest("label").querySelector("input[type='number']"); // Encontra o input mais próximo

    let nomeFrete = document.getElementById('nome-frete');
    let prazoFrete = document.getElementById('prazo-frete');
    let valorFrete = document.getElementById('valor-frete');

    nomeFrete.value = servicoSelecionado.name;
    prazoFrete.value = prazoInput ? prazoInput.value : servicoSelecionado.delivery_time; // Usa o valor do input ou do JSON como fallback
    valorFrete.value = servicoSelecionado.price;

    atualizarDataEntrega();
    formatarData();
}


function atualizarDataEntrega() {
    let prazoInput = document.getElementById("prazo-frete");
    let dataEntregaSpan = document.getElementById("data-entrega");

    let prazo = parseInt(prazoInput.value, 10);
    if (isNaN(prazo) || prazo < 0) {
        dataEntregaSpan.textContent = "Data inválida";
        return;
    }

    let hoje = new Date();
    hoje.setDate(hoje.getDate() + prazo); // Soma o prazo em dias à data atual

    let dataFormatada = hoje.toLocaleDateString("pt-BR", {
        weekday: "long",
        day: "2-digit",
        month: "long",
        year: "numeric"
    });

    dataEntregaSpan.value = dataFormatada;
}


function formatarData() {
    const dataTexto = document.getElementById('data-entrega').value;
  
    // Convertendo o formato 'segunda-feira, 26 de março de 2025' para '2025-03-26'
    // Usamos uma função para mapear o nome dos meses para o formato correto
    const meses = {
      "janeiro": "01",
      "fevereiro": "02",
      "março": "03",
      "abril": "04",
      "maio": "05",
      "junho": "06",
      "julho": "07",
      "agosto": "08",
      "setembro": "09",
      "outubro": "10",
      "novembro": "11",
      "dezembro": "12"
    };
  
    // Remover o dia da semana (ex: "segunda-feira,")
    const partes = dataTexto.split(", ");
    const dataFormatada = partes[1].split(" de ");
    const dia = dataFormatada[0].padStart(2, '0'); // Adiciona zero à esquerda, se necessário
    const mes = meses[dataFormatada[1].toLowerCase()];
    const ano = dataFormatada[2];
  
    // Formato final 'yyyy-mm-dd'
    const dataParaBanco = `${ano}-${mes}-${dia}`;
  
    // Preencher o campo hidden
    document.getElementById('dataFormatoBanco').value = dataParaBanco;
  }

  // Função para preencher o CEP quando o usuário mudar o cliente
    function mudarCliente() {
        let select_cliente = document.getElementById('cliente');

        // Obtém a opção selecionada corretamente
        let optionSelected = select_cliente.options[select_cliente.selectedIndex];

        let cep = optionSelected.getAttribute('data-cep');

        document.getElementById('cep_destino').value = cep;

        // Exibe a opção no alerta (ou pode acessar o atributo data-cep se necessário)
    }