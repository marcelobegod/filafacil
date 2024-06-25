<?php
include_once ('./API/conexao.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_chamada = $_POST['id_chamada'] ?? null;
    $atendido = $_POST['atendido'] ?? null;

    if ($id_chamada !== null && $atendido !== null) {
        $sql = "UPDATE filas_chamada SET atendido = ?, data_atendimento = NOW() WHERE id_chamada = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $atendido, $id_chamada);

        if (mysqli_stmt_execute($stmt)) {
            echo "Success";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Invalid data provided.";
    }
} else {
    echo "Invalid request method.";
}

mysqli_close($conexao);