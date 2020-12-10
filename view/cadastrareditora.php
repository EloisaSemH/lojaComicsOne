<?php
if (isset($_SESSION['logado']) && $_SESSION['logado'] == 3) {
    require_once("app/controllers/editoraDAO.php");
    require_once("app/models/editora.php");
    $editoraDAO = new EditoraDAO();
    $editora = new Editora();
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
                    <h2 class="texto-vermelho-claro">Cadastrar editora</h2>
                        <div class="form-group">
                            <label>Nome da editora: *</label>
                            <input type="text" maxlength='255' name="ediNome" required="" class="form-control" />
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>País:</label>
                                <?php include('view/components/widget_paises.php'); ?>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Site:</label>
                                <input type="text" maxlength='255' name="ediSite" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Sobre</label>
                            <textarea type="text" name="ediSobre" class="form-control"></textarea>
                        </div>
                        <div class="form-group text-right">
                            <small>* campos obrigatórios</small>
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" value="Cadastrar" id="enviar" name="cadastrar" class="btn btn-danger btn-outline-vermelho-claro mt-1">
                        </div>
                    </form>
                </article>
            </div>
        </main>
    </div>
    <?php
    if (isset($_POST["cadastrar"])) {
        $editora->setEdi_nome($_POST["ediNome"]);
        $editora->setEdi_pais($_POST["paises"]);
        $editora->setEdi_site($_POST["ediSite"]);
        $editora->setEdi_sobre($_POST["ediSobre"]);
        if ($editoraDAO->cadastrar($editora)) {
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
        document.location.href = "<?= URL::getBase(); ?>inicio";
    </script>
<?php
}
?>