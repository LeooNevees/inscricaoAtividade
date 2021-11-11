function registerActivity(id) {
    if(id == ''){
        alert('ID da atividade não fornecido. Por favor refaça o procedimento');
    }

    if(!confirm('Realmente deseja se cadastrar na atividade '+id+'?')){
        return false;
    }
    return true;
}

function openModal(titulo, descricao) {
    if(titulo == '' || descricao == ''){
        alert('Erro ao identificar o Titulo e Descrição da Atividade');
    }
    $("#tituloAtividade").text(titulo);
    $("#descricaoAtividade").text(descricao);
    $("#modalDescricao").modal('show');
}

function confirmInactivate() {
    if(!confirm('Realmente deseja inativar essa atividade? ')){
        return false;
    }
    return true;
}
