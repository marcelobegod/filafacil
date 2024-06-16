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
                        <div class="row justify-content-center">
                            <div class="alert alert-danger largmsg" role="alert">
                                Mensagem de erro de login vai ser aqui
                            </div>
                            <div class="">
                                <form action="validacao.php" method="post">
                                <div class="form-group row justify-content-center mb-1">
                                    <input type="text" class="form-control" style="width: 261px; height: 50px;" placeholder="Usuário" name="usu_usu">
                                </div>
                                <div class="form-group row justify-content-center mb-2">
                                    <input type="password" class="form-control" style="width: 261px; height: 50px;" placeholder="Senha" name="senha_usu">
                                </div>
                                <div class="justify-content-center mb-2">
                                    <div class="col-12 form-group">
                                        <input type="submit" value="Logar" class="btn btn-primary largurabtn textobtn">
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="mb-3">
                                <a href="#">Esqueceu a senha?</a> |
                                <a href="#">Criar cadastro</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="">
                                <img src="../img/logoff.png" class="img-fluid" alt="logo">
                            </div>
                        </div>
                </div>
                <!-- Footer -->
                <div class="footer">
                    <div class="row d-flex justify-content-center mx-auto largfoot">
                        <div class="col-4 p-1">
                            <a href="#" class="btn btn-primary btnhome"><i class="fas fa-list"></i>Filas</a>
                        </div>
                        <div class="col-4 p-1">
                            <a href="http://localhost/filafacil/base/home.php" class="btn btn-primary btnhome"><i class="fas fa-home"></i> Home</a>
                        </div>
                        <div class="col-4 p-1">
                            <a href="#" class="btn btn-primary btnhome"><i class="fas fa-user"></i> Usuário</a>
                        </div>
                    </div>
                </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
