<?php
/* ===  API PARA O PRIMEIRO CADASTRO DO USUÁRIO === */
// Inicia a captura de saída
ob_start();
session_start();
include_once("conexao.php");
include_once(__DIR__ . '/function/criar_hash.php');
include_once(__DIR__ . '/function/verify_users.php');

// Captura os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Inicializa o array de resposta
$retorna = [];

// Receber e limpar os dados do formulário
$nome = trim($dados['nome_usu']);
$tel = trim($dados['tel_usu']);
$email = trim($dados['email_usu']);
$senha = trim($dados['senha_usu']);

// Função que verifica se usuário já existe no BD
$userExists = verifyUsers($email, $nome);

if (!$userExists['email_exist'] && !$userExists['nome_exist']) {
    // Criar um hash seguro da senha
    $hashSenha = criarHash($senha);

    // Preparar a query SQL usando prepared statements
    $sql = "INSERT INTO usuario (nome_usu, tel_usu, email_usu, senha_usu) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $tel, $email, $hashSenha);

    // Executar a query
    if (mysqli_stmt_execute($stmt)) {
        // Armazena dados na $_SESSION
        $_SESSION['nivel_usu'] = $nivel;
        $_SESSION['nome_usu'] = $nome;


        // Retornar sucesso
        $retorna = [
            'status' => true,
            'msg' => "Cadastro realizado com sucesso!",
            'nome_usu' => $nome,
            'nivel_usu' => $nivel,
        ];
    } else {
        // Retornar erro ao inserir no banco de dados
        error_log("Erro ao executar statement: " . mysqli_stmt_error($stmt));
        $retorna = ['status' => false, 'msg' => "Erro ao cadastrar usuário. Tente novamente."];
    }

    // Fecha a conexão e envia a resposta dentro do IF principal
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
} else {
    // Mensagem de erro se o usuário já existe
    error_log("Usuário já existe: " . $email);
    $retorna = ['status' => false, 'msg' => "Usuário já existe"];
}

// Limpa qualquer saída antes de enviar o JSON
ob_end_clean();

// Envia a resposta JSON
header('Content-Type: application/json');
echo json_encode($retorna);
exit;
