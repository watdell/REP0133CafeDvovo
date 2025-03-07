// Seção: Formatação de Custo Unitário
// Função para formatar o custo unitário em um formato específico (ex.: 2 ou 4 casas decimais).
// Converte o valor para o formato brasileiro (pt-BR) e define o número de casas decimais.
function formatarCustoUnitario(custo) {
    const valor = parseFloat(custo);
    const partes = valor.toString().split('.');    
    let casasDecimais = partes[1] ? partes[1].length : 0;

    // Limita a 4 casas decimais
    if (casasDecimais > 4) {
        casasDecimais = 4;
    }
    
    // Garante que pelo menos duas casas decimais sejam exibidas
    if (casasDecimais === 0) {
        casasDecimais = 2; // Exibir como "30,00"
    }

    return valor.toLocaleString('pt-BR', {
        minimumFractionDigits: casasDecimais,
        maximumFractionDigits: casasDecimais
    }).replace('.', ',');
}


// Isso aqui alterna entre os formulários e deixa ativo o botão da aba na qual é exibido o formulário.
function abrirFormulario(event, formNome) {
    // Esconde todos os elementos com a classe "tabcontent"
    document.querySelectorAll('.tabcontent').forEach(tab => {
        tab.style.display = 'none';
    });

    // Remove a classe 'active' de todos os elementos com a classe 'tablinks'
    document.querySelectorAll('.tablinks').forEach(link => {
        link.classList.remove('active');
    });

    // Mostra a aba atual e adiciona a classe 'active' ao botão que abriu a aba
    const form = document.getElementById(formNome);
    form.style.display = 'flex'; // Permite que fique um embaixo do outro em conjunto com o estilo pre aplicado em forms-style
    event.currentTarget.classList.add('active');
}


// Quando a página carregar, tornar o formulário de produtos visível e ativar o botão da aba. Tudo utilizando a função feita pra isso, passando os argumentos necessários.
window.addEventListener('load', () => {
    const btnForm = document.getElementById('btn-tab-produto');

    // Como n estamos clicando no botão, então temos que passar o botão em si como argumento dentro do currentTarget, que é o que a função pede.
    // Esse trabalho todo é só pra ver o botãozinho da aba escurinho ao carregar a página xD
    abrirFormulario({currentTarget: btnForm}, 'produto');
});


// Criei pra ser usada quando o usuário clicar em um botão que vai para a próxima sessão para preenchimento.
// O evento foi adicionado diretamente no segundo botão do controle de abas em cadastr-geral.html. O primeiro não precisa de validação para ser selecionado.
function irProximoFormulario(event, formulario) {

    switch(formulario) {
        case 'produto':
            abrirFormulario(event, 'produto');
            break;
        case 'insumos':
            const formProdutoMessage = validarFormSessaoProduto();
            if (formProdutoMessage.length == 0) {
                abrirFormulario(event, 'insumos');
            } else {
                window.alert(formProdutoMessage.join('\n'))
            }
            break;
        case 'financeiro':
            const formInsumosMessage = validarFormSessaoInsumos();
            if (formInsumosMessage.length == 0) {
                abrirFormulario(event, 'financeiro');
            } else {
                window.alert(formInsumosMessage.join('\n'))
            }
            break;
        case 'estoque':
            const formFinanceiroMessage = validarFormSessaoFinanceiro();
            if(formFinanceiroMessage.length == 0) {
                abrirFormulario(event, 'estoque');
            } else {
                window.alert(formFinanceiroMessage.join('\n'));
            }
            break;
        default:
            console.log("Nenhum form válido!");
            break;
    }
}
