
function validarFormSessaoEstoque() {
    const qntdParaEstoque = document.getElementById('quantidade-para-estoque');
    const qntdMinimaEstoque = document.getElementById('estoque-minimo');

    const estoqueAlerta = checarMaximoEstoquePossivel();

    let mensagem = [];
    if (estoqueAlerta.length > 0) { 
        mensagem.push("Estoque de insumo insuficiente");
    }
    if (!qntdParaEstoque.value) {
        mensagem.push("Digite uma quantidade para estoque!")
    }
    if (!qntdMinimaEstoque.value) {
        mensagem.push("Digite uma quantidade mínima para estoque!")
    } else {
        if (parseFloat(qntdMinimaEstoque.value) >= parseFloat(qntdParaEstoque.value)) {
            mensagem.push("A quantidade mínima não pode ser maior ou igual que a de estoque!");
        }
    }
    return mensagem;
}

// Verificação antes do envio do formulário
document.getElementById("formulario-geral").addEventListener("submit", function(event) {
    event.preventDefault(); // Impede o envio do formulário
    
    const alertaFormEstoque = validarFormSessaoEstoque();
    if (alertaFormEstoque.length == 0) {
        //this.submit(); // caso positivo, faço o envio do formulário.
        preencherModal(); // preenche o modal de confirmação com as informações fornecidas ao formulário principal.
        abrirConfirmarCadastro(); // Abre o modal de confirmação para visualização das informações e confirmação para envio ao servidor.
    } else {
        window.alert(alertaFormEstoque.join('\n'));
    }
});

// Para enviar pelo formulário é necessário que eles estejam habilitados.
function habilitarCampos() {
    const pesoTotalInput = document.getElementById('peso-total');

    const custoTotalUnidadeInput = document.getElementById('custo-total-unidade');
    const precoVendaInput = document.getElementById('preco-venda');

    pesoTotalInput.disabled = false;

    custoTotalUnidadeInput.disabled = false;
    custoTotalUnidadeInput.value = custoTotalUnidadeInput.value.replace('R$', '').replace(',', '.');

    precoVendaInput.disabled = false;
    precoVendaInput.value = precoVendaInput.value.replace('R$', '').replace(',', '.');

    precoVendaInput.disabled = false;
}

// Após o envio pelo formulário a gente desabilita esses campos novamente.
function desabilitarCampos() {
    document.getElementById('peso-total').disabled = true;
    document.getElementById('custo-total-unidade').disabled = true;
    document.getElementById('preco-venda').disabled = true;
}

function enviarQntdInsumo() {
    const inputHidden = document.getElementById('qntd-insumo-lista');
    const selects = document.querySelectorAll('.insumo-select');

    let lista = [];

    selects.forEach(select => {
          let opcao = select.options[select.selectedIndex];
              opcao = opcao.getAttribute('data-estoque_atual');
        lista.push(opcao);
    });
    inputHidden.value = lista;
    console.log(inputHidden.value);
} 

const form = document.getElementById("formulario-geral");
const btnConfirmarEnvio = document.getElementById('confirmarEnvio');

function submitForm() {
    const alertaFormEstoque = validarFormSessaoEstoque();
    if (alertaFormEstoque.length == 0) {
        btnConfirmarEnvio.disabled = false; // Habilita o botão novamente para o usuário poder fazer uma nova adição ao banco de dados.
        preencherModal(); // Preenche o modal com as informações do formulário
        abrirConfirmarCadastro(); // Abre o modal de confirmação
        habilitarCampos(); // Habilita os campos se necessário
        
        // Configurar o evento para o botão de confirmar no modal
        document.getElementById("confirmarEnvio").onclick = function() {
            this.disabled = true; // Desabilita o botão para evitar múltiplos envios após clicar em confirmar envio.
            form.submit(); // Envia o formulário
        };

        // Configurar o evento para fechar o modal
        document.getElementById("cancelarEnvio").onclick = function() {
           fecharConfirmarCadastro();
        };

    } else {
        window.alert(alertaFormEstoque.join('\n'));
    }
}

// Limpar e desabilitar campos após o envio do formulário
form.addEventListener('submit', function() {
    this.reset(); // Limpa todos os campos do formulário
    desabilitarCampos(); // Desabilita os campos se necessário
});

// Essa função limpa os dados do formulário quando a página é carregada
// Interessante ter essa função caso o usuário após o envio do formulário aperte pra voltar.
// Algumas informações pré-preenchidas poderiam gerar algum erro na validação das informações caso o usuário retomasse uma inserção incompleta.
window.onload = function() {
    const form = document.getElementById("formulario-geral");
    form.reset(); // Limpa os campos do formulário
};
