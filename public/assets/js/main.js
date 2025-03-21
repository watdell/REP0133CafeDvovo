document.getElementById('hamburguer-menu').addEventListener('click', function() {
    
    const navbar = document.getElementById('navbar');
    
    if (!navbar.innerHTML) {
        const menuLinks = document.getElementById('menu').innerHTML;
        navbar.innerHTML = `<ul>${menuLinks}</ul>`;
    }

    navbar.classList.toggle('show');
 
});

function handleResize() {
    const navbar = document.getElementById('navbar');

    if(window.innerWidth > 700) {
        navbar.classList.remove('show');
    }
}

window.addEventListener('resize', handleResize);

// Função de busca de produtos
function main_search(str, search_file, table, inta) {
    return new Promise((resolve, reject) => {
        // Limpando o conteúdo anterior
        document.getElementById(inta).innerHTML = '';
        var xmlhttp = new XMLHttpRequest();

        // Coletando dados da tabela
        xmlhttp.open("GET", search_file + "?&q=" + str + "&t=" + table.toLowerCase(), true);
        xmlhttp.send();

        // Enviando os dados para o HTML
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    document.getElementById(inta).insertAdjacentHTML("beforeend", this.responseText);
                    resolve(); // Resolve a Promise após o sucesso
                } else {
                    reject("Erro na requisição: " + this.status); // Rejeita em caso de erro
                }
            }
        };
    });
}

