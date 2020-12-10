<?php if (isset($_SESSION['usuario'])) { ?>
    <div id="particles-container"></div>
    <div class="center-half mb-4 pb-4">
        <main class="container my-4 text-left">
            <div class="row my-4">
                <aside class="col-lg-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-dados-list" data-toggle="list" href="#list-dados" role="tab" aria-controls="dados">Meus
                            dados</a>
                        <a class="list-group-item list-group-item-action" id="list-pedidos-list" data-toggle="list" href="#list-pedidos" role="tab" aria-controls="pedidos">Meus
                            pedidos</a>
                        <a class="list-group-item list-group-item-action" id="list-notificacoes-list" data-toggle="list" href="#list-notificacoes" role="tab" aria-controls="notificacoes">Notificações</a>
                        <?php if ($_SESSION['logado'] == 3) { ?>
                            <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
                        <?php } ?>
                    </div>
                </aside>
                <article class="col-lg-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-dados" role="tabpanel" aria-labelledby="list-dados-list">...</div>
                        <div class="tab-pane fade" id="list-pedidos" role="tabpanel" aria-labelledby="list-pedidos-list">...</div>
                        <div class="tab-pane fade" id="list-notificacoes" role="tabpanel" aria-labelledby="list-notificacoes-list">...</div>
                        <?php if ($_SESSION['logado'] == 3) { ?>
                            <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
                        <?php } ?>
                    </div>
                </article>
            </div>
        </main>
    </div>
<?php
} else {
?>
    <script type="text/javascript">
        document.location.href = "<?= URL::getBase(); ?>login";
    </script>
<?php
}
?>