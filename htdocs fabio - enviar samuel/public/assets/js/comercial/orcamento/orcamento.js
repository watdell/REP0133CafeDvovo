var words = [];
var form = [];
var res = 1;
var listtotal = [];
var delta = 1;

function setprod() {
    if (document.getElementById('quanmult').value == '' || document.getElementById('quanmult').value <= '0') {
        document.getElementById('quanmult').value = 1;
    }
    document.getElementById('quanmult').value = parseInt(document.getElementById('quanmult').value)
    words = [];
    form = [];
    const str =  document.getElementById("prodsel").value;
    const strform =  document.getElementById("cliente").value;
    console.log(strform)
    form = strform.split('|');
    words = str.split('|');
    document.getElementById('proddesc').value = words[1];
    var valmult = parseFloat(words[2]) * parseFloat(document.getElementById('quanmult').value);
    document.getElementById('valfinal').value = valmult.toFixed(2);

    document.getElementById('client_p').value = document.getElementById('cliente').value;

    var date = datetime();
    var lastid = getlastid();

    document.getElementById('formcl').value = form[0];
    document.getElementById('formad').value = form[1];
    document.getElementById('formvl').value = date;
    document.getElementById('formid').value = lastid;
}

function addprod() {
    const name = words[3];
    const desc = words[1];
    words.push(document.getElementById('quanmult').value);
    restable.insertAdjacentHTML("beforeend", "<div class='restable'>\
    <a style='width:15%' id='name_temp'>" + name + "</a>\
    <input type='text' style='width: 35%;' disabled value='" + desc + "'></input>\
    <a>Quant: " + document.getElementById('quanmult').value + "</a>\
    <a>Preço: R$:</a>\
    <input type='text'  style='width:10%' disabled id='res" + res + "' value='" + document.getElementById('valfinal').value + "'></input>\
    </div>");
    words[2] = parseFloat(document.getElementById('valfinal').value);

    addNameField()

    res++;

    allvalue();
}

function addNameField() {
    for (var i = 0; i < 5; i++) {
        const container = document.getElementById("field");
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = "item[]";
        input.value = words[i];
        container.appendChild(input);
    }
    console.log(words)
}

function remprod() {
    document.getElementById('restable').innerHTML = '';
    res = 1;
    delta = 1;
    listtotal = []
    document.getElementById('valtotal').value = '';

    const eraser = document.getElementsByName('item[]');

    while (eraser.length > 0) {
        eraser[0].remove();
    }
}

function allvalue() {
    for (var i = delta; i < res; i++) {
        var added = parseFloat(document.getElementById("res" + i).value);
         listtotal.push(added);
        delta++;
    };
    var total = listtotal.reduce((a, b) => a + b, 0);
    
    document.getElementById('valtotal').value = 'R$ ' + total.toFixed(2);
}

function openForm() {
    if (document.getElementById('field').style.display == 'none') {
    document.getElementById('field').style.display = 'flex';
    document.getElementById('openbutton').innerHTML = 'CANCELAR';
    document.getElementById('openbutton').style.backgroundColor = '#d9534f';
    } else {
        document.getElementById('field').style.display = 'none';
        document.getElementById('openbutton').innerHTML = 'CADASTRAR';
        document.getElementById('openbutton').style.backgroundColor = '#b5651d';
    }
}

function datetime() {
    let currentDate = new Date();

    currentDate.setMonth(currentDate.getMonth() + 3);
    var date = currentDate.toISOString().replace('T',' | Hora:')

    return 'Data: ' + date.slice(0, date.indexOf('.'))
}