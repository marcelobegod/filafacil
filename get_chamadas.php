<?php
include_once('./API/conexao.php');

$sql = "SELECT * FROM filas_chamada WHERE atendido = 'não'";
$result = $conexao->query($sql);

$chamadas = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $chamadas[] = $row;
    }
}

echo json_encode($chamadas);
$conexao->close();
