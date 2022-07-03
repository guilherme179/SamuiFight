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
            <a class="nav-link " aria-current="page" href="index.php" style="color: #000; font-size: 25px; font-weight: 600; border-width: ; border: #000">Alunos</a>
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
            <h1>Treino</h1>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#cadastrar_treino" style="margin-right: 5px"> Novo Treino </button>
        </div>
        <div class="col-sm">
            <span id="msgAlerta"></span>
        </div>
        <table id="listar-treino" class="table table-striped table-hover table-bordered align-middle display" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th style="width: 75%">treino</th>
                    <th style="width: 25%">Ação</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="modal fade" id="cadastrar_treino" tabindex="-1" aria-labelledby="cadastrar_treinoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cadastrar_treinoLabel">Cadastrar treino</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span id="msgAlertErroCad"></span>
                        <form method="POST" id="form-cad-treino">
                            
                            <div class="row mb-3">
                                <label for="cod" class="col-sm-2 col-form-label">Treino</label>
                                <div class="col-sm">
                                    <input type="text" name="treino" class="form-control" id="treino" placeholder="Treinamento...">
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

    </main> 
    
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="tableTREINO.js"></script>
        
</body>
</html>