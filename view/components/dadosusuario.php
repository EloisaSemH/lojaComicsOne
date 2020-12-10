<?php
require_once("app/controllers/usuarioDAO.php");
$usuarioDAO = new UsuarioDAO();

if (isset($_GET['id'])) {
    $dados = $usuarioDAO->pegarInfos($_GET['id']);
} else {
    $dados = $usuarioDAO->pegarInfos($_SESSION['cod']);
}

?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 py-5 my-5">
            <form name="login" action="" method="post" enctype="">
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">
                        <label>Nome:</label>
                        <input type="text" maxlength='128' id="usNome" name="usNome" required="" class="form-control" value="<?= $dados['us_nome']; ?>" autocomplete="off" />
                        <p id="retornoNome" class="form-text text-muted text-center">Total
                            de caracteres restantes: 128</p>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">
                        <label>CPF:</label>
                        <input type="number" maxlength='11' id="usCpf" name="usCpf" required="" class="form-control" placeholder="Somente números" value="<?= $dados['us_cpf']; ?>" autocomplete="off" readonly />
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">
                        <label>Email:</label>
                        <input type="email" class="form-control" id="usEmail" name="usEmail" maxlength="128" placeholder="email@provedor.com" required="" value="<?= $dados['us_email']; ?>" autocomplete="off" />
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">
                        <label>Gênero:</label>
                        <select name="usGenero" required>
                            <?php if ($dados['us_genero'] == 'feminino') { ?>
                                <option value="feminino" selected>Feminino</option>
                                <option value="masculino">Masculino</option>
                                <option value="outro">Outro</option>
                            <?php } elseif ($dados['us_genero'] == 'masculino') { ?>
                                <option value="feminino">Feminino</option>
                                <option value="masculino" selected>Masculino</option>
                                <option value="outro">Outro</option>
                            <?php } else { ?>
                                <option value="outro" selected>Outro</option>
                                <option value="feminino">Feminino</option>
                                <option value="masculino">Masculino</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">
                        <label>Telefone:</label>
                        <input type="text" class="form-control" name="usTelefone" maxlength="16" value="<?php echo $dados['us_telefone']; ?>" required="" autocomplete="off">
                    </div>
                </div>
                <?php if ($_SESSION['cod'] == $dados['us_cod']) { ?>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-md-6 col-lg-4">
                            <label>Insira sua nova senha:</label>
                            <input onKeyUp="validarSenha('senha1', 'senha2', 'senhasCoin');" type="password" class="form-control" name="usSenha" id="senha1" maxlength="16" autocomplete="off">
                            <p id="retornoSenha1" class="form-text text-muted text-center">Total
                                de caracteres restantes: 16</p>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-md-6 col-lg-4">
                            <label>Repita a senha:</label>
                            <input onKeyUp="validarSenha('senha1', 'senha2', 'senhasCoin')" type="password" class="form-control" name="usSenhaRep" id="senha2" maxlength="16" autocomplete="off">
                            <p id="senhasCoin" class="form-text text-muted text-center">&nbsp;</p>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($_SESSION['logado'] >= 3) { ?>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-md-6 col-lg-4">
                            <label>Classe de usuário:</label>
                            <select name="usTipo">
                                <?php if ($dados['us_tipo'] == 1) { ?>
                                    <option value="1" selected>Comum</option>
                                    <option value="2">Postador</option>
                                    <option value="3">Webmaster</option>
                                <?php } elseif ($dados['us_tipo'] == 2) { ?>
                                    <option value="1">Comum</option>
                                    <option value="2" selected>Postador</option>
                                    <option value="3">Webmaster</option>
                                <?php } elseif ($dados['us_tipo'] == 3) { ?>
                                    <option value="1">Comum</option>
                                    <option value="2">Postador</option>
                                    <option value="3" selected>Webmaster</option>
                                <?php } else { ?>
                                    <option value="1">Comum</option>
                                    <option value="2">Postador</option>
                                    <option value="3">Webmaster</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-sm-12 col-md-6 col-lg-4">
                            <label>Data e hora de cadastro:</label>
                            <input type="text" name="usDataHora" required="" class="form-control text-center" value="<?php echo date('d/m/Y', strtotime($dados['us_data'])) . ' às ' . $dados['us_hora']; ?>" readonly />
                        </div>
                    </div>
                <?php } else {
                    $_POST['usTipo'] = $dados['us_tipo'];
                } ?>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12 col-md-6 col-lg-4 text-center">
                        <input type="submit" value="Atualizar" id="atualizar" name="atualizar" class="btn btn-outline-dark">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-sm-12 col-md-6 col-lg-4 text-center">
                        <a href="index.php" class="btn btn-link">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST["atualizar"])) {
    // var_dump(intval($_POST["usTipo"]));
    require_once("db/models/usuario.php");
    $usuario = new Usuario();
    $usuario->setUs_cod($dados["us_cod"]);
    $usuario->setUs_nome($_POST["usNome"]);
    $usuario->setUs_cpf($_POST["usCpf"]);
    $usuario->setUs_email($_POST["usEmail"]);
    $usuario->setUs_genero($_POST["usGenero"]);
    $usuario->setUs_telefone($_POST["usTelefone"]);
    $usuario->setUs_tipo(intval($_POST["usTipo"]));

    if ($usuarioDAO->atualizarUsuario($usuario)) {
        if ($_POST['usSenha'] != '') {
            require_once("db/DAO/senhaDAO.class.php");
            $senhaDAO = new senhaDAO();
            $verifsenha = $senhaDAO->verificacaoSenha($_POST['usSenha'], $_POST['usSenhaRep']);

            if ($verifsenha == true) {
                if ($senhaDAO->redefinirSenha($dados["us_cod"], $_POST['usSenhaRep'])) {
                    $_SESSION['Usuario'] = $_POST["us_nome"];
?>
                    <script type="text/javascript">
                        alert("Usuário e senha atualizados com sucesso!");
                        document.location.href = "index.php";
                    </script>
                <?php
                } else {
                ?>
                    <script type="text/javascript">
                        alert("Desculpe, houve um erro ao atualizar o usuário e senha. Por favor, verifique com o Webmaster.");
                    </script>
            <?php
                }
            }
        } else {
            ?>
            <script type="text/javascript">
                alert("Usuário atualizado com sucesso!");
                document.location.href = "index.php";
            </script>
        <?php
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("Desculpe, houve um erro ao atualizar o usuário");
            document.location.href = "index.php?&pg=editarUsuario";
        </script>
<?php
    }
}
?>
<script src="js/form.js"></script>