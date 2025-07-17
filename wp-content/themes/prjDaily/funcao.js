function validarCampos(formAgenda){
   
    if (document.formAgenda.nome_servidor.value == "" && document.formAgenda.email.value == "" && 
        document.formAgenda.tipo.value == "" && document.formAgenda.data_agendamento.value &&
        document.formAgenda.horario.value == "" && document.formAgenda.turno.value  == "" &&
        document.formAgenda.status.value == ""){
            alert("Existe campos em branco.");

    }
    

}

