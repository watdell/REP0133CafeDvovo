
// Esse é um toggle entre os forms de tipos de venda: Pacote, capsula ou kit,
function formsTipoVenda() {

    // Primeira etapa é identificar os formulários que se quer ter controle. 
    const pacote = document.getElementById('opcoes-pacote');
    const capsula = document.getElementById('opcoes-capsula');
    const kit = document.getElementById('opcoes-kit');

    // Em seguida, eu identifico o select responsável pela seleção
    const selectTipoVenda = document.getElementById('tipo-venda');
    // Identificado o select, agora eu identifico a option, que é a opção escolhida pelo usuário.. No final já puxo o valor de uma vez com o .value
    const opcaoSelecionada = selectTipoVenda.options[selectTipoVenda.selectedIndex].value;

    // Agora eu identifico todos os formulários de uma única vez pela classe deles para antes de tudo torná-los invisíveis em seguida.
    const todos_formsTipoVenda = document.querySelectorAll(".tipo-venda-opcoes");

    // Nessa parte usando o ForEach pra iterar sobre os elementos que a função querySelectorAll me deu, para cada elemento eu atribuo display='none' que torna esse elemento invisível
    todos_formsTipoVenda.forEach(form => {
        form.style.display = "none";
    })

    // Agora com todos eles invisíveis eu escolho qual que eu quero que fique visível usando um switch ou um if else, caso prefira.. 
    // pode atribuir 'block' ou 'flex' e até msm outros no display, a depender de cada caso.. o flex vai fazer tudo ficar na horizontal caso não tenha consigurado previamente o css para a classe que esse elemento pertence..
    // Se quiser usar o flex e quiser q continue no formato de coluna na vertical, então tem q adicionar um segundo estilo de display que é o flex-direction: column, ou no arquivo css, ou aqui msm.
    switch(opcaoSelecionada) {
        case 'pacote':
            pacote.style.display = "flex";
            break;
        case 'capsula':
            capsula.style.display = "flex";
            break;
        case 'kit':
            kit.style.display = "flex";
            break;
        default:
            break;
    }
}

// Evento de escuta de mudança no select de id tipo-venda. Ao detectar mudança ele aciona a função formsTipoVenda que alterna de formulário de tipo de venda
document.getElementById('tipo-venda').addEventListener('change', formsTipoVenda);


function somarPesoCaixaCapsulas() {
    let N_capsulas = document.getElementById('quantidade-capsulas');
    let peso_capsula = document.getElementById('peso-por-capsula');

    N_capsulas = parseFloat(N_capsulas.value) || 0;
    peso_capsula = parseFloat(peso_capsula.value) || 0;

    const total = N_capsulas * peso_capsula;
    
    return total;
} 

function atualizarPesoTotalCaixaCapsulas() {
    const pesoTotalCaixaCapsulas = somarPesoCaixaCapsulas();
    document.getElementById('peso-total-capsulas').value = pesoTotalCaixaCapsulas;

    // Já aproveito e atualizo também aquele campo de id='peso-total' desabilitado no próximo formulário. Ele serve para referência apenas
    document.getElementById('peso-total').value = pesoTotalCaixaCapsulas;

}

document.getElementById('quantidade-capsulas').addEventListener('input', atualizarPesoTotalCaixaCapsulas);
document.getElementById('peso-por-capsula').addEventListener('input', atualizarPesoTotalCaixaCapsulas);


// Esse evento captura entrada de dados no campo de peso total do pacote e já atualiza o campo desabilitado de outra aba com o valor preenchido aqui.
document.getElementById("peso-por-pacote").addEventListener('input', function() {
    document.getElementById("peso-total").value = this.value;
});


// Essa função é pra visualizar a imagem.
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview-imagem');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result; // Carrega a nova imagem
        };
        reader.readAsDataURL(file);
    } else {
        // Se não houver arquivo, mantém a imagem padrão
        preview.src = "../assets/images/img_padrao_cafe.png";
    }
}


function triggerFileUpload() {
    const fileInput = document.getElementById('imagem-produto');
    fileInput.click(); // Clica no input de arquivo

    // Cria um evento para passar para a função de pré-visualização
    fileInput.onchange = function(event) {
        previewImage(event);
    };
}