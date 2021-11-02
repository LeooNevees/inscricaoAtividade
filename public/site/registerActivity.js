function validation() {
    var array = ['title', 'description'];
    
    var retorno = true;
    array.forEach(function (value) {
        if($('#'+value).val() == '' && retorno == true){
            alert('Necessário preencher o campo '+$('#'+value).attr('placeholder'));
            retorno = false;
        }
    });

    return retorno;
}

function cancel() {
    if(!confirm('Realmente deseja cancelar o cadastro? ')){
        return false;
    }
    return true;
}

function check() {
    
}