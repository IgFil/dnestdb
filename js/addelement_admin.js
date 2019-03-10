function addadmin() {
    var elemment = document.getElementById('addadmin_div');
    var form = document.createElemant('form');
    var inputname = document.createElemant('input');
    form.method = 'POST';
    form.action = 'adminbd.php';
    elemment.appendChild(form);
    elemment.appendChild(inputname);
}