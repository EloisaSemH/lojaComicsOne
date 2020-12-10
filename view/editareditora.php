<?php
if (isset($_SESSION['logado']) && $_SESSION['logado'] == 3) {
    if (!is_null(URL::getURL(1)) && URL::getURL(1) != '') {
        require_once("app/controllers/editoraDAO.php");
        require_once("app/models/editora.php");
        $editoraDAO = new EditoraDAO();
        $editora = new Editora();
        $dados = $editoraDAO->pegarInfos(Url::getURL(1));
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
                            <h2 class="texto-vermelho-claro">Editar editora</h2>
                            <div class="form-group">
                                <label>Nome da editora: *</label>
                                <input type="text" maxlength='255' name="ediNome" required="" class="form-control" value="<?= $dados['edi_nome']?>"/>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                    <label>País:</label>
                                    <?php include('view/components/widget_paises.php'); ?>
                                </div>
                                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                    <label>Site:</label>
                                    <input type="text" maxlength='255' name="ediSite" class="form-control" value="<?= $dados['edi_site']?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sobre</label>
                                <textarea type="text" name="ediSobre" class="form-control"><?= $dados['edi_sobre']?></textarea>
                            </div>
                            <div class="form-group text-right">
                                <small>* campos obrigatórios</small>
                            </div>
                            <div class="form-group text-right">
                                <input type="submit" value="Editar" id="enviar" name="editar" class="btn btn-danger btn-outline-vermelho-claro mt-1">
                            </div>
                        </form>
                    </article>
                </div>
            </main>
        </div>
        <?php
        if (isset($_POST["editar"])) {
            extract($_POST);
            $editora->setEdi_nome($ediNome);
            $editora->setEdi_pais($paises);
            $editora->setEdi_site($ediSite);
            $editora->setEdi_sobre($ediSobre);
            $editora->setEdi_cod(Url::getURL(1));
            if ($editoraDAO->atualizarEditora($editora)) {
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
            alert("Selecione uma categoria primeiro");
            document.location.href = "<?= URL::getBase(); ?>todas-categorias";
        </script>
    <?php
    }
} else {
    ?>
    <script type="text/javascript">
        document.location.href = "<?= URL::getBase(); ?>inicio";
    </script>
<?php
}
?>