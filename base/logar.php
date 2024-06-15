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
    <div class="container">
        <div class="filafacil">
            <p>Fila Fácil</p>
        </div>
        <div class="navegador">
            <p>Logar</p>
        </div>
        <div class="container">
            <div class="conteudo text-center"> <!-- Adicionado a classe text-center para centralizar todo o conteúdo -->
                <div class="row justify-content-center mb-4"> <!-- Adicionado justify-content-center para centralizar horizontalmente -->
                    <div class="alert alert-danger largmsg" role="alert">
                        Mensagem de erro de login vai ser aqui
                    </div>
                    <form action="validacao.php" method="post">
                        <div class="form-group row justify-content-center mb-1">
                            <input type="text" class="form-control" style="width: 261px; height: 40px;" placeholder="Usuário" name="usu_usu">
                        </div>
                        <div class="form-group row justify-content-center mb-4  ">
                            <input type="password" class="form-control" style="width: 261px; height: 40px;" placeholder="Senha" name="senha_usu">
                        </div>
                        <div class="justify-content-center mb-4">
                            <div class="col-12 form-group ">
                            <input type="submit" value="Logar" class="btn btn-primary largurabtn textobtn ">
                            </div>
                        </div>
                    </form>
                    <div>
                        <a href="#">Esqueceu a senha?</a> |
                        <a href="#">Criar cadastro</a>
                    </div>
                </div>
                <div class="row w-100 p-0 m-0"> <!-- Adicionado justify-content-center para centralizar horizontalmente -->
                    <div class="col-3"></div>
                    <div class="col-6 text-center">
                        <img src="../img/logoff.png" class="img-fluid" alt="Logoff">
                    </div>
                    <div class="col-3 d-flex flex-column align-items-start justify-content-end pr-3">
                        <a href="http://localhost/filafacil/base/home.php" class="btn btn-primary btnhome"><i class="fas fa-home"></i> Home</a>
                    </div>
                </div>

            </div>
        </div>
    </div>   
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
