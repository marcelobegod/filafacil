<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Fila Fácil</title>
</head>
<body>
<main>
    <div class="container">
        <div class="filafacil">
            <p>Fila Fácil</p>
        </div>
        <div class="navegador">
            <p>Logar</p>
        </div>
        <div class="container">
    <div class="conteudo text-center"> <!-- Adicionado a classe text-center para centralizar todo o conteúdo -->
        <div class="row justify-content-center"> <!-- Adicionado justify-content-center para centralizar horizontalmente -->
                    <form action="base/validacao.php" method="post">
                        <div class="input-group form-group">             
                            <input type="text" class="form-control" placeholder="usuario" name="usuario">
                        </div>
                        <div class="input-group form-group">
                            <input type="password" class="form-control" placeholder="senha" name="senha">
                        </div>
                        <div class="row align-items-center remember">
                            <input type="checkbox">Lembrar
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Logar" class="btn float-right login_btn">
                        </div>
                    </form>
            <div>
                <a href="#">Esqueceu a senha?</a> |
                <a href="#">Criar cadastro</a>
            </div>
        </div>
        <div class="row justify-content-center"> <!-- Adicionado justify-content-center para centralizar horizontalmente -->
            <div class="text-center">
                <img src="../img/logoff.png" class="img-fluid" alt="Logoff">
            </div>
        </div>
    </div>
</div>

    </div>   
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
