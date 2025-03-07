// Função de Validação do Formulário
function validarFormulario() {
    const email = document.getElementById('email').value;
    const telefone = document.getElementById('telefone').value;
    const nascimento = document.getElementById('nascimento').value;
    const cnpj = document.getElementById('cnpj_pjuridica').value;
    const cep = document.getElementById('cep').value;

    // Validação de e-mail
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
    if (!emailRegex.test(email)) {
        alert('Por favor, insira um e-mail válido.');
        return false;
    }

    // Validação de telefone
    const telefoneRegex = /^\(\d{2}\) \d{5}-\d{4}$/;
    if (!telefoneRegex.test(telefone)) {
        alert('Por favor, insira um telefone no formato (xx) xxxxx-xxxx.');
        return false;
    }

    // Validação de data de nascimento
    const dataRegex = /^\d{2}\/\d{2}\/\d{4}$/;
    if (!dataRegex.test(nascimento)) {
        alert('Por favor, insira uma data de nascimento no formato dd/mm/yyyy.');
        return false;
    }

    // Validação de CNPJ
    const cnpjRegex = /^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/;
    if (!cnpjRegex.test(cnpj)) {
        alert('Por favor, insira o CNPJ no formato 00.000.000/0000-00.');
        return false;
    }

    // Validação de CEP
    const cepRegex = /^\d{5}-\d{3}$/;
    if (!cepRegex.test(cep)) {
        alert('Por favor, insira o CEP no formato 00000-000.');
        return false;
    }

    return true;
}

// Funções de formatação
function mascaraTelefone(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > 11) {
        value = value.slice(0, 11);
    }
    if (value.length >= 11) {
        input.value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
    } else if (value.length >= 6) {
        input.value = value.replace(/(\d{2})(\d{5})/, '($1) $2');
    } else if (value.length >= 2) {
        input.value = value.replace(/(\d{2})/, '($1');
    } else {
        input.value = value;
    }
}

function mascaraCNPJ(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > 14) {
        value = value.slice(0, 14);
    }
    if (value.length === 14) {
        input.value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
    } else if (value.length >= 8) {
        input.value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})/, '$1.$2.$3/$4');
    } else if (value.length >= 5) {
        input.value = value.replace(/(\d{2})(\d{3})(\d{3})/, '$1.$2.$3');
    } else if (value.length >= 3) {
        input.value = value.replace(/(\d{2})(\d{3})/, '$1.$2');
    } else {
        input.value = value;
    }
}

function mascaraCEP(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > 8) {
        value = value.slice(0, 8);
    }
    if (value.length === 8) {
        input.value = value.replace(/(\d{5})(\d{3})/, '$1-$2');
    } else {
        input.value = value;
    }
}

function mascaraData(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > 8) {
        value = value.slice(0, 8);
    }
    if (value.length >= 6) {
        input.value = value.replace(/(\d{2})(\d{2})(\d{4})/, '$1/$2/$3');
    } else if (value.length >= 4) {
        input.value = value.replace(/(\d{2})(\d{2})/, '$1/$2');
    } else {
        input.value = value;
    }
}

// Função para preencher endereço a partir do CEP
function preencherEndereco() {
    const cep = document.getElementById('cep').value.replace(/\D/g, '');

    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('estado').value = data.uf;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('rua').value = data.logradouro;
                    document.getElementById('complemento').value = data.complemento || ''; 
                } else {
                    alert('CEP não encontrado.');
                }
            })
            .catch(() => alert('Erro ao buscar o CEP. Tente novamente.'));
    } else {
        alert('Por favor, insira um CEP válido.');
    }
}

// Adicionando event listeners
document.getElementById('telefone').addEventListener('input', function() {
    mascaraTelefone(this);
});

document.getElementById('cnpj_pjuridica').addEventListener('input', function() {
    mascaraCNPJ(this);
});

document.getElementById('cep').addEventListener('input', function() {
    mascaraCEP(this);
});

document.getElementById('nascimento').addEventListener('input', function() {
    mascaraData(this);
});