<?php
require_once("app/controllers/categoriaDAO.php");
$categoriaDAO = new CategoriaDAO();
require_once("app/controllers/tipoDAO.php");
$tipoDAO = new TipoDAO();

$todasCategorias = $categoriaDAO->todasCategorias();
$todosTipos = $tipoDAO->todosTipos();
?>
<header id="flipkart-navbar">
    <div class="container">
        <nav class="row row1 float-right">
            <ul class="largenav pull-right">
                <?php foreach ($todasCategorias as $categoria) { ?>
                    <li class="upper-links dropdown"><a class="links" href="<?= URL::getBase(); ?>quadrinhos/<?= ($categoria['cat_nome']); ?>"><?= $categoria['cat_nome']; ?></a>
                        <ul class="dropdown-menu">
                <?php foreach ($todosTipos as $tipos) { ?>
                            <li class="profile-li"><a class="profile-links" href="<?= URL::getBase(); ?>perfil"><?= $tipos['tipo_nome']; ?></a></li>
                <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isset($_SESSION['usuario'])) { ?>
                    <li class="upper-links">
                        <a class="links" href="#">
                            <!-- <i class="fas fa-bell"></i> -->
                            <i class="far fa-bell"></i>
                        </a>
                    </li>
                    <li class="upper-links dropdown"><a class="links" href="<?= URL::getBase(); ?>perfil"><?= $_SESSION['usuario']; ?></a>
                        <ul class="dropdown-menu">
                            <li class="profile-li"><a class="profile-links" href="<?= URL::getBase(); ?>perfil">Meu Perfil</a></li>
                            <li class="profile-li"><a class="profile-links" href="<?= URL::getBase(); ?>pedidos">Pedidos</a></li>
                            <?php if ($_SESSION['logado'] == 3) { ?>
                                <li class="profile-li"><a class="profile-links" href="<?= URL::getBase(); ?>admin">Admin</a></li>
                            <?php } ?>
                            <li class="profile-li"><a class="profile-links text-center" href="<?= URL::getBase(); ?>sair">Sair</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="upper-links font-weight-bold"><a class="links" href="<?= URL::getBase(); ?>login">Login</a></li>
                    <li class="upper-links font-weight-bold"><a class="links" href="<?= URL::getBase(); ?>cadastro">Cadastro</a></li>
                <?php } ?>
            </ul>
        </nav>
        <nav class="row justify-content-center row2">
            <div class="col-sm-2">
                <h2 style="margin:0px;"><span class="smallnav menu" onclick="openNav()">☰ <img src="/loja/images/logotipo-branco.png" class="w-75"></span></h2>
                <h1 style="margin:0px;"><a class="largenav" href="<?= URL::getBase(); ?>"><img src="/loja/images/logotipo-branco.png" class="w-75"></a></h1>
            </div>
            <div class="flipkart-navbar-search smallsearch col-sm-8 col-xs-11">
                <div class="row">
                    <input class="flipkart-navbar-input col-sm-10 col-lg-11" type="" placeholder="O que está procurando?" name="">
                    <button class="flipkart-navbar-button col-sm-2 col-lg-1">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="cart largenav col-sm-2 col-lg-1">
                <a class="cart-button" href="#">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <span class="item-number">0</span>
            </div>
        </nav>
    </div>
</header>
<nav id="mySidenav" class="sidenav">
    <div class="container" style="background-color: #C42F21; padding-top: 10px;">
        <span class="sidenav-heading">Home</span>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    </div>
    <a href="#">Link</a>
    <a href="#">Link</a>
    <a href="#">Link</a>
    <a href="#">Link</a>
</nav>