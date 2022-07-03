$(document).ready(function() {
    $('#listar-treino').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "scripts/treinoBD.php",
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        }
    });
});

const formNovoTreino = document.getElementById("form-cad-treino");
const fecharModal = new bootstrap.Modal(document.getElementById("cadastrar_treino"));
if (formNovoTreino) {
    formNovoTreino.addEventListener("submit", async(e) => {
        e.preventDefault();
        const dadosForm = new FormData(formNovoTreino);
        //console.log(dadosForm);

        const dados = await fetch("scripts/cadastroTreinoBD.php", {
            method: "POST",
            body: dadosForm
        });
        const resposta = await dados.json();
        console.log(resposta);

        if (resposta['status']) {
            document.getElementById("msgAlertErroCad").innerHTML = "";
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
            formNovoTreino.reset();
            fecharModal.hide();
            listarDataTables = $('#listar-treino').DataTable();
            listarDataTables.draw();
        } else {
            document.getElementById("msgAlertErroCad").innerHTML = resposta['msg'];
        }
    });
}

async function apagarTreino(id){

    const dados = await fetch("scripts/excluirTreino.php?id=" + id);
    const resposta = await dados.json();

    //console.log(resposta);

    if(resposta['status']){
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];

        listarDataTables = $('#listar-treino').DataTable();
        listarDataTables.draw()
    }else{
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    }

}