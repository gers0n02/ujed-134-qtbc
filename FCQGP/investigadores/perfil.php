<?php
include '../config/config.php';
include '../includes/header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM investigadores WHERE id = $id";
$result = $conn->query($sql);
$investigador = $result->fetch_assoc();
?>
<div class="perfil-investigador">
    <div class="perfil-header">
        <img src="../uploads/fotos/<?= $investigador['foto'] ?>" class="perfil-foto">

        <div class="perfil-info">
            <h1><?= $investigador['nombre'] ?></h1>

            <ul class="perfil-datos">
                <li><strong>LGAC:</strong> <?= $investigador['lgac'] ?></li>
                <li><strong>SEI:</strong> <?= $investigador['sei'] ?></li>
                <li><strong>SNI:</strong> <?= $investigador['sni'] ?></li>
                <li><strong>PRODEP:</strong> <?= $investigador['pro_dep'] ?></li>
            </ul>

            <?php 
            $cv = $investigador['cv'];
            $ruta = "../uploads/cvs/" . $cv;

            if (!empty($cv) && file_exists($ruta)): 
            ?>
                <a href="<?= $ruta ?>" target="_blank" class="btn-cv">
                    Ver CV
                </a>
            <?php endif; ?>

            <?php if (empty($cv)): ?>
                <span class="sin-cv">CV no disponible</span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Tabs -->
    <div class="perfil-tabs">
        <button class="tab active" data-tab="proyectos">Proyectos</button>
        <button class="tab" data-tab="tesis">Tesis</button>
        <button class="tab" data-tab="libros">Libros</button>
        <button class="tab" data-tab="investigaciones">Investigaciones</button>
    </div>

    <!-- Contenido -->
    <div class="tab-content active" id="proyectos">
        <?php include 'partials/proyectos.php'; ?>
    </div>

    <div class="tab-content" id="tesis">
        <?php include 'partials/tesis.php'; ?>
    </div>

    <div class="tab-content" id="libros">
        <?php include 'partials/libros.php'; ?>
    </div>

    <div class="tab-content" id="investigaciones">
        <?php include 'partials/investigaciones.php'; ?>
    </div>
</div>

<script>
document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', () => {
        // quitar active
        document.querySelectorAll('.tab, .tab-content')
            .forEach(el => el.classList.remove('active'));

        // activar
        tab.classList.add('active');
        document.getElementById(tab.dataset.tab).classList.add('active');
    });
});
</script>

<?php include '../includes/footer.php'; ?>