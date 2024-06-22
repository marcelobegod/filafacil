<?php
/* ===  API PARA O PRIMEIRO CADASTRO DO USUÁRIO === */

ob_start();
session_start();
include_once("conexao.php");
include_once("./function/criar_hash.php");
include_once("./function/verify_users.php");

header('Content-Type: application/json'); // Sempre envie cabeçalho JSON

// Inicializa o array de resposta
$retorna = [];

// Captura os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Receber e limpar os dados do formulário
$nome = trim($dados['nome_usu']);
$tel = trim($dados['tel_usu']);
$email = trim($dados['email_usu']);
$senha = trim($dados['senha_usu']);

// Verifica se o usuário já existe
$userExists = verifyUsers($email, $nome);

if (!$userExists['email_exist'] && !$userExists['nome_exist']) {
    $hashSenha = criarHash($senha);

    $sql = "INSERT INTO usuario (nome_usu, tel_usu, email_usu, senha_usu) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $tel, $email, $hashSenha);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['nivel_usu'] = $nivel;
        $_SESSION['nome_usu'] = $nome;

        $retorna = [
            'status' => true,
            'msg' => "Cadastro realizado com sucesso!",
        ];
    } else {
        error_log("Erro ao executar statement: " . mysqli_stmt_error($stmt));
        $retorna = ['status' => false, 'msg' => "Erro ao cadastrar login. Tente novamente."];
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
} else {
    error_log("Usuário já existe: " . $email);
    $retorna = ['status' => false, 'msg' => "Usuário já existe"];
}

ob_end_clean();
echo json_encode($retorna);
exit;
