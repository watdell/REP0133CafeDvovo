// Essa função checa se é possível criar a quantidade de estoque de produto especificada pelo cliente.
// Se o estoque atual de cada insumo que compõe o produto dividido pela quantidade em gramas necessária para formar 1 produto
// for menor que a quantidade de produtos a ser fabricado, então é retornada uma mensagem para repor estoque!
function checarMaximoEstoquePossivel() {
    const produzir_num_estoque = parseFloat(document.getElementById('quantidade-para-estoque').value);
    const insumoSelects = document.querySelectorAll('.insumo-select');
    const qntdInsumosInput = document.querySelectorAll('.insumo-qntd');

    let relatorio = [];
    for(let i=0; i < insumoSelects.length; i++){
        const opcaoSelecionada = insumoSelects[i].options[insumoSelects[i].selectedIndex];

        let estoque_atual = opcaoSelecionada.getAttribute('data-estoque_atual');
            estoque_atual = parseFloat(estoque_atual);
        
        const nome = opcaoSelecionada.getAttribute('data-nome');
        const quantidade = parseFloat(qntdInsumosInput[i].value);

        const qntd_maxima_possivel = Math.floor(estoque_atual / quantidade);

        if (qntd_maxima_possivel < produzir_num_estoque) {
            relatorio.push(`Insumo: ${nome}.\nDisponível ${qntd_maxima_possivel} x ${quantidade} g/ml/un no momento\n\n`);
        } 
    };
    return relatorio;
}


// Essa função vai acionar uma div de cor de fundo verde ou vermelho dentro de um input dizendo se a quantidade está disponível ou não
function divAlertaEstoqueInput() {
    const divAlertaEstoque = document.getElementById('check-estoque-possibilidade');
    const qntdParaEstoque = document.getElementById('quantidade-para-estoque');
    const estoqueAlerta = checarMaximoEstoquePossivel();

    if (qntdParaEstoque.value && parseFloat(qntdParaEstoque.value) > 0) {
        if (estoqueAlerta.length > 0) { 
            divAlertaEstoque.textContent = "Indisponível";
            divAlertaEstoque.style.backgroundColor = "red";
            divAlertaEstoque.style.display = "block"
        } else {
            divAlertaEstoque.textContent = "Disponível";
            divAlertaEstoque.style.backgroundColor = "green";
            divAlertaEstoque.style.display = "block"
        }
    } else {
        divAlertaEstoque.textContent = "Disponibilidade";
        divAlertaEstoque.style.backgroundColor = "rgb(214, 185, 21)";
        divAlertaEstoque.style.display = "block"
    }
  
}


// Função para gerar uma janela de alerta caso a função checarMaximoEstoquePossivel retornar com uma mensagem para repor estoque.
function alertaReporEstoque(){
    const qntdParaEstoque = document.getElementById('quantidade-para-estoque');
    const msgReporEstoque = checarMaximoEstoquePossivel(); 
    if (msgReporEstoque.length != 0) {
        window.alert(msgReporEstoque);
    } else {
        if (qntdParaEstoque.value && parseFloat(qntdParaEstoque.value) > 0) {
            console.log("Ok");
        } else {
            window.alert("Informe uma quantidade para estoque");
        }
        
    }
}
// Vai capturar o click do botão de id especificado, e acionar a função alertaReporEstoque para o evento.
//document.getElementById('quantidade-para-estoque').addEventListener('input', divAlertaEstoqueInput);
//document.getElementById('check-estoque-possibilidade').addEventListener('click', alertaReporEstoque);


