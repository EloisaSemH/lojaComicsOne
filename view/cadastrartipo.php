<?php
if (isset($_SESSION['logado']) && $_SESSION['logado'] == 3) {
    require_once("app/controllers/tipoDAO.php");
    require_once("app/models/tipo.php");
    $tipoDAO = new TipoDAO();
    $tipo = new Tipo();
?>
    <div id="particles-container"></div>
    <div class="center-half mb-4 pb-4">
        <main class="container my-4 text-left">
            <div class="row my-4">
                <aside class="col-lg-4">
                    <?php include_once('view/components/menulateral.php'); ?>
                </aside>
                <article class="col-lg-8">
                    <form name="cadastro" action="" method="post" enctype="multipart/form-data" class="bg-light p-4 text-dark rounded shadow">
                    <h2 class="texto-vermelho-claro">Cadastrar tipo de quadrinho</h2>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-sm-12 col-md-6 col-lg-4">
                                <label>Título:</label>
                                <input type="text" maxlength='63' name="tipoNome" required="" class="form-control" />
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-sm-12 col-md-6 col-lg-4 text-center">
                                <input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar" class="btn btn-danger btn-outline-vermelho-claro">
                            </div>
                        </div>
                    </form>
                </article>
            </div>
        </main>
    </div>
    <?php
    if (isset($_POST["cadastrar"])) {
        $tipo->setTipo_nome($_POST["tipoNome"]);
        if ($tipoDAO->cadastrar($tipo)) {
    ?>
            <script type="text/javascript">
                alert("Cadastrado com sucesso!");
            </script>
        <?php
        } else {
        ?>
            <script type="text/javascript">
                alert("Desculpe, houvem algum erro ao cadastrar");
            </script>
    <?php
        }
    }
} else {
    ?>
    <script type="text/javascript">
        document.location.href = "<?= URL::getBase(); ?>";
    </script>
<?php
}
?>