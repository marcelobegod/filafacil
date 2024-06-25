<?php
ob_start();
session_start();
header('Content-Type: application/json');

// Incluindo arquivos de conexão
include_once('conexao.php');
include_once('./function/clear_input.php');

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $tabela = clear_input($conexao, $_POST['tabela']);
        $idCampo = clear_input($conexao, $_POST['idCampo']);
        $idValor = clear_input($conexao, $_POST['id_usu']); // Usar id_usu diretamente
        unset($_POST['tabela'], $_POST['idCampo'], $_POST['id_usu']);

        $sql = "UPDATE $tabela SET ";
        $campos = [];

        foreach ($_POST as $campo => $valor) {
            $campo = clear_input($conexao, $campo);

            if ($campo === 'pass_usu') {
                $valor = criarHash($valor);
            } else {
                $valor = clear_input($conexao, $valor);
            }
            $campos[] = "$campo = ?";
        }

        $sql .= implode(", ", $campos);
        $sql .= " WHERE $idCampo = ?";
        // Log para verificação do SQL
        error_log("SQL: $sql");

        // Preparar a declaração SQL
        $stmt = $conexao->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Erro ao preparar a declaração: ' . $conexao->error);
        }

        // Vincular os parâmetros
        // 's' para string
        $types = str_repeat('s', count($campos)) . 's';
        $params = array_merge(array_values($_POST), [$idValor]);
        $stmt->bind_param($types, ...$params);

        // Log para verificação do SQL
        error_log("SQL: $sql");

        if ($stmt->execute()) {
            $response = [
                'redirect' => '/sidebar-01/sistema/usuario/listarUsuarios.php',
                'message' => 'Usuário editado com sucesso',
                'icon' => 'success'
            ];
        } else {
            $response = [
                'message' => 'Erro ao editar o usuário. Tente novamente',
                'icon' => 'error'
            ];
        }

        $stmt->close();
    } catch (Exception $e) {
        $response = [
            'message' => 'Erro ao processar dados: ' . $e->getMessage(),
            'icon' => 'error'
        ];
        // Define o código de status HTTP como 500 para erro no servidor
        http_response_code(500);
        // Log da exceção
        error_log("Erro: " . $e->getMessage());
    }
} else {
    $response = [
        'message' => 'Método inválido!',
        'icon' => 'error'
    ];
    // Método não permitido
    http_response_code(405);
}

mysqli_close($conexao);
ob_end_clean();
echo json_encode($response);
