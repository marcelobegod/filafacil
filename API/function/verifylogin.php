<?php
function verifyLogin($email, $senha)
{
    global $conexao;

    // Prepara a consulta para verificar o email
    $stmt = $conexao->prepare("SELECT id_usu, nome_usu, nivel_usu, pass_usu FROM usuario WHERE email_usu = ?");
    if ($stmt === false) {
        return false;
    }

    $stmt->bind_param("s", $email);

    $stmt->execute();
    if ($stmt->errno) {
        return false;
    }

    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usu, $nome_usu, $nivel_usu, $hashSenha);
        $stmt->fetch();

        error_log("Hash da senha antes: " . $hashSenha);
        if (password_verify($senha, $hashSenha)) {
            $stmt->close();

            $usuario = [
                'id_usu' => $id_usu,
                'nome_usu' => $nome_usu,
                'nivel_usu' => $nivel_usu,
            ];
            return $usuario;
        } else {
            $stmt->close();
            return false;
        }
    } else {
        $stmt->close();
        return false;
    }
}