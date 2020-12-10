<?php if (isset($_SESSION['logado']) && $_SESSION['logado'] == 3) { ?>
    <div id="particles-container"></div>
    <div class="center-half mb-4 pb-4">
        <main class="container my-4 text-left">
            <div class="row my-4">
                <aside class="col-lg-4">
                    <div class="list-group shadow" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-quadrinho-list" data-toggle="list" href="#list-quadrinho" role="tab" aria-controls="quadrinho">Quadrinhos</a>
                        <a class="list-group-item list-group-item-action" id="list-cadastrar-quadrinho-list" data-toggle="list" href="#list-cadastrar-quadrinho" role="tab" aria-controls="cadastrar-quadrinho">Cadastrar quadrinho</a>
                        <a class="list-group-item list-group-item-action" id="list-cadastrar-categoria-list" data-toggle="list" href="#list-cadastrar-autor" role="tab" aria-controls="cadastrar-autor">Cadastrar autor</a>
                        <a class="list-group-item list-group-item-action" id="list-cadastrar-categoria-list" data-toggle="list" href="#list-cadastrar-editora" role="tab" aria-controls="cadastrar-editora">Cadastrar editora</a>
                        <!-- <a class="list-group-item list-group-item-action" id="list-cadastrar-categoria-list" data-toggle="list" href="#list-cadastrar-" role="tab" aria-controls="cadastrar-">Cadastrar </a> -->
                        <a class="list-group-item list-group-item-action" id="list-cadastrar-categoria-list" data-toggle="list" href="#list-cadastrar-categoria" role="tab" aria-controls="cadastrar-categoria">Cadastrar categoria</a>
                        <a class="list-group-item list-group-item-action" id="list-cadastrar-tipo-list" data-toggle="list" href="#list-cadastrar-tipo" role="tab" aria-controls="cadastrar-tipo">Cadastrar tipo</a>
                    </div>
                </aside>
                <article class="col-lg-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-quadrinho" role="tabpanel" aria-labelledby="list-quadrinho-list"><?php //include_once('view/components/produtos.php'); ?></div>
                        <div class="tab-pane fade" id="list-cadastrar-quadrinho" role="tabpanel" aria-labelledby="list-cadastrar-quadrinho-list"><?php //include_once('view/components/cadastrarquadrinho.php'); ?></div>
                        <div class="tab-pane fade" id="list-cadastrar-autor" role="tabpanel" aria-labelledby="list-cadastrar-autor-list"><?php include_once('view/components/cadastrarautor.php'); ?></div>
                        <div class="tab-pane fade" id="list-cadastrar-editora" role="tabpanel" aria-labelledby="list-cadastrar-editora-list"><?php include_once('view/components/cadastrareditora.php'); ?></div>
                        <!-- <div class="tab-pane fade" id="list-cadastrar-" role="tabpanel" aria-labelledby="list-cadastrar--list"><?php include_once('view/components/cadastrar.php'); ?></div> -->
                        <div class="tab-pane fade" id="list-cadastrar-categoria" role="tabpanel" aria-labelledby="list-cadastrar-categoria-list"><?php include_once('view/components/cadastrarcategoria.php'); ?></div>
                        <div class="tab-pane fade" id="list-cadastrar-tipo" role="tabpanel" aria-labelledby="list-cadastrar-tipo-list"><?php include_once('view/components/cadastrartipo.php'); ?></div>
                    </div>
                </article>
            </div>
        </main>
    </div>
<?php
} else {
?>
    <script type="text/javascript">
        document.location.href = "<?= URL::getBase(); ?>";
    </script>
<?php
}
?>