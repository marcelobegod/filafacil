<?php
// Verifica se houve POST e se o usuário ou a senha estão vazios
if (!empty($_POST) and (empty($_POST['usuario']) or empty($_POST['senha']))) {
	header("Location: index.php"); exit;
}
// Tenta se conectar ao servidor MySQL e ao DB
$con = mysqli_connect('localhost', 'root', '', 'filafacil');

$usuario = mysqli_real_escape_string($con, $_POST['usu_usu']);
$senha = mysqli_real_escape_string($con, $_POST['senha_usu']);

// Validaçao do usuário
$sql  = "select id_usu, nome_usu, nivel from usuario where (usuario = '". $usuario ."') ";
$sql .= "and (senha = '". sha1($senha) ."') and (ativo = 1) limit 1";

$query = mysqli_query($con, $sql);

if (mysqli_num_rows($query) != 1) {
	// Mensagem de erro 
	header('Content-Type: text/html; charset=utf-8');
	echo "Login invalido!"; exit;
} else {
	// Salva os dados encontados na variável $resultado
	$resultado = mysqli_fetch_assoc($query);
	
	///// 4.0 - Salvando os dados na sessão do PHP /////

	// Se a sessão não existir, inicia uma
	if (!isset($_SESSION)) session_start();

	// Salva os dados encontrados na sessão
	$_SESSION['UsuarioID'] = $resultado['id_usu'];
	$_SESSION['UsuarioNome'] = $resultado['nome_usu'];
	$_SESSION['UsuarioNivel'] = $resultado['nivel_usu'];

	/* switch($_SESSION['UsuarioNivel']){
        case 2: header("Location: sidebar1.php"); exit;break;
        case 3: header("Location: sidebar2.php"); exit;break;
        case 4: header("Location: sidebar3.php"); exit;break;
    } */

}
	
?>