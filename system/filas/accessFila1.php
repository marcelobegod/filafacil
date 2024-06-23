<?php
// Arquivo de CONEXAO
session_start();
include_once('../../API/conexao.php');;

$erro = 0;
if (isset($_GET['id_criar_fila'])) {
    $id = $_GET['id_criar_fila'];

    $sql = "SELECT * FROM criarfila WHERE id_criar_fila = $id";
    $seleciona = mysqli_query($conexao, $sql);
    $banco = mysqli_fetch_array($seleciona);

    // Armazenar os dados do banco em variáveis
    $criador =  $banco['pessoa_idUsu'];
    $nome =     $banco['nome_fila'];
    $email =    $banco['qtd_fila'];
    $abertura = $banco['data_inicio_fila'];
    $qtd =      $banco['qtd_fila'];
    $posicao =  $banco['posicao_fila'];
} else {
    $erro++;
}
?>
<div class="container">
    <form id="editarUsuarioForm" class="form" name="form" method="POST" onsubmit="updateAccessdEdit(this, '/Fila_Facil/API/access_fila1.php'); return false;">

        <div class="modal-header">
            <h4 class="modal-title">Acessar Fila</h4>
        </div>

        <input type="hidden" name="tabela" value="criarfila">
        <input type="hidden" name="idCampo" value="id_criar_fila">
        <input type="hidden" class="form-control" id="id_criar_fila" name="id_criar_fila" value="<?php echo $id ?>">

        <div class="row">
            <div class="col-md-6">
                <label for="pessoa_idUsu" class="form-label">Criador</label>
                <input type="text" class="form-control" id="pessoa_idUsu" name="pessoa_idUsu" value="<?php echo $criador ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="nome_fila" class="form-label">Fila</label>
                <input type="text" class="form-control" id="nome_fila" name="nome_fila" value="<?php echo $nome ?>" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <label for="data_inicio_fila" class="form-label">Início</label>
                <input type="text" class="form-control" id="data_inicio_fila" name="data_inicio_fila" value="<?php echo $abertura ?>" readonly>
            </div>

            <div class="col-md-2">
                <label for="qtd_fila" class="form-label">QTD:</label>
                <input type="text" class="form-control" id="qtd_fila" name="qtd_fila" autocomplete="email" value="<?php echo $qtd ?>" readonly>
            </div>

            <div class="col-md-2">
                <label for="prefer_fila" class="form-label">Preferencial?</label>
                <select class="form-select" id="prefer_fila" name="prefer_fila">
                    <option value="">Informe...</option>
                    <option value="Idoso">Idoso</option>
                    <option value="Gestante">Gestante</option>
                    <option value="P.C.D">P.C.D</option>
                    <option value="Criança de colo">Criança de colo</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <label for="posicao_fila" class="form-label">Posição:</label>
                <input type="text" class="form-control" id="posicao_fila" name="posicao_fila" autocomplete="current-password" value="<?php echo $posicao ?>" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 text-end">
                <hr>
                <button type="submit" class="btn btn-warning">Editar</button>
                <a onclick="loadContent('/sidebar-01/sistema/usuario/listarUsuarios.php')" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </form>
</div>