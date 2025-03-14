function setCookie(cname, cvalue, exdays) {
    console.log(cvalue)
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    console.log(document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/")
    }

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            console.log(c.substring(name.length, c.length))
        return c.substring(name.length, c.length);
        }
    }
    return "fixo";
    }

function setCat() {
    if (document.getElementById('catf').style.display == 'none') {
    document.getElementById('catf').style.display = 'flex';
    document.getElementById('catv').style.display = 'none';
    Stuff('catf');
    setCookie('tipo','fixo',2);
    } else {
        document.getElementById('catf').style.display = 'none';
        document.getElementById('catv').style.display = 'flex';
        Stuff('catv');
        setCookie('tipo','variavel',2)
    }
}

function datetime() {
    let currentDate = new Date();

    currentDate.setMonth(currentDate.getMonth() + 3);
    var date = currentDate.toISOString().replace('T',' | Hora:')

    document.getElementById('data').value = date.slice(0, date.indexOf('.'))
}

function Stuff(catid) {
    document.getElementById('catd').value = document.getElementById(catid).value;
}

function thewarn() {
    if (document.getElementById('val').value < 0) {
        document.getElementById('valwarn').style.display = 'block';
    } else {
        document.getElementById('valwarn').style.display = 'none';
    }
}