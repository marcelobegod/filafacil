<?php
// Inicia a captura de saída
ob_start();
session_start();
include_once("conexao.php");
include_once("./function/verify_login.php");

// Captura os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Inicializa o array de resposta
$retorna = [];

// Receber e limpar os dados do formulário
$email = trim($dados['email_usu']);
$senha = trim($dados['senha_usu']);

// Armazena o resultado da função que verifica se usuário já existe no BD
$usuario = verifyLogin($email, $senha);

// Verifica se o usuário foi encontrado no banco de dados
if ($usuario) {
    // Define a variável de sessão 'nivel_usu'
    $_SESSION["id_usu"] = $usuario["id_usu"];
    $_SESSION["nome_usu"] = $usuario["nome_usu"];
    $_SESSION["nivel_usu"] = $usuario["nivel_usu"];
    $_SESSION["logged_in"] = true;

    // Adiciona um echo para debugar o nível do usuário na resposta JSON
    $retorna = [
        'status' => true,
        'msg' => "Login realizado com sucesso!",
        'nivel_usu' => $usuario["nivel_usu"],
        'logged_in' => true
    ];
} else {
    // Caso contrário, retorna uma mensagem de erro
    $retorna = ['status' => false, 'msg' => "E-mail ou senha incorretos. Por favor, tente novamente."];
}

// Limpa qualquer saída antes de enviar o JSON
ob_end_clean();

// Retorna os dados JSON
header('Content-Type: application/json');
echo json_encode($retorna);
exit;