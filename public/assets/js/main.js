document.getElementById('hamburguer-menu').addEventListener('click', function () {

    const navbar = document.getElementById('navbar');

    if (!navbar.innerHTML) {
        const menuLinks = document.getElementById('menu').innerHTML;
        navbar.innerHTML = `<ul>${menuLinks}</ul>`;
    }

    navbar.classList.toggle('show');

});

function handleResize() {
    const navbar = document.getElementById('navbar');

    if (window.innerWidth > 700) {
        navbar.classList.remove('show');
    }
}

window.addEventListener('resize', handleResize);

function main_search(str, search_file, table, inta) {
    let tableContainer = document.getElementById(inta);

    // Adiciona um indicador de carregamento antes da requisição
    tableContainer.innerHTML = "<div>Carregando...</div>";

    var xmlhttp = new XMLHttpRequest();

    // Codifica corretamente o termo de pesquisa e converte o nome da tabela para minúsculo
    let queryString = "?q=" + encodeURIComponent(str) + "&t=" + table.toLowerCase();

    // Abre a requisição para buscar os dados no PHP
    xmlhttp.open("GET", search_file + queryString, true);
    xmlhttp.send();

    // Aguarda a resposta do servidor
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // Substitui o indicador de carregamento com os novos dados
                tableContainer.innerHTML = this.responseText;
            } else {
                tableContainer.innerHTML = "<div>Erro ao carregar os dados.</div>";
            }
        }
    };
}

// Exemplo de uso ao digitar no input
document.getElementById("search").addEventListener("input", function () {
    main_search(this.value, "./insumos_search.php", "insumo", "innertable");
});