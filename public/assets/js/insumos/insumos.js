function search(inta) {
    // Definindo variáveis
    str = document.getElementById("search").value.toLowerCase();
    document.getElementById(inta).innerHTML = '';
    var xmlhttp = new XMLHttpRequest();

    // Coletando dados da tabela
    xmlhttp.open("GET","./insumos_search.php?q=" + str, true);
    xmlhttp.send();

    // Enviando os dados para o html
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(inta).insertAdjacentHTML("beforeend",this.responseText);
        }
    };
}