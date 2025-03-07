
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
