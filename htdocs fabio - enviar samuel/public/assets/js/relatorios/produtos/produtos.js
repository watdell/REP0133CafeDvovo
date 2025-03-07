
let i = 0;
function alternarLista() {
    if (i==0) {
        document.getElementById('catalogo-grid').style.display = 'block';

            document.querySelectorAll('.img-produto').forEach(link => {
            link.style.display = 'none'; 
        });
            document.querySelectorAll('.produto-card').forEach(link => {
            link.style.display = 'flex';
            link.style.flexDirection = 'row';    
        });
            document.querySelectorAll('.produto-info').forEach(link => {
            link.style.display = 'flex';
            link.style.justifyContent = 'space-between'; 
            link.style.width = "100%";
        });
            document.querySelectorAll('.btn-acao.visualizar').forEach(link => {
            link.innerHTML = "👁️";
        });
            document.querySelectorAll('.btn-acao.editar').forEach(link => {
            link.innerHTML = "✏️";
        });
            document.querySelectorAll('.btn-acao.excluir').forEach(link => {
            link.innerHTML = "🗑️";
        });
            document.querySelectorAll('.produto-nome').forEach(link => {
            link.style.fontFamily = 'Arial, sans-serif';
            link.style.fontSize = '16px';
            link.style.color = '#333';

        });
            document.querySelectorAll('.produto-descrica').forEach(link => {
            link.style.fontFamily = 'Arial, sans-serif';
            link.style.fontSize = '16px';
            link.style.color = '#333';

        });
        
        i = 1;
        console.log(i);
    } 
    else
    if (i==1) {
        document.getElementById('catalogo-grid').style.display = 'grid';

        document.querySelectorAll('.img-produto').forEach(link => {
        link.style.display = 'flex'; 
       
    });
        document.querySelectorAll('.produto-card').forEach(link => {
        link.style.display = 'flex';
        link.style.flexDirection = 'column';    
    });
        document.querySelectorAll('.produto-info').forEach(link => {
        link.style.display = 'block';
        link.style.gap = "0"; 
    });
        document.querySelectorAll('.btn-acao.visualizar').forEach(link => {
        link.innerHTML = "👁️ Detalhes";
    });
        document.querySelectorAll('.btn-acao.editar').forEach(link => {
        link.innerHTML = "✏️ Editar";
    });
        document.querySelectorAll('.btn-acao.excluir').forEach(link => {
        link.innerHTML = "🗑️ Excluir";
    });
        document.querySelectorAll('.produto-nome').forEach(link => {
        link.style.fontFamily = 'Arial, sans-serif';
        link.style.fontSize = '20px';
        link.style.color = '#704923';

    });

        i = 0;
        console.log(i);
    }
    
}

document.getElementById("btn-list").addEventListener('click', alternarLista);



function alterarDados_enviarID(id) {
    let url = "../../cadastro-produtos/editar-produto/index.php?id=" + encodeURIComponent(id);
    
    window.location.href = url;
}



function converterParaMoeda(valor) {
    
    const valorFormatado = parseFloat(valor);

    // Verifica se o valor é um número válido
    if (isNaN(valorFormatado)) {
        return 'R$ 0,00'; // Ou outra string padrão que você preferir
    }
    
    const valorComDigitos = valorFormatado.toFixed(2);
    const valorMoedaDigitos = `R$ ${valorComDigitos.replace('.', ',')}`; // Troca o ponto por vírgula

    return valorMoedaDigitos;
}



function confirmarExclusao(produtoId){
    if (confirm('Você tem certeza que deseja excluir este produto?')) {
        window.location.href = '../../../serverside/controllers/produtos/remover-produto.php?id=' + produtoId;
    }
}



