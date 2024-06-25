<?php
function verifyUsers($codAccess, $nome)
{
    // Torna a variável $conexao, definida no arquivo conexao.php, acessível dentro desta função.
    global $conexao;

    /* - Prepara as queries para evitar SQL injection - */

    // Utiliza placeholders (?) para os valores que serão inseridos posteriormente.
    $sql_codAccess = $conexao->prepare("SELECT COUNT(*) FROM filafacil WHERE cod_acess_fila = ?");
    $sql_nome = $conexao->prepare("SELECT COUNT(*) FROM filafacil WHERE nome_fila = ?");

    /* - Executa a query para o email - */

    // Associa o valor do parâmetro $codAccess ao placeholder da query $sql_codAccess.
    $sql_codAccess->bind_param("s", $codAceess);

    // Executa a query preparada.
    $sql_codAccess->execute();

    // Obtém o resultado da query.
    $sql_codAccess->store_result();
    $sql_codAccess->bind_result($resultado_codAccess);
    $sql_codAccess->fetch();

    /* - Executa a query para o nome de usuário - */

    $sql_nome->bind_param("s", $nome);
    $sql_nome->execute();

    // Obtém o resultado da query.
    $sql_nome->store_result();
    $sql_nome->bind_result($resultado_nome);
    $sql_nome->fetch();

    // Fecha as statements
    $sql_codAccess->close();
    $sql_nome->close();

    // Retorna um array com os resultados.
    return array(
        'codigo_exist' => $resultado_codAccess > 0,
        'nome_exist' => $resultado_nome > 0
    );
}
