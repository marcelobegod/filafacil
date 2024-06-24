<?php
ob_start();
session_start();

// Arquivo de CONEXAO
include_once("conexao.php");
include_once('./function/position_generator.php');

// Captura os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Inicializa o array de resposta
$retorna = [];
$posicao = '';

// Receber e limpar os dados do formulário
$idFilaCriada = trim($dados['id_criar_fila']);
$nomeFilaCriada = trim($dados['nome_fila']);
$qtdFilaCriada = trim($dados['qtd_fila']);
$nomeChamada = trim($dados['nome_chamada']);
$telChamada = trim($dados['tel_chamada']);
$emailChamada = trim($dados['email_chamada']);
$tipoFila = trim($dados['prefer_fila']);
$posicaoAtual = trim($dados['posicao_fila']);

// Função para gerar Posição Atual
$posicao = position_generator($tipoFila, $idFilaCriada);

// Log dos dados recebidos
error_log("Dados do formulário:");
error_log("id fila criada: " . $idFilaCriada);
error_log("nome fila criada: " . $nomeFilaCriada);
error_log("qtd fila criada: " . $qtdFilaCriada);
error_log("posicao fila criada: " . $posicaoAtual);
error_log('posição nova:' . $posicao);

// Verifica se a posição foi gerada corretamente
if ($posicao === "Vagas Esgotadas") {
    $retorna = ['status' => false, 'msg' => "Vagas esgotadas. Não é possível acessar a fila."];
} else {
    // Preparar a query SQL usando prepared statements para inserção em filas_chamada
    $sqlInsert = "INSERT INTO filas_chamada (nome_chamada, posicao_chamada, tel_chamada, email_chamada, id_fila_chamada, nome_fila_chamada, tipo_fila_chamada) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = $conexao->prepare($sqlInsert);

    if ($stmtInsert === false) {
        error_log("Erro ao preparar statement de inserção: " . $conexao->error);
        $retorna = ['status' => false, 'msg' => "Erro ao preparar statement de inserção. Tente novamente."];
    } else {
        $stmtInsert->bind_param("sssssss", $nomeChamada, $posicao, $telChamada, $emailChamada, $idFilaCriada, $nomeFilaCriada, $tipoFila);

        // ATUALIZA A TABLE criarfila campo posição
        if ($stmtInsert->execute()) {
            // Preparar a query SQL usando prepared statements para atualização em criarfila
            $sqlUpdate = "UPDATE criarfila SET posicao_fila = ? WHERE id_criar_fila = ?";
            $stmtUpdate = $conexao->prepare($sqlUpdate);

            if ($stmtUpdate === false) {
                error_log("Erro ao preparar statement de atualização: " . $conexao->error);
                $retorna = ['status' => false, 'msg' => "Erro ao preparar statement de atualização. Tente novamente."];
            } else {
                // Bind dos parâmetros para a atualização
                $stmtUpdate->bind_param("si", $posicao, $idFilaCriada);

                // Executar a query de atualização
                if ($stmtUpdate->execute()) {
                    // Retorna sucesso
                    $retorna = [
                        'status' => true,
                        'msg' => "Acesso realizado com sucesso!",
                        'redirect' => '/Fila_Facil/index.php',
                        'posicao' => $posicao,
                    ];
                } else {
                    // Retornar erro ao atualizar no banco de dados
                    error_log("Erro ao executar statement de atualização: " . $stmtUpdate->error);
                    $retorna = ['status' => false, 'msg' => "Erro ao atualizar fila. Tente novamente."];
                }

                // Fechar o statement de atualização após o uso
                $stmtUpdate->close();
            }
        } else {
            // Retornar erro ao inserir no banco de dados
            error_log("Erro ao executar statement de inserção: " . $stmtInsert->error);
            $retorna = ['status' => false, 'msg' => "Erro ao acessar fila. Tente novamente."];
        }

        // Fechar o statement de inserção após o uso
        $stmtInsert->close();
    }

    // Fechar a conexão com o banco de dados
    $conexao->close();
}

// Limpa qualquer saída antes de enviar o JSON
ob_end_clean();

// Envia a resposta JSON
header('Content-Type: application/json');
echo json_encode($retorna);
exit;