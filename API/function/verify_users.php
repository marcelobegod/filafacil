<?php
function verifyUsers($email, $nome)
{
    // Torna a variável $conexao, definida no arquivo conexao.php, acessível dentro desta função.
    global $conexao;

    /* - Prepara as queries para evitar SQL injection - */

    // Utiliza placeholders (?) para os valores que serão inseridos posteriormente.
    $sql_email = $conexao->prepare("SELECT COUNT(*) FROM usuario WHERE email_usu = ?");
    $sql_nome = $conexao->prepare("SELECT COUNT(*) FROM usuario WHERE nome_usu = ?");

    /* - Executa a query para o email - */

    // Associa o valor do parâmetro $email ao placeholder da query $sql_email.
    $sql_email->bind_param("s", $email);

    // Executa a query preparada.
    $sql_email->execute();

    // Obtém o resultado da query.
    $sql_email->store_result();
    $sql_email->bind_result($resultado_email);
    $sql_email->fetch();

    /* - Executa a query para o nome de usuário - */

    $sql_nome->bind_param("s", $nome);
    $sql_nome->execute();

    // Obtém o resultado da query.
    $sql_nome->store_result();
    $sql_nome->bind_result($resultado_nome);
    $sql_nome->fetch();

    // Fecha as statements
    $sql_email->close();
    $sql_nome->close();

    // Retorna um array com os resultados.
    return array(
        'email_exist' => $resultado_email > 0,
        'nome_exist' => $resultado_nome > 0
    );
}