// Função de Validação do Formulário
function validarFormulario() {
    const email = document.getElementById('email').value;
    const telefone = document.getElementById('telefone').value;
    const nascimento = document.getElementById('nascimento').value;
    const cpf_rg = document.getElementById('cpf_rg').value;
    const passaporte = document.getElementById('passaporte').value;
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

    // Validação de CPF/RG ou Passaporte
    if (document.getElementById('nacionalidade_brasileiro').checked && cpf_rg === "") {
        alert('Por favor, preencha o CPF/RG.');
        return false;
    }
    if (document.getElementById('nacionalidade_estrangeiro').checked && passaporte === "") {
        alert('Por favor, preencha o Passaporte para estrangeiros.');
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

// Habilitar ou desabilitar campos para estrangeiros
document.getElementById('nacionalidade_brasileiro').addEventListener('change', function () {
    document.getElementById('passaporte').disabled = true;
    document.getElementById('origem').disabled = true;
    document.getElementById('cpf_rg').disabled = false;
});

document.getElementById('nacionalidade_estrangeiro').addEventListener('change', function () {
    document.getElementById('passaporte').disabled = false;
    document.getElementById('origem').disabled = false;
    document.getElementById('cpf_rg').disabled = true;
});

// Função para aplicar máscara no telefone
function mascaraTelefone(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > 10) {
        value = value.slice(0, 11); // Limita a 11 dígitos
    }
    if (value.length > 6) {
        input.value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
    } else if (value.length > 2) {
        input.value = value.replace(/^(\d{2})(\d{0,5})$/, '($1) $2');
    } else {
        input.value = value;
    }
}

// Função para aplicar máscara no campo de CPF
function mascaraCPF(input) {
    // Remove caracteres não numéricos
    let value = input.value.replace(/\D/g, '');
    
    // Limita a 11 dígitos
    if (value.length > 11) {
        value = value.slice(0, 11);
    }

    // Aplica a formatação
    if (value.length >= 11) {
        input.value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
    } else if (value.length >= 8) {
        input.value = value.replace(/(\d{3})(\d{3})(\d{2})/, '$1.$2-$3');
    } else if (value.length >= 5) {
        input.value = value.replace(/(\d{3})(\d{2})/, '$1.$2');
    } else if (value.length >= 3) {
        input.value = value.replace(/(\d{3})/, '$1');
    } else {
        input.value = value; // Para menos de 3 dígitos
    }
}


// Função para aplicar máscara na data
function mascaraData(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > 8) {
        value = value.slice(0, 8); // Limita a 8 dígitos
    }
    if (value.length >= 4) {
        input.value = value.replace(/^(\d{2})(\d{2})(\d{0,4})$/, '$1/$2/$3');
    } else if (value.length >= 2) {
        input.value = value.replace(/^(\d{2})(\d{0,2})$/, '$1/$2');
    } else {
        input.value = value;
    }
}


// Função para aplicar máscara no campo de CEP
function mascaraCEP(input) {
    let value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos
    if (value.length > 8) {
        value = value.slice(0, 8); // Limita a 8 dígitos
    }
    // Formata o CEP para o padrão 00000-000
    if (value.length >= 5) {
        input.value = value.replace(/^(\d{5})(\d{0,3})$/, '$1-$2');
    } else {
        input.value = value;
    }
}

// Função para buscar endereço pelo CEP
function buscarEndereco(cep) {
    cep = cep.replace(/\D/g, ''); // Remove caracteres não numéricos
    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('rua').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('estado').value = data.uf;
                    document.getElementById('complemento').value = data.complemento || ''; 

                } else {
                    alert('CEP não encontrado.');
                }
            })
            .catch(error => {
                console.error('Erro ao buscar CEP:', error);
            });
    } else {
        alert('Por favor, insira um CEP válido.');
    }
}