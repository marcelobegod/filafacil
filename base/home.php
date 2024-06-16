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
                        <p>Logar</p>
                    </div>
                </div>
                <!-- content -->
                <div class="content text-center justify-content-center p-3">
                    <div class="row ">
                        <div class="text-center alig mb-4">
                            <a href="#" class="btn btn-primary largurabtn textobtn alig">Criar fila</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center mb-4">
                            <a href="#" class="btn btn-primary largurabtn textobtn">Entrar na fila</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center mb-4">
                            <a href="#" class="btn btn-primary largurabtn textobtn">Listar filas</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center">
                            <img src="../img/logoff.png" class="img-fluid" alt="Logoff">
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <div class="footer">
                    <div class="row d-flex justify-content-center mx-auto largfoot">
                        <div class="col-4 p-1">
                            <a href="http://localhost/filafacil/base/queue.php" class="btn btn-primary btnhome"><i class="fas fa-list btn-menu"></i>Filas</a>
                        </div>
                        <div class="col-4 p-1">
                            <a href="http://localhost/filafacil/base/home.php" class="btn btn-primary btnhome"><i class="fas fa-home btn-menu"></i> Home</a>
                        </div>
                        <div class="col-4 p-1">
                            <a href="http://localhost/filafacil/base/user.php" class="btn btn-primary btnhome"><i class="fas fa-user btn-menu"></i> Usuário</a>
                        </div>
                    </div>
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
