<?php
require_once("app/controllers/quadrinhoDAO.php");
$quadrinhoDAO = new QuadrinhoDAO();

require_once("app/controllers/categoriaDAO.php");
$categoriaDAO = new CategoriaDAO();
$pagina = $_GET['pagina'] ?? 1;
if (isset($_POST['prodCat'])) {
    if (isset($_POST['disp'])) {
?>
        <script type="text/javascript">
            document.location.href = "<?= URL::getBase(); ?>produtos&pagina=1&cat=<?php echo $_POST['prodCat']; ?>&disp=<?php echo $_POST['disp']; ?>";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            document.location.href = "<?= URL::getBase(); ?>produtos&pagina=1&cat=<?php echo $_POST['prodCat']; ?>";
        </script>
<?php
    }
}
if (isset($_GET['cat'])) {
    $catNome = $cat['cat_nome'];
    $cat = $_GET['cat'];
    $numQuadrinhos = $quadrinhoDAO->contarProdutosCategoria($cat);
} else {
    $cat = null;
    $catNome = 'Todos os produtos';
    $numQuadrinhos = $quadrinhoDAO->contarProdutos();
}

if (isset($_GET['disp'])) {
    $ativo = $_GET['disp'];
} else {
    $ativo = '9';
}

$qntporpag = 30;

$numpags = ceil($numQuadrinhos / $qntporpag);

$inicio = ($qntporpag * $pagina) - $qntporpag;
?>
<div id="particles-container"></div>
<div class="center-half mb-4 pb-4">
    <div class="container-fluid mt-4 mb-2 py-4">
        <div class="container">
            <div class="row">
                <div class="col-3 float-left">
                    <form method="post">
                        <div class="form justify-content-center">
                            <div class="form-group">
                                <label>Categoria:</label>
                                <select class="form-control ls-select" name="hqCat">
                                    <?php $categoriaDAO->selectCategoria($cat); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form justify-content-center">
                            <div class="form-group">
                                <label>Disponibilidade:</label><br>
                                <input type="radio" name="disp" id="opcao-1" class="form-check-label" value="9"><label for="opcao-1">Todos</label><br>
                                <input type="radio" name="disp" id="opcao-2" class="form-check-label" value="1"><label for="opcao-2">Disponíveis</label><br>
                                <input type="radio" name="disp" id="opcao-3" class="form-check-label" value="0"><label for="opcao-3">Indisponíveis</label>
                            </div>
                        </div>
                        <div class="form justify-content-center">
                            <div class="form-group text-center">
                                <input type="submit" value="Consultar" id="consultar" name="consultar" class="btn btn-danger btn-outline-vermelho-claro">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-9 float-left">
                    <h5>
                        <?php
                        if ($ativo == 1) {
                            echo $catNome . ' > Disponíveis';
                        } elseif ($ativo == 0) {
                            echo $catNome . ' > Indisponíveis';
                        } else {
                            echo $catNome . ' > Todos';
                        }
                        ?>
                    </h5>
                    <?php
                    $quadrinhoDAO->tabelaProdutos($inicio, $qntporpag, $cat);

                    $pagina_anterior = $pagina - 1;
                    $pagina_posterior = $pagina + 1;
                    ?>
                    <nav aria-label="Page navigation example" class="mt-3">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <?php
                                if ($pagina_anterior != 0) { ?>
                                    <a href="<?= URL::getBase(); ?>enderecos&pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous" class="page-link">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                <?php } else { ?>
                                    <span aria-hidden="true" class="page-link">&laquo;</span>
                                <?php }  ?>
                            </li>
                            <?php
                            for ($i = 1; $i < $numpags + 1; $i++) { ?>
                                <li class="page-item"><a href="<?= URL::getBase(); ?>enderecos&pagina=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                            <?php } ?>
                            <li class="page-item">
                                <?php
                                if ($pagina_posterior <= $numpags) { ?>
                                    <a href="<?= URL::getBase(); ?>enderecos&pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous" class="page-link">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                <?php } else { ?>
                                    <span aria-hidden="true" class="page-link">&raquo;</span>
                                <?php }  ?>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>