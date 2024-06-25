<?php
session_start();
include_once('../../API/conexao.php');
$erro = 0;

if ($_SESSION["logged_in"]) {
    $idCampo = $_SESSION["id_usu"];

    // Escapar a variável para evitar injeção de SQL
    $idCampo = mysqli_real_escape_string($conexao, $idCampo);

    $sql = "SELECT * FROM criarfila WHERE pessoa_idUsu = '$idCampo'";

    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
?>
<!-- ## MONTAGEM DA TABELA ## -->

<div class="container">
    <div class="table-title">
        <div class="row">
            <div class="col-sm">
                <h2>Criar <b>Filas</b></h2>
            </div>
            <div class="col-sm-6">
                <a href="#" id="btnCadastro" class="btn btn-success open-modal btnCadUsu">
                    <i class='bx bxs-plus-circle'></i><span>Cadastro novo Usuário</span>
                </a>
                <a href="#" class="btn btn-danger open-modal btnDeleteUsu">
                    <i class='bx bxs-minus-circle'></i><span> Deletar Usuário</span>
                </a>
            </div>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Vagas</th>
                <th>Posição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    // Loop para exibir cada usuário na tabela
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $row["nome_fila"] . "</td>";
                        echo "<td>" . $row["qtd_fila"] . "</td>";
                        echo "<td>" . $row["posicao_fila"] . "</td>"; // Exibindo a posição
                        echo "<td>";
                        echo "<a href='#' class='edit open-modal btnEditeUsu' data-id='" . $row["id_criar_fila"] . "' onclick=\"loadAccess('/Fila_Facil/system/filas/accessFila1.php?id_criar_fila=" . $row["id_criar_fila"] . "')\">";
                        echo "<i class='bx bxs-pencil' data-toggle='tooltip' title='Acessar'></i>";
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
        </tbody>
    </table>
</div>

<?php
    } else {
        echo "Nenhuma fila encontrada.";
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($conexao);
} else {
    echo "Usuário não está logado.";
}
?>

<!-- Modal ACESSO -->
<div class="modal fade" id="modalAcesso" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="loginAccessForm" class="needs-validation box" novalidate name="form">
                <div class="modal-header">
                    <img src="../assets/img/Screenshot_1.png" alt="Logo Fila Fácil">
                </div>
                <div class="modal-body">
                    <input type="email" name="email_usu" placeholder="E-mail" class="form-control" autocomplete="email"
                        required>
                    <div class="invalid-feedback">Por favor preencha o e-mail para acesso.</div>
                    <input type="password" name="pass_usu" placeholder="Password" class="form-control"
                        autocomplete="current-password" required>
                    <div class="invalid-feedback">Por favor preencha uma senha válida.</div>
                    <a class="forgot text-muted" href="#">Esqueceu a senha?</a>
                    <input id="btnClose" type="submit" value="Acessar" href="#">
                    <div>
                        <ul class="social-network social-circle">
                            <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <p>Não tem cadastro? <a id="cadastro" href="#!"> Cadastre-se</a></p>
                </div>
            </form>
        </div>
    </div>
</div>