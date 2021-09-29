<?php
function c_header()
{
?>
    <header>
        <div>
            <div class="home">
                <h1><?= $GLOBALS['title'] ?></h1>
            </div>
            <a href="/cervejarias.php" class="nav-link">
                Cervejarias
            </a>
            <a href="/cervejas" class="nav-link">
                Cervejas
            </a>
            <a href="/cozinhas" class="nav-link">
                Cozinhas
            </a>
        </div>
    </header>
<?php
}
