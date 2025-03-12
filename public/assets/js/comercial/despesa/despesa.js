function setCat() {
    if (document.getElementById('catf').style.display == 'none') {
    document.getElementById('catf').style.display = 'flex';
    document.getElementById('catv').style.display = 'none';
    Stuff('catf');
    } else {
        document.getElementById('catf').style.display = 'none';
        document.getElementById('catv').style.display = 'flex';
        Stuff('catv');
    }
}

function datetime() {
    let currentDate = new Date();

    currentDate.setMonth(currentDate.getMonth() + 3);
    var date = currentDate.toISOString().replace('T',' | Hora:')

    document.getElementById('data').value = date.slice(0, date.indexOf('.'))
}

function Stuff(catid) {
    console.log(catid);
    document.getElementById('catd').value = document.getElementById(catid).value;
}