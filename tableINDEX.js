$(document).ready(function() {
    $('#listar-clientes').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "scripts/clientesBD.php",
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        }
    });
});

const formNovoAluno = document.getElementById("form-cad-aluno");
const fecharModalCad = new bootstrap.Modal(document.getElementById("cadastrar_aluno"));
if (formNovoAluno) {
    formNovoAluno.addEventListener("submit", async(e) => {
        e.preventDefault();
        const dadosForm = new FormData(formNovoAluno);
        //console.log(dadosForm);

        const dados = await fetch("scripts/cadastroAlunoBD.php", {
            method: "POST",
            body: dadosForm
        });
        const resposta = await dados.json();
        console.log(resposta);

        if (resposta['status']) {
            document.getElementById("msgAlertErroCad").innerHTML = "";
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
            formNovoAluno.reset();
            fecharModalCad.hide();
            listarDataTables = $('#listar-clientes').DataTable();
            listarDataTables.draw();
        } else {
            document.getElementById("msgAlertErroCad").innerHTML = resposta['msg'];
        }
    });
}

const editModal = new bootstrap.Modal(document.getElementById("editAlunoModal"));
async function editAluno(id) {
    //console.log("Editar: " + id);

    const dados = await fetch('scripts/visualizarAlunoBD.php?id=' + id);
    const resposta = await dados.json();
    console.log(resposta);

    if (resposta['status']) {
        document.getElementById("msgAlertErroEdit").innerHTML = "";

        document.getElementById("msgAlerta").innerHTML = "";
        editModal.show();

        document.getElementById("editId").value = resposta['dados'].id;
        document.getElementById("editNome").value = resposta['dados'].nome;
        document.getElementById("editIdade").value = resposta['dados'].idade;
        document.getElementById("editContato").value = resposta['dados'].contato;
        document.getElementById("editHorario").value = resposta['dados'].horario;
        document.getElementById("editModalidade").value = resposta['dados'].modalidade;
        document.getElementById("editVencimento").value = resposta['dados'].vencimento;

    } else {
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    }
}

const formEditAluno = document.getElementById("form-edit-aluno");
if(formEditAluno){
    formEditAluno.addEventListener("submit", async(e) => {
        e.preventDefault();
        const dadosFormu = new FormData(formEditAluno);

        const dados = await fetch("scripts/editarAlunoBD.php", { 
            method: "POST",
            body: dadosFormu
        });

        const resposta = await dados.json();

        if (resposta['status']) {
            // Manter a janela modal aberta
            //document.getElementById("msgAlertErroEdit").innerHTML = resposta['msg'];

            // Fechar a janela modal
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
            document.getElementById("msgAlertErroEdit").innerHTML = "";
            // Limpar o formulario
            formEditAluno.reset();
            editModal.hide();

            // Atualizar a lista de registros
            listarDataTables = $('#listar-clientes').DataTable();
            listarDataTables.draw();
        } else {
            document.getElementById("msgAlertErroEdit").innerHTML = resposta['msg'];
        }
    });
}

async function apagarAluno(id){

    const dados = await fetch("scripts/excluirAluno.php?id=" + id);
    const resposta = await dados.json();

    //console.log(resposta);

    if(resposta['status']){
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];

        listarDataTables = $('#listar-clientes').DataTable();
        listarDataTables.draw()
    }else{
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    }

}