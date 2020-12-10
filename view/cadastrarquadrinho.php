<?php
if (isset($_SESSION['logado']) && $_SESSION['logado'] == 3) {
    require_once("app/controllers/quadrinhoDAO.php");
    require_once("app/models/quadrinho.php");
    $quadrinhoDAO = new QuadrinhoDAO();
    $quadrinho = new Quadrinho();

    require_once("app/controllers/categoriaDAO.php");
    $categoriaDAO = new CategoriaDAO();

    require_once("app/controllers/tipoDAO.php");
    $tipoDAO = new TipoDAO();

    require_once("app/controllers/editoraDAO.php");
    $editoraDAO = new EditoraDAO();

    require_once("app/controllers/autorDAO.php");
    $autorDAO = new AutorDAO();
?>
    <div id="particles-container"></div>
    <div class="center-half mb-4 pb-4">
        <main class="container my-4 text-left">
            <div class="row justify-content-center center text-left my-4">
                <aside class="col-lg-4">
                    <?php include_once('view/components/menulateral.php'); ?>
                </aside>
                <article class="col-lg-8 col-md-8 col-sm-12">
                    <form name="cadastro" action="" method="post" enctype="multipart/form-data" class="bg-light p-4 text-dark rounded shadow">
                        <h2 class="texto-vermelho-claro">Cadastrar quadrinho</h2>
                        <div class="form-group">
                            <label>Título: *</label>
                            <input type="text" maxlength='255' name="hqTitulo" required="" class="form-control" />
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-sm-12 col-md-6 col-lg-4">
                                <label>Edição:</label>
                                <input type="number" max='9999' min="0" name="hqEdicao" class="form-control" />
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-4">
                                <label>Volume: </label>
                                <input type="number" max="9999" min="0" name="hqVolume" class="form-control" />
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-4">
                                <label>Série:</label>
                                <input type="text" maxlength='32' name="hqSerie" class="form-control" />
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-sm-12 col-md-6 col-lg-4">
                                <label>Ano de lançamento:</label>
                                <input type="number" max="<?= date('Y'); ?>" min="1890" name="hqLancamento" class="form-control" />
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-4">
                                <label>Número de páginas:</label>
                                <input type="number" max='9999' min="1" name="hqNumPaginas" class="form-control" />
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-4">
                                <label>Faixa etária:</label>
                                <input type="number" max='21' min="0" name="hqFaixaEtaria" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Sinopse</label>
                            <textarea type="text" name="hqSinopse" class="form-control"></textarea>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                <label>Editora: *</label>
                                <?php $editoraDAO->selectEditora(); ?>
                            </div>
                            <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                <label>Tipo: *</label>
                                <?php $tipoDAO->selectTipo(); ?>
                            </div>
                            <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                <label>Impressão: </label>
                                <select name="hqImpressao" class="form-control">
                                    <option value=""></option>
                                    <option value="Colorido">Colorido</option>
                                    <option value="Preto e branco">Preto e branco</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row selectCategoria">
                            <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-4 ">
                                <label>Categoria: *</label>
                                <select class="form-control ls-select" name="hqCat[1]">
                                    <?php $categoriaDAO->selectCategoria(); ?>
                                </select>
                            </div>
                            <div class="form-group text-center col-xs-2 col-sm-2 col-md-2 col-lg-2 pt-3">
                                <i class="far fa-minus-square removeBtn mt-3 mr-2" id="removeCategoria"></i>
                                <i class="far fa-plus-square addBtn mt-3 ml-2" id="addCategoria"></i>
                            </div>
                        </div>
                        <div class="form-row selectAutor">
                            <div class="form-group col-xs-10 col-sm-10 col-md-6 col-lg-4">
                                <label>Autor: *</label>
                                <select class="form-control ls-select" name="hqAutor[1]">
                                    <?php $autorDAO->selectAutor(); ?>
                                </select>
                            </div>
                            <div class="form-group text-center col-xs-1 col-sm-1 col-md-2 col-lg-2 pt-3">
                                <i class="far fa-minus-square removeBtn mt-3 mr-2" id="removeAutor"></i>
                                <i class="far fa-plus-square addBtn mt-3 ml-2" id="addAutor"></i>
                            </div>
                        </div>
                        <div class="form-row justify-content-center ">
                            <div class="form-group col-sm-12 col-md-6 col-lg-3">
                                <label>Valor: *</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">R$</div>
                                    </div>
                                    <input type="number" class="form-control" name="hqValor" step="0.01" required="">
                                </div>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-3">
                                <label>Promoção:</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control text-right" placeholder="" name="hqPromocao">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-3">
                                <label>Estoque disponível: *</label>
                                <input type="number" max="9999" min="0" name="hqEstoque" class="form-control" />
                            </div>
                            <div class="form-group col-sm-12 col-md-6 col-lg-3">
                                <label>Em Estoque: *</label>
                                <select name="hqEmEstoque" class="form-control">
                                    <option value="true">Sim</option>
                                    <option value="false">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row ">
                            <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                <label for="input-file">Enviar foto: </label><br>
                                <label for="input-file" class="btn btn-vermelho-medio w-100">Selecione uma imagem</label>
                                <input type="file" id="input-file" name="ftq_img" class="form-control-file" accept="image/png, image/jpeg, image/jpg" />
                                <p id='file-name' class="text-muted text-center p-0 m-0">&nbsp;</p>
                            </div>
                            <div class="form-group col-sm-6 col-md-6 col-lg-6 text-right">
                                <small>* campos obrigatórios</small><br>
                                <input type="submit" value="Cadastrar" id="cadastrar" name="cadastrar" class="btn btn-danger btn-outline-vermelho-claro mt-1">
                            </div>
                        </div>
                    </form>
                </article>
            </div>
        </main>
    </div>
    <script src="js/formadm.js"></script>
    <script>
        $(document).ready(function() {
            let countCategoria = 1;
            $("#addCategoria").click(function() {
                countCategoria++
                $(".selectCategoria").append('<div class="form-group col-sm-12 col-md-6 col-lg-3 cat' + countCategoria + '"><label>Categoria ' + countCategoria + ':</label><select class="form-control ls-select" name="hqCat[' + countCategoria + ']"><?php $categoriaDAO->selectCategoria(); ?></select></div>');
            });
            $("#removeCategoria").click(function() {
                if (countCategoria > 1) {
                    $(".cat" + countCategoria).remove();
                    countCategoria--
                }
            });

            let countAutor = 1;
            $("#addAutor").click(function() {
                countAutor++
                $(".selectAutor").append('<div class="form-group col-sm-12 col-md-6 col-lg-3 aut' + countAutor + '"><label>Autor ' + countAutor + ':</label><select class="form-control ls-select" name="hqAutor[' + countCategoria + ']"><?php $autorDAO->selectAutor(); ?></div>');
            });
            $("#removeAutor").click(function() {
                if (countAutor > 1) {
                    $(".aut" + countAutor).remove();
                    countAutor--
                }
            });
        });
    </script>
    <?php
    if (isset($_POST["cadastrar"])) {
        extract($_POST);
        $quadrinho->setHq_titulo($hqTitulo);
        ($hqVolume != '' || $hqVolume != null) ? $quadrinho->setHq_volume($hqVolume) : $quadrinho->setHq_volume(null);
        ($hqEdicao != '' || $hqEdicao != null) ? $quadrinho->setHq_edicao($hqEdicao) : $quadrinho->setHq_edicao(null);
        $quadrinho->setHq_serie($hqSerie);
        $quadrinho->setHq_tipo($hqTipo);
        $quadrinho->setHq_editora_cod($hqEditora);
        ($hqLancamento != '' || $hqLancamento != null) ? $quadrinho->setHq_lancamento($hqLancamento) : $quadrinho->setHq_lancamento(null);
        ($hqNumPaginas != '' || $hqNumPaginas != null) ? $quadrinho->setHq_numPaginas($hqNumPaginas) : $quadrinho->setHq_numPaginas(null);
        $quadrinho->setHq_impressao($hqImpressao);
        $quadrinho->setHq_sinopse($hqSinopse);
        ($hqFaixaEtaria != '' || $hqFaixaEtaria != null) ? $quadrinho->setHq_faixaEtaria($hqFaixaEtaria) : $quadrinho->setHq_faixaEtaria(null);
        $quadrinho->setHq_valor($hqValor);
        ($hqPromocao != '' || $hqPromocao != null) ? $quadrinho->setHq_porcentagemPromocao($hqPromocao) : $quadrinho->setHq_porcentagemPromocao(null);
        $quadrinho->setHq_estoque($hqEstoque);
        $quadrinho->setHq_emEstoque(boolval($hqEmEstoque));
        $id = $quadrinhoDAO->cadastrar($quadrinho);
        if ($id) {
            require_once("app/models/categoria.php");
            $categoria = new Categoria();
            require_once("app/models/autor.php");
            $autor = new Autor();

            foreach ($hqCat as $catAtual) {
                if (!is_null($catAtual)) {
                    $categoria->setCat_cod($catAtual);
                    $categoria->setHq_cod($id);
                    $categoriaDAO->cadastrarRelacaoQuadrinho($categoria);
                }
            }

            foreach ($hqAutor as $autAtual) {
                if (!is_null($autAtual)) {
                    $autor->setAut_cod($autAtual);
                    $autor->setHq_cod($id);
                    $autorDAO->cadastrarRelacaoQuadrinho($autor);
                }
            }

            if (isset($_FILES['ftq_img'])) {
                require_once("app/controllers/fotoQuadrinhoDAO.php");
                require_once("app/models/fotoQuadrinho.php");
                $fotoDAO = new FotoQuadrinhoDAO();
                $fotos = new FotoQuadrinho();

                $extensao = pathinfo($_FILES['ftq_img']['name'], PATHINFO_EXTENSION);
                $extensao = '.' . strtolower($extensao);
                $nomeimagem = str_replace('-', '', date('Y-m-d')) . str_replace(':', '', date('H:i:s')) . rand(0, 999) . $extensao;

                $verf = move_uploaded_file($_FILES['ftq_img']['tmp_name'], 'images/quadrinhos/' . $nomeimagem);
                if ($verf == 1) {
                    $fotos->setFtq_hq_cod($codUsu);
                    $fotos->setFtq_img($nomeimagem);
                    $fotos->setFtq_desc('Foto de perfil do usuário ' . $_POST['usNome']);
                    if (!$fotoDAO->inserirfoto($fotos)) { ?>
                        <script type="text/javascript">
                            alert("Desculpe, houve um erro ao enviar a foto, contate o Webmaster para resolvê-lo.");
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <script type="text/javascript">
                        alert("Desculpe, houve um erro ao salvar a foto, contate o Webmaster para resolvê-lo.");
                    </script>
            <?php
                }
            }
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