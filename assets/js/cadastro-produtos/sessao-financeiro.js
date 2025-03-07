function calcMargemLucro() {
    let custoTotalUnidade = document.getElementById('custo-total-unidade');
    custoTotalUnidade = custoTotalUnidade.getAttribute('data-custo_total');
    custoTotalUnidade = parseFloat(custoTotalUnidade);

    let margemLucro = document.getElementById('margem-lucro');
    margemLucro = parseFloat(margemLucro.value);

    const precoVenda = custoTotalUnidade + ( custoTotalUnidade * (margemLucro / 100));

    const valorEmMoeda = converterParaMoeda(precoVenda);

    document.getElementById('preco-venda').value = valorEmMoeda;
}

document.getElementById('margem-lucro').addEventListener('input', calcMargemLucro);