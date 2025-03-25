function search(inta) {
    // Pegando o valor do campo de pesquisa e convertendo para minúsculas
    let str = document.getElementById("search").value.toLowerCase();
    let tableContainer = document.getElementById(inta);

    // Adiciona um indicador de carregamento
    tableContainer.innerHTML = "<div>Carregando...</div>";

    var xmlhttp = new XMLHttpRequest();

    // Abre a requisição para buscar os dados no PHP
    xmlhttp.open("GET", "./insumos_search.php?q=" + encodeURIComponent(str), true);
    xmlhttp.send();

    // Aguarda a resposta do servidor
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // Substitui os dados da tabela APÓS a resposta chegar
                tableContainer.innerHTML = this.responseText;
            } else {
                tableContainer.innerHTML = "<div>Erro ao carregar os dados.</div>";
            }
        }
    };
}

// Adiciona um evento para chamar a função quando o usuário digitar no input
document.getElementById("search").addEventListener("input", function () {
    search("innertable");
});