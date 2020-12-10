<?php
if (isset($_SESSION['usuario']) && !is_null($_SESSION['usuario'])) {
    $_SESSION['cod_usuario'] = null;
    $_SESSION['usuario'] = null;
    $_SESSION['logado'] = null;
?>
    <script type="text/javascript">
        document.location.href = "<?= URL::getBase(); ?>";
    </script>
<?php
} else {
?>
    <script type="text/javascript">
        document.location.href = "<?= URL::getBase(); ?>login";
    </script>
<?php
}
?>