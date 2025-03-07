// Fechar o modal
function fecharModal() {
    document.getElementById('modal-novo-insumo').style.display = 'none';
}

document.getElementById('close-modal').addEventListener('click', fecharModal);

// Calcular custo unitário
function calcularCustoUnitario() {
    const estoqueAtual = parseFloat(document.getElementById('estoque-atual').value);
    const custoTotal = parseFloat(document.getElementById('custo-total').value);

    if (!isNaN(estoqueAtual) && estoqueAtual > 0 && !isNaN(custoTotal)) {
        const custoUnitario = (custoTotal / estoqueAtual).toFixed(2);
        document.getElementById('custo-unitario').value = `R$ ${custoUnitario}`;
    } else {
        document.getElementById('custo-unitario').value = '';
    }
}

document.getElementById('estoque-atual').addEventListener('input', calcularCustoUnitario);
document.getElementById('custo-total').addEventListener('input', calcularCustoUnitario);

/*
// Submeter o formulário
document.getElementById('form-insumo').onsubmit = function(event) {
    event.preventDefault();
    alert('Insumo adicionado com sucesso!');
    fecharModal();
    this.reset();
} */
