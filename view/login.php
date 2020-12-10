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
    <main class="container mb-4">
        <div class="row justify-content-center center text-left my-4">
            <div class="col-lg-4 col-md-6 col-sm-12 my-4">
                <form name="login" action="" method="post" enctype="" class="bg-light p-4 text-dark rounded shadow">
                    <h2 class="texto-vermelho-claro">Entrar</h2>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="usEmail" required="" placeholder="nome@email.com" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Senha:</label>
                        <input type="password" name="usSenha" required="" class="form-control" />
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="Entrar" id="entrar" name="entrar" class="btn btn-danger btn-outline-vermelho-claro">
                    </div>
                    <div class="form-group text-center">
                        <a href="<?= URL::getBase(); ?>cadastro" class="btn btn-link">Cadastre-se</a>
                        <!-- <a href="index.php?&pg=recuperarsenha" class="btn btn-link">Esqueceu a senha?</a> -->
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<?php
if (isset($_POST['entrar'])) {
    if ($usuarioDAO->login($_POST['usEmail'], $_POST['usSenha'])) {

        $dados = $usuarioDAO->consultarPorEmail($_POST['usEmail']);
        $_SESSION['cod_usuario'] = $dados['us_cod'];
        $dados['us_nome'] = explode(' ', $dados['us_nome']);
        $_SESSION['usuario'] = $dados['us_nome'][0];

        if ($dados['us_tipo'] == 1) {
            // Usuário comum
            $_SESSION['logado'] = 1;
        } elseif ($dados['us_tipo'] == 2) {
            // Usuário postador
            $_SESSION['logado'] = 2;
        } elseif ($dados['us_tipo'] == 3) {
            // Webmaster
            $_SESSION['logado'] = 3;
        } else {
?>
            <script type="text/javascript">
                alert("Desculpe, houve algum erro na sessão. Contate o Webmaster para a verificação.");
            </script>
        <?php
        }

        ?>
        <script type="text/javascript">
            document.location.href = "<?= URL::getBase(); ?>";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Email ou senha incorretos");
        </script>
<?php
    }
}
?>
<script src="js/form.js"></script>
