// ********************               Seção: Atualizar dropdown (select) com AJAX            ********************************

// Essa função é chamada quando eu adiciono um insumo na função adicionarInsumo
// Ela atualiza o último select que conterá o valor atualizado dos insumos após a adição de um novo insumo.
// os próximos selects que forem criados já conterá o valor atualizado, pois o clone é sempre feito do último select.
function atualizarDropdown() {
    fetch('../../../serverside/controllers/produtos/dropdown-insumos-ajax.php')
    .then(response => response.json())
    .then(data => {
        let $id = obterUltimoSelect(); //função em outro módulo. ela está em cadastro_add_insumos.js mas ambos os módulos são importados no mesmo arquivo php
        const dropdown = document.getElementById($id);
        dropdown.innerHTML = ''; // Limpa o dropdown antes de atualizar com novas opções.

        data.forEach(insumo => {
            const option = document.createElement('option');
            option.value = insumo.insumo_id;
            option.setAttribute('data-nome', insumo.nome);
            option.setAttribute('data-data_validade', insumo.data_validade);
            option.setAttribute('data-custo_unitario', insumo.custo_unitario);
            option.setAttribute('data-estoque_atual', insumo.estoque_atual);
            option.setAttribute('data-unidade_medida', insumo.unidade_medida);
            
            // Define o texto da opção no formato 'Nome - Preço/Unidade - disponível Estoque'
            option.textContent = `${insumo.nome} - R$ ${insumo.custo_unitario}/${insumo.unidade_medida} - disponível ${insumo.estoque_atual}/${insumo.unidade_medida}`;            
            dropdown.appendChild(option);
        });

        const option = document.createElement('option');
        option.value = "Adicionar Novo Insumo";
        option.textContent = "Adicionar Novo Insumo";
        dropdown.appendChild(option);
    })
    .catch(error => {
        console.error('Erro ao obter insumos: ', error);
    })
}

window.addEventListener('load', atualizarDropdown);



/*************                     Seção: listagem ou de busca pelo produto                        ***********/

// Função para listar produtos. Ela envia uma requisição ao arquivo php que faz isso e recebe um json como resposta.
// Depois é só processar o json em um loop e a cada iteração dar um innerHtml com o critério desejado ex. produto.nome para exibir as informações, conforme configurado na consulta ao db no arquivo php

// Vou tbm fazer com que essa função busca pelo produto na medida que o usuário digita o nome do produto
// Isso vai ser importante pra verificarmos se o produto já existe, mostrando isso ao usuário em tempo real! xD
function buscarProduto(criterio) {
    const url = `../../../serverside/controllers/produtos/listar-produtos-ajax.php?criterio=${encodeURIComponent(criterio)}`;
    fetch(url)
    .then(response => response.json())
    .then(data => {
        //const div_conteudo = document.getElementById('div-conteudo-relatorio');
        //div_conteudo.innerHTML = '';
        const suggestionsDiv = document.getElementById('suggestions');
        suggestionsDiv.innerHTML = ""; // Limpa as sugestões antes de preencher

        if (criterio!="") {

            data.forEach(produto => {
                suggestionsDiv.style.display = 'block';
                suggestionsDiv.innerHTML = ""; // Limpa as sugestões antes de preencher
                const div = document.createElement('div');
                div.className = 'suggestion-item';
                div.innerHTML = `${produto.nome} - <span style='color: red'>Existente!</span>`;
                suggestionsDiv.appendChild(div);
            });
        } else {
            console.log("kkkkk")
            suggestionsDiv.innerHTML = ""; // Limpa as sugestões antes de preencher
            suggestionsDiv.style.display = 'none';
        }
    })
    .catch(error => {
        console.error('Erro ao buscar pelo produto: ', error);
    })
}

let timeoutId; // Variável que vai nos ajudar a aplicar a técnica de debounce

// É tipo assim: Se a gente n fizer isso, a cada vez q o usuário digitar um novo timer será criado.
// Múltiplas requisições ao servidor seriam enviadas e teriamos q esperar todas elas serem executadas na fila.
// Ao criarmos uma variavel q armazena o timeOut, a cada input dizemos pra ele zerar o timeout anterior e começar um novo.
// Evitando assim conflito de respostas ou excesso de requisição indesejada ao servidor, independentemente da velocidade q o usuário digitar.

// Criamos o evento de escuta para o input e acionamos o timeout pra aguardar 300ms enquanto executa a função de buscaProduto,
// mas antes disso ela zera o processo anterior, na forma q descrevemos anteriormente.
document.getElementById('nome-produto').addEventListener('input', function() {
    const criterio = this.value;

    // limpo o timeout anterior
    clearTimeout(timeoutId);

    // Defino um novo timeout
    timeoutId = setTimeout(() => {
        buscarProduto(criterio);
    }, 300); // aguarda 300ms após o último input pra evitar de dar bug ou lag no servidor por chamadas excessivas.

});



/****************              Seção: Adicionar Insumo com AJAX                      *****************/

// Função responsável por adicionar um insumo enviando dados para o servidor usando AJAX.
// Usa fetch para enviar os dados do formulário 'form-insumo' ao endpoint 'cadastrar_insumo.php'.
// Caso bem-sucedido, exibe uma mensagem de sucesso e atualiza o dropdown, ou então exibe uma mensagem de erro.
function adicionarInsumo() {
    
    const formElement = document.getElementById('form-insumo');
    console.log(formElement); // This should log the form element or null
    const formData = new FormData(document.getElementById('form-insumo'));

    fetch('../../../serverside/controllers/produtos/cadastrar_insumo.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Insumo adicionado com sucesso!');
            atualizarDropdown(); // Atualiza a lista de insumos no dropdown após a adição.
            fecharModal(); // Fecha o modal do formulário.
        } else {
            alert('Erro ao adicionar insumo: ' + data.error); // Exibe o erro recebido do servidor.
        }
    })
    .catch(error => {
        console.error('Erro na requisição: ', error);
        alert('Ocorreu um erro. Tente novamente.');
    });
}