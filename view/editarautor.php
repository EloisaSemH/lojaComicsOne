<?php
if (isset($_SESSION['logado']) && $_SESSION['logado'] == 3) {
    if (!is_null(URL::getURL(1)) && URL::getURL(1) != '') {

        require_once("app/controllers/autorDAO.php");
        require_once("app/models/autor.php");
        $autorDAO = new AutorDAO();
        $autor = new Autor();

        $dados = $autorDAO->pegarInfos(Url::getURL(1));

        switch ($dados['aut_genero']) {
            case 'f':
                $genero = 'Feminino';
                break;
            case 'm':
                $genero = 'Masculino';
                break;
            default:
                $genero = 'Outro';
                break;
        }
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
                            <h2 class="texto-vermelho-claro">Editar autor</h2>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                    <label>Nome artístico: *</label>
                                    <input type="text" maxlength='127' name="autNomeArtistico" required="" class="form-control" value="<?= $dados['aut_nomeArtistico']; ?>" />
                                </div>
                                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                    <label>Nome verdadeiro:</label>
                                    <input type="text" maxlength='127' name="autNomeVerdadeiro" class="form-control" value="<?= $dados['aut_nomeVerdadeiro']; ?>" />
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                    <label>Gênero:</label>
                                    <select name="slGenero" class="form-control" required>
                                        <option value="<?= $dados['aut_genero']; ?>"><?= $genero; ?></option>
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
                                    <input type="text" maxlength='255' name="autSite" class="form-control" value="<?= $dados['aut_site']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sobre</label>
                                <textarea type="text" name="autSobre" class="form-control"><?= $dados['aut_sobre']; ?></textarea>
                            </div>
                            <div class="form-group text-right">
                                <small>* campos obrigatórios</small>
                            </div>
                            <div class="form-group text-right">
                                <input type="submit" value="Atualizar" id="enviar" name="atualizar" class="btn btn-danger btn-outline-vermelho-claro mt-1">
                            </div>
                        </form>
                    </article>
                </div>
            </main>
        </div>
        <?php
        if (isset($_POST["atualizar"])) {
            extract($_POST);
            $autor->setAut_NomeArtistico($autNomeArtistico);
            $autor->setAut_NomeVerdadeiro($autNomeVerdadeiro);
            $autor->setAut_genero($slGenero);
            $autor->setAut_pais($paises);
            $autor->setAut_site($autSite);
            $autor->setAut_sobre($autSobre);
            $autor->setAut_cod(Url::getURL(1));
            if ($autorDAO->atualizarAutor($autor)) {
        ?>
                <script type="text/javascript">
                    alert("Cadastrado com sucesso!");
                    document.location.href = "<?= URL::getBase(0); ?>editar-autor/<?= URL::getURL(1); ?>";
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("Desculpe, houvem algum erro ao atualizar");
                </script>
        <?php
            }
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("Selecione uma editora primeiro");
            document.location.href = "<?= URL::getBase(); ?>todas-editoras";
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