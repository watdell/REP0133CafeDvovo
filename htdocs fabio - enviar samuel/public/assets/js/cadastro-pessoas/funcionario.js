
    // Função de Validação do Formulário
    function validarFormulario() {
        const email = document.getElementById('email').value;
        const telefone = document.getElementById('telefone').value;
        const nascimento = document.getElementById('nascimento').value;
        const salario = document.getElementById('salario').value;
        const matricula = document.getElementById('matricula').value;
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

        // Validação de salário
        const salarioRegex = /^[0-9]+(\.[0-9]{1,2})?$/;
        if (!salarioRegex.test(salario)) {
            alert('Por favor, insira um salário válido com até duas casas decimais.');
            return false;
        }

        // Validação de matrícula (número positivo)
        if (matricula <= 0) {
            alert('Por favor, insira um número de matrícula válido.');
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

    // Função para preencher endereço a partir do CEP
    function preencherEndereco() {
        const cep = document.getElementById('cep').value.replace(/\D/g, '');
        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById('rua').value = data.logradouro;
                        document.getElementById('bairro').value = data.bairro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf;
                        document.getElementById('complemento').value = data.complemento;
                    } else {
                        alert('CEP não encontrado.');
                    }
                })
                .catch(error => {
                    alert('Erro ao buscar CEP. Tente novamente.');
                });
        }
    }

    // Máscaras de entrada
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

    function mascaraSalario(input) {
        let value = input.value.replace(/\D/g, '');
        if (value.length > 10) {
            value = value.slice(0, 10);
        }
        input.value = parseFloat(value / 100).toFixed(2);
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

    // Adicionando event listeners
    document.getElementById('telefone').addEventListener('input', function() {
        mascaraTelefone(this);
    });

    document.getElementById('salario').addEventListener('input', function() {
        mascaraSalario(this);
    });

    document.getElementById('nascimento').addEventListener('input', function() {
        mascaraData(this);
    });

    document.getElementById('cep').addEventListener('input', function() {
        mascaraCEP(this);
    });