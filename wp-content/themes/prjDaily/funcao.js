function validarCampos(formAgenda){
   
    if (document.formAgenda.nome_servidor.value == "" && document.formAgenda.email.value == "" && 
        document.formAgenda.tipo.value == "" && document.formAgenda.data_agendamento.value &&
        document.formAgenda.horario.value == "" && document.formAgenda.turno.value  == "" &&
        document.formAgenda.status.value == ""){
            alert("Existe campos em branco.");

    }
}
// funcao para o modal 
window.onload = function(){
document.querySelectorAll('.visualizar-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var details = JSON.parse(this.getAttribute('data-details'));
        var html = '';
        for (var key in details) {
            html += '<p><strong>' + key + ':</strong> ' + details[key] + '</p>';
        }
        document.getElementById('modalDetalhes').innerHTML = html;
        document.getElementById('detalheModal').style.display = 'block';
    });
});
document.getElementById('fecharModal').onclick = function() {
    document.getElementById('detalheModal').style.display = 'none';
};
window.onclick = function(event) {
    var modal = document.getElementById('detalheModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};
};