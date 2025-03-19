function search(str) {
    document.getElementById("innertable").innerHTML = '';
    document.getElementById("innertable2").innerHTML = '';

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("innertable").insertAdjacentHTML("beforeend",this.responseText);
        }
    };

    xmlhttp.open("GET","search_log.php?&t=vendas&q="+str.toLowerCase(),true);
    xmlhttp.send();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("innertable2").insertAdjacentHTML("beforeend",this.responseText);
        }
    };

    xmlhttp.open("GET","search_log.php?&t=entregas&q="+str.toLowerCase(),true);
    xmlhttp.send();
}