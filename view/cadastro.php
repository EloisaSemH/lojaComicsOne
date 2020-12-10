<?php
require_once("app/controllers/usuarioDAO.php");
require_once("app/models/usuario.php");
$usuarioDAO = new UsuarioDAO();
$usuario = new Usuario();

require_once("app/controllers/senhaDAO.php");
require_once("app/models/senha.php");
$senhaDAO = new SenhaDAO;
$senha = new Senha;
?>
<div id="particles-container"></div>
<div class="center-half mb-4 pb-4">
    <div class="container mb-4">
        <div class="row justify-content-center center text-left my-4">
            <main class="col-lg-8 col-md-12 col-sm-12 my-4">
                <form name="cadastro" action="" method="post" enctype="multipart/form-data" class="bg-light p-4 text-dark rounded shadow">
                    <h2 class="texto-vermelho-claro">Cadastrar</h2>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label>Nome completo: *</label>
                            <input type="text" maxlength='127' name="usNome" id="usNome" class="form-control" required />
                            <p id="retornoNome" class="form-text text-muted text-center mb-0">Total
                                de caracteres restantes: 128</p>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label>Email: *</label>
                            <input type="email" class="form-control" name="usEmail" id="usEmail" maxlength="127" required>
                            <p id="retornoEmail" class="form-text text-muted text-center mb-0">&nbsp;</p>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label>CPF: *</label>
                            <input type="number" maxlength='14' id="usCpf" name="usCpf" class="form-control" placeholder="Somente números" required />
                            <p id="retornoCPF" class="form-text text-muted text-center mb-0">Total
                                de caracteres restantes: 11</p>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label>Telefone: *</label>
                            <input type="text" class="form-control" name="usTelefone" maxlength="16" placeholder="(XX) XXXXX-XXXX" required="">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label>Data de nascimento: *</label>
                            <input type="date" class="form-control" name="usDataNasc" required="">
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label>Gênero: *</label>
                            <select name="slGenero" class="form-control" required>
                                <option value="f">Feminino</option>
                                <option value="m">Masculino</option>
                                <option value="o">Outro</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label>Senha: *</label>
                            <input onKeyUp="validarSenha('senha1', 'senha2', 'senhasCoin');" type="password" class="form-control" name="usSenha" id="senha1" maxlength="40" required="">
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label>Repita a senha: *</label>
                            <input onKeyUp="validarSenha('senha1', 'senha2', 'senhasCoin')" type="password" class="form-control" name="usSenhaRep" id="senha2" maxlength="40" required="">
                            <p id="senhasCoin" class="form-text text-muted text-center mb-0">Digite uma senha</p>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <label for="input-file">Enviar foto de perfil: </label><br>
                            <label for="input-file" class="btn btn-vermelho-medio w-100">Selecione uma imagem</label>
                            <input type="file" id="input-file" name="ftc_img" class="form-control-file" accept="image/png, image/jpeg, image/jpg" />
                            <p id='file-name' class="text-muted text-center p-0 m-0">&nbsp;</p>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-6 text-right pt-lg-3">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="termos" required>
                                <label class="form-check-label" for="termos">Eu li e concordo com os <a href="#">termos de uso</a> e <a href="#">políticas de privacidade</a>.</label>
                            </div>
                            <!-- <a href="index.php?&pg=recuperarsenha" class="btn btn-link">Esqueceu a senha?</a> -->
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                            <a href="<?= URL::getBase(); ?>login" class="jaestacadastrado">Já está cadastrado? Faça login!</a>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-6 text-right">
                            <input type="submit" value="Registrar" id="enviar" name="registrar" class="btn btn-danger btn-outline-vermelho-claro">
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>
<?php
if (isset($_POST["registrar"])) {
    extract($_POST);
    $verifsenha = $senhaDAO->verificacaoSenha(trim($usSenha), trim($usSenhaRep));

    if ($verifsenha == true) {
        if (!$clienteDAO->consultarCPF($usCpf)) {
            if (!$usuarioDAO->consultarPorEmail(trim($usEmail))) {
                $usuario->setUs_nome(trim($usNome));
                $usuario->setUs_email(trim($usEmail));
                $usuario->setUS_cpf(trim($usCpf));
                $usuario->setUS_dataNasc($usDataNasc);
                $usuario->setUS_telefone(trim($usTelefone));
                $usuario->setUs_genero($slGenero);
                if ($usuarioDAO->cadastrar($usuario)) {
                    $codUsu = $usuarioDAO->consultarCodUsuario(trim($usEmail));
                    $senha->setSe_senha(trim($usSenhaRep));
                    $senha->setUs_cod($codUsu);
                    if ($senhaDAO->cadastrar($senha)) {
                        if (isset($_FILES['ftc_img']) && !is_null($_FILES['ftc_img'])) {
                            require_once("app/controllers/fotoUsuarioDAO.php");
                            require_once("app/models/fotoUsuario.php");
                            $fotoDAO = new FotoUsuarioDAO();
                            $fotos = new FotoUsuario();

                            $extensao = pathinfo($_FILES['ftc_img']['name'], PATHINFO_EXTENSION);
                            $extensao = '.' . strtolower($extensao);
                            $nomeimagem = str_replace('-', '', date('Y-m-d')) . str_replace(':', '', date('H:i:s')) . rand(0, 999) . $extensao;

                            $verf = move_uploaded_file($_FILES['ftc_img']['tmp_name'], 'img/usuarios/' . $nomeimagem);
                            if ($verf == 1) {
                                $fotos->setFtc_us_cod($codUsu);
                                $fotos->setFtc_img($nomeimagem);
                                $fotos->setFtc_desc('Foto de perfil do usuário ' . trim($usNome));
                                if ($fotoDAO->inserirfoto($fotos)) {
?>
                                    <script type="text/javascript">
                                        alert("Cadastro com foto realizado com sucesso!");
                                        document.location.href = "<?= URL::getBase(); ?>login";
                                    </script>
                        <?php
                                }
                            }
                        }
                        ?>
                        <script type="text/javascript">
                            alert("Cadastrado com sucesso!");
                            document.location.href = "<?= URL::getBase(); ?>login";
                        </script>
                    <?php
                    } else {
                    ?>
                        <script type="text/javascript">
                            alert("Erro ao cadastrar");
                        </script>
                <?php
                    }
                }
            } else {
                ?>
                <script type="text/javascript">
                    alert("O E-mail informado já foi cadastrado");
                </script>
            <?php
            }
        } else {
            ?>
            <script type="text/javascript">
                alert("O CPF informado já foi cadastrado");
            </script>
<?php
        }
    }
}
?>
<script src="js/form.js"></script>