<?php
ob_start(); // Inicia o buffer de saída
session_start(); // Inicia a sessão
header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON

// Incluindo arquivos de conexão e funções
include_once("conexao.php");
include_once('./function/clear_input.php');

$response = []; // Inicializa o array de resposta

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Verifica se o método da requisição é POST
    try {
        // Limpa a entrada e atribui à variável tabela
        $tabela = clear_input($conexao, $_POST['tabela']);
        // Limpa a entrada do campo ID se existir
        $idCampo = isset($_POST['idCampo']) ? clear_input($conexao, $_POST['idCampo']) : null;
        // Limpa a entrada do valor do ID se existir
        $idValor = isset($_POST[$idCampo]) ? clear_input($conexao, $_POST[$idCampo]) : null;

        // Remove campos desnecessários do array $_POST
        unset($_POST['tabela'], $_POST['idCampo'], $_POST[$idCampo]);

        $campos = []; // Inicializa o array de campos
        $valores = []; // Inicializa o array de valores
        $verificacao = []; // Inicializa o array de verificação

        // Percorre os dados do formulário
        foreach ($_POST as $campo => $valor) {
            $campoLimpo = clear_input($conexao, $campo); // Limpa o nome do campo

        
            // Verificação de campos únicos
            if ($campoLimpo === 'email_usu' || $campoLimpo === 'nome_usu') {
                $verificacao[$campoLimpo] = $valor;
            }

            // Adiciona campos e valores aos arrays correspondentes
            $campos[] = $campoLimpo;
            $valores[] = $valor;
        }

        // Adiciona campos e valores aos arrays correspondentes
        if (!empty($verificacao)) {
            $userExists = verifyUsers($verificacao['email_usu'] ?? null, $verificacao['nome_usu'] ?? null);

            if ($userExists['email_exist'] || $userExists['nome_exist']) {
                throw new Exception('Usuário já existe'); // Lança exceção se o usuário já existe
            }
        }

        if ($idValor) { // Se existir um valor de ID, prepara uma atualização
            $camposSql = implode(" = ?, ", $campos) . " = ?";
            $sql = "UPDATE $tabela SET $camposSql WHERE $idCampo = ?";
            $valores[] = $idValor; // Adiciona o valor do ID ao array de valores
        } else { // Se não existir valor de ID, prepara uma inserção
            $camposSql = implode(", ", $campos);
            $placeholders = implode(", ", array_fill(0, count($campos), "?"));
            $sql = "INSERT INTO $tabela ($camposSql) VALUES ($placeholders)";
        }
        // Log para verificação do SQL
        error_log("SQL: $sql");

        $stmt = $conexao->prepare($sql); // Prepara a declaração SQL
        if ($stmt === false) {
            throw new Exception('Erro ao preparar a declaração: ' . $conexao->error); // Lança exceção se houver erro na preparação
        }

        $types = str_repeat('s', count($campos)); // Define o tipo de dados dos parâmetros como string
        if ($idValor) {
            $types .= 's'; // Adiciona um tipo string adicional se for atualização
        }
        $stmt->bind_param($types, ...$valores); // Liga os parâmetros à declaração SQL

        if ($stmt->execute()) { // Executa a declaração
            $response = [
                'redirect' => '/sidebar-01/sistema/usuario/listarUsuarios.php', // URL de redirecionamento
                'message' => $idValor ? 'Registro atualizado com sucesso!' : 'Registro criado com sucesso!', // Mensagem de sucesso
                'icon' => 'success' // Ícone de sucesso
            ];
        } else {
            throw new Exception('Erro ao executar a operação: ' . $stmt->error); // Lança exceção se houver erro na execução
        }

        $stmt->close(); // Fecha a declaração
    } catch (Exception $e) { // Captura exceções
        // Define a resposta de erro
        $response = [
            'message' => 'Erro ao processar dados: ' . $e->getMessage(),
            'icon' => 'error'<?php
            ob_start(); // Inicia o buffer de saída
            session_start(); // Inicia a sessão
            header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON
            
            // Incluindo arquivos de conexão e funções
            include_once("conexao.php");
            include_once('./function/clearInput.php');
            
            $response = []; // Inicializa o array de resposta
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Verifica se o método da requisição é POST
                try {
                    // Limpa a entrada e atribui à variável tabela
                    $tabela = clearInput($conexao, $_POST['tabela']);
                    // Limpa a entrada do campo ID se existir
                    $idCampo = isset($_POST['idCampo']) ? clearInput($conexao, $_POST['idCampo']) : null;
                    // Limpa a entrada do valor do ID se existir
                    $idValor = isset($_POST[$idCampo]) ? clearInput($conexao, $_POST[$idCampo]) : null;
            
                    // Remove campos desnecessários do array $_POST
                    unset($_POST['tabela'], $_POST['idCampo'], $_POST[$idCampo]);
            
                    $campos = []; // Inicializa o array de campos
                    $valores = []; // Inicializa o array de valores
                    $verificacao = []; // Inicializa o array de verificação
            
                    // Percorre os dados do formulário
                    foreach ($_POST as $campo => $valor) {
                        $campoLimpo = clearInput($conexao, $campo); // Limpa o nome do campo
            
                    
                        // Verificação de campos únicos
                        if ($campoLimpo === 'email_usu' || $campoLimpo === 'nome_usu') {
                            $verificacao[$campoLimpo] = $valor;
                        }
            
                        // Adiciona campos e valores aos arrays correspondentes
                        $campos[] = $campoLimpo;
                        $valores[] = $valor;
                    }
            
                    // Adiciona campos e valores aos arrays correspondentes
                    if (!empty($verificacao)) {
                        $userExists = verifyUsers($verificacao['email_usu'] ?? null, $verificacao['nome_usu'] ?? null);
            
                        if ($userExists['email_exist'] || $userExists['nome_exist']) {
                            throw new Exception('Usuário já existe'); // Lança exceção se o usuário já existe
                        }
                    }
            
                    if ($idValor) { // Se existir um valor de ID, prepara uma atualização
                        $camposSql = implode(" = ?, ", $campos) . " = ?";
                        $sql = "UPDATE $tabela SET $camposSql WHERE $idCampo = ?";
                        $valores[] = $idValor; // Adiciona o valor do ID ao array de valores
                    } else { // Se não existir valor de ID, prepara uma inserção
                        $camposSql = implode(", ", $campos);
                        $placeholders = implode(", ", array_fill(0, count($campos), "?"));
                        $sql = "INSERT INTO $tabela ($camposSql) VALUES ($placeholders)";
                    }
                    // Log para verificação do SQL
                    error_log("SQL: $sql");
            
                    $stmt = $conexao->prepare($sql); // Prepara a declaração SQL
                    if ($stmt === false) {
                        throw new Exception('Erro ao preparar a declaração: ' . $conexao->error); // Lança exceção se houver erro na preparação
                    }
            
                    $types = str_repeat('s', count($campos)); // Define o tipo de dados dos parâmetros como string
                    if ($idValor) {
                        $types .= 's'; // Adiciona um tipo string adicional se for atualização
                    }
                    $stmt->bind_param($types, ...$valores); // Liga os parâmetros à declaração SQL
            
                    if ($stmt->execute()) { // Executa a declaração
                        $response = [
                            'redirect' => '/sidebar-01/sistema/usuario/listarUsuarios.php', // URL de redirecionamento
                            'message' => $idValor ? 'Registro atualizado com sucesso!' : 'Registro criado com sucesso!', // Mensagem de sucesso
                            'icon' => 'success' // Ícone de sucesso
                        ];
                    } else {
                        throw new Exception('Erro ao executar a operação: ' . $stmt->error); // Lança exceção se houver erro na execução
                    }
            
                    $stmt->close(); // Fecha a declaração
                } catch (Exception $e) { // Captura exceções
                    // Define a resposta de erro
                    $response = [
                        'message' => 'Erro ao processar dados: ' . $e->getMessage(),
                        'icon' => 'error'
                    ];
                    // Define o código de status HTTP como 500 para erro no servidor
                    http_response_code(500);
                    // Log da exceção
                    error_log("Erro: " . $e->getMessage());
                }
            } else { // Se o método da requisição não for POST
                $response = [
                    'message' => 'Método inválido!',
                    'icon' => 'error'
                ];
                // Método não permitido
                http_response_code(405);
            }
            
            mysqli_close($conexao); // Fecha a conexão com o banco de dados
            ob_end_clean(); // Limpa o buffer de saída
            echo json_encode($response); // Envia a resposta JSON
        ];
        // Define o código de status HTTP como 500 para erro no servidor
        http_response_code(500);
        // Log da exceção
        error_log("Erro: " . $e->getMessage());
    }
} else { // Se o método da requisição não for POST
    $response = [
        'message' => 'Método inválido!',
        'icon' => 'error'
    ];
    // Método não permitido
    http_response_code(405);
}

mysqli_close($conexao); // Fecha a conexão com o banco de dados
ob_end_clean(); // Limpa o buffer de saída
echo json_encode($response); // Envia a resposta JSON