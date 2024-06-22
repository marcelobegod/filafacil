<?php
function verifyLogin($email, $senha)
{
    global $conexao;

    // Prepara a consulta para verificar o email
    $stmt = $conexao->prepare("SELECT id_usu, nome_usu, nivel_usu, senha_usu FROM usuario WHERE email_usu = ?");
    if ($stmt === false) {
        error_log("Erro ao preparar statement: " . $conexao->error);
        return false;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    if ($stmt->errno) {
        error_log("Erro ao executar statement: " . $stmt->error);
        return false;
    }

    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usu, $nome_usu, $nivel_usu, $hashSenha);
        $stmt->fetch();

        // Utilize password_verify para comparação
        if (password_verify($senha, $hashSenha)) {
            error_log("Senha verificada com sucesso.");
            $stmt->close();

            $usuario = [
                'id_usu' => $id_usu,
                'nome_usu' => $nome_usu,
                'nivel_usu' => $nivel_usu,
            ];
            return $usuario;
        } else {
            error_log("Falha na verificação da senha.");
            $stmt->close();
            return false;
        }
    } else {
        error_log("Usuário não encontrado.");
        $stmt->close();
        return false;
    }
}