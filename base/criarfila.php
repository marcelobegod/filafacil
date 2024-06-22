<?php
    include ('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Fila Fácil</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <main>
        <div class="principal">
            <!-- top -->
                <div class="topper">
                    <div class="filafacil">
                        <p>Fila Fácil</p>
                    </div>
                    <div class="navegador">
                        <p>Home</p>
                    </div>
                </div>
                <!-- content -->
                <div class="content text-center justify-content-center p-5">
                    <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Fila</th>
                            <th scope="col">Qtdade</th>
                            <th scope="col">Data</th>
                            <th scope="col">Ações</th>
                            <th scope="col">Ações</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                    <div class="row">
                        
                    </div>
                    <div class="row">
                        
                    </div>
                    <div class="row m-5">
                        <div class="text-center">
                            <img src="../img/logoff.png" class="img-fluid" alt="Logoff">
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <div class="footer">
                <?php
                    if (isset($_SESSION['UsuarioNivel'])) {
                        include("navbar2.php");
                    } else {
                        // Caso o usuário não esteja logado, você pode adicionar um redirecionamento ou mensagem de erro
                        include("navbar1.php");
                    }
                ?>
                </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Executa o código quando o DOM estiver completamente carregado
        document.addEventListener('DOMContentLoaded', function() {
            // Obtém o caminho da URL da página atual
            var path = window.location.pathname;
            console.log(window.location.pathname);
            // Seleciona o botão correspondente à página atual
            var buttons = document.querySelectorAll('.btn-menu');
            buttons.forEach(function(button) {
                // Compara o atributo href do botão com o caminho da página atual
                if (button.getAttribute('href') === path) {
                    button.classList.add('active'); // Adiciona a classe 'active' ao botão ativo
                }
            });
        });
    </script>
</body>
</html>
