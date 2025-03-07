var words = [];
var form = [];
var res = 1;
var res_i = 80;
var listtotal = [];
var delta = 1;
var valor_item = 1;
var list_i_total = [];
var to_be_deleted = [];
var delta_i = 1;

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

function table_show() {
    document.getElementById("firsttab").style.display = 'flex'
    document.getElementById("orca_table").style.backgroundColor = '#b5651d'
    document.getElementById("secondtab").style.display = 'none'
    document.getElementById("orca_create").style.backgroundColor = '#d9b38c'
}
function table_create() {
    document.getElementById("firsttab").style.display = 'none'
    document.getElementById("orca_table").style.backgroundColor = '#d9b38c'
    document.getElementById("secondtab").style.display = 'block'
    document.getElementById("orca_create").style.backgroundColor = '#b5651d'
}
function total_value_i() {
    for (var i = delta_i; i < 160; i++) {
        try {
        var added_i = parseFloat(document.getElementById("valor_item" + i).value);
         list_i_total.push(added_i);
        delta_i++;
        } catch (error) {
            continue
        }
    };
    var total_i = list_i_total.reduce((a, b) => a + b, 0);
    
    document.getElementById('valor_label').value = 'R$ ' + total_i.toFixed(2);
}
function addprod_i() {
    const name = words[3];
    const desc = words[1];
    words.push(document.getElementById('quanmult').value);
    restable.insertAdjacentHTML("beforeend", "<div class='restable'>\
    <input type='text' style='width: 20%;' disabled id='name_temp' value='???'></input>\
    <input type='text' style='width: 20%;' disabled id='name_temp' value='" + name + "'></input>\
    <input type='text' style='width: 20%;' disabled value='" + document.getElementById('quanmult').value + "'></input>\
    <input type='text' style='width: 20%;' disabled id='valor_item" + res_i + "' value='" + document.getElementById('valfinal').value + "'></input>\
    <input type='text' style='width: 10%;' disabled value='XXX'></input>\
    </div>");
    
    words[2] = parseFloat(document.getElementById('valfinal').value);
    
    addNameField()

    res_i++;

    total_value_i();
}

function del_quewe(x,y) {
    let deleted_id0 = 'valor_a' + y 
    let deleted_id1 = 'valor_b' + y 
    let deleted_id2 = 'valor_c' + y 
    let deleted_id3 = 'valor_item' + y 
    document.getElementById(deleted_id0).style.backgroundColor = '#d9534f';
    document.getElementById(deleted_id1).style.backgroundColor = '#d9534f';
    document.getElementById(deleted_id2).style.backgroundColor = '#d9534f';
    document.getElementById(deleted_id3).style.backgroundColor = '#d9534f';
    document.getElementById(deleted_id0).style.color = '#ffffff';
    document.getElementById(deleted_id1).style.color = '#ffffff';
    document.getElementById(deleted_id2).style.color = '#ffffff';
    document.getElementById(deleted_id3).style.color = '#ffffff';

    document.getElementById('field').insertAdjacentHTML("beforeend", "<input type='text' style='width: 20%;' hidden name='to_be_del[]' value='" + x + "'></input>");

    to_be_deleted.push(x)
    console.log(to_be_deleted,y,deleted_id0);
}

function setprod_i() {
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
}