<?php
if (isset($_SESSION['logado']) && $_SESSION['logado'] == 3) {
    if (!is_null(URL::getURL(1)) && URL::getURL(1) != '') {
        require_once("app/controllers/tipoDAO.php");
        require_once("app/models/tipo.php");
        $tipoDAO = new TipoDAO();
        $tipo = new Tipo();
        $dados = $tipoDAO->pegarInfos(Url::getURL(1));
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
                            <h2 class="texto-vermelho-claro">Editar tipo de quadrinho</h2>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12 col-md-6 col-lg-4">
                                    <label>Título:</label>
                                    <input type="text" maxlength='63' name="tipoNome" required="" class="form-control" value="<?= $dados['tipo_nome'] ?>" />
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12 col-md-6 col-lg-4 text-center">
                                    <input type="submit" value="Editar" id="editar" name="editar" class="btn btn-danger btn-outline-vermelho-claro">
                                </div>
                            </div>
                        </form>
                    </article>
                </div>
            </main>
        </div>
        <?php
        if (isset($_POST["editar"])) {
            $tipo->setTipo_nome($_POST["tipoNome"]);
            $tipo->setTipo_cod(URL::getURL(1));
            if ($tipoDAO->atualizarTipo($tipo)) {
        ?>
                <script type="text/javascript">
                    alert("Editado com sucesso!");
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("Desculpe, houvem algum erro ao editar");
                </script>
        <?php
            }
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("Selecione uma tipo primeiro");
            document.location.href = "<?= URL::getBase(); ?>todos-tipos";
        </script>
    <?php
    }
} else {
    ?>
    <script type="text/javascript">
        document.location.href = "<?= URL::getBase(); ?>";
    </script>
<?php
}
?>