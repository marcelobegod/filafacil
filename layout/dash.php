<?php
include_once('header.php');
?>

<div id="dynamic-content">
    <?php
    // Verifica se a variável "page" foi passada na URL
    if (isset($_GET['page'])) {
        // Inclui a página solicitada 
        include '../system/filas/' . $_GET['page'] . '.php';
    } else {
        // Exibe um texto padrão caso nenhuma página seja solicitada
        echo "<h1>Bem-vindo ao painel</h1>";
    }
    ?>
</div>

<?php
include_once('footer.php');
?>