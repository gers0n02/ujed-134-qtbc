<?php include __DIR__ . '/head.php'; ?>

<header class="header <?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'header--home' : '' ?>">
    <div class="contenedor">
        <div class="barra">
            <a href="<?php echo BASE_URL; ?>index.php" class="logo">
                <img src="<?php echo BASE_URL; ?>assets/img/logo.png" class="logo__nombre" alt="Logo FCQ">
            </a>

            <?php include __DIR__ . '/nav.php'; ?>
        </div>
    </div>
</header>