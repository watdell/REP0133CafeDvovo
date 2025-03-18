function search(str,inta = "innertable") {
    document.getElementById(inta).innerHTML = '';
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(inta).insertAdjacentHTML("beforeend",this.responseText);
        }
    };

    xmlhttp.open("GET","search_log.php?&q="+str.toLowerCase(),true);
    xmlhttp.send();
}