<?php
if (isset($_SESSION['logado']) && $_SESSION['logado'] == 3) {
    require_once("app/controllers/autorDAO.php");
    require_once("app/models/autor.php");
    $autorDAO = new AutorDAO();
    $autor = new Autor();
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
                    <h2 class="texto-vermelho-claro">Cadastrar autor</h2>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Nome artístico: *</label>
                                <input type="text" maxlength='127' name="autNomeArtistico" required="" class="form-control" />
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                <label>Nome verdadeiro:</label>
                                <input type="text" maxlength='127' name="autNomeVerdadeiro" class="form-control" />
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                <label>Gênero:</label>
                                <select name="slGenero" class="form-control" required>
                                    <option value="f">Feminino</option>
                                    <option value="m">Masculino</option>
                                    <option value="o">Outro</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                <label>País:</label>
                                <?php include('view/components/widget_paises.php'); ?>
                            </div>
                            <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                <label>Site:</label>
                                <input type="text" maxlength='255' name="autSite" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Sobre</label>
                            <textarea type="text" name="autSobre" class="form-control"></textarea>
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
        $autor->setAut_NomeArtistico($_POST["autNomeArtistico"]);
        $autor->setAut_NomeVerdadeiro($_POST["autNomeVerdadeiro"]);
        $autor->setAut_genero($_POST["slGenero"]);
        $autor->setAut_pais($_POST["paises"]);
        $autor->setAut_site($_POST["autSite"]);
        $autor->setAut_sobre($_POST["autSobre"]);
        if ($autorDAO->cadastrar($autor)) {
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