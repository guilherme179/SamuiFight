<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="crud.css?v=<?php echo time();?>" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>SamuiFight</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg" style="background-color: #ffa600">
    <div class="container-fluid">
        <a class="navbar-brand" style="color: #000; font-size: 35px; font-weight: 900;">SamuiFight</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="color: #000; height: 100%; width: 100%">☰</span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index.php" style="color: #000; font-size: 25px; font-weight: 600;">Alunos</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="agenda.php" style="color: #000; font-size: 25px; font-weight: 600;">Planejamento</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="treino.php" style="color: #000; font-size: 25px; font-weight: 600;">Treinos</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <main>
        <div class="container">
            <div class="table-responsive">
            <div id="header-inventario" class="d-flex justify-content-between align-items-center pt-3 pb-2">
                <h1>Alunos</h1>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#cadastrar_aluno" style="margin-right: 5px"> Cadastrar Aluno </button>
            </div>
            <div class="col-sm">
                <span id="msgAlerta"></span>
            </div>
            <table id="listar-clientes" class="table table-striped table-hover table-bordered align-middle display" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>Nome do Aluno</th>
                        <th>Idade</th>
                        <th>Celular</th>
                        <th>Horario</th>
                        <th>Modalidade</th>
                        <th>Vencimento</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="modal fade" id="cadastrar_aluno" tabindex="-1" aria-labelledby="cadastrar_alunoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cadastrar_alunoLabel">Cadastrar Aluno</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span id="msgAlertErroCad"></span>
                        <form method="POST" id="form-cad-aluno">
                            
                            <div class="row mb-3">
                                <label for="cod" class="col-sm-3 col-form-label">Aluno</label>
                                <div class="col-sm">
                                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome do aluno..." maxlength="255">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="cod" class="col-sm-3 col-form-label">Idade</label>
                                <div class="col-sm">
                                    <input type="text" id="idade" name="idade" class="form-control" placeholder="Idade do aluno..." maxlength="3">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="cod" class="col-sm-3 col-form-label">Contato</label>
                                <div class="col-sm">
                                    <input type="text" id="contato" name="contato" class="form-control" placeholder="Telefone do aluno..." maxlength="11">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="cod" class="col-sm-3 col-form-label">Horario</label>
                                <div class="col-sm">
                                    <input type="time" id="horario" name="horario" class="form-control" placeholder="Horario de aula..." maxlength="5">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="item" class="col-sm-3 col-form-label">Modalidade</label>
                                <div class="col-sm">
                                    <input type="text" id="modalidade" name="modalidade" class="form-control" placeholder="Modalidade da aula..." maxlength="10">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="qtd" class="col-sm-3 col-form-label">Vencimento</label>
                                <div class="col-sm">
                                    <input type="date" id="vencimento" name="vencimento" class="form-control" placeholder="Vencimento...">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-sm" value="cadastrar">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editAlunoModal" tabindex="-1" aria-labelledby="editAlunoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAlunoModalLabel">Editar Aluno</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span id="msgAlertErroEdit"></span>
                        <form method="POST" id="form-edit-aluno">
                            <input type="hidden" name="id" id="editId">

                            <div class="row mb-3">
                                <label for="nome" class="col-sm-3 col-form-label">Nome</label>
                                <div class="col-sm">
                                    <input type="text" name="nome" class="form-control" id="editNome" placeholder="Nome...">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="idade" class="col-sm-3 col-form-label">Idade</label>
                                <div class="col-sm">
                                    <input type="text" name="idade" class="form-control" id="editIdade" placeholder="Idade...">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="contato" class="col-sm-3 col-form-label">Contato</label>
                                <div class="col-sm">
                                    <input type="text" name="contato" class="form-control" id="editContato" placeholder="Contato...">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="horario" class="col-sm-3 col-form-label">Horario</label>
                                <div class="col-sm">
                                    <input type="time" name="horario" class="form-control" id="editHorario">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="modalidade" class="col-sm-3 col-form-label">Modalidade</label>
                                <div class="col-sm">
                                    <input type="text" name="modalidade" class="form-control" id="editModalidade" placeholder="Modalidade...">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="vencimento" class="col-sm-3 col-form-label">Vencimento</label>
                                <div class="col-sm">
                                    <input type="date" name="vencimento" class="form-control" id="editVencimento">
                                </div>
                            </div>
                                                    
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="tableINDEX.js"></script>

</body>
</html>