// Pra evitar certos conflitos.. preciso de uma função de de exclusão sem parâmetro pra poder ser removida o evento quando o modal não estiver visível e não sobrepor quando abrir novamente o modal
function confirmarExclusaoModal(){
    //Aproveito esse ID e adiciono o evento no botão de excluir que envia pra função de exclusão o ID do produto
    const inputHiddenId = document.getElementById('produto-id-hidden').value;
    if (confirm('Você tem certeza que deseja excluir este produto?')) {
       window.location.href = '../../../serverside/controllers/produtos/remover-produto.php?id=' + inputHiddenId;
   }
}


function fabricarProduto(){
    window.location.href = '../../cadastro-produtos/cadastrar-produto.php';
}


//Função pra abrir o modal de detalhes do produto
function abrirModalDetalhes(id) {
    // Envio o id pra obter as informações e preencher o modal com detalhes do produto.
    obterDetalhesProduto(id);

    //Aproveito esse ID e adiciono o evento no botão de excluir que envia pra função de exclusão o ID do produto
    document.getElementById('excluir-produto-modal').addEventListener('click', confirmarExclusaoModal); 

    // torno visível a div do container do modal
    document.getElementById('container-modal-relatorio').style.display = 'block';
}

function fecharModalDetalhes() {
    document.getElementById('excluir-produto-modal').removeEventListener('click', confirmarExclusaoModal);
    document.getElementById('container-modal-relatorio').style.display = 'none';
}

function obterDetalhesProduto(id) {
    const url = `../../../serverside/controllers/produtos/obter-detalhes-produto.php?id=${encodeURIComponent(id)}`;
    fetch(url)
    .then(response => response.json())
    .then(data => {
        // Populando as informações do produto
        document.getElementById('nome-produto').textContent = data.nome;
        document.getElementById('data-cadastro').textContent = data.data_cadastro;
        document.getElementById('tipo-venda').textContent = data.tipo;
        document.getElementById('descricao-produto').textContent = data.descricao;
        document.getElementById('peso-unidade').textContent = data.peso + 'g';
        document.getElementById('custo-total').textContent = converterParaMoeda(data.custo);
        document.getElementById('margem-lucro').textContent = data.margem_lucro + '%';
        document.getElementById('preco-venda').textContent = converterParaMoeda(data.preco_venda);
        document.getElementById('quantidade-estoque').textContent = data.estoque_atual + ' unidades';
        document.getElementById('estoque-minimo').textContent = data.estoque_minimo + ' unidades';
        document.getElementById('produto-id-hidden').value = data.produto_id;

        // Verificando a disponibilidade do estoque
        const disponibilidade = data.estoque_atual < data.estoque_minimo ? 'Faltando' : 'Disponível';
        document.getElementById('disponibilidade-estoque').textContent = disponibilidade;

        // Populando a tabela de insumos
        const insumos = data.insumos;
        let tbody = document.getElementById('tbody-insumos');
        let subtotal = 0;

        tbody.innerHTML = ''; //Limpo a tabela pra não haver adição de valores aos já existentes.

        insumos.forEach(insumo => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${insumo.nome_insumo}</td>
                <td>${insumo.qntd_insumo} ${insumo.unidade_medida}</td>
                <td>${converterParaMoeda(insumo.custo_unitario) + '/' + insumo.unidade_medida}</td>
                <td>${converterParaMoeda(insumo.qntd_insumo * insumo.custo_unitario)}</td>
            `;
            tbody.appendChild(tr);
            subtotal += insumo.qntd_insumo * insumo.custo_unitario;
        });

        // Exibir o subtotal dos custos
        document.getElementById('subtotal-custo').textContent = converterParaMoeda(subtotal);
    })
    .catch(error => {
        console.error("Erro ao obter informações: ", error);
    });
}

function converterParaMoeda(valor) {

    const valorFormatado = parseFloat(valor);

    // Verifica se o valor é um número válido
    if (isNaN(valorFormatado)) {
        return 'R$ 0,00'; // Ou outra string padrão que você preferir
    }
    
    const valorComDigitos = valorFormatado.toFixed(2);
    const valorMoedaDigitos = `R$ ${valorComDigitos.replace('.', ',')}`; // Troca o ponto por vírgula

    return valorMoedaDigitos;
}