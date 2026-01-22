<?php
include('../config/config.php');
include('../includes/header.php');

$sql = "SELECT * FROM investigadores WHERE activo = 1 ORDER BY nombre ASC";
$result = $conn->query($sql);
?>
<div class="contenedor header__texto">
    <h2 class="no-margin">Nuestros investigadores en <strong>Química y Tecnología de Biocompuestos</strong> (UJED-134)</h2>
    <p class="no-margin">Explora sus Líneas de Generación y Aplicación del Conocimiento, así como sus proyectos e investigaciones .</p>
</div>

<div class="contenedor contenido-principal">
    <main class="main-investigadores">
        <?php while ($row = $result->fetch_assoc()): ?>
            <article class="entrada">
                <div class="div__entrada">
                    <img  class="entrada__imagen" loading="lazy" src="../uploads/fotos/<?= $row['foto'] ?>" alt="Foto <?php echo $row['nombre']; ?>">
                </div>

                <div class="entrada-contenido">
                    <h4 class="no-margin"><?php echo $row['nombre']; ?></h4>
                    <p><strong>Línea de investigación:</strong> <?php echo $row['lgac']; ?></p>
                    <a href="perfil.php?id=<?php echo $row['id']; ?>" class="boton boton--primario">Ver perfil</a>
                </div>
            </article>
        <?php endwhile; ?>
    </main>
</div>

<?php include '../includes/footer.php'; ?>