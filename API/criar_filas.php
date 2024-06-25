<?php
/* ===  API PARA O CRIAR AS FILAS === */
ob_start();
session_start();
// Arquivo de CONEXAO
include_once("conexao.php");
include_once("./function/verify_users.php");
include_once("./function/criar_codAccessphp");

// Captura os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Inicializa o array de resposta
$retorna = [];

// Receber e limpar os dados do fila
$nome = trim($dados['nome_fila']);
$qtd = trim($dados['qtd_fila']);
$inicio = trim($dados['data_inicio_fila']);
$codAccess = trim($dados['cod_acess_fila']);
$posicao = trim($dados['posicao_fila']);
$criador = trim($dados['pessoa_idUsu']);

// Função que verifica se usuário já existe no BD
$fileExists = verifyUsers($email, $codAccess);

if (!$fileExists['codigo_exist'] && !$fileExists['nome_exist']) {
    // Criar um hash seguro da senha
    $codAccess = criarHash($senha);

    // Preparar a query SQL usando prepared statements
    $sql = "INSERT INTO filafacil(nome_fila, qtd_fila, data_inicio_fila, cod_acess_fila, posicao_fila, pessoa_idUsu) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $nome, $qtd, $inicio, $codAccess, $posicao, $criador);

    // Executar a query
    if (mysqli_stmt_execute($stmt)) {

        //Retorna sucesso
        $retorna = [
            'status' => true,
            'msg' => "Cadastro realizado com sucesso!",
        ];
    } else {
        // Retornar erro ao inserir no banco de dados
        error_log("Erro ao executar statement: " . mysqli_stmt_error($stmt));
        $retorna = ['status' => false, 'msg' => "Erro ao cadastrar login. Tente novamente."];
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
