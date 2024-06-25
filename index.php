<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fila Fácil - On Line</title>
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- FontAwesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!---Link Bootstrap--->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!---Link CSS--->
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="shortcut icon" href="./assets/img/icon.png" type="image/x-icon">

    <!-- SweetAlert CDN Link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <main id="dynamic-index">
        <!-- BOX Login -->
        <div id=" acessoModal" class="box-index">
            <input type="submit" value="Acessar Fila" href="javascript:void(0)" onclick="loadAccess('/Fila_Facil/system/filas/listarFilas.php'); 
                event.preventDefault();">
            <input id="openLogin" type="submit" value="Criar Fila">
            <img src="./assets/img/logoff.png" class="img-fluid" alt="Logoff">
        </div>
    </main>

    <!----MODAIS ACESSO E CADASTRO-->


    <!-- Modal ACESSO -->
    <div class="modal fade" id="modalAcesso" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="loginAccessForm" class="needs-validation box" novalidate name="form">
                    <div class="modal-header">
                        <img src="./assets/img/Screenshot_1.png" alt="">
                    </div>
                    <div class="modal-body">

                        <p class="text-muted">Por favor digite o seu e.mail e senha!</p>

                        <input type="email" name="email_usu" placeholder="E-mail" class="form-control" autocomplete="email" required>

                        <div class="invalid-feedback">Por favor preencha o e.mail para acesso.</div>

                        <input type="password" name="senha_usu" placeholder="Password" class="form-control" autocomplete="curent-password" required>

                        <div class="invalid-feedback">Por favor preencha uma senha válida</div>

                        <a class="forgot text-muted" href="#">Esqueceu a senha?</a>

                        <input id="btnClose" type="submit" value="Acessar" href="#">

                        <div class="col-md-12">
                            <ul class="social-network social-circle">
                                <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li><a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p class="text-muted">Não tem cadastro?
                            <a id="cadastro" href="#!"> Cadastre-se</a>
                        </p>

                    </div>
                </form>

            </div>
        </div>
    </div>



    <!-- Modal CADASTRO-->
    <div class="modal fade" id="modalCadastro" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="cadLoginUsers" class="needs-validation box" novalidate name="form">
                    <div class="modal-header">
                        <img src="./assets/img/Screenshot_4.png" alt="">
                    </div>
                    <div class="modal-body">

                        <input type="text" name="nome_usu" placeholder="Nome" class="form-control" required>
                        <div class="invalid-feedback">Por favor preencha o seu nome.</div>

                        <input type="tel" name="tel_usu" placeholder="Nome" class="form-control" required>
                        <div class="invalid-feedback">Por favor preencha o seu telefone.</div>

                        <input type="email" name="email_usu" placeholder="E-mail" class="form-control" autocomplete="email" required>
                        <div class="invalid-feedback">Por favor preencha o e.mail do usuário</div>

                        <input type="password" name="senha_usu" placeholder="Password" class="form-control" autocomplete="curent-password" required>
                        <div class="invalid-feedback">Por favor preencha uma senha válida</div>

                        <input id="btnCloseModal" type="submit" name="" value="Cadastrar" href="#">

                        <div class="col-md-12">
                            <ul class="social-network social-circle">
                                <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li><a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p class=text-muted>
                            <a href="#" onclick="logout()">SAIR<i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </p>
                    </div>

                </form>

            </div>
        </div>
    </div>



    <!-- Seção de Footer/Rodapé -->
    <footer class="footer_index">
        <ul class="list_index">
            <li>
                <a href="#" onclick="logout()">Home</a>
            </li>
            <li>
                <a href="#" onclick="loadAccess('/Fila_Facil/system/filas/listarFilas.php');
            event.preventDefault();">Filas</a>
            </li>
            <li>
                <a href="listarFuncionarios.php">Usuários</a>
            </li>
        </ul>
    </footer>

    <!-- SCRIPS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- SCRIPTS -->
    <script src="./assets/js/index/modal_index.js" defer></script>
    <script src="./assets/js/index/validar_cad_users.js" defer></script>
    <script src="./assets/js/index/validar_login.js" defer></script>
    <script src="./assets/js/logout.js" defer></script>
    <script src="./assets/js/updateAccessEdit.js" defer></script>
    <script src="./assets/js/index/loadAccess.js"></script>

</body>

</html>