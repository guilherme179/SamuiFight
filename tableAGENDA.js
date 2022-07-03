$(document).ready(function() {
    $('#listar-planejamento').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "scripts/agendaBD.php",
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        }
    });
});

const formNovaAula = document.getElementById("form-cad-aula");
const fechandoModal = new bootstrap.Modal(document.getElementById("cadastrar_aula"));
if (formNovaAula) {
    formNovaAula.addEventListener("submit", async(e) => {
        e.preventDefault();
        const dadosForm = new FormData(formNovaAula);
        //console.log(dadosForm);

        const dados = await fetch("scripts/cadastroAulaBD.php", {
            method: "POST",
            body: dadosForm
        });
        const resposta = await dados.json();
        //console.log(resposta);

        if (resposta['status']) {
            document.getElementById("msgAlertErroCad").innerHTML = "";
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
            formNovaAula.reset();
            fechandoModal.hide();
            listarDataTables = $('#listar-planejamento').DataTable();
            listarDataTables.draw();
        } else {
            document.getElementById("msgAlertErroCad").innerHTML = resposta['msg'];
        }
    });
}

const editModal = new bootstrap.Modal(document.getElementById("editAulaModal"));
async function editAula(id) {
    //console.log("Editar: " + id);

    const dados = await fetch('scripts/visualizarAgendaBD.php?id=' + id);
    const resposta = await dados.json();
    //console.log(resposta);

    if (resposta['status']) {
        document.getElementById("msgAlertErroEdit").innerHTML = "";

        document.getElementById("msgAlerta").innerHTML = "";
        editModal.show();

        document.getElementById("editDia").innerHTML = resposta['dados'].dia;
        document.getElementById("editNivelTreino").innerHTML = resposta['dados'].nivelTreino;
        document.getElementById("editTreino").innerHTML = resposta['dados'].treino;
        document.getElementById("editId").value = resposta['dados'].id;

    } else {
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    }
}

const formEditAula = document.getElementById("form-edit-aula");
if(formEditAula){
    formEditAula.addEventListener("submit", async(e) => {
        e.preventDefault();
        const dadosForm = new FormData(formEditAula);

        const dados = await fetch("scripts/editarAgendaBD.php", { 
            method: "POST",
            body: dadosForm
        });

        const resposta = await dados.json();

        if (resposta['status']) {
            // Manter a janela modal aberta
            //document.getElementById("msgAlertErroEdit").innerHTML = resposta['msg'];

            // Fechar a janela modal
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
            document.getElementById("msgAlertErroEdit").innerHTML = "";
            // Limpar o formulario
            formEditAula.reset();
            editModal.hide();

            // Atualizar a lista de registros
            listarDataTables = $('#listar-planejamento').DataTable();
            listarDataTables.draw();
        } else {
            document.getElementById("msgAlertErroEdit").innerHTML = resposta['msg'];
        }
    });
}

async function apagarAula(id){

    const dados = await fetch("scripts/excluirAgenda.php?id=" + id);
    const resposta = await dados.json();

    //console.log(resposta);

    if(resposta['status']){
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];

        listarDataTables = $('#listar-planejamento').DataTable();
        listarDataTables.draw()
    }else{
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    }

}