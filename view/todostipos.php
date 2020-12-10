<?php
if (is_null($_SESSION['logado']) || $_SESSION['logado'] == 1) {
?>
    <script type="text/javascript">
        alert("Faça login como administrador para visualizar as tipos!");
        document.location.href = "<?= URL::getBase(); ?>login";
    </script>
<?php

}
if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
} else {
    $pagina = 1;
}

require_once("app/controllers/tipoDAO.php");
$tipoDAO = new TipoDAO();

$numtipos = $tipoDAO->contarTipos();

$qntporpag = 10;

$numpags = ceil($numtipos / $qntporpag);

$inicio = ($qntporpag * $pagina) - $qntporpag;
?>
<div id="particles-container"></div>
<div class="center-half mb-4 pb-4">
    <div class="container-fluid mt-4 mb-2 py-4">
        <div class="container">
            <div class="row">
                <div class="col-3 float-left">
                    <p>Vai vender algo mais?</p>
                    <a class="btn btn-outline-vermelho-claro" href="<?= URL::getBase(); ?>cadastrar-tipo">Cadastrar tipo</a>
                </div>
                <div class="col-9 float-left">
                    <?php
                    $tipoDAO->tabelaTipos($inicio, $qntporpag, 'cat_cod DESC');
                    $pagina_anterior = $pagina - 1;
                    $pagina_posterior = $pagina + 1;
                    ?>
                    <nav aria-label="Page navigation example" class="mt-3">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <?php
                                if ($pagina_anterior != 0) { ?>
                                    <a href="<?= URL::getBase(); ?>todas-tipos&pagina=<?php echo $pagina_anterior; ?>" aria-label="Previous" class="page-link">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                <?php } else { ?>
                                    <span aria-hidden="true" class="page-link">&laquo;</span>
                                <?php }  ?>
                            </li>
                            <?php
                            for ($i = 1; $i < $numpags + 1; $i++) { ?>
                                <li class="page-item"><a href="<?= URL::getBase(); ?>todas-tipos&pagina=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                            <?php } ?>
                            <li class="page-item">
                                <?php
                                if ($pagina_posterior <= $numpags) { ?>
                                    <a href="<?= URL::getBase(); ?>todas-tipos&pagina=<?php echo $pagina_posterior; ?>" aria-label="Previous" class="page-link">
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